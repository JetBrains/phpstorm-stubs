<?php
/**
 * PHPStorm stub file for Gearman functions.
 *
 * @link http://php.net/manual/en/book.gearman.php
 */

/**
 */
function gearman_bugreport() { }

/**
 * @param $client_object
 * @param $option
 */
function gearman_client_add_options($client_object, $option) { }

/**
 * @param $client_object
 * @param $host
 * @param $port
 */
function gearman_client_add_server($client_object, $host, $port) { }

/**
 * @param $client_object
 * @param $servers
 */
function gearman_client_add_servers($client_object, $servers) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $context
 * @param $unique
 */
function gearman_client_add_task($client_object, $function_name, $workload, $context, $unique) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $context
 * @param $unique
 */
function gearman_client_add_task_background($client_object, $function_name, $workload, $context, $unique) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $context
 * @param $unique
 */
function gearman_client_add_task_high($client_object, $function_name, $workload, $context, $unique) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $context
 * @param $unique
 */
function gearman_client_add_task_high_background($client_object, $function_name, $workload, $context, $unique) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $context
 * @param $unique
 */
function gearman_client_add_task_low($client_object, $function_name, $workload, $context, $unique) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $context
 * @param $unique
 */
function gearman_client_add_task_low_background($client_object, $function_name, $workload, $context, $unique) { }

/**
 * @param $client_object
 * @param $job_handle
 * @param $context
 */
function gearman_client_add_task_status($client_object, $job_handle, $context) { }

/**
 * @param $client_object
 */
function gearman_client_clear_fn($client_object) { }

/**
 * @param $client_object
 */
function gearman_client_clone($client_object) { }

/**
 * @param $client_object
 */
function gearman_client_context($client_object) { }

/**
 * @param $client_object
 */
function gearman_client_create($client_object) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $unique
 */
function gearman_client_do($client_object, $function_name, $workload, $unique) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $unique
 */
function gearman_client_do_background($client_object, $function_name, $workload, $unique) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $unique
 */
function gearman_client_do_high($client_object, $function_name, $workload, $unique) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $unique
 */
function gearman_client_do_high_background($client_object, $function_name, $workload, $unique) { }

/**
 * @param $client_object
 */
function gearman_client_do_job_handle($client_object) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $unique
 */
function gearman_client_do_low($client_object, $function_name, $workload, $unique) { }

/**
 * @param $client_object
 * @param $function_name
 * @param $workload
 * @param $unique
 */
function gearman_client_do_low_background($client_object, $function_name, $workload, $unique) { }

/**
 * @param        $client_object
 * @param string $function_name
 * @param string $workload
 * @param string $unique
 */
function gearman_client_do_normal($client_object, $function_name, $workload, $unique) { }

/**
 * @param $client_object
 */
function gearman_client_do_status($client_object) { }

/**
 * @param $client_object
 * @param $workload
 */
function gearman_client_echo($client_object, $workload) { }

/**
 * @param $client_object
 */
function gearman_client_errno($client_object) { }

/**
 * @param $client_object
 */
function gearman_client_error($client_object) { }

/**
 * @param $client_object
 * @param $job_handle
 */
function gearman_client_job_status($client_object, $job_handle) { }

/**
 * @param $client_object
 */
function gearman_client_options($client_object) { }

/**
 * @param $client_object
 * @param $option
 */
function gearman_client_remove_options($client_object, $option) { }

/**
 * @param $client_object
 */
function gearman_client_return_code($client_object) { }

/**
 * @param $data
 */
function gearman_client_run_tasks($data) { }

/**
 * @param $client_object
 * @param $callback
 */
function gearman_client_set_complete_fn($client_object, $callback) { }

/**
 * @param $client_object
 * @param $context
 */
function gearman_client_set_context($client_object, $context) { }

/**
 * @param $client_object
 * @param $callback
 */
function gearman_client_set_created_fn($client_object, $callback) { }

/**
 * @param $client_object
 * @param $callback
 */
function gearman_client_set_data_fn($client_object, $callback) { }

/**
 * @param $client_object
 * @param $callback
 */
function gearman_client_set_exception_fn($client_object, $callback) { }

/**
 * @param $client_object
 * @param $callback
 */
function gearman_client_set_fail_fn($client_object, $callback) { }

/**
 * @param $client_object
 * @param $option
 */
function gearman_client_set_options($client_object, $option) { }

/**
 * @param $client_object
 * @param $callback
 */
function gearman_client_set_status_fn($client_object, $callback) { }

/**
 * @param $client_object
 * @param $timeout
 */
function gearman_client_set_timeout($client_object, $timeout) { }

/**
 * @param $client_object
 * @param $callback
 */
function gearman_client_set_warning_fn($client_object, $callback) { }

/**
 * @param $client_object
 * @param $callback
 */
function gearman_client_set_workload_fn($client_object, $callback) { }

