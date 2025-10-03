<?php

namespace Relay;

/**
 * Relay Sentinel client.
 *
 * @see https://redis.io/docs/management/sentinel/
 */
class Sentinel
{
    /**
     * Whether to throw an exception on `-ERR` replies.
     *
     * @var int
     */
    public const OPT_THROW_ON_ERR = 1;

    /**
     * Whether \Relay\Sentinel should automatically discover other sentinels in the
     * cluster, so it may use them if we fail to communicate with the first one.
     *
     * @var int
     */
    public const OPT_AUTO_DISCOVER = 2;

    /**
     * Establishes a new connection to a Sentinel instance.
     *
     * For backwards compatibility with PhpRedis 6.x, the
     * constructor may be called with a single options array.
     *
     * @param  array|string|null  $host
     * @param  int  $port
     * @param  float  $timeout
     * @param  mixed  $persistent
     * @param  int  $retry_interval
     * @param  float  $read_timeout
     * @param  mixed  $auth
     * @param  array|null  $context
     */
    #[Attributes\Server]
    public function __construct(
        array|string|null $host = null,
        int $port = 26379,
        float $timeout = 0,
        mixed $persistent = null,
        int $retry_interval = 0,
        float $read_timeout = 0,
        #[\SensitiveParameter] mixed $auth = null,
        array|null $context = null
    ) {}

    /**
     * Check if the current Sentinel configuration is able to reach the quorum needed
     * to failover a master, and the majority needed to authorize the failover.
     *
     * @param  string  $master
     * @return bool
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function ckquorum(string $master): bool {}

    /**
     * Force a failover as if the master was not reachable,
     * and without asking for agreement to other Sentinels.
     *
     * @param  string  $master
     * @return bool
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function failover(string $master): bool {}

    /**
     * Force Sentinel to rewrite its configuration on disk,
     * including the current Sentinel state.
     *
     * @return bool
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function flushconfig(): bool {}

    /**
     * Returns the ip and port number of the master with that name.
     *
     * @param  string  $master
     * @return array|false
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function getMasterAddrByName(string $master): array|false {}

    /**
     * Returns the ip and port number of the primary with that name.
     *
     * @see Relay\Sentinel::getMasterAddrByName()
     *
     * @param  string  $master
     * @return array|false
     */
    #[Attributes\ValkeyCommand]
    public function getPrimaryAddrByName(string $master): array|false {}

    /**
     * Returns the state and info of the specified master.
     *
     * @param  string  $master
     * @return array|false
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function master(string $master): array|false {}

    /**
     * Returns the state and info of the specified primary.
     *
     * @see Relay\Sentinel::master()
     *
     * @param  string  $master
     * @return array|false
     */
    #[Attributes\ValkeyCommand]
    public function primary(string $master): array|false {}

    /**
     * Returns a list of monitored masters and their state.
     *
     * @return array|false
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function masters(): array|false {}

    /**
     * Returns a list of monitored primaries and their state.
     *
     * @see Relay\Sentinel::masters()
     *
     * @return array|false
     */
    #[Attributes\ValkeyCommand]
    public function primaries(): array|false {}

    /**
     * Returns the ID of the Sentinel instance.
     *
     * @return string
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function myid(): string {}

    /**
     * Returns PONG if no message is provided, otherwise returns the message.
     *
     * @param  string|null  $message
     * @return string|bool
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function ping(?string $message = null): string|bool {}

    /**
     * Will reset all the masters with matching name.
     *
     * @param  string  $pattern
     * @return int
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function reset(string $pattern): int {}

    /**
     * Returns a list of sentinel instances for this master, and their state.
     *
     * @param  string  $master
     * @return array|false
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function sentinels(string $master): array|false {}

    /**
     * Show a list of replicas for this master, and their state.
     *
     * @param  string  $master
     * @return array|false
     */
    #[Attributes\RedisCommand, Attributes\ValkeyCommand]
    public function slaves(string $master): array|false {}

    /**
     * Returns the last error message, if any.
     *
     * @return string|null
     */
    #[Attributes\Local]
    public function getLastError(): string|null {}

    /**
     * Sets a client option.
     *
     * @param  int  $option
     * @param  mixed  $value
     * @return bool
     */
    #[Attributes\Local]
    public function setOption(int $option, mixed $value): bool {}

    /**
     * Returns a client option.
     *
     * @param  int  $option
     * @return mixed
     */
    #[Attributes\Local]
    public function getOption(int $option): mixed {}
}
