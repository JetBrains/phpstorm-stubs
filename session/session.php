<?php

// Start of session v.

/**
 * Get and/or set the current session name
 * @link https://php.net/manual/en/function.session-name.php
 * @param string $name [optional] <p>
 * The session name references the name of the session, which is
 * used in cookies and URLs (e.g. PHPSESSID). It
 * should contain only alphanumeric characters; it should be short and
 * descriptive (i.e. for users with enabled cookie warnings).
 * If <i>name</i> is specified, the name of the current
 * session is changed to its value.
 * </p>
 * <p>
 * <p>
 * The session name can't consist of digits only, at least one letter
 * must be present. Otherwise a new session id is generated every time.
 * </p>
 * </p>
 * @return string the name of the current session.
 * @since 4.0
 * @since 5.0
 */
function session_name ($name = null) {}

/**
 * Get and/or set the current session module
 * @link https://php.net/manual/en/function.session-module-name.php
 * @param string $module [optional] <p>
 * If <i>module</i> is specified, that module will be
 * used instead.
 * </p>
 * @return string the name of the current session module.
 * @since 4.0
 * @since 5.0
 */
function session_module_name ($module = null) {}

/**
 * Get and/or set the current session save path
 * @link https://php.net/manual/en/function.session-save-path.php
 * @param string $path [optional] <p>
 * Session data path. If specified, the path to which data is saved will
 * be changed. <b>session_save_path</b> needs to be called
 * before <b>session_start</b> for that purpose.
 * </p>
 * <p>
 * <p>
 * On some operating systems, you may want to specify a path on a
 * filesystem that handles lots of small files efficiently. For example,
 * on Linux, reiserfs may provide better performance than ext2fs.
 * </p>
 * </p>
 * @return string the path of the current directory used for data storage.
 * @since 4.0
 * @since 5.0
 */
function session_save_path ($path = null) {}

/**
 * Get and/or set the current session id
 * @link https://php.net/manual/en/function.session-id.php
 * @param string $id [optional] <p>
 * If <i>id</i> is specified, it will replace the current
 * session id. <b>session_id</b> needs to be called before
 * <b>session_start</b> for that purpose. Depending on the
 * session handler, not all characters are allowed within the session id.
 * For example, the file session handler only allows characters in the
 * range a-z A-Z 0-9 , (comma) and - (minus)!
 * </p>
 * When using session cookies, specifying an <i>id</i>
 * for <b>session_id</b> will always send a new cookie
 * when <b>session_start</b> is called, regardless if the
 * current session id is identical to the one being set.
 * @return string <b>session_id</b> returns the session id for the current
 * session or the empty string ("") if there is no current
 * session (no current session id exists).
 * @since 4.0
 * @since 5.0
 */
function session_id ($id = null) {}

/**
 * Update the current session id with a newly generated one
 * @link https://php.net/manual/en/function.session-regenerate-id.php
 * @param bool $delete_old_session [optional] <p>
 * Whether to delete the old associated session file or not.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.3.2
 * @since 5.0
 */
function session_regenerate_id ($delete_old_session = false) {}

/**
 * PHP > 5.4.0 <br/>
 * Session shutdown function
 * @link https://secure.php.net/manual/en/function.session-register-shutdown.php
 */
function session_register_shutdown  () {}

/**
 * Decodes session data from a string
 * @link https://php.net/manual/en/function.session-decode.php
 * @param string $data <p>
 * The encoded data to be stored.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function session_decode ($data) {}

/**
 * Register one or more global variables with the current session
 * @link https://php.net/manual/en/function.session-register.php
 * @param mixed $name <p>
 * A string holding the name of a variable or an array consisting of
 * variable names or other arrays.
 * </p>
 * @param mixed $_ [optional]
 * @return bool true on success or false on failure.
 * @deprecated 5.3.0 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since 4.0
 * @since 5.0
 */
function session_register ($name, $_ = null) {}

/**
 * Unregister a global variable from the current session
 * @link https://php.net/manual/en/function.session-unregister.php
 * @param string $name <p>
 * The variable name.
 * </p>
 * @return bool true on success or false on failure.
 * @deprecated 5.3.0 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since 4.0
 * @since 5.0
 */
function session_unregister ($name) {}

/**
 * Find out whether a global variable is registered in a session
 * @link https://php.net/manual/en/function.session-is-registered.php
 * @param string $name <p>
 * The variable name.
 * </p>
 * @return bool <b>session_is_registered</b> returns true if there is a
 * global variable with the name <i>name</i> registered in
 * the current session, false otherwise.
 * @deprecated 5.3.0 This function has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
 * @since 4.0
 * @since 5.0
 */
function session_is_registered ($name) {}

