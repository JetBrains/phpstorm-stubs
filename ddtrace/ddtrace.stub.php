<?php

// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses

namespace DDTrace {
    /**
     * @var int
     */
    const DBM_PROPAGATION_DISABLED = 0;

    /**
     * @var int
     */
    const DBM_PROPAGATION_SERVICE = 0;

    /**
     * @var int
     */
    const DBM_PROPAGATION_FULL = 0;

    class SpanLink implements \JsonSerializable
{
        /**
         * A 32-character, lower-case hexadecimal encoded string of the linked trace ID. This field
         * shouldn't be directly assigned an id from SpanData. Use the SpanData::getLinks() method instead.
         */
        public string $traceId;

        /**
         * A 16-character, lower-case hexadecimal encoded string of the linked span ID. This field
         * shouldn't be directly assigned an id from SpanData. Use the SpanData::getLinks() method instead.
         */
        public string $spanId;
        public string $traceState;

        /**
         * @var string[]
         */
        public array $attributes;
        public int $droppedAttributesCount;

        public function jsonSerialize(): mixed {}

        /**
         * Consumes distributed tracing headers, from which a span link will be constructed.
         *
         * @param array|callable(string):mixed $headersOrCallback Either an array with a lowercase header to value mapping,
         * or a callback, which given a header name for distributed tracing, returns the value it should be updated to.
         */
        public static function fromHeaders(array|callable $headersOrCallback): SpanLink {}
    }

    class SpanData
{
        /**
         * The span name
         */
        public string|null $name = "";

        /**
         * The resource you are tracing
         */
        public string|null $resource = "";

        /**
         * The service you are tracing. Defaults to active service at the time of span creation (i.e.,
         * the parent span), or datadog.service initialization settings if no parent exists
         */
        public string|null $service = "";

        /**
         * The environment you are tracing. Defaults to active environment at the time of span creation
         * (i.e., the parent span), or datadog.env initialization settings if no parent exists
         */
        public string $env = "";

        /**
         * The version of the application you are tracing. Defaults to active version at the time of
         * span creation (i.e., the parent span), or datadog.version initialization settings if no parent exists
         */
        public string $version = "";

        /**
         * @var string[] Meta struct can be used to send any data to the backend. The peculiarity of meta struct is
         * that the values are encoded with msgpack when sent to the agent. The values are first encoded to msgpack
         * and then, encoded again with msgpack to binary
         */
        public array $meta_struct = [];

        /**
         * The type of request which can be set to: web, db, cache, or custom (Optional). Inherited
         * from parent.
         */
        public string|null $type = "";

        /**
         * @var string[] An array of key-value span metadata; keys and values must be strings.
         */
        public array $meta = [];

        /**
         * @var float[] An array of key-value span metrics; keys must be strings and values must be floats.
         */
        public array $metrics = [];

        /**
         * An exception generated during the execution of the original function, if any.
         */
        public \Throwable|null $exception = null;

        /**
         * The unique identifier of the span
         */
        public readonly string $id;

        /**
         * @var SpanLink[] An array of span links
         */
        public array $links = [];

        /**
         * @var string[] A sorted list of tag names used to set the `peer.service` tag. If a tag
         * name is added to this field and the tag exists on the span at serialization time, then the value of the tag
         * will be used to set the value of the `peer.service` tag.
         */
        public array $peerServiceSources = [];

        /**
         * The parent span, or 'null' if there is none
         */
        public readonly SpanData|null $parent;

        /**
         * The span's stack trace
         */
        public readonly SpanStack $stack;

        /**
         * Get the current span duration, in nanoseconds
         */
        public function getDuration(): int {}

        /**
         * Get the start time of the span, in nanoseconds
         */
        public function getStartTime(): int {}

        /**
         * Get a pre-populated SpanLink object with the current span's trace and span IDs
         */
        public function getLink(): SpanLink {}

        /**
         * Returns the span id as zero-padded 16 character hexadecimal string.
         */
        public function hexId(): string {}
    }

    class RootSpanData extends SpanData
{
        /**
         * The origin site of the trace. Propagated through distributed tracing by default.
         */
        public string $origin;

        /**
         * A hashset of keys which are propagated from meta, if present.
         */
        public array $propagatedTags = [];

