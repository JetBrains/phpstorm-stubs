<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Regex
	 *
	 * Allows validate if the value of a field matches a regular expression
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\Regex as RegexValidator;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "created_at",
	 *     new RegexValidator(
	 *         [
	 *             "pattern" => "/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])$/",
	 *             "message" => "The creation date is invalid",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "created_at",
	 *         "name",
	 *     ],
	 *     new RegexValidator(
	 *         [
	 *             "pattern" => [
	 *                 "created_at" => "/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])$/",
	 *                 "name"       => "/^[a-z]$/",
	 *             ],
	 *             "message" => [
	 *                 "created_at" => "The creation date is invalid",
	 *                 "name"       => "The name is invalid",
	 *             ]
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class Regex extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
