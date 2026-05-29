<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Enum_;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\ParserFactory;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicConstantDefinitionNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicFunctionNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicInterfaceNode;
use StubTests\Framework\Parsers\Stubs\NodeExtractorInterface;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicClassNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicEnumNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicGlobalConstantNode;
use StubTests\Framework\Parsers\Stubs\Nodes\ClassNode;
use StubTests\Framework\Parsers\Stubs\Nodes\FunctionNode;

/**
 * Nikic/php-parser implementation of NodeExtractorInterface.
 * Extracts AST nodes from PHP stub code using nikic/php-parser and wraps them in adapter objects.
 */
class NikicNodeExtractor implements NodeExtractorInterface
{
    private \PhpParser\Parser $parser;

    public function __construct()
    {
        $this->parser = (new ParserFactory())->createForNewestSupportedVersion();
    }

    public function extractFunction(string $stubCode): FunctionNode
    {
        $ast = $this->parser->parse($stubCode);
        $namespace = null;
        $functionNode = null;

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $namespace = $node->name ? '\\' . $node->name->toString() : '\\';
                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Function_) {
                        $functionNode = $stmt;
                        break 2;
                    }
                }
            } elseif ($node instanceof Function_) {
                $namespace = '\\';
                $functionNode = $node;
                break;
            }
        }

        if (!$functionNode) {
            throw new \RuntimeException('No function found in stub code');
        }

        $node = new NikicFunctionNode($functionNode);
        $node->setNamespace($namespace ?? '\\');
        return $node;
    }

    public function extractClass(string $stubCode): ClassNode
    {
        $ast = $this->parser->parse($stubCode);
        $namespace = null;
        $classNode = null;

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $namespace = $node->name ? '\\' . $node->name->toString() : '\\';
                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Class_) {
                        $classNode = $stmt;
                        break 2;
                    }
                }
            } elseif ($node instanceof Class_) {
                $namespace = '\\';
                $classNode = $node;
                break;
            }
        }

        if (!$classNode) {
            throw new \RuntimeException('No class found in stub code');
        }

        $node = new NikicClassNode($classNode);
        $node->setNamespace($namespace ?? '\\');
        return $node;
    }

    public function extractAllClasses(string $stubCode): array
    {
        $ast = $this->parser->parse($stubCode);
        $classes = [];
        $currentNamespace = '\\';

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $currentNamespace = $node->name ? '\\' . $node->name->toString() : '\\';
                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Class_) {
                        $classNode = new NikicClassNode($stmt);
                        $classNode->setNamespace($currentNamespace);
                        $classes[] = $classNode;
                    }
                }
            } elseif ($node instanceof Class_) {
                $classNode = new NikicClassNode($node);
                $classNode->setNamespace('\\');
                $classes[] = $classNode;
            }
        }

        return $classes;
    }

    /**
     * Extract all classes with their import context from stub code.
     * Returns array of ['node' => ClassNode, 'imports' => array].
     */
    public function extractAllClassesWithImports(string $stubCode): array
    {
        $ast = $this->parser->parse($stubCode);
        $classes = [];
        $currentNamespace = '\\';
        $currentImports = [];

        // First, extract imports from root level (for files without namespace)
        $rootImports = $this->extractImports($ast);

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $currentNamespace = $node->name ? '\\' . $node->name->toString() : '\\';
                $currentImports = $this->extractImports($node->stmts);

                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Class_) {
                        $classNode = new NikicClassNode($stmt);
                        $classNode->setNamespace($currentNamespace);
                        $classes[] = [
                            'node' => $classNode,
                            'imports' => $currentImports
                        ];
                    }
                }
            } elseif ($node instanceof Class_) {
                $classNode = new NikicClassNode($node);
                $classNode->setNamespace('\\');
                $classes[] = [
                    'node' => $classNode,
                    'imports' => $rootImports
                ];
            }
        }

        return $classes;
    }

    public function extractAllFunctions(string $stubCode): array
    {
        $ast = $this->parser->parse($stubCode);
        $functions = [];
        $currentNamespace = '\\';
        $currentImports = [];

        // First, extract imports from root level (for files without namespace)
        $rootImports = $this->extractImports($ast);

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $currentNamespace = $node->name ? '\\' . $node->name->toString() : '\\';
                $currentImports = $this->extractImports($node->stmts);
                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Function_) {
                        $functionNode = new NikicFunctionNode($stmt);
                        $functionNode->setNamespace($currentNamespace);
                        $functionNode->setImports($currentImports);
                        $functions[] = $functionNode;
                    }
                }
            } elseif ($node instanceof Function_) {
                $functionNode = new NikicFunctionNode($node);
                $functionNode->setNamespace('\\');
                $functionNode->setImports($rootImports);
                $functions[] = $functionNode;
            }
        }

        return $functions;
    }

    public function extractAllInterfaces(string $stubCode): array
    {
        $ast = $this->parser->parse($stubCode);
        $interfaces = [];
        $currentNamespace = '\\';

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $currentNamespace = $node->name ? '\\' . $node->name->toString() : '\\';
                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Interface_) {
                        $interfaceNode = new NikicInterfaceNode($stmt);
                        $interfaceNode->setNamespace($currentNamespace);
                        $interfaces[] = $interfaceNode;
                    }
                }
            } elseif ($node instanceof Interface_) {
                $interfaceNode = new NikicInterfaceNode($node);
                $interfaceNode->setNamespace('\\');
                $interfaces[] = $interfaceNode;
            }
        }

        return $interfaces;
    }

    /**
     * Extract all interfaces with their import context from stub code.
     * Returns array of ['node' => InterfaceNode, 'imports' => array].
     */
    public function extractAllInterfacesWithImports(string $stubCode): array
    {
        $ast = $this->parser->parse($stubCode);
        $interfaces = [];
        $currentNamespace = '\\';
        $currentImports = [];

        // First, extract imports from root level (for files without namespace)
        $rootImports = $this->extractImports($ast);

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $currentNamespace = $node->name ? '\\' . $node->name->toString() : '\\';
                $currentImports = $this->extractImports($node->stmts);

                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Interface_) {
                        $interfaceNode = new NikicInterfaceNode($stmt);
                        $interfaceNode->setNamespace($currentNamespace);
                        $interfaces[] = [
                            'node' => $interfaceNode,
                            'imports' => $currentImports
                        ];
                    }
                }
            } elseif ($node instanceof Interface_) {
                $interfaceNode = new NikicInterfaceNode($node);
                $interfaceNode->setNamespace('\\');
                $interfaces[] = [
                    'node' => $interfaceNode,
                    'imports' => $rootImports
                ];
            }
        }

        return $interfaces;
    }

    public function extractAllEnums(string $stubCode): array
    {
        $ast = $this->parser->parse($stubCode);
        $enums = [];
        $currentNamespace = '\\';

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $currentNamespace = $node->name ? '\\' . $node->name->toString() : '\\';
                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Enum_) {
                        $enumNode = new NikicEnumNode($stmt);
                        $enumNode->setNamespace($currentNamespace);
                        $enums[] = $enumNode;
                    }
                }
            } elseif ($node instanceof Enum_) {
                $enumNode = new NikicEnumNode($node);
                $enumNode->setNamespace('\\');
                $enums[] = $enumNode;
            }
        }

        return $enums;
    }

    /**
     * Extract all enums with their import context from stub code.
     * Returns array of ['node' => EnumNode, 'imports' => array].
     */
    public function extractAllEnumsWithImports(string $stubCode): array
    {
        $ast = $this->parser->parse($stubCode);
        $enums = [];
        $currentNamespace = '\\';
        $currentImports = [];

        // First, extract imports from root level (for files without namespace)
        $rootImports = $this->extractImports($ast);

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $currentNamespace = $node->name ? '\\' . $node->name->toString() : '\\';
                $currentImports = $this->extractImports($node->stmts);

                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Enum_) {
                        $enumNode = new NikicEnumNode($stmt);
                        $enumNode->setNamespace($currentNamespace);
                        $enums[] = [
                            'node' => $enumNode,
                            'imports' => $currentImports
                        ];
                    }
                }
            } elseif ($node instanceof Enum_) {
                $enumNode = new NikicEnumNode($node);
                $enumNode->setNamespace('\\');
                $enums[] = [
                    'node' => $enumNode,
                    'imports' => $rootImports
                ];
            }
        }

        return $enums;
    }

    public function extractAllDefineConstants(string $stubCode): array
    {
        $ast = $this->parser->parse($stubCode);
        $constants = [];
        $currentNamespace = '\\';

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $currentNamespace = $node->name ? '\\' . $node->name->toString() : '\\';
                $this->extractDefinesFromStatements($node->stmts, $currentNamespace, $constants);
            } else {
                $this->extractDefinesFromStatements([$node], $currentNamespace, $constants);
            }
        }

        return $constants;
    }

    public function extractAllModernConstants(string $stubCode): array {
        $ast = $this->parser->parse($stubCode);
        $constants = [];
        $currentNamespace = '\\';

        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                $currentNamespace = $node->name ? '\\' . $node->name->toString() : '\\';
                $this->extractConstFromStatements($node->stmts, $currentNamespace, $constants);
            } else {
                $this->extractConstFromStatements([$node], $currentNamespace, $constants);
            }
        }

        return $constants;
    }

    private function extractDefinesFromStatements(array $stmts, string $namespace, array &$constants): void
    {
        foreach ($stmts as $stmt) {
            if ($stmt instanceof \PhpParser\Node\Stmt\Expression &&
                $stmt->expr instanceof FuncCall &&
                $stmt->expr->name instanceof Name &&
                $stmt->expr->name->toString() === 'define') {

                $constantNode = new NikicConstantDefinitionNode($stmt->expr);
                $constantNode->setNamespace($namespace);
                $constants[] = $constantNode;
            }
        }
    }

    private function extractConstFromStatements(array $stmts, string $namespace, array &$constants): void
    {
        foreach ($stmts as $stmt) {
            if ($stmt instanceof \PhpParser\Node\Stmt\Const_) {
                // Handle multiple constants in single statement: const A = 1, B = 2, C = 3
                foreach ($stmt->consts as $const) {
                    $constantNode = new NikicGlobalConstantNode($const);
                    $constantNode->setNamespace($namespace);
                    $constants[] = $constantNode;
                }
            }
        }
    }

    /**
     * Extract use/import statements from namespace statements.
     * Returns a map of alias => fully qualified name.
     *
     * @param array $stmts Array of statements from a namespace
     * @return array Map of ['Alias' => 'Fully\\Qualified\\Name']
     */
    private function extractImports(array $stmts): array
    {
        $imports = [];
        foreach ($stmts as $stmt) {
            if ($stmt instanceof Use_) {
                foreach ($stmt->uses as $use) {
                    $alias = $use->getAlias()->toString();
                    $fullName = $use->name->toString();
                    $imports[$alias] = $fullName;
                }
            }
        }
        return $imports;
    }
}
