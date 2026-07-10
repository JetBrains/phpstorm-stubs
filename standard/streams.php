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
    case System;
    case Wrapper;
    case Timeout;
}

/**
 * @since 8.6
 */
enum StreamErrorMode implements \UnitEnum
{
    case Silent;
    case Warning;
    case Exception;
}

/**
 * @since 8.6
 */
enum StreamErrorStore implements \UnitEnum
{
    case None;
    case Last;
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
