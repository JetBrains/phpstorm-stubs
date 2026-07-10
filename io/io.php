<?php

// Start of io v.

namespace Io {
    /**
     * @since 8.6
     */
    class IoException extends \Exception {}
}

namespace Io\Poll {
    /**
     * @since 8.6
     */
    interface Handle {}

    /**
     * @since 8.6
     */
    class PollException extends \Io\IoException {}

    /**
     * @since 8.6
     */
    class FailedPollOperationException extends PollException
    {
        public const int ERROR_NONE = 0;
        public const int ERROR_SYSTEM = 1;
        public const int ERROR_NOMEM = 2;
        public const int ERROR_INVALID = 3;
        public const int ERROR_EXISTS = 4;
        public const int ERROR_NOTFOUND = 5;
        public const int ERROR_TIMEOUT = 6;
        public const int ERROR_INTERRUPTED = 7;
        public const int ERROR_PERMISSION = 8;
        public const int ERROR_TOOBIG = 9;
        public const int ERROR_AGAIN = 10;
        public const int ERROR_NOSUPPORT = 11;
    }

    /**
     * @since 8.6
     */
    class FailedContextInitializationException extends FailedPollOperationException {}

    /**
     * @since 8.6
     */
    class FailedHandleAddException extends FailedPollOperationException {}

    /**
     * @since 8.6
     */
    class FailedPollWaitException extends FailedPollOperationException {}

    /**
     * @since 8.6
     */
    class FailedWatcherModificationException extends FailedPollOperationException {}

    /**
     * @since 8.6
     */
    class BackendUnavailableException extends PollException {}

    /**
     * @since 8.6
     */
    class HandleAlreadyWatchedException extends PollException {}

    /**
     * @since 8.6
     */
    class InactiveWatcherException extends PollException {}

    /**
     * @since 8.6
     */
    class InvalidHandleException extends PollException {}

    /**
     * @since 8.6
     */
    enum Backend implements \UnitEnum
    {
        case Epoll;
        case Kqueue;
        case Poll;
        case Select;

        public static function getAvailableBackends(): array {}

        public function isAvailable(): bool {}

        public function supportsEdgeTriggering(): bool {}
    }

    /**
     * @since 8.6
     */
    enum Event implements \UnitEnum
    {
        case Read;
        case Write;
        case Error;
        case Hangup;
    }

    /**
     * @since 8.6
     */
    final class Context
    {
        public function __construct(Backend $backend = Backend::Epoll) {}

        public function add(Handle $handle, array $events, mixed $data = null): Watcher {}

        public function wait(?int $timeoutSeconds = null, int $timeoutMicroseconds = 0, ?int $maxEvents = null): array {}

        public function getBackend(): Backend {}
    }

    /**
     * @since 8.6
     */
    final class Watcher
    {
        final private function __construct() {}

        public function getHandle(): Handle {}

        public function getWatchedEvents(): array {}

        public function getTriggeredEvents(): array {}

        public function getData(): mixed {}

        public function hasTriggered(Event $event): bool {}

        public function isActive(): bool {}

        public function modify(array $events, mixed $data = null): void {}

        public function modifyEvents(array $events): void {}

        public function modifyData(mixed $data): void {}

        public function remove(): void {}
    }
}
