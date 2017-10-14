<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Dispatcher
	 *
	 * Dispatching is the process of taking the request object, extracting the module name,
	 * controller name, action name, and optional parameters contained in it, and then
	 * instantiating a controller and calling an action of that controller.
	 *
	 *<code>
	 * $di = new \Phalcon\Di();
	 *
	 * $dispatcher = new \Phalcon\Mvc\Dispatcher();
	 *
	 * $dispatcher->setDI($di);
	 *
	 * $dispatcher->setControllerName("posts");
	 * $dispatcher->setActionName("index");
	 * $dispatcher->setParams([]);
	 *
	 * $controller = $dispatcher->dispatch();
	 *</code>
	 */
	
	class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\DispatcherInterface, \Phalcon\Mvc\DispatcherInterface {

		const EXCEPTION_NO_DI = 0;

		const EXCEPTION_CYCLIC_ROUTING = 1;

		const EXCEPTION_HANDLER_NOT_FOUND = 2;

		const EXCEPTION_INVALID_HANDLER = 3;

		const EXCEPTION_INVALID_PARAMS = 4;

		const EXCEPTION_ACTION_NOT_FOUND = 5;

		protected $_handlerSuffix;

		protected $_defaultHandler;

		protected $_defaultAction;

		/**
		 * Sets the default controller suffix
		 */
		public function setControllerSuffix($controllerSuffix){ }


		/**
		 * Sets the default controller name
		 */
		public function setDefaultController($controllerName){ }


		/**
		 * Sets the controller name to be dispatched
		 */
		public function setControllerName($controllerName){ }


		/**
		 * Gets last dispatched controller name
		 */
		public function getControllerName(){ }


		/**
		 * Gets previous dispatched namespace name
		 */
		public function getPreviousNamespaceName(){ }


		/**
		 * Gets previous dispatched controller name
		 */
		public function getPreviousControllerName(){ }


		/**
		 * Gets previous dispatched action name
		 */
		public function getPreviousActionName(){ }


		/**
		 * Throws an internal exception
		 */
		protected function _throwDispatchException($message, $exceptionCode=null){ }


		/**
		 * Handles a user exception
		 */
		protected function _handleException(\Exception $exception){ }


		/**
		 * Forwards the execution flow to another controller/action.
		 *
		 * <code>
		 * use \Phalcon\Events\Event;
		 * use \Phalcon\Mvc\Dispatcher;
		 * use App\Backend\Bootstrap as Backend;
		 * use App\Frontend\Bootstrap as Frontend;
		 *
		 * // Registering modules
		 * $modules = [
		 *     "frontend" => [
		 *         "className" => Frontend::class,
		 *         "path"      => __DIR__ . "/app/Modules/Frontend/Bootstrap.php",
		 *         "metadata"  => [
		 *             "controllersNamespace" => "App\Frontend\Controllers",
		 *         ],
		 *     ],
		 *     "backend" => [
		 *         "className" => Backend::class,
		 *         "path"      => __DIR__ . "/app/Modules/Backend/Bootstrap.php",
		 *         "metadata"  => [
		 *             "controllersNamespace" => "App\Backend\Controllers",
		 *         ],
		 *     ],
		 * ];
		 *
		 * $application->registerModules($modules);
		 *
		 * // Setting beforeForward listener
		 * $eventsManager  = $di->getShared("eventsManager");
		 *
		 * $eventsManager->attach(
		 *     "dispatch:beforeForward",
		 *     function(Event $event, Dispatcher $dispatcher, array $forward) use ($modules) {
		 *         $metadata = $modules[$forward["module"]]["metadata"];
		 *
		 *         $dispatcher->setModuleName($forward["module"]);
		 *         $dispatcher->setNamespaceName($metadata["controllersNamespace"]);
		 *     }
		 * );
		 *
		 * // Forward
		 * $this->dispatcher->forward(
		 *     [
		 *         "module"     => "backend",
		 *         "controller" => "posts",
		 *         "action"     => "index",
		 *     ]
		 * );
		 * </code>
		 *
		 * @param array forward
		 */
		public function forward($forward){ }


		/**
		 * Possible controller class name that will be located to dispatch the request
		 */
		public function getControllerClass(){ }


		/**
		 * Returns the latest dispatched controller
		 */
		public function getLastController(){ }


		/**
		 * Returns the active controller in the dispatcher
		 */
		public function getActiveController(){ }

	}
}
