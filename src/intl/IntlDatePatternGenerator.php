<?php

/**
 * @since 8.1
 */
class IntlDatePatternGenerator
{
    public function __construct(?string $locale = null) {}

    public static function create(?string $locale = null): ?IntlDatePatternGenerator {}

    public function getBestPattern(string $skeleton): string|false {}
}
