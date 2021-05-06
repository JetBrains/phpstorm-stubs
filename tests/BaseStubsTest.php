<?php
declare(strict_types=1);

namespace StubTests;

use JetBrains\PhpStorm\Pure;
use PhpParser\Node\Expr\BinaryOp\BitwiseOr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\UnaryMinus;
use PhpParser\Node\Scalar\DNumber;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Scalar\String_;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\ReflectionStubsSingleton;
use function array_filter;
use function array_pop;
use function property_exists;
use function strval;

abstract class BaseStubsTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
        ReflectionStubsSingleton::getReflectionStubs();
    }

    /**
     * @param mixed $defaultValue
     * @param PHPClass|PHPInterface|null $contextClass
     * @return bool|float|int|string|null
     * @throws Exception|RuntimeException
     */
    public static function getStringRepresentationOfDefaultParameterValue(mixed $defaultValue, PHPClass|PHPInterface $contextClass = null): float|bool|int|string|null
    {
        if ($defaultValue instanceof ConstFetch) {
            $defaultValueName = (string)$defaultValue->name;
            if ($defaultValueName !== 'false' && $defaultValueName !== 'true' && $defaultValueName !== 'null') {
                $constants = array_filter(
                    PhpStormStubsSingleton::getPhpStormStubs()->getConstants(),
                    fn (PHPConst $const) => $const->name === (string)$defaultValue->name
                );
                /** @var PHPConst $constant */
                $constant = array_pop($constants);
                $value = $constant->value;
            } else {
                $value = $defaultValueName;
            }
        } elseif ($defaultValue instanceof String_ || $defaultValue instanceof LNumber || $defaultValue instanceof DNumber) {
            $value = strval($defaultValue->value);
        } elseif ($defaultValue instanceof BitwiseOr) {
            if ($defaultValue->left instanceof ConstFetch && $defaultValue->right instanceof ConstFetch) {
                $constants = array_filter(
                    PhpStormStubsSingleton::getPhpStormStubs()->getConstants(),
                    fn (PHPConst $const) => property_exists($defaultValue->left, 'name') &&
                        $const->name === (string)$defaultValue->left->name
                );
                /** @var PHPConst $leftConstant */
                $leftConstant = array_pop($constants);
                $constants = array_filter(
                    PhpStormStubsSingleton::getPhpStormStubs()->getConstants(),
                    fn (PHPConst $const) => property_exists($defaultValue->right, 'name') &&
                        $const->name === (string)$defaultValue->right->name
                );
                /** @var PHPConst $rightConstant */
                $rightConstant = array_pop($constants);
                $value = $leftConstant->value|$rightConstant->value;
            }
        } elseif ($defaultValue instanceof UnaryMinus && property_exists($defaultValue->expr, 'value')) {
            $value = '-' . strval($defaultValue->expr->value);
        } elseif ($defaultValue instanceof ClassConstFetch) {
            $class = (string)$defaultValue->class;
            if ($class === 'self' && $contextClass !== null) {
                $class = $contextClass->name;
            }
            $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class) ??
                PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class);
            if ($parentClass === null) {
                throw new Exception("Class $class not found in stubs");
            }
            if ((string)$defaultValue->name === 'class') {
                $value = (string)$defaultValue->class;
            } else {
                $constants = array_filter($parentClass->constants, fn (PHPConst $const) => $const->name === (string)$defaultValue->name);
                /** @var PHPConst $constant */
                $constant = array_pop($constants);
                $value = $constant->value;
            }
        } else {
            $value = strval($defaultValue);
        }
        return $value;
    }

    #[Pure]
    public static function getParameterRepresentation(PHPFunction $function): string
    {
        $result = '';
        foreach ($function->parameters as $parameter) {
            $types = array_unique($parameter->typesFromSignature + Utils::flattenArray($parameter->typesFromAttribute, false));
            if (!empty($types)) {
                $result .= implode('|', $types) . ' ';
            }
            if ($parameter->is_passed_by_ref) {
                $result .= '&';
            }
            if ($parameter->is_vararg) {
                $result .= '...';
            }
            $result .= '$' . $parameter->name . ', ';
        }
        return rtrim($result, ', ');
    }

    public static function ifReflectionTypesExistInSignature(array $reflectionTypes, array $typesFromSignature): bool
    {
        return count(array_intersect($reflectionTypes, $typesFromSignature)) === count($reflectionTypes);
    }

    public static function ifReflectionTypesExistInAttributes(array $reflectionTypes, array $typesFromAttribute): bool
    {
        return !empty(array_filter(
            $typesFromAttribute,
            fn (array $types) => count(array_intersect($reflectionTypes, $types)) == count($reflectionTypes)
        ));
    }

    public static function getStringRepresentationOfTypeHintsFromAttributes(array $typesFromAttribute): string
    {
        $resultString = '';
        foreach ($typesFromAttribute as $types) {
            $resultString .= '[' . implode('|', $types) . ']';
        }
        return $resultString;
    }

    public static function convertNullableTypesToUnion($typesToProcess, array &$resultArray)
    {
        array_walk($typesToProcess, function (string $type) use (&$resultArray) {
            if (str_contains($type, '?')) {
                array_push($resultArray, 'null', ltrim($type, '?'));
            } else {
                array_push($resultArray, $type);
            }
        });
    }
}
