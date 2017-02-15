<?php
/**
 * PHPStorm stub file for PHP Options and Information functions.
 *
 * @link http://php.net/manual/en/book.info.php
 */

/**
 * Checks if assertion is &false;
 *
 * @link  http://php.net/manual/en/function.assert.php
 *
 * @param mixed  $assertion   <p>
 *                            The assertion.
 *                            </p>
 * @param string $description [optional]
 *                            <p>An optional description that will be included in the failure message if the
 *                            assertion fails.</p>
 *
 * @return bool false if the assertion is false, true otherwise.
 * @since 4.0
 * @since 5.0
 */
function assert($assertion, $description) { }

/**
 * Set/get the various assert flags
 *
 * @link  http://php.net/manual/en/function.assert-options.php
 *
 * @param int   $what  <p>
 *                     <table>
 *                     Assert Options
 *                     <tr valign="top">
 *                     <td>Option</td>
 *                     <td>INI Setting</td>
 *                     <td>Default value</td>
 *                     <td>Description</td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>ASSERT_ACTIVE</td>
 *                     <td>assert.active</td>
 *                     <td>1</td>
 *                     <td>enable assert evaluation</td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>ASSERT_WARNING</td>
 *                     <td>assert.warning</td>
 *                     <td>1</td>
 *                     <td>issue a PHP warning for each failed assertion</td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>ASSERT_BAIL</td>
 *                     <td>assert.bail</td>
 *                     <td>0</td>
 *                     <td>terminate execution on failed assertions</td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>ASSERT_QUIET_EVAL</td>
 *                     <td>assert.quiet_eval</td>
 *                     <td>0</td>
 *                     <td>
 *                     disable error_reporting during assertion expression
 *                     evaluation
 *                     </td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>ASSERT_CALLBACK</td>
 *                     <td>assert.callback</td>
 *                     <td)<&null;)</td>
 *                     <td>Callback to call on failed assertions</td>
 *                     </tr>
 *                     </table>
 *                     </p>
 * @param mixed $value [optional] <p>
 *                     An optional new value for the option.
 *                     </p>
 *
 * @return mixed the original setting of any option or false on errors.
 * @since 4.0
 * @since 5.0
 */
function assert_options($what, $value = null) { }

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Returns the current process title
 *
 * @link http://www.php.net/manual/en/function.cli-get-process-title.php
 * @return string
 */
function cli_get_process_title() { }

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Sets the process title
 *
 * @param string $title <p>The new title</p>
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function cli_set_process_title($title) { }

/**
 * Loads a PHP extension at runtime
 *
 * @link       http://php.net/manual/en/function.dl.php
 *
 * @param string $library <p>
 *                        This parameter is only the filename of the
 *                        extension to load which also depends on your platform. For example,
 *                        the sockets extension (if compiled
 *                        as a shared module, not the default!) would be called
 *                        sockets.so on Unix platforms whereas it is called
 *                        php_sockets.dll on the Windows platform.
 *                        </p>
 *                        <p>
 *                        The directory where the extension is loaded from depends on your
 *                        platform:
 *                        </p>
 *                        <p>
 *                        Windows - If not explicitly set in the <i>php.ini</i>, the extension is
 *                        loaded from C:\php4\extensions\ (PHP 4) or
 *                        C:\php5\ (PHP 5) by default.
 *                        </p>
 *                        <p>
 *                        Unix - If not explicitly set in the <i>php.ini</i>, the default extension
 *                        directory depends on
 *                        whether PHP has been built with --enable-debug
 *                        or not
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure. If the functionality of loading modules is not
 *              available or has been disabled (either by setting enable_dl off or by enabling safe mode in
 *              <i>php.ini</i>) an <b>E_ERROR</b> is emitted and execution is stopped. If <b>dl</b> fails because
 *              the specified library couldn't be loaded, in addition to <b>FALSE</b> an
 * <b>E_WARNING</b> message is emitted.
 * @since      4.0
 * @since      5.0
 * @deprecated 5.3.0
 */
function dl($library) { }

