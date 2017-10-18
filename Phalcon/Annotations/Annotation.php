<?php 

namespace Phalcon\Annotations {

	/**
	 * Phalcon\Annotations\Annotation
	 *
	 * Represents a single annotation in an annotations collection
	 */
	
	class Annotation {

		protected $_name;

		protected $_arguments;

		protected $_exprArguments;

		/**
		 * \Phalcon\Annotations\Annotation constructor
		 */
		public function __construct($reflectionData){ }


		/**
		 * Returns the annotation's name
		 */
		public function getName(){ }


		/**
		 * Resolves an annotation expression
		 *
		 * @param array expr
		 * @return mixed
		 */
		public function getExpression($expr){ }


		/**
		 * Returns the expression arguments without resolving
		 *
		 * @return array
		 */
		public function getExprArguments(){ }


		/**
		 * Returns the expression arguments
		 *
		 * @return array
		 */
		public function getArguments(){ }


		/**
		 * Returns the number of arguments that the annotation has
		 */
		public function numberArguments(){ }


		/**
		 * Returns an argument in a specific position
		 *
		 * @param int|string position
		 * @return mixed
		 */
		public function getArgument($position){ }


		/**
		 * Returns an argument in a specific position
		 *
		 * @param int|string position
		 * @return boolean
		 */
		public function hasArgument($position){ }


		/**
		 * Returns a named argument
		 *
		 * @return mixed
		 */
		public function getNamedArgument($name){ }


		/**
		 * Returns a named parameter
		 *
		 * @return mixed
		 */
		public function getNamedParameter($name){ }

	}
}
