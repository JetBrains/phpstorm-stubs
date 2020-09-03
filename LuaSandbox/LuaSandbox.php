<?php

/**
 * The LuaSandbox class creates a Lua environment
 * and allows for execution of Lua code.
 */
class LuaSandbox
{
    /**
     * Used with LuaSandbox::getProfilerFunctionReport()
     * to return timings in samples.
     */
    const SAMPLES = 0;

    /**
     * Used with LuaSandbox::getProfilerFunctionReport()
     * to return timings in seconds.
     */
    const SECONDS = 1;

    /**
     * Used with LuaSandbox::getProfilerFunctionReport()
     * to return timings in percentages of the total.
     */
    const PERCENT = 2;

    /**
     * Call a function in a Lua global variable.
     *
     * If the name contains "." characters, the function is located via recursive table accesses,
     * as if the name were a Lua expression.
     *
     * If the variable does not exist, or is not a function,
     * false will be returned and a warning issued.
     *
     * For more information about calling Lua functions and the return values,
     * see LuaSandboxFunction::call().
     *
     * @param string $name Lua variable name.
     * @param mixed[] $arguments Arguments to the function.
     * @return array|bool Returns an array of values returned by the Lua function,
     *    which may be empty, or false in case of failure.
     * @see LuaSandboxFunction::call()
     * @since PECL luasandbox >= 1.0.0
     */
    public function callFunction($name, array $arguments)
    {
    }

    /**
     * Disable the profiler.
     *
     * @since PECL luasandbox >= 1.1.0
     */
    public function disableProfiler()
    {
    }

    /**
     * Enable the profiler.
     *
     * The profiler periodically samples the Lua environment
     * to record the running function. Testing indicates that
     * at least on Linux, setting a period less than 1ms will
     * lead to a high overrun count but no performance problems.
     *
     * @param float $period Sampling period in seconds.
     * @return bool Returns a boolean indicating whether the profiler is enabled.
     * @since PECL luasandbox >= 1.1.0
     */
    public function enableProfiler($period = 0.02)
    {
    }

    /**
     * Fetch the current CPU time usage of the Lua environment.
     * This includes time spent in PHP callbacks.
     *
     * Note: On Windows, this function always returns zero.
     * On operating systems that do not support CLOCK_THREAD_CPUTIME_ID,
     * such as FreeBSD and Mac OS X, this function will return the
     * elapsed wall-clock time, not CPU time.
     *
     * @return float Returns the current CPU time usage in seconds.
     * @since PECL luasandbox >= 1.0.0
     */
    public function getCPUUsage()
    {
    }

    /**
     * Fetch the current memory usage of the Lua environment.
     *
     * @return int
     * @since PECL luasandbox >= 1.0.0
     */
    public function getMemoryUsage()
    {
    }

    /**
     * Fetch the peak memory usage of the Lua environment.
     *
     * @return int Returns the current memory usage in bytes.
     * @since PECL luasandbox >= 1.0.0
     */
    public function getPeakMemoryUsage()
    {
    }

    /**
     * Fetch profiler data.
     *
     * For a profiling instance previously started by LuaSandbox::enableProfiler(),
     * get a report of the cost of each function.
     *
     * The measurement unit used for the cost is determined by the $units parameter:
     *  - LuaSandbox::SAMPLES Measure in number of samples.
     *  - LuaSandbox::SECONDS Measure in seconds of CPU time.
     *  - LuaSandbox::PERCENT Measure percentage of CPU time.
     *
     * Note: On Windows, this function always returns an empty array.
     * On operating systems that do not support CLOCK_THREAD_CPUTIME_ID,
     * such as FreeBSD and Mac OS X, this function will report the
     * elapsed wall-clock time, not CPU time.
     *
     * @param int $units Measurement unit constant.
     * @return array Returns profiler measurements,
     * sorted in descending order, as an associative array.
     * Keys are the Lua function names (with source file and
     * line defined in angle brackets), values are the
     * measurements as integer or float.
     * @since PECL luasandbox >= 1.1.0
     */
    public function getProfilerFunctionReport($units = LuaSandbox::SECONDS)
    {
    }

