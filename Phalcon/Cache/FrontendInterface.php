<?php 

namespace Phalcon\Cache {

	interface FrontendInterface {

		public function getLifetime();


		public function isBuffering();


		public function start();


		public function getContent();


		public function stop();


		public function beforeStore($data);


		public function afterRetrieve($data);

	}
}
