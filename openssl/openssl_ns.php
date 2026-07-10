<?php

// Start of openssl namespaced classes

namespace Openssl;

    /**
     * @since 8.6
     */
    class OpensslException extends \Exception {}

    /**
     * @since 8.6
     */
    final class Psk
    {
        public const MAX_PSK_LEN = 256;
        public const MAX_IDENTITY_LEN = 128;
        public readonly string $psk;
        public readonly ?string $identity;

        public function __construct(string $psk, ?string $identity = null) {}
    }

    /**
     * @since 8.6
     */
    final class Session
    {
        public readonly string $id;

        public function export(int $format = 2): string {}

        public static function import(string $data, int $format = 2): Session {}

        public function isResumable(): bool {}

        public function getTimeout(): int {}

        public function getCreatedAt(): int {}

        public function getProtocol(): ?string {}

        public function getCipher(): ?string {}

        public function hasTicket(): bool {}

        public function getTicketLifetimeHint(): ?int {}

        public function __serialize(): array {}

        public function __unserialize(array $data): void {}
    }
