<?php

namespace MongoDB\BSON;

use ArrayAccess;
use IteratorAggregate;
use Stringable;

/**
 * @since 1.16.0
 * @link https://secure.php.net/manual/en/class.mongodb-bson-document.php
 */
final class Document implements IteratorAggregate, ArrayAccess, Type, Stringable
{
    private function __construct() {}

    final public static function fromBSON(string $bson): Document {}

    final public static function fromJSON(string $json): Document {}

    final public static function fromPHP(array|object $value): Document {}

    final public function get(string $key): mixed {}

    final public function getIterator(): Iterator {}

    final public function has(string $key): bool {}

    final public function toPHP(?array $typeMap = null): array|object {}

    final public function toCanonicalExtendedJSON(): string {}

    final public function toRelaxedExtendedJSON(): string {}

    /** @since 1.17.0 */
    public function offsetExists(mixed $offset): bool {}

    /** @since 1.17.0 */
    public function offsetGet(mixed $offset): mixed {}

    /** @since 1.17.0 */
    public function offsetSet(mixed $offset, mixed $value): void {}

    /** @since 1.17.0 */
    public function offsetUnset(mixed $offset): void {}

    final public function __toString(): string {}

    final public static function __set_state(array $properties): Document {}

    final public function __unserialize(array $data): void {}

    final public function __serialize(): array {}
}
