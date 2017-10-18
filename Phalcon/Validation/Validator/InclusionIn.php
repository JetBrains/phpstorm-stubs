<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\InclusionIn
	 *
	 * Check if a value is included into a list of values
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\InclusionIn;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "status",
	 *     new InclusionIn(
	 *         [
	 *             "message" => "The status must be A or B",
	 *             "domain"  => ["A", "B"],
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "status",
	 *         "type",
	 *     ],
	 *     new InclusionIn(
	 *         [
	 *             "message" => [
	 *                 "status" => "The status must be A or B",
	 *                 "type"   => "The status must be 1 or 2",
	 *             ],
	 *             "domain" => [
	 *                 "status" => ["A", "B"],
	 *                 "type"   => [1, 2],
	 *             ]
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class InclusionIn extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
