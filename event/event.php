<?php

// The Event class
/**
 * Event.
 * Event class represents and event firing on a file descriptor being ready to read from or write to; a file descriptor becoming ready to read from or write to(edge-triggered I/O only); a timeout expiring; a signal occuring; a user-triggered event.
 * Every event is associated with EventBase . However, event will never fire until it is added (via Event::add() ). An added event remains in pending state until the registered event occurs, thus turning it to active state. To handle events user may register a callback which is called when event becomes active. If event is configured persistent , it remains pending. If it is not persistent, it stops being pending when it's callback runs. Event::del() method deletes event, thus making it non-pending. By means of Event::add() method it could be added again.
 *
 * @property bool $pending
 *
 * @author Kazuaki MABUCHI
 * @copyright Сopyright (https://php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://php.net/manual/en/class.event.php
 */
final class Event
{
    const ET = 32;
    const PERSIST = 16;
    const READ = 2;
    const WRITE = 4;
    const SIGNAL = 8;
    const TIMEOUT = 1;

    public $pending;

    /**
     * __construct.
     * Constructs Event object.
     *
     * @param EventBase $base
     * @param mixed     $fd
     * @param int       $what
     * @param callable  $cb
     * @param mixed     $arg  = null
     *
     * @see https://php.net/manual/en/event.construct.php
     */
    public function __construct(EventBase $base, mixed $fd, int $what, callable $cb, mixed $arg = null)
    {
    }

    /**
     * add.
     * Makes event pending.
     *
     * @param float $timeout (optional)
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.add.php
     */
    public function add(double $timeout): bool
    {
    }

    /**
     * addSignal.
     * Makes signal event pending.
     *
     * @param float $timeout (optional)
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.addsignal.php
     */
    public function addSignal(double $timeout): bool
    {
    }

    /**
     * addTimer.
     * Makes timer event pending.
     *
     * @param float $timeout (optional)
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.addtimer.php
     */
    public function addTimer(double $timeout): bool
    {
    }

    /**
     * del.
     * Makes event non-pending.
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.del.php
     */
    public function del(): bool
    {
    }

    /**
     * delSignal.
     * Makes signal event non-pending.
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.delsignal.php
     */
    public function delSignal(): bool
    {
    }

    /**
     * delTimer.
     * Makes timer event non-pending.
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.deltimer.php
     */
    public function delTimer(): bool
    {
    }

    /**
     * free.
     * Make event non-pending and free resources allocated for this event.
     *
     * @see https://php.net/manual/en/event.free.php
     */
    public function free(): void
    {
    }

    /**
     * getSupportedMethods.
     * Returns array with of the names of the methods supported in this version of Libevent.
     *
     * @return array
     *
     * @see https://php.net/manual/en/event.getsupportedmethods.php
     */
    public static function getSupportedMethods(): array
    {
    }

    /**
     * pending.
     * Detects whether event is pending or scheduled.
     *
     * @param int $flags
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.pending.php
     */
    public function pending(int $flags): bool
    {
    }

    /**
     * set.
     * Re-configures event.
     *
     * @param EventBase $base
     * @param mixed     $fd
     * @param int       $what (optional)
     * @param callable  $cb   (optional)
     * @param mixed     $arg  (optional)
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.set.php
     */
    public function set(EventBase $base, mixed $fd, int $what, callable $cb, mixed $arg): bool
    {
    }

    /**
     * setPriority.
     * Set event priority.
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.setpriority.php
     */
    public function setPriority(int $priority): bool
    {
    }

    /**
     * setTimer.
     * Re-configures timer event.
     *
     * @param EventBase $base
     * @param callable  $cb
     * @param mixed     $arg  (optional)
     *
     * @return bool
     *
     * @see https://php.net/manual/en/event.settimer.php
     */
    public function setTimer(EventBase $base, callable $cb, mixed $arg): bool
    {
    }

    /**
     * signal.
     * Constructs signal event object.
     *
     * @param EventBase $base
     * @param int       $signum
     * @param callable  $cb
     * @param mixed     $arg    (optional)
     *
     * @return Event
     *
     * @see https://php.net/manual/en/event.signal.php
     */
    public static function signal(EventBase $base, int $signum, callable $cb, mixed $arg): Event
    {
    }

    /**
     * timer.
     * Constructs timer event object.
     *
     * @param EventBase $base
     * @param callable  $cb
     * @param mixed     $arg  (optional)
     *
     * @return Event
     *
     * @see https://php.net/manual/en/event.timer.php
     */
    public static function timer(EventBase $base, callable $cb, mixed $arg): Event
    {
    }
}

//  The EventBase class
/**
 * EventBase.
 * EventBase class represents libevent's event base structure. It holds a set of events and can poll to determine which events are active.
 * Each event base has a method, or a backend that it uses to determine which events are ready. The recognized methods are: select, poll, epoll, kqueue, devpoll, evport and win32 .
 * To configure event base to use, or avoid specific backend EventConfig class can be used.
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://php.net/manual/en/class.eventbase.php
 */
final class EventBase
{
    const LOOP_ONCE = 1;
    const LOOP_NONBLOCK = 2;
    const NOLOCK = 1;
    const STARTUP_IOCP = 4;
    const NO_CACHE_TIME = 8;
    const EPOLL_USE_CHANGELIST = 16;

