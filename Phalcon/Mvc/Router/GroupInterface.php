<?php 

namespace Phalcon\Mvc\Router {

	interface GroupInterface {

		public function setHostname($hostname);


		public function getHostname();


		public function setPrefix($prefix);


		public function getPrefix();


		public function beforeMatch($beforeMatch);


		public function getBeforeMatch();


		public function setPaths($paths);


		public function getPaths();


		public function getRoutes();


		public function add($pattern, $paths=null, $httpMethods=null);


		public function addGet($pattern, $paths=null);


		public function addPost($pattern, $paths=null);


		public function addPut($pattern, $paths=null);


		public function addPatch($pattern, $paths=null);


		public function addDelete($pattern, $paths=null);


		public function addOptions($pattern, $paths=null);


		public function addHead($pattern, $paths=null);


		public function clear();

	}
}
