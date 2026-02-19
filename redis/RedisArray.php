<?php

/**
 * Helper autocomplete for php redis extension
 *
 * @link   https://github.com/phpredis/phpredis/blob/develop/redis_array.stub.php
 */
class RedisArray
{
    /**
     * Constructor
     *
     * @param string|string[] $hosts Name of the redis array from redis.ini or array of hosts to construct the array with
     * @param null|array      $opts  Array of options
     */
    public function __construct(string|array $hosts, ?array $opts = null) {}

    /**
     * @return bool|array returns a list of points on continuum; may be useful with custom distributor function.
     */
    public function _continuum(): bool|array {}

    /**
     * @return bool|array returns a custom distributor function.
     */
    public function _distributor(): bool|callable {}

    /**
     * @return bool|callable the name of the function used to extract key parts during consistent hashing.
     */
    public function _function(): bool|callable {}

    /**
     * @return bool|array list of hosts for the selected array or false
     */
    public function _hosts(): bool|array {}

    /**
     * @param string $host The host you want to retrieve the instance for
     *
     * @return bool|null|\Redis a redis instance connected to a specific node
     */
    public function _instance(string $host): bool|null|Redis {}

    /**
     * Use this function when a new node is added and keys need to be rehashed.
     *
     * @return bool|null rehash result
     */
    public function _rehash(callable $fn = null): bool|null {}

    /**
     * @param string $key The key for which you want to lookup the host
     *
     * @return bool|string|null the host to be used for a certain key
     */
    public function _target(string $key): bool|string|null {}

    /**
     * @param string $host Host
     * @param int    $mode \Redis::MULTI|\Redis::PIPELINE
     *
     * @return bool|string|null the host to be used for a certain key
     */
    public function multi(string $host, int $mode = Redis::MULTI): bool|RedisArray {}

    /**
     * Returns a hosts array of associative array of strings and integers, with the following keys:
     * - redis_version
     * - redis_git_sha1
     * - redis_git_dirty
     * - redis_build_id
     * - redis_mode
     * - os
     * - arch_bits
     * - multiplexing_api
     * - atomicvar_api
     * - gcc_version
     * - process_id
     * - run_id
     * - tcp_port
     * - uptime_in_seconds
     * - uptime_in_days
     * - hz
     * - lru_clock
     * - executable
     * - config_file
     * - connected_clients
     * - client_longest_output_list
     * - client_biggest_input_buf
     * - blocked_clients
     * - used_memory
     * - used_memory_human
     * - used_memory_rss
     * - used_memory_rss_human
     * - used_memory_peak
     * - used_memory_peak_human
     * - used_memory_peak_perc
     * - used_memory_peak
     * - used_memory_overhead
     * - used_memory_startup
     * - used_memory_dataset
     * - used_memory_dataset_perc
     * - total_system_memory
     * - total_system_memory_human
     * - used_memory_lua
     * - used_memory_lua_human
     * - maxmemory
     * - maxmemory_human
     * - maxmemory_policy
     * - mem_fragmentation_ratio
     * - mem_allocator
     * - active_defrag_running
     * - lazyfree_pending_objects
     * - mem_fragmentation_ratio
     * - loading
     * - rdb_changes_since_last_save
     * - rdb_bgsave_in_progress
     * - rdb_last_save_time
     * - rdb_last_bgsave_status
     * - rdb_last_bgsave_time_sec
     * - rdb_current_bgsave_time_sec
     * - rdb_last_cow_size
     * - aof_enabled
     * - aof_rewrite_in_progress
     * - aof_rewrite_scheduled
     * - aof_last_rewrite_time_sec
     * - aof_current_rewrite_time_sec
     * - aof_last_bgrewrite_status
     * - aof_last_write_status
     * - aof_last_cow_size
     * - changes_since_last_save
     * - aof_current_size
     * - aof_base_size
     * - aof_pending_rewrite
     * - aof_buffer_length
     * - aof_rewrite_buffer_length
     * - aof_pending_bio_fsync
     * - aof_delayed_fsync
     * - loading_start_time
     * - loading_total_bytes
     * - loading_loaded_bytes
     * - loading_loaded_perc
     * - loading_eta_seconds
     * - total_connections_received
     * - total_commands_processed
     * - instantaneous_ops_per_sec
     * - total_net_input_bytes
     * - total_net_output_bytes
     * - instantaneous_input_kbps
     * - instantaneous_output_kbps
     * - rejected_connections
     * - maxclients
     * - sync_full
     * - sync_partial_ok
     * - sync_partial_err
     * - expired_keys
     * - evicted_keys
     * - keyspace_hits
     * - keyspace_misses
     * - pubsub_channels
     * - pubsub_patterns
     * - latest_fork_usec
     * - migrate_cached_sockets
     * - slave_expires_tracked_keys
     * - active_defrag_hits
     * - active_defrag_misses
     * - active_defrag_key_hits
     * - active_defrag_key_misses
     * - role
     * - master_replid
     * - master_replid2
     * - master_repl_offset
     * - second_repl_offset
     * - repl_backlog_active
     * - repl_backlog_size
     * - repl_backlog_first_byte_offset
     * - repl_backlog_histlen
     * - master_host
     * - master_port
     * - master_link_status
     * - master_last_io_seconds_ago
     * - master_sync_in_progress
     * - slave_repl_offset
     * - slave_priority
     * - slave_read_only
     * - master_sync_left_bytes
     * - master_sync_last_io_seconds_ago
     * - master_link_down_since_seconds
     * - connected_slaves
     * - min-slaves-to-write
     * - min-replicas-to-write
     * - min_slaves_good_slaves
     * - used_cpu_sys
     * - used_cpu_user
     * - used_cpu_sys_children
     * - used_cpu_user_children
     * - cluster_enabled
     *
     * @link    https://redis.io/commands/info
     * @return  bool|array
     * @example
     * <pre>
     * $redis->info();
     * </pre>
     */
    public function info(): bool|array {}

