<?php

// Start of Core v.5.3.6-13ubuntu3.2

/**
 * Gets the version of the current Zend engine
 * @link https://php.net/manual/en/function.zend-version.php
 * @return string the Zend Engine version number, as a string.
 */
function zend_version () {}

/**
 * Returns the number of arguments passed to the function
 * @link https://php.net/manual/en/function.func-num-args.php
 * @return int the number of arguments passed into the current user-defined
 * function.
 * @since 4.0
 * @since 5.0
 */
function func_num_args () {}

/**
 * Return an item from the argument list
 * @link https://php.net/manual/en/function.func-get-arg.php
 * @param int $arg_num <p>
 * The argument offset. Function arguments are counted starting from
 * zero.
 * </p>
 * @return mixed the specified argument, or false on error.
 * @since 4.0
 * @since 5.0
 */
function func_get_arg ($arg_num) {}

/**
 * Returns an array comprising a function's argument list
 * @link https://php.net/manual/en/function.func-get-args.php
 * @return array an array in which each element is a copy of the corresponding
 * member of the current user-defined function's argument list.
 * @since 4.0
 * @since 5.0
 */
function func_get_args () {}

/**
 * Get string length
 * @link https://php.net/manual/en/function.strlen.php
 * @param string $string <p>
 * The string being measured for length.
 * </p>
 * @return int The length of the <i>string</i> on success,
 * and 0 if the <i>string</i> is empty.
 * @since 4.0
 * @since 5.0
 */
function strlen ($string) {}

/**
 * Binary safe string comparison
 * @link https://php.net/manual/en/function.strcmp.php
 * @param string $str1 <p>
 * The first string.
 * </p>
 * @param string $str2 <p>
 * The second string.
 * </p>
 * @return int &lt; 0 if <i>str1</i> is less than
 * <i>str2</i>; &gt; 0 if <i>str1</i>
 * is greater than <i>str2</i>, and 0 if they are
 * equal.
 * @since 4.0
 * @since 5.0
 */
function strcmp ($str1, $str2) {}

/**
 * Binary safe string comparison of the first n characters
 * @link https://php.net/manual/en/function.strncmp.php
 * @param string $str1 <p>
 * The first string.
 * </p>
 * @param string $str2 <p>
 * The second string.
 * </p>
 * @param int $len <p>
 * Number of characters to use in the comparison.
 * </p>
 * @return int &lt; 0 if <i>str1</i> is less than
 * <i>str2</i>; &gt; 0 if <i>str1</i>
 * is greater than <i>str2</i>, and 0 if they are
 * equal.
 * @since 4.0
 * @since 5.0
 */
function strncmp ($str1, $str2, $len) {}

/**
 * Binary safe case-insensitive string comparison
 * @link https://php.net/manual/en/function.strcasecmp.php
 * @param string $str1 <p>
 * The first string
 * </p>
 * @param string $str2 <p>
 * The second string
 * </p>
 * @return int &lt; 0 if <i>str1</i> is less than
 * <i>str2</i>; &gt; 0 if <i>str1</i>
 * is greater than <i>str2</i>, and 0 if they are
 * equal.
 * @since 4.0
 * @since 5.0
 */
function strcasecmp ($str1, $str2) {}

/**
 * Binary safe case-insensitive string comparison of the first n characters
 * @link https://php.net/manual/en/function.strncasecmp.php
 * @param string $str1 <p>
 * The first string.
 * </p>
 * @param string $str2 <p>
 * The second string.
 * </p>
 * @param int $len <p>
 * The length of strings to be used in the comparison.
 * </p>
 * @return int &lt; 0 if <i>str1</i> is less than
 * <i>str2</i>; &gt; 0 if <i>str1</i> is
 * greater than <i>str2</i>, and 0 if they are equal.
 * @since 4.0.4
 * @since 5.0
 */
function strncasecmp ($str1, $str2, $len) {}