        /**
         * The currently active sampling priority.
         */
        public int $samplingPriority = \DD_TRACE_PRIORITY_SAMPLING_UNKNOWN;

        /**
         * The unmodified sampling priority as inherited directly through distributed tracing.
         */
        public int $propagatedSamplingPriority;

        /**
         * The original tracestate minus datadog specific tags, as it will be propagated to upstream
         * distributed tracing targets.
         */
        public string $tracestate;

        /**
         * A list of datadog specific tags, which will be propagated to upstream distributed tracing
         * targets as part of the tracestate. Some known keys are not included here, but directly extracted, e.g. origin.
         */
        public array $tracestateTags = [];

        /**
         * The unique identifier of the parent span as a decimal number.
         * Assignment of an invalid id will unset the parent id.
         * This variable cannot be accessed by reference.
         */
        public string $parentId;

        /**
         * The unique identifier for the trace id, as a zero-padded 32 character hexadecimal string.
         * Assignment of an invalid id will reset the trace id to the default trace id.
         * This variable cannot be accessed by reference.
         */
        public string $traceId = "";
    }

    /**
     * The SpanStack class allows context transfer between spans.
     *
     * When a new span is created, it will always be on the top the of active stack, becoming the new active span. This
     * new span's stack property is assigned the stack of the previous active span (or a primary stack is initialized in
     * the case of a root span). The parent of a SpanStack is the active stack at the time of the creation of the new
     * stack.
     *
     * Each SpanStack has only one active span at a time, and can be manipulated using the 'create_stack' and
     * 'switch_stack' functions. 'create_stack' creates a new SpanStack whose parent is the currently active stack,
     * while 'switch_stack' switches the active span.
     */
    class SpanStack
{
        /**
         * The parent stack, or 'null' if there is none
         */
        public readonly SpanStack|null $parent;

        /**
         * The active span
         */
        public SpanData|null $active = null;
    }

    interface Integration
{
        // Possible statuses for the concrete:
        /**
         * It has not been loaded yet
         *
         * @var int
         */
        const NOT_LOADED = 0;

        /**
         * It has been loaded, no more work required
         *
         * @var int
         */
        const LOADED = 0;

        /**
         * Prerequisites are not matched and won't be matched in the future.
         *
         * @var int
         */
        const NOT_AVAILABLE = 0;

        /** Load the integration */
        public function init(): int;
    }

    // phpcs:disable Generic.Files.LineLength.TooLong

    /**
     * Instrument (trace) a specific method call. This function automatically handle the following tasks:
     * - Open a span before the code executes
     * - Set any errors from the instrumented call on the span
     * - Close the span when the instrumented call is done.
     *
     * Additional tags are set on the span from the closure (called a tracing closure).
     *
     * @param string $className The name of the class that contains the method.
     * @param string $methodName The name of the method to instrument.
     * @param null|\Closure(SpanData $span, array $args, mixed $retval, \Exception|null $exception):void|array{prehook?: \Closure, posthook?: \Closure, instrument_when_limited?: int, recurse?: bool} $tracingClosureOrConfigArray
     * The tracing closure is a function that adds extra tags to the span after the
     * instrumented call is executed. It accepts four parameters, namely, an instance of 'DDTrace\SpanData', an array of
     * arguments from the instrumented call, the return value of the instrumented call, and an instance of the exception
     * that was thrown in the instrumented call (if any), or 'null' if no exception was thrown.
     *
     * Alternatively, an associative configuration array can be given whose recognized keys are:
     * - 'prehook': a closure to be run prior to the method call
     * - 'posthook': a closure to be run after the method was executed
     * - 'instrument_when_limited': set to 1 shall the method be traced in limited mode (e.g., when span limit
     * exceeded)
     * - 'recurse': a boolean to state whether should recursive calls be traced as well
     * @return bool 'true' if the call was successfully instrumented, else 'false'
     */
    function trace_method(
        string $className,
        string $methodName,
        null|\Closure|array $tracingClosureOrConfigArray
    ): bool {}

