<?php 

namespace Phalcon\Cli {

	/**
	 * Phalcon\Cli\Task
	 *
	 * Every command-line task should extend this class that encapsulates all the task functionality
	 *
	 * A task can be used to run "tasks" such as migrations, cronjobs, unit-tests, or anything that you want.
	 * The Task class should at least have a "mainAction" method
	 *
	 *<code>
	 * class HelloTask extends \Phalcon\Cli\Task
	 * {
	 *     // This action will be executed by default
	 *     public function mainAction()
	 *     {
	 *
	 *     }
	 *
	 *     public function findAction()
	 *     {
	 *
	 *     }
	 * }
	 *</code>
	 */
	
	class Task extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Cli\TaskInterface {

		/**
		 * \Phalcon\Cli\Task constructor
		 */
		final public function __construct(){ }

	}
}