/**
 * Return the current key and value pair from an array and advance the array cursor
 * @link https://php.net/manual/en/function.each.php
 * @param array|ArrayObject $array <p>
 * The input array.
 * </p>
 * @return array the current key and value pair from the array
 * <i>array</i>. This pair is returned in a four-element
 * array, with the keys 0, 1,
 * key, and value. Elements
 * 0 and key contain the key name of
 * the array element, and 1 and value
 * contain the data.
 * </p>
 * <p>
 * If the internal pointer for the array points past the end of the
 * array contents, <b>each</b> returns
 * false.
 * @since 4.0
 * @since 5.0
 * @deprecated 7.2
 */
function each (array &$array) {}

/**
 * Sets which PHP errors are reported
 * @link https://php.net/manual/en/function.error-reporting.php
 * @param int $level [optional] <p>
 * The new error_reporting
 * level. It takes on either a bitmask, or named constants. Using named 
 * constants is strongly encouraged to ensure compatibility for future 
 * versions. As error levels are added, the range of integers increases, 
 * so older integer-based error levels will not always behave as expected.
 * </p>
 * <p>
 * The available error level constants and the actual
 * meanings of these error levels are described in the
 * predefined constants.
 * <table>
 * error_reporting level constants and bit values
 * <tr valign="top">
 * <td>value</td>
 * <td>constant</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td>
 * E_ERROR
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td>
 * E_WARNING
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>4</td>
 * <td>
 * E_PARSE
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>8</td>
 * <td>
 * E_NOTICE
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>16</td>
 * <td>
 * E_CORE_ERROR
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>32</td>
 * <td>
 * E_CORE_WARNING
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>64</td>
 * <td>
 * E_COMPILE_ERROR
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>128</td>
 * <td>
 * E_COMPILE_WARNING
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>256</td>
 * <td>
 * E_USER_ERROR
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>512</td>
 * <td>
 * E_USER_WARNING
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>1024</td>
 * <td>
 * E_USER_NOTICE
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>6143</td>
 * <td>
 * E_ALL
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>2048</td>
 * <td>
 * E_STRICT
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>4096</td>
 * <td>
 * E_RECOVERABLE_ERROR
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>8192</td>
 * <td>
 * E_DEPRECATED
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>16384</td>
 * <td>
 * E_USER_DEPRECATED
 * </td>
 * </tr>
 * </table>
 * </p>
 * @return int the old error_reporting
 * level or the current level if no <i>level</i> parameter is
 * given.
 * @since 4.0
 * @since 5.0
 */
function error_reporting ($level = null) {}

/**
 * Defines a named constant
 * @link https://php.net/manual/en/function.define.php
 * @param string $name <p>
 * The name of the constant.
 * </p>
 * @param mixed $value <p>
 * The value of the constant; only scalar and null values are allowed. 
 * Scalar values are integer, 
 * float, string or boolean values. It is 
 * possible to define resource constants, however it is not recommended 
 * and may cause unpredictable behavior.
 * </p>
 * @param bool $case_insensitive [optional] <p>
 * If set to true, the constant will be defined case-insensitive. 
 * The default behavior is case-sensitive; i.e. 
 * CONSTANT and Constant represent
 * different values.
 * </p>
 * <p>
 * Case-insensitive constants are stored as lower-case.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function define ($name, $value, $case_insensitive = false) {}

/**
 * Checks whether a given named constant exists
 * @link https://php.net/manual/en/function.defined.php
 * @param string $name <p>
 * The constant name.
 * </p>
 * @return bool true if the named constant given by <i>name</i>
 * has been defined, false otherwise.
 * @since 4.0
 * @since 5.0
 */
function defined ($name) {}

