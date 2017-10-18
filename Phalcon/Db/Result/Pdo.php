<?php 

namespace Phalcon\Db\Result {

	/**
	 * Phalcon\Db\Result\Pdo
	 *
	 * Encapsulates the resultset internals
	 *
	 * <code>
	 * $result = $connection->query("SELECT * FROM robots ORDER BY name");
	 *
	 * $result->setFetchMode(
	 *     \Phalcon\Db::FETCH_NUM
	 * );
	 *
	 * while ($robot = $result->fetchArray()) {
	 *     print_r($robot);
	 * }
	 * </code>
	 */
	
	class Pdo implements \Phalcon\Db\ResultInterface {

		protected $_connection;

		protected $_result;

		protected $_fetchMode;

		protected $_pdoStatement;

		protected $_sqlStatement;

		protected $_bindParams;

		protected $_bindTypes;

		protected $_rowCount;

		/**
		 * \Phalcon\Db\Result\Pdo constructor
		 *
		 * @param \Phalcon\Db\AdapterInterface connection
		 * @param \PDOStatement result
		 * @param string sqlStatement
		 * @param array bindParams
		 * @param array bindTypes
		 */
		public function __construct(\Phalcon\Db\AdapterInterface $connection, \PDOStatement $result, $sqlStatement=null, $bindParams=null, $bindTypes=null){ }


		/**
		 * Allows to execute the statement again. Some database systems don't support scrollable cursors,
		 * So, as cursors are forward only, we need to execute the cursor again to fetch rows from the begining
		 */
		public function execute(){ }


		/**
		 * Fetches an array/object of strings that corresponds to the fetched row, or FALSE if there are no more rows.
		 * This method is affected by the active fetch flag set using \Phalcon\Db\Result\Pdo::setFetchMode
		 *
		 *<code>
		 * $result = $connection->query("SELECT * FROM robots ORDER BY name");
		 *
		 * $result->setFetchMode(
		 *     \Phalcon\Db::FETCH_OBJ
		 * );
		 *
		 * while ($robot = $result->fetch()) {
		 *     echo $robot->name;
		 * }
		 *</code>
		 */
		public function fetch($fetchStyle=null, $cursorOrientation=null, $cursorOffset=null){ }


		/**
		 * Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.
		 * This method is affected by the active fetch flag set using \Phalcon\Db\Result\Pdo::setFetchMode
		 *
		 *<code>
		 * $result = $connection->query("SELECT * FROM robots ORDER BY name");
		 *
		 * $result->setFetchMode(
		 *     \Phalcon\Db::FETCH_NUM
		 * );
		 *
		 * while ($robot = result->fetchArray()) {
		 *     print_r($robot);
		 * }
		 *</code>
		 */
		public function fetchArray(){ }


		/**
		 * Returns an array of arrays containing all the records in the result
		 * This method is affected by the active fetch flag set using \Phalcon\Db\Result\Pdo::setFetchMode
		 *
		 *<code>
		 * $result = $connection->query(
		 *     "SELECT * FROM robots ORDER BY name"
		 * );
		 *
		 * $robots = $result->fetchAll();
		 *</code>
		 */
		public function fetchAll($fetchStyle=null, $fetchArgument=null, $ctorArgs=null){ }


		/**
		 * Gets number of rows returned by a resultset
		 *
		 *<code>
		 * $result = $connection->query(
		 *     "SELECT * FROM robots ORDER BY name"
		 * );
		 *
		 * echo "There are ", $result->numRows(), " rows in the resultset";
		 *</code>
		 */
		public function numRows(){ }


		/**
		 * Moves internal resultset cursor to another position letting us to fetch a certain row
		 *
		 *<code>
		 * $result = $connection->query(
		 *     "SELECT * FROM robots ORDER BY name"
		 * );
		 *
		 * // Move to third row on result
		 * $result->dataSeek(2);
		 *
		 * // Fetch third row
		 * $row = $result->fetch();
		 *</code>
		 */
		public function dataSeek($number){ }


		/**
		 * Changes the fetching mode affecting \Phalcon\Db\Result\Pdo::fetch()
		 *
		 *<code>
		 * // Return array with integer indexes
		 * $result->setFetchMode(
		 *     \Phalcon\Db::FETCH_NUM
		 * );
		 *
		 * // Return associative array without integer indexes
		 * $result->setFetchMode(
		 *     \Phalcon\Db::FETCH_ASSOC
		 * );
		 *
		 * // Return associative array together with integer indexes
		 * $result->setFetchMode(
		 *     \Phalcon\Db::FETCH_BOTH
		 * );
		 *
		 * // Return an object
		 * $result->setFetchMode(
		 *     \Phalcon\Db::FETCH_OBJ
		 * );
		 *</code>
		 */
		public function setFetchMode($fetchMode, $colNoOrClassNameOrObject=null, $ctorargs=null){ }


		/**
		 * Gets the internal PDO result object
		 */
		public function getInternalResult(){ }

	}
}
