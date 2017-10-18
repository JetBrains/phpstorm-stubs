<?php 

namespace Phalcon\Mvc\Collection {

	interface ManagerInterface {

		public function setCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Events\ManagerInterface $eventsManager);


		public function getCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model);


		public function initialize(\Phalcon\Mvc\CollectionInterface $model);


		public function isInitialized($modelName);


		public function getLastInitialized();


		public function setConnectionService(\Phalcon\Mvc\CollectionInterface $model, $connectionService);


		public function useImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model, $useImplicitObjectIds);


		public function isUsingImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model);


		public function getConnection(\Phalcon\Mvc\CollectionInterface $model);


		public function notifyEvent($eventName, \Phalcon\Mvc\CollectionInterface $model);


		public function addBehavior(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Mvc\Collection\BehaviorInterface $behavior);

	}
}
