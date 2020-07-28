<?php

/**
 * The <b>ReflectionParameter</b> class retrieves
 * information about function's or method's parameters.
 *
 * @property-read string $name Name of the parameter, same as calling the {@see ReflectionParameter::getName()} method
 *
 * @link https://php.net/manual/en/class.reflectionparameter.php
 */
class ReflectionParameter implements Reflector
{
    /**
     * Construct
     *
     * @link https://php.net/manual/en/reflectionparameter.construct.php
     * @param callable $function The function to reflect parameters from.
     * @param string|int $parameter Either an integer specifying the position
     * of the parameter (starting with zero), or a the parameter name as string.
     * @throws \ReflectionException if the function or parameter does not exist.
     */
    public function __construct(callable $function, $parameter)
    {
    }

    /**
     * Exports
     *
     * @link https://php.net/manual/en/reflectionparameter.export.php
     * @param string $function The function name.
     * @param string $parameter The parameter name.
     * @param bool $return Setting to {@see true} will return the export,
     * as opposed to emitting it. Setting to {@see false} (the default) will do the
     * opposite.
     * @return string|null The exported reflection.
     * @deprecated 7.4
     * @removed 8.0
     */
    public static function export($function, $parameter, $return = false)
    {
    }

    /**
     * Returns the string representation of the ReflectionParameter object.
     *
     * @link https://php.net/manual/en/reflectionparameter.tostring.php
     * @return string
     */
    public function __toString()
    {
    }

    /**
     * Gets parameter name
     *
     * @link https://php.net/manual/en/reflectionparameter.getname.php
     * @return string The name of the reflected parameter.
     */
    public function getName()
    {
    }

    /**
     * Checks if passed by reference
     *
     * @link https://php.net/manual/en/reflectionparameter.ispassedbyreference.php
     * @return bool {@see true} if the parameter is passed in by reference, otherwise {@see false}
     */
    public function isPassedByReference()
    {
    }

    /**
     * Returns whether this parameter can be passed by value
     *
     * @link https://php.net/manual/en/reflectionparameter.canbepassedbyvalue.php
     * @return bool|null {@see true} if the parameter can be passed by value, {@see false} otherwise.
     * Returns {@see null} in case of an error.
     * @since 5.4
     */
    public function canBePassedByValue()
    {
    }

    /**
     * Gets declaring function
     *
     * @link https://php.net/manual/en/reflectionparameter.getdeclaringfunction.php
     * @return ReflectionFunctionAbstract A {@see ReflectionFunctionAbstract} object.
     * @since 5.2.3
     */
    public function getDeclaringFunction()
    {
    }

    /**
     * Gets declaring class
     *
     * @link https://php.net/manual/en/reflectionparameter.getdeclaringclass.php
     * @return ReflectionClass|null A {@see ReflectionClass} object or {@see null} if
     * called on function.
     */
    public function getDeclaringClass()
    {
    }

    /**
     * Gets the class type hinted for the parameter as a ReflectionClass object.
     *
     * @link https://php.net/manual/en/reflectionparameter.getclass.php
     * @return ReflectionClass|null A {@see ReflectionClass} object.
     * @deprecated 8.0 Use {@link ReflectionParameter::getType()} and the ReflectionType APIs should be usedinstead.
     */
    public function getClass()
    {
    }

    /**
     * Checks if the parameter has a type associated with it.
     *
     * @link https://php.net/manual/en/reflectionparameter.hastype.php
     * @return bool {@see true} if a type is specified, {@see false} otherwise.
     * @since 7.0
     */
    public function hasType()
    {
    }

    /**
     * Gets a parameter's type
     *
     * @link https://php.net/manual/en/reflectionparameter.gettype.php
     * @return ReflectionType|null Returns a {@see ReflectionType} object if a
     * parameter type is specified, {@see null} otherwise.
     * @since 7.0
     */
    public function getType()
    {
    }

