<?php

// Stubs for ext-uv: https://github.com/bwoebi/php-uv

/**
 * Decrement reference.
 *
 * @param resource $uv_t resource handle.
 *
 * @return void
 */
function uv_unref(resource $uv_t): void {}

/**
 * Get last error code.
 *
 * @param resource|null $uv_loop uv loop handle.
 * @return int
 */
function uv_last_error(resource $uv_loop = null): int {}

/**
 * Get error code name.
 *
 * @param int $error_code libuv error code.
 * @return string
 */
function uv_err_name(int $error_code): string {}

/**
 * Get error message.
 *
 * @param int $error_code libuv error code
 * @return string
 */
function uv_strerror(int $error_code): string {}

/**
 * @param resource $uv_loop uv loop handle.
 *
 * @return void
 */
function uv_update_time(resource $uv_loop): void {}

/**
 * Increment reference count.
 *
 * @param resource $uv_handle uv resource.
 *
 * @return void
 */
function uv_ref(resource $uv_handle): void {}

/**
 * Run event loop.
 *
 * @param resource|null $uv_loop uv_loop resource.
 *
 * @return void
 */
function uv_run(resource $uv_loop = null): void {}

/**
 * @param resource|null $uv_loop
 *
 * @return void
 */
function uv_run_once(resource $uv_loop = null): void {}

/**
 * Delete specified loop resource.
 *
 * @param resource $uv_loop uv_loop resource.
 *
 * @return void
 */
function uv_loop_delete(resource $uv_loop): void {}

/**
 * @return int
 */
function uv_now(): int {}

/**
 * Binds a name to a socket.
 *
 * @param resource $uv_tcp uv_tcp resource
 * @param resource $uv_sockaddr uv sockaddr4 resource.
 *
 * @return void
 */
function uv_tcp_bind(resource $uv_tcp, resource $uv_sockaddr): void {}

/**
 * Binds a name to a socket.
 *
 * @param resource $uv_tcp uv_tcp resource
 * @param resource $uv_sockaddr uv sockaddr6 resource.
 *
 * @return void
 */
function uv_tcp_bind6(resource $uv_tcp, resource $uv_sockaddr): void {}

/**
 * Send buffer to speicified uv resource.
 *
 * @param resource $handle uv resources (uv_tcp, uv_udp, uv_pipe ...etc.).
 * @param string $data buffer.
 * @param callable $callback callable variables. This callback expects (resource $handle, long $status).
 *
 * @return void
 */
function uv_write(resource $handle, string $data, callable $callback): void {}

/**
 * @param resource $handle
 * @param string $data
 * @param resource $send
 * @param callable $callback
 *
 * @return void
 */
function uv_write2(resource $handle, string $data, resource $send, callable $callback): void {}

/**
 * Set Nagel's flags for specified tcp resource.
 *
 * @param resource $handle libuv tcp resource.
 * @param bool $enable true means enabled. false means disabled.
 */
function uv_tcp_nodelay(resource $handle, bool $enable): void {}

/**
 * Accepts a connection on a socket.
 *
 * @param resource $server uv_tcp or uv_pipe server resource.
 * @param resource $client uv_tcp or uv_pipe client resource.
 *
 * @return void
 */
function uv_accept(resource $server, resource $client): void {}

/**
 * Shutdown uv handle.
 *
 * @param resource $handle uv resources (uv_tcp, uv_udp, uv_pipe ...etc.).
 * @param callable $callback callable variables. this callback expects (resource $handle, long $status).
 *
 * @return void
 */
function uv_shutdown(resource $handle, callable $callback): void {}

/**
 * Close uv handle.
 *
 * @param resource $handle uv resources (uv_tcp, uv_udp, uv_pipe ...etc.).
 * @param callable $callback callable variables. this callback expects (resource $handle, long $status).
 *
 * @return void
 */
function uv_close(resource $handle, callable $callback): void {}

/**
 * Starts read callback for uv resources.
 *
 * Note: You have to handle erorrs correctly. otherwise this will leak.
 * Note: if you want to use PHP's stream or socket resource. see uv_fs_poll_init and uv_fs_read.
 *
 * @param resource $handle uv resources (uv_tcp, uv_udp, uv_pipe ...etc.)
 * @param callable $callback callable variables. this callback parameter expects (resource $handle, long $nread, string buffer).
 */
