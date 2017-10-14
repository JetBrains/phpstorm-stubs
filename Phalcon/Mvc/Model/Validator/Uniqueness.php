<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\Uniqueness
	 *
	 * Validates that a field or a combination of a set of fields are not
	 * present more than once in the existing records of the related table
	 *
	 * This validator is only for use with Phalcon\Mvc\Collection. If you are using
	 * Phalcon\Mvc\Model, please use the validators provided by Phalcon\Validation.
	 *
	 *<code>
	 * use Phalcon\Mvc\Collection;
	 * use Phalcon\Mvc\Model\Validator\Uniqueness;
	 *
	 * class Subscriptors extends Collection
	 * {
	 *     public function validation()
	 *     {
	 *         $this->validate(
	 *             new Uniqueness(
	 *                 [
	 *                     "field"   => "email",
	 *                     "message" => "Value of field 'email' is already present in another record",
	 *                 ]
	 *             )
	 *         );
	 *
	 *         if ($this->validationHasFailed() === true) {
	 *             return false;
	 *         }
	 *     }
	 * }
	 *</code>
	 *
	 * @deprecated 3.1.0
	 * @see Phalcon\Validation\Validator\Uniqueness
	 */
	
	class Uniqueness extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		/**
		 * Executes the validator
		 */
		public function validate(\Phalcon\Mvc\EntityInterface $record){ }

	}
}
