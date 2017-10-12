<?php
/**
 * Stubs for AMQP
 * https://pecl.php.net/package/amqp
 * https://github.com/pdezwart/php-amqp
 */

/**
 * Passing in this constant as a flag will forcefully disable all other flags.
 * Use this if you want to temporarily disable the amqp.auto_ack ini setting.
 */
define('AMQP_NOPARAM', 0);

/**
 * Durable exchanges and queues will survive a broker restart, complete with all of their data.
 */
define('AMQP_DURABLE', 2);

/**
 * Passive exchanges and queues will not be redeclared, but the broker will throw an error if the exchange or queue does not exist.
 */
define('AMQP_PASSIVE', 4);

/**
 * Valid for queues only, this flag indicates that only one client can be listening to and consuming from this queue.
 */
define('AMQP_EXCLUSIVE', 8);

/**
 * For exchanges, the auto delete flag indicates that the exchange will be deleted as soon as no more queues are bound
 * to it. If no queues were ever bound the exchange, the exchange will never be deleted. For queues, the auto delete
 * flag indicates that the queue will be deleted as soon as there are no more listeners subscribed to it. If no
 * subscription has ever been active, the queue will never be deleted. Note: Exclusive queues will always be
 * automatically deleted with the client disconnects.
 */
define('AMQP_AUTODELETE', 16);

/**
 * Clients are not allowed to make specific queue bindings to exchanges defined with this flag.
 */
define('AMQP_INTERNAL', 32);

/**
 * When passed to the consume method for a clustered environment, do not consume from the local node.
 */
define('AMQP_NOLOCAL', 64);

/**
 * When passed to the {@link AMQPQueue::get()} and {@link AMQPQueue::consume()} methods as a flag,
 * the messages will be immediately marked as acknowledged by the server upon delivery.
 */
define('AMQP_AUTOACK', 128);

/**
 * Passed on queue creation, this flag indicates that the queue should be deleted if it becomes empty.
 */
define('AMQP_IFEMPTY', 256);

/**
 * Passed on queue or exchange creation, this flag indicates that the queue or exchange should be
 * deleted when no clients are connected to the given queue or exchange.
 */
define('AMQP_IFUNUSED', 512);

/**
 * When publishing a message, the message must be routed to a valid queue. If it is not, an error will be returned.
 */
define('AMQP_MANDATORY', 1024);

/**
 * When publishing a message, mark this message for immediate processing by the broker. (High priority message.)
 */
define('AMQP_IMMEDIATE', 2048);

/**
 * If set during a call to {@link AMQPQueue::ack()}, the delivery tag is treated as "up to and including", so that multiple
 * messages can be acknowledged with a single method. If set to zero, the delivery tag refers to a single message.
 * If the AMQP_MULTIPLE flag is set, and the delivery tag is zero, this indicates acknowledgement of all outstanding
 * messages.
 */
define('AMQP_MULTIPLE', 4096);

/**
 * If set during a call to {@link AMQPExchange::bind()}, the server will not respond to the method.The client should not wait
 * for a reply method. If the server could not complete the method it will raise a channel or connection exception.
 */
define('AMQP_NOWAIT', 8192);

/**
 * If set during a call to {@link AMQPQueue::nack()}, the message will be placed back to the queue.
 */
define('AMQP_REQUEUE', 16384);

/**
 * A direct exchange type.
 */
define('AMQP_EX_TYPE_DIRECT', 'direct');

/**
 * A fanout exchange type.
 */
define('AMQP_EX_TYPE_FANOUT', 'fanout');

/**
 * A topic exchange type.
 */
define('AMQP_EX_TYPE_TOPIC', 'topic');

/**
 * A header exchange type.
 */
define('AMQP_EX_TYPE_HEADERS', 'headers');

/**
 *
 */
define('AMQP_OS_SOCKET_TIMEOUT_ERRNO', 536870947);

