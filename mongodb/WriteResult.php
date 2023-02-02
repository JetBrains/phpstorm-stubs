<?php

namespace MongoDB\Driver;

/**
 * The MongoDB\Driver\WriteResult class encapsulates information about an executed MongoDB\Driver\BulkWrite and may be returned by MongoDB\Driver\Manager::executeBulkWrite().
 * @link https://php.net/manual/en/class.mongodb-driver-writeresult.php
 */
final class WriteResult
{
    final private function __construct() {}

    final public function __wakeup() {}

    /**
     * Returns the number of documents deleted
     * @link https://php.net/manual/en/mongodb-driver-writeresult.getdeletedcount.php
     * @return int|null
     */
    final public function getDeletedCount() {}

    /**
     * Returns the number of documents inserted (excluding upserts)
     * @link https://php.net/manual/en/mongodb-driver-writeresult.getinsertedcount.php
     * @return int|null
     */
    final public function getInsertedCount() {}

    /**
     * Returns the number of documents selected for update
     * @link https://php.net/manual/en/mongodb-driver-writeresult.getmatchedcount.php
     * @return int|null
     */
    final public function getMatchedCount() {}

    /**
     * Returns the number of existing documents updated
     * @link https://php.net/manual/en/mongodb-driver-writeresult.getmodifiedcount.php
     * @return int|null
     */
    final public function getModifiedCount() {}

    /**
     * Returns the server associated with this write result
     * @link https://php.net/manual/en/mongodb-driver-writeresult.getserver.php
     * @return Server
     */
    final public function getServer() {}

    /**
     * Returns the number of documents inserted by an upsert
     * @link https://php.net/manual/en/mongodb-driver-writeresult.getupsertedcount.php
     * @return int|null
     */
    final public function getUpsertedCount() {}

    /**
     * Returns an array of identifiers for upserted documents
     * @link https://php.net/manual/en/mongodb-driver-writeresult.getupsertedids.php
     * @return array
     */
    final public function getUpsertedIds() {}

    /**
     * Returns any write concern error that occurred
     * @link https://php.net/manual/en/mongodb-driver-writeresult.getwriteconcernerror.php
     * @return WriteConcernError|null
     */
    final public function getWriteConcernError() {}

    /**
     * Returns any write errors that occurred
     * @link https://php.net/manual/en/mongodb-driver-writeresult.getwriteerrors.php
     * @return WriteError[]
     */
    final public function getWriteErrors() {}

    /**
     * Returns whether the write was acknowledged
     * @link https://php.net/manual/en/mongodb-driver-writeresult.isacknowledged.php
     * @return bool
     */
    final public function isAcknowledged() {}
}
