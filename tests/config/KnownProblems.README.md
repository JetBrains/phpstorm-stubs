# Known Problems System

## Overview

The Known Problems system handles entities (functions, methods, classes) where stubs cannot perfectly match PHP reflection data for legitimate reasons.

**Most common case:** Overloaded function signatures - where one function accepts multiple parameter signatures, but reflection only returns one.

## Why Type-Safe PHP Code?

Previously this was a JSON file, but we migrated to type-safe PHP code for:
- ✅ **Compile-time validation** - Invalid problems won't compile
- ✅ **Full IDE support** - Autocomplete, go-to-definition, refactoring
- ✅ **Type safety** - Enums prevent typos in check names, entity types
- ✅ **Self-documenting** - PHPDoc and types explain everything
- ✅ **Testable** - Easy to mock providers for testing

## Architecture

```
tests/Framework/Validator/KnownProblems/
├── ProblemType.php               (Enum: OVERLOADED_SIGNATURE, etc.)
├── CheckType.php                 (Enum: PARAMETER_NAMES, PARAMETER_TYPES, etc.)
├── EntityType.php                (Enum: FUNCTION, METHOD, CLASS_TYPE, etc.)
├── ProblemDefinition.php         (Value object with all problem details)
├── KnownProblemsProvider.php     (Interface for providing problems)
└── DefaultKnownProblemsProvider.php (Implementation with all known problems)
```

## How It Works

### 1. Problems are defined as type-safe PHP objects

```php
new ProblemDefinition(
    entityType: EntityType::FUNCTION,
    entityId: '\\dba_fetch',
    type: ProblemType::OVERLOADED_SIGNATURE,
    affectedChecks: [CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES],
    versionRange: new PhpVersionRange('5.6', '8.4'),
    reason: 'dba_fetch has 2 overloaded signatures...'
)
```

### 2. Registry indexes problems for fast lookup

```php
$registry = KnownProblemsRegistry::getInstance();
if ($registry->shouldSkipValidation('functions', '\\dba_fetch', 'ParameterNamesCheck', '8.0')) {
    // Skip validation
}
```

### 3. Validators check registry before validating

Each validator (ParameterNamesCheck, ParameterTypesCheck, ReturnTypesCheck) queries the registry before running validation.

## Adding New Problems

### Option 1: Direct Addition (Recommended)

Edit `DefaultKnownProblemsProvider.php` and add to the array:

```php
new ProblemDefinition(
    entityType: EntityType::FUNCTION,
    entityId: '\\your_function',
    type: ProblemType::OVERLOADED_SIGNATURE,
    affectedChecks: [CheckType::PARAMETER_NAMES],
    versionRange: new PhpVersionRange('7.0', '8.4'),
    reason: 'Detailed explanation of why this problem exists'
),
```

An entry must suppress a failure that happens today: some validator case for the entity, at a
version in `versionRange`, running one of `affectedChecks`, must fail without the entry and pass
with it. `KnownProblemsNecessityTest` (Structure suite) checks this for every entry and fails on
one that suppresses nothing, so an entry that is too broad, has the wrong check type or version
range, or outlives its fix is caught. Remove such an entry rather than widening it. An entry that
no case can exercise (for example, for an extension that no reflection cache includes) is
reported as skipped.

**Benefits:**
- IDE will autocomplete enum values
- Compiler catches typos immediately
- Full type checking

### Option 2: Custom Provider (Advanced)

For specific test scenarios, implement `KnownProblemsProvider`:

```php
class TestKnownProblemsProvider implements KnownProblemsProvider {
    public function getProblems(): array {
        return [/* your test problems */];
    }

    public function getProblemsForEntity(EntityType $type, string $id): array {
        // Custom logic
    }
}

// Use in tests
$registry = KnownProblemsRegistry::getInstance(new TestKnownProblemsProvider());
```

## Problem Types

### `ProblemType::OVERLOADED_SIGNATURE`
Function/method has multiple valid signatures. PHP reflection only returns one, but stubs must document all for IDE support.

**Examples:** `dba_fetch`, `strtr`, `session_set_save_handler`

### `ProblemType::REFLECTION_LIMITATION`
PHP's reflection API doesn't expose certain internal details correctly.

### `ProblemType::VERSION_SPECIFIC_BEHAVIOR`
Implementation varies across PHP versions in ways reflection doesn't capture clearly.

## Check Types

