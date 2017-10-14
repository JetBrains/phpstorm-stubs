<?php 

namespace Phalcon\Db\Dialect {

	/**
	 * Phalcon\Db\Dialect\Sqlite
	 *
	 * Generates database specific SQL for the Sqlite RDBMS
	 */
	
	class Sqlite extends \Phalcon\Db\Dialect implements \Phalcon\Db\DialectInterface {

		protected $_escapeChar;

		/**
		 * Gets the column name in SQLite
		 */
		public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column){ }


		/**
		 * Generates SQL to add a column to a table
		 */
		public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column){ }


		/**
		 * Generates SQL to modify a column in a table
		 */
		public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn=null){ }


		/**
		 * Generates SQL to delete a column from a table
		 */
		public function dropColumn($tableName, $schemaName, $columnName){ }


		/**
		 * Generates SQL to add an index to a table
		 */
		public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index){ }


		/**
		 * Generates SQL to delete an index from a table
		 */
		public function dropIndex($tableName, $schemaName, $indexName){ }


		/**
		 * Generates SQL to add the primary key to a table
		 */
		public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index){ }


		/**
		 * Generates SQL to delete primary key from a table
		 */
		public function dropPrimaryKey($tableName, $schemaName){ }


		/**
		 * Generates SQL to add an index to a table
		 */
		public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference){ }


		/**
		 * Generates SQL to delete a foreign key from a table
		 */
		public function dropForeignKey($tableName, $schemaName, $referenceName){ }


		/**
		 * Generates SQL to create a table
		 */
		public function createTable($tableName, $schemaName, $definition){ }


		/**
		 * Generates SQL to truncate a table
		 */
		public function truncateTable($tableName, $schemaName){ }


		/**
		 * Generates SQL to drop a table
		 */
		public function dropTable($tableName, $schemaName=null, $ifExists=null){ }


		/**
		 * Generates SQL to create a view
		 */
		public function createView($viewName, $definition, $schemaName=null){ }


		/**
		 * Generates SQL to drop a view
		 */
		public function dropView($viewName, $schemaName=null, $ifExists=null){ }


		/**
		 * Generates SQL checking for the existence of a schema.table
		 *
		 * <code>
		 * echo $dialect->tableExists("posts", "blog");
		 *
		 * echo $dialect->tableExists("posts");
		 * </code>
		 */
		public function tableExists($tableName, $schemaName=null){ }


		/**
		 * Generates SQL checking for the existence of a schema.view
		 */
		public function viewExists($viewName, $schemaName=null){ }


		/**
		 * Generates SQL describing a table
		 *
		 * <code>
		 * print_r(
		 *     $dialect->describeColumns("posts")
		 * );
		 * </code>
		 */
		public function describeColumns($table, $schema=null){ }


		/**
		 * List all tables in database
		 *
		 * <code>
		 * print_r(
		 *     $dialect->listTables("blog")
		 * );
		 * </code>
		 */
		public function listTables($schemaName=null){ }


		/**
		 * Generates the SQL to list all views of a schema or user
		 */
		public function listViews($schemaName=null){ }


		/**
		 * Generates the SQL to get query list of indexes
		 *
		 * <code>
		 * print_r(
		 *     $dialect->listIndexesSql("blog")
		 * );
		 * </code>
		 */
		public function listIndexesSql($table, $schema=null, $keyName=null){ }


		/**
		 * Generates SQL to query indexes on a table
		 */
		public function describeIndexes($table, $schema=null){ }


		/**
		 * Generates SQL to query indexes detail on a table
		 */
		public function describeIndex($index){ }


		/**
		 * Generates SQL to query foreign keys on a table
		 */
		public function describeReferences($table, $schema=null){ }


		/**
		 * Generates the SQL to describe the table creation options
		 */
		public function tableOptions($table, $schema=null){ }

	}
}
