<?php

/**
 * @since 8.5
 */
final class IntlListFormatter
{
    public const int TYPE_AND = 0;
    public const int TYPE_OR = 1;
    public const int TYPE_UNITS = 2;
    public const int WIDTH_WIDE = 0;
    public const int WIDTH_SHORT = 1;
    public const int WIDTH_NARROW = 2;

    /**
     * Creates a new IntlListFormatter instance
     *
     * Creates a new IntlListFormatter instance for the given locale.
     *
     * @link https://php.net/manual/en/intllistformatter.construct.php
     * @param string $locale The locale to use for formatting.
     * @param int $type The list type. One of the IntlListFormatter::TYPE_* constants:
     * IntlListFormatter::TYPE_AND, IntlListFormatter::TYPE_OR, or IntlListFormatter::TYPE_UNITS.
     * @param int $width The list width. One of the IntlListFormatter::WIDTH_* constants:
     * IntlListFormatter::WIDTH_WIDE, IntlListFormatter::WIDTH_SHORT, or
     * IntlListFormatter::WIDTH_NARROW.
     * @throws \IntlException Throws an IntlException if the formatter cannot be created (e.g.
     * invalid locale or ICU version is below 67).
     */
    public function __construct(string $locale, int $type = IntlListFormatter::TYPE_AND, int $width = IntlListFormatter::WIDTH_WIDE) {}

    /**
     * Format a list of items
     *
     * Formats a list of items as a locale-appropriate string.
     *
     * @link https://php.net/manual/en/intllistformatter.format.php
     * @param array $strings An array of strings to format as a list.
     * @return string|false The formatted list as a string, or false on failure.
     */
    public function format(array $strings): string|false {}

    public function getErrorCode(): int {}

    public function getErrorMessage(): string {}
}