/**
 * Find out whether an extension is loaded
 *
 * @link  http://php.net/manual/en/function.extension-loaded.php
 *
 * @param string $name <p>
 *                     The extension name.
 *                     </p>
 *                     <p>
 *                     You can see the names of various extensions by using
 *                     <b>phpinfo</b> or if you're using the
 *                     CGI or CLI version of
 *                     PHP you can use the -m switch to
 *                     list all available extensions:
 *                     <pre>
 *                     $ php -m
 *                     [PHP Modules]
 *                     xml
 *                     tokenizer
 *                     standard
 *                     sockets
 *                     session
 *                     posix
 *                     pcre
 *                     overload
 *                     mysql
 *                     mbstring
 *                     ctype
 *                     [Zend Modules]
 *                     </pre>
 *                     </p>
 *
 * @return bool true if the extension identified by <i>name</i>
 * is loaded, false otherwise.
 * @since 4.0
 * @since 5.0
 */
function extension_loaded($name) { }

/**
 * Forces collection of any existing garbage cycles
 *
 * @link  http://php.net/manual/en/function.gc-collect-cycles.php
 * @return int number of collected cycles.
 * @since 5.3.0
 */
function gc_collect_cycles() { }

/**
 * Deactivates the circular reference collector
 *
 * @link  http://php.net/manual/en/function.gc-disable.php
 * @return void
 * @since 5.3.0
 */
function gc_disable() { }

/**
 * Activates the circular reference collector
 *
 * @link  http://php.net/manual/en/function.gc-enable.php
 * @return void
 * @since 5.3.0
 */
function gc_enable() { }

/**
 * Returns status of the circular reference collector
 *
 * @link  http://php.net/manual/en/function.gc-enabled.php
 * @return bool true if the garbage collector is enabled, false otherwise.
 * @since 5.3.0
 */
function gc_enabled() { }

/**
 * Reclaims memory used by the Zend Engine memory manager
 *
 * @link  http://php.net/manual/en/function.gc-mem-caches.php
 * @return int Returns the number of bytes freed.
 * @since 7.0
 */
function gc_mem_caches() { }

/**
 * Gets the value of a PHP configuration option
 *
 * @link  http://php.net/manual/en/function.get-cfg-var.php
 *
 * @param string $option <p>
 *                       The configuration option name.
 *                       </p>
 *
 * @return string the current value of the PHP configuration variable specified by
 * option, or false if an error occurs.
 * @since 4.0
 * @since 5.0
 */
function get_cfg_var($option) { }

/**
 * Gets the name of the owner of the current PHP script
 *
 * @link  http://php.net/manual/en/function.get-current-user.php
 * @return string the username as a string.
 * @since 4.0
 * @since 5.0
 */
function get_current_user() { }

/**
 * Returns an associative array with the names of all the constants and their values
 *
 * @link  http://php.net/manual/en/function.get-defined-constants.php
 *
 * @param bool $categorize [optional] <p>
 *                         Causing this function to return a multi-dimensional
 *                         array with categories in the keys of the first dimension and constants
 *                         and their values in the second dimension.
 *                         <code>
 *                         define("MY_CONSTANT", 1);
 *                         print_r(get_defined_constants(true));
 *                         </code>
 *                         The above example will output something similar to:
 *                         <pre>
 *                         Array
 *                         (
 *                         [Core] => Array
 *                         (
 *                         [E_ERROR] => 1
 *                         [E_WARNING] => 2
 *                         [E_PARSE] => 4
 *                         [E_NOTICE] => 8
 *                         [E_CORE_ERROR] => 16
 *                         [E_CORE_WARNING] => 32
 *                         [E_COMPILE_ERROR] => 64
 *                         [E_COMPILE_WARNING] => 128
 *                         [E_USER_ERROR] => 256
 *                         [E_USER_WARNING] => 512
 *                         [E_USER_NOTICE] => 1024
 *                         [E_ALL] => 2047
 *                         [TRUE] => 1
 *                         )
 *                         [pcre] => Array
 *                         (
 *                         [PREG_PATTERN_ORDER] => 1
 *                         [PREG_SET_ORDER] => 2
 *                         [PREG_OFFSET_CAPTURE] => 256
 *                         [PREG_SPLIT_NO_EMPTY] => 1
 *                         [PREG_SPLIT_DELIM_CAPTURE] => 2
 *                         [PREG_SPLIT_OFFSET_CAPTURE] => 4
 *                         [PREG_GREP_INVERT] => 1
 *                         )
 *                         [user] => Array
 *                         (
 *                         [MY_CONSTANT] => 1
 *                         )
 *                         )
 *                         </pre>
 *                         </p>
 *
 * @return array
 * @since 4.1.0
 * @since 5.0
 */
