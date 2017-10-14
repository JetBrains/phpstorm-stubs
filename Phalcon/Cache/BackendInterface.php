<?php 

namespace Phalcon\Cache {

	interface BackendInterface {

		public function start($keyName, $lifetime=null);


		public function stop($stopBuffer=null);


		public function getFrontend();


		public function getOptions();


		public function isFresh();


		public function isStarted();


		public function setLastKey($lastKey);


		public function getLastKey();


		public function get($keyName, $lifetime=null);


		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null);


		public function delete($keyName);


		public function queryKeys($prefix=null);


		public function exists($keyName=null, $lifetime=null);

	}
}
