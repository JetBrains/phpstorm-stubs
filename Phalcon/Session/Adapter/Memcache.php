<?php 

namespace Phalcon\Session\Adapter {

	/**
	 * Phalcon\Session\Adapter\Memcache
	 *
	 * This adapter store sessions in memcache
	 *
	 * <code>
	 * use Phalcon\Session\Adapter\Memcache;
	 *
	 * $session = new Memcache(
	 *     [
	 *         "uniqueId"   => "my-private-app",
	 *         "host"       => "127.0.0.1",
	 *         "port"       => 11211,
	 *         "persistent" => true,
	 *         "lifetime"   => 3600,
	 *         "prefix"     => "my_",
	 *     ]
	 * );
	 *
	 * $session->start();
	 *
	 * $session->set("var", "some-value");
	 *
	 * echo $session->get("var");
	 * </code>
	 */
	
	class Memcache extends \Phalcon\Session\Adapter implements \Phalcon\Session\AdapterInterface {

		const SESSION_ACTIVE = 2;

		const SESSION_NONE = 1;

		const SESSION_DISABLED = 0;

		protected $_memcache;

		protected $_lifetime;

		public function getMemcache(){ }


		public function getLifetime(){ }


		/**
		 * \Phalcon\Session\Adapter\Memcache constructor
		 */
		public function __construct($options=null){ }


		public function open(){ }


		public function close(){ }


		/**
		 * {@inheritdoc}
		 */
		public function read($sessionId){ }


		/**
		 * {@inheritdoc}
		 */
		public function write($sessionId, $data){ }


		/**
		 * {@inheritdoc}
		 */
		public function destroy($sessionId=null){ }


		/**
		 * {@inheritdoc}
		 */
		public function gc(){ }

	}
}
