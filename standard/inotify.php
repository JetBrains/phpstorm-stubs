<?php

// Start of inotify v.0.1.6

/**
 * (PHP &gt;= 5.2.0, PECL inotify &gt;= 0.1.2)<br/>
 * Add a watch to an initialized inotify instance
 *
 * @link http://php.net/manual/en/function.inotify-add-watch.php
 *
 * @param resource $inotify_instance <p>resource returned by {@link http://php.net/manual/en/function.inotify-init.php inotify_init()}</p>
 * @param string   $pathname         <p>File or directory to watch</p>
 * @param int      $mask             <p>Events to watch for. See {@link http://php.net/manual/en/inotify.constants.php Predefined Constants}.</p>
 *
 * @return int a unique (<i>inotify</i> instance-wide) watch descriptor.
 */
function inotify_add_watch( $inotify_instance, $pathname, $mask )
{
}

/**
 * (PHP &gt;= 5.2.0, PECL inotify &gt;= 0.1.2)<br/>
 * Initialize an inotify instance for use with {@see inotify_add_watch}
 *
 * @link http://php.net/manual/en/function.inotify-init.php
 * @return resource a stream resource or <b>FALSE</b> on error.
 */
function inotify_init()
{
}

/**
 * (PHP &gt;= 5.2.0, PECL inotify &gt;= 0.1.2)<br/>
 * This function allows to know if {@see inotify_read} will block or not.
 * If a number upper than zero is returned, there are pending events
 * and {@see inotify_read} will not block.
 *
 * @link http://php.net/manual/en/function.inotify-queue-len.php
 *
 * @param resource $inotify_instance <p>resource returned by {@link http://php.net/manual/en/function.inotify-init.php inotify_init()}</p>
 *
 * @return int a number greater than zero if events are pending, otherwise zero.
 */
function inotify_queue_len( $inotify_instance )
{
}

/**
 * (PHP &gt;= 5.2.0, PECL inotify &gt;= 0.1.2)<br/>
 * Read inotify events from an inotify instance.
 *
 * @link http://php.net/manual/en/function.inotify-read.php
 *
 * @param resource $inotify_instance <p>resource returned by {@link http://php.net/manual/en/function.inotify-init.php inotify_init()}</p>
 *
 * @return array an array of inotify events or <b>FALSE</b> if no events
 * were pending and <i>inotify_instance</i> is non-blocking. Each event
 * is an array with the following keys:
 *
 * <ul>
 *  <li><b>wd</b> is a watch descriptor returned by inotify_add_watch()</li>
 *  <li><b>mask</b> is a bit mask of events
 *  <li><b>cookie</b> is a unique id to connect related events (e.g. IN_MOVE_FROM and IN_MOVE_TO)
 *  <li><b>name</b> is the name of a file (e.g. if a file was modified in a watched directory)
 * </ul>
 */
function inotify_read( $inotify_instance )
{
}

/**
 * (PHP &gt;= 5.2.0, PECL inotify &gt;= 0.1.2)<br/>
 * Removes the watch <i>$watch_descriptor</i> from the inotify instance <i>$inotify_instance</i>.
 *
 * @link     http://php.net/manual/en/function.inotify-rm-watch.php
 *
 * @param resource $inotify_instance <p>resource returned by {@link http://php.net/manual/en/function.inotify-init.php inotify_init()}</p>
 * @param int      $watch_descriptor <p>watch to remove from the instance</p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function inotify_rm_watch( $inotify_instance, $watch_descriptor )
{
}

/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_ACCESS = 1;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_MODIFY = 2;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_ATTRIB = 4;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_CLOSE_WRITE = 8;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_CLOSE_NOWRITE = 16;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_OPEN = 32;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_MOVED_FROM = 64;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_MOVED_TO = 128;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_CREATE = 256;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_DELETE = 512;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_DELETE_SELF = 1024;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_MOVE_SELF = 2048;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_UNMOUNT = 8192;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_Q_OVERFLOW = 16384;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_IGNORED = 32768;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_CLOSE = 24;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_MOVE = 192;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_ALL_EVENTS = 4095;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_ONLYDIR = 16777216;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_DONT_FOLLOW = 33554432;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_MASK_ADD = 536870912;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_ISDIR = 1073741824;
/**
 * @type int
 * @link http://php.net/manual/en/inotify.constants.php
 */
const IN_ONESHOT = 2147483648;

// End of inotify v.0.1.6
