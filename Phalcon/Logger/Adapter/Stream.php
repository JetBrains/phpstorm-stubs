<?php 

namespace Phalcon\Logger\Adapter {

	/**
	 * Phalcon\Logger\Adapter\Stream
	 *
	 * Sends logs to a valid PHP stream
	 *
	 * <code>
	 * use Phalcon\Logger;
	 * use Phalcon\Logger\Adapter\Stream;
	 *
	 * $logger = new Stream("php://stderr");
	 *
	 * $logger->log("This is a message");
	 * $logger->log(Logger::ERROR, "This is an error");
	 * $logger->error("This is another error");
	 * </code>
	 */
	
	class Stream extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		protected $_stream;

		/**
		 * \Phalcon\Logger\Adapter\Stream constructor
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
		 * Writes the log to the stream itself
		 */
		public function logInternal($message, $type, $time, $context){ }


		/**
		 * Closes the logger
		 */
		public function close(){ }

	}
}
