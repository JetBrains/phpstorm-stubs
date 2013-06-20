<?php

// Start of SPL v.0.2

/**
 * The SplFileInfo class offers a high-level object oriented interface to
 * information for an individual file.
 * @link http://php.net/manual/en/class.splfileinfo.php
 */
class SplFileInfo  {

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Construct a new SplFileInfo object
         * @link http://php.net/manual/en/splfileinfo.construct.php
         * @param $file_name
         */
        public function __construct ($file_name) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the path without filename
         * @link http://php.net/manual/en/splfileinfo.getpath.php
         * @return string the path to the file.
         */
        public function getPath () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the filename
         * @link http://php.net/manual/en/splfileinfo.getfilename.php
         * @return string The filename.
         */
        public function getFilename () {}

        /**
         * (PHP 5 &gt;= 5.3.6)<br/>
         * Gets the file extension
         * @link http://php.net/manual/en/splfileinfo.getextension.php
	 * @return string a string containing the file extension, or an
	 * empty string if the file has no extension.
         */
        public function getExtension () {}

        /**
         * (PHP 5 &gt;= 5.2.2)<br/>
         * Gets the base name of the file
         * @link http://php.net/manual/en/splfileinfo.getbasename.php
         * @param string $suffix [optional] <p>
         * Optional suffix to omit from the base name returned.
         * </p>
         * @return string the base name without path information.
         */
        public function getBasename ($suffix = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the path to the file
         * @link http://php.net/manual/en/splfileinfo.getpathname.php
         * @return string The path to the file.
         */
        public function getPathname () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets file permissions
         * @link http://php.net/manual/en/splfileinfo.getperms.php
         * @return int the file permissions.
         */
        public function getPerms () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the inode for the file
         * @link http://php.net/manual/en/splfileinfo.getinode.php
         * @return int the inode number for the filesystem object.
         */
        public function getInode () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets file size
         * @link http://php.net/manual/en/splfileinfo.getsize.php
         * @return int The filesize in bytes.
         */
        public function getSize () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the owner of the file
         * @link http://php.net/manual/en/splfileinfo.getowner.php
         * @return int The owner id in numerical format.
         */
        public function getOwner () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the file group
         * @link http://php.net/manual/en/splfileinfo.getgroup.php
         * @return int The group id in numerical format.
         */
        public function getGroup () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets last access time of the file
         * @link http://php.net/manual/en/splfileinfo.getatime.php
         * @return int the time the file was last accessed.
         */
        public function getATime () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the last modified time
         * @link http://php.net/manual/en/splfileinfo.getmtime.php
         * @return int the last modified time for the file, in a Unix timestamp.
         */
        public function getMTime () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the inode change time
         * @link http://php.net/manual/en/splfileinfo.getctime.php
         * @return int The last change time, in a Unix timestamp.
         */
        public function getCTime () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets file type
         * @link http://php.net/manual/en/splfileinfo.gettype.php
         * @return string A string representing the type of the entry.
         * May be one of file, link,
         * or dir
         */
        public function getType () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the entry is writable
         * @link http://php.net/manual/en/splfileinfo.iswritable.php
         * @return bool true if writable, false otherwise;
         */
        public function isWritable () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if file is readable
         * @link http://php.net/manual/en/splfileinfo.isreadable.php
         * @return bool true if readable, false otherwise.
         */
        public function isReadable () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the file is executable
         * @link http://php.net/manual/en/splfileinfo.isexecutable.php
         * @return bool true if executable, false otherwise.
         */
        public function isExecutable () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the object references a regular file
         * @link http://php.net/manual/en/splfileinfo.isfile.php
         * @return bool true if the file exists and is a regular file (not a link), false otherwise.
         */
        public function isFile () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the file is a directory
         * @link http://php.net/manual/en/splfileinfo.isdir.php
         * @return bool true if a directory, false otherwise.
         */
        public function isDir () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the file is a link
         * @link http://php.net/manual/en/splfileinfo.islink.php
         * @return bool true if the file is a link, false otherwise.
         */
        public function isLink () {}

        /**
         * (PHP 5 &gt;= 5.2.2)<br/>
         * Gets the target of a link
         * @link http://php.net/manual/en/splfileinfo.getlinktarget.php
         * @return string the target of the filesystem link.
         */
        public function getLinkTarget () {}

        /**
         * (PHP 5 &gt;= 5.2.2)<br/>
         * Gets absolute path to file
         * @link http://php.net/manual/en/splfileinfo.getrealpath.php
         * @return string the path to the file.
         */
        public function getRealPath () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets an SplFileInfo object for the file
         * @link http://php.net/manual/en/splfileinfo.getfileinfo.php
         * @param string $class_name [optional] <p>
	 * Name of an <b>SplFileInfo</b> derived class to use.
         * </p>
	 * @return SplFileInfo An <b>SplFileInfo</b> object created for the file.
         */
        public function getFileInfo ($class_name = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets an SplFileInfo object for the path
         * @link http://php.net/manual/en/splfileinfo.getpathinfo.php
         * @param string $class_name [optional] <p>
	 * Name of an <b>SplFileInfo</b> derived class to use.
         * </p>
	 * @return SplFileInfo an <b>SplFileInfo</b> object for the parent path of the file.
         */
        public function getPathInfo ($class_name = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets an SplFileObject object for the file
         * @link http://php.net/manual/en/splfileinfo.openfile.php
         * @param string $open_mode [optional] <p>
	 * The mode for opening the file. See the <b>fopen</b>
         * documentation for descriptions of possible modes. The default 
         * is read only.
         * </p>
         * @param bool $use_include_path [optional] <p>
         * &parameter.use_include_path;
         * </p>
         * @param resource $context [optional] <p>
         * &parameter.context;
         * </p>
	 * @return SplFileObject The opened file as an <b>SplFileObject</b> object.
         */
	public function openFile ($open_mode = 'r', $use_include_path = false, $context = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
	 * Sets the class name used with <b>SplFileInfo::openFile</b>
         * @link http://php.net/manual/en/splfileinfo.setfileclass.php
         * @param string $class_name [optional] <p>
         * The class name to use when openFile() is called. 
         * </p>
         * @return void 
         */
        public function setFileClass ($class_name = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Sets the class used with getFileInfo and getPathInfo
         * @link http://php.net/manual/en/splfileinfo.setinfoclass.php
         * @param string $class_name [optional] <p>
         * The class name to use.
         * </p>
         * @return void 
         */
        public function setInfoClass ($class_name = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Returns the path to the file as a string
         * @link http://php.net/manual/en/splfileinfo.tostring.php
         * @return void the path to the file.
         */
        public function __toString () {}

}

/**
 * The DirectoryIterator class provides a simple interface for viewing
 * the contents of filesystem directories.
 * @link http://php.net/manual/en/class.directoryiterator.php
 */
class DirectoryIterator extends SplFileInfo implements Iterator, Traversable, SeekableIterator {

        /**
         * (PHP 5)<br/>
         * Constructs a new directory iterator from a path
         * @link http://php.net/manual/en/directoryiterator.construct.php
         * @param $path
         */
        public function __construct ($path) {}

        /**
         * (PHP 5)<br/>
         * Return file name of current DirectoryIterator item.
         * @link http://php.net/manual/en/directoryiterator.getfilename.php
	 * @return string the file name of the current <b>DirectoryIterator</b> item.
         */
        public function getFilename () {}

        /**
	 * (No version information available, might only be in SVN)<br/>
	 * Returns the file extension component of path
	 * @link http://php.net/manual/en/directoryiterator.getextension.php
	 * @return string
	 */
	public function getExtension () {}

	/**
         * (PHP 5 &gt;= 5.2.2)<br/>
         * Get base name of current DirectoryIterator item.
         * @link http://php.net/manual/en/directoryiterator.getbasename.php
         * @param string $suffix [optional] <p>
	 * If the base name ends in <i>suffix</i>,
         * this will be cut.
         * </p>
	 * @return string The base name of the current <b>DirectoryIterator</b> item.
         */
        public function getBasename ($suffix = null) {}

        /**
	 * (PHP 5)<br/>
         * Determine if current DirectoryIterator item is '.' or '..'
         * @link http://php.net/manual/en/directoryiterator.isdot.php
         * @return bool true if the entry is . or ..,
         * otherwise false
         */
        public function isDot () {}

        /**
         * (PHP 5)<br/>
         * Rewind the DirectoryIterator back to the start
         * @link http://php.net/manual/en/directoryiterator.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5)<br/>
         * Check whether current DirectoryIterator position is a valid file
         * @link http://php.net/manual/en/directoryiterator.valid.php
         * @return bool true if the position is valid, otherwise false
         */
        public function valid () {}

        /**
         * (PHP 5)<br/>
         * Return the key for the current DirectoryIterator item
         * @link http://php.net/manual/en/directoryiterator.key.php
	 * @return string The key for the current <b>DirectoryIterator</b> item.
         */
        public function key () {}

        /**
         * (PHP 5)<br/>
         * Return the current DirectoryIterator item.
         * @link http://php.net/manual/en/directoryiterator.current.php
	 * @return DirectoryIterator The current <b>DirectoryIterator</b> item.
         */
        public function current () {}

        /**
         * (PHP 5)<br/>
         * Move forward to next DirectoryIterator item
         * @link http://php.net/manual/en/directoryiterator.next.php
         * @return void 
         */
        public function next () {}

        /**
	 * (PHP 5 &gt;= 5.3.0)<br/>
         * Seek to a DirectoryIterator item
         * @link http://php.net/manual/en/directoryiterator.seek.php
         * @param int $position <p>
         * The zero-based numeric position to seek to.
         * </p>
         * @return void 
         */
        public function seek ($position) {}

        /**
	 * (PHP 5)<br/>
         * Get file name as a string
         * @link http://php.net/manual/en/directoryiterator.tostring.php
	 * @return string the file name of the current <b>DirectoryIterator</b> item.
         */
        public function __toString () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the path without filename
         * @link http://php.net/manual/en/splfileinfo.getpath.php
         * @return string the path to the file.
         */
        public function getPath () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the path to the file
         * @link http://php.net/manual/en/splfileinfo.getpathname.php
         * @return string The path to the file.
         */
        public function getPathname () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets file permissions
         * @link http://php.net/manual/en/splfileinfo.getperms.php
         * @return int the file permissions.
         */
        public function getPerms () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the inode for the file
         * @link http://php.net/manual/en/splfileinfo.getinode.php
         * @return int the inode number for the filesystem object.
         */
        public function getInode () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets file size
         * @link http://php.net/manual/en/splfileinfo.getsize.php
         * @return int The filesize in bytes.
         */
        public function getSize () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the owner of the file
         * @link http://php.net/manual/en/splfileinfo.getowner.php
         * @return int The owner id in numerical format.
         */
        public function getOwner () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the file group
         * @link http://php.net/manual/en/splfileinfo.getgroup.php
         * @return int The group id in numerical format.
         */
        public function getGroup () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets last access time of the file
         * @link http://php.net/manual/en/splfileinfo.getatime.php
         * @return int the time the file was last accessed.
         */
        public function getATime () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the last modified time
         * @link http://php.net/manual/en/splfileinfo.getmtime.php
         * @return int the last modified time for the file, in a Unix timestamp.
         */
        public function getMTime () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets the inode change time
         * @link http://php.net/manual/en/splfileinfo.getctime.php
         * @return int The last change time, in a Unix timestamp.
         */
        public function getCTime () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets file type
         * @link http://php.net/manual/en/splfileinfo.gettype.php
         * @return string A string representing the type of the entry.
         * May be one of file, link,
         * or dir
         */
        public function getType () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the entry is writable
         * @link http://php.net/manual/en/splfileinfo.iswritable.php
         * @return bool true if writable, false otherwise;
         */
        public function isWritable () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if file is readable
         * @link http://php.net/manual/en/splfileinfo.isreadable.php
         * @return bool true if readable, false otherwise.
         */
        public function isReadable () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the file is executable
         * @link http://php.net/manual/en/splfileinfo.isexecutable.php
         * @return bool true if executable, false otherwise.
         */
        public function isExecutable () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the object references a regular file
         * @link http://php.net/manual/en/splfileinfo.isfile.php
         * @return bool true if the file exists and is a regular file (not a link), false otherwise.
         */
        public function isFile () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the file is a directory
         * @link http://php.net/manual/en/splfileinfo.isdir.php
         * @return bool true if a directory, false otherwise.
         */
        public function isDir () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Tells if the file is a link
         * @link http://php.net/manual/en/splfileinfo.islink.php
         * @return bool true if the file is a link, false otherwise.
         */
        public function isLink () {}

        /**
         * (PHP 5 &gt;= 5.2.2)<br/>
         * Gets the target of a link
         * @link http://php.net/manual/en/splfileinfo.getlinktarget.php
         * @return string the target of the filesystem link.
         */
        public function getLinkTarget () {}

        /**
         * (PHP 5 &gt;= 5.2.2)<br/>
         * Gets absolute path to file
         * @link http://php.net/manual/en/splfileinfo.getrealpath.php
         * @return string the path to the file.
         */
        public function getRealPath () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets an SplFileInfo object for the file
         * @link http://php.net/manual/en/splfileinfo.getfileinfo.php
         * @param string $class_name [optional] <p>
	 * Name of an <b>SplFileInfo</b> derived class to use.
         * </p>
	 * @return SplFileInfo An <b>SplFileInfo</b> object created for the file.
         */
        public function getFileInfo ($class_name = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets an SplFileInfo object for the path
         * @link http://php.net/manual/en/splfileinfo.getpathinfo.php
         * @param string $class_name [optional] <p>
	 * Name of an <b>SplFileInfo</b> derived class to use.
         * </p>
	 * @return SplFileInfo an <b>SplFileInfo</b> object for the parent path of the file.
         */
        public function getPathInfo ($class_name = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Gets an SplFileObject object for the file
         * @link http://php.net/manual/en/splfileinfo.openfile.php
         * @param string $open_mode [optional] <p>
	 * The mode for opening the file. See the <b>fopen</b>
         * documentation for descriptions of possible modes. The default 
         * is read only.
         * </p>
         * @param bool $use_include_path [optional] <p>
         * &parameter.use_include_path;
         * </p>
         * @param resource $context [optional] <p>
         * &parameter.context;
         * </p>
	 * @return SplFileObject The opened file as an <b>SplFileObject</b> object.
         */
	public function openFile ($open_mode = 'r', $use_include_path = false, $context = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
	 * Sets the class name used with <b>SplFileInfo::openFile</b>
         * @link http://php.net/manual/en/splfileinfo.setfileclass.php
         * @param string $class_name [optional] <p>
         * The class name to use when openFile() is called. 
         * </p>
         * @return void 
         */
        public function setFileClass ($class_name = null) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Sets the class used with getFileInfo and getPathInfo
         * @link http://php.net/manual/en/splfileinfo.setinfoclass.php
         * @param string $class_name [optional] <p>
         * The class name to use.
         * </p>
         * @return void 
         */
        public function setInfoClass ($class_name = null) {}

}

/**
 * The Filesystem iterator
 * @link http://php.net/manual/en/class.filesystemiterator.php
 */
class FilesystemIterator extends DirectoryIterator implements SeekableIterator, Traversable, Iterator {
        const CURRENT_MODE_MASK = 240;
        const CURRENT_AS_PATHNAME = 32;
        const CURRENT_AS_FILEINFO = 0;
        const CURRENT_AS_SELF = 16;
        const KEY_MODE_MASK = 3840;
        const KEY_AS_PATHNAME = 0;
        const FOLLOW_SYMLINKS = 512;
        const KEY_AS_FILENAME = 256;
        const NEW_CURRENT_AND_KEY = 256;
        const SKIP_DOTS = 4096;
        const UNIX_PATHS = 8192;

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Constructs a new filesystem iterator
         * @link http://php.net/manual/en/filesystemiterator.construct.php
         * @param $path
         * @param $flags [optional]
         */
        public function __construct ($path, $flags) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Rewinds back to the beginning
         * @link http://php.net/manual/en/filesystemiterator.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Move to the next file
         * @link http://php.net/manual/en/filesystemiterator.next.php
         * @return void 
         */
        public function next () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Retrieve the key for the current file
         * @link http://php.net/manual/en/filesystemiterator.key.php
         * @return string the pathname or filename depending on the set flags.
         * See the FilesystemIterator constants.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * The current file
         * @link http://php.net/manual/en/filesystemiterator.current.php
         * @return mixed The filename, file information, or $this depending on the set flags.
         * See the FilesystemIterator constants.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Get the handling flags
         * @link http://php.net/manual/en/filesystemiterator.getflags.php
         * @return int The integer value of the set flags.
         */
        public function getFlags () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Sets handling flags
         * @link http://php.net/manual/en/filesystemiterator.setflags.php
         * @param int $flags [optional] <p>
         * The handling flags to set.
         * See the FilesystemIterator constants.
         * </p>
         * @return void 
         */
        public function setFlags ($flags = null) {}
}

/**
 * The <b>RecursiveDirectoryIterator</b> provides
 * an interface for iterating recursively over filesystem directories.
 * @link http://php.net/manual/en/class.recursivedirectoryiterator.php
 */
class RecursiveDirectoryIterator extends FilesystemIterator implements Iterator, Traversable, SeekableIterator, RecursiveIterator {


        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Constructs a RecursiveDirectoryIterator
         * @link http://php.net/manual/en/recursivedirectoryiterator.construct.php
         * @param $path
         * @param $flags [optional]
         */
        public function __construct ($path, $flags) {}

        /**
         * (PHP 5)<br/>
         * Returns whether current entry is a directory and not '.' or '..'
         * @link http://php.net/manual/en/recursivedirectoryiterator.haschildren.php
         * @param bool $allow_links [optional] <p>
         * </p>
         * @return bool whether the current entry is a directory, but not '.' or '..'
         */
        public function hasChildren ($allow_links = null) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Returns an iterator for the current entry if it is a directory
         * @link http://php.net/manual/en/recursivedirectoryiterator.getchildren.php
         * @return object An iterator for the current entry, if it is a directory.
         */
        public function getChildren () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Get sub path
         * @link http://php.net/manual/en/recursivedirectoryiterator.getsubpath.php
         * @return string The sub path (sub directory).
         */
        public function getSubPath () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Get sub path and name
         * @link http://php.net/manual/en/recursivedirectoryiterator.getsubpathname.php
         * @return string The sub path (sub directory) and filename.
         */
        public function getSubPathname () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Rewinds back to the beginning
         * @link http://php.net/manual/en/filesystemiterator.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Move to the next file
         * @link http://php.net/manual/en/filesystemiterator.next.php
         * @return void 
         */
        public function next () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Retrieve the key for the current file
         * @link http://php.net/manual/en/filesystemiterator.key.php
         * @return string the pathname or filename depending on the set flags.
         * See the FilesystemIterator constants.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * The current file
         * @link http://php.net/manual/en/filesystemiterator.current.php
         * @return mixed The filename, file information, or $this depending on the set flags.
         * See the FilesystemIterator constants.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Get the handling flags
         * @link http://php.net/manual/en/filesystemiterator.getflags.php
         * @return int The integer value of the set flags.
         */
        public function getFlags () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Sets handling flags
         * @link http://php.net/manual/en/filesystemiterator.setflags.php
         * @param int $flags [optional] <p>
         * The handling flags to set.
         * See the FilesystemIterator constants.
         * </p>
         * @return void 
         */
        public function setFlags ($flags = null) {}

}

/**
 * Iterates through a file system in a similar fashion to 
 * <b>glob</b>.
 * @link http://php.net/manual/en/class.globiterator.php
 */
class GlobIterator extends FilesystemIterator implements Iterator, Traversable, SeekableIterator, Countable {

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Construct a directory using glob
         * @link http://php.net/manual/en/globiterator.construct.php
         * @param $path
         * @param $flags [optional]
         */
        public function __construct ($path, $flags) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Get the number of directories and files
         * @link http://php.net/manual/en/globiterator.count.php
	 * @return int The number of returned directories and files, as an
         * integer.
         */
        public function count () {}
}

/**
 * The SplFileObject class offers an object oriented interface for a file.
 * @link http://php.net/manual/en/class.splfileobject.php
 */
class SplFileObject extends SplFileInfo implements RecursiveIterator, Traversable, Iterator, SeekableIterator {
        const DROP_NEW_LINE = 1;
        const READ_AHEAD = 2;
        const SKIP_EMPTY = 6;
        const READ_CSV = 8;


        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Construct a new file object.
         * @link http://php.net/manual/en/splfileobject.construct.php
         * @param $file_name
         * @param $open_mode [optional]
         * @param $use_include_path [optional]
         * @param $context [optional]
         */
        public function __construct ($file_name, $open_mode, $use_include_path, $context) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Rewind the file to the first line
         * @link http://php.net/manual/en/splfileobject.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Reached end of file
         * @link http://php.net/manual/en/splfileobject.eof.php
	 * @return bool true if file is at EOF, false otherwise.
         */
        public function eof () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Not at EOF
         * @link http://php.net/manual/en/splfileobject.valid.php
         * @return bool true if not reached EOF, false otherwise.
         */
        public function valid () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Gets line from file
         * @link http://php.net/manual/en/splfileobject.fgets.php
         * @return string a string containing the next line from the file, or false on error.
         */
        public function fgets () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Gets line from file and parse as CSV fields
         * @link http://php.net/manual/en/splfileobject.fgetcsv.php
         * @param string $delimiter [optional] <p>
	 * The field delimiter (one character only). Defaults as a comma or the value set using <b>SplFileObject::setCsvControl</b>.
         * </p>
         * @param string $enclosure [optional] <p>
	 * The field enclosure character (one character only). Defaults as a double quotation mark or the value set using <b>SplFileObject::setCsvControl</b>.
         * </p>
         * @param string $escape [optional] <p>
	 * The escape character (one character only). Defaults as a backslash (\) or the value set using <b>SplFileObject::setCsvControl</b>.
         * </p>
         * @return array an indexed array containing the fields read, or false on error.
         * </p>
         * <p>
         * A blank line in a CSV file will be returned as an array
	 * comprising a single null field unless using <b>SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE</b>,
         * in which case empty lines are skipped.
         */
	public function fgetcsv ($delimiter = ",", $enclosure = "\"", $escape = "\\") {}

	/**
         * PHP >= 5.4.0<br/>
         * Write a field array as a CSV line
         * @link http://php.net/manual/en/splfileobject.fgetcsv.php
         * @param array $fields <p>
	 * An array of values
         *</p>
         * @param string $delimiter [optional] <p>
	 * The field delimiter (one character only). Defaults as a comma or the value set using <b>SplFileObject::setCsvControl</b>.
         * </p>
         * @param string $enclosure [optional] <p>
	 * The field enclosure character (one character only). Defaults as a double quotation mark or the value set using <b>SplFileObject::setCsvControl</b>.
         * </p>
         * @return int Returns the length of the written string or FALSE on failure.
         */
	public function fputcsv (array $fields, $delimiter = ',' , $enclosure = '"') {}

        /**
         * (PHP 5 &gt;= 5.2.0)<br/>
         * Set the delimiter and enclosure character for CSV
         * @link http://php.net/manual/en/splfileobject.setcsvcontrol.php
         * @param string $delimiter [optional] <p>
         * The field delimiter (one character only).
         * </p>
         * @param string $enclosure [optional] <p>
         * The field enclosure character (one character only).
         * </p>
         * @param string $escape [optional] <p>
         * The field escape character (one character only).
         * </p>
         * @return void 
         */
	public function setCsvControl ($delimiter = ",", $enclosure = "\"", $escape = "\\") {}

        /**
         * (PHP 5 &gt;= 5.2.0)<br/>
         * Get the delimiter and enclosure character for CSV
         * @link http://php.net/manual/en/splfileobject.getcsvcontrol.php
         * @return array an indexed array containing the delimiter and enclosure character.
         */
        public function getCsvControl () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Portable file locking
         * @link http://php.net/manual/en/splfileobject.flock.php
         * @param int $operation <p>
	 * <i>operation</i> is one of the following:
	 * <b>LOCK_SH</b> to acquire a shared lock (reader).
         * @param int $wouldblock [optional] <p>
         * Set to true if the lock would block (EWOULDBLOCK errno condition).
         * </p>
	 * @return bool true on success or false on failure.
         */
        public function flock ($operation, &$wouldblock = null) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Flushes the output to the file
         * @link http://php.net/manual/en/splfileobject.fflush.php
	 * @return bool true on success or false on failure.
         */
        public function fflush () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Return current file position
         * @link http://php.net/manual/en/splfileobject.ftell.php
         * @return int the position of the file pointer as an integer, or false on error.
         */
        public function ftell () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Seek to a position
         * @link http://php.net/manual/en/splfileobject.fseek.php
         * @param int $offset <p>
         * The offset. A negative value can be used to move backwards through the file which
	 * is useful when SEEK_END is used as the <i>whence</i> value.
         * </p>
         * @param int $whence [optional] <p>
	 * <i>whence</i> values are:
	 * <b>SEEK_SET</b> - Set position equal to <i>offset</i> bytes.
	 * <b>SEEK_CUR</b> - Set position to current location plus <i>offset</i>.
	 * <b>SEEK_END</b> - Set position to end-of-file plus <i>offset</i>.
         * </p>
         * <p>
	 * If <i>whence</i> is not specified, it is assumed to be <b>SEEK_SET</b>.
         * </p>
         * @return int 0 if the seek was successful, -1 otherwise. Note that seeking
         * past EOF is not considered an error.
         */
	public function fseek ($offset, $whence = SEEK_SET) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Gets character from file
         * @link http://php.net/manual/en/splfileobject.fgetc.php
         * @return string a string containing a single character read from the file or false on EOF.
         */
        public function fgetc () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Output all remaining data on a file pointer
         * @link http://php.net/manual/en/splfileobject.fpassthru.php
	 * @return int the number of characters read from <i>handle</i>
         * and passed through to the output.
         */
        public function fpassthru () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Gets line from file and strip HTML tags
         * @link http://php.net/manual/en/splfileobject.fgetss.php
         * @param string $allowable_tags [optional] <p>
         * You can use the optional third parameter to specify tags which should
         * not be stripped.
         * </p>
         * @return string a string containing the next line of the file with HTML and PHP
         * code stripped, or false on error.
         */
        public function fgetss ($allowable_tags = null) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Parses input from file according to a format
         * @link http://php.net/manual/en/splfileobject.fscanf.php
         * @param string $format <p>
	 * The specified format as described in the <b>sprintf</b> documentation.
         * </p>
	 * @param mixed $_ [optional] <p>
	 * The optional assigned values.
	 * </p>
	 * @return mixed If only one parameter is passed to this method, the values parsed will be
         * returned as an array. Otherwise, if optional parameters are passed, the
         * function will return the number of assigned values. The optional
         * parameters must be passed by reference.
         */
        public function fscanf ($format, &$_ = null) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Write to file
         * @link http://php.net/manual/en/splfileobject.fwrite.php
         * @param string $str <p>
         * The string to be written to the file.
         * </p>
         * @param int $length [optional] <p>
	 * If the <i>length</i> argument is given, writing will
	 * stop after <i>length</i> bytes have been written or
	 * the end of <i>string</i> is reached, whichever comes
         * first.
         * </p>
	 * @return int the number of bytes written, or null on error.
         */
        public function fwrite ($str, $length = null) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Gets information about the file
         * @link http://php.net/manual/en/splfileobject.fstat.php
         * @return array an array with the statistics of the file; the format of the array
	 * is described in detail on the <b>stat</b> manual page.
         */
        public function fstat () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Truncates the file to a given length
         * @link http://php.net/manual/en/splfileobject.ftruncate.php
         * @param int $size <p>
         * The size to truncate to.
         * </p>
         * <p>
	 * If <i>size</i> is larger than the file it is extended with null bytes.
         * </p>
         * <p>
	 * If <i>size</i> is smaller than the file, the extra data will be lost.
         * </p>
	 * @return bool true on success or false on failure.
         */
        public function ftruncate ($size) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Retrieve current line of file
         * @link http://php.net/manual/en/splfileobject.current.php
	 * @return string|array Retrieves the current line of the file. If the <b>SplFileObject::READ_CSV</b> flag is set, this method returns an array containing the current line parsed as CSV data.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Get line number
         * @link http://php.net/manual/en/splfileobject.key.php
         * @return int the current line number.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Read next line
         * @link http://php.net/manual/en/splfileobject.next.php
         * @return void 
         */
        public function next () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Sets flags for the SplFileObject
         * @link http://php.net/manual/en/splfileobject.setflags.php
         * @param int $flags <p>
         * Bit mask of the flags to set. See 
         * SplFileObject constants 
         * for the available flags.
         * </p>
         * @return void 
         */
        public function setFlags ($flags) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Gets flags for the SplFileObject
         * @link http://php.net/manual/en/splfileobject.getflags.php
         * @return int an integer representing the flags.
         */
        public function getFlags () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Set maximum line length
         * @link http://php.net/manual/en/splfileobject.setmaxlinelen.php
         * @param int $max_len <p>
         * The maximum length of a line.
         * </p>
         * @return void 
         */
        public function setMaxLineLen ($max_len) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Get maximum line length
         * @link http://php.net/manual/en/splfileobject.getmaxlinelen.php
         * @return int the maximum line length if one has been set with
	 * <b>SplFileObject::setMaxLineLen</b>, default is 0.
         */
        public function getMaxLineLen () {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * SplFileObject does not have children
         * @link http://php.net/manual/en/splfileobject.haschildren.php
         * @return bool false
         */
        public function hasChildren () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * No purpose
         * @link http://php.net/manual/en/splfileobject.getchildren.php
         * @return null An SplFileObject does not have children so this method returns NULL.
         */
        public function getChildren () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Seek to specified line
         * @link http://php.net/manual/en/splfileobject.seek.php
         * @param int $line_pos <p>
         * The zero-based line number to seek to.
         * </p>
         * @return void 
         */
        public function seek ($line_pos) {}

        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
	     * Alias of <b>SplFileObject::fgets</b>
         * @link http://php.net/manual/en/splfileobject.getcurrentline.php
         * @return string Returns a string containing the next line from the file, or FALSE on error.
         */
        public function getCurrentLine () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
	 * Alias of <b>SplFileObject::current</b>
         * @link http://php.net/manual/en/splfileobject.tostring.php
         */
        public function __toString () {}

}

/**
 * The SplTempFileObject class offers an object oriented interface for a temporary file.
 * @link http://php.net/manual/en/class.spltempfileobject.php
 */
class SplTempFileObject extends SplFileObject implements SeekableIterator, Iterator, Traversable, RecursiveIterator {


        /**
         * (PHP 5 &gt;= 5.1.2)<br/>
         * Construct a new temporary file object
         * @link http://php.net/manual/en/spltempfileobject.construct.php
         * @param $max_memory [optional]
         */
        public function __construct ($max_memory) {}
}

/**
 * The SplDoublyLinkedList class provides the main functionalities of a doubly linked list.
 * @link http://php.net/manual/en/class.spldoublylinkedlist.php
 */
class SplDoublyLinkedList implements Iterator, Traversable, Countable, ArrayAccess {
        const IT_MODE_LIFO = 2;
        const IT_MODE_FIFO = 0;
        const IT_MODE_DELETE = 1;
        const IT_MODE_KEEP = 0;


        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Pops a node from the end of the doubly linked list
         * @link http://php.net/manual/en/spldoublylinkedlist.pop.php
         * @return mixed The value of the popped node.
         */
        public function pop () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Shifts a node from the beginning of the doubly linked list
         * @link http://php.net/manual/en/spldoublylinkedlist.shift.php
         * @return mixed The value of the shifted node.
         */
        public function shift () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Pushes an element at the end of the doubly linked list
         * @link http://php.net/manual/en/spldoublylinkedlist.push.php
         * @param mixed $value <p>
         * The value to push.
         * </p>
         * @return void 
         */
        public function push ($value) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Prepends the doubly linked list with an element
         * @link http://php.net/manual/en/spldoublylinkedlist.unshift.php
         * @param mixed $value <p>
         * The value to unshift.
         * </p>
         * @return void 
         */
        public function unshift ($value) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Peeks at the node from the end of the doubly linked list
         * @link http://php.net/manual/en/spldoublylinkedlist.top.php
         * @return mixed The value of the last node.
         */
        public function top () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Peeks at the node from the beginning of the doubly linked list
         * @link http://php.net/manual/en/spldoublylinkedlist.bottom.php
         * @return mixed The value of the first node.
         */
        public function bottom () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Counts the number of elements in the doubly linked list.
         * @link http://php.net/manual/en/spldoublylinkedlist.count.php
         * @return int the number of elements in the doubly linked list.
         */
        public function count () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Checks whether the doubly linked list is empty.
         * @link http://php.net/manual/en/spldoublylinkedlist.isempty.php
         * @return bool whether the doubly linked list is empty.
         */
        public function isEmpty () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Sets the mode of iteration
         * @link http://php.net/manual/en/spldoublylinkedlist.setiteratormode.php
         * @param int $mode <p>
         * There are two orthogonal sets of modes that can be set:
         * </p>
         * The direction of the iteration (either one or the other):
	 * <b>SplDoublyLinkedList::IT_MODE_LIFO</b> (Stack style)
         * @return void 
         */
        public function setIteratorMode ($mode) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Returns the mode of iteration
         * @link http://php.net/manual/en/spldoublylinkedlist.getiteratormode.php
         * @return int the different modes and flags that affect the iteration.
         */
        public function getIteratorMode () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Returns whether the requested $index exists
         * @link http://php.net/manual/en/spldoublylinkedlist.offsetexists.php
         * @param mixed $index <p>
         * The index being checked.
         * </p>
	 * @return bool true if the requested <i>index</i> exists, otherwise false
         */
        public function offsetExists ($index) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Returns the value at the specified $index
         * @link http://php.net/manual/en/spldoublylinkedlist.offsetget.php
         * @param mixed $index <p>
         * The index with the value.
         * </p>
	 * @return mixed The value at the specified <i>index</i>.
         */
        public function offsetGet ($index) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Sets the value at the specified $index to $newval
         * @link http://php.net/manual/en/spldoublylinkedlist.offsetset.php
         * @param mixed $index <p>
         * The index being set.
         * </p>
         * @param mixed $newval <p>
	 * The new value for the <i>index</i>.
         * </p>
         * @return void 
         */
        public function offsetSet ($index, $newval) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Unsets the value at the specified $index
         * @link http://php.net/manual/en/spldoublylinkedlist.offsetunset.php
         * @param mixed $index <p>
         * The index being unset.
         * </p>
         * @return void 
         */
        public function offsetUnset ($index) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Rewind iterator back to the start
         * @link http://php.net/manual/en/spldoublylinkedlist.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current array entry
         * @link http://php.net/manual/en/spldoublylinkedlist.current.php
         * @return mixed The current node value.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current node index
         * @link http://php.net/manual/en/spldoublylinkedlist.key.php
         * @return mixed The current node index.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Move to next entry
         * @link http://php.net/manual/en/spldoublylinkedlist.next.php
         * @return void 
         */
        public function next () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Move to previous entry
         * @link http://php.net/manual/en/spldoublylinkedlist.prev.php
         * @return void 
         */
        public function prev () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Check whether the doubly linked list contains more nodes
         * @link http://php.net/manual/en/spldoublylinkedlist.valid.php
         * @return bool true if the doubly linked list contains any more nodes, false otherwise.
         */
        public function valid () {}

        /**
         * PHP >= 5.4.0<br/>
         * Unserializes the storage
         * @link http://php.net/manual/ru/spldoublylinkedlist.serialize.php
         * @param $serialized The serialized string.
         * @return void
         */
         public function unserialize($serialized) {}

         /**
         * PHP >= 5.4.0<br/>
         * Serializes the storage
         * @link http://php.net/manual/ru/spldoublylinkedlist.unserialize.php
         * @return string The serialized string.
         */
         public function  serialize () {}

}

/**
 * The SplQueue class provides the main functionalities of a queue implemented using a doubly linked list.
 * @link http://php.net/manual/en/class.splqueue.php
 */
class SplQueue extends SplDoublyLinkedList implements ArrayAccess, Countable, Traversable, Iterator {


        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Adds an element to the queue.
         * @link http://php.net/manual/en/splqueue.enqueue.php
         * @param mixed $value <p>
         * The value to enqueue.
         * </p>
         * @return void 
         */
        public function enqueue ($value) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Dequeues a node from the queue
         * @link http://php.net/manual/en/splqueue.dequeue.php
         * @return mixed The value of the dequeued node.
         */
        public function dequeue () {}

    /**
     * (PHP 5 &gt;= 5.3.0)<br/>
     * Sets the mode of iteration
     * @link http://php.net/manual/en/spldoublylinkedlist.setiteratormode.php
     * @param int $mode <p>
     * There are two orthogonal sets of modes that can be set:
     * </p>
     * The direction of the iteration (either one or the other):
* <b>SplDoublyLinkedList::IT_MODE_LIFO</b> (Stack style)
     * @return void
     */
    public function setIteratorMode ($mode) {}

}
/**
 * The SplStack class provides the main functionalities of a stack implemented using a doubly linked list.
 * @link http://php.net/manual/en/class.splstack.php
 */
class SplStack extends SplDoublyLinkedList implements ArrayAccess, Countable, Traversable, Iterator {

    /**
     * (PHP 5 &gt;= 5.3.0)<br/>
     * Sets the mode of iteration
     * @link http://php.net/manual/en/spldoublylinkedlist.setiteratormode.php
     * @param int $mode <p>
     * There are two orthogonal sets of modes that can be set:
     * </p>
     * The direction of the iteration (either one or the other):
     * <b>SplDoublyLinkedList::IT_MODE_LIFO</b> (Stack style)
     * @return void
     */
    public function setIteratorMode ($mode) {}
}

/**
 * The SplHeap class provides the main functionalities of an Heap.
 * @link http://php.net/manual/en/class.splheap.php
 */
abstract class SplHeap implements Iterator, Traversable, Countable {

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Extracts a node from top of the heap and sift up.
         * @link http://php.net/manual/en/splheap.extract.php
         * @return mixed The value of the extracted node.
         */
        public function extract () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Inserts an element in the heap by sifting it up.
         * @link http://php.net/manual/en/splheap.insert.php
         * @param mixed $value <p>
         * The value to insert.
         * </p>
         * @return void 
         */
        public function insert ($value) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
	 * Peeks at the node from the top of the heap
         * @link http://php.net/manual/en/splheap.top.php
         * @return mixed The value of the node on the top.
         */
        public function top () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Counts the number of elements in the heap.
         * @link http://php.net/manual/en/splheap.count.php
         * @return int the number of elements in the heap.
         */
        public function count () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Checks whether the heap is empty.
         * @link http://php.net/manual/en/splheap.isempty.php
         * @return bool whether the heap is empty.
         */
        public function isEmpty () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Rewind iterator back to the start (no-op)
         * @link http://php.net/manual/en/splheap.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current node pointed by the iterator
         * @link http://php.net/manual/en/splheap.current.php
         * @return mixed The current node value.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current node index
         * @link http://php.net/manual/en/splheap.key.php
         * @return mixed The current node index.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Move to the next node
         * @link http://php.net/manual/en/splheap.next.php
         * @return void 
         */
        public function next () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Check whether the heap contains more nodes
         * @link http://php.net/manual/en/splheap.valid.php
         * @return bool true if the heap contains any more nodes, false otherwise.
         */
        public function valid () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Recover from the corrupted state and allow further actions on the heap.
         * @link http://php.net/manual/en/splheap.recoverfromcorruption.php
         * @return void 
         */
        public function recoverFromCorruption () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Compare elements in order to place them correctly in the heap while sifting up.
         * @link http://php.net/manual/en/splheap.compare.php
         * @param mixed $value1 <p>
         * The value of the first node being compared.
         * </p>
         * @param mixed $value2 <p>
         * The value of the second node being compared.
         * </p>
	 * @return int Result of the comparison, positive integer if <i>value1</i> is greater than <i>value2</i>, 0 if they are equal, negative integer otherwise.
         * </p>
         * <p>
         * Having multiple elements with the same value in a Heap is not recommended. They will end up in an arbitrary relative position.
         */
        abstract protected function compare ($value1, $value2);

}

/**
 * The SplMinHeap class provides the main functionalities of a heap, keeping the minimum on the top.
 * @link http://php.net/manual/en/class.splminheap.php
 */
class SplMinHeap extends SplHeap implements Countable, Traversable, Iterator {

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Compare elements in order to place them correctly in the heap while sifting up.
         * @link http://php.net/manual/en/splminheap.compare.php
         * @param mixed $value1 <p>
         * The value of the first node being compared.
         * </p>
         * @param mixed $value2 <p>
         * The value of the second node being compared.
         * </p>
	 * @return void Result of the comparison, positive integer if <i>value1</i> is lower than <i>value2</i>, 0 if they are equal, negative integer otherwise.
         * </p>
         * <p>
         * Having multiple elements with the same value in a Heap is not recommended. They will end up in an arbitrary relative position.
         */
        protected function compare ($value1, $value2) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Extracts a node from top of the heap and sift up.
         * @link http://php.net/manual/en/splheap.extract.php
         * @return mixed The value of the extracted node.
         */
        public function extract () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Inserts an element in the heap by sifting it up.
         * @link http://php.net/manual/en/splheap.insert.php
         * @param mixed $value <p>
         * The value to insert.
         * </p>
         * @return void 
         */
        public function insert ($value) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
	 * Peeks at the node from the top of the heap
         * @link http://php.net/manual/en/splheap.top.php
         * @return mixed The value of the node on the top.
         */
        public function top () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Counts the number of elements in the heap.
         * @link http://php.net/manual/en/splheap.count.php
         * @return int the number of elements in the heap.
         */
        public function count () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Checks whether the heap is empty.
         * @link http://php.net/manual/en/splheap.isempty.php
         * @return bool whether the heap is empty.
         */
        public function isEmpty () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Rewind iterator back to the start (no-op)
         * @link http://php.net/manual/en/splheap.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current node pointed by the iterator
         * @link http://php.net/manual/en/splheap.current.php
         * @return mixed The current node value.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current node index
         * @link http://php.net/manual/en/splheap.key.php
         * @return mixed The current node index.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Move to the next node
         * @link http://php.net/manual/en/splheap.next.php
         * @return void 
         */
        public function next () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Check whether the heap contains more nodes
         * @link http://php.net/manual/en/splheap.valid.php
         * @return bool true if the heap contains any more nodes, false otherwise.
         */
        public function valid () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Recover from the corrupted state and allow further actions on the heap.
         * @link http://php.net/manual/en/splheap.recoverfromcorruption.php
         * @return void 
         */
        public function recoverFromCorruption () {}

}

/**
 * The SplMaxHeap class provides the main functionalities of a heap, keeping the maximum on the top.
 * @link http://php.net/manual/en/class.splmaxheap.php
 */
class SplMaxHeap extends SplHeap implements Countable, Traversable, Iterator {

    /**
     * (PHP 5 &gt;= 5.3.0)<br/>
     * Compare elements in order to place them correctly in the heap while sifting up.
     * @link http://php.net/manual/en/splmaxheap.compare.php
     * @param mixed $value1 <p>
     * The value of the first node being compared.
     * </p>
     * @param mixed $value2 <p>
     * The value of the second node being compared.
     * </p>
     * @return void Result of the comparison, positive integer if <i>value1</i> is greater than <i>value2</i>, 0 if they are equal, negative integer otherwise.
     * </p>
     * <p>
     * Having multiple elements with the same value in a Heap is not recommended. They will end up in an arbitrary relative position.
     */
    protected function compare ($value1, $value2) {}

}
/**
 * The SplPriorityQueue class provides the main functionalities of an 
 * prioritized queue, implemented using a heap.
 * @link http://php.net/manual/en/class.splpriorityqueue.php
 */
class SplPriorityQueue implements Iterator, Traversable, Countable {
        const EXTR_BOTH = 3;
        const EXTR_PRIORITY = 2;
        const EXTR_DATA = 1;


        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Compare priorities in order to place elements correctly in the heap while sifting up.
         * @link http://php.net/manual/en/splpriorityqueue.compare.php
         * @param mixed $priority1 <p>
         * The priority of the first node being compared.
         * </p>
         * @param mixed $priority2 <p>
         * The priority of the second node being compared.
         * </p>
	 * @return int Result of the comparison, positive integer if <i>priority1</i> is greater than <i>priority2</i>, 0 if they are equal, negative integer otherwise.
         * </p>
         * <p>
         * Multiple elements with the same priority will get dequeued in no particular order.
         */
        public function compare ($priority1, $priority2) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Inserts an element in the queue by sifting it up.
         * @link http://php.net/manual/en/splpriorityqueue.insert.php
         * @param mixed $value <p>
         * The value to insert.
         * </p>
         * @param mixed $priority <p>
         * The associated priority.
         * </p>
         * @return void 
         */
        public function insert ($value, $priority) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Sets the mode of extraction
         * @link http://php.net/manual/en/splpriorityqueue.setextractflags.php
         * @param int $flags <p>
	 * Defines what is extracted by <b>SplPriorityQueue::current</b>,
	 * <b>SplPriorityQueue::top</b> and
 	 * <b>SplPriorityQueue::extract</b>.
        * </p>
	 * <b>SplPriorityQueue::EXTR_DATA</b> (0x00000001): Extract the data
         * @return void 
         */
        public function setExtractFlags ($flags) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
	 * Peeks at the node from the top of the queue
         * @link http://php.net/manual/en/splpriorityqueue.top.php
         * @return mixed The value or priority (or both) of the top node, depending on the extract flag.
         */
        public function top () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Extracts a node from top of the heap and sift up.
         * @link http://php.net/manual/en/splpriorityqueue.extract.php
         * @return mixed The value or priority (or both) of the extracted node, depending on the extract flag.
         */
        public function extract () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Counts the number of elements in the queue.
         * @link http://php.net/manual/en/splpriorityqueue.count.php
         * @return int the number of elements in the queue.
         */
        public function count () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Checks whether the queue is empty.
         * @link http://php.net/manual/en/splpriorityqueue.isempty.php
         * @return bool whether the queue is empty.
         */
        public function isEmpty () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Rewind iterator back to the start (no-op)
         * @link http://php.net/manual/en/splpriorityqueue.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current node pointed by the iterator
         * @link http://php.net/manual/en/splpriorityqueue.current.php
         * @return mixed The value or priority (or both) of the current node, depending on the extract flag.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current node index
         * @link http://php.net/manual/en/splpriorityqueue.key.php
         * @return mixed The current node index.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Move to the next node
         * @link http://php.net/manual/en/splpriorityqueue.next.php
         * @return void 
         */
        public function next () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Check whether the queue contains more nodes
         * @link http://php.net/manual/en/splpriorityqueue.valid.php
         * @return bool true if the queue contains any more nodes, false otherwise.
         */
        public function valid () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Recover from the corrupted state and allow further actions on the queue.
         * @link http://php.net/manual/en/splpriorityqueue.recoverfromcorruption.php
         * @return void 
         */
        public function recoverFromCorruption () {}

}

/**
 * The SplFixedArray class provides the main functionalities of array. The 
 * main differences between a SplFixedArray and a normal PHP array is that 
 * the SplFixedArray is of fixed length and allows only integers within 
 * the range as indexes. The advantage is that it allows a faster array
 * implementation.
 * @link http://php.net/manual/en/class.splfixedarray.php
 */
class SplFixedArray implements Iterator, Traversable, ArrayAccess, Countable {

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Constructs a new fixed array
         * @link http://php.net/manual/en/splfixedarray.construct.php
         * @param int $size [optional]
         */
        public function __construct ($size = 0) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Returns the size of the array
         * @link http://php.net/manual/en/splfixedarray.count.php
         * @return int the size of the array.
         */
        public function count () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Returns a PHP array from the fixed array
         * @link http://php.net/manual/en/splfixedarray.toarray.php
         * @return array a PHP array, similar to the fixed array.
         */
        public function toArray () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
	 * Import a PHP array in a <b>SplFixedArray</b> instance
         * @link http://php.net/manual/en/splfixedarray.fromarray.php
         * @param array $array <p>
         * The array to import.
         * </p>
	 * @param bool $save_indexes [optional] <p>
         * Try to save the numeric indexes used in the original array. 
         * </p>
	 * @return SplFixedArray an instance of <b>SplFixedArray</b>
         * containing the array content.
         */
	public static function fromArray (array $array, $save_indexes = true) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Gets the size of the array
         * @link http://php.net/manual/en/splfixedarray.getsize.php
         * @return int the size of the array, as an integer.
         */
        public function getSize () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Change the size of an array
         * @link http://php.net/manual/en/splfixedarray.setsize.php
         * @param int $size <p>
         * The new array size.
         * </p>
         * @return int 
         */
        public function setSize ($size) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Returns whether the requested index exists
         * @link http://php.net/manual/en/splfixedarray.offsetexists.php
         * @param int $index <p>
         * The index being checked.
         * </p>
	 * @return bool true if the requested <i>index</i> exists, otherwise false
         */
        public function offsetExists ($index) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Returns the value at the specified index
         * @link http://php.net/manual/en/splfixedarray.offsetget.php
         * @param int $index <p>
         * The index with the value.
         * </p>
	 * @return mixed The value at the specified <i>index</i>.
         */
        public function offsetGet ($index) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Sets a new value at a specified index
         * @link http://php.net/manual/en/splfixedarray.offsetset.php
         * @param int $index <p>
         * The index being set.
         * </p>
         * @param mixed $newval <p>
	 * The new value for the <i>index</i>.
         * </p>
         * @return void 
         */
        public function offsetSet ($index, $newval) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Unsets the value at the specified $index
         * @link http://php.net/manual/en/splfixedarray.offsetunset.php
         * @param int $index <p>
         * The index being unset.
         * </p>
         * @return void 
         */
        public function offsetUnset ($index) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Rewind iterator back to the start
         * @link http://php.net/manual/en/splfixedarray.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current array entry
         * @link http://php.net/manual/en/splfixedarray.current.php
         * @return mixed The current element value.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Return current array index
         * @link http://php.net/manual/en/splfixedarray.key.php
         * @return int The current array index.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Move to next entry
         * @link http://php.net/manual/en/splfixedarray.next.php
         * @return void 
         */
        public function next () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Check whether the array contains more elements
         * @link http://php.net/manual/en/splfixedarray.valid.php
         * @return bool true if the array contains any more elements, false otherwise.
         */
        public function valid () {}

}

/**
 * The <b>SplObserver</b> interface is used alongside
 * <b>SplSubject</b> to implement the Observer Design Pattern.
 * @link http://php.net/manual/en/class.splobserver.php
 */
interface SplObserver  {

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Receive update from subject
         * @link http://php.net/manual/en/splobserver.update.php
         * @param SplSubject $subject <p>
	 * The <b>SplSubject</b> notifying the observer of an update.
         * </p>
         * @return void 
         */
        public function update (SplSubject $subject);

}

/**
 * The <b>SplSubject</b> interface is used alongside
 * <b>SplObserver</b> to implement the Observer Design Pattern.
 * @link http://php.net/manual/en/class.splsubject.php
 */
interface SplSubject  {

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Attach an SplObserver
         * @link http://php.net/manual/en/splsubject.attach.php
         * @param SplObserver $observer <p>
	 * The <b>SplObserver</b> to attach.
         * </p>
         * @return void 
         */
        public function attach (SplObserver $observer);

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Detach an observer
         * @link http://php.net/manual/en/splsubject.detach.php
         * @param SplObserver $observer <p>
	 * The <b>SplObserver</b> to detach.
         * </p>
         * @return void 
         */
        public function detach (SplObserver $observer);

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Notify an observer
         * @link http://php.net/manual/en/splsubject.notify.php
         * @return void 
         */
        public function notify ();

}

/**
 * The SplObjectStorage class provides a map from objects to data or, by
 * ignoring data, an object set. This dual purpose can be useful in many
 * cases involving the need to uniquely identify objects.
 * @link http://php.net/manual/en/class.splobjectstorage.php
 */
class SplObjectStorage implements Countable, Iterator, Traversable, Serializable, ArrayAccess {

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Adds an object in the storage
         * @link http://php.net/manual/en/splobjectstorage.attach.php
         * @param object $object <p>
         * The object to add.
         * </p>
         * @param mixed $data [optional] <p>
         * The data to associate with the object.
         * </p>
         * @return void 
         */
        public function attach ($object, $data = null) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
	 * Removes an object from the storage
         * @link http://php.net/manual/en/splobjectstorage.detach.php
         * @param object $object <p>
         * The object to remove.
         * </p>
         * @return void 
         */
        public function detach ($object) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Checks if the storage contains a specific object
         * @link http://php.net/manual/en/splobjectstorage.contains.php
         * @param object $object <p>
         * The object to look for.
         * </p>
	 * @return bool true if the object is in the storage, false otherwise.
         */
        public function contains ($object) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Adds all objects from another storage
         * @link http://php.net/manual/en/splobjectstorage.addall.php
         * @param SplObjectStorage $storage <p>
         * The storage you want to import.
         * </p>
         * @return void 
         */
	public function addAll (SplObjectStorage $storage) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Removes objects contained in another storage from the current storage
         * @link http://php.net/manual/en/splobjectstorage.removeall.php
         * @param SplObjectStorage $storage <p>
         * The storage containing the elements to remove.
         * </p>
         * @return void 
         */
	public function removeAll (SplObjectStorage $storage) {}

        /**
	 * (PHP 5 &gt;= 5.3.6)<br/>
	 * Removes all objects except for those contained in another storage from the current storage
	 * @link http://php.net/manual/en/splobjectstorage.removeallexcept.php
	 * @param SplObjectStorage $storage <p>
	 * The storage containing the elements to retain in the current storage.
	 * </p>
	 * @return void
	 */
	public function removeAllExcept (SplObjectStorage $storage) {}

	/**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Returns the data associated with the current iterator entry
         * @link http://php.net/manual/en/splobjectstorage.getinfo.php
         * @return mixed The data associated with the current iterator position.
         */
        public function getInfo () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Sets the data associated with the current iterator entry
         * @link http://php.net/manual/en/splobjectstorage.setinfo.php
         * @param mixed $data <p>
         * The data to associate with the current iterator entry.
         * </p>
         * @return void 
         */
        public function setInfo ($data) {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Returns the number of objects in the storage
         * @link http://php.net/manual/en/splobjectstorage.count.php
         * @return int The number of objects in the storage.
         */
        public function count () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Rewind the iterator to the first storage element
         * @link http://php.net/manual/en/splobjectstorage.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Returns if the current iterator entry is valid
         * @link http://php.net/manual/en/splobjectstorage.valid.php
	 * @return bool true if the iterator entry is valid, false otherwise.
         */
        public function valid () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Returns the index at which the iterator currently is
         * @link http://php.net/manual/en/splobjectstorage.key.php
         * @return int The index corresponding to the position of the iterator.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Returns the current storage entry
         * @link http://php.net/manual/en/splobjectstorage.current.php
         * @return object The object at the current iterator position.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Move to the next entry
         * @link http://php.net/manual/en/splobjectstorage.next.php
         * @return void 
         */
        public function next () {}

        /**
         * (PHP 5 &gt;= 5.2.2)<br/>
         * Unserializes a storage from its string representation
         * @link http://php.net/manual/en/splobjectstorage.unserialize.php
         * @param string $serialized <p>
         * The serialized representation of a storage.
         * </p>
         * @return void 
         */
        public function unserialize ($serialized) {}

        /**
         * (PHP 5 &gt;= 5.2.2)<br/>
         * Serializes the storage
         * @link http://php.net/manual/en/splobjectstorage.serialize.php
         * @return string A string representing the storage.
         */
        public function serialize () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Checks whether an object exists in the storage
         * @link http://php.net/manual/en/splobjectstorage.offsetexists.php
         * @param object $object <p>
         * The object to look for.
         * </p>
	 * @return bool true if the object exists in the storage,
         * and false otherwise.
         */
        public function offsetExists ($object) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Associates data to an object in the storage
         * @link http://php.net/manual/en/splobjectstorage.offsetset.php
         * @param object $object <p>
         * The object to associate data with.
         * </p>
	 * @param mixed $data [optional] <p>
         * The data to associate with the object.
         * </p>
         * @return void 
         */
	public function offsetSet ($object, $data = null) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Removes an object from the storage
         * @link http://php.net/manual/en/splobjectstorage.offsetunset.php
         * @param object $object <p>
         * The object to remove.
         * </p>
         * @return void 
         */
        public function offsetUnset ($object) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Returns the data associated with an <type>object</type>
         * @link http://php.net/manual/en/splobjectstorage.offsetget.php
         * @param object $object <p>
         * The object to look for.
         * </p>
         * @return mixed The data previously associated with the object in the storage.
         */
        public function offsetGet ($object) {}

        /**
         * PHP >= 5.4.0<br/>
         * Calculate a unique identifier for the contained objects
         * @link http://php.net/manual/en/splobjectstorage.gethash.php
         * @param $object  <p>
         * object whose identifier is to be calculated.
         * @return string A string with the calculated identifier.
        */
        public function getHash($object) {}

}

/**
 * An Iterator that sequentially iterates over all attached iterators
 * @link http://php.net/manual/en/class.multipleiterator.php
 */
class MultipleIterator implements Iterator, Traversable {
        const MIT_NEED_ANY = 0;
        const MIT_NEED_ALL = 1;
        const MIT_KEYS_NUMERIC = 0;
        const MIT_KEYS_ASSOC = 2;


        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Constructs a new MultipleIterator
         * @link http://php.net/manual/en/multipleiterator.construct.php
         * @param $flags [optional] Defaults to MultipleIterator::MIT_NEED_ALL | MultipleIterator::MIT_KEYS_NUMERIC
         */
        public function __construct ($flags) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Gets the flag information
         * @link http://php.net/manual/en/multipleiterator.getflags.php
         * @return int Information about the flags, as an integer.
         */
        public function getFlags () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Sets flags
         * @link http://php.net/manual/en/multipleiterator.setflags.php
	 * @param int $flags <p>
         * The flags to set, according to the
         * Flag Constants
         * </p>
         * @return void 
         */
        public function setFlags ($flags) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Attaches iterator information
         * @link http://php.net/manual/en/multipleiterator.attachiterator.php
         * @param Iterator $iterator <p>
         * The new iterator to attach.
         * </p>
         * @param string $infos [optional] <p>
         * The associative information for the Iterator, which must be an
	 * integer, a string, or null.
         * </p>
         * @return void Description...
         */
	public function attachIterator (Iterator $iterator, $infos = null) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Detaches an iterator
         * @link http://php.net/manual/en/multipleiterator.detachiterator.php
         * @param Iterator $iterator <p>
         * The iterator to detach.
         * </p>
         * @return void 
         */
	public function detachIterator (Iterator $iterator) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Checks if an iterator is attached
         * @link http://php.net/manual/en/multipleiterator.containsiterator.php
         * @param Iterator $iterator <p>
         * The iterator to check.
         * </p>
	 * @return void true on success or false on failure.
         */
	public function containsIterator (Iterator $iterator) {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Gets the number of attached iterator instances
         * @link http://php.net/manual/en/multipleiterator.countiterators.php
         * @return void The number of attached iterator instances (as an integer).
         */
        public function countIterators () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Rewinds all attached iterator instances
         * @link http://php.net/manual/en/multipleiterator.rewind.php
         * @return void 
         */
        public function rewind () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Checks the validity of sub iterators
         * @link http://php.net/manual/en/multipleiterator.valid.php
         * @return void true if one or all sub iterators are valid depending on flags,
         * otherwise false
         */
        public function valid () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Gets the registered iterator instances
         * @link http://php.net/manual/en/multipleiterator.key.php
         * @return array An array of all registered iterator instances,
         * or false if no sub iterator is attached.
         */
        public function key () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Gets the registered iterator instances
         * @link http://php.net/manual/en/multipleiterator.current.php
         * @return void An array of all registered iterator instances,
         * or false if no sub iterator is attached.
         */
        public function current () {}

        /**
         * (PHP 5 &gt;= 5.3.0)<br/>
         * Moves all attached iterator instances forward
         * @link http://php.net/manual/en/multipleiterator.next.php
         * @return void 
         */
        public function next () {}

}

/**
 * Parent class for all SPL types.
 */
class SplType {

    const __default = null;

    /**
     * Creates a new value of some type
     * @param mixed $initial_value [optional] Type and default value depends on the extension class.
     * @param boolean $strict [optional] Whether to set the object's sctrictness.
     */
    function __construct ($initial_value, $strict) {}
}

/**
 * The SplInt class is used to enforce strong typing of the integer type.
 */
class SplInt extends SplType {
    /**
     * @var int
     */
    const __default = 0;
}

/**
 * The SplFloat class is used to enforce strong typing of the float type.
 */
class SplFloat extends SplType {
    /**
     * @var float
     */
    const __default = 0;
}

/**
 * The SplString class is used to enforce strong typing of the string type.
 */
class SplString extends SplType {
    /**
     * @var int
     */
    const __default = 0;
}

/**
 * SplEnum gives the ability to emulate and create enumeration objects natively in PHP.
 * @link http://php.net/manual/en/class.splenum.php
 */
class SplEnum extends SplType {
    const __default = null;

    /**
     * Creates a new value of some type
     * @param mixed $initial_value Type and default value depends on the extension class.
     * @param bool $strict Whether to set the object's sctrictness.
     * @throws UnexpectedValueException if incompatible type is given.
     */
    public function __construct($initial_value, $strict) {}

    /**
     * Returns all consts (possible values) as an array.
     * @param bool $include_default Whether to include __default property.
     * @return array
     */
    public function getConstList ($include_default = false) {}

}

/**
 * The SplBool class is used to enforce strong typing of the boolean type.
 */
class SplBool extends SplEnum {
    /**
     * @var bool
     */
    const __default = false;
    const true = true;
    const false = false;
}



// End of SPL v.0.2
?>
