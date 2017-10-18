<?php 

namespace Phalcon\Mvc\Model\MetaData {

	interface StrategyInterface {

		public function getMetaData(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector);


		public function getColumnMaps(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector);

	}
}
