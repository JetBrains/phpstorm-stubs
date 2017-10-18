<?php 

namespace Phalcon\Mvc\Model\Resultset {

	/**
	 * Phalcon\Mvc\Model\Resultset\Complex
	 *
	 * Complex resultsets may include complete objects and scalar values.
	 * This class builds every complex row as it is required
	 */
	
	class Complex extends \Phalcon\Mvc\Model\Resultset implements \JsonSerializable, \Serializable, \ArrayAccess, \Countable, \SeekableIterator, \Traversable, \Iterator, \Phalcon\Mvc\Model\ResultsetInterface {

		const TYPE_RESULT_FULL = 0;

		const TYPE_RESULT_PARTIAL = 1;

		const HYDRATE_RECORDS = 0;

		const HYDRATE_OBJECTS = 2;

		const HYDRATE_ARRAYS = 1;

		protected $_columnTypes;

		protected $_disableHydration;

		/**
		 * \Phalcon\Mvc\Model\Resultset\Complex constructor
		 *
		 * @param array columnTypes
		 * @param \Phalcon\Db\ResultInterface result
		 * @param \Phalcon\Cache\BackendInterface cache
		 */
		public function __construct($columnTypes, \Phalcon\Db\ResultInterface $result=null, \Phalcon\Cache\BackendInterface $cache=null){ }


		/**
		 * Returns current row in the resultset
		 */
		final public function current(){ }


		/**
		 * Returns a complete resultset as an array, if the resultset has a big number of rows
		 * it could consume more memory than currently it does.
		 */
		public function toArray(){ }


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
