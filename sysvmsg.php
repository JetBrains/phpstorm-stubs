<?php

// Start of sysvmsg v.

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Create or attach to a message queue
 * @link http://php.net/manual/en/function.msg-get-queue.php
 * @param int $key <p>
 * Message queue numeric ID
 * </p>
 * @param int $perms [optional] <p>
 * Queue permissions. Default to 0666. If the message queue already
 * exists, the perms will be ignored.
 * </p>
 * @return resource a resource handle that can be used to access the System V message queue.
 */
function msg_get_queue ($key, $perms = null) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Send a message to a message queue
 * @link http://php.net/manual/en/function.msg-send.php
 * @param resource $queue <p>
 * </p>
 * @param int $msgtype <p>
 * </p>
 * @param mixed $message <p>
 * </p>
 * @param bool $serialize [optional] <p>
 * The optional serialize controls how the
 * message is sent. serialize
 * defaults to true which means that the message is
 * serialized using the same mechanism as the session module before being
 * sent to the queue. This allows complex arrays and objects to be sent to
 * other PHP scripts, or if you are using the WDDX serializer, to any WDDX
 * compatible client.
 * </p>
 * @param bool $blocking [optional] <p>
 * If the message is too large to fit in the queue, your script will wait
 * until another process reads messages from the queue and frees enough
 * space for your message to be sent.
 * This is called blocking; you can prevent blocking by setting the
 * optional blocking parameter to false, in which
 * case msg_send will immediately return false if the
 * message is too big for the queue, and set the optional
 * errorcode to MSG_EAGAIN,
 * indicating that you should try to send your message again a little
 * later on.
 * </p>
 * @param int $errorcode [optional] <p>
 * </p>
 * @return bool true on success or false on failure.
 * </p>
 * <p>
 * Upon successful completion the message queue data structure is updated as
 * follows: msg_lspid is set to the process-ID of the
 * calling process, msg_qnum is incremented by 1 and
 * msg_stime is set to the current time.
 */
function msg_send ($queue, $msgtype, $message, $serialize = null, $blocking = null, &$errorcode = null) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Receive a message from a message queue
 * @link http://php.net/manual/en/function.msg-receive.php
 * @param resource $queue <p>
 * </p>
 * @param int $desiredmsgtype <p>
 * If desiredmsgtype is 0, the message from the front
 * of the queue is returned. If desiredmsgtype is
 * greater than 0, then the first message of that type is returned.
 * If desiredmsgtype is less than 0, the first
 * message on the queue with the lowest type less than or equal to the
 * absolute value of desiredmsgtype will be read.
 * If no messages match the criteria, your script will wait until a suitable
 * message arrives on the queue. You can prevent the script from blocking
 * by specifying MSG_IPC_NOWAIT in the
 * flags parameter.
 * </p>
 * @param int $msgtype <p>
 * The type of the message that was received will be stored in this
 * parameter.
 * </p>
 * @param int $maxsize <p>
 * The maximum size of message to be accepted is specified by the
 * maxsize; if the message in the queue is larger
 * than this size the function will fail (unless you set
 * flags as described below).
 * </p>
 * @param mixed $message <p>
 * The received message will be stored in message,
 * unless there were errors receiving the message.
 * </p>
 * @param bool $unserialize [optional] <p>
 * If set to
 * true, the message is treated as though it was serialized using the
 * same mechanism as the session module. The message will be unserialized
 * and then returned to your script. This allows you to easily receive
 * arrays or complex object structures from other PHP scripts, or if you
 * are using the WDDX serializer, from any WDDX compatible source.
 * </p>
 * <p>
 * If unserialize is false, the message will be
 * returned as a binary-safe string.
 * </p>
 * @param int $flags [optional] <p>
 * The optional flags allows you to pass flags to the
 * low-level msgrcv system call. It defaults to 0, but you may specify one
 * or more of the following values (by adding or ORing them together).
 * <table>
 * Flag values for msg_receive
 * <tr valign="top">
 * <td>MSG_IPC_NOWAIT</td>
 * <td>If there are no messages of the
 * desiredmsgtype, return immediately and do not
 * wait. The function will fail and return an integer value
 * corresponding to MSG_ENOMSG.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>MSG_EXCEPT</td>
 * <td>Using this flag in combination with a
 * desiredmsgtype greater than 0 will cause the
 * function to receive the first message that is not equal to
 * desiredmsgtype.</td>
 * </tr>
 * <tr valign="top">
 * <td>MSG_NOERROR</td>
 * <td>
 * If the message is longer than maxsize,
 * setting this flag will truncate the message to
 * maxsize and will not signal an error.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @param int $errorcode [optional] <p>
 * If the function fails, the optional errorcode
 * will be set to the value of the system errno variable.
 * </p>
 * @return bool true on success or false on failure.
 * </p>
 * <p>
 * Upon successful completion the message queue data structure is updated as
 * follows: msg_lrpid is set to the process-ID of the
 * calling process, msg_qnum is decremented by 1 and
 * msg_rtime is set to the current time.
 */
