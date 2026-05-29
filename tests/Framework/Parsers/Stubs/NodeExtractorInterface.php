<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\ClassNodeExtractorInterface;
use StubTests\Framework\Parsers\Stubs\ConstantNodeExtractorInterface;
use StubTests\Framework\Parsers\Stubs\EnumNodeExtractorInterface;
use StubTests\Framework\Parsers\Stubs\FunctionNodeExtractorInterface;
use StubTests\Framework\Parsers\Stubs\InterfaceNodeExtractorInterface;

/**
 * Composite interface for extracting all AST node types from PHP stub code.
 *
 * Extends 5 focused interfaces following ISP. Implementations that support
 * all node types (e.g., NikicNodeExtractor) implement this interface.
 * Clients that only need a subset should depend on the focused interface.
 */
interface NodeExtractorInterface extends
    FunctionNodeExtractorInterface,
    ClassNodeExtractorInterface,
    InterfaceNodeExtractorInterface,
    EnumNodeExtractorInterface,
    ConstantNodeExtractorInterface
{
}
