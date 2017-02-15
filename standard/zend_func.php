<?php
/**
 * PHPStorm stub file for Zend functions.
 */

/**
 * Disable/enable the Code Acceleration functionality at run time.
 *
 * @param $status bool If false, Acceleration is disabled, if true - enabled
 *
 * @return void
 */
function accelerator_set_status($status) { }

/**
 * Create Java object
 *
 * @return object
 *
 * @param string $class
 *
 * @vararg ...
 */
function java($class) { }

/**
 * Clear last Java exception object record.
 *
 * @return void
 */
function java_last_exception_clear() { }

/**
 * Return Java exception object for last exception
 *
 * @return object Java Exception object, if there was an exception, false otherwise
 */
function java_last_exception_get() { }

/**
 * Reload Jar's that were dynamically loaded
 *
 * @return array
 *
 * @param string $new_jarpath
 */
function java_reload($new_jarpath) { }

/**
 * Add to Java's classpath in runtime
 *
 * @return array
 *
 * @param string $new_classpath string
 */
function java_require($new_classpath) { }

/**
 * Set encoding for strings received by Java from PHP. Default is UTF-8.
 *
 * @param string $encoding string
 *
 * @return array
 */
function java_set_encoding($encoding) { }

/**
 * Set case sensitivity for Java calls.
 *
 * @param bool $ignore if set, Java attribute and method names would be resolved disregarding case.
 *                     NOTE:
 *                     this does not make any Java functions case insensi tive, just things like $foo->bar
 *                     and $foo->bar() would match Bar too.
 *
 * @return void
 */
function java_set_ignore_case($ignore) { }

/**
 * Control if exceptions are thrown on Java exception. Only for PHP5.
 *
 * @param bool $throw If true, PHP exception is thrown when Java exception happens. If set to false, use
 *                    java_last_exception_get() to check for exception.
 *
 * @return void
 */
function java_throw_exceptions($throw) { }

/**
 * @returns array containing following fields:
 * "license_ok" - whether license allows use of JobQueue
 * "expires" - license expiration date
 */
function jobqueue_license_info() { }

/**
 * Creates a custom event with class $class, text $text and possibly severity and other user data
 *
 * @param string   $class     string
 * @param string   $text      string
 * @param int|null $severe    int[optional]
 * @param mixed    $user_data mixed[optional]
 *
 * @return void
 */
function monitor_custom_event($class, $text, $severe = null, $user_data = null) { }

/**
 * Create an HTTPERROR event
 *
 * @param int      $error_code int the http error code to be associated with this event
 * @param string   $url        string the URL to be associated with this event
 * @param int|null $severe     int[optional] the severety of the event: 0 - not severe, 1 - severe
 *
 * @return void
 */
function monitor_httperror_event($error_code, $url, $severe = null) { }

/**
 * Returns an array containing information about
 * <li>module loading status (and cause of error if module failed to load)
 * <li>module license status (and cause of error if license not valid)
 *
 * @return array
 */
function monitor_license_info() { }

/**
 * Should be called from a custom error handler to pass the error to the monitor.
 * The user function needs to accept two parameters: the error code, and a string describing the error.
 * Then there are two optional parameters that may be supplied: the filename in which the error occurred
 * and the line number  in which the error occurred.
 *
 * @param int    $errno   int
 * @param string $errstr  string
 * @param string $errfile string
 * @param int    $errline integer
 *
 * @return void
 */
function monitor_pass_error($errno, $errstr, $errfile, $errline) { }

/**
 * Limited in the database to 255 chars
 *
 * @param string $hint string
 *
 * @return void
 */
function monitor_set_aggregation_hint($hint) { }

/**
 * Disables output caching for currently running scripts.
 *
 * @return void
 */
function output_cache_disable() { }

/**
 * Does not allow the cache to perform compression on the output of the current page.
 * This output will not be compressed, even if the global set tings would normally allow
 * compression on files of this type.
 *
 * @return void
 */
function output_cache_disable_compression() { }

/**
 * If data for assigned key exists, this function outputs it and returns a value of true.
 * If not, it starts capturing the output. To be used in pair with output_cache_stop.
 *
 * @param string $key      string cache key
 * @param int    $lifetime int cache validity time (seconds)
 *
 * @return bool true if cached data exists
 */
function output_cache_exists($key, $lifetime) { }

/**
 * Gets the code’s return value from the cache if it is there, if not - run function and cache the value.
 *
 * @param string $key      string cache key
 * @param string $function string PHP expression
 * @param int    $lifetime int data lifetime in cache (seconds)
 *
 * @return string function's return
 */
function output_cache_fetch($key, $function, $lifetime) { }

/**
 * Gets cached data according to the assigned key.
 *
 * @param string $key      string cache key
 * @param int    $lifetime int cache validity time (seconds)
 *
 * @return mixed cached data if cache exists, false otherwise
 */
function output_cache_get($key, $lifetime) { }

/**
 * If they cache for the key exists, output it, otherwise capture expression output, cache and pass it out.
 *
 * @param string $key      string cache key
 * @param string $function string PHP expression
 * @param int    $lifetime int data lifetime in cache (seconds)
 *
 * @return mixed expression output
 */
