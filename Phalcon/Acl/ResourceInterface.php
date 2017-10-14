<?php 

namespace Phalcon\Acl {

	interface ResourceInterface {

		public function getName();


		public function getDescription();


		public function __toString();

	}
}
