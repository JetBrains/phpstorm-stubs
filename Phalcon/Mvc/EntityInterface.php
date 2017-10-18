<?php 

namespace Phalcon\Mvc {

	interface EntityInterface {

		public function readAttribute($attribute);


		public function writeAttribute($attribute, $value);

	}
}
