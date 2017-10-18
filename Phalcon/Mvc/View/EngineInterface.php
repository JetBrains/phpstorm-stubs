<?php 

namespace Phalcon\Mvc\View {

	interface EngineInterface {

		public function getContent();


		public function partial($partialPath, $params=null);


		public function render($path, $params, $mustClean=null);

	}
}
