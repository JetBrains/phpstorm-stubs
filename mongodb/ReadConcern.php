<?php

namespace MongoDB\Driver;

use MongoDB\BSON\Serializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\UnexpectedValueException;

/**
 * MongoDB\Driver\ReadConcern controls the level of isolation for read operations for replica sets and replica set shards. This option requires the WiredTiger storage engine and MongoDB 3.2 or later.
 * @link https://php.net/manual/en/class.mongodb-driver-readconcern.php
 * @since 1.1.0
 */
final class ReadConcern implements Serializable, \Serializable
{
    /**
     * @since 1.2.0
     */
    public const LINEARIZABLE = 'linearizable';
    public const LOCAL = 'local';
    public const MAJORITY = 'majority';

    /**
     * @since 1.4.0
     */
    public const AVAILABLE = 'available';

    /**
     * Construct immutable ReadConcern
     * @link https://php.net/manual/en/mongodb-driver-readconcern.construct.php
     * @param string $level
     */
    final public function __construct($level = null) {}

    public static function __set_state(array $properties) {}

    /**
     * Returns the ReadConcern's "level" option
     * @link https://php.net/manual/en/mongodb-driver-readconcern.getlevel.php
     * @return string|null
     * @since 1.0.0
     */
    final public function getLevel() {}

    /**
     * Returns an object for BSON serialization
     * @link https://php.net/manual/en/mongodb-driver-readconcern.bsonserialize.php
     * @return object
     * @since 1.2.0
     */
    final public function bsonSerialize() {}

    /**
     * Checks if this is the default read concern
     * @link https://secure.php.net/manual/en/mongodb-driver-readconcern.isdefault.php
     * @return bool
     * @since 1.3.0
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors.
     */
    final public function isDefault() {}

    /**
     * Serialize a ReadConcern
     * @since 1.7.0
     * @link https://php.net/manual/en/mongodb-driver-readconcern.serialize.php
     * @return string
     * @throws InvalidArgumentException
     */
    final public function serialize() {}

    /**
     * Unserialize a ReadConcern
     * @since 1.7.0
     * @link https://php.net/manual/en/mongodb-driver-readconcern.unserialize.php
     * @param string $serialized
     * @return void
     * @throws InvalidArgumentException on argument parsing errors or if the properties are invalid
     * @throws UnexpectedValueException if the properties cannot be unserialized (i.e. serialized was malformed)
     */
    final public function unserialize($serialized) {}
}
