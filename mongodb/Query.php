<?php

namespace MongoDB\Driver;

use MongoDB\Driver\Exception\InvalidArgumentException;

/**
 * The MongoDB\Driver\Query class is a value object that represents a database query.
 * @link https://php.net/manual/en/class.mongodb-driver-query.php
 */
final class Query
{
    /**
     * Construct new Query
     * @link https://php.net/manual/en/mongodb-driver-query.construct.php
     * @param array|object $filter The search filter.
     * @param array|null $queryOptions queryOptions Option Type Description allowDiskUse bool Allows
     * MongoDB to use temporary disk files to store data exceeding the 100 megabyte system memory
     * limit while processing a blocking sort operation. allowPartialResults bool For queries
     * against a sharded collection, returns partial results from the mongos if some shards are
     * unavailable instead of throwing an error. Falls back to the deprecated "partial" option if
     * not specified. awaitData bool Use in conjunction with the "tailable" option to block a
     * getMore operation on the cursor temporarily if at the end of data rather than returning no
     * data. After a timeout period, the query returns as normal. batchSize int The number of
     * documents to return in the first batch. Defaults to 101. A batch size of 0 means that the
     * cursor will be established, but no documents will be returned in the first batch. In versions
     * of MongoDB before 3.2, where queries use the legacy wire protocol OP_QUERY, a batch size of 1
     * will close the cursor irrespective of the number of matched documents. collation arrayobject
     * Collation allows users to specify language-specific rules for string comparison, such as
     * rules for lettercase and accent marks. When specifying collation, the "locale" field is
     * mandatory; all other collation fields are optional. For descriptions of the fields, see
     * Collation Document. If the collation is unspecified but the collection has a default
     * collation, the operation uses the collation specified for the collection. If no collation is
     * specified for the collection or for the operation, MongoDB uses the simple binary comparison
     * used in prior versions for string comparisons. This option is available in MongoDB 3.4+ and
     * will result in an exception at execution time if specified for an older server version.
     * comment mixed An arbitrary comment to help trace the operation through the database profiler,
     * currentOp output, and logs. The comment can be any valid BSON type for MongoDB 4.4+. Earlier
     * server versions only support string values. Falls back to the deprecated "$comment" modifier
     * if not specified. exhaust bool Stream the data down full blast in multiple "more" packages,
     * on the assumption that the client will fully read all data queried. Faster when you are
     * pulling a lot of data and know you want to pull it all down. Note: the client is not allowed
     * to not read all the data unless it closes the connection. This option is not supported by the
     * find command in MongoDB 3.2+ and will force the driver to use the legacy wire protocol
     * version (i.e. OP_QUERY). explain bool If true, the returned MongoDB\Driver\Cursor will
     * contain a single document that describes the process and indexes used to return the query.
     * Falls back to the deprecated "$explain" modifier if not specified. This option is not
     * supported by the find command in MongoDB 3.2+ and will only be respected when using the
     * legacy wire protocol version (i.e. OP_QUERY). The explain command should be used on MongoDB
     * 3.0+. hint stringarrayobject Index specification. Specify either the index name as a string
     * or the index key pattern. If specified, then the query system will only consider plans using
     * the hinted index. Falls back to the deprecated "hint" option if not specified. let
     * arrayobject Map of parameter names and values. Values must be constant or closed expressions
     * that do not reference document fields. Parameters can then be accessed as variables in an
     * aggregate expression context (e.g. $$var). This option is available in MongoDB 5.0+ and will
     * result in an exception at execution time if specified for an older server version. limit int
     * The maximum number of documents to return. If unspecified, then defaults to no limit. A limit
     * of 0 is equivalent to setting no limit. max arrayobject The exclusive upper bound for a
     * specific index. Falls back to the deprecated "$max" modifier if not specified. maxAwaitTimeMS
     * int Positive integer denoting the time limit in milliseconds for the server to block a
     * getMore operation if no data is available. This option should only be used in conjunction
     * with the "tailable" and "awaitData" options. maxTimeMS int The cumulative time limit in
     * milliseconds for processing operations on the cursor. MongoDB aborts the operation at the
     * earliest following interrupt point. Falls back to the deprecated "$maxTimeMS" modifier if not
     * specified. min arrayobject The inclusive lower bound for a specific index. Falls back to the
     * deprecated "$min" modifier if not specified. noCursorTimeout bool Prevents the server from
     * timing out idle cursors after an inactivity period (10 minutes). projection arrayobject The
     * projection specification to determine which fields to include in the returned documents. If
     * you are using the ODM functionality to deserialise documents as their original PHP class,
     * make sure that you include the __pclass field in the projection. This is required for the
     * deserialization to work and without it, the extension will return (by default) a stdClass
     * object instead. readConcern MongoDB\Driver\ReadConcern A read concern to apply to the
     * operation. By default, the read concern from the MongoDB Connection URI will be used. This
     * option is available in MongoDB 3.2+ and will result in an exception at execution time if
     * specified for an older server version. returnKey bool If true, returns only the index keys in
     * the resulting documents. Default value is false. If true and the find command does not use an
     * index, the returned documents will be empty. Falls back to the deprecated "$returnKey"
     * modifier if not specified. showRecordId bool Determines whether to return the record
     * identifier for each document. If true, adds a top-level "$recordId" field to the returned
     * documents. Falls back to the deprecated "$showDiskLoc" modifier if not specified. singleBatch
     * bool Determines whether to close the cursor after the first batch. Defaults to false. skip
     * int Number of documents to skip. Defaults to 0. sort arrayobject The sort specification for
     * the ordering of the results. Falls back to the deprecated "$orderby" modifier if not
     * specified. tailable bool Returns a tailable cursor for a capped collection.
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function __construct(array|object $filter, ?array $queryOptions = null) {}

    final public function __wakeup() {}
}