function uv_read_start(resource $handle, callable $callback): void {}

/**
 * @param resource $handle
 * @param callable $callback
 *
 * @return void
 */
function uv_read2_start(resource $handle, callable $callback): void {}

/**
 * Stop read callback.
 *
 * @param resource $handle uv resource handle which started uv_read.
 *
 * @return void
 */
function uv_read_stop(resource $handle): void {}

/**
 * Create a ipv4 sockaddr.
 *
 * @param string $ipv4_addr ipv4 address
 * @param int $port port number.
 *
 * @return resource
 */
function uv_ip4_addr(string $ipv4_addr, int $port): resource {}

/**
 * Create a ipv6 sockaddr.
 *
 * @param string $ipv6_addr ipv6 address.
 * @param int $port port number.
 *
 * @return resource
 */
function uv_ip6_addr(string $ipv6_addr, int $port): resource {}

/**
 * Listens for a connection on a uv handle.
 *
 * @param resource $handle uv resource handle (tcp, udp and pipe).
 * @param int $backlog backlog.
 * @param callable $callback this callback parameter expects (resource $connection, long $status).
 *
 * @return void
 */
function uv_listen(resource $handle, int $backlog, callable $callback): void {}

/**
 * Connect to specified ip address and port.
 *
 * @param resource $handle requires uv_tcp_init() resource.
 * @param resource $ipv4_addr requires uv_sockaddr resource.
 * @param callable $callback callable variables. This callback expects (resource $tcp_handle, $status).
 *
 * @return void
 */
function uv_tcp_connect(resource $handle, resource $ipv4_addr, callable $callback): void {}

/**
 * Connect to specified ip address and port.
 *
 * @param resource $handle requires uv_tcp_init() resource.
 * @param resource $ipv6_addr requires uv_sockaddr resource.
 * @param callable $callback callable variables. This callback expects (resource $tcp_handle, $status).
 *
 * @return void
 */
function uv_tcp_connect6(resource $handle, resource $ipv6_addr, callable $callback): void {}

/**
 * Initialize timer handle.
 *
 * @param resource|null $loop uv_loop resource.
 *
 * @return resource
 */
function uv_timer_init(resource $loop = null): resource {}

/**
 * Initialize timer handle.
 *
 * @param resource $timer uv_loop resource.
 * @param int $timeout periodical event starts when after this timeout. 1000 is 1 sec.
 * @param int $repeat repeat interval. 1000 is 1 sec.
 * @param callable $callback
 *
 * @return void
 */
function uv_timer_start(resource $timer, int $timeout, int $repeat, callable $callback): void {}

/**
 * stop specified timer.
 *
 * @param resource $timer uv timer resource.
 *
 * @return int
 */
function uv_timer_stop(resource $timer): int {}

/**
 * Restart timer.
 *
 * @param resource $timer uv_timer resource.
 *
 * @return void
 */
function uv_timer_again(resource $timer): void {}

/**
 * Set repeat count.
 *
 * @param resource $timer uv_timer resource.
 * @param int $repeat repeat count.
 *
 * @return void
 */
function uv_timer_set_repeat(resource $timer, int $repeat): void {}

/**
 * Returns repeat interval.
 *
 * @param resource $timer uv_timer resource.
 *
 * @return int
 */
function uv_timer_get_repeat(resource $timer): int {}

/**
 * Initialize uv idle handle.
 *
 * @param resource $loop uv_loop resource.
 *
 * @return resource initialized idle handle.
 */
function uv_idle_init(resource $loop = null): resource {}

/**
 * start idle callback.
 *
 * @param resource $idle uv_idle resource.
 * @param callable $callback idle callback.
 *
 * @return void
 */
function uv_idle_start(resource $idle, callable $callback): void {}

/**
 * Stop idle callback.
 *
 * @param resource $idle uv_idle resource.
 *
 * @return void
 */
function uv_idle_stop(resource $idle): void {}

/**
 * @param resource $loop
 * @param callable $callback
 * @param string $node
 * @param string $service
 * @param array $hints
 *
 * @return void
 */
function uv_getaddrinfo(resource $loop, callable $callback, string $node, string $service, array $hints): void {}

/**
 * Create a tcp socket.
 *
 * @param resource|null $loop loop resource or null. if not specified loop resource then use uv_default_loop resource.
 *
 * @return resource uv resource which initialized for tcp.
 */
