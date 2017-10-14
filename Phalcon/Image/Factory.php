<?php 

namespace Phalcon\Image {

	/**
	 * Loads Image Adapter class using 'adapter' option
	 *
	 *<code>
	 * use Phalcon\Image\Factory;
	 *
	 * $options = [
	 *     "width"   => 200,
	 *     "height"  => 200,
	 *     "file"    => "upload/test.jpg",
	 *     "adapter" => "imagick",
	 * ];
	 * $image = Factory::load($options);
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
