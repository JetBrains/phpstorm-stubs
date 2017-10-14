<?php 

namespace Phalcon\Db\Adapter\Pdo {

	/**
	 * Phalcon\Db\Adapter\Pdo\Sqlite
	 *
	 * Specific functions for the Sqlite database system
	 *
	 * <code>
	 * use Phalcon\Db\Adapter\Pdo\Sqlite;
	 *
	 * $connection = new Sqlite(
	 *     [
	 *         "dbname" => "/tmp/test.sqlite",
	 *     ]
	 * );
	 * </code>
	 */
	
	class Sqlite extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_type;

		protected $_dialectType;

		/**
		 * This method is automatically called in \Phalcon\Db\Adapter\Pdo constructor.
		 * Call it when you need to restore a database connection.
		 */
		public function connect($descriptor=null){ }


		/**
		 * Returns an array of \Phalcon\Db\Column objects describing a table
		 *
		 * <code>
		 * print_r(
		 *     $connection->describeColumns("posts")
		 * );
		 * </code>
		 */
		public function describeColumns($table, $schema=null){ }


		/**
		 * Lists table indexes
		 *
		 * <code>
		 * print_r(
		 *     $connection->describeIndexes("robots_parts")
		 * );
		 * </code>
		 *
		 * @param  string table
		 * @param  string schema
		 * @return \Phalcon\Db\IndexInterface[]
		 */
		public function describeIndexes($table, $schema=null){ }


		/**
		 * Lists table references
		 *
		 * @param	string table
		 * @param	string schema
		 * @return	Phalcon\Db\ReferenceInterface[]
		 */
		public function describeReferences($table, $schema=null){ }


		/**
		 * Check whether the database system requires an explicit value for identity columns
		 */
		public function useExplicitIdValue(){ }


		/**
		 * Returns the default value to make the RBDM use the default value declared in the table definition
		 *
		 *<code>
		 * // Inserting a new robot with a valid default value for the column 'year'
		 * $success = $connection->insert(
		 *     "robots",
		 *     [
		 *         "Astro Boy",
		 *         $connection->getDefaultValue(),
		 *     ],
		 *     [
		 *         "name",
		 *         "year",
		 *     ]
		 * );
		 *</code>
		 */
		public function getDefaultValue(){ }

	}
}
