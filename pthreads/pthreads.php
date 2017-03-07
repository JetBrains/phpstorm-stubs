<?php

// Start of PECL pthreads 2.0.4

/**
 * The default options for all Threads, causes pthreads to copy the environment
 * when new Threads are started
 * @link http://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_ALL', 1118481);

/**
 * Do not inherit anything when new Threads are started
 * @link http://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_NONE', 0);

/**
 * Inherit INI entries when new Threads are started
 * @link http://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_INI', 1);

/**
 * Inherit user declared constants when new Threads are started
 * @link http://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_CONSTANTS', 16);

/**
 * Inherit user declared classes when new Threads are started
 * @link http://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_CLASSES', 4096);

/**
 * Inherit user declared functions when new Threads are started
 * @link http://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_FUNCTIONS', 256);

/**
 * Inherit included file information when new Threads are started
 * @link http://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_INCLUDES', 65536);

/**
 * Inherit all comments when new Threads are started
 * @link http://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_COMMENTS', 1048576);

/**
 * Allow new Threads to send headers to standard output (normally prohibited)
 * @link http://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_ALLOW_HEADERS', 16777216);

/**
 * A Pool is a container for, and controller of, an adjustable number of
 * Workers.<br/>
 * Pooling provides a higher level abstraction of the Worker functionality,
 * including the management of references in the way required by pthreads.
 * @link http://www.php.net/manual/en/class.pool.php
 */
class Pool {
    /**
     * Maximum number of Workers this Pool can use
     * @var integer
     */
    protected $size;

    /**
     * The class of the Worker
     * @var string
     */
    protected $class;

    /**
     * The arguments for constructor of new Workers
     * @var array
     */
    protected $ctor;

    /**
     * References to Workers
     * @var array
     */
    protected $workers;

    /**
     * References to Threaded objects submitted to the Pool
     * @var array
     */
    protected $work;