/**
 * Encodes the current session data as a string
 * @link https://php.net/manual/en/function.session-encode.php
 * @return string the contents of the current session encoded.
 * @since 4.0
 * @since 5.0
 */
function session_encode () {}

/**
 * Initialize session data
 * @link https://php.net/manual/en/function.session-start.php
 * @param array $options [optional] <p>If provided, this is an associative array of options that will override the currently set session configuration directives. The keys should not include the session. prefix.
 * In addition to the normal set of configuration directives, a read_and_close option may also be provided. If set to TRUE, this will result in the session being closed immediately after being read, thereby avoiding unnecessary locking if the session data won't be changed.</p>
 * @return bool This function returns true if a session was successfully started,
 * otherwise false.
 * @since 4.0
 * @since 5.0
 * @since 7.0
 */
function session_start ($options = []) {}

/**
 * Create new session id
 * @param string $prefix [optional] If prefix is specified, new session id is prefixed by prefix.
 * Not all characters are allowed within the session id.
 * Characters in the range a-z A-Z 0-9 , (comma) and - (minus) are allowed.
 * @return string new collision free session id for the current session.
 * If it is used without active session, it omits collision check.
 */
function session_create_id($prefix) {}

/**
 * Perform session data garbage collection
 * @return int|false number of deleted session data for success, false for failure.
 * @since 7.1
 */
function session_gc() {}

/**
 * Destroys all data registered to a session
 * @link https://php.net/manual/en/function.session-destroy.php
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function session_destroy () {}

/**
 * Free all session variables
 * @link https://php.net/manual/en/function.session-unset.php
 * @return void
 * @since 4.0
 * @since 5.0
 */
function session_unset () {}

/**
 * Sets user-level session storage functions
 * @link https://php.net/manual/en/function.session-set-save-handler.php
 * @param callback $open <p>
 * Open function, this works like a constructor in classes and is
 * executed when the session is being opened. The open function
 * expects two parameters, where the first is the save path and
 * the second is the session name.
 * </p>
 * @param callback $close <p>
 * Close function, this works like a destructor in classes and is
 * executed when the session operation is done.
 * </p>
 * @param callback $read <p>
 * Read function must return string value always to make save handler
 * work as expected. Return empty string if there is no data to read.
 * Return values from other handlers are converted to boolean expression.
 * true for success, false for failure.
 * </p>
 * @param callback $write <p>
 * Write function that is called when session data is to be saved. This
 * function expects two parameters: an identifier and the data associated
 * with it.
 * <p>
 * The "write" handler is not executed until after the output stream is
 * closed. Thus, output from debugging statements in the "write"
 * handler will never be seen in the browser. If debugging output is
 * necessary, it is suggested that the debug output be written to a
 * file instead.
 * </p>
 * </p>
 * @param callback $destroy <p>
 * The destroy handler, this is executed when a session is destroyed with
 * <b>session_destroy</b> and takes the session id as its
 * only parameter.
 * </p>
 * @param callback $gc <p>
 * The garbage collector, this is executed when the session garbage collector
 * is executed and takes the max session lifetime as its only parameter.
 * </p>
 * @param callback $create_sid [optional]
 * <p>This callback is executed when a new session ID is required.
 * No parameters are provided, and the return value should be a string that is a valid
 * session ID for your handler.</p>
 * @param callback $validate_sid [optional]
 * @param callback $update_timestamp [optional]
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function session_set_save_handler ($open, $close, $read, $write, $destroy, $gc, $create_sid = null, $validate_sid = null,  $update_timestamp = null) {}

/**
 * (PHP 5.4)<br/>
 * Sets user-level session storage functions
 * @link https://php.net/manual/en/function.session-set-save-handler.php
 * </p>
 * @param SessionHandlerInterface $session_handler An instance of a class implementing SessionHandlerInterface, such as SessionHandler,
 * to register as the session handler. Since PHP 5.4 only.
 * @param bool $register_shutdown [optional] Register session_write_close() as a register_shutdown_function() function.
 * @return bool true on success or false on failure.
 */
function session_set_save_handler (SessionHandlerInterface $session_handler, $register_shutdown = true) {}

