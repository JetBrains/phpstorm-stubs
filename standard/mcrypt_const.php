<?php
/**
 * PHPStorm stub file for MCrypt constants.
 *
 * @link http://php.net/manual/en/mcrypt.constants.php
 */

/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_3DES = 'tripledes';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_ARCFOUR = 'arcfour';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_ARCFOUR_IV = 'arcfour-iv';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_BLOWFISH = 'blowfish';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_BLOWFISH_COMPAT = 'blowfish-compat';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_CAST_128 = 'cast-128';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_CAST_256 = 'cast-256';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_CRYPT = 'crypt';
/**
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_DECRYPT = 1;
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_DES = 'des';
/**
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_DEV_RANDOM = 0;
/**
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_DEV_URANDOM = 1;
/**
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_ENCRYPT = 0;
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_ENIGNA = 'crypt';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_GOST = 'gost';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_IDEA = 'idea';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_LOKI97 = 'loki97';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_MARS = 'mars';
/**
 * (cipher block chaining) is especially suitable for encrypting files where the security is increased over ECB
 * significantly.
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_MODE_CBC = 'cbc';
/**
 * (cipher feedback) is the best mode for encrypting byte streams where single bytes must be encrypted.
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_MODE_CFB = 'cfb';
/**
 *  (electronic codebook) is suitable for random data, such as encrypting other keys. Since data there is short and
 *  random, the disadvantages of ECB have a favorable negative effect.
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_MODE_ECB = 'ecb';
/**
 * (output feedback, in nbit) is comparable to OFB, but more secure because it operates on the block size of the
 * algorithm.
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_MODE_NOFB = 'nofb';
/**
 *  (output feedback, in 8bit) is comparable to CFB, but can be used in applications where error propagation cannot be
 *  tolerated. It's insecure (because it operates in 8bit mode) so it is not recommended to use it.
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_MODE_OFB = 'ofb';
/**
 *  is an extra mode to include some stream algorithms like "WAKE" or "RC4".
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_MODE_STREAM = 'stream';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_PANAMA = 'panama';
/**
 * @link  http://php.net/manual/en/mcrypt.constants.php
 */
const MCRYPT_RAND = 2;
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_RC2 = 'rc2';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_RC6 = 'rc6';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_RIJNDAEL_128 = 'rijndael-128';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_RIJNDAEL_192 = 'rijndael-192';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_RIJNDAEL_256 = 'rijndael-256';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_SAFER128 = 'safer-sk128';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_SAFER64 = 'safer-sk64';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_SAFERPLUS = 'saferplus';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_SERPENT = 'serpent';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_SKIPJACK = 'skipjack';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_THREEWAY = 'threeway';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_TRIPLEDES = 'tripledes';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_TWOFISH = 'twofish';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_WAKE = 'wake';
/**
 * @link  http://php.net/manual/en/mcrypt.ciphers.php
 */
const MCRYPT_XTEA = 'xtea';
