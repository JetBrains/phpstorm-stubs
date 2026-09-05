<?php

namespace MongoDB\BSON;

/**
 * Interface TimestampInterface
 *
 * @link https://secure.php.net/manual/en/class.mongodb-bson-timestampinterface.php
 * @since 1.3.0
 */
interface TimestampInterface
{
    /**
     * Returns the increment component of this TimestampInterface
     * @link https://secure.php.net/manual/en/mongodb-bson-timestampinterface.getincrement.php
     * @return int Returns the increment component of this TimestampInterface. On 32-bit systems
     * this method may return a negative number. Although the increment and timestamp parts of the
     * BSON timestamp type consists of two unsigned 32-bit values, PHP can not represent these on
     * 32-bit platforms.
     * @since 1.3.0
     */
    public function getIncrement(): int;

    /**
     * Returns the timestamp component of this TimestampInterface
     * @link https://secure.php.net/manual/en/mongodb-bson-timestampinterface.gettimestamp.php
     * @return int Returns the timestamp component of this TimestampInterface. On 32-bit systems
     * this method may return a negative number. Although the increment and timestamp parts of the
     * BSON timestamp type consists of two unsigned 32-bit values, PHP can not represent these on
     * 32-bit platforms.
     * @since 1.3.0
     */
    public function getTimestamp(): int;

    /**
     * Returns the string representation of this TimestampInterface
     * @link https://secure.php.net/manual/en/mongodb-bson-timestampinterface.tostring.php
     * @return string Returns the string representation of this TimestampInterface.
     * @since 1.3.0
     */
    public function __toString(): string;
}
