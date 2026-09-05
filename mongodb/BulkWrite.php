<?php

namespace MongoDB\Driver;

use MongoDB\Driver\Exception\InvalidArgumentException;

/**
 * The BulkWrite collects one or more write operations that should be sent to the server.
 * After adding any number of insert, update, and delete operations, the collection may be executed via Manager::executeBulkWrite().
 * Write operations may either be ordered (default) or unordered.
 * Ordered write operations are sent to the server, in the order provided, for serial execution.
 * If a write fails, any remaining operations will be aborted.
 * Unordered operations are sent to the server in an arbitrary order where they may be executed in parallel.
 * Any errors that occur are reported after all operations have been attempted.
 */
final class BulkWrite implements \Countable
{
    /**
     * Create a new BulkWrite
     * Constructs a new ordered (default) or unordered BulkWrite.
     * @link https://php.net/manual/en/mongodb-driver-bulkwrite.construct.php
     * @param array $options options Option Type Description Default bypassDocumentValidation bool
     * If true, allows insert and update operations to circumvent document level validation. This
     * option is available in MongoDB 3.2+ and is ignored for older server versions, which do not
     * support document level validation. false comment mixed An arbitrary comment to help trace the
     * operation through the database profiler, currentOp output, and logs. This option is available
     * in MongoDB 4.4+ and will result in an exception at execution time if specified for an older
     * server version. let arrayobject Map of parameter names and values. Values must be constant or
     * closed expressions that do not reference document fields. Parameters can then be accessed as
     * variables in an aggregate expression context (e.g. $$var). This option is available in
     * MongoDB 5.0+ and will result in an exception at execution time if specified for an older
     * server version. ordered bool Ordered operations (true) are executed serially on the MongoDB
     * server, while unordered operations (false) are sent to the server in an arbitrary order and
     * may be executed in parallel. true
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function __construct(?array $options = null) {}

    final public function __wakeup() {}

    /**
     * Count expected roundtrips for executing the bulk
     * Returns the expected number of client-to-server roundtrips required to execute all write operations in the BulkWrite.
     * @link https://php.net/manual/en/mongodb-driver-bulkwrite.count.php
     * @return int number of expected roundtrips to execute the BulkWrite.
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function count(): int {}

    /**
     * Add a delete operation to the bulk
     * @link https://php.net/manual/en/mongodb-driver-bulkwrite.delete.php
     * @param array|object $filter The search filter
     * @param array|null $deleteOptions deleteOptions Option Type Description Default collation
     * arrayobject Collation allows users to specify language-specific rules for string comparison,
     * such as rules for lettercase and accent marks. When specifying collation, the "locale" field
     * is mandatory; all other collation fields are optional. For descriptions of the fields, see
     * Collation Document. If the collation is unspecified but the collection has a default
     * collation, the operation uses the collation specified for the collection. If no collation is
     * specified for the collection or for the operation, MongoDB uses the simple binary comparison
     * used in prior versions for string comparisons. This option is available in MongoDB 3.4+ and
     * will result in an exception at execution time if specified for an older server version. hint
     * stringarrayobject Index specification. Specify either the index name as a string or the index
     * key pattern. If specified, then the query system will only consider plans using the hinted
     * index. This option is available in MongoDB 4.4+ and will result in an exception at execution
     * time if specified for an older server version. limit bool Delete all matching documents
     * (false), or only the first matching document (true) false
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function delete(array|object $filter, ?array $deleteOptions = null): void {}

    /**
     * Add an insert operation to the bulk
     * @link https://php.net/manual/en/mongodb-driver-bulkwrite.insert.php
     * @return mixed If the document did not have an _id, a MongoDB\BSON\ObjectId will be generated and returned; otherwise, no value is returned.
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function insert(array|object $document) {}

    /**
     * Add an update operation to the bulk
     * @link https://php.net/manual/en/mongodb-driver-bulkwrite.update.php
     * @param array|object $filter The search filter
     * @param array|object $newObj A document containing either update operators (e.g. $set) or a replacement document (i.e. only field:value expressions)
     * @param array|null $updateOptions updateOptions Option Type Description Default arrayFilters
     * array An array of filter documents that determines which array elements to modify for an
     * update operation on an array field. See Specify arrayFilters for Array Update Operations in
     * the MongoDB manual for more information. This option is available in MongoDB 3.6+ and will
     * result in an exception at execution time if specified for an older server version. collation
     * arrayobject Collation allows users to specify language-specific rules for string comparison,
     * such as rules for lettercase and accent marks. When specifying collation, the "locale" field
     * is mandatory; all other collation fields are optional. For descriptions of the fields, see
     * Collation Document. If the collation is unspecified but the collection has a default
     * collation, the operation uses the collation specified for the collection. If no collation is
     * specified for the collection or for the operation, MongoDB uses the simple binary comparison
     * used in prior versions for string comparisons. This option is available in MongoDB 3.4+ and
     * will result in an exception at execution time if specified for an older server version. hint
     * stringarrayobject Index specification. Specify either the index name as a string or the index
     * key pattern. If specified, then the query system will only consider plans using the hinted
     * index. This option is available in MongoDB 4.2+ and will result in an exception at execution
     * time if specified for an older server version. multi bool Update only the first matching
     * document if false, or all matching documents true. This option cannot be true if newObj is a
     * replacement document. false sort arrayobject Specify which document the operation updates if
     * the query matches multiple documents. The first document matched by the sort order will be
     * updated. This option cannot be used if "multi" is true. This option is available in MongoDB
     * 8.0+ and will result in an exception at execution time if specified for an older server
     * version. upsert bool If filter does not match an existing document, insert a single document.
     * The document will be created from newObj if it is a replacement document (i.e. no update
     * operators); otherwise, the operators in newObj will be applied to filter to create the new
     * document. false
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function update(array|object $filter, array|object $newObj, ?array $updateOptions = null) {}
}