    /**
     * Instrument (trace) a specific function call. This function automatically handle the following tasks:
     * - Open a span before the code executes
     * - Set any errors from the instrumented call on the span
     * - Close the span when the instrumented call is done.
     *
     * Additional tags are set on the span from the closure (called a tracing closure).
     *
     * @param string $functionName The name of the function to trace.
     * @param null|\Closure(SpanData $span, array $args, mixed $retval, \Exception|null $exception):void|array{prehook?: \Closure, posthook?: \Closure, instrument_when_limited?: int, recurse?: bool} $tracingClosureOrConfigArray
     * The tracing closure is a function that adds extra tags to the span after the
     * instrumented call is executed. It accepts four parameters, namely, an instance of 'DDTrace\SpanData' that writes
     * to the span properties, an array of arguments from the instrumented call, the return value of the instrumented
     * call, and an instance of the exception that was thrown in the instrumented call (if any), or 'null' if no
     * exception was thrown.
     *
     * Alternatively, an associative configuration array can be given whose recognized keys are:
     * - 'prehook': a closure to be run prior to the function call
     * - 'posthook': a closure to be run after the function was executed
     * - 'instrument_when_limited': set to 1 shall the function be traced in limited mode (e.g., when span limit
     * exceeded)
     * - 'recurse': a boolean to state whether should recursive calls be traced as well
     * @return bool 'true' if the call was successfully instrumented, else 'false'
     */
    function trace_function(string $functionName, \Closure|array|null $tracingClosureOrConfigArray): bool {}

    /**
     * This function allows to define pre- and post-hooks that will be executed before and after the function is called.
     *
     * @param string $functionName The name of the function to be instrumented.
     * @param \Closure(object ):void|null|array{prehook?: \Closure, posthook?: \Closure, instrument_when_limited?: int, recurse?: bool} $prehookOrConfigArray
     * A pre-hook function that will be called before the instrumented function is
     * executed. This can be useful for things like asserting the function is passed the  correct arguments.
     *
     * Alternatively, an associative configuration array can be given whose recognized keys are:
     * - 'prehook': a closure to be run prior to the function call
     * - 'posthook': a closure to be run after the function was executed
     * - 'instrument_when_limited': set to 1 shall the function be traced in limited mode (e.g., when span limit
     * exceeded)
     * - 'recurse': a boolean to state whether should recursive calls be traced as well
     * @param \Closure(array $args, mixed $retval, \Exception|null $exception):void|null $posthook A post-hook function that will be called after
     * the instrumented function is executed. This can be useful for things like formatting output data or logging the
     * results of the function call.
     *
     * Note that the $posthook argument shouldn't be given when calling hook_function if a configuration array has been
     * passed.
     * @return bool 'false' if the hook could not be successfully installed, else 'true'
     */
    function hook_function(
        string $functionName,
        \Closure|array|null $prehookOrConfigArray = null,
        ?\Closure $posthook = null
    ): bool {}

    /**
     * This function allows to define pre- and post-hooks that will be executed before and after the method is called.
     *
     * @param string $className The name of the class that contains the method.
     * @param string $methodName The name of the method to instrument.
     * @param \Closure(mixed $args):void|null|array{prehook?: \Closure, posthook?: \Closure, instrument_when_limited?: int, recurse?: bool} $prehookOrConfigArray
     * A pre-hook function that will be called before the instrumented
     * method is executed. This can be useful for things like asserting the method is passed the correct arguments.
     *
     * Alternatively, an associative configuration array can be given whose recognized keys are:
     * - 'prehook': a closure to be run prior to the function call
     * - 'posthook': a closure to be run after the function was executed
     * - 'instrument_when_limited': set to 1 shall the function be traced in limited mode (e.g., when span limit
     * exceeded)
     * - 'recurse': a boolean to state whether should recursive calls be traced as well
     * @param \Closure(object $object, string $scope, array $args, mixed $retval, \Exception|null $exception):void|null $posthook A post-hook function that will be called after
     * the instrumented method is executed. This can be useful for things like formatting output data or logging the
     * results of the method call.
     *
     * Note that the $posthook argument shouldn't be given when calling hook_function if a configuration array has been
     * passed.
     * @return bool 'false' when no hook is passed, else 'true'
     */
    function hook_method(
        string $className,
        string $methodName,
        \Closure|array|null $prehookOrConfigArray = null,
        ?\Closure $posthook = null
    ): bool {}

    // phpcs:enable Generic.Files.LineLength.TooLong

