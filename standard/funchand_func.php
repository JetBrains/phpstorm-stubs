<?php
/**
 * PHPStorm stub file for Function Handling functions.
 *
 * @link http://php.net/manual/en/book.funchand.php
 */

/**
 * Call a user function given by the first parameter
 *
 * @link  http://php.net/manual/en/function.call-user-func.php
 *
 * @param callback $function  <p>
 *                            The function to be called. Class methods may also be invoked
 *                            statically using this function by passing
 *                            array($classname, $methodname) to this parameter.
 *                            Additionally class methods of an object instance may be called by passing
 *                            array($objectinstance, $methodname) to this parameter.
 *                            </p>
 * @param mixed    $parameter [optional] <p>
 *                            Zero or more parameters to be passed to the function.
 *                            </p>
 *                            <p>
 *                            Note that the parameters for call_user_func are
 *                            not passed by reference.
 *                            call_user_func example and references
 *                            ]]>
 *                            &example.outputs;
 *                            </p>
 * @param mixed    $_         [optional]
 *
 * @return mixed the function result, or false on error.
 * @since 4.0
 * @since 5.0
 */
function call_user_func($function, $parameter = null, $_ = null) { }

/**
 * Call a user function given with an array of parameters
 *
 * @link  http://php.net/manual/en/function.call-user-func-array.php
 *
 * @param callback $function  <p>
 *                            The function to be called.
 *                            </p>
 * @param array    $param_arr <p>
 *                            The parameters to be passed to the function, as an indexed array.
 *                            </p>
 *
 * @return mixed the function result, or false on error.
 * @since 4.0.4
 * @since 5.0
 */
function call_user_func_array($function, array $param_arr) { }

/**
 * Create an anonymous (lambda-style) function
 *
 * @link  http://php.net/manual/en/function.create-function.php
 *
 * @param string $args <p>
 *                     The function arguments.
 *                     </p>
 * @param string $code <p>
 *                     The function code.
 *                     </p>
 *
 * @return string a unique function name as a string, or false on error.
 * @since 4.0.1
 * @since 5.0
 */
function create_function($args, $code) { }

/**
 * Call a static method
 *
 * @link  http://php.net/manual/en/function.forward-static-call.php
 *
 * @param callback $function  <p>
 *                            The function or method to be called. This parameter may be an array,
 *                            with the name of the class, and the method, or a string, with a function
 *                            name.
 *                            </p>
 * @param mixed    $parameter [optional] <p>
 *                            Zero or more parameters to be passed to the function.
 *                            </p>
 * @param mixed    $_         [optional]
 *
 * @return mixed the function result, or false on error.
 * @since 5.3.0
 */
function forward_static_call($function, $parameter = null, $_ = null) { }

/**
 * Call a static method and pass the arguments as array
 *
 * @link  http://php.net/manual/en/function.forward-static-call-array.php
 *
 * @param callback $function   <p>
 *                             The function or method to be called. This parameter may be an &array;,
 *                             with the name of the class, and the method, or a &string;, with a function
 *                             name.
 *                             </p>
 * @param array    $parameters [optional]
 *
 * @return mixed the function result, or false on error.
 * @since 5.3.0
 */
function forward_static_call_array($function, array $parameters = null) { }

/**
 * Return an item from the argument list
 *
 * @link  http://php.net/manual/en/function.func-get-arg.php
 *
 * @param int $arg_num <p>
 *                     The argument offset. Function arguments are counted starting from
 *                     zero.
 *                     </p>
 *
 * @return mixed the specified argument, or false on error.
 * @since 4.0
 * @since 5.0
 */
function func_get_arg($arg_num) { }

/**
 * Returns an array comprising a function's argument list
 *
 * @link  http://php.net/manual/en/function.func-get-args.php
 * @return array an array in which each element is a copy of the corresponding
 * member of the current user-defined function's argument list.
 * @since 4.0
 * @since 5.0
 */
function func_get_args() { }

/**
 * Returns the number of arguments passed to the function
 *
 * @link  http://php.net/manual/en/function.func-num-args.php
 * @return int the number of arguments passed into the current user-defined
 * function.
 * @since 4.0
 * @since 5.0
 */
function func_num_args() { }

/**
 * Return true if the given function has been defined
 *
 * @link  http://php.net/manual/en/function.function-exists.php
 *
 * @param string $function_name <p>
 *                              The function name, as a string.
 *                              </p>
 *
 * @return bool true if <i>function_name</i> exists and is a
 * function, false otherwise.
 * </p>
 * <p>
 * This function will return false for constructs, such as
 * <b>include_once</b> and <b>echo</b>.
 * @since 4.0
 * @since 5.0
 */
function function_exists($function_name) { }

/**
 * Returns an array of all defined functions
 *
 * @link  http://php.net/manual/en/function.get-defined-functions.php
 * @return array an multidimensional array containing a list of all defined
 * functions, both built-in (internal) and user-defined. The internal
 * functions will be accessible via $arr["internal"], and
 * the user defined ones using $arr["user"] (see example
 * below).
 * @since 4.0.4
 * @since 5.0
 */
function get_defined_functions() { }

/**
 * Register a function for execution on shutdown
 *
 * @link  http://php.net/manual/en/function.register-shutdown-function.php
 *
 * @param callback $function  <p>
 *                            The shutdown function to register.
 *                            </p>
 *                            <p>
 *                            The shutdown functions are called as the part of the request so that
 *                            it's possible to send the output from them. There is currently no way
 *                            to process the data with output buffering functions in the shutdown
 *                            function.
 *                            </p>
 *                            <p>
 *                            Shutdown functions are called after closing all opened output buffers
 *                            thus, for example, its output will not be compressed if zlib.output_compression is
 *                            enabled.
 *                            </p>
 * @param mixed    $parameter [optional] <p>
 *                            It is possible to pass parameters to the shutdown function by passing
 *                            additional parameters.
 *                            </p>
 * @param mixed    $_         [optional]
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function register_shutdown_function($function, $parameter = null, $_ = null) { }

/**
 * Register a function for execution on each tick
 *
 * @link  http://php.net/manual/en/function.register-tick-function.php
 *
 * @param callback $function <p>
 *                           The function name as a string, or an array consisting of an object and
 *                           a method.
 *                           </p>
 * @param mixed    $arg      [optional] <p>
 *                           </p>
 * @param mixed    $_        [optional]
 *
 * @return bool true on success or false on failure.
 * @since 4.0.3
 * @since 5.0
 */
function register_tick_function($function, $arg = null, $_ = null) { }

/**
 * De-register a function for execution on each tick
 *
 * @link  http://php.net/manual/en/function.unregister-tick-function.php
 *
 * @param string $function_name <p>
 *                              The function name, as a string.
 *                              </p>
 *
 * @return void
 * @since 4.0.3
 * @since 5.0
 */
function unregister_tick_function($function_name) { }
