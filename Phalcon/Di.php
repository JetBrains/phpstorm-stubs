<?php 

namespace Phalcon {

	/**
	 * Phalcon\Di
	 *
	 * Phalcon\Di is a component that implements Dependency Injection/Service Location
	 * of services and it's itself a container for them.
	 *
	 * Since Phalcon is highly decoupled, Phalcon\Di is essential to integrate the different
	 * components of the framework. The developer can also use this component to inject dependencies
	 * and manage global instances of the different classes used in the application.
	 *
	 * Basically, this component implements the `Inversion of Control` pattern. Applying this,
	 * the objects do not receive their dependencies using setters or constructors, but requesting
	 * a service dependency injector. This reduces the overall complexity, since there is only one
	 * way to get the required dependencies within a component.
	 *
	 * Additionally, this pattern increases testability in the code, thus making it less prone to errors.
	 *
	 *<code>
	 * use Phalcon\Di;
	 * use Phalcon\Http\Request;
	 *
	 * $di = new Di();
	 *
	 * // Using a string definition
	 * $di->set("request", Request::class, true);
	 *
	 * // Using an anonymous function
	 * $di->setShared(
	 *     "request",
	 *     function () {
	 *         return new Request();
	 *     }
	 * );
	 *
	 * $request = $di->getRequest();
	 *</code>
	 */
	
	class Di implements \Phalcon\DiInterface, \ArrayAccess {

		protected $_services;

		protected $_sharedInstances;

		protected $_freshInstance;

		protected $_eventsManager;

		protected static $_default;

		/**
		 * \Phalcon\Di constructor
		 */
		public function __construct(){ }


		/**
		 * Sets the internal event manager
		 */
		public function setInternalEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getInternalEventsManager(){ }


		/**
		 * Registers a service in the services container
		 */
		public function set($name, $definition, $shared=null){ }


		/**
		 * Registers an "always shared" service in the services container
		 */
		public function setShared($name, $definition){ }


		/**
		 * Removes a service in the services container
		 * It also removes any shared instance created for the service
		 */
		public function remove($name){ }


		/**
		 * Attempts to register a service in the services container
		 * Only is successful if a service hasn't been registered previously
		 * with the same name
		 */
		public function attempt($name, $definition, $shared=null){ }


		/**
		 * Sets a service using a raw \Phalcon\Di\Service definition
		 */
		public function setRaw($name, \Phalcon\Di\ServiceInterface $rawDefinition){ }


		/**
		 * Returns a service definition without resolving
		 */
		public function getRaw($name){ }


		/**
		 * Returns a \Phalcon\Di\Service instance
		 */
		public function getService($name){ }


		/**
		 * Resolves the service based on its configuration
		 */
		public function get($name, $parameters=null){ }


		/**
		 * Resolves a service, the resolved service is stored in the DI, subsequent
		 * requests for this service will return the same instance
		 *
		 * @param string name
		 * @param array parameters
		 * @return mixed
		 */
		public function getShared($name, $parameters=null){ }


		/**
		 * Check whether the DI contains a service by a name
		 */
		public function has($name){ }


		/**
		 * Check whether the last service obtained via getShared produced a fresh instance or an existing one
		 */
		public function wasFreshInstance(){ }


		/**
		 * Return the services registered in the DI
		 */
		public function getServices(){ }


		/**
		 * Check if a service is registered using the array syntax
		 */
		public function offsetExists($name){ }


		/**
		 * Allows to register a shared service using the array syntax
		 *
		 *<code>
		 * $di["request"] = new \Phalcon\Http\Request();
		 *</code>
		 */
		public function offsetSet($name, $definition){ }


		/**
		 * Allows to obtain a shared service using the array syntax
		 *
		 *<code>
		 * var_dump($di["request"]);
		 *</code>
		 */
		public function offsetGet($name){ }


		/**
		 * Removes a service from the services container using the array syntax
		 */
		public function offsetUnset($name){ }


		/**
		 * Magic method to get or set services using setters/getters
		 */
		public function __call($method, $arguments=null){ }


		/**
		 * Registers a service provider.
		 *
		 * <code>
		 * use \Phalcon\DiInterface;
		 * use \Phalcon\Di\ServiceProviderInterface;
		 *
		 * class SomeServiceProvider implements ServiceProviderInterface
		 * {
		 *     public function register(DiInterface $di)
		 *     {
		 *         $di->setShared('service', function () {
		 *             // ...
		 *         });
		 *     }
		 * }
		 * </code>
		 */
		public function register(\Phalcon\Di\ServiceProviderInterface $provider){ }


		/**
		 * Set a default dependency injection container to be obtained into static methods
		 */
		public static function setDefault(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Return the latest DI created
		 */
		public static function getDefault(){ }


		/**
		 * Resets the internal default DI
		 */
		public static function reset(){ }


		/**
		 * Loads services from a yaml file.
		 *
		 * <code>
		 * $di->loadFromYaml(
		 *     "path/services.yaml",
		 *     [
		 *         "!approot" => function ($value) {
		 *             return dirname(__DIR__) . $value;
		 *         }
		 *     ]
		 * );
		 * </code>
		 *
		 * And the services can be specified in the file as:
		 *
		 * <code>
		 * myComponent:
		 *     className: \Acme\Components\MyComponent
		 *     shared: true
		 *
		 * group:
		 *     className: \Acme\Group
		 *     arguments:
		 *         - type: service
		 *           name: myComponent
		 *
		 * user:
		 *    className: \Acme\User
		 * </code>
		 *
		 * @link https://docs.phalconphp.com/en/latest/reference/di.html
		 */
		public function loadFromYaml($filePath, $callbacks=null){ }


		/**
		 * Loads services from a php config file.
		 *
		 * <code>
		 * $di->loadFromPhp("path/services.php");
		 * </code>
		 *
		 * And the services can be specified in the file as:
		 *
		 * <code>
		 * return [
		 *      'myComponent' => [
		 *          'className' => '\Acme\Components\MyComponent',
		 *          'shared' => true,
		 *      ],
		 *      'group' => [
		 *          'className' => '\Acme\Group',
		 *          'arguments' => [
		 *              [
		 *                  'type' => 'service',
		 *                  'service' => 'myComponent',
		 *              ],
		 *          ],
		 *      ],
		 *      'user' => [
		 *          'className' => '\Acme\User',
		 *      ],
		 * ];
		 * </code>
		 *
		 * @link https://docs.phalconphp.com/en/latest/reference/di.html
		 */
		public function loadFromPhp($filePath){ }


		/**
		 * Loads services from a Config object.
		 */
		protected function loadFromConfig(\Phalcon\Config $config){ }

	}
}
