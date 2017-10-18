<?php 

namespace Phalcon\Di {

	/**
	 * Phalcon\Di\Service
	 *
	 * Represents individually a service in the services container
	 *
	 *<code>
	 * $service = new \Phalcon\Di\Service(
	 *     "request",
	 *     "Phalcon\\Http\\Request"
	 * );
	 *
	 * $request = service->resolve();
	 *</code>
	 */
	
	class Service implements \Phalcon\Di\ServiceInterface {

		protected $_name;

		protected $_definition;

		protected $_shared;

		protected $_resolved;

		protected $_sharedInstance;

		/**
		 * \Phalcon\Di\Service
		 *
		 * @param string name
		 * @param mixed definition
		 * @param boolean shared
		 */
		final public function __construct($name, $definition, $shared=null){ }


		/**
		 * Returns the service's name
		 */
		public function getName(){ }


		/**
		 * Sets if the service is shared or not
		 */
		public function setShared($shared){ }


		/**
		 * Check whether the service is shared or not
		 */
		public function isShared(){ }


		/**
		 * Sets/Resets the shared instance related to the service
		 *
		 * @param mixed sharedInstance
		 */
		public function setSharedInstance($sharedInstance){ }


		/**
		 * Set the service definition
		 *
		 * @param mixed definition
		 */
		public function setDefinition($definition){ }


		/**
		 * Returns the service definition
		 *
		 * @return mixed
		 */
		public function getDefinition(){ }


		/**
		 * Resolves the service
		 *
		 * @param array parameters
		 * @param \Phalcon\DiInterface dependencyInjector
		 * @return mixed
		 */
		public function resolve($parameters=null, \Phalcon\DiInterface $dependencyInjector=null){ }


		/**
		 * Changes a parameter in the definition without resolve the service
		 */
		public function setParameter($position, $parameter){ }


		/**
		 * Returns a parameter in a specific position
		 *
		 * @param int position
		 * @return array
		 */
		public function getParameter($position){ }


		/**
		 * Returns true if the service was resolved
		 */
		public function isResolved(){ }


		/**
		 * Restore the internal state of a service
		 */
		public static function __set_state($attributes){ }

	}
}
