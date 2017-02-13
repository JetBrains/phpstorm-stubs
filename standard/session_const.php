<?php
/**
 * PHPStorm stub file for Session Handling constants.
 *
 * @link http://php.net/manual/en/session.constants.php
 */

/**
 * Return value of session_status() if sessions are enabled, and a session exists.
 *
 * @link  http://php.net/manual/en/function.session-status.php
 *
 * @since 5.4.0
 */
const PHP_SESSION_ACTIVE = 2;
/**
 * Return value of session_status() if sessions are disabled.
 *
 * @link  http://php.net/manual/en/function.session-status.php
 *
 * @since 5.4.0
 */
const PHP_SESSION_DISABLED = 0;
/**
 * Return value of session_status() if sessions are enabled, but no session exists.
 *
 * @link  http://php.net/manual/en/function.session-status.php
 *
 * @since 5.4.0
 */
const PHP_SESSION_NONE = 1;
/**
 * (PHP4, PHP5)
 * <p>Constant containing either the session name and session ID in the form of "name=ID" or
 * empty string if session ID was set in an appropriate session cookie.
 * This is the same id as the one returned by session_id().
 *
 * @link http://php.net/manual/en/session.constants.php
 *
 * @see  session_id()
 */
const SID = 'name=ID';
