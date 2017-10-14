<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Identical
	 *
	 * Checks if a value is identical to other
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\Identical;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "terms",
	 *     new Identical(
	 *         [
	 *             "accepted" => "yes",
	 *             "message" => "Terms and conditions must be accepted",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "terms",
	 *         "anotherTerms",
	 *     ],
	 *     new Identical(
	 *         [
	 *             "accepted" => [
	 *                 "terms"        => "yes",
	 *                 "anotherTerms" => "yes",
	 *             ],
	 *             "message" => [
	 *                 "terms"        => "Terms and conditions must be accepted",
	 *                 "anotherTerms" => "Another terms  must be accepted",
	 *             ],
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class Identical extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