    public function bgsave(): array {}

    public function del(string|array $key, string ...$otherkeys): bool|int {}

    public function discard(): bool|null {}

    public function exec(): bool|null|array {}

    public function flushall(): bool|array {}

    public function flushdb(): bool|array {}

    public function getOption(int $opt): bool|array {}

    public function hscan(string $key, null|int|string &$iterator, ?string $pattern = null, int $count = 0): bool|array {}

    public function keys(string $pattern): bool|array {}

    public function mget(array $keys): bool|array {}

    public function mset(array $pairs): bool {}

    public function ping(): bool|array {}

    public function save(): bool|array {}

    public function scan(null|int|string &$iterator, string $node, ?string $pattern = null, int $count = 0): bool|array {}

    public function select(int $index): bool|array {}

    public function setOption(int $opt, string $value): bool|array {}

    public function sscan(string $key, null|int|string &$iterator, ?string $pattern = null, int $count = 0): bool|array {}

    public function unlink(string|array $key, string ...$otherkeys): bool|int {}

    public function unwatch(): bool|null {}

    public function zscan(string $key, null|int|string &$iterator, ?string $pattern = null, int $count = 0): bool|array {}

    public function acl(string $subcmd, string ...$args): mixed {}

    public function append(string $key, mixed $value): RedisArray|int|false {}

