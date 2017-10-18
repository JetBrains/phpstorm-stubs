<?php 

namespace Phalcon\Mvc\View\Engine\Volt {

	/**
	 * Phalcon\Mvc\View\Engine\Volt\Compiler
	 *
	 * This class reads and compiles Volt templates into PHP plain code
	 *
	 *<code>
	 * $compiler = new \Phalcon\Mvc\View\Engine\Volt\Compiler();
	 *
	 * $compiler->compile("views/partials/header.volt");
	 *
	 * require $compiler->getCompiledTemplatePath();
	 *</code>
	 */
	
	class Compiler implements \Phalcon\Di\InjectionAwareInterface {

		protected $_dependencyInjector;

		protected $_view;

		protected $_options;

		protected $_arrayHelpers;

		protected $_level;

		protected $_foreachLevel;

		protected $_blockLevel;

		protected $_exprLevel;

		protected $_extended;

		protected $_autoescape;

		protected $_extendedBlocks;

		protected $_currentBlock;

		protected $_blocks;

		protected $_forElsePointers;

		protected $_loopPointers;

		protected $_extensions;

		protected $_functions;

		protected $_filters;

		protected $_macros;

		protected $_prefix;

		protected $_currentPath;

		protected $_compiledTemplatePath;

		/**
		 * \Phalcon\Mvc\View\Engine\Volt\Compiler
		 */
		public function __construct(\Phalcon\Mvc\ViewBaseInterface $view=null){ }


		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Sets the compiler options
		 */
		public function setOptions($options){ }


		/**
		 * Sets a single compiler option
		 *
		 * @param string option
		 * @param mixed value
		 */
		public function setOption($option, $value){ }


		/**
		 * Returns a compiler's option
		 *
		 * @param string option
		 * @return string
		 */
		public function getOption($option){ }


		/**
		 * Returns the compiler options
		 */
		public function getOptions(){ }


		/**
		 * Fires an event to registered extensions
		 *
		 * @param string name
		 * @param array arguments
		 * @return mixed
		 */
		final public function fireExtensionEvent($name, $arguments=null){ }


		/**
		 * Registers a Volt's extension
		 */
		public function addExtension($extension){ }


		/**
		 * Returns the list of extensions registered in Volt
		 */
		public function getExtensions(){ }


		/**
		 * Register a new function in the compiler
		 */
		public function addFunction($name, $definition){ }


		/**
		 * Register the user registered functions
		 */
		public function getFunctions(){ }


		/**
		 * Register a new filter in the compiler
		 */
		public function addFilter($name, $definition){ }


		/**
		 * Register the user registered filters
		 */
		public function getFilters(){ }


		/**
		 * Set a unique prefix to be used as prefix for compiled variables
		 */
		public function setUniquePrefix($prefix){ }


		/**
		 * Return a unique prefix to be used as prefix for compiled variables and contexts
		 */
		public function getUniquePrefix(){ }


		/**
		 * Resolves attribute reading
		 */
		public function attributeReader($expr){ }


		/**
		 * Resolves function intermediate code into PHP function calls
		 */
		public function functionCall($expr){ }


		/**
		 * Resolves filter intermediate code into a valid PHP expression
		 */
		public function resolveTest($test, $left){ }


		/**
		 * Resolves filter intermediate code into PHP function calls
		 */
		final protected function resolveFilter($filter, $left){ }


		/**
		 * Resolves an expression node in an AST volt tree
		 */
		final public function expression($expr){ }


		/**
		 * Compiles a block of statements
		 *
		 * @param array statements
		 * @return string|array
		 */
		final protected function _statementListOrExtends($statements){ }


		/**
		 * Compiles a "foreach" intermediate code representation into plain PHP code
		 */
		public function compileForeach($statement, $extendsMode=null){ }


		/**
		 * Generates a 'forelse' PHP code
		 */
		public function compileForElse(){ }


		/**
		 * Compiles a 'if' statement returning PHP code
		 */
		public function compileIf($statement, $extendsMode=null){ }


		/**
		 * Compiles a "elseif" statement returning PHP code
		 */
		public function compileElseIf($statement){ }


		/**
		 * Compiles a "cache" statement returning PHP code
		 */
		public function compileCache($statement, $extendsMode=null){ }


		/**
		 * Compiles a "set" statement returning PHP code
		 */
		public function compileSet($statement){ }


		/**
		 * Compiles a "do" statement returning PHP code
		 */
		public function compileDo($statement){ }


		/**
		 * Compiles a "return" statement returning PHP code
		 */
		public function compileReturn($statement){ }


		/**
		 * Compiles a "autoescape" statement returning PHP code
		 */
		public function compileAutoEscape($statement, $extendsMode){ }


		/**
		 * Compiles a '{{' '}}' statement returning PHP code
		 *
		 * @param array   statement
		 * @param boolean extendsMode
		 * @return string
		 */
		public function compileEcho($statement){ }


		/**
		 * Compiles a 'include' statement returning PHP code
		 */
		public function compileInclude($statement){ }


		/**
		 * Compiles macros
		 */
		public function compileMacro($statement, $extendsMode){ }


		/**
		 * Compiles calls to macros
		 *
		 * @param array    statement
		 * @param boolean  extendsMode
		 * @return string
		 */
		public function compileCall($statement, $extendsMode){ }


		/**
		 * Traverses a statement list compiling each of its nodes
		 */
		final protected function _statementList($statements, $extendsMode=null){ }


		/**
		 * Compiles a Volt source code returning a PHP plain version
		 */
		protected function _compileSource($viewCode, $extendsMode=null){ }


		/**
		 * Compiles a template into a string
		 *
		 *<code>
		 * echo $compiler->compileString('{{ "hello world" }}');
		 *</code>
		 */
		public function compileString($viewCode, $extendsMode=null){ }


		/**
		 * Compiles a template into a file forcing the destination path
		 *
		 *<code>
		 * $compiler->compile("views/layouts/main.volt", "views/layouts/main.volt.php");
		 *</code>
		 *
		 * @param string path
		 * @param string compiledPath
		 * @param boolean extendsMode
		 * @return string|array
		 */
		public function compileFile($path, $compiledPath, $extendsMode=null){ }


		/**
		 * Compiles a template into a file applying the compiler options
		 * This method does not return the compiled path if the template was not compiled
		 *
		 *<code>
		 * $compiler->compile("views/layouts/main.volt");
		 *
		 * require $compiler->getCompiledTemplatePath();
		 *</code>
		 */
		public function compile($templatePath, $extendsMode=null){ }


		/**
		 * Returns the path that is currently being compiled
		 */
		public function getTemplatePath(){ }


		/**
		 * Returns the path to the last compiled template
		 */
		public function getCompiledTemplatePath(){ }


		/**
		 * Parses a Volt template returning its intermediate representation
		 *
		 *<code>
		 * print_r(
		 *     $compiler->parse("{{ 3 + 2 }}")
		 * );
		 *</code>
		 *
		 * @param string viewCode
		 * @return array
		 */
		public function parse($viewCode){ }


		/**
		 * Gets the final path with VIEW
		 */
		protected function getFinalPath($path){ }

	}
}
