<?php

// Start of com_dotnet v.

/**
 * The COM class allows you to instantiate an OLE compatible COM object and call its methods and access its properties.
 * @link https://php.net/manual/en/class.com.php
 */
class COM
{
    /**
     * (PHP 4 &gt;= 4.1.0, PHP 5, PHP 7)<br/>
     * COM class constructor.
     * @param string $module_name
     * @param string $server_name [optional]
     * @param int $codepage [optional]
     * @param string $typelib [optional]
     */
    public function __construct($module_name, $server_name = null, $codepage = CP_ACP, $typelib = null) {}

    public function __get($name) {}

    public function __set($name, $value) {}

    public function __call($name, $args) {}
}

/**
 * The DOTNET class allows you to instantiate a class from a .Net assembly and call its methods and access its properties.
 * @link https://php.net/manual/en/class.dotnet.php
 */
class DOTNET
{
    /**
     * (PHP 4 &gt;= 4.1.0, PHP 5, PHP 7)<br/>
     * COM class constructor.
     * @param string $assembly_name
     * @param string $class_name
     * @param int $codepage [optional]
     */
    public function __construct($assembly_name, string $class_name, $codepage = CP_ACP) {}

    public function __get($name) {}

    public function __set($name, $value) {}

    public function __call($name, $args) {}
}

/**
 * The VARIANT is COM's equivalent of the PHP zval; it is a structure that can contain a value with a range of different possible types. The VARIANT class provided by the COM extension allows you to have more control over the way that PHP passes values to and from COM.
 * @link https://php.net/manual/en/class.variant.php
 */
class VARIANT
{
    /**
     * (PHP 4 &gt;= 4.1.0, PHP 5, PHP 7)<br/>
     * COM class constructor.
     * @param mixed $value [optional]
     * @param int $type [optional]
     * @param int $codepage [optional]
     */
    public function __construct($value = null, int $type = VT_EMPTY, $codepage = CP_ACP) {}

    public function __get($name) {}

    public function __set($name, $value) {}

    public function __call($name, $args) {}
}

/**
 * This extension will throw instances of the class com_exception whenever there is a potentially fatal error reported by COM. All COM exceptions have a well-defined code property that corresponds to the HRESULT return value from the various COM operations. You may use this code to make programmatic decisions on how to handle the exception.
 * @link https://php.net/manual/en/com.error-handling.php
 */
class com_exception extends \Exception {}

/**
 * (PHP 5, PHP 7)<br/>
 * Generate a globally unique identifier (GUID)
 * @link https://php.net/manual/en/function.com-create-guid.php
 * @return string Returns the GUID as a string, or false on failure.
 */
function com_create_guid() {}

/**
 * (PHP 4 &gt;= 4.2.0, PHP 5, PHP 7)<br/>
 * Connect events from a COM object to a PHP object
 * @link https://php.net/manual/en/function.com-event-sink.php
 * @param \VARIANT $comobject
 * @param object $sinkobject
 * @param string $sinkinterface [optional]
 * @return bool Returns true on success or false on failure.
 */
function com_event_sink($comobject, $sinkobject, $sinkinterface = null) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Returns a handle to an already running instance of a COM object
 * @link https://php.net/manual/en/function.com-get-active-object.php
 * @param string $progid
 * @param int $code_page [optional]
 * @return \VARIANT If the requested object is running, it will be returned to your script just like
 * any other COM object.
 */
function com_get_active_object($progid, $code_page = CP_ACP) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5, PHP 7)<br/>
 * Loads a Typelib
 * @link https://php.net/manual/en/function.com-get-active-object.php
 * @param string $typelib_name
 * @param bool $case_insensitive [optional]
 * @return bool Returns true on success or false on failure.
 */
function com_load_typelib($typelib_name, $case_insensitive = true) {}

/**
 * (PHP 4 &gt;= 4.2.0, PHP 5, PHP 7)<br/>
 * Process COM messages, sleeping for up to timeoutms milliseconds
 * @link https://php.net/manual/en/function.com-message-pump.php
 * @param int $timeoutms [optional]
 * @return bool If a message or messages arrives before the timeout, they will be dispatched, and
 * the function will return true. If the timeout occurs and no messages were processed, the return
 * value will be false.
 */