    /**
     * Checks if parameter expects an array
     *
     * @link https://php.net/manual/en/reflectionparameter.isarray.php
     * @return bool {@see true} if an array is expected, {@see false} otherwise.
     * @deprecated 8.0 Use {@link ReflectionParameter::getType()} and the ReflectionType APIs should be usedinstead.
     */
    public function isArray()
    {
    }

    /**
     * Returns whether parameter MUST be callable
     *
     * @link https://php.net/manual/en/reflectionparameter.iscallable.php
     * @return bool|null Returns {@see true} if the parameter is callable, {@see false}
     * if it is not or {@see null} on failure.
     * @since 5.4
     * @deprecated 8.0 Use {@link ReflectionParameter::getType()} and the ReflectionType APIs should be usedinstead.
     */
    public function isCallable()
    {
    }

    /**
     * Checks if null is allowed
     *
     * @link https://php.net/manual/en/reflectionparameter.allowsnull.php
     * @return bool Returns {@see true} if {@see null} is allowed,
     * otherwise {@see false}
     */
    public function allowsNull()
    {
    }

    /**
     * Gets parameter position
     *
     * @link https://php.net/manual/en/reflectionparameter.getposition.php
     * @return int The position of the parameter, left to right, starting at position #0.
     * @since 5.2.3
     */
    public function getPosition()
    {
    }

    /**
     * Checks if optional
     *
     * @link https://php.net/manual/en/reflectionparameter.isoptional.php
     * @return bool Returns {@see true} if the parameter is optional, otherwise {@see false}
     * @since 5.0.3
     */
    public function isOptional()
    {
    }

    /**
     * Checks if a default value is available
     *
     * @link https://php.net/manual/en/reflectionparameter.isdefaultvalueavailable.php
     * @return bool Returns {@see true} if a default value is available, otherwise {@see false}
     * @since 5.0.3
     */
    public function isDefaultValueAvailable()
    {
    }

    /**
     * Gets default parameter value
     *
     * @link https://php.net/manual/en/reflectionparameter.getdefaultvalue.php
     * @return mixed The parameters default value.
     * @throws \ReflectionException if the parameter is not optional
     * @since 5.0.3
     */
    public function getDefaultValue()
    {
    }

    /**
     * Returns whether the default value of this parameter is constant
     *
     * @link https://php.net/manual/en/reflectionparameter.isdefaultvalueconstant.php
     * @return bool Returns {@see true} if the default value is constant, and {@see false} otherwise.
     * @since 5.4.6
     */
    public function isDefaultValueConstant()
    {
    }

    /**
     * Returns the default value's constant name if default value is constant or null
     *
     * @link https://php.net/manual/en/reflectionparameter.getdefaultvalueconstantname.php
     * @return string|null Returns string on success or {@see null} on failure.
     * @throws \ReflectionException if the parameter is not optional
     * @since 5.4.6
     */
    public function getDefaultValueConstantName()
    {
    }

    /**
     * Returns whether this function is variadic
     *
     * @link https://php.net/manual/en/reflectionparameter.isvariadic.php
     * @return bool Returns {@see true} if the function is variadic, otherwise {@see false}
     * @since 5.6
     */
    public function isVariadic()
    {
    }

    /**
     * Returns information about whether the parameter is a promoted.
     *
     * @return bool Returns {@see true} if the parameter promoted or {@see false} instead
     * @since 8.0
     */
    public function isPromoted()
    {
    }

    /**
     * Returns an array of parameter attributes.
     *
     * @param string|null $name Name of an attribute class
     * @param int $flags Сriteria by which the attribute is searched.
     * @return ReflectionAttribute[]
     * @since 8.0
     */
    public function getAttributes($name = null, $flags = 0)
    {
    }

    /**
     * Clone
     *
     * @link https://php.net/manual/en/reflectionparameter.clone.php
     * @return void
     */
    final private function __clone()
    {
    }
}
