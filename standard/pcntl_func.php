<?php
/**
 * PHPStorm stub file for Process Control functions.
 *
 * @link http://php.net/manual/en/book.pcntl.php
 */

/**
 * Set an alarm clock for delivery of a signal
 *
 * @link  http://php.net/manual/en/function.pcntl-alarm.php
 *
 * @param int $seconds <p>
 *                     The number of seconds to wait. If <i>seconds</i> is
 *                     zero, no new alarm is created.
 *                     </p>
 *
 * @return int the time in seconds that any previously scheduled alarm had
 * remaining before it was to be delivered, or 0 if there
 * was no previously scheduled alarm.
 * @since 4.3.0
 * @since 5.0
 */
function pcntl_alarm($seconds) { }

/**
 *
 * @param bool $on
 *
 * @return bool
 * @since 7.1
 */
function pcntl_async_signals($on) { }

/**
 * Alias of <b>pcntl_strerror</b>
 *
 * @link  http://php.net/manual/en/function.pcntl-errno.php
 * @since 5.3.4
 */
function pcntl_errno() { }

/**
 * Executes specified program in current process space
 *
 * @link  http://php.net/manual/en/function.pcntl-exec.php
 *
 * @param string $path <p>
 *                     <i>path</i> must be the path to a binary executable or a
 *                     script with a valid path pointing to an executable in the shebang (
 *                     #!/usr/local/bin/perl for example) as the first line. See your system's
 *                     man execve(2) page for additional information.
 *                     </p>
 * @param array  $args [optional] <p>
 *                     <i>args</i> is an array of argument strings passed to the
 *                     program.
 *                     </p>
 * @param array  $envs [optional] <p>
 *                     <i>envs</i> is an array of strings which are passed as
 *                     environment to the program. The array is in the format of name => value,
 *                     the key being the name of the environmental variable and the value being
 *                     the value of that variable.
 *                     </p>
 *
 * @return void <b>FALSE</b> on error and does not return on success.
 * @since 4.2.0
 * @since 5.0
 */
function pcntl_exec($path, array $args = null, array $envs = null) { }

/**
 * Forks the currently running process
 *
 * @link  http://php.net/manual/en/function.pcntl-fork.php
 * @return int On success, the PID of the child process is returned in the
 * parent's thread of execution, and a 0 is returned in the child's
 * thread of execution. On failure, a -1 will be returned in the
 * parent's context, no child process will be created, and a PHP
 * error is raised.
 * @since 4.1.0
 * @since 5.0
 */
function pcntl_fork() { }

/**
 * Retrieve the error number set by the last pcntl function which failed
 *
 * @link  http://php.net/manual/en/function.pcntl-get-last-error.php
 * @return int error code.
 * @since 5.3.4
 */
function pcntl_get_last_error() { }

/**
 * Get the priority of any process
 *
 * @link  http://php.net/manual/en/function.pcntl-getpriority.php
 *
 * @param int $pid                [optional] <p>
 *                                If not specified, the pid of the current process  (getmypid()) is used.
 *                                </p>
 * @param int $process_identifier [optional] <p>
 *                                One of <b>PRIO_PGRP</b>, <b>PRIO_USER</b>
 *                                or <b>PRIO_PROCESS</b>.
 *                                </p>
 *
 * @return int <b>pcntl_getpriority</b> returns the priority of the process
 * or <b>FALSE</b> on error. A lower numerical value causes more favorable
 * scheduling.
 * @since 5.0
 */
function pcntl_getpriority($pid, $process_identifier = PRIO_PROCESS) { }

/**
 * Change the priority of any process
 *
 * @link  http://php.net/manual/en/function.pcntl-setpriority.php
 *
 * @param int $priority           <p>
 *                                <i>priority</i> is generally a value in the range
 *                                -20 to 20. The default priority
 *                                is 0 while a lower numerical value causes more
 *                                favorable scheduling. Because priority levels can differ between
 *                                system types and kernel versions, please see your system's setpriority(2)
 *                                man page for specific details.
 *                                </p>
 * @param int $pid                [optional] <p>
 *                                If not specified, the pid of the current process (getmypid()) is used.
 *                                </p>
 * @param int $process_identifier [optional] <p>
 *                                One of <b>PRIO_PGRP</b>, <b>PRIO_USER</b>
 *                                or <b>PRIO_PROCESS</b>.
 *                                </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.0
 */
