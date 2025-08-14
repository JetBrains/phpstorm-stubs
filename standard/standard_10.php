<?php
/**
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param callable(TValue, TKey): bool
 * @return TValue|null
 * @since 8.4
 */
function array_find(array $array, callable $callback): mixed {}
/**
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param callable(TValue, TKey): bool
 * @return TKey|null
 * @since 8.4
 */
function array_find_key(array $array, callable $callback): mixed {}
/**
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param callable(TValue, TKey): bool
 * @return bool
 * @since 8.4
 */
function array_any(array $array, callable $callback): bool {}
/**
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param callable(TValue, TKey): bool
 * @return bool
 * @since 8.4
 */
function array_all(array $array, callable $callback): bool {}
/**
 * @since 8.4
 */
function http_get_last_response_headers(): ?array {}
/**
 * @since 8.4
 */
function http_clear_last_response_headers(): void {}

/**
 * @since 8.4
 * @param array|null $options
 * @return array<int, array>
 * @throws RequestParseBodyException if the request body uses an invalid/unsupported content type
 */
function request_parse_body(?array $options = null): array {}
/**
 * @since 8.4
 */
function fpow(float $num, float $exponent): float {}

/**
 * @since 8.4
 */
enum RoundingMode implements \UnitEnum
{
    case HalfAwayFromZero;
    case HalfTowardsZero;
    case HalfEven;
    case HalfOdd;
    case TowardsZero;
    case AwayFromZero;
    case NegativeInfinity;
    case PositiveInfinity;

    public static function cases(): array {}
}
