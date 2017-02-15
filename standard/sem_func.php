<?php
/**
 * PHPStorm stub file for Semaphore, Shared Memory and IPC functions.
 *
 * @link http://php.net/manual/en/book.sem.php
 */

/**
 * Convert a pathname and a project identifier to a System V IPC key
 *
 * @link  http://php.net/manual/en/function.ftok.php
 *
 * @param string $pathname <p>
 *                         Path to an accessible file.
 *                         </p>
 * @param string $proj     <p>
 *                         Project identifier. This must be a one character string.
 *                         </p>
 *
 * @return int On success the return value will be the created key value, otherwise
 * -1 is returned.
 * @since 4.2.0
 * @since 5.0
 */
function ftok($pathname, $proj) { }

/**
 * Create or attach to a message queue
 *
 * @link  http://php.net/manual/en/function.msg-get-queue.php
 *
 * @param int $key   <p>
 *                   Message queue numeric ID
 *                   </p>
 * @param int $perms [optional] <p>
 *                   Queue permissions. Default to 0666. If the message queue already
 *                   exists, the <i>perms</i> will be ignored.
 *                   </p>
 *
 * @return resource a resource handle that can be used to access the System V message queue.
 * @since 4.3.0
 * @since 5.0
 */
function msg_get_queue($key, $perms = 0666) { }

/**
 * Check whether a message queue exists
 *
 * @link  http://php.net/manual/en/function.msg-queue-exists.php
 *
 * @param int $key <p>
 *                 Queue key.
 *                 </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.3.0
 */
function msg_queue_exists($key) { }

/**
 * Receive a message from a message queue
 *
 * @link  http://php.net/manual/en/function.msg-receive.php
 *
 * @param resource $queue
 * @param int      $desiredmsgtype <p>
 *                                 If <i>desiredmsgtype</i> is 0, the message from the front
 *                                 of the queue is returned. If <i>desiredmsgtype</i> is
 *                                 greater than 0, then the first message of that type is returned.
 *                                 If <i>desiredmsgtype</i> is less than 0, the first
 *                                 message on the queue with the lowest type less than or equal to the
 *                                 absolute value of <i>desiredmsgtype</i> will be read.
 *                                 If no messages match the criteria, your script will wait until a suitable
 *                                 message arrives on the queue. You can prevent the script from blocking
 *                                 by specifying <b>MSG_IPC_NOWAIT</b> in the
 *                                 <i>flags</i> parameter.
 *                                 </p>
 * @param int      $msgtype        <p>
 *                                 The type of the message that was received will be stored in this
 *                                 parameter.
 *                                 </p>
 * @param int      $maxsize        <p>
 *                                 The maximum size of message to be accepted is specified by the
 *                                 <i>maxsize</i>; if the message in the queue is larger
 *                                 than this size the function will fail (unless you set
 *                                 <i>flags</i> as described below).
 *                                 </p>
 * @param mixed    $message        <p>
 *                                 The received message will be stored in <i>message</i>,
 *                                 unless there were errors receiving the message.
 *                                 </p>
 * @param bool     $unserialize    [optional] <p>
 *                                 If set to
 *                                 <b>TRUE</b>, the message is treated as though it was serialized using the
 *                                 same mechanism as the session module. The message will be unserialized
 *                                 and then returned to your script. This allows you to easily receive
 *                                 arrays or complex object structures from other PHP scripts, or if you
 *                                 are using the WDDX serializer, from any WDDX compatible source.
 *                                 </p>
 *                                 <p>
 *                                 If <i>unserialize</i> is <b>FALSE</b>, the message will be
 *                                 returned as a binary-safe string.
 *                                 </p>
 * @param int      $flags          [optional] <p>
 *                                 The optional <i>flags</i> allows you to pass flags to the
 *                                 low-level msgrcv system call. It defaults to 0, but you may specify one
 *                                 or more of the following values (by adding or ORing them together).
 *                                 <table>
 *                                 Flag values for msg_receive
 *                                 <tr valign="top">
 *                                 <td><b>MSG_IPC_NOWAIT</b></td>
 *                                 <td>If there are no messages of the
 *                                 <i>desiredmsgtype</i>, return immediately and do not
 *                                 wait. The function will fail and return an integer value
 *                                 corresponding to <b>MSG_ENOMSG</b>.
 *                                 </td>
 *                                 </tr>
 *                                 <tr valign="top">
 *                                 <td><b>MSG_EXCEPT</b></td>
 *                                 <td>Using this flag in combination with a
 *                                 <i>desiredmsgtype</i> greater than 0 will cause the
 *                                 function to receive the first message that is not equal to
 *                                 <i>desiredmsgtype</i>.</td>
 *                                 </tr>
 *                                 <tr valign="top">
 *                                 <td><b>MSG_NOERROR</b></td>
 *                                 <td>
 *                                 If the message is longer than <i>maxsize</i>,
 *                                 setting this flag will truncate the message to
 *                                 <i>maxsize</i> and will not signal an error.
 *                                 </td>
 *                                 </tr>
 *                                 </table>
 *                                 </p>
 * @param int      $errorcode      [optional] <p>
 *                                 If the function fails, the optional <i>errorcode</i>
 *                                 will be set to the value of the system errno variable.
 *                                 </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * Upon successful completion the message queue data structure is updated as
 * follows: msg_lrpid is set to the process-ID of the
 * calling process, msg_qnum is decremented by 1 and
 * msg_rtime is set to the current time.
 * @since 4.3.0
 * @since 5.0
 */
