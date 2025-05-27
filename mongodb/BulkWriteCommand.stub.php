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
     * @param array|null $options
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function __construct(?array $options = null) {}

    /**
     * Count number of write operations in the BulkWriteCommand
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.count.php
     * @return int
     */
    public function count(): int {}

    /**
     * Add a deleteOne operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.deleteone.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $filter The query predicate. An empty predicate will match all documents in the collection.
     * @param array|null $options
     * @return void
     * @throws InvalidArgumentException on argument parsing errors.
     */
    final public function deleteOne(string $namespace, array|object $filter, ?array $options = null): void {}

    /**
     * Add a deleteMany operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.deletemany.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $filter The query predicate. An empty predicate will match all documents in the collection.
     * @param array|null $options
     * @throws InvalidArgumentException on argument parsing errors.
     * @return void
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
     * @param array|null $options
     * @throws InvalidArgumentException on argument parsing errors.
     * @return void
     */
    final public function replaceOne(string $namespace, array|object $filter, array|object $replacement, ?array $options = null): void {}

    /**
     * Add an updateMany operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.updateone.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $filter The query predicate. An empty predicate will match all documents in the collection.
     * @param array|object $update A document containing either update operators (e.g. $set) or an aggregation pipeline.
     * @param array|null $options
     * @throws InvalidArgumentException on argument parsing errors.
     * @return void
     */
    final public function updateOne(string $namespace, array|object $filter, array|object $update, ?array $options = null): void {}

    /**
     * Add an updateMany operation
     * @link https://php.net/manual/en/mongodb-driver-bulkwritecommand.updatemany.php
     * @param string $namespace A fully qualified namespace (e.g. "databaseName.collectionName").
     * @param array|object $filter The query predicate. An empty predicate will match all documents in the collection.
     * @param array|object $update A document containing either update operators (e.g. $set) or an aggregation pipeline.
     * @param array|null $options
     * @throws InvalidArgumentException on argument parsing errors.
     * @return void
     */
    final public function updateMany(string $namespace, array|object $filter, array|object $update, ?array $options = null): void {}
}