function com_message_pump($timeoutms = 0) {}

/**
 * (PHP 4 &gt;= 4.2.0, PHP 5, PHP 7)<br/>
 * Print out a PHP class definition for a dispatchable interface
 * @link https://php.net/manual/en/function.com-print-typeinfo.php
 * @param object $comobject
 * @param string $dispinterface [optional]
 * @param bool $wantsink [optional]
 * @return bool Returns true on success or false on failure.
 */
function com_print_typeinfo($comobject, $dispinterface = null, $wantsink = false) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Returns the absolute value of a variant
 * @link https://php.net/manual/en/function.variant-abs.php
 * @param mixed $val
 * @return mixed Returns the absolute value of value.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_abs($val) {}

/**
 * (PHP 5, PHP 7)<br/>
 * "Adds" two variant values together and returns the result
 * @link https://php.net/manual/en/function.variant-abs.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_add($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Performs a bitwise AND operation between two variants
 * @link https://php.net/manual/en/function.variant-and.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of the bitwise AND, according to the following rules:
 * <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse">
 * <caption><b>Variant AND Rules</b></caption>
 * <thead>
 * <tr><th style="border:1px solid">If left is</th><th style="border:1px solid">If right is</th><th style="border:1px solid">then the result is</th></tr>
 * </thead>
 * <tbody>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">true</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">false</td><td style="border:1px solid">false</td></tr>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">null</td><td style="border:1px solid">null</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">true</td><td style="border:1px solid">false</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">false</td><td style="border:1px solid">false</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">null</td><td style="border:1px solid">false</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">true</td><td style="border:1px solid">null</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">false</td><td style="border:1px solid">false</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">null</td><td style="border:1px solid">null</td></tr>
 * </tbody>
 * </table>
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_and($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Convert a variant into a new variant object of another type
 * @link https://php.net/manual/en/function.variant-cast.php
 * @param \VARIANT $variant The variant.
 * @param int $type type should be one of the VT_* constants.
 * @return \VARIANT Returns a variant of given type.
 */
function variant_cast($variant, $type) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Concatenates two variant values together and returns the result
 * @link https://php.net/manual/en/function.variant-cat.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of the concatenation.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_cat($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Compares two variants
 * @link https://php.net/manual/en/function.variant-cmp.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @param int $lcid [optional]
 * @param int $flags [optional]
 * @return int Returns one of the following:
 * <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse">
 * <caption><b>Variant Comparison Results</b></caption>
 * <thead>
 * <tr><th style="border:1px solid">value</th><th style="border:1px solid">meaning</th></tr>
 * </thead>
 * <tbody>
 * <tr><td style="border:1px solid">VARCMP_LT</td><td style="border:1px solid">left is less than right</td></tr>
 * <tr><td style="border:1px solid">VARCMP_EQ</td><td style="border:1px solid">left is equal to right</td></tr>
 * <tr><td style="border:1px solid">VARCMP_GT</td><td style="border:1px solid">left is greater than right</td></tr>
 * <tr><td style="border:1px solid">VARCMP_NULL</td><td style="border:1px solid">Either left, right or both are null</td></tr>
 * </tbody>
 * </table>
 */
function variant_cmp($left, $right, $lcid = null, $flags = null) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Returns a variant date representation of a Unix timestamp
 * @link https://php.net/manual/en/function.variant-date-from-timestamp.php
 * @param int $timestamp A unix timestamp.
 * @return \VARIANT Returns a VT_DATE variant.
 */
function variant_date_from_timestamp($timestamp) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Converts a variant date/time value to Unix timestamp
 * @link https://php.net/manual/en/function.variant-date-to-timestamp.php
 * @param \VARIANT $variant The variant.
 * @return int|null Returns a unix timestamp, or null on failure.
 */