/**
 * Returns the name of the class of an object
 * @link https://php.net/manual/en/function.get-class.php
 * @param object $object [optional] <p>
 * The tested object. This parameter may be omitted when inside a class.
 * </p>
 * @return string the name of the class of which <i>object</i> is an
 * instance. Returns false if <i>object</i> is not an
 * object.
 * </p>
 * <p>
 * If <i>object</i> is omitted when inside a class, the
 * name of that class is returned.
 * @since 4.0
 * @since 5.0
 */
function get_class ($object = null) {}

/**
 * the "Late Static Binding" class name
 * @link https://php.net/manual/en/function.get-called-class.php
 * @return string the class name. Returns false if called from outside a class.
 * @since 5.3.0
 */
function get_called_class () {}

/**
 * Retrieves the parent class name for object or class
 * @link https://php.net/manual/en/function.get-parent-class.php
 * @param mixed $object [optional] <p>
 * The tested object or class name
 * </p>
 * @return string the name of the parent class of the class of which
 * <i>object</i> is an instance or the name.
 * </p>
 * <p>
 * If the object does not have a parent false will be returned.
 * </p>
 * <p>
 * If called without parameter outside object, this function returns false.
 * @since 4.0
 * @since 5.0
 */
function get_parent_class ($object = null) {}

/**
 * Checks if the class method exists
 * @link https://php.net/manual/en/function.method-exists.php
 * @param mixed $object <p>
 * An object instance or a class name
 * </p>
 * @param string $method_name <p>
 * The method name
 * </p>
 * @return bool true if the method given by <i>method_name</i>
 * has been defined for the given <i>object</i>, false
 * otherwise.
 * @since 4.0
 * @since 5.0
 */
function method_exists ($object, $method_name) {}

/**
 * Checks if the object or class has a property
 * @link https://php.net/manual/en/function.property-exists.php
 * @param mixed $class <p>
 * The class name or an object of the class to test for
 * </p>
 * @param string $property <p>
 * The name of the property
 * </p>
 * @return bool true if the property exists, false if it doesn't exist or
 * null in case of an error.
 * @since 5.1.0
 */
function property_exists ($class, $property) {}

/**
 * Checks if the trait exists
 * @param string $traitname Name of the trait to check
 * @param bool $autoload [optional] Whether to autoload if not already loaded.
 * @return boolean Returns TRUE if trait exists, FALSE if not, NULL in case of an error.
 * @link https://secure.php.net/manual/en/function.trait-exists.php
 * @since 5.4.0
 */
function trait_exists($traitname, $autoload ) {}

/**
 * Checks if the class has been defined
 * @link https://php.net/manual/en/function.class-exists.php
 * @param string $class_name <p>
 * The class name. The name is matched in a case-insensitive manner.
 * </p>
 * @param bool $autoload [optional] <p>
 * Whether or not to call &link.autoload; by default.
 * </p>
 * @return bool true if <i>class_name</i> is a defined class,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function class_exists ($class_name, $autoload = true) {}

/**
 * Checks if the interface has been defined
 * @link https://php.net/manual/en/function.interface-exists.php
 * @param string $interface_name <p>
 * The interface name
 * </p>
 * @param bool $autoload [optional] <p>
 * Whether to call &link.autoload; or not by default.
 * </p>
 * @return bool true if the interface given by 
 * <i>interface_name</i> has been defined, false otherwise.
 * @since 5.0.2
 */
function interface_exists ($interface_name, $autoload = true) {}

/**
 * Return true if the given function has been defined
 * @link https://php.net/manual/en/function.function-exists.php
 * @param string $function_name <p>
 * The function name, as a string.
 * </p>
 * @return bool true if <i>function_name</i> exists and is a
 * function, false otherwise.
 * </p>
 * <p>
 * This function will return false for constructs, such as 
 * <b>include_once</b> and <b>echo</b>.
 * @since 4.0
 * @since 5.0
 */
function function_exists ($function_name) {}

/**
 * Creates an alias for a class
 * @link https://php.net/manual/en/function.class-alias.php
 * @param string $original The original class.
 * @param string $alias The alias name for the class.
 * @param bool $autoload [optional] Whether to autoload if the original class is not found.
 * @return bool true on success or false on failure.
 * @since 5.3.0
 */
