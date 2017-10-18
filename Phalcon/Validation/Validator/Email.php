<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Email
	 *
	 * Checks if a value has a correct e-mail format
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\Email as EmailValidator;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "email",
	 *     new EmailValidator(
	 *         [
	 *             "message" => "The e-mail is not valid",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "email",
	 *         "anotherEmail",
	 *     ],
	 *     new EmailValidator(
	 *         [
	 *             "message" => [
	 *                 "email"        => "The e-mail is not valid",
	 *                 "anotherEmail" => "The another e-mail is not valid",
	 *             ],
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class Email extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
