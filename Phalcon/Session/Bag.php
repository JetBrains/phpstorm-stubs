<?php 

namespace Phalcon\Session {

	/**
	 * Phalcon\Session\Bag
	 *
	 * This component helps to separate session data into "namespaces". Working by this way
	 * you can easily create groups of session variables into the application
	 *
	 * <code>
	 * $user = new \Phalcon\Session\Bag("user");
	 *
	 * $user->name = "Kimbra Johnson";
	 * $user->age  = 22;
	 * </code>
	 */
	
	class Bag implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Session\BagInterface, \IteratorAggregate, \Traversable, \ArrayAccess, \Countable {

		protected $_dependencyInjector;

		protected $_name;

		protected $_data;

		protected $_initialized;

		protected $_session;

		/**
		 * \Phalcon\Session\Bag constructor
		 */
		public function __construct($name){ }


		/**
		 * Sets the DependencyInjector container
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 */
		public function getDI(){ }


		/**
		 * Initializes the session bag. This method must not be called directly, the
		 * class calls it when its internal data is accessed
		 */
		public function initialize(){ }


		/**
		 * Destroys the session bag
		 *
		 *<code>
		 * $user->destroy();
		 *</code>
		 */
		public function destroy(){ }


		/**
		 * Sets a value in the session bag
		 *
		 *<code>
		 * $user->set("name", "Kimbra");
		 *</code>
		 */
		public function set($property, $value){ }


		/**
		 * Magic setter to assign values to the session bag
		 *
		 *<code>
		 * $user->name = "Kimbra";
		 *</code>
		 */
		public function __set($property, $value){ }


		/**
		 * Obtains a value from the session bag optionally setting a default value
		 *
		 *<code>
		 * echo $user->get("name", "Kimbra");
		 *</code>
		 */
		public function get($property, $defaultValue=null){ }


		/**
		 * Magic getter to obtain values from the session bag
		 *
		 *<code>
		 * echo $user->name;
		 *</code>
		 */
		public function __get($property){ }


		/**
		 * Check whether a property is defined in the internal bag
		 *
		 *<code>
		 * var_dump(
		 *     $user->has("name")
		 * );
		 *</code>
		 */
		public function has($property){ }


		/**
		 * Magic isset to check whether a property is defined in the bag
		 *
		 *<code>
		 * var_dump(
		 *     isset($user["name"])
		 * );
		 *</code>
		 */
		public function __isset($property){ }


		/**
		 * Removes a property from the internal bag
		 *
		 *<code>
		 * $user->remove("name");
		 *</code>
		 */
		public function remove($property){ }


		/**
		 * Magic unset to remove items using the array syntax
		 *
		 *<code>
		 * unset($user["name"]);
		 *</code>
		 */
		public function __unset($property){ }


		/**
		 * Return length of bag
		 *
		 *<code>
		 * echo $user->count();
		 *</code>
		 */
		final public function count(){ }


		/**
		 * Returns the bag iterator
		 */
		final public function getIterator(){ }


		final public function offsetSet($property, $value){ }


		final public function offsetExists($property){ }


		final public function offsetUnset($property){ }


		final public function offsetGet($property){ }

	}
}