function class_alias ($original, $alias, $autoload = TRUE) {}

/**
 * Returns an array with the names of included or required files
 * @link https://php.net/manual/en/function.get-included-files.php
 * @return string[] an array of the names of all files.
 * </p>
 * <p>
 * The script originally called is considered an "included file," so it will
 * be listed together with the files referenced by 
 * <b>include</b> and family.
 * </p>
 * <p>
 * Files that are included or required multiple times only show up once in
 * the returned array.
 * @since 4.0
 * @since 5.0
 */
function get_included_files () {}

/**
 * Alias of <b>get_included_files</b>
 * @link https://php.net/manual/en/function.get-required-files.php
 * @return string[]
 * @since 4.0
 * @since 5.0
 */
function get_required_files () {}

/**
 * Checks if the object has this class as one of its parents
 * @link https://php.net/manual/en/function.is-subclass-of.php
 * @param mixed $object <p>
 * A class name or an object instance
 * </p>
 * @param string $class_name <p>
 * The class name
 * </p>
 * @param bool $allow_string [optional] <p>
 * If this parameter set to false, string class name as object is not allowed.
 * This also prevents from calling autoloader if the class doesn't exist. 
 * </p>
 * @return bool This function returns true if the object <i>object</i>,
 * belongs to a class which is a subclass of 
 * <i>class_name</i>, false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_subclass_of ($object, $class_name, $allow_string = TRUE) {}

/**
 * Checks if the object is of this class or has this class as one of its parents
 * @link https://php.net/manual/en/function.is-a.php
 * @param object|string $object <p>
 * The tested object
 * </p>
 * @param string $class_name <p>
 * The class name
 * </p>
 * @param bool $allow_string [optional] <p>
 * If this parameter set to <b>FALSE</b>, string class name as <em><b>object</b></em>
 * is not allowed. This also prevents from calling autoloader if the class doesn't exist.
 * </p>
 * @return bool <b>TRUE</b> if the object is of this class or has this class as one of
 * its parents, <b>FALSE</b> otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function is_a ($object, $class_name, $allow_string = FALSE) {}

/**
 * Get the default properties of the class
 * @link https://php.net/manual/en/function.get-class-vars.php
 * @param string $class_name <p>
 * The class name
 * </p>
 * @return array an associative array of declared properties visible from the
 * current scope, with their default value.
 * The resulting array elements are in the form of 
 * varname => value.
 * @since 4.0
 * @since 5.0
 */
function get_class_vars ($class_name) {}

/**
 * Gets the properties of the given object
 * @link https://php.net/manual/en/function.get-object-vars.php
 * @param object $object <p>
 * An object instance.
 * </p>
 * @return array an associative array of defined object accessible non-static properties 
 * for the specified <i>object</i> in scope. If a property have
 * not been assigned a value, it will be returned with a null value.
 * @since 4.0
 * @since 5.0
 */
function get_object_vars ($object) {}

/**
 * Gets the class methods' names
 * @link https://php.net/manual/en/function.get-class-methods.php
 * @param mixed $class_name <p>
 * The class name or an object instance
 * </p>
 * @return array an array of method names defined for the class specified by
 * <i>class_name</i>. In case of an error, it returns null.
 * @since 4.0
 * @since 5.0
 */
function get_class_methods ($class_name) {}

/**
 * Generates a user-level error/warning/notice message
 * @link https://php.net/manual/en/function.trigger-error.php
 * @param string $error_msg <p>
 * The designated error message for this error. It's limited to 1024 
 * characters in length. Any additional characters beyond 1024 will be 
 * truncated.
 * </p>
 * @param int $error_type [optional] <p>
 * The designated error type for this error. It only works with the E_USER
 * family of constants, and will default to <b>E_USER_NOTICE</b>.
 * </p>
 * @return bool This function returns false if wrong <i>error_type</i> is
 * specified, true otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function trigger_error ($error_msg, $error_type = E_USER_NOTICE) {}

/**
 * Alias of <b>trigger_error</b>
 * @link https://php.net/manual/en/function.user-error.php
 * @param string $message
 * @param int    $error_type [optional]
 * @since 4.0
 * @since 5.0
 */
