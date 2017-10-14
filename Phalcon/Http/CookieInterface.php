<?php 

namespace Phalcon\Http {

	interface CookieInterface {

		public function setValue($value);


		public function getValue($filters=null, $defaultValue=null);


		public function send();


		public function delete();


		public function useEncryption($useEncryption);


		public function isUsingEncryption();


		public function setExpiration($expire);


		public function getExpiration();


		public function setPath($path);


		public function getName();


		public function getPath();


		public function setDomain($domain);


		public function getDomain();


		public function setSecure($secure);


		public function getSecure();


		public function setHttpOnly($httpOnly);


		public function getHttpOnly();

	}
}
