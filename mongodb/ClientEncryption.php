<?php

namespace MongoDB\Driver;

use MongoDB\BSON\Binary;
use MongoDB\Driver\Exception\EncryptionException;
use MongoDB\Driver\Exception\InvalidArgumentException;

/**
 * The MongoDB\Driver\ClientEncryption class handles creation of data keys for client-side encryption, as well as manually encrypting and decrypting values.
 * @link https://www.php.net/manual/en/class.mongodb-driver-clientencryption.php
 * @since 1.7.0
 */
final class ClientEncryption
{
    public const AEAD_AES_256_CBC_HMAC_SHA_512_DETERMINISTIC = 'AEAD_AES_256_CBC_HMAC_SHA_512-Deterministic';
    public const AEAD_AES_256_CBC_HMAC_SHA_512_RANDOM = 'AEAD_AES_256_CBC_HMAC_SHA_512-Random';

    /**
     * @since 1.14.0
     */
    public const ALGORITHM_INDEXED = 'Indexed';

    /**
     * @since 1.14.0
     */
    public const ALGORITHM_UNINDEXED = 'Unindexed';

    /**
     * @since 1.20.0
     */
    public const ALGORITHM_RANGE = 'Range';

    /**
     * @since 1.14.0
     */
    public const QUERY_TYPE_EQUALITY = 'equality';

    /**
     * @since 1.20.0
     */
    public const QUERY_TYPE_RANGE = 'range';

    /**
     * @since 1.14.0
     */
    final public function __construct(array $options) {}

    final public function __wakeup() {}

    /**
     * Adds an alternate name to a key document
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.addkeyaltname.php
     * @param Binary $keyId A MongoDB\BSON\Binary instance with subtype 4 (UUID) identifying the key document.
     * @param string $keyAltName Alternate name to add to the key document.
     * @return object|null Returns the previous version of the key document, or null if no document matched.
     * @throws InvalidArgumentException On argument parsing errors.
     * @since 1.15.0
     */
    final public function addKeyAltName(Binary $keyId, string $keyAltName): ?object {}

    /**
     * Creates a new key document and inserts into the key vault collection.
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.createdatakey.php
     * @param string $kmsProvider The KMS provider ("local" or "aws") that will be used to encrypt the new encryption key.
     * @param array|null $options [optional]
     * @return Binary Returns the identifier of the new key as a MongoDB\BSON\Binary object with subtype 4 (UUID).
     * @throws InvalidArgumentException On argument parsing errors.
     * @throws EncryptionException If an error occurs while creating the data key.
     */
    final public function createDataKey(string $kmsProvider, ?array $options = null): Binary {}

    /**
     * Decrypts an encrypted value (BSON binary of subtype 6).
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.decrypt.php
     * @param \MongoDB\BSON\BinaryInterface $keyVaultClient A MongoDB\BSON\Binary instance with subtype 6 containing the encrypted value.
     * @return mixed Returns the decrypted value
     * @throws InvalidArgumentException On argument parsing errors.
     * @throws EncryptionException If an error occurs while decrypting the value.
     */
    final public function decrypt(Binary $keyVaultClient) {}

    /**
     * Deletes a key document
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.deletekey.php
     * @param Binary $keyId A MongoDB\BSON\Binary instance with subtype 4 (UUID) identifying the key document.
     * @return object Returns the result of the internal deleteOne operation on the key vault collection.
     * @throws InvalidArgumentException On argument parsing errors.
     * @since 1.15.0
     */
    final public function deleteKey(Binary $keyId): object {}

    /**
     * Encrypts a value with a given key and algorithm.
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.encrypt.php
     * @param mixed $value The value to be encrypted. Any value that can be inserted into MongoDB can be encrypted using this method.
     * @param array|null $options [optional]
     * @return Binary Returns the encrypted value as MongoDB\BSON\Binary object with subtype 6.
     * @throws InvalidArgumentException On argument parsing errors.
     * @throws EncryptionException If an error occurs while encrypting the value.
     */
    final public function encrypt($value, ?array $options = null): Binary {}

