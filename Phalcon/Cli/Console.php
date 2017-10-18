<?php 

namespace Phalcon\Cli {

	/**
	 * Phalcon\Cli\Console
	 *
	 * This component allows to create CLI applications using Phalcon
	 */
	
	class Console extends \Phalcon\Application implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_arguments;

		protected $_options;

		/**
		 * Merge modules with the existing ones
		 *
		 *<code>
		 * $application->addModules(
		 *     [
		 *         "admin" => [
		 *             "className" => "Multiple\\Admin\\Module",
		 *             "path"      => "../apps/admin/Module.php",
		 *         ],
		 *     ]
		 * );
		 *</code>
		 */
		public function addModules($modules){ }


		/**
		 * Handle the whole command-line tasks
		 */
		public function handle($arguments=null){ }


		/**
		 * Set an specific argument
		 */
		public function setArgument($arguments=null, $str=null, $shift=null){ }

	}
}
