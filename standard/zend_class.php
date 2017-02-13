<?php
/**
 * PHPStorm stub file for Zend classes.
 */

/**
 * Class JavaException
 */
class JavaException
{
    /**
     * Get Java exception that led to this exception
     *
     * @return object
     */
    public function getCause() { }
}

/**
 * Describing a job in a queue
 * In order to add/modify a job in the queue, a Job class must be created/retrieved and than saved in a queue
 *
 * For simplicity, a job can be added directly to a queue and without creating an instant of a Queue object
 */
class ZendAPI_Job
{
    /**
     * The application id of the job
     * If the application id is not set, this job may get an application id automatically from the queue
     * (if the queue was assigned one). By default it is null (which indicates no application id is assigned)
     *
     * @var string
     */
    public $_application_id;
    /**
     * UNIX timestamp that it's the last time this job should occurs. If _interval was set, and _end_time
     * was not, then this job will run forever.
     * By default there is no end_time, so recurrent job will run forever. If the job is not recurrent
     * (occurs only once) then the job will run at most once. If end_time has reached and the job was not
     * execute yet, it will not run.
     *
     * @var int
     */
    public $_end_time;
    /**
     * Bit mask holding the global variables that the user want the job's script to have when it's called
     * Options are prefixed with "JOB_QUEUE_SAVE_" and may be:
     * POST|GET|COOKIE|SESSION|RAW_POST|SERVER|FILES|ENV
     * By default there are no global variables we want to add to the job's script
     * i.e. In order to save the current GET and COOKIE global variables,
     * this property should be JOB_QUEUE_SAVE_GET|JOB_QUEUE_SAVE_COOKIE (or the integer 6)
     * In that case (of GET and COOKIE), when the job is added, the current $_GET and
     * $_COOKIE variables  should be saved, and when the job's script is called,
     * those global variables should be populated
     *
     * @var int
     */
    public $_global_variables = 0;
    /**
     * The host that the job was submit from
     *
     * @var string
     */
    public $_host;
    /**
     * Unique id of the Job in the job queue
     *
     * @var int
     */
    public $_id;
    /**
     * The job running frequency in seconds. The job should run every _internal seconds
     * This property applys only to recurrent job.
     * By default, its value is 0 e.g. run it only once.
     *
     * @var int
     */
    public $_interval = 0;
    /**
     * A short string describing the job
     *
     * @var string
     */
    public $_name;
    /**
     * The job output after executing
     *
     * @var string
     */
    public $_output;
    /**
     * The job may have a dependency (another job that must be performed before this job)
     * This property hold the id of the job that must be performed. if this variable is an array of integers,
     * it means that there are several jobs that must be performed before this job
     * By default there are no dependencies
     *
     * @var mixed (int|array)
     */
    public $_predecessor;
    /**
     * A bit that determine whether job can be deleted from history. When set, removeJob will not
     * delete the job from history.
     *
     * @var int
     */
    public $_preserved = 0;
    /**
     * The priority of the job, options are the priority constants
     * By default the priority is set to normal (JOB_QUEUE_PRIORITY_NORMAL)
     *
     * @var int
     */
    public $_priority = JOB_QUEUE_PRIORITY_NORMAL;
    /**
     * The time that this job should be performed, this variables is the UNIX timestamp.
     * If set to 0, it means that the job should be performed now (or at least as soon as possible)
     * By default there is no scheduled time, which means we want to perform the job as soon as possible
     *
     * @var int
     */
    public $_scheduled_time = 0;
    /**
     * Full path of the script that this job calls when it's processed
     *
     * @var string
     */
    public $_script;
    /**
     * The status of the job
     * By default, the job status is waiting to being execute.
     * The status is determent by the queue and can not be modify by the user.
     *
     * @var int
     */
    public $_status = JOB_QUEUE_STATUS_WAITING;
    /**
     * Array holding all the variables that the user wants the job's script to have when it's called
     * The structure is variable_name => variable_value
     * i.e. if the user_variables array is array('my_var' => 8), when the script is called,
     * a global variable called $my_var will have the int value of 8
     * By default there are no variables that we want to add to the job's script
     *
     * @var array
     */
    public $_user_variables = [];

    /**
     * Instantiate a Job object, describe all the information and properties of a job
     *
     * @param script $script relative path (relative to document root supplied in ini file) of the script this job
     *                       should call when it's executing
     *
     * @return Job
     */
    public function ZendAPI_Job($script) { }

