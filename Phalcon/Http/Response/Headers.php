<?php 

namespace Phalcon\Http\Response {

	/**
	 * Phalcon\Http\Response\Headers
	 *
	 * This class is a bag to manage the response headers
	 */
	
	class Headers implements \Phalcon\Http\Response\HeadersInterface {

		protected $_headers;

		/**
		 * Sets a header to be sent at the end of the request
		 */
		public function set($name, $value){ }


		/**
		 * Gets a header value from the internal bag
		 */
		public function get($name){ }


		/**
		 * Sets a raw header to be sent at the end of the request
		 */
		public function setRaw($header){ }


		/**
		 * Removes a header to be sent at the end of the request
		 */
		public function remove($header){ }


		/**
		 * Sends the headers to the client
		 */
		public function send(){ }


		/**
		 * Reset set headers
		 */
		public function reset(){ }


		/**
		 * Returns the current headers as an array
		 */
		public function toArray(){ }


		/**
		 * Restore a \Phalcon\Http\Response\Headers object
		 */
		public static function __set_state($data){ }

	}
}