function msg_receive(
    $queue,
    $desiredmsgtype,
    &$msgtype,
    $maxsize,
    &$message,
    $unserialize = true,
    $flags = 0,
    &$errorcode = null
) {
}

/**
 * Destroy a message queue
 *
 * @link  http://php.net/manual/en/function.msg-remove-queue.php
 *
 * @param resource $queue <p>
 *                        Message queue resource handle
 *                        </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.3.0
 * @since 5.0
 */
function msg_remove_queue($queue) { }

/**
 * Send a message to a message queue
 *
 * @link  http://php.net/manual/en/function.msg-send.php
 *
 * @param resource $queue
 * @param int      $msgtype
 * @param mixed    $message
 * @param bool     $serialize [optional] <p>
 *                            The optional <i>serialize</i> controls how the
 *                            <i>message</i> is sent. <i>serialize</i>
 *                            defaults to <b>TRUE</b> which means that the <i>message</i> is
 *                            serialized using the same mechanism as the session module before being
 *                            sent to the queue. This allows complex arrays and objects to be sent to
 *                            other PHP scripts, or if you are using the WDDX serializer, to any WDDX
 *                            compatible client.
 *                            </p>
 * @param bool     $blocking  [optional] <p>
 *                            If the message is too large to fit in the queue, your script will wait
 *                            until another process reads messages from the queue and frees enough
 *                            space for your message to be sent.
 *                            This is called blocking; you can prevent blocking by setting the
 *                            optional <i>blocking</i> parameter to <b>FALSE</b>, in which
 *                            case <b>msg_send</b> will immediately return <b>FALSE</b> if the
 *                            message is too big for the queue, and set the optional
 *                            <i>errorcode</i> to <b>MSG_EAGAIN</b>,
 *                            indicating that you should try to send your message again a little
 *                            later on.
 *                            </p>
 * @param int      $errorcode [optional]
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * Upon successful completion the message queue data structure is updated as
 * follows: <i>msg_lspid</i> is set to the process-ID of the
 * calling process, <i>msg_qnum</i> is incremented by 1 and
 * <i>msg_stime</i> is set to the current time.
 * @since 4.3.0
 * @since 5.0
 */
function msg_send($queue, $msgtype, $message, $serialize = true, $blocking = true, &$errorcode = null) { }

/**
 * Set information in the message queue data structure
 *
 * @link  http://php.net/manual/en/function.msg-set-queue.php
 *
 * @param resource $queue <p>
 *                        Message queue resource handle
 *                        </p>
 * @param array    $data  <p>
 *                        You specify the values you require by setting the value of the keys
 *                        that you require in the <i>data</i> array.
 *                        </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.3.0
 * @since 5.0
 */
function msg_set_queue($queue, array $data) { }

/**
 * Returns information from the message queue data structure
 *
 * @link  http://php.net/manual/en/function.msg-stat-queue.php
 *
 * @param resource $queue <p>
 *                        Message queue resource handle
 *                        </p>
 *
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
 * @since 4.3.0
 * @since 5.0
 */
function msg_stat_queue($queue) { }

/**
 * Acquire a semaphore
 *
 * @link  http://php.net/manual/en/function.sem-acquire.php
 *
 * @param resource $sem_identifier <p>
 *                                 <i>sem_identifier</i> is a semaphore resource,
 *                                 obtained from <b>sem_get</b>.
 *                                 </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function sem_acquire($sem_identifier) { }

/**
 * Get a semaphore id
 *
 * @link  http://php.net/manual/en/function.sem-get.php
 *
 * @param int $key
 * @param int $max_acquire  [optional] <p>
 *                          The number of processes that can acquire the semaphore simultaneously
 *                          is set to <i>max_acquire</i>.
 *                          </p>
 * @param int $perm         [optional] <p>
 *                          The semaphore permissions. Actually this value is
 *                          set only if the process finds it is the only process currently
 *                          attached to the semaphore.
 *                          </p>
 * @param int $auto_release [optional] <p>
 *                          Specifies if the semaphore should be automatically released on request
 *                          shutdown.
 *                          </p>
 *
 * @return resource a positive semaphore identifier on success, or <b>FALSE</b> on
 * error.
 * @since 4.0
 * @since 5.0
 */