    /**
     * Add the job the the specified queue (without instantiating a JobQueue object)
     * This function should be used for extreme simplicity of the user when adding a single job,
     * when the user want to insert more than one job and/or manipulating other jobs (or job tasks)
     * he should create and use the JobQueue object
     * Actually what this function do is to create a new JobQueue, login to it (with the given parameters),
     * add this job to it and logout
     *
     * @param string $jobqueue_url Full address of the queue we want to connect to
     * @param string $password     For authentication, the queue password
     *
     * @return int The added job id or false on failure
     */
    public function addJobToQueue($jobqueue_url, $password) { }

    public function getApplicationID() { }

    // All properties SET functions
    public function getEndTime() { }

    public function getGlobalVariables() { }

    public function getHost() { }

    public function getID() { }

    public function getInterval() { }

    public function getJobDependency() { }

    public function getJobName() { }

    public function getJobPriority() { }

    /**
     * Get the current status of the job
     * If this job was created and not returned from a queue (using the JobQueue::GetJob() function),
     *  the function will return false
     * The status is one of the constants with the "JOB_QUEUE_STATUS_" prefix.
     * E.g. job was performed and failed, job is waiting etc.
     *
     * @return int
     */
    public function getJobStatus() { }

    /**
     * For recurring job get the status of the last execution. For simple job,
     * getLastPerformedStatus is equivalent to getJobStatus.
     * jobs that haven't been executed yet will return STATUS_WAITING
     *
     * @return int
     */
    public function getLastPerformedStatus() { }

    /**
     * Get the job output
     *
     * @return An HTML representing the job output
     */
    public function getOutput() { }

    // All properties GET functions
    public function getPreserved() { }

    /**
     * Get the job properties
     *
     * @return array The same format of job options array as in the Job constructor
     */
    public function getProperties() { }

    public function getScheduledTime() { }

    public function getScript() { }

    /**
     * Get how much seconds there are until the next time the job will run.
     * If the job is not recurrence or it past its end time, then return 0.
     *
     * @return int
     */
    public function getTimeToNextRepeat() { }

    public function getUserVariables() { }

    public function setApplicationID($app_id) { }

    public function setGlobalVariables($vars) { }

    public function setJobDependency($job_id) { }

    public function setJobName($name) { }

    /**
     * Set a new priority to the job
     *
     * @param int $priority Priority options are constants with the "JOB_QUEUE_PRIORITY_" prefix
     */
    public function setJobPriority($priority) { }

    public function setPreserved($preserved) { }

    public function setRecurrenceData($interval, $end_time = null) { }

    public function setScheduledTime($timestamp) { }

    public function setScript($script) { }

    public function setUserVariables($vars) { }
}

/**
 * Class ZendAPI_Queue
 */
class ZendAPI_Queue
{
    public $_jobqueue_url;

    /**
     * Constructor for a job queue connection
     *
     * @param string $queue_url Full address where the queue is in the form host:port
     *
     * @return zendapi_queue object
     */
    public function zendapi_queue($queue_url) { }

    /**
     * Insert a new job to the queue, the Job is passed by reference because
     * its new job ID and status will be set in the Job object
     * If the returned job id is 0 it means the job could be added to the queue
     *
     * @param Job $job The Job we want to insert to the queue (by ref.)
     *
     * @return int The inserted job id
     */
    public function addJob(&$job) { }

    /**
     * Return all the application ids exists in queue.
     *
     * @return array
     */
    public function getAllApplicationIDs() { }

    /**
     * Return all the hosts that jobs were submitted from.
     *
     * @return array
     */
    public function getAllhosts() { }

    /**
     * Return finished jobs (either failed or succeeded) between time range allowing paging.
     * Jobs are sorted by job id descending.
     *
     * @param int $status     . Filter to jobs by status, 1-success, 0-failed either logical or execution.
     * @param int $start_time UNIX timestamp. Get only jobs finished after $start_time.
     * @param int $end_time   UNIX timestamp. Get only jobs finished before $end_time.
     * @param int $index      . Get jobs starting from the $index-th place.
     * @param int $count      . Get only $count jobs.
     * @param int $total      . Pass by reference. Return the total number of jobs statisifed the query criteria.
     *
     * @return array of jobs.
     */
    public function getHistoricJobs($status, $start_time, $end_time, $index, $count, &$total) { }

    /**
     * Return a Job object that describing a job in the queue
     *
     * @param int $job_id The job id
     *
     * @return Job Object describing a job in the queue
     */
    public function getJob($job_id) { }

