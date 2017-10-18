<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\Numericality
	 *
	 * Allows to validate if a field has a valid numeric format
	 *
	 * This validator is only for use with Phalcon\Mvc\Collection. If you are using
	 * Phalcon\Mvc\Model, please use the validators provided by Phalcon\Validation.
	 *
	 *<code>
	 * use Phalcon\Mvc\Model\Validator\Numericality as NumericalityValidator;
	 *
	 * class Products extends \Phalcon\Mvc\Collection
	 * {
	 *     public function validation()
	 *     {
	 *         $this->validate(
	 *             new NumericalityValidator(
	 *                 [
	 *                     "field" => "price",
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
	 * @see Phalcon\Validation\Validator\Numericality
	 */
	
	class Numericality extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		/**
		 * Executes the validator
		 */
		public function validate(\Phalcon\Mvc\EntityInterface $record){ }

	}
}
