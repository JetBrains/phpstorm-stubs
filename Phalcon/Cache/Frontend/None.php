<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Phalcon\Cache\Frontend\None
	 *
	 * Discards any kind of frontend data input. This frontend does not have expiration time or any other options
	 *
	 *<code>
	 *<?php
	 *
	 * //Create a None Cache
	 * $frontCache = new \Phalcon\Cache\Frontend\None();
	 *
	 * // Create the component that will cache "Data" to a "Memcached" backend
	 * // Memcached connection settings
	 * $cache = new \Phalcon\Cache\Backend\Memcache(
	 *     $frontCache,
	 *     [
	 *         "host" => "localhost",
	 *         "port" => "11211",
	 *     ]
	 * );
	 *
	 * $cacheKey = "robots_order_id.cache";
	 *
	 * // This Frontend always return the data as it's returned by the backend
	 * $robots = $cache->get($cacheKey);
	 *
	 * if ($robots === null) {
	 *     // This cache doesn't perform any expiration checking, so the data is always expired
	 *     // Make the database call and populate the variable
	 *     $robots = Robots::find(
	 *         [
	 *             "order" => "id",
	 *         ]
	 *     );
	 *
	 *     $cache->save($cacheKey, $robots);
	 * }
	 *
	 * // Use $robots :)
	 * foreach ($robots as $robot) {
	 *     echo $robot->name, "\n";
	 * }
	 *</code>
	 */
	
	class None implements \Phalcon\Cache\FrontendInterface {

		/**
		 * Returns cache lifetime, always one second expiring content
		 */
		public function getLifetime(){ }


		/**
		 * Check whether if frontend is buffering output, always false
		 */
		public function isBuffering(){ }


		/**
		 * Starts output frontend
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
		 * Prepare data to be stored
		 */
		public function beforeStore($data){ }


		/**
		 * Prepares data to be retrieved to user
		 */
		public function afterRetrieve($data){ }

	}
}
