<?php

namespace StubTests\Unit\Parsers\Reflection\fixtures;

/**
 * A string-backed enum counterpart to {@see PureEnumFixture}.
 *
 * Both shapes are covered because a backed case carries a scalar value while a pure case does not,
 * and only the case *name* is recoverable for the latter.
 */
enum BackedEnumFixture: string
{
    case First = 'first';
}
