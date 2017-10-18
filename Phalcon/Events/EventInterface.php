<?php 

namespace Phalcon\Events {

	interface EventInterface {

		public function getData();


		public function setData($data=null);


		public function getType();


		public function setType($type);


		public function stop();


		public function isStopped();


		public function isCancelable();

	}
}
