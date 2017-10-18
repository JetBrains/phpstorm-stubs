<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Message
	 *
	 * Encapsulates validation info generated before save/delete records fails
	 *
	 *<code>
	 * use Phalcon\Mvc\Model\Message as Message;
	 *
	 * class Robots extends \Phalcon\Mvc\Model
	 * {
	 *     public function beforeSave()
	 *     {
	 *         if ($this->name === "Peter") {
	 *             $text  = "A robot cannot be named Peter";
	 *             $field = "name";
	 *             $type  = "InvalidValue";
	 *
	 *             $message = new Message($text, $field, $type);
	 *
	 *             $this->appendMessage($message);
	 *         }
	 *     }
	 * }
	 * </code>
	 *
	 */
	
	class Message implements \Phalcon\Mvc\Model\MessageInterface {

		protected $_type;

		protected $_message;

		protected $_field;

		protected $_model;

		protected $_code;

		/**
		 * \Phalcon\Mvc\Model\Message constructor
		 *
		 * @param string message
		 * @param string|array field
		 * @param string type
		 * @param \Phalcon\Mvc\ModelInterface model
		 * @param int|null code
		 */
		public function __construct($message, $field=null, $type=null, $model=null, $code=null){ }


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
		 */
		public function getField(){ }


		/**
		 * Set the model who generates the message
		 */
		public function setModel(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Sets code for the message
		 */
		public function setCode($code){ }


		/**
		 * Returns the model that produced the message
		 */
		public function getModel(){ }


		/**
		 * Returns the message code
		 */
		public function getCode(){ }


		/**
		 * Magic __toString method returns verbose message
		 */
		public function __toString(){ }


		/**
		 * Magic __set_state helps to re-build messages variable exporting
		 */
		public static function __set_state($message){ }

	}
}
