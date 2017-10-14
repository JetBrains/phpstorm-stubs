<?php 

namespace Phalcon\Mvc\Micro {

	interface MiddlewareInterface {

		public function call(\Phalcon\Mvc\Micro $application);

	}
}