function get_defined_constants($categorize = false) { }

/**
 * Returns an array with the names of the functions of a module
 *
 * @link  http://php.net/manual/en/function.get-extension-funcs.php
 *
 * @param string $module_name <p>
 *                            The module name.
 *                            </p>
 *                            <p>
 *                            This parameter must be in lowercase.
 *                            </p>
 *
 * @return array an array with all the functions, or false if
 * <i>module_name</i> is not a valid extension.
 * @since 4.0
 * @since 5.0
 */
function get_extension_funcs($module_name) { }

/**
 * Gets the current include_path configuration option
 *
 * @link  http://php.net/manual/en/function.get-include-path.php
 * @return string the path, as a string.
 * @since 4.3.0
 * @since 5.0
 */
function get_include_path() { }

/**
 * Returns an array with the names of included or required files
 *
 * @link  http://php.net/manual/en/function.get-included-files.php
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
function get_included_files() { }

/**
 * Returns an array with the names of all modules compiled and loaded
 *
 * @link  http://php.net/manual/en/function.get-loaded-extensions.php
 *
 * @param bool $zend_extensions [optional] <p>
 *                              Only return Zend extensions, if not then regular extensions, like
 *                              mysqli are listed. Defaults to false (return regular extensions).
 *                              </p>
 *
 * @return array an indexed array of all the modules names.
 * @since 4.0
 * @since 5.0
 */
function get_loaded_extensions($zend_extensions = false) { }

/**
 * Gets the current configuration setting of magic quotes gpc
 *
 * @link  http://php.net/manual/en/function.get-magic-quotes-gpc.php
 * @return int 0 if magic quotes gpc are off, 1 otherwise.
 * @since 4.0
 * @since 5.0
 */
function get_magic_quotes_gpc() { }

/**
 * Gets the current active configuration setting of magic_quotes_runtime
 *
 * @link  http://php.net/manual/en/function.get-magic-quotes-runtime.php
 * @return int 0 if magic quotes runtime is off, 1 otherwise.
 * @since 4.0
 * @since 5.0
 */
function get_magic_quotes_runtime() { }

/**
 * Alias of <b>get_included_files</b>
 *
 * @link  http://php.net/manual/en/function.get-required-files.php
 * @return string[]
 * @since 4.0
 * @since 5.0
 */
function get_required_files() { }

/**
 * Returns active resources
 *
 * @link  http://php.net/manual/en/function.get-resources.php
 *
 * @param string $type [optional]<p>
 *
 * If defined, this will cause get_resources() to only return resources of the given type. A list of resource types
 * is available.
 *
 * If the string Unknown is provided as the type, then only resources that are of an unknown type will be returned.
 *
 * If omitted, all resources will be returned.
 * </p>
 *
 * @return array Returns an array of currently active resources, indexed by resource number.
 * @since 7.0
 */
function get_resources($type) { }

/**
 * Gets the value of an environment variable
 *
 * @link  http://php.net/manual/en/function.getenv.php
 *
 * @param string $varname [optional] <p>
 *                        The variable name.
 *                        </p>
 *
 * @return string|array|false the value of the environment variable
 * varname or array with all environment variables if no variable name
 * provided, or false on an error.
 * @since 4.0
 * @since 5.0
 * @since 7.1
 */
function getenv($varname = null) { }

/**
 * Gets time of last page modification
 *
 * @link  http://php.net/manual/en/function.getlastmod.php
 * @return int the time of the last modification of the current
 * page. The value returned is a Unix timestamp, suitable for
 * feeding to date. Returns false on error.
 * @since 4.0
 * @since 5.0
 */
function getlastmod() { }

/**
 * Get PHP script owner's GID
 *
 * @link  http://php.net/manual/en/function.getmygid.php
 * @return int the group ID of the current script, or false on error.
 * @since 4.1.0
 * @since 5.0
 */
function getmygid() { }

