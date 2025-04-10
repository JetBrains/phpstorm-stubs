<?php

namespace MongoDB\Driver;

use MongoDB\BSON\Serializable;
use stdClass;

/**
 * MongoDB\Driver\ReadConcern controls the level of isolation for read operations for replica sets and replica set shards. This option requires the WiredTiger storage engine and MongoDB 3.2 or later.
 * @link https://php.net/manual/en/class.mongodb-driver-readconcern.php
 * @since 1.1.0
 */
final class ReadConcern implements Serializable
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
     * @since 1.11.0
     */
    public const SNAPSHOT = 'snapshot';

    /**
     * Construct immutable ReadConcern
     * @link https://php.net/manual/en/mongodb-driver-readconcern.construct.php
     */
    final public function __construct(?string $level = null) {}

    public static function __set_state(array $properties) {}

    /**
     * Returns the ReadConcern's "level" option
     * @link https://php.net/manual/en/mongodb-driver-readconcern.getlevel.php
     * @return string|null
     * @since 1.0.0
     */
    final public function getLevel(): ?string {}

    /**
     * Returns an object for BSON serialization
     * @link https://php.net/manual/en/mongodb-driver-readconcern.bsonserialize.php
     * @since 1.2.0
     */
    final public function bsonSerialize(): stdClass {}

    /**
     * Checks if this is the default read concern
     * @link https://secure.php.net/manual/en/mongodb-driver-readconcern.isdefault.php
     * @since 1.3.0
     * @throws \MongoDB\Driver\Exception\InvalidArgumentException On argument parsing errors.
     */
    final public function isDefault(): bool {}
}
