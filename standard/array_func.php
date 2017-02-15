<?php
/**
 * PHPStorm stub file for array functions.
 *
 * @link http://php.net/manual/en/book.array.php
 */
/**
 * Creates an array.
 *
 * @link http://php.net/manual/en/function.array.php
 *
 * @param mixed $_ [optional] <p>
 *                 Syntax "index => values", separated by commas, define index and values.
 *                 index may be of type string or integer. When index is omitted, an integer index is automatically
 *                 generated, starting at 0. If index is an integer, next generated index will be the biggest
 *                 integer index + 1. Note that when two identical index are defined, the last overwrite the first.
 *                 </p>
 *                 <p>
 *                 Having a trailing comma after the last defined array entry, while unusual, is a valid syntax.
 *                 </p>
 *
 * @return array an array of the parameters. The parameters can be given an index with the => operator.
 */
function PS_UNRESERVE_PREFIX_array(...$_) { }

/**
 * Changes all keys in an array
 *
 * @link  http://php.net/manual/en/function.array-change-key-case.php
 *
 * @param array $input <p>
 *                     The array to work on
 *                     </p>
 * @param int   $case  [optional] <p>
 *                     Either CASE_UPPER or
 *                     CASE_LOWER (default)
 *                     </p>
 *
 * @return array|false an array with its keys lower or uppercased, or false if input is not an array.
 * @since 4.2.0
 * @since 5.0
 */
function array_change_key_case(array $input, $case = null) { }

/**
 * Split an array into chunks
 *
 * @link  http://php.net/manual/en/function.array-chunk.php
 *
 * @param array $input         <p>
 *                             The array to work on
 *                             </p>
 * @param int   $size          <p>
 *                             The size of each chunk
 *                             </p>
 * @param bool  $preserve_keys [optional] <p>
 *                             When set to true keys will be preserved.
 *                             Default is false which will reindex the chunk numerically
 *                             </p>
 *
 * @return array a multidimensional numerically indexed array, starting with zero,
 * with each dimension containing size elements.
 * @since 4.2.0
 * @since 5.0
 */
function array_chunk(array $input, $size, $preserve_keys = null) { }

/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Return the values from a single column in the input array
 *
 * @link  http://www.php.net/manual/en/function.array-column.php
 *
 * @param array $array     <p>A multi-dimensional array (record set) from which to pull a column of values.</p>
 * @param mixed $column    <p>The column of values to return. This value may be the integer key of the column you
 *                         wish to retrieve, or it may be the string key name for an associative array. It may also
 *                         be NULL to return complete arrays (useful together with index_key to reindex the
 *                         array).</p>
 * @param mixed $index_key [optional] <p>The column to use as the index/keys for the returned array. This value may
 *                         be the integer key of the column, or it may be the string key name.</p>
 *
 * @return array Returns an array of values representing a single column from the input array.
 * @since 5.5.0
 */
function array_column(array $array, $column, $index_key = null) { }

/**
 * Creates an array by using one array for keys and another for its values
 *
 * @link  http://php.net/manual/en/function.array-combine.php
 *
 * @param array $keys   <p>
 *                      Array of keys to be used. Illegal values for key will be
 *                      converted to string.
 *                      </p>
 * @param array $values <p>
 *                      Array of values to be used
 *                      </p>
 *
 * @return array|false the combined array, false if the number of elements for each array isn't equal or if the arrays
 *                     are empty.
 * @since 5.0
 */
function array_combine(array $keys, array $values) { }

/**
 * Counts all the values of an array
 *
 * @link  http://php.net/manual/en/function.array-count-values.php
 *
 * @param array $input <p>
 *                     The array of values to count
 *                     </p>
 *
 * @return array an associative array of values from input as keys and their count as value.
 * @since 4.0
 * @since 5.0
 */
function array_count_values(array $input) { }

/**
 * Computes the difference of arrays
 *
 * @link  http://php.net/manual/en/function.array-diff.php
 *
 * @param array $array1 <p>
 *                      The array to compare from
 *                      </p>
 * @param array $array2 <p>
 *                      An array to compare against
 *                      </p>
 * @param array $_      [optional]
 *
 * @return array an array containing all the entries from array1 that are not present in any of the other arrays.
 * @since 4.0.1
 * @since 5.0
 */
function array_diff(array $array1, array $array2, array $_ = null) { }

/**
 * Computes the difference of arrays with additional index check
 *
 * @link  http://php.net/manual/en/function.array-diff-assoc.php
 *
 * @param array $array1 <p>
 *                      The array to compare from
 *                      </p>
 * @param array $array2 <p>
 *                      An array to compare against
 *                      </p>
 * @param array $_      [optional]
 *
 * @return array an array containing all the values from array1 that are not present in any of the other arrays.
 * @since 4.3.0
 * @since 5.0
 */
function array_diff_assoc(array $array1, array $array2, array $_ = null) { }

/**
 * Computes the difference of arrays using keys for comparison
 *
 * @link  http://php.net/manual/en/function.array-diff-key.php
 *
 * @param array $array1 <p>
 *                      The array to compare from
 *                      </p>
 * @param array $array2 <p>
 *                      An array to compare against
 *                      </p>
 * @param array $_      [optional]
 *
 * @return array an array containing all the entries from array1 whose keys are not present in any of the other arrays.
 * @since 5.1.0
 */
function array_diff_key(array $array1, array $array2, array $_ = null) { }

/**
 * Computes the difference of arrays with additional index check which is performed by a user supplied callback
 * function
 *
 * @link  http://php.net/manual/en/function.array-diff-uassoc.php
 *
 * @param array    $array1           <p>
 *                                   The array to compare from
 *                                   </p>
 * @param array    $array2           <p>
 *                                   An array to compare against
 *                                   </p>
 * @param array    $_                [optional]
 * @param callback $key_compare_func <p>
 *                                   callback function to use.
 *                                   The callback function must return an integer less than, equal
 *                                   to, or greater than zero if the first argument is considered to
 *                                   be respectively less than, equal to, or greater than the second.
 *                                   </p>
 *
 * @return array an array containing all the entries from array1 that are not present in any of the other arrays.
 * @since 5.0
 */
function array_diff_uassoc(array $array1, array $array2, array $_ = null, $key_compare_func) { }

