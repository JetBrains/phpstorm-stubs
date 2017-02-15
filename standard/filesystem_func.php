<?php
/**
 * PHPStorm stub file for Filesystem functions.
 *
 * @link http://php.net/manual/en/book.filesystem.php
 */

/**
 * Returns filename component of path
 *
 * @link  http://php.net/manual/en/function.basename.php
 *
 * @param string $path   <p>
 *                       A path.
 *                       </p>
 *                       <p>
 *                       On Windows, both slash (/) and backslash
 *                       (\) are used as directory separator character. In
 *                       other environments, it is the forward slash (/).
 *                       </p>
 * @param string $suffix [optional] <p>
 *                       If the filename ends in suffix this will also
 *                       be cut off.
 *                       </p>
 *
 * @return string the base name of the given path.
 * @since 4.0
 * @since 5.0
 */
function basename($path, $suffix = null) { }

/**
 * Changes file group
 *
 * @link  http://php.net/manual/en/function.chgrp.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 * @param mixed  $group    <p>
 *                         A group name or number.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function chgrp($filename, $group) { }

/**
 * Changes file mode
 *
 * @link  http://php.net/manual/en/function.chmod.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 * @param int    $mode     <p>
 *                         Note that mode is not automatically
 *                         assumed to be an octal value, so strings (such as "g+w") will
 *                         not work properly. To ensure the expected operation,
 *                         you need to prefix mode with a zero (0):
 *                         </p>
 *                         <p>
 *                         ]]>
 *                         </p>
 *                         <p>
 *                         The mode parameter consists of three octal
 *                         number components specifying access restrictions for the owner,
 *                         the user group in which the owner is in, and to everybody else in
 *                         this order. One component can be computed by adding up the needed
 *                         permissions for that target user base. Number 1 means that you
 *                         grant execute rights, number 2 means that you make the file
 *                         writeable, number 4 means that you make the file readable. Add
 *                         up these numbers to specify needed rights. You can also read more
 *                         about modes on Unix systems with 'man 1 chmod'
 *                         and 'man 2 chmod'.
 *                         </p>
 *                         <p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function chmod($filename, $mode) { }

/**
 * Changes file owner
 *
 * @link  http://php.net/manual/en/function.chown.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 * @param mixed  $user     <p>
 *                         A user name or number.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function chown($filename, $user) { }

/**
 * Clears file status cache
 *
 * @link  http://php.net/manual/en/function.clearstatcache.php
 *
 * @param bool   $clear_realpath_cache [optional] <p>
 *                                     Whenever to clear realpath cache or not.
 *                                     </p>
 * @param string $filename             [optional] <p>
 *                                     Clear realpath cache on a specific filename, only used if
 *                                     clear_realpath_cache is true.
 *                                     </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function clearstatcache($clear_realpath_cache = null, $filename = null) { }

/**
 * Copies file
 *
 * @link  http://php.net/manual/en/function.copy.php
 *
 * @param string   $source  <p>
 *                          Path to the source file.
 *                          </p>
 * @param string   $dest    <p>
 *                          The destination path. If dest is a URL, the
 *                          copy operation may fail if the wrapper does not support overwriting of
 *                          existing files.
 *                          </p>
 *                          <p>
 *                          If the destination file already exists, it will be overwritten.
 *                          </p>
 * @param resource $context [optional] <p>
 *                          A valid context resource created with
 *                          stream_context_create.
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function copy($source, $dest, $context = null) { }

/**
 * Returns directory name component of path
 *
 * @link  http://php.net/manual/en/function.dirname.php
 *
 * @param string $path   <p>
 *                       A path.
 *                       </p>
 *                       <p>
 *                       On Windows, both slash (/) and backslash
 *                       (\) are used as directory separator character. In
 *                       other environments, it is the forward slash (/).
 *                       </p>
 * @param int    $levels <p>
 *                       The number of parent directories to go up.
 *                       This must be an integer greater than 0.
 *                       </p>
 *
 * @return string the name of the directory. If there are no slashes in path, a dot ('.') is returned, indicating the
 *                current directory. Otherwise, the returned string is path with any trailing /component removed.
 * @since 4.0
 * @since 5.0
 */
function dirname($path, $levels = 1) { }

/**
 * Returns available space in directory
 *
 * @link  http://php.net/manual/en/function.disk-free-space.php
 *
 * @param string $directory <p>
 *                          A directory of the filesystem or disk partition.
 *                          </p>
 *                          <p>
 *                          Given a file name instead of a directory, the behaviour of the
 *                          function is unspecified and may differ between operating systems and
 *                          PHP versions.
 *                          </p>
 *
 * @return float|false the number of available bytes as a float or false on failure.
 * @since 4.1.0
 * @since 5.0
 */
function disk_free_space($directory) { }

/**
 * Returns the total size of a directory
 *
 * @link  http://php.net/manual/en/function.disk-total-space.php
 *
 * @param string $directory <p>
 *                          A directory of the filesystem or disk partition.
 *                          </p>
 *
 * @return float|false the total number of bytes as a float or false on failure.
 * @since 4.1.0
 * @since 5.0
 */
function disk_total_space($directory) { }

/**
 * &Alias; <function>disk_free_space</function>
 *
 * @link  http://php.net/manual/en/function.diskfreespace.php
 *
 * @param string $directory <p>
 *                          A directory of the filesystem or disk partition.
 *                          </p>
 *                          <p>
 *                          Given a file name instead of a directory, the behaviour of the
 *                          function is unspecified and may differ between operating systems and
 *                          PHP versions.
 *                          </p>
 *
 * @return float|false the number of available bytes as a float or false on failure.
 * @since 4.0
 * @since 5.0
 */
function diskfreespace($directory) { }

/**
 * Closes an open file pointer
 *
 * @link  http://php.net/manual/en/function.fclose.php
 *
 * @param resource $handle <p>
 *                         The file pointer must be valid, and must point to a file successfully
 *                         opened by fopen or fsockopen.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function fclose($handle) { }

/**
 * Tests for end-of-file on a file pointer
 *
 * @link  http://php.net/manual/en/function.feof.php
 *
 * @param resource $handle The file pointer must be valid, and must point to a file successfully opened by fopen()
 *                         or fsockopen() (and not yet closed by fclose()).
 *
 * @return bool true if the file pointer is at EOF or an error occurs (including socket timeout); otherwise returns
 *              false.
 * @since 4.0
 * @since 5.0
 */
function feof($handle) { }

/**
 * Flushes the output to a file
 *
 * @link  http://php.net/manual/en/function.fflush.php
 *
 * @param resource $handle The file pointer must be valid, and must point to a file successfully opened by fopen()
 *                         or fsockopen() (and not yet closed by fclose()).
 *
 * @return bool true on success or false on failure.
 * @since 4.0.1
 * @since 5.0
 */
function fflush($handle) { }

