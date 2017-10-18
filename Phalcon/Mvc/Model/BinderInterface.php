<?php 

namespace Phalcon\Mvc\Model {

	interface BinderInterface {

		public function getBoundModels();


		public function getCache();


		public function setCache(\Phalcon\Cache\BackendInterface $cache);


		public function bindToHandler($handler, $params, $cacheKey, $methodName=null);

	}
}
