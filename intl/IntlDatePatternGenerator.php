<?php

/**
 * Generates localized date and/or time format pattern strings suitable for use in
 * IntlDateFormatter.
 * @link https://php.net/manual/en/class.intldatepatterngenerator.php
 * @since 8.1
 */
class IntlDatePatternGenerator
{
    /**
     * Creates a new IntlDatePatternGenerator instance
     * @link https://php.net/manual/en/intldatepatterngenerator.create.php
     * @param string|null $locale The locale. If null is passed, uses the ini setting
     * intl.default_locale.
     */
    public function __construct(?string $locale = null) {}

    /**
     * Creates a new IntlDatePatternGenerator instance
     * @link https://php.net/manual/en/intldatepatterngenerator.create.php
     * @param string|null $locale The locale. If null is passed, uses the ini setting
     * intl.default_locale.
     * @return IntlDatePatternGenerator|null Returns an IntlDatePatternGenerator instance on
     * success, or null on failure.
     */
    public static function create(?string $locale = null): ?IntlDatePatternGenerator {}

    /**
     * Determines the most suitable date/time format
     *
     * Determines which date/time format is most suitable for a particular locale.
     *
     * @link https://php.net/manual/en/intldatepatterngenerator.getbestpattern.php
     * @param string $skeleton The skeleton.
     * @return string|false Returns an ICU date/time pattern accepted by IntlDateFormatter on
     * success, or false on failure.
     */
    public function getBestPattern(string $skeleton): string|false {}
}
