<?php 

namespace Phalcon\Logger\Formatter {

	/**
	 * Phalcon\Logger\Formatter\Line
	 *
	 * Formats messages using an one-line string
	 */
	
	class Line extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface {

		protected $_dateFormat;

		protected $_format;

		/**
		 * Default date format
		 */
		public function getDateFormat(){ }


		/**
		 * Default date format
		 */
		public function setDateFormat($dateFormat){ }


		/**
		 * Format applied to each message
		 */
		public function getFormat(){ }


		/**
		 * Format applied to each message
		 */
		public function setFormat($format){ }


		/**
		 * \Phalcon\Logger\Formatter\Line construct
		 *
		 * @param string format
		 * @param string dateFormat
		 */
		public function __construct($format=null, $dateFormat=null){ }


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
