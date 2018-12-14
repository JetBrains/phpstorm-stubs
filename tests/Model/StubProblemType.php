<?php
declare(strict_types=1);

namespace StubTests\Model;

interface StubProblemType
{
    public const STUB_IS_MISSED = 0;
    public const FUNCTION_PARAMETER_MISMATCH = 1;
    public const WRONG_PARENT = 2;
    public const WRONG_CONSTANT_VALUE = 3;
    public const FUNCTION_IS_DEPRECATED = 4;
    public const FUNCTION_IS_FINAL = 5;
    public const FUNCTION_IS_STATIC = 6;
    public const FUNCTION_ACCESS = 7;
    public const WRONG_INTERFACE = 8;
    public const PARAMETER_TYPE_MISMATCH = 9;
    public const PARAMETER_REFERENCE = 10;
    public const PARAMETER_VARARG = 11;
}