All validators that can skip validation:
- `CheckType::PARAMETER_NAMES` - Parameter name validation (PHP 8.0+)
- `CheckType::PARAMETER_TYPES` - Parameter type hint validation
- `CheckType::RETURN_TYPES` - Return type validation
- `CheckType::FUNCTION_EXISTS` - Function existence
- `CheckType::METHOD_EXISTS` - Method existence
- `CheckType::CLASS_EXISTS` - Class existence

## Entity Types

- `EntityType::FUNCTION` - Global functions (`\dba_fetch`)
- `EntityType::METHOD` - Class/interface methods (`DateTime::format`)
- `EntityType::CLASS_TYPE` - Classes
- `EntityType::INTERFACE_TYPE` - Interfaces

## Currently Registered Problems

`DefaultKnownProblemsProvider.php` is the list of record. Each entry's `reason` explains why it
exists. Entries are grouped by the check they apply to, under `// ── <Check> known problems ──`
section comments, and `KnownProblemsNecessityTest` removes the need to keep a copy of the list
here: an entry that no longer suppresses a failure makes it fail.

The entries fall into these kinds:

- **Overloaded signatures** (`OVERLOADED_SIGNATURE`): functions and methods that accept more than
  one parameter list, such as `dba_fetch`, `strtr`, `setcookie`, `session_set_save_handler` and
  `PDO::query`.
- **Declarations reflection does not report** (`INTERNAL_IMPLEMENTATION`): interfaces implemented
  at the C level (`SimpleXMLElement` and `ArrayAccess`), interfaces and modifiers that changed
  across versions while the stub declares them for all versions (`DatePeriod` and
  `IteratorAggregate`, `GMP` becoming final in 8.4), stub-only methods such as the PDO
  driver-specific ones, and parameter counts older reflection gets wrong.
- **Environment-dependent constant values** (`RUNTIME_VALUE`): library and Unicode versions,
  build paths and other values the stubs cannot pin, such as the `IntlChar` limits.

## Testing

### Unit Tests
```bash
vendor/bin/phpunit tests/Unit/Validator/KnownProblemsRegistryTest.php
```

### Integration Tests
```bash
vendor/bin/phpunit tests/FunctionValidatorTest.php --filter dba_fetch
```

### Necessity Test
Checks that each entry still suppresses a failure (see [Adding New Problems](#adding-new-problems)).
It loads every reflection cache, so it needs more memory than the default `memory_limit`; the
test runner image uses 2048M:
```bash
php -d memory_limit=2048M vendor/bin/phpunit tests/KnownProblemsNecessityTest.php
```

`KnownProblemsIntegrityTest` complements it by checking that each entry's entity exists.

## Migration from JSON

The previous JSON-based approach had issues:
- ❌ No type checking (typos caught at runtime)
- ❌ No IDE support (manual string typing)
- ❌ No autocomplete
- ❌ Hard to refactor
- ❌ Verbose and repetitive

The new PHP-based approach solves all these issues while maintaining the same registry API for backward compatibility.

## Example: Before vs After

### Before (JSON - 190 lines)
```json
{
  "functions": {
    "\\dba_fetch": {
      "problems": [{
        "type": "overloaded_signature",
        "affectedChecks": ["ParameterNamesCheck"],  // typo = runtime error
        "affectedVersions": {"from": "5.6", "to": "8.4"},
        "reason": "...",
        "skipValidation": true
      }]
    }
  }
}
```

### After (PHP - Type-safe)
```php
new ProblemDefinition(
    entityType: EntityType::FUNCTION,
    entityId: '\\dba_fetch',
    type: ProblemType::OVERLOADED_SIGNATURE,
    affectedChecks: [CheckType::PARAMETER_NAMES],  // typo = compile error!
    versionRange: new PhpVersionRange('5.6', '8.4'),
    reason: '...'
)
```

## Benefits Summary

1. **Type Safety:** Enums and value objects prevent invalid configurations
2. **IDE Support:** Full autocomplete, navigation, refactoring
3. **Maintainability:** Clear structure, easy to extend
4. **Self-Documenting:** Types and PHPDoc explain everything
5. **Testable:** Easy to mock providers
6. **Consistent:** Matches codebase patterns (enums, providers, attributes)
7. **Fast:** Indexed lookups, no file I/O

## API Compatibility

The `KnownProblemsRegistry` public API remains unchanged - validators don't need updates. All changes are internal implementation details.