    /**
     * __construct.
     * Constructs EventBase object.
     *
     * @param EventConfig $cfg
     *
     * @see https://php.net/manual/en/eventbase.construct.php
     */
    public function __construct(EventConfig $cfg)
    {
    }

    /**
     * dispatch.
     * Dispatch pending events.
     *
     * @see https://php.net/manual/en/eventbase.dispatch.php
     */
    public function dispatch(): void
    {
    }

    /**
     * exit.
     * Stop dispatching events.
     *
     * @param float $timeout
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbase.exit.php
     */
    public function exit(double $timeout): bool
    {
    }

    /**
     * free.
     * Free resources allocated for this event base.
     *
     * @see https://php.net/manual/en/eventbase.free.php
     */
    public function free(): void
    {
    }

    /**
     * getFeatures.
     * Returns bitmask of features supported.
     *
     * @return int
     *
     * @see https://php.net/manual/en/eventbase.getfeatures.php
     */
    public function getFeatures(): int
    {
    }

    /**
     * getMethod.
     * Returns event method in use.
     *
     * @return string
     *
     * @see https://php.net/manual/en/eventbase.getmethod.php
     */
    public function getMethod(): string
    {
    }

    /**
     * getTimeOfDayCached.
     * Returns the current event base time.
     *
     * @return float
     *
     * @see https://php.net/manual/en/eventbase.gettimeofdaycached.php
     */
    public function getTimeOfDayCached(): double
    {
    }

    /**
     * gotExit.
     * Checks if the event loop was told to exit.
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbase.gotexit.php
     */
    public function gotExit(): bool
    {
    }

    /**
     * gotStop.
     * Checks if the event loop was told to exit.
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbase.gotstop.php
     */
    public function gotStop(): bool
    {
    }

    /**
     * loop.
     * Dispatch pending events.
     *
     * @param int $flags
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbase.loop.php
     */
    public function loop(int $flags): bool
    {
    }

    /**
     * priorityInit.
     * Sets number of priorities per event base.
     *
     * @param int $n_priorities
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbase.priorityinit.php
     */
    public function priorityInit(int $n_priorities): bool
    {
    }

    /**
     * reInit.
     * Re]initialize event base(after a fork).
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbase.reinit.php
     */
    public function reInit(): bool
    {
    }

    /**
     * stop.
     * Tells event_base to stop dispatching events.
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbase.stop.php
     */
    public function stop(): bool
    {
    }
}

// The EventBuffer class
/**
 * EventBuffer.
 * EventBuffer represents Libevent's "evbuffer", an utility functionality for buffered I/O.
 * Event buffers are meant to be generally useful for doing the "buffer" part of buffered network I/O.
 *
 * @property int $length
 * @property int $contiguous_space
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://php.net/manual/en/class.eventbuffer.php
 */
class EventBuffer
{
    const EOL_ANY = 0;
    const EOL_CRLF = 1;
    const EOL_CRLF_STRICT = 2;
    const EOL_LF = 3;
    const PTR_SET = 0;
    const PTR_ADD = 1;

    public $length;
    public $contiguous_space;

    /**
     * __construct.
     * Constructs EventBuffer object.
     *
     * @see https://php.net/manual/en/eventbuffer.construct.php
     */
    public function __construct()
    {
    }

    /**
     * add.
     * Append data to the end of an event buffer.
     *
     * @param string $data
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbuffer.add.php
     */
    public function add(string $data): bool
    {
    }

    /**
     * addBuffer.
     * Move all data from a buffer provided to the current instance of EventBuffer.
     *
     * @param EventBuffer $buf
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbuffer.addbuffer.php
     */
    public function addBuffer(EventBuffer $buf): bool
    {
    }

    /**
     * appendFrom.
     * Moves the specified number of bytes from a source buffer to the end of the current buffer.
     *
     * @param EventBuffer $buf
     * @param int         $len
     *
     * @return int
     *
     * @see https://php.net/manual/en/eventbuffer.appendfrom.php
     */
    public function appendFrom(EventBuffer $buf, int $len): int
    {
    }

    /**
     * copyout.
     * Copies out specified number of bytes from the front of the buffer.
     *
     * @param string &$data
     * @param int    $max_bytes
     *
     * @return int
     *
     * @see https://php.net/manual/en/eventbuffer.copyout.php
     */
    public function copyout(string &$data, int $max_bytes): int
    {
    }

    /**
     * drain.
     * Removes specified number of bytes from the front of the buffer without copying it anywhere.
     *
     * @param int $len
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbuffer.drain.php
     */
    public function drain(int $len): bool
    {
    }

    /**
     * enableLocking.
     *
     * @see https://php.net/manual/en/eventbuffer.enablelocking.php
     */
    public function enableLocking(): void
    {
    }

    /**
     * expand.
     * Reserves space in buffer.
     *
     * @param int $len
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbuffer.expand.php
     */
    public function expand(int $len): bool
    {
    }

    /**
     * freeze.
     * Prevent calls that modify an event buffer from succeeding.
     *
     * @param bool $at_front
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbuffer.freeze.php
     */
    public function freeze(bool $at_front): bool
    {
    }

    /**
     * lock.
     * Acquires a lock on buffer.
     *
     * @see https://php.net/manual/en/eventbuffer.lock.php
     */
    public function lock(): void
    {
    }