/**
 * @param $client_object
 */
function gearman_client_timeout($client_object) { }

/**
 * @param $client_object
 */
function gearman_client_wait($client_object) { }

/**
 * @param $job_object
 */
function gearman_job_function_name($job_object) { }

/**
 * @param $job_object
 */
function gearman_job_handle($job_object) { }

/**
 * @param $job_object
 */
function gearman_job_return_code($job_object) { }

/**
 * @param $job_object
 * @param $result
 */
function gearman_job_send_complete($job_object, $result) { }

/**
 * @param $job_object
 * @param $data
 */
function gearman_job_send_data($job_object, $data) { }

/**
 * @param $job_object
 * @param $exception
 */
function gearman_job_send_exception($job_object, $exception) { }

/**
 * @param $job_object
 */
function gearman_job_send_fail($job_object) { }

/**
 * @param $job_object
 * @param $numerator
 * @param $denominator
 */
function gearman_job_send_status($job_object, $numerator, $denominator) { }

/**
 * @param $job_object
 * @param $warning
 */
function gearman_job_send_warning($job_object, $warning) { }

/**
 * @param $job_object
 */
function gearman_job_unique($job_object) { }

/**
 * @param $job_object
 */
function gearman_job_workload($job_object) { }

/**
 * @param $job_object
 */
function gearman_job_workload_size($job_object) { }

/**
 * @param $task_object
 */
function gearman_task_data($task_object) { }

/**
 * @param $task_object
 */
function gearman_task_data_size($task_object) { }

/**
 * @param $task_object
 */
function gearman_task_denominator($task_object) { }

/**
 * @param $task_object
 */
function gearman_task_function_name($task_object) { }

/**
 * @param $task_object
 */
function gearman_task_is_known($task_object) { }

/**
 * @param $task_object
 */
function gearman_task_is_running($task_object) { }

/**
 * @param $task_object
 */
function gearman_task_job_handle($task_object) { }

/**
 * @param $task_object
 */
function gearman_task_numerator($task_object) { }

/**
 * @param $task_object
 * @param $data_len
 */
function gearman_task_recv_data($task_object, $data_len) { }

/**
 * @param $task_object
 */
function gearman_task_return_code($task_object) { }

/**
 * @param $task_object
 * @param $data
 */
function gearman_task_send_workload($task_object, $data) { }

/**
 * @param $task_object
 */
function gearman_task_unique($task_object) { }

/**
 * @param $verbose
 */
function gearman_verbose_name($verbose) { }

/**
 */
function gearman_version() { }

/**
 * @param $worker_object
 * @param $function_name
 * @param $function
 * @param $data
 * @param $timeout
 */
function gearman_worker_add_function($worker_object, $function_name, $function, $data, $timeout) { }

/**
 * @param $worker_object
 * @param $option
 */
function gearman_worker_add_options($worker_object, $option) { }

/**
 * @param $worker_object
 * @param $host
 * @param $port
 */
function gearman_worker_add_server($worker_object, $host, $port) { }

/**
 * @param $worker_object
 * @param $servers
 */
function gearman_worker_add_servers($worker_object, $servers) { }

/**
 * @param $worker_object
 */
function gearman_worker_clone($worker_object) { }

/**
 */
function gearman_worker_create() { }

/**
 * @param $worker_object
 * @param $workload
 */
function gearman_worker_echo($worker_object, $workload) { }

/**
 * @param $worker_object
 */
function gearman_worker_errno($worker_object) { }

/**
 * @param $worker_object
 */
function gearman_worker_error($worker_object) { }

/**
 * @param $worker_object
 */
function gearman_worker_grab_job($worker_object) { }

/**
 * @param $worker_object
 */
function gearman_worker_options($worker_object) { }

/**
 * @param $worker_object
 * @param $function_name
 * @param $timeout
 */
function gearman_worker_register($worker_object, $function_name, $timeout) { }

/**
 * @param $worker_object
 * @param $option
 */
function gearman_worker_remove_options($worker_object, $option) { }

/**
 * @param $worker_object
 */
function gearman_worker_return_code($worker_object) { }

/**
 * @param $worker_object
 * @param $option
 */
function gearman_worker_set_options($worker_object, $option) { }

/**
 * @param $worker_object
 * @param $timeout
 */
function gearman_worker_set_timeout($worker_object, $timeout) { }

/**
 * @param $worker_object
 */
function gearman_worker_timeout($worker_object) { }

/**
 * @param $worker_object
 * @param $function_name
 */
function gearman_worker_unregister($worker_object, $function_name) { }

/**
 * @param $worker_object
 */
function gearman_worker_unregister_all($worker_object) { }

/**
 * @param $worker_object
 */
function gearman_worker_wait($worker_object) { }

/**
 * @param $worker_object
 */
function gearman_worker_work($worker_object) { }