    /**
     * Return the versions of LuaSandbox and Lua.
     * @return array Returns an array with two keys:
     *  - LuaSandbox (string) The version of the LuaSandbox extension.
     *  - Lua (string) The library name and version as defined by the LUA_RELEASE macro,
     *    for example, "Lua 5.1.5".
     */
    public static function getVersionInfo()
    {
    }

    /**
     * Load a precompiled binary chunk into the Lua environment.
     *
     * Loads data generated by LuaSandboxFunction::dump().
     *
     * @param string $code Data from LuaSandboxFunction::dump().
     * @param string $chunkName Name for the loaded function.
     * @return LuaSandboxFunction
     * @since PECL luasandbox >= 1.0.0
     */
    public function loadBinary($code, $chunkName = '')
    {
    }

    /**
     * Load Lua code into the Lua environment.
     *
     * This is the equivalent of standard Lua's loadstring() function.
     *
     * @param string $code Lua code.
     * @param string $chunkName Name for the loaded chunk, for use in error traces.
     * @return LuaSandboxFunction Returns a LuaSandboxFunction which,
     *    when executed, will execute the passed $code.
     * @since PECL luasandbox >= 1.0.0
     */
    public function loadString($code, $chunkName = '')
    {
    }

    /**
     * Pause the CPU usage timer.
     *
     * This only has effect when called from within a callback from Lua.
     * When execution returns to Lua, the timer will be automatically unpaused.
     * If a new call into Lua is made, the timer will be unpaused
     * for the duration of that call.
     *
     * If a PHP callback calls into Lua again with timer not paused,
     * and then that Lua function calls into PHP again,
     * the second PHP call will not be able to pause the timer.
     * The logic is that even though the second PHP call would
     * avoid counting the CPU usage against the limit,
     * the first call still counts it.
     *
     * @return bool Returns a boolean indicating whether the timer is now paused.
     */
    public function pauseUsageTimer()
    {
    }

    /**
     * Register a set of PHP functions as a Lua library.
     *
     * Registers a set of PHP functions as a Lua library,
     * so that Lua can call the relevant PHP code.
     *
     * For more information about calling Lua functions and the return values,
     * see LuaSandboxFunction::call().
     *
     * @param string $libname The name of the library.
     *    In the Lua state, the global variable of this name will be set to the table of functions.
     *    If the table already exists, the new functions will be added to it.
     * @param array $functions An array, where each key is a function name,
     *    and each value is a corresponding PHP callable.
     * @since PECL luasandbox >= 1.0.0
     */
    public function registerLibrary($libname, $functions)
    {
    }

    /**
     * Set the CPU time limit for the Lua environment.
     *
     * If the total user and system time used by the environment after the call
     * to this method exceeds this limit, a LuaSandboxTimeoutError exception is thrown.
     *
     * Time used in PHP callbacks is included in the limit.
     *
     * Setting the time limit from a callback while Lua is running causes the timer to be reset,
     * or started if it was not already running.
     *
     * Note: On Windows, the CPU limit will be ignored. On operating systems
     * that do not support CLOCK_THREAD_CPUTIME_ID, such as FreeBSD and
     * Mac OS X, wall-clock time rather than CPU time will be limited.
     *
     * @param bool|float $limit Limit as a float in seconds, or false for no limit.
     * @since PECL luasandbox >= 1.0.0
     */
    public function setCPULimit($limit)
    {
    }

    /**
     * Set the memory limit for the Lua environment.
     *
     * @param int $limit Memory limit in bytes.
     * @throws LuaSandboxMemoryError Exception is thrown if this limit is exceeded.
     * @since PECL luasandbox >= 1.0.0
     */
    public function setMemoryLimit($limit)
    {
    }

    /**
     * Unpause the timer paused by LuaSandbox::pauseUsageTimer().
     */
    public function unpauseUsageTimer()
    {
    }

    /**
     * Wrap a PHP callable in a LuaSandboxFunction.
     *
     * Wraps a PHP callable in a LuaSandboxFunction,
     * so it can be passed into Lua as an anonymous function.
     *
     * The function must return either an array of values (which may be empty),
     * or NULL which is equivalent to returning the empty array.
     *
     * Exceptions will be raised as errors in Lua, however only LuaSandboxRuntimeError
     * exceptions may be caught inside Lua with pcall() or xpcall().
     *
     * For more information about calling Lua functions and the return values,
     * see LuaSandboxFunction::call().
     *
     * @param callable $function Callable to wrap.
     * @return LuaSandboxFunction
     * @since PECL luasandbox >= 1.2.0
     */
    public function wrapPhpFunction($function)
    {
    }
}

