<?php
/**
 * The ReflectionConstant class reports information about a global constant.
 * @link https://php.net/manual/en/class.reflectionconstant.php
 * @since 8.4
 */
class ReflectionConstant implements Reflector
{
    public string $name;

    /**
     * Constructs a ReflectionConstant
     *
     * Constructs a new ReflectionConstant object.
     *
     * @link https://php.net/manual/en/reflectionconstant.construct.php
     * @param string $name The name of the constant.
     * @throws \ReflectionException Throws a ReflectionException in case the given constant does not
     * exist.
     */
    public function __construct(string $name) {}

    /**
     * Gets name
     *
     * Gets the name of the constant.
     *
     * @link https://php.net/manual/en/reflectionconstant.getname.php
     * @return string The constants name, which is composed of its namespace and name.
     */
    public function getName(): string {}

    /**
     * Gets namespace name
     *
     * Gets the namespace name of the constant.
     *
     * @link https://php.net/manual/en/reflectionconstant.getnamespacename.php
     * @return string The namespace name, or an empty string for the global namespace.
     */
    public function getNamespaceName(): string {}

    /**
     * Gets short name
     *
     * Gets the short name of the constant, the part without the namespace.
     *
     * @link https://php.net/manual/en/reflectionconstant.getshortname.php
     * @return string The short name of the constant.
     */
    public function getShortName(): string {}

    /**
     * Gets value
     *
     * Gets the value of the constant.
     *
     * @link https://php.net/manual/en/reflectionconstant.getvalue.php
     * @return mixed The value of the constant.
     */
    public function getValue(): mixed {}

    /**
     * Checks if deprecated
     *
     * Checks whether the constant is deprecated.
     *
     * @link https://php.net/manual/en/reflectionconstant.isdeprecated.php
     * @return bool true if it's deprecated, otherwise false
     */
    public function isDeprecated(): bool {}

    /**
     * Returns string representation
     *
     * Returns the string representation of the ReflectionConstant object.
     *
     * @link https://php.net/manual/en/reflectionconstant.tostring.php
     * @return string A string representation of this ReflectionConstant instance.
     */
    public function __toString(): string {}

    /**
     * Gets name of the defining file
     *
     * Gets the filename of the file in which the constant has been defined.
     *
     * @link https://php.net/manual/en/reflectionconstant.getfilename.php
     * @since 8.5
     */
    public function getFileName(): string|false {}

    /**
     * Gets ReflectionExtension of the defining extension
     *
     * Gets a ReflectionExtension object for the extension which defined the constant.
     *
     * @link https://php.net/manual/en/reflectionconstant.getextension.php
     * @since 8.5
     */
    public function getExtension(): ?ReflectionExtension {}

    /**
     * Gets name of the defining extension
     *
     * Gets the name of the extension which defined the constant.
     *
     * @link https://php.net/manual/en/reflectionconstant.getextensionname.php
     * @since 8.5
     */
    public function getExtensionName(): string|false {}

    /**
     * Gets Attributes
     *
     * Returns all attributes declared on this global constant as an array of ReflectionAttribute.
     *
     * @link https://php.net/manual/en/reflectionconstant.getattributes.php
     * @since 8.5
     */
    public function getAttributes(?string $name = null, int $flags = 0): array {}

    /**
     * @return bool
     * @since 8.6
     */
    public function inNamespace(): bool {}
}
