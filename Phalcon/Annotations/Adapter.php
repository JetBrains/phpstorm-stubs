<?php 

namespace Phalcon\Annotations {

	/**
	 * Phalcon\Annotations\Adapter
	 *
	 * This is the base class for Phalcon\Annotations adapters
	 */
	
	abstract class Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_reader;

		protected $_annotations;

		/**
		 * Sets the annotations parser
		 */
		public function setReader(\Phalcon\Annotations\ReaderInterface $reader){ }


		/**
		 * Returns the annotation reader
		 */
		public function getReader(){ }


		/**
		 * Parses or retrieves all the annotations found in a class
		 *
		 * @param string|object className
		 */
		public function get($className){ }


		/**
		 * Returns the annotations found in all the class' methods
		 */
		public function getMethods($className){ }


		/**
		 * Returns the annotations found in a specific method
		 */
		public function getMethod($className, $methodName){ }


		/**
		 * Returns the annotations found in all the class' methods
		 */
		public function getProperties($className){ }


		/**
		 * Returns the annotations found in a specific property
		 */
		public function getProperty($className, $propertyName){ }

	}
}