/**
 *
 */
define('PHP_AMQP_MAX_CHANNELS', 256);

/**
 * Represents a AMQP channel between PHP and a AMQP server.
 * @link https://github.com/pdezwart/php-amqp/blob/master/amqp_channel.h
 */
class AMQPChannel
{
    /**
     * Create an instance of an AMQPChannel object.
     *
     * @param AMQPConnection $amqp_connection An instance of AMQPConnection
     *                                        with an active connection to a
     *                                        broker.
     *
     * @throws AMQPConnectionException        If the connection to the broker
     *                                        was lost.
     */
    public function __construct(AMQPConnection $amqp_connection) { }

    /**
     * Check the channel connection.
     *
     * @return bool Indicates whether the channel is connected.
     */
    public function isConnected() { }

    /**
     * Return internal channel ID
     *
     * @return integer
     */
    public function getChannelId() { }

    /**
     * Set the window size to prefetch from the broker.
     *
     * Set the prefetch window size, in octets, during a call to
     * AMQPQueue::consume() or AMQPQueue::get(). Any call to this method will
     * automatically set the prefetch message count to 0, meaning that the
     * prefetch message count setting will be ignored. If the call to either
     * AMQPQueue::consume() or AMQPQueue::get() is done with the AMQP_AUTOACK
     * flag set, this setting will be ignored.
     *
     * @param integer $size The window size, in octets, to prefetch.
     *
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return bool TRUE on success or FALSE on failure.
     */
    public function setPrefetchSize($size) { }

    /**
     * Get the window size to prefetch from the broker.
     *
     * @return integer
     */
    public function getPrefetchSize() { }

    /**
     * Set the number of messages to prefetch from the broker.
     *
     * Set the number of messages to prefetch from the broker during a call to
     * AMQPQueue::consume() or AMQPQueue::get(). Any call to this method will
     * automatically set the prefetch window size to 0, meaning that the
     * prefetch window size setting will be ignored.
     *
     * @param integer $count The number of messages to prefetch.
     *
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function setPrefetchCount($count) { }

    /**
     * Get the number of messages to prefetch from the broker.
     *
     * @return integer
     */
    public function getPrefetchCount() { }

    /**
     * Set the Quality Of Service settings for the given channel.
     *
     * Specify the amount of data to prefetch in terms of window size (octets)
     * or number of messages from a queue during a AMQPQueue::consume() or
     * AMQPQueue::get() method call. The client will prefetch data up to size
     * octets or count messages from the server, whichever limit is hit first.
     * Setting either value to 0 will instruct the client to ignore that
     * particular setting. A call to AMQPChannel::qos() will overwrite any
     * values set by calling AMQPChannel::setPrefetchSize() and
     * AMQPChannel::setPrefetchCount(). If the call to either
     * AMQPQueue::consume() or AMQPQueue::get() is done with the AMQP_AUTOACK
     * flag set, the client will not do any prefetching of data, regardless of
     * the QOS settings.
     *
     * @param integer $size  The window size, in octets, to prefetch.
     * @param integer $count The number of messages to prefetch.
     *
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return bool TRUE on success or FALSE on failure.
     */
    public function qos($size, $count) { }

    /**
     * Start a transaction.
     *
     * This method must be called on the given channel prior to calling
     * AMQPChannel::commitTransaction() or AMQPChannel::rollbackTransaction().
     *
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return bool TRUE on success or FALSE on failure.
     */
    public function startTransaction() { }

    /**
     * Commit a pending transaction.
     *
     * @throws AMQPChannelException    If no transaction was started prior to
     *                                 calling this method.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return bool TRUE on success or FALSE on failure.
     */
    public function commitTransaction() { }

    /**
     * Rollback a transaction.
     *
     * Rollback an existing transaction. AMQPChannel::startTransaction() must
     * be called prior to this.
     *
     * @throws AMQPChannelException    If no transaction was started prior to
     *                                 calling this method.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return bool TRUE on success or FALSE on failure.
     */
    public function rollbackTransaction() { }

