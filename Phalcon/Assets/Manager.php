<?php 

namespace Phalcon\Assets {

	/**
	 * Phalcon\Assets\Manager
	 *
	 * Manages collections of CSS/Javascript assets
	 */
	
	class Manager {

		protected $_options;

		protected $_collections;

		protected $_implicitOutput;

		/**
		 * \Phalcon\Assets\Manager
		 *
		 * @param array options
		 */
		public function __construct($options=null){ }


		/**
		 * Sets the manager options
		 */
		public function setOptions($options){ }


		/**
		 * Returns the manager options
		 */
		public function getOptions(){ }


		/**
		 * Sets if the HTML generated must be directly printed or returned
		 */
		public function useImplicitOutput($implicitOutput){ }


		/**
		 * Adds a Css resource to the 'css' collection
		 *
		 *<code>
		 *	$assets->addCss("css/bootstrap.css");
		 *	$assets->addCss("http://bootstrap.my-cdn.com/style.css", false);
		 *</code>
		 */
		public function addCss($path, $local=null, $filter=null, $attributes=null){ }


		/**
		 * Adds an inline Css to the 'css' collection
		 */
		public function addInlineCss($content, $filter=null, $attributes=null){ }


		/**
		 * Adds a javascript resource to the 'js' collection
		 *
		 *<code>
		 * $assets->addJs("scripts/jquery.js");
		 * $assets->addJs("http://jquery.my-cdn.com/jquery.js", false);
		 *</code>
		 */
		public function addJs($path, $local=null, $filter=null, $attributes=null){ }


		/**
		 * Adds an inline javascript to the 'js' collection
		 */
		public function addInlineJs($content, $filter=null, $attributes=null){ }


		/**
		 * Adds a resource by its type
		 *
		 *<code>
		 * $assets->addResourceByType("css",
		 *     new \Phalcon\Assets\Resource\Css("css/style.css")
		 * );
		 *</code>
		 */
		public function addResourceByType($type, \Phalcon\Assets\Resource $resource){ }


		/**
		 * Adds an inline code by its type
		 */
		public function addInlineCodeByType($type, \Phalcon\Assets\Inline $code){ }


		/**
		 * Adds a raw resource to the manager
		 *
		 *<code>
		 * $assets->addResource(
		 *     new \Phalcon\Assets\Resource("css", "css/style.css")
		 * );
		 *</code>
		 */
		public function addResource(\Phalcon\Assets\Resource $resource){ }


		/**
		 * Adds a raw inline code to the manager
		 */
		public function addInlineCode(\Phalcon\Assets\Inline $code){ }


		/**
		 * Sets a collection in the Assets Manager
		 *
		 *<code>
		 * $assets->set("js", $collection);
		 *</code>
		 */
		public function set($id, \Phalcon\Assets\Collection $collection){ }


		/**
		 * Returns a collection by its id.
		 *
		 * <code>
		 * $scripts = $assets->get("js");
		 * </code>
		 */
		public function get($id){ }


		/**
		 * Returns the CSS collection of assets
		 */
		public function getCss(){ }


		/**
		 * Returns the CSS collection of assets
		 */
		public function getJs(){ }


		/**
		 * Creates/Returns a collection of resources
		 */
		public function collection($name){ }


		/**
		 * Traverses a collection calling the callback to generate its HTML
		 *
		 * @param \Phalcon\Assets\Collection collection
		 * @param callback callback
		 * @param string type
		 */
		public function output(\Phalcon\Assets\Collection $collection, $callback, $type){ }


		/**
		 * Traverses a collection and generate its HTML
		 *
		 * @param \Phalcon\Assets\Collection collection
		 * @param string type
		 */
		public function outputInline(\Phalcon\Assets\Collection $collection, $type){ }


		/**
		 * Prints the HTML for CSS resources
		 *
		 * @param string collectionName
		 */
		public function outputCss($collectionName=null){ }


		/**
		 * Prints the HTML for inline CSS
		 *
		 * @param string collectionName
		 */
		public function outputInlineCss($collectionName=null){ }


		/**
		 * Prints the HTML for JS resources
		 *
		 * @param string collectionName
		 */
		public function outputJs($collectionName=null){ }


		/**
		 * Prints the HTML for inline JS
		 *
		 * @param string collectionName
		 */
		public function outputInlineJs($collectionName=null){ }


		/**
		 * Returns existing collections in the manager
		 */
		public function getCollections(){ }


		/**
		 * Returns true or false if collection exists.
		 *
		 * <code>
		 * if ($assets->exists("jsHeader")) {
		 *     // \Phalcon\Assets\Collection
		 *     $collection = $assets->get("jsHeader");
		 * }
		 * </code>
		 */
		public function exists($id){ }

	}
}