function pcntl_setpriority($priority, $pid, $process_identifier = PRIO_PROCESS) { }

/**
 * Installs a signal handler
 *
 * @link  http://php.net/manual/en/function.pcntl-signal.php
 *
 * @param int          $signo            <p>
 *                                       The signal number.
 *                                       </p>
 * @param callable|int $handler          <p>
 *                                       The signal handler. This may be either a callable, which
 *                                       will be invoked to handle the signal, or either of the two global
 *                                       constants <b>SIG_IGN</b> or <b>SIG_DFL</b>,
 *                                       which will ignore the signal or restore the default signal handler
 *                                       respectively.
 *                                       </p>
 *                                       <p>
 *                                       If a callable is given, it must implement the following
 *                                       signature:
 *                                       </p>
 *                                       <p>
 *                                       void<b>handler</b>
 *                                       <b>int<i>signo</i></b>
 *                                       <i>signo</i>
 *                                       The signal being handled.
 * @param bool         $restart_syscalls [optional] <p>
 *                                       Specifies whether system call restarting should be used when this
 *                                       signal arrives.
 *                                       </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.1.0
 * @since 5.0
 */
function pcntl_signal($signo, $handler, $restart_syscalls = true) { }

/**
 * Calls signal handlers for pending signals
 *
 * @link  http://php.net/manual/en/function.pcntl-signal-dispatch.php
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.3.0
 */
function pcntl_signal_dispatch() { }

/**
 * @param int $signo
 *
 * @return bool
 * @since 7.1
 */
function pcntl_signal_get_handler($signo) { }

/**
 * Sets and retrieves blocked signals
 *
 * @link  http://php.net/manual/en/function.pcntl-sigprocmask.php
 *
 * @param int   $how    <p>
 *                      Sets the behavior of <b>pcntl_sigprocmask</b>. Possible
 *                      values:
 *                      <b>SIG_BLOCK</b>: Add the signals to the
 *                      currently blocked signals.
 *                      <b>SIG_UNBLOCK</b>: Remove the signals from the
 *                      currently blocked signals.
 *                      <b>SIG_SETMASK</b>: Replace the currently
 *                      blocked signals by the given list of signals.
 *                      </p>
 * @param array $set    <p>
 *                      List of signals.
 *                      </p>
 * @param array $oldset [optional] <p>
 *                      The <i>oldset</i> parameter is set to an array
 *                      containing the list of the previously blocked signals.
 *                      </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.3.0
 */
function pcntl_sigprocmask($how, array $set, array &$oldset = null) { }

/**
 * Waits for signals, with a timeout
 *
 * @link  http://php.net/manual/en/function.pcntl-sigtimedwait.php
 *
 * @param array $set         <p>
 *                           Array of signals to wait for.
 *                           </p>
 * @param array $siginfo     [optional] <p>
 *                           The <i>siginfo</i> is set to an array containing
 *                           informations about the signal. See
 *                           <b>pcntl_sigwaitinfo</b>.
 *                           </p>
 * @param int   $seconds     [optional] <p>
 *                           Timeout in seconds.
 *                           </p>
 * @param int   $nanoseconds [optional] <p>
 *                           Timeout in nanoseconds.
 *                           </p>
 *
 * @return int On success, <b>pcntl_sigtimedwait</b> returns a signal number.
 * @since 5.3.0
 */
function pcntl_sigtimedwait(array $set, array &$siginfo = null, $seconds = 0, $nanoseconds = 0) { }

/**
 * Waits for signals
 *
 * @link  http://php.net/manual/en/function.pcntl-sigwaitinfo.php
 *
 * @param array $set     <p>
 *                       Array of signals to wait for.
 *                       </p>
 * @param array $siginfo [optional] <p>
 *                       The <i>siginfo</i> parameter is set to an array containing
 *                       informations about the signal.
 *                       </p>
 *                       <p>
 *                       The following elements are set for all signals:
 *                       signo: Signal number
 *                       errno: An error number
 *                       code: Signal code
 *                       </p>
 *                       <p>
 *                       The following elements may be set for the <b>SIGCHLD</b> signal:
 *                       status: Exit value or signal
 *                       utime: User time consumed
 *                       stime: System time consumed
 *                       pid: Sending process ID
 *                       uid: Real user ID of sending process
 *                       </p>
 *                       <p>
 *                       The following elements may be set for the <b>SIGILL</b>,
 *                       <b>SIGFPE</b>, <b>SIGSEGV</b> and
 *                       <b>SIGBUS</b> signals:
 *                       addr: Memory location which caused fault
 *                       </p>
 *                       <p>
 *                       The following element may be set for the <b>SIGPOLL</b>
 *                       signal:
 *                       band: Band event
 *                       fd: File descriptor number
 *                       </p>
 *
 * @return int On success, <b>pcntl_sigwaitinfo</b> returns a signal number.
 * @since 5.3.0
 */