    /**
     * Get the AMQPConnection object in use
     *
     * @return AMQPConnection
     */
    public function getConnection() { }

    /**
     * Redeliver unacknowledged messages.
     *
     * @param bool $requeue
     */
    public function basicRecover($requeue = true) { }
}

class AMQPChannelException extends AMQPException
{
}

/**
 * Represents a AMQP connection between PHP and a AMQP server.
 * @link https://github.com/pdezwart/php-amqp/blob/master/amqp_connection.h
 */
class AMQPConnection
{
    /**
     * Create an instance of AMQPConnection.
     *
     * Creates an AMQPConnection instance representing a connection to an AMQP
     * broker. A connection will not be established until
     * AMQPConnection::connect() is called.
     *
     *  $credentials = array(
     *      'host'  => amqp.host The host to connect too. Note: Max 1024 characters.
     *      'port'  => amqp.port Port on the host.
     *      'vhost' => amqp.vhost The virtual host on the host. Note: Max 128 characters.
     *      'login' => amqp.login The login name to use. Note: Max 128 characters.
     *      'password' => amqp.password Password. Note: Max 128 characters.
     *      'read_timeout'  => Timeout in for income activity. Note: 0 or greater seconds. May be fractional.
     *      'write_timeout' => Timeout in for outcome activity. Note: 0 or greater seconds. May be fractional.
     *      'connect_timeout' => Connection timeout. Note: 0 or greater seconds. May be fractional.
     * )
     *
     * @param array $credentials Optional array of credential information for
     *                           connecting to the AMQP broker.
     */
    public function __construct(array $credentials = array()) { }

    /**
     * Check whether the connection to the AMQP broker is still valid.
     *
     * It does so by checking the return status of the last connect-command.
     *
     * @return boolean True if connected, false otherwise.
     */
    public function isConnected() { }

    /**
     * Establish a transient connection with the AMQP broker.
     *
     * This method will initiate a connection with the AMQP broker.
     *
     * @throws AMQPConnectionException
     * @return boolean TRUE on success or throw an exception on failure.
     */
    public function connect() { }

    /**
     * Establish a persistent connection with the AMQP broker.
     *
     * This method will initiate a connection with the AMQP broker
     * or reuse an existing one if present.
     *
     * @throws AMQPConnectionException
     * @return boolean TRUE on success or throws an exception on failure.
     */
    public function pconnect() { }

    /**
     * Closes a persistent connection with the AMQP broker.
     *
     * This method will close an open persistent connection with the AMQP
     * broker.
     *
     * @return boolean true if connection was found and closed,
     *                 false if no persistent connection with this host,
     *                 port, vhost and login could be found,
     */
    public function pdisconnect() { }

    /**
     * Closes the transient connection with the AMQP broker.
     *
     * This method will close an open connection with the AMQP broker.
     *
     * @return boolean true if connection was successfully closed, false otherwise.
     */
    public function disconnect() { }

    /**
     * Close any open transient connections and initiate a new one with the AMQP broker.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function reconnect() { }

    /**
     * Close any open persistent connections and initiate a new one with the AMQP broker.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function preconnect() { }

    /**
     * Get the configured login.
     *
     * @return string The configured login as a string.
     */
    public function getLogin() { }

    /**
     * Set the login string used to connect to the AMQP broker.
     *
     * @param string $login The login string used to authenticate
     *                      with the AMQP broker.
     *
     * @throws AMQPConnectionException If login is longer then 32 characters.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function setLogin($login) { }

    /**
     * Get the configured password.
     *
     * @return string The configured password as a string.
     */
    public function getPassword() { }

