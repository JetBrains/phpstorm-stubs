<?php
/**
 * PHPStorm stub file for Couchbase.
 *
 * @link http://docs.couchbase.com/sdk-api/couchbase-php-client-2.0.7/index.html
 * Maintiner: wayne530@gmail.com
 *
 * @link https://github.com/wayne530/phpstorm-couchbase-stub
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
class CouchbaseBucket
{
    /**
     * Constructs a bucket connection.
     *
     * @param string $connstr  A cluster connection string to connect with.
     * @param string $name     The name of the bucket to connect to.
     * @param string $password The password to authenticate with.
     */
    public function __construct($connstr, $name, $password) { }

    /**
     * Magic function to handle the retrieval of various properties.
     *
     * @param string $name property name; @see CouchbaseBucket
     */
    public function __get($name) { }

    /**
     * Magic function to handle the setting of various properties.
     *
     * @param string $name property name; @see CouchbaseBucket
     * @param mixed  $value
     */
    public function __set($name, $value) { }

    /**
     * Performs a N1QL query.
     *
     * @param CouchbaseN1qlQuery $queryObj N1QL query object
     *
     * @return mixed  results
     */
    public function _n1ql($queryObj) { }

    /**
     * Executes a view query.
     *
     * @param CouchbaseViewQuery $queryObj
     *
     * @return mixed  results
     */
    public function _view($queryObj) { }

    /**
     * Appends content to a document.
     *
     * @param string|array $ids     one or more ids
     * @param mixed        $val
     * @param array        $options cas
     *
     * @return mixed
     */
    public function append($ids, $val = null, $options = []) { }

    /**
     * Increment or decrements a key (based on $delta).
     *
     * @param string|array $ids     one or more ids
     * @param integer      $delta
     * @param array        $options initial, expiry
     *
     * @return mixed
     */
    public function counter($ids, $delta, $options = []) { }

    /**
     * Enables N1QL support on the client.  A cbq-server URI must be passed. This method will be deprecated in the
     * future in favor of automatic configuration through the connected cluster.
     *
     * @param string|array $hosts one or more hosts
     */
    public function enableN1ql($hosts) { }

    /**
     * Retrieves a document.
     *
     * @param string|array $ids     one or more ids
     * @param array        $options lock
     *
     * @return mixed
     */
    public function get($ids, $options = []) { }

    /**
     * Retrieves a document and locks it.
     *
     * @param string  $id
     * @param integer $lockTime
     * @param array   $options
     *
     * @return mixed
     */
    public function getAndLock($id, $lockTime, $options = []) { }

    /**
     * Retrieves a document and simultaneously updates its expiry.
     *
     * @param string  $id
     * @param integer $expiry
     * @param array   $options
     *
     * @return mixed
     */
    public function getAndTouch($id, $expiry, $options = []) { }

    /**
     * Retrieves a document from a replica.
     *
     * @param string $id
     * @param array  $options
     *
     * @return mixed
     */
    public function getFromReplica($id, $options = []) { }

    /**
     * Inserts a document.  This operation will fail if the document already exists on the cluster.
     *
     * @param string|array $ids     one or more ids
     * @param mixed        $val
     * @param array        $options expiry, flags
     *
     * @return mixed
     */
    public function insert($ids, $val = null, $options = []) { }

    /**
     * Returns an instance of a CouchbaseBucketManager for performing management operations against a bucket.
     *
     * @return CouchbaseBucketManager
     */
    public function manager() { }

    /**
     * Prepends content to a document.
     *
     * @param string|array $ids     one or more ids
     * @param mixed        $val
     * @param array        $options cas
     *
     * @return mixed
     */
    public function prepend($ids, $val = null, $options = []) { }

    /**
     * Performs a query (either ViewQuery or N1qlQuery).
     *
     * @param CouchbaseViewQuery|CouchbaseN1qlQuery $query
     *
     * @return mixed  results
     */
    public function query($query) { }

    /**
     * Deletes a document.
     *
     * @param string|array $ids     one or more ids
     * @param array        $options cas
     *
     * @return mixed
     */
    public function remove($ids, $options = []) { }

    /**
     * Replaces a document.
     *
     * @param string|array $ids     one or more ids
     * @param mixed        $val
     * @param array        $options cas, expiry, flags
     *
     * @return mixed
     */
    public function replace($ids, $val = null, $options = []) { }

    /**
     * Sets custom encoder and decoder functions for handling serialization.
     *
     * @param string $encoder The encoder function name
     * @param string $decoder The decoder function name
     */
    public function setTranscoder($encoder, $decoder) { }

    /**
     * Updates a documents expiry.
     *
     * @param string  $id
     * @param integer $expiry
     * @param array   $options
     *
     * @return mixed
     */
    public function touch($id, $expiry, $options = []) { }

    /**
     * Unlocks a key previous locked with a call to get().
     *
     * @param string|array $ids     one or more ids
     * @param array        $options cas
     *
     * @return mixed
     */
    public function unlock($ids, $options = []) { }

    /**
     * Inserts or updates a document, depending on whether the document already exists on the cluster.
     *
     * @param string|array $ids     one or more ids
     * @param mixed        $val
     * @param array        $options expiry, flags
     *
     * @return mixed
     */
    public function upsert($ids, $val = null, $options = []) { }
}

