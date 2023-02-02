<?php

namespace MongoDB\Driver;

use MongoDB\Driver\Exception\CommandException;
use MongoDB\Driver\Exception\InvalidArgumentException;

/**
 * Class Session
 *
 * @link https://secure.php.net/manual/en/class.mongodb-driver-session.php
 * @since 1.4.0
 */
final class Session
{
    /**
     * @since 1.7.0
     */
    public const TRANSACTION_NONE = 'none';

    /**
     * @since 1.7.0
     */
    public const TRANSACTION_STARTING = 'starting';

    /**
     * @since 1.7.0
     */
    public const TRANSACTION_IN_PROGRESS = 'in_progress';

    /**
     * @since 1.7.0
     */
    public const TRANSACTION_COMMITTED = 'committed';

    /**
     * @since 1.7.0
     */
    public const TRANSACTION_ABORTED = 'aborted';

    /**
     * Create a new Session (not used)
     * @link https://secure.php.net/manual/en/mongodb-driver-session.construct.php
     * @since 1.4.0
     */
    final private function __construct() {}

    final public function __wakeup() {}

    /**
     * Aborts a transaction
     * @link https://secure.php.net/manual/en/mongodb-driver-session.aborttransaction.php
     * @return void
     * @since 1.5.0
     */
    final public function abortTransaction() {}

    /**
     * Advances the cluster time for this session
     * @link https://secure.php.net/manual/en/mongodb-driver-session.advanceclustertime.php
     * @param array|object $clusterTime The cluster time is a document containing a logical timestamp and server signature
     * @return void
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors
     * @since 1.4.0
     */
    final public function advanceClusterTime($clusterTime) {}

    /**
     * Advances the operation time for this session
     * @link https://secure.php.net/manual/en/mongodb-driver-session.advanceoperationtime.php
     * @param \MongoDB\BSON\TimestampInterface $timestamp
     * @return void
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors
     * @since 1.4.0
     */
    final public function advanceOperationTime($timestamp) {}

    /**
     * @link https://secure.php.net/manual/en/mongodb-driver-session.committransaction.php
     * @return void
     * @throws InvalidArgumentException On argument parsing errors
     * @throws CommandException If the server could not commit the transaction (e.g. due to conflicts,
     * network issues). In case the exception's MongoDB\Driver\Exception\CommandException::getResultDocument() has a "errorLabels"
     * element, and this array contains a "TransientTransactionError" or "UnUnknownTransactionCommitResult" value, it is safe to
     * re-try the whole transaction. In newer versions of the driver, MongoDB\Driver\Exception\RuntimeException::hasErrorLabel()
     * should be used to test for this situation instead.
     * @throws \MongoDB\Driver\Exception\RuntimeException If the transaction could not be committed (e.g. a transaction was not started)
     * @since 1.5.0
     */
    final public function commitTransaction() {}

    /**
     * This method closes an existing session. If a transaction was associated with this session, this transaction is also aborted,
     * and all its operations are rolled back.
     *
     * @link https://secure.php.net/manual/en/mongodb-driver-session.endsession.php
     * @return void
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors
     * @since 1.5.0
     */
    final public function endSession() {}

    /**
     * Returns the cluster time for this session
     * @link https://secure.php.net/manual/en/mongodb-driver-session.getclustertime.php
     * @return object|null
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException
     * @since 1.4.0
     */
    final public function getClusterTime() {}

    /**
     * Returns the logical session ID for this session
     * @link https://secure.php.net/manual/en/mongodb-driver-session.getlogicalsessionid.php
     * @return object Returns the logical session ID for this session
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException
     * @since 1.4.0
     */
    final public function getLogicalSessionId() {}

    /**
     * Returns the operation time for this session, or NULL if the session has no operation time
     * @link https://secure.php.net/manual/en/mongodb-driver-session.getoperationtime.php
     * @return \MongoDB\BSON\Timestamp|null
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException
     * @since 1.4.0
     */
    final public function getOperationTime() {}

    /**
     * Returns the server to which this session is pinned, or NULL if the session is not pinned to any server.
     * @link https://secure.php.net/manual/en/mongodb-driver-session.getserver.php
     * @return \MongoDB\Driver\Server|null
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException
     * @since 1.6.0
     */
    final public function getServer() {}

    /**
     * Returns options for the current transactions, or NULL if no transaction is running.
     * @link https://secure.php.net/manual/en/mongodb-driver-session.gettransactionoptions.php
     * @return array|null
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException
     * @since 1.7.0
     */
    final public function getTransactionOptions() {}

    /**
     * Returns the current transaction state
     * @link https://secure.php.net/manual/en/mongodb-driver-session.gettransactionstate.php
     * @return string
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException
     * @since 1.7.0
     */
    final public function getTransactionState() {}

    /**
     * Returns whether a multi-document transaction is in progress.
     * @link https://secure.php.net/manual/en/mongodb-driver-session.isintransaction.php
     * @return bool
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException
     * @since 1.6.0
     */
    final public function isInTransaction() {}

    /**
     * Starts a transaction
     * @link https://secure.php.net/manual/en/mongodb-driver-session.starttransaction.php
     * @param array|object $options
     * @return void
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors
     * @throws \MongoDB\Driver\Exception\CommandException If the the transaction could not be started because of a server-side problem (e.g. a lock could not be obtained).
     * @throws \MongoDB\Driver\Exception\RuntimeException If the the transaction could not be started (e.g. a transaction was already started).
     * @since 1.4.0
     */
    final public function startTransaction(?array $options = []) {}
}
