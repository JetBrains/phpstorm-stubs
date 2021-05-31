<?php

namespace PHPSTORM_META {

    registerArgumentsSet('FFICType',
        'void *',

        'bool',

        'float',
        'double',
        'long double',

        'char',
        'signed char',
        'unsigned char',
        'int',
        'signed int',
        'unsigned int',
        'long',
        'signed long',
        'unsigned long',
        'long long',
        'signed long long',
        'unsigned long long',

        'intptr_t',
        'uintptr_t',
        'size_t',
        'ssize_t',
        'ptrdiff_t',
        'off_t',
        'va_list',
        '__builtin_va_list',
        '__gnuc_va_list',

        // stdint.h
        'int8_t',
        'uint8_t',
        'int16_t',
        'uint16_t',
        'int32_t',
        'uint32_t',
        'int64_t',
        'uint64_t',
    );

    expectedArguments(\FFI::new(), 0, argumentsSet('FFICType'));
    expectedArguments(\FFI::cast(), 0, argumentsSet('FFICType'));
    expectedArguments(\FFI::type(), 0, argumentsSet('FFICType'));
}
