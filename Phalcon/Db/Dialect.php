<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Dialect
	 *
	 * This is the base class to each database dialect. This implements
	 * common methods to transform intermediate code into its RDBMS related syntax
	 */
	
	abstract class Dialect implements \Phalcon\Db\DialectInterface {

		protected $_escapeChar;

		protected $_customFunctions;

		/**
		 * Registers custom SQL functions
		 */
		public function registerCustomFunction($name, $customFunction){ }


		/**
		 * Returns registered functions
		 */
		public function getCustomFunctions(){ }


		/**
		 * Escape Schema
		 */
		final public function escapeSchema($str, $escapeChar=null){ }


		/**
		 * Escape identifiers
		 */
		final public function escape($str, $escapeChar=null){ }


		/**
		 * Generates the SQL for LIMIT clause
		 *
		 * <code>
		 * $sql = $dialect->limit("SELECT * FROM robots", 10);
		 * echo $sql; // SELECT * FROM robots LIMIT 10
		 *
		 * $sql = $dialect->limit("SELECT * FROM robots", [10, 50]);
		 * echo $sql; // SELECT * FROM robots LIMIT 10 OFFSET 50
		 * </code>
		 */
		public function limit($sqlQuery, $number){ }


		/**
		 * Returns a SQL modified with a FOR UPDATE clause
		 *
		 *<code>
		 * $sql = $dialect->forUpdate("SELECT * FROM robots");
		 * echo $sql; // SELECT * FROM robots FOR UPDATE
		 *</code>
		 */
		public function forUpdate($sqlQuery){ }


		/**
		 * Returns a SQL modified with a LOCK IN SHARE MODE clause
		 *
		 *<code>
		 * $sql = $dialect->sharedLock("SELECT * FROM robots");
		 * echo $sql; // SELECT * FROM robots LOCK IN SHARE MODE
		 *</code>
		 */
		public function sharedLock($sqlQuery){ }


		/**
		 * Gets a list of columns with escaped identifiers
		 *
		 * <code>
		 * echo $dialect->getColumnList(
		 *     [
		 *         "column1",
		 *         "column",
		 *     ]
		 * );
		 * </code>
		 */
		final public function getColumnList($columnList, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve Column expressions
		 */
		final public function getSqlColumn($column, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Transforms an intermediate representation for an expression into a database system valid expression
		 */
		public function getSqlExpression($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Transform an intermediate representation of a schema/table into a database system valid expression
		 */
		final public function getSqlTable($table, $escapeChar=null){ }


		/**
		 * Builds a SELECT statement
		 */
		public function select($definition){ }


		/**
		 * Checks whether the platform supports savepoints
		 */
		public function supportsSavepoints(){ }


		/**
		 * Checks whether the platform supports releasing savepoints.
		 */
		public function supportsReleaseSavepoints(){ }


		/**
		 * Generate SQL to create a new savepoint
		 */
		public function createSavepoint($name){ }


		/**
		 * Generate SQL to release a savepoint
		 */
		public function releaseSavepoint($name){ }


		/**
		 * Generate SQL to rollback a savepoint
		 */
		public function rollbackSavepoint($name){ }


		/**
		 * Resolve Column expressions
		 */
		final protected function getSqlExpressionScalar($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve object expressions
		 */
		final protected function getSqlExpressionObject($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve qualified expressions
		 */
		final protected function getSqlExpressionQualified($expression, $escapeChar=null){ }


		/**
		 * Resolve binary operations expressions
		 */
		final protected function getSqlExpressionBinaryOperations($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve unary operations expressions
		 */
		final protected function getSqlExpressionUnaryOperations($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve function calls
		 */
		final protected function getSqlExpressionFunctionCall($expression, $escapeChar, $bindCounts=null){ }


		/**
		 * Resolve Lists
		 */
		final protected function getSqlExpressionList($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve *
		 */
		final protected function getSqlExpressionAll($expression, $escapeChar=null){ }


		/**
		 * Resolve CAST of values
		 */
		final protected function getSqlExpressionCastValue($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve CONVERT of values encodings
		 */
		final protected function getSqlExpressionConvertValue($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve CASE expressions
		 */
		final protected function getSqlExpressionCase($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve a FROM clause
		 */
		final protected function getSqlExpressionFrom($expression, $escapeChar=null){ }


		/**
		 * Resolve a JOINs clause
		 */
		final protected function getSqlExpressionJoins($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve a WHERE clause
		 */
		final protected function getSqlExpressionWhere($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve a GROUP BY clause
		 */
		final protected function getSqlExpressionGroupBy($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve a HAVING clause
		 */
		final protected function getSqlExpressionHaving($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve an ORDER BY clause
		 */
		final protected function getSqlExpressionOrderBy($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Resolve a LIMIT clause
		 */
		final protected function getSqlExpressionLimit($expression, $escapeChar=null, $bindCounts=null){ }


		/**
		 * Prepares column for this RDBMS
		 */
		protected function prepareColumnAlias($qualified, $alias=null, $escapeChar=null){ }


		/**
		 * Prepares table for this RDBMS
		 */
		protected function prepareTable($table, $schema=null, $alias=null, $escapeChar=null){ }


		/**
		 * Prepares qualified for this RDBMS
		 */
		protected function prepareQualified($column, $domain=null, $escapeChar=null){ }

	}
}
