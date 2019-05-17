<?php
/**
 * Stubs for stomp
 * https://pecl.php.net/package/stomp
 */

class Stomp
{

    /**
     * Connect to server
     *
     * @param string $broker The broker URI
     * @param string $username The username
     * @param string $password The password
     * @param array  $headers additional headers (example: receipt).
     */
    public function __construct($broker = null, $username = null, $password = null, array $headers = array()) {}

    /**
     * Get the current stomp session ID
     *
     * @return string stomp session ID if it exists, or FALSE otherwise
     */
    public function getSessionId() {}

    /**
     * Close stomp connection
     *
     * @return boolean TRUE on success, or FALSE on failure
     */
    public function disconnect() {}

    /**
     * Sends a message to a destination in the messaging system
     *
     * @param string            $destination indicates where to send the message
     * @param string|StompFrame $msg message to be sent
     * @param array             $headers additional headers (example: receipt).
     * @return boolean TRUE on success, or FALSE on failure
     */
    public function send($destination, $msg, array $headers = array()) {}

    /**
     * Register to listen to a given destination
     *
     * @param string $destination indicates which destination to subscribe to
     * @param array  $headers additional headers (example: receipt).
     * @return boolean TRUE on success, or FALSE on failure
     */
    public function subscribe($destination, array $headers = array()) {}

    /**
     * Remove an existing subscription
     *
     * @param string $destination indicates which subscription to remove
     * @param array  $headers additional headers (example: receipt).
     * @return boolean TRUE on success, or FALSE on failure
     */
    public function unsubscribe($destination, array $headers = array()) {}

    /**
     * Indicate whether or not there is a frame ready to read
     *
     * @return boolean TRUE if there is one, or FALSE otherwise
     */
    public function hasFrame() {}

    /**
     * Read the next frame
     *
     * @param string $className name of the class to instantiate.
     * @return object on success, or FALSE on failure
     */
    public function readFrame($className = 'stompFrame') {}

    /**
     * Start a transaction
     *
     * @param string $transaction_id transaction id
     * @return boolean TRUE on success, or FALSE on failure
     */
    public function begin($transaction_id) {}

    /**
     * Commit a transaction in progress
     *
     * @param string $transaction_id transaction id
     * @return boolean TRUE on success, or FALSE on failure
     */
    public function commit($transaction_id) {}

    /**
     * Roll back a transaction in progress
     *
     * @param string $transaction_id transaction id
     * @return boolean TRUE on success, or FALSE on failure
     */
    public function abort($transaction_id) {}

    /**
     * Acknowledge consumption of a message from a subscription using client acknowledgment
     *
     * @param string|StompFrame $msg message/messageId to be acknowledged
     * @param array             $headers additional headers (example: receipt).
     * @return boolean TRUE on success, or FALSE on failure
     */
    public function ack($msg, array $headers = array()) {}

    /**
     * Get the last stomp error
     *
     * @return string Error message, or FALSE if no error
     */
    public function error() {}

    /**
     * Set timeout
     *
     * @param int $seconds the seconds part of the timeout to be set
     * @param int $microseconds the microseconds part of the timeout to be set
     * @return void
     */
    public function setTimeout($seconds, $microseconds = 0) {}

    /**
     * Get timeout
     *
     * @return array Array with timeout informations
     */
    public function getTimeout() {}

}

class StompFrame
{

    /**
     * Frame Command
     * @var String
     */
    public $command;

    /**
     * Frame headers
     * @var Array
     */
    public $headers;

    /**
     * Frame body
     * @var String
     */
    public $body;
}

class StompException extends Exception
{

    /**
     * Get the stomp server error details
     *
     * @return string
     */
    public function getDetails() {}
}

/**
 * Get the current version of the stomp extension
 *
 * @return string version
 */
function stomp_version() {}

/**
 * Connect to server
 *
 * @param string $broker broker URI
 * @param string $username The username
 * @param string $password The password
 * @param array  $headers additional headers (example: receipt).
 * @return resource stomp connection identifier on success, or FALSE on failure
 */
