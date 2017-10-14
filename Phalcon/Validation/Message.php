<?php 

namespace Phalcon\Validation {

	/**
	 * Phalcon\Validation\Message
	 *
	 * Encapsulates validation info generated in the validation process
	 */
	
	class Message implements \Phalcon\Validation\MessageInterface {

		protected $_type;

		protected $_message;

		protected $_field;

		protected $_code;

		/**
		 * \Phalcon\Validation\Message constructor
		 */
		public function __construct($message, $field=null, $type=null, $code=null){ }


		/**
		 * Sets message type
		 */
		public function setType($type){ }


		/**
		 * Returns message type
		 */
		public function getType(){ }


		/**
		 * Sets verbose message
		 */
		public function setMessage($message){ }


		/**
		 * Returns verbose message
		 */
		public function getMessage(){ }


		/**
		 * Sets field name related to message
		 */
		public function setField($field){ }


		/**
		 * Returns field name related to message
		 *
		 * @return mixed
		 */
		public function getField(){ }


		/**
		 * Sets code for the message
		 */
		public function setCode($code){ }


		/**
		 * Returns the message code
		 */
		public function getCode(){ }


		/**
		 * Magic __toString method returns verbose message
		 */
		public function __toString(){ }


		/**
		 * Magic __set_state helps to recover messages from serialization
		 */
		public static function __set_state($message){ }

	}
}
