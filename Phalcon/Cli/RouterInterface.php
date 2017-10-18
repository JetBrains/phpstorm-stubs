<?php 

namespace Phalcon\Cli {

	interface RouterInterface {

		public function setDefaultModule($moduleName);


		public function setDefaultTask($taskName);


		public function setDefaultAction($actionName);


		public function setDefaults($defaults);


		public function handle($arguments=null);


		public function add($pattern, $paths=null);


		public function getModuleName();


		public function getTaskName();


		public function getActionName();


		public function getParams();


		public function getMatchedRoute();


		public function getMatches();


		public function wasMatched();


		public function getRoutes();


		public function getRouteById($id);


		public function getRouteByName($name);

	}
}
