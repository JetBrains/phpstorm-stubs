<?php 

namespace Phalcon\Config\Adapter {

	/**
	 * Phalcon\Config\Adapter\Yaml
	 *
	 * Reads YAML files and converts them to Phalcon\Config objects.
	 *
	 * Given the following configuration file:
	 *
	 *<code>
	 * phalcon:
	 *   baseuri:        /phalcon/
	 *   controllersDir: !approot  /app/controllers/
	 * models:
	 *   metadata: memory
	 *</code>
	 *
	 * You can read it as follows:
	 *
	 *<code>
	 * define(
	 *     "APPROOT",
	 *     dirname(__DIR__)
	 * );
	 *
	 * $config = new \Phalcon\Config\Adapter\Yaml(
	 *     "path/config.yaml",
	 *     [
	 *         "!approot" => function($value) {
	 *             return APPROOT . $value;
	 *         },
	 *     ]
	 * );
	 *
	 * echo $config->phalcon->controllersDir;
	 * echo $config->phalcon->baseuri;
	 * echo $config->models->metadata;
	 *</code>
	 */
	
	class Yaml extends \Phalcon\Config implements \Countable, \ArrayAccess {

		const DEFAULT_PATH_DELIMITER = .;

		/**
		 * \Phalcon\Config\Adapter\Yaml constructor
		 *
		 * @throws \Phalcon\Config\Exception
		 */
		public function __construct($filePath, $callbacks=null){ }

	}
}
