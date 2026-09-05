<?php

declare(strict_types=1);

namespace Swoole;

class Client
{
    public const MSG_OOB = 1;
    public const MSG_PEEK = 2;
    public const MSG_DONTWAIT = 64;
    public const MSG_WAITALL = 256;
    public const SHUT_RDWR = 2;
    public const SHUT_RD = 0;
    public const SHUT_WR = 1;
    public $errCode = 0;
    public $sock = -1;
    public $reuse = false;
    public $reuseCount = 0;
    public $type = 0;
    public $id;
    public $setting;

    public function __construct($type, $async = null, $id = null) {}

    public function __destruct() {}

    /**
     * @return mixed
     */
    public function set(array $settings) {}

    /**
     * @param mixed $host The host name of the remote address.
     * @param mixed|null $port The port number of the remote address.
     * @param mixed|null $timeout The timeout(second) of connect/send/recv, the default value is
     * 0.1s
     * @param mixed|null $sock_flag
     * @return mixed Whether the connection is established.
     */
    public function connect($host, $port = null, $timeout = null, $sock_flag = null) {}

    /**
     * @param mixed|null $size
     * @param mixed|null $flag
     * @return mixed
     */
    public function recv($size = null, $flag = null) {}

    /**
     * @param mixed $data The data to send which can be string or binary
     * @param mixed|null $flag
     * @return mixed If the client sends data successfully, it returns the length of data sent. Or
     * it returns false and sets $swoole_client->errCode. For sync client, there is no limit for the
     * data to send. For async client, The limit for the data to send is socket_buffer_size.
     */
    public function send($data, $flag = null) {}

    /**
     * @param mixed $filename File path of the file to send.
     * @param mixed|null $offset Offset of the file to send
     * @param mixed|null $length
     * @return mixed
     */
    public function sendfile($filename, $offset = null, $length = null) {}

    /**
     * @param mixed $ip The IP address of remote host, IPv4 or IPv6.
     * @param mixed $port The port number of remote host.
     * @param mixed $data The data to send which should be less-than 64K.
     * @return mixed
     */
    public function sendto($ip, $port, $data) {}

    /**
     * @param mixed $how
     * @return mixed
     */
    public function shutdown($how) {}

    /**
     * @return mixed
     */
    public function enableSSL() {}

    /**
     * @return mixed
     */
    public function getPeerCert() {}

    /**
     * @return mixed
     */
    public function verifyPeerCert() {}

    /**
     * @return mixed Whether the connection is established.
     */
    public function isConnected() {}

    /**
     * @return mixed The host and port of the local socket.
     */
    public function getsockname() {}

    /**
     * @return mixed The host and port of the remote socket.
     */
    public function getpeername() {}

    /**
     * @param mixed|null $force Whether force to close the connection.
     * @return mixed Whether the connection is closed.
     */
    public function close($force = null) {}

    /**
     * @return mixed
     */
    public function getSocket() {}
}
