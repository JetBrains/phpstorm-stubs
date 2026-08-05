<?php

namespace StubTests\Framework\Parsers\Stubs\Versions;

/**
 * Value object holding the deprecation state of a stub element.
 *
 * `$sinceVersion` is the PHP language level the element becomes deprecated at. It is null
 * when deprecation is declared without a version, which means "deprecated in every version
 * the element exists in" — the same meaning the JetBrains attribute gives its `$since = "5.6"`
 * default, 5.6 being the earliest version this suite validates.
 */
final class ParsedDeprecation
{
    public function __construct(
        public readonly bool $isDeprecated = false,
        public readonly ?string $sinceVersion = null
    ) {
    }
}