function variant_date_to_timestamp($variant) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Returns the result from dividing two variants
 * @link https://php.net/manual/en/function.variant-div.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of the division, according to the following rules:
 * <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse">
 * <caption><b>Variant Division Rules</b></caption>
 * <thead>
 * <tr><th style="border:1px solid">If</th><th style="border:1px solid">Then</th></tr>
 * </thead>
 * <tbody>
 * <tr><td style="border:1px solid">Both expressions are of the string, date, character, boolean type</td><td style="border:1px solid">Double is returned</td></tr>
 * <tr><td style="border:1px solid">One expression is a string type and the other a character</td><td style="border:1px solid">Division and a double is returned</td></tr>
 * <tr><td style="border:1px solid">One expression is numeric and the other is a string</td><td style="border:1px solid">Division and a double is returned.</td></tr>
 * <tr><td style="border:1px solid">Both expressions are numeric</td><td style="border:1px solid">Division and a double is returned</td></tr>
 * <tr><td style="border:1px solid">Either expression is NULL</td><td style="border:1px solid">NULL is returned</td></tr>
 * <tr><td style="border:1px solid">right is empty and left is anything but empty</td><td style="border:1px solid">A com_exception with code DISP_E_DIVBYZERO is thrown</td></tr>
 * <tr><td style="border:1px solid">left is empty and right is anything but empty.</td><td style="border:1px solid">0 as type double is returned</td></tr>
 * <tr><td style="border:1px solid">Both expressions are empty</td><td style="border:1px solid">A com_exception with code DISP_E_OVERFLOW is thrown</td></tr>
 * </tbody>
 * </table>
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_div($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Performs a bitwise equivalence on two variants
 * @link https://php.net/manual/en/function.variant-eqv.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed If each bit in left is equal to the corresponding bit in right then true is
 * returned, otherwise false is returned.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_eqv($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Returns the integer portion of a variant
 * @link https://php.net/manual/en/function.variant-fix.php
 * @param mixed $variant
 * @return mixed If value is negative, then the first negative integer greater than or equal to the
 * variant is returned, otherwise returns the integer portion of the value of value.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_fix($variant) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Returns the type of a variant object
 * @link https://php.net/manual/en/function.variant-get-type.php
 * @param VARIANT $variant The variant object.
 * @return int This function returns an integer value that indicates the type of variant, which can
 * be an instance of , or classes. The return value can be compared to one of the VT_* constants.
 * The return value for COM and DOTNET objects will usually be VT_DISPATCH; the only reason this
 * function works for those classes is because COM and DOTNET are descendants of VARIANT.
 */
function variant_get_type($variant) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Converts variants to integers and then returns the result from dividing them
 * @link https://php.net/manual/en/function.variant-idiv.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of the integer division, according to the following rules:
 * <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse">
 * <caption><b>Variant Integer Division Rules</b></caption>
 * <thead>
 * <tr><th style="border:1px solid">If</th><th style="border:1px solid">Then</th></tr>
 * </thead>
 * <tbody>
 * <tr><td style="border:1px solid">Both expressions are of the string, date, character, boolean type</td><td style="border:1px solid">Division and integer is returned</td></tr>
 * <tr><td style="border:1px solid">One expression is a string type and the other a character</td><td style="border:1px solid">Division</td></tr>
 * <tr><td style="border:1px solid">One expression is numeric and the other is a string</td><td style="border:1px solid">Division</td></tr>
 * <tr><td style="border:1px solid">Both expressions are numeric</td><td style="border:1px solid">Division</td></tr>
 * <tr><td style="border:1px solid">Either expression is NULL</td><td style="border:1px solid">NULL is returned</td></tr>
 * <tr><td style="border:1px solid">Both expressions are empty</td><td style="border:1px solid">A com_exception with code DISP_E_DIVBYZERO is thrown</td></tr>
 * </tbody>
 * </table>
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_idiv($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Performs a bitwise implication on two variants
 * @link https://php.net/manual/en/function.variant-imp.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of the implication, according to the following rules:
 * <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse">
 * <caption><b>Variant Implication Table</b></caption>
 * <thead>
 * <tr><th style="border:1px solid">If left is</th><th style="border:1px solid">If right is</th><th style="border:1px solid">then the result is</th></tr>
 * </thead>
 * <tbody>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">true</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">false</td><td style="border:1px solid">false</td></tr>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">null</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">true</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">false</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">null</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">true</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">false</td><td style="border:1px solid">null</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">null</td><td style="border:1px solid">null</td></tr>
 * </tbody>
 * </table>
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_imp($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Returns the integer portion of a variant
 * @link https://php.net/manual/en/function.variant-int.php
 * @param mixed $variant
 * @return mixed If value is negative, then the first negative integer less than or equal to the
 * variant is returned, otherwise returns the integer portion of the value of value.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_int($variant) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Divides two variants and returns only the remainder
 * @link https://php.net/manual/en/function.variant-mod.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the remainder of the division.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_mod($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Multiplies the values of the two variants
 * @link https://php.net/manual/en/function.variant-mul.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of the multiplication, according to the following rules:
 * <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse">
 * <caption><b>Variant Multiplication Rules</b></caption>
 * <thead>
 * <tr><th style="border:1px solid">If</th><th style="border:1px solid">Then</th></tr>
 * </thead>
 * <tbody>
 * <tr><td style="border:1px solid">Both expressions are of the string, date, character, boolean type</td><td style="border:1px solid">Multiplication</td></tr>
 * <tr><td style="border:1px solid">One expression is a string type and the other a character</td><td style="border:1px solid">Multiplication</td></tr>
 * <tr><td style="border:1px solid">One expression is numeric and the other is a string</td><td style="border:1px solid">Multiplication</td></tr>
 * <tr><td style="border:1px solid">Both expressions are numeric</td><td style="border:1px solid">Multiplication</td></tr>
 * <tr><td style="border:1px solid">Either expression is NULL</td><td style="border:1px solid">NULL is returned</td></tr>
 * <tr><td style="border:1px solid">Both expressions are empty</td><td style="border:1px solid">Empty string is returned</td></tr>
 * </tbody>
 * </table>
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_mul($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Performs logical negation on a variant
 * @link https://php.net/manual/en/function.variant-neg.php
 * @param mixed $variant
 * @return mixed Returns the result of the logical negation.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_neg($variant) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Performs bitwise not negation on a variant
 * @link https://php.net/manual/en/function.variant-not.php
 * @param mixed $variant
 * @return mixed Returns the bitwise not negation. If value is null, the result will also be null.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_not($variant) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Performs a logical disjunction on two variants
 * @link https://php.net/manual/en/function.variant-or.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of the bitwise OR, according to the following rules:
 * <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse">
 * <caption><b>Variant OR Rules</b></caption>
 * <thead>
 * <tr><th style="border:1px solid">If left is</th><th style="border:1px solid">If right is</th><th style="border:1px solid">then the result is</th></tr>
 * </thead>
 * <tbody>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">true</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">false</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">null</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">true</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">false</td><td style="border:1px solid">false</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">null</td><td style="border:1px solid">null</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">true</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">false</td><td style="border:1px solid">null</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">null</td><td style="border:1px solid">null</td></tr>
 * </tbody>
 * </table>
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_or($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Returns the result of performing the power function with two variants
 * @link https://php.net/manual/en/function.variant-pow.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of left to the power of right.
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_pow($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Rounds a variant to the specified number of decimal places
 * @link https://php.net/manual/en/function.variant-round.php
 * @param mixed $variant
 * @param int $decimals Number of decimal places.
 * @return mixed Returns the rounded value, or null on failure.
 */
function variant_round($variant, $decimals) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Convert a variant into another type "in-place"
 * @link https://php.net/manual/en/function.variant-set-type.php
 * @param VARIANT $variant The variant.
 * @param int $type
 * @return void No value is returned.
 */
function variant_set_type($variant, $type) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Assigns a new value for a variant object
 * @link https://php.net/manual/en/function.variant-set.php
 * @param VARIANT $variant The variant.
 * @param mixed $value
 * @return void No value is returned.
 */
function variant_set($variant, $value) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Subtracts the value of the right variant from the left variant value
 * @link https://php.net/manual/en/function.variant-sub.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of the subtraction, according to the following rules:
 * <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse">
 * <caption><b>Variant Subtraction Rules</b></caption>
 * <thead>
 * <tr><th style="border:1px solid">If</th><th style="border:1px solid">Then</th></tr>
 * </thead>
 * <tbody>
 * <tr><td style="border:1px solid">Both expressions are of the string type</td><td style="border:1px solid">Subtraction</td></tr>
 * <tr><td style="border:1px solid">One expression is a string type and the other a character</td><td style="border:1px solid">Subtraction</td></tr>
 * <tr><td style="border:1px solid">One expression is numeric and the other is a string</td><td style="border:1px solid">Subtraction.</td></tr>
 * <tr><td style="border:1px solid">Both expressions are numeric</td><td style="border:1px solid">Subtraction</td></tr>
 * <tr><td style="border:1px solid">Either expression is NULL</td><td style="border:1px solid">NULL is returned</td></tr>
 * <tr><td style="border:1px solid">Both expressions are empty</td><td style="border:1px solid">Empty string is returned</td></tr>
 * </tbody>
 * </table>
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_sub($left, $right) {}

/**
 * (PHP 5, PHP 7)<br/>
 * Performs a logical exclusion on two variants
 * @link https://php.net/manual/en/function.variant-xor.php
 * @param mixed $left The left operand.
 * @param mixed $right The right operand.
 * @return mixed Returns the result of the bitwise XOR, according to the following rules:
 * <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse">
 * <caption><b>Variant XOR Rules</b></caption>
 * <thead>
 * <tr><th style="border:1px solid">If left is</th><th style="border:1px solid">If right is</th><th style="border:1px solid">then the result is</th></tr>
 * </thead>
 * <tbody>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">true</td><td style="border:1px solid">false</td></tr>
 * <tr><td style="border:1px solid">true</td><td style="border:1px solid">false</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">true</td><td style="border:1px solid">true</td></tr>
 * <tr><td style="border:1px solid">false</td><td style="border:1px solid">false</td><td style="border:1px solid">false</td></tr>
 * <tr><td style="border:1px solid">null</td><td style="border:1px solid">null</td><td style="border:1px solid">null</td></tr>
 * </tbody>
 * </table>
 * @throws \com_exception Throws a com_exception on failure.
 */
function variant_xor($left, $right) {}

define('CLSCTX_INPROC_SERVER', 1);
define('CLSCTX_INPROC_HANDLER', 2);
define('CLSCTX_LOCAL_SERVER', 4);
define('CLSCTX_REMOTE_SERVER', 16);
define('CLSCTX_SERVER', 21);
define('CLSCTX_ALL', 23);

define('VT_NULL', 1);
define('VT_EMPTY', 0);
define('VT_UI1', 17);
define('VT_I2', 2);
define('VT_I4', 3);
define('VT_R4', 4);
define('VT_R8', 5);
define('VT_BOOL', 11);
define('VT_ERROR', 10);
define('VT_CY', 6);
define('VT_DATE', 7);
define('VT_BSTR', 8);
define('VT_DECIMAL', 14);
define('VT_UNKNOWN', 13);
define('VT_DISPATCH', 9);
define('VT_VARIANT', 12);
define('VT_I1', 16);
define('VT_UI2', 18);
define('VT_UI4', 19);
define('VT_INT', 22);
define('VT_UINT', 23);
define('VT_ARRAY', 8192);
define('VT_BYREF', 16384);

define('CP_ACP', 0);
define('CP_MACCP', 2);
define('CP_OEMCP', 1);
define('CP_UTF7', 65000);
define('CP_UTF8', 65001);
define('CP_SYMBOL', 42);
define('CP_THREAD_ACP', 3);

define('VARCMP_LT', 0);
define('VARCMP_EQ', 1);
define('VARCMP_GT', 2);
define('VARCMP_NULL', 3);

define('NORM_IGNORECASE', 1);
define('NORM_IGNORENONSPACE', 2);
define('NORM_IGNORESYMBOLS', 4);
define('NORM_IGNOREWIDTH', 131072);
define('NORM_IGNOREKANATYPE', 65536);
define('NORM_IGNOREKASHIDA', 262144);

define('DISP_E_DIVBYZERO', -2147352558);
define('DISP_E_OVERFLOW', -2147352566);
define('MK_E_UNAVAILABLE', -2147221021);

// End of com v.
