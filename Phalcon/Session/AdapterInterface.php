<?php 

namespace Phalcon\Session {

	interface AdapterInterface {

		public function start();


		public function setOptions($options);


		public function getOptions();


		public function get($index, $defaultValue=null);


		public function set($index, $value);


		public function has($index);


		public function remove($index);


		public function getId();


		public function isStarted();


		public function destroy($removeData=null);


		public function regenerateId($deleteOldSession=null);


		public function setName($name);


		public function getName();

	}
}
