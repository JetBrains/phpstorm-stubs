<?php

/**
 * Sends HTTP response headers immediately.
 *
 * This function can be used to send 1XX informative responses, for instance 103 "Early Hints" responses.
 * This function can be called multiple times, allowing to send multiple informative responses before the final one.
 *
 * @link https://frankenphp.dev/docs/early-hints/
 *
 * @return int the HTTP status code of this response
 */
function headers_send(int $status = 200): int {}

/**
 * Handles an HTTP request with the provided callbacl.
 *
 * When called, superglobals, php://input and the like are reset to reflect the values of the handled request.
 *
 * @link https://frankenphp.dev/docs/worker/
 *
 * @return bool returns <b>FALSE</b> if the server is terminating, giving the opportunity to the worker script to finish cleanly
 */
function frankenphp_handle_request(callable $callback): bool {}

/**
 * Flushes all response data to the client and finishes the request.
 * This allows for time-consuming tasks to be performed without leaving the connection to the client open.
 *
 * Alias of <b>fastcgi_finish_request</b>.
 *
 * @link https://www.php.net/manual/en/function.fastcgi-finish-request.php
 *
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function frankenphp_finish_request(): bool {}

/**
 * Fetches all HTTP request headers from the current request.
 *
 * Alias of <b>apache_request_headers</b>.
 *
 * @link https://php.net/manual/en/function.apache-request-headers.php
 *
 * @return array An associative array of all the HTTP headers in the current request.
 */
function frankenphp_request_headers(): array {}

/**
 * Fetches all HTTP response headers.
 *
 * Alias of <b>apache_response_headers</b>.
 *
 * @link https://php.net/manual/en/function.apache-response-headers.php
 *
 * @return array|false An array of all FrankenPHP response headers on success or <b>FALSE</b> on failure.
 */
function frankenphp_response_headers(): array|false {}

/**
 * Publishes a Mercure update to all currently connected subscribers.
 *
 * @link https://frankenphp.dev/docs/mercure/
 * @link https://mercure.rocks
 *
 * @param string|string[] $topics
 */
function mercure_publish(string|array $topics, string $data = '', bool $private = false, ?string $id = null, ?string $type = null, ?int $retry = null): string {}

const FRANKENPHP_LOG_LEVEL_DEBUG = -4;
const FRANKENPHP_LOG_LEVEL_INFO = 0;
const FRANKENPHP_LOG_LEVEL_WARN = 4;
const FRANKENPHP_LOG_LEVEL_ERROR = 8;

/**
 * Emits a structured log record with the current time and the given message, level and context.
 *
 * @param int $level The importance or severity of a log event. The higher the level, the more important or severe the event. For more details, see: https://pkg.go.dev/log/slog#Level
 * array<string, any> $context Values of the array will be converted to the corresponding Go type (if supported by FrankenPHP) and added to the context of the structured logs using https://pkg.go.dev/log/slog#Attr
 */
function frankenphp_log(string $message, int $level = FRANKENPHP_LOG_LEVEL_INFO, array $context = []): void {}
