<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Adapter
	 *
	 * Base class for Phalcon\Db adapters
	 */
	
	abstract class Adapter implements \Phalcon\Db\AdapterInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_eventsManager;

		protected $_descriptor;

		protected $_dialectType;

		protected $_type;

		protected $_dialect;

		protected $_connectionId;

		protected $_sqlStatement;

		protected $_sqlVariables;

		protected $_sqlBindTypes;

		protected $_transactionLevel;

		protected $_transactionsWithSavepoints;

		protected static $_connectionConsecutive;

		/**
		 * Name of the dialect used
		 */
		public function getDialectType(){ }


		/**
		 * Type of database system the adapter is used for
		 */
		public function getType(){ }


		/**
		 * Active SQL bound parameter variables
		 */
		public function getSqlVariables(){ }


		/**
		 * \Phalcon\Db\Adapter constructor
		 */
		public function __construct($descriptor){ }


		/**
		 * Sets the event manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Sets the dialect used to produce the SQL
		 */
		public function setDialect(\Phalcon\Db\DialectInterface $dialect){ }


		/**
		 * Returns internal dialect instance
		 */
		public function getDialect(){ }


		/**
		 * Returns the first row in a SQL query result
		 *
		 *<code>
		 * // Getting first robot
		 * $robot = $connection->fetchOne("SELECT * FROM robots");
		 * print_r($robot);
		 *
		 * // Getting first robot with associative indexes only
		 * $robot = $connection->fetchOne("SELECT * FROM robots", \Phalcon\Db::FETCH_ASSOC);
		 * print_r($robot);
		 *</code>
		 */
		public function fetchOne($sqlQuery, $fetchMode=null, $bindParams=null, $bindTypes=null){ }


		/**
		 * Dumps the complete result of a query into an array
		 *
		 *<code>
		 * // Getting all robots with associative indexes only
		 * $robots = $connection->fetchAll(
		 *     "SELECT * FROM robots",
		 *     \Phalcon\Db::FETCH_ASSOC
		 * );
		 *
		 * foreach ($robots as $robot) {
		 *     print_r($robot);
		 * }
		 *
		 *  // Getting all robots that contains word "robot" withing the name
		 * $robots = $connection->fetchAll(
		 *     "SELECT * FROM robots WHERE name LIKE :name",
		 *     \Phalcon\Db::FETCH_ASSOC,
		 *     [
		 *         "name" => "%robot%",
		 *     ]
		 * );
		 * foreach($robots as $robot) {
		 *     print_r($robot);
		 * }
		 *</code>
		 *
		 * @param string sqlQuery
		 * @param int fetchMode
		 * @param array bindParams
		 * @param array bindTypes
		 * @return array
		 */
		public function fetchAll($sqlQuery, $fetchMode=null, $bindParams=null, $bindTypes=null){ }


		/**
		 * Returns the n'th field of first row in a SQL query result
		 *
		 *<code>
		 * // Getting count of robots
		 * $robotsCount = $connection->fetchColumn("SELECT count(*) FROM robots");
		 * print_r($robotsCount);
		 *
		 * // Getting name of last edited robot
		 * $robot = $connection->fetchColumn(
		 *     "SELECT id, name FROM robots order by modified desc",
		 *     1
		 * );
		 * print_r($robot);
		 *</code>
		 *
		 * @param  string sqlQuery
		 * @param  array placeholders
		 * @param  int|string column
		 * @return string|
		 */
		public function fetchColumn($sqlQuery, $placeholders=null, $column=null){ }


		/**
		 * Inserts data into a table using custom RDBMS SQL syntax
		 *
		 * <code>
		 * // Inserting a new robot
		 * $success = $connection->insert(
		 *     "robots",
		 *     ["Astro Boy", 1952],
		 *     ["name", "year"]
		 * );
		 *
		 * // Next SQL sentence is sent to the database system
		 * INSERT INTO `robots` (`name`, `year`) VALUES ("Astro boy", 1952);
		 * </code>
		 *
		 * @param   string|array table
		 * @param 	array values
		 * @param 	array fields
		 * @param 	array dataTypes
		 * @return 	boolean
		 */
		public function insert($table, $values, $fields=null, $dataTypes=null){ }


		/**
		 * Inserts data into a table using custom RBDM SQL syntax
		 *
		 * <code>
		 * // Inserting a new robot
		 * $success = $connection->insertAsDict(
		 *     "robots",
		 *     [
		 *         "name" => "Astro Boy",
		 *         "year" => 1952,
		 *     ]
		 * );
		 *
		 * // Next SQL sentence is sent to the database system
		 * INSERT INTO `robots` (`name`, `year`) VALUES ("Astro boy", 1952);
		 * </code>
		 *
		 * @param 	string table
		 * @param 	array data
		 * @param 	array dataTypes
		 * @return 	boolean
		 */
		public function insertAsDict($table, $data, $dataTypes=null){ }


		/**
		 * Updates data on a table using custom RBDM SQL syntax
		 *
		 * <code>
		 * // Updating existing robot
		 * $success = $connection->update(
		 *     "robots",
		 *     ["name"],
		 *     ["New Astro Boy"],
		 *     "id = 101"
		 * );
		 *
		 * // Next SQL sentence is sent to the database system
		 * UPDATE `robots` SET `name` = "Astro boy" WHERE id = 101
		 *
		 * // Updating existing robot with array condition and $dataTypes
		 * $success = $connection->update(
		 *     "robots",
		 *     ["name"],
		 *     ["New Astro Boy"],
		 *     [
		 *         "conditions" => "id = ?",
		 *         "bind"       => [$some_unsafe_id],
		 *         "bindTypes"  => [PDO::PARAM_INT], // use only if you use $dataTypes param
		 *     ],
		 *     [
		 *         PDO::PARAM_STR
		 *     ]
		 * );
		 *
		 * </code>
		 *
		 * Warning! If $whereCondition is string it not escaped.
		 *
		 * @param   string|array table
		 * @param 	array fields
		 * @param 	array values
		 * @param 	string|array whereCondition
		 * @param 	array dataTypes
		 * @return 	boolean
		 */
		public function update($table, $fields, $values, $whereCondition=null, $dataTypes=null){ }


		/**
		 * Updates data on a table using custom RBDM SQL syntax
		 * Another, more convenient syntax
		 *
		 * <code>
		 * // Updating existing robot
		 * $success = $connection->updateAsDict(
		 *     "robots",
		 *     [
		 *         "name" => "New Astro Boy",
		 *     ],
		 *     "id = 101"
		 * );
		 *
		 * // Next SQL sentence is sent to the database system
		 * UPDATE `robots` SET `name` = "Astro boy" WHERE id = 101
		 * </code>
		 *
		 * @param 	string table
		 * @param 	array data
		 * @param 	string whereCondition
		 * @param 	array dataTypes
		 * @return 	boolean
		 */
		public function updateAsDict($table, $data, $whereCondition=null, $dataTypes=null){ }


		/**
		 * Deletes data from a table using custom RBDM SQL syntax
		 *
		 * <code>
		 * // Deleting existing robot
		 * $success = $connection->delete(
		 *     "robots",
		 *     "id = 101"
		 * );
		 *
		 * // Next SQL sentence is generated
		 * DELETE FROM `robots` WHERE `id` = 101
		 * </code>
		 *
		 * @param  string|array table
		 * @param  string whereCondition
		 * @param  array placeholders
		 * @param  array dataTypes
		 * @return boolean
		 */
		public function delete($table, $whereCondition=null, $placeholders=null, $dataTypes=null){ }


		/**
		 * Escapes a column/table/schema name
		 *
		 *<code>
		 * $escapedTable = $connection->escapeIdentifier(
		 *     "robots"
		 * );
		 *
		 * $escapedTable = $connection->escapeIdentifier(
		 *     [
		 *         "store",
		 *         "robots",
		 *     ]
		 * );
		 *</code>
		 *
		 * @param array|string identifier
		 */
		public function escapeIdentifier($identifier){ }


		/**
		 * Gets a list of columns
		 *
		 * @param	array columnList
		 * @return	string
		 */
		public function getColumnList($columnList){ }


		/**
		 * Appends a LIMIT clause to $sqlQuery argument
		 *
		 * <code>
		 * echo $connection->limit("SELECT * FROM robots", 5);
		 * </code>
		 */
		public function limit($sqlQuery, $number){ }


		/**
		 * Generates SQL checking for the existence of a schema.table
		 *
		 *<code>
		 * var_dump(
		 *     $connection->tableExists("blog", "posts")
		 * );
		 *</code>
		 */
		public function tableExists($tableName, $schemaName=null){ }


		/**
		 * Generates SQL checking for the existence of a schema.view
		 *
		 *<code>
		 * var_dump(
		 *     $connection->viewExists("active_users", "posts")
		 * );
		 *</code>
		 */
		public function viewExists($viewName, $schemaName=null){ }


		/**
		 * Returns a SQL modified with a FOR UPDATE clause
		 */
		public function forUpdate($sqlQuery){ }


		/**
		 * Returns a SQL modified with a LOCK IN SHARE MODE clause
		 */
		public function sharedLock($sqlQuery){ }


		/**
		 * Creates a table
		 */
		public function createTable($tableName, $schemaName, $definition){ }


		/**
		 * Drops a table from a schema/database
		 */
		public function dropTable($tableName, $schemaName=null, $ifExists=null){ }


		/**
		 * Creates a view
		 */
		public function createView($viewName, $definition, $schemaName=null){ }


		/**
		 * Drops a view
		 */
		public function dropView($viewName, $schemaName=null, $ifExists=null){ }


		/**
		 * Adds a column to a table
		 */
		public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column){ }


		/**
		 * Modifies a table column based on a definition
		 */
		public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn=null){ }


		/**
		 * Drops a column from a table
		 */
		public function dropColumn($tableName, $schemaName, $columnName){ }


		/**
		 * Adds an index to a table
		 */
		public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index){ }


		/**
		 * Drop an index from a table
		 */
		public function dropIndex($tableName, $schemaName, $indexName){ }


		/**
		 * Adds a primary key to a table
		 */
		public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index){ }


		/**
		 * Drops a table's primary key
		 */
		public function dropPrimaryKey($tableName, $schemaName){ }


		/**
		 * Adds a foreign key to a table
		 */
		public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference){ }


		/**
		 * Drops a foreign key from a table
		 */
		public function dropForeignKey($tableName, $schemaName, $referenceName){ }


		/**
		 * Returns the SQL column definition from a column
		 */
		public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column){ }


		/**
		 * List all tables on a database
		 *
		 *<code>
		 * print_r(
		 *     $connection->listTables("blog")
		 * );
		 *</code>
		 */
		public function listTables($schemaName=null){ }


		/**
		 * List all views on a database
		 *
		 *<code>
		 * print_r(
		 *     $connection->listViews("blog")
		 * );
		 *</code>
		 */
		public function listViews($schemaName=null){ }


		/**
		 * Lists table indexes
		 *
		 *<code>
		 * print_r(
		 *     $connection->describeIndexes("robots_parts")
		 * );
		 *</code>
		 *
		 * @param	string table
		 * @param	string schema
		 * @return	Phalcon\Db\Index[]
		 */
		public function describeIndexes($table, $schema=null){ }


		/**
		 * Lists table references
		 *
		 *<code>
		 * print_r(
		 *     $connection->describeReferences("robots_parts")
		 * );
		 *</code>
		 */
		public function describeReferences($table, $schema=null){ }


		/**
		 * Gets creation options from a table
		 *
		 *<code>
		 * print_r(
		 *     $connection->tableOptions("robots")
		 * );
		 *</code>
		 */
		public function tableOptions($tableName, $schemaName=null){ }


		/**
		 * Creates a new savepoint
		 */
		public function createSavepoint($name){ }


		/**
		 * Releases given savepoint
		 */
		public function releaseSavepoint($name){ }


		/**
		 * Rollbacks given savepoint
		 */
		public function rollbackSavepoint($name){ }


		/**
		 * Set if nested transactions should use savepoints
		 */
		public function setNestedTransactionsWithSavepoints($nestedTransactionsWithSavepoints){ }


		/**
		 * Returns if nested transactions should use savepoints
		 */
		public function isNestedTransactionsWithSavepoints(){ }


		/**
		 * Returns the savepoint name to use for nested transactions
		 */
		public function getNestedTransactionSavepointName(){ }


		/**
		 * Returns the default identity value to be inserted in an identity column
		 *
		 *<code>
		 * // Inserting a new robot with a valid default value for the column 'id'
		 * $success = $connection->insert(
		 *     "robots",
		 *     [
		 *         $connection->getDefaultIdValue(),
		 *         "Astro Boy",
		 *         1952,
		 *     ],
		 *     [
		 *         "id",
		 *         "name",
		 *         "year",
		 *     ]
		 * );
		 *</code>
		 */
		public function getDefaultIdValue(){ }


		/**
		 * Returns the default value to make the RBDM use the default value declared in the table definition
		 *
		 *<code>
		 * // Inserting a new robot with a valid default value for the column 'year'
		 * $success = $connection->insert(
		 *     "robots",
		 *     [
		 *         "Astro Boy",
		 *         $connection->getDefaultValue()
		 *     ],
		 *     [
		 *         "name",
		 *         "year",
		 *     ]
		 * );
		 *</code>
		 */
		public function getDefaultValue(){ }


		/**
		 * Check whether the database system requires a sequence to produce auto-numeric values
		 */
		public function supportSequences(){ }


		/**
		 * Check whether the database system requires an explicit value for identity columns
		 */
		public function useExplicitIdValue(){ }


		/**
		 * Return descriptor used to connect to the active database
		 */
		public function getDescriptor(){ }


		/**
		 * Gets the active connection unique identifier
		 *
		 * @return string
		 */
		public function getConnectionId(){ }


		/**
		 * Active SQL statement in the object
		 */
		public function getSQLStatement(){ }


		/**
		 * Active SQL statement in the object without replace bound parameters
		 */
		public function getRealSQLStatement(){ }


		/**
		 * Active SQL statement in the object
		 *
		 * @return array
		 */
		public function getSQLBindTypes(){ }

	}
}
