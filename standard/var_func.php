<?php
/**
 * PHPStorm stub file for Variable handling functions.
 *
 * @link http://php.net/manual/en/book.var.php
 */

/**
 * (PHP 5.5.0)<br/>
 * Get the boolean value of a variable
 *
 * @param mixed $var <p>the scalar value being converted to a boolean.</p>
 *
 * @return boolean The boolean value of var.
 * @since 5.5.0
 */
function boolval($var) { }

/**
 * Dumps a string representation of an internal zend value to output
 *
 * @link  http://php.net/manual/en/function.debug-zval-dump.php
 *
 * @param mixed $variable <p>
 *                        The variable being evaluated.
 *                        </p>
 *
 * @return void
 * @since 4.2.0
 * @since 5.0
 */
function debug_zval_dump($variable) { }

/**
 * (PHP 4.2.0, PHP 5)<br/>
 * doubleval � Alias of floatval()
 * Get float value of a variable
 * &Alias; <function>floatval</function>
 *
 * @link http://php.net/manual/en/function.doubleval.php
 *
 * @param mixed $var May be any scalar type. should not be used on objects, as doing so will emit an E_NOTICE level
 *                   error and return 1.
 *
 * @return float value of the given variable. Empty arrays return 0, non-empty arrays return 1.
 */
function doubleval($var) { }

/**
 * Determine whether a variable is considered to be empty. A variable is considered empty if it does not exist or
 * if its value equals <b>FALSE</b>. <b>empty()</b> does not generate a warning if the variable does not exist.
 *
 * @link http://php.net/manual/en/function.empty.php
 *
 * @param mixed $var <p>Variable to be checked.</p>
 *                   <p>Note: Prior to PHP 5.5, <b>empty()</b> only supports variables; anything else will result
 *                   in a parse error. In other words, the following will not work: <b>empty(trim($name))</b>.
 *                   Instead, use <b>trim($name) == false</b>.
 *                   </p>
 *                   <p>
 *                   No warning is generated if the variable does not exist. That means <b>empty()</b> is
 *                   essentially the concise equivalent to <b>!isset($var) || $var == false</b>.
 *                   </p>
 *
 * @return bool <p><b>FALSE</b> if var exists and has a non-empty, non-zero value. Otherwise returns
 *              <b>TRUE</b>.<p>
 * <p>
 * The following things are considered to be empty:
 * <ul>
 * <li>"" (an empty string)</li>
 * <li>0 (0 as an integer)</li>
 * <li>0.0 (0 as a float)</li>
 * <li>"0" (0 as a string)</li>
 * <li><b>NULL</b></li>
 * <li><b>FALSE</b></li>
 * <li>array() (an empty array)</li>
 * <li>$var; (a variable declared, but without a value)</li>
 * </ul>
 * </p>
 */
function PS_UNRESERVE_PREFIX_empty($var) { }

/**
 * Get float value of a variable
 *
 * @link  http://php.net/manual/en/function.floatval.php
 *
 * @param mixed $var May be any scalar type. should not be used on objects, as doing so will emit an E_NOTICE level
 *                   error and return 1.
 *
 * @return float value of the given variable. Empty arrays return 0, non-empty arrays return 1.
 * @since 4.2.0
 * @since 5.0
 */
function floatval($var) { }

/**
 * Returns an array of all defined variables
 *
 * @link  http://php.net/manual/en/function.get-defined-vars.php
 * @return array A multidimensional array with all the variables.
 * @since 4.0.4
 * @since 5.0
 */
function get_defined_vars() { }

/**
 * Returns the resource type
 *
 * @link  http://php.net/manual/en/function.get-resource-type.php
 *
 * @param resource $handle <p>
 *                         The evaluated resource handle.
 *                         </p>
 *
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
function get_resource_type($handle) { }

/**
 * Get the type of a variable
 *
 * @link  http://php.net/manual/en/function.gettype.php
 *
 * @param mixed $var <p>
 *                   The variable being type checked.
 *                   </p>
 *
 * @return string Possibles values for the returned string are:
 * "boolean"
 * "integer"
 * "double" (for historical reasons "double" is
 * returned in case of a float, and not simply
 * "float")
 * "string"
 * "array"
 * "object"
 * "resource"
 * "NULL"
 * "unknown type"
 * @since 4.0
 * @since 5.0
 */
function gettype($var) { }

