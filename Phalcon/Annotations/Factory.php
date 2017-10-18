<?php 

namespace Phalcon\Annotations {

	/**
	 * Loads Annotations Adapter class using 'adapter' option
	 *
	 *<code>
	 * use Phalcon\Annotations\Factory;
	 *
	 * $options = [
	 *     "prefix"   => "annotations",
	 *     "lifetime" => "3600",
	 *     "adapter"  => "apc",
	 * ];
	 * $annotations = Factory::load($options);
	 *</code>
	 */
	
	class Factory extends \Phalcon\Factory implements \Phalcon\FactoryInterface {

		/**
		 * @param \Phalcon\Config|array config
		 */
		public static function load($config){ }

	}
}
