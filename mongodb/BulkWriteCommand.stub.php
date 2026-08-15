<?php

namespace MongoDB\Driver;

use MongoDB\Driver\Exception\InvalidArgumentException;

/**
 * MongoDB\Driver\BulkWriteCommand collects one or more write operations that
 * should be sent to the server using the » bulkWrite command introduced in
 * MongoDB 8.0. After adding any number of insert, update, and delete operations,
 * the command may be executed via MongoDB\Driver\Manager::executeBulkWriteCommand().
 *
 * Unlike MongoDB\Driver\BulkWrite, where all write operations must target the
 * same collection, each write operation within MongoDB\Driver\BulkWriteCommand
 * may target a different collection.
 *
 * Write operations may either be ordered (default) or unordered. Ordered write
 * operations are sent to the server, in the order provided, for serial execution.
 * If a write fails, any remaining operations will be aborted. Unordered operations
 * are sent to the server in an arbitrary order where they may be executed in
 * parallel. Any errors that occur are reported after all operations have been
 * attempted.
 *
 * @since 2.1.0
 */
final class BulkWriteCommand implements \Countable
{
    /**
     * Create a new BulkWriteCommand
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.construct.php
     * @param array|null $options options Option Type Description Default bypassDocumentValidation
     * bool If true, allows insert and update operations to circumvent document level validation.
     * false comment mixed An arbitrary comment to help trace the operation through the database
     * profiler, currentOp output, and logs. let arrayobject Map of parameter names and values.
     * Values must be constant or closed expressions that do not reference document fields.
     * Parameters can then be accessed as variables in an aggregate expression context (e.g. $$var).
     * This option is available in MongoDB 5.0+ and will result in an exception at execution time if
     * specified for an older server version. ordered bool Whether the operations in this bulk write
     * should be executed in the order in which they were specified. If false, writes will continue
     * to be executed if an individual write fails. If true, writes will stop executing if an
     * individual write fails. true verboseResults bool Whether detailed results for each successful
     * operation should be included in the returned MongoDB\Driver\BulkWriteCommandResult. false
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function __construct(?array $options = null) {}

    /**
     * Count number of write operations in the BulkWriteCommand
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.count.php
     * @return int Returns number of write operations added to the MongoDB\Driver\BulkWriteCommand
     * object.
     */
    public function count(): int {}

    /**
     * Add a deleteOne operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.deleteone.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $filter The query predicate. An empty predicate will match all documents in the collection.
     * @param array|null $options options Option Type Description Default collation arrayobject
     * Collation allows users to specify language-specific rules for string comparison, such as
     * rules for lettercase and accent marks. When specifying collation, the "locale" field is
     * mandatory; all other collation fields are optional. For descriptions of the fields, see
     * Collation Document. If the collation is unspecified but the collection has a default
     * collation, the operation uses the collation specified for the collection. If no collation is
     * specified for the collection or for the operation, MongoDB uses the simple binary comparison
     * used in prior versions for string comparisons. This option is available in MongoDB 3.4+ and
     * will result in an exception at execution time if specified for an older server version. hint
     * stringarrayobject Index specification. Specify either the index name as a string or the index
     * key pattern. If specified, then the query system will only consider plans using the hinted
     * index.
     * @return void No value is returned.
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function deleteOne(string $namespace, array|object $filter, ?array $options = null): void {}

    /**
     * Add a deleteMany operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.deletemany.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $filter The query predicate. An empty predicate will match all documents in the collection.
     * @param array|null $options options Option Type Description Default collation arrayobject
     * Collation allows users to specify language-specific rules for string comparison, such as
     * rules for lettercase and accent marks. When specifying collation, the "locale" field is
     * mandatory; all other collation fields are optional. For descriptions of the fields, see
     * Collation Document. If the collation is unspecified but the collection has a default
     * collation, the operation uses the collation specified for the collection. If no collation is
     * specified for the collection or for the operation, MongoDB uses the simple binary comparison
     * used in prior versions for string comparisons. This option is available in MongoDB 3.4+ and
     * will result in an exception at execution time if specified for an older server version. hint
     * stringarrayobject Index specification. Specify either the index name as a string or the index
     * key pattern. If specified, then the query system will only consider plans using the hinted
     * index.
     * @throws InvalidArgumentException on argument parsing errors.
     * @return void No value is returned.
     */
    final public function deleteMany(string $namespace, array|object $filter, ?array $options = null): void {}

    /**
     * Add an insertOne operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.insertone.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $document A document to insert.
     * @throws InvalidArgumentException on argument parsing errors.
     * @return mixed Returns the _id of the inserted document. If the document did not have an _id, the MongoDB\BSON\ObjectId generated for the insert will be returned.
     */
    final public function insertOne(string $namespace, array|object $document): mixed {}