    /**
     * Add a tag to be automatically applied to every span that is created, if tracing is enabled.
     *
     * @param string $key Tag key
     * @param string $value Tag Value
     */
    function add_global_tag(string $key, string $value): void {}

    /**
     * Add a tag to be propagated along distributed traces' information. It also adds the tag to the local root span.
     *
     * @param string $key Tag key
     * @param string $value Tag value
     */
    function add_distributed_tag(string $key, string $value): void {}

    /**
     * Add user information to monitor authenticated requests in the application.
     *
     * @param string $userId Unique identifier of the user (usr.id)
     * @param array $metadata User monitoring tags (usr.<TAG_NAME>) applied to the 'meta' section of the root span
     * @param bool|null $propagate If set to 'true', user's information will be propagated in distributed traces
     */
    function set_user(string $userId, array $metadata = [], bool|null $propagate = null): void {}

    /**
     * Close child spans of a parent span if a non-internal span is given,
     * else if 'null' is given, close active, non-internal spans
     *
     * @param SpanData|null $span The parent span
     * @return false|int 'false' if spans couldn't be closed, else the number of span closed
     */
    function close_spans_until(?SpanData $span): false|int {}

    /**
     * Get the active span
     *
     * @return SpanData|null 'null' if tracing isn't enabled or there isn't any active span, else the active span
     */
    function active_span(): null|SpanData {}

    /**
     * Get the root span
     *
     * @return RootSpanData|null 'null' if tracing isn't enabled or if the active stack doesn't have a root span,
     * else the root span of the active stack
     */
    function root_span(): null|RootSpanData {}

    /**
     * Start a new custom user-span on the top of the stack. If no active span exists, the new created span will be a
     * root span, on its own new span stack (i.e., it is equivalent to 'start_trace_span'). In that case, distributed
     * tracing information will be applied if available.
     *
     * @param float $startTime Start time of the span in seconds.
     * @return SpanData|false The newly started span, or 'false' if a wrong parameter was given.
     */
    function start_span(float $startTime = 0): SpanData|false {}

    /**
     * Close the currently active user-span on the top of the stack
     *
     * @param float $finishTime Finish time in seconds. Defaults to now if zero.
     * @return false|null 'false' if unexpected parameters were given, else 'null'
     */
    function close_span(float $finishTime = 0): false|null {}

    /**
     * Update the duration of an already closed span
     *
     * Note that this API won't cause an update of a closed span if it's already sent. Its usage, particularly on
     * root spans with datadog.trace.auto_flush_enabled may not yield the expected results.
     *
     * @param SpanData $span The span to update.
     * @param float $finishTime Finish time in seconds. Defaults to now if zero.
     * @return false|null 'false' if unexpected parameters were given, else 'null'
     */
    function update_span_duration(SpanData $span, float $finishTime = 0): false|null {}

    /**
     * Start a new trace
     *
     * More precisely, a new root span stack will be created and switched on to, and a new span started.
     *
     * @param float $startTime Start time of the span in seconds.
     * @return SpanData The newly created root span
     */
    function start_trace_span(float $startTime = 0): SpanData {}

    /**
     * Get the active stack
     *
     * @return SpanStack|null A copy of the active stack, or 'null' if the tracer is disabled. Won't happen
     * under normal operation.
     */
    function active_stack(): SpanStack|null {}

    /**
     * Initialize a new span stack and switch to it. If tracing isn't enabled, a root span stack will be created.
     *
     * @return SpanStack The newly created span stack
     */
    function create_stack(): SpanStack {}

    /**
     * Switch back to a specific stack (even if there is no active span on that stack), or to the parent of the active
     * stack if no stack is given.
     *
     * @param SpanData|SpanStack|null $newStack Stack to switch to. If 'null' is given, switches to the parent of the
     * active stack. If a SpanData object is given, it will switch to the stack of the latter.
     * @return null|false|SpanStack The newly active stack, or 'null' if the tracer is disabled (Won't happen under
     * normal operation), or 'false' if unexpected parameters were given.
     */
    function switch_stack(SpanData|SpanStack|null $newStack = null): null|false|SpanStack {}

