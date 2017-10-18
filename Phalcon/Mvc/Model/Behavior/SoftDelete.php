<?php 

namespace Phalcon\Mvc\Model\Behavior {

	/**
	 * Phalcon\Mvc\Model\Behavior\SoftDelete
	 *
	 * Instead of permanently delete a record it marks the record as
	 * deleted changing the value of a flag column
	 */
	
	class SoftDelete extends \Phalcon\Mvc\Model\Behavior implements \Phalcon\Mvc\Model\BehaviorInterface {

		/**
		 * Listens for notifications from the models manager
		 */
		public function notify($type, \Phalcon\Mvc\ModelInterface $model){ }

	}
}
