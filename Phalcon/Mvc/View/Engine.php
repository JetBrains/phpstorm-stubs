<?php 

namespace Phalcon\Mvc\View {

	/**
	 * Phalcon\Mvc\View\Engine
	 *
	 * All the template engine adapters must inherit this class. This provides
	 * basic interfacing between the engine and the Phalcon\Mvc\View component.
	 */
	
	abstract class Engine extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\View\EngineInterface {

		protected $_view;

		/**
		 * \Phalcon\Mvc\View\Engine constructor
		 */
		public function __construct(\Phalcon\Mvc\ViewBaseInterface $view, \Phalcon\DiInterface $dependencyInjector=null){ }


		/**
		 * Returns cached output on another view stage
		 */
		public function getContent(){ }


		/**
		 * Renders a partial inside another view
		 *
		 * @param string partialPath
		 * @param array params
		 * @return string
		 */
		public function partial($partialPath, $params=null){ }


		/**
		 * Returns the view component related to the adapter
		 */
		public function getView(){ }

	}
}
