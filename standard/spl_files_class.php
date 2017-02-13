<?php
/**
 * PHPStorm stub file for Standard PHP Library(SPL) File Handling classes.
 *
 * @link http://php.net/manual/en/spl.files.php
 */

/**
 * The SplFileInfo class offers a high-level object oriented interface to
 * information for an individual file.
 *
 * @link http://php.net/manual/en/class.splfileinfo.php
 */
class SplFileInfo
{
    /**
     * Construct a new SplFileInfo object
     *
     * @link  http://php.net/manual/en/splfileinfo.construct.php
     *
     * @param $file_name
     *
     * @since 5.1.2
     */
    public function __construct($file_name) { }

    /**
     * Returns the path to the file as a string
     *
     * @link  http://php.net/manual/en/splfileinfo.tostring.php
     * @return string the path to the file.
     * @since 5.1.2
     */
    public function __toString() { }

    /**
     * Gets last access time of the file
     *
     * @link  http://php.net/manual/en/splfileinfo.getatime.php
     * @return int the time the file was last accessed.
     * @since 5.1.2
     */
    public function getATime() { }

    /**
     * Gets the base name of the file
     *
     * @link  http://php.net/manual/en/splfileinfo.getbasename.php
     *
     * @param string $suffix [optional] <p>
     *                       Optional suffix to omit from the base name returned.
     *                       </p>
     *
     * @return string the base name without path information.
     * @since 5.2.2
     */
    public function getBasename($suffix = null) { }

    /**
     * Gets the inode change time
     *
     * @link  http://php.net/manual/en/splfileinfo.getctime.php
     * @return int The last change time, in a Unix timestamp.
     * @since 5.1.2
     */
    public function getCTime() { }

    /**
     * Gets the file extension
     *
     * @link  http://php.net/manual/en/splfileinfo.getextension.php
     * @return string a string containing the file extension, or an
     * empty string if the file has no extension.
     * @since 5.3.6
     */
    public function getExtension() { }

    /**
     * Gets an SplFileInfo object for the file
     *
     * @link  http://php.net/manual/en/splfileinfo.getfileinfo.php
     *
     * @param string $class_name [optional] <p>
     *                           Name of an <b>SplFileInfo</b> derived class to use.
     *                           </p>
     *
     * @return SplFileInfo An <b>SplFileInfo</b> object created for the file.
     * @since 5.1.2
     */
    public function getFileInfo($class_name = null) { }

    /**
     * Gets the filename
     *
     * @link  http://php.net/manual/en/splfileinfo.getfilename.php
     * @return string The filename.
     * @since 5.1.2
     */
    public function getFilename() { }

    /**
     * Gets the file group
     *
     * @link  http://php.net/manual/en/splfileinfo.getgroup.php
     * @return int The group id in numerical format.
     * @since 5.1.2
     */
    public function getGroup() { }

    /**
     * Gets the inode for the file
     *
     * @link  http://php.net/manual/en/splfileinfo.getinode.php
     * @return int the inode number for the filesystem object.
     * @since 5.1.2
     */
    public function getInode() { }

    /**
     * Gets the target of a link
     *
     * @link  http://php.net/manual/en/splfileinfo.getlinktarget.php
     * @return string the target of the filesystem link.
     * @since 5.2.2
     */
    public function getLinkTarget() { }

    /**
     * Gets the last modified time
     *
     * @link  http://php.net/manual/en/splfileinfo.getmtime.php
     * @return int the last modified time for the file, in a Unix timestamp.
     * @since 5.1.2
     */
    public function getMTime() { }

    /**
     * Gets the owner of the file
     *
     * @link  http://php.net/manual/en/splfileinfo.getowner.php
     * @return int The owner id in numerical format.
     * @since 5.1.2
     */
    public function getOwner() { }

    /**
     * Gets the path without filename
     *
     * @link  http://php.net/manual/en/splfileinfo.getpath.php
     * @return string the path to the file.
     * @since 5.1.2
     */
    public function getPath() { }

    /**
     * Gets an SplFileInfo object for the path
     *
     * @link  http://php.net/manual/en/splfileinfo.getpathinfo.php
     *
     * @param string $class_name [optional] <p>
     *                           Name of an <b>SplFileInfo</b> derived class to use.
     *                           </p>
     *
     * @return SplFileInfo an <b>SplFileInfo</b> object for the parent path of the file.
     * @since 5.1.2
     */
    public function getPathInfo($class_name = null) { }

    /**
     * Gets the path to the file
     *
     * @link  http://php.net/manual/en/splfileinfo.getpathname.php
     * @return string The path to the file.
     * @since 5.1.2
     */
    public function getPathname() { }

    /**
     * Gets file permissions
     *
     * @link  http://php.net/manual/en/splfileinfo.getperms.php
     * @return int the file permissions.
     * @since 5.1.2
     */
    public function getPerms() { }