    /**
     * Set the priority sampling level
     *
     * @param int $priority The priority level to be set to.
     * @param bool $global If set to 'true' and if there is no active stack (or the active stack doesn't have a
     * root span), then the default priority sampling will be set to the provided priority level. Otherwise, the root's
     * priority sampling level will be updated with the new value.
     */
    function set_priority_sampling(int $priority, bool $global = false): void {}

    /**
     * Get the priority sampling level
     *
     * @param bool $global If set to 'true' and if there is no active stack (or the active stack doesn't have a
     * root span), then the default priority sampling will be returned, else it will be fetched from the root.
     * @return int|null The priority sampling level, or 'null' if an unexpected parameter was given.
     */
    function get_priority_sampling(bool $global = false): int|null {}

    /**
     * Sanitize an exception
     *
     * @param \Exception|\Throwable $exception
     * @param int $skipFrames The number of frames to be dropped from the start. E.g. to hide the fact that we're
     * in a hook function.
     */
    function get_sanitized_exception_trace(\Exception|\Throwable $exception, int $skipFrames = 0): string {}

    /**
     * Update datadog headers for distributed tracing for new spans. Also applies this information to the current trace,
     * if there is one, as well as the future ones if it isn't overwritten
     *
     * @param null|array|callable(string):mixed $headersOrCallback Either an array with a lowercase header to value mapping,
     * or a callback, which given a header name for distributed tracing, returns the value it should be updated to. If null,
     * this reads the headers directly from the $_SERVER superglobal.
     */
    function consume_distributed_tracing_headers(null|array|callable $headersOrCallback): void {}

    /**
     * Get information on the key-value pairs of the datadog headers for distributed tracing
     *
     * @param null|string[] $inject The types of sampling headers which shall be generated, equivalent to what
     * DD_TRACE_PROPAGATION_STYLE_INJECT supports. Defaults to DD_TRACE_PROPAGATION_STYLE_INJECT if null.
     *
     * @return array{x-datadog-sampling-priority: string,
     *               x-datadog-origin: string,
     *               x-datadog-trace-id: string,
     *               x-datadog-parent-id: string,
     *               traceparent: string,
     *               tracestate: string
     *          }
     */
    function generate_distributed_tracing_headers(array|null $inject = null): array {}

    /**
     * Searches parent frames to see whether it's currently within a catch block and returns that exception.
     *
     * @return \Throwable|null The active exception if there is one, else 'null'.
     */
    function find_active_exception(): \Throwable|null {}

    /**
     * Retrieve IPs from the given array if valid headers are found, and return them in
     * a metadata formatting
     *
     * @param string[] $headers
     */
    function extract_ip_from_headers(array $headers): array {}

    /**
     * Get startup information in JSON format
     *
     * @return string Startup information
     */
    function startup_logs(): string {}

    /**
     * Return the id of the current trace
     *
     * @return string The id of the current trace
     */
    function trace_id(): string {}

    /**
     * Formatted trace id to be used for logs correlation.
     *
     * This function handles 128-bit trace ids and 64-bit trace ids. More specifically, if
     * DD_TRACE_128_BIT_TRACEID_LOGGING_ENABLED is set to true and the current trace id is 128-bit, then the trace id
     * will be returned as a 32-character hexadecimal string. Otherwise, the trace id will be returned as the
     * decimal representation of the 64-bit trace id.
     *
     * @return string The formatted id of the current trace
     */
    function logs_correlation_trace_id(): string {}

    /**
     * Get information on the current context
     *
     * @return array{trace_id: string, span_id: string, version: string, env: string}
     */
    function current_context(): array {}

    /**
     * Apply the distributed tracing information on the current and future spans. That API can be called if there is no
     * other currently active span.
     *
     * The distributed tracing context can be reset by calling 'set_distributed_tracing_context("0", "0")'
     *
     * @param string $traceId The unique integer (128-bit unsigned) ID of the trace containing this span
     * @param string $parentId The span integer ID of the parent span
     * @param string|null $origin The distributed tracing origin
     * @param array|string|null $propagated_tags If provided, propagated tags from the root span will be cleared and
     * replaced by the given tags and applied to existing spans
     * @return bool 'true' if the distributed tracing context was properly set, else 'false' if an error occurred
     */
    function set_distributed_tracing_context(
        string $traceId,
        string $parentId,
        ?string $origin = null,
        array|string|null $propagated_tags = null
    ): bool {}

