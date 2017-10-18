<?php 

namespace Phalcon\Translate\Adapter {

	/**
	 * Phalcon\Translate\Adapter\NativeArray
	 *
	 * Allows to define translation lists using PHP arrays
	 */
	
	class NativeArray extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess {

		protected $_translate;

		/**
		 * \Phalcon\Translate\Adapter\NativeArray constructor
		 */
		public function __construct($options){ }


		/**
		 * Returns the translation related to the given key
		 */
		public function query($index, $placeholders=null){ }


		/**
		 * Check whether is defined a translation key in the internal array
		 */
		public function exists($index){ }

	}
}
