<?php
/**
 * PHPStorm stub file for libxml functions.
 *
 * @link http://php.net/manual/en/book.libxml.php
 */

/**
 * Clear libxml error buffer
 *
 * @link  http://php.net/manual/en/function.libxml-clear-errors.php
 * @return void No value is returned.
 * @since 5.1.0
 */
function libxml_clear_errors() { }

/**
 * Disable the ability to load external entities
 *
 * @link  http://php.net/manual/en/function.libxml-disable-entity-loader.php
 *
 * @param bool $disable [optional] <p>
 *                      Disable (<b>TRUE</b>) or enable (<b>FALSE</b>) libxml extensions (such as
 *                      ,
 *                      and ) to load external entities.
 *                      </p>
 *
 * @return bool the previous value.
 * @since 5.2.11
 */
function libxml_disable_entity_loader($disable = true) { }

/**
 * Retrieve array of errors
 *
 * @link  http://php.net/manual/en/function.libxml-get-errors.php
 * @return array an array with LibXMLError objects if there are any
 * errors in the buffer, or an empty array otherwise.
 * @since 5.1.0
 */
function libxml_get_errors() { }

/**
 * Retrieve last error from libxml
 *
 * @link  http://php.net/manual/en/function.libxml-get-last-error.php
 * @return LibXMLError a LibXMLError object if there is any error in the
 * buffer, <b>FALSE</b> otherwise.
 * @since 5.1.0
 */
function libxml_get_last_error() { }

/**
 * Changes the default external entity loader
 *
 * @link  http://php.net/manual/en/function.libxml-set-external-entity-loader.php
 *
 * @param callable $resolver_function <p>
 *                                    A callable that takes three arguments. Two strings, a public id
 *                                    and system id, and a context (an array with four keys) as the third argument.
 *                                    This callback should return a resource, a string from which a resource can be
 *                                    opened, or <b>NULL</b>.
 *                                    </p>
 *
 * @return void No value is returned.
 * @since 5.4.0
 */
function libxml_set_external_entity_loader(callable $resolver_function) { }

/**
 * Set the streams context for the next libxml document load or write
 *
 * @link  http://php.net/manual/en/function.libxml-set-streams-context.php
 *
 * @param resource $streams_context <p>
 *                                  The stream context resource (created with
 *                                  <b>stream_context_create</b>)
 *                                  </p>
 *
 * @return void No value is returned.
 * @since 5.0
 */
function libxml_set_streams_context($streams_context) { }

/**
 * Disable libxml errors and allow user to fetch error information as needed
 *
 * @link  http://php.net/manual/en/function.libxml-use-internal-errors.php
 *
 * @param bool $use_errors [optional] <p>
 *                         Enable (<b>TRUE</b>) user error handling or disable (<b>FALSE</b>) user error handling.
 *                         Disabling will also clear any existing libxml errors.
 *                         </p>
 *
 * @return bool This function returns the previous value of
 * <i>use_errors</i>.
 * @since 5.1.0
 */
function libxml_use_internal_errors($use_errors = false) { }
