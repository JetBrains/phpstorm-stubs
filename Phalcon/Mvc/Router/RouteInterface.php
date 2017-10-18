<?php 

namespace Phalcon\Mvc\Router {

	interface RouteInterface {

		public function setHostname($hostname);


		public function getHostname();


		public function compilePattern($pattern);


		public function via($httpMethods);


		public function reConfigure($pattern, $paths=null);


		public function getName();


		public function setName($name);


		public function setHttpMethods($httpMethods);


		public function getRouteId();


		public function getPattern();


		public function getCompiledPattern();


		public function getPaths();


		public function getReversedPaths();


		public function getHttpMethods();


		public static function reset();

	}
}
