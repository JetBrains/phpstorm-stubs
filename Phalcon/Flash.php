<?php 

namespace Phalcon {

	/**
	 * Phalcon\Flash
	 *
	 * Shows HTML notifications related to different circumstances. Classes can be stylized using CSS
	 *
	 *<code>
	 * $flash->success("The record was successfully deleted");
	 * $flash->error("Cannot open the file");
	 *</code>
	 */
	
	abstract class Flash implements \Phalcon\FlashInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_cssClasses;

		protected $_implicitFlush;

		protected $_automaticHtml;

		protected $_escaperService;

		protected $_autoescape;

		protected $_dependencyInjector;

		protected $_messages;

		/**
		 * \Phalcon\Flash constructor
		 */
		public function __construct($cssClasses=null){ }


		/**
		 * Returns the autoescape mode in generated html
		 */
		public function getAutoescape(){ }


		/**
		 * Set the autoescape mode in generated html
		 */
		public function setAutoescape($autoescape){ }


		/**
		 * Returns the Escaper Service
		 */
		public function getEscaperService(){ }


		/**
		 * Sets the Escaper Service
		 */
		public function setEscaperService(\Phalcon\EscaperInterface $escaperService){ }


		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Set whether the output must be implicitly flushed to the output or returned as string
		 */
		public function setImplicitFlush($implicitFlush){ }


		/**
		 * Set if the output must be implicitly formatted with HTML
		 */
		public function setAutomaticHtml($automaticHtml){ }


		/**
		 * Set an array with CSS classes to format the messages
		 */
		public function setCssClasses($cssClasses){ }


		/**
		 * Shows a HTML error message
		 *
		 *<code>
		 * $flash->error("This is an error");
		 *</code>
		 */
		public function error($message){ }


		/**
		 * Shows a HTML notice/information message
		 *
		 *<code>
		 * $flash->notice("This is an information");
		 *</code>
		 */
		public function notice($message){ }


		/**
		 * Shows a HTML success message
		 *
		 *<code>
		 * $flash->success("The process was finished successfully");
		 *</code>
		 */
		public function success($message){ }


		/**
		 * Shows a HTML warning message
		 *
		 *<code>
		 * $flash->warning("Hey, this is important");
		 *</code>
		 */
		public function warning($message){ }


		/**
		 * Outputs a message formatting it with HTML
		 *
		 *<code>
		 * $flash->outputMessage("error", $message);
		 *</code>
		 *
		 * @param string|array message
		 * @return string|void
		 */
		public function outputMessage($type, $message){ }


		/**
		 * Clears accumulated messages when implicit flush is disabled
		 */
		public function clear(){ }

	}
}
