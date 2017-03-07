<?php
define("COUCHBASE_SUCCESS", 0x00);
define("COUCHBASE_AUTH_CONTINUE", 0x01);
define("COUCHBASE_AUTH_ERROR", 0x02);
define("COUCHBASE_DELTA_BADVAL", 0x03);
define("COUCHBASE_E2BIG", 0x04);
define("COUCHBASE_EBUSY", 0x05);
define("COUCHBASE_EINTERNAL", 0x06);
define("COUCHBASE_EINVAL", 0x07);
define("COUCHBASE_ENOMEM", 0x08);
define("COUCHBASE_ERANGE", 0x09);
define("COUCHBASE_ERROR", 0x0a);
define("COUCHBASE_ETMPFAIL", 0x0b);
define("COUCHBASE_KEY_EEXISTS", 0x0c);
define("COUCHBASE_KEY_ENOENT", 0x0d);
define("COUCHBASE_DLOPEN_FAILED", 0x0e);
define("COUCHBASE_DLSYM_FAILED", 0x0f);
define("COUCHBASE_NETWORK_ERROR", 0x10);
define("COUCHBASE_NOT_MY_VBUCKET", 0x11);
define("COUCHBASE_NOT_STORED", 0x12);
define("COUCHBASE_NOT_SUPPORTED", 0x13);
define("COUCHBASE_UNKNOWN_COMMAND", 0x14);
define("COUCHBASE_UNKNOWN_HOST", 0x15);
define("COUCHBASE_PROTOCOL_ERROR", 0x16);
define("COUCHBASE_ETIMEDOUT", 0x17);
define("COUCHBASE_CONNECT_ERROR", 0x18);
define("COUCHBASE_BUCKET_ENOENT", 0x19);
define("COUCHBASE_CLIENT_ENOMEM", 0x1a);
define("COUCHBASE_CLIENT_ETMPFAIL", 0x1b);
define("COUCHBASE_EBADHANDLE", 0x1c);
define("COUCHBASE_SERVER_BUG", 0x1d);
define("COUCHBASE_PLUGIN_VERSION_MISMATCH", 0x1e);
define("COUCHBASE_INVALID_HOST_FORMAT", 0x1f);
define("COUCHBASE_INVALID_CHAR", 0x20);
define("COUCHBASE_DURABILITY_ETOOMANY", 0x21);
define("COUCHBASE_DUPLICATE_COMMANDS", 0x22);
define("COUCHBASE_NO_MATCHING_SERVER", 0x23);
define("COUCHBASE_BAD_ENVIRONMENT", 0x24);

define("COUCHBASE_VALUE_F_JSON", 0x01);

/**
 * Couchbase extension stubs
 * Gathered from http://docs.couchbase.com/sdk-api/couchbase-php-client-2.0.7/index.html
 * Maintiner: wayne530@gmail.com
 *
 * https://github.com/wayne530/phpstorm-couchbase-stub
 */

/**
 * Class CouchbaseBucket
 *
 * Represents a bucket connection.
 *
 * Supported properties:
 *   - operationTimeout
 *   - viewTimeout
 *   - durabilityInterval
 *   - durabilityTimeout
 *   - httpTimeout
 *   - configTimeout
 *   - configDelay
 *   - configNodeTimeout
 *   - htconfigIdleTimeout
 */
class CouchbaseBucket {

    /**
     * Constructs a bucket connection.
     *
     * @param string $connstr  A cluster connection string to connect with.
     * @param string $name  The name of the bucket to connect to.
     * @param string $password  The password to authenticate with.
     */
    public function __construct($connstr, $name, $password) { }

    /**
     * Returns an instance of a CouchbaseBucketManager for performing management operations against a bucket.
     *
     * @return CouchbaseBucketManager
     */
    public function manager() { }

    /**
     * Enables N1QL support on the client.  A cbq-server URI must be passed. This method will be deprecated in the
     * future in favor of automatic configuration through the connected cluster.
     *
     * @param string|array $hosts  one or more hosts
     */
    public function enableN1ql($hosts) { }

    /**
     * Inserts a document.  This operation will fail if the document already exists on the cluster.
     *
     * @param string|array $ids  one or more ids
     * @param mixed $val
     * @param array $options  expiry, flags
     *
     * @return mixed
     */
    public function insert($ids, $val = null, $options = array()) { }

