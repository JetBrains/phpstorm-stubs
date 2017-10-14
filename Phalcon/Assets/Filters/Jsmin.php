<?php 

namespace Phalcon\Assets\Filters {

	/**
	 * Phalcon\Assets\Filters\Jsmin
	 *
	 * Deletes the characters which are insignificant to JavaScript. Comments will be removed. Tabs will be
	 * replaced with spaces. Carriage returns will be replaced with linefeeds.
	 * Most spaces and linefeeds will be removed.
	 */
	
	class Jsmin implements \Phalcon\Assets\FilterInterface {

		/**
		 * Filters the content using JSMIN
		 */
		public function filter($content){ }

	}
}
