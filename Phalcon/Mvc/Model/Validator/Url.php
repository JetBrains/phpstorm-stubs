<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\Url
	 *
	 * Allows to validate if a field has a url format
	 *
	 * This validator is only for use with Phalcon\Mvc\Collection. If you are using
	 * Phalcon\Mvc\Model, please use the validators provided by Phalcon\Validation.
	 *
	 *<code>
	 * use Phalcon\Mvc\Model\Validator\Url as UrlValidator;
	 *
	 * class Posts extends \Phalcon\Mvc\Collection
	 * {
	 *     public function validation()
	 *     {
	 *         $this->validate(
	 *             new UrlValidator(
	 *                 [
	 *                     "field" => "source_url",
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
	 * @see Phalcon\Validation\Validator\Url
	 */
	
	class Url extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		/**
		 * Executes the validator
		 */
		public function validate(\Phalcon\Mvc\EntityInterface $record){ }

	}
}
