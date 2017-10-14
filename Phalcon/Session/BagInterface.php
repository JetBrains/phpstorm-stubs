<?php 

namespace Phalcon\Session {

	interface BagInterface {

		public function initialize();


		public function destroy();


		public function set($property, $value);


		public function get($property, $defaultValue=null);


		public function has($property);


		public function __set($property, $value);


		public function __get($property);


		public function __isset($property);

	}
}
