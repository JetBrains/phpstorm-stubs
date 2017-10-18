<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Between
	 *
	 * Validates that a value is between an inclusive range of two values.
	 * For a value x, the test is passed if minimum<=x<=maximum.
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\Between;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "price",
	 *     new Between(
	 *         [
	 *             "minimum" => 0,
	 *             "maximum" => 100,
	 *             "message" => "The price must be between 0 and 100",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "price",
	 *         "amount",
	 *     ],
	 *     new Between(
	 *         [
	 *             "minimum" => [
	 *                 "price"  => 0,
	 *                 "amount" => 0,
	 *             ],
	 *             "maximum" => [
	 *                 "price"  => 100,
	 *                 "amount" => 50,
	 *             ],
	 *             "message" => [
	 *                 "price"  => "The price must be between 0 and 100",
	 *                 "amount" => "The amount must be between 0 and 50",
	 *             ],
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class Between extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
