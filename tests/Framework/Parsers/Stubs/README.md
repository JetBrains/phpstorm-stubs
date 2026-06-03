# Parser Architecture

This directory contains a parser-agnostic architecture for processing PHP stub files. The design follows the **Adapter Pattern** to decouple the parsing logic from specific parser implementations.

## Architecture Overview

```
┌─────────────────────────────────────────────────────────┐
│                     Client Code                         │
│              (StubFunctionParser,                       │
│               StubClassParser)                          │
└────────────────────┬────────────────────────────────────┘
                     │ depends on
                     ▼
┌─────────────────────────────────────────────────────────┐
│              Parser-Agnostic Interfaces                 │
│  (NodeExtractorInterface, FunctionNode, ClassNode...)  │
└────────────────────┬────────────────────────────────────┘
                     │ implemented by
                     ▼
┌─────────────────────────────────────────────────────────┐
│                  Adapter Layer                          │
│        (NikicNodeExtractor, NikicFunctionNode...)       │
└────────────────────┬────────────────────────────────────┘
                     │ wraps
                     ▼
┌─────────────────────────────────────────────────────────┐
│              Concrete Parser Library                    │
│               (nikic/php-parser)                        │
└─────────────────────────────────────────────────────────┘
```

## Key Components

### 1. Interfaces (`Nodes/`)
Parser-agnostic interfaces that define the contract for AST nodes:
- `NodeExtractorInterface` - Extracts nodes from PHP source code
- `FunctionNode` - Represents a function in the AST
- `ClassNode` - Represents a class in the AST
- `ParameterNode`, `TypeNode`, `DocCommentNode`, etc.

### 2. Adapters (`Adapters/Nikic/`)
Implementations that wrap nikic/php-parser nodes:
- `NikicNodeExtractor` - Extracts and wraps nikic nodes
- `NikicFunctionNode` - Wraps `PhpParser\Node\Stmt\Function_`
- `NikicClassNode` - Wraps `PhpParser\Node\Stmt\Class_`
- And more...

### 3. Parsers
Business logic that works with interfaces:
- `StubFunctionParser` - Converts `FunctionNode` to `PHPFunction` domain objects
- `StubClassParser` - Converts `ClassNode` to `PHPClass` domain objects

## How to Switch Parser Libraries

If you need to replace nikic/php-parser with a different library:

### Step 1: Create New Adapter Implementations

Create a new directory under `Adapters/` (e.g., `Adapters/NewParser/`) and implement:

1. **NewParserNodeExtractor** (implements `NodeExtractorInterface`)
   ```php
   class NewParserNodeExtractor implements NodeExtractorInterface
   {
       public function extractFunction(string $stubCode): array
       {
           // Use NewParser library to parse $stubCode
           // Return ['node' => NewParserFunctionNode, 'namespace' => '...']
       }

       public function extractClass(string $stubCode): array
       {
           // Use NewParser library to parse $stubCode
           // Return ['node' => NewParserClassNode, 'namespace' => '...']
       }
   }
   ```

2. **NewParserFunctionNode** (implements `FunctionNode`)
   ```php
   class NewParserFunctionNode implements FunctionNode
   {
       private NewParserFunctionAst $function;

       public function __construct(NewParserFunctionAst $function)
       {
           $this->function = $function;
       }

       public function getName(): string
       {
           return $this->function->getName(); // Adapt to NewParser API
       }

       public function getParameters(): array
       {
           // Convert NewParser parameters to ParameterNode[]
       }

       // Implement other methods...
   }
   ```

3. **NewParserClassNode** (implements `ClassNode`)
4. Other node adapters as needed

### Step 2: Update Default Node Extractor

In `StubFunctionParser` and `StubClassParser`, change the default from `NikicNodeExtractor` to your new implementation:

```php
class StubFunctionParser
{
    private NodeExtractorInterface $nodeExtractor;

    public function __construct(?NodeExtractorInterface $nodeExtractor = null)
    {
        // Change this line:
        $this->nodeExtractor = $nodeExtractor ?? new NewParserNodeExtractor();
    }
}
```

### Step 3: Run Tests

All existing tests should pass without modification, as they use the public API which hasn't changed.

```bash
php vendor/bin/phpunit tests/Unit/AST/Parsers/
```

## Benefits of This Architecture

1. **Swappable Parser Libraries** - Replace the underlying parser without touching business logic
2. **Testability** - Mock interfaces instead of concrete parser nodes
3. **Encapsulation** - Parser-specific details hidden behind clean interfaces
4. **Single Responsibility** - Each class has one reason to change
5. **Open/Closed Principle** - Open for extension (new adapters), closed for modification (parsers)

## Current Implementation

- **Parser Library**: nikic/php-parser v5.x
- **Adapter Location**: `Adapters/Nikic/`
- **Node Extractor**: `NikicNodeExtractor`

## Example Usage

```php
use StubTests\Sources\Parsers\Entities\Stubs\StubFunctionParser;
use StubTests\Sources\Parsers\Entities\Stubs\Adapters\Nikic\NikicNodeExtractor;

// Using default (nikic) parser
$parser = new StubFunctionParser();
$function = $parser->parse('<?php function foo() {}');

// Or inject a custom parser implementation
$customExtractor = new CustomNodeExtractor();
$parser = new StubFunctionParser($customExtractor);
$function = $parser->parse('<?php function foo() {}');
```
