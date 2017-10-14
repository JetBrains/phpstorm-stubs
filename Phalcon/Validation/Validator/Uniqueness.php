<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Uniqueness
	 *
	 * Check that a field is unique in the related table
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "username",
	 *     new UniquenessValidator(
	 *         [
	 *             "model"   => new Users(),
	 *             "message" => ":field must be unique",
	 *         ]
	 *     )
	 * );
	 * </code>
	 *
	 * Different attribute from the field:
	 * <code>
	 * $validator->add(
	 *     "username",
	 *     new UniquenessValidator(
	 *         [
	 *             "model"     => new Users(),
	 *             "attribute" => "nick",
	 *         ]
	 *     )
	 * );
	 * </code>
	 *
	 * In model:
	 * <code>
	 * $validator->add(
	 *     "username",
	 *     new UniquenessValidator()
	 * );
	 * </code>
	 *
	 * Combination of fields in model:
	 * <code>
	 * $validator->add(
	 *     [
	 *         "firstName",
	 *         "lastName",
	 *     ],
	 *     new UniquenessValidator()
	 * );
	 * </code>
	 *
	 * It is possible to convert values before validation. This is useful in
	 * situations where values need to be converted to do the database lookup:
	 *
	 * <code>
	 * $validator->add(
	 *     "username",
	 *     new UniquenessValidator(
	 *         [
	 *             "convert" => function (array $values) {
	 *                 $values["username"] = strtolower($values["username"]);
	 *
	 *                 return $values;
	 *             }
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class Uniqueness extends \Phalcon\Validation\CombinedFieldsValidator implements \Phalcon\Validation\ValidatorInterface {

		private $columnMap;

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }


		protected function isUniqueness(\Phalcon\Validation $validation, $field){ }


		/**
		 * The column map is used in the case to get real column name
		 */
		protected function getColumnNameReal($record, $field){ }


		/**
		 * Uniqueness method used for model
		 */
		protected function isUniquenessModel($record, $field, $values){ }


		/**
		 * Uniqueness method used for collection
		 */
		protected function isUniquenessCollection($record, $field, $values){ }

	}
}
