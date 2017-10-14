<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\Regex
	 *
	 * Allows validate if the value of a field matches a regular expression
	 *
	 * This validator is only for use with Phalcon\Mvc\Collection. If you are using
	 * Phalcon\Mvc\Model, please use the validators provided by Phalcon\Validation.
	 *
	 *<code>
	 * use Phalcon\Mvc\Model\Validator\Regex as RegexValidator;
	 *
	 * class Subscriptors extends \Phalcon\Mvc\Collection
	 * {
	 *     public function validation()
	 *     {
	 *         $this->validate(
	 *             new RegexValidator(
	 *                 [
	 *                     "field"   => "created_at",
	 *                     "pattern" => "/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])/",
	 *                 ]
	 *             )
	 *         );
	 *
	 *         if ($this->validationHasFailed() == true) {
	 *             return false;
	 *         }
	 *     }
	 * }
	 *</code>
	 *
	 * @deprecated 3.1.0
	 * @see Phalcon\Validation\Validator\Regex
	 */
	
	class Regex extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		/**
		 * Executes the validator
		 */
		public function validate(\Phalcon\Mvc\EntityInterface $record){ }

	}
}
