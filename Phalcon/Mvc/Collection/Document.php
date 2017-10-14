<?php 

namespace Phalcon\Mvc\Collection {

	/**
	 * Phalcon\Mvc\Collection\Document
	 *
	 * This component allows Phalcon\Mvc\Collection to return rows without an associated entity.
	 * This objects implements the ArrayAccess interface to allow access the object as object->x or array[x].
	 */
	
	class Document implements \Phalcon\Mvc\EntityInterface, \ArrayAccess {

		/**
		 * Checks whether an offset exists in the document
		 *
		 * @param int index
		 * @return boolean
		 */
		public function offsetExists($index){ }


		/**
		 * Returns the value of a field using the ArrayAccess interfase
		 */
		public function offsetGet($index){ }


		/**
		 * Change a value using the ArrayAccess interface
		 */
		public function offsetSet($index, $value){ }


		/**
		 * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
		 *
		 * @param string offset
		 */
		public function offsetUnset($offset){ }


		/**
		 * Reads an attribute value by its name
		 *
		 *<code>
		 *  echo $robot->readAttribute("name");
		 *</code>
		 *
		 * @param string attribute
		 * @return mixed
		 */
		public function readAttribute($attribute){ }


		/**
		 * Writes an attribute value by its name
		 *
		 *<code>
		 *  $robot->writeAttribute("name", "Rosey");
		 *</code>
		 *
		 * @param string attribute
		 * @param mixed value
		 */
		public function writeAttribute($attribute, $value){ }


		/**
		 * Returns the instance as an array representation
		 *
		 * @return array
		 */
		public function toArray(){ }

	}
}
