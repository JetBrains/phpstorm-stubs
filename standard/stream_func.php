<?php
/**
 * PHPStorm stub file for Streams functions.
 *
 * @link http://php.net/manual/en/book.stream.php
 */

/**
 * &Alias; <function>stream_set_blocking</function>
 * <p>Sets blocking or non-blocking mode on a stream.
 * This function works for any stream that supports non-blocking mode (currently, regular files and socket
 * streams).
 *
 * @link       http://php.net/manual/en/function.set-socket-blocking.php
 * @deprecated 5.3 use stream_set_blocking() instead
 *
 * @param resource $socket
 * @param int      $mode If mode is 0, the given stream will be switched to non-blocking mode, and if 1, it will be
 *                       switched to blocking mode. This affects calls like fgets() and fread() that read from the
 *                       stream. In non-blocking mode an fgets() call will always return right away while in
 *                       blocking mode it will wait for data to become available on the stream.
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 * @since      4.0
 * @since      5.0
 */
function set_socket_blocking($socket, $mode) { }

/**
 * Append bucket to brigade
 *
 * @link  http://php.net/manual/en/function.stream-bucket-append.php
 *
 * @param resource $brigade
 * @param object   $bucket
 *
 * @return void
 * @since 5.0
 */
function stream_bucket_append($brigade, $bucket) { }

/**
 * Return a bucket object from the brigade for operating on
 *
 * @link  http://php.net/manual/en/function.stream-bucket-make-writeable.php
 *
 * @param resource $brigade
 *
 * @return object
 * @since 5.0
 */
function stream_bucket_make_writeable($brigade) { }

/**
 * Create a new bucket for use on the current stream
 *
 * @link  http://php.net/manual/en/function.stream-bucket-new.php
 *
 * @param resource $stream
 * @param string   $buffer
 *
 * @return object
 * @since 5.0
 */
function stream_bucket_new($stream, $buffer) { }

/**
 * Prepend bucket to brigade
 *
 * @link  http://php.net/manual/en/function.stream-bucket-prepend.php
 *
 * @param resource $brigade
 * @param resource $bucket
 *
 * @return void
 * @since 5.0
 */
function stream_bucket_prepend($brigade, $bucket) { }

/**
 * Create a streams context
 *
 * @link  http://php.net/manual/en/function.stream-context-create.php
 *
 * @param array $options [optional] <p>
 *                       Must be an associative array of associative arrays in the format
 *                       $arr['wrapper']['option'] = $value.
 *                       </p>
 *                       <p>
 *                       Default to an empty array.
 *                       </p>
 * @param array $params  [optional] <p>
 *                       Must be an associative array in the format
 *                       $arr['parameter'] = $value.
 *                       Refer to context parameters for
 *                       a listing of standard stream parameters.
 *                       </p>
 *
 * @return resource A stream context resource.
 * @since 4.3.0
 * @since 5.0
 */
function stream_context_create(array $options = null, array $params = null) { }

/**
 * Retreive the default streams context
 *
 * @link  http://php.net/manual/en/function.stream-context-get-default.php
 *
 * @param array $options [optional] options must be an associative
 *                       array of associative arrays in the format
 *                       $arr['wrapper']['option'] = $value.
 *                       <p>
 *                       As of PHP 5.3.0, the stream_context_set_default function
 *                       can be used to set the default context.
 *                       </p>
 *
 * @return resource A stream context resource.
 * @since 5.1.0
 */
function stream_context_get_default(array $options = null) { }

/**
 * Retrieve options for a stream/wrapper/context
 *
 * @link  http://php.net/manual/en/function.stream-context-get-options.php
 *
 * @param resource $stream_or_context <p>
 *                                    The stream or context to get options from
 *                                    </p>
 *
 * @return array an associative array with the options.
 * @since 4.3.0
 * @since 5.0
 */
function stream_context_get_options($stream_or_context) { }

/**
 * Retrieves parameters from a context
 *
 * @link  http://php.net/manual/en/function.stream-context-get-params.php
 *
 * @param resource $stream_or_context <p>
 *                                    A stream resource or a
 *                                    context resource
 *                                    </p>
 *
 * @return array an associate array containing all context options and parameters.
 * @since 5.3.0
 */
function stream_context_get_params($stream_or_context) { }

/**
 * Set the default streams context
 *
 * @link  http://php.net/manual/en/function.stream-context-set-default.php
 *
 * @param array $options <p>
 *                       The options to set for the default context.
 *                       </p>
 *                       <p>
 *                       options must be an associative
 *                       array of associative arrays in the format
 *                       $arr['wrapper']['option'] = $value.
 *                       </p>
 *
 * @return resource the default stream context.
 * @since 5.3.0
 */
function stream_context_set_default(array $options) { }

