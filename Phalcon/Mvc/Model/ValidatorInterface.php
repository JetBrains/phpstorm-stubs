<?php 

namespace Phalcon\Mvc\Model {

	interface ValidatorInterface {

		public function getMessages();


		public function validate(\Phalcon\Mvc\EntityInterface $record);

	}
}
