<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Resultset
	 *
	 * This component allows to Phalcon\Mvc\Model returns large resultsets with the minimum memory consumption
	 * Resultsets can be traversed using a standard foreach or a while statement. If a resultset is serialized
	 * it will dump all the rows into a big array. Then unserialize will retrieve the rows as they were before
	 * serializing.
	 *
	 * <code>
	 *
	 * // Using a standard foreach
	 * $robots = Robots::find(
	 *     [
	 *         "type = 'virtual'",
	 *         "order" => "name",
	 *     ]
	 * );
	 *
	 * foreach ($robots as robot) {
	 *     echo robot->name, "\n";
	 * }
	 *
	 * // Using a while
	 * $robots = Robots::find(
	 *     [
	 *         "type = 'virtual'",
	 *         "order" => "name",
	 *     ]
	 * );
	 *
	 * $robots->rewind();
	 *
	 * while ($robots->valid()) {
	 *     $robot = $robots->current();
	 *
	 *     echo $robot->name, "\n";
	 *
	 *     $robots->next();
	 * }
	 * </code>
	 */
	
	abstract class Resultset implements \Phalcon\Mvc\Model\ResultsetInterface, \Iterator, \Traversable, \SeekableIterator, \Countable, \ArrayAccess, \Serializable, \JsonSerializable {

		const TYPE_RESULT_FULL = 0;

		const TYPE_RESULT_PARTIAL = 1;

		const HYDRATE_RECORDS = 0;

		const HYDRATE_OBJECTS = 2;

		const HYDRATE_ARRAYS = 1;

		protected $_result;

		protected $_cache;

		protected $_isFresh;

		protected $_pointer;

		protected $_count;

		protected $_activeRow;

		protected $_rows;

		protected $_row;

		protected $_errorMessages;

		protected $_hydrateMode;

		/**
		 * \Phalcon\Mvc\Model\Resultset constructor
		 *
		 * @param \Phalcon\Db\ResultInterface|false result
		 * @param \Phalcon\Cache\BackendInterface cache
		 */
		public function __construct($result, \Phalcon\Cache\BackendInterface $cache=null){ }


		/**
		 * Moves cursor to next row in the resultset
		 */
		public function next(){ }


		/**
		 * Check whether internal resource has rows to fetch
		 */
		public function valid(){ }


		/**
		 * Gets pointer number of active row in the resultset
		 */
		public function key(){ }


		/**
		 * Rewinds resultset to its beginning
		 */
		final public function rewind(){ }


		/**
		 * Changes internal pointer to a specific position in the resultset
		 * Set new position if required and set this->_row
		 */
		final public function seek($position){ }


		/**
		 * Counts how many rows are in the resultset
		 */
		final public function count(){ }


		/**
		 * Checks whether offset exists in the resultset
		 */
		public function offsetExists($index){ }


		/**
		 * Gets row in a specific position of the resultset
		 */
		public function offsetGet($index){ }


		/**
		 * Resultsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
		 *
		 * @param int index
		 * @param \Phalcon\Mvc\ModelInterface value
		 */
		public function offsetSet($index, $value){ }


		/**
		 * Resultsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
		 */
		public function offsetUnset($offset){ }


		/**
		 * Returns the internal type of data retrieval that the resultset is using
		 */
		public function getType(){ }


		/**
		 * Get first row in the resultset
		 */
		public function getFirst(){ }


		/**
		 * Get last row in the resultset
		 */
		public function getLast(){ }


		/**
		 * Set if the resultset is fresh or an old one cached
		 */
		public function setIsFresh($isFresh){ }


		/**
		 * Tell if the resultset if fresh or an old one cached
		 */
		public function isFresh(){ }


		/**
		 * Sets the hydration mode in the resultset
		 */
		public function setHydrateMode($hydrateMode){ }


		/**
		 * Returns the current hydration mode
		 */
		public function getHydrateMode(){ }


		/**
		 * Returns the associated cache for the resultset
		 */
		public function getCache(){ }


		/**
		 * Returns the error messages produced by a batch operation
		 */
		public function getMessages(){ }


		/**
		 * Updates every record in the resultset
		 *
		 * @param array data
		 * @param \Closure conditionCallback
		 * @return boolean
		 */
		public function update($data, \Closure $conditionCallback=null){ }


		/**
		 * Deletes every record in the resultset
		 */
		public function delete(\Closure $conditionCallback=null){ }


		/**
		 * Filters a resultset returning only those the developer requires
		 *
		 *<code>
		 * $filtered = $robots->filter(
		 *     function ($robot) {
		 *         if ($robot->id < 3) {
		 *             return $robot;
		 *         }
		 *     }
		 * );
		 *</code>
		 *
		 * @param callback filter
		 * @return \Phalcon\Mvc\Model[]
		 */
		public function filter($filter){ }


		/**
		 * Returns serialised model objects as array for json_encode.
		 * Calls jsonSerialize on each object if present
		 *
		 *<code>
		 * $robots = Robots::find();
		 * echo json_encode($robots);
		 *</code>
		 *
		 * @return array
		 */
		public function jsonSerialize(){ }

	}
}
