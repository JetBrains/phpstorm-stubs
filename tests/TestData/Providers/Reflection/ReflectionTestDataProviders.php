<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Reflection;

use Generator;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class ReflectionTestDataProviders
{
    public static function allFunctionsProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getFunctions()) as $function) {
            yield "function {$function->name}" => [$function];
        }
    }

    public static function allClassesProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getClasses()) as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0) {
                yield "class {$class->name}" => [$class];
            }
        }

        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getInterfaces()) as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }

    public static function classesProvider(): ?Generator {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getClasses()) as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0) {
                yield "class {$class->name}" => [$class];
            }
        }
    }

    public static function interfaceProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getInterfaces()) as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }

    public static function getFilteredFunctions(PHPClass|PHPInterface $class = null): array
    {
        if ($class === null) {
            $allFunctions = ReflectionStubsSingleton::getReflectionStubs()->getFunctions();
        } else {
            $allFunctions = $class->methods;
        }
        /** @var PHPFunction[] $resultArray */
        $resultArray = [];
        foreach (EntitiesFilter::getFiltered($allFunctions, StubProblemType::FUNCTION_PARAMETER_MISMATCH) as $function) {
            $resultArray[] = $function;
        }
        return $resultArray;
    }
}
