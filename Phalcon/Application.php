<?php 

namespace Phalcon {

	/**
	 * Phalcon\Application
	 *
	 * Base class for Phalcon\Cli\Console and Phalcon\Mvc\Application.
	 */
	
	abstract class Application extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_eventsManager;

		protected $_dependencyInjector;

		protected $_defaultModule;

		protected $_modules;

		/**
		 * \Phalcon\Application
		 */
		public function __construct(\Phalcon\DiInterface $dependencyInjector=null){ }


		/**
		 * Sets the events manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Register an array of modules present in the application
		 *
		 * <code>
		 * $this->registerModules(
		 *     [
		 *         "frontend" => [
		 *             "className" => "Multiple\\Frontend\\Module",
		 *             "path"      => "../apps/frontend/Module.php",
		 *         ],
		 *         "backend" => [
		 *             "className" => "Multiple\\Backend\\Module",
		 *             "path"      => "../apps/backend/Module.php",
		 *         ],
		 *     ]
		 * );
		 * </code>
		 */
		public function registerModules($modules, $merge=null){ }


		/**
		 * Return the modules registered in the application
		 */
		public function getModules(){ }


		/**
		 * Gets the module definition registered in the application via module name
		 */
		public function getModule($name){ }


		/**
		 * Sets the module name to be used if the router doesn't return a valid module
		 */
		public function setDefaultModule($defaultModule){ }


		/**
		 * Returns the default module name
		 */
		public function getDefaultModule(){ }


		/**
		 * Handles a request
		 */
		abstract public function handle();

	}
}
