<?php

namespace MongoDB\Driver;

use MongoDB\Driver\Exception\InvalidArgumentException;

/**
 * The MongoDB\Driver\Cursor class encapsulates the results of a MongoDB command or query and may be returned by MongoDB\Driver\Manager::executeCommand() or MongoDB\Driver\Manager::executeQuery(), respectively.
 * @link https://php.net/manual/en/class.mongodb-driver-cursor.php
 */
final class Cursor implements CursorInterface, \Iterator
{
    /**
     * Create a new Cursor
     * MongoDB\Driver\Cursor objects are returned as the result of an executed command or query and cannot be constructed directly.
     * @link https://php.net/manual/en/mongodb-driver-cursor.construct.php
     */
    final private function __construct() {}

    final public function __wakeup() {}

    /**
     * Returns the current element.
     * @link https://www.php.net/manual/en/mongodb-driver-cursor.current.php
     * @return array|object
     */
    public function current() {}

    /**
     * Returns the MongoDB\Driver\CursorId associated with this cursor. A cursor ID cursor uniquely identifies the cursor on the server.
     * @link https://php.net/manual/en/mongodb-driver-cursor.getid.php
     * @return CursorId for this Cursor
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function getId() {}

    /**
     * Returns the MongoDB\Driver\Server associated with this cursor. This is the server that executed the query or command.
     * @link https://php.net/manual/en/mongodb-driver-cursor.getserver.php
     * @return Server for this Cursor
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function getServer() {}

    /**
     * Checks if a cursor is still alive
     * @link https://php.net/manual/en/mongodb-driver-cursor.isdead.php
     * @return bool
     * @throws InvalidArgumentException On argument parsing errors
     */
    final public function isDead() {}

    /**
     * Returns the current result's index within the cursor.
     * @link https://www.php.net/manual/en/mongodb-driver-cursor.key.php
     * @return int
     */
    public function key() {}

    /**
     * Advances the cursor to the next result.
     * @link https://www.php.net/manual/en/mongodb-driver-cursor.next.php
     * @return void
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException on argument parsing errors.
     * @throws \MongoDB\Driver\Exception\ConnectionException if connection to the server fails (for reasons other than authentication).
     * @throws \MongoDB\Driver\Exception\AuthenticationException if authentication is needed and fails.
     */
    public function next() {}

    /**
     * Rewind the cursor to the first result.
     * @link https://www.php.net/manual/en/mongodb-driver-cursor.rewind.php
     * @return void
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException on argument parsing errors.
     * @throws \MongoDB\Driver\Exception\ConnectionException if connection to the server fails (for reasons other than authentication).
     * @throws \MongoDB\Driver\Exception\AuthenticationException if authentication is needed and fails.
     * @throws \MongoDB\Driver\Exception\LogicException if this method is called after the cursor has advanced beyond its first position.
     */
    public function rewind() {}

    /**
     * Sets a type map to use for BSON unserialization
     *
     * @link https://php.net/manual/en/mongodb-driver-cursor.settypemap.php
     *
     * @param array $typemap
     * @return void
     * @throws InvalidArgumentException On argument parsing errors or if a class in the type map cannot
     * be instantiated or does not implement MongoDB\BSON\Unserializable
     */
    final public function setTypeMap(array $typemap) {}

    /**
     * Returns an array of all result documents for this cursor
     * @link https://php.net/manual/en/mongodb-driver-cursor.toarray.php
     * @return array
     * @throws InvalidArgumentException On argument parsing errors
     */
    final public function toArray() {}

    /**
     * Checks if the current position in the cursor is valid.
     * @link https://www.php.net/manual/en/mongodb-driver-cursor.valid.php
     * @return bool
     */
    public function valid() {}
}
