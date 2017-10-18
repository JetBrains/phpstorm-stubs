<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\PresenceOf
	 *
	 * Validates that a value is not null or empty string
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\PresenceOf;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "name",
	 *     new PresenceOf(
	 *         [
	 *             "message" => "The name is required",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "name",
	 *         "email",
	 *     ],
	 *     new PresenceOf(
	 *         [
	 *             "message" => [
	 *                 "name"  => "The name is required",
	 *                 "email" => "The email is required",
	 *             ],
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class PresenceOf extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