    /**
     * Inserts or updates a document, depending on whether the document already exists on the cluster.
     *
     * @param string|array $ids  one or more ids
     * @param mixed $val
     * @param array $options  expiry, flags
     *
     * @return mixed
     */
    public function upsert($ids, $val = null, $options = array()) { }

    /**
     * Replaces a document.
     *
     * @param string|array $ids  one or more ids
     * @param mixed $val
     * @param array $options  cas, expiry, flags
     *
     * @return mixed
     */
    public function replace($ids, $val = null, $options = array()) { }

    /**
     * Appends content to a document.
     *
     * @param string|array $ids  one or more ids
     * @param mixed $val
     * @param array $options  cas
     *
     * @return mixed
     */
    public function append($ids, $val = null, $options = array()) { }

    /**
     * Prepends content to a document.
     *
     * @param string|array $ids  one or more ids
     * @param mixed $val
     * @param array $options  cas
     *
     * @return mixed
     */
    public function prepend($ids, $val = null, $options = array()) { }

    /**
     * Deletes a document.
     *
     * @param string|array $ids  one or more ids
     * @param array $options  cas
     *
     * @return mixed
     */
    public function remove($ids, $options = array()) { }

    /**
     * Retrieves a document.
     *
     * @param string|array $ids  one or more ids
     * @param array $options  lock
     *
     * @return mixed
     */
    public function get($ids, $options = array()) { }

    /**
     * Retrieves a document and simultaneously updates its expiry.
     *
     * @param string $id
     * @param integer $expiry
     * @param array $options
     *
     * @return mixed
     */
    public function getAndTouch($id, $expiry, $options = array()) { }

    /**
     * Retrieves a document and locks it.
     *
     * @param string $id
     * @param integer $lockTime
     * @param array $options
     *
     * @return mixed
     */
    public function getAndLock($id, $lockTime, $options = array()) { }

    /**
     * Retrieves a document from a replica.
     *
     * @param string $id
     * @param array $options
     *
     * @return mixed
     */
    public function getFromReplica($id, $options = array()) { }

    /**
     * Updates a documents expiry.
     *
     * @param string $id
     * @param integer $expiry
     * @param array $options
     *
     * @return mixed
     */
    public function touch($id, $expiry, $options = array()) { }

    /**
     * Increment or decrements a key (based on $delta).
     *
     * @param string|array $ids  one or more ids
     * @param integer $delta
     * @param array $options  initial, expiry
     *
     * @return mixed
     */
    public function counter($ids, $delta, $options = array()) { }

    /**
     * Unlocks a key previous locked with a call to get().
     *
     * @param string|array $ids  one or more ids
     * @param array $options  cas
     *
     * @return mixed
     */
    public function unlock($ids, $options = array()) { }

    /**
     * Executes a view query.
     *
     * @param CouchbaseViewQuery $queryObj
     *
     * @return mixed  results
     */
    public function _view($queryObj) { }

    /**
     * Performs a N1QL query.
     *
     * @param CouchbaseN1qlQuery $queryObj  N1QL query object
     *
     * @return mixed  results
     */
    public function _n1ql($queryObj) { }

    /**
     * Performs a query (either ViewQuery or N1qlQuery).
     *
     * @param CouchbaseViewQuery|CouchbaseN1qlQuery $query
     *
     * @return mixed  results
     */
    public function query($query) { }

    /**
     * Sets custom encoder and decoder functions for handling serialization.
     *
     * @param string $encoder  The encoder function name
     * @param string $decoder  The decoder function name
     */
    public function setTranscoder($encoder, $decoder) { }

    /**
     * Magic function to handle the retrieval of various properties.
     *
     * @param string $name  property name; @see CouchbaseBucket
     */
    public function __get($name) { }

    /**
     * Magic function to handle the setting of various properties.
     *
     * @param string $name  property name; @see CouchbaseBucket
     * @param mixed $value
     */
    public function __set($name, $value) { }

}

/**
 * Class CouchbaseBucketManager
 *
 * Class exposing the various available management operations that can be performed on a bucket.
 */
class CouchbaseBucketManager {

    /**
     * @param $binding
     * @param string $name
     */
    public function __construct($binding, $name) { }

    /**
     * Returns all the design documents for this bucket.
     *
     * @return mixed
     */
    public function getDesignDocuments() { }

    /**
     * Inserts a design document to this bucket.  Failing if a design document with the same name already exists.
     *
     * @param string $name  Name of the design document.
     * @param mixed $data  The design document data.
     *
     * @returns bool
     */
    public function insertDesignDocument($name, $data) { }

