<?php 

namespace Phalcon\Mvc\Model\MetaData {

	/**
	 * Phalcon\Mvc\Model\MetaData\Redis
	 *
	 * Stores model meta-data in the Redis.
	 *
	 * By default meta-data is stored for 48 hours (172800 seconds)
	 *
	 *<code>
	 * use Phalcon\Mvc\Model\Metadata\Redis;
	 *
	 * $metaData = new Redis(
	 *     [
	 *         "host"       => "127.0.0.1",
	 *         "port"       => 6379,
	 *         "persistent" => 0,
	 *         "statsKey"   => "_PHCM_MM",
	 *         "lifetime"   => 172800,
	 *         "index"      => 2,
	 *     ]
	 * );
	 *</code>
	 */
	
	class Redis extends \Phalcon\Mvc\Model\MetaData implements \Phalcon\Mvc\Model\MetaDataInterface, \Phalcon\Di\InjectionAwareInterface {

		const MODELS_ATTRIBUTES = 0;

		const MODELS_PRIMARY_KEY = 1;

		const MODELS_NON_PRIMARY_KEY = 2;

		const MODELS_NOT_NULL = 3;

		const MODELS_DATA_TYPES = 4;

		const MODELS_DATA_TYPES_NUMERIC = 5;

		const MODELS_DATE_AT = 6;

		const MODELS_DATE_IN = 7;

		const MODELS_IDENTITY_COLUMN = 8;

		const MODELS_DATA_TYPES_BIND = 9;

		const MODELS_AUTOMATIC_DEFAULT_INSERT = 10;

		const MODELS_AUTOMATIC_DEFAULT_UPDATE = 11;

		const MODELS_DEFAULT_VALUES = 12;

		const MODELS_EMPTY_STRING_VALUES = 13;

		const MODELS_COLUMN_MAP = 0;

		const MODELS_REVERSE_COLUMN_MAP = 1;

		protected $_ttl;

		protected $_redis;

		protected $_metaData;

		/**
		 * \Phalcon\Mvc\Model\MetaData\Redis constructor
		 *
		 * @param array options
		 */
		public function __construct($options=null){ }


		/**
		 * Reads metadata from Redis
		 */
		public function read($key){ }


		/**
		 * Writes the metadata to Redis
		 */
		public function write($key, $data){ }


		/**
		 * Flush Redis data and resets internal meta-data in order to regenerate it
		 */
		public function reset(){ }

	}
}
