<?php
/**
 * PHPStorm stub file for Gearman classes.
 *
 * @link http://php.net/manual/en/book.gearman.php
 */

/**
 * Represents a class for connecting to a Gearman job server and making requests to perform some function on provided
 * data. The function performed must be one registered by a Gearman worker and the data passed is opaque to the job
 * server.
 *
 * @link http://php.net/manual/en/class.gearmanclient.php
 */
class GearmanClient
{
    /**
     * Creates a GearmanClient instance representing a client that connects to the job
     * server and submits tasks to complete.
     *
     * @link http://php.net/manual/en/gearmanclient.construct.php
     */
    public function __construct() { }

    /**
     * Adds one or more options to those already set.
     *
     * @link http://php.net/manual/en/gearmanclient.addoptions.php
     *
     * @param int $options The options to add
     *
     * @return bool Always returns true
     */
    public function addOptions($options) { }

    /**
     * Adds a job server to a list of servers that can be used to run a task. No socket
     * I/O happens here; the server is simply added to the list.
     *
     * @link http://php.net/manual/en/gearmanclient.addserver.php
     *
     * @param string $host
     * @param int    $port
     *
     * @return bool
     */
    public function addServer($host = '127.0.0.1', $port = 4730) { }

    /**
     * Adds a list of job servers that can be used to run a task. No socket I/O happens
     * here; the servers are simply added to the full list of servers.
     *
     * @link http://php.net/manual/en/gearmanclient.addservers.php
     *
     * @param string $servers A comma-separated list of servers, each server specified
     *                        in the format host:port
     *
     * @return bool
     */
    public function addServers($servers = '127.0.0.1:4730') { }

    /**
     * Adds a task to be run in parallel with other tasks. Call this method for all the
     * tasks to be run in parallel, then call GearmanClient::runTasks to perform the
     * work. Note that enough workers need to be available for the tasks to all run in
     * parallel.
     *
     * @link http://php.net/manual/en/gearmanclient.addtask.php
     *
     * @param string $function_name
     * @param string $workload
     * @param mixed  $context
     * @param string $unique
     *
     * @return GearmanTask A GearmanTask object or false if the task could not be added
     */
    public function addTask($function_name, $workload, $context = null, $unique = null) { }

    /**
     * Adds a background task to be run in parallel with other tasks. Call this method
     * for all the tasks to be run in parallel, then call GearmanClient::runTasks to
     * perform the work.
     *
     * @link http://php.net/manual/en/gearmanclient.addtaskbackground.php
     *
     * @param string $function_name
     * @param string $workload
     * @param mixed  $context
     * @param string $unique
     *
     * @return GearmanTask A GearmanTask object or false if the task could not be added
     */
    public function addTaskBackground($function_name, $workload, $context = null, $unique = null) { }

    /**
     * Adds a high priority task to be run in parallel with other tasks. Call this
     * method for all the high priority tasks to be run in parallel, then call
     * GearmanClient::runTasks to perform the work. Tasks with a high priority will be
     * selected from the queue before those of normal or low priority.
     *
     * @link http://php.net/manual/en/gearmanclient.addtaskhigh.php
     *
     * @param string $function_name
     * @param string $workload
     * @param mixed  $context
     * @param string $unique
     *
     * @return GearmanTask A GearmanTask object or false if the task could not be added
     */
    public function addTaskHigh($function_name, $workload, $context = null, $unique = null) { }

    /**
     * Adds a high priority background task to be run in parallel with other tasks.
     * Call this method for all the tasks to be run in parallel, then call
     * GearmanClient::runTasks to perform the work. Tasks with a high priority will be
     * selected from the queue before those of normal or low priority.
     *
     * @link http://php.net/manual/en/gearmanclient.addtaskhighbackground.php
     *
     * @param string $function_name
     * @param string $workload
     * @param mixed  $context
     * @param string $unique
     *
     * @return GearmanTask A GearmanTask object or false if the task could not be added
     */
    public function addTaskHighBackground($function_name, $workload, $context = null, $unique = null) { }

