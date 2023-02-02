<?php

namespace MongoDB\Driver;

use MongoDB\Driver\Exception\AuthenticationException;
use MongoDB\Driver\Exception\BulkWriteException;
use MongoDB\Driver\Exception\ConnectionException;
use MongoDB\Driver\Exception\Exception;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\RuntimeException;
use MongoDB\Driver\Exception\WriteConcernException;
use MongoDB\Driver\Exception\WriteException;
use MongoDB\Driver\Monitoring\Subscriber;

/**
 * The MongoDB\Driver\Manager is the main entry point to the extension. It is responsible for maintaining connections to MongoDB (be it standalone server, replica set, or sharded cluster).
 * No connection to MongoDB is made upon instantiating the Manager. This means the MongoDB\Driver\Manager can always be constructed, even though one or more MongoDB servers are down.
 * Any write or query can throw connection exceptions as connections are created lazily. A MongoDB server may also become unavailable during the life time of the script. It is therefore important that all actions on the Manager to be wrapped in try/catch statements.
 * @link https://php.net/manual/en/class.mongodb-driver-manager.php
 */
final class Manager
{
    /**
     * Manager constructor.
     * @link https://php.net/manual/en/mongodb-driver-manager.construct.php
     * @param string $uri A mongodb:// connection URI
     * @param array $options Connection string options
     * @param array $driverOptions Any driver-specific options not included in MongoDB connection spec.
     * @throws InvalidArgumentException on argument parsing errors
     * @throws RuntimeException if the uri format is invalid
     */
    final public function __construct($uri = '', array $options = [], array $driverOptions = []) {}

    final public function __wakeup() {}

    /**
     * Return a ClientEncryption instance.
     * @link https://php.net/manual/en/mongodb-driver-manager.createclientencryption.php
     * @param array $options
     * @return \MongoDB\Driver\ClientEncryption
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors.
     * @throws \MongoDB\Driver\Exception\RuntimeException If the extension was compiled without libmongocrypt support.
     */
    final public function createClientEncryption(array $options) {}

    /**
     * Execute one or more write operations
     * @link https://php.net/manual/en/mongodb-driver-manager.executebulkwrite.php
     * @param string $namespace A fully qualified namespace (databaseName.collectionName)
     * @param BulkWrite $zbulk The MongoDB\Driver\BulkWrite to execute.
     * @param array|WriteConcern $options WriteConcern type for backwards compatibility
     * @return WriteResult
     * @throws InvalidArgumentException on argument parsing errors.
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws AuthenticationException if authentication is needed and fails
     * @throws BulkWriteException on any write failure
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @since 1.4.0 added $options argument
     */
    final public function executeBulkWrite($namespace, BulkWrite $zbulk, $options = []) {}

    /**
     * @link https://php.net/manual/en/mongodb-driver-manager.executecommand.php
     * @param string $db The name of the database on which to execute the command.
     * @param Command $command The command document.
     * @param array|ReadPreference $options ReadPreference type for backwards compatibility
     * @return Cursor
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @throws WriteException on Write Error
     * @throws WriteConcernException on Write Concern failure
     * @since 1.4.0 added $options argument
     */
    final public function executeCommand($db, Command $command, $options = []) {}

    /**
     * Execute a MongoDB query
     * @link https://php.net/manual/en/mongodb-driver-manager.executequery.php
     * @param string $namespace A fully qualified namespace (databaseName.collectionName)
     * @param Query $zquery A MongoDB\Driver\Query to execute.
     * @param array|ReadPreference $options ReadPreference type for backwards compatibility
     * @return Cursor
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @since 1.4.0 added $options argument
     */
    final public function executeQuery($namespace, Query $zquery, $options = []) {}

    /**
     * @link https://php.net/manual/en/mongodb-driver-manager.executereadcommand.php
     * @param string $db The name of the database on which to execute the command that reads.
     * @param Command $command The command document.
     * @param array $options
     * @return Cursor
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @throws WriteException on Write Error
     * @throws WriteConcernException on Write Concern failure
     * @since 1.4.0
     */
    final public function executeReadCommand($db, Command $command, array $options = []) {}

    /**
     * @link https://php.net/manual/en/mongodb-driver-manager.executereadwritecommand.php
     * @param string $db The name of the database on which to execute the command that reads.
     * @param Command $command The command document.
     * @param array $options
     * @return Cursor
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @throws WriteException on Write Error
     * @throws WriteConcernException on Write Concern failure
     * @since 1.4.0
     */
    final public function executeReadWriteCommand($db, Command $command, $options = []) {}

    /**
     * @link https://php.net/manual/en/mongodb-driver-manager.executewritecommand.php
     * @param string $db The name of the database on which to execute the command that writes.
     * @param Command $command The command document.
     * @param array $options
     * @return Cursor
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @throws WriteException on Write Error
     * @throws WriteConcernException on Write Concern failure
     * @since 1.4.0
     */
    final public function executeWriteCommand($db, Command $command, array $options = []) {}

    /**
     * Return the ReadConcern for the Manager
     * @link https://php.net/manual/en/mongodb-driver-manager.getreadconcern.php
     * @throws InvalidArgumentException on argument parsing errors.
     * @return ReadConcern
     */
    final public function getReadConcern() {}

    /**
     * Return the ReadPreference for the Manager
     * @link https://php.net/manual/en/mongodb-driver-manager.getreadpreference.php
     * @throws InvalidArgumentException
     * @return ReadPreference
     */
    final public function getReadPreference() {}

    /**
     * Return the servers to which this manager is connected
     * @link https://php.net/manual/en/mongodb-driver-manager.getservers.php
     * @throws InvalidArgumentException on argument parsing errors
     * @return Server[]
     */
    final public function getServers() {}

    /**
     * Return the WriteConcern for the Manager
     * @link https://php.net/manual/en/mongodb-driver-manager.getwriteconcern.php
     * @throws InvalidArgumentException on argument parsing errors.
     * @return WriteConcern
     */
    final public function getWriteConcern() {}

    /**
     * Preselect a MongoDB node based on provided readPreference. This can be useful to guarantee a command runs on a specific server when operating in a mixed version cluster.
     * https://secure.php.net/manual/en/mongodb-driver-manager.selectserver.php
     * @param ReadPreference $readPreference Optionally, a MongoDB\Driver\ReadPreference to route the command to. If none given, defaults to the Read Preferences set by the MongoDB Connection URI.
     * @throws InvalidArgumentException on argument parsing errors.
     * @throws ConnectionException if connection to the server fails (for reasons other than authentication).
     * @throws AuthenticationException if authentication is needed and fails.
     * @throws RuntimeException if a server matching the read preference could not be found.
     * @return Server
     */
    final public function selectServer(ReadPreference $readPreference = null) {}

    /**
     * Start a new client session for use with this client
     * @param array $options
     * @return \MongoDB\Driver\Session
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors
     * @throws \MongoDB\Driver\Exception\RuntimeException If the session could not be created (e.g. libmongoc does not support crypto).
     * @link https://secure.php.net/manual/en/mongodb-driver-manager.startsession.php
     * @since 1.4.0
     */
    final public function startSession(?array $options = []) {}

    final public function addSubscriber(Subscriber $subscriber) {}

    final public function removeSubscriber(Subscriber $subscriber) {}
}
