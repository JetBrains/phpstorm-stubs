<?php 

namespace Phalcon\Mvc\Router {

	/**
	 * Phalcon\Mvc\Router\Route
	 *
	 * This class represents every route added to the router
	 */
	
	class Route implements \Phalcon\Mvc\Router\RouteInterface {

		protected $_pattern;

		protected $_compiledPattern;

		protected $_paths;

		protected $_methods;

		protected $_hostname;

		protected $_converters;

		protected $_id;

		protected $_name;

		protected $_beforeMatch;

		protected $_match;

		protected $_group;

		protected static $_uniqueId;

		/**
		 * \Phalcon\Mvc\Router\Route constructor
		 */
		public function __construct($pattern, $paths=null, $httpMethods=null){ }


		/**
		 * Replaces placeholders from pattern returning a valid PCRE regular expression
		 */
		public function compilePattern($pattern){ }


		/**
		 * Set one or more HTTP methods that constraint the matching of the route
		 *
		 *<code>
		 * $route->via("GET");
		 *
		 * $route->via(
		 *     [
		 *         "GET",
		 *         "POST",
		 *     ]
		 * );
		 *</code>
		 */
		public function via($httpMethods){ }


		/**
		 * Extracts parameters from a string
		 */
		public function extractNamedParams($pattern){ }


		/**
		 * Reconfigure the route adding a new pattern and a set of paths
		 */
		public function reConfigure($pattern, $paths=null){ }


		/**
		 * Returns routePaths
		 */
		public static function getRoutePaths($paths=null){ }


		/**
		 * Returns the route's name
		 */
		public function getName(){ }


		/**
		 * Sets the route's name
		 *
		 *<code>
		 * $router->add(
		 *     "/about",
		 *     [
		 *         "controller" => "about",
		 *     ]
		 * )->setName("about");
		 *</code>
		 */
		public function setName($name){ }


		/**
		 * Sets a callback that is called if the route is matched.
		 * The developer can implement any arbitrary conditions here
		 * If the callback returns false the route is treated as not matched
		 *
		 *<code>
		 * $router->add(
		 *     "/login",
		 *     [
		 *         "module"     => "admin",
		 *         "controller" => "session",
		 *     ]
		 * )->beforeMatch(
		 *     function ($uri, $route) {
		 *         // Check if the request was made with Ajax
		 *         if ($_SERVER["HTTP_X_REQUESTED_WITH"] === "xmlhttprequest") {
		 *             return false;
		 *         }
		 *
		 *         return true;
		 *     }
		 * );
		 *</code>
		 */
		public function beforeMatch($callback){ }


		/**
		 * Returns the 'before match' callback if any
		 */
		public function getBeforeMatch(){ }


		/**
		 * Allows to set a callback to handle the request directly in the route
		 *
		 *<code>
		 * $router->add(
		 *     "/help",
		 *     []
		 * )->match(
		 *     function () {
		 *         return $this->getResponse()->redirect("https://support.google.com/", true);
		 *     }
		 * );
		 *</code>
		 */
		public function match($callback){ }


		/**
		 * Returns the 'match' callback if any
		 */
		public function getMatch(){ }


		/**
		 * Returns the route's id
		 */
		public function getRouteId(){ }


		/**
		 * Returns the route's pattern
		 */
		public function getPattern(){ }


		/**
		 * Returns the route's compiled pattern
		 */
		public function getCompiledPattern(){ }


		/**
		 * Returns the paths
		 */
		public function getPaths(){ }


		/**
		 * Returns the paths using positions as keys and names as values
		 */
		public function getReversedPaths(){ }


		/**
		 * Sets a set of HTTP methods that constraint the matching of the route (alias of via)
		 *
		 *<code>
		 * $route->setHttpMethods("GET");
		 * $route->setHttpMethods(["GET", "POST"]);
		 *</code>
		 */
		public function setHttpMethods($httpMethods){ }


		/**
		 * Returns the HTTP methods that constraint matching the route
		 */
		public function getHttpMethods(){ }


		/**
		 * Sets a hostname restriction to the route
		 *
		 *<code>
		 * $route->setHostname("localhost");
		 *</code>
		 */
		public function setHostname($hostname){ }


		/**
		 * Returns the hostname restriction if any
		 */
		public function getHostname(){ }


		/**
		 * Sets the group associated with the route
		 */
		public function setGroup(\Phalcon\Mvc\Router\GroupInterface $group){ }


		/**
		 * Returns the group associated with the route
		 */
		public function getGroup(){ }


		/**
		 * Adds a converter to perform an additional transformation for certain parameter
		 */
		public function convert($name, $converter){ }


		/**
		 * Returns the router converter
		 */
		public function getConverters(){ }


		/**
		 * Resets the internal route id generator
		 */
		public static function reset(){ }

	}
}