    /**
     * Closes all spans and force-send finished traces to the agent
     */
    function flush(): void {}

    /**
     * Registers an array to be populated with spans for each request during the next curl_multi_exec() call.
     *
     * @internal
     * @param list{\CurlHandle, SpanData}[] $array An array which will be populated with curl handles and spans.
     */
    function curl_multi_exec_get_request_spans(&$array): void {}

    /**
     * Update a DogStatsD counter
     *
     * @param string $metric The metric name
     * @param int $value The metric value
     * @param array $tags A list of tags associated to the metric
     */
    function dogstatsd_count(string $metric, int $value, array $tags = []): void {}

    /**
     * Update a DogStatsD distribution
     *
     * @param string $metric The metric name
     * @param float $value The metric value
     * @param array $tags A list of tags associated to the metric
     */
    function dogstatsd_distribution(string $metric, float $value, array $tags = []): void {}

    /**
     * Update a DogStatsD gauge
     *
     * @param string $metric The metric name
     * @param float $value The metric value
     * @param array $tags A list of tags associated to the metric
     */
    function dogstatsd_gauge(string $metric, float $value, array $tags = []): void {}

    /**
     * Update a DogStatsD histogram
     *
     * @param string $metric The metric name
     * @param float $value The metric value
     * @param array $tags A list of tags associated to the metric
     */
    function dogstatsd_histogram(string $metric, float $value, array $tags = []): void {}

    /**
     * Update a DogStatsD set
     *
     * @param string $metric The metric name
     * @param int $value The metric value
     * @param array $tags A list of tags associated to the metric
     */
    function dogstatsd_set(string $metric, int $value, array $tags = []): void {}
}

namespace DDTrace\System {
    /**
     * Get the unique identifier of the container
     *
     * @return string|null The container id, or 'null' if no id was found
     */
    function container_id(): string|null {}
}

namespace DDTrace\Config {
    /**
     * Check if the app analytics of an app is enabled for a given integration
     *
     * @param string $integrationName The name of the integration (e.g., mysqli)
     * @return bool The status of the app analytics of the integration
     */
    function integration_analytics_enabled(string $integrationName): bool {}

    /**
     * Check the app analytics sample rate of a given integration
     *
     * @param string $integrationName The name of the integration (e.g., mysqli)
     * @return float The sample rate of the app analytics of the integration
     */
    function integration_analytics_sample_rate(string $integrationName): float {}
}

namespace DDTrace\UserRequest {
    /**
     * If there are any listeners of user request events.
     * @return bool true iif there are any listeners
     */
    function has_listeners(): bool {}

    /**
     * Notifies the user request listeners of the start of a user request.
     *
     * @param \DDTrace\RootSpanData $span the span associated with this user request.
     * @param array $data an array with keys named '_GET', '_POST', '_SERVER', '_FILES', '_COOKIE'
     * @param string|resource|null $body the body of the request (a string or a seekable resource)
     * @return array|null an array with the keys 'status', 'headers' and 'body', or null
     */
    function notify_start(\DDTrace\RootSpanData $span, array $data, mixed $body = null): ?array {}

    /**
     * Notifies the user request listeners of the imminence of a commit, and allows for the replacement of the response.
     * @param \DDTrace\RootSpanData $span the span associated with this user request.
     * @param int $status the HTTP status code of the response
     * @param array $headers the HTTP headers of the response in the form name => array(values)
     * @param string|resource|null $body the body of the response (a string or a seekable resource)
     * @return array|null an array with the keys 'status', 'headers' and 'body', or null
     */
    function notify_commit(\DDTrace\RootSpanData $span, int $status, array $headers, mixed $body = null): ?array {}

    /**
     * Sets a function to be called when blocking a request midway.
     *
     * @param \DDTrace\RootSpanData $span
     * @param callable $blockingFunction a blocking function taking an array with the keys 'status', 'headers', 'body'
     */
    function set_blocking_function(\DDTrace\RootSpanData $span, callable $blockingFunction): void {}
}