/**
 * Sets an option for a stream/wrapper/context
 *
 * @link  http://php.net/manual/en/function.stream-context-set-option.php
 *
 * @param resource $stream_or_context <p>
 *                                    The stream or context resource to apply the options too.
 *                                    </p>
 * @param string   $wrapper
 * @param string   $option
 * @param mixed    $value
 *
 * @return bool true on success or false on failure.
 * @since 4.3.0
 * @since 5.0
 */
function stream_context_set_option($stream_or_context, $wrapper, $option, $value) { }

/**
 * Sets an option for a stream/wrapper/context
 *
 * @link  http://php.net/manual/en/function.stream-context-set-option.php
 *
 * @param resource $stream_or_context The stream or context resource to apply the options too.
 * @param array    $options           The options to set for the default context.
 *
 * @return bool true on success or false on failure.
 * @since 4.3.0
 * @since 5.0
 */
function stream_context_set_option($stream_or_context, array $options) { }

/**
 * Set parameters for a stream/wrapper/context
 *
 * @link  http://php.net/manual/en/function.stream-context-set-params.php
 *
 * @param resource $stream_or_context <p>
 *                                    The stream or context to apply the parameters too.
 *                                    </p>
 * @param array    $params            <p>
 *                                    An array of parameters to set.
 *                                    </p>
 *                                    <p>
 *                                    params should be an associative array of the structure:
 *                                    $params['paramname'] = "paramvalue";.
 *                                    </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.3.0
 * @since 5.0
 */
function stream_context_set_params($stream_or_context, array $params) { }

/**
 * Copies data from one stream to another
 *
 * @link  http://php.net/manual/en/function.stream-copy-to-stream.php
 *
 * @param resource $source    <p>
 *                            The source stream
 *                            </p>
 * @param resource $dest      <p>
 *                            The destination stream
 *                            </p>
 * @param int      $maxlength [optional] <p>
 *                            Maximum bytes to copy
 *                            </p>
 * @param int      $offset    [optional] <p>
 *                            The offset where to start to copy data
 *                            </p>
 *
 * @return int the total count of bytes copied.
 * @since 5.0
 */
function stream_copy_to_stream($source, $dest, $maxlength = null, $offset = null) { }

/**
 * Set character set for stream encoding.
 *
 * @link  http://php.net/manual/en/function.stream-encoding.php
 *
 * @param resource $stream   The target stream.
 * @param string $encoding Encoding character set.
 *
 * @return bool
 */
function stream_encoding($stream, $encoding) { }

/**
 * Attach a filter to a stream
 *
 * @link  http://php.net/manual/en/function.stream-filter-append.php
 *
 * @param resource $stream     <p>
 *                             The target stream.
 *                             </p>
 * @param string   $filtername <p>
 *                             The filter name.
 *                             </p>
 * @param int      $read_write [optional] <p>
 *                             By default, stream_filter_append will
 *                             attach the filter to the read filter chain
 *                             if the file was opened for reading (i.e. File Mode:
 *                             r, and/or +). The filter
 *                             will also be attached to the write filter chain
 *                             if the file was opened for writing (i.e. File Mode:
 *                             w, a, and/or +).
 *                             STREAM_FILTER_READ,
 *                             STREAM_FILTER_WRITE, and/or
 *                             STREAM_FILTER_ALL can also be passed to the
 *                             read_write parameter to override this behavior.
 *                             </p>
 * @param mixed    $params     [optional] <p>
 *                             This filter will be added with the specified
 *                             params to the end of
 *                             the list and will therefore be called last during stream operations.
 *                             To add a filter to the beginning of the list, use
 *                             stream_filter_prepend.
 *                             </p>
 *
 * @return resource a resource which can be used to refer to this filter
 * instance during a call to stream_filter_remove.
 * @since 4.3.0
 * @since 5.0
 */
function stream_filter_append($stream, $filtername, $read_write = null, $params = null) { }

/**
 * Attach a filter to a stream
 *
 * @link  http://php.net/manual/en/function.stream-filter-prepend.php
 *
 * @param resource $stream     <p>
 *                             The target stream.
 *                             </p>
 * @param string   $filtername <p>
 *                             The filter name.
 *                             </p>
 * @param int      $read_write [optional] <p>
 *                             By default, stream_filter_prepend will
 *                             attach the filter to the read filter chain
 *                             if the file was opened for reading (i.e. File Mode:
 *                             r, and/or +). The filter
 *                             will also be attached to the write filter chain
 *                             if the file was opened for writing (i.e. File Mode:
 *                             w, a, and/or +).
 *                             STREAM_FILTER_READ,
 *                             STREAM_FILTER_WRITE, and/or
 *                             STREAM_FILTER_ALL can also be passed to the
 *                             read_write parameter to override this behavior.
 *                             See stream_filter_append for an example of
 *                             using this parameter.
 *                             </p>
 * @param mixed    $params     [optional] <p>
 *                             This filter will be added with the specified params
 *                             to the beginning of the list and will therefore be
 *                             called first during stream operations. To add a filter to the end of the
 *                             list, use stream_filter_append.
 *                             </p>
 *
 * @return resource a resource which can be used to refer to this filter
 * instance during a call to stream_filter_remove.
 * @since 4.3.0
 * @since 5.0
 */
