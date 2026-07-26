<?php

// Start of streams v.

/**
 * @since 8.6
 */
final readonly class StreamError
{
    public readonly StreamErrorCode $code;
    public readonly string $message;
    public readonly string $wrapperName;
    public readonly int $severity;
    public readonly bool $terminating;
    public readonly ?string $param;
}

/**
 * @since 8.6
 */
class StreamException extends \Exception
{
    /**
     * @var StreamError[]
     */
    private array $errors;

    public function getErrors(): array {}
}

/**
 * @since 8.6
 */
final class StreamPollHandle implements \Io\Poll\Handle
{
    public function __construct($stream) {}

    public function getStream() {}

    public function isValid(): bool {}
}

/**
 * @since 8.6
 */
enum StreamErrorCode implements \UnitEnum
{
    case None;
    case Generic;

    case ReadFailed;
    case WriteFailed;
    case SeekFailed;
    case SeekNotSupported;
    case FlushFailed;
    case TruncateFailed;
    case ConnectFailed;
    case BindFailed;
    case ListenFailed;
    case AcceptFailed;
    case NotWritable;
    case NotReadable;

    case Disabled;
    case NotFound;
    case PermissionDenied;
    case AlreadyExists;
    case InvalidPath;
    case PathTooLong;
    case OpenFailed;
    case CreateFailed;
    case DupFailed;
    case UnlinkFailed;
    case RenameFailed;
    case MkdirFailed;
    case RmdirFailed;
    case StatFailed;
    case MetaFailed;
    case ChmodFailed;
    case ChownFailed;
    case CopyFailed;
    case TouchFailed;
    case InvalidMode;
    case InvalidMeta;
    case ModeNotSupported;
    case Readonly;
    case RecursionDetected;

    case NotImplemented;
    case NoOpener;
    case PersistentNotSupported;
    case WrapperNotFound;
    case WrapperDisabled;
    case ProtocolUnsupported;
    case WrapperRegistrationFailed;
    case WrapperUnregistrationFailed;
    case WrapperRestorationFailed;

    case FilterNotFound;
    case FilterFailed;

    case CastFailed;
    case CastNotSupported;
    case MakeSeekableFailed;
    case BufferedDataLost;

    case NetworkSendFailed;
    case NetworkRecvFailed;
    case SslNotSupported;
    case ResumptionFailed;
    case SocketPathTooLong;
    case OobNotSupported;
    case ProtocolError;
    case InvalidUrl;
    case InvalidResponse;
    case InvalidHeader;
    case InvalidParam;
    case RedirectLimit;
    case AuthFailed;
    case TimeOut;

    case ArchivingFailed;
    case EncodingFailed;
    case DecodingFailed;
    case InvalidFormat;

    case AllocationFailed;
    case TemporaryFileFailed;

    case LockFailed;
    case LockNotSupported;

    case UserspaceNotImplemented;
    case UserspaceInvalidReturn;
    case UserspaceCallFailed;
}

/**
 * @since 8.6
 */
enum StreamErrorMode implements \UnitEnum
{
    case Error;
    case Exception;
    case Silent;
}

/**
 * @since 8.6
 */
enum StreamErrorStore implements \UnitEnum
{
    case Auto;
    case None;
    case NonTerminating;
    case Terminating;
    case All;
}

/**
 * @since 8.6
 */
define('STREAM_CRYPTO_STATUS_NONE', 0);
/**
 * @since 8.6
 */
define('STREAM_CRYPTO_STATUS_WANT_READ', 1);
/**
 * @since 8.6
 */
define('STREAM_CRYPTO_STATUS_WANT_WRITE', 2);

/**
 * Clears the accumulated stream errors
 * @return void
 * @since 8.6
 */
function stream_clear_errors(): void {}

/**
 * Returns the accumulated stream errors
 * @return StreamError[]
 * @since 8.6
 */
function stream_last_errors(): array {}

/**
 * Returns the current crypto status of a stream
 * @param resource $stream
 * @return int
 * @since 8.6
 */
function stream_socket_get_crypto_status($stream): int {}
