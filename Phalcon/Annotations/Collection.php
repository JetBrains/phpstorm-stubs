<?php 

namespace Phalcon\Annotations {

	/**
	 * Phalcon\Annotations\Collection
	 *
	 * Represents a collection of annotations. This class allows to traverse a group of annotations easily
	 *
	 *<code>
	 * //Traverse annotations
	 * foreach ($classAnnotations as $annotation) {
	 *     echo "Name=", $annotation->getName(), PHP_EOL;
	 * }
	 *
	 * //Check if the annotations has a specific
	 * var_dump($classAnnotations->has("Cacheable"));
	 *
	 * //Get an specific annotation in the collection
	 * $annotation = $classAnnotations->get("Cacheable");
	 *</code>
	 */
	
	class Collection implements \Iterator, \Traversable, \Countable {

		protected $_position;

		protected $_annotations;

		/**
		 * \Phalcon\Annotations\Collection constructor
		 *
		 * @param array reflectionData
		 */
		public function __construct($reflectionData=null){ }


		/**
		 * Returns the number of annotations in the collection
		 */
		public function count(){ }


		/**
		 * Rewinds the internal iterator
		 */
		public function rewind(){ }


		/**
		 * Returns the current annotation in the iterator
		 *
		 * @return \Phalcon\Annotations\Annotation
		 */
		public function current(){ }


		/**
		 * Returns the current position/key in the iterator
		 */
		public function key(){ }


		/**
		 * Moves the internal iteration pointer to the next position
		 */
		public function next(){ }


		/**
		 * Check if the current annotation in the iterator is valid
		 */
		public function valid(){ }


		/**
		 * Returns the internal annotations as an array
		 */
		public function getAnnotations(){ }


		/**
		 * Returns the first annotation that match a name
		 */
		public function get($name){ }


		/**
		 * Returns all the annotations that match a name
		 */
		public function getAll($name){ }


		/**
		 * Check if an annotation exists in a collection
		 */
		public function has($name){ }

	}
}
