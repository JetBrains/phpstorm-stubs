<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\Formatter
	 *
	 * This is a base class for logger formatters
	 */
	
	abstract class Formatter implements \Phalcon\Logger\FormatterInterface {

		/**
		 * Returns the string meaning of a logger constant
		 */
		public function getTypeString($type){ }


		/**
		 * Interpolates context values into the message placeholders
		 *
		 * @see http://www.php-fig.org/psr/psr-3/ Section 1.2 Message
		 * @param string $message
		 * @param array $context
		 */
		public function interpolate($message, $context=null){ }

	}
}