    /**
     * Offset in workers of the last Worker used
     * @var integer
     */
    protected $last;

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Creates a new Pool of Workers
     * @link http://www.php.net/manual/en/pool.construct.php
     * @param integer $size <p>The maximum number of Workers this Pool can create</p>
     * @param string $class <p>The class for new Workers</p>
     * @param array $ctor <p>An array of arguments to be passed to new Workers</p>
     * @return Pool <p>the new Pool</p>
     */
    public function __construct( $size, $class, $ctor=[] ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Allows the Pool to collect references determined to be garbage by the
     * given collector
     * @link http://www.php.net/manual/en/pool.collect.php
     * @param Callable $collector
     * @return void
     */
    public function collect( $collector ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Resize the Pool
     * @link http://www.php.net/manual/en/pool.resize.php
     * @param integer $size <p>The maximum number of Workers this Pool can create</p>
     * @return void
     */
    public function resize( $size ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Shutdown the Workers in this Pool
     * @link http://www.php.net/manual/en/pool.shutdown.php
     * @return void
     */
    public function shutdown() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Submit the task to the next Worker in the Pool
     * @link http://www.php.net/manual/en/pool.submit.php
     * @param Threaded $task
     * @return integer <p>the identifier of the Worker executing the object</p>
     */
    public function submit( $task ) {}

    /**
     * Submit the object to the specified Worker in the Pool
     * @link http://www.php.net/manual/en/pool.submitTo.php
     * @param integer $worker <p>The worker for execution</p>
     * @param Threaded $task <p>The task for execution</p>
     * @return integer <p>the identifier of the Worker that accepted the object</p>
     */
    public function submitTo( $worker, $task ) {}
}

/**
 * Threaded objects form the basis of pthreads ability to execute user code
 * asynchronously; they expose and include synchronization methods and various
 * useful interfaces.
 * @link http://www.php.net/manual/en/class.threaded.php
 */
class Threaded implements Traversable, Countable, ArrayAccess {
    /**
     * Worker object in which this Threaded is being executed
     * @var Worker
     */
    protected $worker;

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Fetches a chunk of the objects property table of the given size,
     * optionally preserving keys
     * @link http://www.php.net/manual/en/threaded.chunk.php
     * @param integer $size <p>The number of items to fetch</p>
     * @param boolean $preserve <p>Preserve the keys of members, by default false</p>
     * @return array <p>An array of items from the objects property table</p>
     */
    public function chunk( $size, $preserve ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Returns the number of properties for this object
     * @link http://www.php.net/manual/en/threaded.count.php
     * @return int <p>Returns the number of properties for this object</p>
     */
    public function count() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Retrieves terminal error information from the referenced object
     * @link http://www.php.net/manual/en/threaded.getterminationinfo.php
     * @return array <p>array containing the termination conditions of the referenced object</p>
     */
    public function getTerminationInfo() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Tell if the referenced object is executing
     * @link http://www.php.net/manual/en/thread.isrunning.php
     * @return boolean
     */
    public function isRunning() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Tell if the referenced object was terminated during execution; suffered
     * fatal errors, or threw uncaught exceptions
     * @link http://www.php.net/manual/en/threaded.isterminated.php
     * @return boolean
     */
    public function isTerminated() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Tell if the referenced object is waiting for notification
     * @link http://www.php.net/manual/en/threaded.iswaiting.php
     * @return boolean <p>A boolean indication of state</p>
     */
    public function isWaiting() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Lock the referenced objects property table
     * @link http://php.net/manual/en/threaded.lock.php
     * @link http://www.php.net/manual/en/threaded.lock.php
     * @return boolean
     */
    public function lock() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Merges data into the current object
     * @link http://www.php.net/manual/en/threaded.merge.php
     * @var mixed $from
     * @var mixed $overwrite [optional]
     * @return boolean
     */
    public function merge( $from, $overwrite = null ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Send notification to the referenced object
     * @link http://www.php.net/manual/en/threaded.notify.php
     * @return boolean
     */
    public function notify() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Pops an item from the objects property table
     * @link http://www.php.net/manual/en/threaded.pop.php
     * @return boolean
     */
    public function pop() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * The programmer should always implement the run method for objects
     * that are intended for execution.
     * @link http://www.php.net/manual/en/threaded.run.php
     * @return void
     */
    public function run() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Shifts an item from the objects property table
     * @link http://www.php.net/manual/en/threaded.shift.php
     * @return boolean
     */
    public function shift() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Executes the block while retaining the referenced objects
     * synchronization lock for the calling context
     * @link http://www.php.net/manual/en/threaded.synchronized.php
     * @param Closure $block
     * @param mixed $_ [optional]
     * @return mixed
     */
    public function synchronized( $block, $_ = null ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Unlock the referenced objects storage for the calling context
     * @link http://www.php.net/manual/en/threaded.unlock.php
     * @return boolean
     */
    public function unlock() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Will cause the calling context to wait for notification from the
     * referenced object
     * @link http://www.php.net/manual/en/threaded.wait.php
     * @param int $timeout [optional]
     * @return boolean
     */
    public function wait( $timeout = 0 ) {}


    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset) {
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset) {
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value) {
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset) {
    }




}

/**
 * Stackable is an alias of Threaded. This class name was used in pthreads until
 * version 2.0.0
 * @link http://www.php.net/manual/en/class.threaded.php
 */
class Stackable extends Threaded implements Traversable, Countable, ArrayAccess {

}

/**
 * When the start method of a Thread is invoked, the run method code will
 * be executed in separate Thread, asynchronously.<br/>After the run method
 * is executed the Thread will exit immediately, it will be joined with
 * the creating Thread at the approriate time.
 * @link http://www.php.net/manual/en/class.thread.php
 */
class Thread extends Threaded implements Traversable, Countable, ArrayAccess {
    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Detaches the referenced Thread from the calling context, dangerously!
     * @link http://www.php.net/manual/en/thread.detach.php
     * @return void
     */
    public function detach() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Will return the identity of the Thread that created the referenced Thread
     * @link http://www.php.net/manual/en/thread.getcreatorid.php
     * @return int <p>A numeric identity</p>
     */
    public function getCreatorId() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Return a reference to the currently executing Thread
     * @link http://www.php.net/manual/en/thread.getcurrentthread.php
     * @return Thread <p>An object representing the currently executing Thread</p>
     */
    public static function getCurrentThread() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Will return the identity of the currently executing Thread
     * @link http://www.php.net/manual/en/thread.getcurrentthreadid.php
     * @return int <p>A numeric identity</p>
     */
    public static function getCurrentThreadId() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Will return the identity of the referenced Thread
     * @link http://www.php.net/manual/en/thread.getthreadid.php
     * @return int <p>A numeric identity</p>
     */
    public function getThreadId() {}

    /**
     * (PECL pthreads &gt;= 2.0.1)
     * Will execute a Callable in the global scope
     * @link http://www.php.net/manual/en/thread.globally.php
     * @return mixed <p>The return value of the Callable</p>
     */
    public static function globally() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Tell if the referenced Thread has been joined
     * @link http://www.php.net/manual/en/thread.isjoined.php
     * @return boolean <p>A boolean indication of state</p>
     */
    public function isJoined() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Tell if the referenced Thread was started
     * @link http://www.php.net/manual/en/thread.isstarted.php
     * @return boolean <p>A boolean indication of state</p>
     */
    public function isStarted() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Causes the calling context to wait for the referenced Thread to finish executing
     * @link http://www.php.net/manual/en/thread.join.php
     * @return boolean <p>A boolean indication of success</p>
     */
    public function join() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Forces the referenced Thread to terminate
     * @link http://www.php.net/manual/en/thread.kill.php
     * @return bool <p>A boolean indication of success</p>
     */
    public function kill() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Will start a new Thread to execute the implemented run method
     * @link http://www.php.net/manual/en/thread.start.php
     * @param integer $options [optional] An optional mask of inheritance constants, by default <b>PTHREADS_INHERIT_ALL</b>
     * @return boolean <p>A boolean indication of success</p>
     */
    public function start( $options = 0 ) {}

}

/**
 * Worker Threads have a persistent context, as such should be used over
 * Threads in most cases.<br/>
 * When a Worker is started, the run method will be executed, but the Thread will
 * not leave until one of the following conditions are met:<br/>
 * - the Worker goes out of scope (no more references remain)<br/>
 * - the programmer calls shutdown<br/>
 * - the script dies<br/>
 * This means the programmer can reuse the context throughout execution; placing
 * objects on the stack of the Worker will cause the Worker to execute the stacked
 * objects run method.
 * @link http://www.php.net/manual/en/class.worker.php
 */
class Worker extends Thread implements Traversable, Countable, ArrayAccess {
    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Returns the number of objects waiting to be executed by the referenced Worker
     * @link http://www.php.net/manual/en/worker.getstacked.php
     * @return int <p>An numeric value</p>
     */
    public function getStacked() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Tell if the referenced Worker has been shutdown
     * @link http://www.php.net/manual/en/worker.isshutdown.php
     * @return boolean <p>A boolean indication of state</p>
     */
    public function isShutdown() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Tell if a Worker is executing Stackables
     * @link http://www.php.net/manual/en/worker.isworking.php
     * @return boolean <p>A boolean indication of state</p>
     */
    public function isWorking() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Shuts down the Worker after executing all the objects previously stacked
     * @link http://www.php.net/manual/en/worker.shutdown.php
     * @return boolean
     */
    public function shutdown() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Appends the referenced object to the stack of the referenced Worker
     * @link http://www.php.net/manual/en/worker.stack.php
     * @param Threaded $work <p>Threaded object to be executed by the referenced Worker</p>
     * @return int <p>The new length of the stack</p>
     */
    public function stack( &$work ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Removes the referenced object ( or all objects if parameters are void )
     * from stack of the referenced Worker
     * @link http://www.php.net/manual/en/worker.unstack.php
     * @param Threaded $work [optional] <p>Threaded object previously stacked onto Worker</p>
     * @return int <p>The new length of the stack</p>
     */
    public function unstack( &$work = null ) {}

}

/**
 * The static methods contained in the Mutex class provide direct access to Posix
 * Mutex functionality.
 * @link http://www.php.net/manual/en/class.mutex.php
 */
class Mutex {
    /**
     * Create, and optionally lock a new Mutex for the caller
     * @link http://www.php.net/manual/en/mutex.create.php
     * @param boolean $lock [optional] <p>Setting lock to true will lock the Mutex for the caller before returning the handle</p>
     * @return int <p>A newly created and optionally locked Mutex handle</p>
     */
    final public static function create ( $lock = false ) {}

    /**
     * Destroying Mutex handles must be carried out explicitly by the programmer when
     * they are finished with the Mutex handle.
     * @link http://www.php.net/manual/en/mutex.destroy.php
     * @param int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()}. The handle should not be locked by any Thread when
     * {@see Mutex::destroy()} is called.</p>
     * @return boolean <p>A boolean indication of success.</p>
     */
    final public static function destroy( $mutex ) {}

    /**
     * Attempt to lock the Mutex for the caller.<br/>
     * An attempt to lock a Mutex owned (locked) by another Thread will result in
     * blocking.
     * @link http://www.php.net/manual/en/mutex.lock.php
     * @param int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()}.</p>
     * @return boolean <p>A boolean indication of success.</p>
     */
    final public static function lock( $mutex ) {}

    /**
     * Attempt to lock the Mutex for the caller without blocking if the Mutex is
     * owned (locked) by another Thread.
     * @link http://www.php.net/manual/en/mutex.trylock.php
     * @param int $mutex int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()}.</p>
     * @return boolean <p>A boolean indication of success.</p>
     */
    final public static function trylock( $mutex ) {}

    /**
     * Attempts to unlock the Mutex for the caller, optionally destroying the Mutex
     * handle. The calling thread should own the Mutex at the time of the call.
     * @link http://www.php.net/manual/en/mutex.unlock.php
     * @param int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()}.</p>
     * @param bool $destroy [optional]
     * <p>When true pthreads will destroy the Mutex after a successful unlock.</p>
     * @return boolean <p>A boolean indication of success.</p>
     */
    final public static function unlock( $mutex, $destroy = false ) {}
}

/**
 * The static methods contained in the Cond class provide direct access to Posix
 * Condition Variables.
 * @link http://www.php.net/manual/en/class.cond.php
 */
class Cond {
    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Broadcast to all Threads blocking on a call to Cond::wait().
     * @link http://www.php.net/manual/en/cond.broadcast.php
     * @param int $condition <p>A handle to a Condition Variable returned by a previous call to
     * {@see Cond::create()}</p>
     * @return boolean <p>A boolean indication of success.</p>
     */
    final public static function broadcast( $condition ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Creates a new Condition Variable for the caller.
     * @link http://www.php.net/manual/en/cond.create.php
     * @return int <p>A handle to a Condition Variable</p>
     */
    final public static function create() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Destroying Condition Variable handles must be carried out explicitly by the
     * programmer when they are finished with the Condition Variable. No Threads should
     * be blocking on a call to Cond::wait() when the call to Cond::destroy() takes place.
     * @link http://www.php.net/manual/en/cond.destroy.php
     * @param int $condition <p>A handle to a Condition Variable returned by a previous call to
     * {@see Cond::create()}</p>
     * @return boolean <p>A boolean indication of success.</p>
     */
    final public static function destroy( $condition ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * A handle returned by a previous call to Cond::create()
     * @link http://www.php.net/manual/en/cond.signal.php
     * @param int $condition <p>A handle to a Condition Variable returned by a previous call to
     * {@see Cond::create()}</p>
     * @return boolean <p>A boolean indication of success.</p>
     */
    final public static function signal( $condition ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)
     * Wait for a signal on a Condition Variable, optionally specifying a timeout to
     * limit waiting time.
     * @link http://www.php.net/manual/en/cond.wait.php
     * @param int $condition <p>A handle returned by a previous call to
     * {@see Cond::create()}.</p>
     * @param int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()} and owned (locked) by the caller.</p>
     * @param int $timeout [optional] <p>An optional timeout, in microseconds ( millionths of a second ).</p>
     * @return boolean <p>A boolean indication of success.</p>
     */
    final public static function wait( $condition, $mutex, $timeout = 0 ) {}
}
