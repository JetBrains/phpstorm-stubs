<?php

/**
 * Abstract parent class for all SPL types.
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/class.spltype
 */
abstract class SplType
{
    /**
     * @var null Default value
     * @link https://php-legacy-docs.zend.com/manual/php5/en/class.spltype.php#spltype.constants.default
     */
    public const __default = null;

    /**
     * Creates a new value of some type
     *
     * @param mixed $initial_value
     * @param bool $strict  If set to true then will throw UnexpectedValueException if value of other type will be assigned. True by default
     * @link https://php-legacy-docs.zend.com/manual/php5/en/spltype.construct
     */
    public function __construct($initial_value = self::__default, $strict = true) {}
}

/**
 * The SplInt class is used to enforce strong typing of the integer type.
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splint
 */
class SplInt extends SplType
{
    /**
     * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splint.php#splint.constants.default
     */
    public const __default = 0;
}

/**
 * The SplFloat class is used to enforce strong typing of the float type.
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splfloat
 */
class SplFloat extends SplType
{
    public const __default = 0;
}

/**
 * SplEnum gives the ability to emulate and create enumeration objects natively in PHP.
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splenum
 */
class SplEnum extends SplType
{
    /**
     * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splenum.php#splenum.constants.default
     */
    public const __default = null;

    /**
     * Returns all consts (possible values) as an array.
     *
     * @param bool $include_default Whether to include __default constant (property). False by default.
     * @return array
     * @link https://php-legacy-docs.zend.com/manual/php5/en/splenum.getconstlist
     */
    public function getConstList($include_default = false) {}
}

/**
 * The SplBool class is used to enforce strong typing of the bool type.
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splbool
 */
class SplBool extends SplEnum
{
    /**
     * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splbool.php#splbool.constants.default
     */
    public const __default = false;

    /**
     * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splbool.php#splbool.constants.false
     */
    public const false = false;

    /**
     * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splbool.php#splbool.constants.true
     */
    public const true = true;
}

/**
 * The SplString class is used to enforce strong typing of the string type.
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splstring
 */
class SplString extends SplType
{
    /**
     * @link https://php-legacy-docs.zend.com/manual/php5/en/class.splstring.php#splstring.constants.default
     */
    public const __default = 0;
}