/**
 * Gets character from file pointer
 *
 * @link  http://php.net/manual/en/function.fgetc.php
 *
 * @param resource $handle The file pointer must be valid, and must point to a file successfully opened by fopen()
 *                         or fsockopen() (and not yet closed by fclose()).
 *
 * @return string|false a string containing a single character read from the file pointed to by handle. Returns false
 *                      on EOF.
 * @since 4.0
 * @since 5.0
 */
function fgetc($handle) { }

/**
 * Gets line from file pointer and parse for CSV fields
 *
 * @link  http://php.net/manual/en/function.fgetcsv.php
 *
 * @param resource $handle    <p>
 *                            A valid file pointer to a file successfully opened by
 *                            fopen, popen, or
 *                            fsockopen.
 *                            </p>
 * @param int      $length    [optional] <p>
 *                            Must be greater than the longest line (in characters) to be found in
 *                            the CSV file (allowing for trailing line-end characters). It became
 *                            optional in PHP 5. Omitting this parameter (or setting it to 0 in PHP
 *                            5.0.4 and later) the maximum line length is not limited, which is
 *                            slightly slower.
 *                            </p>
 * @param string   $delimiter [optional] <p>
 *                            Set the field delimiter (one character only).
 *                            </p>
 * @param string   $enclosure [optional] <p>
 *                            Set the field enclosure character (one character only).
 *                            </p>
 * @param string   $escape    [optional] <p>
 *                            Set the escape character (one character only). Defaults as a backslash.
 *                            </p>
 *
 * @return array|false an indexed array containing the fields read.
 * </p>
 * <p>
 * A blank line in a CSV file will be returned as an array comprising a single null field, and will not be treated as
 * an error.
 * </p>
 * &note.line-endings;
 * <p>
 * fgetcsv returns &null; if an invalid handle is supplied or false on other errors, including end of file.
 * @since 4.0
 * @since 5.0
 */
function fgetcsv($handle, $length = null, $delimiter = null, $enclosure = null, $escape = null) { }

/**
 * Gets line from file pointer
 *
 * @link  http://php.net/manual/en/function.fgets.php
 *
 * @param resource $handle The file pointer must be valid, and must point to a file successfully opened by fopen()
 *                         or fsockopen() (and not yet closed by fclose()).
 * @param int      $length [optional] <p>
 *                         Reading ends when length - 1 bytes have been
 *                         read, on a newline (which is included in the return value), or on EOF
 *                         (whichever comes first). If no length is specified, it will keep
 *                         reading from the stream until it reaches the end of the line.
 *                         </p>
 *                         <p>
 *                         Until PHP 4.3.0, omitting it would assume 1024 as the line length.
 *                         If the majority of the lines in the file are all larger than 8KB,
 *                         it is more resource efficient for your script to specify the maximum
 *                         line length.
 *                         </p>
 *
 * @return string|false a string of up to length - 1 bytes read from the file pointed to by handle. If an error occurs,
 *                      returns false.
 * @since 4.0
 * @since 5.0
 */
function fgets($handle, $length = null) { }

/**
 * Gets line from file pointer and strip HTML tags
 *
 * @link  http://php.net/manual/en/function.fgetss.php
 *
 * @param resource $handle         The file pointer must be valid, and must point to a file successfully opened by
 *                                 fopen() or fsockopen() (and not yet closed by fclose()).
 * @param int      $length         [optional] <p>
 *                                 Length of the data to be retrieved.
 *                                 </p>
 * @param string   $allowable_tags [optional] <p>
 *                                 You can use the optional third parameter to specify tags which should
 *                                 not be stripped.
 *                                 </p>
 *
 * @return string a string of up to length - 1 bytes read from
 * the file pointed to by handle, with all HTML and PHP
 * code stripped.
 * </p>
 * <p>
 * If an error occurs, returns false.
 * @since 4.0
 * @since 5.0
 */
function fgetss($handle, $length = null, $allowable_tags = null) { }

/**
 * Reads entire file into an array
 *
 * @link  http://php.net/manual/en/function.file.php
 *
 * @param string   $filename <p>
 *                           Path to the file.
 *                           </p>
 *                           &tip.fopen-wrapper;
 * @param int      $flags    [optional] <p>
 *                           The optional parameter flags can be one, or
 *                           more, of the following constants:
 *                           FILE_USE_INCLUDE_PATH
 *                           Search for the file in the include_path.
 * @param resource $context  [optional] <p>
 *                           A context resource created with the
 *                           stream_context_create function.
 *                           </p>
 *                           <p>
 *                           &note.context-support;
 *                           </p>
 *
 * @return array|false the file in an array. Each element of the array corresponds to a line in the file, with the
 *                     newline still attached. Upon failure, file returns false. Each line in the resulting array will
 *                     include the line ending, unless FILE_IGNORE_NEW_LINES is used, so you still need to use rtrim if
 *                     you do not want the line ending present.
 * @since 4.0
 * @since 5.0
 */
function file($filename, $flags = null, $context = null) { }

/**
 * Checks whether a file or directory exists
 *
 * @link  http://php.net/manual/en/function.file-exists.php
 *
 * @param string $filename <p>
 *                         Path to the file or directory.
 *                         </p>
 *                         <p>
 *                         On windows, use //computername/share/filename or
 *                         \\computername\share\filename to check files on
 *                         network shares.
 *                         </p>
 *
 * @return bool true if the file or directory specified by
 * filename exists; false otherwise.
 * </p>
 * <p>
 * This function will return false for symlinks pointing to non-existing
 * files.
 * </p>
 * <p>
 * This function returns false for files inaccessible due to safe mode restrictions. However these
 * files still can be included if
 * they are located in safe_mode_include_dir.
 * </p>
 * <p>
 * The check is done using the real UID/GID instead of the effective one.
 * @since 4.0
 * @since 5.0
 */
function file_exists($filename) { }

/**
 * Reads entire file into a string
 *
 * @link  http://php.net/manual/en/function.file-get-contents.php
 *
 * @param string   $filename         <p>
 *                                   Name of the file to read.
 *                                   </p>
 * @param bool     $use_include_path [optional] <p>
 *                                   Note: As of PHP 5 the FILE_USE_INCLUDE_PATH constant can be
 *                                   used to trigger include path search.
 *                                   </p>
 * @param resource $context          [optional] <p>
 *                                   A valid context resource created with
 *                                   stream_context_create. If you don't need to use a
 *                                   custom context, you can skip this parameter by &null;.
 *                                   </p>
 * @param int      $offset           [optional] <p>
 *                                   The offset where the reading starts.
 *                                   </p>
 * @param int      $maxlen           [optional] <p>
 *                                   Maximum length of data read. The default is to read until end
 *                                   of file is reached.
 *                                   </p>
 *
 * @return string|false The function returns the read data or false on failure.
 * @since 4.3.0
 * @since 5.0
 */
function file_get_contents($filename, $use_include_path = false, $context = null, $offset = 0, $maxlen = null) { }

