<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Url
	 *
	 * Checks if a value has a url format
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\Url as UrlValidator;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "url",
	 *     new UrlValidator(
	 *         [
	 *             "message" => ":field must be a url",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "url",
	 *         "homepage",
	 *     ],
	 *     new UrlValidator(
	 *         [
	 *             "message" => [
	 *                 "url"      => "url must be a url",
	 *                 "homepage" => "homepage must be a url",
	 *             ]
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class Url extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
