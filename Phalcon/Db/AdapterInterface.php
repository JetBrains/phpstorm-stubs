<?php 

namespace Phalcon\Db {

	interface AdapterInterface {

		public function fetchOne($sqlQuery, $fetchMode=null, $placeholders=null);


		public function fetchAll($sqlQuery, $fetchMode=null, $placeholders=null);


		public function insert($table, $values, $fields=null, $dataTypes=null);


		public function update($table, $fields, $values, $whereCondition=null, $dataTypes=null);


		public function delete($table, $whereCondition=null, $placeholders=null, $dataTypes=null);


		public function getColumnList($columnList);


		public function limit($sqlQuery, $number);


		public function tableExists($tableName, $schemaName=null);


		public function viewExists($viewName, $schemaName=null);


		public function forUpdate($sqlQuery);


		public function sharedLock($sqlQuery);


		public function createTable($tableName, $schemaName, $definition);


		public function dropTable($tableName, $schemaName=null, $ifExists=null);


		public function createView($viewName, $definition, $schemaName=null);


		public function dropView($viewName, $schemaName=null, $ifExists=null);


		public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column);


		public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn=null);


		public function dropColumn($tableName, $schemaName, $columnName);


		public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index);


		public function dropIndex($tableName, $schemaName, $indexName);


		public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index);


		public function dropPrimaryKey($tableName, $schemaName);


		public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference);


		public function dropForeignKey($tableName, $schemaName, $referenceName);


		public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column);


		public function listTables($schemaName=null);


		public function listViews($schemaName=null);


		public function getDescriptor();


		public function getConnectionId();


		public function getSQLStatement();


		public function getRealSQLStatement();


		public function getSQLVariables();


		public function getSQLBindTypes();


		public function getType();


		public function getDialectType();


		public function getDialect();


		public function connect($descriptor=null);


		public function query($sqlStatement, $placeholders=null, $dataTypes=null);


		public function execute($sqlStatement, $placeholders=null, $dataTypes=null);


		public function affectedRows();


		public function close();


		public function escapeIdentifier($identifier);


		public function escapeString($str);


		public function lastInsertId($sequenceName=null);


		public function begin($nesting=null);


		public function rollback($nesting=null);


		public function commit($nesting=null);


		public function isUnderTransaction();


		public function getInternalHandler();


		public function describeIndexes($table, $schema=null);


		public function describeReferences($table, $schema=null);


		public function tableOptions($tableName, $schemaName=null);


		public function useExplicitIdValue();


		public function getDefaultIdValue();


		public function supportSequences();


		public function createSavepoint($name);


		public function releaseSavepoint($name);


		public function rollbackSavepoint($name);


		public function setNestedTransactionsWithSavepoints($nestedTransactionsWithSavepoints);


		public function isNestedTransactionsWithSavepoints();


		public function getNestedTransactionSavepointName();


		public function describeColumns($table, $schema=null);

	}
}
