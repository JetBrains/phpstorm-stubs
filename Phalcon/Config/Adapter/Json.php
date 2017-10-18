<?php 

namespace Phalcon\Config\Adapter {

	/**
	 * Phalcon\Config\Adapter\Json
	 *
	 * Reads JSON files and converts them to Phalcon\Config objects.
	 *
	 * Given the following configuration file:
	 *
	 *<code>
	 * {"phalcon":{"baseuri":"\/phalcon\/"},"models":{"metadata":"memory"}}
	 *</code>
	 *
	 * You can read it as follows:
	 *
	 *<code>
	 * $config = new Phalcon\Config\Adapter\Json("path/config.json");
	 *
	 * echo $config->phalcon->baseuri;
	 * echo $config->models->metadata;
	 *</code>
	 */
	
	class Json extends \Phalcon\Config implements \Countable, \ArrayAccess {

		const DEFAULT_PATH_DELIMITER = .;

		/**
		 * \Phalcon\Config\Adapter\Json constructor
		 */
		public function __construct($filePath){ }

	}
}
