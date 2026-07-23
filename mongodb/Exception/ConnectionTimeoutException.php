<?php

namespace MongoDB\Driver\Exception;

/**
 * Thrown when the driver fails to establish a database connection within a specified time limit (e.g. connectTimeoutMS).
 * @link https://www.php.net/manual/en/class.mongodb-driver-exception-connectiontimeoutexception.php
 */
class ConnectionTimeoutException extends ConnectionException implements Exception {}
