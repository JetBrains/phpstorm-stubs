<?php

namespace Relay;

/**
 * Relay Table is a persistent hash table shared across workers that can store arbitrary data.
 */
class Table
{
    /**
     * Returns a key's value, or `null` if key doesn't exist.
     *
     * @param  string  $key
     * @param  string|null  $namespace
     * @return mixed
     */
    public static function get(string $key, ?string $namespace = null): mixed {}

    /**
     * Get the value and metadata of key.
     *
     * @param  mixed  $key
     * @param  string|null  $namespace
     * @return array{0: mixed, 1: array{cached: bool, length: int}}|false
     */
    public static function getWithMeta(mixed $key, ?string $namespace = null): array|false {}

    /**
     * Sets a key and its value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @param  int|null  $expire
     * @param  string|null  $namespace
     * @return bool
     */
    public static function set(string $key, mixed $value, ?int $expire = null, ?string $namespace = null): bool {}

    /**
     * Records numeric values in a fixed-resolution, fixed-retention time series.
     *
     * Field names must start with `+` (sum), `~` (mean), or `=` (last value).
     * The timestamp, resolution, and retention are expressed in Unix milliseconds.
     *
     * A `null` value keeps its field in the schema, but records no sample for it,
     * leaving aggregates and the field's type untouched.
     *
     * @param  string  $key
     * @param  int  $resolution
     * @param  int  $retention
     * @param  array<string, int|float|null>  $metrics
     * @param  int|null  $timestamp
     * @param  string|null  $namespace
     * @return bool
     */
    public static function recordMetrics(
        string $key,
        int $resolution,
        int $retention,
        array $metrics,
        ?int $timestamp = null,
        ?string $namespace = null
    ): bool {}

    /**
     * Returns a stats series, optionally restricted by inclusive bucket timestamps.
     *
     * Fields that never held a value have no type, and buckets in which a field
     * held no value are returned as `null`.
     *
     * @param  string  $key
     * @param  int|null  $from
     * @param  int|null  $to
     * @param  string|null  $namespace
     * @return array{
     *     resolution: int,
     *     retention: int,
     *     fields: list<array{name: string, type: 'int'|'double'|null, aggregate: 'sum'|'mean'|'last'}>,
     *     rows: list<list<int|float|null>>
     * }|false
     */
    public static function getMetrics(
        string $key,
        ?int $from = null,
        ?int $to = null,
        ?string $namespace = null
    ): array|false {}

    /**
     * Checks if a key exists in the table.
     *
     * @param  string  $key
     * @param  string|null  $namespace
     * @return bool
     */
    public static function exists(string $key, ?string $namespace = null): bool {}

    /**
     * Remove a key from the table.
     *
     * @param  string  $key
     * @param  string|null  $namespace
     * @return bool
     */
    public static function delete(string $key, ?string $namespace = null): bool {}

    /**
     * Returns the remaining time to live of a key that has a timeout,
     * or `false` if the key doesn't exist or has no timeout.
     *
     * @param  string  $key
     * @param  string|null  $namespace
     * @return int|false
     */
    public static function ttl(string $key, ?string $namespace = null): int|false {}

    /**
     * Returns the number of keys stored in the table.
     *
     * @param  string|null  $namespace
     * @return int|false
     */
    public static function count(?string $namespace = null): int|false {}

    /**
     * Removes all keys from the table.
     *
     * @param  string|null  $namespace
     * @return bool
     */
    public static function clear(?string $namespace = null): bool {}

    /**
     * Returns all keys matching pattern.
     *
     * @param  mixed  $pattern
     * @param  string|null  $namespace
     * @return array|false
     */
    public static function keys(mixed $pattern, ?string $namespace = null): array|false {}

    /**
     * Returns the number of bytes allocated for all elements.
     *
     * @param  string|null  $namespace
     * @return int|false
     */
    public static function memory(?string $namespace = null): int|false {}

    /**
     * Returns all table namespaces.
     *
     * @return array|false
     */
    public static function namespaces(): array|false {}

    /**
     * Removes all keys from all namespaces.
     *
     * @return int|false
     */
    public static function clearAll(): int|false {}

    /**
     * Scan the keyspace for matching keys on each namespace.
     *
     * @param  mixed  $match
     * @param  int  $count
     * @return \Generator<int, list<string>>|false
     */
    public static function fullscan(mixed $match = null, int $count = 0): \Generator|false {}

    /**
     * Returns statistics about Table.
     *
     * @return array<string, mixed>|false
     */
    public static function stats(): array|false {}
}

/**
 * Thrown when recorded metrics conflict with a key's existing series — a field
 * set, value type, resolution, or retention that does not match the series'
 * schema, or a key that does not hold a metrics series at all.
 */
class TableMetricsSchemaException extends Exception
{
}