function uv_tcp_init(resource $loop = null): resource {}

/**
 * Return default loop handle.
 *
 * @return resource
 */
function uv_default_loop(): resource {}

/**
 * Create a new loop handle.
 *
 * @return resource
 */
function uv_loop_new(): resource {}

/**
 * Create a udp socket.
 *
 * @param resource|null $loop loop resource or null. if not specified loop resource then use uv_default_loop resource.
 *
 * @return resource uv resource which initialized for udp.
 */
function uv_udp_init(resource $loop = null): resource {}

/**
 * Listens for a connection on a uv udp handle.
 *
 * @param resource $resource uv resource handle (udp).
 * @param resource $address uv sockaddr(ipv4) resource.
 * @param int $flags unused.
 *
 * @return void
 */
function uv_udp_bind(resource $resource, resource $address, int $flags): void {}

/**
 * Listens for a connection on a uv udp handle.
 *
 * @param resource $resource uv resource handle (udp).
 * @param resource $address uv sockaddr(ipv6) resource.
 * @param int $flags Should be 0 or UV::UDP_IPV6ONLY.
 *
 * @return void
 */
function uv_udp_bind6(resource $resource, resource $address, int $flags): void {}

/**
 * Start receive callback.
 *
 * @param resource $handle uv resource handle (udp).
 * @param callable $callback this callback parameter expects (resource $stream, long $nread, string $buffer)..
 *
 * @return void
 */
function uv_udp_recv_start(resource $handle, callable $callback): void {}

/**
 * Stop receive callback.
 *
 * @param resource $handle
 *
 * @return void
 */
function uv_udp_recv_stop(resource $handle): void {}

/**
 * Join or leave udp muticast group.
 *
 * @param resource $handle uv resource handle (udp).
 * @param string $multicast_addr multicast address.
 * @param string $interface_addr interface address.
 * @param int $membership UV::JOIN_GROUP or UV::LEAVE_GROUP
 *
 * @return int
 */
function uv_udp_set_membership(resource $handle, string $multicast_addr, string $interface_addr, int $membership): int {}

/**
 * Set multicast loop.
 *
 * @param resource $handle uv resource handle (udp).
 * @param int $enabled
 *
 * @return void
 */
function uv_udp_set_multicast_loop(resource $handle, int $enabled): void {}

/**
 * Set multicast ttl.
 *
 * @param resource $handle uv resource handle (udp).
 * @param int $ttl multicast ttl.
 *
 * @return void
 */
function uv_udp_set_multicast_ttl(resource $handle, int $ttl): void {}

/**
 * Set udp broadcast.
 *
 * @param resource $handle uv resource handle (udp).
 * @param bool $enabled
 *
 * @return void
 */
function uv_udp_set_broadcast(resource $handle, bool $enabled): void {}

/**
 * Send buffer to specified address.
 *
 * @param resource $handle uv resource handle (udp).
 * @param string $data data.
 * @param resource $uv_addr uv_ip4_addr.
 * @param callable $callback this callback parameter expects (resource $stream, long $status).
 *
 * @return void
 */
function uv_udp_send(resource $handle, string $data, resource $uv_addr, callable $callback): void {}

/**
 * Send buffer to specified address.
 *
 * @param resource $handle uv resource handle (udp).
 * @param string $data data.
 * @param resource $uv_addr6 uv_ip6_addr.
 * @param callable $callback this callback parameter expects (resource $stream, long $status).
 *
 * @return void
 */
function uv_udp_send6(resource $handle, string $data, resource $uv_addr6, callable $callback): void {}

/**
 * @param resource $handle
 *
 * @return bool
 */
function uv_is_active(resource $handle): bool {}

/**
 * @param resource $handle
 *
 * @return bool
 */
function uv_is_readable(resource $handle): bool {}

/**
 * @param resource $handle
 *
 * @return bool
 */
function uv_is_writable(resource $handle): bool {}

/**
 * @param resource $loop
 * @param callable $closure
 * @param array|null $opaque
 *
 * @return bool
 */
function uv_walk(resource $loop, callable $closure, array $opaque = null): bool {}

/**
 * @param resource $uv
 *
 * @return int
 */
function uv_guess_handle(resource $uv): int {}

