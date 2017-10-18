<?php 

namespace Phalcon\Session {

	/**
	 * Loads Session Adapter class using 'adapter' option
	 *
	 *<code>
	 * use Phalcon\Session\Factory;
	 *
	 * $options = [
	 *     "uniqueId"   => "my-private-app",
	 *     "host"       => "127.0.0.1",
	 *     "port"       => 11211,
	 *     "persistent" => true,
	 *     "lifetime"   => 3600,
	 *     "prefix"     => "my_",
	 *     "adapter"    => "memcache",
	 * ];
	 * $session = Factory::load($options);
	 *</code>
	 */
	
	class Factory extends \Phalcon\Factory implements \Phalcon\FactoryInterface {

		/**
		 * @param \Phalcon\Config|array config
		 */
		public static function load($config){ }

	}
}
