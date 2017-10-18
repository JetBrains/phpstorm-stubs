<?php 

namespace Phalcon\Di {

	interface ServiceProviderInterface {

		public function register(\Phalcon\DiInterface $di);

	}
}