    /**
     * Inserts a design document to this bucket.  Overwriting any existing design document with the same name.
     *
     * @param string $name  Name of the design document.
     * @param mixed $data  The design document data.
     *
     * @returns bool
     */
    public function upsertDesignDocument($name, $data) { }

    /**
     * Retrieves a design documents from the bucket.
     *
     * @param string $name  Name of the design document.
     *
     * @return mixed
     */
    public function getDesignDocument($name) { }

    /**
     * Deletes a design document from the bucket.
     *
     * @param string $name  Name of the design document.
     *
     * @return mixed
     */
    public function removeDesignDocument($name) { }

    /**
     * Flushes this bucket (clears all data).
     */
    public function flush() { }

    /**
     * Retrieves bucket status information
     *
     * Returns an associative array of status information as seen by the cluster for this bucket.  The exact structure
     * of the returned data can be seen in the Couchbase Manual by looking at the bucket /info endpoint.
     *
     * @return mixed  The status information.
     */
    public function info() { }

}

/**
 * Class CouchbaseCluster
 *
 * Represents a cluster connection.
 */
class CouchbaseCluster {

    /**
     * @param string $dsn  A cluster DSn to connect with.
     * @param string $username  The username for the cluster.
     * @param string $password  The password for the cluster.
     */
    public function __construct($dsn = 'http://127.0.0.1/', $username = '', $password = '') { }

    /**
     * Constructs a connection to a bucket.
     *
     * @param string $name  The name of the bucket to open.
     * @param string $password  The bucket password to authenticate with.
     *
     * @return CouchbaseBucket
     */
    public function openBucket($name = 'default', $password = '') { }

    /**
     * Creates a manager allowing the management of a Couchbase cluster.
     *
     * @param string $username  The administration username.
     * @param string $password  The administration password.
     *
     * @return  CouchbaseClusterManager
     */
    public function manager($username, $password) { }

}

/**
 * Class CouchbaseClusterManager
 *
 * Class exposing the various available management operations that can be performed on a cluster.
 */
class CouchbaseClusterManager {

    /**
     * Constructs a cluster manager connection.
     *
     * @param string $connstr  A connection string to connect with.
     * @param string $username  The username to authenticate with.
     * @param string $password  The password to authenticate with.
     */
    public function __construct($connstr, $username, $password) { }

    /**
     * Lists all buckets on this cluster.
     *
     * @return mixed
     */
    public function listBuckets() { }

    /**
     * Creates a new bucket on this cluster.
     *
     * @param string $name  The bucket name.
     * @param array $opts  The options for this bucket.
     *
     * @return mixed
     */
    public function createBucket($name, $opts = array()) { }

    /**
     * Deletes a bucket from the cluster.
     *
     * @param string $name  The bucket name.
     *
     * @return mixed
     */
    public function removeBucket($name) { }

    /**
     * Retrieves cluster status information
     *
     * Returns an associative array of status information as seen on the cluster.  The exact structure of the returned
     * data can be seen in the Couchbase Manual by looking at the cluster /info endpoint.
     *
     * @return mixed  The status information.
     */
    public function info() { }

}

/**
 * Class CouchbaseN1qlQuery
 *
 * Represents a N1QL query to be executed against a Couchbase bucket.
 */
class CouchbaseN1qlQuery {

    /** @var array */
    public $options = array();

    const NOT_BOUNDED = 1;
    const REQUEST_PLUS = 2;
    const STATEMENT_PLUS = 3;

    /**
     * Creates a new N1qlQuery instance directly from a N1QL DML.
     *
     * @param string $str
     *
     * @return CouchbaseN1qlQuery
     */
    public static function fromString($str) { }

    /**
     * Specify the consistency level for this query.
     *
     * @param int $consistency  consistency level; use constants NOT_BOUNDED, REQUEST_PLUS, STATEMENT_PLUS
     *
     * @return CouchbaseN1qlQuery
     */
    public function consistency($consistency) { }

    /**
     * Generates the N1QL object as it will be passed to the server.
     *
     * @return object
     */
    public function toObject() { }

    /**
     * Returns the string representation of this N1ql query (the statement).
     *
     * @return string
     */
    public function toString() { }

}

/**
 * Class CouchbaseViewQuery
 *
 * Represents a view query to be executed against a Couchbase bucket.
 */