function user_error ($message, $error_type) {}

/**
 * Sets a user-defined error handler function
 * @link https://php.net/manual/en/function.set-error-handler.php
 * @param callable $error_handler <p>
 * The user function needs to accept two parameters: the error code, and a
 * string describing the error. Then there are three optional parameters 
 * that may be supplied: the filename in which the error occurred, the
 * line number in which the error occurred, and the context in which the
 * error occurred (an array that points to the active symbol table at the
 * point the error occurred). The function can be shown as:
 * </p>
 * <p>
 * <b>handler</b>
 * <b>int<i>errno</i></b>
 * <b>string<i>errstr</i></b>
 * <b>string<i>errfile</i></b>
 * <b>int<i>errline</i></b>
 * <b>array<i>errcontext</i></b>
 * <i>errno</i>
 * The first parameter, <i>errno</i>, contains the
 * level of the error raised, as an integer.
 * @param int $error_types [optional] <p>
 * Can be used to mask the triggering of the
 * <i>error_handler</i> function just like the error_reporting ini setting
 * controls which errors are shown. Without this mask set the
 * <i>error_handler</i> will be called for every error
 * regardless to the setting of the error_reporting setting.
 * </p>
 * @return mixed a string containing the previously defined error handler (if any). If
 * the built-in error handler is used null is returned. null is also returned
 * in case of an error such as an invalid callback. If the previous error handler
 * was a class method, this function will return an indexed array with the class
 * and the method name.
 * @since 4.0.4
 * @since 5.0
 */
function set_error_handler ($error_handler, $error_types = E_ALL | E_STRICT) {}

/**
 * Restores the previous error handler function
 * @link https://php.net/manual/en/function.restore-error-handler.php
 * @return bool This function always returns true.
 * @since 4.0.4
 * @since 5.0
 */
function restore_error_handler () {}

/**
 * Sets a user-defined exception handler function
 * @link https://php.net/manual/en/function.set-exception-handler.php
 * @param callable|null $exception_handler <p>
 * Name of the function to be called when an uncaught exception occurs.
 * This function must be defined before calling
 * <b>set_exception_handler</b>. This handler function
 * needs to accept one parameter, which will be the exception object that
 * was thrown.
 * NULL may be passed instead, to reset this handler to its default state.
 * </p>
 * @return callable|null the name of the previously defined exception handler, or null on error. If
 * no previous handler was defined, null is also returned.
 * @since 5.0
 */
function set_exception_handler ($exception_handler) {}

/**
 * Restores the previously defined exception handler function
 * @link https://php.net/manual/en/function.restore-exception-handler.php
 * @return bool This function always returns true.
 * @since 5.0
 */
function restore_exception_handler () {}

/**
 * Returns an array with the name of the defined classes
 * @link https://php.net/manual/en/function.get-declared-classes.php
 * @return array an array of the names of the declared classes in the current
 * script.
 * </p>
 * <p>
 * Note that depending on what extensions you have compiled or
 * loaded into PHP, additional classes could be present. This means that
 * you will not be able to define your own classes using these
 * names. There is a list of predefined classes in the Predefined Classes section of
 * the appendices.
 * @since 4.0
 * @since 5.0
 */
function get_declared_classes () {}

/**
 * Returns an array of all declared interfaces
 * @link https://php.net/manual/en/function.get-declared-interfaces.php
 * @return array an array of the names of the declared interfaces in the current
 * script.
 * @since 5.0
 */
function get_declared_interfaces () {}

