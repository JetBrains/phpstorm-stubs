<?php 

namespace Phalcon\Di {

	/**
	 * Phalcon\Di\Injectable
	 *
	 * This class allows to access services in the services container by just only accessing a public property
	 * with the same name of a registered service
	 *
	 * @property \Phalcon\Mvc\Dispatcher|\Phalcon\Mvc\DispatcherInterface $dispatcher
	 * @property \Phalcon\Mvc\Router|\Phalcon\Mvc\RouterInterface $router
	 * @property \Phalcon\Mvc\Url|\Phalcon\Mvc\UrlInterface $url
	 * @property \Phalcon\Http\Request|\Phalcon\Http\RequestInterface $request
	 * @property \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface $response
	 * @property \Phalcon\Http\Response\Cookies|\Phalcon\Http\Response\CookiesInterface $cookies
	 * @property \Phalcon\Filter|\Phalcon\FilterInterface $filter
	 * @property \Phalcon\Flash\Direct $flash
	 * @property \Phalcon\Flash\Session $flashSession
	 * @property \Phalcon\Session\Adapter\Files|\Phalcon\Session\Adapter|\Phalcon\Session\AdapterInterface $session
	 * @property \Phalcon\Events\Manager|\Phalcon\Events\ManagerInterface $eventsManager
	 * @property \Phalcon\Db\AdapterInterface $db
	 * @property \Phalcon\Security $security
	 * @property \Phalcon\Crypt|\Phalcon\CryptInterface $crypt
	 * @property \Phalcon\Tag $tag
	 * @property \Phalcon\Escaper|\Phalcon\EscaperInterface $escaper
	 * @property \Phalcon\Annotations\Adapter\Memory|\Phalcon\Annotations\Adapter $annotations
	 * @property \Phalcon\Mvc\Model\Manager|\Phalcon\Mvc\Model\ManagerInterface $modelsManager
	 * @property \Phalcon\Mvc\Model\MetaData\Memory|\Phalcon\Mvc\Model\MetadataInterface $modelsMetadata
	 * @property \Phalcon\Mvc\Model\Transaction\Manager|\Phalcon\Mvc\Model\Transaction\ManagerInterface $transactionManager
	 * @property \Phalcon\Assets\Manager $assets
	 * @property \Phalcon\Di|\Phalcon\DiInterface $di
	 * @property \Phalcon\Session\Bag|\Phalcon\Session\BagInterface $persistent
	 * @property \Phalcon\Mvc\View|\Phalcon\Mvc\ViewInterface $view
	 */
	
	abstract class Injectable implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_dependencyInjector;

		protected $_eventsManager;

		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Sets the event manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Magic method __get
		 */
		public function __get($propertyName){ }

	}
}
