<?php

namespace MongoDB\Driver\Exception;

use MongoDB\Driver\WriteResult;

/**
 * Thrown when a bulk write operation fails.
 * @link https://php.net/manual/en/class.mongodb-driver-exception-bulkwriteexception.php
 * @since 1.0.0
 */
class BulkWriteException extends ServerException implements Exception
{
    /**
     * @var WriteResult associated with the failed write operation.
     */
    protected $writeResult;

    /**
     * @return WriteResult for the failed write operation
     * @since 1.0.0
     */
    final public function getWriteResult(): WriteResult {}
}
