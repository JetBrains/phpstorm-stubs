<?php

namespace MongoDB\BSON;

use JsonSerializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use Stringable;

/**
 * Class ObjectId
 * @link https://php.net/manual/en/class.mongodb-bson-objectid.php
 */
final class ObjectId implements Type, ObjectIdInterface, JsonSerializable, Stringable
{
    /**
     * Construct a new ObjectId
     * @link https://php.net/manual/en/mongodb-bson-objectid.construct.php
     * @param string|null $id A 24-character hexadecimal string. If not provided, the driver will generate an ObjectId.
     * @throws InvalidArgumentException if id is not a 24-character hexadecimal string.
     */
    final public function __construct(?string $id = null) {}

    /**
     * Returns the hexadecimal representation of this ObjectId
     * @link https://php.net/manual/en/mongodb-bson-objectid.tostring.php
     */
    final public function __toString(): string {}

    public static function __set_state(array $properties): self {}

    /**
     * Returns the timestamp component of this ObjectId
     * @since 1.2.0
     * @link https://secure.php.net/manual/en/mongodb-bson-objectid.gettimestamp.php
     * @return int the timestamp component of this ObjectId
     */
    final public function getTimestamp(): int {}

    /**
     * Returns a representation that can be converted to JSON
     * @since 1.2.0
     * @link https://secure.php.net/manual/en/mongodb-bson-objectid.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     */
    final public function jsonSerialize(): mixed {}
}