    /**
     * prepend.
     * Prepend data to the front of the buffer.
     *
     * @param string $data
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbuffer.prepend.php
     */
    public function prepend(string $data): bool
    {
    }

    /**
     * prependBuffer.
     * Moves all data from source buffer to the front of current buffer.
     *
     * @param EventBuffer $buf
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbuffer.prependbuffer.php
     */
    public function prependBuffer(EventBuffer $buf): bool
    {
    }

    /**
     * pullup.
     * Linearizes data within buffer and returns it's contents as a string.
     *
     * @param int $size
     *
     * @return string
     *
     * @see https://php.net/manual/en/eventbuffer.pullup.php
     */
    public function pullup(int $size): string
    {
    }

    /**
     * read.
     * Read data from an evbuffer and drain the bytes read.
     *
     * @param int $max_bytes
     *
     * @return string
     *
     * @see int $max_bytes
     */
    public function read(int $max_bytes): string
    {
    }

    /**
     * readFrom.
     * Read data from a file onto the end of the buffer.
     *
     * @param mixed $fd
     * @param int   $howmuch
     *
     * @return int
     *
     * @see https://php.net/manual/en/eventbuffer.readfrom.php
     */
    public function readFrom(mixed $fd, int $howmuch): int
    {
    }

    /**
     * readLine.
     * Extracts a line from the front of the buffer.
     *
     * @param int $eol_style
     *
     * @return string
     *
     * @see https://php.net/manual/en/eventbuffer.readline.php
     */
    public function readLine(int $eol_style): string
    {
    }

    /**
     * search.
     * Scans the buffer for an occurrence of a string.
     *
     * @param string $what
     * @param int    $start = 1
     * @param int    $end   = 1
     *
     * @return mixed
     *
     * @see https://php.net/manual/en/eventbuffer.search.php
     */
    public function search(string $what, int $start = 1, int $end = 1): mixed
    {
    }

    /**
     * searchEol.
     * Scans the buffer for an occurrence of an end of line.
     *
     * @param int $start     = 1
     * @param int $eol_style = EOL_ANY
     *
     * @return mixed
     *
     * @see https://php.net/manual/en/eventbuffer.searcheol.php
     */
    public function searchEol(int $start = 1, int $eol_style = EOL_ANY): mixed
    {
    }

    /**
     * substr.
     * Substracts a portion of the buffer data.
     *
     * @param int $start
     * @param int $length (optional)
     *
     * @return string
     *
     * @see https://php.net/manual/en/eventbuffer.substr.php
     */
    public function substr(int $start, int $length): string
    {
    }

    /**
     * unfreeze.
     * Re-enable calls that modify an event buffer.
     *
     * @param bool $at_front
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbuffer.unfreeze.php
     */
    public function unfreeze(bool $at_front): bool
    {
    }

    /**
     * unlock.
     * Releases lock acquired by EventBuffer::lock.
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbuffer.unlock.php
     */
    public function unlock(): bool
    {
    }

    /**
     * write.
     * Write contents of the buffer to a file or socket.
     *
     * @param mixed $fd
     * @param int   $howmuch (optional)
     *
     * @return int
     *
     * @see https://php.net/manual/en/eventbuffer.write.php
     */
    public function write(mixed $fd, int $howmuch): int
    {
    }
}

// The EventBufferEvent class
/**
 * EventBufferEvent.
 * Represents Libevent's buffer event.
 * Usually an application wants to perform some amount of data buffering in addition to just responding to events. When we want to write data, for example, the usual pattern looks like:
 * Decide that we want to write some data to a connection; put that data in a buffer.
 * Wait for the connection to become writable
 * Write as much of the data as we can
 * Remember how much we wrote, and if we still have more data to write, wait for the connection to become writable again.
 * This buffered I/O pattern is common enough that Libevent provides a generic mechanism for it. A "buffer event" consists of an underlying transport (like a socket), a read buffer, and a write buffer. Instead of regular events, which give callbacks when the underlying transport is ready to be read or written, a buffer event invokes its user-supplied callbacks when it has read or written enough data.
 *
 * @property int $fd
 * @property int $priority
 * @property EventBuffer $input
 * @property EventBuffer $output
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://php.net/manual/en/class.eventbufferevent.php
 */
final class EventBufferEvent
{
    const READING = 1;
    const WRITING = 2;
    const EOF = 16;
    const ERROR = 32;
    const TIMEOUT = 64;
    const CONNECTED = 128;
    const OPT_CLOSE_ON_FREE = 1;
    const OPT_THREADSAFE = 2;
    const OPT_DEFER_CALLBACKS = 4;
    const OPT_UNLOCK_CALLBACKS = 8;
    const SSL_OPEN = 0;
    const SSL_CONNECTING = 1;
    const SSL_ACCEPTING = 2;

    public $fd;
    public $priority;
    public $input;
    public $output;

    /**
     * __construct.
     * Constructs EventBufferEvent object.
     *
     * @param EventBase $base
     * @param mixed     $socket  = null
     * @param int       $options = 0
     * @param callable  $readcb  = null
     * @param callable  $writecb = null
     * @param callable  $eventcb = null
     *
     * @see https://php.net/manual/en/eventbufferevent.construct.php
     */
    public function __construct(EventBase $base, mixed $socket = null, int $options = 0, callable $readcb = null, callable $writecb = null, callable $eventcb = null)
    {
    }

