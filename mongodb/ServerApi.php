<?php

namespace MongoDB\Driver;

use MongoDB\BSON\Serializable;
use stdClass;

final class ServerApi implements Serializable
{
    public const V1 = 1;

    final public function __construct(string $version, ?bool $strict = false, ?bool $deprecationErrors = false) {}

    public static function __set_state(array $properties) {}

    final public function bsonSerialize(): stdClass {}
}
