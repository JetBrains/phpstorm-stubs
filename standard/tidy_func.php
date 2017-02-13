<?php
/**
 * PHPStorm stub file for Tidy functions.
 *
 * @link http://php.net/manual/en/book.tidy.php
 */

/**
 * ob_start callback function to repair the buffer
 *
 * @link  http://php.net/manual/en/function.ob-tidyhandler.php
 *
 * @param string $input <p>
 *                      The buffer.
 *                      </p>
 * @param int    $mode [optional] <p>
 *                      The buffer mode.
 *                      </p>
 *
 * @return string the modified buffer.
 * @since 5.0
 */
function ob_tidyhandler($input, $mode = null) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Returns the Number of Tidy accessibility warnings encountered for specified document
 *
 * @link http://php.net/manual/en/function.tidy-access-count.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return int the number of warnings.
 */
function tidy_access_count(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Execute configured cleanup and repair operations on parsed markup
 *
 * @link http://php.net/manual/en/tidy.cleanrepair.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function tidy_clean_repair(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Returns the Number of Tidy configuration errors encountered for specified document
 *
 * @link http://php.net/manual/en/function.tidy-config-count.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return int the number of errors.
 */
function tidy_config_count(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Run configured diagnostics on parsed and repaired markup
 *
 * @link http://php.net/manual/en/tidy.diagnose.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function tidy_diagnose(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Returns the Number of Tidy errors encountered for specified document
 *
 * @link http://php.net/manual/en/function.tidy-error-count.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return int the number of errors.
 */
function tidy_error_count(tidy $object) { }

/**
 * (PHP 5, PECL tidy 0.5.2-1.0)<br/>
 * Returns a <b>tidyNode</b> object starting from the &lt;body&gt; tag of the tidy parse tree
 *
 * @link http://php.net/manual/en/tidy.body.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return tidyNode a <b>tidyNode</b> object starting from the
 * &lt;body&gt; tag of the tidy parse tree.
 */
function tidy_get_body(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.7.0)<br/>
 * Get current Tidy configuration
 *
 * @link http://php.net/manual/en/tidy.getconfig.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return array an array of configuration options.
 * </p>
 * <p>
 * For an explanation about each option, visit http://tidy.sourceforge.net/docs/quickref.html.
 */
function tidy_get_config(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Return warnings and errors which occurred parsing the specified document
 *
 * @link http://php.net/manual/en/tidy.props.errorbuffer.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return mixed the error buffer as a string.
 */
function tidy_get_error_buffer(tidy $object) { }

/**
 * (PHP 5, PECL tidy 0.5.2-1.0.0)<br/>
 * Returns a <b>tidyNode</b> object starting from the &lt;head&gt; tag of the tidy parse tree
 *
 * @link http://php.net/manual/en/tidy.head.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return tidyNode the <b>tidyNode</b> object.
 */
function tidy_get_head(tidy $object) { }

/**
 * (PHP 5, PECL tidy 0.5.2-1.0.0)<br/>
 * Returns a <b>tidyNode</b> object starting from the &lt;html&gt; tag of the tidy parse tree
 *
 * @link http://php.net/manual/en/tidy.html.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return tidyNode the <b>tidyNode</b> object.
 */
function tidy_get_html(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Get the Detected HTML version for the specified document
 *
 * @link http://php.net/manual/en/tidy.gethtmlver.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return int the detected HTML version.
 * <p>
 * This function is not yet implemented in the Tidylib itself, so it always
 * return 0.
 * </p>
 */
function tidy_get_html_ver(tidy $object) { }

/**
 * Returns the documentation for the given option name
 *
 * @link  http://php.net/manual/en/tidy.getoptdoc.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 * @param string $optname <p>The option name</p>
 *
 * @return string a string if the option exists and has documentation available, or
 * <b>FALSE</b> otherwise.
 * @since 5.1.0
 */
function tidy_get_opt_doc(tidy $object, $optname) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Return a string representing the parsed tidy markup
 *
 * @link http://php.net/manual/en/function.tidy-get-output.php
 *
 * @param tidy $object <p>
 *                     The <b>Tidy</b> object.
 *                     </p>
 *
 * @return string the parsed tidy markup.
 */
function tidy_get_output(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Get release date (version) for Tidy library
 *
 * @link http://php.net/manual/en/tidy.getrelease.php
 * @return string a string with the release date of the Tidy library.
 */
function tidy_get_release() { }

/**
 * (PHP 5, PECL tidy 0.5.2-1.0.0)<br/>
 * Returns a <b>tidyNode</b> object representing the root of the tidy parse tree
 *
 * @link http://php.net/manual/en/tidy.root.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return tidyNode the <b>tidyNode</b> object.
 */
function tidy_get_root(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Get status of specified document
 *
 * @link http://php.net/manual/en/tidy.getstatus.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return int 0 if no error/warning was raised, 1 for warnings or accessibility
 * errors, or 2 for errors.
 */
function tidy_get_status(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Returns the value of the specified configuration option for the tidy document
 *
 * @link http://php.net/manual/en/tidy.getopt.php
 *
 * @param tidy   $object <p>The <b>Tidy</b> object.</p>
 * @param string $option <p>
 *                       You will find a list with each configuration option and their types
 *                       at: http://tidy.sourceforge.net/docs/quickref.html.
 *                       </p>
 *
 * @return mixed the value of the specified <i>option</i>.
 * The return type depends on the type of the specified one.
 */
function tidy_getopt(tidy $object, $option) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Indicates if the document is a XHTML document
 *
 * @link http://php.net/manual/en/tidy.isxhtml.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return bool <p>This function returns <b>TRUE</b> if the specified tidy
 * <i>object</i> is a XHTML document, or <b>FALSE</b> otherwise.
 * </p>
 * <p>
 * This function is not yet implemented in the Tidylib itself, so it always
 * return <b>FALSE</b>.
 * </p>
 */
function tidy_is_xhtml(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Indicates if the document is a generic (non HTML/XHTML) XML document
 *
 * @link http://php.net/manual/en/tidy.isxml.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return bool <p>This function returns <b>TRUE</b> if the specified tidy
 * <i>object</i> is a generic XML document (non HTML/XHTML),
 * or <b>FALSE</b> otherwise.
 * </p>
 * <p>
 * This function is not yet implemented in the Tidylib itself, so it always
 * return <b>FALSE</b>.
 * </p>
 */
function tidy_is_xml(tidy $object) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Parse markup in file or URI
 *
 * @link http://php.net/manual/en/tidy.parsefile.php
 *
 * @param string $filename <p>
 *                                 If the <i>filename</i> parameter is given, this function
 *                                 will also read that file and initialize the object with the file,
 *                                 acting like <b>tidy_parse_file</b>.
 *                                 </p>
 * @param mixed  $config [optional] <p>
 *                                 The config <i>config</i> can be passed either as an
 *                                 array or as a string. If a string is passed, it is interpreted as the
 *                                 name of the configuration file, otherwise, it is interpreted as the
 *                                 options themselves.
 *                                 </p>
 *                                 <p>
 *                                 For an explanation about each option, see
 *                                 http://tidy.sourceforge.net/docs/quickref.html.
 *                                 </p>
 * @param string $encoding [optional] <p>
 *                                 The <i>encoding</i> parameter sets the encoding for
 *                                 input/output documents. The possible values for encoding are:
 *                                 ascii, latin0, latin1,
 *                                 raw, utf8, iso2022,
 *                                 mac, win1252, ibm858,
 *                                 utf16, utf16le, utf16be,
 *                                 big5, and shiftjis.
 *                                 </p>
 * @param bool   $use_include_path [optional] <p>
 *                                 Search for the file in the include_path.
 *                                 </p>
 *
 * @return tidy a new <b>tidy</b> instance.
 */
function tidy_parse_file($filename, $config = null, $encoding = null, $use_include_path = false) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Parse a document stored in a string
 *
 * @link http://php.net/manual/en/tidy.parsestring.php
 *
 * @param string $input <p>
 *                         The data to be parsed.
 *                         </p>
 * @param mixed  $config [optional] <p>
 *                         The config <i>config</i> can be passed either as an
 *                         array or as a string. If a string is passed, it is interpreted as the
 *                         name of the configuration file, otherwise, it is interpreted as the
 *                         options themselves.
 *                         </p>
 *                         <p>
 *                         For an explanation about each option, visit
 *                         http://tidy.sourceforge.net/docs/quickref.html.
 *                         </p>
 * @param string $encoding [optional] <p>
 *                         The <i>encoding</i> parameter sets the encoding for
 *                         input/output documents. The possible values for encoding are:
 *                         ascii, latin0, latin1,
 *                         raw, utf8, iso2022,
 *                         mac, win1252, ibm858,
 *                         utf16, utf16le, utf16be,
 *                         big5, and shiftjis.
 *                         </p>
 *
 * @return tidy a new <b>tidy</b> instance.
 */
function tidy_parse_string($input, $config = null, $encoding = null) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.7.0)<br/>
 * Repair a file and return it as a string
 *
 * @link http://php.net/manual/en/tidy.repairfile.php
 *
 * @param string $filename <p>
 *                                 The file to be repaired.
 *                                 </p>
 * @param mixed  $config [optional] <p>
 *                                 The config <i>config</i> can be passed either as an
 *                                 array or as a string. If a string is passed, it is interpreted as the
 *                                 name of the configuration file, otherwise, it is interpreted as the
 *                                 options themselves.
 *                                 </p>
 *                                 <p>
 *                                 Check http://tidy.sourceforge.net/docs/quickref.html for an
 *                                 explanation about each option.
 *                                 </p>
 * @param string $encoding [optional] <p>
 *                                 The <i>encoding</i> parameter sets the encoding for
 *                                 input/output documents. The possible values for encoding are:
 *                                 ascii, latin0, latin1,
 *                                 raw, utf8, iso2022,
 *                                 mac, win1252, ibm858,
 *                                 utf16, utf16le, utf16be,
 *                                 big5, and shiftjis.
 *                                 </p>
 * @param bool   $use_include_path [optional] <p>
 *                                 Search for the file in the include_path.
 *                                 </p>
 *
 * @return string the repaired contents as a string.
 */
function tidy_repair_file($filename, $config = null, $encoding = null, $use_include_path = false) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.7.0)<br/>
 * Repair a string using an optionally provided configuration file
 *
 * @link http://php.net/manual/en/tidy.repairstring.php
 *
 * @param string $data <p>
 *                         The data to be repaired.
 *                         </p>
 * @param mixed  $config [optional] <p>
 *                         The config <i>config</i> can be passed either as an
 *                         array or as a string. If a string is passed, it is interpreted as the
 *                         name of the configuration file, otherwise, it is interpreted as the
 *                         options themselves.
 *                         </p>
 *                         <p>
 *                         Check http://tidy.sourceforge.net/docs/quickref.html for
 *                         an explanation about each option.
 *                         </p>
 * @param string $encoding [optional] <p>
 *                         The <i>encoding</i> parameter sets the encoding for
 *                         input/output documents. The possible values for encoding are:
 *                         ascii, latin0, latin1,
 *                         raw, utf8, iso2022,
 *                         mac, win1252, ibm858,
 *                         utf16, utf16le, utf16be,
 *                         big5, and shiftjis.
 *                         </p>
 *
 * @return string the repaired string.
 */
function tidy_repair_string($data, $config = null, $encoding = null) { }

/**
 * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
 * Returns the Number of Tidy warnings encountered for specified document
 *
 * @link http://php.net/manual/en/function.tidy-warning-count.php
 *
 * @param tidy $object <p>The <b>Tidy</b> object.</p>
 *
 * @return int the number of warnings.
 */
function tidy_warning_count(tidy $object) { }
