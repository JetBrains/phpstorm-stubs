<?php 

namespace Phalcon\Mvc\Router {

	/**
	 * Phalcon\Mvc\Router\Annotations
	 *
	 * A router that reads routes annotations from classes/resources
	 *
	 * <code>
	 * use Phalcon\Mvc\Router\Annotations;
	 *
	 * $di->setShared(
	 *     "router",
	 *     function() {
	 *         // Use the annotations router
	 *         $router = new Annotations(false);
	 *
	 *         // This will do the same as above but only if the handled uri starts with /robots
	 *         $router->addResource("Robots", "/robots");
	 *
	 *         return $router;
	 *     }
	 * );
	 * </code>
	 */
	
	class Annotations extends \Phalcon\Mvc\Router implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Mvc\RouterInterface, \Phalcon\Di\InjectionAwareInterface {

		const URI_SOURCE_GET_URL = 0;

		const URI_SOURCE_SERVER_REQUEST_URI = 1;

		const POSITION_FIRST = 0;

		const POSITION_LAST = 1;

		protected $_handlers;

		protected $_controllerSuffix;

		protected $_actionSuffix;

		protected $_routePrefix;

		/**
		 * Adds a resource to the annotations handler
		 * A resource is a class that contains routing annotations
		 */
		public function addResource($handler, $prefix=null){ }


		/**
		 * Adds a resource to the annotations handler
		 * A resource is a class that contains routing annotations
		 * The class is located in a module
		 */
		public function addModuleResource($module, $handler, $prefix=null){ }


		/**
		 * Produce the routing parameters from the rewrite information
		 */
		public function handle($uri=null){ }


		/**
		 * Checks for annotations in the controller docblock
		 */
		public function processControllerAnnotation($handler, \Phalcon\Annotations\Annotation $annotation){ }


		/**
		 * Checks for annotations in the public methods of the controller
		 */
		public function processActionAnnotation($module, $namespaceName, $controller, $action, \Phalcon\Annotations\Annotation $annotation){ }


		/**
		 * Changes the controller class suffix
		 */
		public function setControllerSuffix($controllerSuffix){ }


		/**
		 * Changes the action method suffix
		 */
		public function setActionSuffix($actionSuffix){ }


		/**
		 * Return the registered resources
		 */
		public function getResources(){ }

	}
}
