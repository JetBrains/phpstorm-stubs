<?php 

namespace Phalcon\Di {

	interface InjectionAwareInterface {

		public function setDI(\Phalcon\DiInterface $dependencyInjector);


		public function getDI();

	}
}
