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
        /**
         * Parse a URI
         *
         * Parses a URI.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.parse.php
         * @param string $uri URI to parse.
         * @param \Uri\Rfc3986\Uri|null $baseUrl When a string is passed, uri is applied on baseUrl,
         * if uri is a relative reference. If either null is passed, or uri is a not a relative
         * reference, then baseUrl doesn't have any effect.
         * @return static|null Returns a Uri\Rfc3986\Uri instance on success, or null on failure.
         */
        public static function parse(string $uri, ?\Uri\Rfc3986\Uri $baseUrl = null): ?static {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.construct.php
         * @throws \Uri\InvalidUriException
         */
        public function __construct(string $uri, ?\Uri\Rfc3986\Uri $baseUrl = null) {}

        /**
         * Retrieve the normalized scheme component
         *
         * Retrieves the normalized scheme component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getscheme.php
         * @return string|null Returns the normalized scheme component as a string if the scheme
         * component exists, null is returned otherwise.
         */
        public function getScheme(): ?string {}

        /**
         * Retrieve the raw scheme component
         *
         * Retrieves the raw (non-normalized) scheme component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getrawscheme.php
         * @return string|null Returns the raw scheme component as a string if the scheme component
         * exists, null is returned otherwise.
         */
        public function getRawScheme(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.withscheme.php
         * @throws \Uri\InvalidUriException
         */
        public function withScheme(?string $scheme): static {}

        /**
         * Retrieve the normalized userinfo component
         *
         * Retrieves the normalized userinfo component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getuserinfo.php
         * @return string|null Returns the normalized userinfo component as a string if the userinfo
         * component exists, null is returned otherwise.
         */
        public function getUserInfo(): ?string {}

        /**
         * Retrieve the raw userinfo component
         *
         * Retrieves the raw (non-normalized) userinfo component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getrawuserinfo.php
         * @return string|null Returns the raw userinfo component as a string if the userinfo
         * component exists, null is returned otherwise.
         */
        public function getRawUserInfo(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.withuserinfo.php
         * @throws \Uri\InvalidUriException
         */
        public function withUserInfo(#[\SensitiveParameter] ?string $userinfo): static {}

        /**
         * Retrieve the normalized username
         *
         * Retrieves the normalized username part (the text before the first : character) from the
         * userinfo component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getusername.php
         * @return string|null Returns the normalized username as a string if the userinfo component
         * exists, null is returned otherwise.
         */
        public function getUsername(): ?string {}

        /**
         * Retrieve the raw username
         *
         * Retrieves the raw (non-normalized) username part (the text before the first : character)
         * from userinfo component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getrawusername.php
         * @return string|null Returns the raw (non-normalized) username as a string if the userinfo
         * component exists, null is returned otherwise.
         */
        public function getRawUsername(): ?string {}

        /**
         * Retrieve the normalized password
         *
         * Retrieves the normalized password part (the text after the first : character) from the
         * userinfo component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getpassword.php
         * @return string|null Returns the normalized password as a string if the userinfo component
         * contains a : character. An empty string is returned when the userinfo component doesn't
         * contain a : character. null is returned when the userinfo component doesn't exist.
         */
        public function getPassword(): ?string {}

        /**
         * Retrieve the raw password
         *
         * Retrieves the raw (non-normalized) password part (the text after the first : character)
         * from the userinfo component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getrawpassword.php
         * @return string|null Returns the raw (non-normalized) password as a string if the userinfo
         * component contains a : character. An empty string is returned when the userinfo component
         * doesn't contain a : character. null is returned when the userinfo component doesn't
         * exist.
         */
        public function getRawPassword(): ?string {}

        /**
         * Retrieve the normalized host component
         *
         * Retrieves the normalized host component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.gethost.php
         * @return string|null Returns the normalized host component as a string if the host
         * component exists, null is returned otherwise.
         */
        public function getHost(): ?string {}

        /**
         * Retrieve the raw host component
         *
         * Retrieves the raw (non-normalized) host component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getrawhost.php
         * @return string|null Returns the raw host component as a string if the host component
         * exists, null is returned otherwise.
         */
        public function getRawHost(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.withhost.php
         * @throws \Uri\InvalidUriException
         */
        public function withHost(?string $host): static {}

        /**
         * Retrieve the normalized port component
         *
         * Retrieves the normalized port component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getport.php
         * @return int|null Returns the normalized port component as an integer if the port
         * component exists, null is returned otherwise.
         */
        public function getPort(): ?int {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.withport.php
         * @throws \Uri\InvalidUriException
         */
        public function withPort(?int $port): static {}

        /**
         * Retrieve the normalized path component
         *
         * Retrieves the normalized path component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getpath.php
         * @return string Returns the normalized path component as a string.
         */
        public function getPath(): string {}

        /**
         * Retrieve the raw path component
         *
         * Retrieves the raw (non-normalized) path component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getrawpath.php
         * @return string Returns the raw path component as a string.
         */
        public function getRawPath(): string {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.withpath.php
         * @throws \Uri\InvalidUriException
         */
        public function withPath(string $path): static {}

        /**
         * Retrieve the normalized query component
         *
         * Retrieves the normalized query component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getquery.php
         * @return string|null Returns the normalized query component as a string if the query
         * component exists, null is returned otherwise.
         */
        public function getQuery(): ?string {}

        /**
         * Retrieve the raw query component
         *
         * Retrieves the raw (non-normalized) query component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getrawquery.php
         * @return string|null Returns the raw query component as a string if the query component
         * exists, null is returned otherwise.
         */
        public function getRawQuery(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.withquery.php
         * @throws \Uri\InvalidUriException
         */
        public function withQuery(?string $query): static {}

        /**
         * Retrieve the normalized fragment component
         *
         * Retrieves the normalized fragment component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getfragment.php
         * @return string|null Returns the normalized fragment component as a string if the fragment
         * component exists, null is returned otherwise.
         */
        public function getFragment(): ?string {}

        /**
         * Retrieve the raw fragment component
         *
         * Retrieves the raw (non-normalized) fragment component.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.getrawfragment.php
         * @return string|null Returns the raw fragment component as a string if the fragment
         * component exists, null is returned otherwise.
         */
        public function getRawFragment(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.withfragment.php
         * @throws \Uri\InvalidUriException
         */
        public function withFragment(?string $fragment): static {}

        /**
         * Check if two URIs are equivalent
         *
         * Checks if two URIs are equivalent.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.equals.php
         * @param \Uri\Rfc3986\Uri $uri URI to compare the current URI against.
         * @param \Uri\UriComparisonMode $comparisonMode Whether the fragment component is taken
         * into account of the comparison (Uri\UriComparisonMode::IncludeFragment) or not
         * (Uri\UriComparisonMode::ExcludeFragment). By default, the fragment is excluded.
         * @return bool Returns true if the two URIs are equivalent, or false otherwise.
         */
        public function equals(\Uri\Rfc3986\Uri $uri, \Uri\UriComparisonMode $comparisonMode = \Uri\UriComparisonMode::ExcludeFragment): bool {}

        /**
         * Recompose the normalized URI
         *
         * Recomposes the normalized URI to a string.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.tostring.php
         * @return string Returns the recomposed normalized URI as a string.
         */
        public function toString(): string {}

        /**
         * Recompose the raw URI
         *
         * Recomposes the raw (non-normalized) URI to a string.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.torawstring.php
         * @return string Returns the recomposed raw (non-normalized) URI as a string.
         */
        public function toRawString(): string {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.resolve.php
         * @throws \Uri\InvalidUriException
         */
        public function resolve(string $uri): static {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.serialize.php
         * @throws \Exception
         */
        public function __serialize(): array {}

        /**
         * @link https://php.net/manual/en/uri-rfc3986-uri.unserialize.php
         * @throws \Exception
         */
        public function __unserialize(array $data): void {}

        /**
         * Return the internal state of the URI
         *
         * Returns the internal state of the URI.
         *
         * @link https://php.net/manual/en/uri-rfc3986-uri.debuginfo.php
         * @return array Returns the internal state of the URI as an array.
         */
        public function __debugInfo(): array {}

        /**
         * @since 8.6
         */
        public function getHostType(): ?UriHostType {}

        /**
         * @since 8.6
         */
        public function getUriType(): ?UriType {}
    }

    /**
     * @since 8.6
     */
    enum UriHostType implements \UnitEnum
    {
        case IPv4;
        case IPv6;
        case IPvFuture;
        case RegisteredName;
    }

    /**
     * @since 8.6
     */
    enum UriType implements \UnitEnum
    {
        case AbsolutePathReference;
        case RelativePathReference;
        case NetworkPathReference;
        case Uri;
    }

    /**
     * @since 8.6
     */
    final class UriBuilder
    {
        private ?string $scheme;
        private ?string $userinfo;
        private ?string $host;
        private ?int $port;
        private string $path;
        private ?string $query;
        private ?string $fragment;

        public function reset(): static {}

        public function setScheme(?string $scheme): static {}

        public function setUserInfo(?string $userInfo): static {}

        public function setHost(?string $host): static {}

        public function setPort(?int $port): static {}

        public function setPath(string $path): static {}

        public function setQuery(?string $query): static {}

        public function setFragment(?string $fragment): static {}

        public function build(?Uri $baseUrl = null): Uri {}
    }
}

namespace Uri\WhatWg {
    /**
     * @since 8.5
     */
    class InvalidUrlException extends \Uri\InvalidUriException
    {
        public readonly array $errors;

        /**
         * Construct an InvalidUrlException object
         *
         * Constructs a Uri\WhatWg\InvalidUrlException object.
         *
         * @link https://php.net/manual/en/uri-whatwg-invalidurlexception.construct.php
         * @param string $message Exception message.
         * @param array $errors An array of Uri\WhatWg\UrlValidationError objects.
         * @param int $code Exception code.
         * @param \Throwable|null $previous The previous exception used for exception chaining.
         */
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

        /**
         * Construct a UrlValidationError object
         *
         * Constructs a Uri\WhatWg\UrlValidationError object.
         *
         * @link https://php.net/manual/en/uri-whatwg-urlvalidationerror.construct.php
         * @param string $context The input URL at the point where the error was detected.
         * @param \Uri\WhatWg\UrlValidationErrorType $type The type of error.
         * @param bool $failure If true the error caused the URL to be rejected as invalid. If false
         * the error is a soft error that was automatically corrected during parsing.
         */
        public function __construct(string $context, \Uri\WhatWg\UrlValidationErrorType $type, bool $failure) {}
    }

    /**
     * @since 8.5
     */
    final readonly class Url
    {
        /**
         * @link https://php.net/manual/en/uri-whatwg-url.parse.php
         * @param array $errors
         */
        public static function parse(string $uri, ?\Uri\WhatWg\Url $baseUrl = null, &$errors = null): ?static {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.construct.php
         * @param string $uri A valid URL string to parse (e.g. /foo or (e.g.
         * https://example.com/foo).
         * @param \Uri\WhatWg\Url|null $baseUrl When a string is passed, uri is applied on baseUrl,
         * if uri is a relative-URL string. If either null is passed, or uri is a not a relative-URL
         * string, then baseUrl doesn't have any effect.
         * @param array $softErrors
         *
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function __construct(string $uri, ?\Uri\WhatWg\Url $baseUrl = null, &$softErrors = null) {}

        /**
         * Retrieve the scheme component
         *
         * Retrieves the scheme component.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.getscheme.php
         * @return string Returns the scheme component as a string if the scheme component exists,
         * null is returned otherwise.
         */
        public function getScheme(): string {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.withscheme.php
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function withScheme(string $scheme): static {}

        /**
         * Retrieve the username component
         *
         * Retrieves the username component.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.getusername.php
         * @return string|null Returns the username component as a string if the username component
         * exists, null is returned otherwise.
         */
        public function getUsername(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.withusername.php
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function withUsername(?string $username): static {}

        /**
         * Retrieve the password component
         *
         * Retrieves the password component.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.getpassword.php
         * @return string|null Returns the password component as a string if the password component
         * exists, null is returned otherwise.
         */
        public function getPassword(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.withpassword.php
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function withPassword(#[\SensitiveParameter] ?string $password): static {}

        /**
         * Retrieve the host component as an ASCII string
         *
         * Retrieves the host component as a string using punycode transcription instead of Unicode
         * characters.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.getasciihost.php
         * @return string|null Returns the host component as an ASCII string if the host component
         * exists, null is returned otherwise.
         */
        public function getAsciiHost(): ?string {}

        /**
         * Retrieve the host component as an Unicode string
         *
         * Retrieves the host component as a string, which may contain Unicode characters.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.getunicodehost.php
         * @return string|null Returns the host component as a Unicode string if the host component
         * exists, null is returned otherwise.
         */
        public function getUnicodeHost(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.withhost.php
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function withHost(?string $host): static {}

        /**
         * Retrieve the port component
         *
         * Retrieves the port component.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.getport.php
         * @return int|null Returns the port component as an integer if the port component exists,
         * null is returned otherwise.
         */
        public function getPort(): ?int {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.withport.php
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function withPort(?int $port): static {}

        /**
         * Retrieve the path component
         *
         * Retrieves the path component.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.getpath.php
         * @return string Returns the path component as a string.
         */
        public function getPath(): string {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.withpath.php
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function withPath(string $path): static {}

        /**
         * Retrieve the query component
         *
         * Retrieves the query component.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.getquery.php
         * @return string|null Returns the query component as a string if the query component
         * exists, null is returned otherwise.
         */
        public function getQuery(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.withquery.php
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function withQuery(?string $query): static {}

        /**
         * Retrieve the fragment component
         *
         * Retrieves the fragment component.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.getfragment.php
         * @return string|null Returns the fragment component as a string if the fragment component
         * exists, null is returned otherwise.
         */
        public function getFragment(): ?string {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.withfragment.php
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function withFragment(?string $fragment): static {}

        /**
         * Check if two URLs are equivalent
         *
         * Checks if two URLs are equivalent.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.equals.php
         * @param \Uri\WhatWg\Url $url URL to compare the current URL against.
         * @param \Uri\UriComparisonMode $comparisonMode Whether the fragment component is taken
         * into account of the comparison (Uri\UriComparisonMode::IncludeFragment) or not
         * (Uri\UriComparisonMode::ExcludeFragment). By default, the fragment is excluded.
         * @return bool Returns true if the two URLs are equivalent, or false otherwise.
         */
        public function equals(\Uri\WhatWg\Url $url, \Uri\UriComparisonMode $comparisonMode = \Uri\UriComparisonMode::ExcludeFragment): bool {}

        /**
         * Recompose the URL as an ASCII string
         *
         * Recomposes the URL as an ASCII string, using punycode transcription instead of Unicode
         * characters in the host component.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.toasciistring.php
         * @return string Returns the recomposed URL as an ASCII string.
         */
        public function toAsciiString(): string {}

        /**
         * Recompose the URL as a Unicode string
         *
         * Recomposes the URL as a string, where the host component may contain Unicode characters.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.tounicodestring.php
         * @return string Returns the recomposed URL as a Unicode string.
         */
        public function toUnicodeString(): string {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.resolve.php
         * @param string $uri A valid URL string (e.g. /foo or (e.g. https://example.com/foo) to
         * apply on the current object.
         * @param array $softErrors
         *
         * @throws \Uri\WhatWg\InvalidUrlException
         */
        public function resolve(string $uri, &$softErrors = null): static {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.serialize.php
         * @throws \Exception
         */
        public function __serialize(): array {}

        /**
         * @link https://php.net/manual/en/uri-whatwg-url.unserialize.php
         * @throws \Exception
         */
        public function __unserialize(array $data): void {}

        /**
         * Return the internal state of the URL
         *
         * Returns the internal state of the URL.
         *
         * @link https://php.net/manual/en/uri-whatwg-url.debuginfo.php
         * @return array Returns the internal state of the URL as an array.
         */
        public function __debugInfo(): array {}

        /**
         * @since 8.6
         */
        public function getHostType(): ?UrlHostType {}

        /**
         * @since 8.6
         */
        public function isSpecialScheme(): bool {}
    }

    /**
     * @since 8.6
     */
    enum UrlHostType implements \UnitEnum
    {
        case IPv4;
        case IPv6;
        case Domain;
        case Opaque;
        case Empty;
    }
}
