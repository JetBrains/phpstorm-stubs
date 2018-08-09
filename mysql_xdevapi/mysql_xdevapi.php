<?php
/**
 * Start of mysql_xdevapi extension stubs v.0.1
 * @link http://php.net/manual/en/book.mysql-xdevapi.php
 * @package mysql_xdevapi
 */
namespace mysql_xdevapi;

/**
 * @link http://php.net/manual/en/function.mysql-xdevapi-getsession.php
 * @param string $uri The URI to the MySQL server, such as mysqlx://user:password@host.
 * @return \mysql_xdevapi\Session
 */
function getSession($uri) {}


/**
 * Class Collection
 * @package mysql_xdevapi
 */
class Collection  {

    /**
     * Adds a document to the collection
     * @link http://php.net/manual/en/mysql-xdevapi-collection.add.php
     * @param mixed $document
     * @return \mysql_xdevapi\CollectionAdd
     */
    public function add($document) {}
}

/**
 * Class Session
 * @package mysql_xdevapi
 */
class Session {
    /**
     * Get the schema
     * @link http://php.net/manual/en/mysql-xdevapi-session.getschema.php
     * @param string $schema_name name of the schema
     * @return \mysql_xdevapi\Schema
     */
    public function getSchema($schema_name) {}

    /**
     * Creates a the schema
     * @link http://php.net/manual/en/mysql-xdevapi-session.createschema.php
     * @param string $schema_name name of the schema
     * @return \mysql_xdevapi\Schema
     * @throws \mysql_xdevapi\Exception
     */
    public function createSchema($schema_name) {}

}

/**
 * Class Schema
 * @package mysql_xdevapi
 */
class Schema {
    /**
     * Get collection from schema
     * @link http://php.net/manual/en/mysql-xdevapi-schema.getcollection.php
     * @param string $name name of the collection
     * @return \mysql_xdevapi\Collection
     */
    public function getCollection($name) {}
}

/**
 * Class Exception
 * @package mysql_xdevapi
 */
class Exception extends \RuntimeException implements \Throwable {

}

/**
 * Class Result
 * @package mysql_xdevapi
 */
class Result {

}

/**
 * Class CollectionAdd
 * @link http://php.net/manual/en/class.mysql-xdevapi-collectionadd.php
 * @package mysql_xdevapi
 */
class CollectionAdd {

    /**
     * Execute the statement
     * @link http://php.net/manual/en/mysql-xdevapi-collectionadd.execute.php
     * @return \mysql_xdevapi\Result
     */
    public function execute() {}
}