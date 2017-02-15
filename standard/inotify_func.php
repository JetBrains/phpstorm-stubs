<?php
/**
 * PHPStorm stub file for Inotify functions.
 *
 * @link http://php.net/manual/en/book.inotify.php
 */

/**
 * Add a watch to an initialized inotify instance
 *
 * @link http://php.net/manual/en/function.inotify-add-watch.php
 *
 * @param resource $inotify_instance <p>resource returned by {@link
 *                                   http://php.net/manual/en/function.inotify-init.php inotify_init()}</p>
 * @param string   $pathname         <p>File or directory to watch</p>
 * @param int      $mask             <p>Events to watch for. See {@link
 *                                   http://php.net/manual/en/inotify.constants.php Predefined Constants}.</p>
 *
 * @return int a unique (<i>inotify</i> instance-wide) watch descriptor.
 * @since 5.2.0
 */
function inotify_add_watch($inotify_instance, $pathname, $mask) { }

/**
 * Initialize an inotify instance for use with {@see inotify_add_watch}
 *
 * @link http://php.net/manual/en/function.inotify-init.php
 * @return resource a stream resource or <b>FALSE</b> on error.
 * @since 5.2.0
 */
function inotify_init() { }

/**
 * This function allows to know if {@see inotify_read} will block or not.
 * If a number upper than zero is returned, there are pending events
 * and {@see inotify_read} will not block.
 *
 * @link http://php.net/manual/en/function.inotify-queue-len.php
 *
 * @param resource $inotify_instance <p>resource returned by {@link
 *                                   http://php.net/manual/en/function.inotify-init.php inotify_init()}</p>
 *
 * @return int a number greater than zero if events are pending, otherwise zero.
 * @since 5.2.0
 */
function inotify_queue_len($inotify_instance) { }

/**
 * Read inotify events from an inotify instance.
 *
 * @link http://php.net/manual/en/function.inotify-read.php
 *
 * @param resource $inotify_instance <p>resource returned by {@link
 *                                   http://php.net/manual/en/function.inotify-init.php inotify_init()}</p>
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
 * @since 5.2.0
 */
function inotify_read($inotify_instance) { }

/**
 * Removes the watch <i>$watch_descriptor</i> from the inotify instance <i>$inotify_instance</i>.
 *
 * @link     http://php.net/manual/en/function.inotify-rm-watch.php
 *
 * @param resource $inotify_instance <p>resource returned by {@link
 *                                   http://php.net/manual/en/function.inotify-init.php inotify_init()}</p>
 * @param int      $watch_descriptor <p>watch to remove from the instance</p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.2.0
 */
function inotify_rm_watch($inotify_instance, $watch_descriptor) { }
