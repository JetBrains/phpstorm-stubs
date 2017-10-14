<?php 

namespace Phalcon\Flash {

	/**
	 * Phalcon\Flash\Direct
	 *
	 * This is a variant of the Phalcon\Flash that immediately outputs any message passed to it
	 */
	
	class Direct extends \Phalcon\Flash implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\FlashInterface {

		/**
		 * Outputs a message
		 */
		public function message($type, $message){ }


		/**
		 * Prints the messages accumulated in the flasher
		 */
		public function output($remove=null){ }

	}
}
