<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Alpha
	 *
	 * Check for alphabetic character(s)
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\Alpha as AlphaValidator;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "username",
	 *     new AlphaValidator(
	 *         [
	 *             "message" => ":field must contain only letters",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "username",
	 *         "name",
	 *     ],
	 *     new AlphaValidator(
	 *         [
	 *             "message" => [
	 *                 "username" => "username must contain only letters",
	 *                 "name"     => "name must contain only letters",
	 *             ],
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class Alpha extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
