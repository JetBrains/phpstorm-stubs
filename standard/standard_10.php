<?php
/**
 * Returns the first element satisfying a callback function
 *
 * array_find returns the value of the first element of an array for which the given callback
 * returns true. If no matching element is found the function returns null.
 *
 * @link https://php.net/manual/en/function.array-find.php
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array The array that should be searched.
 * @param callable(TValue, TKey): bool $callback The callback function to call to check each element, which must be of
 * the following signature:
 * <code>callback ( mixed \$value , mixed \$key ): bool</code>
 * <br/>If this function returns true, the
 * value is returned from array_find and the callback will not be called for further elements.
 * @return TValue|null The function returns the value of the first element for which the callback
 * returns true. If no matching element is found the function returns null.
 * @since 8.4
 */
function array_find(array $array, callable $callback): mixed {}

/**
 * Checks if at least one array element satisfies a callback function.
 * Returns true, if the given callback returns true for any element. Otherwise the function returns false.
 * @link https://php.net/manual/en/function.array-find-key.php
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array The array that should be searched.
 * @param callable(TValue, TKey): bool $callback The callback function to call to check each element, which must be of
 * the following signature:
 * <code>callback ( mixed \$value , mixed \$key ): bool</code>
 * <br/>If this function returns true, the key
 * is returned from array_find_key and the callback will not be called for further elements.
 * @return TKey|null The function returns the key of the first element for which the callback
 * returns true. If no matching element is found the function returns null.
 * @since 8.4
 */
function array_find_key(array $array, callable $callback): mixed {}
/**
 * Checks if at least one array element satisfies a callback function
 *
 * array_any returns true, if the given callback returns true for any element. Otherwise the
 * function returns false.
 *
 * @link https://php.net/manual/en/function.array-any.php
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array The array that should be searched.
 * @param callable(TValue, TKey): bool $callback The callback function to call to check each element, which must be of
 * the following signature:
 * <code>callback ( mixed \$value , mixed \$key ): bool</code>
 * <br/>If this function returns true, true is
 * returned from array_any and the callback will not be called for further elements.
 * @return bool The function returns true, if there is at least one element for which callback
 * returns true. Otherwise the function returns false.
 * @since 8.4
 */
function array_any(array $array, callable $callback): bool {}

/**
 * Checks if all array elements satisfy a callback function.
 * Returns true, if the given callback returns true for all elements. Otherwise the function returns false.
 * @link https://php.net/manual/en/function.array-all.php
 * @template TKey
 * @template TValue
 * @param array<TKey, TValue> $array The array that should be searched.
 * @param callable(TValue, TKey): bool $callback The callback function to call to check each element, which must be of
 * the following signature:
 * <code>callback ( mixed \$value , mixed \$key ): bool</code>
 * <br/>If this function returns false, false
 * is returned from array_all and the callback will not be called for further elements.
 * @return bool The function returns true, if callback returns true for all elements. Otherwise the
 * function returns false.
 * @since 8.4
 */
function array_all(array $array, callable $callback): bool {}

/**
 * Retrieve last HTTP response headers
 *
 * Returns an array containing the last HTTP response headers received via the HTTP wrapper. If
 * there are none, null is returned instead.
 *
 * @link https://php.net/manual/en/function.http-get-last-response-headers.php
 * @since 8.4
 */
function http_get_last_response_headers(): ?array {}
/**
 * Clears the stored HTTP response headers
 *
 * Clears the HTTP response headers that were received using the HTTP wrapper.
 *
 * @link https://php.net/manual/en/function.http-clear-last-response-headers.php
 * @since 8.4
 */
function http_clear_last_response_headers(): void {}

/**
 * Read and parse the request body and return the result
 *
 * This function reads the request body and parses it according to the Content-Type header.
 * Currently, two content types are supported:
 *
 * @link https://php.net/manual/en/function.request-parse-body.php
 * @since 8.4
 * @param array|null $options The options parameter accepts an associative array to override the
 * following global settings for parsing of the request body. max_file_uploads max_input_vars
 * max_multipart_body_parts post_max_size upload_max_filesize
 * @return array<int, array> request_parse_body returns an array pair with the equivalent of $_POST
 * at index 0 and $_FILES at index 1.
 * @throws RequestParseBodyException if the request body uses an invalid/unsupported content type
 */
function request_parse_body(?array $options = null): array {}
/**
 * Raise one number to the power of another, according to IEEE 754
 *
 * Returns the floating point result of raising num to the power of exponent. If num is zero and
 * exponent is less than zero, then INF is returned.
 *
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
