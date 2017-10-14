<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Url
	 *
	 * This components helps in the generation of: URIs, URLs and Paths
	 *
	 *<code>
	 * // Generate a URL appending the URI to the base URI
	 * echo $url->get("products/edit/1");
	 *
	 * // Generate a URL for a predefined route
	 * echo $url->get(
	 *     [
	 *         "for"   => "blog-post",
	 *         "title" => "some-cool-stuff",
	 *         "year"  => "2012",
	 *     ]
	 * );
	 *</code>
	 */
	
	class Url implements \Phalcon\Mvc\UrlInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_dependencyInjector;

		protected $_baseUri;

		protected $_staticBaseUri;

		protected $_basePath;

		protected $_router;

		/**
		 * Sets the DependencyInjector container
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 */
		public function getDI(){ }


		/**
		 * Sets a prefix for all the URIs to be generated
		 *
		 *<code>
		 * $url->setBaseUri("/invo/");
		 *
		 * $url->setBaseUri("/invo/index.php/");
		 *</code>
		 */
		public function setBaseUri($baseUri){ }


		/**
		 * Sets a prefix for all static URLs generated
		 *
		 *<code>
		 * $url->setStaticBaseUri("/invo/");
		 *</code>
		 */
		public function setStaticBaseUri($staticBaseUri){ }


		/**
		 * Returns the prefix for all the generated urls. By default /
		 */
		public function getBaseUri(){ }


		/**
		 * Returns the prefix for all the generated static urls. By default /
		 */
		public function getStaticBaseUri(){ }


		/**
		 * Sets a base path for all the generated paths
		 *
		 *<code>
		 * $url->setBasePath("/var/www/htdocs/");
		 *</code>
		 */
		public function setBasePath($basePath){ }


		/**
		 * Returns the base path
		 */
		public function getBasePath(){ }


		/**
		 * Generates a URL
		 *
		 *<code>
		 * // Generate a URL appending the URI to the base URI
		 * echo $url->get("products/edit/1");
		 *
		 * // Generate a URL for a predefined route
		 * echo $url->get(
		 *     [
		 *         "for"   => "blog-post",
		 *         "title" => "some-cool-stuff",
		 *         "year"  => "2015",
		 *     ]
		 * );
		 *
		 * // Generate a URL with GET arguments (/show/products?id=1&name=Carrots)
		 * echo $url->get(
		 *     "show/products",
		 *     [
		 *         "id"   => 1,
		 *         "name" => "Carrots",
		 *     ]
		 * );
		 *
		 * // Generate an absolute URL by setting the third parameter as false.
		 * echo $url->get(
		 *     "https://phalconphp.com/",
		 *     null,
		 *     false
		 * );
		 *</code>
		 */
		public function get($uri=null, $args=null, $local=null, $baseUri=null){ }


		/**
		 * Generates a URL for a static resource
		 *
		 *<code>
		 * // Generate a URL for a static resource
		 * echo $url->getStatic("img/logo.png");
		 *
		 * // Generate a URL for a static predefined route
		 * echo $url->getStatic(
		 *     [
		 *         "for" => "logo-cdn",
		 *     ]
		 * );
		 *</code>
		 */
		public function getStatic($uri=null){ }


		/**
		 * Generates a local path
		 */
		public function path($path=null){ }

	}
}
