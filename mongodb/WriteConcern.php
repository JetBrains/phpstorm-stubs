<?php

namespace MongoDB\Driver;

use MongoDB\BSON\Serializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use stdClass;

/**
 * WriteConcern controls the acknowledgment of a write operation, specifies the level of write guarantee for Replica Sets.
 */
final class WriteConcern implements Serializable
{
    /**
     * Majority of all the members in the set; arbiters, non-voting members, passive members, hidden members and delayed members are all included in the definition of majority write concern.
     */
    public const MAJORITY = 'majority';

    /**
     * @since 2.3.0
     */
    public readonly string|int|null $w;

    /**
     * @since 2.3.0
     */
    public readonly bool|null $j;

    /**
     * @since 2.3.0
     */
    public readonly int $wtimeout;

    /**
     * Construct immutable WriteConcern
     * @link https://php.net/manual/en/mongodb-driver-writeconcern.construct.php
     * @param string|int $w Write concern Value Description 1 Requests acknowledgement that the
     * write operation has propagated to the standalone mongod or the primary in a replica set. This
     * is the default write concern for MongoDB. 0 Requests no acknowledgment of the write
     * operation. However, this may return information about socket exceptions and networking errors
     * to the application. <integer greater than 1> Numbers greater than 1 are valid only for
     * replica sets to request acknowledgement from specified number of members, including the
     * primary. MongoDB\Driver\WriteConcern::MAJORITY Requests acknowledgment that write operations
     * have propagated to the majority of voting nodes, including the primary, and have been written
     * to the on-disk journal for these nodes. Prior to MongoDB 3.0, this refers to the majority of
     * replica set members (not just voting nodes). string A string value is interpereted as a tag
     * set. Requests acknowledgement that the write operations have propagated to a replica set
     * member with the specified tag.
     * @param int|null $wtimeout How long to wait (in milliseconds) for secondaries before failing.
     * @param bool|null $journal Wait until mongod has applied the write to the journal.
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function __construct(string|int $w, ?int $wtimeout = null, ?bool $journal = null) {}

    public static function __set_state(array $properties) {}

    /**
     * Returns the WriteConcern's "journal" option
     * @link https://php.net/manual/en/mongodb-driver-writeconcern.getjournal.php
     */
    final public function getJournal(): ?bool {}

    /**
     * Returns the WriteConcern's "w" option
     * @link https://php.net/manual/en/mongodb-driver-writeconcern.getw.php
     */
    final public function getW(): string|int|null {}

    /**
     * Returns the WriteConcern's "wtimeout" option
     * @link https://php.net/manual/en/mongodb-driver-writeconcern.getwtimeout.php
     */
    final public function getWtimeout(): int {}

    /**
     * Returns an object for BSON serialization
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-driver-writeconcern.bsonserialize.php
     * @return array|object Returns an object for serializing the WriteConcern as BSON.
     * @throws InvalidArgumentException
     */
    final public function bsonSerialize(): stdClass {}

    final public function isDefault(): bool {}
}
