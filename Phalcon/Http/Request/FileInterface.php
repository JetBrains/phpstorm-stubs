<?php 

namespace Phalcon\Http\Request {

	interface FileInterface {

		public function getSize();


		public function getName();


		public function getTempName();


		public function getType();


		public function getRealType();


		public function moveTo($destination);

	}
}
