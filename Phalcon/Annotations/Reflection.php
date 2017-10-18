<?php 

namespace Phalcon\Annotations {

	/**
	 * Phalcon\Annotations\Reflection
	 *
	 * Allows to manipulate the annotations reflection in an OO manner
	 *
	 *<code>
	 * use Phalcon\Annotations\Reader;
	 * use Phalcon\Annotations\Reflection;
	 *
	 * // Parse the annotations in a class
	 * $reader = new Reader();
	 * $parsing = $reader->parse("MyComponent");
	 *
	 * // Create the reflection
	 * $reflection = new Reflection($parsing);
	 *
	 * // Get the annotations in the class docblock
	 * $classAnnotations = $reflection->getClassAnnotations();
	 *</code>
	 */
	
	class Reflection {

		protected $_reflectionData;

		protected $_classAnnotations;

		protected $_methodAnnotations;

		protected $_propertyAnnotations;

		/**
		 * \Phalcon\Annotations\Reflection constructor
		 *
		 * @param array reflectionData
		 */
		public function __construct($reflectionData=null){ }


		/**
		 * Returns the annotations found in the class docblock
		 */
		public function getClassAnnotations(){ }


		/**
		 * Returns the annotations found in the methods' docblocks
		 */
		public function getMethodsAnnotations(){ }


		/**
		 * Returns the annotations found in the properties' docblocks
		 */
		public function getPropertiesAnnotations(){ }


		/**
		 * Returns the raw parsing intermediate definitions used to construct the reflection
		 *
		 * @return array
		 */
		public function getReflectionData(){ }


		/**
		 * Restores the state of a \Phalcon\Annotations\Reflection variable export
		 *
		 * @return array data
		 */
		public static function __set_state($data){ }

	}
}
