<?php 

namespace Phalcon\Config\Adapter {

	/**
	 * Phalcon\Config\Adapter\Grouped
	 *
	 * Reads multiple files (or arrays) and merges them all together.
	 *
	 * @see Phalcon\Config\Factory::load To load Config Adapter class using 'adapter' option.
	 *
	 * <code>
	 * use Phalcon\Config\Adapter\Grouped;
	 *
	 * $config = new Grouped(
	 *     [
	 *         "path/to/config.php",
	 *         "path/to/config.dist.php",
	 *     ]
	 * );
	 * </code>
	 *
	 * <code>
	 * use Phalcon\Config\Adapter\Grouped;
	 *
	 * $config = new Grouped(
	 *     [
	 *         "path/to/config.json",
	 *         "path/to/config.dist.json",
	 *     ],
	 *     "json"
	 * );
	 * </code>
	 *
	 * <code>
	 * use Phalcon\Config\Adapter\Grouped;
	 *
	 * $config = new Grouped(
	 *     [
	 *         [
	 *             "filePath" => "path/to/config.php",
	 *             "adapter"  => "php",
	 *         ],
	 *         [
	 *             "filePath" => "path/to/config.json",
	 *             "adapter"  => "json",
	 *         ],
	 *         [
	 *             "adapter"  => "array",
	 *             "config"   => [
	 *                 "property" => "value",
	 *         ],
	 *     ],
	 * );
	 * </code>
	 */
	
	class Grouped extends \Phalcon\Config implements \Countable, \ArrayAccess {

		const DEFAULT_PATH_DELIMITER = .;

		/**
		 * \Phalcon\Config\Adapter\Grouped constructor
		 */
		public function __construct($arrayConfig, $defaultAdapter=null){ }

	}
}
