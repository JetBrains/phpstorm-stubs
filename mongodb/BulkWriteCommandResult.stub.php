<?php

namespace MongoDB\Driver;

use MongoDB\BSON\Document;
use MongoDB\Driver\Exception\LogicException;

/**
 * The MongoDB\Driver\BulkWriteCommandResult class encapsulates information
 * about an executed MongoDB\Driver\BulkWriteCommand and is returned by
 * MongoDB\Driver\Manager::executeBulkWriteCommand().
 * @since 2.1.0
 */
final class BulkWriteCommandResult
{
    final private function __construct() {}

    /**
     * Returns the number of documents inserted
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandresult.getinsertedcount.php
     * @throws LogicException if the write was not acknowledged.
     * @return int Returns the total number of documents inserted (excluding upserts) by all operations.
     */
    final public function getInsertedCount(): int {}

    /**
     * Returns the number of documents selected for update
     *
     * If the update operation results in no change to the document (e.g. setting the value of a field to its current value), the matched count may be greater than the value returned by MongoDB\Driver\BulkWriteCommandResult::getModifiedCount().
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandresult.getmatchedcount.php
     * @throws LogicException if the write was not acknowledged.
     * @return int Returns the total number of documents selected for update by all operations.
     */
    final public function getMatchedCount(): int {}

    /**
     * Returns the number of existing documents updated
     *
     * If the update operation results in no change to the document (e.g. setting the value of a field to its current value), the modified count may be less than the value returned by MongoDB\Driver\BulkWriteCommandResult::getMatchedCount().
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandresult.getmodifiedcount.php
     * @throws LogicException if the write was not acknowledged.
     * @return int Returns the total number of existing documents updated by all operations.
     */
    final public function getModifiedCount(): int {}

    /**
     * Returns the number of documents upserted
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandresult.getupsertedcount.php
     * @throws LogicException if the write was not acknowledged.
     * @return int Returns the total number of documents upserted by all operations.
     */
    final public function getUpsertedCount(): int {}

    /**
     * Returns the number of documents deleted
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandresult.getdeletedcount.php
     * @throws LogicException if the write was not acknowledged.
     * @return int Returns the total number of documents deleted by all operations.
     */
    final public function getDeletedCount(): int {}

    /**
     * Returns verbose results for successful inserts
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandresult.getinsertresults.php
     * @throws LogicException if the write was not acknowledged.
     * @return Document|null Returns a document containing the result of each successful insert operation, or null if verbose results were not requested. The document keys will correspond to the index of the write operation from MongoDB\Driver\BulkWriteCommand.
     */
    final public function getInsertResults(): ?Document {}

    /**
     * Returns verbose results for successful updates
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandresult.getupdateresults.php
     * @throws LogicException if the write was not acknowledged.
     * @return Document|null Returns a document containing the result of each successful update operation, or null if verbose results were not requested. The document keys will correspond to the index of the write operation from MongoDB\Driver\BulkWriteCommand.
     */
    final public function getUpdateResults(): ?Document {}

    /**
     * Returns verbose results for successful deletes
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandresult.getdeleteresults.php
     * @return Document|null Returns a document containing the result of each successful delete operation, or null if verbose results were not requested. The document keys will correspond to the index of the write operation from MongoDB\Driver\BulkWriteCommand.
     * @throws LogicException if the write was not acknowledged.
     */
    final public function getDeleteResults(): ?Document {}

    /**
     * Returns whether the write was acknowledged
     *
     * If the write is acknowledged, other fields will be available on the MongoDB\Driver\BulkWriteCommandResult object.
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandresult.isacknowledged.php
     * @return bool Returns true if the write was acknowledged, and false otherwise.
     */
    final public function isAcknowledged(): bool {}
}
