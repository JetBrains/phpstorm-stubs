<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\StringLength
	 *
	 * Simply validates specified string length constraints
	 *
	 * This validator is only for use with Phalcon\Mvc\Collection. If you are using
	 * Phalcon\Mvc\Model, please use the validators provided by Phalcon\Validation.
	 *
	 *<code>
	 * use Phalcon\Mvc\Model\Validator\StringLength as StringLengthValidator;
	 *
	 * class Subscriptors extends \Phalcon\Mvc\Collection
	 * {
	 *     public function validation()
	 *     {
	 *         $this->validate(
	 *             new StringLengthValidator(
	 *                 [
	 *                     "field"          => "name_last",
	 *                     "max"            => 50,
	 *                     "min"            => 2,
	 *                     "messageMaximum" => "We don't like really long names",
	 *                     "messageMinimum" => "We want more than just their initials",
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
	 * @see Phalcon\Validation\Validator\StringLength
	 */
	
	class StringLength extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		/**
		 * Executes the validator
		 */
		public function validate(\Phalcon\Mvc\EntityInterface $record){ }

	}
}
