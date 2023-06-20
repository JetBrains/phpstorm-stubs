<?php

namespace MongoDB\Driver;

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

    final private function __construct() {}

    final public function __wakeup() {}

    /**
     * Adds an alternate name to a key document
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.addkeyaltname.php
     * @param \MongoDB\BSON\Binary $keyId A MongoDB\BSON\Binary instance with subtype 4 (UUID) identifying the key document.
     * @param string $keyAltName Alternate name to add to the key document.
     * @return object|null Returns the previous version of the key document, or null if no document matched.
     * @throws InvalidArgumentException On argument parsing errors.
     */
    final public function addKeyAltName(\MongoDB\BSON\Binary $keyId, string $keyAltName): ?object {}

    /**
     * Creates a new key document and inserts into the key vault collection.
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.createdatakey.php
     * @param string $kmsProvider The KMS provider ("local" or "aws") that will be used to encrypt the new encryption key.
     * @param array $options [optional]
     * @return \MongoDB\BSON\Binary Returns the identifier of the new key as a MongoDB\BSON\Binary object with subtype 4 (UUID).
     * @throws InvalidArgumentException On argument parsing errors.
     * @throws EncryptionException If an error occurs while creating the data key.
     */
    final public function createDataKey($kmsProvider, ?array $options = []) {}

    /**
     * Decrypts an encrypted value (BSON binary of subtype 6).
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.decrypt.php
     * @param \MongoDB\BSON\BinaryInterface $keyVaultClient A MongoDB\BSON\Binary instance with subtype 6 containing the encrypted value.
     * @return mixed Returns the decrypted value
     * @throws InvalidArgumentException On argument parsing errors.
     * @throws EncryptionException If an error occurs while decrypting the value.
     */
    final public function decrypt(\MongoDB\BSON\Binary $keyVaultClient) {}

    /**
     * Deletes a key document
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.deletekey.php
     * @param \MongoDB\BSON\Binary $keyId A MongoDB\BSON\Binary instance with subtype 4 (UUID) identifying the key document.
     * @return object Returns the result of the internal deleteOne operation on the key vault collection.
     * @throws InvalidArgumentException On argument parsing errors.
     */
    final public function deleteKey(\MongoDB\BSON\Binary $keyId): object {}

    /**
     * Encrypts a value with a given key and algorithm.
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.encrypt.php
     * @param mixed $value The value to be encrypted. Any value that can be inserted into MongoDB can be encrypted using this method.
     * @param array $options [optional]
     * @return \MongoDB\BSON\Binary Returns the encrypted value as MongoDB\BSON\Binary object with subtype 6.
     * @throws InvalidArgumentException On argument parsing errors.
     * @throws EncryptionException If an error occurs while encrypting the value.
     */
    final public function encrypt($value, ?array $options = []): \MongoDB\BSON\Binary {}

    /**
     * Encrypts a Match Expression or Aggregate Expression to query a range index
     * @param array|object $expr A BSON document containing the expression
     * @param array|null $options
     * @return object Returns the encrypted expression as a BSON document
     * @throws InvalidArgumentException On argument parsing errors.
     */
    final public function encryptExpression(array|object $expr, ?array $options = null): object {}

    /**
     * Gets a key document
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.getkey.php
     * @param \MongoDB\BSON\Binary $keyId A MongoDB\BSON\Binary instance with subtype 4 (UUID) identifying the key document.
     * @return object|null Returns the key document, or null if no document matched.
     * @throws InvalidArgumentException On argument parsing errors.
     */
    final public function getKey(\MongoDB\BSON\Binary $keyId): ?object {}

    /**
     * Gets a key document by an alternate name
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.getkeybyaltname.php
     * @param string $keyAltName Alternate name for the key document.
     * @return object|null Returns the key document, or null if no document matched.
     * @throws InvalidArgumentException On argument parsing errors.
     */
    final public function getKeyByAltName(string $keyAltName): ?object {}

    /**
     * Finds all key documents in the key vault collection.
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.getkeys.php
     * @return Cursor
     * @throws InvalidArgumentException On argument parsing errors.
     */
    final public function getKeys(): Cursor {}

    /**
     * Removes an alternate name from a key document
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.removekeyaltname.php
     * @param \MongoDB\BSON\Binary $keyId A MongoDB\BSON\Binary instance with subtype 4 (UUID) identifying the key document.
     * @param string $keyAltName Alternate name to remove from the key document.
     * @return object|null Returns the previous version of the key document, or null if no document matched.
     */
    final public function removeKeyAltName(\MongoDB\BSON\Binary $keyId, string $keyAltName): ?object {}

    /**
     * Rewraps data keys
     * @link https://www.php.net/manual/en/mongodb-driver-clientencryption.rewrapmanydatakey.php
     * @param array|object $filter
     * @param array|null $options
     * @return object Returns an object, which will have an optional bulkWriteResult property containing the result of the internal bulkWrite operation as an object. If no data keys matched the filter or the write was unacknowledged, the bulkWriteResult property will be null.
     */
    final public function rewrapManyDataKey(array|object $filter, ?array $options = null): object {}
}
