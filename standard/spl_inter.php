<?php
/**
 * PHPStorm stub file for Standard PHP Library(SPL) interfaces.
 *
 * @link http://php.net/manual/en/spl.interfaces.php
 */

/**
 * Classes implementing <b>Countable</b> can be used with the
 * <b>count</b> function.
 *
 * @link http://php.net/manual/en/class.countable.php
 */
interface Countable
{
    /**
     * Count elements of an object
     *
     * @link  http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count();
}

/**
 * Classes implementing <b>OuterIterator</b> can be used to iterate
 * over iterators.
 *
 * @link http://php.net/manual/en/class.outeriterator.php
 */
interface OuterIterator extends Iterator
{
    /**
     * Returns the inner iterator for the current entry.
     *
     * @link  http://php.net/manual/en/outeriterator.getinneriterator.php
     * @return Iterator The inner iterator for the current entry.
     * @since 5.1.0
     */
    public function getInnerIterator();
}

/**
 * Classes implementing <b>RecursiveIterator</b> can be used to iterate
 * over iterators recursively.
 *
 * @link http://php.net/manual/en/class.recursiveiterator.php
 */
interface RecursiveIterator extends Iterator
{
    /**
     * Returns an iterator for the current entry.
     *
     * @link  http://php.net/manual/en/recursiveiterator.getchildren.php
     * @return RecursiveIterator An iterator for the current entry.
     * @since 5.1.0
     */
    public function getChildren();

    /**
     * Returns if an iterator can be created for the current entry.
     *
     * @link  http://php.net/manual/en/recursiveiterator.haschildren.php
     * @return bool true if the current entry can be iterated over, otherwise returns false.
     * @since 5.1.0
     */
    public function hasChildren();
}

/**
 * The Seekable iterator.
 *
 * @link http://php.net/manual/en/class.seekableiterator.php
 */
interface SeekableIterator extends Iterator
{
    /**
     * Seeks to a position
     *
     * @link  http://php.net/manual/en/seekableiterator.seek.php
     *
     * @param int $position <p>
     *                      The position to seek to.
     *                      </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function seek($position);
}
