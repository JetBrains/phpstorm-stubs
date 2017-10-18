<?php 

namespace Phalcon\Acl {

	/**
	 * Phalcon\Acl\Adapter
	 *
	 * Adapter for Phalcon\Acl adapters
	 */
	
	abstract class Adapter implements \Phalcon\Acl\AdapterInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_eventsManager;

		protected $_defaultAccess;

		protected $_accessGranted;

		protected $_activeRole;

		protected $_activeResource;

		protected $_activeAccess;

		/**
		 * Role which the list is checking if it's allowed to certain resource/access
		 */
		public function getActiveRole(){ }


		/**
		 * Resource which the list is checking if some role can access it
		 */
		public function getActiveResource(){ }


		/**
		 * Active access which the list is checking if some role can access it
		 */
		public function getActiveAccess(){ }


		/**
		 * Sets the events manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Sets the default access level (Phalcon\Acl::ALLOW or \Phalcon\Acl::DENY)
		 */
		public function setDefaultAction($defaultAccess){ }


		/**
		 * Returns the default ACL access level
		 */
		public function getDefaultAction(){ }

	}
}
