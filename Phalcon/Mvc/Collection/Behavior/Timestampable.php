<?php 

namespace Phalcon\Mvc\Collection\Behavior {

	/**
	 * Phalcon\Mvc\Collection\Behavior\Timestampable
	 *
	 * Allows to automatically update a model’s attribute saving the
	 * datetime when a record is created or updated
	 */
	
	class Timestampable extends \Phalcon\Mvc\Collection\Behavior implements \Phalcon\Mvc\Collection\BehaviorInterface {

		/**
		 * Listens for notifications from the models manager
		 */
		public function notify($type, \Phalcon\Mvc\CollectionInterface $model){ }

	}
}
