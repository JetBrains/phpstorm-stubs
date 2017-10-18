<?php 

namespace Phalcon\Security {

	/**
	 * Phalcon\Security\Random
	 *
	 * Secure random number generator class.
	 *
	 * Provides secure random number generator which is suitable for generating
	 * session key in HTTP cookies, etc.
	 *
	 * It supports following secure random number generators:
	 *
	 * - random_bytes (PHP 7)
	 * - libsodium
	 * - openssl, libressl
	 * - /dev/urandom
	 *
	 * `Phalcon\Security\Random` could be mainly useful for:
	 *
	 * - Key generation (e.g. generation of complicated keys)
	 * - Generating random passwords for new user accounts
	 * - Encryption systems
	 *
	 *<code>
	 * $random = new \Phalcon\Security\Random();
	 *
	 * // Random binary string
	 * $bytes = $random->bytes();
	 *
	 * // Random hex string
	 * echo $random->hex(10); // a29f470508d5ccb8e289
	 * echo $random->hex(10); // 533c2f08d5eee750e64a
	 * echo $random->hex(11); // f362ef96cb9ffef150c9cd
	 * echo $random->hex(12); // 95469d667475125208be45c4
	 * echo $random->hex(13); // 05475e8af4a34f8f743ab48761
	 *
	 * // Random base62 string
	 * echo $random->base62(); // z0RkwHfh8ErDM1xw
	 *
	 * // Random base64 string
	 * echo $random->base64(12); // XfIN81jGGuKkcE1E
	 * echo $random->base64(12); // 3rcq39QzGK9fUqh8
	 * echo $random->base64();   // DRcfbngL/iOo9hGGvy1TcQ==
	 * echo $random->base64(16); // SvdhPcIHDZFad838Bb0Swg==
	 *
	 * // Random URL-safe base64 string
	 * echo $random->base64Safe();           // PcV6jGbJ6vfVw7hfKIFDGA
	 * echo $random->base64Safe();           // GD8JojhzSTrqX7Q8J6uug
	 * echo $random->base64Safe(8);          // mGyy0evy3ok
	 * echo $random->base64Safe(null, true); // DRrAgOFkS4rvRiVHFefcQ==
	 *
	 * // Random UUID
	 * echo $random->uuid(); // db082997-2572-4e2c-a046-5eefe97b1235
	 * echo $random->uuid(); // da2aa0e2-b4d0-4e3c-99f5-f5ef62c57fe2
	 * echo $random->uuid(); // 75e6b628-c562-4117-bb76-61c4153455a9
	 * echo $random->uuid(); // dc446df1-0848-4d05-b501-4af3c220c13d
	 *
	 * // Random number between 0 and $len
	 * echo $random->number(256); // 84
	 * echo $random->number(256); // 79
	 * echo $random->number(100); // 29
	 * echo $random->number(300); // 40
	 *
	 * // Random base58 string
	 * echo $random->base58();   // 4kUgL2pdQMSCQtjE
	 * echo $random->base58();   // Umjxqf7ZPwh765yR
	 * echo $random->base58(24); // qoXcgmw4A9dys26HaNEdCRj9
	 * echo $random->base58(7);  // 774SJD3vgP
	 *</code>
	 *
	 * This class partially borrows SecureRandom library from Ruby
	 *
	 * @link http://ruby-doc.org/stdlib-2.2.2/libdoc/securerandom/rdoc/SecureRandom.html
	 */
	
	class Random {

		/**
		 * Generates a random binary string
		 *
		 * The `Random::bytes` method returns a string and accepts as input an int
		 * representing the length in bytes to be returned.
		 *
		 * If $len is not specified, 16 is assumed. It may be larger in future.
		 * The result may contain any byte: "x00" - "xFF".
		 *
		 *<code>
		 * $random = new \Phalcon\Security\Random();
		 *
		 * $bytes = $random->bytes();
		 * var_dump(bin2hex($bytes));
		 * // Possible output: string(32) "00f6c04b144b41fad6a59111c126e1ee"
		 *</code>
		 *
		 * @throws Exception If secure random number generator is not available or unexpected partial read
		 */
		public function bytes($len=null){ }


		/**
		 * Generates a random hex string
		 *
		 * If $len is not specified, 16 is assumed. It may be larger in future.
		 * The length of the result string is usually greater of $len.
		 *
		 *<code>
		 * $random = new \Phalcon\Security\Random();
		 *
		 * echo $random->hex(10); // a29f470508d5ccb8e289
		 *</code>
		 *
		 * @throws Exception If secure random number generator is not available or unexpected partial read
		 */
		public function hex($len=null){ }


