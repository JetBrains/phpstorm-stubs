<?php 

namespace Phalcon\Session {

	/**
	 * Phalcon\Session\Adapter
	 *
	 * Base class for Phalcon\Session adapters
	 */
	
	abstract class Adapter implements \Phalcon\Session\AdapterInterface {

		const SESSION_ACTIVE = 2;

		const SESSION_NONE = 1;

		const SESSION_DISABLED = 0;

		protected $_uniqueId;

		protected $_started;

		protected $_options;

		/**
		 * \Phalcon\Session\Adapter constructor
		 *
		 * @param array options
		 */
		public function __construct($options=null){ }


		/**
		 * Starts the session (if headers are already sent the session will not be started)
		 */
		public function start(){ }


		/**
		 * Sets session's options
		 *
		 *<code>
		 * $session->setOptions(
		 *     [
		 *         "uniqueId" => "my-private-app",
		 *     ]
		 * );
		 *</code>
		 */
		public function setOptions($options){ }


		/**
		 * Get internal options
		 */
		public function getOptions(){ }


		/**
		 * Set session name
		 */
		public function setName($name){ }


		/**
		 * Get session name
		 */
		public function getName(){ }


		/**
		 * {@inheritdoc}
		 */
		public function regenerateId($deleteOldSession=null){ }


		/**
		 * Gets a session variable from an application context
		 *
		 * <code>
		 * $session->get("auth", "yes");
		 * </code>
		 */
		public function get($index, $defaultValue=null, $remove=null){ }


		/**
		 * Sets a session variable in an application context
		 *
		 *<code>
		 * $session->set("auth", "yes");
		 *</code>
		 */
		public function set($index, $value){ }


		/**
		 * Check whether a session variable is set in an application context
		 *
		 *<code>
		 * var_dump(
		 *     $session->has("auth")
		 * );
		 *</code>
		 */
		public function has($index){ }


		/**
		 * Removes a session variable from an application context
		 *
		 * <code>
		 * $session->remove("auth");
		 * </code>
		 */
		public function remove($index){ }


		/**
		 * Returns active session id
		 *
		 *<code>
		 * echo $session->getId();
		 *</code>
		 */
		public function getId(){ }


		/**
		 * Set the current session id
		 *
		 *<code>
		 * $session->setId($id);
		 *</code>
		 */
		public function setId($id){ }


		/**
		 * Check whether the session has been started
		 *
		 *<code>
		 * var_dump(
		 *     $session->isStarted()
		 * );
		 *</code>
		 */
		public function isStarted(){ }


		/**
		 * Destroys the active session
		 *
		 *<code>
		 * var_dump(
		 *     $session->destroy()
		 * );
		 *
		 * var_dump(
		 *     $session->destroy(true)
		 * );
		 *</code>
		 */
		public function destroy($removeData=null){ }


		/**
		 * Returns the status of the current session.
		 *
		 *<code>
		 * var_dump(
		 *     $session->status()
		 * );
		 *
		 * if ($session->status() !== $session::SESSION_ACTIVE) {
		 *     $session->start();
		 * }
		 *</code>
		 */
		public function status(){ }


		/**
		 * Alias: Gets a session variable from an application context
		 */
		public function __get($index){ }


		/**
		 * Alias: Sets a session variable in an application context
		 */
		public function __set($index, $value){ }


		/**
		 * Alias: Check whether a session variable is set in an application context
		 */
		public function __isset($index){ }


		/**
		 * Alias: Removes a session variable from an application context
		 *
		 * <code>
		 * unset($session->auth);
		 * </code>
		 */
		public function __unset($index){ }


		public function __destruct(){ }


		protected function removeSessionData(){ }

	}
}
