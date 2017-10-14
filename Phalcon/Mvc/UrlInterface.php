<?php 

namespace Phalcon\Mvc {

	interface UrlInterface {

		public function setBaseUri($baseUri);


		public function getBaseUri();


		public function setBasePath($basePath);


		public function getBasePath();


		public function get($uri=null, $args=null, $local=null);


		public function path($path=null);

	}
}
