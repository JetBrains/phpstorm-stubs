<?php 

namespace Phalcon\Annotations\Adapter {

	/**
	 * Phalcon\Annotations\Adapter\Memory
	 *
	 * Stores the parsed annotations in memory. This adapter is the suitable development/testing
	 */
	
	class Memory extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_data;

		/**
		 * Reads parsed annotations from memory
		 */
		public function read($key){ }


		/**
		 * Writes parsed annotations to memory
		 */
		public function write($key, \Phalcon\Annotations\Reflection $data){ }

	}
}
