<?php 

namespace Phalcon\Mvc\Model {

	interface BehaviorInterface {

		public function notify($type, \Phalcon\Mvc\ModelInterface $model);


		public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $method, $arguments=null);

	}
}
