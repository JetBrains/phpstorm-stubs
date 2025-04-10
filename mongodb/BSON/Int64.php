<?php

namespace MongoDB\BSON;

use JsonSerializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use Stringable;

/**
 * BSON type for a 64-bit integer.
 *
 * @since 1.5.0
 * @link https://secure.php.net/manual/en/class.mongodb-bson-int64.php
 */
final class Int64 implements Type, JsonSerializable, Stringable
{
    /** @since 1.16.0 */
    final public function __construct(string|int $value) {}

    public static function __set_state(array $properties): self {}

    /**
     * Returns a representation that can be converted to JSON
     * @link https://www.php.net/manual/en/mongodb-bson-int64.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     * @throws InvalidArgumentException on argument parsing errors
     */
    final public function jsonSerialize(): mixed {}

    /**
     * Returns the Symbol as a string
     * @return string Returns the string representation of this Symbol.
     */
    final public function __toString(): string {}
}
