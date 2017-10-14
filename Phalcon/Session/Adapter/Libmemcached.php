<?php 

namespace Phalcon\Session\Adapter {

	/**
	 * Phalcon\Session\Adapter\Libmemcached
	 *
	 * This adapter store sessions in libmemcached
	 *
	 * <code>
	 * use Phalcon\Session\Adapter\Libmemcached;
	 *
	 * $session = new Libmemcached(
	 *     [
	 *         "servers" => [
	 *             [
	 *                 "host"   => "localhost",
	 *                 "port"   => 11211,
	 *                 "weight" => 1,
	 *             ],
	 *         ],
	 *         "client" => [
	 *             \Memcached::OPT_HASH       => \Memcached::HASH_MD5,
	 *             \Memcached::OPT_PREFIX_KEY => "prefix.",
	 *         ],
	 *         "lifetime" => 3600,
	 *         "prefix"   => "my_",
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
	
	class Libmemcached extends \Phalcon\Session\Adapter implements \Phalcon\Session\AdapterInterface {

		const SESSION_ACTIVE = 2;

		const SESSION_NONE = 1;

		const SESSION_DISABLED = 0;

		protected $_libmemcached;

		protected $_lifetime;

		public function getLibmemcached(){ }


		public function getLifetime(){ }


		/**
		 * \Phalcon\Session\Adapter\Libmemcached constructor
		 *
		 * @throws \Phalcon\Session\Exception
		 */
		public function __construct($options){ }


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
