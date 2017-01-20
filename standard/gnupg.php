<?php
/** GNUPG Constants
 * @link http://php.net/manual/en/gnupg.constants.php
 */
define('GNUPG_SIG_MODE_NORMAL', 0);
define('GNUPG_SIG_MODE_DETACH', 0);
define('GNUPG_SIG_MODE_CLEAR', 0);
define('GNUPG_VALIDITY_UNKNOWN', 0);
define('GNUPG_VALIDITY_UNDEFINED', 0);
define('GNUPG_VALIDITY_NEVER', 0);
define('GNUPG_VALIDITY_MARGINAL', 0);
define('GNUPG_VALIDITY_FULL', 0);
define('GNUPG_VALIDITY_ULTIMATE', 0);
define('GNUPG_PROTOCOL_OpenPGP', 0);
define('GNUPG_PROTOCOL_CMS', 0);
define('GNUPG_SIGSUM_VALID', 0);
define('GNUPG_SIGSUM_GREEN', 0);
define('GNUPG_SIGSUM_RED', 0);
define('GNUPG_SIGSUM_KEY_REVOKED', 0);
define('GNUPG_SIGSUM_KEY_EXPIRED', 0);
define('GNUPG_SIGSUM_KEY_MISSING', 0);
define('GNUPG_SIGSUM_SIG_EXPIRED', 0);
define('GNUPG_SIGSUM_CRL_MISSING', 0);
define('GNUPG_SIGSUM_CRL_TOO_OLD', 0);
define('GNUPG_SIGSUM_BAD_POLICY', 0);
define('GNUPG_SIGSUM_SYS_ERROR', 0);
define('GNUPG_ERROR_WARNING', 0);
define('GNUPG_ERROR_EXCEPTION', 0);
define('GNUPG_ERROR_SILENT', 0);

/**
 * GNUPG Encryption Class
 * @link http://php.net/manual/en/book.gnupg.php
 * Class gnupg
 */

class gnupg {
	/**
	 * Add a key for decryption
	 * @link http://php.net/manual/en/function.gnupg-adddecryptkey.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $fingerprint
	 * @param string $passphrase
	 *
	 * @return bool 
	 */
	function gnupg_adddecryptkey($identifier, $fingerprint, $passphrase)
	{
	}

	/**
	 * Verifies a signed text
	 * @link http://php.net/manual/en/function.gnupg-verify.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $signed_text
	 * @param string $signature
	 * @param string $plaintext
	 *
	 * @return array On success, this function returns information about the signature.
	 *               On failure, this function returns false.
	 */
	function gnupg_verify($identifier, $signed_text, $signature, &$plaintext = NULL)
	{
	}

	/**
	 * Add a key for encryption
	 * @link http://php.net/manual/en/function.gnupg-addencryptkey.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $fingerprint
	 *
	 * @return bool 
	 */
	function gnupg_addencryptkey($identifier, $fingerprint)
	{
	}

	/**
	 * Add a key for signing
	 * @link http://php.net/manual/en/function.gnupg-addsignkey.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $fingerprint
	 * @param string $passphrase
	 *
	 * @return bool 
	 */
	function gnupg_addsignkey($identifier, $fingerprint, $passphrase = NULL)
	{
	}

	/**
	 * Removes all keys which were set for decryption before
	 * @link http://php.net/manual/en/function.gnupg-cleardecryptkeys.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 *
	 * @return bool 
	 */
	function gnupg_cleardecryptkeys($identifier)
	{
	}

	/**
	 * Removes all keys which were set for encryption before
	 * @link http://php.net/manual/en/function.gnupg-clearencryptkeys.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 *
	 * @return bool 
	 */
	function gnupg_clearencryptkeys($identifier)
	{
	}

	/**
	 * Removes all keys which were set for signing before
	 * @link http://php.net/manual/en/function.gnupg-clearsignkeys.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 *
	 * @return bool 
	 */
	function gnupg_clearsignkeys($identifier)
	{
	}

