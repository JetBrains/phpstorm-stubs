<?php

namespace Relay;

/**
 * Lazily iterates the keys of `BLESS SCAN`, fetching one page at a time. Rewinding
 * restarts the scan once a key has been consumed.
 *
 * @implements \Iterator<int, string>
 */
final class BlessScanIterator implements \Iterator
{
    /**
     * Returns the current key name, or `null` when the scan has finished.
     *
     * @return string|null
     */
    public function current(): mixed {}

    /**
     * Returns the position of the current key, or `null` when the scan has finished.
     *
     * @return int|null
     */
    public function key(): mixed {}

    /**
     * Moves to the next key.
     *
     * @return void
     */
    public function next(): void {}

    /**
     * Restarts the scan if any keys have been consumed.
     *
     * @return void
     */
    public function rewind(): void {}

    /**
     * Returns whether there is a current key, fetching pages as needed.
     *
     * @return bool
     */
    public function valid(): bool {}
}
