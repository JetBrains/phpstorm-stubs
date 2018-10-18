<?php
/**
 * Start of mysql_xdevapi extension stubs
 * @link https://secure.php.net/manual/en/book.mysql-xdevapi.php
 * @version 0.2 2018-08-09
 * @author Jorge Castro C jcastro@eftec.cl
 * @todo It only adds the basic features.  It misses the rest of features.
 * @package mysql_xdevapi
 */
namespace mysql_xdevapi;

define('MYSQLX_LOCK_DEFAULT','');
define('MYSQLX_LOCK_NOWAIT',1);
define('MYSQLX_LOCK_SKIP_LOCKED',2);


/**
 * @link https://secure.php.net/manual/en/function.mysql-xdevapi-getsession.php
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
     * @link https://secure.php.net/manual/en/mysql-xdevapi-collection.add.php
     * @param mixed $document
     * @return \mysql_xdevapi\CollectionAdd
     */
    public function add($document) {}

    /**
     * Add or replace collection document
     * @link https://secure.php.net/manual/en/mysql-xdevapi-collection.addorreplaceone.php
     * @param string $id
     * @param mixed $document
     * @return \mysql_xdevapi\Result
     */
    public function addOrReplaceOne($id,$document) {}

    /**
     * @link https://secure.php.net/manual/en/mysql-xdevapi-collection.find.php
     * @param string $search_condition
     * @return \mysql_xdevapi\CollectionFind
     */
    public function find($search_condition) {}

    /**
     * Get one document
     * This is a shortcut for Collection.find("_id = :id").bind("id", id).execute().fetchOne();.
     * @param $id
     * @return mixed Null if object is not found
     */
    public function getOne($id) {

    }
}

/**
 * Class Session
 * @package mysql_xdevapi
 */
class Session {
    /**
     * Get the schema
     * @link https://secure.php.net/manual/en/mysql-xdevapi-session.getschema.php
     * @param string $schema_name name of the schema
     * @return \mysql_xdevapi\Schema
     */
    public function getSchema($schema_name) {}

    /**
     * Creates a the schema
     * @link https://secure.php.net/manual/en/mysql-xdevapi-session.createschema.php
     * @param string $schema_name name of the schema
     * @return \mysql_xdevapi\Schema
     * @throws \mysql_xdevapi\Exception
     */
    public function createSchema($schema_name) {}

    /**
     * Close session
     * @return bool
     */
    public function close() {

    }

}

/**
 * Interface Executable
 * @package mysql_xdevapi
 */
interface Executable {

}

/**
 * Interface CrudOperationBindable
 * @package mysql_xdevapi
 */
interface CrudOperationBindable {

}

/**
 * Interface CrudOperationLimitable
 * @package mysql_xdevapi
 */
interface CrudOperationLimitable {

}

/**
 * Interface CrudOperationSortable
 * @package mysql_xdevapi
 */
interface CrudOperationSortable {

}

/**
 * Class CollectionFind
 * @https://secure.php.net/manual/en/class.mysql-xdevapi-collectionfind.php
 * @package mysql_xdevapi
 */
class CollectionFind  implements \mysql_xdevapi\Executable
    , \mysql_xdevapi\CrudOperationBindable
    , \mysql_xdevapi\CrudOperationLimitable
    , \mysql_xdevapi\CrudOperationSortable
{
    /**
     * Execute the statement
     * @link https://secure.php.net/manual/en/mysql-xdevapi-collectionfind.execute.php
     * @return \mysql_xdevapi\DocResult
     */
    public function execute() {}

    /**
     * Execute operation with EXCLUSIVE LOCK
     * @link https://secure.php.net/manual/en/mysql-xdevapi-collectionfind.lockexclusive.php
     * @param mixed $lock_waiting_option MYSQLX_LOCK_*
     * @return \mysql_xdevapi\CollectionFind
     */
    public function lockExclusive($lock_waiting_option = null) {}

    /**
     * Execute operation with SHARED LOCK
     * @link https://secure.php.net/manual/en/mysql-xdevapi-collectionfind.lockshared.php
     * @param mixed $lock_waiting_option MYSQLX_LOCK_*
     * @return \mysql_xdevapi\CollectionFind
     */
    public function lockShared($lock_waiting_option = null) {}
}
/**
 * Class Schema
 * @package mysql_xdevapi
 */
class Schema {
    /**
     * Get collection from schema
     * @link https://secure.php.net/manual/en/mysql-xdevapi-schema.getcollection.php
     * @param string $name name of the collection
     * @return \mysql_xdevapi\Collection
     */
    public function getCollection($name) {}

    /**
     * Add collection to schema
     * @link https://secure.php.net/manual/en/mysql-xdevapi-schema.createcollection.php
     * @param $name
     * @return \mysql_xdevapi\Collection
     */
    public function createCollection($name) {}
}

/**
 * Class Exception
 * @package mysql_xdevapi
 */
class Exception extends \RuntimeException implements \Throwable {

}

/**
 * interface BaseResult
 * @link https://secure.php.net/manual/en/class.mysql-xdevapi-baseresult.php
 * @package mysql_xdevapi
 */
interface BaseResult {

}

/**
 * Class DocResult
 * @package mysql_xdevapi
 */
class DocResult implements \mysql_xdevapi\BaseResult , \Traversable {

    /**
     * Get one row
     * @link https://secure.php.net/manual/en/mysql-xdevapi-docresult.fetchone.php
     * @return object
     */
    public function fetchOne() {}

    /**
     * Get all rows
     * @link https://secure.php.net/manual/en/mysql-xdevapi-docresult.fetchall.php
     * @return array
     */
    public function fetchAll() {}
}

/**
 * Class Result
 * @https://secure.php.net/manual/en/class.mysql-xdevapi-result.php
 * @package mysql_xdevapi
 */
class Result implements \mysql_xdevapi\BaseResult , \Traversable   {

    /**
     * Get generated ids. The id is the type of "00005b650a8b000000000000000e"
     * @link https://secure.php.net/manual/en/mysql-xdevapi-result.getgeneratedids.php
     * @return string[]
     */
    public function getGeneratedIds() {}

    /**
     * Get affected row count
     * @link https://secure.php.net/manual/en/mysql-xdevapi-sqlstatementresult.getaffecteditemscount.php
     * @return integer
     */
    public function getAffectedItemsCount() {}

}

/**
 * Class CollectionAdd
 * @link https://secure.php.net/manual/en/class.mysql-xdevapi-collectionadd.php
 * @package mysql_xdevapi
 */
class CollectionAdd {

    /**
     * Execute the statement
     * @link https://secure.php.net/manual/en/mysql-xdevapi-collectionadd.execute.php
     * @return \mysql_xdevapi\Result
     */
    public function execute() {}
}