/**
 * Computes the difference of arrays using a callback function on the keys for comparison
 *
 * @link  http://php.net/manual/en/function.array-diff-ukey.php
 *
 * @param array    $array1           <p>
 *                                   The array to compare from
 *                                   </p>
 * @param array    $array2           <p>
 *                                   An array to compare against
 *                                   </p>
 * @param array    $_                [optional]
 * @param callback $key_compare_func <p>
 *                                   callback function to use.
 *                                   The callback function must return an integer less than, equal
 *                                   to, or greater than zero if the first argument is considered to
 *                                   be respectively less than, equal to, or greater than the second.
 *                                   </p>
 *
 * @return array an array containing all the entries from array1 that are not present in any of the other arrays.
 * @since 5.1.0
 */
function array_diff_ukey(array $array1, array $array2, array $_ = null, $key_compare_func) { }

/**
 * Fill an array with values
 *
 * @link  http://php.net/manual/en/function.array-fill.php
 *
 * @param int   $start_index <p>
 *                           The first index of the returned array.
 *                           Supports non-negative indexes only.
 *                           </p>
 * @param int   $num         <p>
 *                           Number of elements to insert
 *                           </p>
 * @param mixed $value       <p>
 *                           Value to use for filling
 *                           </p>
 *
 * @return array the filled array
 * @since 4.2.0
 * @since 5.0
 */
function array_fill($start_index, $num, $value) { }

/**
 * Fill an array with values, specifying keys
 *
 * @link  http://php.net/manual/en/function.array-fill-keys.php
 *
 * @param array $keys  <p>
 *                     Array of values that will be used as keys. Illegal values
 *                     for key will be converted to string.
 *                     </p>
 * @param mixed $value <p>
 *                     Value to use for filling
 *                     </p>
 *
 * @return array the filled array
 * @since 5.2.0
 */
function array_fill_keys(array $keys, $value) { }

/**
 * Iterates over each value in the <b>array</b>
 * passing them to the <b>callback</b> function.
 * If the <b>callback</b> function returns true, the
 * current value from <b>array</b> is returned into
 * the result array. Array keys are preserved.
 *
 * @link  http://php.net/manual/en/function.array-filter.php
 *
 * @param array    $input    <p>
 *                           The array to iterate over
 *                           </p>
 * @param callback $callback [optional] <p>
 *                           The callback function to use
 *                           </p>
 *                           <p>
 *                           If no callback is supplied, all entries of
 *                           input equal to false (see
 *                           converting to
 *                           boolean) will be removed.
 *                           </p>
 * @param int      $flag     [optional] <p>
 *                           Flag determining what arguments are sent to <i>callback</i>:
 *                           </p><ul>
 *                           <li>
 *                           <b>ARRAY_FILTER_USE_KEY</b> - pass key as the only argument
 *                           to <i>callback</i> instead of the value</span>
 *                           </li>
 *                           <li>
 *                           <b>ARRAY_FILTER_USE_BOTH</b> - pass both value and key as
 *                           arguments to <i>callback</i> instead of the value</span>
 *                           </li>
 *                           </ul>
 *
 * @return array the filtered array.
 * @since 4.0.6
 * @since 5.0
 */
function array_filter(array $input, $callback = null, $flag = 0) { }

/**
 * Exchanges all keys with their associated values in an array
 *
 * @link  http://php.net/manual/en/function.array-flip.php
 *
 * @param array $trans <p>
 *                     An array of key/value pairs to be flipped.
 *                     </p>
 *
 * @return array|false the flipped array on success and false on failure.
 * @since 4.0
 * @since 5.0
 */
function array_flip(array $trans) { }

/**
 * Computes the intersection of arrays
 *
 * @link  http://php.net/manual/en/function.array-intersect.php
 *
 * @param array $array1 <p>
 *                      The array with master values to check.
 *                      </p>
 * @param array $array2 <p>
 *                      An array to compare values against.
 *                      </p>
 * @param array $_      [optional]
 *
 * @return array an array containing all of the values in array1 whose values exist in all of the parameters.
 * @since 4.0.1
 * @since 5.0
 */
function array_intersect(array $array1, array $array2, array $_ = null) { }

/**
 * Computes the intersection of arrays with additional index check
 *
 * @link  http://php.net/manual/en/function.array-intersect-assoc.php
 *
 * @param array $array1 <p>
 *                      The array with master values to check.
 *                      </p>
 * @param array $array2 <p>
 *                      An array to compare values against.
 *                      </p>
 * @param array $_      [optional]
 *
 * @return array an associative array containing all the values in array1 that are present in all of the arguments.
 * @since 4.3.0
 * @since 5.0
 */
function array_intersect_assoc(array $array1, array $array2, array $_ = null) { }

/**
 * Computes the intersection of arrays using keys for comparison
 *
 * @link  http://php.net/manual/en/function.array-intersect-key.php
 *
 * @param array $array1 <p>
 *                      The array with master keys to check.
 *                      </p>
 * @param array $array2 <p>
 *                      An array to compare keys against.
 *                      </p>
 * @param array $_      [optional]
 *
 * @return array an associative array containing all the entries of array1 which have keys that are present in all
 *               arguments.
 * @since 5.1.0
 */
function array_intersect_key(array $array1, array $array2, array $_ = null) { }

/**
 * Computes the intersection of arrays with additional index check, compares indexes by a callback function
 *
 * @link  http://php.net/manual/en/function.array-intersect-uassoc.php
 *
 * @param array    $array1           <p>
 *                                   Initial array for comparison of the arrays.
 *                                   </p>
 * @param array    $array2           <p>
 *                                   First array to compare keys against.
 *                                   </p>
 * @param array    $_                [optional]
 * @param callback $key_compare_func <p>
 *                                   User supplied callback function to do the comparison.
 *                                   </p>
 *
 * @return array the values of array1 whose values exist in all of the arguments.
 * @since 5.0
 */
function array_intersect_uassoc(array $array1, array $array2, array $_ = null, $key_compare_func) { }

