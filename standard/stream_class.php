<?php
/**
 * PHPStorm stub file for Streams classes.
 *
 * @link http://php.net/manual/en/book.stream.php
 *
 * @todo add abstract streamWrapper class.
 */

/**
 * Class php_user_filter
 */
class php_user_filter
{
    public $filtername;
    public $params;

    /**
     * @link http://php.net/manual/en/php-user-filter.filter.php
     *
     * @param resource $in       <p> is a resource pointing to a <i>bucket brigade</i< which contains one or more
     *                           <i>bucket</i> objects containing data to be filtered.</p>
     * @param resource $out      <p>is a resource pointing to a second bucket brigade into which your modified buckets
     *                           should be placed.</p>
     * @param int      $consumed <p>which must <i>always</i> be declared by reference, should be incremented by the
     *                           length of the data which your filter reads in and alters. In most cases this means you
     *                           will increment consumed by <i>$bucket->datalen</i> for each <i>$bucket</i>.</p>
     * @param bool     $closing  <p>If the stream is in the process of closing (and therefore this is the last pass
     *                           through the filterchain), the closing parameter will be set to <b>TRUE</b>
     *
     * @return int <p>
     * The <b>filter()</b> method must return one of
     * three values upon completion.
     * </p><table>
     *
     * <thead>
     * <tr>
     * <th>Return Value</th>
     * <th>Meaning</th>
     * </tr>
     *
     * </thead>
     *
     * <tbody class="tbody">
     * <tr>
     * <td><b>PSFS_PASS_ON</b></td>
     * <td>
     * Filter processed successfully with data available in the
     * <code class="parameter">out</code> <em>bucket brigade</em>.
     * </td>
     * </tr>
     *
     * <tr>
     * <td><b>PSFS_FEED_ME</b></td>
     * <td>
     * Filter processed successfully, however no data was available to
     * return. More data is required from the stream or prior filter.
     * </td>
     * </tr>
     *
     * <tr>
     * <td><b>PSFS_ERR_FATAL</b> (default)</td>
     * <td>
     * The filter experienced an unrecoverable error and cannot continue.
     * </td>
     * </tr>
     *
     */
    public function filter($in, $out, &$consumed, $closing) { }

    /**
     * @link http://php.net/manual/en/php-user-filter.onclose.php
     */
    public function onClose() { }

    /**
     * @link http://php.net/manual/en/php-user-filter.oncreate.php
     * @return bool
     */
    public function onCreate() { }
}
