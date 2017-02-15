<?php
/**
 * PHPStorm stub file for Sockets constants.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */

/**
 *
 */
const AF_INET = 2;
/**
 * Only available if compiled with IPv6 support.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const AF_INET6 = 10;
const AF_UNIX = 1;
const IPPROTO_IP = 0;
const IPPROTO_IPV6 = 41;
const IPV6_HOPLIMIT = 52;
/**
 * The time-to-live of outgoing IPv4 multicast packets.
 * This should be a value between 0 (don't leave the interface) and 255.
 * The default value is 1 (only the local network is reached). (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const IPV6_MULTICAST_HOPS = 18;
/**
 * Analogous to IP_MULTICAST_LOOP, but for IPv6. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const IPV6_MULTICAST_IF = 17;
/**
 * Analogous to IP_MULTICAST_TTL, but for IPv6 packets.
 * The value -1 is also accepted, meaning the route default should be used. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const IPV6_MULTICAST_LOOP = 19;
const IPV6_PKTINFO = 50;
const IPV6_RECVHOPLIMIT = 51;
const IPV6_RECVPKTINFO = 49;
const IPV6_RECVTCLASS = 66;
const IPV6_TCLASS = 67;
const IPV6_UNICAST_HOPS = 16;
/**
 * The outgoing interface for IPv4 multicast packets. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const IP_MULTICAST_IF = 32;
/**
 * The multicast loopback policy for IPv4 packets,
 * which determines whether multicast packets sent by this socket
 * also reach receivers in the same host that have joined the same multicast group
 * on the outgoing interface used by this socket. This is the case by default. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const IP_MULTICAST_LOOP = 34;
/**
 * The outgoing interface for IPv6 multicast packets. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const IP_MULTICAST_TTL = 33;
/**
 * Blocks packets arriving from a specific source to a specific multicast group,
 * which must have been previously joined. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const MCAST_BLOCK_SOURCE = 43;
/**
 * Joins a multicast group. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const MCAST_JOIN_GROUP = 42;
/**
 * Receive packets destined to a specific multicast group
 * whose source address matches a specific value. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const MCAST_JOIN_SOURCE_GROUP = 46;
/**
 * Leaves a multicast group. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const MCAST_LEAVE_GROUP = 45;
/**
 * Stop receiving packets destined to a specific multicast group
 * whose soure address matches a specific value. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const MCAST_LEAVE_SOURCE_GROUP = 47;
/**
 * Unblocks (start receiving again) packets arriving from
 * a specific source address to a specific multicast group,
 * which must have been previously joined. (added in PHP 5.4)
 *
 * @link http://php.net/manual/en/function.socket-get-option.php
 */