/**
 * Write a string to a file
 *
 * @link  http://php.net/manual/en/function.file-put-contents.php
 *
 * @param string   $filename <p>
 *                           Path to the file where to write the data.
 *                           </p>
 * @param mixed    $data     <p>
 *                           The data to write. Can be either a string, an
 *                           array or a stream resource.
 *                           </p>
 *                           <p>
 *                           If data is a stream resource, the
 *                           remaining buffer of that stream will be copied to the specified file.
 *                           This is similar with using stream_copy_to_stream.
 *                           </p>
 *                           <p>
 *                           You can also specify the data parameter as a single
 *                           dimension array. This is equivalent to
 *                           file_put_contents($filename, implode('', $array)).
 *                           </p>
 * @param int      $flags    [optional] <p>
 *                           The value of flags can be any combination of
 *                           the following flags (with some restrictions), joined with the binary OR
 *                           (|) operator.
 *                           </p>
 *                           <p>
 *                           <table>
 *                           Available flags
 *                           <tr valign="top">
 *                           <td>Flag</td>
 *                           <td>Description</td>
 *                           </tr>
 *                           <tr valign="top">
 *                           <td>
 *                           FILE_USE_INCLUDE_PATH
 *                           </td>
 *                           <td>
 *                           Search for filename in the include directory.
 *                           See include_path for more
 *                           information.
 *                           </td>
 *                           </tr>
 *                           <tr valign="top">
 *                           <td>
 *                           FILE_APPEND
 *                           </td>
 *                           <td>
 *                           If file filename already exists, append
 *                           the data to the file instead of overwriting it. Mutually
 *                           exclusive with LOCK_EX since appends are atomic and thus there
 *                           is no reason to lock.
 *                           </td>
 *                           </tr>
 *                           <tr valign="top">
 *                           <td>
 *                           LOCK_EX
 *                           </td>
 *                           <td>
 *                           Acquire an exclusive lock on the file while proceeding to the
 *                           writing. Mutually exclusive with FILE_APPEND.
 *                           </td>
 *                           </tr>
 *                           </table>
 *                           </p>
 *
 * @param resource $context  [optional] <p>
 *                           A valid context resource created with
 *                           stream_context_create.
 *                           </p>
 *
 * @return int|false The function returns the number of bytes that were written to the file, or false on failure.
 * @since 5.0
 */
function file_put_contents($filename, $data, $flags = 0, $context = null) { }

/**
 * Gets last access time of file
 *
 * @link  http://php.net/manual/en/function.fileatime.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return int|false the time the file was last accessed, or false on failure.
 * The time is returned as a Unix timestamp.
 * @since 4.0
 * @since 5.0
 */
function fileatime($filename) { }

/**
 * Gets inode change time of file
 *
 * @link  http://php.net/manual/en/function.filectime.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return int|false the time the file was last changed, or false on failure. The time is returned as a Unix timestamp.
 * @since 4.0
 * @since 5.0
 */
function filectime($filename) { }

/**
 * Gets file group
 *
 * @link  http://php.net/manual/en/function.filegroup.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return int|false the group ID of the file, or false in case of an error. The group ID is returned in numerical
 *                   format, use posix_getgrgid to resolve it to a group name. Upon failure, false is returned.
 * @since 4.0
 * @since 5.0
 */
function filegroup($filename) { }

/**
 * Gets file inode
 *
 * @link  http://php.net/manual/en/function.fileinode.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return int|false the inode number of the file, or false on failure.
 * @since 4.0
 * @since 5.0
 */
function fileinode($filename) { }

/**
 * Gets file modification time
 *
 * @link  http://php.net/manual/en/function.filemtime.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return int|false the time the file was last modified, or false on failure. The time is returned as a Unix
 *                   timestamp, which is suitable for the date function.
 * @since 4.0
 * @since 5.0
 */
function filemtime($filename) { }

/**
 * Gets file owner
 *
 * @link  http://php.net/manual/en/function.fileowner.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return int|false the user ID of the owner of the file, or false on failure. The user ID is returned in numerical
 *                   format, use posix_getpwuid to resolve it to a username.
 * @since 4.0
 * @since 5.0
 */
function fileowner($filename) { }

/**
 * Gets file permissions
 *
 * @link  http://php.net/manual/en/function.fileperms.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return int|false the permissions on the file, or false on failure.
 * @since 4.0
 * @since 5.0
 */
function fileperms($filename) { }

/**
 * Gets file size
 *
 * @link  http://php.net/manual/en/function.filesize.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return int|false the size of the file in bytes, or false (and generates an error of level E_WARNING) in case of an
 *                   error.
 * @since 4.0
 * @since 5.0
 */
function filesize($filename) { }

/**
 * Gets file type
 *
 * @link  http://php.net/manual/en/function.filetype.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return string|false the type of the file. Possible values are fifo, char, dir, block, link, file, socket and
 *                      unknown. Returns false if an error occurs. filetype will also produce an E_NOTICE message if
 *                      the stat call fails or if the file type is unknown.
 * @since 4.0
 * @since 5.0
 */
function filetype($filename) { }

/**
 * Portable advisory file locking
 *
 * @link  http://php.net/manual/en/function.flock.php
 *
 * @param resource $handle     <p>
 *                             An open file pointer.
 *                             </p>
 * @param int      $operation  <p>
 *                             operation is one of the following:
 *                             LOCK_SH to acquire a shared lock (reader).
 * @param int      $wouldblock [optional] <p>
 *                             The optional third argument is set to true if the lock would block
 *                             (EWOULDBLOCK errno condition).
 *                             </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function flock($handle, $operation, &$wouldblock = null) { }

/**
 * Match filename against a pattern
 *
 * @link  http://php.net/manual/en/function.fnmatch.php
 *
 * @param string $pattern <p>
 *                        The shell wildcard pattern.
 *                        </p>
 * @param string $string  <p>
 *                        The tested string. This function is especially useful for filenames,
 *                        but may also be used on regular strings.
 *                        </p>
 *                        <p>
 *                        The average user may be used to shell patterns or at least in their
 *                        simplest form to '?' and '*'
 *                        wildcards so using fnmatch instead of
 *                        preg_match for
 *                        frontend search expression input may be way more convenient for
 *                        non-programming users.
 *                        </p>
 * @param int    $flags   [optional] <p>
 *                        The value of flags can be any combination of
 *                        the following flags, joined with the
 *                        binary OR (|) operator.
 *                        <table>
 *                        A list of possible flags for fnmatch
 *                        <tr valign="top">
 *                        <td>Flag</td>
 *                        <td>Description</td>
 *                        </tr>
 *                        <tr valign="top">
 *                        <td>FNM_NOESCAPE</td>
 *                        <td>
 *                        Disable backslash escaping.
 *                        </td>
 *                        </tr>
 *                        <tr valign="top">
 *                        <td>FNM_PATHNAME</td>
 *                        <td>
 *                        Slash in string only matches slash in the given pattern.
 *                        </td>
 *                        </tr>
 *                        <tr valign="top">
 *                        <td>FNM_PERIOD</td>
 *                        <td>
 *                        Leading period in string must be exactly matched by period in the given pattern.
 *                        </td>
 *                        </tr>
 *                        <tr valign="top">
 *                        <td>FNM_CASEFOLD</td>
 *                        <td>
 *                        Caseless match. Part of the GNU extension.
 *                        </td>
 *                        </tr>
 *                        </table>
 *                        </p>
 *
 * @return bool true if there is a match, false otherwise.
 * @since 4.3.0
 * @since 5.0
 */