function pcntl_sigwaitinfo(array $set, array &$siginfo = null) { }

/**
 * Retrieve the system error message associated with the given errno
 *
 * @link  http://php.net/manual/en/function.pcntl-strerror.php
 *
 * @param int $errno <p>
 *                   </p>
 *
 * @return string error description on success or <b>FALSE</b> on failure.
 * @since 5.3.4
 */
function pcntl_strerror($errno) { }

/**
 * Waits on or returns the status of a forked child
 *
 * @link  http://php.net/manual/en/function.pcntl-wait.php
 *
 * @param int $status  <p>
 *                     <b>pcntl_wait</b> will store status information
 *                     in the <i>status</i> parameter which can be
 *                     evaluated using the following functions:
 *                     <b>pcntl_wifexited</b>,
 *                     <b>pcntl_wifstopped</b>,
 *                     <b>pcntl_wifsignaled</b>,
 *                     <b>pcntl_wexitstatus</b>,
 *                     <b>pcntl_wtermsig</b> and
 *                     <b>pcntl_wstopsig</b>.
 *                     </p>
 * @param int $options [optional] <p>
 *                     If wait3 is available on your system (mostly BSD-style systems), you can
 *                     provide the optional <i>options</i> parameter. If this
 *                     parameter is not provided, wait will be used for the system call. If
 *                     wait3 is not available, providing a value for <i>options
 *                     </i> will have no effect. The value of <i>options
 *                     </i> is the value of zero or more of the following two constants
 *                     OR'ed together:
 *                     <table>
 *                     Possible values for <i>options</i>
 *                     <tr valign="top">
 *                     <td>WNOHANG</td>
 *                     <td>
 *                     Return immediately if no child has exited.
 *                     </td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>WUNTRACED</td>
 *                     <td>
 *                     Return for children which are stopped, and whose status has
 *                     not been reported.
 *                     </td>
 *                     </tr>
 *                     </table>
 *                     </p>
 *
 * @return int <b>pcntl_wait</b> returns the process ID of the
 * child which exited, -1 on error or zero if WNOHANG was provided as an
 * option (on wait3-available systems) and no child was available.
 * @since 5.0
 */
function pcntl_wait(&$status, $options = 0) { }

/**
 * Waits on or returns the status of a forked child
 *
 * @link  http://php.net/manual/en/function.pcntl-waitpid.php
 *
 * @param int $pid     <p>
 *                     The value of <i>pid</i> can be one of the following:
 *                     <table>
 *                     possible values for <i>pid</i>
 *                     <tr valign="top">
 *                     <td>&lt; -1</td>
 *                     <td>
 *                     wait for any child process whose process group ID is equal to
 *                     the absolute value of <i>pid</i>.
 *                     </td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>-1</td>
 *                     <td>
 *                     wait for any child process; this is the same behaviour that
 *                     the wait function exhibits.
 *                     </td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>0</td>
 *                     <td>
 *                     wait for any child process whose process group ID is equal to
 *                     that of the calling process.
 *                     </td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>&gt; 0</td>
 *                     <td>
 *                     wait for the child whose process ID is equal to the value of
 *                     <i>pid</i>.
 *                     </td>
 *                     </tr>
 *                     </table>
 *                     </p>
 *                     <p>
 *                     Specifying -1 as the <i>pid</i> is
 *                     equivalent to the functionality <b>pcntl_wait</b> provides
 *                     (minus <i>options</i>).
 *                     </p>
 * @param int $status  <p>
 *                     <b>pcntl_waitpid</b> will store status information
 *                     in the <i>status</i> parameter which can be
 *                     evaluated using the following functions:
 *                     <b>pcntl_wifexited</b>,
 *                     <b>pcntl_wifstopped</b>,
 *                     <b>pcntl_wifsignaled</b>,
 *                     <b>pcntl_wexitstatus</b>,
 *                     <b>pcntl_wtermsig</b> and
 *                     <b>pcntl_wstopsig</b>.
 *                     </p>
 * @param int $options [optional] <p>
 *                     The value of <i>options</i> is the value of zero
 *                     or more of the following two global constants
 *                     OR'ed together:
 *                     <table>
 *                     possible values for <i>options</i>
 *                     <tr valign="top">
 *                     <td>WNOHANG</td>
 *                     <td>
 *                     return immediately if no child has exited.
 *                     </td>
 *                     </tr>
 *                     <tr valign="top">
 *                     <td>WUNTRACED</td>
 *                     <td>
 *                     return for children which are stopped, and whose status has
 *                     not been reported.
 *                     </td>
 *                     </tr>
 *                     </table>
 *                     </p>
 *
 * @return int <b>pcntl_waitpid</b> returns the process ID of the
 * child which exited, -1 on error or zero if <b>WNOHANG</b> was used and no
 * child was available
 * @since 4.1.0
 * @since 5.0
 */