function stream_filter_prepend($stream, $filtername, $read_write = null, $params = null) { }

/**
 * Register a user defined stream filter
 *
 * @link  http://php.net/manual/en/function.stream-filter-register.php
 *
 * @param string $filtername <p>
 *                           The filter name to be registered.
 *                           </p>
 * @param string $classname  <p>
 *                           To implement a filter, you need to define a class as an extension of
 *                           php_user_filter with a number of member functions
 *                           as defined below. When performing read/write operations on the stream
 *                           to which your filter is attached, PHP will pass the data through your
 *                           filter (and any other filters attached to that stream) so that the
 *                           data may be modified as desired. You must implement the methods
 *                           exactly as described below - doing otherwise will lead to undefined
 *                           behaviour.
 *                           </p>
 *                           intfilter
 *                           resourcein
 *                           resourceout
 *                           intconsumed
 *                           boolclosing
 *                           <p>
 *                           This method is called whenever data is read from or written to
 *                           the attached stream (such as with fread or fwrite).
 *                           in is a resource pointing to a bucket brigade
 *                           which contains one or more bucket objects containing data to be filtered.
 *                           out is a resource pointing to a second bucket brigade
 *                           into which your modified buckets should be placed.
 *                           consumed, which must always
 *                           be declared by reference, should be incremented by the length of the data
 *                           which your filter reads in and alters. In most cases this means you will
 *                           increment consumed by $bucket->datalen
 *                           for each $bucket. If the stream is in the process of closing
 *                           (and therefore this is the last pass through the filterchain),
 *                           the closing parameter will be set to true.
 *                           The filter method must return one of
 *                           three values upon completion.
 *                           <tr valign="top">
 *                           <td>Return Value</td>
 *                           <td>Meaning</td>
 *                           </tr>
 *                           <tr valign="top">
 *                           <td>PSFS_PASS_ON</td>
 *                           <td>
 *                           Filter processed successfully with data available in the
 *                           out bucket brigade.
 *                           </td>
 *                           </tr>
 *                           <tr valign="top">
 *                           <td>PSFS_FEED_ME</td>
 *                           <td>
 *                           Filter processed successfully, however no data was available to
 *                           return. More data is required from the stream or prior filter.
 *                           </td>
 *                           </tr>
 *                           <tr valign="top">
 *                           <td>PSFS_ERR_FATAL (default)</td>
 *                           <td>
 *                           The filter experienced an unrecoverable error and cannot continue.
 *                           </td>
 *                           </tr>
 *                           </p>
 *                           boolonCreate
 *                           This method is called during instantiation of the filter class
 *                           object. If your filter allocates or initializes any other resources
 *                           (such as a buffer), this is the place to do it. Your implementation of
 *                           this method should return false on failure, or true on success.
 *                           When your filter is first instantiated, and
 *                           yourfilter-&gt;onCreate() is called, a number of properties
 *                           will be available as shown in the table below.
 *                           <p>
 *                           <tr valign="top">
 *                           <td>Property</td>
 *                           <td>Contents</td>
 *                           </tr>
 *                           <tr valign="top">
 *                           <td>FilterClass-&gt;filtername</td>
 *                           <td>
 *                           A string containing the name the filter was instantiated with.
 *                           Filters may be registered under multiple names or under wildcards.
 *                           Use this property to determine which name was used.
 *                           </td>
 *                           </tr>
 *                           <tr valign="top">
 *                           <td>FilterClass-&gt;params</td>
 *                           <td>
 *                           The contents of the params parameter passed
 *                           to stream_filter_append
 *                           or stream_filter_prepend.
 *                           </td>
 *                           </tr>
 *                           <tr valign="top">
 *                           <td>FilterClass-&gt;stream</td>
 *                           <td>
 *                           The stream resource being filtered. Maybe available only during
 *                           filter calls when the
 *                           closing parameter is set to false.
 *                           </td>
 *                           </tr>
 *                           </p>
 *                           voidonClose
 *                           <p>
 *                           This method is called upon filter shutdown (typically, this is also
 *                           during stream shutdown), and is executed after
 *                           the flush method is called. If any resources
 *                           were allocated or initialzed during onCreate()
 *                           this would be the time to destroy or dispose of them.
 *                           </p>
 *
 * @return bool true on success or false on failure.
 * </p>
 * <p>
 * stream_filter_register will return false if the
 * filtername is already defined.
 * @since 5.0
 */
function stream_filter_register($filtername, $classname) { }