    /**
     * Adds a low priority background task to be run in parallel with other tasks. Call
     * this method for all the tasks to be run in parallel, then call
     * GearmanClient::runTasks to perform the work. Tasks with a low priority will be
     * selected from the queue after those of normal or low priority.
     *
     * @link http://php.net/manual/en/gearmanclient.addtasklow.php
     *
     * @param string $function_name
     * @param string $workload
     * @param mixed  $context
     * @param string $unique
     *
     * @return GearmanTask A GearmanTask object or false if the task could not be added
     */
    public function addTaskLow($function_name, $workload, $context = null, $unique = null) { }

    /**
     * Adds a low priority background task to be run in parallel with other tasks. Call
     * this method for all the tasks to be run in parallel, then call
     * GearmanClient::runTasks to perform the work. Tasks with a low priority will be
     * selected from the queue after those of normal or high priority.
     *
     * @link http://php.net/manual/en/gearmanclient.addtasklowbackground.php
     *
     * @param string $function_name
     * @param string $workload
     * @param mixed  $context
     * @param string $unique
     *
     * @return GearmanTask A GearmanTask object or false if the task could not be added
     */
    public function addTaskLowBackground($function_name, $workload, $context = null, $unique = null) { }

    /**
     * Used to request status information from the Gearman server, which will call the
     * specified status callback (set using GearmanClient::setStatusCallback).
     *
     * @link http://php.net/manual/en/gearmanclient.addtaskstatus.php
     *
     * @param string $job_handle The job handle for the task to get status for
     * @param string $context    Data to be passed to the status callback, generally a
     *                           reference to an array or object
     *
     * @return GearmanTask A GearmanTask object
     */
    public function addTaskStatus($job_handle, $context = null) { }

    /**
     * Clears all the task callback functions that have previously been set.
     *
     * @link http://php.net/manual/en/gearmanclient.clearcallbacks.php
     * @return bool Always returns true
     */
    public function clearCallbacks() { }

    /**
     * Get the application context previously set with GearmanClient::setContext.
     *
     * @link http://php.net/manual/en/gearmanclient.context.php
     * @return string The same context data structure set with GearmanClient::setContext
     */
    public function context() { }

    /**
     * Runs a task in the background, returning a job handle which can be used to get
     * the status of the running task.
     *
     * @link http://php.net/manual/en/gearmanclient.dobackground.php
     *
     * @param string $function_name
     * @param string $workload
     * @param string $unique
     *
     * @return string The job handle for the submitted task
     */
    public function doBackground($function_name, $workload, $unique = null) { }

    /**
     * Runs a single high priority task and returns a string representation of the
     * result. It is up to the GearmanClient and GearmanWorker to agree on the format
     * of the result. High priority tasks will get precedence over normal and low
     * priority tasks in the job queue.
     *
     * @link http://php.net/manual/en/gearmanclient.dohigh.php
     *
     * @param string $function_name
     * @param string $workload
     * @param string $unique
     *
     * @return string A string representing the results of running a task
     */
    public function doHigh($function_name, $workload, $unique = null) { }

    /**
     * Runs a high priority task in the background, returning a job handle which can be
     * used to get the status of the running task. High priority tasks take precedence
     * over normal and low priority tasks in the job queue.
     *
     * @link http://php.net/manual/en/gearmanclient.dohighbackground.php
     *
     * @param string $function_name
     * @param string $workload
     * @param string $unique
     *
     * @return string The job handle for the submitted task
     */
    public function doHighBackground($function_name, $workload, $unique = null) { }

    /**
     * Gets that job handle for a running task. This should be used between repeated
     * GearmanClient::do calls. The job handle can then be used to get information on
     * the task.
     *
     * @link http://php.net/manual/en/gearmanclient.dojobhandle.php
     * @return string The job handle for the running task
     */
    public function doJobHandle() { }

    /**
     * Runs a single low priority task and returns a string representation of the
     * result. It is up to the GearmanClient and GearmanWorker to agree on the format
     * of the result. Normal and high priority tasks will get precedence over low
     * priority tasks in the job queue.
     *
     * @link http://php.net/manual/en/gearmanclient.dolow.php
     *
     * @param string $function_name
     * @param string $workload
     * @param string $unique
     *
     * @return string A string representing the results of running a task
     */
    public function doLow($function_name, $workload, $unique = null) { }