/**
 * Gets the inode of the current script
 *
 * @link  http://php.net/manual/en/function.getmyinode.php
 * @return int the current script's inode as an integer, or false on error.
 * @since 4.0
 * @since 5.0
 */
function getmyinode() { }

/**
 * Gets PHP's process ID
 *
 * @link  http://php.net/manual/en/function.getmypid.php
 * @return int the current PHP process ID, or false on error.
 * @since 4.0
 * @since 5.0
 */
function getmypid() { }

/**
 * Gets PHP script owner's UID
 *
 * @link  http://php.net/manual/en/function.getmyuid.php
 * @return int the user ID of the current script, or false on error.
 * @since 4.0
 * @since 5.0
 */
function getmyuid() { }

/**
 * Gets options from the command line argument list
 *
 * @link  http://php.net/manual/en/function.getopt.php
 *
 * @param string $options  Each character in this string will be used as option characters and
 *                         matched against options passed to the script starting with a single
 *                         hyphen (-).
 *                         For example, an option string "x" recognizes an
 *                         option -x.
 *                         Only a-z, A-Z and 0-9 are allowed.
 * @param array  $longopts [optional] An array of options. Each element in this array will be used as option
 *                         strings and matched against options passed to the script starting with
 *                         two hyphens (--).
 *                         For example, an longopts element "opt" recognizes an
 *                         option --opt.
 *                         Prior to PHP5.3.0 this parameter was only available on few systems
 * @param int    $optind   If the optind parameter is present, then the index where argument parsing stopped will
 *                         be written to this variable.
 *
 * @return array This function will return an array of option / argument pairs or false on
 * failure.
 * @since 4.3.0
 * @since 5.0
 */
function getopt($options, array $longopts = [], &$optind = null) { }

/**
 * Gets the current resource usages
 *
 * @link  http://php.net/manual/en/function.getrusage.php
 *
 * @param int $who [optional] <p>
 *                 If who is 1, getrusage will be called with
 *                 RUSAGE_CHILDREN.
 *                 </p>
 *
 * @return array an associative array containing the data returned from the system
 * call. All entries are accessible by using their documented field names.
 * @since 4.0
 * @since 5.0
 */
function getrusage($who = null) { }

/**
 * &Alias; <function>ini_set</function>
 *
 * @link  http://php.net/manual/en/function.ini-alter.php
 *
 * @param $varname
 * @param $newvalue
 *
 * @since 4.0
 * @since 5.0
 */
function ini_alter($varname, $newvalue) { }

/**
 * Gets the value of a configuration option
 *
 * @link  http://php.net/manual/en/function.ini-get.php
 *
 * @param string $varname <p>
 *                        The configuration option name.
 *                        </p>
 *
 * @return string the value of the configuration option as a string on success, or
 * an empty string on failure or for null values.
 * @since 4.0
 * @since 5.0
 */
function ini_get($varname) { }

/**
 * Gets all configuration options
 *
 * @link  http://php.net/manual/en/function.ini-get-all.php
 *
 * @param string $extension [optional] <p>
 *                          An optional extension name. If set, the function return only options
 *                          specific for that extension.
 *                          </p>
 * @param bool   $details   [optional] <p>
 *                          Retrieve details settings or only the current value for each setting.
 *                          Default is true (retrieve details).
 *                          </p>
 *
 * @return array an associative array with directive name as the array key.
 * </p>
 * <p>
 * When details is true (default) the array will
 * contain global_value (set in
 * &php.ini;), local_value (perhaps set with
 * ini_set or &htaccess;), and
 * access (the access level).
 * </p>
 * <p>
 * When details is false the value will be the
 * current value of the option.
 * </p>
 * <p>
 * See the manual section
 * for information on what access levels mean.
 * </p>
 * <p>
 * It's possible for a directive to have multiple access levels, which is
 * why access shows the appropriate bitmask values.
 * @since 4.2.0
 * @since 5.0
 */
function ini_get_all($extension = null, $details = null) { }

