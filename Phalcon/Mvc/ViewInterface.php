<?php 

namespace Phalcon\Mvc {

	interface ViewInterface {

		public function setLayoutsDir($layoutsDir);


		public function getLayoutsDir();


		public function setPartialsDir($partialsDir);


		public function getPartialsDir();


		public function setBasePath($basePath);


		public function getBasePath();


		public function setRenderLevel($level);


		public function setMainView($viewPath);


		public function getMainView();


		public function setLayout($layout);


		public function getLayout();


		public function setTemplateBefore($templateBefore);


		public function cleanTemplateBefore();


		public function setTemplateAfter($templateAfter);


		public function cleanTemplateAfter();


		public function getControllerName();


		public function getActionName();


		public function getParams();


		public function start();


		public function registerEngines($engines);


		public function render($controllerName, $actionName, $params=null);


		public function pick($renderView);


		public function finish();


		public function getActiveRenderPath();


		public function disable();


		public function enable();


		public function reset();


		public function isDisabled();

	}
}
