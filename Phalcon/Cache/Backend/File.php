<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\File
	 *
	 * Allows to cache output fragments using a file backend
	 *
	 *<code>
	 * use Phalcon\Cache\Backend\File;
	 * use Phalcon\Cache\Frontend\Output as FrontOutput;
	 *
	 * // Cache the file for 2 days
	 * $frontendOptions = [
	 *     "lifetime" => 172800,
	 * ];
	 *
	 * // Create an output cache
	 * $frontCache = FrontOutput($frontOptions);
	 *
	 * // Set the cache directory
	 * $backendOptions = [
	 *     "cacheDir" => "../app/cache/",
	 * ];
	 *
	 * // Create the File backend
	 * $cache = new File($frontCache, $backendOptions);
	 *
	 * $content = $cache->start("my-cache");
	 *
	 * if ($content === null) {
	 *     echo "<h1>", time(), "</h1>";
	 *
	 *     $cache->save();
	 * } else {
	 *     echo $content;
	 * }
	 *</code>
	 */
	
	class File extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		private $_useSafeKey;

		/**
		 * \Phalcon\Cache\Backend\File constructor
		 */
		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options){ }


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
		 * @param string|int keyName
		 * @param int lifetime
		 */
		public function exists($keyName=null, $lifetime=null){ }


		/**
		 * Increment of a given key, by number $value
		 *
		 * @param  string|int keyName
		 */
		public function increment($keyName=null, $value=null){ }


		/**
		 * Decrement of a given key, by number $value
		 *
		 * @param string|int keyName
		 */
		public function decrement($keyName=null, $value=null){ }


		/**
		 * Immediately invalidates all existing items.
		 */
		public function flush(){ }


		/**
		 * Return a file-system safe identifier for a given key
		 */
		public function getKey($key){ }


		/**
		 * Set whether to use the safekey or not
		 */
		public function useSafeKey($useSafeKey){ }

	}
}