    /**
     * Runs a low priority task in the background, returning a job handle which can be
     * used to get the status of the running task. Normal and high priority tasks take
     * precedence over low priority tasks in the job queue.
     *
     * @link http://php.net/manual/en/gearmanclient.dolowbackground.php
     *
     * @param string $function_name
     * @param string $workload
     * @param string $unique
     *
     * @return string The job handle for the submitted task
     */
    public function doLowBackground($function_name, $workload, $unique = null) { }

    /**
     * Runs a single task and returns a string representation of the
     * result. It is up to the GearmanClient and GearmanWorker to agree on the format
     * of the result. Normal and high priority tasks will get precedence over low
     * priority tasks in the job queue.
     *
     * @link http://php.net/manual/en/gearmanclient.dolow.php
     *
     * @param string $function_name
     * @param string $workload
     * @param string $unique
     *
     * @return string A string representing the results of running a task
     */
    public function doNormal($function_name, $workload, $unique = null) { }

    /**
     * Returns the status for the running task. This should be used between repeated
     * GearmanClient::do calls.
     *
     * @link http://php.net/manual/en/gearmanclient.dostatus.php
     * @return array An array representing the percentage completion given as a fraction, with
     *         the first element the numerator and the second element the denomintor
     */
    public function doStatus() { }

    /**
     * Returns an error string for the last error encountered.
     *
     * @link http://php.net/manual/en/gearmanclient.error.php
     * @return string A human readable error string
     */
    public function error() { }

    /**
     * Value of errno in the case of a GEARMAN_ERRNO return value.
     *
     * @link http://php.net/manual/en/gearmanclient.geterrno.php
     * @return int A valid Gearman errno
     */
    public function getErrno() { }

    /**
     * Object oriented style (method):.
     *
     * @link http://php.net/manual/en/gearmanclient.jobstatus.php
     *
     * @param string $job_handle
     *
     * @return array An array containing status information for the job corresponding to the
     *         supplied job handle. The first array element is a boolean indicating whether the
     *         job is even known, the second is a boolean indicating whether the job is still
     *         running, and the third and fourth elements correspond to the numerator and
     *         denominator of the fractional completion percentage, respectively
     */
    public function jobStatus($job_handle) { }

    /**
     */
    public function options() { }

    /**
     * Removes (unsets) one or more options.
     *
     * @link http://php.net/manual/en/gearmanclient.removeoptions.php
     *
     * @param int $options The options to be removed (unset)
     *
     * @return bool Always returns true
     */
    public function removeOptions($options) { }

    /**
     * Returns the last Gearman return code.
     *
     * @link http://php.net/manual/en/gearmanclient.returncode.php
     * @return int A valid Gearman return code
     */
    public function returnCode() { }

    /**
     * For a set of tasks previously added with GearmanClient::addTask,
     * GearmanClient::addTaskHigh, GearmanClient::addTaskLow,
     * GearmanClient::addTaskBackground, GearmanClient::addTaskHighBackground, or
     * GearmanClient::addTaskLowBackground, this call starts running the tasks in
     * parallel.
     *
     * @link http://php.net/manual/en/gearmanclient.runtasks.php
     * @return bool
     */
    public function runTasks() { }

    /**
     * Use to set a function to be called when a task is completed. The callback
     * function should accept a single argument, a GearmanTask oject.
     *
     * @link http://php.net/manual/en/gearmanclient.setcompletecallback.php
     *
     * @param callback $callback A function to be called
     *
     * @return bool
     */
    public function setCompleteCallback($callback) { }

    /**
     * Sets an arbitrary string to provide application context that can later be
     * retrieved by GearmanClient::context.
     *
     * @link http://php.net/manual/en/gearmanclient.setcontext.php
     *
     * @param string $context Arbitrary context data
     *
     * @return bool Always returns true
     */
    public function setContext($context) { }

