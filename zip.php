<?php

// Start of zip v.1.11.0

/**
 * A file archive, compressed with Zip.
 * @link http://php.net/manual/en/class.ziparchive.php
 */
class ZipArchive  {
	const CREATE = 1;
	const EXCL = 2;
	const CHECKCONS = 4;
	const OVERWRITE = 8;
	const FL_NOCASE = 1;
	const FL_NODIR = 2;
	const FL_COMPRESSED = 4;
	const FL_UNCHANGED = 8;
	const CM_DEFAULT = -1;
	const CM_STORE = 0;
	const CM_SHRINK = 1;
	const CM_REDUCE_1 = 2;
	const CM_REDUCE_2 = 3;
	const CM_REDUCE_3 = 4;
	const CM_REDUCE_4 = 5;
	const CM_IMPLODE = 6;
	const CM_DEFLATE = 8;
	const CM_DEFLATE64 = 9;
	const CM_PKWARE_IMPLODE = 10;
	const CM_BZIP2 = 12;
	const CM_LZMA = 14;
	const CM_TERSE = 18;
	const CM_LZ77 = 19;
	const CM_WAVPACK = 97;
	const CM_PPMD = 98;
	const ER_OK = 0;
	const ER_MULTIDISK = 1;
	const ER_RENAME = 2;
	const ER_CLOSE = 3;
	const ER_SEEK = 4;
	const ER_READ = 5;
	const ER_WRITE = 6;
	const ER_CRC = 7;
	const ER_ZIPCLOSED = 8;
	const ER_NOENT = 9;
	const ER_EXISTS = 10;
	const ER_OPEN = 11;
	const ER_TMPOPEN = 12;
	const ER_ZLIB = 13;
	const ER_MEMORY = 14;
	const ER_CHANGED = 15;
	const ER_COMPNOTSUPP = 16;
	const ER_EOF = 17;
	const ER_INVAL = 18;
	const ER_NOZIP = 19;
	const ER_INTERNAL = 20;
	const ER_INCONS = 21;
	const ER_REMOVE = 22;
	const ER_DELETED = 23;

