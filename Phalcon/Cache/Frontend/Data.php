<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Phalcon\Cache\Frontend\Data
	 *
	 * Allows to cache native PHP data in a serialized form
	 *
	 *<code>
	 * use Phalcon\Cache\Backend\File;
	 * use Phalcon\Cache\Frontend\Data;
	 *
	 * // Cache the files for 2 days using a Data frontend
	 * $frontCache = new Data(
	 *     [
	 *         "lifetime" => 172800,
	 *     ]
	 * );
	 *
	 * // Create the component that will cache "Data" to a 'File' backend
	 * // Set the cache file directory - important to keep the '/' at the end of
	 * // of the value for the folder
	 * $cache = new File(
	 *     $frontCache,
	 *     [
	 *         "cacheDir" => "../app/cache/",
	 *     ]
	 * );
	 *
	 * $cacheKey = "robots_order_id.cache";
	 *
	 * // Try to get cached records
	 * $robots = $cache->get($cacheKey);
	 *
	 * if ($robots === null) {
	 *     // $robots is null due to cache expiration or data does not exist
	 *     // Make the database call and populate the variable
	 *     $robots = Robots::find(
	 *         [
	 *             "order" => "id",
	 *         ]
	 *     );
	 *
	 *     // Store it in the cache
	 *     $cache->save($cacheKey, $robots);
	 * }
	 *
	 * // Use $robots :)
	 * foreach ($robots as $robot) {
	 *     echo $robot->name, "\n";
	 * }
	 *</code>
	 */
	
	class Data implements \Phalcon\Cache\FrontendInterface {

		protected $_frontendOptions;

		/**
		 * \Phalcon\Cache\Frontend\Data constructor
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
