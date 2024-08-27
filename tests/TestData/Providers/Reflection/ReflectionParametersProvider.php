<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Reflection;

use Generator;
use StubTests\Model\PHPEnum;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class ReflectionParametersProvider
{
    public static function functionParametersProvider(): ?Generator
    {
        $filteredFunctions = EntitiesFilter::getFilteredReflectionFunctions();
        $array = array_map(function (PHPFunction $function) {
            return EntitiesFilter::getFilteredParameters($function);
        }, $filteredFunctions);
        if (empty($array)) {
            yield [null, null];
        } else {
            foreach ($filteredFunctions as $function) {
                $PHPParameters = EntitiesFilter::getFilteredParameters($function);
                foreach ($PHPParameters as $parameter) {
                    yield "$function->id($parameter->name)" => [$function->id, $parameter->name];
                }
            }
        }
    }

    public static function functionParametersWithTypeProvider(): ?Generator
    {
        $filteredFunctions = EntitiesFilter::getFilteredReflectionFunctions();
        $array = array_map(function (PHPFunction $function) {
            return EntitiesFilter::getFilteredParameters(
                $function,
                null,
                StubProblemType::PARAMETER_TYPE_MISMATCH
            );
        }, $filteredFunctions);
        if (empty($array)) {
            yield [null, null];
        } else {
            foreach ($filteredFunctions as $function) {
                foreach (EntitiesFilter::getFilteredParameters(
                    $function,
                    null,
                    StubProblemType::PARAMETER_TYPE_MISMATCH
                ) as $parameter) {
                    yield "$function->id($parameter->name)" => [$function->id, $parameter->name];
                }
            }
        }
    }

    public static function functionOptionalParametersProvider(): ?Generator
    {
        $filteredFunctions = EntitiesFilter::getFiltered(
            EntitiesFilter::getFilteredReflectionFunctions(),
            problemTypes: StubProblemType::FUNCTION_PARAMETER_MISMATCH
        );
        $array = array_map(function (PHPFunction $function) {
            return EntitiesFilter::getFilteredParameters(
                $function,
                fn (PHPParameter $parameter) => !$parameter->isOptional,
                StubProblemType::PARAMETER_TYPE_MISMATCH,
                StubProblemType::WRONG_OPTIONALLITY
            );
        }, $filteredFunctions);
        if (empty($array)) {
            yield [null, null];
        } else {
            foreach ($filteredFunctions as $function) {
                foreach (EntitiesFilter::getFilteredParameters(
                    $function,
                    fn (PHPParameter $parameter) => !$parameter->isOptional,
                    StubProblemType::PARAMETER_TYPE_MISMATCH,
                    StubProblemType::WRONG_OPTIONALLITY
                ) as $parameter) {
                    yield "$function->id($parameter->name)" => [$function->id, $parameter->name];
                }
            }
        }
    }

    public static function functionOptionalParametersWithDefaultValueProvider(): ?Generator
    {
        $filteredFunctions = EntitiesFilter::getFilteredReflectionFunctions();
        $array = array_map(function (PHPFunction $function) {
            return EntitiesFilter::getFilteredParameters(
                $function,
                fn (PHPParameter $parameter) => !$parameter->isOptional,
                StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
            );
        }, $filteredFunctions);
        if (empty($array)) {
            yield [null, null];
        } else {
            foreach ($filteredFunctions as $function) {
                foreach (EntitiesFilter::getFilteredParameters(
                    $function,
                    fn (PHPParameter $parameter) => !$parameter->isOptional,
                    StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                ) as $parameter) {
                    yield "$function->id($parameter->name)" => [$function->id, $parameter->name];
                }
            }
        }
    }

    public static function functionOptionalParametersWithoutDefaultValueProvider(): ?Generator
    {
        $filteredFunctions = EntitiesFilter::getFilteredReflectionFunctions();
        $array = array_map(function (PHPFunction $function) {
            return EntitiesFilter::getFilteredParameters(
                $function,
                fn (PHPParameter $parameter) => !$parameter->isOptional || $parameter->isDefaultValueAvailable || $parameter->is_vararg,
                StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
            );
        }, $filteredFunctions);
        if (empty($array)) {
            yield [null, null];
        } else {
            foreach ($filteredFunctions as $function) {
                foreach (EntitiesFilter::getFilteredParameters(
                    $function,
                    fn (PHPParameter $parameter) => !$parameter->isOptional || $parameter->isDefaultValueAvailable || $parameter->is_vararg,
                    StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                ) as $parameter) {
                    yield "$function->id($parameter->name)" => [$function->id, $parameter->name];
                }
            }
        }
    }

    public static function classMethodsParametersProvider(): ?Generator
    {
        $classes = ReflectionStubsSingleton::getReflectionStubs()->getClasses();
        $filtered = EntitiesFilter::getFiltered($classes);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters($method);
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                //exclude classes from PHPReflectionParser
                if (strncmp($class->name, 'PHP', 3) !== 0) {
                    foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                        foreach (EntitiesFilter::getFilteredParameters($method) as $parameter) {
                            yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                        }
                    }
                }
            }
        }
    }

    public static function interfaceMethodsParametersProvider(): ?Generator
    {
        $interfaces = ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        $filtered = EntitiesFilter::getFiltered($interfaces);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters($method);
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters($method) as $parameter) {
                        yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }

    public static function enumMethodsParametersProvider(): ?Generator
    {
        $enums = ReflectionStubsSingleton::getReflectionStubs()->getEnums();
        $filtered = EntitiesFilter::getFiltered($enums);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters($method);
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters($method) as $parameter) {
                        yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }

    public static function classMethodParametersWithTypeHintProvider(): ?Generator
    {
        $classes = ReflectionStubsSingleton::getReflectionStubs()->getClasses();
        $filtered = EntitiesFilter::getFiltered($classes);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    null,
                    StubProblemType::PARAMETER_TYPE_MISMATCH
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                //exclude classes from PHPReflectionParser
                if (strncmp($class->name, 'PHP', 3) !== 0) {
                    foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                        foreach (EntitiesFilter::getFilteredParameters(
                            $method,
                            null,
                            StubProblemType::PARAMETER_TYPE_MISMATCH
                        ) as $parameter) {
                            yield "$class->name::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                        }
                    }
                }
            }
        }
    }

    public static function interfaceMethodParametersWithTypeHintProvider(): ?Generator
    {
        $interfaces = ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        $filtered = EntitiesFilter::getFiltered($interfaces);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    null,
                    StubProblemType::PARAMETER_TYPE_MISMATCH
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters(
                        $method,
                        null,
                        StubProblemType::PARAMETER_TYPE_MISMATCH
                    ) as $parameter) {
                        yield "$class->name::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }

    public static function enumMethodParametersWithTypeHintProvider(): ?Generator
    {
        $enums = ReflectionStubsSingleton::getReflectionStubs()->getEnums();
        $filtered = EntitiesFilter::getFiltered($enums);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    null,
                    StubProblemType::PARAMETER_TYPE_MISMATCH
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters(
                        $method,
                        null,
                        StubProblemType::PARAMETER_TYPE_MISMATCH
                    ) as $parameter) {
                        yield "$class->name::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }

    public static function classMethodOptionalParametersProvider(): ?Generator
    {
        $classes = ReflectionStubsSingleton::getReflectionStubs()->getClasses();
        $filtered = EntitiesFilter::getFiltered($classes);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    null,
                    StubProblemType::WRONG_OPTIONALLITY
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                //exclude classes from PHPReflectionParser
                if (strncmp($class->name, 'PHP', 3) !== 0) {
                    foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                        foreach (EntitiesFilter::getFilteredParameters(
                            $method,
                            null,
                            StubProblemType::WRONG_OPTIONALLITY
                        ) as $parameter) {
                            yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                        }
                    }
                }
            }
        }
    }

    public static function interfaceMethodOptionalParametersProvider(): ?Generator
    {
        $interfaces = ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        $filtered = EntitiesFilter::getFiltered($interfaces);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    null,
                    StubProblemType::WRONG_OPTIONALLITY
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $interface) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($interface) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters(
                        $method,
                        null,
                        StubProblemType::WRONG_OPTIONALLITY
                    ) as $parameter) {
                        yield "$interface->id::$method->name($parameter->name)" => [$interface->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }

    public static function enumMethodOptionalParametersProvider(): ?Generator
    {
        $enums = ReflectionStubsSingleton::getReflectionStubs()->getEnums();
        $filtered = EntitiesFilter::getFiltered($enums);
        $array = array_filter(array_map(function (PHPEnum $enum) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    null,
                    StubProblemType::WRONG_OPTIONALLITY
                );
            }, EntitiesFilter::getFilteredReflectionMethods($enum)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));

        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $enum) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($enum) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters(
                        $method,
                        null,
                        StubProblemType::WRONG_OPTIONALLITY
                    ) as $parameter) {
                        yield "$enum->id::$method->name($parameter->name)" => [$enum->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }

    public static function classMethodOptionalParametersWithDefaultValueProvider(): ?Generator
    {
        $classes = ReflectionStubsSingleton::getReflectionStubs()->getClasses();
        $filtered = EntitiesFilter::getFiltered($classes);
        $array = array_filter(array_map(function ($enum) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    fn (PHPParameter $parameter) => !$parameter->isOptional || !$parameter->isDefaultValueAvailable,
                    StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                );
            }, EntitiesFilter::getFilteredReflectionMethods($enum)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));

        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                //exclude classes from PHPReflectionParser
                if (strncmp($class->name, 'PHP', 3) !== 0) {
                    foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                        foreach (EntitiesFilter::getFilteredParameters(
                            $method,
                            fn (PHPParameter $parameter) => !$parameter->isOptional || !$parameter->isDefaultValueAvailable,
                            StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                        ) as $parameter) {
                            yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                        }
                    }
                }
            }
        }
    }

    public static function interfaceMethodOptionalParametersWithDefaultValueProvider(): ?Generator
    {
        $interfaces = ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        $filtered = EntitiesFilter::getFiltered($interfaces);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    fn (PHPParameter $parameter) => !$parameter->isOptional || !$parameter->isDefaultValueAvailable,
                    StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters(
                        $method,
                        fn (PHPParameter $parameter) => !$parameter->isOptional || !$parameter->isDefaultValueAvailable,
                        StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                    ) as $parameter) {
                        yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }

    public static function enumMethodOptionalParametersWithDefaultValueProvider(): ?Generator
    {
        $enums = ReflectionStubsSingleton::getReflectionStubs()->getEnums();
        $filtered = EntitiesFilter::getFiltered($enums);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    fn (PHPParameter $parameter) => !$parameter->isOptional || !$parameter->isDefaultValueAvailable,
                    StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters(
                        $method,
                        fn (PHPParameter $parameter) => !$parameter->isOptional || !$parameter->isDefaultValueAvailable,
                        StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                    ) as $parameter) {
                        yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }

    public static function classMethodOptionalParametersWithoutDefaultValueProvider(): ?Generator
    {
        $classes = ReflectionStubsSingleton::getReflectionStubs()->getClasses();
        $filtered = EntitiesFilter::getFiltered($classes);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    fn (PHPParameter $parameter) => !$parameter->isOptional || $parameter->isDefaultValueAvailable || $parameter->is_vararg,
                    StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                //exclude classes from PHPReflectionParser
                if (strncmp($class->name, 'PHP', 3) !== 0) {
                    foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                        foreach (EntitiesFilter::getFilteredParameters(
                            $method,
                            fn (PHPParameter $parameter) => !$parameter->isOptional || $parameter->isDefaultValueAvailable || $parameter->is_vararg,
                            StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                        ) as $parameter) {
                            yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                        }
                    }
                }
            }
        }
    }

    public static function interfaceMethodOptionalParametersWithoutDefaultValueProvider(): ?Generator
    {
        $interfaces = ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        $filtered = EntitiesFilter::getFiltered($interfaces);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    fn (PHPParameter $parameter) => !$parameter->isOptional || $parameter->isDefaultValueAvailable || $parameter->is_vararg,
                    StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters(
                        $method,
                        fn (PHPParameter $parameter) => !$parameter->isOptional || $parameter->isDefaultValueAvailable || $parameter->is_vararg,
                        StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                    ) as $parameter) {
                        yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }

    public static function enumMethodOptionalParametersWithoutDefaultValueProvider(): ?Generator
    {
        $enums = ReflectionStubsSingleton::getReflectionStubs()->getEnums();
        $filtered = EntitiesFilter::getFiltered($enums);
        $array = array_filter(array_map(function ($class) {
            return array_filter(array_map(function (PHPMethod $method) {
                return EntitiesFilter::getFilteredParameters(
                    $method,
                    fn (PHPParameter $parameter) => !$parameter->isOptional || $parameter->isDefaultValueAvailable || $parameter->is_vararg,
                    StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                );
            }, EntitiesFilter::getFilteredReflectionMethods($class)), fn ($arr) => !empty($arr));
        }, $filtered), fn ($arr) => !empty($arr));
        if (empty($array)) {
            yield [null, null, null];
        } else {
            foreach ($filtered as $class) {
                foreach (EntitiesFilter::getFilteredReflectionMethods($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters(
                        $method,
                        fn (PHPParameter $parameter) => !$parameter->isOptional || $parameter->isDefaultValueAvailable || $parameter->is_vararg,
                        StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE
                    ) as $parameter) {
                        yield "$class->id::$method->name($parameter->name)" => [$class->id, $method->name, $parameter->name];
                    }
                }
            }
        }
    }
}