/**
 * Restores the value of a configuration option
 *
 * @link  http://php.net/manual/en/function.ini-restore.php
 *
 * @param string $varname <p>
 *                        The configuration option name.
 *                        </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function ini_restore($varname) { }

/**
 * Sets the value of a configuration option
 *
 * @link  http://php.net/manual/en/function.ini-set.php
 *
 * @param string $varname  <p>
 *                         </p>
 *                         <p>
 *                         Not all the available options can be changed using
 *                         ini_set. There is a list of all available options
 *                         in the appendix.
 *                         </p>
 * @param string $newvalue <p>
 *                         The new value for the option.
 *                         </p>
 *
 * @return string|false the old value on success, false on failure.
 * @since 4.0
 * @since 5.0
 */
function ini_set($varname, $newvalue) { }

/**
 * &Alias; <function>set_magic_quotes_runtime</function>
 *
 * @link       http://php.net/manual/en/function.magic-quotes-runtime.php
 * @deprecated 5.3.0
 *
 * @param $new_setting
 *
 * @since      4.0
 * @since      5.0
 */
function magic_quotes_runtime($new_setting) { }

/**
 * Returns the peak of memory allocated by PHP
 *
 * @link  http://php.net/manual/en/function.memory-get-peak-usage.php
 *
 * @param bool $real_usage [optional] <p>
 *                         Set this to true to get the real size of memory allocated from
 *                         system. If not set or false only the memory used by
 *                         emalloc() is reported.
 *                         </p>
 *
 * @return int the memory peak in bytes.
 * @since 5.2.0
 */
function memory_get_peak_usage($real_usage = null) { }

/**
 * Returns the amount of memory allocated to PHP
 *
 * @link  http://php.net/manual/en/function.memory-get-usage.php
 *
 * @param bool $real_usage [optional] <p>
 *                         Set this to true to get the real size of memory allocated from
 *                         system. If not set or false only the memory used by
 *                         emalloc() is reported.
 *                         </p>
 *
 * @return int the memory amount in bytes.
 * @since 4.3.2
 * @since 5.0
 */
function memory_get_usage($real_usage = null) { }

/**
 * Retrieve a path to the loaded php.ini file
 *
 * @link  http://php.net/manual/en/function.php-ini-loaded-file.php
 * @return string The loaded &php.ini; path, or false if one is not loaded.
 * @since 5.2.4
 */
function php_ini_loaded_file() { }

/**
 * Return a list of .ini files parsed from the additional ini dir
 *
 * @link  http://php.net/manual/en/function.php-ini-scanned-files.php
 * @return string a comma-separated string of .ini files on success. Each comma is
 * followed by a newline. If the directive --with-config-file-scan-dir wasn't set,
 * false is returned. If it was set and the directory was empty, an
 * empty string is returned. If a file is unrecognizable, the file will
 * still make it into the returned string but a PHP error will also result.
 * This PHP error will be seen both at compile time and while using
 * php_ini_scanned_files.
 * @since 4.3.0
 * @since 5.0
 */
function php_ini_scanned_files() { }

/**
 * @deprecated 5.5 Removed in PHP 5.5
 * Gets the logo guid
 * @link       http://php.net/manual/en/function.php-logo-guid.php
 * @return string PHPE9568F34-D428-11d2-A769-00AA001ACF42.
 * @since      4.0
 * @since      5.0
 */
function php_logo_guid() { }

/**
 * Returns the type of interface between web server and PHP
 *
 * @link  http://php.net/manual/en/function.php-sapi-name.php
 * @return string the interface type, as a lowercase string.
 * </p>
 * <p>
 * Although not exhaustive, the possible return values include
 * aolserver, apache,
 * apache2filter, apache2handler,
 * caudium, cgi (until PHP 5.3),
 * cgi-fcgi, cli,
 * continuity, embed,
 * isapi, litespeed,
 * milter, nsapi,
 * phttpd, pi3web, roxen,
 * thttpd, tux, and webjames.
 * @since 4.0.1
 * @since 5.0
 */
function php_sapi_name() { }

/**
 * Returns information about the operating system PHP is running on
 *
 * @link  http://php.net/manual/en/function.php-uname.php
 *
 * @param string $mode [optional] <p>
 *                     mode is a single character that defines what
 *                     information is returned:
 *                     'a': This is the default. Contains all modes in
 *                     the sequence "s n r v m".
 *
 * @return string the description, as a string.
 * @since 4.0.2
 * @since 5.0
 */
function php_uname($mode = null) { }