function output_cache_output($key, $function, $lifetime) { }

/**
 * Puts data in cache according to the assigned key.
 *
 * @param string $key  string cache key
 * @param mixed  $data mixed cached data (must not contain objects or resources)
 *
 * @return bool true if OK
 */
function output_cache_put($key, $data) { }

/**
 * Removes all the cache data for the given filename.
 *
 * @param string $filename string full script path on local filesystem
 *
 * @return bool true if OK, false if something went wrong
 */
function output_cache_remove($filename) { }

/**
 * Remove item from PHP API cache by key
 *
 * @param string $key string cache key as given to output_cache_get/output_cache_put
 *
 * @return bool true if OK
 */
function output_cache_remove_key($key) { }

/**
 * Remove cache data for the script with given URL (all dependent data is removed)
 *
 * @param string $url string the local url for the script
 *
 * @return bool true if OK
 */
function output_cache_remove_url($url) { }

/**
 * If output was captured by output_cache_exists, this function stops the output capture and stores
 * the data under the key that was given to output_cache_exists().
 *
 * @return void
 */
function output_cache_stop() { }

/**
 * Allow you to register a user function as an event handler.When a monitor event is triggered
 * all the user event handlers are called and the return value from the handler is saved in
 * an array keyed by the name the event handler was registered under. The event handlers
 * results array is saved in the event_extra_data table.
 *
 * @param callable $event_handler_func
 *                        string The
 * @param string   $handler_register_name
 *                        string[optional] The
 * @param int      $event_type_mask
 *
 * @return bool TRUE on sucess and FALSE if an error occurs.
 */
function register_event_handler($event_handler_func, $handler_register_name, $event_type_mask) { }

/**
 * causes a job to fail logically
 * can be used to indicate an error in the script logic (e.g. database connection problem)
 *
 * @param string $error_string the error string to display
 */
function set_job_failed($error_string) { }

/**
 * Allow you to unregister an event handler.
 *
 * @param string $handler_name string the name you registered with the handler you now wish to unregister.
 *
 * @return bool TRUE on success and FALSE if no handler we registered under the given name.
 */
function unregister_event_handler($handler_name) { }

/**
 * Returns the current obfuscation level support (set by zend_optimizer.obfuscation_level_support)
 *
 * @return int
 */
function zend_current_obfuscation_level() { }

/**
 * Returns array of the host ids. If all_ids is true, then all IDs are returned, otehrwise only IDs considered
 * "primary" are returned.
 *
 * @param bool $all_ids bool[optional]
 *
 * @return array
 */
function zend_get_id($all_ids = false) { }

/**
 * Returns the name of the file currently being executed.
 *
 * @return string
 */
function zend_loader_current_file() { }

/**
 * Shown if loader is enabled
 *
 * @return bool
 */
function zend_loader_enabled() { }

/**
 * Returns true if the current file is a Zend-encoded file.
 *
 * @return bool
 */
function zend_loader_file_encoded() { }

/**
 * Returns license (array with fields) if the current file has a valid license and is encoded, otherwise it returns
 * false.
 *
 * @return array
 */
function zend_loader_file_licensed() { }

/**
 * Dynamically loads a license for applications encoded with Zend SafeGuard. The Override controls if it will
 * override old licenses for the same product.
 *
 * @param string $license_file string
 * @param bool   $override     bool[optional]
 *
 * @return bool
 */
function zend_loader_install_license($license_file, $override) { }

/**
 * Obfuscate and return the given class name with the internal obfuscation function.
 *
 * @param string $class_name string
 *
 * @return string
 */
function zend_obfuscate_class_name($class_name) { }

/**
 * Obfuscate and return the given function name with the internal obfuscation function.
 *
 * @param string $function_name string
 *
 * @return string
 */
function zend_obfuscate_function_name($function_name) { }

/**
 * Returns Optimizer version. Alias: zend_loader_version()
 *
 * @return string
 */
function zend_optimizer_version() { }

/**
 * Start runtime-obfuscation support that allows limited mixing of obfuscated and un-obfuscated code.
 *
 * @return void
 */
function zend_runtime_obfuscate() { }

/**
 * Send a buffer using ZDS
 *
 * @param string $buffer         string the content that will be send
 * @param string $mime_type      [optional] MIME type of the buffer, if omitted, taken from configured MIME types file.
 * @param string $custom_headers [optional] user defined headers that will be send instead of regular ZDS headers. few
 *                               basic essential headers will be send anyway
 *
 * @return bool FALSE if sending file failed, does not return otherwise
 */
function zend_send_buffer($buffer, $mime_type, $custom_headers) { }

/**
 * Send a file using ZDS
 *
 * @param string $filename path to the file
 * @param string $mime_type [optional] MIME type of the file, if omitted, taken from configured MIME types file.
 * @param string $custom_headers [optional] user defined headers that will be send instead of regular ZDS headers. few
 *               basic essential headers will be send anyway.
 *
 * @return bool FALSE if sending file failed, does not return otherwise
 */
function zend_send_file($filename, $mime_type, $custom_headers) { }