const MCAST_UNBLOCK_SOURCE = 44;
const MSG_CMSG_CLOEXEC = 1073741824;
const MSG_CONFIRM = 2048;
const MSG_CTRUNC = 8;
const MSG_DONTROUTE = 4;
const MSG_DONTWAIT = 64;
/**
 * Not available on Windows platforms.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const MSG_EOF = 512;
/**
 * Not available on Windows platforms.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const MSG_EOR = 128;
const MSG_ERRQUEUE = 8192;
const MSG_MORE = 32768;
const MSG_NOSIGNAL = 16384;
const MSG_OOB = 1;
const MSG_PEEK = 2;
const MSG_TRUNC = 32;
const MSG_WAITALL = 256;
const MSG_WAITFORONE = 65536;
const PHP_BINARY_READ = 2;
const PHP_NORMAL_READ = 1;
const SCM_CREDENTIALS = 2;
const SCM_RIGHTS = 1;
/**
 * Arg list too long.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_E2BIG = 7;
/**
 * Permission denied.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EACCES = 13;
const SOCKET_EADDRINUSE = 98;
/**
 * Cannot assign requested address.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EADDRNOTAVAIL = 99;
/**
 * Advertise error.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EADV = 68;
/**
 * Address family not supported by protocol.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EAFNOSUPPORT = 97;
/**
 * Try again.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EAGAIN = 11;
/**
 * Operation already in progress.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EALREADY = 114;
/**
 * Invalid exchange.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EBADE = 52;
/**
 * Bad file number.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EBADF = 9;
/**
 * File descriptor in bad state.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EBADFD = 77;
/**
 * Not a data message.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EBADMSG = 74;
/**
 * Invalid request descriptor.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EBADR = 53;
/**
 * Invalid request code.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EBADRQC = 56;
/**
 * Invalid slot.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EBADSLT = 57;
/**
 * Device or resource busy.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EBUSY = 16;
/**
 * Channel number out of range.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ECHRNG = 44;
/**
 * Communication error on send.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ECOMM = 70;
/**
 * Software caused connection abort.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ECONNABORTED = 103;
/**
 * Connection refused.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ECONNREFUSED = 111;
/**
 * Connection reset by peer.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ECONNRESET = 104;
/**
 * Destination address required.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EDESTADDRREQ = 89;
/**
 * Quota exceeded.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EDQUOT = 122;
/**
 * File exists.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EEXIST = 17;
/**
 * Bad address.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EFAULT = 14;
/**
 * Host is down.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EHOSTDOWN = 112;
/**
 * No route to host.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EHOSTUNREACH = 113;
/**
 * Identifier removed.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EIDRM = 43;
/**
 * Operation now in progress.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EINPROGRESS = 115;
/**
 * Interrupted system call.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EINTR = 4;
/**
 * Invalid argument.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EINVAL = 22;
/**
 * I/O error.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EIO = 5;
/**
 * Transport endpoint is already connected.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EISCONN = 106;
/**
 * Is a directory.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EISDIR = 21;
/**
 * Is a named type file.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EISNAM = 120;
/**
 * Level 2 halted.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EL2HLT = 51;
/**
 * Level 2 not synchronized.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EL2NSYNC = 45;
/**
 * Level 3 halted.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EL3HLT = 46;
/**
 * Level 3 reset.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EL3RST = 47;
/**
 * Link number out of range.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ELNRNG = 48;
/**
 * Too many symbolic links encountered.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ELOOP = 40;
/**
 * Wrong medium type.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EMEDIUMTYPE = 124;
/**
 * Too many open files.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EMFILE = 24;
/**
 * Too many links.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EMLINK = 31;
/**
 * Message too long.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EMSGSIZE = 90;
/**
 * Multihop attempted.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EMULTIHOP = 72;
/**
 * File name too long.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENAMETOOLONG = 36;
/**
 * Network is down.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENETDOWN = 100;
/**
 * Network dropped connection because of reset.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENETRESET = 102;
/**
 * Network is unreachable.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENETUNREACH = 101;
/**
 * File table overflow.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENFILE = 23;
/**
 * No anode.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOANO = 55;
/**
 * No buffer space available.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOBUFS = 105;
/**
 * No CSI structure available.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOCSI = 50;
/**
 * No data available.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENODATA = 61;
/**
 * No such device.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENODEV = 19;
/**
 * No such file or directory.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOENT = 2;
/**
 * No record locks available.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOLCK = 37;
/**
 * Link has been severed.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOLINK = 67;
/**
 * No medium found.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOMEDIUM = 123;
/**
 * Out of memory.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOMEM = 12;
/**
 * No message of desired type.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOMSG = 42;
/**
 * Machine is not on the network.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENONET = 64;
const SOCKET_ENOPROTOOPT = 92;
/**
 * No space left on device.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOSPC = 28;
/**
 * Out of streams resources.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOSR = 63;
/**
 * Device not a stream.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOSTR = 60;
/**
 * Function not implemented.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOSYS = 38;
/**
 * Block device required.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOTBLK = 15;
/**
 * Transport endpoint is not connected.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOTCONN = 107;
/**
 * Not a directory.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOTDIR = 20;
/**
 * Directory not empty.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOTEMPTY = 39;
/**
 * Socket operation on non-socket.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOTSOCK = 88;
/**
 * Not a typewriter.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOTTY = 25;
/**
 * Name not unique on network.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENOTUNIQ = 76;
/**
 * No such device or address.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ENXIO = 6;
/**
 * Operation not supported on transport endpoint.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EOPNOTSUPP = 95;
/**
 * Operation not permitted.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EPERM = 1;
/**
 * Protocol family not supported.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EPFNOSUPPORT = 96;
/**
 * Broken pipe.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EPIPE = 32;
/**
 * Protocol error.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EPROTO = 71;
/**
 * Protocol not supported.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EPROTONOSUPPORT = 93;
/**
 * Protocol wrong type for socket.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EPROTOTYPE = 91;
/**
 * Remote address changed.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EREMCHG = 78;
/**
 * Object is remote.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EREMOTE = 66;
/**
 * Remote I/O error.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EREMOTEIO = 121;
/**
 * Interrupted system call should be restarted.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ERESTART = 85;
/**
 * Read-only file system.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EROFS = 30;
/**
 * Cannot send after transport endpoint shutdown.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ESHUTDOWN = 108;
/**
 * Socket type not supported.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ESOCKTNOSUPPORT = 94;
/**
 * Illegal seek.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ESPIPE = 29;
/**
 * Srmount error.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ESRMNT = 69;
/**
 * Streams pipe error.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ESTRPIPE = 86;
/**
 * Timer expired.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ETIME = 62;
/**
 * Connection timed out.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ETIMEDOUT = 110;
/**
 * Too many references: cannot splice.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_ETOOMANYREFS = 109;
/**
 * Protocol driver not attached.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EUNATCH = 49;
/**
 * Too many users.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EUSERS = 87;
/**
 * Operation would block.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EWOULDBLOCK = 11;
/**
 * Cross-device link.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EXDEV = 18;
/**
 * Exchange full.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SOCKET_EXFULL = 54;
const SOCK_DGRAM = 2;
const SOCK_RAW = 3;
const SOCK_RDM = 4;
const SOCK_SEQPACKET = 5;
const SOCK_STREAM = 1;
const SOL_SOCKET = 1;
const SOL_TCP = 6;
const SOL_UDP = 17;
const SOMAXCONN = 128;
const SO_BINDTODEVICE = 25;
const SO_BROADCAST = 6;
const SO_DEBUG = 1;
const SO_DONTROUTE = 5;
const SO_ERROR = 4;
const SO_KEEPALIVE = 9;
const SO_LINGER = 13;
const SO_OOBINLINE = 10;
const SO_PASSCRED = 16;
const SO_RCVBUF = 8;
const SO_RCVLOWAT = 18;
const SO_RCVTIMEO = 20;
const SO_REUSEADDR = 2;
/**
 * This constant is only available in PHP 5.4.10 or later on platforms that
 * support the <b>SO_REUSEPORT</b> socket option: this
 * includes Mac OS X and FreeBSD, but does not include Linux or Windows.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const SO_REUSEPORT = 15;
const SO_SNDBUF = 7;
const SO_SNDLOWAT = 19;
const SO_SNDTIMEO = 21;
const SO_TYPE = 3;
/**
 * Used to disable Nagle TCP algorithm.
 * Added in PHP 5.2.7.
 *
 * @link http://php.net/manual/en/sockets.constants.php
 */
const TCP_NODELAY = 1;
