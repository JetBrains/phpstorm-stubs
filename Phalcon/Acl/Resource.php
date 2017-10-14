<?php 

namespace Phalcon\Acl {

	/**
	 * Phalcon\Acl\Resource
	 *
	 * This class defines resource entity and its description
	 */
	
	class Resource implements \Phalcon\Acl\ResourceInterface {

		protected $_name;

		protected $_description;

		/**
		 * Resource name
		 */
		public function getName(){ }


		/**
		 * Resource name
		 */
		public function __toString(){ }


		/**
		 * Resource description
		 */
		public function getDescription(){ }


		/**
		 * \Phalcon\Acl\Resource constructor
		 */
		public function __construct($name, $description=null){ }

	}
}
