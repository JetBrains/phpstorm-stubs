<?php 

namespace Phalcon\Di\FactoryDefault {

	/**
	 * Phalcon\Di\FactoryDefault\Cli
	 *
	 * This is a variant of the standard Phalcon\Di. By default it automatically
	 * registers all the services provided by the framework.
	 * Thanks to this, the developer does not need to register each service individually.
	 * This class is specially suitable for CLI applications
	 */
	
	class Cli extends \Phalcon\Di\FactoryDefault implements \Phalcon\DiInterface, \ArrayAccess {

		/**
		 * \Phalcon\Di\FactoryDefault\Cli constructor
		 */
		public function __construct(){ }

	}
}