function fnmatch($pattern, $string, $flags = null) { }

/**
 * Opens file or URL
 *
 * @link  http://php.net/manual/en/function.fopen.php
 *
 * @param string   $filename         <p>
 *                                   If filename is of the form "scheme://...", it
 *                                   is assumed to be a URL and PHP will search for a protocol handler
 *                                   (also known as a wrapper) for that scheme. If no wrappers for that
 *                                   protocol are registered, PHP will emit a notice to help you track
 *                                   potential problems in your script and then continue as though
 *                                   filename specifies a regular file.
 *                                   </p>
 *                                   <p>
 *                                   If PHP has decided that filename specifies
 *                                   a local file, then it will try to open a stream on that file.
 *                                   The file must be accessible to PHP, so you need to ensure that
 *                                   the file access permissions allow this access.
 *                                   If you have enabled &safemode;,
 *                                   or open_basedir further
 *                                   restrictions may apply.
 *                                   </p>
 *                                   <p>
 *                                   If PHP has decided that filename specifies
 *                                   a registered protocol, and that protocol is registered as a
 *                                   network URL, PHP will check to make sure that
 *                                   allow_url_fopen is
 *                                   enabled. If it is switched off, PHP will emit a warning and
 *                                   the fopen call will fail.
 *                                   </p>
 *                                   <p>
 *                                   The list of supported protocols can be found in . Some protocols (also
 *                                   referred to as wrappers) support context and/or &php.ini; options. Refer to
 *                                   the specific page for the protocol in use for a list of options which can be
 *                                   set. (e.g.
 *                                   &php.ini; value user_agent used by the
 *                                   http wrapper).
 *                                   </p>
 *                                   <p>
 *                                   On the Windows platform, be careful to escape any backslashes
 *                                   used in the path to the file, or use forward slashes.
 *                                   ]]>
 *                                   </p>
 * @param string   $mode             <p>
 *                                   The mode parameter specifies the type of access
 *                                   you require to the stream. It may be any of the following:
 *                                   <table>
 *                                   A list of possible modes for fopen
 *                                   using mode
 *                                   <tr valign="top">
 *                                   <td>mode</td>
 *                                   <td>Description</td>
 *                                   </tr>
 *                                   <tr valign="top">
 *                                   <td>'r'</td>
 *                                   <td>
 *                                   Open for reading only; place the file pointer at the
 *                                   beginning of the file.
 *                                   </td>
 *                                   </tr>
 *                                   <tr valign="top">
 *                                   <td>'r+'</td>
 *                                   <td>
 *                                   Open for reading and writing; place the file pointer at
 *                                   the beginning of the file.
 *                                   </td>
 *                                   </tr>
 *                                   <tr valign="top">
 *                                   <td>'w'</td>
 *                                   <td>
 *                                   Open for writing only; place the file pointer at the
 *                                   beginning of the file and truncate the file to zero length.
 *                                   If the file does not exist, attempt to create it.
 *                                   </td>
 *                                   </tr>
 *                                   <tr valign="top">
 *                                   <td>'w+'</td>
 *                                   <td>
 *                                   Open for reading and writing; place the file pointer at
 *                                   the beginning of the file and truncate the file to zero
 *                                   length. If the file does not exist, attempt to create it.
 *                                   </td>
 *                                   </tr>
 *                                   <tr valign="top">
 *                                   <td>'a'</td>
 *                                   <td>
 *                                   Open for writing only; place the file pointer at the end of
 *                                   the file. If the file does not exist, attempt to create it.
 *                                   </td>
 *                                   </tr>
 *                                   <tr valign="top">
 *                                   <td>'a+'</td>
 *                                   <td>
 *                                   Open for reading and writing; place the file pointer at
 *                                   the end of the file. If the file does not exist, attempt to
 *                                   create it.
 *                                   </td>
 *                                   </tr>
 *                                   <tr valign="top">
 *                                   <td>'x'</td>
 *                                   <td>
 *                                   Create and open for writing only; place the file pointer at the
 *                                   beginning of the file. If the file already exists, the
 *                                   fopen call will fail by returning false and
 *                                   generating an error of level E_WARNING. If
 *                                   the file does not exist, attempt to create it. This is equivalent
 *                                   to specifying O_EXCL|O_CREAT flags for the
 *                                   underlying open(2) system call.
 *                                   </td>
 *                                   </tr>
 *                                   <tr valign="top">
 *                                   <td>'x+'</td>
 *                                   <td>
 *                                   Create and open for reading and writing; place the file pointer at
 *                                   the beginning of the file. If the file already exists, the
 *                                   fopen call will fail by returning false and
 *                                   generating an error of level E_WARNING. If
 *                                   the file does not exist, attempt to create it. This is equivalent
 *                                   to specifying O_EXCL|O_CREAT flags for the
 *                                   underlying open(2) system call.
 *                                   </td>
 *                                   </tr>
 *                                   </table>
 *                                   </p>
 *                                   <p>
 *                                   Different operating system families have different line-ending
 *                                   conventions. When you write a text file and want to insert a line
 *                                   break, you need to use the correct line-ending character(s) for your
 *                                   operating system. Unix based systems use \n as the
 *                                   line ending character, Windows based systems use \r\n
 *                                   as the line ending characters and Macintosh based systems use
 *                                   \r as the line ending character.
 *                                   </p>
 *                                   <p>
 *                                   If you use the wrong line ending characters when writing your files, you
 *                                   might find that other applications that open those files will "look
 *                                   funny".
 *                                   </p>
 *                                   <p>
 *                                   Windows offers a text-mode translation flag ('t')
 *                                   which will transparently translate \n to
 *                                   \r\n when working with the file. In contrast, you
 *                                   can also use 'b' to force binary mode, which will not
 *                                   translate your data. To use these flags, specify either
 *                                   'b' or 't' as the last character
 *                                   of the mode parameter.
 *                                   </p>
 *                                   <p>
 *                                   The default translation mode depends on the SAPI and version of PHP that
 *                                   you are using, so you are encouraged to always specify the appropriate
 *                                   flag for portability reasons. You should use the 't'
 *                                   mode if you are working with plain-text files and you use
 *                                   \n to delimit your line endings in your script, but
 *                                   expect your files to be readable with applications such as notepad. You
 *                                   should use the 'b' in all other cases.
 *                                   </p>
 *                                   <p>
 *                                   If you do not specify the 'b' flag when working with binary files, you
 *                                   may experience strange problems with your data, including broken image
 *                                   files and strange problems with \r\n characters.
 *                                   </p>
 *                                   <p>
 *                                   For portability, it is strongly recommended that you always
 *                                   use the 'b' flag when opening files with fopen.
 *                                   </p>
 *                                   <p>
 *                                   Again, for portability, it is also strongly recommended that
 *                                   you re-write code that uses or relies upon the 't'
 *                                   mode so that it uses the correct line endings and
 *                                   'b' mode instead.
 *                                   </p>
 * @param bool     $use_include_path [optional] <p>
 *                                   The optional third use_include_path parameter
 *                                   can be set to '1' or true if you want to search for the file in the
 *                                   include_path, too.
 *                                   </p>
 * @param resource $context          [optional] &note.context-support;
 *
 * @return resource|false a file pointer resource on success, or false on error.
 * @since 4.0
 * @since 5.0
 */