    /**
     * Set the password string used to connect to the AMQP broker.
     *
     * @param string $password The password string used to authenticate
     *                         with the AMQP broker.
     *
     * @throws AMQPConnectionException If password is longer then 32characters.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function setPassword($password) { }

    /**
     * Get the configured host.
     *
     * @return string The configured hostname of the broker
     */
    public function getHost() { }

    /**
     * Set the hostname used to connect to the AMQP broker.
     *
     * @param string $host The hostname of the AMQP broker.
     *
     * @throws AMQPConnectionException If host is longer then 1024 characters.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function setHost($host) { }

    /**
     * Get the configured port.
     *
     * @return int The configured port as an integer.
     */
    public function getPort() { }

    /**
     * Set the port used to connect to the AMQP broker.
     *
     * @param integer $port The port used to connect to the AMQP broker.
     *
     * @throws AMQPConnectionException If port is longer not between
     *                                 1 and 65535.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function setPort($port) { }

    /**
     * Get the configured vhost.
     *
     * @return string The configured virtual host as a string.
     */
    public function getVhost() { }

    /**
     * Sets the virtual host to which to connect on the AMQP broker.
     *
     * @param string $vhost The virtual host to use on the AMQP
     *                      broker.
     *
     * @throws AMQPConnectionException If host is longer then 32 characters.
     *
     * @return boolean true on success or false on failure.
     */
    public function setVhost($vhost) { }

    /**
     * Get the configured interval of time to wait for income activity
     * from AMQP broker
     *
     * @deprecated use AMQPConnection::getReadTimout() instead
     *
     * @return float
     */
    public function getTimeout() { }

    /**
     * Sets the interval of time to wait for income activity from AMQP broker
     *
     * @deprecated use AMQPConnection::setReadTimout($timeout) instead
     *
     * @param int $timeout
     *
     * @return bool
     */
    public function setTimeout($timeout) { }

    /**
     * Get the configured interval of time to wait for income activity
     * from AMQP broker
     *
     * @return float
     */
    public function getReadTimeout() { }

    /**
     * Sets the interval of time to wait for income activity from AMQP broker
     *
     * @param int $timeout
     *
     * @return bool
     */
    public function setReadTimeout($timeout) { }

    /**
     * Get the configured interval of time to wait for outcome activity
     * to AMQP broker
     *
     * @return float
     */
    public function getWriteTimeout() { }

    /**
     * Sets the interval of time to wait for outcome activity to AMQP broker
     *
     * @param int $timeout
     *
     * @return bool
     */
    public function setWriteTimeout($timeout) { }

    /**
     * Return last used channel id during current connection session.
     *
     * @return int
     */
    public function getUsedChannels() { }

    /**
     * Get the maximum number of channels the connection can handle.
     *
     * @return int|null
     */
    public function getMaxChannels() { }

    /**
     * Whether connection persistent.
     *
     * @return bool|null
     */
    public function isPersistent() { }
}

class AMQPConnectionException extends AMQPException
{
}

/**
 * Represents a AMQP envelope
 * @link https://github.com/pdezwart/php-amqp/blob/master/amqp_envelope.h
 */
class AMQPEnvelope
{
    /**
     * Get the body of the message.
     *
     * @return string The contents of the message body.
     */
    public function getBody() { }

    /**
     * Get the routing key of the message.
     *
     * @return string The message routing key.
     */
    public function getRoutingKey() { }

    /**
     * Get the delivery tag of the message.
     *
     * @return string The delivery tag of the message.
     */
    public function getDeliveryTag() { }

    /**
     * Get the delivery mode of the message.
     *
     * @return integer The delivery mode of the message.
     */
    public function getDeliveryMode() { }

    /**
     * Get the exchange name on which the message was published.
     *
     * @return string The exchange name on which the message was published.
     */
    public function getExchangeName() { }

