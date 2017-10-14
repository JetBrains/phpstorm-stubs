<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\CreditCard
	 *
	 * Checks if a value has a valid credit card number
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\CreditCard as CreditCardValidator;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "creditCard",
	 *     new CreditCardValidator(
	 *         [
	 *             "message" => "The credit card number is not valid",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "creditCard",
	 *         "secondCreditCard",
	 *     ],
	 *     new CreditCardValidator(
	 *         [
	 *             "message" => [
	 *                 "creditCard"       => "The credit card number is not valid",
	 *                 "secondCreditCard" => "The second credit card number is not valid",
	 *             ],
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class CreditCard extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }


		/**
		 * is a simple checksum formula used to validate a variety of identification numbers
		 * @param  string number
		 * @return boolean
		 */
		private function verifyByLuhnAlgorithm($number){ }

	}
}
