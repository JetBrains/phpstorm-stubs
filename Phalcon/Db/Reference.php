<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Reference
	 *
	 * Allows to define reference constraints on tables
	 *
	 *<code>
	 * $reference = new \Phalcon\Db\Reference(
	 *     "field_fk",
	 *     [
	 *         "referencedSchema"  => "invoicing",
	 *         "referencedTable"   => "products",
	 *         "columns"           => [
	 *             "product_type",
	 *             "product_code",
	 *         ],
	 *         "referencedColumns" => [
	 *             "type",
	 *             "code",
	 *         ],
	 *     ]
	 * );
	 *</code>
	 */
	
	class Reference implements \Phalcon\Db\ReferenceInterface {

		protected $_name;

		protected $_schemaName;

		protected $_referencedSchema;

		protected $_referencedTable;

		protected $_columns;

		protected $_referencedColumns;

		protected $_onDelete;

		protected $_onUpdate;

		/**
		 * Constraint name
		 */
		public function getName(){ }


		public function getSchemaName(){ }


		public function getReferencedSchema(){ }


		/**
		 * Referenced Table
		 */
		public function getReferencedTable(){ }


		/**
		 * Local reference columns
		 */
		public function getColumns(){ }


		/**
		 * Referenced Columns
		 */
		public function getReferencedColumns(){ }


		/**
		 * ON DELETE
		 */
		public function getOnDelete(){ }


		/**
		 * ON UPDATE
		 */
		public function getOnUpdate(){ }


		/**
		 * \Phalcon\Db\Reference constructor
		 */
		public function __construct($name, $definition){ }


		/**
		 * Restore a \Phalcon\Db\Reference object from export
		 */
		public static function __set_state($data){ }

	}
}
