<?php

namespace MongoDB\Driver;

/**
 * The MongoDB\Driver\WriteConcernError class encapsulates information about a write concern error and may be returned by MongoDB\Driver\WriteResult::getWriteConcernError().
 * @link https://php.net/manual/en/class.mongodb-driver-writeconcernerror.php
 */
final class WriteConcernError
{
    final private function __construct() {}

    final public function __wakeup() {}

    /**
     * Returns the WriteConcernError's error code
     * @link https://php.net/manual/en/mongodb-driver-writeconcernerror.getcode.php
     * @return int
     */
    final public function getCode() {}

    /**
     * Returns additional metadata for the WriteConcernError
     * @link https://php.net/manual/en/mongodb-driver-writeconcernerror.getinfo.php
     * @return mixed
     */
    final public function getInfo() {}

    /**
     * Returns the WriteConcernError's error message
     * @link https://php.net/manual/en/mongodb-driver-writeconcernerror.getmessage.php
     * @return string
     */
    final public function getMessage() {}
}