    /**
     * Gets absolute path to file
     *
     * @link  http://php.net/manual/en/splfileinfo.getrealpath.php
     * @return string the path to the file.
     * @since 5.2.2
     */
    public function getRealPath() { }

    /**
     * Gets file size
     *
     * @link  http://php.net/manual/en/splfileinfo.getsize.php
     * @return int The filesize in bytes.
     * @since 5.1.2
     */
    public function getSize() { }

    /**
     * Gets file type
     *
     * @link  http://php.net/manual/en/splfileinfo.gettype.php
     * @return string A string representing the type of the entry.
     * May be one of file, link,
     * or dir
     * @since 5.1.2
     */
    public function getType() { }

    /**
     * Tells if the file is a directory
     *
     * @link  http://php.net/manual/en/splfileinfo.isdir.php
     * @return bool true if a directory, false otherwise.
     * @since 5.1.2
     */
    public function isDir() { }

    /**
     * Tells if the file is executable
     *
     * @link  http://php.net/manual/en/splfileinfo.isexecutable.php
     * @return bool true if executable, false otherwise.
     * @since 5.1.2
     */
    public function isExecutable() { }

    /**
     * Tells if the object references a regular file
     *
     * @link  http://php.net/manual/en/splfileinfo.isfile.php
     * @return bool true if the file exists and is a regular file (not a link), false otherwise.
     * @since 5.1.2
     */
    public function isFile() { }

    /**
     * Tells if the file is a link
     *
     * @link  http://php.net/manual/en/splfileinfo.islink.php
     * @return bool true if the file is a link, false otherwise.
     * @since 5.1.2
     */
    public function isLink() { }

    /**
     * Tells if file is readable
     *
     * @link  http://php.net/manual/en/splfileinfo.isreadable.php
     * @return bool true if readable, false otherwise.
     * @since 5.1.2
     */
    public function isReadable() { }

    /**
     * Tells if the entry is writable
     *
     * @link  http://php.net/manual/en/splfileinfo.iswritable.php
     * @return bool true if writable, false otherwise;
     * @since 5.1.2
     */
    public function isWritable() { }

    /**
     * Gets an SplFileObject object for the file
     *
     * @link  http://php.net/manual/en/splfileinfo.openfile.php
     *
     * @param string   $open_mode        [optional] <p>
     *                                   The mode for opening the file. See the <b>fopen</b>
     *                                   documentation for descriptions of possible modes. The default
     *                                   is read only.
     *                                   </p>
     * @param bool     $use_include_path [optional] <p>
     *                                   &parameter.use_include_path;
     *                                   </p>
     * @param resource $context          [optional] <p>
     *                                   &parameter.context;
     *                                   </p>
     *
     * @return SplFileObject The opened file as an <b>SplFileObject</b> object.
     * @since 5.1.2
     */
    public function openFile($open_mode = 'r', $use_include_path = false, $context = null) { }

    /**
     * Sets the class name used with <b>SplFileInfo::openFile</b>
     *
     * @link  http://php.net/manual/en/splfileinfo.setfileclass.php
     *
     * @param string $class_name [optional] <p>
     *                           The class name to use when openFile() is called.
     *                           </p>
     *
     * @return void
     * @since 5.1.2
     */
    public function setFileClass($class_name = null) { }

    /**
     * Sets the class used with getFileInfo and getPathInfo
     *
     * @link  http://php.net/manual/en/splfileinfo.setinfoclass.php
     *
     * @param string $class_name [optional] <p>
     *                           The class name to use.
     *                           </p>
     *
     * @return void
     * @since 5.1.2
     */
    public function setInfoClass($class_name = null) { }
}

/**
 * The SplFileObject class offers an object oriented interface for a file.
 *
 * @link http://php.net/manual/en/class.splfileobject.php
 */
class SplFileObject extends SplFileInfo implements RecursiveIterator, Traversable, Iterator, SeekableIterator
{
    const DROP_NEW_LINE = 1;
    const READ_AHEAD = 2;
    const READ_CSV = 8;
    const SKIP_EMPTY = 6;

    /**
     * Construct a new file object.
     *
     * @link  http://php.net/manual/en/splfileobject.construct.php
     *
     * @param $file_name
     * @param $open_mode        [optional]
     * @param $use_include_path [optional]
     * @param $context          [optional]
     *
     * @since 5.1.0
     */
    public function __construct($file_name, $open_mode, $use_include_path, $context) { }

    /**
     * Alias of <b>SplFileObject::current</b>
     *
     * @link  http://php.net/manual/en/splfileobject.tostring.php
     * @since 5.1.0
     */
    public function __toString() { }

