<?php
/**
 * PHPStorm stub file for System program execution functions.
 *
 * @link http://php.net/manual/en/book.exec.php
 */

/**
 * Escape a string to be used as a shell argument
 *
 * @link  http://php.net/manual/en/function.escapeshellarg.php
 *
 * @param string $arg <p>
 *                    The argument that will be escaped.
 *                    </p>
 *
 * @return string The escaped string.
 * @since 4.0.3
 * @since 5.0
 */
function escapeshellarg($arg) { }

/**
 * Escape shell metacharacters
 *
 * @link  http://php.net/manual/en/function.escapeshellcmd.php
 *
 * @param string $command <p>
 *                        The command that will be escaped.
 *                        </p>
 *
 * @return string The escaped string.
 * @since 4.0
 * @since 5.0
 */
function escapeshellcmd($command) { }

/**
 * Execute an external program
 *
 * @link  http://php.net/manual/en/function.exec.php
 *
 * @param string $command    <p>
 *                           The command that will be executed.
 *                           </p>
 * @param array  $output     [optional] <p>
 *                           If the output argument is present, then the
 *                           specified array will be filled with every line of output from the
 *                           command. Trailing whitespace, such as \n, is not
 *                           included in this array. Note that if the array already contains some
 *                           elements, exec will append to the end of the array.
 *                           If you do not want the function to append elements, call
 *                           unset on the array before passing it to
 *                           exec.
 *                           </p>
 * @param int    $return_var [optional] <p>
 *                           If the return_var argument is present
 *                           along with the output argument, then the
 *                           return status of the executed command will be written to this
 *                           variable.
 *                           </p>
 *
 * @return string The last line from the result of the command. If you need to execute a
 * command and have all the data from the command passed directly back without
 * any interference, use the passthru function.
 * </p>
 * <p>
 * To get the output of the executed command, be sure to set and use the
 * output parameter.
 * @since 4.0
 * @since 5.0
 */
function exec($command, array &$output = null, &$return_var = null) { }

/**
 * Execute an external program and display raw output
 *
 * @link  http://php.net/manual/en/function.passthru.php
 *
 * @param string $command    <p>
 *                           The command that will be executed.
 *                           </p>
 * @param int    $return_var [optional] <p>
 *                           If the return_var argument is present, the
 *                           return status of the Unix command will be placed here.
 *                           </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function passthru($command, &$return_var = null) { }

/**
 * Close a process opened by <function>proc_open</function> and return the exit code of that process
 *
 * @link  http://php.net/manual/en/function.proc-close.php
 *
 * @param resource $process <p>
 *                          The proc_open resource that will
 *                          be closed.
 *                          </p>
 *
 * @return int the termination status of the process that was run.
 * @since 4.3.0
 * @since 5.0
 */
function proc_close($process) { }

/**
 * Get information about a process opened by <function>proc_open</function>
 *
 * @link  http://php.net/manual/en/function.proc-get-status.php
 *
 * @param resource $process <p>
 *                          The proc_open resource that will
 *                          be evaluated.
 *                          </p>
 *
 * @return array|false An array of collected information on success, and false
 * on failure. The returned array contains the following elements:
 * </p>
 * <p>
 * <tr valign="top"><td>element</td><td>type</td><td>description</td></tr>
 * <tr valign="top">
 * <td>command</td>
 * <td>string</td>
 * <td>
 * The command string that was passed to proc_open.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>pid</td>
 * <td>int</td>
 * <td>process id</td>
 * </tr>
 * <tr valign="top">
 * <td>running</td>
 * <td>bool</td>
 * <td>
 * true if the process is still running, false if it has
 * terminated.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>signaled</td>
 * <td>bool</td>
 * <td>
 * true if the child process has been terminated by
 * an uncaught signal. Always set to false on Windows.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>stopped</td>
 * <td>bool</td>
 * <td>
 * true if the child process has been stopped by a
 * signal. Always set to false on Windows.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>exitcode</td>
 * <td>int</td>
 * <td>
 * The exit code returned by the process (which is only
 * meaningful if running is false).
 * Only first call of this function return real value, next calls return
 * -1.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>termsig</td>
 * <td>int</td>
 * <td>
 * The number of the signal that caused the child process to terminate
 * its execution (only meaningful if signaled is true).
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>stopsig</td>
 * <td>int</td>
 * <td>
 * The number of the signal that caused the child process to stop its
 * execution (only meaningful if stopped is true).
 * </td>
 * </tr>
 * @since 5.0
 */
function proc_get_status($process) { }