    /**
     * Sets a function to be called when a task is received and queued by the Gearman
     * job server. The callback should accept a single argument, a GearmanClient oject.
     *
     * @link http://php.net/manual/en/gearmanclient.setcreatedcallback.php
     *
     * @param string $callback A function to call
     *
     * @return bool
     */
    public function setCreatedCallback($callback) { }

    /**
     * Sets the callback function for accepting data packets for a task. The callback
     * function should take a single argument, a GearmanTask object.
     *
     * @link http://php.net/manual/en/gearmanclient.setdatacallback.php
     *
     * @param callback $callback A function or method to call
     *
     * @return bool
     */
    public function setDataCallback($callback) { }

    /**
     * Specifies a function to call when a worker for a task sends an exception.
     *
     * @link http://php.net/manual/en/gearmanclient.setexceptioncallback.php
     *
     * @param callback $callback Function to call when the worker throws an exception
     *
     * @return bool
     */
    public function setExceptionCallback($callback) { }

    /**
     * Sets the callback function to be used when a task does not complete
     * successfully. The function should accept a single argument, a GearmanTask object.
     *
     * @link http://php.net/manual/en/gearmanclient.setfailcallback.php
     *
     * @param callback $callback A function to call
     *
     * @return bool
     */
    public function setFailCallback($callback) { }

    /**
     * Sets one or more client options.
     *
     * @link http://php.net/manual/en/gearmanclient.setoptions.php
     *
     * @param int $options The options to be set
     *
     * @return bool Always returns true
     */
    public function setOptions($options) { }

    /**
     * Sets a callback function used for getting updated status information from a
     * worker. The function should accept a single argument, a GearmanTask object.
     *
     * @link http://php.net/manual/en/gearmanclient.setstatuscallback.php
     *
     * @param callback $callback A function to call
     *
     * @return bool
     */
    public function setStatusCallback($callback) { }

    /**
     * Sets the timeout for socket I/O activity.
     *
     * @link http://php.net/manual/en/gearmanclient.settimeout.php
     *
     * @param int $timeout An interval of time in milliseconds
     *
     * @return bool Always returns true
     */
    public function setTimeout($timeout) { }

    /**
     * Sets a function to be called when a worker sends a warning. The callback should
     * accept a single argument, a GearmanTask object.
     *
     * @link http://php.net/manual/en/gearmanclient.setwarningcallback.php
     *
     * @param callback $callback A function to call
     *
     * @return bool
     */
    public function setWarningCallback($callback) { }

    /**
     * Sets a function to be called when a worker needs to send back data prior to job
     * completion. A worker can do this when it needs to send updates, send partial
     * results, or flush data during long running jobs. The callback should accept a
     * single argument, a GearmanTask object.
     *
     * @link http://php.net/manual/en/gearmanclient.setworkloadcallback.php
     *
     * @param callback $callback A function to call
     *
     * @return bool
     */
    public function setWorkloadCallback($callback) { }

    /**
     * Returns the timeout in milliseconds to wait for I/O activity.
     *
     * @link http://php.net/manual/en/gearmanclient.timeout.php
     * @return int Timeout in milliseconds to wait for I/O activity. A negative value means an
     *         infinite timeout
     */
    public function timeout() { }

    /**
     */
    public function wait() { }
}

/**
 * Class: GearmanException
 *
 * @link http://php.net/manual/en/class.gearmanexception.php
 */
class GearmanException extends Exception
{
}

/**
 * Class: GearmanJob
 *
 * @link http://php.net/manual/en/class.gearmanjob.php
 */
class GearmanJob
{
    /**
     * Create a GearmanJob instance.
     *
     * @link http://php.net/manual/en/gearmanjob.construct.php
     */
    public function __construct() { }

    /**
     * Returns the function name for this job. This is the function the work will
     * execute to perform the job.
     *
     * @link http://php.net/manual/en/gearmanjob.functionname.php
     * @return string The name of a function
     */
    public function functionName() { }

    /**
     * Returns the opaque job handle assigned by the job server.
     *
     * @link http://php.net/manual/en/gearmanjob.handle.php
     * @return string An opaque job handle
     */
    public function handle() { }

