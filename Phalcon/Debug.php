<?php 

namespace Phalcon {

	/**
	 * Phalcon\Debug
	 *
	 * Provides debug capabilities to Phalcon applications
	 */
	
	class Debug {

		public $_uri;

		public $_theme;

		protected $_hideDocumentRoot;

		protected $_showBackTrace;

		protected $_showFiles;

		protected $_showFileFragment;

		protected $_data;

		protected static $_isActive;

		/**
		 * Change the base URI for static resources
		 */
		public function setUri($uri){ }


		/**
		 * Sets if files the exception's backtrace must be showed
		 */
		public function setShowBackTrace($showBackTrace){ }


		/**
		 * Set if files part of the backtrace must be shown in the output
		 */
		public function setShowFiles($showFiles){ }


		/**
		 * Sets if files must be completely opened and showed in the output
		 * or just the fragment related to the exception
		 */
		public function setShowFileFragment($showFileFragment){ }


		/**
		 * Listen for uncaught exceptions and unsilent notices or warnings
		 */
		public function listen($exceptions=null, $lowSeverity=null){ }


		/**
		 * Listen for uncaught exceptions
		 */
		public function listenExceptions(){ }


		/**
		 * Listen for unsilent notices or warnings
		 */
		public function listenLowSeverity(){ }


		/**
		 * Halts the request showing a backtrace
		 */
		public function halt(){ }


		/**
		 * Adds a variable to the debug output
		 */
		public function debugVar($varz, $key=null){ }


		/**
		 * Clears are variables added previously
		 */
		public function clearVars(){ }


		/**
		 * Escapes a string with htmlentities
		 */
		protected function _escapeString($value){ }


		/**
		 * Produces a recursive representation of an array
		 */
		protected function _getArrayDump($argument, $n=null){ }


		/**
		 * Produces an string representation of a variable
		 */
		protected function _getVarDump($variable){ }


		/**
		 * Returns the major framework's version
		 *
		 * @deprecated Will be removed in 4.0.0
		 * @see \Phalcon\Version::getPart()
		 */
		public function getMajorVersion(){ }


		/**
		 * Generates a link to the current version documentation
		 */
		public function getVersion(){ }


		/**
		 * Returns the css sources
		 */
		public function getCssSources(){ }


		/**
		 * Returns the javascript sources
		 */
		public function getJsSources(){ }


		/**
		 * Shows a backtrace item
		 */
		final protected function showTraceItem($n, $trace){ }


		/**
		 * Throws an exception when a notice or warning is raised
		 */
		public function onUncaughtLowSeverity($severity, $message, $file, $line, $context){ }


		/**
		 * Handles uncaught exceptions
		 */
		public function onUncaughtException(\Exception $exception){ }

	}
}