/**
 * Returns current uv type. (this is not libuv function. util for php-uv).
 *
 * @param resource $uv uv_handle.
 *
 * @return int  should return UV::IS_UV_* constatns. e.g) UV::IS_UV_TCP.
 */
function uv_handle_type(resource $uv): int {}

/**
 * Initialize pipe resource.
 *
 * @param resource $loop uv_loop resource.
 * @param int $ipc when this pipe use for ipc, please set true otherwise false.
 *
 * @return resource
 */
function uv_pipe_init(resource $loop, int $ipc): resource {}

/**
 * Open a pipe resource.
 *
 * @param resource $handle uv pipe handle.
 * @param int $pipe dunnno. maybe file descriptor.
 *
 * @return void
 */
function uv_pipe_open(resource $handle, int $pipe): void {}

/**
 * Create a named pipe.
 *
 * @param resource $handle uv pipe handle.
 * @param string $name dunnno. maybe file descriptor.
 *
 * @return int
 */
function uv_pipe_bind(resource $handle, string $name): int {}

/**
 * Connect to named pipe.
 *
 * @param resource $handle uv pipe handle.
 * @param string $path named pipe path.
 * @param callable $callback this callback parameter expects (resource $pipe, long $status).
 *
 * @return void
 */
function uv_pipe_connect(resource $handle, string $path, callable $callback): void {}

/**
 * @param resource $handle
 * @param void $count
 *
 * @return void
 */
function uv_pipe_pending_instances(resource $handle, void $count): void {}

/**
 * @param resource $loop
 * @param array $options
 * @param int $optmask
 *
 * @return resource
 */
function uv_ares_init_options(resource $loop, array $options, int $optmask): resource {}

/**
 * @param resource $handle
 * @param string $name
 * @param int $flag
 * @param callable $callback
 *
 * @return void
 */
function ares_gethostbyname(resource $handle, string $name, int $flag, callable $callback): void {}

/**
 * Returns current loadaverage.
 *
 * Note: returns array on windows box. (does not support load average on windows).
 *
 * @return array
 */
function uv_loadavg(): array {}

/**
 * Returns current uptime.
 *
 * @return float
 */
function uv_uptime(): float {}

/**
 * Returns current free memory size.
 *
 * @return int
 */
function uv_get_free_memory(): int {}

/**
 * Returns total memory size.
 *
 * @return int
 */
function uv_get_total_memory(): int {}

/**
 * @return int
 */
function uv_hrtime(): int {}

/**
 * Returns current exepath. basically this will returns current php path.
 *
 * @return string
 */
function uv_exepath(): string {}

/**
 * Returns current cpu informations.
 *
 * @return array
 */
function uv_cpu_info(): array {}

/**
 * @return array
 */
function uv_interface_addresses(): array {}

/**
 * @param resource $fd
 * @param int $flags
 *
 * @return resource
 */
function uv_stdio_new(resource $fd, int $flags): resource {}

/**
 * @param resource $loop
 * @param string $command
 * @param array $args
 * @param array $stdio
 * @param string $cwd
 * @param array $env
 * @param callable $callback
 * @param int|null $flags
 * @param array|null $options
 *
 * @return resource
 */
function uv_spawn(resource $loop, string $command, array $args, array $stdio, string $cwd, array $env = array(), callable $callback, int $flags = null, array $options = null): resource {}

/**
 * Send signal to specified uv process resource.
 *
 * @param resource $handle uv resource handle (process).
 * @param int $signal
 *
 * @return void
 */
function uv_process_kill(resource $handle, int $signal): void {}

/**
 * Send signal to specified pid.
 *
 * @param int $pid process id.
 * @param int $signal
 */
function uv_kill(int $pid, int $signal): void {}

/**
 * Change working directory.
 *
 * @param string $directory
 * @return bool
 */
function uv_chdir(string $directory): bool {}

/**
 * Initialize rwlock resource.
 *
 * @return resource returns uv rwlock resource.
 */
function uv_rwlock_init(): resource {}

/**
 * Set read lock.
 *
 * @param resource $handle uv resource handle (uv rwlock).
 */
function uv_rwlock_rdlock(resource $handle): void {}

/**
 * @param resource $handle
 *
 * @return bool
 */
function uv_rwlock_tryrdlock(resource $handle): bool {}

/**
 * Unlock read lock.
 *
 * @param resource $handle uv resource handle (uv rwlock)
 *
 * @return void
 */