    /**
     * close.
     * Closes file descriptor associated with the current buffer event.
     *
     * @see https://php.net/manual/en/eventbufferevent.close.php
     */
    public function close(): void
    {
    }

    /**
     * connect.
     * Connect buffer event's file descriptor to given address or UNIX socket.
     *
     * @param string $addr
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbufferevent.connect.php
     */
    public function connect(string $addr): bool
    {
    }

    /**
     * connectHost.
     * Connects to a hostname with optionally asyncronous DNS.
     *
     * @param EventDnsBase $dns_base
     * @param string       $hostname
     * @param int          $port
     * @param int          $family   = AF_UNSPEC
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbufferevent.connecthost.php
     */
    public function connectHost(EventDnsBase $dns_base, string $hostname, int $port, int $family = AF_UNSPEC): bool
    {
    }

    /**
     * createPair.
     * Creates two buffer events connected to each other.
     *
     * @param EventBase $base
     * @param int       $options = 0
     *
     * @return array
     *
     * @see https://php.net/manual/en/eventbufferevent.createpair.php
     */
    public static function createPair(EventBase $base, int $options = 0): array
    {
    }

    /**
     * disable.
     * Disable events read, write, or both on a buffer event.
     *
     * @param int $events
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbufferevent.disable.php
     */
    public function disable(int $events): bool
    {
    }

    /**
     * enable.
     * Enable events read, write, or both on a buffer event.
     *
     * @param int $events
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbufferevent.enable.php
     */
    public function enable(int $events): bool
    {
    }

    /**
     * free.
     * Free a buffer event.
     *
     * @see https://php.net/manual/en/eventbufferevent.free.php
     */
    public function free(): void
    {
    }

    /**
     * getDnsErrorString.
     * Returns string describing the last failed DNS lookup attempt.
     *
     * @return string
     *
     * @see https://php.net/manual/en/eventbufferevent.getdnserrorstring.php
     */
    public function getDnsErrorString(): string
    {
    }

    /**
     * getEnabled.
     * Returns bitmask of events currently enabled on the buffer event.
     *
     * @return int
     *
     * @see https://php.net/manual/en/eventbufferevent.getenabled.php
     */
    public function getEnabled(): int
    {
    }

    /**
     * getInput.
     * Returns underlying input buffer associated with current buffer event.
     *
     * @return EventBuffer
     *
     * @see https://php.net/manual/en/eventbufferevent.getinput.php
     */
    public function getInput(): EventBuffer
    {
    }

    /**
     * getOutput.
     * Returns underlying output buffer associated with current buffer event.
     *
     * @return EventBuffer
     *
     * @see https://php.net/manual/en/eventbufferevent.getoutput.php
     */
    public function getOutput(): EventBuffer
    {
    }

    /**
     * read.
     * Read buffer's data.
     *
     * @param int $size
     *
     * @return string
     *
     * @see https://php.net/manual/en/eventbufferevent.read.php
     */
    public function read(int $size): string
    {
    }

    /**
     * readBuffer.
     * Drains the entire contents of the input buffer and places them into buf.
     *
     * @param EventBuffer $buf
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbufferevent.readbuffer.php
     */
    public function readBuffer(EventBuffer $buf): bool
    {
    }

    /**
     * setCallbacks.
     * Assigns read, write and event(status) callbacks.
     *
     * @param callable $readcb
     * @param callable $writecb
     * @param callable $eventcb
     * @param string   $arg     (optional)
     *
     * @see https://php.net/manual/en/eventbufferevent.setcallbacks.php
     */
    public function setCallbacks(callable $readcb, callable $writecb, callable $eventcb, string $arg): void
    {
    }

    /**
     * setPriority.
     * Assign a priority to a bufferevent.
     *
     * @param int $priority
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbufferevent.setpriority.php
     */
    public function setPriority(int $priority): bool
    {
    }

    /**
     * setTimeouts.
     * Set the read and write timeout for a buffer event.
     *
     * @param float $timeout_read
     * @param float $timeout_write
     *
     * @return bool
     *
     * @see https://php.net/manual/en/eventbufferevent.settimeouts.php
     */
    public function setTimeouts(float $timeout_read, float $timeout_write): bool
    {
    }

    /**
     * setWatermark.
     * Adjusts read and/or write watermarks.
     *
     * @param int $events
     * @param int $lowmark
     * @param int $highmark
     *
     * @see https://php.net/manual/en/eventbufferevent.setwatermark.php
     */
    public function setWatermark(int $events, int $lowmark, int $highmark): void
    {
    }

    /**
     * sslError.
     * Returns most recent OpenSSL error reported on the buffer event.
     *
     * @return string
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.sslerror.php
     */
    public function sslError(): string
    {
    }

    /**
     * sslFilter.
     * Create a new SSL buffer event to send its data over another buffer event.
     *
     * @param EventBase        $base
     * @param EventBufferEvent $underlying
     * @param EventSslContext  $ctx
     * @param int              $state
     * @param int              $options    = 0
     *
     * @return EventBufferEvent
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.sslfilter.php
     */
    public static function sslFilter(EventBase $base, EventBufferEvent $underlying, EventSslContext $ctx, int $state, int $options = 0): EventBufferEvent
    {
    }

