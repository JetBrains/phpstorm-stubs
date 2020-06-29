<?php

/**
 * The <b>ReflectionClass</b> class reports
 * information about a class.
 *
 * @link https://php.net/manual/en/class.reflectionclass.php
 */
class ReflectionClass implements Reflector
{
    /**
     * Indicates class that is abstract because it has some abstract methods.
     *
     * @link https://www.php.net/manual/en/class.reflectionclass.php#reflectionclass.constants.is-implicit-abstract
     */
    public const IS_IMPLICIT_ABSTRACT = 16;

    /**
     * Indicates class that is abstract because of its definition.
     *
     * @link https://www.php.net/manual/en/class.reflectionclass.php#reflectionclass.constants.is-explicit-abstract
     */
    public const IS_EXPLICIT_ABSTRACT = 64;

    /**
     * Indicates final class.
     *
     * @link https://www.php.net/manual/en/class.reflectionclass.php#reflectionclass.constants.is-final
     */
    public const IS_FINAL = 32;

    /**
     * Name of the class. Read-only, throws {@see ReflectionException} in
     * attempt to write.
     *
     * @link https://www.php.net/manual/en/class.reflectionclass.php#reflectionclass.props.name
     * @var string
     */
    public string $name = '';

    /**
     * Constructs a ReflectionClass
     *
     * @link https://php.net/manual/en/reflectionclass.construct.php
     * @param string|object $argument Either a string containing the name of
     * the class to reflect, or an object.
     * @throws \ReflectionException if the class does not exist.
     */
    public function __construct($argument)
    {
    }

    /**
     * Exports a reflected class
     *
     * @link https://php.net/manual/en/reflectionclass.export.php
     * @param mixed $argument The reflection to export.
     * @param bool $return Setting to {@see true} will return the export, as
     * opposed to emitting it. Setting to {@see false} (the default) will do the opposite.
     * @return string|null If the $return parameter is set to {@see true}, then the
     * export is returned as a string, otherwise {@see null} is returned.
     * @deprecated Since PHP 7.4 and removed in 8.0
     */
    public static function export($argument, bool $return = false): ?string
    {
    }

    /**
     * Returns the string representation of the ReflectionClass object.
     *
     * @link https://php.net/manual/en/reflectionclass.tostring.php
     * @return string A string representation of this {@see ReflectionClass} instance.
     */
    public function __toString(): string
    {
    }

    /**
     * Gets class name
     *
     * @link https://php.net/manual/en/reflectionclass.getname.php
     * @return string The class name.
     */
    public function getName(): string
    {
    }

    /**
     * Checks if class is defined internally by an extension, or the core
     *
     * @link https://php.net/manual/en/reflectionclass.isinternal.php
     * @return bool Returns {@see true} on success or {@see false} on failure.
     */
    public function isInternal(): bool
    {
    }

    /**
     * Checks if user defined
     *
     * @link https://php.net/manual/en/reflectionclass.isuserdefined.php
     * @return bool Returns {@see true} on success or {@see false} on failure.
     */
    public function isUserDefined(): bool
    {
    }

    /**
     * Checks if the class is instantiable
     *
     * @link https://php.net/manual/en/reflectionclass.isinstantiable.php
     * @return bool Returns {@see true} on success or {@see false} on failure.
     */
    public function isInstantiable(): bool
    {
    }

    /**
     * Returns whether this class is cloneable
     *
     * @link https://php.net/manual/en/reflectionclass.iscloneable.php
     * @return bool Returns {@see true} if the class is cloneable, {@see false} otherwise.
     * @since 5.4
     */
    public function isCloneable(): bool
    {
    }

    /**
     * Gets the filename of the file in which the class has been defined
     *
     * @link https://php.net/manual/en/reflectionclass.getfilename.php
     * @return string|false the filename of the file in which the class has been defined.
     * If the class is defined in the PHP core or in a PHP extension, {@see false}
     * is returned.
     */
    public function getFileName()
    {
    }

    /**
     * Gets starting line number
     *
     * @link https://php.net/manual/en/reflectionclass.getstartline.php
     * @return int The starting line number, as an integer.
     */
    public function getStartLine(): int
    {
    }

    /**
     * Gets end line
     *
     * @link https://php.net/manual/en/reflectionclass.getendline.php
     * @return int|false The ending line number of the user defined class, or
     * {@see false} if unknown.
     */
    public function getEndLine()
    {
    }