    /**
     * Add a replaceOne operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.replaceone.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $filter The query predicate. An empty predicate will match all documents in the collection.
     * @param array|object $replacement A replacement document.
     * @param array|null $options options Option Type Description Default collation arrayobject
     * Collation allows users to specify language-specific rules for string comparison, such as
     * rules for lettercase and accent marks. When specifying collation, the "locale" field is
     * mandatory; all other collation fields are optional. For descriptions of the fields, see
     * Collation Document. If the collation is unspecified but the collection has a default
     * collation, the operation uses the collation specified for the collection. If no collation is
     * specified for the collection or for the operation, MongoDB uses the simple binary comparison
     * used in prior versions for string comparisons. This option is available in MongoDB 3.4+ and
     * will result in an exception at execution time if specified for an older server version. hint
     * stringarrayobject Index specification. Specify either the index name as a string or the index
     * key pattern. If specified, then the query system will only consider plans using the hinted
     * index. sort arrayobject Specify which document the operation replaces if the query matches
     * multiple documents. The first document matched by the sort order will be replaced. upsert
     * bool If filter does not match an existing document, insert a single document. The document
     * will be created from replacement. false
     * @throws InvalidArgumentException on argument parsing errors.
     * @return void No value is returned.
     */
    final public function replaceOne(string $namespace, array|object $filter, array|object $replacement, ?array $options = null): void {}

    /**
     * Add an updateMany operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.updateone.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $filter The query predicate. An empty predicate will match all documents in the collection.
     * @param array|object $update A document containing either update operators (e.g. $set) or an aggregation pipeline.
     * @param array|null $options options Option Type Description Default arrayFilters array An
     * array of filter documents that determines which array elements to modify for an update
     * operation on an array field. See Specify arrayFilters for Array Update Operations in the
     * MongoDB manual for more information. collation arrayobject Collation allows users to specify
     * language-specific rules for string comparison, such as rules for lettercase and accent marks.
     * When specifying collation, the "locale" field is mandatory; all other collation fields are
     * optional. For descriptions of the fields, see Collation Document. If the collation is
     * unspecified but the collection has a default collation, the operation uses the collation
     * specified for the collection. If no collation is specified for the collection or for the
     * operation, MongoDB uses the simple binary comparison used in prior versions for string
     * comparisons. This option is available in MongoDB 3.4+ and will result in an exception at
     * execution time if specified for an older server version. hint stringarrayobject Index
     * specification. Specify either the index name as a string or the index key pattern. If
     * specified, then the query system will only consider plans using the hinted index. sort
     * arrayobject Specify which document the operation updates if the query matches multiple
     * documents. The first document matched by the sort order will be updated. upsert bool If
     * filter does not match an existing document, insert a single document. The document will be
     * created by applying operators in update to any field values in filter. false
     * @throws InvalidArgumentException on argument parsing errors.
     * @return void No value is returned.
     */
    final public function updateOne(string $namespace, array|object $filter, array|object $update, ?array $options = null): void {}

    /**
     * Add an updateMany operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.updatemany.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $filter The query predicate. An empty predicate will match all documents in the collection.
     * @param array|object $update A document containing either update operators (e.g. $set) or an aggregation pipeline.
     * @param array|null $options options Option Type Description Default arrayFilters array An
     * array of filter documents that determines which array elements to modify for an update
     * operation on an array field. See Specify arrayFilters for Array Update Operations in the
     * MongoDB manual for more information. collation arrayobject Collation allows users to specify
     * language-specific rules for string comparison, such as rules for lettercase and accent marks.
     * When specifying collation, the "locale" field is mandatory; all other collation fields are
     * optional. For descriptions of the fields, see Collation Document. If the collation is
     * unspecified but the collection has a default collation, the operation uses the collation
     * specified for the collection. If no collation is specified for the collection or for the
     * operation, MongoDB uses the simple binary comparison used in prior versions for string
     * comparisons. This option is available in MongoDB 3.4+ and will result in an exception at
     * execution time if specified for an older server version. hint stringarrayobject Index
     * specification. Specify either the index name as a string or the index key pattern. If
     * specified, then the query system will only consider plans using the hinted index. upsert bool
     * If filter does not match an existing document, insert a single document. The document will be
     * created by applying operators in update to any field values in filter. false
     * @throws InvalidArgumentException on argument parsing errors.
     * @return void No value is returned.
     */
    final public function updateMany(string $namespace, array|object $filter, array|object $update, ?array $options = null): void {}
}
