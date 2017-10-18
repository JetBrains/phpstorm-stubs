<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\Multiple
	 *
	 * Handles multiples logger handlers
	 */
	
	class Multiple {

		protected $_loggers;

		protected $_formatter;

		protected $_logLevel;

		public function getLoggers(){ }


		public function getFormatter(){ }


		public function getLogLevel(){ }


		/**
		 * Pushes a logger to the logger tail
		 */
		public function push(\Phalcon\Logger\AdapterInterface $logger){ }


		/**
		 * Sets a global formatter
		 */
		public function setFormatter(\Phalcon\Logger\FormatterInterface $formatter){ }


		/**
		 * Sets a global level
		 */
		public function setLogLevel($level){ }


		/**
		 * Sends a message to each registered logger
		 */
		public function log($type, $message=null, $context=null){ }


		/**
		 * Sends/Writes an critical message to the log
		 */
		public function critical($message, $context=null){ }


		/**
		 * Sends/Writes an emergency message to the log
		 */
		public function emergency($message, $context=null){ }


		/**
		 * Sends/Writes a debug message to the log
		 */
		public function debug($message, $context=null){ }


		/**
		 * Sends/Writes an error message to the log
		 */
		public function error($message, $context=null){ }


		/**
		 * Sends/Writes an info message to the log
		 */
		public function info($message, $context=null){ }


		/**
		 * Sends/Writes a notice message to the log
		 */
		public function notice($message, $context=null){ }


		/**
		 * Sends/Writes a warning message to the log
		 */
		public function warning($message, $context=null){ }


		/**
		 * Sends/Writes an alert message to the log
		 */
		public function alert($message, $context=null){ }

	}
}