/**
 * Returns an array of all declared traits
 * @return array with names of all declared traits in values. Returns NULL in case of a failure.
 * @link https://secure.php.net/manual/en/function.get-declared-traits.php
 * @see class_uses()
 * @since 5.4.0
 */
function get_declared_traits() {}

/**
 * Returns an array of all defined functions
 * @link https://php.net/manual/en/function.get-defined-functions.php
 * @param bool $exclude_disabled [optional] Whether disabled functions should be excluded from the return value.
 * @return array an multidimensional array containing a list of all defined
 * functions, both built-in (internal) and user-defined. The internal
 * functions will be accessible via $arr["internal"], and
 * the user defined ones using $arr["user"] (see example
 * below).
 * @since 4.0.4
 * @since 5.0
 */
function get_defined_functions ($exclude_disabled = FALSE) {}

/**
 * Returns an array of all defined variables
 * @link https://php.net/manual/en/function.get-defined-vars.php
 * @return array A multidimensional array with all the variables.
 * @since 4.0.4
 * @since 5.0
 */
function get_defined_vars () {}

/**
 * Create an anonymous (lambda-style) function
 * @link https://php.net/manual/en/function.create-function.php
 * @param string $args <p>
 * The function arguments.
 * </p>
 * @param string $code <p>
 * The function code.
 * </p>
 * @return string a unique function name as a string, or false on error.
 * @since 4.0.1
 * @since 5.0
 * @deprecated 7.2
 */
function create_function ($args, $code) {}

/**
 * Returns the resource type
 * @link https://php.net/manual/en/function.get-resource-type.php
 * @param resource $handle <p>
 * The evaluated resource handle.
 * </p>
 * @return string If the given <i>handle</i> is a resource, this function
 * will return a string representing its type. If the type is not identified
 * by this function, the return value will be the string 
 * Unknown.
 * </p>
 * <p>
 * This function will return false and generate an error if 
 * <i>handle</i> is not a resource.
 * @since 4.0.2
 * @since 5.0
 */
function get_resource_type ($handle) {}

/**
 * Returns an array with the names of all modules compiled and loaded
 * @link https://php.net/manual/en/function.get-loaded-extensions.php
 * @param bool $zend_extensions [optional] <p>
 * Only return Zend extensions, if not then regular extensions, like
 * mysqli are listed. Defaults to false (return regular extensions).
 * </p>
 * @return array an indexed array of all the modules names.
 * @since 4.0
 * @since 5.0
 */
function get_loaded_extensions ($zend_extensions = false) {}

/**
 * Find out whether an extension is loaded
 * @link https://php.net/manual/en/function.extension-loaded.php
 * @param string $name <p>
 * The extension name.
 * </p>
 * <p>
 * You can see the names of various extensions by using
 * <b>phpinfo</b> or if you're using the
 * CGI or CLI version of
 * PHP you can use the -m switch to
 * list all available extensions:
 * <pre>
 * $ php -m
 * [PHP Modules]
 * xml
 * tokenizer
 * standard
 * sockets
 * session
 * posix
 * pcre
 * overload
 * mysql
 * mbstring
 * ctype
 * [Zend Modules]
 * </pre>
 * </p>
 * @return bool true if the extension identified by <i>name</i>
 * is loaded, false otherwise.
 * @since 4.0
 * @since 5.0
 */
function extension_loaded ($name) {}

/**
 * Returns an array with the names of the functions of a module
 * @link https://php.net/manual/en/function.get-extension-funcs.php
 * @param string $module_name <p>
 * The module name.
 * </p>
 * <p>
 * This parameter must be in lowercase.
 * </p>
 * @return array an array with all the functions, or false if 
 * <i>module_name</i> is not a valid extension.
 * @since 4.0
 * @since 5.0
 */
function get_extension_funcs ($module_name) {}