function msg_receive ($queue, $desiredmsgtype, &$msgtype, $maxsize, &$message, $unserialize = null, $flags = null, &$errorcode = null) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Destroy a message queue
 * @link http://php.net/manual/en/function.msg-remove-queue.php
 * @param resource $queue <p>
 * Message queue resource handle
 * </p>
 * @return bool true on success or false on failure.
 */
function msg_remove_queue ($queue) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Returns information from the message queue data structure
 * @link http://php.net/manual/en/function.msg-stat-queue.php
 * @param resource $queue <p>
 * Message queue resource handle
 * </p>
 * @return array The return value is an array whose keys and values have the following
 * meanings:
 * <table>
 * Array structure for msg_stat_queue
 * <tr valign="top">
 * <td>msg_perm.uid</td>
 * <td>
 * The uid of the owner of the queue.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>msg_perm.gid</td>
 * <td>
 * The gid of the owner of the queue.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>msg_perm.mode</td>
 * <td>
 * The file access mode of the queue.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>msg_stime</td>
 * <td>
 * The time that the last message was sent to the queue.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>msg_rtime</td>
 * <td>
 * The time that the last message was received from the queue.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>msg_ctime</td>
 * <td>
 * The time that the queue was last changed.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>msg_qnum</td>
 * <td>
 * The number of messages waiting to be read from the queue.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>msg_qbytes</td>
 * <td>
 * The maximum number of bytes allowed in one message queue. On
 * Linux, this value may be read and modified via
 * /proc/sys/kernel/msgmnb.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>msg_lspid</td>
 * <td>
 * The pid of the process that sent the last message to the queue.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>msg_lrpid</td>
 * <td>
 * The pid of the process that received the last message from the queue.
 * </td>
 * </tr>
 * </table>
 */
function msg_stat_queue ($queue) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Set information in the message queue data structure
 * @link http://php.net/manual/en/function.msg-set-queue.php
 * @param resource $queue <p>
 * Message queue resource handle
 * </p>
 * @param array $data <p>
 * You specify the values you require by setting the value of the keys
 * that you require in the data array.
 * </p>
 * @return bool true on success or false on failure.
 */
function msg_set_queue ($queue, array $data) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Check whether a message queue exists
 * @link http://php.net/manual/en/function.msg-queue-exists.php
 * @param int $key <p>
 * Queue key.
 * </p>
 * @return bool true on success or false on failure.
 */
function msg_queue_exists ($key) {}

define ('MSG_IPC_NOWAIT', 1);
define ('MSG_EAGAIN', 11);
define ('MSG_ENOMSG', 42);
define ('MSG_NOERROR', 2);
define ('MSG_EXCEPT', 4);

// End of sysvmsg v.
?>