		/**
		 * Generates a random base58 string
		 *
		 * If $len is not specified, 16 is assumed. It may be larger in future.
		 * The result may contain alphanumeric characters except 0, O, I and l.
		 *
		 * It is similar to `Phalcon\Security\Random:base64` but has been modified to avoid both non-alphanumeric
		 * characters and letters which might look ambiguous when printed.
		 *
		 *<code>
		 * $random = new \Phalcon\Security\Random();
		 *
		 * echo $random->base58(); // 4kUgL2pdQMSCQtjE
		 *</code>
		 *
		 * @see    \Phalcon\Security\Random:base64
		 * @link   https://en.wikipedia.org/wiki/Base58
		 * @throws Exception If secure random number generator is not available or unexpected partial read
		 */
		public function base58($len=null){ }


		/**
		 * Generates a random base62 string
		 *
		 * If $len is not specified, 16 is assumed. It may be larger in future.
		 *
		 * It is similar to `Phalcon\Security\Random:base58` but has been modified to provide the largest value that can
		 * safely be used in URLs without needing to take extra characters into consideration because it is [A-Za-z0-9].
		 *
		 *<code>
		 * $random = new \Phalcon\Security\Random();
		 *
		 * echo $random->base62(); // z0RkwHfh8ErDM1xw
		 *</code>
		 *
		 * @see    \Phalcon\Security\Random:base58
		 * @throws Exception If secure random number generator is not available or unexpected partial read
		 */
		public function base62($len=null){ }


		/**
		 * Generates a random base64 string
		 *
		 * If $len is not specified, 16 is assumed. It may be larger in future.
		 * The length of the result string is usually greater of $len.
		 * Size formula: 4 * ($len / 3) and this need to be rounded up to a multiple of 4.
		 *
		 *<code>
		 * $random = new \Phalcon\Security\Random();
		 *
		 * echo $random->base64(12); // 3rcq39QzGK9fUqh8
		 *</code>
		 *
		 * @throws Exception If secure random number generator is not available or unexpected partial read
		 */
		public function base64($len=null){ }


		/**
		 * Generates a random URL-safe base64 string
		 *
		 * If $len is not specified, 16 is assumed. It may be larger in future.
		 * The length of the result string is usually greater of $len.
		 *
		 * By default, padding is not generated because "=" may be used as a URL delimiter.
		 * The result may contain A-Z, a-z, 0-9, "-" and "_". "=" is also used if $padding is true.
		 * See RFC 3548 for the definition of URL-safe base64.
		 *
		 *<code>
		 * $random = new \Phalcon\Security\Random();
		 *
		 * echo $random->base64Safe(); // GD8JojhzSTrqX7Q8J6uug
		 *</code>
		 *
		 * @link https://www.ietf.org/rfc/rfc3548.txt
		 * @throws Exception If secure random number generator is not available or unexpected partial read
		 */
		public function base64Safe($len=null, $padding=null){ }


		/**
		 * Generates a v4 random UUID (Universally Unique IDentifier)
		 *
		 * The version 4 UUID is purely random (except the version). It doesn't contain meaningful
		 * information such as MAC address, time, etc. See RFC 4122 for details of UUID.
		 *
		 * This algorithm sets the version number (4 bits) as well as two reserved bits.
		 * All other bits (the remaining 122 bits) are set using a random or pseudorandom data source.
		 * Version 4 UUIDs have the form xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx where x is any hexadecimal
		 * digit and y is one of 8, 9, A, or B (e.g., f47ac10b-58cc-4372-a567-0e02b2c3d479).
		 *
		 *<code>
		 * $random = new \Phalcon\Security\Random();
		 *
		 * echo $random->uuid(); // 1378c906-64bb-4f81-a8d6-4ae1bfcdec22
		 *</code>
		 *
		 * @link https://www.ietf.org/rfc/rfc4122.txt
		 * @throws Exception If secure random number generator is not available or unexpected partial read
		 */
		public function uuid(){ }


		/**
		 * Generates a random number between 0 and $len
		 *
		 * Returns an integer: 0 <= result <= $len.
		 *
		 *<code>
		 * $random = new \Phalcon\Security\Random();
		 *
		 * echo $random->number(16); // 8
		 *</code>
		 * @throws Exception If secure random number generator is not available, unexpected partial read or $len <= 0
		 */
		public function number($len){ }


		/**
		 * Generates a random string based on the number ($base) of characters ($alphabet).
		 *
		 * If $n is not specified, 16 is assumed. It may be larger in future.
		 *
		 * @throws Exception If secure random number generator is not available or unexpected partial read
		 */
		protected function base($alphabet, $base, $n=null){ }

	}
}
