<?php
/**
 * MongoDB Extension Stub File
 * @version 1.1.9
 * Documentation taken from http://php.net/manual/en/set.mongodb.php
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

/**
 * Unlike the mongo extension, this extension supports both PHP and HHVM and is developed atop the » libmongoc and » libbson libraries. It provides a minimal API for core driver functionality: commands, queries, writes, connection management, and BSON serialization.
 * Userland PHP libraries that depend on this extension may provide higher level APIs, such as query builders, individual command helper methods, and GridFS. Application developers should consider using this extension in conjunction with the » MongoDB PHP library, which implements the same higher level APIs found in MongoDB drivers for other languages. This separation of concerns allows the driver to focus on essential features for which an extension implementation is paramount for performance.
 * @link http://php.net/manual/en/set.mongodb.php
 */
namespace MongoDB {}

    namespace MongoDB\Driver {

        use MongoDB\BSON\Serializable;
        use MongoDB\Driver\Exception\AuthenticationException;
        use MongoDB\Driver\Exception\BulkWriteException;
        use MongoDB\Driver\Exception\ConnectionException;
        use MongoDB\Driver\Exception\Exception;
        use MongoDB\Driver\Exception\InvalidArgumentException;
        use MongoDB\Driver\Exception\RuntimeException;
        use MongoDB\Driver\Exception\WriteConcernException;
        use MongoDB\Driver\Exception\WriteException;

        /**
         * The MongoDB\Driver\Manager is the main entry point to the extension. It is responsible for maintaining connections to MongoDB (be it standalone server, replica set, or sharded cluster).
         * No connection to MongoDB is made upon instantiating the Manager. This means the MongoDB\Driver\Manager can always be constructed, even though one or more MongoDB servers are down.
         * Any write or query can throw connection exceptions as connections are created lazily. A MongoDB server may also become unavailable during the life time of the script. It is therefore important that all actions on the Manager to be wrapped in try/catch statements.
         * @link http://php.net/manual/en/class.mongodb-driver-manager.php
         */
        final class Manager
        {
            /**
             * Manager constructor.
             * @link http://php.net/manual/en/mongodb-driver-manager.construct.php
             * @param string $uri A mongodb:// connection URI
             * @param array $options Connection string options
             * @param array $driverOptions Any driver-specific options not included in MongoDB connection spec.
             * @throws InvalidArgumentException on argument parsing errors
             * @throws RuntimeException if the uri format is invalid
             */
            final public function __construct($uri, array $options = [], array $driverOptions = [])
            {
            }

            /**
             * Execute one or more write operations
             * @link http://php.net/manual/en/mongodb-driver-manager.executebulkwrite.php
             * @param string $namespace A fully qualified namespace (databaseName.collectionName)
             * @param BulkWrite $bulk The MongoDB\Driver\BulkWrite to execute.
             * @param WriteConcern $writeConcern Optionally, a MongoDB\Driver\WriteConcern. If none given, default to the Write Concern set by the MongoDB Connection URI.
             * @return WriteResult
             */
            final public function executeBulkWrite($namespace, BulkWrite $bulk, WriteConcern $writeConcern = null)
            {
            }

            /**
             * @link http://php.net/manual/en/mongodb-driver-manager.executecommand.php
             * @param string $db The name of the database on which to execute the command.
             * @param Command $command The command document.
             * @param ReadPreference $readPreference Optionally, a MongoDB\Driver\ReadPreference to route the command to. If none given, defaults to the Read Preferences set by the MongoDB Connection URI.
             * @return Cursor
             * @throws Exception
             * @throws AuthenticationException if authentication is needed and fails
             * @throws ConnectionException if connection to the server fails for other then authentication reasons
             * @throws RuntimeException on other errors (invalid command, command arguments, ...)
             * @throws WriteException on Write Error
             * @throws WriteConcernException on Write Concern failure
             */
            final public function executeCommand($db, Command $command, ReadPreference $readPreference = null)
            {
            }

            /**
             * Execute a MongoDB query
             * @link http://php.net/manual/en/mongodb-driver-manager.executequery.php
             * @param string $namespace A fully qualified namespace (databaseName.collectionName)
             * @param Query $query A MongoDB\Driver\Query to execute.
             * @param ReadPreference $readPreference Optionally, a MongoDB\Driver\ReadPreference to route the command to. If none given, defaults to the Read Preferences set by the MongoDB Connection URI.
             * @return Cursor
             * @throws Exception
             * @throws AuthenticationException if authentication is needed and fails
             * @throws ConnectionException if connection to the server fails for other then authentication reasons
             * @throws RuntimeException on other errors (invalid command, command arguments, ...)
             */
            final public function executeQuery($namespace, Query $query, ReadPreference $readPreference = null)
            {
            }

            /**
             * Return the servers to which this manager is connected
             * @link http://php.net/manual/en/mongodb-driver-manager.getservers.php
             * @throws InvalidArgumentException on argument parsing errors
             * @return Server[]
             */
            final public function getServers()
            {
            }

            /**
             * Return the ReadConcern for the Manager
             * @link http://php.net/manual/en/mongodb-driver-manager.getreadconcern.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return ReadConcern
             */
            final public function getReadConcern()
            {
            }

            /**
             * Return the ReadPreference for the Manager
             * @link http://php.net/manual/en/mongodb-driver-manager.getreadpreference.php
             * @throws InvalidArgumentException
             * @return ReadPreference
             */
            final public function getReadPreference()
            {
            }

            /**
             * Return the WriteConcern for the Manager
             * @link http://php.net/manual/en/mongodb-driver-manager.getwriteconcern.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return WriteConcern
             */
            final public function getWriteConcern()
            {
            }

            /**
             * Preselect a MongoDB node based on provided readPreference. This can be useful to gurantee a command runs on a specific server when operating in a mixed version cluster.
             * http://php.net/manual/en/mongodb-driver-manager.selectserver.php
             * @param ReadPreference $readPreference Optionally, a MongoDB\Driver\ReadPreference to route the command to. If none given, defaults to the Read Preferences set by the MongoDB Connection URI.
             * @throws InvalidArgumentException on argument parsing errors.
             * @throws ConnectionException if connection to the server fails (for reasons other than authentication).
             * @throws AuthenticationException if authentication is needed and fails.
             * @throws RuntimeException if a server matching the read preference could not be found.
             * @return Server
             */
            final public function selectServer(ReadPreference $readPreference = null)
            {
            }
        }

        /**
         * @link http://php.net/manual/en/class.mongodb-driver-server.php
         */
        final class Server
        {
            const TYPE_UNKNOWN = 0;
            const TYPE_STANDALONE = 1;
            const TYPE_MONGOS = 2;
            const TYPE_POSSIBLE_PRIMARY = 3;
            const TYPE_RS_PRIMARY = 4;
            const TYPE_RS_SECONDARY = 5;
            const TYPE_RS_ARBITER = 6;
            const TYPE_RS_OTHER = 7;
            const TYPE_RS_GHOST = 8;

            /**
             * Server constructor.
             * @link http://php.net/manual/en/mongodb-driver-server.construct.php
             * @throws RuntimeException (can only be created internally)
             */
            final private function __construct()
            {
            }

            /**
             * Execute one or more write operations on this server
             * @link http://php.net/manual/en/mongodb-driver-server.executebulkwrite.php
             * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
             * @param BulkWrite $zwrite The MongoDB\Driver\BulkWrite to execute.
             * @param WriteConcern $writeConcern Optionally, a MongoDB\Driver\WriteConcern. If none given, default to the Write Concern set by the MongoDB Connection URI.
             * @throws BulkWriteException on any write failure (e.g. write error, failure to apply a write concern).
             * @throws InvalidArgumentException on argument parsing errors.
             * @throws ConnectionException if connection to the server fails (for reasons other than authentication).
             * @throws AuthenticationException if authentication is needed and fails.
             * @throws RuntimeException on other errors.
             * @return WriteResult
             */
            final public function executeBulkWrite($namespace, BulkWrite $zwrite, WriteConcern $writeConcern = null)
            {
            }

            /**
             * Execute a database command on this server
             * @link http://php.net/manual/en/mongodb-driver-server.executecommand.php
             * @param string $db The name of the database on which to execute the command.
             * @param Command $command The MongoDB\Driver\Command to execute.
             * @param ReadPreference $readPreference Optionally, a MongoDB\Driver\ReadPreference to select the server for this operation. If none is given, the read preference from the MongoDB Connection URI will be used.
             * @throws InvalidArgumentException on argument parsing errors.
             * @throws ConnectionException if connection to the server fails (for reasons other than authentication).
             * @throws AuthenticationException if authentication is needed and fails.
             * @throws RuntimeException on other errors (e.g. invalid command, issuing a write command to a secondary).
             * @return Cursor
             */
            final public function executeCommand($db, Command $command, ReadPreference $readPreference = null)
            {
            }

            /**
             * Execute a database query on this server
             * @link http://php.net/manual/en/mongodb-driver-server.executequery.php
             * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
             * @param Query $query The MongoDB\Driver\Query to execute.
             * @param ReadPreference $readPreference Optionally, a MongoDB\Driver\ReadPreference to select the server for this operation. If none is given, the read preference from the MongoDB Connection URI will be used.
             * @throws InvalidArgumentException on argument parsing errors.
             * @throws ConnectionException if connection to the server fails (for reasons other than authentication).
             * @throws AuthenticationException if authentication is needed and fails.
             * @throws RuntimeException on other errors (e.g. invalid command, issuing a write command to a secondary).
             * @return Cursor
             */
            final public function executeQuery($namespace, Query $query, ReadPreference $readPreference = null)
            {
            }

            /**
             * Returns the hostname of this server
             * @link http://php.net/manual/en/mongodb-driver-server.gethost.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return string
             */
            final public function getHost()
            {
            }

            /**
             * Returns an array of information about this server
             * @link http://php.net/manual/en/mongodb-driver-server.getinfo.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return array
             */
            final public function getInfo()
            {
            }

            /**
             * Returns the latency of this server
             * @link http://php.net/manual/en/mongodb-driver-server.getlatency.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return integer
             */
            final public function getLatency()
            {
            }

            /**
             * Returns the port on which this server is listening
             * @link http://php.net/manual/en/mongodb-driver-server.getport.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return integer
             */
            final public function getPort()
            {
            }

            /**
             * Returns an array of tags describing this server in a replica set
             * @link http://php.net/manual/en/mongodb-driver-server.gettags.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return array An array of tags used to describe this server in a replica set. The array will contain zero or more string key and value pairs.
             */
            final public function getTags()
            {
            }

            /**
             * Returns an integer denoting the type of this server
             * @link http://php.net/manual/en/mongodb-driver-server.gettype.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return integer denoting the type of this server
             */
            final public function getType()
            {
            }

            /**
             * Checks if this server is an arbiter member of a replica set
             * @link http://php.net/manual/en/mongodb-driver-server.isarbiter.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return boolean
             */
            final public function isArbiter()
            {
            }

            /**
             * Checks if this server is a hidden member of a replica set
             * @link http://php.net/manual/en/mongodb-driver-server.ishidden.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return boolean
             */
            final public function isHidden()
            {
            }

            /**
             * Checks if this server is a passive member of a replica set
             * @link http://php.net/manual/en/mongodb-driver-server.ispassive.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return boolean
             */
            final public function isPassive()
            {
            }

            /**
             * Checks if this server is a primary member of a replica set
             * @link http://php.net/manual/en/mongodb-driver-server.isprimary.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return boolean
             */
            final public function isPrimary()
            {
            }

            /**
             * Checks if this server is a secondary member of a replica set
             * @link http://php.net/manual/en/mongodb-driver-server.issecondary.php
             * @throws InvalidArgumentException on argument parsing errors.
             * @return boolean
             */
            final public function isSecondary()
            {
            }
        }

        /**
         * The MongoDB\Driver\Query class is a value object that represents a database query.
         * @link http://php.net/manual/en/class.mongodb-driver-query.php
         */
        final class Query
        {
            /**
             * Construct new Query
             * @link http://php.net/manual/en/mongodb-driver-query.construct.php
             * @param array|object $filter The search filter.
             * @param array $queryOptions
             * @throws InvalidArgumentException on argument parsing errors.
             */
            final public function __construct($filter, array $queryOptions = [])
            {
            }
        }

        /**
         * The MongoDB\Driver\Command class is a value object that represents a database command.
         * To provide "Command Helpers" the MongoDB\Driver\Command object should be composed.
         * @link http://php.net/manual/en/class.mongodb-driver-command.php
         */
        final class Command
        {
            /**
             * Construct new Command
             * @param array|object $document The complete command to construct
             * @throws InvalidArgumentException on argument parsing errors.
             */
            final public function __construct($document)
            {
            }
        }

        /**
         * Class ReadPreference
         * @link http://php.net/manual/en/class.mongodb-driver-readpreference.php
         */
        final class ReadPreference implements Serializable
        {
            const RP_PRIMARY = 1;
            const RP_PRIMARY_PREFERRED = 5;
            const RP_SECONDARY = 2;
            const RP_SECONDARY_PREFERRED = 6;
            const RP_NEAREST = 10;

            /**
             * Construct immutable ReadPreference
             * @link http://php.net/manual/en/mongodb-driver-readpreference.construct.php
             * @param int $mode
             * @param array $tagSets
             * @throws InvalidArgumentException if mode is invalid or if tagSets is provided for a primary read preference.
             */
            final public function __construct($mode, array $tagSets = [])
            {
            }

            /**
             * Returns the ReadPreference's "mode" option
             * @link http://php.net/manual/en/mongodb-driver-readpreference.getmode.php
             * @return integer
             */
            final public function  getMode()
            {
            }

            /**
             * Returns the ReadPreference's "tagSets" option
             * @link http://php.net/manual/en/mongodb-driver-readpreference.gettagsets.php
             * @return array
             */
            final public function getTagSets()
            {
            }

            /**
             * Returns an object for BSON serialization
             * @link http://php.net/manual/en/mongodb-driver-readpreference.bsonserialize.php
             * @return object
             */
            final public function bsonSerialize()
            {
            }
        }

        /**
         * MongoDB\Driver\ReadConcern controls the level of isolation for read operations for replica sets and replica set shards. This option requires the WiredTiger storage engine and MongoDB 3.2 or later.
         * @link http://php.net/manual/en/class.mongodb-driver-readconcern.php
         */
        final class ReadConcern implements Serializable
        {
            const LINEARIZABLE = 'linearizable' ;
            const LOCAL = 'local' ;
            const MAJORITY = 'majority' ;

            /**
             * Construct immutable ReadConcern
             * @link http://php.net/manual/en/mongodb-driver-readconcern.construct.php
             * @param string $level
             */
            final public function __construct($level = null)
            {
            }

            /**
             * Returns the ReadConcern's "level" option
             * @link http://php.net/manual/en/mongodb-driver-readconcern.getlevel.php
             * @return string|null
             */
            final public function getLevel()
            {
            }

            /**
             * Returns an object for BSON serialization
             * @link http://php.net/manual/en/mongodb-driver-readconcern.bsonserialize.php
             * @return object
             */
            final public function bsonSerialize()
            {
            }
        }

        /**
         * The MongoDB\Driver\Cursor class encapsulates the results of a MongoDB command or query and may be returned by MongoDB\Driver\Manager::executeCommand() or MongoDB\Driver\Manager::executeQuery(), respectively.
         * @link http://php.net/manual/en/class.mongodb-driver-cursor.php
         */
        final class Cursor implements \Traversable
        {
            /**
             * Create a new Cursor
             * MongoDB\Driver\Cursor objects are returned as the result of an executed command or query and cannot be constructed directly.
             * @link http://php.net/manual/en/mongodb-driver-cursor.construct.php
             */
            final private function __construct()
            {
            }

            /**
             * Returns the MongoDB\Driver\CursorId associated with this cursor. A cursor ID cursor uniquely identifies the cursor on the server.
             * @link http://php.net/manual/en/mongodb-driver-cursor.getid.php
             * @return CursorId for this Cursor
             * @throws InvalidArgumentException on argument parsing errors.
             */
            final public function getId()
            {
            }

            /**
             * Returns the MongoDB\Driver\Server associated with this cursor. This is the server that executed the query or command.
             * @link http://php.net/manual/en/mongodb-driver-cursor.getserver.php
             * @return Server for this Cursor
             * @throws InvalidArgumentException on argument parsing errors.
             */
            final public function getServer()
            {
            }

            /**
             * Checks if a cursor is still alive
             * @link http://php.net/manual/en/mongodb-driver-cursor.isdead.php
             * @return boolean
             */
            final public function isDead()
            {
            }

            /**
             * Sets a type map to use for BSON unserialization
             * @link http://php.net/manual/en/mongodb-driver-cursor.settypemap.php
             * @param array $typemap
             */
            final public function setTypeMap(array $typemap)
            {
            }

            /**
             * Returns an array of all result documents for this cursor
             * @link http://php.net/manual/en/mongodb-driver-cursor.toarray.php
             * @return array
             */
            final public function toArray()
            {
            }
        }

        /**
         * Class CursorId
         * @link http://php.net/manual/en/class.mongodb-driver-cursorid.php
         */
        final class CursorId
        {
            /**
             * Create a new CursorId (not used)
             * CursorId objects are returned from Cursor::getId() and cannot be constructed directly.
             * @link http://php.net/manual/en/mongodb-driver-cursorid.construct.php
             * @see Cursor::getId()
             */
            final private function __construct()
            {
            }

            /**
             * String representation of the cursor ID
             * @link http://php.net/manual/en/mongodb-driver-cursorid.tostring.php
             * @return string representation of the cursor ID.
             * @throws InvalidArgumentException on argument parsing errors.
             */
            final public function __toString()
            {
            }
        }

        /**
         * The BulkWrite collects one or more write operations that should be sent to the server.
         * After adding any number of insert, update, and delete operations, the collection may be executed via Manager::executeBulkWrite().
         * Write operations may either be ordered (default) or unordered.
         * Ordered write operations are sent to the server, in the order provided, for serial execution.
         * If a write fails, any remaining operations will be aborted.
         * Unordered operations are sent to the server in an arbitrary order where they may be executed in parallel.
         * Any errors that occur are reported after all operations have been attempted.
         */
        final class BulkWrite implements \Countable
        {
            /**
             * Create a new BulkWrite
             * Constructs a new ordered (default) or unordered BulkWrite.
             * @link http://php.net/manual/en/mongodb-driver-bulkwrite.construct.php
             * @param array $options
             * @throws InvalidArgumentException on argument parsing errors.
             */
            public function __construct(array $options = [])
            {
            }

            /**
             * Count expected roundtrips for executing the bulk
             * Returns the expected number of client-to-server roundtrips required to execute all write operations in the BulkWrite.
             * @link http://php.net/manual/en/mongodb-driver-bulkwrite.count.php
             * @return int number of expected roundtrips to execute the BulkWrite.
             * @throws InvalidArgumentException on argument parsing errors.
             */
            public function count()
            {
            }

            /**
             * Add a delete operation to the bulk
             * @link http://php.net/manual/en/mongodb-driver-bulkwrite.delete.php
             * @param array|object $filter The search filter
             * @param array $deleteOptions
             * @throws InvalidArgumentException on argument parsing errors.
             */
            public function delete($filter, array $deleteOptions = [])
            {
            }

            /**
             * Add an insert operation to the bulk
             * If the document did not have an _id, a MongoDB\BSON\ObjectId will be generated and returned; otherwise, no value is returned.
             * @link http://php.net/manual/en/mongodb-driver-bulkwrite.insert.php
             * @param array|object $document
             * @return mixed
             * @Throws MongoDB\Driver\InvalidArgumentException on argument parsing errors.
             */
            public function insert($document)
            {
            }

            /**
             * Add an update operation to the bulk
             * @link http://php.net/manual/en/mongodb-driver-bulkwrite.update.php
             * @param array|object $filter The search filter
             * @param array|object $newObj A document containing either update operators (e.g. $set) or a replacement document (i.e. only field:value expressions)
             * @param array $updateOptions
             * @throws InvalidArgumentException on argument parsing errors.
             */
            public function update($filter, $newObj, array $updateOptions = [])
            {
            }
        }

        /**
         * WriteConcern controls the acknowledgment of a write operation, specifies the level of write guarantee for Replica Sets.
         */
        final class WriteConcern
        {
            /**
             * Majority of all the members in the set; arbiters, non-voting members, passive members, hidden members and delayed members are all included in the definition of majority write concern.
             */
            const MAJORITY = 'majority';

            /**
             * Construct immutable WriteConcern
             * @link http://php.net/manual/en/mongodb-driver-writeconcern.construct.php
             * @param string|integer $w
             * @param integer $wtimeout How long to wait (in milliseconds) for secondaries before failing.
             * @param boolean $journal Wait until mongod has applied the write to the journal.
             * @throws InvalidArgumentException on argument parsing errors.
             */
            final public function __construct($w, $wtimeout = 0, $journal = false)
            {
            }

            /**
             * Returns the WriteConcern's "journal" option
             * @link http://php.net/manual/en/mongodb-driver-writeconcern.getjournal.php
             * @return bool|null
             */
            final public function getJurnal()
            {
            }

            /**
             * Returns the WriteConcern's "w" option
             * @link http://php.net/manual/en/mongodb-driver-writeconcern.getw.php
             * @return string|int|null
             */
            final public function getW()
            {
            }

            /**
             * Returns the WriteConcern's "wtimeout" option
             * @link http://php.net/manual/en/mongodb-driver-writeconcern.getwtimeout.php
             * @return int
             */
            final public function getWtimeout()
            {
            }
        }

        /**
         * The MongoDB\Driver\WriteResult class encapsulates information about an executed MongoDB\Driver\BulkWrite and may be returned by MongoDB\Driver\Manager::executeBulkWrite().
         * @link http://php.net/manual/en/class.mongodb-driver-writeresult.php
         */
        final class WriteResult
        {
            /**
             * Returns the number of documents deleted
             * @link http://php.net/manual/en/mongodb-driver-writeresult.getdeletedcount.php
             * @return integer|null
             */
            final public function getDeletedCount()
            {
            }

            /**
             * Returns the number of documents inserted (excluding upserts)
             * @link http://php.net/manual/en/mongodb-driver-writeresult.getinsertedcount.php
             * @return integer|null
             */
            final public function getInsertedCount()
            {
            }

            /**
             * Returns the number of documents selected for update
             * @link http://php.net/manual/en/mongodb-driver-writeresult.getmatchedcount.php
             * @return integer|null
             */
            final public function getMatchedCount()
            {
            }

            /**
             * Returns the number of existing documents updated
             * @link http://php.net/manual/en/mongodb-driver-writeresult.getmodifiedcount.php
             * @return integer|null
             */
            final public function getModifiedCount()
            {
            }

            /**
             * Returns the server associated with this write result
             * @link http://php.net/manual/en/mongodb-driver-writeresult.getserver.php
             * @return Server
             */
            final public function getServer()
            {
            }

            /**
             * Returns the number of documents inserted by an upsert
             * @link http://php.net/manual/en/mongodb-driver-writeresult.getupsertedcount.php
             * @return integer|null
             */
            final public function getUpsertedCount()
            {
            }

            /**
             * Returns an array of identifiers for upserted documents
             * @link http://php.net/manual/en/mongodb-driver-writeresult.getupsertedids.php
             * @return array
             */
            final public function getUpsertedIds()
            {
            }

            /**
             * Returns any write concern error that occurred
             * @link http://php.net/manual/en/mongodb-driver-writeresult.getwriteconcernerror.php
             * @return WriteConcernError|null
             */
            final public function getWriteConcernError()
            {
            }

            /**
             * Returns any write errors that occurred
             * @link http://php.net/manual/en/mongodb-driver-writeresult.getwriteerrors.php
             * @return WriteError[]
             */
            final public function getWriteErrors()
            {
            }

            /**
             * Returns whether the write was acknowledged
             * @link http://php.net/manual/en/mongodb-driver-writeresult.isacknowledged.php
             * @return boolean
             */
            final public function isAcknowledged()
            {
            }
        }

        /**
         * The MongoDB\Driver\WriteError class encapsulates information about a write error and may be returned as an array element from MongoDB\Driver\WriteResult::getWriteErrors().
         */
        final class WriteError
        {
            /**
             * Returns the WriteError's error code
             * @link http://php.net/manual/en/mongodb-driver-writeerror.getcode.php
             * @return int
             */
            final public function getCode()
            {
            }

            /**
             * Returns the index of the write operation corresponding to this WriteError
             * @link http://php.net/manual/en/mongodb-driver-writeerror.getindex.php
             * @return int
             */
            final public function getIndex()
            {
            }

            /**
             * Returns additional metadata for the WriteError
             * @link http://php.net/manual/en/mongodb-driver-writeerror.getinfo.php
             * @return mixed
             */
            final public function getInfo()
            {
            }

            /**
             * Returns the WriteError's error message
             * @link http://php.net/manual/en/mongodb-driver-writeerror.getmessage.php
             * @return string
             */
            final public function getMessage()
            {
            }
        }

        /**
         * The MongoDB\Driver\WriteConcernError class encapsulates information about a write concern error and may be returned by MongoDB\Driver\WriteResult::getWriteConcernError().
         * @link http://php.net/manual/en/class.mongodb-driver-writeconcernerror.php
         */
        final class WriteConcernError
        {
            /**
             * Returns the WriteConcernError's error code
             * @link http://php.net/manual/en/mongodb-driver-writeconcernerror.getcode.php
             * @return int
             */
            final public function getCode()
            {
            }

            /**
             * Returns additional metadata for the WriteConcernError
             * @link http://php.net/manual/en/mongodb-driver-writeconcernerror.getinfo.php
             * @return mixed
             */
            final public function getInfo()
            {
            }

            /**
             * Returns the WriteConcernError's error message
             * @link http://php.net/manual/en/mongodb-driver-writeconcernerror.getmessage.php
             * @return string
             */
            final public function getMessage()
            {
            }
        }
    }

    namespace MongoDB\Driver\Exception {

        use MongoDB\Driver\WriteResult;

        /**
         * Thrown when the driver encounters a runtime error (e.g. internal error from » libmongoc).
         * @link http://php.net/manual/en/class.mongodb-driver-exception-runtimeexception.php
         */
        class RuntimeException extends \RuntimeException implements Exception
        {
        }

        /**
         * Common interface for all driver exceptions. This may be used to catch only exceptions originating from the driver itself.
         * @link http://php.net/manual/en/class.mongodb-driver-exception-exception.php
         */
        interface Exception
        {
        }

        /**
         * Thrown when the driver fails to authenticate with the server.
         * @link http://php.net/manual/en/class.mongodb-driver-exception-authenticationexception.php
         */
        class AuthenticationException extends ConnectionException implements Exception
        {
        }

        /**
         * Base class for exceptions thrown when the driver fails to establish a database connection.
         * @link http://php.net/manual/en/class.mongodb-driver-exception-connectionexception.php
         */
        class ConnectionException extends RuntimeException implements Exception
        {
        }

        /**
         * Thrown when a driver method is given invalid arguments (e.g. invalid option types).
         * @link http://php.net/manual/en/class.mongodb-driver-exception-invalidargumentexception.php
         */
        class InvalidArgumentException extends \InvalidArgumentException implements Exception
        {
        }

        /**
         * Base class for exceptions thrown by a failed write operation.
         * The exception encapsulates a MongoDB\Driver\WriteResult object.
         * @link http://php.net/manual/en/class.mongodb-driver-exception-writeexception.php
         */
        abstract class WriteException extends RuntimeException implements Exception
        {
            /**
             * @var WriteResult associated with the failed write operation.
             */
            protected $writeResult;

            /**
             * @return WriteResult for the failed write operation
             */
            final public function  getWriteResult()
            {
            }
        }

        class WriteConcernException extends RuntimeException implements Exception
        {
        }

        /**
         * Thrown when the driver encounters an unexpected value (e.g. during BSON serialization or deserialization).
         * @link http://php.net/manual/en/class.mongodb-driver-exception-unexpectedvalueexception.php
         */
        class UnexpectedValueException extends \UnexpectedValueException implements Exception
        {
        }

        /**
         * Thrown when a bulk write operation fails.
         * @link http://php.net/manual/en/class.mongodb-driver-exception-bulkwriteexception.php
         */
        class BulkWriteException extends WriteException implements Exception
        {
        }

        /**
         * Thrown when the driver fails to establish a database connection within a specified time limit (e.g. connectTimeoutMS).
         * @link http://php.net/manual/en/class.mongodb-driver-exception-connectiontimeoutexception.php
         */
        class ConnectionTimeoutException extends ConnectionException implements Exception
        {
        }

        /**
         * Thrown when a query or command fails to complete within a specified time limit (e.g. maxTimeMS).
         * @link http://php.net/manual/en/class.mongodb-driver-exception-executiontimeoutexception.php
         */
        class ExecutionTimeoutException extends RuntimeException implements Exception
        {
        }

        /**
         * Thrown when the driver is incorrectly used (e.g. rewinding a cursor).
         * @link http://php.net/manual/en/class.mongodb-driver-exception-logicexception.php
         */
        class LogicException extends \LogicException implements Exception
        {
        }

        /**
         * Thrown when the driver fails to establish an SSL connection with the server.
         * @link http://php.net/manual/en/class.mongodb-driver-exception-sslconnectionexception.php
         */
        class SSLConnectionException extends ConnectionException implements Exception
        {
        }
    }

    /**
     * @link http://php.net/manual/en/book.bson.php
     */
    namespace MongoDB\BSON {

        use MongoDB\Driver\Exception\InvalidArgumentException;
        use MongoDB\Driver\Exception\UnexpectedValueException;

        /**
         * Returns the BSON representation of a JSON value
         * Converts an extended JSON string to its BSON representation.
         * @link http://php.net/manual/en/function.mongodb.bson-fromjson.php
         * @param string $json JSON value to be converted.
         * @return string The serialized BSON document as a binary string.
         * @throws UnexpectedValueException if the JSON value cannot be converted to BSON (e.g. due to a syntax error).
         */
        function fromJSON($json)
        {
        }

        /**
         * Returns the BSON representation of a PHP value
         * Serializes a PHP array or object (e.g. document) to its BSON representation. The returned binary string will describe a BSON document.
         * @link http://php.net/manual/en/function.mongodb.bson-fromphp.php
         * @param array|object $value PHP value to be serialized.
         * @return string The serialized BSON document as a binary string
         * @throws UnexpectedValueException if the PHP value cannot be converted to BSON.
         */
        function fromPHP($value)
        {
        }

        /**
         * Returns the JSON representation of a BSON value
         * Converts a BSON string to its extended JSON representation.
         * @link http://php.net/manual/en/function.mongodb.bson-tojson.php
         * @param string $bson BSON value to be converted
         * @return string The converted JSON value.
         * @see https://docs.mongodb.org/manual/reference/mongodb-extended-json/
         * @throws UnexpectedValueException if the input did not contain exactly one BSON document
         */
        function toJSON($bson)
        {
        }

        /**
         * Returns the PHP representation of a BSON value
         * Unserializes a BSON document (i.e. binary string) to its PHP representation.
         * The typeMap paramater may be used to control the PHP types used for converting BSON arrays and documents (both root and embedded).
         * @link http://php.net/manual/en/function.mongodb.bson-tophp.php
         * @param string $bson BSON value to be unserialized.
         * @param array $typeMap
         * @return object The unserialized PHP value
         * @throws UnexpectedValueException if the input did not contain exactly one BSON document.
         * @throws InvalidArgumentException if a class in the type map cannot be instantiated or does not implement MongoDB\BSON\Unserializable.
         */
        function toPHP($bson, array $typeMap)
        {
        }

        /**
         * Class Binary
         * @link http://php.net/manual/en/class.mongodb-bson-binary.php
         */
        class Binary implements Type
        {
            const TYPE_GENERIC = 0;
            const TYPE_FUNCTION = 1;
            const TYPE_OLD_BINARY = 2;
            const TYPE_OLD_UUID = 3;
            const TYPE_UUID = 4;
            const TYPE_MD5 = 5;
            const TYPE_USER_DEFINED = 128;

            /**
             * Binary constructor.
             * @link http://php.net/manual/en/mongodb-bson-binary.construct.php
             * @param string $data
             * @param integer $type
             */
            public function __construct($data, $type)
            {
            }

            /**
             * Returns the Binary's data
             * @link http://php.net/manual/en/mongodb-bson-binary.getdata.php
             * @return string
             */
            public function getData()
            {
            }

            /**
             * Returns the Binary's type
             * @link http://php.net/manual/en/mongodb-bson-binary.gettype.php
             * @return integer
             */
            public function getType()
            {
            }
        }

        /**
         * BSON type for the Decimal128 floating-point format, which supports numbers with up to 34 decimal digits (i.e. significant digits) and an exponent range of −6143 to +6144.
         * @link http://php.net/manual/en/class.mongodb-bson-decimal128.php
         */
        class Decimal128 implements Type
        {
            /**
             * Construct a new Decimal128
             * @link http://php.net/manual/en/mongodb-bson-decimal128.construct.php
             * @param string $value A decimal string.
             */
            final public function __construct($value = '')
            {
            }

            /**
             * Returns the string representation of this Decimal128
             * @link http://php.net/manual/en/mongodb-bson-decimal128.tostring.php
             * @return string
             */
            final public function __toString()
            {
            }
        }

        /**
         * Class Javascript
         * @link http://php.net/manual/en/class.mongodb-bson-javascript.php
         */
        class Javascript implements Type
        {
            /**
             * Construct a new Javascript
             * @link http://php.net/manual/en/mongodb-bson-javascript.construct.php
             * @param string $code
             * @param array|object $scope
             */
            final public function __construct($code, $scope = [])
            {
            }
        }

        /**
         * Class MaxKey
         * @link http://php.net/manual/en/class.mongodb-bson-maxkey.php
         */
        class MaxKey implements Type
        {
        }

        /**
         * Class MinKey
         * @link http://php.net/manual/en/class.mongodb-bson-minkey.php
         */
        class MinKey implements Type
        {
        }

        /**
         * Class ObjectId
         * @link http://php.net/manual/en/class.mongodb-bson-objectid.php
         */
        class ObjectId implements Type
        {
            /**
             * Construct a new ObjectId
             * @link http://php.net/manual/en/mongodb-bson-objectid.construct.php
             * @param string $id A 24-character hexadecimal string. If not provided, the driver will generate an ObjectId.
             * @throws InvalidArgumentException if id is not a 24-character hexadecimal string.
             */
            public function __construct($id = null)
            {
            }

            /**
             * Returns the hexidecimal representation of this ObjectId
             * @link http://php.net/manual/en/mongodb-bson-objectid.tostring.php
             * @return string
             */
            public function __toString()
            {
            }
        }

        /**
         * Class Regex
         * @link http://php.net/manual/en/class.mongodb-bson-regex.php
         */
        class Regex implements Type
        {
            /**
             * Construct a new Regex
             * @link http://php.net/manual/en/mongodb-bson-regex.construct.php
             * @param string $pattern
             * @param string $flags [optional]
             */
            public function __construct($pattern, $flags = "")
            {
            }

            /**
             * Returns the Regex's flags
             * @link http://php.net/manual/en/mongodb-bson-regex.getflags.php
             */
            public function getFlags()
            {
            }

            /**
             * Returns the Regex's pattern
             * @link http://php.net/manual/en/mongodb-bson-regex.getpattern.php
             * @return string
             */
            public function getPattern()
            {
            }

            /**
             * Returns the string representation of this Regex
             * @link http://php.net/manual/en/mongodb-bson-regex.tostring.php
             * @return string
             */
            public function __toString()
            {
            }
        }

        /**
         * Represents a BSON timestamp, which is an internal MongoDB type not intended for general date storage.
         * @link http://php.net/manual/en/class.mongodb-bson-timestamp.php
         */
        class Timestamp implements Type
        {
            /**
             * Construct a new Timestamp
             * @link http://php.net/manual/en/mongodb-bson-timestamp.construct.php
             * @param integer $increment
             * @param integer $timestamp
             */
            final public function __construct($increment, $timestamp)
            {
            }

            /**
             * Returns the string representation of this Timestamp
             * @link http://php.net/manual/en/mongodb-bson-timestamp.tostring.php
             * @return string
             */
            final public function __toString()
            {
            }
        }

        /**
         * Represents a BSON date.
         * @link http://php.net/manual/en/class.mongodb-bson-utcdatetime.php
         */
        class UTCDateTime implements Type
        {
            /**
             * Construct a new UTCDateTime
             * @link http://php.net/manual/en/mongodb-bson-utcdatetime.construct.php
             * @param integer $milliseconds
             */
            final public function __construct($milliseconds=null)
            {
            }

            /**
             * Returns the DateTime representation of this UTCDateTime
             * @link http://php.net/manual/en/mongodb-bson-utcdatetime.todatetime.php
             * @return \DateTime
             */
            final public function toDateTime()
            {
            }

            /**
             * Returns the string representation of this UTCDateTime
             * @link http://php.net/manual/en/mongodb-bson-utcdatetime.tostring.php
             * @return string
             */
            final public function __toString()
            {
            }
        }

        /**
         * Classes may implement this interface to take advantage of automatic ODM (object document mapping) behavior in the driver.
         * @link http://php.net/manual/en/class.mongodb-bson-persistable.php
         */
        interface Persistable extends Unserializable, Serializable
        {
        }

        /**
         * Classes that implement this interface may return data to be serialized as a BSON array or document in lieu of the object's public properties
         * @link http://php.net/manual/en/class.mongodb-bson-serializable.php
         */
        interface Serializable extends Type
        {

            /**
             * Provides an array or document to serialize as BSON
             * Called during serialization of the object to BSON. The method must return an array or stdClass.
             * Root documents (e.g. a MongoDB\BSON\Serializable passed to MongoDB\BSON\fromPHP()) will always be serialized as a BSON document.
             * For field values, associative arrays and stdClass instances will be serialized as a BSON document and sequential arrays (i.e. sequential, numeric indexes starting at 0) will be serialized as a BSON array.
             * @link http://php.net/manual/en/mongodb-bson-serializable.bsonserialize.php
             * @return array|object An array or stdClass to be serialized as a BSON array or document.
             */
            public function  bsonSerialize();
        }

        /**
         * Classes that implement this interface may be specified in a type map for unserializing BSON arrays and documents (both root and embedded).
         * @link http://php.net/manual/en/class.mongodb-bson-unserializable.php
         */
        interface Unserializable extends Type
        {

            /**
             * Constructs the object from a BSON array or document
             * Called during unserialization of the object from BSON.
             * The properties of the BSON array or document will be passed to the method as an array.
             * @link http://php.net/manual/en/mongodb-bson-unserializable.bsonunserialize.php
             * @param array $data Properties within the BSON array or document.
             */
            public function bsonUnserialize(array $data);
        }

        /**
         * Interface Type
         * @link http://php.net/manual/en/class.mongodb-bson-type.php
         */
        interface Type
        {
        }
    }
