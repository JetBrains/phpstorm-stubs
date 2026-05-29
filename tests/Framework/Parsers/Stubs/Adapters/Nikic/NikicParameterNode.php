<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Param;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicAttributeNode;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicTypeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;
use StubTests\Framework\Parsers\Stubs\Nodes\ParameterNode;
use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;

/**
 * Adapter for nikic/php-parser Param nodes.
 */
class NikicParameterNode implements ParameterNode
{
    private Param $param;

    public function __construct(Param $param)
    {
        $this->param = $param;
    }

    public function getName(): string
    {
        return $this->param->var->name;
    }

    public function getType(): ?TypeNode
    {
        if ($this->param->type === null) {
            return null;
        }

        return new NikicTypeNode($this->param->type);
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->param->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                $attributes[] = new NikicAttributeNode($attr);
            }
        }
        return $attributes;
    }

    public function isVariadic(): bool
    {
        return $this->param->variadic;
    }

    public function hasDefaultValue(): bool
    {
        return $this->param->default !== null;
    }

    public function getDefaultValue(): mixed
    {
        if ($this->param->default === null) {
            throw new \RuntimeException('Parameter has no default value');
        }

        // Suppress E_DEPRECATED (and E_WARNING from undefined constants) for the duration
        // of the evaluation. Returning true from the handler prevents propagation to
        // PHPUnit's own set_error_handler, which cannot be silenced with @.
        set_error_handler(fn() => true, E_DEPRECATED | E_WARNING);
        try {
            return self::sharedEvaluator()->evaluateDirectly($this->param->default);
        } catch (\PhpParser\ConstExprEvaluationException $e) {
            throw new \RuntimeException('Cannot evaluate default value: ' . $e->getMessage(), 0, $e);
        } finally {
            restore_error_handler();
        }
    }

    private static function sharedEvaluator(): \PhpParser\ConstExprEvaluator
    {
        static $evaluator = null;
        if ($evaluator === null) {
            $evaluator = new \PhpParser\ConstExprEvaluator(
                function (\PhpParser\Node\Expr $node): mixed {
                    if ($node instanceof \PhpParser\Node\Expr\ConstFetch) {
                        $name = $node->name->toString();
                        if (defined($name)) {
                            return constant($name);
                        }
                    } elseif ($node instanceof \PhpParser\Node\Expr\ClassConstFetch) {
                        if ($node->class instanceof \PhpParser\Node\Name
                            && $node->name instanceof \PhpParser\Node\Identifier
                        ) {
                            $class = $node->class->toString();
                            $const = $node->name->toString();
                            if ($const === 'class') {
                                return $class;
                            }
                            $fqn = $class . '::' . $const;
                            if (defined($fqn)) {
                                return constant($fqn);
                            }
                        }
                    }
                    throw new \PhpParser\ConstExprEvaluationException(
                        'Expression of type ' . get_class($node) . ' cannot be evaluated'
                    );
                }
            );
        }
        return $evaluator;
    }
}
