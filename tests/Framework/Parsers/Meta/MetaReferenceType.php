<?php

namespace StubTests\Framework\Parsers\Meta;

enum MetaReferenceType: string
{
    case FUNCTION = 'function';
    case METHOD = 'method';
    case CLASS_CONST = 'class_const';
    case GLOBAL_CONST = 'global_const';
}
