<?php
declare(strict_types=1);

namespace StubTests;

use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\BinaryOp\BitwiseOr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\UnaryMinus;
use PhpParser\Node\Scalar\DNumber;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Scalar\String_;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConstant;
use StubTests\Model\PHPEnum;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Parsers\ParserUtils;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use UnitEnum;
use function array_filter;
use function array_pop;
use function property_exists;
use function strval;

abstract class AbstractBaseStubsTestCase extends TestCase
{
    protected string $emptyDataSetMessage = "Data provider returned empty set";

    public static function getStringRepresentationOfDefaultParameterValue(mixed $defaultValue, PHPClass|PHPInterface|null $contextClass = null): float|bool|int|string|null
    {
        if ($defaultValue instanceof ConstFetch) {
            $defaultValueName = (string)$defaultValue->name;
            if ($defaultValueName !== 'false' && $defaultValueName !== 'true' && $defaultValueName !== 'null') {
                $constant = PhpStormStubsSingleton::getPhpStormStubs()->getConstant($defaultValue->name->toCodeString());
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
                    fn ($const) => property_exists($defaultValue->left, 'name') &&
                        $const->name === (string)$defaultValue->left->name
                );
                /** @var PHPConstant $leftConstant */
                $leftConstant = array_pop($constants);
                $constants = array_filter(
                    PhpStormStubsSingleton::getPhpStormStubs()->getConstants(),
                    fn ($const) => property_exists($defaultValue->right, 'name') &&
                        $const->name === (string)$defaultValue->right->name
                );
                /** @var PHPConstant $rightConstant */
                $rightConstant = array_pop($constants);
                $value = $leftConstant->value|$rightConstant->value;
            } elseif ($defaultValue->left instanceof ClassConstFetch && $defaultValue->right instanceof ClassConstFetch){
                $leftClass = $defaultValue->left->class->toCodeString();
                $rightClass = $defaultValue->right->class->toCodeString();
                $leftClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($leftClass);
                $rightClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($rightClass);
                if ($leftClass === null || $rightClass === null) {
                    throw new Exception("Class $leftClass->name or $rightClass->name not found in stubs");
                }
                $leftConstant = $leftClass->getConstant((string)$defaultValue->left->name);
                $rightConstant = $rightClass->getConstant((string)$defaultValue->right->name);
                $value = $leftConstant->value|$rightConstant->value;
            }
        } elseif ($defaultValue instanceof UnaryMinus && property_exists($defaultValue->expr, 'value')) {
            $value = '-' . $defaultValue->expr->value;
        } elseif ($defaultValue instanceof ClassConstFetch) {
            $class = $defaultValue->class->toCodeString();
            if ($class === 'self' && $contextClass !== null) {
                $class = $contextClass->id;
            }
            $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($class) ??
                PhpStormStubsSingleton::getPhpStormStubs()->getClass($class) ??
                PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class);
            if ($parentClass === null) {
                throw new Exception("Class $class not found in stubs");
            }
            if ($parentClass instanceof PHPEnum) {
                $value = $parentClass->id . "::" . $defaultValue->name;
            } elseif ((string)$defaultValue->name === 'class') {
                $value = (string)$defaultValue->class;
            } else {
                $constant = $parentClass->getConstant((string)$defaultValue->name);
                $value = $constant->value;
            }
        } elseif ($defaultValue === null) {
            $value = "null";
        } elseif (is_array($defaultValue) || $defaultValue instanceof Array_) {
            $value = '[]';
        } elseif ($defaultValue instanceof UnitEnum){
            $value = "\\" . get_class($defaultValue) . "::" . $defaultValue->name;
        } else {
            $value = strval($defaultValue);
        }
        return $value;
    }

    public static function getParameterRepresentation(PHPFunction $function): string
    {
        $result = '';
        foreach ($function->parameters as $parameter) {
            $types = array_unique($parameter->typesFromSignature + Model\CommonUtils::flattenArray($parameter->typesFromAttribute, false));
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

    /**
     * @param PHPFunction[] $filtered
     * @return PHPFunction[]
     */
    protected static function getDuplicatedFunctions(array $filtered): array
    {
        $duplicatedFunctions = array_filter($filtered, function (PHPFunction $value, int|string $key) {
            $duplicatesOfFunction = self::getAllDuplicatesOfFunction($value->name);
            $functionVersions[] = ParserUtils::getAvailableInVersions(
                PhpStormStubsSingleton::getPhpStormStubs()->getFunction($value->name, shouldSuitCurrentPhpVersion: false)
            );
            array_push($functionVersions, ...array_values(array_map(
                fn (PHPFunction $function) => ParserUtils::getAvailableInVersions($function),
                $duplicatesOfFunction
            )));
            $hasDuplicates = false;
            $current = array_pop($functionVersions);
            $next = array_pop($functionVersions);
            while ($next !== null) {
                if (!empty(array_intersect($current, $next))) {
                    $hasDuplicates = true;
                }
                $current = array_merge($current, $next);
                $next = array_pop($functionVersions);
            }
            return $hasDuplicates;
        }, ARRAY_FILTER_USE_BOTH);
        return array_unique(array_map(fn (PHPFunction $function) => $function->name, $duplicatedFunctions));
    }

    /**
     * @return PHPFunction[]
     */
    protected static function getAllDuplicatesOfFunction(?string $name): array
    {
        return array_filter(
            PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(),
            fn ($duplicateValue, $duplicateKey) => $duplicateValue->name === $name && str_contains($duplicateKey, 'duplicated'),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * @param string[] $reflectionTypes
     * @param string[] $typesFromSignature
     */
    public static function isReflectionTypesMatchSignature(array $reflectionTypes, array $typesFromSignature): bool
    {
        return empty(array_merge(
            array_diff($reflectionTypes, $typesFromSignature),
            array_diff($typesFromSignature, $reflectionTypes)
        ));
    }

    /**
     * @param string[] $reflectionTypes
     * @param string[] $typesFromAttribute
     */
    public static function isReflectionTypesExistInAttributes(array $reflectionTypes, array $typesFromAttribute): bool
    {
        return empty(array_merge(
            array_diff($reflectionTypes, array_filter($typesFromAttribute, fn ($type) => !empty($type))),
            array_diff(array_filter($typesFromAttribute, fn ($type) => !empty($type)), $reflectionTypes)
        ));
    }

    /**
     * @param string[][] $typesFromAttribute
     */
    public static function getStringRepresentationOfTypeHintsFromAttributes(array $typesFromAttribute): string
    {
        $resultString = '';
        foreach ($typesFromAttribute as $types) {
            $resultString .= '[' . implode('|', $types) . ']';
        }
        return $resultString;
    }

    /**
     * @param string[] $typesToProcess
     * @param string[] $resultArray
     */
    public static function convertNullableTypesToUnion(array $typesToProcess, array &$resultArray)
    {
        array_walk($typesToProcess, function (string $type) use (&$resultArray) {
            if (str_contains($type, '?')) {
                array_push($resultArray, 'null', ltrim($type, '?'));
            } else {
                $resultArray[] = $type;
            }
        });
    }

    public function getClassLikeFromStubs(string $classId, bool $shouldSuiteCurrentPHPVersion = true): PHPInterface|PHPEnum|PHPClass|null
    {
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getEnum("$classId", $shouldSuiteCurrentPHPVersion);
        if ($stubClass == null) {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass("$classId", $shouldSuiteCurrentPHPVersion);
        }
        if ($stubClass == null) {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface("$classId", $shouldSuiteCurrentPHPVersion);
        }
        return $stubClass;
    }
}