/**
 * Class CouchbaseBucketManager
 *
 * Class exposing the various available management operations that can be performed on a bucket.
 */
class CouchbaseBucketManager
{
    /**
     * @param        $binding
     * @param string $name
     */
    public function __construct($binding, $name) { }

    /**
     * Flushes this bucket (clears all data).
     */
    public function flush() { }

    /**
     * Retrieves a design documents from the bucket.
     *
     * @param string $name Name of the design document.
     *
     * @return mixed
     */
    public function getDesignDocument($name) { }

    /**
     * Returns all the design documents for this bucket.
     *
     * @return mixed
     */
    public function getDesignDocuments() { }

    /**
     * Retrieves bucket status information
     *
     * Returns an associative array of status information as seen by the cluster for this bucket.  The exact structure
     * of the returned data can be seen in the Couchbase Manual by looking at the bucket /info endpoint.
     *
     * @return mixed  The status information.
     */
    public function info() { }

    /**
     * Inserts a design document to this bucket.  Failing if a design document with the same name already exists.
     *
     * @param string $name Name of the design document.
     * @param mixed  $data The design document data.
     *
     * @returns bool
     */
    public function insertDesignDocument($name, $data) { }

    /**
     * Deletes a design document from the bucket.
     *
     * @param string $name Name of the design document.
     *
     * @return mixed
     */
    public function removeDesignDocument($name) { }

    /**
     * Inserts a design document to this bucket.  Overwriting any existing design document with the same name.
     *
     * @param string $name Name of the design document.
     * @param mixed  $data The design document data.
     *
     * @returns bool
     */
    public function upsertDesignDocument($name, $data) { }
}

/**
 * Class CouchbaseCluster
 *
 * Represents a cluster connection.
 */
class CouchbaseCluster
{
    /**
     * @param string $dsn      A cluster DSn to connect with.
     * @param string $username The username for the cluster.
     * @param string $password The password for the cluster.
     */
    public function __construct($dsn = 'http://127.0.0.1/', $username = '', $password = '') { }

    /**
     * Creates a manager allowing the management of a Couchbase cluster.
     *
     * @param string $username The administration username.
     * @param string $password The administration password.
     *
     * @return  CouchbaseClusterManager
     */
    public function manager($username, $password) { }

    /**
     * Constructs a connection to a bucket.
     *
     * @param string $name     The name of the bucket to open.
     * @param string $password The bucket password to authenticate with.
     *
     * @return CouchbaseBucket
     */
    public function openBucket($name = 'default', $password = '') { }
}

/**
 * Class CouchbaseClusterManager
 *
 * Class exposing the various available management operations that can be performed on a cluster.
 */
class CouchbaseClusterManager
{
    /**
     * Constructs a cluster manager connection.
     *
     * @param string $connstr  A connection string to connect with.
     * @param string $username The username to authenticate with.
     * @param string $password The password to authenticate with.
     */
    public function __construct($connstr, $username, $password) { }

    /**
     * Creates a new bucket on this cluster.
     *
     * @param string $name The bucket name.
     * @param array  $opts The options for this bucket.
     *
     * @return mixed
     */
    public function createBucket($name, $opts = []) { }

    /**
     * Retrieves cluster status information
     *
     * Returns an associative array of status information as seen on the cluster.  The exact structure of the returned
     * data can be seen in the Couchbase Manual by looking at the cluster /info endpoint.
     *
     * @return mixed  The status information.
     */
    public function info() { }