/**
 * Computes the intersection of arrays using a callback function on the keys for comparison
 *
 * @link  http://php.net/manual/en/function.array-intersect-ukey.php
 *
 * @param array    $array1           <p>
 *                                   Initial array for comparison of the arrays.
 *                                   </p>
 * @param array    $array2           <p>
 *                                   First array to compare keys against.
 *                                   </p>
 * @param array    $_                [optional]
 * @param callback $key_compare_func <p>
 *                                   User supplied callback function to do the comparison.
 *                                   </p>
 *
 * @return array the values of array1 whose keys exist in all the arguments.
 * @since 5.1.0
 */
function array_intersect_ukey(array $array1, array $array2, array $_ = null, $key_compare_func) { }

/**
 * Checks if the given key or index exists in the array
 *
 * @link  http://php.net/manual/en/function.array-key-exists.php
 *
 * @param mixed             $key    <p>
 *                                  Value to check.
 *                                  </p>
 * @param array|ArrayObject $search <p>
 *                                  An array with keys to check.
 *                                  </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0.7
 * @since 5.0
 */
function array_key_exists($key, array $search) { }

/**
 * Return all the keys of an array
 *
 * @link  http://php.net/manual/en/function.array-keys.php
 *
 * @param array $input        <p>
 *                            An array containing keys to return.
 *                            </p>
 * @param mixed $search_value [optional] <p>
 *                            If specified, then only keys containing these values are returned.
 *                            </p>
 * @param bool  $strict       [optional] <p>
 *                            Determines if strict comparison (===) should be used during the search.
 *                            </p>
 *
 * @return array an array of all the keys in input.
 * @since 4.0
 * @since 5.0
 */
function array_keys(array $input, $search_value = null, $strict = null) { }

/**
 * Applies the callback to the elements of the given arrays
 *
 * @link  http://php.net/manual/en/function.array-map.php
 *
 * @param callback $callback <p>
 *                           Callback function to run for each element in each array.
 *                           </p>
 * @param array    $arr1     <p>
 *                           An array to run through the callback function.
 *                           </p>
 * @param array    $_        [optional]
 *
 * @return array an array containing all the elements of arr1 after applying the callback function to each one.
 * @since 4.0.6
 * @since 5.0
 */
function array_map($callback, array $arr1, array $_ = null) { }

/**
 * Merge one or more arrays
 *
 * @link  http://php.net/manual/en/function.array-merge.php
 *
 * @param array $array1 <p>
 *                      Initial array to merge.
 *                      </p>
 * @param array $array2 [optional]
 * @param array $_      [optional]
 *
 * @return array the resulting array.
 * @since 4.0
 * @since 5.0
 */
function array_merge(array $array1, array $array2 = null, array $_ = null) { }

/**
 * Merge two or more arrays recursively
 *
 * @link  http://php.net/manual/en/function.array-merge-recursive.php
 *
 * @param array $array1 <p>
 *                      Initial array to merge.
 *                      </p>
 * @param array $_      [optional]
 *
 * @return array An array of values resulted from merging the arguments together.
 * @since 4.0.1
 * @since 5.0
 */
function array_merge_recursive(array $array1, array $_ = null) { }

/**
 * Sort multiple or multi-dimensional arrays
 *
 * @link  http://php.net/manual/en/function.array-multisort.php
 *
 * @param array $arr <p>
 *                   An array being sorted.
 *                   </p>
 * @param mixed $arg [optional] <p>
 *                   Optionally another array, or sort options for the
 *                   previous array argument:
 *                   SORT_ASC,
 *                   SORT_DESC,
 *                   SORT_REGULAR,
 *                   SORT_NUMERIC,
 *                   SORT_STRING.
 *                   </p>
 * @param mixed $arg [optional]
 * @param mixed $_   [optional]
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function array_multisort(array &$arr, $arg = null, $arg = null, $_ = null) { }

/**
 * Pad array to the specified length with a value
 *
 * @link  http://php.net/manual/en/function.array-pad.php
 *
 * @param array $input     <p>
 *                         Initial array of values to pad.
 *                         </p>
 * @param int   $pad_size  <p>
 *                         New size of the array.
 *                         </p>
 * @param mixed $pad_value <p>
 *                         Value to pad if input is less than
 *                         pad_size.
 *                         </p>
 *
 * @return array a copy of the input padded to size specified by pad_size with value pad_value. If pad_size is positive
 *               then the array is padded on the right, if it's negative then on the left. If the absolute value of
 *               pad_size is less than or equal to the length of the input then no padding takes place.
 * @since 4.0
 * @since 5.0
 */
function array_pad(array $input, $pad_size, $pad_value) { }

/**
 * Pop the element off the end of array
 *
 * @link  http://php.net/manual/en/function.array-pop.php
 *
 * @param array $array <p>
 *                     The array to get the value from.
 *                     </p>
 *
 * @return mixed the last value of array. If array is empty (or is not an array), &null; will be returned.
 * @since 4.0
 * @since 5.0
 */
function array_pop(array &$array) { }

/**
 * Calculate the product of values in an array
 *
 * @link  http://php.net/manual/en/function.array-product.php
 *
 * @param array $array <p>
 *                     The array.
 *                     </p>
 *
 * @return int|float the product as an integer or float.
 * @since 5.1.0
 */
function array_product(array $array) { }

/**
 * Push one or more elements onto the end of array
 *
 * @link  http://php.net/manual/en/function.array-push.php
 *
 * @param array $array <p>
 *                     The input array.
 *                     </p>
 * @param mixed $var   <p>
 *                     The pushed value.
 *                     </p>
 * @param mixed $_     [optional]
 *
 * @return int the new number of elements in the array.
 * @since 4.0
 * @since 5.0
 */
function array_push(array &$array, $var, $_ = null) { }

/**
 * Pick one or more random entries out of an array
 *
 * @link  http://php.net/manual/en/function.array-rand.php
 *
 * @param array $input   <p>
 *                       The input array.
 *                       </p>
 * @param int   $num_req [optional] <p>
 *                       Specifies how many entries you want to pick.
 *                       </p>
 *
 * @return string|int|array If you are picking only one entry, array_rand returns the key for a random entry.
 *                          Otherwise, it returns an array of keys for the random entries. This is done so that you can
 *                          pick random keys as well as values out of the array.
 * @since 4.0
 * @since 5.0
 */
function array_rand(array $input, $num_req = null) { }

