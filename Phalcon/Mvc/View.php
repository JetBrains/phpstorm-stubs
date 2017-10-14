<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\View
	 *
	 * Phalcon\Mvc\View is a class for working with the "view" portion of the model-view-controller pattern.
	 * That is, it exists to help keep the view script separate from the model and controller scripts.
	 * It provides a system of helpers, output filters, and variable escaping.
	 *
	 * <code>
	 * use Phalcon\Mvc\View;
	 *
	 * $view = new View();
	 *
	 * // Setting views directory
	 * $view->setViewsDir("app/views/");
	 *
	 * $view->start();
	 *
	 * // Shows recent posts view (app/views/posts/recent.phtml)
	 * $view->render("posts", "recent");
	 * $view->finish();
	 *
	 * // Printing views output
	 * echo $view->getContent();
	 * </code>
	 */
	
	class View extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\ViewInterface, \Phalcon\Mvc\ViewBaseInterface {

		const LEVEL_MAIN_LAYOUT = 5;

		const LEVEL_AFTER_TEMPLATE = 4;

		const LEVEL_LAYOUT = 3;

		const LEVEL_BEFORE_TEMPLATE = 2;

		const LEVEL_ACTION_VIEW = 1;

		const LEVEL_NO_RENDER = 0;

		const CACHE_MODE_NONE = 0;

		const CACHE_MODE_INVERSE = 1;

		protected $_options;

		protected $_basePath;

		protected $_content;

		protected $_renderLevel;

		protected $_currentRenderLevel;

		protected $_disabledLevels;

		protected $_viewParams;

		protected $_layout;

		protected $_layoutsDir;

		protected $_partialsDir;

		protected $_viewsDirs;

		protected $_templatesBefore;

		protected $_templatesAfter;

		protected $_engines;

		protected $_registeredEngines;

		protected $_mainView;

		protected $_controllerName;

		protected $_actionName;

		protected $_params;

		protected $_pickView;

		protected $_cache;

		protected $_cacheLevel;

		protected $_activeRenderPaths;

		protected $_disabled;

		public function getRenderLevel(){ }


		public function getCurrentRenderLevel(){ }


		/**
		 */
		public function getRegisteredEngines(){ }


		/**
		 * \Phalcon\Mvc\View constructor
		 */
		public function __construct($options=null){ }


		/**
		 * Checks if a path is absolute or not
		 */
		final protected function _isAbsolutePath($path){ }


		/**
		 * Sets the views directory. Depending of your platform,
		 * always add a trailing slash or backslash
		 */
		public function setViewsDir($viewsDir){ }


		/**
		 * Gets views directory
		 */
		public function getViewsDir(){ }


		/**
		 * Sets the layouts sub-directory. Must be a directory under the views directory.
		 * Depending of your platform, always add a trailing slash or backslash
		 *
		 *<code>
		 * $view->setLayoutsDir("../common/layouts/");
		 *</code>
		 */
		public function setLayoutsDir($layoutsDir){ }


		/**
		 * Gets the current layouts sub-directory
		 */
		public function getLayoutsDir(){ }


		/**
		 * Sets a partials sub-directory. Must be a directory under the views directory.
		 * Depending of your platform, always add a trailing slash or backslash
		 *
		 *<code>
		 * $view->setPartialsDir("../common/partials/");
		 *</code>
		 */
		public function setPartialsDir($partialsDir){ }


		/**
		 * Gets the current partials sub-directory
		 */
		public function getPartialsDir(){ }


		/**
		 * Sets base path. Depending of your platform, always add a trailing slash or backslash
		 *
		 * <code>
		 * 	$view->setBasePath(__DIR__ . "/");
		 * </code>
		 */
		public function setBasePath($basePath){ }


		/**
		 * Gets base path
		 */
		public function getBasePath(){ }


		/**
		 * Sets the render level for the view
		 *
		 * <code>
		 * // Render the view related to the controller only
		 * $this->view->setRenderLevel(
		 *     View::LEVEL_LAYOUT
		 * );
		 * </code>
		 */
		public function setRenderLevel($level){ }


		/**
		 * Disables a specific level of rendering
		 *
		 *<code>
		 * // Render all levels except ACTION level
		 * $this->view->disableLevel(
		 *     View::LEVEL_ACTION_VIEW
		 * );
		 *</code>
		 */
		public function disableLevel($level){ }


		/**
		 * Sets default view name. Must be a file without extension in the views directory
		 *
		 * <code>
		 * // Renders as main view views-dir/base.phtml
		 * $this->view->setMainView("base");
		 * </code>
		 */
		public function setMainView($viewPath){ }


		/**
		 * Returns the name of the main view
		 */
		public function getMainView(){ }


		/**
		 * Change the layout to be used instead of using the name of the latest controller name
		 *
		 * <code>
		 * $this->view->setLayout("main");
		 * </code>
		 */
		public function setLayout($layout){ }


		/**
		 * Returns the name of the main view
		 */
		public function getLayout(){ }


		/**
		 * Sets a template before the controller layout
		 */
		public function setTemplateBefore($templateBefore){ }


		/**
		 * Resets any "template before" layouts
		 */
		public function cleanTemplateBefore(){ }


		/**
		 * Sets a "template after" controller layout
		 */
		public function setTemplateAfter($templateAfter){ }


		/**
		 * Resets any template before layouts
		 */
		public function cleanTemplateAfter(){ }


		/**
		 * Adds parameters to views (alias of setVar)
		 *
		 *<code>
		 * $this->view->setParamToView("products", $products);
		 *</code>
		 */
		public function setParamToView($key, $value){ }


		/**
		 * Set all the render params
		 *
		 *<code>
		 * $this->view->setVars(
		 *     [
		 *         "products" => $products,
		 *     ]
		 * );
		 *</code>
		 */
		public function setVars($params, $merge=null){ }


		/**
		 * Set a single view parameter
		 *
		 *<code>
		 * $this->view->setVar("products", $products);
		 *</code>
		 */
		public function setVar($key, $value){ }


		/**
		 * Returns a parameter previously set in the view
		 */
		public function getVar($key){ }


		/**
		 * Returns parameters to views
		 */
		public function getParamsToView(){ }


		/**
		 * Gets the name of the controller rendered
		 */
		public function getControllerName(){ }


		/**
		 * Gets the name of the action rendered
		 */
		public function getActionName(){ }


		/**
		 * Gets extra parameters of the action rendered
		 *
		 * @deprecated Will be removed in 4.0.0
		 */
		public function getParams(){ }


		/**
		 * Starts rendering process enabling the output buffering
		 */
		public function start(){ }


		/**
		 * Loads registered template engines, if none is registered it will use \Phalcon\Mvc\View\Engine\Php
		 */
		protected function _loadTemplateEngines(){ }


		/**
		 * Checks whether view exists on registered extensions and render it
		 *
		 * @param array engines
		 * @param string viewPath
		 * @param boolean silence
		 * @param boolean mustClean
		 * @param \Phalcon\Cache\BackendInterface $cache
		 */
		protected function _engineRender($engines, $viewPath, $silence, $mustClean, \Phalcon\Cache\BackendInterface $cache=null){ }


		/**
		 * Register templating engines
		 *
		 *<code>
		 * $this->view->registerEngines(
		 *     [
		 *         ".phtml" => "Phalcon\\Mvc\\View\\Engine\\Php",
		 *         ".volt"  => "Phalcon\\Mvc\\View\\Engine\\Volt",
		 *         ".mhtml" => "MyCustomEngine",
		 *     ]
		 * );
		 *</code>
		 */
		public function registerEngines($engines){ }


		/**
		 * Checks whether view exists
		 */
		public function exists($view){ }


		/**
		 * Executes render process from dispatching data
		 *
		 *<code>
		 * // Shows recent posts view (app/views/posts/recent.phtml)
		 * $view->start()->render("posts", "recent")->finish();
		 *</code>
		 *
		 * @param string controllerName
		 * @param string actionName
		 * @param array params
		 */
		public function render($controllerName, $actionName, $params=null){ }


		/**
		 * Choose a different view to render instead of last-controller/last-action
		 *
		 * <code>
		 * use \Phalcon\Mvc\Controller;
		 *
		 * class ProductsController extends Controller
		 * {
		 *    public function saveAction()
		 *    {
		 *         // Do some save stuff...
		 *
		 *         // Then show the list view
		 *         $this->view->pick("products/list");
		 *    }
		 * }
		 * </code>
		 */
		public function pick($renderView){ }


		/**
		 * Renders a partial view
		 *
		 * <code>
		 * // Retrieve the contents of a partial
		 * echo $this->getPartial("shared/footer");
		 * </code>
		 *
		 * <code>
		 * // Retrieve the contents of a partial with arguments
		 * echo $this->getPartial(
		 *     "shared/footer",
		 *     [
		 *         "content" => $html,
		 *     ]
		 * );
		 * </code>
		 */
		public function getPartial($partialPath, $params=null){ }


		/**
		 * Renders a partial view
		 *
		 * <code>
		 * // Show a partial inside another view
		 * $this->partial("shared/footer");
		 * </code>
		 *
		 * <code>
		 * // Show a partial inside another view with parameters
		 * $this->partial(
		 *     "shared/footer",
		 *     [
		 *         "content" => $html,
		 *     ]
		 * );
		 * </code>
		 */
		public function partial($partialPath, $params=null){ }


		/**
		 * Perform the automatic rendering returning the output as a string
		 *
		 * <code>
		 * $template = $this->view->getRender(
		 *     "products",
		 *     "show",
		 *     [
		 *         "products" => $products,
		 *     ]
		 * );
		 * </code>
		 *
		 * @param string controllerName
		 * @param string actionName
		 * @param array params
		 * @param mixed configCallback
		 * @return string
		 */
		public function getRender($controllerName, $actionName, $params=null, $configCallback=null){ }


		/**
		 * Finishes the render process by stopping the output buffering
		 */
		public function finish(){ }


		/**
		 * Create a \Phalcon\Cache based on the internal cache options
		 */
		protected function _createCache(){ }


		/**
		 * Check if the component is currently caching the output content
		 */
		public function isCaching(){ }


		/**
		 * Returns the cache instance used to cache
		 */
		public function getCache(){ }


		/**
		 * Cache the actual view render to certain level
		 *
		 *<code>
		 * $this->view->cache(
		 *     [
		 *         "key"      => "my-key",
		 *         "lifetime" => 86400,
		 *     ]
		 * );
		 *</code>
		 */
		public function cache($options=null){ }


		/**
		 * Externally sets the view content
		 *
		 *<code>
		 * $this->view->setContent("<h1>hello</h1>");
		 *</code>
		 */
		public function setContent($content){ }


		/**
		 * Returns cached output from another view stage
		 */
		public function getContent(){ }


		/**
		 * Returns the path (or paths) of the views that are currently rendered
		 */
		public function getActiveRenderPath(){ }


		/**
		 * Disables the auto-rendering process
		 */
		public function disable(){ }


		/**
		 * Enables the auto-rendering process
		 */
		public function enable(){ }


		/**
		 * Resets the view component to its factory default values
		 */
		public function reset(){ }


		/**
		 * Magic method to pass variables to the views
		 *
		 *<code>
		 * $this->view->products = $products;
		 *</code>
		 */
		public function __set($key, $value){ }


		/**
		 * Magic method to retrieve a variable passed to the view
		 *
		 *<code>
		 * echo $this->view->products;
		 *</code>
		 */
		public function __get($key){ }


		/**
		 * Whether automatic rendering is enabled
		 */
		public function isDisabled(){ }


		/**
		 * Magic method to retrieve if a variable is set in the view
		 *
		 *<code>
		 * echo isset($this->view->products);
		 *</code>
		 */
		public function __isset($key){ }


		/**
		 * Gets views directories
		 */
		protected function getViewsDirs(){ }

	}
}
