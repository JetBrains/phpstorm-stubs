<?php 

namespace Phalcon {

	/**
	 * Phalcon\Dispatcher
	 *
	 * This is the base class for Phalcon\Mvc\Dispatcher and Phalcon\Cli\Dispatcher.
	 * This class can't be instantiated directly, you can use it to create your own dispatchers.
	 */
	
	abstract class Dispatcher implements \Phalcon\DispatcherInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		const EXCEPTION_NO_DI = 0;

		const EXCEPTION_CYCLIC_ROUTING = 1;

		const EXCEPTION_HANDLER_NOT_FOUND = 2;

		const EXCEPTION_INVALID_HANDLER = 3;

		const EXCEPTION_INVALID_PARAMS = 4;

		const EXCEPTION_ACTION_NOT_FOUND = 5;

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_activeHandler;

		protected $_finished;

		protected $_forwarded;

		protected $_moduleName;

		protected $_namespaceName;

		protected $_handlerName;

		protected $_actionName;

		protected $_params;

		protected $_returnedValue;

		protected $_lastHandler;

		protected $_defaultNamespace;

		protected $_defaultHandler;

		protected $_defaultAction;

		protected $_handlerSuffix;

		protected $_actionSuffix;

		protected $_previousNamespaceName;

		protected $_previousHandlerName;

		protected $_previousActionName;

		protected $_modelBinding;

		protected $_modelBinder;

		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Sets the events manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Sets the default action suffix
		 */
		public function setActionSuffix($actionSuffix){ }


		/**
		 * Gets the default action suffix
		 */
		public function getActionSuffix(){ }


		/**
		 * Sets the module where the controller is (only informative)
		 */
		public function setModuleName($moduleName){ }


		/**
		 * Gets the module where the controller class is
		 */
		public function getModuleName(){ }


		/**
		 * Sets the namespace where the controller class is
		 */
		public function setNamespaceName($namespaceName){ }


		/**
		 * Gets a namespace to be prepended to the current handler name
		 */
		public function getNamespaceName(){ }


		/**
		 * Sets the default namespace
		 */
		public function setDefaultNamespace($namespaceName){ }


		/**
		 * Returns the default namespace
		 */
		public function getDefaultNamespace(){ }


		/**
		 * Sets the default action name
		 */
		public function setDefaultAction($actionName){ }


		/**
		 * Sets the action name to be dispatched
		 */
		public function setActionName($actionName){ }


		/**
		 * Gets the latest dispatched action name
		 */
		public function getActionName(){ }


		/**
		 * Sets action params to be dispatched
		 *
		 * @param array params
		 */
		public function setParams($params){ }


		/**
		 * Gets action params
		 */
		public function getParams(){ }


		/**
		 * Set a param by its name or numeric index
		 *
		 * @param  mixed param
		 * @param  mixed value
		 */
		public function setParam($param, $value){ }


		/**
		 * Gets a param by its name or numeric index
		 *
		 * @param  mixed param
		 * @param  string|array filters
		 * @param  mixed defaultValue
		 * @return mixed
		 */
		public function getParam($param, $filters=null, $defaultValue=null){ }


		/**
		 * Check if a param exists
		 *
		 * @param  mixed param
		 * @return boolean
		 */
		public function hasParam($param){ }


		/**
		 * Returns the current method to be/executed in the dispatcher
		 */
		public function getActiveMethod(){ }


		/**
		 * Checks if the dispatch loop is finished or has more pendent controllers/tasks to dispatch
		 */
		public function isFinished(){ }


		/**
		 * Sets the latest returned value by an action manually
		 *
		 * @param mixed value
		 */
		public function setReturnedValue($value){ }


		/**
		 * Returns value returned by the latest dispatched action
		 *
		 * @return mixed
		 */
		public function getReturnedValue(){ }


		/**
		 * Enable/Disable model binding during dispatch
		 *
		 * <code>
		 * $di->set('dispatcher', function() {
		 *     $dispatcher = new Dispatcher();
		 *
		 *     $dispatcher->setModelBinding(true, 'cache');
		 *     return $dispatcher;
		 * });
		 * </code>
		 *
		 * @deprecated 3.1.0 Use setModelBinder method
		 * @see \Phalcon\Dispatcher::setModelBinder()
		 */
		public function setModelBinding($value, $cache=null){ }


		/**
		 * Enable model binding during dispatch
		 *
		 * <code>
		 * $di->set('dispatcher', function() {
		 *     $dispatcher = new Dispatcher();
		 *
		 *     $dispatcher->setModelBinder(new Binder(), 'cache');
		 *     return $dispatcher;
		 * });
		 * </code>
		 */
		public function setModelBinder(\Phalcon\Mvc\Model\BinderInterface $modelBinder, $cache=null){ }


		/**
		 * Gets model binder
		 */
		public function getModelBinder(){ }


		/**
		 * Process the results of the router by calling into the appropriate controller action(s)
		 * including any routing data or injected parameters.
		 *
		 * @return object|false Returns the dispatched handler class (the Controller for Mvc dispatching or a Task
		 *                      for CLI dispatching) or <tt>false</tt> if an exception occurred and the operation was
		 *                      stopped by returning <tt>false</tt> in the exception handler.
		 *
		 * @throws \Exception if any uncaught or unhandled exception occurs during the dispatcher process.
		 */
		public function dispatch(){ }


		protected function _dispatch(){ }


		/**
		 * Forwards the execution flow to another controller/action.
		 *
		 * <code>
		 * $this->dispatcher->forward(
		 *     [
		 *         "controller" => "posts",
		 *         "action"     => "index",
		 *     ]
		 * );
		 * </code>
		 *
		 * @param array forward
		 *
		 * @throws \Phalcon\Exception
		 */
		public function forward($forward){ }


		/**
		 * Check if the current executed action was forwarded by another one
		 */
		public function wasForwarded(){ }


		/**
		 * Possible class name that will be located to dispatch the request
		 */
		public function getHandlerClass(){ }


		public function callActionMethod($handler, $actionMethod, $params=null){ }


		/**
		 * Returns bound models from binder instance
		 *
		 * <code>
		 * class UserController extends Controller
		 * {
		 *     public function showAction(User $user)
		 *     {
		 *         $boundModels = $this->dispatcher->getBoundModels(); // return array with $user
		 *     }
		 * }
		 * </code>
		 */
		public function getBoundModels(){ }


		/**
		 * Set empty properties to their defaults (where defaults are available)
		 */
		protected function _resolveEmptyProperties(){ }

	}
}