    /**
     * Lists all buckets on this cluster.
     *
     * @return mixed
     */
    public function listBuckets() { }

    /**
     * Deletes a bucket from the cluster.
     *
     * @param string $name The bucket name.
     *
     * @return mixed
     */
    public function removeBucket($name) { }
}

class CouchbaseException extends Exception
{
}

/**
 * Class CouchbaseN1qlQuery
 *
 * Represents a N1QL query to be executed against a Couchbase bucket.
 */
class CouchbaseN1qlQuery
{
    const NOT_BOUNDED = 1;
    const REQUEST_PLUS = 2;
    const STATEMENT_PLUS = 3;
    /** @var array */
    public $options = [];

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
     * @param int $consistency consistency level; use constants NOT_BOUNDED, REQUEST_PLUS, STATEMENT_PLUS
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
class CouchbaseViewQuery
{
    const ORDER_ASCENDING = 1;
    const ORDER_DESCENDING = 2;
    const UPDATE_AFTER = 3;
    const UPDATE_BEFORE = 1;
    const UPDATE_NONE = 2;
    /** @var string */
    public $ddoc = '';
    /** @var string */
    public $name = '';
    /** @var array */
    public $options = [];

    /**
     * private constructor
     */
    private function __construct() { }

    /**
     * Creates a new Couchbase ViewQuery instance for performing a view query.
     *
     * @param string $ddoc The name of the design document to query.
     * @param string $name The name of the view to query.
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public static function from($ddoc, $name) { }

    /**
     * Creates a new Couchbase ViewQuery instance for performing a spatial query.
     *
     * @param string $ddoc The name of the design document to query.
     * @param string $name The name of the view to query.
     *
     * @return _CouchbaseSpatialViewQuery
     */
    public static function fromSpatial($ddoc, $name) { }

    /**
     * Specifies custom options to pass to the server.  Note that these options are expected to be already encoded.
     *
     * @param array $opts key-value pairs of custom options to pass to the server
     *
     * @return CouchbaseViewQuery
     */
    public function custom(array $opts) { }

    /**
     * Limits the result set to a restricted number of results.
     *
     * @param int $limit max number of records in returned result set
     *
     * @return CouchbaseViewQuery
     */
    public function limit($limit) { }

    /**
     * Skips a number of records from the beginning of the result set.
     *
     * @param int $skip number of records to skip
     *
     * @return CouchbaseViewQuery
     */
    public function skip($skip) { }

    /**
     * Specifies the mode of updating to perform before and after executing this query.
     *
     * @param int $stale use constants UPDATE_BEFORE, UPDATE_NONE, UPDATE_AFTER
     *
     * @return CouchbaseViewQuery
     */
    public function stale($stale) { }
}

/**
 * Class _CouchbaseDefaultViewQuery
 *
 * Represents a regular view query to perform against the server. Note that this object should never be instantiated
 * directly, but instead through the CouchbaseViewQuery::from method.
 */
class _CouchbaseDefaultViewQuery extends CouchbaseViewQuery
{
    /**
     * public constructor
     */
    public function __construct() { }

    /**
     * Specifies the level of grouping to use on the results.
     *
     * @param int|bool $group enable/disable grouping or specify level of grouping
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function group($group) { }

    /**
     * Specifies the level at which to perform view grouping.
     *
     * @param int $group_level specify level of grouping
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function group_level($group_level) { }

    /**
     * Specifies a range of document ids to return from the index.
     *
     * @param mixed|null $start start of range document id
     * @param mixed|null $end   end of range document id
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function id_range($start = null, $end = null) { }

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
     * Orders the results by key as specified.
     *
     * @param int $order use constants ORDER_ASCENDING, ORDER_DESCENDING
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function order($order) { }

    /**
     * Specifies a range of keys to return from the index.
     *
     * @param mixed|null $start         start key
     * @param mixed|null $end           end key
     * @param bool       $inclusive_end whether to include the end key
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function range($start = null, $end = null, $inclusive_end = false) { }

    /**
     * Specifies a reduction function to apply to the index.
     *
     * @param bool $reduce
     *
     * @return _CouchbaseDefaultViewQuery
     */
    public function reduce($reduce) { }

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
class _CouchbaseSpatialViewQuery extends CouchbaseViewQuery
{
    /**
     * public constructor
     */
    public function __construct() { }

    /**
     * Specifies the bounding box to search within.
     *
     * @param array $bbox bounding box coordinates expressed as a list of numeric values
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
