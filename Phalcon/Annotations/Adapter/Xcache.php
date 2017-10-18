<?php 

namespace Phalcon\Annotations\Adapter {

	/**
	 * Phalcon\Annotations\Adapter\Xcache
	 *
	 * Stores the parsed annotations to XCache. This adapter is suitable for production
	 *
	 *<code>
	 * $annotations = new \Phalcon\Annotations\Adapter\Xcache();
	 *</code>
	 */
	
	class Xcache extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		/**
		 * Reads parsed annotations from XCache
		 *
		 * @param string key
		 * @return \Phalcon\Annotations\Reflection
		 */
		public function read($key){ }


		/**
		 * Writes parsed annotations to XCache
		 */
		public function write($key, \Phalcon\Annotations\Reflection $data){ }

	}
}