    /**
     * Whether this is a redelivery of the message.
     *
     * Whether this is a redelivery of a message. If this message has been
     * delivered and AMQPEnvelope::nack() was called, the message will be put
     * back on the queue to be redelivered, at which point the message will
     * always return TRUE when this method is called.
     *
     * @return bool TRUE if this is a redelivery, FALSE otherwise.
     */
    public function isRedelivery() { }

    /**
     * Get the message content type.
     *
     * @return string The content type of the message.
     */
    public function getContentType() { }

    /**
     * Get the content encoding of the message.
     *
     * @return string The content encoding of the message.
     */
    public function getContentEncoding() { }

    /**
     * Get the message type.
     *
     * @return string The message type.
     */
    public function getType() { }

    /**
     * Get the timestamp of the message.
     *
     * @return string The message timestamp.
     */
    public function getTimeStamp() { }

    /**
     * Get the priority of the message.
     *
     * @return int The message priority.
     */
    public function getPriority() { }

    /**
     * Get the expiration of the message.
     *
     * @return string The message expiration.
     */
    public function getExpiration() { }

    /**
     * Get the message user id.
     *
     * @return string The message user id.
     */
    public function getUserId() { }

    /**
     * Get the application id of the message.
     *
     * @return string The application id of the message.
     */
    public function getAppId() { }

    /**
     * Get the message id of the message.
     *
     * @return string The message id
     */
    public function getMessageId() { }

    /**
     * Get the reply-to address of the message.
     *
     * @return string The contents of the reply to field.
     */
    public function getReplyTo() { }

    /**
     * Get the message correlation id.
     *
     * @return string The correlation id of the message.
     */
    public function getCorrelationId() { }

    /**
     * Get the headers of the message.
     *
     * @return array An array of key value pairs associated with the message.
     */
    public function getHeaders() { }

    /**
     * Get a specific message header.
     *
     * @param string $header_key Name of the header to get the value from.
     *
     * @return string|boolean The contents of the specified header or FALSE
     *                        if not set.
     */
    public function getHeader($header_key) { }
}

class AMQPException extends Exception
{
}

/**
 * Represents a AMQP exchange
 * @link https://github.com/pdezwart/php-amqp/blob/master/amqp_exchange.h
 */
class AMQPExchange
{
    /**
     * Create an instance of AMQPExchange.
     *
     * Returns a new instance of an AMQPExchange object, associated with the
     * given AMQPChannel object.
     *
     * @param AMQPChannel $amqp_channel A valid AMQPChannel object, connected
     *                                  to a broker.
     *
     * @throws AMQPExchangeException   When amqp_channel is not connected to
     *                                 a broker.
     * @throws AMQPConnectionException If the connection to the broker was
     *                                 lost.
     */
    public function __construct(AMQPChannel $amqp_channel) { }

    /**
     * Get the configured name.
     *
     * @return string The configured name as a string.
     */
    public function getName() { }

    /**
     * Set the name of the exchange.
     *
     * @param string $exchange_name The name of the exchange to set as string.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function setName($exchange_name) { }

    /**
     * Get the configured type.
     *
     * @return string The configured type as a string.
     */
    public function getType() { }

    /**
     * Set the type of the exchange.
     *
     * Set the type of the exchange. This can be any of AMQP_EX_TYPE_DIRECT,
     * AMQP_EX_TYPE_FANOUT, AMQP_EX_TYPE_HEADERS or AMQP_EX_TYPE_TOPIC.
     *
     * @param string $exchange_type The type of exchange as a string.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function setType($exchange_type) { }

    /**
     * Get all the flags currently set on the given exchange.
     *
     * @return int An integer bitmask of all the flags currently set on this
     *             exchange object.
     */
    public function getFlags() { }

    /**
     * Set the flags on an exchange.
     *
     * @param integer $flags A bitmask of flags. This call currently only
     *                       considers the following flags:
     *                       AMQP_DURABLE, AMQP_PASSIVE
     *                       (and AMQP_DURABLE, if librabbitmq version >= 0.5.3)
     *
     * @return boolean True on success or false on failure.
     */
    public function setFlags($flags) { }

