<?php 

namespace Phalcon\Config\Adapter {

	/**
	 * Phalcon\Config\Adapter\Ini
	 *
	 * Reads ini files and converts them to Phalcon\Config objects.
	 *
	 * Given the next configuration file:
	 *
	 *<code>
	 * [database]
	 * adapter = Mysql
	 * host = localhost
	 * username = scott
	 * password = cheetah
	 * dbname = test_db
	 *
	 * [phalcon]
	 * controllersDir = "../app/controllers/"
	 * modelsDir = "../app/models/"
	 * viewsDir = "../app/views/"
	 * </code>
	 *
	 * You can read it as follows:
	 *
	 *<code>
	 * $config = new \Phalcon\Config\Adapter\Ini("path/config.ini");
	 *
	 * echo $config->phalcon->controllersDir;
	 * echo $config->database->username;
	 *</code>
	 *
	 * PHP constants may also be parsed in the ini file, so if you define a constant
	 * as an ini value before calling the constructor, the constant's value will be
	 * integrated into the results. To use it this way you must specify the optional
	 * second parameter as INI_SCANNER_NORMAL when calling the constructor:
	 *
	 * <code>
	 * $config = new \Phalcon\Config\Adapter\Ini(
	 *     "path/config-with-constants.ini",
	 *     INI_SCANNER_NORMAL
	 * );
	 * </code>
	 */
	
	class Ini extends \Phalcon\Config implements \Countable, \ArrayAccess {

		const DEFAULT_PATH_DELIMITER = .;

		/**
		 * \Phalcon\Config\Adapter\Ini constructor
		 */
		public function __construct($filePath, $mode=null){ }


		/**
		 * Build multidimensional array from string
		 *
		 * <code>
		 * $this->_parseIniString("path.hello.world", "value for last key");
		 *
		 * // result
		 * [
		 *      "path" => [
		 *          "hello" => [
		 *              "world" => "value for last key",
		 *          ],
		 *      ],
		 * ];
		 * </code>
		 */
		protected function _parseIniString($path, $value){ }


		/**
		 * We have to cast values manually because parse_ini_file() has a poor implementation.
		 *
		 * @param mixed ini The array casted by `parse_ini_file`
		 */
		protected function _cast($ini){ }

	}
}
