<?php 

namespace Phalcon\Events {

	interface ManagerInterface {

		public function attach($eventType, $handler);


		public function detach($eventType, $handler);


		public function detachAll($type=null);


		public function fire($eventType, $source, $data=null);


		public function getListeners($type);

	}
}