    /**
     * Retrieve current line of file
     *
     * @link  http://php.net/manual/en/splfileobject.current.php
     * @return string|array Retrieves the current line of the file. If the <b>SplFileObject::READ_CSV</b> flag is set,
     *                      this method returns an array containing the current line parsed as CSV data.
     * @since 5.1.0
     */
    public function current() { }

    /**
     * Reached end of file
     *
     * @link  http://php.net/manual/en/splfileobject.eof.php
     * @return bool true if file is at EOF, false otherwise.
     * @since 5.1.0
     */
    public function eof() { }

    /**
     * No purpose
     *
     * @link  http://php.net/manual/en/splfileobject.getchildren.php
     * @return null An SplFileObject does not have children so this method returns NULL.
     * @since 5.1.0
     */
    public function getChildren() { }

    /**
     * Get the delimiter and enclosure character for CSV
     *
     * @link  http://php.net/manual/en/splfileobject.getcsvcontrol.php
     * @return array an indexed array containing the delimiter and enclosure character.
     * @since 5.2.0
     */
    public function getCsvControl() { }

    /**
     * Alias of <b>SplFileObject::fgets</b>
     *
     * @link  http://php.net/manual/en/splfileobject.getcurrentline.php
     * @return string Returns a string containing the next line from the file, or FALSE on error.
     * @since 5.1.2
     */
    public function getCurrentLine() { }

    /**
     * Gets flags for the SplFileObject
     *
     * @link  http://php.net/manual/en/splfileobject.getflags.php
     * @return int an integer representing the flags.
     * @since 5.1.0
     */
    public function getFlags() { }

    /**
     * Get maximum line length
     *
     * @link  http://php.net/manual/en/splfileobject.getmaxlinelen.php
     * @return int the maximum line length if one has been set with
     * <b>SplFileObject::setMaxLineLen</b>, default is 0.
     * @since 5.1.0
     */
    public function getMaxLineLen() { }

    /**
     * SplFileObject does not have children
     *
     * @link  http://php.net/manual/en/splfileobject.haschildren.php
     * @return bool false
     * @since 5.1.2
     */
    public function hasChildren() { }

    /**
     * Get line number
     *
     * @link  http://php.net/manual/en/splfileobject.key.php
     * @return int the current line number.
     * @since 5.1.0
     */
    public function key() { }

    /**
     * Read next line
     *
     * @link  http://php.net/manual/en/splfileobject.next.php
     * @return void
     * @since 5.1.0
     */
    public function next() { }

    /**
     * Rewind the file to the first line
     *
     * @link  http://php.net/manual/en/splfileobject.rewind.php
     * @return void
     * @since 5.1.0
     */
    public function rewind() { }

    /**
     * Seek to specified line
     *
     * @link  http://php.net/manual/en/splfileobject.seek.php
     *
     * @param int $line_pos <p>
     *                      The zero-based line number to seek to.
     *                      </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function seek($line_pos) { }

    /**
     * Set the delimiter and enclosure character for CSV
     *
     * @link  http://php.net/manual/en/splfileobject.setcsvcontrol.php
     *
     * @param string $delimiter [optional] <p>
     *                          The field delimiter (one character only).
     *                          </p>
     * @param string $enclosure [optional] <p>
     *                          The field enclosure character (one character only).
     *                          </p>
     * @param string $escape    [optional] <p>
     *                          The field escape character (one character only).
     *                          </p>
     *
     * @return void
     * @since 5.2.0
     */
    public function setCsvControl($delimiter = ',', $enclosure = '"', $escape = '\\') { }

    /**
     * Sets flags for the SplFileObject
     *
     * @link  http://php.net/manual/en/splfileobject.setflags.php
     *
     * @param int $flags <p>
     *                   Bit mask of the flags to set. See
     *                   SplFileObject constants
     *                   for the available flags.
     *                   </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function setFlags($flags) { }

    /**
     * Set maximum line length
     *
     * @link  http://php.net/manual/en/splfileobject.setmaxlinelen.php
     *
     * @param int $max_len <p>
     *                     The maximum length of a line.
     *                     </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function setMaxLineLen($max_len) { }

    /**
     * Not at EOF
     *
     * @link  http://php.net/manual/en/splfileobject.valid.php
     * @return bool true if not reached EOF, false otherwise.
     * @since 5.1.0
     */
    public function valid() { }
}

/**
 * The SplTempFileObject class offers an object oriented interface for a temporary file.
 *
 * @link http://php.net/manual/en/class.spltempfileobject.php
 */
class SplTempFileObject extends SplFileObject
{
    /**
     * Construct a new temporary file object
     *
     * @link  http://php.net/manual/en/spltempfileobject.construct.php
     *
     * @param $max_memory [optional]
     *
     * @since 5.1.2
     */
    public function __construct($max_memory) { }
}
