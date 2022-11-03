<?php

namespace PHPSTORM_META {

    registerArgumentsSet('ReflectionClassModifiers',
        \ReflectionClass::IS_FINAL|
        \ReflectionClass::IS_EXPLICIT_ABSTRACT|
        \ReflectionClass::IS_IMPLICIT_ABSTRACT
    );

    registerArgumentsSet('ReflectionMethodModifiers',
        \ReflectionMethod::IS_ABSTRACT|
        \ReflectionMethod::IS_FINAL|
        \ReflectionMethod::IS_PUBLIC|
        \ReflectionMethod::IS_PRIVATE|
        \ReflectionMethod::IS_PROTECTED|
        \ReflectionMethod::IS_STATIC
    );

    registerArgumentsSet('ReflectionPropertyModifiers',
        \ReflectionProperty::IS_PUBLIC|
        \ReflectionProperty::IS_PRIVATE|
        \ReflectionProperty::IS_PROTECTED|
        \ReflectionProperty::IS_STATIC
    );

    registerArgumentsSet('ReflectionGeneratorGetTrace',
        \DEBUG_BACKTRACE_PROVIDE_OBJECT,
        \DEBUG_BACKTRACE_IGNORE_ARGS
    );

    expectedArguments(\ReflectionClass::getMethods(), 0, argumentsSet('ReflectionMethodModifiers'));
    expectedArguments(\ReflectionClass::getProperties(), 0, argumentsSet('ReflectionPropertyModifiers'));

    expectedReturnValues(\ReflectionClass::getModifiers(), argumentsSet('ReflectionClassModifiers'));
    expectedReturnValues(\ReflectionProperty::getModifiers(), argumentsSet('ReflectionPropertyModifiers'));
    expectedReturnValues(\ReflectionMethod::getModifiers(), argumentsSet('ReflectionMethodModifiers'));
}
