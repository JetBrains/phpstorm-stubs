<?php

namespace Relay;

class AdaptiveCache
{
    /**
     * Whether the adaptive cache is enabled for this Relay object.
     *
     * Since the Count-Min Sketch is shared it may exist for a given endpoint,
     * but not be enabled for a specific Relay object. When it exists but is not
     * enabled for a specific object the sketch counts will still be updated.
     *
     * @readonly
     * @var bool
     */
    public bool $enabled = false;

    /**
     * The actual state of the adaptive cache. The user can request an adaptive
     * cache of a certain width and depth, but it is not actually created until
     * Relay attaches to an in-memory endpoint. This can fail if we are out of
     * memory. This property will be ['inactive', 'active'].
     *
     * @readonly
     * @var string
     */
    public string $status = 'inactive';

    /**
     * The underlying count-min sketch width.
     *
     * @readonly
     * @var int
     */
    public int $width = 0;

    /**
     * The underlying count-min sketch depth.
     *
     * @readonly
     * @var int
     */
    public int $depth = 0;

    /**
     * Minimum number of events before a key is cached.
     *
     * @readonly
     * @var int
     */
    public int $minEvents = 0;

    /**
     * Minimum read/write ratio before a key is cached.
     *
     * @readonly
     * @var float
     */
    public float $minRatio = 0.0;

    /**
     * The adaptive cache formula (`pure`, `scaled`).
     *
     * @readonly
     * @var string
     */
    public string $formula = 'scaled';

    /**
     * @internal
     */
    protected function __construct() {}

    /**
     * Returns the estimated load factor.
     *
     * @return float|false
     */
    #[Attributes\Local]
    public function loadFactor(int $depth = 1): float|false {}

    /**
     * Flush the adaptive cache.
     *
     * @param  bool  $async
     * @return bool
     */
    #[Attributes\Local]
    public function flush(bool $async = true): bool {}

    /**
     * Returns stats for given key name.
     *
     * @param  string  $key
     * @return array|false
     */
    #[Attributes\Local]
    public function stats(string $key): array|false {}

    /**
     * Increment a key's read or write counter by given count.
     *
     * @param  string  $key
     * @param  bool  $write
     * @param  int  $count
     * @return bool
     */
    #[Attributes\Local]
    public function incrBy(string $key, bool $write, int $count): bool {}

    /**
     * Get the last time the adaptive cache was flushed.
     *
     * @return float
     */
    #[Attributes\Local]
    public function lastFlush(): float {}
}
