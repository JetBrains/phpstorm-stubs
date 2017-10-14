<?php 

namespace Phalcon\Translate {

	/**
	 * Loads Translate Adapter class using 'adapter' option
	 *
	 *<code>
	 * use Phalcon\Translate\Factory;
	 *
	 * $options = [
	 *     "locale"        => "de_DE.UTF-8",
	 *     "defaultDomain" => "translations",
	 *     "directory"     => "/path/to/application/locales",
	 *     "category"      => LC_MESSAGES,
	 *     "adapter"       => "gettext",
	 * ];
	 * $translate = Factory::load($options);
	 *</code>
	 */
	
	class Factory extends \Phalcon\Factory implements \Phalcon\FactoryInterface {

		/**
		 * @param \Phalcon\Config|array config
		 */
		public static function load($config){ }

	}
}