/**
 * Iteratively reduce the array to a single value using a callback function
 *
 * @link  http://php.net/manual/en/function.array-reduce.php
 *
 * @param array    $input    <p>
 *                           The input array.
 *                           </p>
 * @param callback $function <p>
 *                           The callback function.
 *                           </p>
 * @param mixed    $initial  [optional] <p>
 *                           If the optional initial is available, it will
 *                           be used at the beginning of the process, or as a final result in case
 *                           the array is empty.
 *                           </p>
 *
 * @return mixed the resulting value. If the array is empty and initial is not passed, array_reduce returns &null;.
 * @since 4.0.5
 * @since 5.0
 */
function array_reduce(array $input, $function, $initial = null) { }

/**
 * array_replace() replaces the values of the first array with the same values from all the following arrays.
 * If a key from the first array exists in the second array, its value will be replaced by the value from the
 * second array. If the key exists in the second array, and not the first, it will be created in the first array.
 * If a key only exists in the first array, it will be left as is. If several arrays are passed for replacement,
 * they will be processed in order, the later arrays overwriting the previous values. array_replace() is not
 * recursive : it will replace values in the first array by whatever type is in the second array.
 *
 * @link  http://php.net/manual/en/function.array-replace.php
 *
 * @param array $array  <p>
 *                      The array in which elements are replaced.
 *                      </p>
 * @param array $array1 <p>
 *                      The array from which elements will be extracted.
 *                      </p>
 * @param array $array2 [optional]
 * @param array $_      [optional]
 *
 * @return array|null Returns an array or null if an error occurs.
 * @since 5.3.0
 */
function array_replace(array $array, array $array1, array $array2 = null, array $_ = null) { }

/**
 * Replaces elements from passed arrays into the first array recursively
 *
 * @link  http://php.net/manual/en/function.array-replace-recursive.php
 *
 * @param array $array  <p>
 *                      The array in which elements are replaced.
 *                      </p>
 * @param array $array1 <p>
 *                      The array from which elements will be extracted.
 *                      </p>
 * @param array $array2 [optional]
 * @param array $_      [optional]
 *
 * @return array|null an array, or &null; if an error occurs.
 * @since 5.3.0
 */
function array_replace_recursive(array $array, array $array1, array $array2 = null, array $_ = null) { }

/**
 * Return an array with elements in reverse order
 *
 * @link  http://php.net/manual/en/function.array-reverse.php
 *
 * @param array $array         <p>
 *                             The input array.
 *                             </p>
 * @param bool  $preserve_keys [optional] <p>
 *                             If set to true keys are preserved.
 *                             </p>
 *
 * @return array the reversed array.
 * @since 4.0
 * @since 5.0
 */
function array_reverse(array $array, $preserve_keys = null) { }

/**
 * Searches the array for a given value and returns the corresponding key if successful
 *
 * @link  http://php.net/manual/en/function.array-search.php
 *
 * @param mixed $needle   <p>
 *                        The searched value.
 *                        </p>
 *                        <p>
 *                        If needle is a string, the comparison is done
 *                        in a case-sensitive manner.
 *                        </p>
 * @param array $haystack <p>
 *                        The array.
 *                        </p>
 * @param bool  $strict   [optional] <p>
 *                        If the third parameter strict is set to true
 *                        then the array_search function will also check the
 *                        types of the
 *                        needle in the haystack.
 *                        </p>
 *
 * @return mixed the key for needle if it is found in the
 * array, false otherwise.
 * </p>
 * <p>
 * If needle is found in haystack
 * more than once, the first matching key is returned. To return the keys for
 * all matching values, use array_keys with the optional
 * search_value parameter instead.
 * @since 4.0.5
 * @since 5.0
 */
function array_search($needle, array $haystack, $strict = null) { }

/**
 * Shift an element off the beginning of array
 *
 * @link  http://php.net/manual/en/function.array-shift.php
 *
 * @param array $array <p>
 *                     The input array.
 *                     </p>
 *
 * @return mixed the shifted value, or &null; if array is empty or is not an array.
 * @since 4.0
 * @since 5.0
 */
function array_shift(array &$array) { }

/**
 * Extract a slice of the array
 *
 * @link  http://php.net/manual/en/function.array-slice.php
 *
 * @param array $array         <p>
 *                             The input array.
 *                             </p>
 * @param int   $offset        <p>
 *                             If offset is non-negative, the sequence will
 *                             start at that offset in the array. If
 *                             offset is negative, the sequence will
 *                             start that far from the end of the array.
 *                             </p>
 * @param int   $length        [optional] <p>
 *                             If length is given and is positive, then
 *                             the sequence will have that many elements in it. If
 *                             length is given and is negative then the
 *                             sequence will stop that many elements from the end of the
 *                             array. If it is omitted, then the sequence will have everything
 *                             from offset up until the end of the
 *                             array.
 *                             </p>
 * @param bool  $preserve_keys [optional] <p>
 *                             Note that array_slice will reorder and reset the
 *                             array indices by default. You can change this behaviour by setting
 *                             preserve_keys to true.
 *                             </p>
 *
 * @return array the slice.
 * @since 4.0
 * @since 5.0
 */
function array_slice(array $array, $offset, $length = null, $preserve_keys = false) { }

/**
 * Remove a portion of the array and replace it with something else
 *
 * @link  http://php.net/manual/en/function.array-splice.php
 *
 * @param array $input       <p>
 *                           The input array.
 *                           </p>
 * @param int   $offset      <p>
 *                           If offset is positive then the start of removed
 *                           portion is at that offset from the beginning of the
 *                           input array. If offset
 *                           is negative then it starts that far from the end of the
 *                           input array.
 *                           </p>
 * @param int   $length      [optional] <p>
 *                           If length is omitted, removes everything
 *                           from offset to the end of the array. If
 *                           length is specified and is positive, then
 *                           that many elements will be removed. If
 *                           length is specified and is negative then
 *                           the end of the removed portion will be that many elements from
 *                           the end of the array. Tip: to remove everything from
 *                           offset to the end of the array when
 *                           replacement is also specified, use
 *                           count($input) for
 *                           length.
 *                           </p>
 * @param mixed $replacement [optional] <p>
 *                           If replacement array is specified, then the
 *                           removed elements are replaced with elements from this array.
 *                           </p>
 *                           <p>
 *                           If offset and length
 *                           are such that nothing is removed, then the elements from the
 *                           replacement array are inserted in the place
 *                           specified by the offset. Note that keys in
 *                           replacement array are not preserved.
 *                           </p>
 *                           <p>
 *                           If replacement is just one element it is
 *                           not necessary to put array()
 *                           around it, unless the element is an array itself.
 *                           </p>
 *
 * @return array the array consisting of the extracted elements.
 * @since 4.0
 * @since 5.0
 */
