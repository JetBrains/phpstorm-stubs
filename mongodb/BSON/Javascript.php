<?php

namespace MongoDB\BSON;

use JsonSerializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\UnexpectedValueException;

/**
 * Class Javascript
 * @link https://php.net/manual/en/class.mongodb-bson-javascript.php
 */
final class Javascript implements Type, JavascriptInterface, \Serializable, JsonSerializable
{
    /**
     * Construct a new Javascript
     * @link https://php.net/manual/en/mongodb-bson-javascript.construct.php
     * @param string $javascript
     * @param array|object $scope
     */
    final public function __construct($javascript, $scope = []) {}

    public static function __set_state(array $properties) {}

    /**
     * Returns the Javascript's code
     * @return string
     * @link https://secure.php.net/manual/en/mongodb-bson-javascript.getcode.php
     */
    final public function getCode() {}

    /**
     * Returns the Javascript's scope document
     * @return object|null
     * @link https://secure.php.net/manual/en/mongodb-bson-javascript.getscope.php
     */
    final public function getScope() {}

    /**
     * Returns the Javascript's code
     * @return string
     * @link https://secure.php.net/manual/en/mongodb-bson-javascript.tostring.php
     */
    final public function __toString() {}

    /**
     * Serialize a Javascript
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-javascript.serialize.php
     * @return string
     * @throws InvalidArgumentException
     */
    final public function serialize() {}

    /**
     * Unserialize a Javascript
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-javascript.unserialize.php
     * @param string $serialized
     * @return void
     * @throws InvalidArgumentException on argument parsing errors or if the properties are invalid
     * @throws UnexpectedValueException if the properties cannot be unserialized (i.e. serialized was malformed)
     */
    final public function unserialize($serialized) {}

    /**
     * Returns a representation that can be converted to JSON
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-javascript.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     * @throws InvalidArgumentException on argument parsing errors
     */
    final public function jsonSerialize() {}
}