/**
 * Import GET/POST/Cookie variables into the global scope
 *
 * @link       http://php.net/manual/en/function.import-request-variables.php
 *
 * @param string $types  <p>
 *                       Using the types parameter, you can specify
 *                       which request variables to import. You can use 'G', 'P' and 'C'
 *                       characters respectively for GET, POST and Cookie. These characters are
 *                       not case sensitive, so you can also use any combination of 'g', 'p'
 *                       and 'c'. POST includes the POST uploaded file information.
 *                       </p>
 *                       <p>
 *                       Note that the order of the letters matters, as when using
 *                       "GP", the
 *                       POST variables will overwrite GET variables with the same name. Any
 *                       other letters than GPC are discarded.
 *                       </p>
 * @param string $prefix [optional] <p>
 *                       Variable name prefix, prepended before all variable's name imported
 *                       into the global scope. So if you have a GET value named
 *                       "userid", and provide a prefix
 *                       "pref_", then you'll get a global variable named
 *                       $pref_userid.
 *                       </p>
 *                       <p>
 *                       Although the prefix parameter is optional, you
 *                       will get an E_NOTICE level
 *                       error if you specify no prefix, or specify an empty string as a
 *                       prefix. This is a possible security hazard. Notice level errors are
 *                       not displayed using the default error reporting level.
 *                       </p>
 *
 * @return bool true on success or false on failure.
 * @deprecated 5.3 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since      4.1.0
 * @since      5.0
 */
function import_request_variables($types, $prefix = null) { }

/**
 * Get the integer value of a variable
 *
 * @link  http://php.net/manual/en/function.intval.php
 *
 * @param mixed $var  <p>
 *                    The scalar value being converted to an integer
 *                    </p>
 * @param int   $base [optional] <p>
 *                    The base for the conversion
 *                    </p>
 *
 * @return int The integer value of var on success, or 0 on
 * failure. Empty arrays and objects return 0, non-empty arrays and
 * objects return 1.
 * </p>
 * <p>
 * The maximum value depends on the system. 32 bit systems have a
 * maximum signed integer range of -2147483648 to 2147483647. So for example
 * on such a system, intval('1000000000000') will return
 * 2147483647. The maximum signed integer value for 64 bit systems is
 * 9223372036854775807.
 * </p>
 * <p>
 * Strings will most likely return 0 although this depends on the
 * leftmost characters of the string. The common rules of
 * integer casting
 * apply.
 * @since 4.0
 * @since 5.0
 */
function intval($var, $base = null) { }

/**
 * Finds whether a variable is an array
 *
 * @link  http://php.net/manual/en/function.is-array.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is an array,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_array($var) { }

/**
 * Finds out whether a variable is a boolean
 *
 * @link  http://php.net/manual/en/function.is-bool.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is a boolean,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_bool($var) { }

/**
 * Verify that the contents of a variable can be called as a function
 *
 * @link  http://php.net/manual/en/function.is-callable.php
 *
 * @param callback|callable $name          <p>
 *                                         Can be either the name of a function stored in a string variable, or
 *                                         an object and the name of a method within the object, like this:
 *                                         array($SomeObject, 'MethodName')
 *                                         </p>
 * @param bool              $syntax_only   [optional] <p>
 *                                         If set to true the function only verifies that
 *                                         name might be a function or method. It will only
 *                                         reject simple variables that are not strings, or an array that does
 *                                         not have a valid structure to be used as a callback. The valid ones
 *                                         are supposed to have only 2 entries, the first of which is an object
 *                                         or a string, and the second a string.
 *                                         </p>
 * @param string            $callable_name [optional] <p>
 *                                         Receives the "callable name". In the example below it is
 *                                         "someClass::someMethod". Note, however, that despite the implication
 *                                         that someClass::SomeMethod() is a callable static method, this is not
 *                                         the case.
 *                                         </p>
 *
 * @return bool true if name is callable, false
 * otherwise.
 * @since 4.0.6
 * @since 5.0
 */
function is_callable($name, $syntax_only = null, &$callable_name = null) { }

