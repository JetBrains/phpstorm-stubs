<?php
/**
 * PHPStorm stub file for HASH Message Digest Framework functions.
 *
 * @link http://php.net/manual/en/book.hash.php
 */

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Generate a hash value (message digest)
 *
 * @link http://php.net/manual/en/function.hash.php
 *
 * @param string $algo       <p>
 *                           Name of selected hashing algorithm (i.e. "md5", "sha256", "haval160,4", etc..)
 *                           </p>
 * @param string $data       <p>
 *                           Message to be hashed.
 *                           </p>
 * @param bool   $raw_output [optional] <p>
 *                           When set to <b>TRUE</b>, outputs raw binary data.
 *                           <b>FALSE</b> outputs lowercase hexits.
 *                           </p>
 *
 * @return string a string containing the calculated message digest as lowercase hexits
 * unless <i>raw_output</i> is set to true in which case the raw
 * binary representation of the message digest is returned.
 */
function hash($algo, $data, $raw_output = false) { }

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Return a list of registered hashing algorithms
 *
 * @link http://php.net/manual/en/function.hash-algos.php
 * @return array a numerically indexed array containing the list of supported
 * hashing algorithms.
 */
function hash_algos() { }

/**
 * Copy hashing context
 *
 * @link  http://php.net/manual/en/function.hash-copy.php
 *
 * @param resource $context <p>
 *                          Hashing context returned by <b>hash_init</b>.
 *                          </p>
 *
 * @return resource a copy of Hashing Context resource.
 * @since 5.3.0
 */
function hash_copy($context) { }

/**
 * Timing attack safe string comparison
 *
 * @link  http://php.net/manual/en/function.hash-equals.php
 *
 * @param string $known_string <p>The string of known length to compare against</p>
 * @param string $user_string  <p>The user-supplied string</p>
 *
 * @return boolean <p>Returns <b>TRUE</b> when the two strings are equal, <b>FALSE</b> otherwise.</p>
 * @since 5.6.0
 */
function hash_equals($known_string, $user_string) { }

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Generate a hash value using the contents of a given file
 *
 * @link http://php.net/manual/en/function.hash-file.php
 *
 * @param string $algo       <p>
 *                           Name of selected hashing algorithm (i.e. "md5", "sha256", "haval160,4", etc..)
 *                           </p>
 * @param string $filename   <p>
 *                           URL describing location of file to be hashed; Supports fopen wrappers.
 *                           </p>
 * @param bool   $raw_output [optional] <p>
 *                           When set to <b>TRUE</b>, outputs raw binary data.
 *                           <b>FALSE</b> outputs lowercase hexits.
 *                           </p>
 *
 * @return string a string containing the calculated message digest as lowercase hexits
 * unless <i>raw_output</i> is set to true in which case the raw
 * binary representation of the message digest is returned.
 */
function hash_file($algo, $filename, $raw_output = false) { }

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Finalize an incremental hash and return resulting digest
 *
 * @link http://php.net/manual/en/function.hash-final.php
 *
 * @param resource $context    <p>
 *                             Hashing context returned by <b>hash_init</b>.
 *                             </p>
 * @param bool     $raw_output [optional] <p>
 *                             When set to <b>TRUE</b>, outputs raw binary data.
 *                             <b>FALSE</b> outputs lowercase hexits.
 *                             </p>
 *
 * @return string a string containing the calculated message digest as lowercase hexits
 * unless <i>raw_output</i> is set to true in which case the raw
 * binary representation of the message digest is returned.
 */
function hash_final($context, $raw_output = false) { }

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Generate a keyed hash value using the HMAC method
 *
 * @link http://php.net/manual/en/function.hash-hmac.php
 *
 * @param string $algo       <p>
 *                           Name of selected hashing algorithm (i.e. "md5", "sha256", "haval160,4", etc..) See
 *                           <b>hash_algos</b> for a list of supported algorithms.
 *                           </p>
 * @param string $data       <p>
 *                           Message to be hashed.
 *                           </p>
 * @param string $key        <p>
 *                           Shared secret key used for generating the HMAC variant of the message digest.
 *                           </p>
 * @param bool   $raw_output [optional] <p>
 *                           When set to <b>TRUE</b>, outputs raw binary data.
 *                           <b>FALSE</b> outputs lowercase hexits.
 *                           </p>
 *
 * @return string a string containing the calculated message digest as lowercase hexits
 * unless <i>raw_output</i> is set to true in which case the raw
 * binary representation of the message digest is returned.
 */