/**
 * Returns an associative array with the names of all the constants and their values
 * @link https://php.net/manual/en/function.get-defined-constants.php
 * @param bool $categorize [optional] <p>
 * Causing this function to return a multi-dimensional
 * array with categories in the keys of the first dimension and constants
 * and their values in the second dimension.
 * <code>
 * define("MY_CONSTANT", 1);
 * print_r(get_defined_constants(true));
 * </code>
 * The above example will output something similar to:
 * <pre>
 * Array
 * (
 * [Core] => Array
 * (
 * [E_ERROR] => 1
 * [E_WARNING] => 2
 * [E_PARSE] => 4
 * [E_NOTICE] => 8
 * [E_CORE_ERROR] => 16
 * [E_CORE_WARNING] => 32
 * [E_COMPILE_ERROR] => 64
 * [E_COMPILE_WARNING] => 128
 * [E_USER_ERROR] => 256
 * [E_USER_WARNING] => 512
 * [E_USER_NOTICE] => 1024
 * [E_ALL] => 2047
 * [TRUE] => 1
 * )
 * [pcre] => Array
 * (
 * [PREG_PATTERN_ORDER] => 1
 * [PREG_SET_ORDER] => 2
 * [PREG_OFFSET_CAPTURE] => 256
 * [PREG_SPLIT_NO_EMPTY] => 1
 * [PREG_SPLIT_DELIM_CAPTURE] => 2
 * [PREG_SPLIT_OFFSET_CAPTURE] => 4
 * [PREG_GREP_INVERT] => 1
 * )
 * [user] => Array
 * (
 * [MY_CONSTANT] => 1
 * )
 * )
 * </pre>
 * </p>
 * @return array 
 * @since 4.1.0
 * @since 5.0
 */
function get_defined_constants ($categorize = false) {}

/**
 * Generates a backtrace
 * @link https://php.net/manual/en/function.debug-backtrace.php
 * @param int $options [optional] <p>
 * As of 5.3.6, this parameter is a bitmask for the following options:
 * <table>
 * <b>debug_backtrace</b> options
 * <tr valign="top">
 * <td>DEBUG_BACKTRACE_PROVIDE_OBJECT</td>
 * <td>
 * Whether or not to populate the "object" index.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>DEBUG_BACKTRACE_IGNORE_ARGS</td>
 * <td>
 * Whether or not to omit the "args" index, and thus all the function/method arguments,
 * to save memory.
 * </td>
 * </tr>
 * </table>
 * Before 5.3.6, the only values recognized are true or false, which are the same as
 * setting or not setting the <b>DEBUG_BACKTRACE_PROVIDE_OBJECT</b> option respectively.
 * </p>
 * @param int $limit [optional] <p>
 * As of 5.4.0, this parameter can be used to limit the number of stack frames returned.
 * By default (<i>limit</i>=0) it returns all stack frames.
 * </p>
 * @return array an array of associative arrays. The possible returned elements
 * are as follows:
 * </p>
 * <p>
 * <table>
 * Possible returned elements from <b>debug_backtrace</b>
 * <tr valign="top">
 * <td>&Name;</td>
 * <td>&Type;</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>function</td>
 * <td>string</td>
 * <td>
 * The current function name. See also
 * __FUNCTION__.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>line</td>
 * <td>integer</td>
 * <td>
 * The current line number. See also
 * __LINE__.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>file</td>
 * <td>string</td>
 * <td>
 * The current file name. See also
 * __FILE__.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>class</td>
 * <td>string</td>
 * <td>
 * The current class name. See also
 * __CLASS__
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>object</td>
 * <td>object</td>
 * <td>
 * The current object.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>type</td>
 * <td>string</td>
 * <td>
 * The current call type. If a method call, "->" is returned. If a static
 * method call, "::" is returned. If a function call, nothing is returned.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>args</td>
 * <td>array</td>
 * <td>
 * If inside a function, this lists the functions arguments. If
 * inside an included file, this lists the included file name(s).
 * </td>
 * </tr>
 * </table>
 * @since 4.3.0
 * @since 5.0
 */
