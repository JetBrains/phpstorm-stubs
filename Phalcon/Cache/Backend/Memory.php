<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\Memory
	 *
	 * Stores content in memory. Data is lost when the request is finished
	 *
	 *<code>
	 * use Phalcon\Cache\Backend\Memory;
	 * use Phalcon\Cache\Frontend\Data as FrontData;
	 *
	 * // Cache data
	 * $frontCache = new FrontData();
	 *
	 * $cache = new Memory($frontCache);
	 *
	 * // Cache arbitrary data
	 * $cache->save("my-data", [1, 2, 3, 4, 5]);
	 *
	 * // Get data
	 * $data = $cache->get("my-data");
	 *</code>
	 */
	
	class Memory extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface, \Serializable {

		protected $_data;

		/**
		 * Returns a cached content
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the backend and stops the frontend
		 *
		 * @param string keyName
		 * @param string content
		 * @param int lifetime
		 * @param boolean stopBuffer
		 */
		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		/**
		 * Deletes a value from the cache by its key
		 *
		 * @param string keyName
		 * @return boolean
		 */
		public function delete($keyName){ }


		/**
		 * Query the existing cached keys.
		 *
		 * <code>
		 * $cache->save("users-ids", [1, 2, 3]);
		 * $cache->save("projects-ids", [4, 5, 6]);
		 *
		 * var_dump($cache->queryKeys("users")); // ["users-ids"]
		 * </code>
		 */
		public function queryKeys($prefix=null){ }


		/**
		 * Checks if cache exists and it hasn't expired
		 *
		 * @param string|int keyName
		 * @param int lifetime
		 */
		public function exists($keyName=null, $lifetime=null){ }


		/**
		 * Increment of given $keyName by $value
		 *
		 * @param string keyName
		 */
		public function increment($keyName=null, $value=null){ }


		/**
		 * Decrement of $keyName by given $value
		 *
		 * @param string keyName
		 */
		public function decrement($keyName=null, $value=null){ }


		/**
		 * Immediately invalidates all existing items.
		 */
		public function flush(){ }


		/**
		 * Required for interface \Serializable
		 */
		public function serialize(){ }


		/**
		 * Required for interface \Serializable
		 */
		public function unserialize($data){ }

	}
}