    /**
     * Get the argument associated with the given key.
     *
     * @param string $key The key to look up.
     *
     * @return string|integer|boolean The string or integer value associated
     *                                with the given key, or FALSE if the key
     *                                is not set.
     */
    public function getArgument($key) { }

    /**
     * Get all arguments set on the given exchange.
     *
     * @return array An array containing all of the set key/value pairs.
     */
    public function getArguments() { }

    /**
     * Set the value for the given key.
     *
     * @param string         $key   Name of the argument to set.
     * @param string|integer $value Value of the argument to set.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function setArgument($key, $value) { }

    /**
     * Set all arguments on the exchange.
     *
     * @param array $arguments An array of key/value pairs of arguments.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function setArguments(array $arguments) { }

    /**
     * Declare a new exchange on the broker.
     *
     * @throws AMQPExchangeException   On failure.
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function declareExchange() { }

    /**
     * Delete the exchange from the broker.
     *
     * @param string  $exchangeName Optional name of exchange to delete.
     * @param integer $flags        Optionally AMQP_IFUNUSED can be specified
     *                              to indicate the exchange should not be
     *                              deleted until no clients are connected to
     *                              it.
     *
     * @throws AMQPExchangeException   On failure.
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean true on success or false on failure.
     */
    public function delete($exchangeName = null, $flags = AMQP_NOPARAM) { }

    /**
     * Bind to another exchange.
     *
     * Bind an exchange to another exchange using the specified routing key.
     *
     * @param string $exchange_name Name of the exchange to bind.
     * @param string $routing_key   The routing key to use for binding.
     * @param array  $arguments     Additional binding arguments.
     *
     * @throws AMQPExchangeException   On failure.
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     * @return boolean true on success or false on failure.
     */
    public function bind($exchange_name, $routing_key = '', array $arguments = array()) { }

    /**
     * Remove binding to another exchange.
     *
     * Remove a routing key binding on an another exchange from the given exchange.
     *
     * @param string $exchange_name Name of the exchange to bind.
     * @param string $routing_key   The routing key to use for binding.
     * @param array  $arguments     Additional binding arguments.
     *
     * @throws AMQPExchangeException   On failure.
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     * @return boolean true on success or false on failure.
     */
    public function unbind($exchange_name, $routing_key = '', array $arguments = array()) { }

    /**
     * Publish a message to an exchange.
     *
     * Publish a message to the exchange represented by the AMQPExchange object.
     *
     * @param string  $message     The message to publish.
     * @param string  $routing_key The optional routing key to which to
     *                             publish to.
     * @param integer $flags       One or more of AMQP_MANDATORY and
     *                             AMQP_IMMEDIATE.
     * @param array   $attributes  One of content_type, content_encoding,
     *                             message_id, user_id, app_id, delivery_mode,
     *                             priority, timestamp, expiration, type
     *                             or reply_to, headers.
     *
     * @throws AMQPExchangeException   On failure.
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    public function publish(
        $message,
        $routing_key = null,
        $flags = AMQP_NOPARAM,
        array $attributes = array()
    ) {
    }

    /**
     * Get the AMQPChannel object in use
     *
     * @return AMQPChannel
     */
    public function getChannel() { }

    /**
     * Get the AMQPConnection object in use
     *
     * @return AMQPConnection
     */
    public function getConnection() { }
}

class AMQPExchangeException extends AMQPException
{
}

/**
 * Represents a AMQP queue
 * @link https://github.com/pdezwart/php-amqp/blob/master/amqp_queue.h
 */
class AMQPQueue
{
    /**
     * Create an instance of an AMQPQueue object.
     *
     * @param AMQPChannel $amqp_channel The amqp channel to use.
     *
     * @throws AMQPQueueException      When amqp_channel is not connected to a
     *                                 broker.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     */
    public function __construct(AMQPChannel $amqp_channel) { }

