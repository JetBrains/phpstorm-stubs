<?php 

namespace Phalcon\Paginator {

	/**
	 * Phalcon\Paginator\Adapter
	 */
	
	abstract class Adapter implements \Phalcon\Paginator\AdapterInterface {

		protected $_limitRows;

		protected $_page;

		/**
		 * Set the current page number
		 */
		public function setCurrentPage($page){ }


		/**
		 * Set current rows limit
		 */
		public function setLimit($limitRows){ }


		/**
		 * Get current rows limit
		 */
		public function getLimit(){ }

	}
}
