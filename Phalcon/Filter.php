<?php 

namespace Phalcon {

	/**
	 * Phalcon\Filter
	 *
	 * The Phalcon\Filter component provides a set of commonly needed data filters. It provides
	 * object oriented wrappers to the php filter extension. Also allows the developer to
	 * define his/her own filters
	 *
	 *<code>
	 * $filter = new \Phalcon\Filter();
	 *
	 * $filter->sanitize("some(one)@exa\\mple.com", "email"); // returns "someone@example.com"
	 * $filter->sanitize("hello<<", "string"); // returns "hello"
	 * $filter->sanitize("!100a019", "int"); // returns "100019"
	 * $filter->sanitize("!100a019.01a", "float"); // returns "100019.01"
	 *</code>
	 */
	
	class Filter implements \Phalcon\FilterInterface {

		const FILTER_EMAIL = email;

		const FILTER_ABSINT = absint;

		const FILTER_INT = int;

		const FILTER_INT_CAST = int!;

		const FILTER_STRING = string;

		const FILTER_FLOAT = float;

		const FILTER_FLOAT_CAST = float!;

		const FILTER_ALPHANUM = alphanum;

		const FILTER_TRIM = trim;

		const FILTER_STRIPTAGS = striptags;

		const FILTER_LOWER = lower;

		const FILTER_UPPER = upper;

		const FILTER_URL = url;

		const FILTER_SPECIAL_CHARS = special_chars;

		protected $_filters;

		/**
		 * Adds a user-defined filter
		 */
		public function add($name, $handler){ }


		/**
		 * Sanitizes a value with a specified single or set of filters
		 */
		public function sanitize($value, $filters, $noRecursive=null){ }


		/**
		 * Internal sanitize wrapper to filter_var
		 */
		protected function _sanitize($value, $filter){ }


		/**
		 * Return the user-defined filters in the instance
		 */
		public function getFilters(){ }

	}
}