    /**
     * sslGetCipherInfo.
     * Returns a textual description of the cipher.
     *
     * @return string
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.sslgetcipherinfo.php
     */
    public function sslGetCipherInfo(): string
    {
    }

    /**
     * sslGetCipherName.
     * Returns the current cipher name of the SSL connection.
     *
     * @return string
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.sslgetciphername.php
     */
    public function sslGetCipherName(): string
    {
    }

    /**
     * sslGetCipherVersion.
     * Returns version of cipher used by current SSL connection.
     *
     * @return string
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.sslgetcipherversion.php
     */
    public function sslGetCipherVersion(): string
    {
    }

    /**
     * sslGetProtocol.
     * Returns the name of the protocol used for current SSL.
     *
     * @return string
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.sslgetprotocol.php
     */
    public function sslGetProtocol(): string
    {
    }

    /**
     * sslRenegotiate.
     * Tells a bufferevent to begin SSL renegotiation.
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.sslrenegotiate.php
     */
    public function sslRenegotiate(): void
    {
    }

    /**
     * sslSocket.
     * Creates a new SSL buffer event to send its data over an SSL on a socket.
     *
     * @param EventBase       $base
     * @param mixed           $socket
     * @param EventSslContext $ctx
     * @param int             $state
     * @param int             $options (optional)
     *
     * @return EventBufferEvent
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.sslsocket.php
     */
    public static function sslSocket(EventBase $base, mixed $socket, EventSslContext $ctx, int $state, int $options): EventBufferEvent
    {
    }

    /**
     * write.
     * Adds data to a buffer event's output buffer.
     *
     * @param string $data
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.write.php
     */
    public function write(string $data): bool
    {
    }

    /**
     * writeBuffer.
     * Adds contents of the entire buffer to a buffer event's output buffer.
     *
     * @param EventBuffer $buf
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventbufferevent.writebuffer.php
     */
    public function writeBuffer(EventBuffer $buf): bool
    {
    }
}

// The EventConfig class
/**
 * EventConfig.
 * Represents configuration structure which could be used in construction of the EventBase .
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://secure.php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://secure.php.net/manual/en/class.eventconfig.php
 */
final class EventConfig
{
    const FEATURE_ET = 1;
    const FEATURE_O1 = 2;
    const FEATURE_FDS = 4;

    /**
     * __construct.
     * Constructs EventConfig object.
     *
     * @see https://secure.php.net/manual/en/eventconfig.construct.php
     */
    public function __construct()
    {
    }

    /**
     * avoidMethod.
     * Tells libevent to avoid specific event method.
     *
     * @param string $method
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventconfig.avoidmethod.php
     */
    public function avoidMethod(string $method): bool
    {
    }

    /**
     * requireFeatures.
     * Enters a required event method feature that the application demands.
     *
     * @param int $feature
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventconfig.requirefeatures.php
     */
    public function requireFeatures(int $feature): bool
    {
    }

    /**
     * setMaxDispatchInterval.
     * Prevents priority inversion.
     *
     * @param int $max_interval
     * @param int $max_callbacks
     * @param int $min_priority
     *
     * @see https://secure.php.net/manual/en/eventconfig.setmaxdispatchinterval.php
     */
    public function setMaxDispatchInterval(int $max_interval, int $max_callbacks, int $min_priority): void
    {
    }
}

// The EventDnsBase class
/**
 * EventDnsBase.
 * Represents Libevent's DNS base structure. Used to resolve DNS asyncronously, parse configuration files like resolv.conf etc.
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://secure.php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://secure.php.net/manual/en/class.eventdnsbase.php
 */
final class EventDnsBase
{
    const OPTION_SEARCH = 1;
    const OPTION_NAMESERVERS = 2;
    const OPTION_MISC = 4;
    const OPTION_HOSTSFILE = 8;
    const OPTIONS_ALL = 15;

    /**
     * __construct.
     * Constructs EventDnsBase object.
     *
     * @param EventBase $base
     * @param bool      $initialize
     *
     * @see https://secure.php.net/manual/en/eventdnsbase.construct.php
     */
    public function __construct(EventBase $base, bool $initialize)
    {
    }

    /**
     * addNameserverIp.
     * Adds a nameserver to the DNS base.
     *
     * @param string $ip
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventdnsbase.addnameserverip.php
     */
    public function addNameserverIp(string $ip): bool
    {
    }

    /**
     * addSearch.
     * Adds a domain to the list of search domains.
     *
     * @param string $domain
     *
     * @see https://secure.php.net/manual/en/eventdnsbase.addsearch.php
     */
    public function addSearch(string $domain): void
    {
    }

    /**
     * clearSearch.
     * Removes all current search suffixes.
     *
     * @see https://secure.php.net/manual/en/eventdnsbase.clearsearch.php
     */
    public function clearSearch(): void
    {
    }

    /**
     * countNameservers.
     * Gets the number of configured nameservers.
     *
     * @return int
     *
     * @see https://secure.php.net/manual/en/eventdnsbase.countnameservers.php
     */
    public function countNameservers(): int
    {
    }

