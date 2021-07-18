<?php

namespace MongoDB\Driver;

final class ServerApi implements \MongoDB\BSON\Serializable, \Serializable
{
    public const V1 = 1;

    final public function __construct($version, $strict = false, $deprecationErrors = false) {}

    public static function __set_state($properties) {}

    final public function unserialize($serialized) {}

    final public function serialize() {}

    final public function bsonSerialize() {}
}
