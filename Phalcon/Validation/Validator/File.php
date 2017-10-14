<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\File
	 *
	 * Checks if a value has a correct file
	 *
	 * <code>
	 * use Phalcon\Validation;
	 * use Phalcon\Validation\Validator\File as FileValidator;
	 *
	 * $validator = new Validation();
	 *
	 * $validator->add(
	 *     "file",
	 *     new FileValidator(
	 *         [
	 *             "maxSize"              => "2M",
	 *             "messageSize"          => ":field exceeds the max filesize (:max)",
	 *             "allowedTypes"         => [
	 *                 "image/jpeg",
	 *                 "image/png",
	 *             ],
	 *             "messageType"          => "Allowed file types are :types",
	 *             "maxResolution"        => "800x600",
	 *             "messageMaxResolution" => "Max resolution of :field is :max",
	 *         ]
	 *     )
	 * );
	 *
	 * $validator->add(
	 *     [
	 *         "file",
	 *         "anotherFile",
	 *     ],
	 *     new FileValidator(
	 *         [
	 *             "maxSize" => [
	 *                 "file"        => "2M",
	 *                 "anotherFile" => "4M",
	 *             ],
	 *             "messageSize" => [
	 *                 "file"        => "file exceeds the max filesize 2M",
	 *                 "anotherFile" => "anotherFile exceeds the max filesize 4M",
	 *             "allowedTypes" => [
	 *                 "file"        => [
	 *                     "image/jpeg",
	 *                     "image/png",
	 *                 ],
	 *                 "anotherFile" => [
	 *                     "image/gif",
	 *                     "image/bmp",
	 *                 ],
	 *             ],
	 *             "messageType" => [
	 *                 "file"        => "Allowed file types are image/jpeg and image/png",
	 *                 "anotherFile" => "Allowed file types are image/gif and image/bmp",
	 *             ],
	 *             "maxResolution" => [
	 *                 "file"        => "800x600",
	 *                 "anotherFile" => "1024x768",
	 *             ],
	 *             "messageMaxResolution" => [
	 *                 "file"        => "Max resolution of file is 800x600",
	 *                 "anotherFile" => "Max resolution of file is 1024x768",
	 *             ],
	 *         ]
	 *     )
	 * );
	 * </code>
	 */
	
	class File extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }


		/**
		 * Check on empty
		 */
		public function isAllowEmpty(\Phalcon\Validation $validation, $field){ }

	}
}