    /**
     * loadHosts.
     * Loads a hosts file (in the same format as /etc/hosts) from hosts file.
     *
     * @param string $hosts
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventdnsbase.loadhosts.php
     */
    public function loadHosts(string $hosts): bool
    {
    }

    /**
     * parseResolvConf.
     * Scans the resolv.conf-formatted file.
     *
     * @param int    $flags
     * @param string $filename
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventdnsbase.parseresolvconf.php
     */
    public function parseResolvConf(int $flags, string $filename): bool
    {
    }

    /**
     * setOption.
     * Set the value of a configuration option.
     *
     * @param string $option
     * @param string $value
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventdnsbase.setoption.php
     */
    public function setOption(string $option, string $value): bool
    {
    }

    /**
     * setSearchNdots.
     * Set the 'ndots' parameter for searches.
     *
     * @param int $ndots
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventdnsbase.setsearchndots.php
     */
    public function setSearchNdots(int $ndots): bool
    {
    }
}

// The EventHttp class
/**
 * EventHttp.
 * Represents HTTP server.
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://secure.php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://secure.php.net/manual/en/class.eventhttp.php
 */
final class EventHttp
{
    /**
     * __construct.
     * Constructs EventHttp object(the HTTP server).
     *
     * @param EventBase       $base
     * @param EventSslContext $ctx  = null
     *
     * @see https://secure.php.net/manual/en/eventhttp.construct.php
     */
    public function __construct(EventBase $base, EventSslContext $ctx = null)
    {
    }

    /**
     * accept.
     * Makes an HTTP server accept connections on the specified socket stream or resource.
     *
     * @param mixed $socket
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventhttp.accept.php
     */
    public function accept(mixed $socket): bool
    {
    }

    /**
     * addServerAlias.
     * Adds a server alias to the HTTP server object.
     *
     * @param string $alias
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventhttp.addserveralias.php
     */
    public function addServerAlias(string $alias): bool
    {
    }

    /**
     * bind.
     * Binds an HTTP server on the specified address and port.
     *
     * @param string $address
     * @param int    $port
     *
     * @see https://secure.php.net/manual/en/eventhttp.bind.php
     */
    public function bind(string $address, int $port): void
    {
    }

    /**
     * removeServerAlias.
     * Removes server alias.
     *
     * @param string $alias
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventhttp.removeserveralias.php
     */
    public function removeServerAlias(string $alias): bool
    {
    }

    /**
     * setAllowedMethods.
     * Sets the what HTTP methods are supported in requests accepted by this server, and passed to user callbacks.
     *
     * @param int $methods
     *
     * @see https://secure.php.net/manual/en/eventhttp.setallowedmethods.php
     */
    public function setAllowedMethods(int $methods): void
    {
    }

    /**
     * setCallback.
     * Sets a callback for specified URI.
     *
     * @param string $path
     * @param string $cb
     * @param string $arg  (optional)
     *
     * @see https://secure.php.net/manual/en/eventhttp.setcallback.php
     */
    public function setCallback(string $path, string $cb, string $arg): void
    {
    }

    /**
     * setDefaultCallback.
     * Sets default callback to handle requests that are not caught by specific callbacks.
     *
     * @param string $cb
     * @param string $arg (optional)
     *
     * @see https://secure.php.net/manual/en/eventhttp.setdefaultcallback.php
     */
    public function setDefaultCallback(string $cb, string $arg): void
    {
    }

    /**
     * setMaxBodySize.
     * Sets maximum request body size.
     *
     * @param int $value
     *
     * @see https://secure.php.net/manual/en/eventhttp.setmaxbodysize.php
     */
    public function setMaxBodySize(int $value): void
    {
    }

    /**
     * setMaxHeadersSize.
     * Sets maximum HTTP header size.
     *
     * @param int $value
     *
     * @see https://secure.php.net/manual/en/eventhttp.setmaxheaderssize.php
     */
    public function setMaxHeadersSize(int $value): void
    {
    }

    /**
     * setTimeout.
     * Sets the timeout for an HTTP request.
     *
     * @param int $value
     *
     * @see https://secure.php.net/manual/en/eventhttp.settimeout.php
     */
    public function setTimeout(int $value): void
    {
    }
}

// The EventHttpConnection class
/**
 * EventHttpConnection.
 * Represents an HTTP connection.
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://secure.php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://secure.php.net/manual/en/class.eventhttpconnection.php
 */
class EventHttpConnection
{
    /**
     * __construct.
     * Constructs EventHttpConnection object.
     *
     * @param EventBase       $base
     * @param EventDnsBase    $dns_base
     * @param string          $address
     * @param int             $port
     * @param EventSslContext $ctx      = null
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.construct.php
     */
    public function __construct(EventBase $base, EventDnsBase $dns_base, string $address, int $port, EventSslContext $ctx = null)
    {
    }

    /**
     * getBase.
     * Returns event base associated with the connection.
     *
     * @return EventBase
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.getbase.php
     */
    public function getBase(): EventBase
    {
    }

    /**
     * getPeer.
     * Gets the remote address and port associated with the connection.
     *
     * @param string &$address
     * @param int    &$port
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.getpeer.php
     */
    public function getPeer(string &$address, int &$port): void
    {
    }