    /**
     * Status of the Zip Archive
     * @var
     */
    public $status;
    /**
     * System status of the Zip Archive
     * @var
     */
    public $statusSys;
    /**
     * Number of files in archive
     * @var
     */
    public $numFiles;
    /**
     * File name in the file system
     * @var
     */
    public $filename;
    /**
     * Comment for the archive
     * @var
     */
    public $comment;

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Open a ZIP file archive
	 * @link http://php.net/manual/en/ziparchive.open.php
	 * @param string $filename <p>
	 * The file name of the ZIP archive to open.
	 * </p>
	 * @param int $flags [optional] <p>
	 * The mode to use to open the archive.
	 * <p>
	 * <b>ZIPARCHIVE::OVERWRITE</b>
	 * </p>
	 * @return mixed <i>Error codes</i>
	 * <p>
	 * Returns <b>TRUE</b> on success or the error code.
	 * <p>
	 * <b>ZIPARCHIVE::ER_EXISTS</b>
	 * </p>
	 * <p>
	 * File already exists.
	 * </p>
	 * <p>
	 * <b>ZIPARCHIVE::ER_INCONS</b>
	 * </p>
	 * <p>
	 * Zip archive inconsistent.
	 * </p>
	 * <p>
	 * <b>ZIPARCHIVE::ER_INVAL</b>
	 * </p>
	 * <p>
	 * Invalid argument.
	 * </p>
	 * <p>
	 * <b>ZIPARCHIVE::ER_MEMORY</b>
	 * </p>
	 * <p>
	 * Malloc failure.
	 * </p>
	 * <p>
	 * <b>ZIPARCHIVE::ER_NOENT</b>
	 * </p>
	 * <p>
	 * No such file.
	 * </p>
	 * <p>
	 * <b>ZIPARCHIVE::ER_NOZIP</b>
	 * </p>
	 * <p>
	 * Not a zip archive.
	 * </p>
	 * <p>
	 * <b>ZIPARCHIVE::ER_OPEN</b>
	 * </p>
	 * <p>
	 * Can't open file.
	 * </p>
	 * <p>
	 * <b>ZIPARCHIVE::ER_READ</b>
	 * </p>
	 * <p>
	 * Read error.
	 * </p>
	 * <p>
	 * <b>ZIPARCHIVE::ER_SEEK</b>
	 * </p>
	 * <p>
	 * Seek error.
	 * </p>
	 * </p>
	 */
	public function open ($filename, $flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Close the active archive (opened or newly created)
	 * @link http://php.net/manual/en/ziparchive.close.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function close () {}

	/**
	 * (PHP 5 &gt;= 5.2.7)<br/>
	 * Returns the status error message, system and/or zip messages
	 * @link http://php.net/manual/en/ziparchive.getstatusstring.php
	 * @return string a string with the status message on success or <b>FALSE</b> on failure.
	 */
	public function getStatusString () {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.8.0)<br/>
	 * Add a new directory
	 * @link http://php.net/manual/en/ziparchive.addemptydir.php
	 * @param string $dirname <p>
	 * The directory to add.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function addEmptyDir ($dirname) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Add a file to a ZIP archive using its contents
	 * @link http://php.net/manual/en/ziparchive.addfromstring.php
	 * @param string $localname <p>
	 * The name of the entry to create.
	 * </p>
	 * @param string $contents <p>
	 * The contents to use to create the entry. It is used in a binary
	 * safe mode.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function addFromString ($localname, $contents) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Adds a file to a ZIP archive from the given path
	 * @link http://php.net/manual/en/ziparchive.addfile.php
	 * @param string $filename <p>
	 * The path to the file to add.
	 * </p>
	 * @param string $localname [optional] <p>
	 * If supplied, this is the local name inside the ZIP archive that will override the <i>filename</i>.
	 * </p>
	 * @param int $start [optional] <p>
	 * This parameter is not used but is required to extend <b>ZipArchive</b>.
	 * </p>
	 * @param int $length [optional] <p>
	 * This parameter is not used but is required to extend <b>ZipArchive</b>.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function addFile ($filename, $localname = null, $start = 0, $length = 0) {}

	/**
	 * @param $pattern
	 * @param $flags [optional]
	 * @param $options [optional]
	 */
	public function addGlob ($pattern, $flags, $options) {}

	/**
	 * @param $pattern
	 * @param $path [optional]
	 * @param $options [optional]
	 */
	public function addPattern ($pattern, $path, $options) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
	 * Renames an entry defined by its index
	 * @link http://php.net/manual/en/ziparchive.renameindex.php
	 * @param int $index <p>
	 * Index of the entry to rename.
	 * </p>
	 * @param string $newname <p>
	 * New name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function renameIndex ($index, $newname) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
	 * Renames an entry defined by its name
	 * @link http://php.net/manual/en/ziparchive.renamename.php
	 * @param string $name <p>
	 * Name of the entry to rename.
	 * </p>
	 * @param string $newname <p>
	 * New name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function renameName ($name, $newname) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
	 * Set the comment of a ZIP archive
	 * @link http://php.net/manual/en/ziparchive.setarchivecomment.php
	 * @param string $comment <p>
	 * The contents of the comment.
	 * </p>
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setArchiveComment ($comment) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Returns the Zip archive comment
	 * @link http://php.net/manual/en/ziparchive.getarchivecomment.php
	 * @param int $flags [optional] <p>
	 * If flags is set to <b>ZIPARCHIVE::FL_UNCHANGED</b>, the original unchanged
	 * comment is returned.
	 * </p>
	 * @return string the Zip archive comment or <b>FALSE</b> on failure.
	 */
	public function getArchiveComment ($flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
	 * Set the comment of an entry defined by its index
	 * @link http://php.net/manual/en/ziparchive.setcommentindex.php
	 * @param int $index <p>
	 * Index of the entry.
	 * </p>
	 * @param string $comment <p>
	 * The contents of the comment.
	 * </p>
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setCommentIndex ($index, $comment) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
	 * Set the comment of an entry defined by its name
	 * @link http://php.net/manual/en/ziparchive.setcommentname.php
	 * @param string $name <p>
	 * Name of the entry.
	 * </p>
	 * @param string $comment <p>
	 * The contents of the comment.
	 * </p>
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setCommentName ($name, $comment) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
	 * Returns the comment of an entry using the entry index
	 * @link http://php.net/manual/en/ziparchive.getcommentindex.php
	 * @param int $index <p>
	 * Index of the entry
	 * </p>
	 * @param int $flags [optional] <p>
	 * If flags is set to <b>ZIPARCHIVE::FL_UNCHANGED</b>, the original unchanged
	 * comment is returned.
	 * </p>
	 * @return string the comment on success or <b>FALSE</b> on failure.
	 */
	public function getCommentIndex ($index, $flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.4.0)<br/>
	 * Returns the comment of an entry using the entry name
	 * @link http://php.net/manual/en/ziparchive.getcommentname.php
	 * @param string $name <p>
	 * Name of the entry
	 * </p>
	 * @param int $flags [optional] <p>
	 * If flags is set to <b>ZIPARCHIVE::FL_UNCHANGED</b>, the original unchanged
	 * comment is returned.
	 * </p>
	 * @return string the comment on success or <b>FALSE</b> on failure.
	 */
	public function getCommentName ($name, $flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
	 * delete an entry in the archive using its index
	 * @link http://php.net/manual/en/ziparchive.deleteindex.php
	 * @param int $index <p>
	 * Index of the entry to delete.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function deleteIndex ($index) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
	 * delete an entry in the archive using its name
	 * @link http://php.net/manual/en/ziparchive.deletename.php
	 * @param string $name <p>
	 * Name of the entry to delete.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function deleteName ($name) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
	 * Get the details of an entry defined by its name.
	 * @link http://php.net/manual/en/ziparchive.statname.php
	 * @param string $name <p>
	 * Name of the entry
	 * </p>
	 * @param int $flags [optional] <p>
	 * The flags argument specifies how the name lookup should be done.
	 * Also, ZipArchive::FL_UNCHANGED may be ORed to it to request
	 * information about the original file in the archive,
	 * ignoring any changes made.
	 * <p>
	 * ZipArchive::FL_NOCASE
	 * </p>
	 * @return mixed an array containing the entry details or <b>FALSE</b> on failure.
	 */
	public function statName ($name, $flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Get the details of an entry defined by its index.
	 * @link http://php.net/manual/en/ziparchive.statindex.php
	 * @param int $index <p>
	 * Index of the entry
	 * </p>
	 * @param int $flags [optional] <p>
	 * ZipArchive::FL_UNCHANGED may be ORed to it to request
	 * information about the original file in the archive,
	 * ignoring any changes made.
	 * </p>
	 * @return mixed an array containing the entry details or <b>FALSE</b> on failure.
	 */
	public function statIndex ($index, $flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
	 * Returns the index of the entry in the archive
	 * @link http://php.net/manual/en/ziparchive.locatename.php
	 * @param string $name <p>
	 * The name of the entry to look up
	 * </p>
	 * @param int $flags [optional] <p>
	 * The flags are specified by ORing the following values,
	 * or 0 for none of them.
	 * <p>
	 * ZipArchive::FL_NOCASE
	 * </p>
	 * @return mixed the index of the entry on success or <b>FALSE</b> on failure.
	 */
	public function locateName ($name, $flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
	 * Returns the name of an entry using its index
	 * @link http://php.net/manual/en/ziparchive.getnameindex.php
	 * @param int $index <p>
	 * Index of the entry.
	 * </p>
	 * @param int $flags [optional] <p>
	 * If flags is set to <b>ZIPARCHIVE::FL_UNCHANGED</b>, the original unchanged
	 * name is returned.
	 * </p>
	 * @return string the name on success or <b>FALSE</b> on failure.
	 */
	public function getNameIndex ($index, $flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Revert all global changes done in the archive.
	 * @link http://php.net/manual/en/ziparchive.unchangearchive.php
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function unchangeArchive () {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Undo all changes done in the archive
	 * @link http://php.net/manual/en/ziparchive.unchangeall.php
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function unchangeAll () {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Revert all changes done to an entry at the given index
	 * @link http://php.net/manual/en/ziparchive.unchangeindex.php
	 * @param int $index <p>
	 * Index of the entry.
	 * </p>
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function unchangeIndex ($index) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.5.0)<br/>
	 * Revert all changes done to an entry with the given name.
	 * @link http://php.net/manual/en/ziparchive.unchangename.php
	 * @param string $name <p>
	 * Name of the entry.
	 * </p>
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function unchangeName ($name) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Extract the archive contents
	 * @link http://php.net/manual/en/ziparchive.extractto.php
	 * @param string $destination <p>
	 * Location where to extract the files.
	 * </p>
	 * @param mixed $entries [optional] <p>
	 * The entries to extract. It accepts either a single entry name or
	 * an array of names.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function extractTo ($destination, $entries = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Returns the entry contents using its name
	 * @link http://php.net/manual/en/ziparchive.getfromname.php
	 * @param string $name <p>
	 * Name of the entry
	 * </p>
	 * @param int $length [optional] <p>
	 * The length to be read from the entry. If 0, then the
	 * entire entry is read.
	 * </p>
	 * @param int $flags [optional] <p>
	 * The flags to use to open the archive. the following values may
	 * be ORed to it.
	 * <p>
	 * <b>ZIPARCHIVE::FL_UNCHANGED</b>
	 * </p>
	 * @return mixed the contents of the entry on success or <b>FALSE</b> on failure.
	 */
	public function getFromName ($name, $length = 0, $flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.3.0)<br/>
	 * Returns the entry contents using its index
	 * @link http://php.net/manual/en/ziparchive.getfromindex.php
	 * @param int $index <p>
	 * Index of the entry
	 * </p>
	 * @param int $length [optional] <p>
	 * The length to be read from the entry. If 0, then the
	 * entire entry is read.
	 * </p>
	 * @param int $flags [optional] <p>
	 * The flags to use to open the archive. the following values may
	 * be ORed to it.
	 * <p>
	 * ZipArchive::FL_UNCHANGED
	 * </p>
	 * @return mixed the contents of the entry on success or <b>FALSE</b> on failure.
	 */
	public function getFromIndex ($index, $length = 0, $flags = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.1.0)<br/>
	 * Get a file handler to the entry defined by its name (read only).
	 * @link http://php.net/manual/en/ziparchive.getstream.php
	 * @param string $name <p>
	 * The name of the entry to use.
	 * </p>
	 * @return resource a file pointer (resource) on success or <b>FALSE</b> on failure.
	 */
	public function getStream ($name) {}

}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Open a ZIP file archive
 * @link http://php.net/manual/en/function.zip-open.php
 * @param string $filename <p>
 * The file name of the ZIP archive to open.
 * </p>
 * @return resource a resource handle for later use with
 * <b>zip_read</b> and <b>zip_close</b>
 * or returns the number of error if <i>filename</i> does not
 * exist or in case of other error.
 */
function zip_open ($filename) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Close a ZIP file archive
 * @link http://php.net/manual/en/function.zip-close.php
 * @param resource $zip <p>
 * A ZIP file previously opened with <b>zip_open</b>.
 * </p>
 * @return void No value is returned.
 */
function zip_close ($zip) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Read next entry in a ZIP file archive
 * @link http://php.net/manual/en/function.zip-read.php
 * @param resource $zip <p>
 * A ZIP file previously opened with <b>zip_open</b>.
 * </p>
 * @return resource a directory entry resource for later use with the
 * zip_entry_... functions, or <b>FALSE</b> if
 * there are no more entries to read, or an error code if an error
 * occurred.
 */
function zip_read ($zip) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Open a directory entry for reading
 * @link http://php.net/manual/en/function.zip-entry-open.php
 * @param resource $zip <p>
 * A valid resource handle returned by <b>zip_open</b>.
 * </p>
 * @param resource $zip_entry <p>
 * A directory entry returned by <b>zip_read</b>.
 * </p>
 * @param string $mode [optional] <p>
 * Any of the modes specified in the documentation of
 * <b>fopen</b>.
 * </p>
 * <p>
 * Currently, <i>mode</i> is ignored and is always
 * "rb". This is due to the fact that zip support
 * in PHP is read only access.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * Unlike <b>fopen</b> and other similar functions,
 * the return value of <b>zip_entry_open</b> only
 * indicates the result of the operation and is not needed for
 * reading or closing the directory entry.
 */
function zip_entry_open ($zip, $zip_entry, $mode = null) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Close a directory entry
 * @link http://php.net/manual/en/function.zip-entry-close.php
 * @param resource $zip_entry <p>
 * A directory entry previously opened <b>zip_entry_open</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function zip_entry_close ($zip_entry) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Read from an open directory entry
 * @link http://php.net/manual/en/function.zip-entry-read.php
 * @param resource $zip_entry <p>
 * A directory entry returned by <b>zip_read</b>.
 * </p>
 * @param int $length [optional] <p>
 * The number of bytes to return. If not specified, this function will
 * attempt to read 1024 bytes.
 * </p>
 * <p>
 * This should be the uncompressed length you wish to read.
 * </p>
 * @return string the data read, or <b>FALSE</b> if the end of the file is
 * reached.
 */
function zip_entry_read ($zip_entry, $length = null) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Retrieve the actual file size of a directory entry
 * @link http://php.net/manual/en/function.zip-entry-filesize.php
 * @param resource $zip_entry <p>
 * A directory entry returned by <b>zip_read</b>.
 * </p>
 * @return int The size of the directory entry.
 */
function zip_entry_filesize ($zip_entry) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Retrieve the name of a directory entry
 * @link http://php.net/manual/en/function.zip-entry-name.php
 * @param resource $zip_entry <p>
 * A directory entry returned by <b>zip_read</b>.
 * </p>
 * @return string The name of the directory entry.
 */
function zip_entry_name ($zip_entry) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Retrieve the compressed size of a directory entry
 * @link http://php.net/manual/en/function.zip-entry-compressedsize.php
 * @param resource $zip_entry <p>
 * A directory entry returned by <b>zip_read</b>.
 * </p>
 * @return int The compressed size.
 */
function zip_entry_compressedsize ($zip_entry) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5 &gt;= 5.2.0, PECL zip &gt;= 1.0.0)<br/>
 * Retrieve the compression method of a directory entry
 * @link http://php.net/manual/en/function.zip-entry-compressionmethod.php
 * @param resource $zip_entry <p>
 * A directory entry returned by <b>zip_read</b>.
 * </p>
 * @return string The compression method.
 */
function zip_entry_compressionmethod ($zip_entry) {}

// End of zip v.1.11.0
?>