function pcntl_waitpid($pid, &$status, $options = 0) { }

/**
 * Returns the return code of a terminated child
 *
 * @link  http://php.net/manual/en/function.pcntl-wexitstatus.php
 *
 * @param int $status The <i>status</i>
 *                    parameter is the status parameter supplied to a successful
 *                    call to <b>pcntl_waitpid</b>.</p>
 *
 * @return int the return code, as an integer.
 * @since 4.1.0
 * @since 5.0
 */
function pcntl_wexitstatus($status) { }

/**
 * Checks if status code represents a normal exit
 *
 * @link  http://php.net/manual/en/function.pcntl-wifexited.php
 *
 * @param int $status The <i>status</i>
 *                    parameter is the status parameter supplied to a successful
 *                    call to <b>pcntl_waitpid</b>.</p>
 *
 * @return bool <b>TRUE</b> if the child status code represents a normal exit, <b>FALSE</b>
 * otherwise.
 * @since 4.1.0
 * @since 5.0
 */
function pcntl_wifexited($status) { }

/**
 * Checks whether the status code represents a termination due to a signal
 *
 * @link  http://php.net/manual/en/function.pcntl-wifsignaled.php
 *
 * @param int $status The <i>status</i>
 *                    parameter is the status parameter supplied to a successful
 *                    call to <b>pcntl_waitpid</b>.</p>
 *
 * @return bool <b>TRUE</b> if the child process exited because of a signal which was
 * not caught, <b>FALSE</b> otherwise.
 * @since 4.1.0
 * @since 5.0
 */
function pcntl_wifsignaled($status) { }

/**
 * Checks whether the child process is currently stopped
 *
 * @link  http://php.net/manual/en/function.pcntl-wifstopped.php
 *
 * @param int $status The <i>status</i>
 *                    parameter is the status parameter supplied to a successful
 *                    call to <b>pcntl_waitpid</b>.</p>
 *
 * @return bool <b>TRUE</b> if the child process which caused the return is
 * currently stopped, <b>FALSE</b> otherwise.
 * @since 4.1.0
 * @since 5.0
 */
function pcntl_wifstopped($status) { }

/**
 * Returns the signal which caused the child to stop
 *
 * @link  http://php.net/manual/en/function.pcntl-wstopsig.php
 *
 * @param int $status The <i>status</i>
 *                    parameter is the status parameter supplied to a successful
 *                    call to <b>pcntl_waitpid</b>.</p>
 *
 * @return int the signal number.
 * @since 4.1.0
 * @since 5.0
 */
function pcntl_wstopsig($status) { }

/**
 * Returns the signal which caused the child to terminate
 *
 * @link  http://php.net/manual/en/function.pcntl-wtermsig.php
 *
 * @param int $status The <i>status</i>
 *                    parameter is the status parameter supplied to a successful
 *                    call to <b>pcntl_waitpid</b>.</p>
 *
 * @return int the signal number, as an integer.
 * @since 4.1.0
 * @since 5.0
 */
function pcntl_wtermsig($status) { }
