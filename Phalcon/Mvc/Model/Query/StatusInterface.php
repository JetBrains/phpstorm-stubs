<?php 

namespace Phalcon\Mvc\Model\Query {

	interface StatusInterface {

		public function getModel();


		public function getMessages();


		public function success();

	}
}
