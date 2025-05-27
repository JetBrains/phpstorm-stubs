<?php

namespace MongoDB\Driver\Exception;

use MongoDB\BSON\Document;
use MongoDB\Driver\BulkWriteCommandResult;

/**
 * Exception thrown due to failed execution of a MongoDB\Driver\BulkWriteCommand.
 * The methods of this class provide more details of the error that occurred,
 * including the error reply and partial results from the bulk write.
 * @since 2.1.0
 */
final class BulkWriteCommandException extends ServerException
{
    private ?Document $errorReply = null;
    private ?BulkWriteCommandResult $partialResult = null;
    private array $writeErrors = [];
    private array $writeConcernErrors = [];

    /**
     * Returns any top-level command error
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandexception.geterrorreply.php
     * @return Document|null Returns any top-level error that occurred when attempting to communicate with the server or execute the bulk write. This value may be null if the exception was thrown due to errors occurring on individual writes.
     */
    final public function getErrorReply(): ?Document {}

    /**
     * Returns the result of any successful write operations
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandexception.getpartialresult.php
     * @return BulkWriteCommandResult|null Returns a MongoDB\Driver\BulkWriteCommandResult reporting the result of any successful operations that were performed before the error was encountered. The return value will be null if it cannot be determined that at least one write was successfully performed (and acknowledged).
     */
    final public function getPartialResult(): ?BulkWriteCommandResult {}

    /**
     * Returns any write errors
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandexception.getwriteerrors.php
     * @return array An array of any MongoDB\Driver\WriteErrors that occurred during the execution of individual write operations. Array keys will correspond to the index of the write operation from MongoDB\Driver\BulkWriteCommand. This map will contain at most one entry if the bulk write was ordered.
     */
    final public function getWriteErrors(): array {}

    /**
     * Returns any write concern errors
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommandexception.getwriteconcernerrors.php
     * @return array An array of any MongoDB\Driver\WriteConcernErrors that occurred while executing the bulk write. This list may have multiple items if more than one server command was required to execute the bulk write.
     */
    final public function getWriteConcernErrors(): array {}
}