function stomp_connect($broker = null, $username = null, $password = null, array $headers = array()) {}

/**
 * Get the current stomp session ID
 *
 * @param resource $link identifier returned by stomp_connect
 * @return string stomp session ID if it exists, or FALSE otherwise
 */
function stomp_get_session_id($link) {}

/**
 * Close stomp connection
 *
 * @param resource $link identifier returned by stomp_connect
 * @return boolean TRUE on success, or FALSE on failure
 */
function stomp_close($link) {}

/**
 * Sends a message to a destination in the messaging system
 *
 * @param resource         $link identifier returned by stomp_connect
 * @param string            $destination indicates where to send the message
 * @param string|StompFrame $msg message to be sent
 * @param array             $headers additional headers (example: receipt).
 * @return boolean TRUE on success, or FALSE on failure
 */
function stomp_send($link, $destination, $msg, array $headers = array()) {}

/**
 * Register to listen to a given destination
 *
 * @param resource $link identifier returned by stomp_connect
 * @param string    $destination indicates which destination to subscribe to
 * @param array     $headers additional headers (example: receipt).
 * @return boolean TRUE on success, or FALSE on failure
 */
function stomp_subscribe($link, $destination, array $headers = array()) {}

/**
 * Remove an existing subscription
 *
 * @param resource $link identifier returned by stomp_connect
 * @param string    $destination indicates which subscription to remove
 * @param array     $headers additional headers (example: receipt).
 * @return boolean TRUE on success, or FALSE on failure
 */
function stomp_unsubscribe($link, $destination, array $headers = array()) {}

/**
 * Indicate whether or not there is a frame ready to read
 *
 * @param resource $link identifier returned by stomp_connect
 * @return boolean TRUE if there is one, or FALSE otherwise
 */
function stomp_has_frame($link) {}

/**
 * Read the next frame
 *
 * @param resource $link identifier returned by stomp_connect
 * @return array on success, or FALSE on failure
 */
function stomp_read_frame($link) {}

/**
 * Start a transaction
 *
 * @param resource $link identifier returned by stomp_connect
 * @param string    $transaction_id transaction id
 * @return boolean TRUE on success, or FALSE on failure
 */
function stomp_begin($link, $transaction_id) {}

/**
 * Commit a transaction in progress
 *
 * @param resource $link identifier returned by stomp_connect
 * @param string    $transaction_id transaction id
 * @return boolean TRUE on success, or FALSE on failure
 */
function stomp_commit($link, $transaction_id) {}

/**
 * Roll back a transaction in progress
 *
 * @param resource $link identifier returned by stomp_connect
 * @param string    $transaction_id transaction id
 * @return boolean TRUE on success, or FALSE on failure
 */
function stomp_abort($link, $transaction_id) {}

/**
 * Acknowledge consumption of a message from a subscription using client acknowledgment
 *
 * @param resource         $link identifier returned by stomp_connect
 * @param string|StompFrame $msg message/messageId to be acknowledged
 * @param array             $headers additional headers (example: receipt).
 * @return boolean TRUE on success, or FALSE on failure
 */
function stomp_ack($link, $msg, array $headers = array()) {}

/**
 * Get the last stomp error
 *
 * @param resource $link identifier returned by stomp_connect
 * @return string Error message, or FALSE if no error
 */
function stomp_error($link) {}

/**
 * Set timeout
 *
 * @param resource $link identifier returned by stomp_connect
 * @param int       $seconds the seconds part of the timeout to be set
 * @param int       $microseconds the microseconds part of the timeout to be set
 * @return void
 */
function stomp_set_timeout($link, $seconds, $microseconds = 0) {}

/**
 * Get timeout
 *
 * @param resource $link identifier returned by stomp_connect
 * @return array Array with timeout informations
 */
function stomp_get_timeout($link) {}
