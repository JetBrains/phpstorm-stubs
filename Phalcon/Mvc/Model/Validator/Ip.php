<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\IP
	 *
	 * Validates that a value is ipv4 address in valid range
	 *
	 * This validator is only for use with Phalcon\Mvc\Collection. If you are using
	 * Phalcon\Mvc\Model, please use the validators provided by Phalcon\Validation.
	 *
	 *<code>
	 * use Phalcon\Mvc\Model\Validator\Ip;
	 *
	 * class Data extends \Phalcon\Mvc\Collection
	 * {
	 *     public function validation()
	 *     {
	 *         // Any pubic IP
	 *         $this->validate(
	 *             new IP(
	 *                 [
	 *                     "field"         => "server_ip",
	 *                     "version"       => IP::VERSION_4 | IP::VERSION_6, // v6 and v4. The same if not specified
	 *                     "allowReserved" => false,   // False if not specified. Ignored for v6
	 *                     "allowPrivate"  => false,   // False if not specified
	 *                     "message"       => "IP address has to be correct",
	 *                 ]
	 *             )
	 *         );
	 *
	 *         // Any public v4 address
	 *         $this->validate(
	 *             new IP(
	 *                 [
	 *                     "field"   => "ip_4",
	 *                     "version" => IP::VERSION_4,
	 *                     "message" => "IP address has to be correct",
	 *                 ]
	 *             )
	 *         );
	 *
	 *         // Any v6 address
	 *         $this->validate(
	 *             new IP(
	 *                 [
	 *                     "field"        => "ip6",
	 *                     "version"      => IP::VERSION_6,
	 *                     "allowPrivate" => true,
	 *                     "message"      => "IP address has to be correct",
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
	 */
	
	class Ip extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		const VERSION_4 = 1048576;

		const VERSION_6 = 2097152;

		/**
		 * Executes the validator
		 */
		public function validate(\Phalcon\Mvc\EntityInterface $record){ }

	}
}
