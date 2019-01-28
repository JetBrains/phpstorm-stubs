<?php

namespace StubTests;

use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\StaticCall;
use PHPUnit\Framework\TestCase;
use StubTests\Model\PHPConst;
use StubTests\Model\StubsContainer;
use StubTests\Parsers\ExpectedFunctionArgumentsInfo;
use StubTests\Parsers\MetaExpectedArgumentsCollector;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsMetaExpectedArgumentsTest extends TestCase
{
    /**
     * @var ExpectedFunctionArgumentsInfo[]
     */
    private static $expectedArguments;
    private static $functionsFqns;
    private static $methodsFqns;
    private static $constantsFqns;

    public static function setUpBeforeClass()
    {
        self::$expectedArguments = MetaExpectedArgumentsCollector::getMetaExpectedArguments();
        $stubs = PhpStormStubsSingleton::getPhpStormStubs();
        self::$functionsFqns = array_map(function (Model\PHPFunction $func) {
            return self::toPresentableFqn((string)$func->name);
        }, $stubs->getFunctions());
        self::$methodsFqns = self::getMethodsFqns($stubs);
        self::$constantsFqns = self::getConstantsFqns($stubs);
    }

    private static function flatten(array $array): array
    {
        $return = array();
        array_walk_recursive($array, function ($a) use (&$return) {
            $return[$a] = $a;
        });
        return $return;
    }

    public static function getConstantsFqns(StubsContainer $stubs): array
    {
        $constants = array_map(function (PHPConst $constant) {
            return self::toPresentableFqn((string)$constant->name);
        }, $stubs->getConstants());
        foreach ($stubs->getClasses() as $class) {
            foreach ($class->constants as $classConstant) {
                $name = self::getClassMemberFqn($class->name, $classConstant->name);
                $constants[$name] = $name;
            }
        }
        return $constants;
    }

    public static function getMethodsFqns(StubsContainer $stubs): array
    {
        return self::flatten(
            array_map(function (Model\PHPClass $class) {
                return array_map(function (Model\PHPMethod $method) use ($class) {
                    return self::getClassMemberFqn($class->name, $method->name);
                }, $class->methods);
            }, $stubs->getClasses()));
    }


    public function testFunctionReferencesExists()
    {
        foreach (self::$expectedArguments as $argument) {
            $expr = $argument->getFunctionReference();
            if ($expr instanceof FuncCall) {
                $fqn = self::toPresentableFqn($expr->name);
                self::assertArrayHasKey($fqn, self::$functionsFqns, "Can't resolve function " . $fqn);
            } else if ($expr instanceof StaticCall) {
                if ((string)$expr->name !== '__construct') {
                    $fqn = self::getClassMemberFqn($expr->class, $expr->name);
                    self::assertArrayHasKey($fqn, self::$methodsFqns, "Can't resolve method " . $fqn);
                }
            } else if ($expr !== null) {
                self::fail('First argument should be function reference or method reference, got: ' . get_class($expr));
            }
        }
    }

    public function testConstantsExists()
    {
        foreach (self::$expectedArguments as $argument) {
            $expectedArguments = $argument->getExpectedArguments();
            self::assertNotEmpty($expectedArguments, 'Expected arguments should not be empty for ' . $argument);
            foreach ($expectedArguments as $constantReference) {
                if ($constantReference instanceof ClassConstFetch) {
                    $fqn = self::getClassMemberFqn($constantReference->class, $constantReference->name);
                    self::assertArrayHasKey($fqn, self::$constantsFqns, "Can't resolve class constant " . $fqn);
                } else if ($constantReference instanceof ConstFetch) {
                    $fqn = self::toPresentableFqn((string)$constantReference->name);
                    self::assertArrayHasKey($fqn, self::$constantsFqns, "Can't resolve constant " . $fqn);
                }
            }
        }
    }

    private static function getClassMemberFqn($className, $memberName): string
    {
        return self::toPresentableFqn($className) . '.' . $memberName;
    }

    private static function toPresentableFqn(string $name): string
    {
        if (strpos($name, '\\') === 0) {
            return substr($name, 1);
        }
        return $name;
    }
}