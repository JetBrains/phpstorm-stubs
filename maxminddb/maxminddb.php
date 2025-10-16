<?php

namespace MaxMind\Db;

/**
 * Instances of this class provide a reader for the MaxMind DB format. IP
 * addresses can be looked up using the get method.
 */
class Reader
{
    /**
     * Constructs a Reader for the MaxMind DB format. The file passed to it must
     * be a valid MaxMind DB file such as a GeoIp2 database file.
     *
     * @param string $database the MaxMind DB file to use
     *
     * @throws \InvalidArgumentException for invalid database path or unknown arguments
     * @throws InvalidDatabaseException
     *                                   if the database is invalid or there is an error reading
     *                                   from it
     */
    public function __construct(string $database) {}

    /**
     * Retrieves the record for the IP address.
     *
     * @param string $ipAddress the IP address to look up
     *
     * @return mixed the record for the IP address
     * @throws \InvalidArgumentException if something other than a single IP address is passed to the method
     * @throws InvalidDatabaseException
     *                                   if the database is invalid or there is an error reading
     *                                   from it
     *
     * @throws \BadMethodCallException   if this method is called on a closed database
     */
    public function get(string $ipAddress): mixed {}

    /**
     * Retrieves the record for the IP address and its associated network prefix length.
     *
     * @param string $ipAddress the IP address to look up
     *
     * @return array{0:mixed, 1:int} an array where the first element is the record and the
     *                               second the network prefix length for the record
     * @throws \InvalidArgumentException if something other than a single IP address is passed to the method
     * @throws InvalidDatabaseException
     *                                   if the database is invalid or there is an error reading
     *                                   from it
     *
     * @throws \BadMethodCallException   if this method is called on a closed database
     */
    public function getWithPrefixLen(string $ipAddress): array {}

    /**
     * @return Metadata object for the database
     * @throws \BadMethodCallException   if the database has been closed
     *
     * @throws \InvalidArgumentException if arguments are passed to the method
     */
    public function metadata(): Metadata {}

    /**
     * Closes the MaxMind DB and returns resources to the system.
     *
     * @throws \Exception
     *                    if an I/O error occurs
     */
    public function close(): void {}
}

/**
 * This class should be thrown when unexpected data is found in the database.
 */
class InvalidDatabaseException extends \Exception {}

/**
 * This class provides the metadata for the MaxMind DB file.
 */
class Metadata
{
    /**
     * This is an unsigned 16-bit integer indicating the major version number
     * for the database's binary format.
     *
     * @var int
     */
    public int $binaryFormatMajorVersion;

    /**
     * This is an unsigned 16-bit integer indicating the minor version number
     * for the database's binary format.
     *
     * @var int
     */
    public int $binaryFormatMinorVersion;

    /**
     * This is an unsigned 64-bit integer that contains the database build
     * timestamp as a Unix epoch value.
     *
     * @var int
     */
    public int $buildEpoch;

    /**
     * This is a string that indicates the structure of each data record
     * associated with an IP address.  The actual definition of these
     * structures is left up to the database creator.
     *
     * @var string
     */
    public string $databaseType;

    /**
     * This key will always point to a map (associative array). The keys of
     * that map will be language codes, and the values will be a description
     * in that language as a UTF-8 string. May be undefined for some
     * databases.
     *
     * @var array<string, string>
     */
    public array $description;

    /**
     * This is an unsigned 16-bit integer which is always 4 or 6. It indicates
     * whether the database contains IPv4 or IPv6 address data.
     *
     * @var int
     */
    public int $ipVersion;

    /**
     * An array of strings, each of which is a language code. A given record
     * may contain data items that have been localized to some or all of
     * these languages. This may be undefined.
     *
     * @var array<string>
     */
    public array $languages;

    /**
     * @var int
     */
    public int $nodeByteSize;

    /**
     * This is an unsigned 32-bit integer indicating the number of nodes in
     * the search tree.
     *
     * @var int
     */
    public int $nodeCount;

    /**
     * This is an unsigned 16-bit integer. It indicates the number of bits in a
     * record in the search tree. Note that each node consists of two records.
     *
     * @var int
     */
    public int $recordSize;

    /**
     * @var int
     */
    public int $searchTreeSize;
}
