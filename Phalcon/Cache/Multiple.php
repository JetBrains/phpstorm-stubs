<?php 

namespace Phalcon\Cache {

	/**
	 * Phalcon\Cache\Multiple
	 *
	 * Allows to read to chained backend adapters writing to multiple backends
	 *
	 *<code>
	 * use Phalcon\Cache\Frontend\Data as DataFrontend;
	 * use Phalcon\Cache\Multiple;
	 * use Phalcon\Cache\Backend\Apc as ApcCache;
	 * use Phalcon\Cache\Backend\Memcache as MemcacheCache;
	 * use Phalcon\Cache\Backend\File as FileCache;
	 *
	 * $ultraFastFrontend = new DataFrontend(
	 *     [
	 *         "lifetime" => 3600,
	 *     ]
	 * );
	 *
	 * $fastFrontend = new DataFrontend(
	 *     [
	 *         "lifetime" => 86400,
	 *     ]
	 * );
	 *
	 * $slowFrontend = new DataFrontend(
	 *     [
	 *         "lifetime" => 604800,
	 *     ]
	 * );
	 *
	 * //Backends are registered from the fastest to the slower
	 * $cache = new Multiple(
	 *     [
	 *         new ApcCache(
	 *             $ultraFastFrontend,
	 *             [
	 *                 "prefix" => "cache",
	 *             ]
	 *         ),
	 *         new MemcacheCache(
	 *             $fastFrontend,
	 *             [
	 *                 "prefix" => "cache",
	 *                 "host"   => "localhost",
	 *                 "port"   => "11211",
	 *             ]
	 *         ),
	 *         new FileCache(
	 *             $slowFrontend,
	 *             [
	 *                 "prefix"   => "cache",
	 *                 "cacheDir" => "../app/cache/",
	 *             ]
	 *         ),
	 *     ]
	 * );
	 *
	 * //Save, saves in every backend
	 * $cache->save("my-key", $data);
	 *</code>
	 */
	
	class Multiple {

		protected $_backends;

		/**
		 * \Phalcon\Cache\Multiple constructor
		 *
		 * @param	Phalcon\Cache\BackendInterface[] backends
		 */
		public function __construct($backends=null){ }


		/**
		 * Adds a backend
		 */
		public function push(\Phalcon\Cache\BackendInterface $backend){ }


		/**
		 * Returns a cached content reading the internal backends
		 *
		 * @param string|int keyName
		 * @param int lifetime
		 * @return mixed
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Starts every backend
		 *
		 * @param string|int keyName
		 * @param int lifetime
		 */
		public function start($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into all backends and stops the frontend
		 *
		 * @param string keyName
		 * @param string content
		 * @param int lifetime
		 * @param boolean stopBuffer
		 */
		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		/**
		 * Deletes a value from each backend
		 *
		 * @param string|int keyName
		 * @return boolean
		 */
		public function delete($keyName){ }


		/**
		 * Checks if cache exists in at least one backend
		 *
		 * @param  string|int keyName
		 * @param  int lifetime
		 */
		public function exists($keyName=null, $lifetime=null){ }


		/**
		 * Flush all backend(s)
		 */
		public function flush(){ }

	}
}