class CouchbaseViewQuery {

    /** @var string */
    public $ddoc = '';

    /** @var string */
    public $name = '';

    /** @var array */
    public $options = array();

    const UPDATE_BEFORE = 1;
    const UPDATE_NONE = 2;
    const UPDATE_AFTER = 3;

    const ORDER_ASCENDING = 1;
    const ORDER_DESCENDING = 2;

    /**
     * private constructor
     */
    private function __construct() { }

    /**
     * Creates a new Couchbase ViewQuery instance for performing a view query.
     *
     * @param string $ddoc  The name of the design document to query.
     * @param string $name  The name of the view to query.
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public static function from($ddoc, $name) { }

    /**
     * Creates a new Couchbase ViewQuery instance for performing a spatial query.
     *
     * @param string $ddoc  The name of the design document to query.
     * @param string $name  The name of the view to query.
     *
     * @return _CouchbaseSpatialViewQuery
     */
    public static function fromSpatial($ddoc, $name) { }

    /**
     * Specifies the mode of updating to perform before and after executing this query.
     *
     * @param int $stale  use constants UPDATE_BEFORE, UPDATE_NONE, UPDATE_AFTER
     *
     * @return CouchbaseViewQuery
     */
    public function stale($stale) { }

    /**
     * Skips a number of records from the beginning of the result set.
     *
     * @param int $skip  number of records to skip
     *
     * @return CouchbaseViewQuery
     */
    public function skip($skip) { }

    /**
     * Limits the result set to a restricted number of results.
     *
     * @param int $limit  max number of records in returned result set
     *
     * @return CouchbaseViewQuery
     */
    public function limit($limit) { }

    /**
     * Specifies custom options to pass to the server.  Note that these options are expected to be already encoded.
     *
     * @param array $opts  key-value pairs of custom options to pass to the server
     *
     * @return CouchbaseViewQuery
     */
    public function custom(array $opts) { }

}

/**
 * Class _CouchbaseDefaultViewQuery
 *
 * Represents a regular view query to perform against the server. Note that this object should never be instantiated
 * directly, but instead through the CouchbaseViewQuery::from method.
 */
class _CouchbaseDefaultViewQuery extends CouchbaseViewQuery {

    /**
     * public constructor
     */
    public function __construct() { }

    /**
     * Orders the results by key as specified.
     *
     * @param int $order  use constants ORDER_ASCENDING, ORDER_DESCENDING
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function order($order) { }

    /**
     * Specifies a reduction function to apply to the index.
     *
     * @param bool $reduce
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function reduce($reduce) { }

    /**
     * Specifies the level of grouping to use on the results.
     *
     * @param int|bool $group  enable/disable grouping or specify level of grouping
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function group($group) { }

    /**
     * Specifies the level at which to perform view grouping.
     *
     * @param int $group_level  specify level of grouping
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function group_level($group_level) { }

    /**
     * Specifies a specific key to return from the index.
     *
     * @param mixed $key
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function key($key) { }

    /**
     * Specifies a list of keys to return from the index.
     *
     * @param array $keys
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function keys(array $keys) { }

    /**
     * Specifies a range of keys to return from the index.
     *
     * @param mixed|null $start  start key
     * @param mixed|null $end  end key
     * @param bool $inclusive_end  whether to include the end key
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function range($start = null, $end = null, $inclusive_end = false) { }

    /**
     * Specifies a range of document ids to return from the index.
     *
     * @param mixed|null $start  start of range document id
     * @param mixed|null $end  end of range document id
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function id_range($start = null, $end = null) { }

    /**
     * Generates the view query as it will be passed to the server.
     *
     * @return string
     */
    public function toString() { }

}

/**
 * Class _CouchbaseSpatialViewQuery
 *
 * Represents a spatial view query to perform against the server.  Note that this object should never be instantiated
 * directly, but instead through the CouchbaseViewQuery::fromSpatial method.
 */
class _CouchbaseSpatialViewQuery extends CouchbaseViewQuery {

    /**
     * public constructor
     */
    public function __construct() { }

    /**
     * Specifies the bounding box to search within.
     *
     * @param array $bbox  bounding box coordinates expressed as a list of numeric values
     *
     * @return _CouchbaseSpatialViewQuery
     */
    public function bbox($bbox) { }

    /**
     * Generates the view query as it will be passed to the server.
     *
     * @return string
     */
    public function toString() { }

}

class CouchbaseException extends Exception { }
