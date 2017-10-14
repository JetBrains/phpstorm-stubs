<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Loads Frontend Cache Adapter class using 'adapter' option
	 *
	 *<code>
	 * use Phalcon\Cache\Frontend\Factory;
	 *
	 * $options = [
	 *     "lifetime" => 172800,
	 *     "adapter"  => "data",
	 * ];
	 * $frontendCache = Factory::load($options);
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
