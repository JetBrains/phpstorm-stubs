<?php

// Start of wddx v.

/**
 * (PHP 4, PHP 5)<br/>
 * Serialize a single value into a WDDX packet
 * @link http://php.net/manual/en/function.wddx-serialize-value.php
 * @param mixed $var <p>
 * The value to be serialized
 * </p>
 * @param string $comment [optional] <p>
 * An optional comment string that appears in the packet header.
 * </p>
 * @return string the WDDX packet, or false on error.
 */
function wddx_serialize_value ($var, $comment = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Serialize variables into a WDDX packet
 * @link http://php.net/manual/en/function.wddx-serialize-vars.php
 * @param mixed $var_name <p>
 * Can be either a string naming a variable or an array containing
 * strings naming the variables or another array, etc.
 * </p>
 * @param mixed $_ [optional] 
 * @return string the WDDX packet, or false on error.
 */
function wddx_serialize_vars ($var_name, $_ = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Starts a new WDDX packet with structure inside it
 * @link http://php.net/manual/en/function.wddx-packet-start.php
 * @param string $comment [optional] <p>
 * An optional comment string.
 * </p>
 * @return resource a packet ID for use in later functions, or false on error.
 */
function wddx_packet_start ($comment = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Ends a WDDX packet with the specified ID
 * @link http://php.net/manual/en/function.wddx-packet-end.php
 * @param resource $packet_id <p>
 * A WDDX packet, returned by wddx_packet_start.
 * </p>
 * @return string the string containing the WDDX packet.
 */
function wddx_packet_end ($packet_id) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Add variables to a WDDX packet with the specified ID
 * @link http://php.net/manual/en/function.wddx-add-vars.php
 * @param resource $packet_id <p>
 * A WDDX packet, returned by wddx_packet_start.
 * </p>
 * @param mixed $var_name <p>
 * Can be either a string naming a variable or an array containing
 * strings naming the variables or another array, etc.
 * </p>
 * @param mixed $_ [optional] 
 * @return bool true on success or false on failure.
 */
function wddx_add_vars ($packet_id, $var_name, $_ = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Unserializes a WDDX packet.
 * Alias: <function>wddx_unserialize</function>
 * @link http://php.net/manual/en/function.wddx-deserialize.php
 * @param string $packet A WDDX packet, as a string or stream.
 * @return mixed Returns the deserialized value which can be a string, a number or an array.
 * Note that structures are deserialized into associative arrays.
 */
function wddx_deserialize ($packet) {}

// End of wddx v.
?>
