<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Alnum
	 *
	 * Check for alphanumeric character(s)
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\Alnum as AlnumValidator;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "username",
	 *     new AlnumValidator(
	 *         [
	 *             "message" => ":field must contain only alphanumeric characters",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "username",
	 *         "name",
	 *     ],
	 *     new AlnumValidator(
	 *         [
	 *             "message" => [
	 *                 "username" => "username must contain only alphanumeric characters",
	 *                 "name"     => "name must contain only alphanumeric characters",
	 *             ],
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class Alnum extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