    /**
     * Returns the last return code issued by the job server.
     *
     * @link http://php.net/manual/en/gearmanjob.returncode.php
     * @return int A valid Gearman return code
     */
    public function returnCode() { }

    /**
     * Sends result data and the complete status update for this job.
     *
     * @link http://php.net/manual/en/gearmanjob.sendcomplete.php
     *
     * @param string $result Serialized result data
     *
     * @return bool
     */
    public function sendComplete($result) { }

    /**
     * Sends data to the job server (and any listening clients) for this job.
     *
     * @link http://php.net/manual/en/gearmanjob.senddata.php
     *
     * @param string $data Arbitrary serialized data
     *
     * @return bool
     */
    public function sendData($data) { }

    /**
     * Sends the supplied exception when this job is running.
     *
     * @link http://php.net/manual/en/gearmanjob.sendexception.php
     *
     * @param string $exception An exception description
     *
     * @return bool
     */
    public function sendException($exception) { }

    /**
     * Sends failure status for this job, indicating that the job failed in a known way
     * (as opposed to failing due to a thrown exception).
     *
     * @link http://php.net/manual/en/gearmanjob.sendfail.php
     * @return bool
     */
    public function sendFail() { }

    /**
     * Sends status information to the job server and any listening clients. Use this
     * to specify what percentage of the job has been completed.
     *
     * @link http://php.net/manual/en/gearmanjob.sendstatus.php
     *
     * @param int $numerator   The numerator of the precentage completed expressed as a
     *                         fraction
     * @param int $denominator The denominator of the precentage completed expressed as
     *                         a fraction
     *
     * @return bool
     */
    public function sendStatus($numerator, $denominator) { }

    /**
     * Sends a warning for this job while it is running.
     *
     * @link http://php.net/manual/en/gearmanjob.sendwarning.php
     *
     * @param string $warning A warning messages
     *
     * @return bool
     */
    public function sendWarning($warning) { }

    /**
     * Sets the return value for this job, indicates how the job completed.
     *
     * @link http://php.net/manual/en/gearmanjob.setreturn.php
     *
     * @param string $gearman_return_t A valid Gearman return value
     *
     * @return bool Description
     */
    public function setReturn($gearman_return_t) { }

    /**
     * Returns the unique identifiter for this job. The identifier is assigned by the
     * client.
     *
     * @link http://php.net/manual/en/gearmanjob.unique.php
     * @return string An opaque unique identifier
     */
    public function unique() { }

    /**
     * Returns the workload for the job. This is serialized data that is to be
     * processed by the worker.
     *
     * @link http://php.net/manual/en/gearmanjob.workload.php
     * @return string Serialized data
     */
    public function workload() { }

    /**
     * Returns the size of the job's work load (the data the worker is to process) in
     * bytes.
     *
     * @link http://php.net/manual/en/gearmanjob.workloadsize.php
     * @return int The size in bytes
     */
    public function workloadSize() { }
}

/**
 * Class: GearmanTask
 *
 * @link http://php.net/manual/en/class.gearmantask.php
 */
class GearmanTask
{
    /**
     * Create a GearmanTask instance.
     *
     * @link http://php.net/manual/en/gearmantask.construct.php
     */
    public function __construct() { }

    /**
     * Returns data being returned for a task by a worker.
     *
     * @link http://php.net/manual/en/gearmantask.data.php
     * @return string|false The serialized data, or false if no data is present
     */
    public function data() { }

    /**
     * Returns the size of the data being returned for a task.
     *
     * @link http://php.net/manual/en/gearmantask.datasize.php
     * @return int The data size, or false if there is no data
     */
    public function dataSize() { }

    /**
     * Returns the name of the function this task is associated with, i.e., the
     * function the Gearman worker calls.
     *
     * @link http://php.net/manual/en/gearmantask.functionname.php
     * @return string A function name
     */
    public function functionName() { }

    /**
     * Gets the status information for whether or not this task is known to the job
     * server.
     *
     * @link http://php.net/manual/en/gearmantask.isknown.php
     * @return bool true if the task is known, false otherwise
     */
    public function isKnown() { }