function array_splice(array &$input, $offset, $length = null, $replacement = null) { }

/**
 * Calculate the sum of values in an array
 *
 * @link  http://php.net/manual/en/function.array-sum.php
 *
 * @param array $array <p>
 *                     The input array.
 *                     </p>
 *
 * @return int|float the sum of values as an integer or float.
 * @since 4.0.4
 * @since 5.0
 */
function array_sum(array $array) { }

/**
 * Computes the difference of arrays by using a callback function for data comparison
 *
 * @link  http://php.net/manual/en/function.array-udiff.php
 *
 * @param array    $array1            <p>
 *                                    The first array.
 *                                    </p>
 * @param array    $array2            <p>
 *                                    The second array.
 *                                    </p>
 * @param array    $_                 [optional]
 * @param callback $data_compare_func <p>
 *                                    The callback comparison function.
 *                                    </p>
 *                                    <p>
 *                                    The user supplied callback function is used for comparison.
 *                                    It must return an integer less than, equal to, or greater than zero if
 *                                    the first argument is considered to be respectively less than, equal
 *                                    to, or greater than the second.
 *                                    </p>
 *
 * @return array an array containing all the values of array1 that are not present in any of the other arguments.
 * @since 5.0
 */
function array_udiff(array $array1, array $array2, array $_ = null, $data_compare_func) { }

/**
 * Computes the difference of arrays with additional index check, compares data by a callback function
 *
 * @link  http://php.net/manual/en/function.array-udiff-assoc.php
 *
 * @param array    $array1            <p>
 *                                    The first array.
 *                                    </p>
 * @param array    $array2            <p>
 *                                    The second array.
 *                                    </p>
 * @param array    $_                 [optional]
 * @param callback $data_compare_func <p>
 *                                    The callback comparison function.
 *                                    </p>
 *                                    <p>
 *                                    The user supplied callback function is used for comparison.
 *                                    It must return an integer less than, equal to, or greater than zero if
 *                                    the first argument is considered to be respectively less than, equal
 *                                    to, or greater than the second.
 *                                    </p>
 *
 * @return array array_udiff_assoc returns an array containing all the values from array1 that are not present in any
 *               of the other arguments. Note that the keys are used in the comparison unlike array_diff and
 *               array_udiff. The comparison of arrays' data is performed by using an user-supplied callback. In this
 *               aspect the behaviour is opposite to the behaviour of array_diff_assoc which uses internal function for
 *               comparison.
 * @since 5.0
 */
function array_udiff_assoc(array $array1, array $array2, array $_ = null, $data_compare_func) { }

/**
 * Computes the difference of arrays with additional index check, compares data and indexes by a callback function
 *
 * @link  http://php.net/manual/en/function.array-udiff-uassoc.php
 *
 * @param array    $array1            <p>
 *                                    The first array.
 *                                    </p>
 * @param array    $array2            <p>
 *                                    The second array.
 *                                    </p>
 * @param array    $_                 [optional]
 * @param callback $data_compare_func <p>
 *                                    The callback comparison function.
 *                                    </p>
 *                                    <p>
 *                                    The user supplied callback function is used for comparison.
 *                                    It must return an integer less than, equal to, or greater than zero if
 *                                    the first argument is considered to be respectively less than, equal
 *                                    to, or greater than the second.
 *                                    </p>
 *                                    <p>
 *                                    The comparison of arrays' data is performed by using an user-supplied
 *                                    callback : data_compare_func. In this aspect
 *                                    the behaviour is opposite to the behaviour of
 *                                    array_diff_assoc which uses internal function for
 *                                    comparison.
 *                                    </p>
 * @param callback $key_compare_func  <p>
 *                                    The comparison of keys (indices) is done also by the callback function
 *                                    key_compare_func. This behaviour is unlike what
 *                                    array_udiff_assoc does, since the latter compares
 *                                    the indices by using an internal function.
 *                                    </p>
 *
 * @return array an array containing all the values from array1 that are not present in any of the other arguments.
 * @since 5.0
 */
function array_udiff_uassoc(
    array $array1,
    array $array2,
    array $_ = null,
    $data_compare_func,
    $key_compare_func
)
{
}

/**
 * Computes the intersection of arrays, compares data by a callback function
 *
 * @link  http://php.net/manual/en/function.array-uintersect.php
 *
 * @param array    $array1            <p>
 *                                    The first array.
 *                                    </p>
 * @param array    $array2            <p>
 *                                    The second array.
 *                                    </p>
 * @param array    $_                 [optional]
 * @param callback $data_compare_func <p>
 *                                    The callback comparison function.
 *                                    </p>
 *                                    <p>
 *                                    The user supplied callback function is used for comparison.
 *                                    It must return an integer less than, equal to, or greater than zero if
 *                                    the first argument is considered to be respectively less than, equal
 *                                    to, or greater than the second.
 *                                    </p>
 *
 * @return array an array containing all the values of array1 that are present in all the arguments.
 * @since 5.0
 */
function array_uintersect(array $array1, array $array2, array $_ = null, $data_compare_func) { }

/**
 * Computes the intersection of arrays with additional index check, compares data by a callback function
 *
 * @link  http://php.net/manual/en/function.array-uintersect-assoc.php
 *
 * @param array    $array1            <p>
 *                                    The first array.
 *                                    </p>
 * @param array    $array2            <p>
 *                                    The second array.
 *                                    </p>
 * @param array    $_                 [optional]
 * @param callback $data_compare_func <p>
 *                                    For comparison is used the user supplied callback function.
 *                                    It must return an integer less than, equal
 *                                    to, or greater than zero if the first argument is considered to
 *                                    be respectively less than, equal to, or greater than the
 *                                    second.
 *                                    </p>
 *
 * @return array an array containing all the values of array1 that are present in all the arguments.
 * @since 5.0
 */