    /**
     * Get the configured name.
     *
     * @return string The configured name as a string.
     */
    public function getName() { }

    /**
     * Set the queue name.
     *
     * @param string $queue_name The name of the queue.
     *
     * @return boolean
     */
    public function setName($queue_name) { }

    /**
     * Get all the flags currently set on the given queue.
     *
     * @return int An integer bitmask of all the flags currently set on this
     *             exchange object.
     */
    public function getFlags() { }

    /**
     * Set the flags on the queue.
     *
     * @param integer $flags A bitmask of flags:
     *                       AMQP_DURABLE, AMQP_PASSIVE,
     *                       AMQP_EXCLUSIVE, AMQP_AUTODELETE.
     *
     * @return boolean
     */
    public function setFlags($flags) { }

    /**
     * Get the argument associated with the given key.
     *
     * @param string $key The key to look up.
     *
     * @return string|integer|boolean The string or integer value associated
     *                                with the given key, or false if the key
     *                                is not set.
     */
    public function getArgument($key) { }

    /**
     * Get all set arguments as an array of key/value pairs.
     *
     * @return array An array containing all of the set key/value pairs.
     */
    public function getArguments() { }

    /**
     * Set a queue argument.
     *
     * @param string $key   The key to set.
     * @param mixed  $value The value to set.
     *
     * @return boolean
     */
    public function setArgument($key, $value) { }

    /**
     * Set all arguments on the given queue.
     *
     * All other argument settings will be wiped.
     *
     * @param array $arguments An array of key/value pairs of arguments.
     *
     * @return boolean
     */
    public function setArguments(array $arguments) { }

    /**
     * Declare a new queue on the broker.
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return integer the message count.
     */
    public function declareQueue() { }

    /**
     * Bind the given queue to a routing key on an exchange.
     *
     * @param string $exchange_name Name of the exchange to bind to.
     * @param string $routing_key   Pattern or routing key to bind with.
     * @param array  $arguments     Additional binding arguments.
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean
     */
    public function bind($exchange_name, $routing_key = null, array $arguments = array()) { }

    /**
     * Retrieve the next message from the queue.
     *
     * Retrieve the next available message from the queue. If no messages are
     * present in the queue, this function will return FALSE immediately. This
     * is a non blocking alternative to the AMQPQueue::consume() method.
     * Currently, the only supported flag for the flags parameter is
     * AMQP_AUTOACK. If this flag is passed in, then the message returned will
     * automatically be marked as acknowledged by the broker as soon as the
     * frames are sent to the client.
     *
     * @param integer $flags A bitmask of supported flags for the
     *                       method call. Currently, the only the
     *                       supported flag is AMQP_AUTOACK. If this
     *                       value is not provided, it will use the
     *                       value of ini-setting amqp.auto_ack.
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return AMQPEnvelope|boolean
     */
    public function get($flags = AMQP_NOPARAM) { }

    /**
     * Consume messages from a queue.
     *
     * Blocking function that will retrieve the next message from the queue as
     * it becomes available and will pass it off to the callback.
     *
     * @param callable | null $callback    A callback function to which the
     *                              consumed message will be passed. The
     *                              function must accept at a minimum
     *                              one parameter, an AMQPEnvelope object,
     *                              and an optional second parameter
     *                              the AMQPQueue object from which callback
     *                              was invoked. The AMQPQueue::consume() will
     *                              not return the processing thread back to
     *                              the PHP script until the callback
     *                              function returns FALSE.
     *                              If the callback is omitted or null is passed,
     *                              then the messages delivered to this client will
     *                              be made available to the first real callback
     *                              registered. That allows one to have a single
     *                              callback consuming from multiple queues.
     * @param integer  $flags       A bitmask of any of the flags: AMQP_AUTOACK.
     * @param string   $consumerTag A string describing this consumer. Used
     *                              for canceling subscriptions with cancel().
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return void
     */
    public function consume(
        callable $callback = null,
        $flags = AMQP_NOPARAM,
        $consumerTag = null
    ) {
    }