/**
 * Remove a filter from a stream
 *
 * @link  http://php.net/manual/en/function.stream-filter-remove.php
 *
 * @param resource $stream_filter <p>
 *                                The stream filter to be removed.
 *                                </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.1.0
 */
function stream_filter_remove($stream_filter) { }

/**
 * Reads remainder of a stream into a string
 *
 * @link  http://php.net/manual/en/function.stream-get-contents.php
 *
 * @param resource $handle    <p>
 *                            A stream resource (e.g. returned from fopen)
 *                            </p>
 * @param int      $maxlength [optional] <p>
 *                            The maximum bytes to read. Defaults to -1 (read all the remaining
 *                            buffer).
 *                            </p>
 * @param int      $offset    [optional] <p>
 *                            Seek to the specified offset before reading.
 *                            </p>
 *
 * @return string|false a string or false on failure.
 * @since 5.0
 */
function stream_get_contents($handle, $maxlength = null, $offset = null) { }

/**
 * Retrieve list of registered filters
 *
 * @link  http://php.net/manual/en/function.stream-get-filters.php
 * @return array an indexed array containing the name of all stream filters
 * available.
 * @since 5.0
 */
function stream_get_filters() { }

/**
 * Gets line from stream resource up to a given delimiter
 *
 * @link  http://php.net/manual/en/function.stream-get-line.php
 *
 * @param resource $handle <p>
 *                         A valid file handle.
 *                         </p>
 * @param int      $length <p>
 *                         The number of bytes to read from the handle.
 *                         </p>
 * @param string   $ending [optional] <p>
 *                         An optional string delimiter.
 *                         </p>
 *
 * @return string a string of up to length bytes read from the file
 * pointed to by handle.
 * </p>
 * <p>
 * If an error occurs, returns false.
 * @since 5.0
 */
function stream_get_line($handle, $length, $ending = null) { }

/**
 * Retrieves header/meta data from streams/file pointers
 *
 * @link  http://php.net/manual/en/function.stream-get-meta-data.php
 *
 * @param resource $stream <p>
 *                         The stream can be any stream created by fopen,
 *                         fsockopen and pfsockopen.
 *                         </p>
 *
 * @return array The result array contains the following items:
 * </p>
 * <p>
 * timed_out (bool) - true if the stream
 * timed out while waiting for data on the last call to
 * fread or fgets.
 * </p>
 * <p>
 * blocked (bool) - true if the stream is
 * in blocking IO mode. See stream_set_blocking.
 * </p>
 * <p>
 * eof (bool) - true if the stream has reached
 * end-of-file. Note that for socket streams this member can be true
 * even when unread_bytes is non-zero. To
 * determine if there is more data to be read, use
 * feof instead of reading this item.
 * </p>
 * <p>
 * unread_bytes (int) - the number of bytes
 * currently contained in the PHP's own internal buffer.
 * </p>
 * You shouldn't use this value in a script.
 * <p>
 * stream_type (string) - a label describing
 * the underlying implementation of the stream.
 * </p>
 * <p>
 * wrapper_type (string) - a label describing
 * the protocol wrapper implementation layered over the stream.
 * See for more information about wrappers.
 * </p>
 * <p>
 * wrapper_data (mixed) - wrapper specific
 * data attached to this stream. See for
 * more information about wrappers and their wrapper data.
 * </p>
 * <p>
 * filters (array) - and array containing
 * the names of any filters that have been stacked onto this stream.
 * Documentation on filters can be found in the
 * Filters appendix.
 * </p>
 * <p>
 * mode (string) - the type of access required for
 * this stream (see Table 1 of the fopen() reference)
 * </p>
 * <p>
 * seekable (bool) - whether the current stream can
 * be seeked.
 * </p>
 * <p>
 * uri (string) - the URI/filename associated with this
 * stream.
 * @since 4.3.0
 * @since 5.0
 */
function stream_get_meta_data($stream) { }

/**
 * Retrieve list of registered socket transports
 *
 * @link  http://php.net/manual/en/function.stream-get-transports.php
 * @return array an indexed array of socket transports names.
 * @since 5.0
 */
function stream_get_transports() { }

/**
 * Retrieve list of registered streams
 *
 * @link  http://php.net/manual/en/function.stream-get-wrappers.php
 * @return array an indexed array containing the name of all stream wrappers
 * available on the running system.
 * @since 5.0
 */
function stream_get_wrappers() { }

/**
 * Checks if a stream is a local stream
 *
 * @link  http://php.net/manual/en/function.stream-is-local.php
 *
 * @param mixed $stream_or_url <p>
 *                             The stream resource or URL to check.
 *                             </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.2.4
 */
function stream_is_local($stream_or_url) { }

