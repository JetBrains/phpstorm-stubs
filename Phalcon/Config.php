<?php 

namespace Phalcon {

	/**
	 * Phalcon\Config
	 *
	 * Phalcon\Config is designed to simplify the access to, and the use of, configuration data within applications.
	 * It provides a nested object property based user interface for accessing this configuration data within
	 * application code.
	 *
	 *<code>
	 * $config = new \Phalcon\Config(
	 *     [
	 *         "database" => [
	 *             "adapter"  => "Mysql",
	 *             "host"     => "localhost",
	 *             "username" => "scott",
	 *             "password" => "cheetah",
	 *             "dbname"   => "test_db",
	 *         ],
	 *         "phalcon" => [
	 *             "controllersDir" => "../app/controllers/",
	 *             "modelsDir"      => "../app/models/",
	 *             "viewsDir"       => "../app/views/",
	 *         ],
	 *     ]
	 * );
	 *</code>
	 */
	
	class Config implements \ArrayAccess, \Countable {

		const DEFAULT_PATH_DELIMITER = .;

		protected static $_pathDelimiter;

		/**
		 * \Phalcon\Config constructor
		 */
		public function __construct($arrayConfig=null){ }


		/**
		 * Allows to check whether an attribute is defined using the array-syntax
		 *
		 *<code>
		 * var_dump(
		 *     isset($config["database"])
		 * );
		 *</code>
		 */
		public function offsetExists($index){ }


		/**
		 * Returns a value from current config using a dot separated path.
		 *
		 *<code>
		 * echo $config->path("unknown.path", "default", ".");
		 *</code>
		 */
		public function path($path, $defaultValue=null, $delimiter=null){ }


		/**
		 * Gets an attribute from the configuration, if the attribute isn't defined returns null
		 * If the value is exactly null or is not defined the default value will be used instead
		 *
		 *<code>
		 * echo $config->get("controllersDir", "../app/controllers/");
		 *</code>
		 */
		public function get($index, $defaultValue=null){ }


		/**
		 * Gets an attribute using the array-syntax
		 *
		 *<code>
		 * print_r(
		 *     $config["database"]
		 * );
		 *</code>
		 */
		public function offsetGet($index){ }


		/**
		 * Sets an attribute using the array-syntax
		 *
		 *<code>
		 * $config["database"] = [
		 *     "type" => "Sqlite",
		 * ];
		 *</code>
		 */
		public function offsetSet($index, $value){ }


		/**
		 * Unsets an attribute using the array-syntax
		 *
		 *<code>
		 * unset($config["database"]);
		 *</code>
		 */
		public function offsetUnset($index){ }


		/**
		 * Merges a configuration into the current one
		 *
		 *<code>
		 * $appConfig = new \Phalcon\Config(
		 *     [
		 *         "database" => [
		 *             "host" => "localhost",
		 *         ],
		 *     ]
		 * );
		 *
		 * $globalConfig->merge($appConfig);
		 *</code>
		 */
		public function merge(\Phalcon\Config $config){ }


		/**
		 * Converts recursively the object to an array
		 *
		 *<code>
		 * print_r(
		 *     $config->toArray()
		 * );
		 *</code>
		 */
		public function toArray(){ }


		/**
		 * Returns the count of properties set in the config
		 *
		 *<code>
		 * print count($config);
		 *</code>
		 *
		 * or
		 *
		 *<code>
		 * print $config->count();
		 *</code>
		 */
		public function count(){ }


		/**
		 * Restores the state of a \Phalcon\Config object
		 */
		public static function __set_state($data){ }


		/**
		 * Sets the default path delimiter
		 */
		public static function setPathDelimiter($delimiter=null){ }


		/**
		 * Gets the default path delimiter
		 */
		public static function getPathDelimiter(){ }


		/**
		 * Helper method for merge configs (forwarding nested config instance)
		 *
		 * @param Config config
		 * @param Config instance = null
		 *
		 * @return Config merged config
		 */
		final protected function _merge(\Phalcon\Config $config, $instance=null){ }

	}
}
