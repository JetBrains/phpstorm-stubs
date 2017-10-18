<?php 

namespace Phalcon\Logger\Formatter {

	/**
	 * Phalcon\Logger\Formatter\Json
	 *
	 * Formats messages using JSON encoding
	 */
	
	class Json extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface {

		/**
		 * Applies a format to a message before sent it to the internal log
		 *
		 * @param string message
		 * @param int type
		 * @param int timestamp
		 * @param array $context
		 * @return string
		 */
		public function format($message, $type, $timestamp, $context=null){ }

	}
}
