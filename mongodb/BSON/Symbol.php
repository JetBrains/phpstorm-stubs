<?php

namespace MongoDB\BSON;

use JetBrains\PhpStorm\Deprecated;
use JsonSerializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use Stringable;

/**
 * BSON type for the "Symbol" type. This BSON type is deprecated, and this class can not be instantiated. It will be created from a
 * BSON symbol type while converting BSON to PHP, and can also be converted back into BSON while storing documents in the database.
 *
 * @link https://secure.php.net/manual/en/class.mongodb-bson-symbol.php
 */
#[Deprecated]
final class Symbol implements JsonSerializable, Type, Stringable
{
    final private function __construct() {}

    /**
     * Returns a representation that can be converted to JSON
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-bson-symbol.jsonserialize.php
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
