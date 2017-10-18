<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\Mongo
	 *
	 * Allows to cache output fragments, PHP data or raw data to a MongoDb backend
	 *
	 *<code>
	 * use Phalcon\Cache\Backend\Mongo;
	 * use Phalcon\Cache\Frontend\Base64;
	 *
	 * // Cache data for 2 days
	 * $frontCache = new Base64(
	 *     [
	 *         "lifetime" => 172800,
	 *     ]
	 * );
	 *
	 * // Create a MongoDB cache
	 * $cache = new Mongo(
	 *     $frontCache,
	 *     [
	 *         "server"     => "mongodb://localhost",
	 *         "db"         => "caches",
	 *         "collection" => "images",
	 *     ]
	 * );
	 *
	 * // Cache arbitrary data
	 * $cache->save(
	 *     "my-data",
	 *     file_get_contents("some-image.jpg")
	 * );
	 *
	 * // Get data
	 * $data = $cache->get("my-data");
	 *</code>
	 */
	
	class Mongo extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		protected $_collection;

		/**
		 * \Phalcon\Cache\Backend\Mongo constructor
		 *
		 * @param \Phalcon\Cache\FrontendInterface frontend
		 * @param array options
		 */
		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options=null){ }


		/**
		 * Returns a MongoDb collection based on the backend parameters
		 *
		 * @return MongoCollection
		 */
		final protected function _getCollection(){ }


		/**
		 * Returns a cached content
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the file backend and stops the frontend
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
		 * Checks if cache exists and it isn't expired
		 *
		 * @param string keyName
		 * @param int lifetime
		 */
		public function exists($keyName=null, $lifetime=null){ }


		/**
		 * gc
		 * @return collection->remove(...)
		 */
		public function gc(){ }


		/**
		 * Increment of a given key by $value
		 *
		 * @param int|string keyName
		 */
		public function increment($keyName, $value=null){ }


		/**
		 * Decrement of a given key by $value
		 *
		 * @param int|string $keyName
		 */
		public function decrement($keyName, $value=null){ }


		/**
		 * Immediately invalidates all existing items.
		 */
		public function flush(){ }

	}
}