function fopen($filename, $mode, $use_include_path = null, $context = null) { }

/**
 * Output all remaining data on a file pointer
 *
 * @link  http://php.net/manual/en/function.fpassthru.php
 *
 * @param resource $handle The file pointer must be valid, and must point to a file successfully opened by fopen()
 *                         or fsockopen() (and not yet closed by fclose()).
 *
 * @return int|false If an error occurs, fpassthru returns false. Otherwise, fpassthru returns the number of characters
 *                   read from handle and passed through to the output.
 * @since 4.0
 * @since 5.0
 */
function fpassthru($handle) { }

/**
 * Format line as CSV and write to file pointer
 *
 * @link  http://php.net/manual/en/function.fputcsv.php
 *
 * @param resource $handle      The file pointer must be valid, and must point to a file successfully opened by
 *                              fopen() or fsockopen() (and not yet closed by fclose()).
 * @param array    $fields      <p>
 *                              An array of values.
 *                              </p>
 * @param string   $delimiter   [optional] <p>
 *                              The optional delimiter parameter sets the field
 *                              delimiter (one character only).
 *                              </p>
 * @param string   $enclosure   [optional] <p>
 *                              The optional enclosure parameter sets the field
 *                              enclosure (one character only).
 *                              </p>
 * @param string   $escape_char The optional escape_char parameter sets the escape character (one character only).
 *
 * @return int|false the length of the written string or false on failure.
 * @since 5.1.0
 */
function fputcsv($handle, array $fields, $delimiter = ',', $enclosure = '"', $escape_char = "\\") { }

/**
 * &Alias; <function>fwrite</function>
 *
 * @see   fwrite()
 * @link  http://php.net/manual/en/function.fputs.php
 * Binary-safe file write
 *
 * @param resource $handle A file system pointer resource that is typically created using fopen().
 * @param string   $string <p>
 *                         The string that is to be written.
 *                         </p>
 * @param int      $length [optional] <p>
 *                         If the length argument is given, writing will
 *                         stop after length bytes have been written or
 *                         the end of string is reached, whichever comes
 *                         first.
 *                         </p>
 *                         <p>
 *                         Note that if the length argument is given,
 *                         then the magic_quotes_runtime
 *                         configuration option will be ignored and no slashes will be
 *                         stripped from string.
 *                         </p>
 *
 * @return int
 * @since 4.0
 * @since 5.0
 */
function fputs($handle, $string, $length) { }

/**
 * Binary-safe file read
 *
 * @link  http://php.net/manual/en/function.fread.php
 *
 * @param resource $handle &fs.file.pointer;
 * @param int      $length <p>
 *                         Up to length number of bytes read.
 *                         </p>
 *
 * @return string|false the read string or false on failure.
 * @since 4.0
 * @since 5.0
 */
function fread($handle, $length) { }

/**
 * Parses input from a file according to a format
 *
 * @link  http://php.net/manual/en/function.fscanf.php
 *
 * @param resource $handle &fs.file.pointer;
 * @param string   $format <p>
 *                         The specified format as described in the
 *                         sprintf documentation.
 *                         </p>
 * @param mixed    $_      [optional]
 *
 * @return mixed If only two parameters were passed to this function, the values parsed will be
 * returned as an array. Otherwise, if optional parameters are passed, the
 * function will return the number of assigned values. The optional
 * parameters must be passed by reference.
 * @since 4.0.1
 * @since 5.0
 */
function fscanf($handle, $format, &$_ = null) { }

/**
 * Seeks on a file pointer
 *
 * @link  http://php.net/manual/en/function.fseek.php
 *
 * @param resource $handle &fs.file.pointer;
 * @param int      $offset <p>
 *                         The offset.
 *                         </p>
 *                         <p>
 *                         To move to a position before the end-of-file, you need to pass
 *                         a negative value in offset and
 *                         set whence
 *                         to SEEK_END.
 *                         </p>
 * @param int      $whence [optional] <p>
 *                         whence values are:
 *                         SEEK_SET - Set position equal to offset bytes.
 *                         SEEK_CUR - Set position to current location plus offset.
 *                         SEEK_END - Set position to end-of-file plus offset.
 *                         </p>
 *                         <p>
 *                         If whence is not specified, it is assumed to be
 *                         SEEK_SET.
 *                         </p>
 *
 * @return int Upon success, returns 0; otherwise, returns -1. Note that seeking
 * past EOF is not considered an error.
 * @since 4.0
 * @since 5.0
 */
function fseek($handle, $offset, $whence = SEEK_SET) { }

/**
 * Gets information about a file using an open file pointer
 *
 * @link  http://php.net/manual/en/function.fstat.php
 *
 * @param resource $handle &fs.file.pointer;
 *
 * @return array an array with the statistics of the file; the format of the array is described in detail on the stat
 *               manual page.
 * @since 4.0
 * @since 5.0
 */
function fstat($handle) { }

/**
 * Returns the current position of the file read/write pointer
 *
 * @link  http://php.net/manual/en/function.ftell.php
 *
 * @param resource $handle <p>
 *                         The file pointer must be valid, and must point to a file successfully
 *                         opened by fopen or popen.
 *                         ftell gives undefined results for append-only streams
 *                         (opened with "a" flag).
 *                         </p>
 *
 * @return int|false the position of the file pointer referenced by handle as an integer; i.e., its offset into the
 *                   file stream. If an error occurs, returns false.
 * @since 4.0
 * @since 5.0
 */
function ftell($handle) { }

