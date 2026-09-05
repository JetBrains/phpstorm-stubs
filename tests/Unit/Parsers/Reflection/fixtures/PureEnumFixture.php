<?php

namespace StubTests\Unit\Parsers\Reflection\fixtures;

/**
 * A pure (non-backed) enum, for tests that need a real enum *instance* rather than enum source code.
 *
 * Declared as an autoloadable fixture rather than inline in the test file: the sibling
 * fixtures/ directory holds .txt files, but those are stub *source* fed to the parser and cannot
 * produce a live \UnitEnum. The other tests that need a runtime type build it with heredoc + eval();
 * a fixture class is clearer when the type is shared between test methods.
 *
 * @see \StubTests\Unit\Parsers\Reflection\EnumCaseSerializationTest
 */
enum PureEnumFixture
{
    case Auto;
    case Manual;
}
