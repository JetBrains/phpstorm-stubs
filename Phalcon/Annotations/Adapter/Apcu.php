<?php 

namespace Phalcon\Annotations\Adapter {

	/**
	 * Phalcon\Annotations\Adapter\Apcu
	 *
	 * Stores the parsed annotations in APCu. This adapter is suitable for production
	 *
	 *<code>
	 * use Phalcon\Annotations\Adapter\Apcu;
	 *
	 * $annotations = new Apcu();
	 *</code>
	 */
	
	class Apcu extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_prefix;

		protected $_ttl;

		/**
		 * \Phalcon\Annotations\Adapter\Apcu constructor
		 *
		 * @param array options
		 */
		public function __construct($options=null){ }


		/**
		 * Reads parsed annotations from APCu
		 */
		public function read($key){ }


		/**
		 * Writes parsed annotations to APCu
		 */
		public function write($key, \Phalcon\Annotations\Reflection $data){ }

	}
}
