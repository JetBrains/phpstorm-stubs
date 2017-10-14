<?php 

namespace Phalcon\Assets {

	interface ResourceInterface {

		public function setType($type);


		public function getType();


		public function setFilter($filter);


		public function getFilter();


		public function setAttributes($attributes);


		public function getAttributes();


		public function getResourceKey();

	}
}
