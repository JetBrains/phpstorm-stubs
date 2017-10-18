<?php 

namespace Phalcon\Mvc {

	interface ModuleDefinitionInterface {

		public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector=null);


		public function registerServices(\Phalcon\DiInterface $dependencyInjector);

	}
}
