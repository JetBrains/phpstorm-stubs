<?php 

namespace Phalcon {

	interface DiInterface {

		public function set($name, $definition, $shared=null);


		public function setShared($name, $definition);


		public function remove($name);


		public function attempt($name, $definition, $shared=null);


		public function get($name, $parameters=null);


		public function getShared($name, $parameters=null);


		public function setRaw($name, \Phalcon\Di\ServiceInterface $rawDefinition);


		public function getRaw($name);


		public function getService($name);


		public function has($name);


		public function wasFreshInstance();


		public function getServices();


		public static function setDefault(\Phalcon\DiInterface $dependencyInjector);


		public static function getDefault();


		public static function reset();

	}
}
