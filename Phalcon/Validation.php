<?php 

namespace Phalcon {

	/**
	 * Phalcon\Validation
	 *
	 * Allows to validate data using custom or built-in validators
	 */
	
	class Validation extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\ValidationInterface {

		protected $_data;

		protected $_entity;

		protected $_validators;

		protected $_combinedFieldsValidators;

		protected $_filters;

		protected $_messages;

		protected $_defaultMessages;

		protected $_labels;

		protected $_values;

		public function getData(){ }


		public function setValidators($validators){ }


		/**
		 * \Phalcon\Validation constructor
		 */
		public function __construct($validators=null){ }


		/**
		 * Validate a set of data according to a set of rules
		 *
		 * @param array|object data
		 * @param object entity
		 * @return \Phalcon\Validation\Message\Group
		 */
		public function validate($data=null, $entity=null){ }


		/**
		 * Adds a validator to a field
		 */
		public function add($field, \Phalcon\Validation\ValidatorInterface $validator){ }


		/**
		 * Alias of `add` method
		 */
		public function rule($field, \Phalcon\Validation\ValidatorInterface $validator){ }


		/**
		 * Adds the validators to a field
		 */
		public function rules($field, $validators){ }


		/**
		 * Adds filters to the field
		 *
		 * @param string field
		 * @param array|string filters
		 * @return \Phalcon\Validation
		 */
		public function setFilters($field, $filters){ }


		/**
		 * Returns all the filters or a specific one
		 *
		 * @param string field
		 * @return mixed
		 */
		public function getFilters($field=null){ }


		/**
		 * Returns the validators added to the validation
		 */
		public function getValidators(){ }


		/**
		 * Sets the bound entity
		 *
		 * @param object entity
		 */
		public function setEntity($entity){ }


		/**
		 * Returns the bound entity
		 *
		 * @return object
		 */
		public function getEntity(){ }


		/**
		 * Adds default messages to validators
		 */
		public function setDefaultMessages($messages=null){ }


		/**
		 * Get default message for validator type
		 */
		public function getDefaultMessage($type){ }


		/**
		 * Returns the registered validators
		 */
		public function getMessages(){ }


		/**
		 * Adds labels for fields
		 */
		public function setLabels($labels){ }


		/**
		 * Get label for field
		 *
		 * @param string field
		 * @return string
		 */
		public function getLabel($field){ }


		/**
		 * Appends a message to the messages list
		 */
		public function appendMessage(\Phalcon\Validation\MessageInterface $message){ }


		/**
		 * Assigns the data to an entity
		 * The entity is used to obtain the validation values
		 *
		 * @param object entity
		 * @param array|object data
		 * @return \Phalcon\Validation
		 */
		public function bind($entity, $data){ }


		/**
		 * Gets the a value to validate in the array/object data source
		 *
		 * @param string field
		 * @return mixed
		 */
		public function getValue($field){ }


		/**
		 * Internal validations, if it returns true, then skip the current validator
		 */
		protected function preChecking($field, \Phalcon\Validation\ValidatorInterface $validator){ }

	}
}
