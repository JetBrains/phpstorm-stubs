<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Binding
	 *
	 * This is an class for binding models into params for handler
	 */
	
	class Binder implements \Phalcon\Mvc\Model\BinderInterface {

		protected $boundModels;

		protected $cache;

		protected $internalCache;

		protected $originalValues;

		/**
		 * Array for storing active bound models
		 */
		public function getBoundModels(){ }


		/**
		 * Array for original values
		 */
		public function getOriginalValues(){ }


		/**
		 * \Phalcon\Mvc\Model\Binder constructor
		 */
		public function __construct(\Phalcon\Cache\BackendInterface $cache=null){ }


		/**
		 * Gets cache instance
		 */
		public function setCache(\Phalcon\Cache\BackendInterface $cache){ }


		/**
		 * Sets cache instance
		 */
		public function getCache(){ }


		/**
		 * Bind models into params in proper handler
		 */
		public function bindToHandler($handler, $params, $cacheKey, $methodName=null){ }


		/**
		 * Find the model by param value.
		 */
		protected function findBoundModel($paramValue, $className){ }


		/**
		 * Get params classes from cache by key
		 */
		protected function getParamsFromCache($cacheKey){ }


		/**
		 * Get modified params for handler using reflection
		 */
		protected function getParamsFromReflection($handler, $params, $cacheKey, $methodName){ }

	}
}