/**
 * Change the priority of the current process
 *
 * @link  http://php.net/manual/en/function.proc-nice.php
 *
 * @param int $increment <p>
 *                       The increment value of the priority change.
 *                       </p>
 *
 * @return bool true on success or false on failure.
 * If an error occurs, like the user lacks permission to change the priority,
 * an error of level E_WARNING is also generated.
 * @since 5.0
 */
function proc_nice($increment) { }

/**
 * Execute a command and open file pointers for input/output
 *
 * @link  http://php.net/manual/en/function.proc-open.php
 *
 * @param string $cmd            <p>
 *                               The command to execute
 *                               </p>
 * @param array  $descriptorspec <p>
 *                               An indexed array where the key represents the descriptor number and the
 *                               value represents how PHP will pass that descriptor to the child
 *                               process. 0 is stdin, 1 is stdout, while 2 is stderr.
 *                               </p>
 *                               <p>
 *                               Each element can be:
 *                               An array describing the pipe to pass to the process. The first
 *                               element is the descriptor type and the second element is an option for
 *                               the given type. Valid types are pipe (the second
 *                               element is either r to pass the read end of the pipe
 *                               to the process, or w to pass the write end) and
 *                               file (the second element is a filename).
 *                               A stream resource representing a real file descriptor (e.g. opened file,
 *                               a socket, STDIN).
 *                               </p>
 *                               <p>
 *                               The file descriptor numbers are not limited to 0, 1 and 2 - you may
 *                               specify any valid file descriptor number and it will be passed to the
 *                               child process. This allows your script to interoperate with other
 *                               scripts that run as "co-processes". In particular, this is useful for
 *                               passing passphrases to programs like PGP, GPG and openssl in a more
 *                               secure manner. It is also useful for reading status information
 *                               provided by those programs on auxiliary file descriptors.
 *                               </p>
 * @param array  $pipes          <p>
 *                               Will be set to an indexed array of file pointers that correspond to
 *                               PHP's end of any pipes that are created.
 *                               </p>
 * @param string $cwd            [optional] <p>
 *                               The initial working dir for the command. This must be an
 *                               absolute directory path, or &null;
 *                               if you want to use the default value (the working dir of the current
 *                               PHP process)
 *                               </p>
 * @param array  $env            [optional] <p>
 *                               An array with the environment variables for the command that will be
 *                               run, or &null; to use the same environment as the current PHP process
 *                               </p>
 * @param array  $other_options  [optional] <p>
 *                               Allows you to specify additional options. Currently supported options
 *                               include:
 *                               suppress_errors (windows only): suppresses errors
 *                               generated by this function when it's set to true
 *                               bypass_shell (windows only): bypass
 *                               cmd.exe shell when set to true
 *                               context: stream context used when opening files
 *                               (created with stream_context_create)
 *                               binary_pipes: open pipes in binary mode, instead
 *                               of using the usual stream_encoding
 *                               </p>
 *
 * @return resource|false a resource representing the process, which should be freed using
 * proc_close when you are finished with it. On failure returns false.
 * @since 4.3.0
 * @since 5.0
 */
function proc_open(
    $cmd,
    array $descriptorspec,
    array &$pipes,
    $cwd = null,
    array $env = null,
    array $other_options = null
) {
}

/**
 * Kills a process opened by proc_open
 *
 * @link  http://php.net/manual/en/function.proc-terminate.php
 *
 * @param resource $process <p>
 *                          The proc_open resource that will
 *                          be closed.
 *                          </p>
 * @param int      $signal  [optional] <p>
 *                          This optional parameter is only useful on POSIX
 *                          operating systems; you may specify a signal to send to the process
 *                          using the kill(2) system call. The default is
 *                          SIGTERM.
 *                          </p>
 *
 * @return bool the termination status of the process that was run.
 * @since 5.0
 */
function proc_terminate($process, $signal = null) { }

/**
 * Execute command via shell and return the complete output as a string
 *
 * @link  http://php.net/manual/en/function.shell-exec.php
 *
 * @param string $cmd <p>
 *                    The command that will be executed.
 *                    </p>
 *
 * @return string The output from the executed command.
 * @since 4.0
 * @since 5.0
 */
function shell_exec($cmd) { }

/**
 * Execute an external program and display the output
 *
 * @link  http://php.net/manual/en/function.system.php
 *
 * @param string $command    <p>
 *                           The command that will be executed.
 *                           </p>
 * @param int    $return_var [optional] <p>
 *                           If the return_var argument is present, then the
 *                           return status of the executed command will be written to this
 *                           variable.
 *                           </p>
 *
 * @return string|bool the last line of the command output on success, and false
 * on failure.
 * @since 4.0
 * @since 5.0
 */
function system($command, &$return_var = null) { }

