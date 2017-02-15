<?php
/**
 * PHPStorm stub file for Zip classes.
 *
 * @link http://php.net/manual/en/book.zip.php
 */

/**
 * A file archive, compressed with Zip.
 *
 * @link http://php.net/manual/en/class.ziparchive.php
 */
class ZipArchive
{
    /**
     * Perform additional consistency checks on the archive, and error if they fail.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CHECKCONS = 4;
    /**
     * BZIP2 algorithm
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_BZIP2 = 12;
    /**
     * better of deflate or store.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_DEFAULT = -1;
    /**
     * deflated
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_DEFLATE = 8;
    /**
     * deflate64
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_DEFLATE64 = 9;
    /**
     * imploded
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_IMPLODE = 6;
    const CM_LZ77 = 19;
    const CM_LZMA = 14;
    /**
     * PKWARE imploding
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_PKWARE_IMPLODE = 10;
    const CM_PPMD = 98;
    /**
     * reduced with factor 1
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_REDUCE_1 = 2;
    /**
     * reduced with factor 2
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_REDUCE_2 = 3;
    /**
     * reduced with factor 3
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_REDUCE_3 = 4;
    /**
     * reduced with factor 4
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_REDUCE_4 = 5;
    /**
     * shrunk
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_SHRINK = 1;
    /**
     * stored (uncompressed).
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CM_STORE = 0;
    const CM_TERSE = 18;
    const CM_WAVPACK = 97;
    /**
     * Create the archive if it does not exist.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const CREATE = 1;
    /**
     * Entry has been changed
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_CHANGED = 15;
    /**
     * Closing zip archive failed
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_CLOSE = 3;
    /**
     * Compression method not supported.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_COMPNOTSUPP = 16;
    /**
     * CRC error
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_CRC = 7;
    /**
     * Entry has been deleted
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_DELETED = 23;
    /**
     * Premature EOF
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_EOF = 17;
    /**
     * File already exists
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_EXISTS = 10;
    /**
     * Zip archive inconsistent
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_INCONS = 21;
    /**
     * Internal error
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_INTERNAL = 20;
    /**
     * Invalid argument
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_INVAL = 18;
    /**
     * Memory allocation failure
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_MEMORY = 14;
    /**
     * Multi-disk zip archives not supported.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_MULTIDISK = 1;
    /**
     * No such file.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_NOENT = 9;
    /**
     * Not a zip archive
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_NOZIP = 19;
    /**
     * No error.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_OK = 0;
    /**
     * Can't open file
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_OPEN = 11;
    /**
     * Read error
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_READ = 5;
    /**
     * Can't remove file
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_REMOVE = 22;
    /**
     * Renaming temporary file failed.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_RENAME = 2;
    /**
     * Seek error
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_SEEK = 4;
    /**
     * Failure to create temporary file.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_TMPOPEN = 12;
    /**
     * Write error
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_WRITE = 6;
    /**
     * Containing zip archive was closed
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_ZIPCLOSED = 8;
    /**
     * Zlib error
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const ER_ZLIB = 13;
    /**
     * Error if archive already exists.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const EXCL = 2;
    /**
     * Read compressed data
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const FL_COMPRESSED = 4;
    /**
     * Ignore case on name lookup
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const FL_NOCASE = 1;
    /**
     * Ignore directory component
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const FL_NODIR = 2;
    /**
     * Use original data, ignoring changes.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const FL_UNCHANGED = 8;
    /**
     * Always start a new archive, this mode will overwrite the file if
     * it already exists.
     *
     * @link http://php.net/manual/en/zip.constants.php
     */
    const OVERWRITE = 8;
    /**
     * Comment for the archive
     */
    public $comment;
    /**
     * File name in the file system
     */
    public $filename;
    /**
     * Number of files in archive
     */
    public $numFiles;
    /**
     * Status of the Zip Archive
     */
    public $status;
    /**
     * System status of the Zip Archive
     */
    public $statusSys;

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.8.0)<br/>
     * Add a new directory
     *
     * @link http://php.net/manual/en/ziparchive.addemptydir.php
     *
     * @param string $dirname <p>
     *                        The directory to add.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function addEmptyDir($dirname) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Adds a file to a ZIP archive from the given path
     *
     * @link http://php.net/manual/en/ziparchive.addfile.php
     *
     * @param string $filename  <p>
     *                          The path to the file to add.
     *                          </p>
     * @param string $localname [optional] <p>
     *                          If supplied, this is the local name inside the ZIP archive that will override the
     *                          <i>filename</i>.
     *                          </p>
     * @param int    $start     [optional] <p>
     *                          This parameter is not used but is required to extend <b>ZipArchive</b>.
     *                          </p>
     * @param int    $length    [optional] <p>
     *                          This parameter is not used but is required to extend <b>ZipArchive</b>.
     *                          </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function addFile($filename, $localname = null, $start = 0, $length = 0) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Add a file to a ZIP archive using its contents
     *
     * @link http://php.net/manual/en/ziparchive.addfromstring.php
     *
     * @param string $localname <p>
     *                          The name of the entry to create.
     *                          </p>
     * @param string $contents  <p>
     *                          The contents to use to create the entry. It is used in a binary
     *                          safe mode.
     *                          </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function addFromString($localname, $contents) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL zip &gt;= 1.9.0)<br/>
     * Add files from a directory by glob pattern
     *
     * @link http://php.net/manual/en/ziparchive.addglob.php
     *
     * @param string $pattern <p>
     *                        A <b>glob</b> pattern against which files will be matched.
     *                        </p>
     * @param int    $flags   [optional] <p>
     *                        A bit mask of glob() flags.
     *                        </p>
     * @param array  $options [optional] <p>
     *                        An associative array of options. Available options are:
     *                        <p>
     *                        "add_path"
     *                        </p>
     *                        <p>
     *                        Prefix to prepend when translating to the local path of the file within
     *                        the archive. This is applied after any remove operations defined by the
     *                        "remove_path" or "remove_all_path"
     *                        options.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function addGlob($pattern, $flags = 0, array $options = []) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL zip &gt;= 1.9.0)<br/>
     * Add files from a directory by PCRE pattern
     *
     * @link http://php.net/manual/en/ziparchive.addpattern.php
     *
     * @param string $pattern <p>
     *                        A PCRE pattern against which files will be matched.
     *                        </p>
     * @param string $path    [optional] <p>
     *                        The directory that will be scanned. Defaults to the current working directory.
     *                        </p>
     * @param array  $options [optional] <p>
     *                        An associative array of options accepted by <b>ZipArchive::addGlob</b>.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function addPattern($pattern, $path = '.', array $options = []) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Close the active archive (opened or newly created)
     *
     * @link http://php.net/manual/en/ziparchive.close.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function close() { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
     * delete an entry in the archive using its index
     *
     * @link http://php.net/manual/en/ziparchive.deleteindex.php
     *
     * @param int $index <p>
     *                   Index of the entry to delete.
     *                   </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function deleteIndex($index) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
     * delete an entry in the archive using its name
     *
     * @link http://php.net/manual/en/ziparchive.deletename.php
     *
     * @param string $name <p>
     *                     Name of the entry to delete.
     *                     </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function deleteName($name) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Extract the archive contents
     *
     * @link http://php.net/manual/en/ziparchive.extractto.php
     *
     * @param string $destination <p>
     *                            Location where to extract the files.
     *                            </p>
     * @param mixed  $entries     [optional] <p>
     *                            The entries to extract. It accepts either a single entry name or
     *                            an array of names.
     *                            </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function extractTo($destination, $entries = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Returns the Zip archive comment
     *
     * @link http://php.net/manual/en/ziparchive.getarchivecomment.php
     *
     * @param int $flags [optional] <p>
     *                   If flags is set to <b>ZipArchive::FL_UNCHANGED</b>, the original unchanged
     *                   comment is returned.
     *                   </p>
     *
     * @return string the Zip archive comment or <b>FALSE</b> on failure.
     */
    public function getArchiveComment($flags = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
     * Returns the comment of an entry using the entry index
     *
     * @link http://php.net/manual/en/ziparchive.getcommentindex.php
     *
     * @param int $index <p>
     *                   Index of the entry
     *                   </p>
     * @param int $flags [optional] <p>
     *                   If flags is set to <b>ZipArchive::FL_UNCHANGED</b>, the original unchanged
     *                   comment is returned.
     *                   </p>
     *
     * @return string the comment on success or <b>FALSE</b> on failure.
     */
    public function getCommentIndex($index, $flags = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
     * Returns the comment of an entry using the entry name
     *
     * @link http://php.net/manual/en/ziparchive.getcommentname.php
     *
     * @param string $name  <p>
     *                      Name of the entry
     *                      </p>
     * @param int    $flags [optional] <p>
     *                      If flags is set to <b>ZipArchive::FL_UNCHANGED</b>, the original unchanged
     *                      comment is returned.
     *                      </p>
     *
     * @return string the comment on success or <b>FALSE</b> on failure.
     */
    public function getCommentName($name, $flags = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.3.0)<br/>
     * Returns the entry contents using its index
     *
     * @link http://php.net/manual/en/ziparchive.getfromindex.php
     *
     * @param int $index  <p>
     *                    Index of the entry
     *                    </p>
     * @param int $length [optional] <p>
     *                    The length to be read from the entry. If 0, then the
     *                    entire entry is read.
     *                    </p>
     * @param int $flags  [optional] <p>
     *                    The flags to use to open the archive. the following values may
     *                    be ORed to it.
     *                    <p>
     *                    <b>ZipArchive::FL_UNCHANGED</b>
     *                    </p>
     *
     * @return string the contents of the entry on success or <b>FALSE</b> on failure.
     */
    public function getFromIndex($index, $length = 0, $flags = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Returns the entry contents using its name
     *
     * @link http://php.net/manual/en/ziparchive.getfromname.php
     *
     * @param string $name   <p>
     *                       Name of the entry
     *                       </p>
     * @param int    $length [optional] <p>
     *                       The length to be read from the entry. If 0, then the
     *                       entire entry is read.
     *                       </p>
     * @param int    $flags  [optional] <p>
     *                       The flags to use to open the archive. the following values may
     *                       be ORed to it.
     *                       <p>
     *                       <b>ZipArchive::FL_UNCHANGED</b>
     *                       </p>
     *
     * @return string the contents of the entry on success or <b>FALSE</b> on failure.
     */
    public function getFromName($name, $length = 0, $flags = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
     * Returns the name of an entry using its index
     *
     * @link http://php.net/manual/en/ziparchive.getnameindex.php
     *
     * @param int $index <p>
     *                   Index of the entry.
     *                   </p>
     * @param int $flags [optional] <p>
     *                   If flags is set to <b>ZipArchive::FL_UNCHANGED</b>, the original unchanged
     *                   name is returned.
     *                   </p>
     *
     * @return string the name on success or <b>FALSE</b> on failure.
     */
    public function getNameIndex($index, $flags = null) { }

    /**
     * Returns the status error message, system and/or zip messages
     *
     * @link  http://php.net/manual/en/ziparchive.getstatusstring.php
     * @return string a string with the status message on success or <b>FALSE</b> on failure.
     * @since 5.2.7
     */
    public function getStatusString() { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Get a file handler to the entry defined by its name (read only).
     *
     * @link http://php.net/manual/en/ziparchive.getstream.php
     *
     * @param string $name <p>
     *                     The name of the entry to use.
     *                     </p>
     *
     * @return resource a file pointer (resource) on success or <b>FALSE</b> on failure.
     */
    public function getStream($name) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
     * Returns the index of the entry in the archive
     *
     * @link http://php.net/manual/en/ziparchive.locatename.php
     *
     * @param string $name  <p>
     *                      The name of the entry to look up
     *                      </p>
     * @param int    $flags [optional] <p>
     *                      The flags are specified by ORing the following values,
     *                      or 0 for none of them.
     *                      <p>
     *                      <b>ZipArchive::FL_NOCASE</b>
     *                      </p>
     *
     * @return int the index of the entry on success or <b>FALSE</b> on failure.
     */
    public function locateName($name, $flags = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Open a ZIP file archive
     *
     * @link http://php.net/manual/en/ziparchive.open.php
     *
     * @param string $filename <p>
     *                         The file name of the ZIP archive to open.
     *                         </p>
     * @param int    $flags    [optional] <p>
     *                         The mode to use to open the archive.
     *                         <p>
     *                         <b>ZipArchive::OVERWRITE</b>
     *                         </p>
     *
     * @return mixed <i>Error codes</i>
     * <p>
     * Returns <b>TRUE</b> on success or the error code.
     * <p>
     * <b>ZipArchive::ER_EXISTS</b>
     * </p>
     * <p>
     * File already exists.
     * </p>
     * <p>
     * <b>ZipArchive::ER_INCONS</b>
     * </p>
     * <p>
     * Zip archive inconsistent.
     * </p>
     * <p>
     * <b>ZipArchive::ER_INVAL</b>
     * </p>
     * <p>
     * Invalid argument.
     * </p>
     * <p>
     * <b>ZipArchive::ER_MEMORY</b>
     * </p>
     * <p>
     * Malloc failure.
     * </p>
     * <p>
     * <b>ZipArchive::ER_NOENT</b>
     * </p>
     * <p>
     * No such file.
     * </p>
     * <p>
     * <b>ZipArchive::ER_NOZIP</b>
     * </p>
     * <p>
     * Not a zip archive.
     * </p>
     * <p>
     * <b>ZipArchive::ER_OPEN</b>
     * </p>
     * <p>
     * Can't open file.
     * </p>
     * <p>
     * <b>ZipArchive::ER_READ</b>
     * </p>
     * <p>
     * Read error.
     * </p>
     * <p>
     * <b>ZipArchive::ER_SEEK</b>
     * </p>
     * <p>
     * Seek error.
     * </p>
     * </p>
     */
    public function open($filename, $flags = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
     * Renames an entry defined by its index
     *
     * @link http://php.net/manual/en/ziparchive.renameindex.php
     *
     * @param int    $index   <p>
     *                        Index of the entry to rename.
     *                        </p>
     * @param string $newname <p>
     *                        New name.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function renameIndex($index, $newname) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
     * Renames an entry defined by its name
     *
     * @link http://php.net/manual/en/ziparchive.renamename.php
     *
     * @param string $name    <p>
     *                        Name of the entry to rename.
     *                        </p>
     * @param string $newname <p>
     *                        New name.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function renameName($name, $newname) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
     * Set the comment of a ZIP archive
     *
     * @link http://php.net/manual/en/ziparchive.setarchivecomment.php
     *
     * @param string $comment <p>
     *                        The contents of the comment.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setArchiveComment($comment) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
     * Set the comment of an entry defined by its index
     *
     * @link http://php.net/manual/en/ziparchive.setcommentindex.php
     *
     * @param int    $index   <p>
     *                        Index of the entry.
     *                        </p>
     * @param string $comment <p>
     *                        The contents of the comment.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setCommentIndex($index, $comment) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
     * Set the comment of an entry defined by its name
     *
     * @link http://php.net/manual/en/ziparchive.setcommentname.php
     *
     * @param string $name    <p>
     *                        Name of the entry.
     *                        </p>
     * @param string $comment <p>
     *                        The contents of the comment.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setCommentName($name, $comment) { }

    /**
     * Set the compression method of an entry defined by its index
     *
     * @link  http://php.net/manual/en/ziparchive.setcompressionindex.php
     *
     * @param int $index       Index of the entry.
     * @param int $comp_method The compression method. Either ZipArchive::CM_DEFAULT, ZipArchive::CM_STORE or
     *                         ZipArchive::CM_DEFLATE.
     * @param int $comp_flags  [optional] Compression flags. Currently unused.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     * @since 7.0
     */
    public function setCompressionIndex($index, $comp_method, $comp_flags = 0) { }

    /**
     * Set the compression method of an entry defined by its name
     * http://php.net/manual/en/ziparchive.setcompressionname.php
     *
     * @param string $name        Name of the entry.
     * @param int    $comp_method The compression method. Either ZipArchive::CM_DEFAULT, ZipArchive::CM_STORE or
     *                            ZipArchive::CM_DEFLATE.
     * @param int    $comp_flags  [optional] Compression flags. Currently unused.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     * @since 7.0
     */
    public function setCompressionName($name, $comp_method, $comp_flags = 0) { }

    /**
     * (PHP 5 &gt;= 5.6.0, PECL zip &gt;= 1.12.0)<br/>
     *
     * @param $password
     *
     * @return boolean
     */
    public function setPassword($password) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Get the details of an entry defined by its index.
     *
     * @link http://php.net/manual/en/ziparchive.statindex.php
     *
     * @param int $index <p>
     *                   Index of the entry
     *                   </p>
     * @param int $flags [optional] <p>
     *                   <b>ZipArchive::FL_UNCHANGED</b> may be ORed to it to request
     *                   information about the original file in the archive,
     *                   ignoring any changes made.
     *                   </p>
     *
     * @return array an array containing the entry details or <b>FALSE</b> on failure.
     */
    public function statIndex($index, $flags = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
     * Get the details of an entry defined by its name.
     *
     * @link http://php.net/manual/en/ziparchive.statname.php
     *
     * @param string $name  <p>
     *                      Name of the entry
     *                      </p>
     * @param int    $flags [optional] <p>
     *                      The flags argument specifies how the name lookup should be done.
     *                      Also, <b>ZipArchive::FL_UNCHANGED</b> may be ORed to it to request
     *                      information about the original file in the archive,
     *                      ignoring any changes made.
     *                      <p>
     *                      <b>ZipArchive::FL_NOCASE</b>
     *                      </p>
     *
     * @return array an array containing the entry details or <b>FALSE</b> on failure.
     */
    public function statName($name, $flags = null) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Undo all changes done in the archive
     *
     * @link http://php.net/manual/en/ziparchive.unchangeall.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function unchangeAll() { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Revert all global changes done in the archive.
     *
     * @link http://php.net/manual/en/ziparchive.unchangearchive.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function unchangeArchive() { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
     * Revert all changes done to an entry at the given index
     *
     * @link http://php.net/manual/en/ziparchive.unchangeindex.php
     *
     * @param int $index <p>
     *                   Index of the entry.
     *                   </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function unchangeIndex($index) { }

    /**
     * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
     * Revert all changes done to an entry with the given name.
     *
     * @link http://php.net/manual/en/ziparchive.unchangename.php
     *
     * @param string $name <p>
     *                     Name of the entry.
     *                     </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function unchangeName($name) { }
}