function uv_rwlock_rdunlock(resource $handle): void {}

/**
 * Set write lock.
 *
 * @param resource $handle uv resource handle (uv rwlock).
 *
 * @return void
 */
function uv_rwlock_wrlock(resource $handle): void {}

/**
 * @param resource $handle
 */
function uv_rwlock_trywrlock(resource $handle): void {}

/**
 * Unlock write lock.
 *
 * @param resource $handle uv resource handle (uv rwlock).
 */
function uv_rwlock_wrunlock(resource $handle): void {}

/**
 * Initialize mutex resource.
 *
 * @return resource uv mutex resource
 */
function uv_mutex_init(): resource {}

/**
 * Lock mutex.
 *
 * @param resource $lock uv resource handle (uv mutex).
 *
 * @return void
 */
function uv_mutex_lock(resource $lock): void {}

/**
 * @param resource $lock
 *
 * @return bool
 */
function uv_mutex_trylock(resource $lock): bool {}

/**
 * Initialize semaphore resource.
 *
 * @param int $value
 * @return resource
 */
function uv_sem_init(int $value): resource {}

/**
 * Post semaphore.
 *
 * @param resource $sem uv resource handle (uv sem).
 *
 * @return void
 */
function uv_sem_post(resource $sem): void {}

/**
 * @param resource $sem
 *
 * @return void
 */
function uv_sem_wait(resource $sem): void {}

/**
 * @param resource $sem
 *
 * @return void
 */
function uv_sem_trywait(resource $sem): void {}

/**
 * Initialize prepare resource.
 *
 * @param resource $loop uv loop handle.
 *
 * @return resource
 */
function uv_prepare_init(resource $loop): resource {}

/**
 * Setup prepare loop callback. (pre loop callback)
 *
 * @param resource $handle uv resource handle (prepare)
 * @param callable $callback this callback parameter expects (resource $prepare, long $status).
 *
 * @return void
 */
function uv_prepare_start(resource $handle, callable $callback): void {}

/**
 * Stop prepare callback.
 *
 * @param resource $handle uv resource handle (prepare).
 *
 * @return void
 */
function uv_prepare_stop(resource $handle): void {}

/**
 * Setup check resource.
 *
 * @param resource $loop uv loop handle
 *
 * @return resource
 */
function uv_check_init(resource $loop): resource {}

/**
 * Stats check loop callback. (after loop callback)
 *
 * @param resource $handle uv resource handle (check).
 * @param callable $callback this callback parameter expects (resource $check, long $status).
 *
 * @return void
 */
function uv_check_start(resource $handle, callable $callback): void {}

/**
 * Stop check callback.
 *
 * @param resource $handle uv resource handle (check).
 *
 * @return void
 */
function uv_check_stop(resource $handle): void {}

/**
 * Setup async callback.
 *
 * @param resource $loop uv loop resource
 * @param callable $callback
 *
 * @return resource uv async resource.
 */
function uv_async_init(resource $loop, callable $callback): resource {}

/**
 * Send async callback immidiately.
 *
 * @param resource $handle uv async handle.
 *
 * @return void
 */
function uv_async_send(resource $handle): void {}

/**
 * Execute callbacks in another thread (requires Thread Safe enabled PHP).
 *
 * @param resource $loop
 * @param callable $callback
 * @param callable $after_callback
 *
 * @return void
 */
function uv_queue_work(resource $loop, callable $callback, callable $after_callback): void {}

/**
 * Open specified file.
 *
 * @param resource $loop uv_loop resource.
 * @param string $path file path
 * @param int $flag file flag. this should be UV::O_RDONLY and some constants flag.
 * @param int $mode mode flag. this should be UV::S_IRWXU and some mode flag.
 * @param callable $callback this callback parameter expects (resource $stream).
 *
 * @return resource
 */
function uv_fs_open(resource $loop, string $path, int $flag, int $mode, callable $callback): resource {}

/**
 * Async read.
 *
 * @param resource $loop uv loop handle
 * @param resource $fd this expects long $fd, resource $php_stream or resource $php_socket.
 * @param int $offset the offset position in the file at which reading should commence.
 * @param int $length the length in bytes that should be read starting at position $offset.
 * @param callable $callback this callback parameter expects (zval $fd, long $nread, string $buffer).
 *
 * @return void
 */
function uv_fs_read(resource $loop, resource $fd, int $offset, int $length, callable $callback): void {}

