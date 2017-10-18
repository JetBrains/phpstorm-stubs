<?php 

namespace Phalcon\Mvc\Router {

	/**
	 * Phalcon\Mvc\Router\Group
	 *
	 * Helper class to create a group of routes with common attributes
	 *
	 *<code>
	 * $router = new \Phalcon\Mvc\Router();
	 *
	 * //Create a group with a common module and controller
	 * $blog = new Group(
	 *     [
	 *         "module"     => "blog",
	 *         "controller" => "index",
	 *     ]
	 * );
	 *
	 * //All the routes start with /blog
	 * $blog->setPrefix("/blog");
	 *
	 * //Add a route to the group
	 * $blog->add(
	 *     "/save",
	 *     [
	 *         "action" => "save",
	 *     ]
	 * );
	 *
	 * //Add another route to the group
	 * $blog->add(
	 *     "/edit/{id}",
	 *     [
	 *         "action" => "edit",
	 *     ]
	 * );
	 *
	 * //This route maps to a controller different than the default
	 * $blog->add(
	 *     "/blog",
	 *     [
	 *         "controller" => "about",
	 *         "action"     => "index",
	 *     ]
	 * );
	 *
	 * //Add the group to the router
	 * $router->mount($blog);
	 *</code>
	 */
	
	class Group implements \Phalcon\Mvc\Router\GroupInterface {

		protected $_prefix;

		protected $_hostname;

		protected $_paths;

		protected $_routes;

		protected $_beforeMatch;

		/**
		 * \Phalcon\Mvc\Router\Group constructor
		 */
		public function __construct($paths=null){ }


		/**
		 * Set a hostname restriction for all the routes in the group
		 */
		public function setHostname($hostname){ }


		/**
		 * Returns the hostname restriction
		 */
		public function getHostname(){ }


		/**
		 * Set a common uri prefix for all the routes in this group
		 */
		public function setPrefix($prefix){ }


		/**
		 * Returns the common prefix for all the routes
		 */
		public function getPrefix(){ }


		/**
		 * Sets a callback that is called if the route is matched.
		 * The developer can implement any arbitrary conditions here
		 * If the callback returns false the route is treated as not matched
		 */
		public function beforeMatch($beforeMatch){ }


		/**
		 * Returns the 'before match' callback if any
		 */
		public function getBeforeMatch(){ }


		/**
		 * Set common paths for all the routes in the group
		 */
		public function setPaths($paths){ }


		/**
		 * Returns the common paths defined for this group
		 */
		public function getPaths(){ }


		/**
		 * Returns the routes added to the group
		 */
		public function getRoutes(){ }


		/**
		 * Adds a route to the router on any HTTP method
		 *
		 *<code>
		 * $router->add("/about", "About::index");
		 *</code>
		 */
		public function add($pattern, $paths=null, $httpMethods=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is GET
		 *
		 * @param string pattern
		 * @param string/array paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addGet($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is POST
		 *
		 * @param string pattern
		 * @param string/array paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addPost($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is PUT
		 *
		 * @param string pattern
		 * @param string/array paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addPut($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is PATCH
		 *
		 * @param string pattern
		 * @param string/array paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addPatch($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is DELETE
		 *
		 * @param string pattern
		 * @param string/array paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addDelete($pattern, $paths=null){ }


		/**
		 * Add a route to the router that only match if the HTTP method is OPTIONS
		 *
		 * @param string pattern
		 * @param string/array paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addOptions($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is HEAD
		 *
		 * @param string pattern
		 * @param string/array paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addHead($pattern, $paths=null){ }


		/**
		 * Removes all the pre-defined routes
		 */
		public function clear(){ }


		/**
		 * Adds a route applying the common attributes
		 */
		protected function _addRoute($pattern, $paths=null, $httpMethods=null){ }

	}
}
