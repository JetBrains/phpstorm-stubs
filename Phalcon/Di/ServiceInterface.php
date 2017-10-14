<?php 

namespace Phalcon\Di {

	interface ServiceInterface {

		public function getName();


		public function setShared($shared);


		public function isShared();


		public function setDefinition($definition);


		public function getDefinition();


		public function resolve($parameters=null, \Phalcon\DiInterface $dependencyInjector=null);


		public function setParameter($position, $parameter);


		public static function __set_state($attributes);

	}
}
