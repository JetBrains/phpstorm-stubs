<?php 

namespace Phalcon\Db\Adapter {

	/**
	 * Phalcon\Db\Adapter\Pdo
	 *
	 * Phalcon\Db\Adapter\Pdo is the Phalcon\Db that internally uses PDO to connect to a database
	 *
	 * <code>
	 * use Phalcon\Db\Adapter\Pdo\Mysql;
	 *
	 * $config = [
	 *     "host"     => "localhost",
	 *     "dbname"   => "blog",
	 *     "port"     => 3306,
	 *     "username" => "sigma",
	 *     "password" => "secret",
	 * ];
	 *
	 * $connection = new Mysql($config);
	 *</code>
	 */
	
	abstract class Pdo extends \Phalcon\Db\Adapter implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Db\AdapterInterface {

		protected $_pdo;

		protected $_affectedRows;

		/**
		 * Constructor for \Phalcon\Db\Adapter\Pdo
		 */
		public function __construct($descriptor){ }


		/**
		 * This method is automatically called in \Phalcon\Db\Adapter\Pdo constructor.
		 *
		 * Call it when you need to restore a database connection.
		 *
		 *<code>
		 * use \Phalcon\Db\Adapter\Pdo\Mysql;
		 *
		 * // Make a connection
		 * $connection = new Mysql(
		 *     [
		 *         "host"     => "localhost",
		 *         "username" => "sigma",
		 *         "password" => "secret",
		 *         "dbname"   => "blog",
		 *         "port"     => 3306,
		 *     ]
		 * );
		 *
		 * // Reconnect
		 * $connection->connect();
		 * </code>
		 */
		public function connect($descriptor=null){ }


		/**
		 * Returns a PDO prepared statement to be executed with 'executePrepared'
		 *
		 *<code>
		 * use \Phalcon\Db\Column;
		 *
		 * $statement = $db->prepare(
		 *     "SELECT * FROM robots WHERE name = :name"
		 * );
		 *
		 * $result = $connection->executePrepared(
		 *     $statement,
		 *     [
		 *         "name" => "Voltron",
		 *     ],
		 *     [
		 *         "name" => Column::BIND_PARAM_INT,
		 *     ]
		 * );
		 *</code>
		 */
		public function prepare($sqlStatement){ }


		/**
		 * Executes a prepared statement binding. This function uses integer indexes starting from zero
		 *
		 *<code>
		 * use \Phalcon\Db\Column;
		 *
		 * $statement = $db->prepare(
		 *     "SELECT * FROM robots WHERE name = :name"
		 * );
		 *
		 * $result = $connection->executePrepared(
		 *     $statement,
		 *     [
		 *         "name" => "Voltron",
		 *     ],
		 *     [
		 *         "name" => Column::BIND_PARAM_INT,
		 *     ]
		 * );
		 *</code>
		 *
		 * @param \PDOStatement statement
		 * @param array placeholders
		 * @param array dataTypes
		 * @return \PDOStatement
		 */
		public function executePrepared(\PDOStatement $statement, $placeholders, $dataTypes){ }


		/**
		 * Sends SQL statements to the database server returning the success state.
		 * Use this method only when the SQL statement sent to the server is returning rows
		 *
		 *<code>
		 * // Querying data
		 * $resultset = $connection->query(
		 *     "SELECT * FROM robots WHERE type = 'mechanical'"
		 * );
		 *
		 * $resultset = $connection->query(
		 *     "SELECT * FROM robots WHERE type = ?",
		 *     [
		 *         "mechanical",
		 *     ]
		 * );
		 *</code>
		 */
		public function query($sqlStatement, $bindParams=null, $bindTypes=null){ }


		/**
		 * Sends SQL statements to the database server returning the success state.
		 * Use this method only when the SQL statement sent to the server doesn't return any rows
		 *
		 *<code>
		 * // Inserting data
		 * $success = $connection->execute(
		 *     "INSERT INTO robots VALUES (1, 'Astro Boy')"
		 * );
		 *
		 * $success = $connection->execute(
		 *     "INSERT INTO robots VALUES (?, ?)",
		 *     [
		 *         1,
		 *         "Astro Boy",
		 *     ]
		 * );
		 *</code>
		 */
		public function execute($sqlStatement, $bindParams=null, $bindTypes=null){ }


		/**
		 * Returns the number of affected rows by the latest INSERT/UPDATE/DELETE executed in the database system
		 *
		 *<code>
		 * $connection->execute(
		 *     "DELETE FROM robots"
		 * );
		 *
		 * echo $connection->affectedRows(), " were deleted";
		 *</code>
		 */
		public function affectedRows(){ }


		/**
		 * Closes the active connection returning success. \Phalcon automatically closes and destroys
		 * active connections when the request ends
		 */
		public function close(){ }


		/**
		 * Escapes a value to avoid SQL injections according to the active charset in the connection
		 *
		 *<code>
		 * $escapedStr = $connection->escapeString("some dangerous value");
		 *</code>
		 */
		public function escapeString($str){ }


		/**
		 * Converts bound parameters such as :name: or ?1 into PDO bind params ?
		 *
		 *<code>
		 * print_r(
		 *     $connection->convertBoundParams(
		 *         "SELECT * FROM robots WHERE name = :name:",
		 *         [
		 *             "Bender",
		 *         ]
		 *     )
		 * );
		 *</code>
		 */
		public function convertBoundParams($sql, $params=null){ }


		/**
		 * Returns the insert id for the auto_increment/serial column inserted in the latest executed SQL statement
		 *
		 *<code>
		 * // Inserting a new robot
		 * $success = $connection->insert(
		 *     "robots",
		 *     [
		 *         "Astro Boy",
		 *         1952,
		 *     ],
		 *     [
		 *         "name",
		 *         "year",
		 *     ]
		 * );
		 *
		 * // Getting the generated id
		 * $id = $connection->lastInsertId();
		 *</code>
		 *
		 * @param string sequenceName
		 * @return int|boolean
		 */
		public function lastInsertId($sequenceName=null){ }


		/**
		 * Starts a transaction in the connection
		 */
		public function begin($nesting=null){ }


		/**
		 * Rollbacks the active transaction in the connection
		 */
		public function rollback($nesting=null){ }


		/**
		 * Commits the active transaction in the connection
		 */
		public function commit($nesting=null){ }


		/**
		 * Returns the current transaction nesting level
		 */
		public function getTransactionLevel(){ }


		/**
		 * Checks whether the connection is under a transaction
		 *
		 *<code>
		 * $connection->begin();
		 *
		 * // true
		 * var_dump(
		 *     $connection->isUnderTransaction()
		 * );
		 *</code>
		 */
		public function isUnderTransaction(){ }


		/**
		 * Return internal PDO handler
		 */
		public function getInternalHandler(){ }


		/**
		 * Return the error info, if any
		 *
		 * @return array
		 */
		public function getErrorInfo(){ }

	}
}
