<?php

namespace MongoDB\Driver\Monitoring;

/**
 * @since 1.13.0
 */
final class ServerHeartbeatFailedEvent
{
    /**
     * @since 2.3.0
     */
    public readonly string $host;

    /**
     * @since 2.3.0
     */
    public readonly int $port;

    /**
     * @since 2.3.0
     */
    public readonly bool $awaited;

    /**
     * @since 2.3.0
     */
    public readonly int $duration;

    /**
     * @since 2.3.0
     */
    public readonly \Exception $error;

    final private function __construct() {}

    /**
     * Returns the heartbeat's duration in microseconds
     * @link https://www.php.net/manual/en/mongodb-driver-monitoring-serverheartbeatfailedevent.getdurationmicros.php
     */
    final public function getDurationMicros(): int {}

    /**
     * Returns the Exception associated with the failed heartbeat
     * @link https://www.php.net/manual/en/mongodb-driver-monitoring-serverheartbeatfailedevent.geterror.php
     */
    final public function getError(): \Exception {}

    /**
     * Returns the port on which this server is listening
     * @link https://www.php.net/manual/en/mongodb-driver-monitoring-serverheartbeatfailedevent.getport.php
     */
    final public function getPort(): int {}

    /**
     * Returns the hostname of the server
     * @link https://www.php.net/manual/en/mongodb-driver-monitoring-serverheartbeatfailedevent.gethost.php
     */
    final public function getHost(): string {}

    /**
     * Returns whether the heartbeat used a streaming protocol
     * @link https://www.php.net/manual/en/mongodb-driver-monitoring-serverheartbeatfailedevent.isstreaming.php
     */
    final public function isAwaited(): bool {}

    final public function __wakeup(): void {}
}