/**
 * Truncates a file to a given length
 *
 * @link  http://php.net/manual/en/function.ftruncate.php
 *
 * @param resource $handle <p>
 *                         The file pointer.
 *                         </p>
 *                         <p>
 *                         The handle must be open for writing.
 *                         </p>
 * @param int      $size   <p>
 *                         The size to truncate to.
 *                         </p>
 *                         <p>
 *                         If size is larger than the file it is extended
 *                         with null bytes.
 *                         </p>
 *                         <p>
 *                         If size is smaller than the extra data
 *                         will be lost.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ftruncate($handle, $size) { }

/**
 * Binary-safe file write
 *
 * @link  http://php.net/manual/en/function.fwrite.php
 *
 * @param resource $handle &fs.file.pointer;
 * @param string   $string <p>
 *                         The string that is to be written.
 *                         </p>
 * @param int      $length [optional] <p>
 *                         If the length argument is given, writing will
 *                         stop after length bytes have been written or
 *                         the end of string is reached, whichever comes
 *                         first.
 *                         </p>
 *                         <p>
 *                         Note that if the length argument is given,
 *                         then the magic_quotes_runtime
 *                         configuration option will be ignored and no slashes will be
 *                         stripped from string.
 *                         </p>
 *
 * @return int
 * @since 4.0
 * @since 5.0
 */
function fwrite($handle, $string, $length = null) { }

/**
 * Find pathnames matching a pattern
 *
 * @link  http://php.net/manual/en/function.glob.php
 *
 * @param string $pattern <p>
 *                        The pattern. No tilde expansion or parameter substitution is done.
 *                        </p>
 * @param int    $flags   [optional] <p>
 *                        Valid flags:
 *                        GLOB_MARK - Adds a slash to each directory returned
 *                        GLOB_NOSORT - Return files as they appear in the directory (no sorting). When this flag
 *                        is not used, the pathnames are sorted alphabetically GLOB_NOCHECK - Return the search
 *                        pattern if no files matching it were found GLOB_NOESCAPE - Backslashes do not quote
 *                        metacharacters GLOB_BRACE - Expands {a,b,c} to match 'a', 'b', or 'c' GLOB_ONLYDIR -
 *                        Return only directory entries which match the pattern GLOB_ERR - Stop on read errors
 *                        (like unreadable directories), by default errors are ignored.
 *
 * @return array|false an array containing the matched files/directories, an empty array if no file matched or false on
 *                     error. On some systems it is impossible to distinguish between empty match and an error.
 * @since 4.3.0
 * @since 5.0
 */
function glob($pattern, $flags = null) { }

/**
 * Tells whether the filename is a directory
 *
 * @link  http://php.net/manual/en/function.is-dir.php
 *
 * @param string $filename <p>
 *                         Path to the file. If filename is a relative
 *                         filename, it will be checked relative to the current working
 *                         directory. If filename is a symbolic or hard link
 *                         then the link will be resolved and checked.
 *                         </p>
 *
 * @return bool true if the filename exists and is a directory, false
 * otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_dir($filename) { }

/**
 * Tells whether the filename is executable
 *
 * @link  http://php.net/manual/en/function.is-executable.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return bool true if the filename exists and is executable, or false on
 * error.
 * @since 4.0
 * @since 5.0
 */
function is_executable($filename) { }

/**
 * Tells whether the filename is a regular file
 *
 * @link  http://php.net/manual/en/function.is-file.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return bool true if the filename exists and is a regular file, false
 * otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_file($filename) { }

/**
 * Tells whether the filename is a symbolic link
 *
 * @link  http://php.net/manual/en/function.is-link.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return bool true if the filename exists and is a symbolic link, false
 * otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_link($filename) { }

/**
 * Tells whether a file exists and is readable
 *
 * @link  http://php.net/manual/en/function.is-readable.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return bool true if the file or directory specified by
 * filename exists and is readable, false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_readable($filename) { }

/**
 * Tells whether the file was uploaded via HTTP POST
 *
 * @link  http://php.net/manual/en/function.is-uploaded-file.php
 *
 * @param string $filename <p>
 *                         The filename being checked.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0.3
 * @since 5.0
 */
function is_uploaded_file($filename) { }

/**
 * Tells whether the filename is writable
 *
 * @link  http://php.net/manual/en/function.is-writable.php
 *
 * @param string $filename <p>
 *                         The filename being checked.
 *                         </p>
 *
 * @return bool true if the filename exists and is
 * writable.
 * @since 4.0
 * @since 5.0
 */
function is_writable($filename) { }

/**
 * &Alias; <function>is_writable</function>
 *
 * @link  http://php.net/manual/en/function.is-writeable.php
 *
 * @param string $filename <p>
 *                         The filename being checked.
 *                         </p>
 *
 * @return bool true if the filename exists and is
 * writable.
 * @since 4.0
 * @since 5.0
 */
function is_writeable($filename) { }

/**
 * Changes group ownership of symlink
 *
 * @link  http://php.net/manual/en/function.lchgrp.php
 *
 * @param string $filename <p>
 *                         Path to the symlink.
 *                         </p>
 * @param mixed  $group    <p>
 *                         The group specified by name or number.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.1.2
 */
function lchgrp($filename, $group) { }

/**
 * Changes user ownership of symlink
 *
 * @link  http://php.net/manual/en/function.lchown.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 * @param mixed  $user     <p>
 *                         User name or number.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.1.2
 */
function lchown($filename, $user) { }

/**
 * Create a hard link
 *
 * @link  http://php.net/manual/en/function.link.php
 *
 * @param string $target Target of the link.
 * @param string $link   The link name.
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function link($target, $link) { }

/**
 * Gets information about a link
 *
 * @link  http://php.net/manual/en/function.linkinfo.php
 *
 * @param string $path <p>
 *                     Path to the link.
 *                     </p>
 *
 * @return int|false linkinfo returns the st_dev field of the Unix C stat structure returned by the lstat system call.
 *                   Returns 0 or false in case of error.
 * @since 4.0
 * @since 5.0
 */
function linkinfo($path) { }

/**
 * Gives information about a file or symbolic link
 *
 * @link  http://php.net/manual/en/function.lstat.php
 *
 * @param string $filename <p>
 *                         Path to a file or a symbolic link.
 *                         </p>
 *
 * @return array See the manual page for stat for information on the structure of the array that lstat returns. This
 *               function is identical to the stat function except that if the filename parameter is a symbolic link,
 *               the status of the symbolic link is returned, not the status of the file pointed to by the symbolic
 *               link.
 * @since 4.0
 * @since 5.0
 */
function lstat($filename) { }