    /**
     * Encrypts a Match Expression or Aggregate Expression to query a range index
     * @param array|object $expr A BSON document containing the expression
     * @param array|null $options Encryption options Option Type Description algorithm string The
     * encryption algorithm to be used. This option is required. Specify one of the following
     * ClientEncryption constants:
     * MongoDB\Driver\ClientEncryption::AEAD_AES_256_CBC_HMAC_SHA_512_DETERMINISTIC
     * MongoDB\Driver\ClientEncryption::AEAD_AES_256_CBC_HMAC_SHA_512_RANDOM
     * MongoDB\Driver\ClientEncryption::ALGORITHM_INDEXED
     * MongoDB\Driver\ClientEncryption::ALGORITHM_UNINDEXED
     * MongoDB\Driver\ClientEncryption::ALGORITHM_RANGE contentionFactor int The contention factor
     * for evaluating queries with indexed, encrypted payloads. This option only applies and may
     * only be specified when algorithm is MongoDB\Driver\ClientEncryption::ALGORITHM_INDEXED or
     * MongoDB\Driver\ClientEncryption::ALGORITHM_RANGE. keyAltName string Identifies a key vault
     * collection document by keyAltName. This option is mutually exclusive with keyId and exactly
     * one is required. keyId MongoDB\BSON\Binary Identifies a data key by _id. The value is a UUID
     * (binary subtype 4). This option is mutually exclusive with keyAltName and exactly one is
     * required. queryType string The query type for evaluating queries with indexed, encrypted
     * payloads. Specify one of the following ClientEncryption constants:
     * MongoDB\Driver\ClientEncryption::QUERY_TYPE_EQUALITY
     * MongoDB\Driver\ClientEncryption::QUERY_TYPE_RANGE This option only applies and may only be
     * specified when algorithm is MongoDB\Driver\ClientEncryption::ALGORITHM_INDEXED or
     * MongoDB\Driver\ClientEncryption::ALGORITHM_RANGE. rangeOpts array Index options for a
     * queryable encryption field supporting "range" queries. The options below must match the
     * values set in the encryptedFields of the target collection. For double and decimal128 BSON
     * field types, min, max, and precision must all be set, or all be unset. Range index options
     * Option Type Description min mixed Required if precision is set. The minimum BSON value of the
     * range. max mixed Required if precision is set. The maximum BSON value of the range. sparsity
     * int Optional. Positive 64-bit integer. precision int Optional. Positive 32-bit integer
     * specifying precision to use for explicit encryption. May only be set for double or decimal128
     * BSON field types. trimFactor int Optional. Positive 32-bit integer.
     * @return object Returns the encrypted expression as a BSON document
     * @throws InvalidArgumentException On argument parsing errors.
     * @since 1.16.0
     */
    final public function encryptExpression(array|object $expr, ?array $options = null): object {}

    /**
     * Gets a key document
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.getkey.php
     * @param Binary $keyId A MongoDB\BSON\Binary instance with subtype 4 (UUID) identifying the key document.
     * @return object|null Returns the key document, or null if no document matched.
     * @throws InvalidArgumentException On argument parsing errors.
     * @since 1.15.0
     */
    final public function getKey(Binary $keyId): ?object {}

    /**
     * Gets a key document by an alternate name
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.getkeybyaltname.php
     * @param string $keyAltName Alternate name for the key document.
     * @return object|null Returns the key document, or null if no document matched.
     * @throws InvalidArgumentException On argument parsing errors.
     * @since 1.15.0
     */
    final public function getKeyByAltName(string $keyAltName): ?object {}

    /**
     * Finds all key documents in the key vault collection.
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.getkeys.php
     * @return Cursor Returns MongoDB\Driver\Cursor on success.
     * @throws InvalidArgumentException On argument parsing errors.
     * @since 1.15.0
     */
    final public function getKeys(): Cursor {}

    /**
     * Removes an alternate name from a key document
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.removekeyaltname.php
     * @param Binary $keyId A MongoDB\BSON\Binary instance with subtype 4 (UUID) identifying the key document.
     * @param string $keyAltName Alternate name to remove from the key document.
     * @return object|null Returns the previous version of the key document, or null if no document matched.
     * @since 1.15.0
     */
    final public function removeKeyAltName(Binary $keyId, string $keyAltName): ?object {}

    /**
     * Rewraps data keys
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.rewrapmanydatakey.php
     * @param array|object $filter The query predicate. An empty predicate will match all documents
     * in the collection. When evaluating query criteria, MongoDB compares types and values
     * according to its own comparison rules for BSON types, which differs from PHP's comparison and
     * type juggling rules. When matching a special BSON type the query criteria should use the
     * respective BSON class (e.g. use MongoDB\BSON\ObjectId to match an ObjectId).
     * @param array|null $options RewrapManyDataKey options Option Type Description provider string
     * The KMS provider (e.g. "local", "aws") that will be used to re-encrypt the matched data keys.
     * If a KMS provider is not specified, matched data keys will be re-encrypted with their current
     * KMS provider. masterKey array The masterKey identifies a KMS-specific key used to encrypt the
     * new data key. This option should not be specified without the "provider" option. This option
     * is required if "provider" is specified and not "local". "aws" provider options Option Type
     * Description region string Required. key string Required. The Amazon Resource Name (ARN) to
     * the AWS customer master key (CMK). endpoint string Optional. An alternate host identifier to
     * send KMS requests to. May include port number. "azure" provider options Option Type
     * Description keyVaultEndpoint string Required. Host with optional port (e.g.
     * "example.vault.azure.net"). keyName string Required. keyVersion string Optional. A specific
     * version of the named key. Defaults to using the key's primary version. "gcp" provider options
     * Option Type Description projectId string Required. location string Required. keyRing string
     * Required. keyName string Required. keyVersion string Optional. A specific version of the
     * named key. Defaults to using the key's primary version. endpoint string Optional. Host with
     * optional port. Defaults to "cloudkms.googleapis.com". "kmip" provider options Option Type
     * Description keyId string Optional. Unique identifier to a 96-byte KMIP secret data managed
     * object. If unspecified, the driver creates a random 96-byte KMIP secret data managed object.
     * endpoint string Optional. Host with optional port. delegated bool Optional. If true, this key
     * should be decrypted by the KMIP server.
     * @return object Returns an object, which will have an optional bulkWriteResult property containing the result of the internal bulkWrite operation as an object. If no data keys matched the filter or the write was unacknowledged, the bulkWriteResult property will be null.
     * @since 1.16.0
     */
    final public function rewrapManyDataKey(array|object $filter, ?array $options = null): object {}
}