    public function auth(#[\SensitiveParameter] mixed $credentials): RedisArray|bool {}

    public function bgrewriteaof(): RedisArray|bool {}

    public function waitaof(int $numlocal, int $numreplicas, int $timeout): RedisArray|array|false {}

    public function bitcount(string $key, int $start = 0, int $end = -1, bool $bybit = false): RedisArray|int|false {}

    public function bitop(string $operation, string $deskey, string $srckey, string ...$other_keys): RedisArray|int|false {}

    public function bitpos(string $key, bool $bit, int $start = 0, int $end = -1, bool $bybit = false): RedisArray|int|false {}

    public function blPop(string|array $key_or_keys, string|float|int $timeout_or_key, mixed ...$extra_args): RedisArray|array|null|false {}

    public function brPop(string|array $key_or_keys, string|float|int $timeout_or_key, mixed ...$extra_args): RedisArray|array|null|false {}

    public function brpoplpush(string $src, string $dst, int|float $timeout): RedisArray|string|false {}

    public function bzPopMax(string|array $key, string|int $timeout_or_key, mixed ...$extra_args): RedisArray|array|false {}

    public function bzPopMin(string|array $key, string|int $timeout_or_key, mixed ...$extra_args): RedisArray|array|false {}

    public function bzmpop(float $timeout, array $keys, string $from, int $count = 1): RedisArray|array|null|false {}

    public function zmpop(array $keys, string $from, int $count = 1): RedisArray|array|null|false {}

    public function blmpop(float $timeout, array $keys, string $from, int $count = 1): RedisArray|array|null|false {}

    public function lmpop(array $keys, string $from, int $count = 1): RedisArray|array|null|false {}

    public function clearLastError(): bool {}

    public function client(string $opt, mixed ...$args): mixed {}

    public function close(): bool {}

    public function command(?string $opt = null, mixed ...$args): mixed {}

    public function config(string $operation, array|string|null $key_or_settings = null, ?string $value = null): mixed {}

    public function copy(string $src, string $dst, ?array $options = null): RedisArray|bool {}

    public function dbSize(): RedisArray|int|false {}

    public function debug(string $key): RedisArray|string {}

    public function decr(string $key, int $by = 1): RedisArray|int|false {}

    public function decrBy(string $key, int $value): RedisArray|int|false {}

    public function delex(string $key, ?array $options = null): RedisArray|int|false {}

    public function delifeq(string $key, mixed $value): RedisArray|int|false {}

    public function delete(array|string $key, string ...$other_keys): RedisArray|int|false {}

    public function dump(string $key): RedisArray|string|false {}

    public function echo(string $str): RedisArray|string|false {}

    public function eval(string $script, array $args = [], int $num_keys = 0): mixed {}

    public function eval_ro(string $script_sha, array $args = [], int $num_keys = 0): mixed {}

    public function evalsha(string $sha1, array $args = [], int $num_keys = 0): mixed {}

    public function evalsha_ro(string $sha1, array $args = [], int $num_keys = 0): mixed {}

    public function exists(mixed $key, mixed ...$other_keys): RedisArray|int|bool {}

    public function expire(string $key, int $timeout, ?string $mode = null): RedisArray|bool {}

    public function expireAt(string $key, int $timestamp, ?string $mode = null): RedisArray|bool {}

    public function failover(?array $to = null, bool $abort = false, int $timeout = 0): RedisArray|bool {}

    public function expiretime(string $key): RedisArray|int|false {}

    public function pexpiretime(string $key): RedisArray|int|false {}

    public function fcall(string $fn, array $keys = [], array $args = []): mixed {}

    public function fcall_ro(string $fn, array $keys = [], array $args = []): mixed {}

    public function function(string $operation, mixed ...$args): RedisArray|bool|string|array {}

    public function geoadd(string $key, float $lng, float $lat, string $member, mixed ...$other_triples_and_options): RedisArray|int|false {}

    public function geodist(string $key, string $src, string $dst, ?string $unit = null): RedisArray|float|false {}

    public function geohash(string $key, string $member, string ...$other_members): RedisArray|array|false {}

    public function geopos(string $key, string $member, string ...$other_members): RedisArray|array|false {}

    public function georadius(string $key, float $lng, float $lat, float $radius, string $unit, array $options = []): mixed {}

    public function georadius_ro(string $key, float $lng, float $lat, float $radius, string $unit, array $options = []): mixed {}

    public function georadiusbymember(string $key, string $member, float $radius, string $unit, array $options = []): mixed {}

    public function georadiusbymember_ro(string $key, string $member, float $radius, string $unit, array $options = []): mixed {}

    public function geosearch(string $key, array|string $position, array|int|float $shape, string $unit, array $options = []): array {}

    public function geosearchstore(string $dst, string $src, array|string $position, array|int|float $shape, string $unit, array $options = []): RedisArray|array|int|false {}

    public function get(string $key): mixed {}

    public function getWithMeta(string $key): RedisArray|array|false {}

    public function getAuth(): mixed {}

    public function getBit(string $key, int $idx): RedisArray|int|false {}

    public function getEx(string $key, array $options = []): RedisArray|string|bool {}

    public function getDBNum(): int {}

    public function getDel(string $key): RedisArray|string|bool {}

    public function getHost(): string {}

    public function getLastError(): string|null {}

    public function getMode(): int {}

    public function getPersistentID(): string|null {}

    public function getPort(): int {}

    public function serverName(): string|false {}

    public function serverVersion(): string|false {}

    public function getRange(string $key, int $start, int $end): RedisArray|string|false {}

    public function lcs(string $key1, string $key2, ?array $options = null): RedisArray|string|array|int|false {}

    public function getReadTimeout(): float {}

    public function getset(string $key, mixed $value): RedisArray|string|false {}

    public function getTimeout(): float|false {}

    public function getTransferredBytes(): array {}

    public function clearTransferredBytes(): void {}

    public function hDel(string $key, string $field, string ...$other_fields): RedisArray|int|false {}

    public function hExists(string $key, string $field): RedisArray|bool {}

    public function hGet(string $key, string $member): mixed {}

    public function hGetAll(string $key): RedisArray|array|false {}

    public function hGetWithMeta(string $key, string $member): mixed {}

    public function hIncrBy(string $key, string $field, int $value): RedisArray|int|false {}

    public function hIncrByFloat(string $key, string $field, float $value): RedisArray|float|false {}

    public function hKeys(string $key): RedisArray|array|false {}

    public function hLen(string $key): RedisArray|int|false {}

    public function hMget(string $key, array $fields): RedisArray|array|false {}

    public function hgetex(string $key, array $fields, string|array|null $expiry = null): RedisArray|array|false {}

    public function hsetex(string $key, array $fields, ?array $expiry = null): RedisArray|int|false {}

    public function hgetdel(string $key, array $fields): RedisArray|array|false {}

    public function hMset(string $key, array $fieldvals): RedisArray|bool {}

    public function hRandField(string $key, ?array $options = null): RedisArray|string|array|false {}

    public function hSet(string $key, mixed ...$fields_and_vals): RedisArray|int|false {}

    public function hSetNx(string $key, string $field, mixed $value): RedisArray|bool {}

    public function hStrLen(string $key, string $field): RedisArray|int|false {}

    public function hVals(string $key): RedisArray|array|false {}

    public function httl(string $key, array $fields): RedisArray|array|false {}

    public function hpttl(string $key, array $fields): RedisArray|array|false {}

    public function hexpiretime(string $key, array $fields): RedisArray|array|false {}

    public function hpexpiretime(string $key, array $fields): RedisArray|array|false {}

    public function hpersist(string $key, array $fields): RedisArray|array|false {}

    public function expiremember(string $key, string $field, int $ttl, ?string $unit = null): RedisArray|int|false {}

    public function expirememberat(string $key, string $field, int $timestamp): RedisArray|int|false {}

    public function incr(string $key, int $by = 1): RedisArray|int|false {}

    public function incrBy(string $key, int $value): RedisArray|int|false {}

    public function incrByFloat(string $key, float $value): RedisArray|float|false {}

    public function isConnected(): bool {}

    public function lInsert(string $key, string $pos, mixed $pivot, mixed $value): RedisArray|int|false {}

    public function lLen(string $key): RedisArray|int|false {}

    public function lMove(string $src, string $dst, string $wherefrom, string $whereto): RedisArray|string|false {}

    public function blmove(string $src, string $dst, string $wherefrom, string $whereto, float $timeout): RedisArray|string|false {}

    public function lPop(string $key, int $count = 0): RedisArray|bool|string|array {}

    public function lPos(string $key, mixed $value, ?array $options = null): RedisArray|null|bool|int|array {}

    public function lPush(string $key, mixed ...$elements): RedisArray|int|false {}

    public function rPush(string $key, mixed ...$elements): RedisArray|int|false {}

    public function lPushx(string $key, mixed $value): RedisArray|int|false {}

    public function rPushx(string $key, mixed $value): RedisArray|int|false {}

    public function lSet(string $key, int $index, mixed $value): RedisArray|bool {}

    public function lastSave(): int {}

    public function lindex(string $key, int $index): mixed {}

    public function lrange(string $key, int $start, int $end): RedisArray|array|false {}

    public function lrem(string $key, mixed $value, int $count = 0): RedisArray|int|false {}

    public function ltrim(string $key, int $start, int $end): RedisArray|bool {}

    public function move(string $key, int $index): RedisArray|bool {}

    public function msetex(array $key_vals, int|float|array|null $expiry = null): RedisArray|int|false {}

    public function msetnx(array $key_values): RedisArray|bool {}

    public function object(string $subcommand, string $key): RedisArray|int|string|false {}

    public function open(string $host, int $port = 6379, float $timeout = 0, ?string $persistent_id = null, int $retry_interval = 0, float $read_timeout = 0, ?array $context = null): bool {}

    public function pconnect(string $host, int $port = 6379, float $timeout = 0, ?string $persistent_id = null, int $retry_interval = 0, float $read_timeout = 0, ?array $context = null): bool {}

    public function persist(string $key): RedisArray|bool {}

    public function pexpire(string $key, int $timeout, ?string $mode = null): bool {}

    public function pexpireAt(string $key, int $timestamp, ?string $mode = null): RedisArray|bool {}

    public function pfadd(string $key, array $elements): RedisArray|int {}

    public function pfcount(array|string $key_or_keys): RedisArray|int|false {}

    public function pfmerge(string $dst, array $srckeys): RedisArray|bool {}

    public function pipeline(): bool|RedisArray {}

    public function popen(string $host, int $port = 6379, float $timeout = 0, ?string $persistent_id = null, int $retry_interval = 0, float $read_timeout = 0, ?array $context = null): bool {}

    public function psetex(string $key, int $expire, mixed $value): RedisArray|bool {}

    public function psubscribe(array $patterns, callable $cb): bool {}

    public function pttl(string $key): RedisArray|int|false {}

    public function publish(string $channel, string $message): RedisArray|int|false {}

    public function pubsub(string $command, mixed $arg = null): mixed {}

    public function punsubscribe(array $patterns): RedisArray|array|bool {}

    public function rPop(string $key, int $count = 0): RedisArray|array|string|bool {}

    public function randomKey(): RedisArray|string|false {}

    public function rawcommand(string $command, mixed ...$args): mixed {}

    public function rename(string $old_name, string $new_name): RedisArray|bool {}

    public function renameNx(string $key_src, string $key_dst): RedisArray|bool {}

    public function reset(): RedisArray|bool {}

    public function restore(string $key, int $ttl, string $value, ?array $options = null): RedisArray|bool {}

    public function role(): mixed {}

    public function rpoplpush(string $srckey, string $dstkey): RedisArray|string|false {}

    public function sAdd(string $key, mixed $value, mixed ...$other_values): RedisArray|int|false {}

    public function sAddArray(string $key, array $values): int {}

    public function sDiff(string $key, string ...$other_keys): RedisArray|array|false {}

    public function sDiffStore(string $dst, string $key, string ...$other_keys): RedisArray|int|false {}

    public function sInter(array|string $key, string ...$other_keys): RedisArray|array|false {}

    public function sintercard(array $keys, int $limit = -1): RedisArray|int|false {}

    public function sInterStore(array|string $key, string ...$other_keys): RedisArray|int|false {}

    public function sMembers(string $key): RedisArray|array|false {}

    public function sMisMember(string $key, string $member, string ...$other_members): RedisArray|array|false {}

    public function sMove(string $src, string $dst, mixed $value): RedisArray|bool {}

    public function sPop(string $key, int $count = 0): RedisArray|string|array|false {}

    public function sRandMember(string $key, int $count = 0): mixed {}

    public function sUnion(string $key, string ...$other_keys): RedisArray|array|false {}

    public function sUnionStore(string $dst, string $key, string ...$other_keys): RedisArray|int|false {}

    public function scard(string $key): RedisArray|int|false {}

    public function script(string $command, mixed ...$args): mixed {}

    public function set(string $key, mixed $value, mixed $options = null): RedisArray|string|bool {}

    public function setBit(string $key, int $idx, bool $value): RedisArray|int|false {}

    public function setRange(string $key, int $index, string $value): RedisArray|int|false {}

    public function setex(string $key, int $expire, mixed $value): RedisArray|bool {}

    public function setnx(string $key, mixed $value): RedisArray|bool {}

    public function sismember(string $key, mixed $value): RedisArray|bool {}

    public function slaveof(?string $host = null, int $port = 6379): RedisArray|bool {}

    public function replicaof(?string $host = null, int $port = 6379): RedisArray|bool {}

    public function touch(array|string $key_or_array, string ...$more_keys): RedisArray|int|false {}

    public function slowlog(string $operation, int $length = 0): mixed {}

    public function sort(string $key, ?array $options = null): mixed {}

    public function sort_ro(string $key, ?array $options = null): mixed {}

    public function sortAsc(string $key, ?string $pattern = null, mixed $get = null, int $offset = -1, int $count = -1, ?string $store = null): array {}

    public function sortAscAlpha(string $key, ?string $pattern = null, mixed $get = null, int $offset = -1, int $count = -1, ?string $store = null): array {}

    public function sortDesc(string $key, ?string $pattern = null, mixed $get = null, int $offset = -1, int $count = -1, ?string $store = null): array {}

    public function sortDescAlpha(string $key, ?string $pattern = null, mixed $get = null, int $offset = -1, int $count = -1, ?string $store = null): array {}

    public function srem(string $key, mixed $value, mixed ...$other_values): RedisArray|int|false {}

    public function ssubscribe(array $channels, callable $cb): bool {}

    public function strlen(string $key): RedisArray|int|false {}

    public function subscribe(array $channels, callable $cb): bool {}

    public function sunsubscribe(array $channels): RedisArray|array|bool {}

    public function swapdb(int $src, int $dst): RedisArray|bool {}

    public function time(): RedisArray|array {}

    public function ttl(string $key): RedisArray|int|false {}

    public function type(string $key): RedisArray|int|false {}

    public function unsubscribe(array $channels): RedisArray|array|bool {}

    public function watch(array|string $key, string ...$other_keys): RedisArray|bool {}

    public function wait(int $numreplicas, int $timeout): int|false {}

    public function xack(string $key, string $group, array $ids): int|false {}

    public function xadd(string $key, string $id, array $values, int $maxlen = 0, bool $approx = false, bool $nomkstream = false): RedisArray|string|false {}

    public function xautoclaim(string $key, string $group, string $consumer, int $min_idle, string $start, int $count = -1, bool $justid = false): RedisArray|bool|array {}

    public function xclaim(string $key, string $group, string $consumer, int $min_idle, array $ids, array $options): RedisArray|array|bool {}

    public function xdel(string $key, array $ids): RedisArray|int|false {}

    public function xdelex(string $key, array $ids, ?string $mode = null): RedisArray|array|false {}

    public function xinfo(string $operation, ?string $arg1 = null, ?string $arg2 = null, int $count = -1): mixed {}

    public function xlen(string $key): RedisArray|int|false {}

    public function xpending(string $key, string $group, ?string $start = null, ?string $end = null, int $count = -1, ?string $consumer = null): RedisArray|array|false {}

    public function xrange(string $key, string $start, string $end, int $count = -1): RedisArray|array|bool {}

    public function xread(array $streams, int $count = -1, int $block = -1): RedisArray|array|bool {}

    public function xreadgroup(string $group, string $consumer, array $streams, int $count = 1, int $block = 1): RedisArray|array|bool {}

    public function xrevrange(string $key, string $end, string $start, int $count = -1): RedisArray|array|bool {}

    public function vadd(string $key, array $values, mixed $element, array|null $options = null): RedisArray|int|false {}

    public function vsim(string $key, mixed $member, array|null $options = null): RedisArray|array|false {}

    public function vcard(string $key): RedisArray|int|false {}

    public function vdim(string $key): RedisArray|int|false {}

    public function vinfo(string $key): RedisArray|array|false {}

    public function vismember(string $key, mixed $member): RedisArray|bool {}

    public function vemb(string $key, mixed $member, bool $raw = false): RedisArray|array|false {}

    public function vrandmember(string $key, int $count = 0): RedisArray|array|string|false {}

    public function vrange(string $key, string $min, string $max, int $count = -1): RedisArray|array|false {}

    public function vrem(string $key, mixed $member): RedisArray|int|false {}

    public function vsetattr(string $key, mixed $member, array|string $attributes): RedisArray|int|false {}

    public function vgetattr(string $key, mixed $member, bool $decode = true): RedisArray|array|string|false {}

    public function vlinks(string $key, mixed $member, bool $withscores = false): RedisArray|array|false {}

    public function xtrim(string $key, string $threshold, bool $approx = false, bool $minid = false, int $limit = -1): RedisArray|int|false {}

    public function zAdd(string $key, array|float $score_or_options, mixed ...$more_scores_and_mems): RedisArray|int|float|false {}

    public function zCard(string $key): RedisArray|int|false {}

    public function zCount(string $key, int|string $start, int|string $end): RedisArray|int|false {}

    public function zIncrBy(string $key, float $value, mixed $member): RedisArray|float|false {}

    public function zLexCount(string $key, string $min, string $max): RedisArray|int|false {}

    public function zMscore(string $key, mixed $member, mixed ...$other_members): RedisArray|array|false {}

    public function zPopMax(string $key, ?int $count = null): RedisArray|array|false {}

    public function zPopMin(string $key, ?int $count = null): RedisArray|array|false {}

    public function zRange(string $key, string|int $start, string|int $end, array|bool|null $options = null): RedisArray|array|false {}

    public function zRangeByLex(string $key, string $min, string $max, int $offset = -1, int $count = -1): RedisArray|array|false {}

    public function zRangeByScore(string $key, string $start, string $end, array $options = []): RedisArray|array|false {}

    public function zRandMember(string $key, ?array $options = null): RedisArray|string|array {}

    public function zRank(string $key, mixed $member): RedisArray|int|false {}

    public function zRem(mixed $key, mixed $member, mixed ...$other_members): RedisArray|int|false {}

    public function zRemRangeByLex(string $key, string $min, string $max): RedisArray|int|false {}

    public function zRemRangeByRank(string $key, int $start, int $end): RedisArray|int|false {}

    public function zRemRangeByScore(string $key, string $start, string $end): RedisArray|int|false {}

    public function zRevRange(string $key, int $start, int $end, mixed $scores = null): RedisArray|array|false {}

    public function zRevRangeByLex(string $key, string $max, string $min, int $offset = -1, int $count = -1): RedisArray|array|false {}

    public function zRevRangeByScore(string $key, string $max, string $min, array|bool $options = []): RedisArray|array|false {}

    public function zRevRank(string $key, mixed $member): RedisArray|int|false {}

    public function zScore(string $key, mixed $member): RedisArray|float|false {}

    public function zdiff(array $keys, ?array $options = null): RedisArray|array|false {}

    public function zdiffstore(string $dst, array $keys): RedisArray|int|false {}

    public function zinter(array $keys, ?array $weights = null, ?array $options = null): RedisArray|array|false {}

    public function zintercard(array $keys, int $limit = -1): RedisArray|int|false {}

    public function zinterstore(string $dst, array $keys, ?array $weights = null, ?string $aggregate = null): RedisArray|int|false {}

    public function zunion(array $keys, ?array $weights = null, ?array $options = null): RedisArray|array|false {}

    public function zunionstore(string $dst, array $keys, ?array $weights = null, ?string $aggregate = null): RedisArray|int|false {}

    public function digest(string $key): RedisArray|string|false {}
}
