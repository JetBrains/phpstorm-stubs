<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\ConstExprEvaluationException;
use PhpParser\ConstExprEvaluator;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use StubTests\Framework\Parsers\Stubs\StubConstantRegistry;

/**
 * Evaluates constant expressions from stub sources to plain PHP values.
 *
 * Shared by the Nikic adapters that expose a default value (parameters and
 * properties) so both resolve named constants identically. Unlike
 * NikicExprValueResolverTrait — which only understands scalars and unary
 * operators — this handles arrays, constant fetches and class-constant
 * fetches via PhpParser's ConstExprEvaluator.
 */
trait NikicConstExprEvaluatorTrait
{
    /**
     * Evaluates a constant expression node to a plain PHP value.
     *
     * @throws \RuntimeException if the expression cannot be statically evaluated
     */
    private static function evaluateConstExpr(Expr $expr): mixed
    {
        // Suppress E_DEPRECATED (and E_WARNING from undefined constants) for the duration
        // of the evaluation. Returning true from the handler prevents propagation to
        // PHPUnit's own set_error_handler, which cannot be silenced with @.
        set_error_handler(fn () => true, E_DEPRECATED|E_WARNING);
        try {
            return self::sharedEvaluator()->evaluateDirectly($expr);
        } catch (ConstExprEvaluationException $e) {
            throw new \RuntimeException('Cannot evaluate default value: ' . $e->getMessage(), 0, $e);
        } finally {
            restore_error_handler();
        }
    }

    private static function sharedEvaluator(): ConstExprEvaluator
    {
        static $evaluator = null;
        if ($evaluator === null) {
            $evaluator = new ConstExprEvaluator(
                function (Expr $node): mixed {
                    if ($node instanceof ConstFetch) {
                        $name = $node->name->toString();
                        if (defined($name)) {
                            return constant($name);
                        }
                        // Runtime miss (e.g. the defining extension is not loaded): fall back
                        // to the value parsed from the stub sources so the result is the same
                        // regardless of which extensions the host process happens to have.
                        if (StubConstantRegistry::has($name)) {
                            return StubConstantRegistry::get($name);
                        }
                    } elseif ($node instanceof ClassConstFetch) {
                        if ($node->class instanceof Name && $node->name instanceof Identifier) {
                            $class = $node->class->toString();
                            $const = $node->name->toString();
                            if ($const === 'class') {
                                return $class;
                            }
                            $fqn = $class . '::' . $const;
                            if (defined($fqn)) {
                                return constant($fqn);
                            }
                            // Runtime miss (e.g. ext-intl not loaded for IntlPartsIterator::KEY_*):
                            // fall back to the value parsed from the stub sources.
                            if (StubConstantRegistry::has($fqn)) {
                                return StubConstantRegistry::get($fqn);
                            }
                        }
                    }
                    throw new ConstExprEvaluationException('Expression of type ' . get_class($node) . ' cannot be evaluated');
                }
            );
        }
        return $evaluator;
    }
}
