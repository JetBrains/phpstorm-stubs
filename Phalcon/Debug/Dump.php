<?php 

namespace Phalcon\Debug {

	/**
	 * Phalcon\Debug\Dump
	 *
	 * Dumps information about a variable(s)
	 *
	 * <code>
	 * $foo = 123;
	 *
	 * echo (new \Phalcon\Debug\Dump())->variable($foo, "foo");
	 * </code>
	 *
	 * <code>
	 * $foo = "string";
	 * $bar = ["key" => "value"];
	 * $baz = new stdClass();
	 *
	 * echo (new \Phalcon\Debug\Dump())->variables($foo, $bar, $baz);
	 * </code>
	 */
	
	class Dump {

		protected $_detailed;

		protected $_methods;

		protected $_styles;

		public function getDetailed(){ }


		public function setDetailed($detailed){ }


		/**
		 * \Phalcon\Debug\Dump constructor
		 *
		 * @param boolean detailed debug object's private and protected properties
		 */
		public function __construct($styles=null, $detailed=null){ }


		/**
		 * Alias of variables() method
		 *
		 * @param mixed variable
		 * @param ...
		 */
		public function all(){ }


		/**
		 * Get style for type
		 */
		protected function getStyle($type){ }


		/**
		 * Set styles for vars type
		 */
		public function setStyles($styles=null){ }


		/**
		 * Alias of variable() method
		 */
		public function one($variable, $name=null){ }


		/**
		 * Prepare an HTML string of information about a single variable.
		 */
		protected function output($variable, $name=null, $tab=null){ }


		/**
		 * Returns an HTML string of information about a single variable.
		 *
		 * <code>
		 * echo (new \Phalcon\Debug\Dump())->variable($foo, "foo");
		 * </code>
		 */
		public function variable($variable, $name=null){ }


		/**
		 * Returns an HTML string of debugging information about any number of
		 * variables, each wrapped in a "pre" tag.
		 *
		 * <code>
		 * $foo = "string";
		 * $bar = ["key" => "value"];
		 * $baz = new stdClass();
		 *
		 * echo (new \Phalcon\Debug\Dump())->variables($foo, $bar, $baz);
		 * </code>
		 *
		 * @param mixed variable
		 * @param ...
		 */
		public function variables(){ }


		/**
		 * Returns an JSON string of information about a single variable.
		 *
		 * <code>
		 * $foo = [
		 *     "key" => "value",
		 * ];
		 *
		 * echo (new \Phalcon\Debug\Dump())->toJson($foo);
		 *
		 * $foo = new stdClass();
		 * $foo->bar = "buz";
		 *
		 * echo (new \Phalcon\Debug\Dump())->toJson($foo);
		 * </code>
		 *
		 * @param mixed variable
		 */
		public function toJson($variable){ }

	}
}