    /**
     * makeRequest.
     * Makes an HTTP request over the specified connection.
     *
     * @param EventHttpRequest $req
     * @param int              $type
     * @param string           $uri
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.makerequest.php
     */
    public function makeRequest(EventHttpRequest $req, int $type, string $uri): bool
    {
    }

    /**
     * setCloseCallback.
     * Set callback for connection close.
     *
     * @param callable $callback
     * @param mixed    $data     (optional)
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.setclosecallback.php
     */
    public function setCloseCallback(callable $callback, mixed $data): void
    {
    }

    /**
     * setLocalAddress.
     * Sets the IP address from which HTTP connections are made.
     *
     * @param string $address
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.setlocaladdress.php
     */
    public function setLocalAddress(string $address): void
    {
    }

    /**
     * setLocalPort.
     * Sets the local port from which connections are made.
     *
     * @param int $port
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.setlocalport.php
     */
    public function setLocalPort(int $port): void
    {
    }

    /**
     * setMaxBodySize.
     * Sets maximum body size for the connection.
     *
     * @param string $max_size
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.setmaxbodysize.php
     */
    public function setMaxBodySize(string $max_size): void
    {
    }

    /**
     * setMaxHeadersSize.
     * Sets maximum header size.
     *
     * @param string $max_size
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.setmaxheaderssize.php
     */
    public function setMaxHeadersSize(string $max_size): void
    {
    }

    /**
     * setRetries.
     * Sets the retry limit for the connection.
     *
     * @param int $retries
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.setretries.php
     */
    public function setRetries(int $retries): void
    {
    }

    /**
     * setTimeout.
     * Sets the timeout for the connection.
     *
     * @param int $timeout
     *
     * @see https://secure.php.net/manual/en/eventhttpconnection.settimeout.php
     */
    public function setTimeout(int $timeout): void
    {
    }
}

// The EventHttpRequest class
class EventHttpRequest
{
    const CMD_GET = 1;
    const CMD_POST = 2;
    const CMD_HEAD = 4;
    const CMD_PUT = 8;
    const CMD_DELETE = 16;
    const CMD_OPTIONS = 32;
    const CMD_TRACE = 64;
    const CMD_CONNECT = 128;
    const CMD_PATCH = 256;
    const INPUT_HEADER = 1;
    const OUTPUT_HEADER = 2;

    /**
     * EventHttpRequest constructor.
     * @param callable $callback
     * @param mixed $data
     */
    public function __construct(callable $callback, $data = null)
    {
    }

    public function addHeader(string $key, string $value, int $type)
    {
    }

    public function cancel()
    {
    }

    public function clearHeaders()
    {
    }

    public function closeConnection()
    {
    }

    public function findHeader(string $key, string $type)
    {
    }

    public function free()
    {
    }

    public function getCommand()
    {
    }

    public function getHost()
    {
    }

    public function getInputBuffer()
    {
    }

    public function getInputHeaders()
    {
    }

    public function getOutputBuffer()
    {
    }

    public function getOutputHeaders()
    {
    }

    public function getResponseCode()
    {
    }

    public function getUri()
    {
    }

    public function removeHeader()
    {
    }

    public function sendError()
    {
    }

    public function sendReply()
    {
    }

    public function sendReplyChunk()
    {
    }

    public function sendReplyEnd()
    {
    }

    public function sendReplyStart()
    {
    }
}

//  The EventListener class
/**
 * EventListener.
 * Represents a connection listener.
 *
 * @property int $fd
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://secure.php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://secure.php.net/manual/en/class.eventlistener.php
 */
final class EventListener
{
    const OPT_LEAVE_SOCKETS_BLOCKING = 1;
    const OPT_CLOSE_ON_FREE = 2;
    const OPT_CLOSE_ON_EXEC = 4;
    const OPT_REUSEABLE = 8;
    const OPT_THREADSAFE = 16;

    public $fd;

    /**
     * __construct.
     * Creates new connection listener associated with an event base.
     *
     * @param EventBase $base
     * @param callable  $cb
     * @param mixed     $data
     * @param int       $flags
     * @param int       $backlog
     * @param mixed     $target
     *
     * @see https://secure.php.net/manual/en/eventlistener.construct.php
     */
    public function __construct(EventBase $base, callable $cb, mixed $data, int $flags, int $backlog, mixed $target)
    {
    }

    /**
     * disable.
     * Disables an event connect listener object.
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventlistener.disable.php
     */
    public function disable(): bool
    {
    }

    /**
     * enable.
     * Enables an event connect listener object.
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventlistener.enable.php
     */
    public function enable(): bool
    {
    }

    /**
     * getBase.
     * Returns event base associated with the event listener.
     *
     * @see https://secure.php.net/manual/en/eventlistener.getbase.php
     */
    public function getBase(): void
    {
    }

    /**
     * getSocketName.
     * Retreives the current address to which the listener's socket is bound.
     *
     * @param string &$address
     * @param mixed  &$port
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventlistener.getsocketname.php
     */
    public static function getSocketName(string &$address, mixed &$port): bool
    {
    }

    /**
     * setCallback.
     * The setCallback purpose.
     *
     * @param callable $cb
     * @param mixed    $arg = null
     *
     * @see https://secure.php.net/manual/en/eventlistener.setcallback.php
     */
    public function setCallback(callable $cb, mixed $arg = null): void
    {
    }