/**
 * &Alias; <function>stream_wrapper_register</function>
 * <p>Register a URL wrapper implemented as a PHP class
 *
 * @link  http://php.net/manual/en/function.stream-register-wrapper.php
 *
 * @param string $protocol  <p>
 *                          The wrapper name to be registered.
 *                          </p>
 * @param string $classname <p>
 *                          The classname which implements the protocol.
 *                          </p>
 * @param int    $flags     [optional] <p>
 *                          Should be set to STREAM_IS_URL if
 *                          protocol is a URL protocol. Default is 0, local
 *                          stream.
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * </p>
 * <p>
 * stream_wrapper_register will return false if the
 * protocol already has a handler.
 * @since 4.3.0
 * @since 5.0
 */
function stream_register_wrapper($protocol, $classname, $flags) { }

/**
 * Resolve filename against the include path according to the same rules as fopen()/include().
 *
 * @link  http://php.net/manual/en/function.stream-resolve-include-path.php
 *
 * @param string $filename The filename to resolve.
 *
 * @return string|false containing the resolved absolute filename, or FALSE on failure.
 * @since 5.3.2
 */
function stream_resolve_include_path($filename) { }

/**
 * Runs the equivalent of the select() system call on the given
 * arrays of streams with a timeout specified by tv_sec and tv_usec
 *
 * @link  http://php.net/manual/en/function.stream-select.php
 *
 * @param array $read    <p>
 *                       The streams listed in the read array will be watched to
 *                       see if characters become available for reading (more precisely, to see if
 *                       a read will not block - in particular, a stream resource is also ready on
 *                       end-of-file, in which case an fread will return
 *                       a zero length string).
 *                       </p>
 * @param array $write   <p>
 *                       The streams listed in the write array will be
 *                       watched to see if a write will not block.
 *                       </p>
 * @param array $except  <p>
 *                       The streams listed in the except array will be
 *                       watched for high priority exceptional ("out-of-band") data arriving.
 *                       </p>
 *                       <p>
 *                       When stream_select returns, the arrays
 *                       read, write and
 *                       except are modified to indicate which stream
 *                       resource(s) actually changed status.
 *                       </p>
 *                       You do not need to pass every array to
 *                       stream_select. You can leave it out and use an
 *                       empty array or &null; instead. Also do not forget that those arrays are
 *                       passed by reference and will be modified after
 *                       stream_select returns.
 * @param int   $tv_sec  <p>
 *                       The tv_sec and tv_usec
 *                       together form the timeout parameter,
 *                       tv_sec specifies the number of seconds while
 *                       tv_usec the number of microseconds.
 *                       The timeout is an upper bound on the amount of time
 *                       that stream_select will wait before it returns.
 *                       If tv_sec and tv_usec are
 *                       both set to 0, stream_select will
 *                       not wait for data - instead it will return immediately, indicating the
 *                       current status of the streams.
 *                       </p>
 *                       <p>
 *                       If tv_sec is &null; stream_select
 *                       can block indefinitely, returning only when an event on one of the
 *                       watched streams occurs (or if a signal interrupts the system call).
 *                       </p>
 *                       <p>
 *                       Using a timeout value of 0 allows you to
 *                       instantaneously poll the status of the streams, however, it is NOT a
 *                       good idea to use a 0 timeout value in a loop as it
 *                       will cause your script to consume too much CPU time.
 *                       </p>
 *                       <p>
 *                       It is much better to specify a timeout value of a few seconds, although
 *                       if you need to be checking and running other code concurrently, using a
 *                       timeout value of at least 200000 microseconds will
 *                       help reduce the CPU usage of your script.
 *                       </p>
 *                       <p>
 *                       Remember that the timeout value is the maximum time that will elapse;
 *                       stream_select will return as soon as the
 *                       requested streams are ready for use.
 *                       </p>
 * @param int   $tv_usec [optional] <p>
 *                       See tv_sec description.
 *                       </p>
 *
 * @return int On success stream_select returns the number of
 * stream resources contained in the modified arrays, which may be zero if
 * the timeout expires before anything interesting happens. On error false
 * is returned and a warning raised (this can happen if the system call is
 * interrupted by an incoming signal).
 * @since 4.3.0
 * @since 5.0
 */
function stream_select(array &$read, array &$write, array &$except, $tv_sec, $tv_usec = null) { }

/**
 * Set blocking/non-blocking mode on a stream
 *
 * @link  http://php.net/manual/en/function.stream-set-blocking.php
 *
 * @param resource $stream <p>
 *                         The stream.
 *                         </p>
 * @param int      $mode   <p>
 *                         If mode is 0, the given stream
 *                         will be switched to non-blocking mode, and if 1, it
 *                         will be switched to blocking mode. This affects calls like
 *                         fgets and fread
 *                         that read from the stream. In non-blocking mode an
 *                         fgets call will always return right away
 *                         while in blocking mode it will wait for data to become available
 *                         on the stream.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.3.0
 * @since 5.0
 */
