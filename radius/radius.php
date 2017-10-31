<?php

/**
 * Creates a Radius handle for accounting
 * @link http://php.net/manual/en/function.radius-acct-open.php
 * @return resource|bool Returns a handle on success, <b>FALSE</b> on error. This function only fails if insufficient memory is available.
 * @since 1.1.0
 */
function radius_acct_open() { }

/**
 * <b>radius_add_server()</b> may be called multiple times, and it may be used together with {@see radius_config()}. At most 10 servers may be specified. When multiple servers are given, they are tried in round-robin fashion until a valid response is received, or until each server's max_tries limit has been reached.
 * @link http://php.net/manual/en/function.radius-add-server.php
 * @param resource $radius_handle
 * @param string $hostname The <b>hostname</b> parameter specifies the server host, either as a fully qualified domain name or as a dotted-quad IP address in text form.
 * @param int $port The <b>port</b> specifies the UDP port to contact on the server.<br>
 *                  If port is given as 0, the library looks up the radius/udp or radacct/udp service in the network services database, and uses the port found there.<br>
 *                  If no entry is found, the library uses the standard Radius ports, 1812 for authentication and 1813 for accounting.
 * @param string $secret The shared secret for the server host is passed to the <b>secret</b> parameter. The Radius protocol ignores all but the leading 128 bytes of the shared secret.
 * @param int $timeout The timeout for receiving replies from the server is passed to the <b>timeout</b> parameter, in units of seconds.
 * @param int $max_tries The maximum number of repeated requests to make before giving up is passed into the <b>max_tries</b>.
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @see radius_config()
 * @since 1.1.0
 */
function radius_add_server(resource $radius_handle , $hostname, $port , $secret, $timeout, $max_tries) { }

/**
 * Creates a Radius handle for authentication
 * @link http://php.net/manual/en/function.radius-auth-open.php
 * @return resource|bool Returns a handle on success, <b>FALSE</b> on error. This function only fails if insufficient memory is available.
 * @since 1.1.0
 */
function radius_auth_open() { }

/**
 * Free all ressources. It is not needed to call this function because php frees all resources at the end of each request.
 * @link http://php.net/manual/en/function.radius-close.php
 * @param resource $radius_handle
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 1.1.0
 */
function radius_close(resource $radius_handle) { }

/**
 * Before issuing any Radius requests, the library must be made aware of the servers it can contact. The easiest way to configure the library is to call <b>radius_config()</b>. <b>radius_config()</b> causes the library to read a configuration file whose format is described in radius.conf.
 * @link http://php.net/manual/en/function.radius-config.php
 * @link https://www.freebsd.org/cgi/man.cgi?query=radius.conf
 * @param resource $radius_handle
 * @param string $file The pathname of the configuration file is passed as the file argument to {@see radius_config()}. The library can also be configured programmatically by calls to <b>{@see radius_add_server()}</b>.
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @see radius_add_server()
 * @since 1.1.0
 */
function radius_config(resource $radius_handle, $file) { }

/**
 * A Radius request consists of a code specifying the kind of request, and zero or more attributes which provide additional information. To begin constructing a new request, call <b>radius_create_request()</b>.<br />
 * <b>Note:</b> Attention: You must call this function, before you can put any attribute!
 * @link http://php.net/manual/en/function.radius-create-request.php
 * @param resource $radius_handle
 * @param int $type Type is <b>RADIUS_ACCESS_REQUEST</b> or <b>RADIUS_ACCOUNTING_REQUEST</b>.
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @see radius_send_request()
 * @since 1.1.0
 */
function radius_create_request(resource $radius_handle, $type) { }