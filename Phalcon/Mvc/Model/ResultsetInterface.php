<?php 

namespace Phalcon\Mvc\Model {

	interface ResultsetInterface {

		public function getType();


		public function getFirst();


		public function getLast();


		public function setIsFresh($isFresh);


		public function isFresh();


		public function getCache();


		public function toArray();

	}
}
