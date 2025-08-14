<?php

/**
 * @since 8.5
 */
final class IntlListFormatter
{
    public const int TYPE_AND = 0;
    public const int TYPE_OR = 2;
    public const int TYPE_UNITS = 3;
    public const int WIDTH_WIDE = 0;
    public const int WIDTH_SHORT = 1;
    public const int WIDTH_NARROW = 2;

    public function __construct(string $locale, int $type = IntlListFormatter::TYPE_AND, int $width = IntlListFormatter::WIDTH_WIDE) {}

    public function format(array $strings): string|false {}

    public function getErrorCode(): int {}

    public function getErrorMessage(): string {}
}
