<?php 

namespace Phalcon\Mvc\View\Engine {

	/**
	 * Phalcon\Mvc\View\Engine\Volt
	 *
	 * Designer friendly and fast template engine for PHP written in Zephir/C
	 */
	
	class Volt extends \Phalcon\Mvc\View\Engine implements \Phalcon\Mvc\View\EngineInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_options;

		protected $_compiler;

		protected $_macros;

		/**
		 * Set Volt's options
		 */
		public function setOptions($options){ }


		/**
		 * Return Volt's options
		 */
		public function getOptions(){ }


		/**
		 * Returns the Volt's compiler
		 */
		public function getCompiler(){ }


		/**
		 * Renders a view using the template engine
		 */
		public function render($templatePath, $params, $mustClean=null){ }


		/**
		 * Length filter. If an array/object is passed a count is performed otherwise a strlen/mb_strlen
		 */
		public function length($item){ }


		/**
		 * Checks if the needle is included in the haystack
		 */
		public function isIncluded($needle, $haystack){ }


		/**
		 * Performs a string conversion
		 */
		public function convertEncoding($text, $from, $to){ }


		/**
		 * Extracts a slice from a string/array/traversable object value
		 */
		public function slice($value, $start=null, $end=null){ }


		/**
		 * Sorts an array
		 */
		public function sort($value){ }


		/**
		 * Checks if a macro is defined and calls it
		 */
		public function callMacro($name, $arguments=null){ }

	}
}
