<?php

// Start of sysvmsg v.

/**
 * Create or attach to a message queue
 * @link https://php.net/manual/en/function.msg-get-queue.php
 * @param int $key <p>
 * Message queue numeric ID
 * </p>
 * @param int $perms [optional] <p>
 * Queue permissions. Default to 0666. If the message queue already
 * exists, the <i>perms</i> will be ignored.
 * </p>
 * @return resource a resource handle that can be used to access the System V message queue.
 * @since 4.3
 * @since 5.0
 */
function msg_get_queue ($key, $perms = 0666) {}

/**
 * Send a message to a message queue
 * @link https://php.net/manual/en/function.msg-send.php
 * @param resource $queue
 * @param int $msgtype
 * @param mixed $message
 * @param bool $serialize [optional] <p>
 * The optional <i>serialize</i> controls how the
 * <i>message</i> is sent. <i>serialize</i>
 * defaults to <b>TRUE</b> which means that the <i>message</i> is
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
 * optional <i>blocking</i> parameter to <b>FALSE</b>, in which
 * case <b>msg_send</b> will immediately return <b>FALSE</b> if the
 * message is too big for the queue, and set the optional
 * <i>errorcode</i> to <b>MSG_EAGAIN</b>,
 * indicating that you should try to send your message again a little
 * later on.
 * </p>
 * @param int $errorcode [optional]
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * Upon successful completion the message queue data structure is updated as
 * follows: <i>msg_lspid</i> is set to the process-ID of the
 * calling process, <i>msg_qnum</i> is incremented by 1 and
 * <i>msg_stime</i> is set to the current time.
 * @since 4.3
 * @since 5.0
 */
function msg_send ($queue, $msgtype, $message, $serialize = true, $blocking = true, &$errorcode = null) {}

/**
 * Receive a message from a message queue
 * @link https://php.net/manual/en/function.msg-receive.php
 * @param resource $queue
 * @param int $desiredmsgtype <p>
 * If <i>desiredmsgtype</i> is 0, the message from the front
 * of the queue is returned. If <i>desiredmsgtype</i> is
 * greater than 0, then the first message of that type is returned.
 * If <i>desiredmsgtype</i> is less than 0, the first
 * message on the queue with the lowest type less than or equal to the
 * absolute value of <i>desiredmsgtype</i> will be read.
 * If no messages match the criteria, your script will wait until a suitable
 * message arrives on the queue. You can prevent the script from blocking
 * by specifying <b>MSG_IPC_NOWAIT</b> in the
 * <i>flags</i> parameter.
 * </p>
 * @param int $msgtype <p>
 * The type of the message that was received will be stored in this
 * parameter.
 * </p>
 * @param int $maxsize <p>
 * The maximum size of message to be accepted is specified by the
 * <i>maxsize</i>; if the message in the queue is larger
 * than this size the function will fail (unless you set
 * <i>flags</i> as described below).
 * </p>
 * @param mixed $message <p>
 * The received message will be stored in <i>message</i>,
 * unless there were errors receiving the message.
 * </p>
 * @param bool $unserialize [optional] <p>
 * If set to
 * <b>TRUE</b>, the message is treated as though it was serialized using the
 * same mechanism as the session module. The message will be unserialized
 * and then returned to your script. This allows you to easily receive
 * arrays or complex object structures from other PHP scripts, or if you
 * are using the WDDX serializer, from any WDDX compatible source.
 * </p>
 * <p>
 * If <i>unserialize</i> is <b>FALSE</b>, the message will be
 * returned as a binary-safe string.
 * </p>
 * @param int $flags [optional] <p>
 * The optional <i>flags</i> allows you to pass flags to the
 * low-level msgrcv system call. It defaults to 0, but you may specify one
 * or more of the following values (by adding or ORing them together).
 * <table>
 * Flag values for msg_receive
 * <tr valign="top">
 * <td><b>MSG_IPC_NOWAIT</b></td>
 * <td>If there are no messages of the
 * <i>desiredmsgtype</i>, return immediately and do not
 * wait. The function will fail and return an integer value
 * corresponding to <b>MSG_ENOMSG</b>.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td><b>MSG_EXCEPT</b></td>
 * <td>Using this flag in combination with a
 * <i>desiredmsgtype</i> greater than 0 will cause the
 * function to receive the first message that is not equal to
 * <i>desiredmsgtype</i>.</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MSG_NOERROR</b></td>
 * <td>
 * If the message is longer than <i>maxsize</i>,
 * setting this flag will truncate the message to
 * <i>maxsize</i> and will not signal an error.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @param int $errorcode [optional] <p>
 * If the function fails, the optional <i>errorcode</i>
 * will be set to the value of the system errno variable.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * Upon successful completion the message queue data structure is updated as
 * follows: msg_lrpid is set to the process-ID of the
 * calling process, msg_qnum is decremented by 1 and
 * msg_rtime is set to the current time.
 * @since 4.3
 * @since 5.0
 */
function msg_receive ($queue, $desiredmsgtype, &$msgtype, $maxsize, &$message, $unserialize = true, $flags = 0, &$errorcode = null) {}

/**
 * Destroy a message queue
 * @link https://php.net/manual/en/function.msg-remove-queue.php
 * @param resource $queue <p>
 * Message queue resource handle
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.3
 * @since 5.0
 */
function msg_remove_queue ($queue) {}

/**
 * Returns information from the message queue data structure
 * @link https://php.net/manual/en/function.msg-stat-queue.php
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
 * @since 4.3
 * @since 5.0
 */
function msg_stat_queue ($queue) {}

/**
 * Set information in the message queue data structure
 * @link https://php.net/manual/en/function.msg-set-queue.php
 * @param resource $queue <p>
 * Message queue resource handle
 * </p>
 * @param array $data <p>
 * You specify the values you require by setting the value of the keys
 * that you require in the <i>data</i> array.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.3
 * @since 5.0
 */
function msg_set_queue ($queue, array $data) {}

/**
 * Check whether a message queue exists
 * @link https://php.net/manual/en/function.msg-queue-exists.php
 * @param int $key <p>
 * Queue key.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.3
 */
function msg_queue_exists ($key) {}

define ('MSG_IPC_NOWAIT', 1);
define ('MSG_EAGAIN', 11);
define ('MSG_ENOMSG', 42);
define ('MSG_NOERROR', 2);
define ('MSG_EXCEPT', 4);

// End of sysvmsg v.
?>
