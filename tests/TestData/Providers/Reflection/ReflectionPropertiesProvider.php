<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Reflection;

use Generator;
use StubTests\Model\PHPProperty;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class ReflectionPropertiesProvider
{
    public static function classPropertiesProvider(): Generator
    {
        return self::yieldFilteredClassProperties();
    }

    public static function classStaticPropertiesProvider(): Generator
    {
        return self::yieldFilteredClassProperties(StubProblemType::PROPERTY_IS_STATIC);
    }

    public static function classPropertiesWithAccessProvider(): Generator
    {
        return self::yieldFilteredClassProperties(StubProblemType::PROPERTY_ACCESS);
    }

    public static function classPropertiesWithTypeProvider(): Generator
    {
        return self::yieldFilteredClassProperties(StubProblemType::PROPERTY_TYPE);
    }

    public static function classReadonlyPropertiesProvider(): Generator
    {
        return self::yieldFilteredClassProperties(StubProblemType::WRONG_READONLY);
    }

    private static function yieldFilteredClassProperties(int ...$problemTypes): ?Generator
    {
        $classes = ReflectionStubsSingleton::getReflectionStubs()->getClasses();
        $filteredClasses = EntitiesFilter::getFiltered($classes);
        $toYield = array_filter(array_map(fn ($class) => EntitiesFilter::getFiltered(
            $class->properties,
            fn (PHPProperty $property) => $property->access === 'private' || $class->name === "DOMException",
            ...$problemTypes
        ), $filteredClasses), fn ($array) => !empty($array));
        if (empty($toYield)) {
            yield [null, null];
        }
        foreach ($toYield as $properties) {
            foreach ($properties as $property) {
                yield "Property $property->parentId::$property->name" => [$property->parentId, $property->name];
            }
        }
    }
}
