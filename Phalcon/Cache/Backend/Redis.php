<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\Redis
	 *
	 * Allows to cache output fragments, PHP data or raw data to a redis backend
	 *
	 * This adapter uses the special redis key "_PHCR" to store all the keys internally used by the adapter
	 *
	 *<code>
	 * use Phalcon\Cache\Backend\Redis;
	 * use Phalcon\Cache\Frontend\Data as FrontData;
	 *
	 * // Cache data for 2 days
	 * $frontCache = new FrontData(
	 *     [
	 *         "lifetime" => 172800,
	 *     ]
	 * );
	 *
	 * // Create the Cache setting redis connection options
	 * $cache = new Redis(
	 *     $frontCache,
	 *     [
	 *         "host"       => "localhost",
	 *         "port"       => 6379,
	 *         "auth"       => "foobared",
	 *         "persistent" => false,
	 *         "index"      => 0,
	 *     ]
	 * );
	 *
	 * // Cache arbitrary data
	 * $cache->save("my-data", [1, 2, 3, 4, 5]);
	 *
	 * // Get data
	 * $data = $cache->get("my-data");
	 *</code>
	 */
	
	class Redis extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		protected $_redis;

		/**
		 * \Phalcon\Cache\Backend\Redis constructor
		 *
		 * @param	Phalcon\Cache\FrontendInterface frontend
		 * @param	array options
		 */
		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options=null){ }


		/**
		 * Create internal connection to redis
		 */
		public function _connect(){ }


		/**
		 * Returns a cached content
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the file backend and stops the frontend
		 *
		 * <code>
		 * $cache->save("my-key", $data);
		 *
		 * // Save data termlessly
		 * $cache->save("my-key", $data, -1);
		 * </code>
		 *
		 * @param int|string keyName
		 * @param string content
		 * @param int lifetime
		 * @param boolean stopBuffer
		 */
		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		/**
		 * Deletes a value from the cache by its key
		 *
		 * @param int|string keyName
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
		 * Checks if cache exists and it isn't expired
		 *
		 * @param string keyName
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

	}
}
