<?php 

namespace Phalcon\Mvc\Model\MetaData {

	/**
	 * Phalcon\Mvc\Model\MetaData\Files
	 *
	 * Stores model meta-data in PHP files.
	 *
	 *<code>
	 * $metaData = new \Phalcon\Mvc\Model\Metadata\Files(
	 *     [
	 *         "metaDataDir" => "app/cache/metadata/",
	 *     ]
	 * );
	 *</code>
	 */
	
	class Files extends \Phalcon\Mvc\Model\MetaData implements \Phalcon\Mvc\Model\MetaDataInterface, \Phalcon\Di\InjectionAwareInterface {

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

		protected $_metaDataDir;

		protected $_metaData;

		/**
		 * \Phalcon\Mvc\Model\MetaData\Files constructor
		 *
		 * @param array options
		 */
		public function __construct($options=null){ }


		/**
		 * Reads meta-data from files
		 *
		 * @param string key
		 * @return mixed
		 */
		public function read($key){ }


		/**
		 * Writes the meta-data to files
		 *
		 * @param string key
		 * @param array data
		 */
		public function write($key, $data){ }

	}
}