/**
 * Prints out the credits for PHP
 *
 * @link  http://php.net/manual/en/function.phpcredits.php
 *
 * @param int $flag [optional] <p>
 *                  To generate a custom credits page, you may want to use the
 *                  flag parameter.
 *                  </p>
 *                  <p>
 *                  <table>
 *                  Pre-defined phpcredits flags
 *                  <tr valign="top">
 *                  <td>name</td>
 *                  <td>description</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>CREDITS_ALL</td>
 *                  <td>
 *                  All the credits, equivalent to using: CREDITS_DOCS +
 *                  CREDITS_GENERAL + CREDITS_GROUP +
 *                  CREDITS_MODULES + CREDITS_FULLPAGE.
 *                  It generates a complete stand-alone HTML page with the appropriate tags.
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>CREDITS_DOCS</td>
 *                  <td>The credits for the documentation team</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>CREDITS_FULLPAGE</td>
 *                  <td>
 *                  Usually used in combination with the other flags. Indicates
 *                  that a complete stand-alone HTML page needs to be
 *                  printed including the information indicated by the other
 *                  flags.
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>CREDITS_GENERAL</td>
 *                  <td>
 *                  General credits: Language design and concept, PHP 4.0
 *                  authors and SAPI module.
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>CREDITS_GROUP</td>
 *                  <td>A list of the core developers</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>CREDITS_MODULES</td>
 *                  <td>
 *                  A list of the extension modules for PHP, and their authors
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>CREDITS_SAPI</td>
 *                  <td>
 *                  A list of the server API modules for PHP, and their authors
 *                  </td>
 *                  </tr>
 *                  </table>
 *                  </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function phpcredits($flag = null) { }

/**
 * Outputs lots of PHP information
 *
 * @link  http://php.net/manual/en/function.phpinfo.php
 *
 * @param int $what [optional] <p>
 *                  The output may be customized by passing one or more of the
 *                  following constants bitwise values summed
 *                  together in the optional what parameter.
 *                  One can also combine the respective constants or bitwise values
 *                  together with the or operator.
 *                  </p>
 *                  <p>
 *                  <table>
 *                  phpinfo options
 *                  <tr valign="top">
 *                  <td>Name (constant)</td>
 *                  <td>Value</td>
 *                  <td>Description</td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INFO_GENERAL</td>
 *                  <td>1</td>
 *                  <td>
 *                  The configuration line, &php.ini; location, build date, Web
 *                  Server, System and more.
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INFO_CREDITS</td>
 *                  <td>2</td>
 *                  <td>
 *                  PHP Credits. See also phpcredits.
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INFO_CONFIGURATION</td>
 *                  <td>4</td>
 *                  <td>
 *                  Current Local and Master values for PHP directives. See
 *                  also ini_get.
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INFO_MODULES</td>
 *                  <td>8</td>
 *                  <td>
 *                  Loaded modules and their respective settings. See also
 *                  get_loaded_extensions.
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INFO_ENVIRONMENT</td>
 *                  <td>16</td>
 *                  <td>
 *                  Environment Variable information that's also available in
 *                  $_ENV.
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INFO_VARIABLES</td>
 *                  <td>32</td>
 *                  <td>
 *                  Shows all
 *                  predefined variables from EGPCS (Environment, GET,
 *                  POST, Cookie, Server).
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INFO_LICENSE</td>
 *                  <td>64</td>
 *                  <td>
 *                  PHP License information. See also the license FAQ.
 *                  </td>
 *                  </tr>
 *                  <tr valign="top">
 *                  <td>INFO_ALL</td>
 *                  <td>-1</td>
 *                  <td>
 *                  Shows all of the above.
 *                  </td>
 *                  </tr>
 *                  </table>
 *                  </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function phpinfo($what = null) { }

/**
 * Gets the current PHP version
 *
 * @link  http://php.net/manual/en/function.phpversion.php
 *
 * @param string $extension [optional] <p>
 *                          An optional extension name.
 *                          </p>
 *
 * @return string If the optional extension parameter is
 * specified, phpversion returns the version of that
 * extension, or false if there is no version information associated or
 * the extension isn't enabled.
 * @since 4.0
 * @since 5.0
 */
function phpversion($extension = null) { }