    /**
     * Gets doc comments
     *
     * @link https://php.net/manual/en/reflectionclass.getdoccomment.php
     * @return string|false The doc comment if it exists, otherwise {@see false}
     */
    public function getDocComment()
    {
    }

    /**
     * Gets the constructor of the class
     *
     * @link https://php.net/manual/en/reflectionclass.getconstructor.php
     * @return ReflectionMethod|null A {@see ReflectionMethod} object reflecting
     * the class' constructor, or {@see null} if the class has no constructor.
     */
    public function getConstructor(): ?ReflectionMethod
    {
    }

    /**
     * Checks if method is defined
     *
     * @link https://php.net/manual/en/reflectionclass.hasmethod.php
     * @param string $name Name of the method being checked for.
     * @return bool Returns {@see true} if it has the method, otherwise {@see false}
     */
    public function hasMethod(string $name): bool
    {
    }

    /**
     * Gets a <b>ReflectionMethod</b> for a class method.
     *
     * @link https://php.net/manual/en/reflectionclass.getmethod.php
     * @param string $name The method name to reflect.
     * @return ReflectionMethod A {@see ReflectionMethod}
     * @throws \ReflectionException if the method does not exist.
     */
    public function getMethod(string $name): ReflectionMethod
    {
    }

    /**
     * Gets an array of methods for the class.
     *
     * @link https://php.net/manual/en/reflectionclass.getmethods.php
     * @param int $filter Filter the results to include only methods
     * with certain attributes. Defaults to no filtering.
     * @return ReflectionMethod[] An array of {@see ReflectionMethod} objects
     * reflecting each method.
     */
    public function getMethods(int $filter = 119): array
    {
    }

    /**
     * Checks if property is defined
     *
     * @link https://php.net/manual/en/reflectionclass.hasproperty.php
     * @param string $name Name of the property being checked for.
     * @return bool Returns {@see true} if it has the property, otherwise {@see false}
     */
    public function hasProperty(string $name): bool
    {
    }

    /**
     * Gets a <b>ReflectionProperty</b> for a class's property
     *
     * @link https://php.net/manual/en/reflectionclass.getproperty.php
     * @param string $name The property name.
     * @return ReflectionProperty A {@see ReflectionProperty}
     * @throws ReflectionException If no property exists by that name.
     */
    public function getProperty(string $name): ReflectionProperty
    {
    }

    /**
     * Gets properties
     *
     * @link https://php.net/manual/en/reflectionclass.getproperties.php
     * @param int $filter The optional filter, for filtering desired
     * property types. It's configured using the {@see ReflectionProperty} constants,
     * and defaults to all property types.
     * @return ReflectionProperty[]
     */
    public function getProperties(int $filter = 23): array
    {
    }

    /**
     * Gets a ReflectionClassConstant for a class's property
     *
     * @link https://php.net/manual/en/reflectionclass.getreflectionconstant.php
     * @param string $name The class constant name.
     * @return ReflectionClassConstant A {@see ReflectionClassConstant}.
     * @since 7.1
     */
    public function getReflectionConstant(string $name): ReflectionClassConstant
    {
    }

    /**
     * Gets class constants
     *
     * @link https://php.net/manual/en/reflectionclass.getreflectionconstants.php
     * @return ReflectionClassConstant[] An array of ReflectionClassConstant objects.
     * @since 7.1
     */
    public function getReflectionConstants(): array
    {
    }

    /**
     * Checks if constant is defined
     *
     * @link https://php.net/manual/en/reflectionclass.hasconstant.php
     * @param string $name The name of the constant being checked for.
     * @return bool Returns {@see true} if the constant is defined, otherwise {@see false}
     */
    public function hasConstant(string $name): bool
    {
    }

    /**
     * Gets constants
     *
     * @link https://php.net/manual/en/reflectionclass.getconstants.php
     * @return array An array of constants, where the keys hold the name and
     * the values the value of the constants.
     */
    public function getConstants(): array
    {
    }

    /**
     * Gets defined constant
     *
     * @link https://php.net/manual/en/reflectionclass.getconstant.php
     * @param string $name Name of the constant.
     * @return mixed|false Value of the constant with the name name.
     * Returns {@see false} if the constant was not found in the class.
     */
    public function getConstant(string $name)
    {
    }

    /**
     * Gets the interfaces
     *
     * @link https://php.net/manual/en/reflectionclass.getinterfaces.php
     * @return ReflectionClass[] An associative array of interfaces, with keys as interface
     * names and the array values as {@see ReflectionClass} objects.
     */
    public function getInterfaces(): array
    {
    }