/**
 * &Alias; <function>is_float</function>
 *
 * @link  http://php.net/manual/en/function.is-double.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is a float,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_double($var) { }

/**
 * Finds whether the type of a variable is float
 *
 * @link  http://php.net/manual/en/function.is-float.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is a float,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_float($var) { }

/**
 * Find whether the type of a variable is integer
 *
 * @link  http://php.net/manual/en/function.is-int.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is an integer,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_int($var) { }

/**
 * &Alias; <function>is_int</function>
 *
 * @link  http://php.net/manual/en/function.is-integer.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is an integer,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_integer($var) { }

/**
 * &Alias; <function>is_int</function>
 *
 * @link  http://php.net/manual/en/function.is-long.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is an integer,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_long($var) { }

/**
 * Finds whether a variable is &null;
 *
 * @link  http://php.net/manual/en/function.is-null.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is null, false
 * otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function is_null($var) { }

/**
 * Finds whether a variable is a number or a numeric string
 *
 * @link  http://php.net/manual/en/function.is-numeric.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is a number or a numeric
 * string, false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_numeric($var) { }

/**
 * Finds whether a variable is an object
 *
 * @link  http://php.net/manual/en/function.is-object.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is an object,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_object($var) { }

/**
 * &Alias; <function>is_float</function>
 *
 * @link  http://php.net/manual/en/function.is-real.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is a float,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_real($var) { }

/**
 * Finds whether a variable is a resource
 *
 * @link  http://php.net/manual/en/function.is-resource.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is a resource,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_resource($var) { }

/**
 * Finds whether a variable is a scalar
 *
 * @link  http://php.net/manual/en/function.is-scalar.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is a scalar false
 * otherwise.
 * @since 4.0.5
 * @since 5.0
 */
function is_scalar($var) { }

/**
 * Find whether the type of a variable is string
 *
 * @link  http://php.net/manual/en/function.is-string.php
 *
 * @param mixed $var <p>
 *                   The variable being evaluated.
 *                   </p>
 *
 * @return bool true if var is of type string,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_string($var) { }

/**
 * <p>Determine if a variable is set and is not <b>NULL</b>.</p>
 * <p>If a variable has been unset with unset(), it will no longer be set. <b>isset()</b> will return <b>FALSE</b>
 * if testing a variable that has been set to <b>NULL</b>. Also note that a null character ("\0") is not equivalent
 * to the PHP <b>NULL</b> constant.</p>
 * <p>If multiple parameters are supplied then <b>isset()</b> will return <b>TRUE</b> only if all of the parameters
 * are set. Evaluation goes from left to right and stops as soon as an unset variable is encountered.</p>
 *
 * @link http://php.net/manual/en/function.isset.php
 *
 * @param mixed $var <p>The variable to be checked.</p>
 * @param mixed $_   [optional] <p>Another variable ...</p>
 *
 * @return bool Returns <b>TRUE</b> if var exists and has value other than <b>NULL</b>, <b>FALSE</b> otherwise.
 */
function PS_UNRESERVE_PREFIX_isset($var, ...$_) { }

/**
 * Prints human-readable information about a variable
 *
 * @link  http://php.net/manual/en/function.print-r.php
 *
 * @param mixed $expression <p>
 *                          The expression to be printed.
 *                          </p>
 * @param bool  $return     [optional] <p>
 *                          If you would like to capture the output of print_r,
 *                          use the return parameter. If this parameter is set
 *                          to true, print_r will return its output, instead of
 *                          printing it (which it does by default).
 *                          </p>
 *
 * @return mixed If given a string, integer or float,
 * the value itself will be printed. If given an array, values
 * will be presented in a format that shows keys and elements. Similar
 * notation is used for objects.
 * @since 4.0
 * @since 5.0
 */
function print_r($expression, $return = null) { }

/**
 * Generates a storable representation of a value
 *
 * @link  http://php.net/manual/en/function.serialize.php
 *
 * @param mixed $value <p>
 *                     The value to be serialized. serialize
 *                     handles all types, except the resource-type.
 *                     You can even serialize arrays that contain
 *                     references to itself. Circular references inside the array/object you
 *                     are serializing will also be stored. Any other
 *                     reference will be lost.
 *                     </p>
 *                     <p>
 *                     When serializing objects, PHP will attempt to call the member function
 *                     __sleep prior to serialization.
 *                     This is to allow the object to do any last minute clean-up, etc. prior
 *                     to being serialized. Likewise, when the object is restored using
 *                     unserialize the __wakeup member function is called.
 *                     </p>
 *                     <p>
 *                     Object's private members have the class name prepended to the member
 *                     name; protected members have a '*' prepended to the member name.
 *                     These prepended values have null bytes on either side.
 *                     </p>
 *
 * @return string a string containing a byte-stream representation of
 * value that can be stored anywhere.
 * @since 4.0
 * @since 5.0
 */
function serialize($value) { }

