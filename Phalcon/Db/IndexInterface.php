<?php 

namespace Phalcon\Db {

	interface IndexInterface {

		public function getName();


		public function getColumns();


		public function getType();


		public static function __set_state($data);

	}
}
