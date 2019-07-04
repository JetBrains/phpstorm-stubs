<?php
/** GNUPG Constants
 * @link https://php.net/manual/en/gnupg.constants.php
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
 * @link https://php.net/manual/en/book.gnupg.php
 * Class gnupg
 */

class gnupg {
	/**
	 * Add a key for decryption
	 * @link https://php.net/manual/en/function.gnupg-adddecryptkey.php
	 * @phpstub
	 *
	 * @param string $fingerprint
	 * @param string $passphrase
	 *
	 * @return bool
	 */
	function adddecryptkey($fingerprint, $passphrase)
	{
	}

	/**
	 * Verifies a signed text
	 * @link https://php.net/manual/en/function.gnupg-verify.php
	 * @phpstub
	 *
	 * * @param string $signed_text
	 * @param string $signature
	 * @param string $plaintext
	 *
	 * @return array|false On success, this function returns information about the signature.
	 *               On failure, this function returns false.
	 */
	function verify($signed_text, $signature, &$plaintext = NULL)
	{
	}

	/**
	 * Add a key for encryption
	 * @link https://php.net/manual/en/function.gnupg-addencryptkey.php
	 * @phpstub
	 *
	 * @param string $fingerprint
	 *
	 * @return bool
	 */
	function addencryptkey($fingerprint)
	{
	}

	/**
	 * Add a key for signing
	 * @link https://php.net/manual/en/function.gnupg-addsignkey.php
	 * @phpstub
	 *
	 * @param string $fingerprint
	 * @param string $passphrase
	 *
	 * @return bool
	 */
	function addsignkey($fingerprint, $passphrase = NULL)
	{
	}

	/**
	 * Removes all keys which were set for decryption before
	 * @link https://php.net/manual/en/function.gnupg-cleardecryptkeys.php
	 * @phpstub
	 *
	 * @return bool
	 */
	function cleardecryptkeys()
	{
	}

	/**
	 * Removes all keys which were set for encryption before
	 * @link https://php.net/manual/en/function.gnupg-clearencryptkeys.php
	 * @phpstub
	 *
	 *
	 * @return bool
	 */
	function clearencryptkeys()
	{
	}

	/**
	 * Removes all keys which were set for signing before
	 * @link https://php.net/manual/en/function.gnupg-clearsignkeys.php
	 * @phpstub
	 *
	 *
	 * @return bool
	 */
	function clearsignkeys()
	{
	}

	/**
	 * Decrypts a given text
	 * @link https://php.net/manual/en/function.gnupg-decrypt.php
	 * @phpstub
	 *
	 * @param string $text
	 *
	 * @return string|false On success, this function returns the decrypted text.
	 *                On failure, this function returns false.
	 */
	function decrypt($text)
	{
	}

	/**
	 * Decrypts and verifies a given text
	 * @link https://php.net/manual/en/function.gnupg-decryptverify.php
	 * @phpstub
	 *
	 * @param string $text
	 * @param string $plaintext
	 *
	 * @return array|false On success, this function returns information about the signature and
	 *               fills the  parameter with the decrypted text.
	 *               On failure, this function returns false.
	 */
	function decryptverify($text, &$plaintext)
	{
	}

	/**
	 * Encrypts a given text
	 * @link https://php.net/manual/en/function.gnupg-encrypt.php
	 * @phpstub
	 *
	 * @param string $plaintext
	 *
	 * @return string|false On success, this function returns the encrypted text.
	 *                On failure, this function returns false.
	 */
	function encrypt($plaintext)
	{
	}

	/**
	 * Encrypts and signs a given text
	 * @link https://php.net/manual/en/function.gnupg-encryptsign.php
	 * @phpstub
	 *
	 * @param string $plaintext
	 *
	 * @return string|false On success, this function returns the encrypted and signed text.
	 *                On failure, this function returns false.
	 */
	function encryptsign($plaintext)
	{
	}

	/**
	 * Exports a key
	 * @link https://php.net/manual/en/function.gnupg-export.php
	 * @phpstub
	 *
	 * @param string $fingerprint
	 *
	 * @return string|false On success, this function returns the keydata.
	 *                On failure, this function returns false.
	 */
	function export($fingerprint)
	{
	}

	/**
	 * Returns the errortext, if a function fails
	 * @link https://php.net/manual/en/function.gnupg-geterror.php
	 * @phpstub
	 *
	 *
	 * @return string|false Returns an errortext, if an error has occurred, otherwise false.
	 */
	function geterror()
	{
	}

	/**
	 * Returns the currently active protocol for all operations
	 * @link https://php.net/manual/en/function.gnupg-getprotocol.php
	 * @phpstub
	 *
	 *
	 * @return int Returns the currently active protocol, which can be one of
	 *             or
	 *             .
	 */
	function getprotocol()
	{
	}

	/**
	 * Imports a key
	 * @link https://php.net/manual/en/function.gnupg-import.php
	 * @phpstub
	 *
	 * @param string $keydata
	 *
	 * @return array|false On success, this function returns and info-array about the importprocess.
	 *               On failure, this function returns false.
	 */
	function import($keydata)
	{
	}

	/**
	 * Initialize a connection
	 * @link https://php.net/manual/en/function.gnupg-init.php
	 * @phpstub
	 *
	 * @return resource A GnuPG ``resource`` connection used by other GnuPG functions.
	 */
	function init()
	{
	}

	/**
	 * Returns an array with information about all keys that matches the given pattern
	 * @link https://php.net/manual/en/function.gnupg-keyinfo.php
	 * @phpstub
	 *
	 * @param string $pattern
	 *
	 * @return array Returns an array with information about all keys that matches the given
	 *               pattern or false, if an error has occurred.
	 */
	function keyinfo($pattern)
	{
	}

	/**
	 * Toggle armored output
	 * @link https://php.net/manual/en/function.gnupg-setarmor.php
	 * @phpstub
	 *
	 * @param int $armor
	 *
	 * @return bool
	 */
	function setarmor($armor)
	{
	}

	/**
	 * Sets the mode for error_reporting
	 * @link https://php.net/manual/en/function.gnupg-seterrormode.php
	 * @phpstub
	 *
	 * @param int $errormode
	 *
	 * @return void
	 */
	function seterrormode($errormode)
	{
	}

	/**
	 * Sets the mode for signing
	 * @link https://php.net/manual/en/function.gnupg-setsignmode.php
	 * @phpstub
	 *
	 * @param int $signmode
	 *
	 * @return bool
	 */
	function setsignmode($signmode)
	{
	}

	/**
	 * Signs a given text
	 * @link https://php.net/manual/en/function.gnupg-sign.php
	 * @phpstub
	 *
	 * @param string $plaintext
	 *
	 * @return string|false On success, this function returns the signed text or the signature.
	 *                On failure, this function returns false.
	 */
	function sign($plaintext)
	{
	}

}


