<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Reflection;

use Generator;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPInterface;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class ReflectionClassesTestDataProviders
{
    public static function allClassesProvider(): ?Generator
    {
        $allClassesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses() +
            ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        foreach (EntitiesFilter::getFiltered($allClassesAndInterfaces) as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0) {
                yield "class $class->name" => [$class];
            }
        }
    }

    public static function classesWithInterfacesProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getClasses(),
            fn(PHPClass $class) => empty($class->interfaces), StubProblemType::WRONG_INTERFACE) as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0) {
                yield "class $class->name" => [$class];
            }
        }
    }

    public static function classWithParentProvider(): ?Generator
    {
        $classesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses() +
            ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        $filtered = EntitiesFilter::getFiltered(
            $classesAndInterfaces,
            fn(PHPClass|PHPInterface $class) => empty($class->parentInterfaces) && empty($class->parentClass),
            StubProblemType::WRONG_PARENT);
        foreach ($filtered as $class) {
            yield "class $class->name" => [$class];
        }
    }
}
