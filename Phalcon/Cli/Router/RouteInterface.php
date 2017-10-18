<?php 

namespace Phalcon\Cli\Router {

	interface RouteInterface {

		public function compilePattern($pattern);


		public function reConfigure($pattern, $paths=null);


		public function getName();


		public function setName($name);


		public function getRouteId();


		public function getPattern();


		public function getCompiledPattern();


		public function getPaths();


		public function getReversedPaths();


		public static function reset();

	}
}
