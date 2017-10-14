<?php 

namespace Phalcon\Mvc\Collection\Behavior {

	/**
	 * Phalcon\Mvc\Collection\Behavior\SoftDelete
	 *
	 * Instead of permanently delete a record it marks the record as
	 * deleted changing the value of a flag column
	 */
	
	class SoftDelete extends \Phalcon\Mvc\Collection\Behavior implements \Phalcon\Mvc\Collection\BehaviorInterface {

		/**
		 * Listens for notifications from the models manager
		 */
		public function notify($type, \Phalcon\Mvc\CollectionInterface $model){ }

	}
}