/**
 * Sets the value of an environment variable
 *
 * @link  http://php.net/manual/en/function.putenv.php
 *
 * @param string $setting <p>
 *                        The setting, like "FOO=BAR"
 *                        </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function putenv($setting) { }

/**
 * Restores the value of the include_path configuration option
 *
 * @link  http://php.net/manual/en/function.restore-include-path.php
 * @return void
 * @since 4.3.0
 * @since 5.0
 */
function restore_include_path() { }

/**
 * Sets the include_path configuration option
 *
 * @link  http://php.net/manual/en/function.set-include-path.php
 *
 * @param string $new_include_path <p>
 *                                 The new value for the include_path
 *                                 </p>
 *
 * @return string|false the old include_path on success or false on failure.
 * @since 4.3.0
 * @since 5.0
 */
function set_include_path($new_include_path) { }

/**
 * Sets the current active configuration setting of magic_quotes_runtime
 *
 * @link       http://php.net/manual/en/function.set-magic-quotes-runtime.php
 * @deprecated 5.3.0
 *
 * @param bool $new_setting <p>
 *                          false for off, true for on.
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * @deprecated 5.4 This function has been DEPRECATED as of PHP 5.4.0. Raises an E_CORE_ERROR.
 * @since      4.0
 * @since      5.0
 */
function set_magic_quotes_runtime($new_setting) { }

/**
 * Limits the maximum execution time
 *
 * @link  http://php.net/manual/en/function.set-time-limit.php
 *
 * @param int $seconds <p>
 *                     The maximum execution time, in seconds. If set to zero, no time limit
 *                     is imposed.
 *                     </p>
 *
 * @return bool Returns TRUE on success, or FALSE on failure.
 * @since 4.0
 * @since 5.0
 */
function set_time_limit($seconds) { }

/**
 * Returns directory path used for temporary files
 *
 * @link  http://php.net/manual/en/function.sys-get-temp-dir.php
 * @return string the path of the temporary directory.
 * @since 5.2.1
 */
function sys_get_temp_dir() { }

/**
 * Compares two "PHP-standardized" version number strings
 *
 * @link  http://php.net/manual/en/function.version-compare.php
 *
 * @param string $version1 <p>
 *                         First version number.
 *                         </p>
 * @param string $version2 <p>
 *                         Second version number.
 *                         </p>
 * @param string $operator [optional] <p>
 *                         If you specify the third optional operator
 *                         argument, you can test for a particular relationship. The
 *                         possible operators are: &lt;,
 *                         lt, &lt;=,
 *                         le, &gt;,
 *                         gt, &gt;=,
 *                         ge, ==,
 *                         =, eq,
 *                         !=, &lt;&gt;,
 *                         ne respectively.
 *                         </p>
 *                         <p>
 *                         This parameter is case-sensitive, so values should be lowercase.
 *                         </p>
 *
 * @return mixed By default, version_compare returns
 * -1 if the first version is lower than the second,
 * 0 if they are equal, and
 * 1 if the second is lower.
 * </p>
 * <p>
 * When using the optional operator argument, the
 * function will return true if the relationship is the one specified
 * by the operator, false otherwise.
 * @since 4.1.0
 * @since 5.0
 */
function version_compare($version1, $version2, $operator = null) { }

/**
 * @deprecated 5.5 Removed in PHP 5.5
 * Gets the Zend guid
 * @link       http://php.net/manual/en/function.zend-logo-guid.php
 * @return string PHPE9568F35-D428-11d2-A769-00AA001ACF42.
 * @since      4.0
 * @since      5.0
 */
function zend_logo_guid() { }

/**
 * Returns a unique identifier for the current thread.
 *
 * __Note:__
 * This function is only available if PHP has been built with ZTS (Zend Thread Safety) support and debug mode
 * (--enable-debug).
 *
 * @link       http://php.net/manual/en/function.zend-thread-id.php
 * @return int Returns the thread id as an integer.
 * @since      5.0
 */
function zend_thread_id() { }

/**
 * Gets the version of the current Zend engine.
 *
 * @link       http://php.net/manual/en/function.zend-version.php
 * @return string Returns the Zend Engine version number, as a string.
 * @since      4.0
 * @since      5.0
 */
function zend_version() { }
