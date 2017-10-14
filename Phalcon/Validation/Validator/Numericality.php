<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Numericality
	 *
	 * Check for a valid numeric value
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\Numericality;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "price",
	 *     new Numericality(
	 *         [
	 *             "message" => ":field is not numeric",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "price",
	 *         "amount",
	 *     ],
	 *     new Numericality(
	 *         [
	 *             "message" => [
	 *                 "price"  => "price is not numeric",
	 *                 "amount" => "amount is not numeric",
	 *             ]
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class Numericality extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
