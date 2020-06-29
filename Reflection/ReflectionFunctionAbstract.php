<?php

/**
 * A parent class to <b>ReflectionFunction</b>, read its
 * description for details.
 *
 * @link https://php.net/manual/en/class.reflectionfunctionabstract.php
 */
abstract class ReflectionFunctionAbstract implements Reflector
{
    /**
     * Name of the function. An alias of
     * {@see ReflectionFunctionAbstract::getName} method.
     *
     * Read-only, throws {@see ReflectionException} in attempt to write.
     *
     * @link https://www.php.net/manual/en/class.reflectionfunctionabstract.php#reflectionfunctionabstract.props.name
     * @var string
     */
    public string $name = '';

    /**
     * Clones function
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.clone.php
     * @return void
     */
    final private function __clone()
    {
    }

    /**
     * Checks if function in namespace
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.innamespace.php
     * @return bool {@see true} if it's in a namespace, otherwise {@see false}
     */
    public function inNamespace(): bool
    {
    }

    /**
     * Checks if closure
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.isclosure.php
     * @return bool {@see true} if it's a closure, otherwise {@see false}
     */
    public function isClosure(): bool
    {
    }

    /**
     * Checks if deprecated
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.isdeprecated.php
     * @return bool {@see true} if it's deprecated, otherwise {@see false}
     */
    public function isDeprecated(): bool
    {
    }

    /**
     * Checks if is internal
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.isinternal.php
     * @return bool {@see true} if it's internal, otherwise {@see false}
     */
    public function isInternal(): bool
    {
    }

    /**
     * Checks if user defined
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.isuserdefined.php
     * @return bool {@see true} if it's user-defined, otherwise {@see false}
     */
    public function isUserDefined(): bool
    {
    }

    /**
     * Returns whether this function is a generator
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.isgenerator.php
     * @return bool {@see true} if the function is generator, otherwise {@see false}
     * @since 5.5
     */
    public function isGenerator(): bool
    {
    }

    /**
     * Returns whether this function is variadic
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.isvariadic.php
     * @return bool {@see true} if the function is variadic, otherwise {@see false}
     * @since 5.6
     */
    public function isVariadic(): bool
    {
    }

    /**
     * Returns this pointer bound to closure
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getclosurethis.php
     * @return object|null Returns $this pointer or {@see null} in case of an error.
     */
    public function getClosureThis(): ?object
    {
    }

    /**
     * Returns the scope associated to the closure
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getclosurescopeclass.php
     * @return ReflectionClass|null Returns the class on success or {@see null}
     * on failure.
     * @since 5.4
     */
    public function getClosureScopeClass(): ?ReflectionClass
    {
    }

    /**
     * Gets doc comment
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getdoccomment.php
     * @return string|false The doc comment if it exists, otherwise {@see false}
     */
    public function getDocComment()
    {
    }

    /**
     * Gets end line number
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getendline.php
     * @return int|false The ending line number of the user defined function,
     * or {@see false} if unknown.
     */
    public function getEndLine()
    {
    }

    /**
     * Gets extension info
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getextension.php
     * @return ReflectionExtension|null The extension information, as a
     * {@see ReflectionExtension} object or {@see null} instead.
     */
    public function getExtension(): ?ReflectionExtension
    {
    }

    /**
     * Gets extension name
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getextensionname.php
     * @return string|null The extension's name or {@see null} instead.
     */
    public function getExtensionName(): ?string
    {
    }

    /**
     * Gets file name
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getfilename.php
     * @return string|false The file name or {@see false} in case of error.
     */
    public function getFileName()
    {
    }

    /**
     * Gets function name
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getname.php
     * @return string The name of the function.
     */
    public function getName(): string
    {
    }

    /**
     * Gets namespace name
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getnamespacename.php
     * @return string The namespace name.
     */
    public function getNamespaceName(): string
    {
    }

    /**
     * Gets number of parameters
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getnumberofparameters.php
     * @return int The number of parameters.
     * @since 5.0.3
     */
    public function getNumberOfParameters(): int
    {
    }

    /**
     * Gets number of required parameters
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getnumberofrequiredparameters.php
     * @return int The number of required parameters.
     * @since 5.0.3
     */
    public function getNumberOfRequiredParameters(): int
    {
    }

    /**
     * Gets parameters
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getparameters.php
     * @return ReflectionParameter[] The parameters, as a ReflectionParameter objects.
     */
    public function getParameters(): array
    {
    }

    /**
     * Gets the specified return type of a function
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getreturntype.php
     * @return ReflectionType|null Returns a {@see ReflectionType} object if a
     * return type is specified, {@see null} otherwise.
     * @since 7.0
     */
    public function getReturnType(): ?ReflectionType
    {
    }

    /**
     * Gets function short name
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getshortname.php
     * @return string The short name of the function.
     */
    public function getShortName(): string
    {
    }

    /**
     * Gets starting line number
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getstartline.php
     * @return int The starting line number.
     */
    public function getStartLine(): int
    {
    }

    /**
     * Gets static variables
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.getstaticvariables.php
     * @return array An array of static variables.
     */
    public function getStaticVariables(): array
    {
    }

    /**
     * Checks if returns reference
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.returnsreference.php
     * @return bool {@see true} if it returns a reference, otherwise {@see false}
     */
    public function returnsReference(): bool
    {
    }

    /**
     * Checks if the function has a specified return type
     *
     * @link https://php.net/manual/en/reflectionfunctionabstract.hasreturntype.php
     * @return bool Returns {@see true} if the function is a specified return
     * type, otherwise {@see false}.
     * @since 7.0
     */
    public function hasReturnType(): bool
    {
    }

    /**
     * Returns an array of function attributes.
     *
     * @param string|null $name Name of an attribute class
     * @param int $flags Сriteria by which the attribute is searched.
     * @return ReflectionAttribute[]
     * @since 8.0
     */
    public function getAttributes(string $name = null, int $flags = 0): array
    {
    }
}
