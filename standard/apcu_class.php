<?php
/**
 * PHPStorm stub file for APCu classes.
 *
 * @link http://php.net/manual/en/book.apcu.php
 */

/**
 * The APCUIterator class
 *
 * The APCUIterator class makes it easier to iterate over large APCu caches.
 * This is helpful as it allows iterating over large caches in steps, while grabbing a defined number
 * of entries per lock instance, so it frees the cache locks for other activities rather than hold up
 * the entire cache to grab 100 (the default) entries. Also, using regular expression matching is more
 * efficient as it's been moved to the C level.
 *
 * @link  http://php.net/manual/en/class.apcuiterator.php
 * @since APCu 5.0.0
 */
class APCUIterator implements Iterator
{
    /**
     * Constructs an APCUIterator iterator object
     *
     * @link http://php.net/manual/en/apcuiterator.construct.php
     *
     * @param string|string[]|null $search     A PCRE regular expression that matches against APCu key names,
     *                                         either as a string for a single regular expression, or as an array of
     *                                         regular expressions. Or, optionally pass in NULL to skip the search.
     * @param int                  $format     The desired format, as configured with one ore more of the APC_ITER_*
     *                                         constants.
     * @param int                  $chunk_size The chunk size. Must be a value greater than 0. The default value is
     *                                         100.
     * @param int                  $list       The type to list. Either pass in APC_LIST_ACTIVE  or APC_LIST_DELETED.
     */
    public function __construct($search = null, $format = APC_ITER_ALL, $chunk_size = 100, $list = APC_LIST_ACTIVE) { }

    /**
     * Gets the current item from the APCUIterator stack
     *
     * @link http://php.net/manual/en/apcuiterator.current.php
     * @return mixed Returns the current item on success, or FALSE if no more items or exist, or on failure.
     */
    public function current() { }

    /**
     * Get the total count
     *
     * @link http://php.net/manual/en/apcuiterator.gettotalcount.php
     * @return int|bool The total count.
     */
    public function getTotalCount() { }

    /**
     * Gets the total number of cache hits
     *
     * @link http://php.net/manual/en/apcuiterator.gettotalhits.php
     * @return int|bool The number of hits on success, or FALSE on failure.
     */
    public function getTotalHits() { }

    /**
     * Gets the total cache size
     *
     * @link http://php.net/manual/en/apcuiterator.gettotalsize.php
     * @return int|bool The total cache size.
     */
    public function getTotalSize() { }

    /**
     * Gets the current iterator key
     *
     * @link http://php.net/manual/en/apcuiterator.key.php
     * @return string|int|bool Returns the key on success, or FALSE upon failure.
     */
    public function key() { }

    /**
     * Moves the iterator pointer to the next element
     *
     * @link http://php.net/manual/en/apcuiterator.next.php
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function next() { }

    /**
     * Rewinds back the iterator to the first element
     *
     * @link http://php.net/manual/en/apcuiterator.rewind.php
     */
    public function rewind() { }

    /**
     * Checks if the current iterator position is valid
     *
     * @link http://php.net/manual/en/apcuiterator.valid.php
     * @return bool Returns TRUE if the current iterator position is valid, otherwise FALSE.
     */
    public function valid() { }
}
