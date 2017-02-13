<?php
/**
 * PHPStorm stub file for Streams constants.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */

/**
 * Return Code indicating that the userspace filter encountered an unrecoverable error (i.e. Invalid data received).
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const PSFS_ERR_FATAL = 0;
/**
 * Return Code indicating that the
 * userspace filter did not return buckets in $out
 * (i.e. No data available).
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const PSFS_FEED_ME = 1;
/**
 * Final flush prior to closing.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const PSFS_FLAG_FLUSH_CLOSE = 2;
/**
 * An incremental flush.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const PSFS_FLAG_FLUSH_INC = 1;
/**
 * Regular read/write.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const PSFS_FLAG_NORMAL = 0;
/**
 * Return Code indicating that the
 * userspace filter returned buckets in $out.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const PSFS_PASS_ON = 2;
const STREAM_BUFFER_FULL = 2;
const STREAM_BUFFER_LINE = 1;
const STREAM_BUFFER_NONE = 0;
/**
 * Stream casting, when stream_cast is called
 * otherwise (see above).
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_CAST_AS_STREAM = 0;
/**
 * Stream casting, for when stream_select is
 * calling stream_cast.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_CAST_FOR_SELECT = 3;
/**
 * Open client socket asynchronously. This option must be used
 * together with the STREAM_CLIENT_CONNECT flag.
 * Used with stream_socket_client.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_CLIENT_ASYNC_CONNECT = 2;
/**
 * Open client socket connection. Client sockets should always
 * include this flag. Used with stream_socket_client.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_CLIENT_CONNECT = 4;
/**
 * Client socket opened with stream_socket_client
 * should remain persistent between page loads.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_CLIENT_PERSISTENT = 1;
const STREAM_ENFORCE_SAFE_MODE = 4;
/**
 * This constant is equivalent to
 * STREAM_FILTER_READ | STREAM_FILTER_WRITE
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_FILTER_ALL = 3;
/**
 * Used with stream_filter_append and
 * stream_filter_prepend to indicate
 * that the specified filter should only be applied when
 * reading
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_FILTER_READ = 1;
/**
 * Used with stream_filter_append and
 * stream_filter_prepend to indicate
 * that the specified filter should only be applied when
 * writing
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_FILTER_WRITE = 2;
const STREAM_IGNORE_URL = 2;
/**
 * Provides a ICMP socket.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_IPPROTO_ICMP = 1;
/**
 * Provides a IP socket.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_IPPROTO_IP = 0;
/**
 * Provides a RAW socket.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_IPPROTO_RAW = 255;
/**
 * Provides a TCP socket.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_IPPROTO_TCP = 6;
/**
 * Provides a UDP socket.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_IPPROTO_UDP = 17;
const STREAM_IS_URL = 1;
/** @link http://php.net/manual/en/streamwrapper.stream-metadata.php */
const STREAM_META_ACCESS = 6;
/** @link http://php.net/manual/en/streamwrapper.stream-metadata.php */
const STREAM_META_GROUP = 5;
/** @link http://php.net/manual/en/streamwrapper.stream-metadata.php */
const STREAM_META_GROUP_NAME = 4;
/** @link http://php.net/manual/en/streamwrapper.stream-metadata.php */
const STREAM_META_OWNER = 3;
/** @link http://php.net/manual/en/streamwrapper.stream-metadata.php */
const STREAM_META_OWNER_NAME = 2;
/** @link http://php.net/manual/en/streamwrapper.stream-metadata.php */
const STREAM_META_TOUCH = 1;
const STREAM_MKDIR_RECURSIVE = 1;
/**
 * This flag is useful when your extension really must be able to randomly
 * seek around in a stream. Some streams may not be seekable in their
 * native form, so this flag asks the streams API to check to see if the
 * stream does support seeking. If it does not, it will copy the stream
 * into temporary storage (which may be a temporary file or a memory
 * stream) which does support seeking.
 * Please note that this flag is not useful when you want to seek the
 * stream and write to it, because the stream you are accessing might
 * not be bound to the actual resource you requested.
 * If the requested resource is network based, this flag will cause the
 * opener to block until the whole contents have been downloaded.
 *
 * @link http://php.net/manual/en/internals2.ze1.streams.constants.php
 */