    /**
     * Gets the interface names
     *
     * @link https://php.net/manual/en/reflectionclass.getinterfacenames.php
     * @return string[] A numerical array with interface names as the values.
     */
    public function getInterfaceNames(): array
    {
    }

    /**
     * Checks if the class is anonymous
     *
     * @link https://php.net/manual/en/reflectionclass.isanonymous.php
     * @return bool Returns {@see true} on success or {@see false} on failure.
     * @since 7.0
     */
    public function isAnonymous(): bool
    {
    }

    /**
     * Checks if the class is an interface
     *
     * @link https://php.net/manual/en/reflectionclass.isinterface.php
     * @return bool Returns {@see true} on success or {@see false} on failure.
     */
    public function isInterface(): bool
    {
    }

    /**
     * Returns an array of traits used by this class
     *
     * @link https://php.net/manual/en/reflectionclass.gettraits.php
     * @return ReflectionClass[]|null an array with trait names in keys and
     * instances of trait's {@see ReflectionClass} in values.
     * Returns {@see null} in case of an error.
     * @since 5.4
     */
    public function getTraits(): ?array
    {
    }

    /**
     * Returns an array of names of traits used by this class
     *
     * @link https://php.net/manual/en/reflectionclass.gettraitnames.php
     * @return string[] An array with trait names in values.
     * Returns {@see null} in case of an error.
     * @since 5.4
     */
    public function getTraitNames(): ?array
    {
    }

    /**
     * Returns an array of trait aliases
     *
     * @link https://php.net/manual/en/reflectionclass.gettraitaliases.php
     * @return string[] an array with new method names in keys and original
     * names (in the format "TraitName::original") in values.
     * Returns {@see null} in case of an error.
     * @since 5.4
     */
    public function getTraitAliases(): array
    {
    }

    /**
     * Returns whether this is a trait
     *
     * @link https://php.net/manual/en/reflectionclass.istrait.php
     * @return bool Returns {@see true} if this is a trait, {@see false} otherwise.
     * Returns {@see null} in case of an error.
     * @since 5.4
     */
    public function isTrait(): bool
    {
    }

    /**
     * Checks if class is abstract
     *
     * @link https://php.net/manual/en/reflectionclass.isabstract.php
     * @return bool Returns {@see true} on success or {@see false} on failure.
     */
    public function isAbstract(): bool
    {
    }

    /**
     * Checks if class is final
     *
     * @link https://php.net/manual/en/reflectionclass.isfinal.php
     * @return bool Returns {@see true} on success or {@see false} on failure.
     */
    public function isFinal(): bool
    {
    }

    /**
     * Gets modifiers
     *
     * @link https://php.net/manual/en/reflectionclass.getmodifiers.php
     * @return int bitmask of modifier constants.
     */
    public function getModifiers(): int
    {
    }

    /**
     * Checks class for instance
     *
     * @link https://php.net/manual/en/reflectionclass.isinstance.php
     * @param object $object The object being compared to.
     * @return bool Returns {@see true} on success or {@see false} on failure.
     */
    public function isInstance(object $object): bool
    {
    }

    /**
     * Creates a new class instance from given arguments.
     *
     * @link https://php.net/manual/en/reflectionclass.newinstance.php
     * @param mixed ...$args Accepts a variable number of arguments which are
     * passed to the class constructor, much like {@see call_user_func}
     * @return object a new instance of the class.
     * @throws ReflectionException if the class constructor is not public or if
     * the class does not have a constructor and the $args parameter contains
     * one or more parameters.
     */
    public function newInstance(...$args): object
    {
    }

    /**
     * Creates a new class instance without invoking the constructor.
     *
     * @link https://php.net/manual/en/reflectionclass.newinstancewithoutconstructor.php
     * @return object a new instance of the class.
     * @throws ReflectionException if the class is an internal class that
     * cannot be instantiated without invoking the constructor. In PHP 5.6.0
     * onwards, this exception is limited only to internal classes that are final.
     * @since 5.4
     */
    public function newInstanceWithoutConstructor(): object
    {
    }

    /**
     * Creates a new class instance from given arguments.
     *
     * @link https://php.net/manual/en/reflectionclass.newinstanceargs.php
     * @param array $args The parameters to be passed to the class constructor as an array.
     * @return object a new instance of the class.
     * @throws ReflectionException if the class constructor is not public or if
     * the class does not have a constructor and the $args parameter contains
     * one or more parameters.
     * @since 5.1.3
     */
    public function newInstanceArgs(array $args = []): object
    {
    }

