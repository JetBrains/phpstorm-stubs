<?php 

namespace Phalcon {

	/**
	 * Phalcon\Loader
	 *
	 * This component helps to load your project classes automatically based on some conventions
	 *
	 *<code>
	 * use Phalcon\Loader;
	 *
	 * // Creates the autoloader
	 * $loader = new Loader();
	 *
	 * // Register some namespaces
	 * $loader->registerNamespaces(
	 *     [
	 *         "Example\\Base"    => "vendor/example/base/",
	 *         "Example\\Adapter" => "vendor/example/adapter/",
	 *         "Example"          => "vendor/example/",
	 *     ]
	 * );
	 *
	 * // Register autoloader
	 * $loader->register();
	 *
	 * // Requiring this class will automatically include file vendor/example/adapter/Some.php
	 * $adapter = new \Example\Adapter\Some();
	 *</code>
	 */
	
	class Loader implements \Phalcon\Events\EventsAwareInterface {

		protected $_eventsManager;

		protected $_foundPath;

		protected $_checkedPath;

		protected $_classes;

		protected $_extensions;

		protected $_namespaces;

		protected $_directories;

		protected $_files;

		protected $_registered;

		/**
		 * Sets the events manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Sets an array of file extensions that the loader must try in each attempt to locate the file
		 */
		public function setExtensions($extensions){ }


		/**
		 * Returns the file extensions registered in the loader
		 */
		public function getExtensions(){ }


		/**
		 * Register namespaces and their related directories
		 */
		public function registerNamespaces($namespaces, $merge=null){ }


		protected function prepareNamespace($namespace){ }


		/**
		 * Returns the namespaces currently registered in the autoloader
		 */
		public function getNamespaces(){ }


		/**
		 * Register directories in which "not found" classes could be found
		 */
		public function registerDirs($directories, $merge=null){ }


		/**
		 * Returns the directories currently registered in the autoloader
		 */
		public function getDirs(){ }


		/**
		 * Registers files that are "non-classes" hence need a "require". This is very useful for including files that only
		 * have functions
		 */
		public function registerFiles($files, $merge=null){ }


		/**
		 * Returns the files currently registered in the autoloader
		 */
		public function getFiles(){ }


		/**
		 * Register classes and their locations
		 */
		public function registerClasses($classes, $merge=null){ }


		/**
		 * Returns the class-map currently registered in the autoloader
		 */
		public function getClasses(){ }


		/**
		 * Register the autoload method
		 */
		public function register($prepend=null){ }


		/**
		 * Unregister the autoload method
		 */
		public function unregister(){ }


		/**
		 * Checks if a file exists and then adds the file by doing virtual require
		 */
		public function loadFiles(){ }


		/**
		 * Autoloads the registered classes
		 */
		public function autoLoad($className){ }


		/**
		 * Get the path when a class was found
		 */
		public function getFoundPath(){ }


		/**
		 * Get the path the loader is checking for a path
		 */
		public function getCheckedPath(){ }

	}
}
