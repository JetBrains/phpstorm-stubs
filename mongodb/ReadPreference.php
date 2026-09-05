<?php

namespace MongoDB\Driver;

use MongoDB\BSON\Serializable;
use MongoDB\Driver\Exception\InvalidArgumentException;
use stdClass;

/**
 * Class ReadPreference
 * @link https://php.net/manual/en/class.mongodb-driver-readpreference.php
 */
final class ReadPreference implements Serializable
{
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
     * @since 2.3.0
     */
    public readonly string $mode;

    /**
     * @since 2.3.0
     */
    public readonly array|null $tags;

    /**
     * @since 2.3.0
     */
    public readonly int $maxStalenessSeconds;

    /**
     * @since 2.3.0
     * @deprecated
     */
    public readonly object|null $hedge;

    /**
     * Construct immutable ReadPreference
     * @link https://php.net/manual/en/mongodb-driver-readpreference.construct.php
     * @param string $mode Read preference mode Value Description "primary" All operations read from
     * the current replica set primary. This is the default read preference for MongoDB.
     * "primaryPreferred" In most situations, operations read from the primary but if it is
     * unavailable, operations read from secondary members. "secondary" All operations read from the
     * secondary members of the replica set. "secondaryPreferred" In most situations, operations
     * read from secondary members but if no secondary members are available, operations read from
     * the primary. "nearest" Operations read from member of the replica set with the least network
     * latency, irrespective of the member's type.
     * @param array|null $tagSets Tag sets allow you to target read operations to specific members
     * of a replica set. This parameter should be an array of associative arrays, each of which
     * contain zero or more key/value pairs. When selecting a server for a read operation, the
     * driver attempt to select a node having all tags in a set (i.e. the associative array of
     * key/value pairs). If selection fails, the driver will attempt subsequent sets. An empty tag
     * set (array()) will match any node and may be used as a fallback. Tags are not compatible with
     * the "primary" mode and, in general, only apply when selecting a secondary member of a set for
     * a read operation. However, the "nearest" mode, when combined with a tag set, selects the
     * matching member with the lowest network latency. This member may be a primary or secondary.
     * @param array|null $options options Option Type Description hedge objectarray Specifies
     * whether to use hedged reads, which are supported by MongoDB 4.4+ for sharded queries. Server
     * hedged reads are available for all non-primary read preferences and are enabled by default
     * when using the "nearest" mode. This option allows explicitly enabling server hedged reads for
     * non-primary read preferences by specifying ['enabled' => true], or explicitly disabling
     * server hedged reads for the "nearest" read preference by specifying ['enabled' => false].
     * maxStalenessSeconds int Specifies a maximum replication lag, or "staleness", for reads from
     * secondaries. When a secondary's estimated staleness exceeds this value, the driver stops
     * using it for read operations. If specified, the max staleness must be a signed 32-bit integer
     * greater than or equal to MongoDB\Driver\ReadPreference::SMALLEST_MAX_STALENESS_SECONDS.
     * Defaults to MongoDB\Driver\ReadPreference::NO_MAX_STALENESS, which means that the driver will
     * not consider a secondary's lag when choosing where to direct a read operation. This option is
     * not compatible with the "primary" mode. Specifying a max staleness also requires all MongoDB
     * instances in the deployment to be using MongoDB 3.4+. An exception will be thrown at
     * execution time if any MongoDB instances in the deployment are of an older server version.
     * @throws InvalidArgumentException if mode is invalid or if tagSets is provided for a primary read preference.
     */
    final public function __construct(string $mode, ?array $tagSets = null, ?array $options = null) {}

    public static function __set_state(array $properties) {}

    /**
     * Returns the ReadPreference's "hedge" option
     * @since 1.8.0
     * @link https://www.php.net/manual/en/mongodb-driver-readpreference.gethedge.php
     * @deprecated
     */
    final public function getHedge(): ?object {}

    /**
     * Returns the ReadPreference's "mode" option as a string
     * @since 1.7.0
     * @link https://php.net/manual/en/mongodb-driver-readpreference.getmodestring.php
     * @throws InvalidArgumentException
     */
    final public function getModeString(): string {}

    /**
     * Returns the ReadPreference's "tagSets" option
     * @link https://php.net/manual/en/mongodb-driver-readpreference.gettagsets.php
     */
    final public function getTagSets(): array {}

    /**
     * Returns an object for BSON serialization
     * @since 1.2.0
     * @link https://www.php.net/manual/en/mongodb-driver-readpreference.bsonserialize.php
     * @return object Returns an object for serializing the WriteConcern as BSON.
     * @throws InvalidArgumentException
     */
    final public function bsonSerialize(): stdClass {}

    final public function getMaxStalenessSeconds() {}
}
