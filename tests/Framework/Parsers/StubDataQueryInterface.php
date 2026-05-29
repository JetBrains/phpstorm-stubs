<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Parsers\ClassQueryInterface;
use StubTests\Framework\Parsers\ConstantQueryInterface;
use StubTests\Framework\Parsers\EnumQueryInterface;
use StubTests\Framework\Parsers\FunctionQueryInterface;
use StubTests\Framework\Parsers\InterfaceQueryInterface;

/**
 * Composed read-only query interface for accessing parsed stub/reflection data.
 *
 * Extends five entity-specific query interfaces so that clients can depend on
 * only the slice they need (Interface Segregation Principle).
 *
 * Validators that need multiple entity types should depend on this composed
 * interface; validators that only need one type can depend on the narrower
 * interface (e.g. ConstantQueryInterface).
 */
interface StubDataQueryInterface extends
    ClassQueryInterface,
    FunctionQueryInterface,
    InterfaceQueryInterface,
    EnumQueryInterface,
    ConstantQueryInterface
{
}
