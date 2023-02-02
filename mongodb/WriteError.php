<?php

namespace MongoDB\Driver;

/**
 * The MongoDB\Driver\WriteError class encapsulates information about a write error and may be returned as an array element from MongoDB\Driver\WriteResult::getWriteErrors().
 */
final class WriteError
{
    final private function __construct() {}

    final public function __wakeup() {}

    /**
     * Returns the WriteError's error code
     * @link https://php.net/manual/en/mongodb-driver-writeerror.getcode.php
     * @return int
     */
    final public function getCode() {}

    /**
     * Returns the index of the write operation corresponding to this WriteError
     * @link https://php.net/manual/en/mongodb-driver-writeerror.getindex.php
     * @return int
     */
    final public function getIndex() {}

    /**
     * Returns additional metadata for the WriteError
     * @link https://php.net/manual/en/mongodb-driver-writeerror.getinfo.php
     * @return mixed
     */
    final public function getInfo() {}

    /**
     * Returns the WriteError's error message
     * @link https://php.net/manual/en/mongodb-driver-writeerror.getmessage.php
     * @return string
     */
    final public function getMessage() {}
}
