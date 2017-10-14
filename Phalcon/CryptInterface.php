<?php 

namespace Phalcon {

	interface CryptInterface {

		public function setCipher($cipher);


		public function getCipher();


		public function setKey($key);


		public function getKey();


		public function encrypt($text, $key=null);


		public function decrypt($text, $key=null);


		public function encryptBase64($text, $key=null);


		public function decryptBase64($text, $key=null);


		public function getAvailableCiphers();

	}
}
