<?php

// Start of proctitle v.0.1.2

/**
 * Changes the current process' title in the system's list of processes.
 *
 * Mainly useful together with {@see pcntl_fork()}, to tell forked workers apart in the process list.
 *
 * On systems that provide setproctitle(3) — the *BSD family — the native call is used. Everywhere
 * else the extension overwrites the process' own argv[0] in place, which caps the visible title at
 * 127 bytes; longer titles are truncated, shorter ones are padded with spaces.
 *
 * @link https://pecl.php.net/package/proctitle
 * @see cli_set_process_title() Bundled with PHP since 5.5 and the maintained alternative.
 *
 * @param string $title The new process title.
 *
 * @return void No value is returned; the function reports failure only by raising a warning.
 *
 * @since 0.1.0
 */
function setproctitle($title) {}

/**
 * Sets the name of the current thread.
 *
 * Implemented with prctl(PR_SET_NAME), so the function exists only in builds whose configure step
 * found a working prctl(2) — Linux in practice, not *BSD. The kernel stores at most 16 bytes
 * including the terminator, so names are truncated to 15 characters.
 *
 * @link https://pecl.php.net/package/proctitle
 *
 * @param string $title The new thread name.
 *
 * @return bool TRUE on success, FALSE when prctl() failed.
 *
 * @since 0.1.2
 */
function setthreadtitle($title) {}

// End of proctitle v.0.1.2
