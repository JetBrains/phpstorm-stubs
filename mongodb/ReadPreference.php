<?php

namespace MongoDB\Driver;

use MongoDB\BSON\Serializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\UnexpectedValueException;

/**
 * Class ReadPreference
 * @link https://php.net/manual/en/class.mongodb-driver-readpreference.php
 */
final class ReadPreference implements Serializable, \Serializable
{
    public const RP_PRIMARY = 1;
    public const RP_PRIMARY_PREFERRED = 5;
    public const RP_SECONDARY = 2;
    public const RP_SECONDARY_PREFERRED = 6;
    public const RP_NEAREST = 10;

    /**
     * @since 1.7.0
     */
    public const PRIMARY = 'primary';

    /**
     * @since 1.7.0
     */
    public const PRIMARY_PREFERRED = 'primaryPreferred';

    /**
     * @since 1.7.0
     */
    public const SECONDARY = 'secondary';

    /**
     * @since 1.7.0
     */
    public const SECONDARY_PREFERRED = 'secondaryPreferred';

    /**
     * @since 1.7.0
     */
    public const NEAREST = 'nearest';

    /**
     * @since 1.2.0
     */
    public const NO_MAX_STALENESS = -1;

    /**
     * @since 1.2.0
     */
    public const SMALLEST_MAX_STALENESS_SECONDS = 90;

    /**
     * Construct immutable ReadPreference
     * @link https://php.net/manual/en/mongodb-driver-readpreference.construct.php
     * @param string|int $mode
     * @param array|null $tagSets
     * @param array $options
     * @throws InvalidArgumentException if mode is invalid or if tagSets is provided for a primary read preference.
     */
    final public function __construct($mode, ?array $tagSets = null, ?array $options = []) {}

    public static function __set_state(array $properties) {}

    /**
     * Returns the ReadPreference's "hedge" option
     * @since 1.8.0
     * @link https://www.php.net/manual/en/mongodb-driver-readpreference.gethedge.php
     * @return object|null
     */
    final public function getHedge() {}

    /**
     * Returns the ReadPreference's "mode" option
     * @link https://php.net/manual/en/mongodb-driver-readpreference.getmode.php
     * @return int
     */
    final public function getMode() {}

    /**
     * Returns the ReadPreference's "mode" option as a string
     * @since 1.7.0
     * @link https://php.net/manual/en/mongodb-driver-readpreference.getmodestring.php
     * @return string
     * @throws InvalidArgumentException
     */
    final public function getModeString() {}

    /**
     * Returns the ReadPreference's "tagSets" option
     * @link https://php.net/manual/en/mongodb-driver-readpreference.gettagsets.php
     * @return array
     */
    final public function getTagSets() {}

    /**
     * Returns an object for BSON serialization
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-driver-readpreference.bsonserialize.php
     * @return object Returns an object for serializing the WriteConcern as BSON.
     * @throws InvalidArgumentException
     */
    final public function bsonSerialize() {}

    /**
     * Serialize a ReadPreference
     * @since 1.7.0
     * @link https://php.net/manual/en/mongodb-driver-readpreference.serialize.php
     * @return string
     * @throws InvalidArgumentException
     */
    final public function serialize() {}

    /**
     * Unserialize a ReadPreference
     * @since 1.7.0
     * @link https://php.net/manual/en/mongodb-driver-readpreference.unserialize.php
     * @param string $serialized
     * @return void
     * @throws InvalidArgumentException on argument parsing errors or if the properties are invalid
     * @throws UnexpectedValueException if the properties cannot be unserialized (i.e. serialized was malformed)
     */
    final public function unserialize($serialized) {}

    final public function getMaxStalenessSeconds() {}
}
