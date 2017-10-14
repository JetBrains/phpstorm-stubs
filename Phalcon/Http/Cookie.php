<?php 

namespace Phalcon\Http {

	/**
	 * Phalcon\Http\Cookie
	 *
	 * Provide OO wrappers to manage a HTTP cookie
	 */
	
	class Cookie implements \Phalcon\Http\CookieInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_readed;

		protected $_restored;

		protected $_useEncryption;

		protected $_dependencyInjector;

		protected $_filter;

		protected $_name;

		protected $_value;

		protected $_expire;

		protected $_path;

		protected $_domain;

		protected $_secure;

		protected $_httpOnly;

		/**
		 * \Phalcon\Http\Cookie constructor
		 *
		 * @param string name
		 * @param mixed value
		 * @param int expire
		 * @param string path
		 * @param boolean secure
		 * @param string domain
		 * @param boolean httpOnly
		 */
		public function __construct($name, $value=null, $expire=null, $path=null, $secure=null, $domain=null, $httpOnly=null){ }


		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Sets the cookie's value
		 *
		 * @param string value
		 * @return \Phalcon\Http\Cookie
		 */
		public function setValue($value){ }


		/**
		 * Returns the cookie's value
		 *
		 * @param string|array filters
		 * @param string defaultValue
		 * @return mixed
		 */
		public function getValue($filters=null, $defaultValue=null){ }


		/**
		 * Sends the cookie to the HTTP client
		 * Stores the cookie definition in session
		 */
		public function send(){ }


		/**
		 * Reads the cookie-related info from the SESSION to restore the cookie as it was set
		 * This method is automatically called internally so normally you don't need to call it
		 */
		public function restore(){ }


		/**
		 * Deletes the cookie by setting an expire time in the past
		 */
		public function delete(){ }


		/**
		 * Sets if the cookie must be encrypted/decrypted automatically
		 */
		public function useEncryption($useEncryption){ }


		/**
		 * Check if the cookie is using implicit encryption
		 */
		public function isUsingEncryption(){ }


		/**
		 * Sets the cookie's expiration time
		 */
		public function setExpiration($expire){ }


		/**
		 * Returns the current expiration time
		 */
		public function getExpiration(){ }


		/**
		 * Sets the cookie's expiration time
		 */
		public function setPath($path){ }


		/**
		 * Returns the current cookie's name
		 */
		public function getName(){ }


		/**
		 * Returns the current cookie's path
		 */
		public function getPath(){ }


		/**
		 * Sets the domain that the cookie is available to
		 */
		public function setDomain($domain){ }


		/**
		 * Returns the domain that the cookie is available to
		 */
		public function getDomain(){ }


		/**
		 * Sets if the cookie must only be sent when the connection is secure (HTTPS)
		 */
		public function setSecure($secure){ }


		/**
		 * Returns whether the cookie must only be sent when the connection is secure (HTTPS)
		 */
		public function getSecure(){ }


		/**
		 * Sets if the cookie is accessible only through the HTTP protocol
		 */
		public function setHttpOnly($httpOnly){ }


		/**
		 * Returns if the cookie is accessible only through the HTTP protocol
		 */
		public function getHttpOnly(){ }


		/**
		 * Magic __toString method converts the cookie's value to string
		 */
		public function __toString(){ }

	}
}
