<?php
/**
 * PHPStorm stub file for SOAP functions.
 *
 * @link http://php.net/manual/en/book.soap.php
 */

/**
 * Checks if a SOAP call has failed
 *
 * @link http://php.net/manual/en/function.is-soap-fault.php
 *
 * @param mixed $object <p>
 *                      The object to test.
 *                      </p>
 *
 * @return bool This will return <b>TRUE</b> on error, and <b>FALSE</b> otherwise.
 */
function is_soap_fault($object) { }

/**
 * Set whether to use the SOAP error handler
 *
 * @link http://php.net/manual/en/function.use-soap-error-handler.php
 *
 * @param bool $handler [optional] <p>
 *                      Set to <b>TRUE</b> to send error details to clients.
 *                      </p>
 *
 * @return bool the original value.
 */
function use_soap_error_handler($handler = true) { }
