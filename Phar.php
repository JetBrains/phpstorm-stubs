<?php

// Start of Phar v.2.0.1

/**
 * The PharException class provides a phar-specific exception class
 * for try/catch blocks.
 * @link http://php.net/manual/en/class.PharException.php
 */
class PharException extends Exception  {
}

/**
 * The Phar class provides a high-level interface to accessing and creating
 * phar archives.
 * @link http://php.net/manual/en/class.Phar.php
 */
class Phar extends RecursiveDirectoryIterator implements RecursiveIterator, SeekableIterator, Traversable, Iterator, Countable, ArrayAccess {
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
	const BZ2 = 8192;
	const GZ = 4096;
	const NONE = 0;
	const PHAR = 1;
	const TAR = 2;
	const ZIP = 3;
	const COMPRESSED = 61440;
	const PHP = 0;
	const PHPS = 1;
	const MD5 = 1;
	const OPENSSL = 16;
	const SHA1 = 2;
	const SHA256 = 3;
	const SHA512 = 4;


	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Construct a Phar archive object
	 * @link http://php.net/manual/en/phar.construct.php
	 * @param string $fname <p>
	 * Path to an existing Phar archive or to-be-created archive
	 * </p>
	 * @param int $flags [optional] <p>
	 * Flags to pass to parent class RecursiveDirectoryIterator.
	 * </p>
	 * @param string $alias [optional] <p>
	 * Alias with which this Phar archive should be referred to in calls to stream
	 * functionality.
	 * </p>
	 * @return void 
	 */
	public function __construct ($fname, $flags = null, $alias = null) {}

	public function __destruct () {}

	/**
	 * (Unknown)<br/>
	 * Add an empty directory to the phar archive
	 * @link http://php.net/manual/en/phar.addemptydir.php
	 * @param string $dirname <p>
	 * The name of the empty directory to create in the phar archive
	 * </p>
	 * @return void no return value, exception is thrown on failure.
	 */
	public function addEmptyDir ($dirname) {}

	/**
	 * (Unknown)<br/>
	 * Add a file from the filesystem to the phar archive
	 * @link http://php.net/manual/en/phar.addfile.php
	 * @param string $file <p>
	 * Full or relative path to a file on disk to be added
	 * to the phar archive.
	 * </p>
	 * @param string $localname [optional] <p>
	 * Path that the file will be stored in the archive.
	 * </p>
	 * @return void no return value, exception is thrown on failure.
	 */
	public function addFile ($file, $localname = null) {}