function stream_set_blocking($stream, $mode) { }

/**
 * PHP > 5.4.0<br/>
 * Set the stream chunk size.
 *
 * @link http://www.php.net/manual/en/function.stream-set-chunk-size.php
 *
 * @param resource $fp         The target stream.
 * @param int      $chunk_size The desired new chunk size.
 *
 * @return int Returns the previous chunk size on success.<br>
 * Will return <b>FALSE</b> if chunk_size is less than 1 or greater than <b>PHP_INT_MAX</b>.
 */
function stream_set_chunk_size($fp, $chunk_size) { }

/**
 * Sets file buffering on the given stream
 *
 * @link  http://php.net/manual/en/function.stream-set-read-buffer.php
 *
 * @param resource $stream <p>
 *                         The file pointer.
 *                         </p>
 * @param int      $buffer <p>
 *                         The number of bytes to buffer. If buffer
 *                         is 0 then write operations are unbuffered. This ensures that all writes
 *                         with fwrite are completed before other processes are
 *                         allowed to write to that output stream.
 *                         </p>
 *
 * @return int 0 on success, or EOF if the request cannot be honored.
 * @see   stream_set_write_buffer()
 * @since 4.3.0
 * @since 5.0
 */
function stream_set_read_buffer($stream, $buffer) { }

/**
 * Set timeout period on a stream
 *
 * @link  http://php.net/manual/en/function.stream-set-timeout.php
 *
 * @param resource $stream       <p>
 *                               The target stream.
 *                               </p>
 * @param int      $seconds      <p>
 *                               The seconds part of the timeout to be set.
 *                               </p>
 * @param int      $microseconds [optional] <p>
 *                               The microseconds part of the timeout to be set.
 *                               </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.3.0
 * @since 5.0
 */
function stream_set_timeout($stream, $seconds, $microseconds = null) { }

/**
 * Sets file buffering on the given stream
 *
 * @link  http://php.net/manual/en/function.stream-set-write-buffer.php
 *
 * @param resource $stream <p>
 *                         The file pointer.
 *                         </p>
 * @param int      $buffer <p>
 *                         The number of bytes to buffer. If buffer
 *                         is 0 then write operations are unbuffered. This ensures that all writes
 *                         with fwrite are completed before other processes are
 *                         allowed to write to that output stream.
 *                         </p>
 *
 * @return int 0 on success, or EOF if the request cannot be honored.
 * @see   stream_set_read_buffer()
 * @since 4.3.0
 * @since 5.0
 */
function stream_set_write_buffer($stream, $buffer) { }

/**
 * Accept a connection on a socket created by <function>stream_socket_server</function>
 *
 * @link  http://php.net/manual/en/function.stream-socket-accept.php
 *
 * @param resource $server_socket
 * @param float    $timeout  [optional] <p>
 *                           Override the default socket accept timeout. Time should be given in
 *                           seconds.
 *                           </p>
 * @param string   $peername [optional] <p>
 *                           Will be set to the name (address) of the client which connected, if
 *                           included and available from the selected transport.
 *                           </p>
 *                           <p>
 *                           Can also be determined later using
 *                           stream_socket_get_name.
 *                           </p>
 *
 * @return resource|bool Returns a stream to the accepted socket connection or FALSE on failure.
 * @since 5.0
 */
function stream_socket_accept($server_socket, $timeout = null, &$peername = null) { }

/**
 * Open Internet or Unix domain socket connection
 *
 * @link  http://php.net/manual/en/function.stream-socket-client.php
 *
 * @param string   $remote_socket <p>
 *                                Address to the socket to connect to.
 *                                </p>
 * @param int      $errno         [optional] <p>
 *                                Will be set to the system level error number if connection fails.
 *                                </p>
 * @param string   $errstr        [optional] <p>
 *                                Will be set to the system level error message if the connection fails.
 *                                </p>
 * @param float    $timeout       [optional] <p>
 *                                Number of seconds until the connect() system call
 *                                should timeout.
 *                                This parameter only applies when not making asynchronous
 *                                connection attempts.
 *                                <p>
 *                                To set a timeout for reading/writing data over the socket, use the
 *                                stream_set_timeout, as the
 *                                timeout only applies while making connecting
 *                                the socket.
 *                                </p>
 *                                </p>
 * @param int      $flags         [optional] <p>
 *                                Bitmask field which may be set to any combination of connection flags.
 *                                Currently the select of connection flags is limited to
 *                                STREAM_CLIENT_CONNECT (default),
 *                                STREAM_CLIENT_ASYNC_CONNECT and
 *                                STREAM_CLIENT_PERSISTENT.
 *                                </p>
 * @param resource $context       [optional] <p>
 *                                A valid context resource created with stream_context_create.
 *                                </p>
 *
 * @return resource|false On success a stream resource is returned which may be used together with the other file
 *                        functions (such as fgets, fgetss, fwrite, fclose, and feof), false on failure.
 * @since 5.0
 */
