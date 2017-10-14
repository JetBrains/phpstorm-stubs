<?php 

namespace Phalcon\Logger {

	interface FormatterInterface {

		public function format($message, $type, $timestamp, $context=null);

	}
}
