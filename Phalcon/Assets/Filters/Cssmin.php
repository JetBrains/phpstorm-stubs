<?php 

namespace Phalcon\Assets\Filters {

	/**
	 * Phalcon\Assets\Filters\Cssmin
	 *
	 * Minify the css - removes comments
	 * removes newlines and line feeds keeping
	 * removes last semicolon from last property
	 */
	
	class Cssmin implements \Phalcon\Assets\FilterInterface {

		/**
		 * Filters the content using CSSMIN
		 */
		public function filter($content){ }

	}
}
