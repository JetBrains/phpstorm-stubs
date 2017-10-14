<?php 

namespace Phalcon\Logger\Adapter {

	/**
	 * Phalcon\Logger\Adapter\Firephp
	 *
	 * Sends logs to FirePHP
	 *
	 *<code>
	 * use Phalcon\Logger\Adapter\Firephp;
	 * use Phalcon\Logger;
	 *
	 * $logger = new Firephp();
	 *
	 * $logger->log(Logger::ERROR, "This is an error");
	 * $logger->error("This is another error");
	 *</code>
	 */
	
	class Firephp extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		private $_initialized;

		private $_index;

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
