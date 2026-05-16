<?php

namespace MongoDB\Driver\Exception;

/**
 * Thrown when a command fails
 *
 * @link https://php.net/manual/en/class.mongodb-driver-exception-commandexception.php
 * @since 1.5.0
 */
class CommandException extends ServerException
{
    /**
     * @var object The result document for the failed command
     * @since 2.3.0
     */
    public readonly object $resultDocument;

    /**
     * Returns the result document for the failed command
     * @link https://secure.php.net/manual/en/mongodb-driver-commandexception.getresultdocument.php
     * @since 1.5.0
     */
    final public function getResultDocument(): object {}
}
