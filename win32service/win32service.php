<?php

/**
* The handle to the SCM database does not have the appropriate access rights.
*/
define( "WIN32_ERROR_ACCESS_DENIED", 0x00000005 );
/**
* A circular service dependency was specified.
*/
define( "WIN32_ERROR_CIRCULAR_DEPENDENCY", 0x00000423 );
/**
* The specified database does not exist.
*/
define( "WIN32_ERROR_DATABASE_DOES_NOT_EXIST", 0x00000429 );
/**
* The service cannot be stopped because other running services are dependent on it.
*/
define( "WIN32_ERROR_DEPENDENT_SERVICES_RUNNING", 0x0000041B );
/**
* The display name already exists in the service control manager database either as a service name or as another display name.
*/
define( "WIN32_ERROR_DUPLICATE_SERVICE_NAME", 0x00000436 );
/**
 * This error is returned if the program is being run as a console application rather than as a service. If the program will be run as a console application for debugging purposes, structure it such that service-specific code is not called.
 */
define( "WIN32_ERROR_FAILED_SERVICE_CONTROLLER_CONNECT", 0x00000427 );
/**
* The buffer is too small for the service status structure. Nothing was written to the structure.
*/
define( "WIN32_ERROR_INSUFFICIENT_BUFFER", 0x0000007A );
/**
* The specified service status structure is invalid.
*/
define( "WIN32_ERROR_INVALID_DATA", 0x0000000D );
/**
* The handle to the specified service control manager database is invalid.
*/
define( "WIN32_ERROR_INVALID_HANDLE", 0x00000006 );
/**
* The InfoLevel parameter contains an unsupported value.
*/
define( "WIN32_ERROR_INVALID_LEVEL", 0x0000007C );
/**
* The specified service name is invalid.
*/
define( "WIN32_ERROR_INVALID_NAME", 0x0000007B );
/**
* A parameter that was specified is invalid.
*/
define( "WIN32_ERROR_INVALID_PARAMETER", 0x00000057 );
/**
* The user account name specified in the user parameter does not exist. See win32_create_service().
*/
define( "WIN32_ERROR_INVALID_SERVICE_ACCOUNT", 0x00000421 );
/**
* The requested control code is not valid, or it is unacceptable to the service.
*/
define( "WIN32_ERROR_INVALID_SERVICE_CONTROL", 0x0000041C );
/**
* The service binary file could not be found.
*/
define( "WIN32_ERROR_PATH_NOT_FOUND", 0x00000003 );
/**
* An instance of the service is already running.
*/
define( "WIN32_ERROR_SERVICE_ALREADY_RUNNING", 0x00000420 );
/**
* The requested control code cannot be sent to the service because the state of the service is WIN32_SERVICE_STOPPED, WIN32_SERVICE_START_PENDING, or WIN32_SERVICE_STOP_PENDING.
*/
define( "WIN32_ERROR_SERVICE_CANNOT_ACCEPT_CTRL", 0x00000425 );
/**
* The database is locked.
*/
define( "WIN32_ERROR_SERVICE_DATABASE_LOCKED", 0x0000041F );
/**
* The service depends on a service that does not exist or has been marked for deletion.
*/
define( "WIN32_ERROR_SERVICE_DEPENDENCY_DELETED", 0x00000433 );
/**
* The service depends on another service that has failed to start.
*/
define( "WIN32_ERROR_SERVICE_DEPENDENCY_FAIL", 0x0000042C );
/**
* The service has been disabled.
*/
define( "WIN32_ERROR_SERVICE_DISABLED", 0x00000422 );
/**
* The specified service does not exist as an installed service.
*/
define( "WIN32_ERROR_SERVICE_DOES_NOT_EXIST", 0x00000424 );
/**
* The specified service already exists in this database.
*/
define( "WIN32_ERROR_SERVICE_EXISTS", 0x00000431 );
/**
* The service did not start due to a logon failure. This error occurs if the service is configured to run under an account that does not have the "Log on as a service" right.
*/
define( "WIN32_ERROR_SERVICE_LOGON_FAILED", 0x0000042D );
/**
* The specified service has already been marked for deletion.
*/
define( "WIN32_ERROR_SERVICE_MARKED_FOR_DELETE", 0x00000430 );
/**
* A thread could not be created for the service.
*/
define( "WIN32_ERROR_SERVICE_NO_THREAD", 0x0000041E );
/**
* The service has not been started.
*/
define( "WIN32_ERROR_SERVICE_NOT_ACTIVE", 0x00000426 );
/**
* The process for the service was started, but it did not call StartServiceCtrlDispatcher, or the thread that called StartServiceCtrlDispatcher may be blocked in a control handler function.
*/
define( "WIN32_ERROR_SERVICE_REQUEST_TIMEOUT", 0x0000041D );
/**
* The system is shutting down; this function cannot be called.
*/
define( "WIN32_ERROR_SHUTDOWN_IN_PROGRESS", 0x0000045B );
/**
* No error.
*/
define( "WIN32_NO_ERROR", 0x00000000 );

/**
 * resumes a paused service
 */
function win32_continue_service() { }

/**
 * Creates a new service entry in the SCM database
 *
 */

function win32_create_service() { }

/**
 *  Deletes a service entry from the SCM database
 *
 */
function win32_delete_service() { }

/**
 *   Returns the last control message that was sent to this service
 *
 */
function win32_get_last_control_message() { }

/**
 *   Pauses a service
 *
 */
function win32_pause_service() { }

/**
 *   Queries the status of a service
 *
 */
function win32_query_service_status() { }

/**
 *   Update the service status
 *
 */
function win32_set_service_status() { }

/**
 *   Registers the script with the SCM, so that it can act as the service with the given name
 *
 */
function win32_start_service_ctrl_dispatcher() { }

/**
 *   Starts a service
 *
 */
function win32_start_service() { }

/**
 *   Stops a service
 *
 */
function win32_stop_service() { }