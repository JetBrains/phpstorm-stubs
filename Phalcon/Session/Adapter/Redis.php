<?php 

namespace Phalcon\Session\Adapter {

	/**
	 * Phalcon\Session\Adapter\Redis
	 *
	 * This adapter store sessions in Redis
	 *
	 * <code>
	 * use Phalcon\Session\Adapter\Redis;
	 *
	 * $session = new Redis(
	 *     [
	 *         "uniqueId"   => "my-private-app",
	 *         "host"       => "localhost",
	 *         "port"       => 6379,
	 *         "auth"       => "foobared",
	 *         "persistent" => false,
	 *         "lifetime"   => 3600,
	 *         "prefix"     => "my",
	 *         "index"      => 1,
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
	
	class Redis extends \Phalcon\Session\Adapter implements \Phalcon\Session\AdapterInterface {

		const SESSION_ACTIVE = 2;

		const SESSION_NONE = 1;

		const SESSION_DISABLED = 0;

		protected $_redis;

		protected $_lifetime;

		public function getRedis(){ }


		public function getLifetime(){ }


		/**
		 * \Phalcon\Session\Adapter\Redis constructor
		 */
		public function __construct($options=null){ }


		/**
		 * {@inheritdoc}
		 */
		public function open(){ }


		/**
		 * {@inheritdoc}
		 */
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
