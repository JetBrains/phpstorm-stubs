<?php

/**
 * Sets the name of the application
 *
 * The string $name uses the same format as newrelic.appname
 * and can set multiple application names by separating each with a semi-colon.
 * However please be aware of the restriction on the application name ordering as described for that setting.
 * The first application name is the primary name, and up to two extra application names can be specified
 * (however the same application name can only ever be used once as a primary name).
 * This function should be called as early as possible, and will have no effect if called after the RUM footer has been sent.
 * You may want to consider setting the application name in a file loaded by PHP's auto_prepend_file INI setting.
 *
 * If you use multiple licenses you can also specify a license key along with the application name.
 * An application can appear in more than one account and the license key controls which account you are changing the name in.
 * If you do not wish to change the license and wish to use the third variant, simply set the license key to the empty string ("").
 *
 * The xmit flag is new in version 3.1 of the agent.
 * Usually, when you change an application name, the agent simply discards the current transaction and does not send
 * any of the accumulated metrics to the daemon.
 * However, if you want to record the metric and transaction data up to the point at which you called this function,
 * you can specify a value of true for this argument to make the agent send the transaction to the daemon.
 * This has a very slight performance impact as it takes a few milliseconds for the agent to dump its data.
 * By default this parameter is false.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param string    $name
 * @param null      $license    if empty than used global license key from newrelic.ini or php.ini
 * @param bool      $xmit
 *
 * @return bool     returns true if it succeeded or false otherwise.
 */
function newrelic_set_appname($name, $license = null, $xmit = false) {}

/**
 * Report an error at this line of code, with a complete stack trace.
 *
 * The form of the call: newrelic_notice_error ($message, $ex) was added in agent version 2.6
 * and should be used for reporting exceptions. Only the exception for the last call is retained during the course of a transaction.
 * The exception parameter must be a valid PHP Exception class, and the stack frame recorded in that class will be the one reported,
 * rather than the stack at the time this function was called.
 * When using this form, if the error message is empty, a standard message in the same format as created by Exception::__toString()
 * will be automatically generated.
 *
 * Note: With the: newrelic_notice_error($message, Exception $ex = null, $unused_1 = null, $unused_2 = null, $unused_3 = null)
 * form of the call, only the $ex is used. This form of the call was designed
 * to be a valid function passed to the PHP internal function set_error_handler().
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param string|null       $message
 * @param Exception|null    $ex
 * @param null              $unused_1
 * @param null              $unused_2
 * @param null              $unused_3
 *
 */
function newrelic_notice_error($message = null, Exception $ex = null, $unused_1 = null, $unused_2 = null, $unused_3 = null) {}

/**
 * Sets the name of the transaction to the specified string.
 *
 * This can be useful if you have implemented your own dispatching scheme and wish to name transactions according to their purpose
 * rather than their URL.
 *
 * Avoid creating too many unique transaction names.
 * For example, if you have /product/123 and /product/234, if you generate a separate transaction name for each,
 * then New Relic will store separate information for these two transaction names.
 * This will make your graphs less useful, and may run into limits we set on the number of unique transaction names per account.
 * It also can slow down the performance of your application. Instead, store the transaction as /product/*,
 * or use something significant about the code itself to name the transaction, such as /Product/view.
 * The limit for the total number of transactions should be less than 1000 unique transaction names -- exceeding that is not recommended.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param string    $name
 */
function newrelic_name_transaction($name) {}

/**
 * Stop recording the web transaction immediately.
 *
 * Usually used when a page is done with all computation and is about to stream data
 * (file download, audio or video streaming etc) and you don't want the time taken to stream to be counted as part of the transaction.
 * This is especially relevant when the time taken to complete the operation is completely outside the bounds of your application.
 * For example, a user on a very slow connection may take a very long time to download even small files,
 * and you wouldn't want that download time to skew the real transaction time.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 */
function newrelic_end_of_transaction() {}

/**
 * End transaction and send all metrics to the daemon immediately
 *
 * Note: This API call was introduced in version 3.0 of the agent.
 *
 * Despite being similar in name to newrelic_end_of_transaction
 * this function call serves a very different purpose.
 * newrelic_end_of_transaction simply marks the end time of the transaction but takes no other action.
 * This function on the other hand, causes the current transaction to end immediately,
 * and will ship all of the metrics gathered thus far to the daemon unless the ignore parameter is set to true.
 *
 * The transaction is still only sent to the daemon when the PHP engine determines that the script is done executing
 * and is shutting down.
 * In effect this call simulates what would happen when PHP terminates the current transaction.
 * This is most commonly used in command line scripts that do some form of job queue processing.
 * You would use this call at the end of processing a single job task, and begin a new transaction when a new task is pulled off the queue.
 *
 * Normally, when you end a transaction you want the metrics that have been gathered thus far to be recorded.
 * However, there are times when you may want to end a transaction without doing so.
 * In this case use the second form of the function and set $ignoreSendingMetrics to true.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param bool $ignoreSendingMetrics
 *
 */