/**
 * Get and/or set the current cache limiter
 * @link https://php.net/manual/en/function.session-cache-limiter.php
 * @param string $cache_limiter [optional] <p>
 * If <i>cache_limiter</i> is specified, the name of the
 * current cache limiter is changed to the new value.
 * </p>
 * <table>
 * Possible values
 * <tr valign="top">
 * <td>Value</td>
 * <td>Headers sent</td>
 * </tr>
 * <tr valign="top">
 * <td>public</td>
 * <td>
 * <pre>
 * Expires: (sometime in the future, according session.cache_expire)
 * Cache-Control: public, max-age=(sometime in the future, according to session.cache_expire)
 * Last-Modified: (the timestamp of when the session was last saved)
 * </pre>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>private_no_expire</td>
 * <td>
 * <pre>
 * Cache-Control: private, max-age=(session.cache_expire in the future), pre-check=(session.cache_expire in the future)
 * Last-Modified: (the timestamp of when the session was last saved)
 * </pre>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>private</td>
 * <td>
 * <pre>
 * Expires: Thu, 19 Nov 1981 08:52:00 GMT
 * Cache-Control: private, max-age=(session.cache_expire in the future), pre-check=(session.cache_expire in the future)
 * Last-Modified: (the timestamp of when the session was last saved)
 * </pre>
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>nocache</td>
 * <td>
 * <pre>
 * Expires: Thu, 19 Nov 1981 08:52:00 GMT
 * Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
 * Pragma: no-cache
 * </pre>
 * </td>
 * </tr>
 * </table>
 * @return string the name of the current cache limiter.
 * @since 4.0.3
 * @since 5.0
 * @since 7.0
 */
function session_cache_limiter ($cache_limiter = null) {}

/**
 * Return current cache expire
 * @link https://php.net/manual/en/function.session-cache-expire.php
 * @param string $new_cache_expire [optional] <p>
 * If <i>new_cache_expire</i> is given, the current cache
 * expire is replaced with <i>new_cache_expire</i>.
 * </p>
 * <p>
 * Setting <i>new_cache_expire</i> is of value only, if
 * session.cache_limiter is set to a value
 * different from nocache.
 * </p>
 * @return int the current setting of session.cache_expire.
 * The value returned should be read in minutes, defaults to 180.
 * @since 4.2.0
 * @since 5.0
 * @since 7.0
 */
function session_cache_expire ($new_cache_expire = null) {}

/**
 * Set the session cookie parameters
 * @link https://php.net/manual/en/function.session-set-cookie-params.php
 * @param int $lifetime <p>
 * Lifetime of the
 * session cookie, defined in seconds.
 * </p>
 * @param string $path [optional] <p>
 * Path on the domain where
 * the cookie will work. Use a single slash ('/') for all paths on the
 * domain.
 * </p>
 * @param string $domain [optional] <p>
 * Cookie domain, for
 * example 'www.php.net'. To make cookies visible on all subdomains then
 * the domain must be prefixed with a dot like '.php.net'.
 * </p>
 * @param bool $secure [optional] <p>
 * If true cookie will only be sent over
 * secure connections.
 * </p>
 * @param bool $httponly [optional] <p>
 * If set to true then PHP will attempt to send the
 * httponly
 * flag when setting the session cookie.
 * </p>
 * @return void
 * @since 4.0
 * @since 5.0
 */
function session_set_cookie_params ($lifetime, $path = null, $domain = null, $secure = false, $httponly = false) {}

/**
 * Get the session cookie parameters
 * @link https://php.net/manual/en/function.session-get-cookie-params.php
 * @return array an array with the current session cookie information, the array
 * contains the following items:
 * "lifetime" - The
 * lifetime of the cookie in seconds.
 * "path" - The path where
 * information is stored.
 * "domain" - The domain
 * of the cookie.
 * "secure" - The cookie
 * should only be sent over secure connections.
 * "httponly" - The
 * cookie can only be accessed through the HTTP protocol.
 * @since 4.0
 * @since 5.0
 */
function session_get_cookie_params () {}

/**
 * Write session data and end session
 * @link https://php.net/manual/en/function.session-write-close.php
 * @return void
 * @since 4.0.4
 * @since 5.0
 */
function session_write_close () {}

/**
 * Alias of <b>session_write_close</b>
 * @link https://php.net/manual/en/function.session-commit.php
 * @since 4.4.0
 * @since 5.0
 */
function session_commit () {}

/**
 * (PHP 5 >= 5.4.0)<br>
 * Returns the current session status
 * @link https://php.net/manual/en/function.session-status.php
 * @return int <b>PHP_SESSION_DISABLED</b> if sessions are disabled.
 * <b>PHP_SESSION_NONE</b> if sessions are enabled, but none exists.
 * <b>PHP_SESSION_ACTIVE</b> if sessions are enabled, and one exists.
 */
function session_status () {}

/**
 * (PHP 5 >= 5.6.0)<br>
 * Discard session array changes and finish session
 * @link https://php.net/manual/en/function.session-abort.php
 * @return bool true if a session was successfully reinitialized or false on failure.
 */
function session_abort() {}

/**
 * (PHP 5 >= 5.6.0)<br>
 * Re-initialize session array with original values
 * @link https://php.net/manual/en/function.session-reset.php
 * @return bool true if a session was successfully reinitialized or false on failure.
 */
function session_reset() {}

// End of session v.
?>