    /**
     * Acknowledge the receipt of a message.
     *
     * This method allows the acknowledgement of a message that is retrieved
     * without the AMQP_AUTOACK flag through AMQPQueue::get() or
     * AMQPQueue::consume()
     *
     * @param string  $delivery_tag The message delivery tag of which to
     *                              acknowledge receipt.
     * @param integer $flags        The only valid flag that can be passed is
     *                              AMQP_MULTIPLE.
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean
     */
    public function ack($delivery_tag, $flags = AMQP_NOPARAM) { }

    /**
     * Mark a message as explicitly not acknowledged.
     *
     * Mark the message identified by delivery_tag as explicitly not
     * acknowledged. This method can only be called on messages that have not
     * yet been acknowledged, meaning that messages retrieved with by
     * AMQPQueue::consume() and AMQPQueue::get() and using the AMQP_AUTOACK
     * flag are not eligible. When called, the broker will immediately put the
     * message back onto the queue, instead of waiting until the connection is
     * closed. This method is only supported by the RabbitMQ broker. The
     * behavior of calling this method while connected to any other broker is
     * undefined.
     *
     * @param string  $delivery_tag Delivery tag of last message to reject.
     * @param integer $flags        AMQP_REQUEUE to requeue the message(s),
     *                              AMQP_MULTIPLE to nack all previous
     *                              unacked messages as well.
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean
     */
    public function nack($delivery_tag, $flags = AMQP_NOPARAM) { }

    /**
     * Mark one message as explicitly not acknowledged.
     *
     * Mark the message identified by delivery_tag as explicitly not
     * acknowledged. This method can only be called on messages that have not
     * yet been acknowledged, meaning that messages retrieved with by
     * AMQPQueue::consume() and AMQPQueue::get() and using the AMQP_AUTOACK
     * flag are not eligible.
     *
     * @param string  $delivery_tag Delivery tag of the message to reject.
     * @param integer $flags        AMQP_REQUEUE to requeue the message(s).
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean
     */
    public function reject($delivery_tag, $flags = AMQP_NOPARAM) { }

    /**
     * Purge the contents of a queue.
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean
     */
    public function purge() { }

    /**
     * Cancel a queue that is already bound to an exchange and routing key.
     *
     * @param string $consumer_tag The queue name to cancel, if the queue
     *                             object is not already representative of
     *                             a queue.
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return bool
     */
    public function cancel($consumer_tag = '') { }

    /**
     * Remove a routing key binding on an exchange from the given queue.
     *
     * @param string $exchange_name The name of the exchange on which the
     *                              queue is bound.
     * @param string $routing_key   The binding routing key used by the
     *                              queue.
     * @param array  $arguments     Additional binding arguments.
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return boolean
     */
    public function unbind($exchange_name, $routing_key = null, array $arguments = array()) { }

    /**
     * Delete a queue from the broker.
     *
     * This includes its entire contents of unread or unacknowledged messages.
     *
     * @param integer $flags        Optionally AMQP_IFUNUSED can be specified
     *                              to indicate the queue should not be
     *                              deleted until no clients are connected to
     *                              it.
     *
     * @throws AMQPChannelException    If the channel is not open.
     * @throws AMQPConnectionException If the connection to the broker was lost.
     *
     * @return integer The number of deleted messages.
     */
    public function delete($flags = AMQP_NOPARAM) { }

    /**
     * Get the AMQPChannel object in use
     *
     * @return AMQPChannel
     */
    public function getChannel() { }

    /**
     * Get the AMQPConnection object in use
     *
     * @return AMQPConnection
     */
    public function getConnection() { }
}

class AMQPQueueException extends AMQPException
{
}
