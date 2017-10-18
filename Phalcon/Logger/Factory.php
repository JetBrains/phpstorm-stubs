<?php 

namespace Phalcon\Logger {

	/**
	 * Loads Logger Adapter class using 'adapter' option
	 *
	 *<code>
	 * use Phalcon\Logger\Factory;
	 *
	 * $options = [
	 *     "name"    => "log.txt",
	 *     "adapter" => "file",
	 * ];
	 * $logger = Factory::load($options);
	 *</code>
	 */
	
	class Factory extends \Phalcon\Factory implements \Phalcon\FactoryInterface {

		/**
		 * @param \Phalcon\Config|array config
		 */
		public static function load($config){ }


		protected static function loadClass($namespace, $config){ }

	}
}
