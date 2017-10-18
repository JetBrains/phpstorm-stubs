<?php 

namespace Phalcon\Translate\Adapter {

	/**
	 * Phalcon\Translate\Adapter\Gettext
	 *
	 * <code>
	 * use Phalcon\Translate\Adapter\Gettext;
	 *
	 * $adapter = new Gettext(
	 *     [
	 *         "locale"        => "de_DE.UTF-8",
	 *         "defaultDomain" => "translations",
	 *         "directory"     => "/path/to/application/locales",
	 *         "category"      => LC_MESSAGES,
	 *     ]
	 * );
	 * </code>
	 *
	 * Allows translate using gettext
	 */
	
	class Gettext extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess {

		protected $_directory;

		protected $_defaultDomain;

		protected $_locale;

		protected $_category;

		/**
		 */
		public function getDirectory(){ }


		/**
		 */
		public function getDefaultDomain(){ }


		/**
		 */
		public function getLocale(){ }


		/**
		 */
		public function getCategory(){ }


		/**
		 * \Phalcon\Translate\Adapter\Gettext constructor
		 */
		public function __construct($options){ }


		/**
		 * Returns the translation related to the given key.
		 *
		 * <code>
		 * $translator->query("你好 %name%！", ["name" => "Phalcon"]);
		 * </code>
		 */
		public function query($index, $placeholders=null){ }


		/**
		 * Check whether is defined a translation key in the internal array
		 */
		public function exists($index){ }


		/**
		 * The plural version of gettext().
		 * Some languages have more than one form for plural messages dependent on the count.
		 */
		public function nquery($msgid1, $msgid2, $count, $placeholders=null, $domain=null){ }


		/**
		 * Changes the current domain (i.e. the translation file)
		 */
		public function setDomain($domain){ }


		/**
		 * Sets the default domain
		 */
		public function resetDomain(){ }


		/**
		 * Sets the domain default to search within when calls are made to gettext()
		 */
		public function setDefaultDomain($domain){ }


		/**
		 * Sets the path for a domain
		 *
		 * <code>
		 * // Set the directory path
		 * $gettext->setDirectory("/path/to/the/messages");
		 *
		 * // Set the domains and directories path
		 * $gettext->setDirectory(
		 *     [
		 *         "messages" => "/path/to/the/messages",
		 *         "another"  => "/path/to/the/another",
		 *     ]
		 * );
		 * </code>
		 *
		 * @param string|array directory The directory path or an array of directories and domains
		 */
		public function setDirectory($directory){ }


		/**
		 * Sets locale information
		 *
		 * <code>
		 * // Set locale to Dutch
		 * $gettext->setLocale(LC_ALL, "nl_NL");
		 *
		 * // Try different possible locale names for german
		 * $gettext->setLocale(LC_ALL, "de_DE@euro", "de_DE", "de", "ge");
		 * </code>
		 */
		public function setLocale($category, $locale){ }


		/**
		 * Validator for constructor
		 */
		protected function prepareOptions($options){ }


		/**
		 * Gets default options
		 */
		protected function getOptionsDefault(){ }

	}
}
