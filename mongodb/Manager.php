<?php

namespace MongoDB\Driver;

use MongoDB\Driver\Exception\AuthenticationException;
use MongoDB\Driver\Exception\BulkWriteCommandException;
use MongoDB\Driver\Exception\BulkWriteException;
use MongoDB\Driver\Exception\ConnectionException;
use MongoDB\Driver\Exception\Exception;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\RuntimeException;
use MongoDB\Driver\Exception\WriteConcernException;
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
     * @param string|null $uri A mongodb:// connection URI
     * @param array|null $uriOptions Connection string options
     * @param array|null $driverOptions Any driver-specific options not included in MongoDB connection spec.
     * @throws InvalidArgumentException on argument parsing errors
     * @throws RuntimeException if the uri format is invalid
     */
    final public function __construct(?string $uri = null, ?array $uriOptions = null, ?array $driverOptions = null) {}

    final public function __wakeup() {}

    /**
     * Return a ClientEncryption instance.
     * @link https://php.net/manual/en/mongodb-driver-manager.createclientencryption.php
     * @param array $options options Option Type Description keyVaultClient MongoDB\Driver\Manager
     * The Manager used to route data key queries to a separate MongoDB cluster. By default, the
     * current Manager and cluster is used. keyVaultNamespace string A fully qualified namespace
     * (e.g. "databaseName.collectionName") denoting the collection that contains all data keys used
     * for encryption and decryption. This option is required. kmsProviders array A document
     * containing the configuration for one or more KMS providers, which are used to encrypt data
     * keys. Supported providers include "aws", "azure", "gcp", "kmip", and "local" and at least one
     * must be specified. If an empty document is specified for "aws", "azure", or "gcp", the driver
     * will attempt to configure the provider using Automatic Credentials. The format for "aws" is
     * as follows: aws: { accessKeyId: <string>, secretAccessKey: <string>, sessionToken: <optional
     * string> } The format for "azure" is as follows: azure: { tenantId: <string>, clientId:
     * <string>, clientSecret: <string>, identityPlatformEndpoint: <optional string> // Defaults to
     * "login.microsoftonline.com" } The format for "gcp" is as follows: gcp: { email: <string>,
     * privateKey: <base64 string>|<MongoDB\BSON\Binary>, endpoint: <optional string> // Defaults to
     * "oauth2.googleapis.com" } The format for "kmip" is as follows: kmip: { endpoint: <string> }
     * The format for "local" is as follows: local: { // 96-byte master key used to encrypt/decrypt
     * data keys key: <base64 string>|<MongoDB\BSON\Binary> } tlsOptions array A document containing
     * the TLS configuration for one or more KMS providers. Supported providers include "aws",
     * "azure", "gcp", and "kmip". All providers support the following options: <provider>: {
     * tlsCaFile: <optional string>, tlsCertificateKeyFile: <optional string>,
     * tlsCertificateKeyFilePassword: <optional string>, tlsDisableOCSPEndpointCheck: <optional
     * bool> }
     * @return \MongoDB\Driver\ClientEncryption Returns a new MongoDB\Driver\ClientEncryption
     * instance.
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors.
     * @throws \MongoDB\Driver\Exception\RuntimeException If the extension was compiled without libmongocrypt support.
     */
    final public function createClientEncryption(array $options) {}

    /**
     * Execute one or more write operations
     * @link https://php.net/manual/en/mongodb-driver-manager.executebulkwrite.php
     * @param string $namespace A fully qualified namespace (databaseName.collectionName)
     * @param BulkWrite $bulk The MongoDB\Driver\BulkWrite to execute.
     * @param array|null $options WriteConcern type for backwards compatibility
     * @throws InvalidArgumentException on argument parsing errors.
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws AuthenticationException if authentication is needed and fails
     * @throws BulkWriteException on any write failure
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @since 1.4.0 added $options argument
     */
    final public function executeBulkWrite(string $namespace, BulkWrite $bulk, array|null $options = null): WriteResult {}

    /**
     * Execute write operations using the bulkWrite command
     * @link https://php.net/manual/en/mongodb-driver-server.executebulkwritecommand.php
     * @param BulkWriteCommand $bulkWriteCommand The write(s) to execute.
     * @param array|null $options options Option Type Description session MongoDB\Driver\Session A
     * session to associate with the operation. writeConcern MongoDB\Driver\WriteConcern A write
     * concern to apply to the operation.
     * @throws BulkWriteCommandException on any write failure (e.g. write error, failure to apply a write concern).
     * @throws InvalidArgumentException on argument parsing errors.
     * @throws ConnectionException if connection to the server fails (for reasons other than authentication).
     * @throws AuthenticationException if authentication is needed and fails.
     * @throws RuntimeException on other errors.
     * @return BulkWriteCommandResult Returns MongoDB\Driver\BulkWriteCommandResult on success.
     * @since 2.1.0
     */
    final public function executeBulkWriteCommand(BulkWriteCommand $bulkWriteCommand, ?array $options = null): BulkWriteCommandResult {}

    /**
     * @link https://php.net/manual/en/mongodb-driver-manager.executecommand.php
     * @param string $db The name of the database on which to execute the command.
     * @param Command $command The command document.
     * @param array|null $options ReadPreference type for backwards compatibility
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @throws BulkWriteException on Write Error
     * @throws WriteConcernException on Write Concern failure
     * @since 1.4.0 added $options argument
     */
    final public function executeCommand(string $db, Command $command, array|null $options = null): CursorInterface {}

    /**
     * Execute a MongoDB query
     * @link https://php.net/manual/en/mongodb-driver-manager.executequery.php
     * @param string $namespace A fully qualified namespace (databaseName.collectionName)
     * @param Query $query A MongoDB\Driver\Query to execute.
     * @param array|null $options ReadPreference type for backwards compatibility
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @since 1.4.0 added $options argument
     */
    final public function executeQuery(string $namespace, Query $query, array|null $options = null): CursorInterface {}

    /**
     * @link https://php.net/manual/en/mongodb-driver-manager.executereadcommand.php
     * @param string $db The name of the database on which to execute the command that reads.
     * @param Command $command The command document.
     * @param array|null $options options Option Type Description readConcern
     * MongoDB\Driver\ReadConcern A read concern to apply to the operation. This option is available
     * in MongoDB 3.2+ and will result in an exception at execution time if specified for an older
     * server version. readPreference MongoDB\Driver\ReadPreference A read preference to use for
     * selecting a server for the operation. session MongoDB\Driver\Session A session to associate
     * with the operation. If you are using a "session" which has a transaction in progress, you
     * cannot specify a "readConcern" or "writeConcern" option. This will result in an
     * MongoDB\Driver\Exception\InvalidArgumentException being thrown. Instead, you should set these
     * two options when you create the transaction with MongoDB\Driver\Session::startTransaction.
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @throws BulkWriteException on Write Error
     * @throws WriteConcernException on Write Concern failure
     * @since 1.4.0
     */
    final public function executeReadCommand(string $db, Command $command, ?array $options = null): CursorInterface {}

    /**
     * @link https://php.net/manual/en/mongodb-driver-manager.executereadwritecommand.php
     * @param string $db The name of the database on which to execute the command that reads.
     * @param Command $command The command document.
     * @param array|null $options options Option Type Description readConcern
     * MongoDB\Driver\ReadConcern A read concern to apply to the operation. This option is available
     * in MongoDB 3.2+ and will result in an exception at execution time if specified for an older
     * server version. session MongoDB\Driver\Session A session to associate with the operation.
     * writeConcern MongoDB\Driver\WriteConcern A write concern to apply to the operation. If you
     * are using a "session" which has a transaction in progress, you cannot specify a "readConcern"
     * or "writeConcern" option. This will result in an
     * MongoDB\Driver\Exception\InvalidArgumentException being thrown. Instead, you should set these
     * two options when you create the transaction with MongoDB\Driver\Session::startTransaction.
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @throws BulkWriteException on Write Error
     * @throws WriteConcernException on Write Concern failure
     * @since 1.4.0
     */
    final public function executeReadWriteCommand(string $db, Command $command, ?array $options = null): CursorInterface {}

    /**
     * @link https://php.net/manual/en/mongodb-driver-manager.executewritecommand.php
     * @param string $db The name of the database on which to execute the command that writes.
     * @param Command $command The command document.
     * @param array|null $options options Option Type Description session MongoDB\Driver\Session A
     * session to associate with the operation. writeConcern MongoDB\Driver\WriteConcern A write
     * concern to apply to the operation. If you are using a "session" which has a transaction in
     * progress, you cannot specify a "readConcern" or "writeConcern" option. This will result in an
     * MongoDB\Driver\Exception\InvalidArgumentException being thrown. Instead, you should set these
     * two options when you create the transaction with MongoDB\Driver\Session::startTransaction.
     * @throws Exception
     * @throws AuthenticationException if authentication is needed and fails
     * @throws ConnectionException if connection to the server fails for other then authentication reasons
     * @throws RuntimeException on other errors (invalid command, command arguments, ...)
     * @throws BulkWriteException on Write Error
     * @throws WriteConcernException on Write Concern failure
     * @since 1.4.0
     */
    final public function executeWriteCommand(string $db, Command $command, ?array $options = null): CursorInterface {}

    /**
     * Return the encryptedFieldsMap auto encryption option for the Manager
     * @link https://www.php.net/manual/en/mongodb-driver-manager.getencryptedfieldsmap.php
     * @since 1.14.0
     */
    final public function getEncryptedFieldsMap(): array|object|null {}

    /**
     * Return the ReadConcern for the Manager
     * @link https://php.net/manual/en/mongodb-driver-manager.getreadconcern.php
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function getReadConcern(): ReadConcern {}

    /**
     * Return the ReadPreference for the Manager
     * @link https://php.net/manual/en/mongodb-driver-manager.getreadpreference.php
     * @throws InvalidArgumentException
     * @return ReadPreference The MongoDB\Driver\ReadPreference for the Manager.
     */
    final public function getReadPreference(): ReadPreference {}

    /**
     * Return the servers to which this manager is connected
     * @link https://php.net/manual/en/mongodb-driver-manager.getservers.php
     * @throws InvalidArgumentException on argument parsing errors
     * @return Server[] Returns an array of MongoDB\Driver\Server instances to which this manager is
     * connected.
     */
    final public function getServers(): array {}

    /**
     * Return the WriteConcern for the Manager
     * @link https://php.net/manual/en/mongodb-driver-manager.getwriteconcern.php
     * @throws InvalidArgumentException on argument parsing errors.
     * @return WriteConcern The MongoDB\Driver\WriteConcern for the Manager.
     */
    final public function getWriteConcern(): WriteConcern {}

    /**
     * Preselect a MongoDB node based on provided readPreference. This can be useful to guarantee a command runs on a specific server when operating in a mixed version cluster.
     * https://secure.php.net/manual/en/mongodb-driver-manager.selectserver.php
     * @param ReadPreference|null $readPreference Optionally, a MongoDB\Driver\ReadPreference to route the command to. If none given, defaults to the Read Preferences set by the MongoDB Connection URI.
     * @throws InvalidArgumentException on argument parsing errors.
     * @throws ConnectionException if connection to the server fails (for reasons other than authentication).
     * @throws AuthenticationException if authentication is needed and fails.
     * @throws RuntimeException if a server matching the read preference could not be found.
     * @return Server Returns a MongoDB\Driver\Server matching the read preference.
     */
    final public function selectServer(?ReadPreference $readPreference = null) {}

    /**
     * Start a new client session for use with this client
     * @param array|null $options options Option Type Description Default causalConsistency bool
     * Configure causal consistency in a session. If true, each operation in the session will be
     * causally ordered after the previous read or write operation. Set to false to disable causal
     * consistency. See Causal Consistency in the MongoDB manual for more information. true
     * defaultTransactionOptions array Default options to apply to newly created transactions. These
     * options are used unless they are overridden when a transaction is started with different
     * value for each option. options Option Type Description maxCommitTimeMS integer The maximum
     * amount of time in milliseconds to allow a single commitTransaction command to run. If
     * specified, maxCommitTimeMS must be a signed 32-bit integer greater than or equal to zero.
     * readConcern MongoDB\Driver\ReadConcern A read concern to apply to the operation. This option
     * is available in MongoDB 3.2+ and will result in an exception at execution time if specified
     * for an older server version. readPreference MongoDB\Driver\ReadPreference A read preference
     * to use for selecting a server for the operation. writeConcern MongoDB\Driver\WriteConcern A
     * write concern to apply to the operation. This option is available in MongoDB 4.0+. []
     * snapshot bool Configure snapshot reads in a session. If true, a timestamp will be obtained
     * from the first supported read operation in the session (i.e. find, aggregate, or unsharded
     * distinct). Subsequent read operations within the session will then utilize a "snapshot" read
     * concern level to read majority-committed data from that timestamp. Set to false to disable
     * snapshot reads. Snapshot reads require MongoDB 5.0+ and cannot be used with causal
     * consistency, transactions, or write operations. If "snapshot" is true, "causalConsistency"
     * will default to false. See Read Concern "snapshot" in the MongoDB manual for more
     * information. false
     * @return \MongoDB\Driver\Session Returns a MongoDB\Driver\Session.
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors
     * @throws \MongoDB\Driver\Exception\RuntimeException If the session could not be created (e.g. libmongoc does not support crypto).
     * @link https://secure.php.net/manual/en/mongodb-driver-manager.startsession.php
     * @since 1.4.0
     */
    final public function startSession(?array $options = null) {}

    /**
     * Registers a monitoring event subscriber with this Manager
     * @link https://www.php.net/manual/en/mongodb-driver-manager.addsubscriber.php
     * @since 1.10.0
     */
    final public function addSubscriber(Subscriber $subscriber): void {}

    /**
     * Unregisters a monitoring event subscriber with this Manager
     * @link https://www.php.net/manual/en/mongodb-driver-manager.removesubscriber.php
     * @since 1.10.0
     */
    final public function removeSubscriber(Subscriber $subscriber): void {}
}