	/**
	 * Decrypts a given text
	 * @link http://php.net/manual/en/function.gnupg-decrypt.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $text
	 *
	 * @return string On success, this function returns the decrypted text.
	 *                On failure, this function returns false.
	 */
	function gnupg_decrypt($identifier, $text)
	{
	}

	/**
	 * Decrypts and verifies a given text
	 * @link http://php.net/manual/en/function.gnupg-decryptverify.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $text
	 * @param string $plaintext
	 *
	 * @return array On success, this function returns information about the signature and
	 *               fills the  parameter with the decrypted text.
	 *               On failure, this function returns false.
	 */
	function gnupg_decryptverify($identifier, $text, &$plaintext)
	{
	}

	/**
	 * Encrypts a given text
	 * @link http://php.net/manual/en/function.gnupg-encrypt.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $plaintext
	 *
	 * @return string On success, this function returns the encrypted text.
	 *                On failure, this function returns false.
	 */
	function gnupg_encrypt($identifier, $plaintext)
	{
	}

	/**
	 * Encrypts and signs a given text
	 * @link http://php.net/manual/en/function.gnupg-encryptsign.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $plaintext
	 *
	 * @return string On success, this function returns the encrypted and signed text.
	 *                On failure, this function returns false.
	 */
	function gnupg_encryptsign($identifier, $plaintext)
	{
	}

	/**
	 * Exports a key
	 * @link http://php.net/manual/en/function.gnupg-export.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $fingerprint
	 *
	 * @return string On success, this function returns the keydata.
	 *                On failure, this function returns false.
	 */
	function gnupg_export($identifier, $fingerprint)
	{
	}

	/**
	 * Returns the errortext, if a function fails
	 * @link http://php.net/manual/en/function.gnupg-geterror.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 *
	 * @return string Returns an errortext, if an error has occurred, otherwise false.
	 */
	function gnupg_geterror($identifier)
	{
	}

	/**
	 * Returns the currently active protocol for all operations
	 * @link http://php.net/manual/en/function.gnupg-getprotocol.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 *
	 * @return int Returns the currently active protocol, which can be one of
	 *             or
	 *             .
	 */
	function gnupg_getprotocol($identifier)
	{
	}

	/**
	 * Imports a key
	 * @link http://php.net/manual/en/function.gnupg-import.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $keydata
	 *
	 * @return array On success, this function returns and info-array about the importprocess.
	 *               On failure, this function returns false.
	 */
	function gnupg_import($identifier, $keydata)
	{
	}

	/**
	 * Initialize a connection
	 * @link http://php.net/manual/en/function.gnupg-init.php
	 * @phpstub
	 *
	 * @return resource A GnuPG ``resource`` connection used by other GnuPG functions.
	 */
	function gnupg_init()
	{
	}

	/**
	 * Returns an array with information about all keys that matches the given pattern
	 * @link http://php.net/manual/en/function.gnupg-keyinfo.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $pattern
	 *
	 * @return array Returns an array with information about all keys that matches the given
	 *               pattern or false, if an error has occurred.
	 */
	function gnupg_keyinfo($identifier, $pattern)
	{
	}

	/**
	 * Toggle armored output
	 * @link http://php.net/manual/en/function.gnupg-setarmor.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param int $armor
	 *
	 * @return bool 
	 */
	function gnupg_setarmor($identifier, $armor)
	{
	}

	/**
	 * Sets the mode for error_reporting
	 * @link http://php.net/manual/en/function.gnupg-seterrormode.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param int $errormode
	 *
	 * @return void 
	 */
	function gnupg_seterrormode($identifier, $errormode)
	{
	}

	/**
	 * Sets the mode for signing
	 * @link http://php.net/manual/en/function.gnupg-setsignmode.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param int $signmode
	 *
	 * @return bool 
	 */
	function gnupg_setsignmode($identifier, $signmode)
	{
	}

	/**
	 * Signs a given text
	 * @link http://php.net/manual/en/function.gnupg-sign.php
	 * @phpstub
	 *
	 * @param resource $identifier
	 * @param string $plaintext
	 *
	 * @return string On success, this function returns the signed text or the signature.
	 *                On failure, this function returns false.
	 */
	function gnupg_sign($identifier, $plaintext)
	{
	}

}