/**
 * Close specified file descriptor.
 *
 * @param resource $loop uv_loop resource.
 * @param resource $fd file descriptor. this expects long $fd, resource $php_stream or resource $php_socket.
 * @param callable $callback this callback parameter expects (resource $stream)
 *
 * @return void
 */
function uv_fs_close(resource $loop, resource $fd, callable $callback): void {}

/**
 * Write buffer to specified file descriptor.
 *
 * @param resource $loop uv_loop resource.
 * @param resource $fd file descriptor. this expects long $fd, resource $php_stream or resource $php_socket.
 * @param string $buffer buffer.
 * @param int $offset
 * @param callable $callback this callback parameter expects (resource $stream, long $result)
 *
 * @return void
 */
function uv_fs_write(resource $loop, resource $fd, string $buffer, int $offset, callable $callback): void {}

/**
 * Async fsync.
 *
 * @param resource $loop uv loop handle.
 * @param resource $fd
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_fsync(resource $loop, resource $fd, callable $callback): void {}

/**
 * Async fdatasync.
 *
 * @param resource $loop uv loop handle.
 * @param resource $fd
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_fdatasync(resource $loop, resource $fd, callable $callback): void {}

/**
 * Async ftruncate.
 *
 * @param resource $loop uv loop handle.
 * @param resource $fd
 * @param int $offset
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_ftruncate(resource $loop, resource $fd, int $offset, callable $callback): void {}

/**
 * Async mkdir.
 *
 * @param resource $loop uv loop handle
 * @param string $path
 * @param int $mode
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_mkdir(resource $loop, string $path, int $mode, callable $callback):  void {}

/**
 * Async rmdir.
 *
 * @param resource $loop uv loop handle
 * @param string $path
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_rmdir(resource $loop, string $path, callable $callback): void {}

/**
 * Async unlink.
 *
 * @param resource $loop uv loop handle
 * @param string $path
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_unlink(resource $loop, string $path, callable $callback): void {}

/**
 * Async rename.
 *
 * @param resource $loop uv loop handle.
 * @param string $from
 * @param string $to
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_rename(resource $loop, string $from, string $to, callable $callback): void {}

/**
 * Async utime.
 *
 * @param resource $loop uv loop handle.
 * @param string $path
 * @param int $utime
 * @param int $atime
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_utime(resource $loop, string $path, int $utime, int $atime, callable $callback): void {}

/**
 * Async futime.
 *
 * @param resource $loop uv loop handle.
 * @param resource $fd
 * @param int $utime
 * @param int $atime
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_futime(resource $loop, resource $fd, int $utime, int $atime, callable $callback): void {}

/**
 * Async chmod.
 *
 * @param resource $loop uv loop handle.
 * @param string $path
 * @param int $mode
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_chmod(resource $loop, string $path, int $mode, callable $callback): void {}

/**
 * Async fchmod.
 *
 * @param resource $loop uv loop handle.
 * @param resource $fd
 * @param int $mode
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_fchmod(resource $loop, resource $fd, int $mode, callable $callback): void {}

/**
 * Async chown.
 *
 * @param resource $loop uv loop handle.
 * @param string $path
 * @param int $uid
 * @param int $gid
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_chown(resource $loop, string $path, int $uid, int $gid, callable $callback): void {}

/**
 * Async fchown.
 *
 * @param resource $loop uv loop handle.
 * @param resource $fd
 * @param int $uid
 * @param int $gid
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_fchown(resource $loop, resource $fd, int $uid, int $gid, callable $callback): void {}

/**
 * Async link.
 *
 * @param resource $loop uv loop handle.
 * @param string $from
 * @param string $to
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_link(resource $loop, string $from, string $to, callable $callback): void {}

/**
 * Async symlink.
 *
 * @param resource $loop uv loop handle.
 * @param string $from
 * @param string $to
 * @param int $flags
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_symlink(resource $loop, string $from, string $to, int $flags, callable $callback): void {}

/**
 * Async readlink.
 *
 * @param resource $loop uv loop handle
 * @param string $path
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_readlink(resource $loop, string $path, callable $callback): void {}

/**
 * Async stat.
 *
 * @param resource $loop uv loop handle
 * @param string $path
 * @param callable $callback this callback parameter expects (resource $stream, array $stat)
 *
 * @return void
 */
