<?php

namespace MongoDB\BSON;

use JsonSerializable;
use MongoDB\Driver\Exception\InvalidArgumentException;

/**
 * Class MinKey
 * @link https://php.net/manual/en/class.mongodb-bson-minkey.php
 */
final class MinKey implements Type, MinKeyInterface, JsonSerializable
{
    public static function __set_state(array $properties): self {}

    /**
     * Returns a representation that can be converted to JSON
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-minkey.jsonserialize.php
     * @return mixed data which can be serialized by json_encode()
     * @throws InvalidArgumentException on argument parsing errors
     */
    final public function jsonSerialize(): mixed {}
}