namespace DDTrace\Testing {
    /**
     * Overrides PHP's default error handling.
     *
     * @param string $message Error message
     * @param int $errorType Error Type. Supported error types are: E_ERROR, E_WARNING, E_PARSE, E_NOTICE, E_CORE_ERROR,
     * E_CORE_WARNING, E_COMPILE_ERROR, E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE, E_STRICT, E_RECOVERABLE_ERROR,
     * E_DEPRECATED, E_USER_DEPRECATED
     */
    function trigger_error(string $message, int $errorType): void {}
}

namespace DDTrace\Internal {
    /**
     * @var int
     */
    const SPAN_FLAG_OPENTELEMETRY = 0;

    /**
     * @var int
     */
    const SPAN_FLAG_OPENTRACING = 0;

    /**
     * Adds a flag to a span.
     *
     * @internal
     *
     * @param \DDTrace\SpanData $span the span to flag
     * @param int $flag the flag to add to the span
     */
    function add_span_flag(\DDTrace\SpanData $span, int $flag): void {}

    /**
     * To be called when a fork is performed.
     *
     * @internal
     */
    function handle_fork(): void {}
}

namespace {
    /**
     * @var string
     */
    const DD_TRACE_VERSION = '0';

    /**
     * @var int
     */
    const DD_TRACE_PRIORITY_SAMPLING_AUTO_KEEP = 0;

    /**
     * @var int
     */
    const DD_TRACE_PRIORITY_SAMPLING_AUTO_REJECT = 0;

    /**
     * @var int
     */
    const DD_TRACE_PRIORITY_SAMPLING_USER_KEEP = 0;

    /**
     * @var int
     */
    const DD_TRACE_PRIORITY_SAMPLING_USER_REJECT = 0;

    /**
     * @var int
     */
    const DD_TRACE_PRIORITY_SAMPLING_UNKNOWN = 0;

    /**
     * @var int
     */
    const DD_TRACE_PRIORITY_SAMPLING_UNSET = 0;

    /**
     * Get the value of a DD environment variable
     *
     * @param string $envName Environment variable name
     * @return mixed Value of the environment variable
     */
    function dd_trace_env_config(string $envName): mixed {}

    /**
     * Disable tracing in the current request
     */
    function dd_trace_disable_in_request(): bool {}

    /**
     * (Noop/To do) Untrace traced functions and methods
     *
     * @internal
     * @return bool 'true' if reset was successful, else 'false'
     */
    function dd_trace_reset(): bool {}

    /**
     * If tracing is enabled, serialize the trace into a string to send to the agent
     *
     * @internal
     * @param array $traceArray Serialize values must be of type array, string, int, float, bool or null
     * @return bool|string The serialized array, else 'false' if an error was encountered
     */
    function dd_trace_serialize_msgpack(array $traceArray): bool|string {}

    /**
     * Null function to easily breakpoint the execution at specific PHP line in GDB
     *
     * @internal
     * @return bool Return 'true' if tracing is enabled, else 'false'
     */
    function dd_trace_noop(mixed ...$args): bool {}

    /**
     * Get the parsed value of the memory limit DD_TRACE_MEMORY_LIMIT in binary bytes
     *
     * @return int The memory limit
     */
    function dd_trace_dd_get_memory_limit(): int {}

    /**
     * Check if the current memory usage is under the memory limit DD_TRACE_MEMORY_LIMIT
     *
     * @return bool 'true' if the current memory usage is under the memory limit, else 'false'
     */
    function dd_trace_check_memory_under_limit(): bool {}

    /**
     * Get the name of the app (DD_SERVICE)
     *
     * @param string|null $fallbackName Fallback name if the app's name wasn't set
     * @return string|null The app name, else the fallback name. Return 'null' if the app name isn't set and no
     * fallback name is provided.
     */
    function ddtrace_config_app_name(?string $fallbackName = null): ?string {}

    /**
     * Check if distributed tracing is enabled (DD_DISTRIBUTED_TRACING)
     *
     * @return bool 'true' if distributed tracing is enabled, else 'false'
     */
    function ddtrace_config_distributed_tracing_enabled(): bool {}

    /**
     * Check if tracing is enabled (DD_TRACE_ENABLED)
     *
     * @return bool 'true' is tracing is enabled, else 'false'
     */
    function ddtrace_config_trace_enabled(): bool {}

