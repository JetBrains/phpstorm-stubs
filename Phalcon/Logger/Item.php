<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\Item
	 *
	 * Represents each item in a logging transaction
	 *
	 */
	
	class Item {

		protected $_type;

		protected $_message;

		protected $_time;

		protected $_context;

		/**
		 * Log type
		 */
		public function getType(){ }


		/**
		 * Log message
		 */
		public function getMessage(){ }


		/**
		 * Log timestamp
		 */
		public function getTime(){ }


		public function getContext(){ }


		/**
		 * \Phalcon\Logger\Item constructor
		 *
		 * @param string $message
		 * @param integer $type
		 * @param integer $time
		 * @param array $context
		 */
		public function __construct($message, $type, $time=null, $context=null){ }

	}
}