function stream_socket_client(
    $remote_socket,
    &$errno = null,
    &$errstr = null,
    $timeout = null,
    $flags = null,
    $context = null
)
{
}

/**
 * Turns encryption on/off on an already connected socket
 *
 * @link  http://php.net/manual/en/function.stream-socket-enable-crypto.php
 *
 * @param resource $stream         <p>
 *                                 The stream resource.
 *                                 </p>
 * @param bool     $enable         <p>
 *                                 Enable/disable cryptography on the stream.
 *                                 </p>
 * @param int      $crypto_type    [optional] <p>
 *                                 Setup encryption on the stream.
 *                                 Valid methods are
 *                                 STREAM_CRYPTO_METHOD_SSLv2_CLIENT
 * @param resource $session_stream [optional] <p>
 *                                 Seed the stream with settings from session_stream.
 *                                 </p>
 *
 * @return mixed true on success, false if negotiation has failed or
 * 0 if there isn't enough data and you should try again
 * (only for non-blocking sockets).
 * @since 5.1.0
 */
function stream_socket_enable_crypto($stream, $enable, $crypto_type = null, $session_stream = null) { }

/**
 * Retrieve the name of the local or remote sockets
 *
 * @link  http://php.net/manual/en/function.stream-socket-get-name.php
 *
 * @param resource $handle    <p>
 *                            The socket to get the name of.
 *                            </p>
 * @param bool     $want_peer <p>
 *                            If set to true the remote socket name will be returned, if set
 *                            to false the local socket name will be returned.
 *                            </p>
 *
 * @return string The name of the socket.
 * @since 5.0
 */
function stream_socket_get_name($handle, $want_peer) { }

/**
 * Creates a pair of connected, indistinguishable socket streams
 *
 * @link  http://php.net/manual/en/function.stream-socket-pair.php
 *
 * @param int $domain   <p>
 *                      The protocol family to be used: STREAM_PF_INET,
 *                      STREAM_PF_INET6 or
 *                      STREAM_PF_UNIX
 *                      </p>
 * @param int $type     <p>
 *                      The type of communication to be used:
 *                      STREAM_SOCK_DGRAM,
 *                      STREAM_SOCK_RAW,
 *                      STREAM_SOCK_RDM,
 *                      STREAM_SOCK_SEQPACKET or
 *                      STREAM_SOCK_STREAM
 *                      </p>
 * @param int $protocol <p>
 *                      The protocol to be used: STREAM_IPPROTO_ICMP,
 *                      STREAM_IPPROTO_IP,
 *                      STREAM_IPPROTO_RAW,
 *                      STREAM_IPPROTO_TCP or
 *                      STREAM_IPPROTO_UDP
 *                      </p>
 *
 * @return array|false an array with the two socket resources on success, or false on failure.
 * @since 5.1.0
 */
function stream_socket_pair($domain, $type, $protocol) { }

/**
 * Receives data from a socket, connected or not
 *
 * @link  http://php.net/manual/en/function.stream-socket-recvfrom.php
 *
 * @param resource $socket  <p>
 *                          The remote socket.
 *                          </p>
 * @param int      $length  <p>
 *                          The number of bytes to receive from the socket.
 *                          </p>
 * @param int      $flags   [optional] <p>
 *                          The value of flags can be any combination
 *                          of the following:
 *                          <table>
 *                          Possible values for flags
 *                          <tr valign="top">
 *                          <td>STREAM_OOB</td>
 *                          <td>
 *                          Process OOB (out-of-band) data.
 *                          </td>
 *                          </tr>
 *                          <tr valign="top">
 *                          <td>STREAM_PEEK</td>
 *                          <td>
 *                          Retrieve data from the socket, but do not consume the buffer.
 *                          Subsequent calls to fread or
 *                          stream_socket_recvfrom will see
 *                          the same data.
 *                          </td>
 *                          </tr>
 *                          </table>
 *                          </p>
 * @param string   $address [optional] <p>
 *                          If address is provided it will be populated with
 *                          the address of the remote socket.
 *                          </p>
 *
 * @return string the read data, as a string
 * @since 5.0
 */
function stream_socket_recvfrom($socket, $length, $flags = null, &$address = null) { }

