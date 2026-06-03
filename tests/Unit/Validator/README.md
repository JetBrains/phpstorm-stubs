# Validator Unit Tests

Unit tests for all validator check classes. Each test class verifies a single `CheckInterface`
implementation in isolation using mocks — no file I/O, no parsing, no reflection cache.

## Running

```bash
# All validator unit tests (~1 second)
vendor/bin/phpunit tests/Unit/Validator/

# Specific entity group
vendor/bin/phpunit tests/Unit/Validator/Classes/
vendor/bin/phpunit tests/Unit/Validator/Functions/
vendor/bin/phpunit tests/Unit/Validator/Interfaces/
vendor/bin/phpunit tests/Unit/Validator/Enums/
vendor/bin/phpunit tests/Unit/Validator/Constants/
vendor/bin/phpunit tests/Unit/Validator/PhpDoc/
```

## Structure

```
Unit/Validator/
├── CheckTestCase.php          — base class with mock helpers (see below)
├── KnownProblemsRegistryTest.php
├── Classes/                   — 32 test files (ClassMethodsReturnTypesCheck, etc.)
├── Functions/                 — 10 test files (FunctionExistsCheck, ParameterNamesCheck, etc.)
├── Interfaces/                — 16 test files
├── Enums/                     — 20 test files
├── Constants/                 — 2 test files
└── PhpDoc/                    — 3 test files (Links, Tags, VersionFormat)
```

Current count: **~1083 tests, all passing, 0 skipped**.

## CheckTestCase helpers

`CheckTestCase extends TestCase` provides:

| Method | Returns | Notes |
|---|---|---|
| `createMockStorageManager()` | `ParsedDataStorageManager` | mock |
| `createMockFunction($name, $params, $returnType)` | `PHPFunction` | mock |
| `createMockClass($name, $methods)` | `PHPClass` | mock |
| `createMockClassWithProperties(...)` | `PHPClass` | mock with namespace/final/readonly/parent |
| `createMockMethod($name, $params, $returnType)` | `PHPMethod` | mock |
| `createMockParameter($name, $type, $since, $removed)` | `PHPParameter` | mock |
| `createMockProperty($name, $since, $removed)` | `PHPProperty` | mock |
| `createType($typeName)` | `StandaloneType` | real object |
| `createUnionType(...$types)` | `UnionType` | real object |
| `createNullableType($base)` | `NullableType` | real object |
| `createMockType($typeString)` | `object` | anonymous class with `__toString`/`getTypeName` |
| `createMockReflectionProvider($functions, $classes)` | `ReflectionProviderInterface` | mock |

## Adding a new test file

1. Create `Tests/Unit/Validator/{Group}/YourCheckTest.php`
2. Extend `CheckTestCase`
3. Use `createMock*` helpers; instantiate the check directly with a
   `createMockReflectionProvider()` if it takes one
4. Test: `supports()` returns true/false for specific versions,
   `run()` returns failures for invalid stubs, successes for valid ones
