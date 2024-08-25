<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Reflection;

use Generator;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class ReflectionFunctionsProvider
{
    public static function allFunctionsProvider(): ?Generator
    {
        $filtered = EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getFunctions());
        if (empty($filtered)) {
            yield [null];
        } else {
            foreach ($filtered as $function) {
                yield "function $function->id" => [$function->id];
            }
        }
    }

    public static function functionsForReturnTypeHintsTestProvider(): ?Generator
    {
        $filtered = EntitiesFilter::getFiltered(
            ReflectionStubsSingleton::getReflectionStubs()->getFunctions(),
            null,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
        if (empty($filtered)) {
            yield [null];
        } else {
            foreach ($filtered as $function) {
                yield "function $function->id" => [$function->id];
            }
        }
    }

    public static function functionsForDeprecationTestsProvider(): ?Generator
    {
        $filtered = EntitiesFilter::getFiltered(
            ReflectionStubsSingleton::getReflectionStubs()->getFunctions(),
            null,
            StubProblemType::FUNCTION_IS_DEPRECATED
        );
        if (empty($filtered)) {
            yield [null];
        } else {
            foreach ($filtered as $function) {
                yield "function $function->id" => [$function->id];
            }
        }
    }

    public static function functionsForParamsAmountTestsProvider(): ?Generator
    {
        $filtered = EntitiesFilter::getFiltered(
            ReflectionStubsSingleton::getReflectionStubs()->getFunctions(),
            null,
            StubProblemType::FUNCTION_PARAMETER_MISMATCH,
            StubProblemType::HAS_DUPLICATION
        );
        if (empty($filtered)) {
            yield [null];
        } else {
            foreach ($filtered as $function) {
                yield "function $function->id" => [$function->id];
            }
        }
    }
}