    /**
     * Return a list of jobs in the queue according to the options given in the filter_options parameter, doesn't
     * return jobs in "final states" (failed, complete) If application id is set for this queue, only jobs with this
     * application id will be returned
     *
     * @param array $filter_options          Array of optional filter options to filter the jobs we want to get
     *                                       from the queue. If not set, all jobs will be returned.<br>
     *                                       Options can be: priority, application_id, name, status, recurring.
     * @param int   $max_jobs                Maximum jobs to retrive. Default is -1, getting all jobs available.
     * @param bool  $with_globals_and_output . Whether gets the global variables dataand job output.
     *                                       Default is false.
     *
     * @return array  Jobs that satisfies filter_options.
     */
    public function getJobsInQueue($filter_options = null, $max_jobs = -1, $with_globals_and_output = false) { }

    /**
     * Return description of the last error occured in the queue object. After every
     *    method invoked an error string describing the error is store in the queue object.
     *
     * @return string
     */
    public function getLastError() { }

    /**
     * Return the number of jobs in the queue according to the options given in the filter_options parameter
     *
     * @param array $filter_options Array of optional filter options to filter the jobs we want to get from the queue.
     *                              If not set, all jobs will be counted.<br> Options can be: priority, application_id,
     *                              host, name, status, recurring.
     *
     * @return int  Number of jobs that satisfy filter_options.
     */
    public function getNumOfJobsInQueue($filter_options = null) { }

    /**
     * returns job statistics
     *
     * @return array with the following:
     * "total_complete_jobs"
     * "total_incomplete_jobs"
     * "average_time_in_queue"  [msec]
     * "average_waiting_time"   [sec]
     * "added_jobs_in_window"
     * "activated_jobs_in_window"
     * "completed_jobs_in_window"
     * moving window size can be set through ini file
     */
    public function getStatistics() { }

    /**
     * Returns whether a script exists in the document root
     *
     * @param string $path relative script path
     *
     * @return bool - TRUE if script exists in the document root FALSE otherwise
     */
    public function isScriptExists($path) { }

    /**
     * Returns whether the queue is suspended
     *
     * @return bool - TRUE if job is suspended FALSE otherwise
     */
    public function isSuspend() { }

    /**
     * Open a connection to a job queue
     *
     * @param string $password       For authentication, password must be specified to connect to a queue
     * @param int    $application_id Optional, if set, all subsequent calls to job related methods will use this
     *                               application id (unless explicitly specified otherwise). I.e. When adding new job,
     *                               unless this job already set an application id, the job will be assigned the queue
     *                               application id
     *
     * @return bool Success
     */
    public function login($password, $application_id = null) { }

    /**
     * Remove a job from the queue
     *
     * @param int|array $job_id The job id or array of job ids we want to remove from the queue
     *
     * @return bool Success/Failure
     */
    public function removeJob($job_id) { }

    /**
     * Requeue failed job back to the queue.
     *
     * @param Job $job job object to re-query
     *
     * @return bool - true or false.
     */
    public function requeueJob($job) { }

    /**
     * Resume a suspended job in the queue
     *
     * @param int|array $job_id The job id or array of job ids we want to resume
     *
     * @return bool Success/Failure (if the job wasn't suspended, the function will return false)
     */
    public function resumeJob($job_id) { }

    /**
     * Resumes queue operation
     *
     * @return bool - TRUE if successful FALSE otherwise
     */
    public function resumeQueue() { }

    /**
     * Sets a new maximum time for keeping historic jobs
     *
     * @return bool - TRUE if successful FALSE otherwise
     */
    public function setMaxHistoryTime() { }

    /**
     * Suspend a job in the queue (without removing it)
     *
     * @param int|array $job_id The job id or array of job ids we want to suspend
     *
     * @return bool Success/Failure
     */
    public function suspendJob($job_id) { }

    /**
     * Suspends queue operation
     *
     * @return bool - TRUE if successful FALSE otherwise
     */
    public function suspendQueue() { }

    /**
     * Update an existing job in the queue with it's new properties. If job doesn't exists,
     * a new job will be added. Job is passed by reference and it's updated from the queue.
     *
     * @param Job $job The Job object, the ID of the given job is the id of the job we try to update.
     *                 If the given Job doesn't have an assigned ID, a new job will be added
     *
     * @return int The id of the updated job
     */
    public function updateJob(&$job) { }
}

/**
 * Class java
 */
class java
{
    /**
     * Create Java object
     *
     * @return java
     *
     * @param string $classname
     *
     * @vararg ...
     */
    public function java($classname) { }
}


