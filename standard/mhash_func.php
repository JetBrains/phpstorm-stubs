<?php
/**
 * PHPStorm stub file for Mhash functions.
 *
 * @link http://php.net/manual/en/book.mhash.php
 */

/**
 * Computes hash
 *
 * @link  http://php.net/manual/en/function.mhash.php
 *
 * @param int    $hash <p>
 *                     The hash ID. One of the <b>MHASH_hashname</b> constants.
 *                     </p>
 * @param string $data <p>
 *                     The user input, as a string.
 *                     </p>
 * @param string $key  [optional] <p>
 *                     If specified, the function will return the resulting HMAC instead.
 *                     HMAC is keyed hashing for message authentication, or simply a message
 *                     digest that depends on the specified key. Not all algorithms
 *                     supported in mhash can be used in HMAC mode.
 *                     </p>
 *
 * @return string the resulting hash (also called digest) or HMAC as a string, or
 * <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function mhash($hash, $data, $key = null) { }

/**
 * Gets the highest available hash ID
 *
 * @link  http://php.net/manual/en/function.mhash-count.php
 * @return int the highest available hash ID. Hashes are numbered from 0 to this
 * hash ID.
 * @since 4.0
 * @since 5.0
 */
function mhash_count() { }

/**
 * Gets the block size of the specified hash
 *
 * @link  http://php.net/manual/en/function.mhash-get-block-size.php
 *
 * @param int $hash <p>
 *                  The hash ID. One of the <b>MHASH_hashname</b> constants.
 *                  </p>
 *
 * @return int the size in bytes or <b>FALSE</b>, if the <i>hash</i>
 * does not exist.
 * @since 4.0
 * @since 5.0
 */
function mhash_get_block_size($hash) { }

/**
 * Gets the name of the specified hash
 *
 * @link  http://php.net/manual/en/function.mhash-get-hash-name.php
 *
 * @param int $hash <p>
 *                  The hash ID. One of the <b>MHASH_hashname</b> constants.
 *                  </p>
 *
 * @return string the name of the hash or <b>FALSE</b>, if the hash does not exist.
 * @since 4.0
 * @since 5.0
 */
function mhash_get_hash_name($hash) { }

/**
 * Generates a key
 *
 * @link  http://php.net/manual/en/function.mhash-keygen-s2k.php
 *
 * @param int    $hash     <p>
 *                         The hash ID used to create the key.
 *                         One of the <b>MHASH_hashname</b> constants.
 *                         </p>
 * @param string $password <p>
 *                         An user supplied password.
 *                         </p>
 * @param string $salt     <p>
 *                         Must be different and random enough for every key you generate in
 *                         order to create different keys. Because <i>salt</i>
 *                         must be known when you check the keys, it is a good idea to append
 *                         the key to it. Salt has a fixed length of 8 bytes and will be padded
 *                         with zeros if you supply less bytes.
 *                         </p>
 * @param int    $bytes    <p>
 *                         The key length, in bytes.
 *                         </p>
 *
 * @return string the generated key as a string, or <b>FALSE</b> on error.
 * @since 4.0.4
 * @since 5.0
 */
function mhash_keygen_s2k($hash, $password, $salt, $bytes) { }

