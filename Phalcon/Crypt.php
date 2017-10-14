<?php 

namespace Phalcon {

	/**
	 * Phalcon\Crypt
	 *
	 * Provides encryption facilities to phalcon applications
	 *
	 *<code>
	 * $crypt = new \Phalcon\Crypt();
	 *
	 * $key  = "le password";
	 * $text = "This is a secret text";
	 *
	 * $encrypted = $crypt->encrypt($text, $key);
	 *
	 * echo $crypt->decrypt($encrypted, $key);
	 *</code>
	 */
	
	class Crypt implements \Phalcon\CryptInterface {

		const PADDING_DEFAULT = 0;

		const PADDING_ANSI_X_923 = 1;

		const PADDING_PKCS7 = 2;

		const PADDING_ISO_10126 = 3;

		const PADDING_ISO_IEC_7816_4 = 4;

		const PADDING_ZERO = 5;

		const PADDING_SPACE = 6;

		protected $_key;

		protected $_padding;

		protected $_cipher;

		/**
		 * Changes the padding scheme used
		 */
		public function setPadding($scheme){ }


		/**
		 * Sets the cipher algorithm
		 */
		public function setCipher($cipher){ }


		/**
		 * Returns the current cipher
		 */
		public function getCipher(){ }


		/**
		 * Sets the encryption key
		 */
		public function setKey($key){ }


		/**
		 * Returns the encryption key
		 */
		public function getKey(){ }


		/**
		 * Pads texts before encryption
		 *
		 * @see http://www.di-mgt.com.au/cryptopad.html
		 */
		protected function _cryptPadText($text, $mode, $blockSize, $paddingType){ }


		/**
		 * Removes padding @a padding_type from @a text
		 * If the function detects that the text was not padded, it will return it unmodified
		 *
		 * @param string text Message to be unpadded
		 * @param string mode Encryption mode; unpadding is applied only in CBC or ECB mode
		 * @param int blockSize Cipher block size
		 * @param int paddingType Padding scheme
		 */
		protected function _cryptUnpadText($text, $mode, $blockSize, $paddingType){ }


		/**
		 * Encrypts a text
		 *
		 *<code>
		 * $encrypted = $crypt->encrypt("Ultra-secret text", "encrypt password");
		 *</code>
		 */
		public function encrypt($text, $key=null){ }


		/**
		 * Decrypts an encrypted text
		 *
		 *<code>
		 * echo $crypt->decrypt($encrypted, "decrypt password");
		 *</code>
		 */
		public function decrypt($text, $key=null){ }


		/**
		 * Encrypts a text returning the result as a base64 string
		 */
		public function encryptBase64($text, $key=null, $safe=null){ }


		/**
		 * Decrypt a text that is coded as a base64 string
		 */
		public function decryptBase64($text, $key=null, $safe=null){ }


		/**
		 * Returns a list of available ciphers
		 */
		public function getAvailableCiphers(){ }

	}
}
