<?php

/**
 * @since 8.6
 */
final class IntlNumberRangeFormatter
{
    public const int COLLAPSE_AUTO = 0;
    public const int COLLAPSE_NONE = 1;
    public const int COLLAPSE_UNIT = 2;
    public const int COLLAPSE_ALL = 3;
    public const int IDENTITY_FALLBACK_SINGLE_VALUE = 0;
    public const int IDENTITY_FALLBACK_APPROXIMATELY_OR_SINGLE_VALUE = 1;
    public const int IDENTITY_FALLBACK_APPROXIMATELY = 2;
    public const int IDENTITY_FALLBACK_RANGE = 3;

    private function __construct() {}

    public static function createFromSkeleton(string $skeleton, string $locale, int $collapse, int $identityFallback): IntlNumberRangeFormatter {}

    public function format(int|float $start, int|float $end): string {}

    public function getErrorCode(): int {}

    public function getErrorMessage(): string {}
}
