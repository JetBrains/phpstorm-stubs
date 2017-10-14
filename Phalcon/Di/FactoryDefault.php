<?php 

namespace Phalcon\Di {

	/**
	 * Phalcon\Di\FactoryDefault
	 *
	 * This is a variant of the standard Phalcon\Di. By default it automatically
	 * registers all the services provided by the framework. Thanks to this, the developer does not need
	 * to register each service individually providing a full stack framework
	 */
	
	class FactoryDefault extends \Phalcon\Di implements \ArrayAccess, \Phalcon\DiInterface {

		/**
		 * \Phalcon\Di\FactoryDefault constructor
		 */
		public function __construct(){ }

	}
}
