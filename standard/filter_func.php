<?php
/**
 * PHPStorm stub file for Data Filtering functions.
 *
 * @link http://php.net/manual/en/book.filter.php
 */

/**
 * Checks if variable of specified type exists
 *
 * @link  http://php.net/manual/en/function.filter-has-var.php
 *
 * @param int    $type          <p>
 *                              One of <b>INPUT_GET</b>, <b>INPUT_POST</b>,
 *                              <b>INPUT_COOKIE</b>, <b>INPUT_SERVER</b>, or
 *                              <b>INPUT_ENV</b>.
 *                              </p>
 * @param string $variable_name <p>
 *                              Name of a variable to check.
 *                              </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.2.0
 */
function filter_has_var($type, $variable_name) { }

/**
 * Returns the filter ID belonging to a named filter
 *
 * @link  http://php.net/manual/en/function.filter-id.php
 *
 * @param string $filtername <p>
 *                           Name of a filter to get.
 *                           </p>
 *
 * @return int ID of a filter on success or <b>FALSE</b> if filter doesn't exist.
 * @since 5.2.0
 */
function filter_id($filtername) { }

/**
 * Gets a specific external variable by name and optionally filters it
 *
 * @link  http://php.net/manual/en/function.filter-input.php
 *
 * @param int    $type          <p>
 *                              One of <b>INPUT_GET</b>, <b>INPUT_POST</b>,
 *                              <b>INPUT_COOKIE</b>, <b>INPUT_SERVER</b>, or
 *                              <b>INPUT_ENV</b>.
 *                              </p>
 * @param string $variable_name <p>
 *                              Name of a variable to get.
 *                              </p>
 * @param int    $filter        [optional] <p>
 *                              The ID of the filter to apply. The
 *                              manual page lists the available filters.
 *                              </p>
 * @param mixed  $options       [optional] <p>
 *                              Associative array of options or bitwise disjunction of flags. If filter
 *                              accepts options, flags can be provided in "flags" field of array.
 *                              </p>
 *
 * @return mixed Value of the requested variable on success, <b>FALSE</b> if the filter fails,
 * or <b>NULL</b> if the <i>variable_name</i> variable is not set.
 * If the flag <b>FILTER_NULL_ON_FAILURE</b> is used, it
 * returns <b>FALSE</b> if the variable is not set and <b>NULL</b> if the filter fails.
 * @since 5.2.0
 */
function filter_input($type, $variable_name, $filter = FILTER_DEFAULT, $options = null) { }

/**
 * Gets external variables and optionally filters them
 *
 * @link  http://php.net/manual/en/function.filter-input-array.php
 *
 * @param int   $type       <p>
 *                          One of <b>INPUT_GET</b>, <b>INPUT_POST</b>,
 *                          <b>INPUT_COOKIE</b>, <b>INPUT_SERVER</b>, or
 *                          <b>INPUT_ENV</b>.
 *                          </p>
 * @param mixed $definition [optional] <p>
 *                          An array defining the arguments. A valid key is a string
 *                          containing a variable name and a valid value is either a filter type, or an array
 *                          optionally specifying the filter, flags and options. If the value is an
 *                          array, valid keys are filter which specifies the
 *                          filter type,
 *                          flags which specifies any flags that apply to the
 *                          filter, and options which specifies any options that
 *                          apply to the filter. See the example below for a better understanding.
 *                          </p>
 *                          <p>
 *                          This parameter can be also an integer holding a filter constant. Then all values in the
 *                          input array are filtered by this filter.
 *                          </p>
 * @param bool  $add_empty  [optional] <p>
 *                          Add missing keys as <b>NULL</b> to the return value.
 *                          </p>
 *
 * @return mixed An array containing the values of the requested variables on success, or <b>FALSE</b>
 * on failure. An array value will be <b>FALSE</b> if the filter fails, or <b>NULL</b> if
 * the variable is not set. Or if the flag <b>FILTER_NULL_ON_FAILURE</b>
 * is used, it returns <b>FALSE</b> if the variable is not set and <b>NULL</b> if the filter
 * fails.
 * @since 5.2.0
 */
