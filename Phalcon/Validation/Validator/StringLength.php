<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\StringLength
	 *
	 * Validates that a string has the specified maximum and minimum constraints
	 * The test is passed if for a string's length L, min<=L<=max, i.e. L must
	 * be at least min, and at most max.
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\StringLength as StringLength;
	 *
	 * $validator = new Validation();
	 *
	 * $validation->add(
	 *     "name_last",
	 *     new StringLength(
	 *         [
	 *             "max"            => 50,
	 *             "min"            => 2,
	 *             "messageMaximum" => "We don't like really long names",
	 *             "messageMinimum" => "We want more than just their initials",
	 *         ]
	 *     )
	 * );
	 *
	 * $validation->add(
	 *     [
	 *         "name_last",
	 *         "name_first",
	 *     ],
	 *     new StringLength(
	 *         [
	 *             "max" => [
	 *                 "name_last"  => 50,
	 *                 "name_first" => 40,
	 *             ],
	 *             "min" => [
	 *                 "name_last"  => 2,
	 *                 "name_first" => 4,
	 *             ],
	 *             "messageMaximum" => [
	 *                 "name_last"  => "We don't like really long last names",
	 *                 "name_first" => "We don't like really long first names",
	 *             ],
	 *             "messageMinimum" => [
	 *                 "name_last"  => "We don't like too short last names",
	 *                 "name_first" => "We don't like too short first names",
	 *             ]
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class StringLength extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
