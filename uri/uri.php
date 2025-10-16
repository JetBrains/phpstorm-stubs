<?php

namespace Uri {
    /**
     * @since 8.5
     */
    class UriException extends \Exception {}

    /**
     * @since 8.5
     */
    class UriError extends \Error {}

    /**
     * @since 8.5
     */
    class InvalidUriException extends \Uri\UriException {}

    /**
     * @since 8.5
     */
    enum UriComparisonMode implements \UnitEnum
    {
        case IncludeFragment;
        case ExcludeFragment;

        public static function cases(): array {}
    }
}

namespace Uri\Rfc3986 {
    /**
     * @since 8.5
     */
    final readonly class Uri
    {
        public static function parse(string $uri, ?\Uri\Rfc3986\Uri $baseUrl = null): ?static {}

        public function __construct(string $uri, ?\Uri\Rfc3986\Uri $baseUrl = null) {}

        public function getScheme(): ?string {}

        public function getRawScheme(): ?string {}

        public function withScheme(?string $scheme): static {}

        public function getUserInfo(): ?string {}

        public function getRawUserInfo(): ?string {}

        public function withUserInfo(#[\SensitiveParameter] ?string $userinfo): static {}

        public function getUsername(): ?string {}

        public function getRawUsername(): ?string {}

        public function getPassword(): ?string {}

        public function getRawPassword(): ?string {}

        public function getHost(): ?string {}

        public function getRawHost(): ?string {}

        public function withHost(?string $host): static {}

        public function getPort(): ?int {}

        public function withPort(?int $port): static {}

        public function getPath(): string {}

        public function getRawPath(): string {}

        public function withPath(string $path): static {}

        public function getQuery(): ?string {}

        public function getRawQuery(): ?string {}

        public function withQuery(?string $query): static {}

        public function getFragment(): ?string {}

        public function getRawFragment(): ?string {}

        public function withFragment(?string $fragment): static {}

        public function equals(\Uri\Rfc3986\Uri $uri, \Uri\UriComparisonMode $comparisonMode = \Uri\UriComparisonMode::ExcludeFragment): bool {}

        public function toString(): string {}

        public function toRawString(): string {}

        public function resolve(string $uri): static {}

        public function __serialize(): array {}

        public function __unserialize(array $data): void {}

        public function __debugInfo(): array {}
    }
}

namespace Uri\WhatWg {
    /**
     * @since 8.5
     */
    class InvalidUrlException extends \Uri\InvalidUriException
    {
        public readonly array $errors;

        public function __construct(string $message = "", array $errors = [], int $code = 0, ?\Throwable $previous = null) {}
    }

    /**
     * @since 8.5
     */
    enum UrlValidationErrorType implements \UnitEnum
    {
        case DomainToAscii;
        case DomainToUnicode;
        case DomainInvalidCodePoint;
        case HostInvalidCodePoint;
        case Ipv4EmptyPart;
        case Ipv4TooManyParts;
        case Ipv4NonNumericPart;
        case Ipv4NonDecimalPart;
        case Ipv4OutOfRangePart;
        case Ipv6Unclosed;
        case Ipv6InvalidCompression;
        case Ipv6TooManyPieces;
        case Ipv6MultipleCompression;
        case Ipv6InvalidCodePoint;
        case Ipv6TooFewPieces;
        case Ipv4InIpv6TooManyPieces;
        case Ipv4InIpv6InvalidCodePoint;
        case Ipv4InIpv6OutOfRangePart;
        case Ipv4InIpv6TooFewParts;
        case InvalidUrlUnit;
        case SpecialSchemeMissingFollowingSolidus;
        case MissingSchemeNonRelativeUrl;
        case InvalidReverseSoldius;
        case InvalidCredentials;
        case HostMissing;
        case PortOutOfRange;
        case PortInvalid;
        case FileInvalidWindowsDriveLetter;
        case FileInvalidWindowsDriveLetterHost;

        public static function cases(): array {}
    }

    /**
     * @since 8.5
     */
    final readonly class UrlValidationError
    {
        public readonly string $context;
        public readonly \Uri\WhatWg\UrlValidationErrorType $type;
        public readonly bool $failure;

        public function __construct(string $context, \Uri\WhatWg\UrlValidationErrorType $type, bool $failure) {}
    }

    /**
     * @since 8.5
     */
    final readonly class Url
    {
        /** @param array $errors */
        public static function parse(string $uri, ?\Uri\WhatWg\Url $baseUrl = null, &$errors = null): ?static {}

        /** @param array $softErrors */
        public function __construct(string $uri, ?\Uri\WhatWg\Url $baseUrl = null, &$softErrors = null) {}

        public function getScheme(): string {}

        public function withScheme(string $scheme): static {}

        public function getUsername(): ?string {}

        public function withUsername(?string $username): static {}

        public function getPassword(): ?string {}

        public function withPassword(#[\SensitiveParameter] ?string $password): static {}

        public function getAsciiHost(): ?string {}

        public function getUnicodeHost(): ?string {}

        public function withHost(?string $host): static {}

        public function getPort(): ?int {}

        public function withPort(?int $port): static {}

        public function getPath(): string {}

        public function withPath(string $path): static {}

        public function getQuery(): ?string {}

        public function withQuery(?string $query): static {}

        public function getFragment(): ?string {}

        public function withFragment(?string $fragment): static {}

        public function equals(\Uri\WhatWg\Url $url, \Uri\UriComparisonMode $comparisonMode = \Uri\UriComparisonMode::ExcludeFragment): bool {}

        public function toAsciiString(): string {}

        public function toUnicodeString(): string {}

        /** @param array $softErrors */
        public function resolve(string $uri, &$softErrors = null): static {}

        public function __serialize(): array {}

        public function __unserialize(array $data): void {}

        public function __debugInfo(): array {}
    }
}