const STREAM_MUST_SEEK = 16;
/**
 * Additional authorization is required to access the specified resource.
 * Typical issued with severity level of
 * STREAM_NOTIFY_SEVERITY_ERR.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_AUTH_REQUIRED = 3;
/**
 * Authorization has been completed (with or without success).
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_AUTH_RESULT = 10;
/**
 * There is no more data available on the stream.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_COMPLETED = 8;
/**
 * A connection with an external resource has been established.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_CONNECT = 2;
/**
 * A generic error occurred on the stream, consult
 * message and message_code
 * for details.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_FAILURE = 9;
/**
 * The size of the resource has been discovered.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_FILE_SIZE_IS = 5;
/**
 * The mime-type of resource has been identified,
 * refer to message for a description of the
 * discovered type.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_MIME_TYPE_IS = 4;
/**
 * Indicates current progress of the stream transfer in
 * bytes_transferred and possibly
 * bytes_max as well.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_PROGRESS = 7;
/**
 * The external resource has redirected the stream to an alternate
 * location. Refer to message.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_REDIRECTED = 6;
/**
 * A remote address required for this stream has been resolved, or the resolution
 * failed. See severity for an indication of which happened.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_RESOLVE = 1;
/**
 * A critical error occurred. Processing cannot continue.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_SEVERITY_ERR = 2;
/**
 * Normal, non-error related, notification.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_SEVERITY_INFO = 0;
/**
 * Non critical error condition. Processing may continue.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_NOTIFY_SEVERITY_WARN = 1;
const STREAM_OOB = 1;
const STREAM_OPTION_BLOCKING = 1;
const STREAM_OPTION_READ_BUFFER = 2;
const STREAM_OPTION_READ_TIMEOUT = 4;
const STREAM_OPTION_WRITE_BUFFER = 3;
const STREAM_PEEK = 2;
/**
 * Internet Protocol Version 4 (IPv4).
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_PF_INET = 2;
/**
 * Internet Protocol Version 6 (IPv6).
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_PF_INET6 = 10;
/**
 * Unix system internal protocols.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_PF_UNIX = 1;
/**
 * Flag indicating if the wrapper
 * is responsible for raising errors using trigger_error
 * during opening of the stream. If this flag is not set, you
 * should not raise any errors.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_REPORT_ERRORS = 8;
/**
 * Tells a stream created with stream_socket_server
 * to bind to the specified target. Server sockets should always include this flag.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SERVER_BIND = 4;
/**
 * Tells a stream created with stream_socket_server
 * and bound using the STREAM_SERVER_BIND flag to start
 * listening on the socket. Connection-orientated transports (such as TCP)
 * must use this flag, otherwise the server socket will not be enabled.
 * Using this flag for connect-less transports (such as UDP) is an error.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SERVER_LISTEN = 8;
/**
 * Used with stream_socket_shutdown to disable
 * further receptions. Added in PHP 5.2.1.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SHUT_RD = 0;
/**
 * Used with stream_socket_shutdown to disable
 * further receptions and transmissions. Added in PHP 5.2.1.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SHUT_RDWR = 2;
/**
 * Used with stream_socket_shutdown to disable
 * further transmissions. Added in PHP 5.2.1.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SHUT_WR = 1;
/**
 * Provides datagrams, which are connectionless messages (UDP, for
 * example).
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SOCK_DGRAM = 2;
/**
 * Provides a raw socket, which provides access to internal network
 * protocols and interfaces. Usually this type of socket is just available
 * to the root user.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SOCK_RAW = 3;
/**
 * Provides a RDM (Reliably-delivered messages) socket.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SOCK_RDM = 4;
/**
 * Provides a sequenced packet stream socket.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SOCK_SEQPACKET = 5;
/**
 * Provides sequenced, two-way byte streams with a transmission mechanism
 * for out-of-band data (TCP, for example).
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_SOCK_STREAM = 1;
const STREAM_URL_STAT_LINK = 1;
const STREAM_URL_STAT_QUIET = 2;
/**
 * Flag indicating if the stream
 * used the include path.
 *
 * @link http://php.net/manual/en/stream.constants.php
 */
const STREAM_USE_PATH = 1;
