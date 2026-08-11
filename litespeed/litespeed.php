<?php

function litespeed_request_headers(): array {}

function litespeed_response_headers(): array|false {}

/**
 * Flushes all response data to the client
 *
 * This function flushes all response data to the client and finishes the request. This allows for
 * time consuming tasks to be performed without leaving the connection to the client open.
 *
 * @link https://php.net/manual/en/function.litespeed-finish-request.php
 * @return bool Returns true on success or false on failure.
 */
function litespeed_finish_request(): bool {}