function debug_backtrace ($options = DEBUG_BACKTRACE_PROVIDE_OBJECT, $limit = 0) {}

/**
 * Clear the most recent error
 * @link https://php.net/manual/en/function.error-clear-last.php
 * @since 7.0
 */
function error_clear_last () {}
const DEBUG_BACKTRACE_PROVIDE_OBJECT = 0;
const DEBUG_BACKTRACE_IGNORE_ARGS = 0;

/**
 * Prints a backtrace
 * @link https://php.net/manual/en/function.debug-print-backtrace.php
 * @param int $options [optional] <p>
 * As of 5.3.6, this parameter is a bitmask for the following options:
 * <table>
 * <b>debug_print_backtrace</b> options
 * <tr valign="top">
 * <td>DEBUG_BACKTRACE_IGNORE_ARGS</td>
 * <td>
 * Whether or not to omit the "args" index, and thus all the function/method arguments,
 * to save memory.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @param int $limit [optional] <p>
 * As of 5.4.0, this parameter can be used to limit the number of stack frames printed.
 * By default (<i>limit</i>=0) it prints all stack frames.
 * </p>
 * @return void
 * @since 5.0
 */
function debug_print_backtrace ($options = 0, $limit = 0) {}

/**
 * Forces collection of any existing garbage cycles
 * @link https://php.net/manual/en/function.gc-collect-cycles.php
 * @return int number of collected cycles.
 * @since 5.3.0
 */
function gc_collect_cycles () {}

/**
 * Returns status of the circular reference collector
 * @link https://php.net/manual/en/function.gc-enabled.php
 * @return bool true if the garbage collector is enabled, false otherwise.
 * @since 5.3.0
 */
function gc_enabled () {}

/**
 * Activates the circular reference collector
 * @link https://php.net/manual/en/function.gc-enable.php
 * @return void 
 * @since 5.3.0
 */
function gc_enable () {}

/**
 * Deactivates the circular reference collector
 * @link https://php.net/manual/en/function.gc-disable.php
 * @return void 
 * @since 5.3.0
 */
function gc_disable () {}

/**
 * @since 7.3
 */
function gc_status () {}

/**
 * @param string $kind
 * @return int
 * @since 7.1
 */
function sapi_windows_cp_get($kind) {

}

/**
 * @param int $cp
 * @return bool
 * @since 7.1
 */
function sapi_windows_cp_set($cp) {

}

/**
 * @param int|string $in_codepage
 * @param int|string $out_codepage
 * @param string $subject
 * @return string
 * @since 7.1
 */
function sapi_windows_cp_conv($in_codepage, $out_codepage, $subject) {}

/**
 * @return bool
 * @since 7.1
 */
function sapi_windows_cp_is_utf8() {

}

/**
 * Verify that the contents of a variable is accepted by the iterable pseudo-type, i.e. that it is an array or an object implementing Traversable
 * @param mixed $value
 * @return bool
 * @since 7.1
 * @link https://php.net/manual/en/function.is-iterable.php
 */
function is_iterable($value) {}

/**
 * Encodes an ISO-8859-1 string to UTF-8
 * @link https://php.net/manual/en/function.utf8-encode.php
 * @param string $data <p>
 * An ISO-8859-1 string.
 * </p>
 * @return string the UTF-8 translation of <i>data</i>.
 * @since 4.0
 * @since 5.0
 */
function utf8_encode ($data) {}

/**
 * Converts a string with ISO-8859-1 characters encoded with UTF-8
 * @since 4.0
 * @since 5.0
to single-byte ISO-8859-1
 * @link https://php.net/manual/en/function.utf8-decode.php
 * @param string $data <p>
 * An UTF-8 encoded string.
 * </p>
 * @return string the ISO-8859-1 translation of <i>data</i>.
 */
function utf8_decode ($data) {}
