<?php 

namespace Phalcon\Forms {

	/**
	 * Phalcon\Forms\Manager
	 */
	
	class Manager {

		protected $_forms;

		/**
		 * Creates a form registering it in the forms manager
		 *
		 * @param string name
		 * @param object entity
		 */
		public function create($name, $entity=null){ }


		/**
		 * Returns a form by its name
		 */
		public function get($name){ }


		/**
		 * Checks if a form is registered in the forms manager
		 */
		public function has($name){ }


		/**
		 * Registers a form in the Forms Manager
		 */
		public function set($name, \Phalcon\Forms\Form $form){ }

	}
}
