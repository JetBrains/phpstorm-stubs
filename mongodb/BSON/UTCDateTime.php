<?php

namespace MongoDB\BSON;

use DateTimeInterface;
use JsonSerializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use Stringable;

/**
 * Represents a BSON date.
 * @link https://php.net/manual/en/class.mongodb-bson-utcdatetime.php
 */
final class UTCDateTime implements UTCDateTimeInterface, JsonSerializable, Type, Stringable
{
    /**
     * Construct a new UTCDateTime
     * @link https://php.net/manual/en/mongodb-bson-utcdatetime.construct.php
     */
    final public function __construct(int|DateTimeInterface|Int64|null $milliseconds = null) {}

    public static function __set_state(array $properties): self {}

    /**
     * Returns the DateTime representation of this UTCDateTime
     * @link https://php.net/manual/en/mongodb-bson-utcdatetime.todatetime.php
     */
    final public function toDateTime(): \DateTime {}

    /**
     * Returns the DateTimeImmutable representation of this UTCDateTime
     * @since 1.20.0
     * @link https://php.net/manual/en/mongodb-bson-utcdatetime.todatetimeimmutable.php
     */
    final public function toDateTimeImmutable(): \DateTimeImmutable {}

    /**
     * Returns the string representation of this UTCDateTime
     * @link https://php.net/manual/en/mongodb-bson-utcdatetime.tostring.php
     */
    final public function __toString(): string {}

    /**
     * Returns a representation that can be converted to JSON
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-utcdatetime.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     * @throws InvalidArgumentException on argument parsing errors
     */
    final public function jsonSerialize(): mixed {}
}
