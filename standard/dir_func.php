<?php
/**
 * PHPStorm stub file for Directories functions.
 *
 * @link http://php.net/manual/en/book.dir.php
 */

/**
 * Change directory
 *
 * @link  http://php.net/manual/en/function.chdir.php
 *
 * @param string $directory <p>
 *                          The new current directory
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function chdir($directory) { }

/**
 * Change the root directory
 *
 * @link  http://php.net/manual/en/function.chroot.php
 *
 * @param string $directory <p>
 *                          The new directory
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0.5
 * @since 5.0
 */
function chroot($directory) { }

/**
 * Close directory handle
 *
 * @link  http://php.net/manual/en/function.closedir.php
 *
 * @param resource $dir_handle [optional] <p>
 *                             The directory handle resource previously opened
 *                             with opendir. If the directory handle is
 *                             not specified, the last link opened by opendir
 *                             is assumed.
 *                             </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function closedir($dir_handle = null) { }

/**
 * Return an instance of the Directory class
 *
 * @link  http://php.net/manual/en/class.dir.php
 *
 * @param $directory
 * @param $context [optional]
 *
 * @return Directory
 * @since 4.0
 * @since 5.0
 */
function dir($directory, $context) { }

/**
 * Gets the current working directory
 *
 * @link  http://php.net/manual/en/function.getcwd.php
 * @return string the current working directory on success, or false on
 * failure.
 * </p>
 * <p>
 * On some Unix variants, getcwd will return
 * false if any one of the parent directories does not have the
 * readable or search mode set, even if the current directory
 * does. See chmod for more information on
 * modes and permissions.
 * @since 4.0
 * @since 5.0
 */
function getcwd() { }

/**
 * Open directory handle
 *
 * @link  http://php.net/manual/en/function.opendir.php
 *
 * @param string   $path    <p>
 *                          The directory path that is to be opened
 *                          </p>
 * @param resource $context [optional] <p>
 *                          For a description of the context parameter,
 *                          refer to the streams section of
 *                          the manual.
 *                          </p>
 *
 * @return resource|false a directory handle resource on success, or false on failure. If path is not a valid directory
 *                        or the directory can not be opened due to permission restrictions or filesystem errors,
 *                        opendir returns false and generates a PHP error of level E_WARNING. You can suppress the
 *                        error output of  opendir by prepending '@' to the front of the function name.
 * @since 4.0
 * @since 5.0
 */
function opendir($path, $context = null) { }

/**
 * Read entry from directory handle
 *
 * @link  http://php.net/manual/en/function.readdir.php
 *
 * @param resource $dir_handle [optional] <p>
 *                             The directory handle resource previously opened
 *                             with opendir. If the directory handle is
 *                             not specified, the last link opened by opendir
 *                             is assumed.
 *                             </p>
 *
 * @return string|false the filename on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function readdir($dir_handle = null) { }

/**
 * Rewind directory handle
 *
 * @link  http://php.net/manual/en/function.rewinddir.php
 *
 * @param resource $dir_handle [optional] <p>
 *                             The directory handle resource previously opened
 *                             with opendir. If the directory handle is
 *                             not specified, the last link opened by opendir
 *                             is assumed.
 *                             </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function rewinddir($dir_handle = null) { }

/**
 * List files and directories inside the specified path
 *
 * @link  http://php.net/manual/en/function.scandir.php
 *
 * @param string   $directory     <p>
 *                                The directory that will be scanned.
 *                                </p>
 * @param int      $sorting_order [optional] <p>
 *                                By default, the sorted order is alphabetical in ascending order. If
 *                                the optional sorting_order is set to non-zero,
 *                                then the sort order is alphabetical in descending order.
 *                                </p>
 * @param resource $context       [optional] <p>
 *                                For a description of the context parameter,
 *                                refer to the streams section of
 *                                the manual.
 *                                </p>
 *
 * @return array|false an array of filenames on success, or false on failure. If directory is not a directory, then
 *                     boolean false is returned, and an error of level E_WARNING is generated.
 * @since 5.0
 */
function scandir($directory, $sorting_order = null, $context = null) { }