function hash_hmac($algo, $data, $key, $raw_output = false) { }

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Generate a keyed hash value using the HMAC method and the contents of a given file
 *
 * @link http://php.net/manual/en/function.hash-hmac-file.php
 *
 * @param string $algo       <p>
 *                           Name of selected hashing algorithm (i.e. "md5", "sha256", "haval160,4", etc..) See
 *                           <b>hash_algos</b> for a list of supported algorithms.
 *                           </p>
 * @param string $filename   <p>
 *                           URL describing location of file to be hashed; Supports fopen wrappers.
 *                           </p>
 * @param string $key        <p>
 *                           Shared secret key used for generating the HMAC variant of the message digest.
 *                           </p>
 * @param bool   $raw_output [optional] <p>
 *                           When set to <b>TRUE</b>, outputs raw binary data.
 *                           <b>FALSE</b> outputs lowercase hexits.
 *                           </p>
 *
 * @return string a string containing the calculated message digest as lowercase hexits
 * unless <i>raw_output</i> is set to true in which case the raw
 * binary representation of the message digest is returned.
 */
function hash_hmac_file($algo, $filename, $key, $raw_output = false) { }

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Initialize an incremental hashing context
 *
 * @link http://php.net/manual/en/function.hash-init.php
 *
 * @param string $algo    <p>
 *                        Name of selected hashing algorithm (i.e. "md5", "sha256", "haval160,4", etc..). For a
 *                        list of supported algorithms see <b>hash_algos</b>.
 *                        </p>
 * @param int    $options [optional] <p>
 *                        Optional settings for hash generation, currently supports only one option:
 *                        <b>HASH_HMAC</b>. When specified, the <i>key</i>
 *                        must be specified.
 *                        </p>
 * @param string $key     [optional] <p>
 *                        When <b>HASH_HMAC</b> is specified for <i>options</i>,
 *                        a shared secret key to be used with the HMAC hashing method must be supplied in this
 *                        parameter.
 *                        </p>
 *
 * @return resource a Hashing Context resource for use with <b>hash_update</b>,
 * <b>hash_update_stream</b>, <b>hash_update_file</b>,
 * and <b>hash_final</b>.
 */
function hash_init($algo, $options = 0, $key = null) { }

/**
 * Generate a PBKDF2 key derivation of a supplied password
 *
 * @link  http://php.net/manual/en/function.hash-pbkdf2.php
 *
 * @param $algo
 * @param $password
 * @param $salt
 * @param $iterations
 * @param $length     [optional]
 * @param $raw_output [optional]
 *
 * @return mixed a string containing the derived key as lowercase hexits unless
 * <i>raw_output</i> is set to <b>TRUE</b> in which case the raw
 * binary representation of the derived key is returned.
 * @since 5.5.0
 */
function hash_pbkdf2($algo, $password, $salt, $iterations, $length, $raw_output) { }

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Pump data into an active hashing context
 *
 * @link http://php.net/manual/en/function.hash-update.php
 *
 * @param resource $context <p>
 *                          Hashing context returned by <b>hash_init</b>.
 *                          </p>
 * @param string   $data    <p>
 *                          Message to be included in the hash digest.
 *                          </p>
 *
 * @return bool <b>TRUE</b>.
 */
function hash_update($context, $data) { }

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Pump data into an active hashing context from a file
 *
 * @link http://php.net/manual/en/function.hash-update-file.php
 *
 * @param resource $hcontext <p>
 *                           Hashing context returned by <b>hash_init</b>.
 *                           </p>
 * @param string   $filename <p>
 *                           URL describing location of file to be hashed; Supports fopen wrappers.
 *                           </p>
 * @param resource $scontext [optional] <p>
 *                           Stream context as returned by <b>stream_context_create</b>.
 *                           </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function hash_update_file($hcontext, $filename, $scontext = null) { }

/**
 * (PHP 5 &gt;= 5.1.2, PECL hash &gt;= 1.1)<br/>
 * Pump data into an active hashing context from an open stream
 *
 * @link http://php.net/manual/en/function.hash-update-stream.php
 *
 * @param resource $context <p>
 *                          Hashing context returned by <b>hash_init</b>.
 *                          </p>
 * @param resource $handle  <p>
 *                          Open file handle as returned by any stream creation function.
 *                          </p>
 * @param int      $length  [optional] <p>
 *                          Maximum number of characters to copy from <i>handle</i>
 *                          into the hashing context.
 *                          </p>
 *
 * @return int Actual number of bytes added to the hashing context from <i>handle</i>.
 */
function hash_update_stream($context, $handle, $length = -1) { }
