<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Behavior
	 *
	 * This is an optional base class for ORM behaviors
	 */
	
	abstract class Behavior implements \Phalcon\Mvc\Model\BehaviorInterface {

		protected $_options;

		/**
		 * \Phalcon\Mvc\Model\Behavior
		 *
		 * @param array options
		 */
		public function __construct($options=null){ }


		/**
		 * Checks whether the behavior must take action on certain event
		 */
		protected function mustTakeAction($eventName){ }


		/**
		 * Returns the behavior options related to an event
		 *
		 * @param string eventName
		 * @return array
		 */
		protected function getOptions($eventName=null){ }


		/**
		 * This method receives the notifications from the EventsManager
		 */
		public function notify($type, \Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Acts as fallbacks when a missing method is called on the model
		 *
		 * @param \Phalcon\Mvc\ModelInterface model
		 * @param string method
		 * @param array arguments
		 */
		public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $method, $arguments=null){ }

	}
}
