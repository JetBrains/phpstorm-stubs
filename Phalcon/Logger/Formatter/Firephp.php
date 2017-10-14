<?php 

namespace Phalcon\Logger\Formatter {

	/**
	 * Phalcon\Logger\Formatter\Firephp
	 *
	 * Formats messages so that they can be sent to FirePHP
	 */
	
	class Firephp extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface {

		protected $_showBacktrace;

		protected $_enableLabels;

		/**
		 * Returns the string meaning of a logger constant
		 */
		public function getTypeString($type){ }


		/**
		 * Returns the string meaning of a logger constant
		 */
		public function setShowBacktrace($isShow=null){ }


		/**
		 * Returns the string meaning of a logger constant
		 */
		public function getShowBacktrace(){ }


		/**
		 * Returns the string meaning of a logger constant
		 */
		public function enableLabels($isEnable=null){ }


		/**
		 * Returns the labels enabled
		 */
		public function labelsEnabled(){ }


		/**
		 * Applies a format to a message before sending it to the log
		 *
		 * @param string $message
		 * @param int $type
		 * @param int $timestamp
		 * @param array $context
		 *
		 * @return string
		 */
		public function format($message, $type, $timestamp, $context=null){ }

	}
}