    /**
     * Gets parent class
     *
     * @link https://php.net/manual/en/reflectionclass.getparentclass.php
     * @return ReflectionClass|false A {@see ReflectionClass} or {@see false}
     * if there's no parent.
     */
    public function getParentClass()
    {
    }

    /**
     * Checks if a subclass
     *
     * @link https://php.net/manual/en/reflectionclass.issubclassof.php
     * @param string|ReflectionClass $class Either the name of the class as
     * string or a {@see ReflectionClass} object of the class to check against.
     * @return bool {@see true} on success or {@see false} on failure.
     */
    public function isSubclassOf($class): bool
    {
    }

    /**
     * Gets static properties
     *
     * @link https://php.net/manual/en/reflectionclass.getstaticproperties.php
     * @return mixed[] The static properties, as an array where the keys hold
     * the name and the values the value of the properties.
     */
    public function getStaticProperties(): array
    {
    }

    /**
     * Gets static property value
     *
     * @link https://php.net/manual/en/reflectionclass.getstaticpropertyvalue.php
     * @param string $name The name of the static property for which to return a value.
     * @param mixed $default A default value to return in case the class does
     * not declare a static property with the given name. If the property does
     * not exist and this argument is omitted, a {@see ReflectionException} is thrown.
     * @return mixed The value of the static property.
     */
    public function getStaticPropertyValue(string $name, $default = null)
    {
    }

    /**
     * Sets static property value
     *
     * @link https://php.net/manual/en/reflectionclass.setstaticpropertyvalue.php
     * @param string $name Property name.
     * @param mixed $value New property value.
     * @return void No value is returned.
     */
    public function setStaticPropertyValue(string $name, $value): void
    {
    }

    /**
     * Gets default properties
     *
     * @link https://php.net/manual/en/reflectionclass.getdefaultproperties.php
     * @return mixed[] An array of default properties, with the key being the name
     * of the property and the value being the default value of the property
     * or {@see null} if the property doesn't have a default value. The function
     * does not distinguish between static and non static properties and does
     * not take visibility modifiers into account.
     */
    public function getDefaultProperties(): array
    {
    }

    /**
     * An alias of {@see ReflectionClass::isIterable} method.
     *
     * @link https://php.net/manual/en/reflectionclass.isiterateable.php
     * @return bool Returns {@see true} on success or {@see false} on failure.
     */
    public function isIterateable(): bool
    {
    }

    /**
     * Check whether this class is iterable
     *
     * @link https://php.net/manual/en/reflectionclass.isiterable.php
     * @return bool Returns {@see true} on success or {@see false} on failure.
     * @since 7.2
     */
    public function isIterable(): bool
    {
    }

    /**
     * Checks whether it implements an interface.
     *
     * @link https://php.net/manual/en/reflectionclass.implementsinterface.php
     * @param string $interface The interface name.
     * @return bool Returns {@see true} on success or {@see false} on failure.
     */
    public function implementsInterface(string $interface): bool
    {
    }

    /**
     * Gets a <b>ReflectionExtension</b> object for the extension which defined the class
     *
     * @link https://php.net/manual/en/reflectionclass.getextension.php
     * @return ReflectionExtension A {@see ReflectionExtension} object representing
     * the extension which defined the class, or {@see null} for user-defined classes.
     */
    public function getExtension(): ?ReflectionExtension
    {
    }

    /**
     * Gets the name of the extension which defined the class
     *
     * @link https://php.net/manual/en/reflectionclass.getextensionname.php
     * @return string|false The name of the extension which defined the class,
     * or {@see false} for user-defined classes.
     */
    public function getExtensionName()
    {
    }

    /**
     * Checks if in namespace
     *
     * @link https://php.net/manual/en/reflectionclass.innamespace.php
     * @return bool {@see true} on success or {@see false} on failure.
     */
    public function inNamespace(): bool
    {
    }

    /**
     * Gets namespace name
     *
     * @link https://php.net/manual/en/reflectionclass.getnamespacename.php
     * @return string The namespace name.
     */
    public function getNamespaceName(): string
    {
    }

    /**
     * Gets short name
     *
     * @link https://php.net/manual/en/reflectionclass.getshortname.php
     * @return string The class short name.
     */
    public function getShortName(): string
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

    /**
     * Clones object
     *
     * @link https://php.net/manual/en/reflectionclass.clone.php
     * @return void
     */
    final private function __clone()
    {
    }

}