    /**
     * Indicates whether or not this task is currently running.
     *
     * @link http://php.net/manual/en/gearmantask.isrunning.php
     * @return bool true if the task is running, false otherwise
     */
    public function isRunning() { }

    /**
     * Returns the job handle for this task.
     *
     * @link http://php.net/manual/en/gearmantask.jobhandle.php
     * @return string The opaque job handle
     */
    public function jobHandle() { }

    /**
     * Read work or result data into a buffer for a task.
     *
     * @link http://php.net/manual/en/gearmantask.recvdata.php
     *
     * @param int $data_len Length of data to be read
     *
     * @return array|false An array whose first element is the length of data read and the second is
     *         the data buffer. Returns false if the read failed.
     */
    public function recvData($data_len) { }

    /**
     * Returns the last Gearman return code for this task.
     *
     * @link http://php.net/manual/en/gearmantask.returncode.php
     * @return int A valid Gearman return code
     */
    public function returnCode() { }

    /**
     * Send data for a task.
     *
     * @link http://php.net/manual/en/gearmantask.sendworkload.php
     *
     * @param string $data Data to send to the worker
     *
     * @return int|false The length of data sent, or false if the send failed
     */
    public function sendWorkload($data) { }

    /**
     * Returns the denominator of the percentage of the task that is complete expressed
     * as a fraction.
     *
     * @link http://php.net/manual/en/gearmantask.taskdenominator.php
     * @return int|false A number between 0 and 100, or false if cannot be determined
     */
    public function taskDenominator() { }

    /**
     * Returns the numerator of the percentage of the task that is complete expressed
     * as a fraction.
     *
     * @link http://php.net/manual/en/gearmantask.tasknumerator.php
     * @return int|false A number between 0 and 100, or false if cannot be determined
     */
    public function taskNumerator() { }

    /**
     * Returns the unique identifier for this task. This is assigned by the
     * GearmanClient, as opposed to the job handle which is set by the Gearman job
     * server.
     *
     * @link http://php.net/manual/en/gearmantask.unique.php
     * @return string|false The unique identifier, or false if no identifier is assigned
     */
    public function unique() { }
}

/**
 * Class: GearmanWorker
 *
 * @link http://php.net/manual/en/class.gearmanworker.php
 */
class GearmanWorker
{
    /**
     * Creates a GearmanWorker instance representing a worker that connects to the job
     * server and accepts tasks to run.
     *
     * @link http://php.net/manual/en/gearmanworker.construct.php
     */
    public function __construct() { }

    /**
     * Registers a function name with the job server and specifies a callback
     * corresponding to that function. Optionally specify extra application context
     * data to be used when the callback is called and a timeout.
     *
     * @link http://php.net/manual/en/gearmanworker.addfunction.php
     *
     * @param string   $function_name The name of a function to register with the job
     *                                server
     * @param callback $function      A callback that gets called when a job for the
     *                                registered function name is submitted
     * @param mixed    $context       A reference to arbitrary application context data that can
     *                                be modified by the worker function
     * @param int      $timeout       An interval of time in seconds
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function addFunction($function_name, $function, $context = null, $timeout = 0) { }

    /**
     * Adds one or more options to the options previously set.
     *
     * @link http://php.net/manual/en/gearmanworker.addoptions.php
     *
     * @param int $option The options to be added
     *
     * @return bool Always returns true
     */
    public function addOptions($option) { }

    /**
     * Adds a job server to this worker. This goes into a list of servers than can be
     * used to run jobs. No socket I/O happens here.
     *
     * @link http://php.net/manual/en/gearmanworker.addserver.php
     *
     * @param string $host
     * @param int    $port
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function addServer($host = '127.0.0.1', $port = 4730) { }

    /**
     * Adds one or more job servers to this worker. These go into a list of servers
     * that can be used to run jobs. No socket I/O happens here.
     *
     * @link http://php.net/manual/en/gearmanworker.addservers.php
     *
     * @param string $servers A comma separated list of job servers in the format
     *                        host:port. If no port is specified, it defaults to 4730
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function addServers($servers = '127.0.0.1:4730') { }

    /**
     * Test job server response.
     *
     * @param $workload
     */
    public function echo($workload) { }