/**
 * Represents a Lua function, allowing it to be called from PHP.
 * A LuaSandboxFunction may be obtained as a return value from Lua,
 * as a parameter passed to a callback from Lua,
 * or by using LuaSandbox::wrapPhpFunction(), LuaSandbox::loadString(),
 * or LuaSandbox::loadBinary().
 */
class LuaSandboxFunction
{
    /**
     * Call a Lua function.
     *
     * Errors considered to be the fault of the PHP code will result in the
     * function returning false and E_WARNING being raised, for example,
     * a resource type being used as an argument. Lua errors will result
     * in a LuaSandboxRuntimeError exception being thrown.
     *
     * PHP and Lua types are converted as follows:
     *  - PHP NULL is Lua nil, and vice versa.
     *  - PHP integers and floats are converted to Lua numbers. Infinity and NAN are supported.
     *  - Lua numbers without a fractional part between approximately -2**53 and 2**53 are converted to PHP integers, with others being converted to PHP floats.
     *  - PHP booleans are Lua booleans, and vice versa.
     *  - PHP strings are Lua strings, and vice versa.
     *  - Lua functions are PHP LuaSandboxFunction objects, and vice versa. General PHP callables are not supported.
     *  - PHP arrays are converted to Lua tables, and vice versa.
     *    - Note that Lua typically indexes arrays from 1, while PHP indexes arrays from 0. No adjustment is made for these differing conventions.
     *    - Self-referential arrays are not supported in either direction.
     *    - PHP references are dereferenced.
     *    - Lua __pairs and __ipairs are processed. __index is ignored.
     *    - When converting from PHP to Lua, integer keys between -2**53 and 2**53 are represented as Lua numbers. All other keys are represented as Lua strings.
     *    - When converting from Lua to PHP, keys other than strings and numbers will result in an error, as will collisions when converting numbers to strings or vice versa (since PHP considers things like $a[0] and $a["0"] as being equivalent).
     *  - All other types are unsupported and will raise an error/exception, including general PHP objects and Lua userdata and thread types.
     *
     * Lua functions inherently return a list of results. So on success,
     * this method returns an array containing all of the values returned by Lua,
     * with integer keys starting from zero.
     * Lua may return no results, in which case an empty array is returned.
     *
     * @param string[] $arguments Arguments passed to the function.
     * @return array|bool Returns an array of values returned by the function,
     *    which may be empty, or false on error.
     * @since PECL luasandbox >= 1.0.0
     */
    public function call($arguments)
    {
    }

    /**
     * Dump the function as a binary blob.
     *
     * @return string Returns a string that may be passed to LuaSandbox::loadBinary().
     * @since PECL luasandbox >= 1.0.0
     */
    public function dump()
    {
    }
}

/**
 * Base class for LuaSandbox exceptions.
 */
class LuaSandboxError extends Exception
{
    /**
     *
     */
    const RUN = 2;

    /**
     *
     */
    const SYNTAX = 3;

    /**
     *
     */
    const MEM = 4;

    /**
     *
     */
    const ERR = 5;
}

/**
 * Catchable LuaSandbox runtime exceptions.
 *
 * These may be caught inside Lua using pcall() or xpcall().
 */
class LuaSandboxRuntimeError extends LuaSandboxError {}

/**
 * Uncatchable LuaSandbox exceptions.
 *
 * These may not be caught inside Lua using pcall() or xpcall().
 */
class LuaSandboxFatalError extends LuaSandboxError {}

/**
 * Exception thrown when Lua encounters an error inside an error handler.
 */
class LuaSandboxErrorError extends LuaSandboxFatalError {}

/**
 * Exception thrown when Lua cannot allocate memory.
 */
class LuaSandboxMemoryError extends LuaSandboxFatalError {}

/**
 * Exception thrown when Lua code cannot be parsed.
 */
class LuaSandboxSyntaxError extends LuaSandboxFatalError {}

/**
 * Exception thrown when the configured CPU time limit is exceeded.
 */
class LuaSandboxTimeoutError extends LuaSandboxFatalError {}

