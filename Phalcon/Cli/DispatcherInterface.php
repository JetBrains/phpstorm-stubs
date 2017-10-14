<?php 

namespace Phalcon\Cli {

	interface DispatcherInterface {

		public function setTaskSuffix($taskSuffix);


		public function setDefaultTask($taskName);


		public function setTaskName($taskName);


		public function getTaskName();


		public function getLastTask();


		public function getActiveTask();

	}
}