function array_uintersect_assoc(array $array1, array $array2, array $_ = null, $data_compare_func) { }

/**
 * Computes the intersection of arrays with additional index check, compares data and indexes by a callback
 * functions
 *
 * @link  http://php.net/manual/en/function.array-uintersect-uassoc.php
 *
 * @param array    $array1            <p>
 *                                    The first array.
 *                                    </p>
 * @param array    $array2            <p>
 *                                    The second array.
 *                                    </p>
 * @param array    $_                 [optional]
 * @param callback $data_compare_func <p>
 *                                    For comparison is used the user supplied callback function.
 *                                    It must return an integer less than, equal
 *                                    to, or greater than zero if the first argument is considered to
 *                                    be respectively less than, equal to, or greater than the
 *                                    second.
 *                                    </p>
 * @param callback $key_compare_func  <p>
 *                                    Key comparison callback function.
 *                                    </p>
 *
 * @return array an array containing all the values of array1 that are present in all the arguments.
 * @since 5.0
 */
function array_uintersect_uassoc(
    array $array1,
    array $array2,
    array $_ = null,
    $data_compare_func,
    $key_compare_func
)
{
}

/**
 * Removes duplicate values from an array
 *
 * @link  http://php.net/manual/en/function.array-unique.php
 *
 * @param array $array      <p>
 *                          The input array.
 *                          </p>
 * @param int   $sort_flags [optional] <p>
 *                          The optional second parameter sort_flags
 *                          may be used to modify the sorting behavior using these values:
 *                          </p>
 *                          <p>
 *                          Sorting type flags:
 *                          SORT_REGULAR - compare items normally
 *                          (don't change types)
 *
 * @return array the filtered array.
 * @since 4.0.1
 * @since 5.0
 */
function array_unique(array $array, $sort_flags = null) { }

/**
 * Prepend one or more elements to the beginning of an array
 *
 * @link  http://php.net/manual/en/function.array-unshift.php
 *
 * @param array $array <p>
 *                     The input array.
 *                     </p>
 * @param mixed $var   <p>
 *                     The prepended variable.
 *                     </p>
 * @param mixed $_     [optional]
 *
 * @return int the new number of elements in the array.
 * @since 4.0
 * @since 5.0
 */
function array_unshift(array &$array, $var, $_ = null) { }

/**
 * Return all the values of an array
 *
 * @link  http://php.net/manual/en/function.array-values.php
 *
 * @param array $input <p>
 *                     The array.
 *                     </p>
 *
 * @return array an indexed array of values.
 * @since 4.0
 * @since 5.0
 */
function array_values(array $input) { }

/**
 * Apply a user function to every member of an array
 *
 * @link  http://php.net/manual/en/function.array-walk.php
 *
 * @param array    $array    <p>
 *                           The input array.
 *                           </p>
 * @param callback $funcname <p>
 *                           Typically, funcname takes on two parameters.
 *                           The array parameter's value being the first, and
 *                           the key/index second.
 *                           </p>
 *                           <p>
 *                           If funcname needs to be working with the
 *                           actual values of the array, specify the first parameter of
 *                           funcname as a
 *                           reference. Then,
 *                           any changes made to those elements will be made in the
 *                           original array itself.
 *                           </p>
 *                           <p>
 *                           Users may not change the array itself from the
 *                           callback function. e.g. Add/delete elements, unset elements, etc. If
 *                           the array that array_walk is applied to is
 *                           changed, the behavior of this function is undefined, and unpredictable.
 *                           </p>
 * @param mixed    $userdata [optional] <p>
 *                           If the optional userdata parameter is supplied,
 *                           it will be passed as the third parameter to the callback
 *                           funcname.
 *                           </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function array_walk(array &$array, $funcname, $userdata = null) { }

/**
 * Apply a user function recursively to every member of an array
 *
 * @link  http://php.net/manual/en/function.array-walk-recursive.php
 *
 * @param array    $input    <p>
 *                           The input array.
 *                           </p>
 * @param callback $funcname <p>
 *                           Typically, funcname takes on two parameters.
 *                           The input parameter's value being the first, and
 *                           the key/index second.
 *                           </p>
 *                           <p>
 *                           If funcname needs to be working with the
 *                           actual values of the array, specify the first parameter of
 *                           funcname as a
 *                           reference. Then,
 *                           any changes made to those elements will be made in the
 *                           original array itself.
 *                           </p>
 * @param mixed    $userdata [optional] <p>
 *                           If the optional userdata parameter is supplied,
 *                           it will be passed as the third parameter to the callback
 *                           funcname.
 *                           </p>
 *
 * @return bool true on success or false on failure.
 * @since 5.0
 */
function array_walk_recursive(array &$input, $funcname, $userdata = null) { }

/**
 * Sort an array in reverse order and maintain index association
 *
 * @link  http://php.net/manual/en/function.arsort.php
 *
 * @param array $array      <p>
 *                          The input array.
 *                          </p>
 * @param int   $sort_flags [optional] <p>
 *                          You may modify the behavior of the sort using the optional parameter
 *                          sort_flags, for details see
 *                          sort.
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function arsort(array &$array, $sort_flags = null) { }

/**
 * Sort an array and maintain index association
 *
 * @link  http://php.net/manual/en/function.asort.php
 *
 * @param array $array      <p>
 *                          The input array.
 *                          </p>
 * @param int   $sort_flags [optional] <p>
 *                          You may modify the behavior of the sort using the optional
 *                          parameter sort_flags, for details
 *                          see sort.
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function asort(array &$array, $sort_flags = null) { }

/**
 * Create array containing variables and their values
 *
 * @link  http://php.net/manual/en/function.compact.php
 *
 * @param mixed $varname <p>
 *                       compact takes a variable number of parameters.
 *                       Each parameter can be either a string containing the name of the
 *                       variable, or an array of variable names. The array can contain other
 *                       arrays of variable names inside it; compact
 *                       handles it recursively.
 *                       </p>
 * @param mixed $_       [optional]
 *
 * @return array the output array with all the variables added to it.
 * @since 4.0
 * @since 5.0
 */
function compact($varname, $_ = null) { }