/**
 * Attempts to create the directory specified by pathname.
 *
 * @link  http://php.net/manual/en/function.mkdir.php
 *
 * @param string   $pathname  <p>
 *                            The directory path.
 *                            </p>
 * @param int      $mode      [optional] <p>
 *                            The mode is 0777 by default, which means the widest possible
 *                            access. For more information on modes, read the details
 *                            on the chmod page.
 *                            </p>
 *                            <p>
 *                            mode is ignored on Windows.
 *                            </p>
 *                            <p>
 *                            Note that you probably want to specify the mode as an octal number,
 *                            which means it should have a leading zero. The mode is also modified
 *                            by the current umask, which you can change using
 *                            umask().
 *                            </p>
 * @param bool     $recursive [optional] <p>
 *                            Allows the creation of nested directories specified in the pathname. Default to false.
 *                            </p>
 * @param resource $context   [optional] &note.context-support;
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function mkdir($pathname, $mode = 0777, $recursive = false, $context = null) { }

/**
 * Moves an uploaded file to a new location
 *
 * @link  http://php.net/manual/en/function.move-uploaded-file.php
 *
 * @param string $filename    <p>
 *                            The filename of the uploaded file.
 *                            </p>
 * @param string $destination <p>
 *                            The destination of the moved file.
 *                            </p>
 *
 * @return bool If filename is not a valid upload file, then no action will occur, and move_uploaded_file will return
 *              false. If filename is a valid upload file, but cannot be moved for some reason, no action will occur,
 *              and move_uploaded_file will return false. Additionally, a warning will be issued.
 * @since 4.0.3
 * @since 5.0
 */
function move_uploaded_file($filename, $destination) { }

/**
 * Parse a configuration file
 *
 * @link  http://php.net/manual/en/function.parse-ini-file.php
 *
 * @param string $filename         <p>
 *                                 The filename of the ini file being parsed.
 *                                 </p>
 * @param bool   $process_sections [optional] <p>
 *                                 By setting the process_sections
 *                                 parameter to true, you get a multidimensional array, with
 *                                 the section names and settings included. The default
 *                                 for process_sections is false
 *                                 </p>
 * @param int    $scanner_mode     [optional] <p>
 *                                 Can either be INI_SCANNER_NORMAL (default) or
 *                                 INI_SCANNER_RAW. If INI_SCANNER_RAW
 *                                 is supplied, then option values will not be parsed.
 *                                 </p>
 *                                 <p>
 *                                 As of PHP 5.6.1 can also be specified as
 *                                 <strong><code>INI_SCANNER_TYPED</code></strong>. In this mode boolean, null and
 *                                 integer types are preserved when possible. String values <em>"true"</em>,
 *                                 <em>"on"</em> and <em>"yes"</em> are converted to <b>TRUE</b>. <em>"false"</em>,
 *                                 <em>"off"</em>, <em>"no"</em> and <em>"none"</em> are considered <b>FALSE</b>.
 *                                 <em>"null"</em> is converted to <b>NULL</b> in typed mode. Also, all numeric
 *                                 strings are converted to integer type if it is possible.
 *                                 </p>
 *
 * @return array|false The settings are returned as an associative array on success, and false on failure.
 * @since 4.0
 * @since 5.0
 */
function parse_ini_file($filename, $process_sections = null, $scanner_mode = null) { }

/**
 * Parse a configuration string
 *
 * @link  http://php.net/manual/en/function.parse-ini-string.php
 *
 * @param string $ini              <p>
 *                                 The contents of the ini file being parsed.
 *                                 </p>
 * @param bool   $process_sections [optional] <p>
 *                                 By setting the process_sections
 *                                 parameter to true, you get a multidimensional array, with
 *                                 the section names and settings included. The default
 *                                 for process_sections is false
 *                                 </p>
 * @param int    $scanner_mode     [optional] <p>
 *                                 Can either be INI_SCANNER_NORMAL (default) or
 *                                 INI_SCANNER_RAW. If INI_SCANNER_RAW
 *                                 is supplied, then option values will not be parsed.
 *                                 </p>
 *
 * @return array|false The settings are returned as an associative array on success, and false on failure.
 * @since 5.3.0
 */
function parse_ini_string($ini, $process_sections = null, $scanner_mode = null) { }

/**
 * Returns information about a file path
 *
 * @link  http://php.net/manual/en/function.pathinfo.php
 *
 * @param string $path    <p>
 *                        The path being checked.
 *                        </p>
 * @param int    $options [optional] <p>
 *                        You can specify which elements are returned with optional parameter
 *                        options. It composes from
 *                        PATHINFO_DIRNAME,
 *                        PATHINFO_BASENAME,
 *                        PATHINFO_EXTENSION and
 *                        PATHINFO_FILENAME. It
 *                        defaults to return all elements.
 *                        </p>
 *
 * @return mixed The following associative array elements are returned: dirname, basename, extension (if any), and
 *               filename. If options is used, this function will return a string if not all elements are requested.
 * @since 4.0.3
 * @since 5.0
 */
function pathinfo($path, $options = null) { }

/**
 * Closes process file pointer
 *
 * @link  http://php.net/manual/en/function.pclose.php
 *
 * @param resource $handle <p>
 *                         The file pointer must be valid, and must have been returned by a
 *                         successful call to popen.
 *                         </p>
 *
 * @return int the termination status of the process that was run.
 * @since 4.0
 * @since 5.0
 */
function pclose($handle) { }

/**
 * Opens process file pointer
 *
 * @link  http://php.net/manual/en/function.popen.php
 *
 * @param string $command <p>
 *                        The command
 *                        </p>
 * @param string $mode    <p>
 *                        The mode
 *                        </p>
 *
 * @return resource|false a file pointer identical to that returned by fopen, except that it is unidirectional (may
 *                        only be used for reading or writing) and must be closed with pclose. This pointer may be used
 *                        with fgets, fgetss, and fwrite. If an error occurs, returns false.
 * @since 4.0
 * @since 5.0
 */
function popen($command, $mode) { }

/**
 * Outputs a file
 *
 * @link  http://php.net/manual/en/function.readfile.php
 *
 * @param string   $filename         <p>
 *                                   The filename being read.
 *                                   </p>
 * @param bool     $use_include_path [optional] <p>
 *                                   You can use the optional second parameter and set it to true, if
 *                                   you want to search for the file in the include_path, too.
 *                                   </p>
 * @param resource $context          [optional] <p>
 *                                   A context stream resource.
 *                                   </p>
 *
 * @return int|false the number of bytes read from the file. If an error occurs, false is returned and unless the
 *                   function was called as @readfile, an error message is printed.
 * @since 4.0
 * @since 5.0
 */
function readfile($filename, $use_include_path = null, $context = null) { }

/**
 * Returns the target of a symbolic link
 *
 * @link  http://php.net/manual/en/function.readlink.php
 *
 * @param string $path <p>
 *                     The symbolic link path.
 *                     </p>
 *
 * @return string|false the contents of the symbolic link path or false on error.
 * @since 4.0
 * @since 5.0
 */
function readlink($path) { }

/**
 * Returns canonicalized absolute pathname
 *
 * @link  http://php.net/manual/en/function.realpath.php
 *
 * @param string $path <p>
 *                     The path being checked.
 *                     </p>
 *
 * @return string|false the canonicalized absolute pathname on success. The resulting path will have no symbolic link,
 *                      '/./' or '/../' components. realpath returns false on failure, e.g. if the file does not exist.
 * @since 4.0
 * @since 5.0
 */
function realpath($path) { }

