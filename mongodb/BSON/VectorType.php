<?php

namespace MongoDB\BSON;

/**
 * @since 2.2.0
 * @link https://php.net/manual/en/enum.mongodb-bson-vectortype.php
 */
enum VectorType
{
    case Float32;
    case Int8;
    case PackedBit;
}
