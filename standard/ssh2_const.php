<?php
/**
 * PHPStorm stub file for Secure Shell2 constants.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */

/**
 * Default terminal type (e.g. vt102, ansi, xterm, vanilla) requested
 * by ssh2_shell.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_DEFAULT_TERMINAL = 'vanilla';
/**
 * Default terminal height requested by ssh2_shell.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_DEFAULT_TERM_HEIGHT = 25;
/**
 * Default terminal units requested by ssh2_shell.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_DEFAULT_TERM_UNIT = 0;
/**
 * Default terminal width requested by ssh2_shell.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_DEFAULT_TERM_WIDTH = 80;
/**
 * Flag to ssh2_fingerprint requesting hostkey
 * fingerprint as a string of hexits.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_FINGERPRINT_HEX = 0;
/**
 * Flag to ssh2_fingerprint requesting hostkey
 * fingerprint as an MD5 hash.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_FINGERPRINT_MD5 = 0;
/**
 * Flag to ssh2_fingerprint requesting hostkey
 * fingerprint as a raw string of 8-bit characters.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_FINGERPRINT_RAW = 2;
/**
 * Flag to ssh2_fingerprint requesting hostkey
 * fingerprint as an SHA1 hash.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_FINGERPRINT_SHA1 = 1;
const SSH2_POLLERR = 8;
const SSH2_POLLEXT = 2;
const SSH2_POLLHUP = 16;
const SSH2_POLLIN = 1;
const SSH2_POLLNVAL = 32;
const SSH2_POLLOUT = 4;
const SSH2_POLL_CHANNEL_CLOSED = 128;
const SSH2_POLL_LISTENER_CLOSED = 128;
const SSH2_POLL_SESSION_CLOSED = 16;
/**
 * Flag to ssh2_fetch_stream requesting STDERR subchannel.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_STREAM_STDERR = 1;
/**
 * Flag to ssh2_fetch_stream requesting STDIO subchannel.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_STREAM_STDIO = 0;
/**
 * Flag to ssh2_shell specifying that
 * width and height
 * are provided as character sizes.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_TERM_UNIT_CHARS = 0;
/**
 * Flag to ssh2_shell specifying that
 * width and height
 * are provided in pixel units.
 *
 * @link http://php.net/manual/en/ssh2.constants.php
 */
const SSH2_TERM_UNIT_PIXELS = 1;