function filter_input_array($type, $definition = null, $add_empty = true) { }

/**
 * Returns a list of all supported filters
 *
 * @link  http://php.net/manual/en/function.filter-list.php
 * @return array an array of names of all supported filters, empty array if there
 * are no such filters. Indexes of this array are not filter IDs, they can be
 * obtained with <b>filter_id</b> from a name instead.
 * @since 5.2.0
 */
function filter_list() { }

/**
 * Filters a variable with a specified filter
 *
 * @link  http://php.net/manual/en/function.filter-var.php
 *
 * @param mixed $variable <p>
 *                        Value to filter.
 *                        </p>
 * @param int   $filter   [optional] <p>
 *                        The ID of the filter to apply. The
 *                        manual page lists the available filters.
 *                        </p>
 * @param mixed $options  [optional] <p>
 *                        Associative array of options or bitwise disjunction of flags. If filter
 *                        accepts options, flags can be provided in "flags" field of array. For
 *                        the "callback" filter, callable type should be passed. The
 *                        callback must accept one argument, the value to be filtered, and return
 *                        the value after filtering/sanitizing it.
 *                        </p>
 *                        <p>
 *                        <code>
 *                        // for filters that accept options, use this format
 *                        $options = array(
 *                        'options' => array(
 *                        'default' => 3, // value to return if the filter fails
 *                        // other options here
 *                        'min_range' => 0
 *                        ),
 *                        'flags' => FILTER_FLAG_ALLOW_OCTAL,
 *                        );
 *                        $var = filter_var('0755', FILTER_VALIDATE_INT, $options);
 *                        // for filter that only accept flags, you can pass them directly
 *                        $var = filter_var('oops', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
 *                        // for filter that only accept flags, you can also pass as an array
 *                        $var = filter_var('oops', FILTER_VALIDATE_BOOLEAN,
 *                        array('flags' => FILTER_NULL_ON_FAILURE));
 *                        // callback validate filter
 *                        function foo($value)
 *                        {
 *                        // Expected format: Surname, GivenNames
 *                        if (strpos($value, ", ") === false) return false;
 *                        list($surname, $givennames) = explode(", ", $value, 2);
 *                        $empty = (empty($surname) || empty($givennames));
 *                        $notstrings = (!is_string($surname) || !is_string($givennames));
 *                        if ($empty || $notstrings) {
 *                        return false;
 *                        } else {
 *                        return $value;
 *                        }
 *                        }
 *                        $var = filter_var('Doe, Jane Sue', FILTER_CALLBACK, array('options' => 'foo'));
 *                        </code>
 *                        </p>
 *
 * @return mixed the filtered data, or <b>FALSE</b> if the filter fails.
 * @since 5.2.0
 */
function filter_var($variable, $filter = FILTER_DEFAULT, $options = null) { }

/**
 * Gets multiple variables and optionally filters them
 *
 * @link  http://php.net/manual/en/function.filter-var-array.php
 *
 * @param array $data       <p>
 *                          An array with string keys containing the data to filter.
 *                          </p>
 * @param mixed $definition [optional] <p>
 *                          An array defining the arguments. A valid key is a string
 *                          containing a variable name and a valid value is either a
 *                          filter type, or an
 *                          array optionally specifying the filter, flags and options.
 *                          If the value is an array, valid keys are filter
 *                          which specifies the filter type,
 *                          flags which specifies any flags that apply to the
 *                          filter, and options which specifies any options that
 *                          apply to the filter. See the example below for a better understanding.
 *                          </p>
 *                          <p>
 *                          This parameter can be also an integer holding a filter constant. Then all values in the
 *                          input array are filtered by this filter.
 *                          </p>
 * @param bool  $add_empty  [optional] <p>
 *                          Add missing keys as <b>NULL</b> to the return value.
 *                          </p>
 *
 * @return mixed An array containing the values of the requested variables on success, or <b>FALSE</b>
 * on failure. An array value will be <b>FALSE</b> if the filter fails, or <b>NULL</b> if
 * the variable is not set.
 * @since 5.2.0
 */
function filter_var_array(array $data, $definition = null, $add_empty = true) { }