function newrelic_end_transaction($ignoreSendingMetrics = false) {}

/**
 * Start a new transaction
 *
 * Note: This API call was introduced in version 3.0 of the agent.
 *
 * If you have ended a transaction before your script terminates (perhaps due to it just having finished a task in a job queue manager)
 * and you want to start a new transaction, use this call.
 * This will perform the same operations that occur when the script was first started.
 *
 * However, if you are processing tasks for multiple accounts, you may also provide a license for the associated account.
 * The license set for this API call will supersede all per-directory and global default licenses configured in INI files.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param string        $appName
 * @param string|null   $license
 */
function newrelic_start_transaction($appName, $license = null) {}

/**
 * Do not generate metrics for this transaction.
 *
 * This is useful when you have transactions that are particularly slow for known reasons
 * and you do not want them always being reported as the transaction trace or skewing your site averages.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 */
function newrelic_ignore_transaction() {}

/**
 * Do not generate Apdex metrics for this transaction.
 *
 * This is useful when you have either very short or very long transactions
 * (such as file downloads) that can skew your apdex score.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 */
function newrelic_ignore_apdex() {}

/**
 * Mark the current transaction as a background job.
 *
 * If false is passed as an argument, mark the transaction as a web transaction.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param bool $flag
 */
function newrelic_background_job($flag = true) {}

/**
 * Enables the capturing of URL parameters for displaying in transaction traces.
 *
 * If enable is omitted or set to on,
 * In essence this overrides the newrelic.capture_params setting.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param string $enable
 */
function newrelic_capture_params($enable = 'on') {}

/**
 * Enables the capturing of URL parameters
 * In agents prior to 2.1.3
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @deprecated use newrelic_capture_params() instead
 */
function newrelic_enable_params() {}

/**
 * Adds a custom metric with the specified name and value.
 *
 * Note: Avoid creating too many unique custom metric names.
 *  New Relic limits the total number of custom metrics you can use (not the total you can report for each of these custom metrics).
 *  Exceeding more than 2000 unique custom metric names can cause automatic clamps that will affect other data.
 *
 * Your custom metrics can then be used in custom dashboards and custom views in the New Relic user interface.
 * It's a best practice to name your custom metrics with a Custom/ prefix. This will make them easily usable in custom dashboards.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param string    $metricName
 * @param float     $value
 */
function newrelic_custom_metric($metricName, $value) {}

/**
 * Add a custom parameter to the current web transaction with the specified value.
 *
 * For example, you can add a customer's full name from your customer database.
 * This parameter is shown in any transaction trace that results from this transaction.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param $key
 * @param $value
 */
function newrelic_add_custom_parameter($key, $value) {}

/**
 * API equivalent of the newrelic.transaction_tracer.customi setting.
 *
 * It allows you to add user defined functions or methods to the list to be instrumented.
 * Internal PHP functions cannot have custom tracing.
 *
 * $callable could be classname::function_name or function_name
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param string    $callable
 */
function newrelic_add_custom_tracer($callable) {}

/**
 * Returns the JavaScript string to inject as part of the header for browser timing (real user monitoring).
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param bool  $flag This indicates whether or not surrounding script tags should be returned as part of the string.
 */
function newrelic_get_browser_timing_header($flag = true) {}

/**
 * Returns the JavaScript string to inject at the very end of the HTML output for browser timing (real user monitoring).
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 * @param bool $flag This indicates whether or not surrounding script tags should be returned as part of the string.
 */
function newrelic_get_browser_timing_footer ($flag = true) {}

/**
 * Prevents the output filter from attempting to insert RUM JavaScript for this current transaction.
 *
 * Useful for AJAX calls, for example.
 *
 * @link https://newrelic.com/docs/php/the-php-api
 *
 */
function newrelic_disable_autorum() {}

/**
 * Adds the three parameter strings to collected browser traces.
 *
 * All three parameters are required, but may be empty strings.
 * For more information please see the section on browser traces.
 *
 * @link https://newrelic.com/docs/features/browser-traces
 *
 * @param string    $user
 * @param string    $account
 * @param string    $product
 */
function newrelic_set_user_attributes ($user, $account, $product) {}