function sem_get($key, $max_acquire = 1, $perm = 0666, $auto_release = 1) { }

/**
 * Release a semaphore
 *
 * @link  http://php.net/manual/en/function.sem-release.php
 *
 * @param resource $sem_identifier <p>
 *                                 A Semaphore resource handle as returned by
 *                                 <b>sem_get</b>.
 *                                 </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function sem_release($sem_identifier) { }

/**
 * Remove a semaphore
 *
 * @link  http://php.net/manual/en/function.sem-remove.php
 *
 * @param resource $sem_identifier <p>
 *                                 A semaphore resource identifier as returned
 *                                 by <b>sem_get</b>.
 *                                 </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.1.0
 * @since 5.0
 */
function sem_remove($sem_identifier) { }

/**
 * Creates or open a shared memory segment
 *
 * @link  http://php.net/manual/en/function.shm-attach.php
 *
 * @param int $key     <p>
 *                     A numeric shared memory segment ID
 *                     </p>
 * @param int $memsize [optional] <p>
 *                     The memory size. If not provided, default to the
 *                     sysvshm.init_mem in the <i>php.ini</i>, otherwise 10000
 *                     bytes.
 *                     </p>
 * @param int $perm    [optional] <p>
 *                     The optional permission bits. Default to 0666.
 *                     </p>
 *
 * @return resource a shared memory segment identifier.
 * @since 4.0
 * @since 5.0
 */
function shm_attach($key, $memsize = null, $perm = 0666) { }

/**
 * Disconnects from shared memory segment
 *
 * @link  http://php.net/manual/en/function.shm-detach.php
 *
 * @param resource $shm_identifier <p>
 *                                 A shared memory resource handle as returned by
 *                                 <b>shm_attach</b>
 *                                 </p>
 *
 * @return bool <b>shm_detach</b> always returns <b>TRUE</b>.
 * @since 4.0
 * @since 5.0
 */
function shm_detach($shm_identifier) { }

/**
 * Returns a variable from shared memory
 *
 * @link  http://php.net/manual/en/function.shm-get-var.php
 *
 * @param resource $shm_identifier <p>
 *                                 Shared memory segment, obtained from <b>shm_attach</b>.
 *                                 </p>
 * @param int      $variable_key   <p>
 *                                 The variable key.
 *                                 </p>
 *
 * @return mixed the variable with the given key.
 * @since 4.0
 * @since 5.0
 */
function shm_get_var($shm_identifier, $variable_key) { }

/**
 * Check whether a specific entry exists
 *
 * @link  http://php.net/manual/en/function.shm-has-var.php
 *
 * @param resource $shm_identifier <p>
 *                                 Shared memory segment, obtained from <b>shm_attach</b>.
 *                                 </p>
 * @param int      $variable_key   <p>
 *                                 The variable key.
 *                                 </p>
 *
 * @return bool <b>TRUE</b> if the entry exists, otherwise <b>FALSE</b>
 * @since 5.3.0
 */
function shm_has_var($shm_identifier, $variable_key) { }

/**
 * Inserts or updates a variable in shared memory
 *
 * @link  http://php.net/manual/en/function.shm-put-var.php
 *
 * @param resource $shm_identifier <p>
 *                                 A shared memory resource handle as returned by
 *                                 <b>shm_attach</b>
 *                                 </p>
 * @param int      $variable_key   <p>
 *                                 The variable key.
 *                                 </p>
 * @param mixed    $variable       <p>
 *                                 The variable. All variable types
 *                                 that <b>serialize</b> supports may be used: generally
 *                                 this means all types except for resources and some internal objects
 *                                 that cannot be serialized.
 *                                 </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function shm_put_var($shm_identifier, $variable_key, $variable) { }

/**
 * Removes shared memory from Unix systems
 *
 * @link  http://php.net/manual/en/function.shm-remove.php
 *
 * @param resource $shm_identifier <p>
 *                                 The shared memory identifier as returned by
 *                                 <b>shm_attach</b>
 *                                 </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function shm_remove($shm_identifier) { }

/**
 * Removes a variable from shared memory
 *
 * @link  http://php.net/manual/en/function.shm-remove-var.php
 *
 * @param resource $shm_identifier <p>
 *                                 The shared memory identifier as returned by
 *                                 <b>shm_attach</b>
 *                                 </p>
 * @param int      $variable_key   <p>
 *                                 The variable key.
 *                                 </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function shm_remove_var($shm_identifier, $variable_key) { }