/**
 * Sends a message to a socket, whether it is connected or not
 *
 * @link  http://php.net/manual/en/function.stream-socket-sendto.php
 *
 * @param resource $socket  <p>
 *                          The socket to send data to.
 *                          </p>
 * @param string   $data    <p>
 *                          The data to be sent.
 *                          </p>
 * @param int      $flags   [optional] <p>
 *                          The value of flags can be any combination
 *                          of the following:
 *                          <table>
 *                          possible values for flags
 *                          <tr valign="top">
 *                          <td>STREAM_OOB</td>
 *                          <td>
 *                          Process OOB (out-of-band) data.
 *                          </td>
 *                          </tr>
 *                          </table>
 *                          </p>
 * @param string   $address [optional] <p>
 *                          The address specified when the socket stream was created will be used
 *                          unless an alternate address is specified in address.
 *                          </p>
 *                          <p>
 *                          If specified, it must be in dotted quad (or [ipv6]) format.
 *                          </p>
 *
 * @return int a result code, as an integer.
 * @since 5.0
 */
function stream_socket_sendto($socket, $data, $flags = null, $address = null) { }

/**
 * Create an Internet or Unix domain server socket
 *
 * @link  http://php.net/manual/en/function.stream-socket-server.php
 *
 * @param string   $local_socket <p>
 *                               The type of socket created is determined by the transport specified
 *                               using standard URL formatting: transport://target.
 *                               </p>
 *                               <p>
 *                               For Internet Domain sockets (AF_INET) such as TCP and UDP, the
 *                               target portion of the
 *                               remote_socket parameter should consist of a
 *                               hostname or IP address followed by a colon and a port number. For
 *                               Unix domain sockets, the target portion should
 *                               point to the socket file on the filesystem.
 *                               </p>
 *                               <p>
 *                               Depending on the environment, Unix domain sockets may not be available.
 *                               A list of available transports can be retrieved using
 *                               stream_get_transports. See
 *                               for a list of bulitin transports.
 *                               </p>
 * @param int      $errno        [optional] <p>
 *                               If the optional errno and errstr
 *                               arguments are present they will be set to indicate the actual system
 *                               level error that occurred in the system-level socket(),
 *                               bind(), and listen() calls. If
 *                               the value returned in errno is
 *                               0 and the function returned false, it is an
 *                               indication that the error occurred before the bind()
 *                               call. This is most likely due to a problem initializing the socket.
 *                               Note that the errno and
 *                               errstr arguments will always be passed by reference.
 *                               </p>
 * @param string   $errstr       [optional] <p>
 *                               See errno description.
 *                               </p>
 * @param int      $flags        [optional] <p>
 *                               A bitmask field which may be set to any combination of socket creation
 *                               flags.
 *                               </p>
 *                               <p>
 *                               For UDP sockets, you must use STREAM_SERVER_BIND as
 *                               the flags parameter.
 *                               </p>
 * @param resource $context      [optional] <p>
 *                               </p>
 *
 * @return resource the created stream, or false on error.
 * @since 5.0
 */
function stream_socket_server($local_socket, &$errno = null, &$errstr = null, $flags = null, $context = null) { }

/**
 * Shutdown a full-duplex connection
 *
 * @link  http://php.net/manual/en/function.stream-socket-shutdown.php
 *
 * @param resource $stream <p>
 *                         An open stream (opened with stream_socket_client,
 *                         for example)
 *                         </p>
 * @param int      $how    <p>
 *                         One of the following constants: STREAM_SHUT_RD
 *                         (disable further receptions), STREAM_SHUT_WR
 *                         (disable further transmissions) or
 *                         STREAM_SHUT_RDWR (disable further receptions and
 *                         transmissions).
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.2.1
 */
function stream_socket_shutdown($stream, $how) { }

/**
 * Tells whether the stream supports locking.
 *
 * @link  http://php.net/manual/en/function.stream-supports-lock.php
 *
 * @param resource $stream <p>
 *                         The stream to check.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.3.0
 */
function stream_supports_lock($stream) { }

/**
 * Register a URL wrapper implemented as a PHP class
 *
 * @link  http://php.net/manual/en/function.stream-wrapper-register.php
 *
 * @param string $protocol  <p>
 *                          The wrapper name to be registered.
 *                          </p>
 * @param string $classname <p>
 *                          The classname which implements the protocol.
 *                          </p>
 * @param int    $flags     [optional] <p>
 *                          Should be set to STREAM_IS_URL if
 *                          protocol is a URL protocol. Default is 0, local
 *                          stream.
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * </p>
 * <p>
 * stream_wrapper_register will return false if the
 * protocol already has a handler.
 * @since 4.3.2
 * @since 5.0
 */
function stream_wrapper_register($protocol, $classname, $flags = null) { }

/**
 * Restores a previously unregistered built-in wrapper
 *
 * @link  http://php.net/manual/en/function.stream-wrapper-restore.php
 *
 * @param string $protocol <p>
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.1.0
 */
function stream_wrapper_restore($protocol) { }

/**
 * Unregister a URL wrapper
 *
 * @link  http://php.net/manual/en/function.stream-wrapper-unregister.php
 *
 * @param string $protocol <p>
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.1.0
 */
function stream_wrapper_unregister($protocol) { }