    /**
     * Returns an error string for the last error encountered.
     *
     * @link http://php.net/manual/en/gearmanworker.error.php
     * @return string An error string
     */
    public function error() { }

    /**
     * Returns the value of errno in the case of a GEARMAN_ERRNO return value.
     *
     * @link http://php.net/manual/en/gearmanworker.geterrno.php
     * @return int A valid errno
     */
    public function getErrno() { }

    /**
     * Gets the options previously set for the worker.
     *
     * @link http://php.net/manual/en/gearmanworker.options.php
     * @return int The options currently set for the worker
     */
    public function options() { }

    /**
     * Registers a function name with the job server with an optional timeout. The
     * timeout specifies how many seconds the server will wait before marking a job as
     * failed. If the timeout is set to zero, there is no timeout.
     *
     * @link http://php.net/manual/en/gearmanworker.register.php
     *
     * @param string $function_name The name of a function to register with the job
     *                              server
     * @param int    $timeout       An interval of time in seconds
     *
     * @return bool A standard Gearman return value
     */
    public function register($function_name, $timeout) { }

    /**
     * Removes (unsets) one or more worker options.
     *
     * @link http://php.net/manual/en/gearmanworker.removeoptions.php
     *
     * @param int $option The options to be removed (unset)
     *
     * @return bool Always returns true
     */
    public function removeOptions($option) { }

    /**
     * Returns the last Gearman return code.
     *
     * @link http://php.net/manual/en/gearmanworker.returncode.php
     * @return int A valid Gearman return code
     */
    public function returnCode() { }

    /**
     * Give the worker an identifier so it can be tracked when asking gearmand for
     * the list of available workers.
     *
     * @link http://php.net/manual/en/gearmanworker.setid.php
     *
     * @param int $id A string identifier
     *
     * @return bool Returns TRUE on success or FALSE on failure
     */
    public function setId($id) { }

    /**
     * Sets one or more options to the supplied value.
     *
     * @link http://php.net/manual/en/gearmanworker.setoptions.php
     *
     * @param int $option The options to be set
     *
     * @return bool Always returns true
     */
    public function setOptions($option) { }

    /**
     * Sets the interval of time to wait for socket I/O activity.
     *
     * @link http://php.net/manual/en/gearmanworker.settimeout.php
     *
     * @param int $timeout An interval of time in milliseconds. A negative value
     *                     indicates an infinite timeout
     *
     * @return bool Always returns true
     */
    public function setTimeout($timeout) { }

    /**
     * Returns the current time to wait, in milliseconds, for socket I/O activity.
     *
     * @link http://php.net/manual/en/gearmanworker.timeout.php
     * @return int A time period is milliseconds. A negative value indicates an infinite
     *         timeout
     */
    public function timeout() { }

    /**
     * Unregisters a function name with the job servers ensuring that no more jobs (for
     * that function) are sent to this worker.
     *
     * @link http://php.net/manual/en/gearmanworker.unregister.php
     *
     * @param string $function_name The name of a function to register with the job
     *                              server
     *
     * @return bool A standard Gearman return value
     */
    public function unregister($function_name) { }

    /**
     * Unregisters all previously registered functions, ensuring that no more jobs are
     * sent to this worker.
     *
     * @link http://php.net/manual/en/gearmanworker.unregisterall.php
     * @return bool A standard Gearman return value
     */
    public function unregisterAll() { }

    /**
     * Causes the worker to wait for activity from one of the Gearman job servers when
     * operating in non-blocking I/O mode. On failure, issues a E_WARNING with the last
     * Gearman error encountered.
     *
     * @link http://php.net/manual/en/gearmanworker.wait.php
     * @return bool
     */
    public function wait() { }

    /**
     * Waits for a job to be assigned and then calls the appropriate callback function.
     * Issues an E_WARNING with the last Gearman error if the return code is not one of
     * GEARMAN_SUCCESS, GEARMAN_IO_WAIT, or GEARMAN_WORK_FAIL.
     *
     * @link http://php.net/manual/en/gearmanworker.work.php
     * @return bool
     */
    public function work() { }
}
