<?php 

namespace Phalcon\Paginator {

	/**
	 * Loads Paginator Adapter class using 'adapter' option
	 *
	 *<code>
	 * use Phalcon\Paginator\Factory;
	 * $builder = $this->modelsManager->createBuilder()
	 *                 ->columns("id, name")
	 *                 ->from("Robots")
	 *                 ->orderBy("name");
	 *
	 * $options = [
	 *     "builder" => $builder,
	 *     "limit"   => 20,
	 *     "page"    => 1,
	 *     "adapter" => "queryBuilder",
	 * ];
	 * $paginator = Factory::load($options);
	 *</code>
	 */
	
	class Factory extends \Phalcon\Factory implements \Phalcon\FactoryInterface {

		/**
		 * @param \Phalcon\Config|array config
		 */
		public static function load($config){ }

	}
}
