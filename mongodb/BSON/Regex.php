<?php

namespace MongoDB\BSON;

use JsonSerializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\UnexpectedValueException;

/**
 * Class Regex
 * @link https://php.net/manual/en/class.mongodb-bson-regex.php
 */
final class Regex implements Type, RegexInterface, \Serializable, JsonSerializable
{
    /**
     * Construct a new Regex
     * @link https://php.net/manual/en/mongodb-bson-regex.construct.php
     * @param string $pattern
     * @param string $flags [optional]
     */
    final public function __construct($pattern, $flags = "") {}

    /**
     * Returns the Regex's flags
     * @link https://php.net/manual/en/mongodb-bson-regex.getflags.php
     */
    final public function getFlags() {}

    /**
     * Returns the Regex's pattern
     * @link https://php.net/manual/en/mongodb-bson-regex.getpattern.php
     * @return string
     */
    final public function getPattern() {}

    /**
     * Returns the string representation of this Regex
     * @link https://php.net/manual/en/mongodb-bson-regex.tostring.php
     * @return string
     */
    final public function __toString() {}

    public static function __set_state(array $properties) {}

    /**
     * Serialize a Regex
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-regex.serialize.php
     * @return string
     * @throws InvalidArgumentException
     */
    final public function serialize() {}

    /**
     * Unserialize a Regex
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-regex.unserialize.php
     * @param string $serialized
     * @return void
     * @throws InvalidArgumentException on argument parsing errors or if the properties are invalid
     * @throws UnexpectedValueException if the properties cannot be unserialized (i.e. serialized was malformed)
     */
    final public function unserialize($serialized) {}

    /**
     * Returns a representation that can be converted to JSON
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-regex.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     * @throws InvalidArgumentException on argument parsing errors
     */
    final public function jsonSerialize() {}
}
