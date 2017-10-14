<?php 

namespace Phalcon\Mvc\Model {

	interface QueryInterface {

		public function parse();


		public function cache($cacheOptions);


		public function getCacheOptions();


		public function setUniqueRow($uniqueRow);


		public function getUniqueRow();


		public function execute($bindParams=null, $bindTypes=null);

	}
}