    /**
     * setErrorCallback.
     * Set event listener's error callback.
     *
     * @param string $cb
     *
     * @see https://secure.php.net/manual/en/eventlistener.seterrorcallback.php
     */
    public function setErrorCallback(string $cb): void
    {
    }
}

//  The EventSslContext class
/**
 * EventSslContext.
 * Represents SSL_CTX structure. Provides methods and properties to configure the SSL context.
 *
 * @property string $local_cert
 * @property string $local_pk
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://secure.php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://secure.php.net/manual/en/class.eventsslcontext.php
 */
final class EventSslContext
{
    const SSLv2_CLIENT_METHOD = 1;
    const SSLv3_CLIENT_METHOD = 2;
    const SSLv23_CLIENT_METHOD = 3;
    const TLS_CLIENT_METHOD = 4;
    const SSLv2_SERVER_METHOD = 5;
    const SSLv3_SERVER_METHOD = 6;
    const SSLv23_SERVER_METHOD = 7;
    const TLS_SERVER_METHOD = 8;
    const OPT_LOCAL_CERT = 1;
    const OPT_LOCAL_PK = 2;
    const OPT_PASSPHRASE = 3;
    const OPT_CA_FILE = 4;
    const OPT_CA_PATH = 5;
    const OPT_ALLOW_SELF_SIGNED = 6;
    const OPT_VERIFY_PEER = 7;
    const OPT_VERIFY_DEPTH = 8;
    const OPT_CIPHERS = 9;

    public $local_cert;
    public $local_pk;

    /**
     * __construct.
     * Constructs an OpenSSL context for use with Event classes.
     *
     * @param string $method
     * @param string $options
     *
     * @see https://secure.php.net/manual/en/eventsslcontext.construct.php
     */
    public function __construct(string $method, string $options)
    {
    }
}

// The EventUtil class
/**
 * EventUtil.
 * EventUtil is a singleton with supplimentary methods and constants.
 *
 * @author Kazuaki MABUCHI
 * @copyright Copyright (https://secure.php.net/manual/cc.license.php) by the PHP Documentation Group is licensed under [CC by 3.0 or later](https://creativecommons.org/licenses/by/3.0/).
 *
 * @see https://secure.php.net/manual/en/class.eventutil.php
 */
final class EventUtil
{
    const AF_INET = 2;
    const AF_INET6 = 10;
    const AF_UNSPEC = 0;
    const LIBEVENT_VERSION_NUMBER = 33559808;
    const SO_DEBUG = 1;
    const SO_REUSEADDR = 2;
    const SO_KEEPALIVE = 9;
    const SO_DONTROUTE = 5;
    const SO_LINGER = 13;
    const SO_BROADCAST = 6;
    const SO_OOBINLINE = 10;
    const SO_SNDBUF = 7;
    const SO_RCVBUF = 8;
    const SO_SNDLOWAT = 19;
    const SO_RCVLOWAT = 18;
    const SO_SNDTIMEO = 21;
    const SO_RCVTIMEO = 20;
    const SO_TYPE = 3;
    const SO_ERROR = 4;
    const SOL_SOCKET = 1;
    const SOL_TCP = 6;
    const SOL_UDP = 17;
    const IPPROTO_IP = 0;
    const IPPROTO_IPV6 = 41;

    /**
     * __construct.
     * The abstract constructor.
     *
     * @see https://secure.php.net/manual/en/eventutil.construct.php
     */
    abstract public function __construct();

    /**
     * getLastSocketErrno.
     * Returns the most recent socket error number.
     *
     * @param mixed $socket = null
     *
     * @return int
     *
     * @see https://secure.php.net/manual/en/eventutil.getlastsocketerrno.php
     */
    public static function getLastSocketErrno(mixed $socket = null): int
    {
    }

    /**
     * getLastSocketError.
     * Returns the most recent socket error.
     *
     * @param mixed $socket
     *
     * @return string
     *
     * @see https://secure.php.net/manual/en/eventutil.getlastsocketerror.php
     */
    public static function getLastSocketError(mixed $socket): string
    {
    }

    /**
     * getSocketFd.
     * Returns numeric file descriptor of a socket, or stream.
     *
     * @param mixed $socket
     *
     * @return int
     *
     * @see https://secure.php.net/manual/en/eventutil.getsocketfd.php
     */
    public static function getSocketFd(mixed $socket): int
    {
    }

    /**
     * getSocketName.
     * Retreives the current address to which the socket is bound.
     *
     * @param mixed  $socket
     * @param string &$address
     * @param mixed  &$port
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventutil.getsocketname.php
     */
    public static function getSocketName(mixed $socket, string &$address, mixed &$port): bool
    {
    }

    /**
     * setSocketOption.
     * Sets socket options.
     *
     * @param mixed $socket
     * @param int   $level
     * @param int   $optname
     * @param mixed $optval
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/eventutil.setsocketoption.php
     */
    public static function setSocketOption(mixed $socket, int $level, int $optname, mixed $optval): bool
    {
    }

    /**
     * sslRandPoll.
     * Generates entropy by means of OpenSSL's RAND_poll().
     *
     * @see https://secure.php.net/manual/en/eventutil.sslrandpoll.php
     */
    public static function sslRandPoll(): void
    {
    }
}