function uv_fs_stat(resource $loop, string $path, callable $callback): void {}

/**
 * Async lstat.
 *
 * @param resource $loop uv loop handle
 * @param string $path
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_lstat(resource $loop, string $path, callable $callback): void {}

/**
 * Async fstat.
 *
 * @param resource $loop uv loop handle.
 * @param resource $fd
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_fstat(resource $loop, resource $fd, callable $callback): void {}

/**
 * Async readdir.
 *
 * @param resource $loop  uv loop handle
 * @param string $path
 * @param int $flags
 * @param callable $callback
 *
 * @return void
 */
function uv_fs_readdir(resource $loop, string $path, int $flags, callable $callback): void {}

/**
 * Async sendfile.
 *
 * @param resource $loop uv loop handle
 * @param resource $in_fd
 * @param resource $out_fd
 * @param int $offset
 * @param int $length
 * @param callable $callback
 */
function uv_fs_sendfile(resource $loop, resource $in_fd, resource $out_fd, int $offset, int $length, callable $callback): void {}

/**
 * Initialize fs event.
 *
 * @param resource $loop uv loop handle
 * @param string $path
 * @param callable $callback
 * @param int $flags
 *
 * @return resource
 */
function uv_fs_event_init(resource $loop, string $path, callable $callback, int $flags = 0): resource {}

/**
 * Initialize tty resource. you have to open tty your hand.
 *
 * @param resource $loop uv loop handle.
 * @param resource $fd
 * @param int $readable
 *
 * @return resource
 */
function uv_tty_init(resource $loop, resource $fd, int $readable): resource {}

/**
 * @param resource $tty
 * @param int $width
 * @param int $height
 *
 * @return int
 */
function uv_tty_get_winsize(resource $tty, int &$width, int &$height): int {}

/**
 * @param resource $tty
 * @param int $mode
 *
 * @return int
 */
function uv_tty_set_mode(resource $tty, int $mode): int {}

/**
 * @return void
 */
function uv_tty_reset_mode(): void {}

/**
 * @param resource $uv_sockaddr
 *
 * @return string
 */
function uv_tcp_getsockname(resource $uv_sockaddr): string {}

/**
 * @param resource $uv_sockaddr
 *
 * @return string
 */
function uv_tcp_getpeername(resource $uv_sockaddr): string {}

/**
 * @param resource $uv_sockaddr
 *
 * @return string
 */
function uv_udp_getsockname(resource $uv_sockaddr): string {}

/**
 * @return int
 */
function uv_resident_set_memory(): int {}

/**
 * @param resource $address
 *
 * @return string
 */
function uv_ip4_name(resource $address): string {}

/**
 * @param resource $address
 *
 * @return string
 */
function uv_ip6_name(resource $address): string {}

/**
 * Initialize poll.
 *
 * @param resource $uv_loop uv_loop resource.
 * @param resource $fd this expects long fd, PHP's stream or PHP's socket resource.
 *
 * @return resource uv resource which initialized poll.
 */
function uv_poll_init(resource $uv_loop, resource $fd): resource {}

/**
 * Start polling.
 *
 * @param resource $handle uv poll resource.
 * @param int $events UV::READBLE and UV::WRITABLE flags.
 * @param callable $callback this callback parameter expects (resource $poll, long $status, long $events, mixed $connection). the connection parameter passes uv_poll_init'd fd.
 *
 * @return void
 */
function uv_poll_start(resource $handle, int $events, callable $callback): void {}

/**
 * @param resource $poll
 *
 * @return void
 */
function uv_poll_stop(resource $poll): void {}

/**
 * @param resource|null $uv_loop
 *
 * @return resource
 */
function uv_fs_poll_init(resource $uv_loop = null): resource {}

/**
 * @param resource $handle
 * @param $callback
 * @param string $path
 * @param int $interval
 *
 * @return resource
 */
function uv_fs_poll_start(resource $handle, $callback, string $path, int $interval): resource {}

/**
 * @param resource $poll
 *
 * @return void
 */
function uv_fs_poll_stop(resource $poll): void {}

/**
 * @param resource $uv_loop uv loop handle
 *
 * @return void
 */
function uv_stop(resource $uv_loop): void {}

/**
 * @param resource $sig_handle
 *
 * @return int
 */
function uv_signal_stop(resource $sig_handle): int {}
