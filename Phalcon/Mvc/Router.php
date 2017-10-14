<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Router
	 *
	 * Phalcon\Mvc\Router is the standard framework router. Routing is the
	 * process of taking a URI endpoint (that part of the URI which comes after the base URL) and
	 * decomposing it into parameters to determine which module, controller, and
	 * action of that controller should receive the request
	 *
	 * <code>
	 * use Phalcon\Mvc\Router;
	 *
	 * $router = new Router();
	 *
	 * $router->add(
	 *     "/documentation/{chapter}/{name}\.{type:[a-z]+}",
	 *     [
	 *         "controller" => "documentation",
	 *         "action"     => "show",
	 *     ]
	 * );
	 *
	 * $router->handle();
	 *
	 * echo $router->getControllerName();
	 * </code>
	 */
	
	class Router implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\RouterInterface, \Phalcon\Events\EventsAwareInterface {

		const URI_SOURCE_GET_URL = 0;

		const URI_SOURCE_SERVER_REQUEST_URI = 1;

		const POSITION_FIRST = 0;

		const POSITION_LAST = 1;

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_uriSource;

		protected $_namespace;

		protected $_module;

		protected $_controller;

		protected $_action;

		protected $_params;

		protected $_routes;

		protected $_matchedRoute;

		protected $_matches;

		protected $_wasMatched;

		protected $_defaultNamespace;

		protected $_defaultModule;

		protected $_defaultController;

		protected $_defaultAction;

		protected $_defaultParams;

		protected $_removeExtraSlashes;

		protected $_notFoundPaths;

		/**
		 * \Phalcon\Mvc\Router constructor
		 */
		public function __construct($defaultRoutes=null){ }


		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Sets the events manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Get rewrite info. This info is read from $_GET["_url"]. This returns '/' if the rewrite information cannot be read
		 */
		public function getRewriteUri(){ }


		/**
		 * Sets the URI source. One of the URI_SOURCE_* constants
		 *
		 * <code>
		 * $router->setUriSource(
		 *     Router::URI_SOURCE_SERVER_REQUEST_URI
		 * );
		 * </code>
		 */
		public function setUriSource($uriSource){ }


		/**
		 * Set whether router must remove the extra slashes in the handled routes
		 */
		public function removeExtraSlashes($remove){ }


		/**
		 * Sets the name of the default namespace
		 */
		public function setDefaultNamespace($namespaceName){ }


		/**
		 * Sets the name of the default module
		 */
		public function setDefaultModule($moduleName){ }


		/**
		 * Sets the default controller name
		 */
		public function setDefaultController($controllerName){ }


		/**
		 * Sets the default action name
		 */
		public function setDefaultAction($actionName){ }


		/**
		 * Sets an array of default paths. If a route is missing a path the router will use the defined here
		 * This method must not be used to set a 404 route
		 *
		 *<code>
		 * $router->setDefaults(
		 *     [
		 *         "module" => "common",
		 *         "action" => "index",
		 *     ]
		 * );
		 *</code>
		 */
		public function setDefaults($defaults){ }


		/**
		 * Returns an array of default parameters
		 */
		public function getDefaults(){ }


		/**
		 * Handles routing information received from the rewrite engine
		 *
		 *<code>
		 * // Read the info from the rewrite engine
		 * $router->handle();
		 *
		 * // Manually passing an URL
		 * $router->handle("/posts/edit/1");
		 *</code>
		 */
		public function handle($uri=null){ }


		/**
		 * Adds a route to the router without any HTTP constraint
		 *
		 *<code>
		 * use \Phalcon\Mvc\Router;
		 *
		 * $router->add("/about", "About::index");
		 * $router->add("/about", "About::index", ["GET", "POST"]);
		 * $router->add("/about", "About::index", ["GET", "POST"], Router::POSITION_FIRST);
		 *</code>
		 */
		public function add($pattern, $paths=null, $httpMethods=null, $position=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is GET
		 */
		public function addGet($pattern, $paths=null, $position=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is POST
		 */
		public function addPost($pattern, $paths=null, $position=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is PUT
		 */
		public function addPut($pattern, $paths=null, $position=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is PATCH
		 */
		public function addPatch($pattern, $paths=null, $position=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is DELETE
		 */
		public function addDelete($pattern, $paths=null, $position=null){ }


		/**
		 * Add a route to the router that only match if the HTTP method is OPTIONS
		 */
		public function addOptions($pattern, $paths=null, $position=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is HEAD
		 */
		public function addHead($pattern, $paths=null, $position=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is PURGE (Squid and Varnish support)
		 */
		public function addPurge($pattern, $paths=null, $position=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is TRACE
		 */
		public function addTrace($pattern, $paths=null, $position=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is CONNECT
		 */
		public function addConnect($pattern, $paths=null, $position=null){ }


		/**
		 * Mounts a group of routes in the router
		 */
		public function mount(\Phalcon\Mvc\Router\GroupInterface $group){ }


		/**
		 * Set a group of paths to be returned when none of the defined routes are matched
		 */
		public function notFound($paths){ }


		/**
		 * Removes all the pre-defined routes
		 */
		public function clear(){ }


		/**
		 * Returns the processed namespace name
		 */
		public function getNamespaceName(){ }


		/**
		 * Returns the processed module name
		 */
		public function getModuleName(){ }


		/**
		 * Returns the processed controller name
		 */
		public function getControllerName(){ }


		/**
		 * Returns the processed action name
		 */
		public function getActionName(){ }


		/**
		 * Returns the processed parameters
		 */
		public function getParams(){ }


		/**
		 * Returns the route that matches the handled URI
		 */
		public function getMatchedRoute(){ }


		/**
		 * Returns the sub expressions in the regular expression matched
		 */
		public function getMatches(){ }


		/**
		 * Checks if the router matches any of the defined routes
		 */
		public function wasMatched(){ }


		/**
		 * Returns all the routes defined in the router
		 */
		public function getRoutes(){ }


		/**
		 * Returns a route object by its id
		 */
		public function getRouteById($id){ }


		/**
		 * Returns a route object by its name
		 */
		public function getRouteByName($name){ }


		/**
		 * Returns whether controller name should not be mangled
		 */
		public function isExactControllerName(){ }

	}
}
