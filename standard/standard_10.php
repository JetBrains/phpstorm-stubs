<?php
/**
 * @link https://php.net/manual/en/function.array-find.php
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param callable(TValue, TKey): bool $callback The callback function to call to check each element, which must be of
 * the following signature: boolcallback mixedvalue mixedkey If this function returns true, the
 * value is returned from array_find and the callback will not be called for further elements.
 * @return TValue|null
 * @since 8.4
 */
function array_find(array $array, callable $callback): mixed {}

/**
 * Checks if at least one array element satisfies a callback function.
 * Returns true, if the given callback returns true for any element. Otherwise the function returns false.
 * @link https://php.net/manual/en/function.array-find-key.php
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param callable(TValue, TKey): bool $callback The callback function to call to check each element, which must be of
 * the following signature: boolcallback mixedvalue mixedkey If this function returns true, the key
 * is returned from array_find_key and the callback will not be called for further elements.
 * @return TKey|null
 * @since 8.4
 */
function array_find_key(array $array, callable $callback): mixed {}
/**
 * @link https://php.net/manual/en/function.array-any.php
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param callable(TValue, TKey): bool $callback The callback function to call to check each element, which must be of
 * the following signature: boolcallback mixedvalue mixedkey If this function returns true, true is
 * returned from array_any and the callback will not be called for further elements.
 * @return bool
 * @since 8.4
 */
function array_any(array $array, callable $callback): bool {}

/**
 * Checks if all array elements satisfy a callback function.
 * Returns true, if the given callback returns true for all elements. Otherwise the function returns false.
 * @link https://php.net/manual/en/function.array-all.php
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param callable(TValue, TKey): bool $callback The callback function to call to check each element, which must be of
 * the following signature: boolcallback mixedvalue mixedkey If this function returns false, false
 * is returned from array_all and the callback will not be called for further elements.
 * @return bool
 * @since 8.4
 */
function array_all(array $array, callable $callback): bool {}

/**
 * @link https://php.net/manual/en/function.http-get-last-response-headers.php
 * @since 8.4
 */
function http_get_last_response_headers(): ?array {}
/**
 * @link https://php.net/manual/en/function.http-clear-last-response-headers.php
 * @since 8.4
 */
function http_clear_last_response_headers(): void {}

/**
 * @link https://php.net/manual/en/function.request-parse-body.php
 * @since 8.4
 * @param array|null $options
 * @return array<int, array>
 * @throws RequestParseBodyException if the request body uses an invalid/unsupported content type
 */
function request_parse_body(?array $options = null): array {}
/**
 * @link https://php.net/manual/en/function.fpow.php
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