/**
 * Counts all elements in an array, or something in an object.
 * <p>For objects, if you have SPL installed, you can hook into count() by implementing interface {@see Countable}.
 * The interface has exactly one method, {@see Countable::count()}, which returns the return value for the count()
 * function. Please see the {@see Array} section of the manual for a detailed explanation of how arrays are
 * implemented and used in PHP.
 *
 * @link  http://php.net/manual/en/function.count.php
 *
 * @param array|Countable $var  The array or the object.
 * @param int             $mode [optional] If the optional mode parameter is set to
 *                              COUNT_RECURSIVE (or 1), count
 *                              will recursively count the array. This is particularly useful for
 *                              counting all the elements of a multidimensional array. count does not detect
 *                              infinite recursion.
 *
 * @return int the number of elements in var, which is
 * typically an array, since anything else will have one
 * element.
 * </p>
 * <p>
 * If var is not an array or an object with
 * implemented Countable interface,
 * 1 will be returned.
 * There is one exception, if var is &null;,
 * 0 will be returned.
 * </p>
 * <p>
 * Caution: count may return 0 for a variable that isn't set,
 * but it may also return 0 for a variable that has been initialized with an
 * empty array. Use isset to test if a variable is set.
 * @since 4.0
 * @since 5.0
 */
function count($var, $mode = COUNT_NORMAL) { }

/**
 * Return the current element in an array
 *
 * @link  http://php.net/manual/en/function.current.php
 *
 * @param array $array <p>
 *                     The array.
 *                     </p>
 *
 * @return mixed The current function simply returns the
 * value of the array element that's currently being pointed to by the
 * internal pointer. It does not move the pointer in any way. If the
 * internal pointer points beyond the end of the elements list or the array is
 * empty, current returns false.
 * @since 4.0
 * @since 5.0
 */
function current(array &$array) { }

/**
 * Return the current key and value pair from an array and advance the array cursor
 *
 * @link  http://php.net/manual/en/function.each.php
 *
 * @param array $array <p>
 *                     The input array.
 *                     </p>
 *
 * @return array the current key and value pair from the array
 * <i>array</i>. This pair is returned in a four-element
 * array, with the keys 0, 1,
 * key, and value. Elements
 * 0 and key contain the key name of
 * the array element, and 1 and value
 * contain the data.
 * </p>
 * <p>
 * If the internal pointer for the array points past the end of the
 * array contents, <b>each</b> returns
 * false.
 * @since 4.0
 * @since 5.0
 */
function each(array &$array) { }

/**
 * Set the internal pointer of an array to its last element
 *
 * @link  http://php.net/manual/en/function.end.php
 *
 * @param array $array <p>
 *                     The array. This array is passed by reference because it is modified by
 *                     the function. This means you must pass it a real variable and not
 *                     a function returning an array because only actual variables may be
 *                     passed by reference.
 *                     </p>
 *
 * @return mixed the value of the last element or false for empty array.
 * @since 4.0
 * @since 5.0
 */
function end(array &$array) { }

/**
 * Import variables into the current symbol table from an array
 *
 * @link  http://php.net/manual/en/function.extract.php
 *
 * @param array  $var_array    <p>
 *                             Note that prefix is only required if
 *                             extract_type is EXTR_PREFIX_SAME,
 *                             EXTR_PREFIX_ALL, EXTR_PREFIX_INVALID
 *                             or EXTR_PREFIX_IF_EXISTS. If
 *                             the prefixed result is not a valid variable name, it is not
 *                             imported into the symbol table. Prefixes are automatically separated from
 *                             the array key by an underscore character.
 *                             </p>
 * @param int    $extract_type [optional] <p>
 *                             The way invalid/numeric keys and collisions are treated is determined
 *                             by the extract_type. It can be one of the
 *                             following values:
 *                             EXTR_OVERWRITE
 *                             If there is a collision, overwrite the existing variable.
 * @param string $prefix       [optional] Only overwrite the variable if it already exists in the
 *                             current symbol table, otherwise do nothing. This is useful
 *                             for defining a list of valid variables and then extracting
 *                             only those variables you have defined out of
 *                             $_REQUEST, for example.
 *
 * @return int the number of variables successfully imported into the symbol table.
 * @since 4.0
 * @since 5.0
 */
function extract(array $var_array, $extract_type = null, $prefix = null) { }

/**
 * Checks if a value exists in an array
 *
 * @link  http://php.net/manual/en/function.in-array.php
 *
 * @param mixed $needle   <p>
 *                        The searched value.
 *                        </p>
 *                        <p>
 *                        If needle is a string, the comparison is done
 *                        in a case-sensitive manner.
 *                        </p>
 * @param array $haystack <p>
 *                        The array.
 *                        </p>
 * @param bool  $strict   [optional] <p>
 *                        If the third parameter strict is set to true
 *                        then the in_array function will also check the
 *                        types of the
 *                        needle in the haystack.
 *                        </p>
 *
 * @return bool true if needle is found in the array, false otherwise.
 * @since 4.0
 * @since 5.0
 */
function in_array($needle, array $haystack, $strict = false) { }

/**
 * Fetch a key from an array
 *
 * @link  http://php.net/manual/en/function.key.php
 *
 * @param array $array <p>
 *                     The array.
 *                     </p>
 *
 * @return mixed The key function simply returns the key of the array element that's currently being pointed to by the
 *               internal pointer. It does not move the pointer in any way. If the internal pointer points beyond the
 *               end of the elements list or the array is empty, key returns &null;.
 * @since 4.0
 * @since 5.0
 */
function key(array &$array) { }

/**
 * Checks if the given key or index exists in the array. The name of this function is array_key_exists() in PHP >
 * 4.0.6.
 *
 * @link  http://php.net/manual/en/function.array-key-exists.php
 *
 * @param mixed $key    <p>
 *                      Value to check.
 *                      </p>
 * @param array $search <p>
 *                      An array with keys to check.
 *                      </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0.7
 * @since 5.0
 */
function key_exists($key, $search) { }