/**
 * Get the contents of the realpath cache.
 *
 * @link  http://php.net/manual/en/function.realpath-cache-get.php
 * @return array Returns an array of realpath cache entries. The keys are original path entries, and the values are
 *               arrays of data items, containing the resolved path, expiration date, and other options kept in the
 *               cache.
 * @since 5.3.2
 */
function realpath_cache_get() { }

/**
 * Get the amount of memory used by the realpath cache.
 *
 * @link  http://php.net/manual/en/function.realpath-cache-size.php
 * @return int Returns how much memory realpath cache is using.
 * @since 5.3.2
 */
function realpath_cache_size() { }

/**
 * Renames a file or directory
 *
 * @link  http://php.net/manual/en/function.rename.php
 *
 * @param string   $oldname <p>
 *                          </p>
 *                          <p>
 *                          The old name. The wrapper used in oldname
 *                          must match the wrapper used in
 *                          newname.
 *                          </p>
 * @param string   $newname <p>
 *                          The new name.
 *                          </p>
 * @param resource $context [optional] &note.context-support;
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function rename($oldname, $newname, $context = null) { }

/**
 * Rewind the position of a file pointer
 *
 * @link  http://php.net/manual/en/function.rewind.php
 *
 * @param resource $handle <p>
 *                         The file pointer must be valid, and must point to a file
 *                         successfully opened by fopen.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function rewind($handle) { }

/**
 * Removes directory
 *
 * @link  http://php.net/manual/en/function.rmdir.php
 *
 * @param string   $dirname <p>
 *                          Path to the directory.
 *                          </p>
 * @param resource $context [optional] &note.context-support;
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function rmdir($dirname, $context = null) { }

/**
 * &Alias; <function>stream_set_write_buffer</function>
 * <p>Sets the buffering for write operations on the given stream to buffer bytes.
 * Output using fwrite() is normally buffered at 8K.
 * This means that if there are two processes wanting to write to the same output stream (a file),
 * each is paused after 8K of data to allow the other to write.
 *
 * @link  http://php.net/manual/en/function.set-file-buffer.php
 *
 * @param resource $fp     The file pointer.
 * @param int      $buffer The number of bytes to buffer. If buffer is 0 then write operations are unbuffered.
 *                         This ensures that all writes with fwrite() are completed before other processes are
 *                         allowed to write to that output stream.
 *
 * @return int
 * @since 4.0
 * @since 5.0
 */
function set_file_buffer($fp, $buffer) { }

/**
 * Gives information about a file
 *
 * @link  http://php.net/manual/en/function.stat.php
 *
 * @param string $filename <p>
 *                         Path to the file.
 *                         </p>
 *
 * @return array|false <table>
 * stat and fstat result
 * format
 * <tr valign="top">
 * <td>Numeric</td>
 * <td>Associative (since PHP 4.0.6)</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>0</td>
 * <td>dev</td>
 * <td>device number</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td>ino</td>
 * <td>inode number *</td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td>mode</td>
 * <td>inode protection mode</td>
 * </tr>
 * <tr valign="top">
 * <td>3</td>
 * <td>nlink</td>
 * <td>number of links</td>
 * </tr>
 * <tr valign="top">
 * <td>4</td>
 * <td>uid</td>
 * <td>userid of owner *</td>
 * </tr>
 * <tr valign="top">
 * <td>5</td>
 * <td>gid</td>
 * <td>groupid of owner *</td>
 * </tr>
 * <tr valign="top">
 * <td>6</td>
 * <td>rdev</td>
 * <td>device type, if inode device</td>
 * </tr>
 * <tr valign="top">
 * <td>7</td>
 * <td>size</td>
 * <td>size in bytes</td>
 * </tr>
 * <tr valign="top">
 * <td>8</td>
 * <td>atime</td>
 * <td>time of last access (Unix timestamp)</td>
 * </tr>
 * <tr valign="top">
 * <td>9</td>
 * <td>mtime</td>
 * <td>time of last modification (Unix timestamp)</td>
 * </tr>
 * <tr valign="top">
 * <td>10</td>
 * <td>ctime</td>
 * <td>time of last inode change (Unix timestamp)</td>
 * </tr>
 * <tr valign="top">
 * <td>11</td>
 * <td>blksize</td>
 * <td>blocksize of filesystem IO **</td>
 * </tr>
 * <tr valign="top">
 * <td>12</td>
 * <td>blocks</td>
 * <td>number of 512-byte blocks allocated **</td>
 * </tr>
 * </table>
 * * On Windows this will always be 0.
 * </p>
 * <p>
 * ** Only valid on systems supporting the st_blksize type - other
 * systems (e.g. Windows) return -1.
 * </p>
 * <p>
 * In case of error, stat returns false.
 * @since 4.0
 * @since 5.0
 */
function stat($filename) { }

/**
 * Creates a symbolic link
 *
 * @link  http://php.net/manual/en/function.symlink.php
 *
 * @param string $target <p>
 *                       Target of the link.
 *                       </p>
 * @param string $link   <p>
 *                       The link name.
 *                       </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function symlink($target, $link) { }

/**
 * Create file with unique file name
 *
 * @link  http://php.net/manual/en/function.tempnam.php
 *
 * @param string $dir    <p>
 *                       The directory where the temporary filename will be created.
 *                       </p>
 * @param string $prefix <p>
 *                       The prefix of the generated temporary filename.
 *                       </p>
 *                       Windows use only the first three characters of prefix.
 *
 * @return string|false the new temporary filename, or false on failure.
 * @since 4.0
 * @since 5.0
 */
function tempnam($dir, $prefix) { }

/**
 * Creates a temporary file
 *
 * @link  http://php.net/manual/en/function.tmpfile.php
 * @return resource|false a file handle, similar to the one returned by fopen, for the new file or false on failure.
 * @since 4.0
 * @since 5.0
 */
function tmpfile() { }

/**
 * Sets access and modification time of file
 *
 * @link  http://php.net/manual/en/function.touch.php
 *
 * @param string $filename <p>
 *                         The name of the file being touched.
 *                         </p>
 * @param int    $time     [optional] <p>
 *                         The touch time. If time is not supplied,
 *                         the current system time is used.
 *                         </p>
 * @param int    $atime    [optional] <p>
 *                         If present, the access time of the given filename is set to
 *                         the value of atime. Otherwise, it is set to
 *                         time.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function touch($filename, $time = null, $atime = null) { }

/**
 * Changes the current umask
 *
 * @link  http://php.net/manual/en/function.umask.php
 *
 * @param int $mask [optional] <p>
 *                  The new umask.
 *                  </p>
 *
 * @return int umask without arguments simply returns the current umask otherwise the old umask is returned.
 * @since 4.0
 * @since 5.0
 */
function umask($mask = null) { }

/**
 * Deletes a file
 *
 * @link  http://php.net/manual/en/function.unlink.php
 *
 * @param string   $filename <p>
 *                           Path to the file.
 *                           </p>
 * @param resource $context  [optional] &note.context-support;
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function unlink($filename, $context = null) { }
