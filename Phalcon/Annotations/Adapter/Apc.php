<?php 

namespace Phalcon\Annotations\Adapter {

	/**
	 * Phalcon\Annotations\Adapter\Apc
	 *
	 * Stores the parsed annotations in APC. This adapter is suitable for production
	 *
	 * <code>
	 * use Phalcon\Annotations\Adapter\Apc;
	 *
	 * $annotations = new Apc();
	 * </code>
	 *
	 * @see \Phalcon\Annotations\Adapter\Apcu
	 * @deprecated
	 */
	
	class Apc extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_prefix;

		protected $_ttl;

		/**
		 * \Phalcon\Annotations\Adapter\Apc constructor
		 *
		 * @param array options
		 */
		public function __construct($options=null){ }


		/**
		 * Reads parsed annotations from APC
		 */
		public function read($key){ }


		/**
		 * Writes parsed annotations to APC
		 */
		public function write($key, \Phalcon\Annotations\Reflection $data){ }

	}
}
