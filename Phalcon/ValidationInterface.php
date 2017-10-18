<?php 

namespace Phalcon {

	interface ValidationInterface {

		public function validate($data=null, $entity=null);


		public function add($field, \Phalcon\Validation\ValidatorInterface $validator);


		public function rule($field, \Phalcon\Validation\ValidatorInterface $validator);


		public function rules($field, $validators);


		public function setFilters($field, $filters);


		public function getFilters($field=null);


		public function getValidators();


		public function getEntity();


		public function setDefaultMessages($messages=null);


		public function getDefaultMessage($type);


		public function getMessages();


		public function setLabels($labels);


		public function getLabel($field);


		public function appendMessage(\Phalcon\Validation\MessageInterface $message);


		public function bind($entity, $data);


		public function getValue($field);

	}
}
