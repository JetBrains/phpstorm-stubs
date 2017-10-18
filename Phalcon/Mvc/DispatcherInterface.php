<?php 

namespace Phalcon\Mvc {

	interface DispatcherInterface {

		public function setControllerSuffix($controllerSuffix);


		public function setDefaultController($controllerName);


		public function setControllerName($controllerName);


		public function getControllerName();


		public function getLastController();


		public function getActiveController();

	}
}
