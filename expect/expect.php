<?php
const EXP_GLOB = 1;
const EXP_EXACT = 2;
const EXP_REGEXP = 3;
const EXP_EOF = -11;
const EXP_TIMEOUT = -2;
const EXP_FULLBUFFER = -5;

/**
 * Execute command via Bourne shell, and open the PTY stream to the process
 *
 * @link https://www.php.net/manual/en/function.expect-popen.php
 * @param string $command Command to execute.
 * @return resource|bool Returns an open PTY stream to the processes stdio, stdout, and stderr.
 *                        On failure this function returns FALSE.
 * @since PECL expect >= 0.1.0
 */
function expect_popen(string $command)
{
	unset($command);
	return false;
}

/**
 * Waits until the output from a process matches one of the patterns, a specified time period has passed,
 * or an EOF is seen.
 *
 * If match is provided, then it is filled with the result of search. The matched string can be found in match[0].
 * The match substrings (according to the parentheses) in the original pattern can be found in match[1], match[2],
 * and so on, up to match[9] (the limitation of libexpect).
 *
 * @link https://www.php.net/manual/en/function.expect-expectl.php
 * @param resource $expect An Expect stream, previously opened with expect_popen()
 * @param array $cases An array of expect cases.
 * @param array $match
 *
 * @return int Returns value associated with the pattern that was matched.
 * 			   On failure this function returns: EXP_EOF, EXP_TIMEOUT or EXP_FULLBUFFER
 * @since PECL expect >= 0.1.0
 */
function expect_expectl($expect, array $cases, array &$match = array()): int
{
	unset ($expect, $cases, $match);
	return 0;
}
