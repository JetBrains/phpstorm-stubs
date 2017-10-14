<?php 

namespace Phalcon\Logger\Adapter {

	/**
	 * Phalcon\Logger\Adapter\File
	 *
	 * Adapter to store logs in plain text files
	 *
	 *<code>
	 * $logger = new \Phalcon\Logger\Adapter\File("app/logs/test.log");
	 *
	 * $logger->log("This is a message");
	 * $logger->log(\Phalcon\Logger::ERROR, "This is an error");
	 * $logger->error("This is another error");
	 *
	 * $logger->close();
	 *</code>
	 */
	
	class File extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		protected $_fileHandler;

		protected $_path;

		protected $_options;

		/**
		 * File Path
		 */
		public function getPath(){ }


		/**
		 * \Phalcon\Logger\Adapter\File constructor
		 *
		 * @param string name
		 * @param array options
		 */
		public function __construct($name, $options=null){ }


		/**
		 * Returns the internal formatter
		 */
		public function getFormatter(){ }


		/**
		 * Writes the log to the file itself
		 */
		public function logInternal($message, $type, $time, $context){ }


		/**
		 * Closes the logger
		 */
		public function close(){ }


		/**
		 * Opens the internal file handler after unserialization
		 */
		public function __wakeup(){ }

	}
}
