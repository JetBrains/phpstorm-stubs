<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Phalcon\Cache\Frontend\Json
	 *
	 * Allows to cache data converting/deconverting them to JSON.
	 *
	 * This adapter uses the json_encode/json_decode PHP's functions
	 *
	 * As the data is encoded in JSON other systems accessing the same backend could
	 * process them
	 *
	 *<code>
	 *<?php
	 *
	 * // Cache the data for 2 days
	 * $frontCache = new \Phalcon\Cache\Frontend\Json(
	 *     [
	 *         "lifetime" => 172800,
	 *     ]
	 * );
	 *
	 * // Create the Cache setting memcached connection options
	 * $cache = new \Phalcon\Cache\Backend\Memcache(
	 *     $frontCache,
	 *     [
	 *         "host"       => "localhost",
	 *         "port"       => 11211,
	 *         "persistent" => false,
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
	
	class Json implements \Phalcon\Cache\FrontendInterface {

		protected $_frontendOptions;

		/**
		 * \Phalcon\Cache\Frontend\Base64 constructor
		 *
		 * @param array frontendOptions
		 */
		public function __construct($frontendOptions=null){ }


		/**
		 * Returns the cache lifetime
		 */
		public function getLifetime(){ }


		/**
		 * Check whether if frontend is buffering output
		 */
		public function isBuffering(){ }


		/**
		 * Starts output frontend. Actually, does nothing
		 */
		public function start(){ }


		/**
		 * Returns output cached content
		 *
		 * @return string
		 */
		public function getContent(){ }


		/**
		 * Stops output frontend
		 */
		public function stop(){ }


		/**
		 * Serializes data before storing them
		 */
		public function beforeStore($data){ }


		/**
		 * Unserializes data after retrieval
		 */
		public function afterRetrieve($data){ }

	}
}
