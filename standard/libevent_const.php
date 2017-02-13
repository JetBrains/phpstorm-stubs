<?php
/**
 * PHPStorm stub file for Libevent constants.
 *
 * @link http://php.net/manual/en/libevent.constants.php
 */

/**
 * We finished a requested connection on the bufferevent.
 */
const EVBUFFER_EOF = 16;
/**
 * An error occurred during a bufferevent operation. For more information
 * on what the error was, call {@link socket_strerror}().
 */
const EVBUFFER_ERROR = 32;
/**
 * An event occured during a read operation on the
 * bufferevent. See the other flags for which event it was.
 */
const EVBUFFER_READ = 1;
/**
 * A timeout expired on the bufferevent.
 */
const EVBUFFER_TIMEOUT = 64;
/**
 * An event occured during a write operation on the bufferevent.
 * See the other flags for which event it was.
 */
const EVBUFFER_WRITE = 2;
/**
 * Event base loop mode.
 * Not wait for events to trigger, only check whether
 * any events are ready to trigger immediately.
 *
 * @see event_base_loop
 */
const EVLOOP_NONBLOCK = 2;
/**
 * Event base loop mode.
 * Starts only one iteration of loop.
 *
 * @see event_base_loop
 */
const EVLOOP_ONCE = 1;
/**
 * Indicates that the event is persistent.
 *
 * By default, whenever a pending event becomes active
 * (because its fd is ready to read or write, or because its timeout expires),
 * it becomes non-pending right before its callback is executed.
 * Thus, if you want to make the event pending again, you can call event_add()
 * on it again from inside the callback function.
 *
 * If the EV_PERSIST flag is set on an event, however, the event is persistent.
 * This means that event remains pending even when its callback is activated.
 * If you want to make it non-pending from within its callback, you can call
 * event_del() on it.
 *
 * The timeout on a persistent event resets whenever the event�s callback runs.
 * Thus, if you have an event with flags EV_READ|EV_PERSIST and a timeout of five
 * seconds, the event will become active:
 *
 * Whenever the socket is ready for reading.
 *
 * Whenever five seconds have passed since the event last became active.
 */
const EV_PERSIST = 16;
/**
 * This flag indicates an event that becomes active when the provided
 * file descriptor is ready for reading.
 */
const EV_READ = 2;
/**
 * Used to implement signal detection.
 */
const EV_SIGNAL = 8;
/**
 * This flag indicates an event that becomes active after a timeout elapses.
 *
 * The EV_TIMEOUT flag is ignored when constructing an event: you
 * can either set a timeout when you add the event, or not.  It is
 * set in the 'what' argument to the callback function when a timeout
 * has occurred.
 */
const EV_TIMEOUT = 1;
/**
 * This flag indicates an event that becomes active when the provided
 * file descriptor is ready for writing.
 */
const EV_WRITE = 4;