    /**
     * Check if a specific integration is enabled
     *
     * @param string $integrationName The name of the integration (e.g., mysqli)
     * @return bool The status of the integration, or 'false' if tracing isn't enabled.
     */
    function ddtrace_config_integration_enabled(string $integrationName): bool {}

    /**
     * Send payload to background sender's buffer
     *
     * @internal
     * @param int $numTraces Trace count. Note that at the moment, the background sender is only capable of sending
     * exactly one trace
     * @param array $curlHeaders HTTP Headers
     * @param string $payload HTTP Body
     * @return bool 'true' if tracers were successfully sent or if the tracer is disabled, and 'false' if not exactly
     * one trace was sent or if the procedure was unsuccessful
     */
    function dd_trace_send_traces_via_thread(int $numTraces, array $curlHeaders, string $payload): bool {}

    /**
     * Serializes and sends traces to the agent (in the format dd_trace_serialize_closed_spans() returns spans).
     *
     * @internal
     * @param array $traceArray Array in the format returned by dd_trace_serialize_closed_spans()
     */
    function dd_trace_buffer_span(array $traceArray): bool {}

    /**
     * Used to send any already buffered spans to the agent
     *
     * @internal
     */
    function dd_trace_coms_trigger_writer_flush(): int {}

    /**
     * Execute a given internal function
     *
     * Internal functions are: init_and_start_writer, ddtrace_coms_next_group_id, ddtrace_coms_buffer_span,
     * ddtrace_coms_buffer_data, shutdown_writer, set_writer_send_on_flush, test_consumer, test_writers,
     * test_msgpack_consumer, synchronous_flush, and root_span_add_tag
     *
     * @internal
     * @param string $functionName Internal function name
     * @param mixed $args,... Arguments of the function
     * @return mixed false if void function was properly executed, else the return value of it
     */
    function dd_trace_internal_fn(string $functionName, mixed ...$args): mixed {}

    /**
     * Set the distributed trace id
     *
     * @param string|null $traceId New trace id
     * @return bool 'true' if the change was properly applied, else 'false'
     */
    function dd_trace_set_trace_id(?string $traceId = null): bool {}

    /**
     * Tracks closed spans
     *
     * @return int Number of closed spans
     */
    function dd_trace_closed_spans_count(): int {}

    /**
     * Check if the tracer's current memory usage is higher than the set limits
     *
     * @return bool 'true' if memory is overused, else 'false'
     */
    function dd_trace_tracer_is_limited(): bool {}

    /**
     * Get the compiling time of all files compiled up to now (in µs)
     *
     * @return int Compile time
     */
    function dd_trace_compile_time_microseconds(): int {}

    /**
     * Get serialized information about closed spans as arrays. Note that calling this function will result in
     * automatically closing unfinished spans (destroys the open span stack).
     *
     * @return array Closed spans data
     */
    function dd_trace_serialize_closed_spans(): array {}

    /**
     * Get the currently active span id, or the distributed parent trace id if there is no currently active span
     *
     * @return string Currently active span/trace unique identifier
     */
    function dd_trace_peek_span_id(): string {}

    /**
     * Force-finish all spans and force-send finished traces to the agent. Note that this function drops (resp. closes)
     * all currently open spans if DD_AUTOFINISH_SPANS is set to 'false' (resp. 'true'). Dropped spans are not sent to
     * the agent.
     */
    function dd_trace_close_all_spans_and_flush(): void {}

    /**
     * @see DDTrace_trace_function
     */
    function dd_trace_function(string $functionName, \Closure|array|null $tracingClosureOrConfigArray): bool {}

    /**
     * @see DDTrace_trace_method
     */
    function dd_trace_method(
        string $className,
        string $methodName,
        \Closure|array|null $tracingClosureOrConfigArray
    ): bool {}

    /**
     * Untrace a function or a method.
     *
     * @param string $functionName The name of the function or method to untrace
     * @param string|null $className In the case of a method, its respective class should be provided as well
     * @return bool 'true' if the un-tracing process was successful, else 'false'
     */
    function dd_untrace(string $functionName, string|null $className = null): bool {}

    /**
     * Blocking-call synchronously flushing all spans to the agent
     *
     * @param int $timeout Timeout in milliseconds to wait for the flush to complete
     */
    function dd_trace_synchronous_flush(int $timeout = 100): void {}
}