	/**
	 * (Unknown)<br/>
	 * Add a file from the filesystem to the phar archive
	 * @link http://php.net/manual/en/phar.addfromstring.php
	 * @param string $localname <p>
	 * Path that the file will be stored in the archive.
	 * </p>
	 * @param string $contents <p>
	 * The file contents to store
	 * </p>
	 * @return void no return value, exception is thrown on failure.
	 */
	public function addFromString ($localname, $contents) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Construct a phar archive from the files within a directory.
	 * @link http://php.net/manual/en/phar.buildfromdirectory.php
	 * @param string $base_dir <p>
	 * The full or relative path to the directory that contains all files
	 * to add to the archive.
	 * </p>
	 * @param string $regex [optional] <p>
	 * An optional pcre regular expression that is used to filter the
	 * list of files. Only file paths matching the regular expression
	 * will be included in the archive.
	 * </p>
	 * @return array Phar::buildFromDirectory returns an associative array
	 * mapping internal path of file to the full path of the file on the
	 * filesystem.
	 */
	public function buildFromDirectory ($base_dir, $regex = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Construct a phar archive from an iterator.
	 * @link http://php.net/manual/en/phar.buildfromiterator.php
	 * @param Iterator $iter <p>
	 * Any iterator that either associatively maps phar file to location or
	 * returns SplFileInfo objects
	 * </p>
	 * @param string $base_directory [optional] <p>
	 * For iterators that return SplFileInfo objects, the portion of each
	 * file's full path to remove when adding to the phar archive
	 * </p>
	 * @return array Phar::buildFromIterator returns an associative array
	 * mapping internal path of file to the full path of the file on the
	 * filesystem.
	 */
	public function buildFromIterator ($iter, $base_directory = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Compresses all files in the current Phar archive
	 * @link http://php.net/manual/en/phar.compressfiles.php
	 * @param int $compression <p>
	 * Compression must be one of Phar::GZ,
	 * Phar::BZ2 to add compression, or Phar::NONE
	 * to remove compression.
	 * </p>
	 * @return void 
	 */
	public function compressFiles ($compression) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Decompresses all files in the current Phar archive
	 * @link http://php.net/manual/en/phar.decompressfiles.php
	 * @return bool true on success or false on failure.
	 */
	public function decompressFiles () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Compresses the entire Phar archive using Gzip or Bzip2 compression
	 * @link http://php.net/manual/en/phar.compress.php
	 * @param int $compression <p>
	 * Compression must be one of Phar::GZ,
	 * Phar::BZ2 to add compression, or Phar::NONE
	 * to remove compression.
	 * </p>
	 * @param string $extension [optional] <p>
	 * By default, the extension is .phar.gz
	 * or .phar.bz2 for compressing phar archives, and
	 * .phar.tar.gz or .phar.tar.bz2 for
	 * compressing tar archives. For decompressing, the default file extensions
	 * are .phar and .phar.tar.
	 * </p>
	 * @return object a Phar object.
	 */
	public function compress ($compression, $extension = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Decompresses the entire Phar archive
	 * @link http://php.net/manual/en/phar.decompress.php
	 * @param string $extension [optional] <p>
	 * For decompressing, the default file extensions
	 * are .phar and .phar.tar.
	 * Use this parameter to specify another file extension. Be aware
	 * that all executable phar archives must contain .phar
	 * in their filename.
	 * </p>
	 * @return object A Phar object is returned.
	 */
	public function decompress ($extension = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Convert a phar archive to another executable phar archive file format
	 * @link http://php.net/manual/en/phar.converttoexecutable.php
	 * @param int $format [optional] <p>
	 * This should be one of Phar::PHAR, Phar::TAR,
	 * or Phar::ZIP. If set to &null;, the existing file format
	 * will be preserved.
	 * </p>
	 * @param int $compression [optional] <p>
	 * This should be one of Phar::NONE for no whole-archive
	 * compression, Phar::GZ for zlib-based compression, and
	 * Phar::BZ2 for bzip-based compression.
	 * </p>
	 * @param string $extension [optional] <p>
	 * This parameter is used to override the default file extension for a
	 * converted archive. Note that all zip- and tar-based phar archives must contain
	 * .phar in their file extension in order to be processed as a
	 * phar archive.
	 * </p>
	 * <p>
	 * If converting to a phar-based archive, the default extensions are
	 * .phar, .phar.gz, or .phar.bz2
	 * depending on the specified compression. For tar-based phar archives, the
	 * default extensions are .phar.tar, .phar.tar.gz,
	 * and .phar.tar.bz2. For zip-based phar archives, the
	 * default extension is .phar.zip.
	 * </p>
	 * @return Phar The method returns a Phar object on success and throws an
	 * exception on failure.
	 */
	public function convertToExecutable ($format = null, $compression = null, $extension = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Convert a phar archive to a non-executable tar or zip file
	 * @link http://php.net/manual/en/phar.converttodata.php
	 * @param int $format [optional] <p>
	 * This should be one of Phar::TAR
	 * or Phar::ZIP. If set to &null;, the existing file format
	 * will be preserved.
	 * </p>
	 * @param int $compression [optional] <p>
	 * This should be one of Phar::NONE for no whole-archive
	 * compression, Phar::GZ for zlib-based compression, and
	 * Phar::BZ2 for bzip-based compression.
	 * </p>
	 * @param string $extension [optional] <p>
	 * This parameter is used to override the default file extension for a
	 * converted archive. Note that .phar cannot be used
	 * anywhere in the filename for a non-executable tar or zip archive.
	 * </p>
	 * <p>
	 * If converting to a tar-based phar archive, the
	 * default extensions are .tar, .tar.gz,
	 * and .tar.bz2 depending on specified compression.
	 * For zip-based archives, the
	 * default extension is .zip.
	 * </p>
	 * @return PharData The method returns a PharData object on success and throws an
	 * exception on failure.
	 */
	public function convertToData ($format = null, $compression = null, $extension = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Copy a file internal to the phar archive to another new file within the phar
	 * @link http://php.net/manual/en/phar.copy.php
	 * @param string $oldfile <p>
	 * </p>
	 * @param string $newfile <p>
	 * </p>
	 * @return bool returns true on success, but it is safer to encase method call in a
	 * try/catch block and assume success if no exception is thrown.
	 */
	public function copy ($oldfile, $newfile) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns the number of entries (files) in the Phar archive
	 * @link http://php.net/manual/en/phar.count.php
	 * @return int The number of files contained within this phar, or 0 (the number zero)
	 * if none.
	 */
	public function count () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Delete a file within a phar archive
	 * @link http://php.net/manual/en/phar.delete.php
	 * @param string $entry <p>
	 * Path within an archive to the file to delete.
	 * </p>
	 * @return bool returns true on success, but it is better to check for thrown exception,
	 * and assume success if none is thrown.
	 */
	public function delete ($entry) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.2.0)<br/>
	 * Deletes the global metadata of the phar
	 * @link http://php.net/manual/en/phar.delmetadata.php
	 * @return bool returns true on success, but it is better to check for thrown exception,
	 * and assume success if none is thrown.
	 */
	public function delMetadata () {}

	/**
	 * (Unknown)<br/>
	 * Extract the contents of a phar archive to a directory
	 * @link http://php.net/manual/en/phar.extractto.php
	 * @param string $pathto <p>
	 * Path within an archive to the file to delete.
	 * </p>
	 * @param string|array $files [optional] <p>
	 * The name of a file or directory to extract, or an array of files/directories to extract
	 * </p>
	 * @param bool $overwrite [optional] <p>
	 * Set to true to enable overwriting existing files
	 * </p>
	 * @return bool returns true on success, but it is better to check for thrown exception,
	 * and assume success if none is thrown.
	 */
	public function extractTo ($pathto, $files = null, $overwrite = null) {}

        /**
         * @see setAlias
         * @return string
         */
        public function getAlias () {}

	public function getPath () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns phar archive meta-data
	 * @link http://php.net/manual/en/phar.getmetadata.php
	 * @return mixed any PHP variable that can be serialized and is stored as meta-data for the Phar archive,
	 * or &null; if no meta-data is stored.
	 */
	public function getMetadata () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Return whether phar was modified
	 * @link http://php.net/manual/en/phar.getmodified.php
	 * @return bool true if the phar has been modified since opened, false if not.
	 */
	public function getModified () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Return MD5/SHA1/SHA256/SHA512/OpenSSL signature of a Phar archive
	 * @link http://php.net/manual/en/phar.getsignature.php
	 * @return array Array with the opened archive's signature in hash key and MD5,
	 * SHA-1,
	 * SHA-256, SHA-512, or OpenSSL
	 * in hash_type. This signature is a hash calculated on the
	 * entire phar's contents, and may be used to verify the integrity of the archive.
	 * A valid signature is absolutely required of all executable phar archives if the
	 * phar.require_hash INI variable
	 * is set to true.
	 */
	public function getSignature () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Return the PHP loader or bootstrap stub of a Phar archive
	 * @link http://php.net/manual/en/phar.getstub.php
	 * @return string a string containing the contents of the bootstrap loader (stub) of
	 * the current Phar archive.
	 */
	public function getStub () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Return version info of Phar archive
	 * @link http://php.net/manual/en/phar.getversion.php
	 * @return string The opened archive's API version. This is not to be confused with
	 * the API version that the loaded phar extension will use to create
	 * new phars. Each Phar archive has the API version hard-coded into
	 * its manifest. See Phar file format
	 * documentation for more information.
	 */
	public function getVersion () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.2.0)<br/>
	 * Returns whether phar has global meta-data
	 * @link http://php.net/manual/en/phar.hasmetadata.php
	 * @return bool true if meta-data has been set, and false if not.
	 */
	public function hasMetadata () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Used to determine whether Phar write operations are being buffered, or are flushing directly to disk
	 * @link http://php.net/manual/en/phar.isbuffering.php
	 * @return bool true if the write operations are being buffer, false otherwise.
	 */
	public function isBuffering () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Returns Phar::GZ or PHAR::BZ2 if the entire phar archive is compressed (.tar.gz/tar.bz and so on)
	 * @link http://php.net/manual/en/phar.iscompressed.php
	 * @return mixed Phar::GZ, Phar::BZ2 or false
	 */
	public function isCompressed () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Returns true if the phar archive is based on the tar/phar/zip file format depending on the parameter
	 * @link http://php.net/manual/en/phar.isfileformat.php
	 * @param int $format <p>
	 * Either Phar::PHAR, Phar::TAR, or
	 * Phar::ZIP to test for the format of the archive.
	 * </p>
	 * @return bool true if the phar archive matches the file format requested by the parameter
	 */
	public function isFileFormat ($format) {}

	/**
	 * (Unknown)<br/>
	 * Returns true if the phar archive can be modified
	 * @link http://php.net/manual/en/phar.iswritable.php
	 * @return bool true if the phar archive can be modified
	 */
	public function isWritable () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * determines whether a file exists in the phar
	 * @link http://php.net/manual/en/phar.offsetexists.php
	 * @param string $offset <p>
	 * The filename (relative path) to look for in a Phar.
	 * </p>
	 * @return bool true if the file exists within the phar, or false if not.
	 */
	public function offsetExists ($offset) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Gets a <classname>PharFileInfo</classname> object for a specific file
	 * @link http://php.net/manual/en/phar.offsetget.php
	 * @param string $offset <p>
	 * The filename (relative path) to look for in a Phar.
	 * </p>
	 * @return int A PharFileInfo object is returned that can be used to
	 * iterate over a file's contents or to retrieve information about the current file.
	 */
	public function offsetGet ($offset) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * set the contents of an internal file to those of an external file
	 * @link http://php.net/manual/en/phar.offsetset.php
	 * @param string $offset <p>
	 * The filename (relative path) to modify in a Phar.
	 * </p>
	 * @param string $value <p>
	 * Content of the file.
	 * </p>
	 * @return void No return values.
	 */
	public function offsetSet ($offset, $value) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * remove a file from a phar
	 * @link http://php.net/manual/en/phar.offsetunset.php
	 * @param string $offset <p>
	 * The filename (relative path) to modify in a Phar.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function offsetUnset ($offset) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.2.1)<br/>
	 * Set the alias for the Phar archive
	 * @link http://php.net/manual/en/phar.setalias.php
	 * @param string $alias <p>
	 * A shorthand string that this archive can be referred to in phar
	 * stream wrapper access.
	 * </p>
	 * @return bool 
	 */
	public function setAlias ($alias) {}

	/**
	 * (Unknown)<br/>
	 * Used to set the PHP loader or bootstrap stub of a Phar archive to the default loader
	 * @link http://php.net/manual/en/phar.setdefaultstub.php
	 * @param string $index [optional] <p>
	 * Relative path within the phar archive to run if accessed on the command-line
	 * </p>
	 * @param string $webindex [optional] <p>
	 * Relative path within the phar archive to run if accessed through a web browser
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function setDefaultStub ($index = null, $webindex = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Sets phar archive meta-data
	 * @link http://php.net/manual/en/phardata.setmetadata.php
	 * @param mixed $metadata <p>
	 * Any PHP variable containing information to store that describes the phar archive
	 * </p>
	 * @return void
	 */
	public function setMetadata ($metadata) {}

    /**
     * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.1.0)<br/>
     * set the signature algorithm for a phar and apply it.
     * @link http://php.net/manual/en/phardata.setsignaturealgorithm.php
     * @param int $sigtype <p>
     * One of Phar::MD5,
     * Phar::SHA1, Phar::SHA256,
     * Phar::SHA512, or Phar::PGP (pgp not yet supported and falls back to SHA-1).
     * </p>
     * @return void
     */
	public function setSignatureAlgorithm ($sigtype) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Used to set the PHP loader or bootstrap stub of a Phar archive
	 * @link http://php.net/manual/en/phar.setstub.php
	 * @param string $stub <p>
	 * A string or an open stream handle to use as the executable stub for this
	 * phar archive.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function setStub ($stub) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Start buffering Phar write operations, do not modify the Phar object on disk
	 * @link http://php.net/manual/en/phar.startbuffering.php
	 * @return void 
	 */
	public function startBuffering () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Stop buffering write requests to the Phar archive, and save changes to disk
	 * @link http://php.net/manual/en/phar.stopbuffering.php
	 * @return void 
	 */
	public function stopBuffering () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns the api version
	 * @link http://php.net/manual/en/phar.apiversion.php
	 * @return string The API version string as in &quot;1.0.0&quot;.
	 */
	final public static function apiVersion () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns whether phar extension supports compression using either zlib or bzip2
	 * @link http://php.net/manual/en/phar.cancompress.php
	 * @param int $type [optional] <p>
	 * Either Phar::GZ or Phar::BZ2 can be
	 * used to test whether compression is possible with a specific compression
	 * algorithm (zlib or bzip2).
	 * </p>
	 * @return bool true if compression/decompression is available, false if not.
	 */
	final public static function canCompress ($type = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns whether phar extension supports writing and creating phars
	 * @link http://php.net/manual/en/phar.canwrite.php
	 * @return bool true if write access is enabled, false if it is disabled.
	 */
	final public static function canWrite () {}

	/**
	 * (Unknown)<br/>
	 * Create a phar-file format specific stub
	 * @link http://php.net/manual/en/phar.createdefaultstub.php
	 * @param string $indexfile [optional] 
	 * @param string $webindexfile [optional] 
	 * @return string a string containing the contents of a customized bootstrap loader (stub)
	 * that allows the created Phar archive to work with or without the Phar extension
	 * enabled.
	 */
	final public static function createDefaultStub ($indexfile = null, $webindexfile = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.2.0)<br/>
	 * Return array of supported compression algorithms
	 * @link http://php.net/manual/en/phar.getsupportedcompression.php
	 * @return array an array containing any of Phar::GZ or
	 * Phar::BZ2, depending on the availability of
	 * the zlib extension or the
	 * bz2 extension.
	 */
	final public static function getSupportedCompression () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.1.0)<br/>
	 * Return array of supported signature types
	 * @link http://php.net/manual/en/phar.getsupportedsignatures.php
	 * @return array an array containing any of MD5, SHA-1,
	 * SHA-256, SHA-512, or OpenSSL.
	 */
	final public static function getSupportedSignatures () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * instructs phar to intercept fopen, file_get_contents, opendir, and all of the stat-related functions
	 * @link http://php.net/manual/en/phar.interceptfilefuncs.php
	 * @return void 
	 */
	final public static function interceptFileFuncs () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.2.0)<br/>
	 * Returns whether the given filename is a valid phar filename
	 * @link http://php.net/manual/en/phar.isvalidpharfilename.php
	 * @param string $filename <p>
	 * The name or full path to a phar archive not yet created
	 * </p>
	 * @param bool $executable [optional] <p>
	 * This parameter determines whether the filename should be treated as
	 * a phar executable archive, or a data non-executable archive
	 * </p>
	 * @return bool true if the filename is valid, false if not.
	 */
	final public static function isValidPharFilename ($filename, $executable = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Loads any phar archive with an alias
	 * @link http://php.net/manual/en/phar.loadphar.php
	 * @param string $filename <p>
	 * the full or relative path to the phar archive to open
	 * </p>
	 * @param string $alias [optional] <p>
	 * The alias that may be used to refer to the phar archive. Note
	 * that many phar archives specify an explicit alias inside the
	 * phar archive, and a PharException will be thrown if
	 * a new alias is specified in this case.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	final public static function loadPhar ($filename, $alias = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Reads the currently executed file (a phar) and registers its manifest
	 * @link http://php.net/manual/en/phar.mapphar.php
	 * @param string $alias [optional] <p>
	 * The alias that can be used in phar:// URLs to
	 * refer to this archive, rather than its full path.
	 * </p>
	 * @param int $dataoffset [optional] <p>
	 * Unused variable, here for compatibility with PEAR's PHP_Archive.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	final public static function mapPhar ($alias = null, $dataoffset = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Returns the full path on disk or full phar URL to the currently executing Phar archive
	 * @link http://php.net/manual/en/phar.running.php
	 * @param bool $retphar [optional] <p>
	 * If false, the full path on disk to the phar
	 * archive is returned. If true, a full phar URL is returned.
	 * </p>
	 * @return string the filename if valid, empty string otherwise.
	 */
	final public static function running ($retphar = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Mount an external path or file to a virtual location within the phar archive
	 * @link http://php.net/manual/en/phar.mount.php
	 * @param string $pharpath <p>
	 * The internal path within the phar archive to use as the mounted path location.
	 * If executed within a phar archive, this may be a relative path, otherwise this must
	 * be a full phar URL.
	 * </p>
	 * @param string $externalpath <p>
	 * A path or URL to an external file or directory to mount within the phar archive
	 * </p>
	 * @return void No return. PharException is thrown on failure.
	 */
	final public static function mount ($pharpath, $externalpath) {}

	/**
	 * (Unknown)<br/>
	 * Defines a list of up to 4 $_SERVER variables that should be modified for execution
	 * @link http://php.net/manual/en/phar.mungserver.php
	 * @param array $munglist <p>
	 * an array containing as string indices any of
	 * REQUEST_URI, PHP_SELF,
	 * SCRIPT_NAME and SCRIPT_FILENAME.
	 * Other values trigger an exception, and Phar::mungServer
	 * is case-sensitive.
	 * </p>
	 * @return void No return.
	 */
	final public static function mungServer (array $munglist ) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Completely remove a phar archive from disk and from memory
	 * @link http://php.net/manual/en/phar.unlinkarchive.php
	 * @param string $archive <p>
	 * The path on disk to the phar archive.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	final public static function unlinkArchive ($archive) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * mapPhar for web-based phars. front controller for web applications
	 * @link http://php.net/manual/en/phar.webphar.php
	 * @param string $alias [optional] <p>
	 * The alias that can be used in phar:// URLs to
	 * refer to this archive, rather than its full path.
	 * </p>
	 * @param string $index [optional] <p>
	 * The location within the phar of the directory index.
	 * </p>
	 * @param string $f404 [optional] <p>
	 * The location of the script to run when a file is not found. This
	 * script should output the proper HTTP 404 headers.
	 * </p>
	 * @param array $mimetypes [optional] <p>
	 * An array mapping additional file extensions to MIME type. By default,
	 * these extensions are mapped to these mime types:
	 * 2, // pass to highlight_file()
	 * 'c' => 'text/plain',
	 * 'cc' => 'text/plain',
	 * 'cpp' => 'text/plain',
	 * 'c++' => 'text/plain',
	 * 'dtd' => 'text/plain',
	 * 'h' => 'text/plain',
	 * 'log' => 'text/plain',
	 * 'rng' => 'text/plain',
	 * 'txt' => 'text/plain',
	 * 'xsd' => 'text/plain',
	 * 'php' => 1, // parse as PHP
	 * 'inc' => 1, // parse as PHP
	 * 'avi' => 'video/avi',
	 * 'bmp' => 'image/bmp',
	 * 'css' => 'text/css',
	 * 'gif' => 'image/gif',
	 * 'htm' => 'text/html',
	 * 'html' => 'text/html',
	 * 'htmls' => 'text/html',
	 * 'ico' => 'image/x-ico',
	 * 'jpe' => 'image/jpeg',
	 * 'jpg' => 'image/jpeg',
	 * 'jpeg' => 'image/jpeg',
	 * 'js' => 'application/x-javascript',
	 * 'midi' => 'audio/midi',
	 * 'mid' => 'audio/midi',
	 * 'mod' => 'audio/mod',
	 * 'mov' => 'movie/quicktime',
	 * 'mp3' => 'audio/mp3',
	 * 'mpg' => 'video/mpeg',
	 * 'mpeg' => 'video/mpeg',
	 * 'pdf' => 'application/pdf',
	 * 'png' => 'image/png',
	 * 'swf' => 'application/shockwave-flash',
	 * 'tif' => 'image/tiff',
	 * 'tiff' => 'image/tiff',
	 * 'wav' => 'audio/wav',
	 * 'xbm' => 'image/xbm',
	 * 'xml' => 'text/xml',
	 * );
	 * ?>
	 * ]]>
	 * </p>
	 * @param array $rewrites [optional] <p>
	 * An array mapping URI to internal file, simulating mod_rewrite of apache.
	 * For example:
	 * 'myinfo.php'
	 * );
	 * ?>
	 * ]]>
	 * would route calls to http://&lt;host&gt;/myphar.phar/myinfo
	 * to the file phar:///path/to/myphar.phar/myinfo.php, preserving
	 * GET/POST. This does not quite work like mod_rewrite in that it would not
	 * match http://&lt;host&gt;/myphar.phar/myinfo/another.
	 * </p>
	 * @return void 
	 */
	final public static function webPhar ($alias = null, $index = null, $f404 = null, array $mimetypes = null, array $rewrites = null) {}

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

	/**
	 * (PHP 5)<br/>
	 * Return file name of current DirectoryIterator item.
	 * @link http://php.net/manual/en/directoryiterator.getfilename.php
	 * @return string the file name of the current DirectoryIterator item.
	 */
	public function getFilename () {}

	/**
	 * (PHP 5 &gt;= 5.2.2)<br/>
	 * Get base name of current DirectoryIterator item.
	 * @link http://php.net/manual/en/directoryiterator.getbasename.php
	 * @param string $suffix [optional] <p>
	 * If the base name ends in suffix, 
	 * this will be cut.
	 * </p>
	 * @return string The base name of the current DirectoryIterator item.
	 */
	public function getBasename ($suffix = null) {}

	/**
	 * (PHP 5.1.0)<br/>
	 * Determine if current DirectoryIterator item is '.' or '..'
	 * @link http://php.net/manual/en/directoryiterator.isdot.php
	 * @return bool true if the entry is . or ..,
	 * otherwise false
	 */
	public function isDot () {}

	/**
	 * (PHP 5)<br/>
	 * Check whether current DirectoryIterator position is a valid file
	 * @link http://php.net/manual/en/directoryiterator.valid.php
	 * @return bool true if the position is valid, otherwise false
	 */
	public function valid () {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Seek to a DirectoryIterator item
	 * @link http://php.net/manual/en/directoryiterator.seek.php
	 * @param int $position <p>
	 * The zero-based numeric position to seek to.
	 * </p>
	 * @return void 
	 */
	public function seek ($position) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Get file name as a string
	 * @link http://php.net/manual/en/directoryiterator.tostring.php
	 * @return string the file name of the current DirectoryIterator item.
	 */
	public function __toString () {}

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
	 * Name of an SplFileInfo derived class to use. 
	 * </p>
	 * @return SplFileInfo An SplFileInfo object created for the file.
	 */
	public function getFileInfo ($class_name = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.2)<br/>
	 * Gets an SplFileInfo object for the path
	 * @link http://php.net/manual/en/splfileinfo.getpathinfo.php
	 * @param string $class_name [optional] <p>
	 * Name of an SplFileInfo derived class to use.
	 * </p>
	 * @return SplFileInfo an SplFileInfo object for the parent path of the file.
	 */
	public function getPathInfo ($class_name = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.2)<br/>
	 * Gets an SplFileObject object for the file
	 * @link http://php.net/manual/en/splfileinfo.openfile.php
	 * @param string $open_mode [optional] <p>
	 * The mode for opening the file. See the fopen
	 * documentation for descriptions of possible modes. The default 
	 * is read only.
	 * </p>
	 * @param bool $use_include_path [optional] <p>
	 * &parameter.use_include_path;
	 * </p>
	 * @param resource $context [optional] <p>
	 * &parameter.context;
	 * </p>
	 * @return SplFileObject The opened file as an SplFileObject object.
	 */
	public function openFile ($open_mode = null, $use_include_path = null, $context = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.2)<br/>
	 * Sets the class name used with <methodname>SplFileInfo::openFile</methodname>
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
 * The PharData class provides a high-level interface to accessing and creating
 * non-executable tar and zip archives. Because these archives do not contain
 * a stub and cannot be executed by the phar extension, it is possible to create
 * and manipulate regular zip and tar files using the PharData class even if
 * phar.readonly php.ini setting is 1.
 * @link http://php.net/manual/en/class.PharData.php
 */
class PharData extends RecursiveDirectoryIterator implements RecursiveIterator, SeekableIterator, Traversable, Iterator, Countable, ArrayAccess {

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Construct a non-executable tar or zip archive object
	 * @link http://php.net/manual/en/phardata.construct.php
	 * @param string $fname <p>
	 * Path to an existing tar/zip archive or to-be-created archive
	 * </p>
	 * @param int $flags [optional] <p>
	 * Flags to pass to Phar parent class RecursiveDirectoryIterator.
	 * </p>
	 * @return void 
	 */
	public function __construct ($fname, $flags = null) {}

	public function __destruct () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Add an empty directory to the tar/zip archive
	 * @link http://php.net/manual/en/phardata.addemptydir.php
	 * @param string $dirname <p>
	 * The name of the empty directory to create in the phar archive
	 * </p>
	 * @return bool no return value, exception is thrown on failure.
	 */
	public function addEmptyDir ($dirname) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Add a file from the filesystem to the tar/zip archive
	 * @link http://php.net/manual/en/phardata.addfile.php
	 * @param string $file <p>
	 * Full or relative path to a file on disk to be added
	 * to the phar archive.
	 * </p>
	 * @param string $localname [optional] <p>
	 * Path that the file will be stored in the archive.
	 * </p>
	 * @return void no return value, exception is thrown on failure.
	 */
	public function addFile ($file, $localname = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Add a file from the filesystem to the tar/zip archive
	 * @link http://php.net/manual/en/phardata.addfromstring.php
	 * @param string $localname <p>
	 * Path that the file will be stored in the archive.
	 * </p>
	 * @param string $contents <p>
	 * The file contents to store
	 * </p>
	 * @return bool no return value, exception is thrown on failure.
	 */
	public function addFromString ($localname, $contents) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Construct a tar/zip archive from the files within a directory.
	 * @link http://php.net/manual/en/phardata.buildfromdirectory.php
	 * @param string $base_dir <p>
	 * The full or relative path to the directory that contains all files
	 * to add to the archive.
	 * </p>
	 * @param string $regex [optional] <p>
	 * An optional pcre regular expression that is used to filter the
	 * list of files. Only file paths matching the regular expression
	 * will be included in the archive.
	 * </p>
	 * @return array Phar::buildFromDirectory returns an associative array
	 * mapping internal path of file to the full path of the file on the
	 * filesystem.
	 */
	public function buildFromDirectory ($base_dir, $regex = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Construct a tar or zip archive from an iterator.
	 * @link http://php.net/manual/en/phardata.buildfromiterator.php
	 * @param Iterator $iter <p>
	 * Any iterator that either associatively maps tar/zip file to location or
	 * returns SplFileInfo objects
	 * </p>
	 * @param string $base_directory [optional] <p>
	 * For iterators that return SplFileInfo objects, the portion of each
	 * file's full path to remove when adding to the tar/zip archive
	 * </p>
	 * @return array PharData::buildFromIterator returns an associative array
	 * mapping internal path of file to the full path of the file on the
	 * filesystem.
	 */
	public function buildFromIterator ($iter, $base_directory = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Compresses all files in the current tar/zip archive
	 * @link http://php.net/manual/en/phardata.compressfiles.php
	 * @param int $compression <p>
	 * Compression must be one of Phar::GZ,
	 * Phar::BZ2 to add compression, or Phar::NONE
	 * to remove compression.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function compressFiles ($compression) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Decompresses all files in the current zip archive
	 * @link http://php.net/manual/en/phardata.decompressfiles.php
	 * @return bool true on success or false on failure.
	 */
	public function decompressFiles () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Compresses the entire tar/zip archive using Gzip or Bzip2 compression
	 * @link http://php.net/manual/en/phardata.compress.php
	 * @param int $compression <p>
	 * Compression must be one of Phar::GZ,
	 * Phar::BZ2 to add compression, or Phar::NONE
	 * to remove compression.
	 * </p>
	 * @param string $extension [optional] <p>
	 * By default, the extension is .tar.gz or .tar.bz2
	 * for compressing a tar, and .tar for decompressing.
	 * </p>
	 * @return object A PharData object is returned.
	 */
	public function compress ($compression, $extension) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Decompresses the entire Phar archive
	 * @link http://php.net/manual/en/phardata.decompress.php
	 * @param string $extension [optional] <p>
	 * For decompressing, the default file extension
	 * is .phar.tar.
	 * Use this parameter to specify another file extension. Be aware
	 * that no non-executable archives cannot contain .phar
	 * in their filename.
	 * </p>
	 * @return object A PharData object is returned.
	 */
	public function decompress ($extension = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Convert a non-executable tar/zip archive to an executable phar archive
	 * @link http://php.net/manual/en/phardata.converttoexecutable.php
	 * @param int $format [optional] <p>
	 * This should be one of Phar::PHAR, Phar::TAR,
	 * or Phar::ZIP. If set to &null;, the existing file format
	 * will be preserved.
	 * </p>
	 * @param int $compression [optional] <p>
	 * This should be one of Phar::NONE for no whole-archive
	 * compression, Phar::GZ for zlib-based compression, and
	 * Phar::BZ2 for bzip-based compression.
	 * </p>
	 * @param string $extension [optional] <p>
	 * This parameter is used to override the default file extension for a
	 * converted archive. Note that all zip- and tar-based phar archives must contain
	 * .phar in their file extension in order to be processed as a
	 * phar archive.
	 * </p>
	 * <p>
	 * If converting to a phar-based archive, the default extensions are
	 * .phar, .phar.gz, or .phar.bz2
	 * depending on the specified compression. For tar-based phar archives, the
	 * default extensions are .phar.tar, .phar.tar.gz,
	 * and .phar.tar.bz2. For zip-based phar archives, the
	 * default extension is .phar.zip.
	 * </p>
	 * @return Phar The method returns a Phar object on success and throws an
	 * exception on failure.
	 */
	public function convertToExecutable ($format = null, $compression = null, $extension = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Convert a phar archive to a non-executable tar or zip file
	 * @link http://php.net/manual/en/phardata.converttodata.php
	 * @param int $format [optional] <p>
	 * This should be one of Phar::TAR
	 * or Phar::ZIP. If set to &null;, the existing file format
	 * will be preserved.
	 * </p>
	 * @param int $compression [optional] <p>
	 * This should be one of Phar::NONE for no whole-archive
	 * compression, Phar::GZ for zlib-based compression, and
	 * Phar::BZ2 for bzip-based compression.
	 * </p>
	 * @param string $extension [optional] <p>
	 * This parameter is used to override the default file extension for a
	 * converted archive. Note that .phar cannot be used
	 * anywhere in the filename for a non-executable tar or zip archive.
	 * </p>
	 * <p>
	 * If converting to a tar-based phar archive, the
	 * default extensions are .tar, .tar.gz,
	 * and .tar.bz2 depending on specified compression.
	 * For zip-based archives, the
	 * default extension is .zip.
	 * </p>
	 * @return PharData The method returns a PharData object on success and throws an
	 * exception on failure.
	 */
	public function convertToData ($format = null, $compression = null, $extension = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Copy a file internal to the phar archive to another new file within the phar
	 * @link http://php.net/manual/en/phardata.copy.php
	 * @param string $oldfile <p>
	 * </p>
	 * @param string $newfile <p>
	 * </p>
	 * @return bool returns true on success, but it is safer to encase method call in a
	 * try/catch block and assume success if no exception is thrown.
	 */
	public function copy ($oldfile, $newfile) {}

	public function count () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Delete a file within a tar/zip archive
	 * @link http://php.net/manual/en/phardata.delete.php
	 * @param string $entry <p>
	 * Path within an archive to the file to delete.
	 * </p>
	 * @return int returns true on success, but it is better to check for thrown exception,
	 * and assume success if none is thrown.
	 */
	public function delete ($entry) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Deletes the global metadata of a zip archive
	 * @link http://php.net/manual/en/phardata.delmetadata.php
	 * @return int returns true on success, but it is better to check for thrown exception,
	 * and assume success if none is thrown.
	 */
	public function delMetadata () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Extract the contents of a tar/zip archive to a directory
	 * @link http://php.net/manual/en/phardata.extractto.php
	 * @param string $pathto <p>
	 * Path within an archive to the file to delete.
	 * </p>
	 * @param string|array $files [optional] <p>
	 * The name of a file or directory to extract, or an array of files/directories to extract
	 * </p>
	 * @param bool $overwrite [optional] <p>
	 * Set to true to enable overwriting existing files
	 * </p>
	 * @return int returns true on success, but it is better to check for thrown exception,
	 * and assume success if none is thrown.
	 */
	public function extractTo ($pathto, $files = null, $overwrite = null) {}

    /**
     * @see setAlias
     * @return string
     */
    public function getAlias () {}

	public function getPath () {}

	public function getMetadata () {}

	public function getModified () {}

	public function getSignature () {}

	public function getStub () {}

	public function getVersion () {}

	public function hasMetadata () {}

	public function isBuffering () {}

	public function isCompressed () {}

	/**
	 * @param $fileformat
	 */
	public function isFileFormat ($fileformat) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Returns true if the tar/zip archive can be modified
	 * @link http://php.net/manual/en/phardata.iswritable.php
	 * @return bool true if the tar/zip archive can be modified
	 */
	public function isWritable () {}

	/**
	 * @param $entry
	 */
	public function offsetExists ($entry) {}

	/**
	 * @param $entry
	 */
	public function offsetGet ($entry) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * set the contents of a file within the tar/zip to those of an external file or string
	 * @link http://php.net/manual/en/phardata.offsetset.php
	 * @param string $offset <p>
	 * The filename (relative path) to modify in a tar or zip archive.
	 * </p>
	 * @param string $value <p>
	 * Content of the file.
	 * </p>
	 * @return void No return values.
	 */
	public function offsetSet ($offset, $value) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * remove a file from a tar/zip archive
	 * @link http://php.net/manual/en/phardata.offsetunset.php
	 * @param string $offset <p>
	 * The filename (relative path) to modify in the tar/zip archive.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function offsetUnset ($offset) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * dummy function (Phar::setAlias is not valid for PharData)
	 * @link http://php.net/manual/en/phardata.setalias.php
	 * @param string $alias <p>
	 * A shorthand string that this archive can be referred to in phar
	 * stream wrapper access. This parameter is ignored.
	 * </p>
	 * @return bool 
	 */
	public function setAlias ($alias) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * dummy function (Phar::setDefaultStub is not valid for PharData)
	 * @link http://php.net/manual/en/phardata.setdefaultstub.php
	 * @param string $index [optional] <p>
	 * Relative path within the phar archive to run if accessed on the command-line
	 * </p>
	 * @param string $webindex [optional] <p>
	 * Relative path within the phar archive to run if accessed through a web browser
	 * </p>
	 * @return void 
	 */
	public function setDefaultStub ($index = null, $webindex = null) {}

	/**
	 * @param $metadata
	 */
	public function setMetadata ($metadata) {}

	/**
	 * @param $algorithm
	 * @param $privatekey [optional]
	 */
	public function setSignatureAlgorithm ($algorithm, $privatekey) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * dummy function (Phar::setStub is not valid for PharData)
	 * @link http://php.net/manual/en/phardata.setstub.php
	 * @param string $stub <p>
	 * A string or an open stream handle to use as the executable stub for this
	 * phar archive. This parameter is ignored.
	 * </p>
	 * @return void 
	 */
	public function setStub ($stub) {}

	public function startBuffering () {}

	public function stopBuffering () {}

	final public static function apiVersion () {}

	final public static function canCompress () {}

	final public static function canWrite () {}

	/**
	 * @param $index [optional]
	 * @param $webindex [optional]
	 */
	final public static function createDefaultStub ($index, $webindex) {}

	final public static function getSupportedCompression () {}

	final public static function getSupportedSignatures () {}

	final public static function interceptFileFuncs () {}

	final public static function isValidPharFilename () {}

	/**
	 * @param $filename
	 * @param $alias [optional]
	 */
	final public static function loadPhar ($filename, $alias) {}

	/**
	 * @param $alias [optional]
	 * @param $offset [optional]
	 */
	final public static function mapPhar ($alias, $offset) {}

	/**
	 * @param $retphar
	 */
	final public static function running ($retphar) {}

	/**
	 * @param $inphar
	 * @param $externalfile
	 */
	final public static function mount ($inphar, $externalfile) {}

	/**
	 * @param $munglist
	 */
	final public static function mungServer ($munglist) {}

	/**
	 * @param $archive
	 */
	final public static function unlinkArchive ($archive) {}

	/**
	 * @param $alias [optional]
	 * @param $index [optional]
	 * @param $f404 [optional]
	 * @param $mimetypes [optional]
	 * @param $rewrites [optional]
	 */
	final public static function webPhar ($alias, $index, $f404, $mimetypes, $rewrites) {}

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

	/**
	 * (PHP 5)<br/>
	 * Return file name of current DirectoryIterator item.
	 * @link http://php.net/manual/en/directoryiterator.getfilename.php
	 * @return string the file name of the current DirectoryIterator item.
	 */
	public function getFilename () {}

	/**
	 * (PHP 5 &gt;= 5.2.2)<br/>
	 * Get base name of current DirectoryIterator item.
	 * @link http://php.net/manual/en/directoryiterator.getbasename.php
	 * @param string $suffix [optional] <p>
	 * If the base name ends in suffix, 
	 * this will be cut.
	 * </p>
	 * @return string The base name of the current DirectoryIterator item.
	 */
	public function getBasename ($suffix = null) {}

	/**
	 * (PHP 5.1.0)<br/>
	 * Determine if current DirectoryIterator item is '.' or '..'
	 * @link http://php.net/manual/en/directoryiterator.isdot.php
	 * @return bool true if the entry is . or ..,
	 * otherwise false
	 */
	public function isDot () {}

	/**
	 * (PHP 5)<br/>
	 * Check whether current DirectoryIterator position is a valid file
	 * @link http://php.net/manual/en/directoryiterator.valid.php
	 * @return bool true if the position is valid, otherwise false
	 */
	public function valid () {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Seek to a DirectoryIterator item
	 * @link http://php.net/manual/en/directoryiterator.seek.php
	 * @param int $position <p>
	 * The zero-based numeric position to seek to.
	 * </p>
	 * @return void 
	 */
	public function seek ($position) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Get file name as a string
	 * @link http://php.net/manual/en/directoryiterator.tostring.php
	 * @return string the file name of the current DirectoryIterator item.
	 */
	public function __toString () {}

}

/**
 * The PharFileInfo class provides a high-level interface to the contents
 * and attributes of a single file within a phar archive.
 * @link http://php.net/manual/en/class.PharFileInfo.php
 */
class PharFileInfo extends SplFileInfo  {

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Construct a Phar entry object
	 * @link http://php.net/manual/en/pharfileinfo.construct.php
	 * @param string $entry <p>
	 * The full url to retrieve a file. If you wish to retrieve the information
	 * for the file my/file.php from the phar boo.phar,
	 * the entry should be phar://boo.phar/my/file.php.
	 * </p>
	 * @return void 
	 */
	public function __construct ($entry) {}

	public function __destruct () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Sets file-specific permission bits
	 * @link http://php.net/manual/en/pharfileinfo.chmod.php
	 * @param int $permissions <p>
	 * permissions (see chmod)
	 * </p>
	 * @return void 
	 */
	public function chmod ($permissions) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Compresses the current Phar entry with either zlib or bzip2 compression
	 * @link http://php.net/manual/en/pharfileinfo.compress.php
	 * @param int $compression 
	 * @return bool true on success or false on failure.
	 */
	public function compress ($compression) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 2.0.0)<br/>
	 * Decompresses the current Phar entry within the phar
	 * @link http://php.net/manual/en/pharfileinfo.decompress.php
	 * @return bool true on success or false on failure.
	 */
	public function decompress () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.2.0)<br/>
	 * Deletes the metadata of the entry
	 * @link http://php.net/manual/en/pharfileinfo.delmetadata.php
	 * @return bool true if successful, false if the entry had no metadata.
	 * As with all functionality that modifies the contents of
	 * a phar, the phar.readonly INI variable
	 * must be off in order to succeed if the file is within a Phar
	 * archive. Files within PharData archives do not have
	 * this restriction.
	 */
	public function delMetadata () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns the actual size of the file (with compression) inside the Phar archive
	 * @link http://php.net/manual/en/pharfileinfo.getcompressedsize.php
	 * @return int The size in bytes of the file within the Phar archive on disk.
	 */
	public function getCompressedSize () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns CRC32 code or throws an exception if CRC has not been verified
	 * @link http://php.net/manual/en/pharfileinfo.getcrc32.php
	 * @return int The crc32 checksum of the file within the Phar archive.
	 */
	public function getCRC32 () {}

	public function getContent () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns file-specific meta-data saved with a file
	 * @link http://php.net/manual/en/pharfileinfo.getmetadata.php
	 * @return mixed any PHP variable that can be serialized and is stored as meta-data for the file,
	 * or &null; if no meta-data is stored.
	 */
	public function getMetadata () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns the Phar file entry flags
	 * @link http://php.net/manual/en/pharfileinfo.getpharflags.php
	 * @return int The Phar flags (always 0 in the current implementation)
	 */
	public function getPharFlags () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.2.0)<br/>
	 * Returns the metadata of the entry
	 * @link http://php.net/manual/en/pharfileinfo.hasmetadata.php
	 * @return bool false if no metadata is set or is &null;, true if metadata is not &null;
	 */
	public function hasMetadata () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns whether the entry is compressed
	 * @link http://php.net/manual/en/pharfileinfo.iscompressed.php
	 * @param int $compression_type [optional] <p>
	 * One of Phar::GZ or Phar::BZ2,
	 * defaults to any compression.
	 * </p>
	 * @return bool true if the file is compressed within the Phar archive, false if not.
	 */
	public function isCompressed ($compression_type = null) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Returns whether file entry has had its CRC verified
	 * @link http://php.net/manual/en/pharfileinfo.iscrcchecked.php
	 * @return bool true if the file has had its CRC verified, false if not.
	 */
	public function isCRCChecked () {}

	/**
	 * (PHP &gt;= 5.3.0, PECL phar &gt;= 1.0.0)<br/>
	 * Sets file-specific meta-data saved with a file
	 * @link http://php.net/manual/en/pharfileinfo.setmetadata.php
	 * @param mixed $metadata <p>
	 * Any PHP variable containing information to store alongside a file
	 * </p>
	 * @return void 
	 */
	public function setMetadata ($metadata) {}

}
// End of Phar v.2.0.1
?>
