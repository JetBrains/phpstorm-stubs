<?php

namespace StubTests\Unit\Parsers\Reflection\fixtures;

/**
 * A class with one deprecated and one current constant, for ReflectionClassConstant::isDeprecated() (PHP 8.4+).
 */
class DeprecatedConstantFixture
{
    #[\Deprecated]
    public const OLD = 1;
    public const CURRENT = 2;
}