/**
 * Sort an array by key in reverse order
 *
 * @link  http://php.net/manual/en/function.krsort.php
 *
 * @param array $array      <p>
 *                          The input array.
 *                          </p>
 * @param int   $sort_flags [optional] <p>
 *                          You may modify the behavior of the sort using the optional parameter
 *                          sort_flags, for details see
 *                          sort.
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function krsort(array &$array, $sort_flags = null) { }

/**
 * Sort an array by key
 *
 * @link  http://php.net/manual/en/function.ksort.php
 *
 * @param array $array      <p>
 *                          The input array.
 *                          </p>
 * @param int   $sort_flags [optional] <p>
 *                          You may modify the behavior of the sort using the optional
 *                          parameter sort_flags, for details
 *                          see sort.
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function ksort(array &$array, $sort_flags = null) { }

/**
 * Assigns a list of variables in one operation.
 *
 * @link http://php.net/manual/en/function.list.php
 *
 * @param mixed $var1 <p>A variable.</p>
 * @param mixed $_    [optional] <p>Another variable ...</p>
 *
 * @return array the assigned array.
 */
function PS_UNRESERVE_PREFIX_list($var1, ...$_) { }

/**
 * Sort an array using a case insensitive "natural order" algorithm
 *
 * @link  http://php.net/manual/en/function.natcasesort.php
 *
 * @param array $array <p>
 *                     The input array.
 *                     </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function natcasesort(array &$array) { }

/**
 * Sort an array using a "natural order" algorithm
 *
 * @link  http://php.net/manual/en/function.natsort.php
 *
 * @param array $array <p>
 *                     The input array.
 *                     </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function natsort(array &$array) { }

/**
 * Advance the internal array pointer of an array
 *
 * @link  http://php.net/manual/en/function.next.php
 *
 * @param array $array <p>
 *                     The array being affected.
 *                     </p>
 *
 * @return mixed the array value in the next place that's pointed to by the internal array pointer, or false if there
 *               are no more elements.
 * @since 4.0
 * @since 5.0
 */
function next(array &$array) { }

/**
 * &Alias; <function>current</function>
 *
 * @link  http://php.net/manual/en/function.pos.php
 *
 * @param $arg
 *
 * @since 4.0
 * @since 5.0
 */
function pos(&$arg) { }

/**
 * Rewind the internal array pointer
 *
 * @link  http://php.net/manual/en/function.prev.php
 *
 * @param array $array <p>
 *                     The input array.
 *                     </p>
 *
 * @return mixed the array value in the previous place that's pointed to by the internal array pointer, or false if
 *               there are no more elements.
 * @since 4.0
 * @since 5.0
 */
function prev(array &$array) { }

/**
 * Create an array containing a range of elements
 *
 * @link  http://php.net/manual/en/function.range.php
 *
 * @param mixed  $low  <p>
 *                     Low value.
 *                     </p>
 * @param mixed  $high <p>
 *                     High value.
 *                     </p>
 * @param number $step [optional] <p>
 *                     If a step value is given, it will be used as the
 *                     increment between elements in the sequence. step
 *                     should be given as a positive number. If not specified,
 *                     step will default to 1.
 *                     </p>
 *
 * @return array an array of elements from low to high, inclusive. If low > high, the sequence will be from high to low.
 * @since 4.0
 * @since 5.0
 */
function range($low, $high, $step = null) { }

/**
 * Set the internal pointer of an array to its first element
 *
 * @link  http://php.net/manual/en/function.reset.php
 *
 * @param array $array <p>
 *                     The input array.
 *                     </p>
 *
 * @return mixed the value of the first array element, or false if the array is empty.
 * @since 4.0
 * @since 5.0
 */
function reset(array &$array) { }

/**
 * Sort an array in reverse order
 *
 * @link  http://php.net/manual/en/function.rsort.php
 *
 * @param array $array      <p>
 *                          The input array.
 *                          </p>
 * @param int   $sort_flags [optional] <p>
 *                          You may modify the behavior of the sort using the optional
 *                          parameter sort_flags, for details see
 *                          sort.
 *                          </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function rsort(array &$array, $sort_flags = null) { }

/**
 * Shuffle an array
 *
 * @link  http://php.net/manual/en/function.shuffle.php
 *
 * @param array $array <p>
 *                     The array.
 *                     </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function shuffle(array &$array) { }

/**
 * &Alias; <function>count</function>
 *
 * @link  http://php.net/manual/en/function.sizeof.php
 *
 * @param $var
 * @param $mode [optional]
 *
 * @return int
 * @since 4.0
 * @since 5.0
 */
function sizeof($var, $mode) { }

/**
 * Sort an array
 *
 * @link  http://php.net/manual/en/function.sort.php
 *
 * @param array $array      <p>
 *                          The input array.
 *                          </p>
 * @param int   $sort_flags [optional] <p>
 *                          The optional second parameter sort_flags
 *                          may be used to modify the sorting behavior using these values:
 *                          </p>
 *                          <p>
 *                          Sorting type flags:
 *                          SORT_REGULAR - compare items normally
 *                          (don't change types)
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function sort(array &$array, $sort_flags = null) { }

/**
 * Sort an array with a user-defined comparison function and maintain index association
 *
 * @link  http://php.net/manual/en/function.uasort.php
 *
 * @param array    $array        <p>
 *                               The input array.
 *                               </p>
 * @param callback $cmp_function <p>
 *                               See usort and uksort for
 *                               examples of user-defined comparison functions.
 *                               </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function uasort(array &$array, $cmp_function) { }

/**
 * Sort an array by keys using a user-defined comparison function
 *
 * @link  http://php.net/manual/en/function.uksort.php
 *
 * @param array    $array        <p>
 *                               The input array.
 *                               </p>
 * @param callback $cmp_function <p>
 *                               The callback comparison function.
 *                               </p>
 *                               <p>
 *                               Function cmp_function should accept two
 *                               parameters which will be filled by pairs of array keys.
 *                               The comparison function must return an integer less than, equal
 *                               to, or greater than zero if the first argument is considered to
 *                               be respectively less than, equal to, or greater than the
 *                               second.
 *                               </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function uksort(array &$array, $cmp_function) { }

/**
 * Sort an array by values using a user-defined comparison function
 *
 * @link  http://php.net/manual/en/function.usort.php
 *
 * @param array    $array        <p>
 *                               The input array.
 *                               </p>
 * @param callback $cmp_function <p>
 *                               The comparison function must return an integer less than, equal to, or
 *                               greater than zero if the first argument is considered to be
 *                               respectively less than, equal to, or greater than the second.
 *                               </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function usort(array &$array, $cmp_function) { }