/**
 * Set the type of a variable
 *
 * @link  http://php.net/manual/en/function.settype.php
 *
 * @param mixed  $var  <p>
 *                     The variable being converted.
 *                     </p>
 * @param string $type <p>
 *                     Possibles values of <b>type</b> are:
 *                     </p><ul>
 *                     <li>
 *                     "boolean" (or, since PHP 4.2.0, "bool")
 *                     </li>
 *                     <li>
 *                     "integer" (or, since PHP 4.2.0, "int")
 *                     </li>
 *                     <li>
 *                     "float" (only possible since PHP 4.2.0, for older versions use the
 *                     deprecated variant "double")
 *                     </li>
 *                     <li>
 *                     "string"
 *                     </li>
 *                     <li>
 *                     "array"
 *                     </li>
 *                     <li>
 *                     "object"
 *                     </li>
 *                     <li>
 *                     "null" (since PHP 4.2.0)
 *                     </li>
 *                     </ul>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function settype(&$var, $type) { }

/**
 * Get string value of a variable
 *
 * @link  http://php.net/manual/en/function.strval.php
 *
 * @param mixed $var <p>
 *                   The variable that is being converted to a string.
 *                   </p>
 *                   <p>
 *                   $var may be any scalar type or an object that implements the __toString() method.
 *                   You cannot use strval() on arrays or objects that do not implement the __toString() method.
 *                   </p>
 *
 * @return string The string value of var.
 * @since 4.0
 * @since 5.0
 */
function strval($var) { }

/**
 * Creates a PHP value from a stored representation
 *
 * @link  http://php.net/manual/en/function.unserialize.php
 *
 * @param string $str     <p>
 *                        The serialized string.
 *                        </p>
 *                        <p>
 *                        If the variable being unserialized is an object, after successfully
 *                        reconstructing the object PHP will automatically attempt to call the
 *                        __wakeup member function (if it exists).
 *                        </p>
 *                        <p>
 *                        unserialize_callback_func directive
 *                        <p>
 *                        It's possible to set a callback-function which will be called,
 *                        if an undefined class should be instantiated during unserializing.
 *                        (to prevent getting an incomplete object "__PHP_Incomplete_Class".)
 *                        Use your &php.ini;, ini_set or &htaccess;
 *                        to define 'unserialize_callback_func'. Everytime an undefined class
 *                        should be instantiated, it'll be called. To disable this feature just
 *                        empty this setting.
 *                        </p>
 * @param mixed  $options [optional]
 *                        <p>Any options to be provided to unserialize(), as an associative array.</p>
 *                        <p>
 *                        Either an array of class names which should be accepted, FALSE to
 *                        accept no classes, or TRUE to accept all classes. If this option is defined
 *                        and unserialize() encounters an object of a class that isn't to be accepted,
 *                        then the object will be instantiated as __PHP_Incomplete_Class instead.
 *                        Omitting this option is the same as defining it as TRUE: PHP will attempt
 *                        to instantiate objects of any class.
 *                        </p>
 *
 * @return mixed The converted value is returned, and can be a boolean,
 * integer, float, string,
 * array or object.
 * </p>
 * <p>
 * In case the passed string is not unserializeable, false is returned and
 * E_NOTICE is issued.
 * @since 4.0
 * @since 5.0
 * @since 7.0
 */
function unserialize($str, array $options = null) { }

/**
 * <p>Destroys the specified variables.</p>
 * <p>The behavior of <b>unset()</b> inside of a function can vary depending on what type of variable you are
 * attempting to destroy.</p>
 *
 * @link http://php.net/manual/en/function.unset.php
 *
 * @param mixed $var <p>The variable to be unset.</p>
 * @param mixed $_   [optional] <p>Another variable ...</p>
 *
 * @return void
 */
function PS_UNRESERVE_PREFIX_unset($var, ...$_) { }

/**
 * Dumps information about a variable
 *
 * @link  http://php.net/manual/en/function.var-dump.php
 *
 * @param mixed $expression <p>
 *                          The variable you want to export.
 *                          </p>
 * @param mixed $_          [optional]
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function var_dump($expression, $_ = null) { }

/**
 * Outputs or returns a parsable string representation of a variable
 *
 * @link  http://php.net/manual/en/function.var-export.php
 *
 * @param mixed $expression <p>
 *                          The variable you want to export.
 *                          </p>
 * @param bool  $return     [optional] <p>
 *                          If used and set to true, var_export will return
 *                          the variable representation instead of outputing it.
 *                          </p>
 *                          &note.uses-ob;
 *
 * @return mixed the variable representation when the return
 * parameter is used and evaluates to true. Otherwise, this function will
 * return &null;.
 * @since 4.2.0
 * @since 5.0
 */
function var_export($expression, $return = null) { }
