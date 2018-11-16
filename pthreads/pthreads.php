<?php

// Start of PECL pthreads 3.1.6

/**
 * The default options for all Threads, causes pthreads to copy the environment
 * when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_ALL', 1118481);

/**
 * Do not inherit anything when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_NONE', 0);

/**
 * Inherit INI entries when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_INI', 1);

/**
 * Inherit user declared constants when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_CONSTANTS', 16);

/**
 * Inherit user declared classes when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_CLASSES', 4096);

/**
 * Inherit user declared functions when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_FUNCTIONS', 256);

/**
 * Inherit included file information when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_INCLUDES', 65536);

/**
 * Inherit all comments when new Threads are started
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_INHERIT_COMMENTS', 1048576);

/**
 * Allow new Threads to send headers to standard output (normally prohibited)
 * @link https://php.net/manual/en/pthreads.constants.php
 */
define('PTHREADS_ALLOW_HEADERS', 268435456);

/**
 * (PECL pthreads &gt;= 2.0.0)<br/>
 * A Pool is a container for, and controller of, an adjustable number of
 * Workers.<br/>
 * Pooling provides a higher level abstraction of the Worker functionality,
 * including the management of references in the way required by pthreads.
 * @link https://secure.php.net/manual/en/class.pool.php
 */
class Pool {
    /**
     * Maximum number of Workers this Pool can use
     * @var int
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
     * Offset in workers of the last Worker used
     * @var int
     */
    protected $last;

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Construct a new pool of workers. Pools lazily create their threads, which means
     * new threads will only be spawned when they are required to execute tasks.
     * @link https://secure.php.net/manual/en/pool.construct.php
     * @param int $size <p>The maximum number of workers for this pool to create</p>
     * @param string $class [optional] <p>The class for new Workers. If no class is
     * given, then it defaults to the {@link Worker} class.</p>
     * @param array $ctor [optional] <p>An array of arguments to be passed to new
     * Workers</p>
     */
    public function __construct( $size, $class = 'Worker', $ctor = [] ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Allows the pool to collect references determined to be garbage by the
     * optionally given collector
     * @link https://secure.php.net/manual/en/pool.collect.php
     * @param callable $collector [optional] <p>A Callable collector that returns a
     * boolean on whether the task can be collected or not. Only in rare cases should
     * a custom collector need to be used.</p>
     * @return int <p>The number of remaining tasks in the pool to be collected</p>
     */
    public function collect( $collector = null ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Resize the Pool
     * @link https://secure.php.net/manual/en/pool.resize.php
     * @param int $size <p>The maximum number of Workers this Pool can create</p>
     * @return void
     */
    public function resize( $size ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Shuts down all of the workers in the pool. This will block until all submitted
     * tasks have been executed.
     * @link https://secure.php.net/manual/en/pool.shutdown.php
     * @return void
     */
    public function shutdown() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Submit the task to the next Worker in the Pool
     * @link https://secure.php.net/manual/en/pool.submit.php
     * @param Threaded $task <p>The task for execution</p>
     * @return int <p>the identifier of the Worker executing the object</p>
     */
    public function submit( $task ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Submit a task to the specified worker in the pool. The workers are indexed
     * from 0, and will only exist if the pool has needed to create them (since
     * threads are lazily spawned).
     * @link https://secure.php.net/manual/en/pool.submitTo.php
     * @param int $worker <p>The worker to stack the task onto, indexed from 0</p>
     * @param Threaded $task <p>The task for execution</p>
     * @return int <p>The identifier of the worker that accepted the task</p>
     */
    public function submitTo( $worker, $task ) {}
}

/**
 * Threaded objects form the basis of pthreads ability to execute user code
 * in parallel; they expose synchronization methods and various useful
 * interfaces.<br/>
 * Threaded objects, most importantly, provide implicit safety for the programmer;
 * all operations on the object scope are safe.
 *
 * @link https://secure.php.net/manual/en/class.threaded.php
 */
class Threaded implements Collectable, Traversable, Countable, ArrayAccess {
    /**
     * Worker object in which this Threaded is being executed
     * @var Worker
     */
    protected $worker;

    /**
     * (PECL pthreads &gt;= 3.0.0)<br/>
     * Increments the internal number of references to a Threaded object
     * @return void
     */
    public function addRef() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Fetches a chunk of the objects property table of the given size,
     * optionally preserving keys
     * @link https://secure.php.net/manual/en/threaded.chunk.php
     * @param int $size <p>The number of items to fetch</p>
     * @param bool $preserve [optional] <p>Preserve the keys of members, by default false</p>
     * @return array <p>An array of items from the objects property table</p>
     */
    public function chunk( $size, $preserve = false ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Returns the number of properties for this object
     * @link https://secure.php.net/manual/en/threaded.count.php
     * @return int <p>The number of properties for this object</p>
     */
    public function count() {}

    /**
     * (PECL pthreads &gt;= 3.0.0)<br/>
     * Decrements the internal number of references to a Threaded object
     * @return void
     */
    public function delRef() {}

    /**
     * (PECL pthreads &gt;= 2.0.8)<br/>
     * Makes thread safe standard class at runtime
     * @link https://secure.php.net/manual/en/threaded.extend.php
     * @param string $class <p>The class to extend</p>
     * @return bool <p>A boolean indication of success</p>
     */
    public static function extend( $class ) {}

    /**
     * (PECL pthreads &gt;= 3.0.0)<br/>
     * Retrieves the internal number of references to a Threaded object
     * @return int <p>The number of references to the Threaded object</p>
     */
    public function getRefCount() {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Retrieves terminal error information from the referenced object
     * @link https://secure.php.net/manual/en/threaded.getterminationinfo.php
     * @return array <p>array containing the termination conditions of the referenced object</p>
     */
    public function getTerminationInfo() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Tell if the referenced object is executing
     * @link https://secure.php.net/manual/en/thread.isrunning.php
     * @return bool <p>A boolean indication of state</p>
     */
    public function isRunning() {}

    /**
     * (PECL pthreads &gt;= 3.1.0)<br/>
     * @inheritdoc
     * @see Collectable::isGarbage()
     */
    public function isGarbage() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Tell if the referenced object was terminated during execution; suffered
     * fatal errors, or threw uncaught exceptions
     * @link https://secure.php.net/manual/en/threaded.isterminated.php
     * @return bool <p>A boolean indication of state</p>
     */
    public function isTerminated() {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Tell if the referenced object is waiting for notification
     * @link https://secure.php.net/manual/en/threaded.iswaiting.php
     * @return bool <p>A boolean indication of state</p>
     */
    public function isWaiting() {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Lock the referenced objects property table
     * @see Threaded::synchronized()
     * @link https://secure.php.net/manual/en/threaded.lock.php
     * @return bool <p>A boolean indication of success</p>
     */
    public function lock() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Merges data into the current object
     * @link https://secure.php.net/manual/en/threaded.merge.php
     * @var mixed $from <p>The data to merge</p>
     * @var bool $overwrite [optional] <p>Overwrite existing keys, by default true</p>
     * @return bool <p>A boolean indication of success</p>
     */
    public function merge( $from, $overwrite = true ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Send notification to the referenced object
     * @link https://secure.php.net/manual/en/threaded.notify.php
     * @return bool <p>A boolean indication of success</p>
     */
    public function notify() {}

    /**
     * (PECL pthreads &gt;= 3.0.0)<br/>
     * Send notification to the referenced object. This unblocks at least one
     * of the blocked threads (as opposed to unblocking all of them, as seen with
     * Threaded::notify()).
     * @link https://secure.php.net/manual/en/threaded.notifyone.php
     * @return bool <p>A boolean indication of success</p>
     */
    public function notifyOne() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Pops an item from the objects property table
     * @link https://secure.php.net/manual/en/threaded.pop.php
     * @return mixed <p>The last item from the objects property table</p>
     */
    public function pop() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * The programmer should always implement the run method for objects
     * that are intended for execution.
     * @link https://secure.php.net/manual/en/threaded.run.php
     * @return void
     */
    public function run() {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * @inheritdoc
     * @see Collectable::setGarbage()
     */
    public function setGarbage() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Shifts an item from the objects property table
     * @link https://secure.php.net/manual/en/threaded.shift.php
     * @return mixed <p>The first item from the objects property table</p>
     */
    public function shift() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Executes the block while retaining the referenced objects
     * synchronization lock for the calling context
     * @link https://secure.php.net/manual/en/threaded.synchronized.php
     * @param Closure $block <p>The block of code to execute</p>
     * @param mixed ...$_ [optional] <p>Variable length list of arguments
     * to use as function arguments to the block</p>
     * @return mixed <p>The return value from the block</p>
     */
    public function synchronized( $block, ...$_ ) {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Unlock the referenced objects storage for the calling context
     * @see Threaded::synchronized()
     * @link https://secure.php.net/manual/en/threaded.unlock.php
     * @return bool <p>A boolean indication of success</p>
     */
    public function unlock() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Will cause the calling context to wait for notification from the
     * referenced object
     * @link https://secure.php.net/manual/en/threaded.wait.php
     * @param int $timeout [optional] <p>An optional timeout in microseconds</p>
     * @return bool <p>A boolean indication of success</p>
     */
    public function wait( $timeout = 0 ) {}


    /**
     * @inheritdoc
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists( $offset ) {}

    /**
     * @inheritdoc
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet( $offset ) {}

    /**
     * @inheritdoc
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet( $offset, $value ) {}

    /**
     * @inheritdoc
     * @see ArrayAccess::offsetUnset()
     */
    public function offsetUnset( $offset ) {}
}

/**
 * Stackable is an alias of Threaded. This class name was used in pthreads until
 * version 2.0.0
 * @see Threaded
 * @link https://secure.php.net/manual/en/class.threaded.php
 */
class Stackable extends Threaded implements Traversable, Countable, ArrayAccess {

}

/**
 * (PECL pthreads &gt;= 2.0.0)<br/>
 * When the start method of a Thread is invoked, the run method code will be
 * executed in separate Thread, in parallel.<br/>
 * After the run method is executed the Thread will exit immediately, it will
 * be joined with the creating Thread at the approriate time.
 *
 * @link https://secure.php.net/manual/en/class.thread.php
 */
class Thread extends Threaded implements Countable, Traversable, ArrayAccess {
    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Detaches the referenced Thread from the calling context, dangerous!
     * @link https://secure.php.net/manual/en/thread.detach.php
     * @return void
     */
    public function detach() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Will return the identity of the Thread that created the referenced Thread
     * @link https://secure.php.net/manual/en/thread.getcreatorid.php
     * @return int <p>A numeric identity</p>
     */
    public function getCreatorId() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Return a reference to the currently executing Thread
     * @link https://secure.php.net/manual/en/thread.getcurrentthread.php
     * @return Thread <p>An object representing the currently executing Thread</p>
     */
    public static function getCurrentThread() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Will return the identity of the currently executing Thread
     * @link https://secure.php.net/manual/en/thread.getcurrentthreadid.php
     * @return int <p>A numeric identity</p>
     */
    public static function getCurrentThreadId() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Will return the identity of the referenced Thread
     * @link https://secure.php.net/manual/en/thread.getthreadid.php
     * @return int <p>A numeric identity</p>
     */
    public function getThreadId() {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Will execute a Callable in the global scope
     * @link https://secure.php.net/manual/en/thread.globally.php
     * @return mixed <p>The return value of the Callable</p>
     */
    public static function globally() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Tell if the referenced Thread has been joined
     * @link https://secure.php.net/manual/en/thread.isjoined.php
     * @return bool <p>A boolean indication of state</p>
     */
    public function isJoined() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Tell if the referenced Thread was started
     * @link https://secure.php.net/manual/en/thread.isstarted.php
     * @return bool <p>A boolean indication of state</p>
     */
    public function isStarted() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Causes the calling context to wait for the referenced Thread to finish executing
     * @link https://secure.php.net/manual/en/thread.join.php
     * @return bool <p>A boolean indication of success</p>
     */
    public function join() {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Forces the referenced Thread to terminate
     * @link https://secure.php.net/manual/en/thread.kill.php
     * @return bool <p>A boolean indication of success</p>
     */
    public function kill() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Will start a new Thread to execute the implemented run method
     * @link https://secure.php.net/manual/en/thread.start.php
     * @param int $options [optional] <p>An optional mask of inheritance
     * constants, by default <b>{@link PTHREADS_INHERIT_ALL}</b></p>
     * @return bool <p>A boolean indication of success</p>
     */
    public function start( $options = PTHREADS_INHERIT_ALL ) {}
}

/**
 * (PECL pthreads &gt;= 2.0.0)<br/>
 * Worker Threads have a persistent context, as such should be used over
 * Threads in most cases.<br/>
 * When a Worker is started, the run method will be executed, but the Thread will
 * not leave until one of the following conditions are met:<br/><ul>
 * <li>the Worker goes out of scope (no more references remain)</li>
 * <li>the programmer calls shutdown</li>
 * <li>the script dies</li></ul>
 * This means the programmer can reuse the context throughout execution; placing
 * objects on the stack of the Worker will cause the Worker to execute the stacked
 * objects run method.
 * @link https://secure.php.net/manual/en/class.worker.php
 */
class Worker extends Thread implements Traversable, Countable, ArrayAccess {
    /**
     * (PECL pthreads &gt;= 3.0.0)<br/>
     * Allows the worker to collect references determined to be garbage by the
     * optionally given collector
     * @link https://secure.php.net/manual/en/worker.collect.php
     * @param callable $collector [optional] <p>A Callable collector that returns
     * a boolean on whether the task can be collected or not. Only in rare cases
     * should a custom collector need to be used</p>
     * @return int <p>The number of remaining tasks on the worker's stack to be
     * collected</p>
     */
    public function collect( $collector = null ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Returns the number of tasks left on the stack
     * @link https://secure.php.net/manual/en/worker.getstacked.php
     * @return int <p>Returns the number of tasks currently waiting to be
     * executed by the worker</p>
     */
    public function getStacked() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Whether the worker has been shutdown or not
     * @link https://secure.php.net/manual/en/worker.isshutdown.php
     * @return bool <p>Returns whether the worker has been shutdown or not</p>
     */
    public function isShutdown() {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Tell if a Worker is executing Stackables
     * @link https://secure.php.net/manual/en/worker.isworking.php
     * @return bool <p>A boolean indication of state</p>
     */
    public function isWorking() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Shuts down the Worker after executing all of the stacked tasks
     * @link https://secure.php.net/manual/en/worker.shutdown.php
     * @return bool <p>Whether the worker was successfully shutdown or not</p>
     */
    public function shutdown() {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Appends the new work to the stack of the referenced worker
     * @link https://secure.php.net/manual/en/worker.stack.php
     * @param Threaded &$work <p>A Threaded object to be executed by the Worker</p>
     * @return int <p>The new size of the stack</p>
     */
    public function stack( &$work ) {}

    /**
     * (PECL pthreads &gt;= 2.0.0)<br/>
     * Removes the first task (the oldest one) in the stack
     * @link https://secure.php.net/manual/en/worker.unstack.php
     * @return int <p>The new size of the stack</p>
     */
    public function unstack() {}
}

/**
 * (PECL pthreads &gt;= 2.0.8)<br/>
 * Represents a garbage-collectable object.
 * @link https://secure.php.net/manual/en/class.collectable.php
 */
interface Collectable {
    /**
     * (PECL pthreads &gt;= 2.0.8)<br/>
     * Can be called in {@link Pool::collect()} to determine if this object is garbage
     * @link https://secure.php.net/manual/en/collectable.isgarbage.php
     * @return bool <p>Whether this object is garbage or not</p>
     */
    public function isGarbage();

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Should be called once per object when the object is finished being
     * executed or referenced
     * @link https://secure.php.net/manual/en/collectable.setgarbage.php
     * @return void
     */
    public function setGarbage();
}

/**
 * (PECL pthreads &lt; 3.0.0)<br>
 * The static methods contained in the Mutex class provide direct access to Posix
 * Mutex functionality.
 * @link https://secure.php.net/manual/en/class.mutex.php
 */
class Mutex {
    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Create, and optionally lock a new Mutex for the caller
     * @link https://secure.php.net/manual/en/mutex.create.php
     * @param bool $lock [optional] <p>Setting lock to true will lock the Mutex for the caller before returning the handle</p>
     * @return int <p>A newly created and optionally locked Mutex handle</p>
     */
    final public static function create ( $lock = false ) {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Destroying Mutex handles must be carried out explicitly by the programmer when
     * they are finished with the Mutex handle.
     * @link https://secure.php.net/manual/en/mutex.destroy.php
     * @param int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()}. The handle should not be locked by any Thread when
     * {@see Mutex::destroy()} is called.</p>
     * @return bool <p>A boolean indication of success.</p>
     */
    final public static function destroy( $mutex ) {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Attempt to lock the Mutex for the caller.<br/>
     * An attempt to lock a Mutex owned (locked) by another Thread will result in
     * blocking.
     * @link https://secure.php.net/manual/en/mutex.lock.php
     * @param int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()}.</p>
     * @return bool <p>A boolean indication of success.</p>
     */
    final public static function lock( $mutex ) {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Attempt to lock the Mutex for the caller without blocking if the Mutex is
     * owned (locked) by another Thread.
     * @link https://secure.php.net/manual/en/mutex.trylock.php
     * @param int $mutex int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()}.</p>
     * @return bool <p>A boolean indication of success.</p>
     */
    final public static function trylock( $mutex ) {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Attempts to unlock the Mutex for the caller, optionally destroying the Mutex
     * handle. The calling thread should own the Mutex at the time of the call.
     * @link https://secure.php.net/manual/en/mutex.unlock.php
     * @param int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()}.</p>
     * @param bool $destroy [optional]
     * <p>When true pthreads will destroy the Mutex after a successful unlock.</p>
     * @return bool <p>A boolean indication of success.</p>
     */
    final public static function unlock( $mutex, $destroy = false ) {}
}

/**
 * (PECL pthreads &lt; 3.0.0)<br/>
 * The static methods contained in the Cond class provide direct access to Posix
 * Condition Variables.
 * @link https://secure.php.net/manual/en/class.cond.php
 */
class Cond {
    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Broadcast to all Threads blocking on a call to Cond::wait().
     * @link https://secure.php.net/manual/en/cond.broadcast.php
     * @param int $condition <p>A handle to a Condition Variable returned by a previous call to
     * {@see Cond::create()}</p>
     * @return bool <p>A boolean indication of success.</p>
     */
    final public static function broadcast( $condition ) {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Creates a new Condition Variable for the caller.
     * @link https://secure.php.net/manual/en/cond.create.php
     * @return int <p>A handle to a Condition Variable</p>
     */
    final public static function create() {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Destroying Condition Variable handles must be carried out explicitly by the
     * programmer when they are finished with the Condition Variable. No Threads should
     * be blocking on a call to Cond::wait() when the call to Cond::destroy() takes place.
     * @link https://secure.php.net/manual/en/cond.destroy.php
     * @param int $condition <p>A handle to a Condition Variable returned by a previous call to
     * {@see Cond::create()}</p>
     * @return bool <p>A boolean indication of success.</p>
     */
    final public static function destroy( $condition ) {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * A handle returned by a previous call to Cond::create()
     * @link https://secure.php.net/manual/en/cond.signal.php
     * @param int $condition <p>A handle to a Condition Variable returned by a previous call to
     * {@see Cond::create()}</p>
     * @return bool <p>A boolean indication of success.</p>
     */
    final public static function signal( $condition ) {}

    /**
     * (PECL pthreads &lt; 3.0.0)<br/>
     * Wait for a signal on a Condition Variable, optionally specifying a timeout to
     * limit waiting time.
     * @link https://secure.php.net/manual/en/cond.wait.php
     * @param int $condition <p>A handle returned by a previous call to
     * {@see Cond::create()}.</p>
     * @param int $mutex <p>A handle returned by a previous call to
     * {@see Mutex::create()} and owned (locked) by the caller.</p>
     * @param int $timeout [optional] <p>An optional timeout, in microseconds ( millionths of a second ).</p>
     * @return bool <p>A boolean indication of success.</p>
     */
    final public static function wait( $condition, $mutex, $timeout = 0 ) {}
}

/**
 * (PECL pthreads &gt;= 3.0.0)<br/>
 * The Volatile class is new to pthreads v3. Its introduction is a consequence of
 * the new immutability semantics of Threaded members of Threaded classes. The
 * Volatile class enables for mutability of its Threaded members, and is also
 * used to store PHP arrays in Threaded contexts.
 * @see Threaded
 * @link https://secure.php.net/manual/en/class.volatile.php
 */
class Volatile extends Threaded implements Collectable, Traversable
    {

    }
