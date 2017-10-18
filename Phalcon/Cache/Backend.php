<?php 

namespace Phalcon\Cache {

	/**
	 * Phalcon\Cache\Backend
	 *
	 * This class implements common functionality for backend adapters. A backend cache adapter may extend this class
	 */
	
	abstract class Backend implements \Phalcon\Cache\BackendInterface {

		protected $_frontend;

		protected $_options;

		protected $_prefix;

		protected $_lastKey;

		protected $_lastLifetime;

		protected $_fresh;

		protected $_started;

		public function getFrontend(){ }


		public function setFrontend($frontend){ }


		public function getOptions(){ }


		public function setOptions($options){ }


		public function getLastKey(){ }


		public function setLastKey($lastKey){ }


		/**
		 * \Phalcon\Cache\Backend constructor
		 *
		 * @param \Phalcon\Cache\FrontendInterface frontend
		 * @param array options
		 */
		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options=null){ }


		/**
		 * Starts a cache. The keyname allows to identify the created fragment
		 *
		 * @param   int|string keyName
		 * @param   int lifetime
		 * @return  mixed
		 */
		public function start($keyName, $lifetime=null){ }


		/**
		 * Stops the frontend without store any cached content
		 */
		public function stop($stopBuffer=null){ }


		/**
		 * Checks whether the last cache is fresh or cached
		 */
		public function isFresh(){ }


		/**
		 * Checks whether the cache has starting buffering or not
		 */
		public function isStarted(){ }


		/**
		 * Gets the last lifetime set
		 *
		 * @return int
		 */
		public function getLifetime(){ }

	}
}
