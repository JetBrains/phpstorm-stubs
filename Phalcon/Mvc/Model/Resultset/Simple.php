<?php 

namespace Phalcon\Mvc\Model\Resultset {

	/**
	 * Phalcon\Mvc\Model\Resultset\Simple
	 *
	 * Simple resultsets only contains a complete objects
	 * This class builds every complete object as it is required
	 */
	
	class Simple extends \Phalcon\Mvc\Model\Resultset implements \JsonSerializable, \Serializable, \ArrayAccess, \Countable, \SeekableIterator, \Traversable, \Iterator, \Phalcon\Mvc\Model\ResultsetInterface {

		const TYPE_RESULT_FULL = 0;

		const TYPE_RESULT_PARTIAL = 1;

		const HYDRATE_RECORDS = 0;

		const HYDRATE_OBJECTS = 2;

		const HYDRATE_ARRAYS = 1;

		protected $_model;

		protected $_columnMap;

		protected $_keepSnapshots;

		/**
		 * \Phalcon\Mvc\Model\Resultset\Simple constructor
		 *
		 * @param array columnMap
		 * @param \Phalcon\Mvc\ModelInterface|Phalcon\Mvc\Model\Row model
		 * @param \Phalcon\Db\Result\Pdo|null result
		 * @param \Phalcon\Cache\BackendInterface cache
		 * @param boolean keepSnapshots
		 */
		public function __construct($columnMap, $model, $result, \Phalcon\Cache\BackendInterface $cache=null, $keepSnapshots=null){ }


		/**
		 * Returns current row in the resultset
		 */
		final public function current(){ }


		/**
		 * Returns a complete resultset as an array, if the resultset has a big number of rows
		 * it could consume more memory than currently it does. Export the resultset to an array
		 * couldn't be faster with a large number of records
		 */
		public function toArray($renameColumns=null){ }


		/**
		 * Serializing a resultset will dump all related rows into a big array
		 */
		public function serialize(){ }


		/**
		 * Unserializing a resultset will allow to only works on the rows present in the saved state
		 */
		public function unserialize($data){ }

	}
}
