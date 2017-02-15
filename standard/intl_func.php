<?php
/**
 * PHPStorm stub file for Internationalization functions.
 *
 * @link http://php.net/manual/en/book.intl.php
 */

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Sort array maintaining index association
 *
 * @link http://php.net/manual/en/collator.asort.php
 *
 * @param Collator $object
 * @param array    $arr       <p>Array of strings to sort.</p>
 * @param int      $sort_flag [optional] <p>
 *                            Optional sorting type, one of the following:
 *                            <p>
 *                            <b>Collator::SORT_REGULAR</b>
 *                            - compare items normally (don't change types)
 *                            </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_asort(Collator $object, array &$arr, $sort_flag = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Compare two Unicode strings
 *
 * @link http://php.net/manual/en/collator.compare.php
 *
 * @param Collator $object
 * @param string   $str1 <p>
 *                       The first string to compare.
 *                       </p>
 * @param string   $str2 <p>
 *                       The second string to compare.
 *                       </p>
 *
 * @return int Return comparison result:</p>
 * <p>
 * <p>
 * 1 if <i>str1</i> is greater than
 * <i>str2</i> ;
 * </p>
 * <p>
 * 0 if <i>str1</i> is equal to
 * <i>str2</i>;
 * </p>
 * <p>
 * -1 if <i>str1</i> is less than
 * <i>str2</i> .
 * </p>
 * On error
 * boolean
 * <b>FALSE</b>
 * is returned.
 */
function collator_compare(Collator $object, $str1, $str2) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Create a collator
 *
 * @link http://php.net/manual/en/collator.create.php
 *
 * @param string $locale <p>
 *                       The locale containing the required collation rules. Special values for
 *                       locales can be passed in - if null is passed for the locale, the
 *                       default locale collation rules will be used. If empty string ("") or
 *                       "root" are passed, UCA rules will be used.
 *                       </p>
 *
 * @return Collator Return new instance of <b>Collator</b> object, or <b>NULL</b>
 * on error.
 */
function collator_create($locale) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get collation attribute value
 *
 * @link http://php.net/manual/en/collator.getattribute.php
 *
 * @param Collator $object
 * @param int      $attr <p>
 *                       Attribute to get value for.
 *                       </p>
 *
 * @return int Attribute value, or boolean <b>FALSE</b> on error.
 */
function collator_get_attribute(Collator $object, $attr) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get collator's last error code
 *
 * @link http://php.net/manual/en/collator.geterrorcode.php
 *
 * @param Collator $object
 *
 * @return int Error code returned by the last Collator API function call.
 */
function collator_get_error_code(Collator $object) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get text for collator's last error code
 *
 * @link http://php.net/manual/en/collator.geterrormessage.php
 *
 * @param Collator $object
 *
 * @return string Description of an error occurred in the last Collator API function call.
 */
function collator_get_error_message(Collator $object) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the locale name of the collator
 *
 * @link http://php.net/manual/en/collator.getlocale.php
 *
 * @param Collator $object
 * @param int      $type [optional] <p>
 *                       You can choose between valid and actual locale (
 *                       <b>Locale::VALID_LOCALE</b> and
 *                       <b>Locale::ACTUAL_LOCALE</b>,
 *                       respectively). The default is the actual locale.
 *                       </p>
 *
 * @return string Real locale name from which the collation data comes. If the collator was
 * instantiated from rules or an error occurred, returns
 * boolean <b>FALSE</b>.
 */
function collator_get_locale(Collator $object, $type = null) { }

/**
 * (No version information available, might only be in SVN)<br/>
 * Get sorting key for a string
 *
 * @link http://php.net/manual/en/collator.getsortkey.php
 *
 * @param Collator $object
 * @param string   $str <p>
 *                      The string to produce the key from.
 *                      </p>
 *
 * @return string the collation key for the string. Collation keys can be compared directly instead of strings.
 */
function collator_get_sort_key(Collator $object, $str) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get current collation strength
 *
 * @link http://php.net/manual/en/collator.getstrength.php
 *
 * @param Collator $object
 *
 * @return int current collation strength, or boolean <b>FALSE</b> on error.
 */
function collator_get_strength(Collator $object) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set collation attribute
 *
 * @link http://php.net/manual/en/collator.setattribute.php
 *
 * @param Collator $object
 * @param int      $attr <p>Attribute.</p>
 * @param int      $val  <p>
 *                       Attribute value.
 *                       </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_set_attribute(Collator $object, $attr, $val) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set collation strength
 *
 * @link http://php.net/manual/en/collator.setstrength.php
 *
 * @param Collator $object
 * @param int      $strength <p>Strength to set.</p>
 *                           <p>
 *                           Possible values are:
 *                           <p>
 *                           <b>Collator::PRIMARY</b>
 *                           </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_set_strength(Collator $object, $strength) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Sort array using specified collator
 *
 * @link http://php.net/manual/en/collator.sort.php
 *
 * @param Collator $object
 * @param array    $arr       <p>
 *                            Array of strings to sort.
 *                            </p>
 * @param int      $sort_flag [optional] <p>
 *                            Optional sorting type, one of the following:
 *                            </p>
 *                            <p>
 *                            <p>
 *                            <b>Collator::SORT_REGULAR</b>
 *                            - compare items normally (don't change types)
 *                            </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_sort(Collator $object, array &$arr, $sort_flag = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Sort array using specified collator and sort keys
 *
 * @link http://php.net/manual/en/collator.sortwithsortkeys.php
 *
 * @param Collator $object
 * @param array    $arr <p>Array of strings to sort</p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_sort_with_sort_keys(Collator $object, array &$arr) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Create a date formatter
 *
 * @link http://php.net/manual/en/intldateformatter.create.php
 *
 * @param string $locale   <p>
 *                         Locale to use when formatting or parsing.
 *                         </p>
 * @param int    $datetype <p>
 *                         Date type to use (<b>none</b>,
 *                         <b>short</b>, <b>medium</b>,
 *                         <b>long</b>, <b>full</b>).
 *                         This is one of the
 *                         IntlDateFormatter constants.
 *                         </p>
 * @param int    $timetype <p>
 *                         Time type to use (<b>none</b>,
 *                         <b>short</b>, <b>medium</b>,
 *                         <b>long</b>, <b>full</b>).
 *                         This is one of the
 *                         IntlDateFormatter constants.
 *                         </p>
 * @param string $timezone [optional] <p>
 *                         Time zone ID, default is system default.
 *                         </p>
 * @param int    $calendar [optional] <p>
 *                         Calendar to use for formatting or parsing; default is Gregorian.
 *                         This is one of the
 *                         IntlDateFormatter calendar constants.
 *                         </p>
 * @param string $pattern  [optional] <p>
 *                         Optional pattern to use when formatting or parsing.
 *                         Possible patterns are documented at
 *                         http://userguide.icu-project.org/formatparse/datetime.
 *                         </p>
 *
 * @return IntlDateFormatter
 */
function datefmt_create($locale, $datetype, $timetype, $timezone = null, $calendar = null, $pattern = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Format the date/time value as a string
 *
 * @link http://php.net/manual/en/intldateformatter.format.php
 *
 * @param MessageFormatter $mf
 * @param mixed            $value <p>
 *                                Value to format. This may be a <b>DateTime</b> object,
 *                                an integer representing a Unix timestamp value (seconds
 *                                since epoch, UTC) or an array in the format output by
 *                                <b>localtime</b>.
 *                                </p>
 *
 * @return string The formatted string or, if an error occurred, <b>FALSE</b>.
 */
function datefmt_format(MessageFormatter $mf, $value) { }

/**
 * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
 * Formats an object
 *
 * @link http://www.php.net/manual/en/intldateformatter.formatobject.php
 *
 * @param IntlCalendar|DateTime $object <p>
 *                       An object of type IntlCalendar or DateTime. The timezone information in the object will be
 *                       used.
 *                       </p>
 * @param mixed  $format [optional] <p>
 *                       How to format the date/time. This can either be an
 *                       {http://www.php.net/manual/en/language.types.array.php array}  with two elements (first
 *                       the date style, then the time style, these being one of the constants
 *                       <b>IntlDateFormatter::NONE</b>,
 *                       <b>IntlDateFormatter::SHORT</b>,
 *                       <b>IntlDateFormatter::MEDIUM</b>,
 *                       <b>IntlDateFormatter::LONG</b>,
 *                       <b>IntlDateFormatter::FULL</b>), a long with
 *                       the value of one of these constants (in which case it will be used both
 *                       for the time and the date) or a {@link
 *                       http://www.php.net/manual/en/language.types.string.php} with the format described in
 *                       {@link http://www.icu-project.org/apiref/icu4c/classSimpleDateFormat.html#details the ICU
 *                       documentation} documentation. If <b>NULL</b>, the default style will be used.
 *                       </p>
 * @param string $locale [optional] <p>
 *                       The locale to use, or NULL to use the default one.</p>
 *
 * @return string The formatted string or, if an error occurred, <b>FALSE</b>.
 */
function datefmt_format_object($object, $format = null, $locale = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the calendar used for the IntlDateFormatter
 *
 * @link http://php.net/manual/en/intldateformatter.getcalendar.php
 *
 * @param $mf
 *
 * @return int The calendar being used by the formatter.
 */
function datefmt_get_calendar(MessageFormatter $mf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 3.0.0)<br/>
 * Get copy of formatter's calendar object
 *
 * @link http://www.php.net/manual/en/intldateformatter.getcalendarobject.php
 * @return IntlCalendar A copy of the internal calendar object used by this formatter.
 */
function datefmt_get_calendar_object() { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the datetype used for the IntlDateFormatter
 *
 * @link http://php.net/manual/en/intldateformatter.getdatetype.php
 *
 * @param $mf
 *
 * @return int The current date type value of the formatter.
 */
function datefmt_get_datetype(MessageFormatter $mf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the error code from last operation
 *
 * @link http://php.net/manual/en/intldateformatter.geterrorcode.php
 *
 * @param MessageFormatter $mf
 *
 * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
 */
function datefmt_get_error_code(MessageFormatter $mf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the error text from the last operation.
 *
 * @link http://php.net/manual/en/intldateformatter.geterrormessage.php
 *
 * @param MessageFormatter $mf
 * @param                  $coll
 *
 * @return string Description of the last error.
 */
function datefmt_get_error_message(MessageFormatter $mf, $coll) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the locale used by formatter
 *
 * @link http://php.net/manual/en/intldateformatter.getlocale.php
 *
 * @param MessageFormatter $mf
 * @param int              $which [optional]
 *
 * @return string the locale of this formatter or 'false' if error
 */
function datefmt_get_locale(MessageFormatter $mf, $which = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the pattern used for the IntlDateFormatter
 *
 * @link http://php.net/manual/en/intldateformatter.getpattern.php
 *
 * @param $mf
 *
 * @return string The pattern string being used to format/parse.
 */
function datefmt_get_pattern(MessageFormatter $mf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the timetype used for the IntlDateFormatter
 *
 * @link http://php.net/manual/en/intldateformatter.gettimetype.php
 *
 * @param $mf
 *
 * @return int The current date type value of the formatter.
 */
function datefmt_get_timetype(MessageFormatter $mf) { }

/**
 * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
 *  Get formatter's timezone
 *
 * @link http://www.php.net/manual/en/intldateformatter.gettimezone.php
 * @return IntlTimeZone|bool The associated IntlTimeZone object or FALSE on failure.
 */
function datefmt_get_timezone() { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the timezone-id used for the IntlDateFormatter
 *
 * @link http://php.net/manual/en/intldateformatter.gettimezoneid.php
 *
 * @param $mf
 *
 * @return string ID string for the time zone used by this formatter.
 */
function datefmt_get_timezone_id(MessageFormatter $mf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the lenient used for the IntlDateFormatter
 *
 * @link http://php.net/manual/en/intldateformatter.islenient.php
 *
 * @param $mf
 *
 * @return bool <b>TRUE</b> if parser is lenient, <b>FALSE</b> if parser is strict. By default the parser is
 *              lenient.
 */
function datefmt_is_lenient(MessageFormatter $mf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse string to a field-based time value
 *
 * @link http://php.net/manual/en/intldateformatter.localtime.php
 *
 * @param MessageFormatter $mf
 * @param string           $value    <p>
 *                                   string to convert to a time
 *                                   </p>
 * @param int              $position [optional] <p>
 *                                   Position at which to start the parsing in $value (zero-based).
 *                                   If no error occurs before $value is consumed, $parse_pos will contain -1
 *                                   otherwise it will contain the position at which parsing ended .
 *                                   If $parse_pos > strlen($value), the parse fails immediately.
 *                                   </p>
 *
 * @return array Localtime compatible array of integers : contains 24 hour clock value in tm_hour field
 */
function datefmt_localtime(MessageFormatter $mf, $value, &$position = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse string to a timestamp value
 *
 * @link http://php.net/manual/en/intldateformatter.parse.php
 *
 * @param MessageFormatter $mf
 * @param string           $value    <p>
 *                                   string to convert to a time
 *                                   </p>
 * @param int              $position [optional] <p>
 *                                   Position at which to start the parsing in $value (zero-based).
 *                                   If no error occurs before $value is consumed, $parse_pos will contain -1
 *                                   otherwise it will contain the position at which parsing ended (and the error
 *                                   occurred). This variable will contain the end position if the parse fails. If
 *                                   $parse_pos > strlen($value), the parse fails immediately.
 *                                   </p>
 *
 * @return int timestamp parsed value
 */
function datefmt_parse(MessageFormatter $mf, $value, &$position = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * sets the calendar used to the appropriate calendar, which must be
 *
 * @link http://php.net/manual/en/intldateformatter.setcalendar.php
 *
 * @param MessageFormatter $mf
 * @param int              $which <p>
 *                                The calendar to use.
 *                                Default is <b>IntlDateFormatter::GREGORIAN</b>.
 *                                </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function datefmt_set_calendar(MessageFormatter $mf, $which) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set the leniency of the parser
 *
 * @link http://php.net/manual/en/intldateformatter.setlenient.php
 *
 * @param MessageFormatter $mf
 * @param bool             $lenient <p>
 *                                  Sets whether the parser is lenient or not, default is <b>TRUE</b> (lenient).
 *                                  </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function datefmt_set_lenient(MessageFormatter $mf, $lenient) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set the pattern used for the IntlDateFormatter
 *
 * @link http://php.net/manual/en/intldateformatter.setpattern.php
 *
 * @param MessageFormatter $mf
 * @param string           $pattern <p>
 *                                  New pattern string to use.
 *                                  Possible patterns are documented at
 *                                  http://userguide.icu-project.org/formatparse/datetime.
 *                                  </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * Bad formatstrings are usually the cause of the failure.
 */
function datefmt_set_pattern(MessageFormatter $mf, $pattern) { }

/**
 * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
 * Sets formatter's timezone
 *
 * @link http://php.net/manual/en/intldateformatter.settimezone.php
 *
 * @param mixed $zone <p>
 *                    The timezone to use for this formatter. This can be specified in the
 *                    following forms:
 *                    <ul>
 *                    <li>
 *                    <p>
 *                    <b>NULL</b>, in which case the default timezone will be used, as specified in
 *                    the ini setting {@link
 *                    "http://php.net/manual/en/datetime.configuration.php#ini.date.timezone" date.timezone} or
 *                    through the function  {@link
 *                    "http://php.net/manual/en/function.date-default-timezone-set.php"
 *                    date_default_timezone_set()} and as returned by {@link
 *                    "http://php.net/manual/en/function.date-default-timezone-get.php"
 *                    date_default_timezone_get()}.
 *                    </p>
 *                    </li>
 *                    <li>
 *                    <p>
 *                    An {@link "http://php.net/manual/en/class.intltimezone.php" IntlTimeZone}, which will be used
 *                    directly.
 *                    </p>
 *                    </li>
 *                    <li>
 *                    <p>
 *                    A {@link "http://php.net/manual/en/class.datetimezone.php" DateTimeZone}. Its identifier will
 *                    be extracted and an ICU timezone object will be created; the timezone will be backed by ICU's
 *                    database, not PHP's.
 *                    </p>
 *                    </li>
 *                    <li>
 *                    <p>
 *                    A {@link "http://php.net/manual/en/language.types.string.php" string}, which should be a
 *                    valid ICU timezone identifier. See <b>IntlTimeZone::createTimeZoneIDEnumeration()</b>. Raw
 *                    offsets such as <em>"GMT+08:30"</em> are also accepted.
 *                    </p>
 *                    </li>
 *                    </ul>
 *                    </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function datefmt_set_timezone($zone) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Sets the time zone to use
 *
 * @link       http://php.net/manual/en/intldateformatter.settimezoneid.php
 *
 * @param MessageFormatter $mf
 * @param string           $zone <p>
 *                               The time zone ID string of the time zone to use.
 *                               If <b>NULL</b> or the empty string, the default time zone for the runtime is used.
 *                               </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @deprecated 5.5 http://www.php.net/manual/en/migration55.deprecated.php
 */
function datefmt_set_timezone_id(MessageFormatter $mf, $zone) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Function to extract a sequence of default grapheme clusters from a text buffer, which must be encoded in UTF-8.
 *
 * @link http://php.net/manual/en/function.grapheme-extract.php
 *
 * @param string $haystack     <p>
 *                             String to search.
 *                             </p>
 * @param int    $size         <p>
 *                             Maximum number items - based on the $extract_type - to return.
 *                             </p>
 * @param int    $extract_type [optional] <p>
 *                             Defines the type of units referred to by the $size parameter:
 *                             </p>
 *                             <p>
 *                             GRAPHEME_EXTR_COUNT (default) - $size is the number of default
 *                             grapheme clusters to extract.
 *                             GRAPHEME_EXTR_MAXBYTES - $size is the maximum number of bytes
 *                             returned.
 *                             GRAPHEME_EXTR_MAXCHARS - $size is the maximum number of UTF-8
 *                             characters returned.
 *                             </p>
 * @param int    $start        [optional] <p>
 *                             Starting position in $haystack in bytes - if given, it must be zero or a
 *                             positive value that is less than or equal to the length of $haystack in
 *                             bytes. If $start does not point to the first byte of a UTF-8
 *                             character, the start position is moved to the next character boundary.
 *                             </p>
 * @param int    $next         [optional] <p>
 *                             Reference to a value that will be set to the next starting position.
 *                             When the call returns, this may point to the first byte position past the end of the
 *                             string.
 *                             </p>
 *
 * @return string A string starting at offset $start and ending on a default grapheme cluster
 * boundary that conforms to the $size and $extract_type specified.
 */
function grapheme_extract($haystack, $size, $extract_type = null, $start = 0, &$next = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Find position (in grapheme units) of first occurrence of a case-insensitive string
 *
 * @link http://php.net/manual/en/function.grapheme-stripos.php
 *
 * @param string $haystack <p>
 *                         The string to look in. Must be valid UTF-8.
 *                         </p>
 * @param string $needle   <p>
 *                         The string to look for. Must be valid UTF-8.
 *                         </p>
 * @param int    $offset   [optional] <p>
 *                         The optional $offset parameter allows you to specify where in haystack to
 *                         start searching as an offset in grapheme units (not bytes or characters).
 *                         The position returned is still relative to the beginning of haystack
 *                         regardless of the value of $offset.
 *                         </p>
 *
 * @return int the position as an integer. If needle is not found, grapheme_stripos() will return boolean FALSE.
 */
function grapheme_stripos($haystack, $needle, $offset = 0) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns part of haystack string from the first occurrence of case-insensitive needle to the end of haystack.
 *
 * @link http://php.net/manual/en/function.grapheme-stristr.php
 *
 * @param string $haystack      <p>
 *                              The input string. Must be valid UTF-8.
 *                              </p>
 * @param string $needle        <p>
 *                              The string to look for. Must be valid UTF-8.
 *                              </p>
 * @param bool   $before_needle [optional] <p>
 *                              If <b>TRUE</b>, grapheme_strstr() returns the part of the
 *                              haystack before the first occurrence of the needle (excluding needle).
 *                              </p>
 *
 * @return string the portion of $haystack, or FALSE if $needle is not found.
 */
function grapheme_stristr($haystack, $needle, $before_needle = false) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get string length in grapheme units
 *
 * @link http://php.net/manual/en/function.grapheme-strlen.php
 *
 * @param string $input <p>
 *                      The string being measured for length. It must be a valid UTF-8 string.
 *                      </p>
 *
 * @return int The length of the string on success, and 0 if the string is empty.
 */
function grapheme_strlen($input) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Find position (in grapheme units) of first occurrence of a string
 *
 * @link http://php.net/manual/en/function.grapheme-strpos.php
 *
 * @param string $haystack <p>
 *                         The string to look in. Must be valid UTF-8.
 *                         </p>
 * @param string $needle   <p>
 *                         The string to look for. Must be valid UTF-8.
 *                         </p>
 * @param int    $offset   [optional] <p>
 *                         The optional $offset parameter allows you to specify where in $haystack to
 *                         start searching as an offset in grapheme units (not bytes or characters).
 *                         The position returned is still relative to the beginning of haystack
 *                         regardless of the value of $offset.
 *                         </p>
 *
 * @return int the position as an integer. If needle is not found, strpos() will return boolean FALSE.
 */
function grapheme_strpos($haystack, $needle, $offset = 0) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Find position (in grapheme units) of last occurrence of a case-insensitive string
 *
 * @link http://php.net/manual/en/function.grapheme-strripos.php
 *
 * @param string $haystack <p>
 *                         The string to look in. Must be valid UTF-8.
 *                         </p>
 * @param string $needle   <p>
 *                         The string to look for. Must be valid UTF-8.
 *                         </p>
 * @param int    $offset   [optional] <p>
 *                         The optional $offset parameter allows you to specify where in $haystack to
 *                         start searching as an offset in grapheme units (not bytes or characters).
 *                         The position returned is still relative to the beginning of haystack
 *                         regardless of the value of $offset.
 *                         </p>
 *
 * @return int the position as an integer. If needle is not found, grapheme_strripos() will return boolean FALSE.
 */
function grapheme_strripos($haystack, $needle, $offset = 0) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Find position (in grapheme units) of last occurrence of a string
 *
 * @link http://php.net/manual/en/function.grapheme-strrpos.php
 *
 * @param string $haystack <p>
 *                         The string to look in. Must be valid UTF-8.
 *                         </p>
 * @param string $needle   <p>
 *                         The string to look for. Must be valid UTF-8.
 *                         </p>
 * @param int    $offset   [optional] <p>
 *                         The optional $offset parameter allows you to specify where in $haystack to
 *                         start searching as an offset in grapheme units (not bytes or characters).
 *                         The position returned is still relative to the beginning of haystack
 *                         regardless of the value of $offset.
 *                         </p>
 *
 * @return int the position as an integer. If needle is not found, grapheme_strrpos() will return boolean FALSE.
 */
function grapheme_strrpos($haystack, $needle, $offset = 0) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns part of haystack string from the first occurrence of needle to the end of haystack.
 *
 * @link http://php.net/manual/en/function.grapheme-strstr.php
 *
 * @param string $haystack      <p>
 *                              The input string. Must be valid UTF-8.
 *                              </p>
 * @param string $needle        <p>
 *                              The string to look for. Must be valid UTF-8.
 *                              </p>
 * @param bool   $before_needle [optional] <p>
 *                              If <b>TRUE</b>, grapheme_strstr() returns the part of the
 *                              haystack before the first occurrence of the needle (excluding the needle).
 *                              </p>
 *
 * @return string the portion of string, or FALSE if needle is not found.
 */
function grapheme_strstr($haystack, $needle, $before_needle = false) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Return part of a string
 *
 * @link http://php.net/manual/en/function.grapheme-substr.php
 *
 * @param string $string <p>
 *                       The input string. Must be valid UTF-8.
 *                       </p>
 * @param int    $start  <p>
 *                       Start position in default grapheme units.
 *                       If $start is non-negative, the returned string will start at the
 *                       $start'th position in $string, counting from zero. If $start is negative,
 *                       the returned string will start at the $start'th grapheme unit from the
 *                       end of string.
 *                       </p>
 * @param int    $length [optional] <p>
 *                       Length in grapheme units.
 *                       If $length is given and is positive, the string returned will contain
 *                       at most $length grapheme units beginning from $start (depending on the
 *                       length of string). If $length is given and is negative, then
 *                       that many grapheme units will be omitted from the end of string (after the
 *                       start position has been calculated when a start is negative). If $start
 *                       denotes a position beyond this truncation, <b>FALSE</b> will be returned.
 *                       </p>
 *
 * @return int the extracted part of $string.
 */
function grapheme_substr($string, $start, $length = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PHP 7, PECL intl &gt;= 1.0.2, PHP 7, PECL idn &gt;= 0.1)<br/>
 * Convert domain name to IDNA ASCII form.
 *
 * @link http://php.net/manual/en/function.idn-to-ascii.php
 *
 * @param string $domain    <p>
 *                          Domain to convert. In PHP 5 must be UTF-8 encoded.
 *                          If e.g. an ISO-8859-1 (aka Western Europe latin1) encoded string is
 *                          passed it will be converted into an ACE encoded "xn--" string.
 *                          It will not be the one you expected though!
 *                          </p>
 * @param int    $options   [optional] <p>
 *                          Conversion options - combination of IDNA_* constants (except IDNA_ERROR_* constants).
 *                          </p>
 * @param int    $variant   [optional] <p>
 *                          Either INTL_IDNA_VARIANT_2003 for IDNA 2003 or INTL_IDNA_VARIANT_UTS46 for UTS #46.
 *                          </p>
 * @param array  $idna_info [optional] <p>
 *                          This parameter can be used only if INTL_IDNA_VARIANT_UTS46 was used for variant.
 *                          In that case, it will be filled with an array with the keys 'result',
 *                          the possibly illegal result of the transformation, 'isTransitionalDifferent',
 *                          a boolean indicating whether the usage of the transitional mechanisms of UTS #46
 *                          either has or would have changed the result and 'errors',
 *                          which is an int representing a bitset of the error constants IDNA_ERROR_*.
 *                          </p>
 *
 * @return string The ACE encoded version of the domain name or <b>FALSE</b> on failure.
 */
function idn_to_ascii($domain, $options = 0, $variant = INTL_IDNA_VARIANT_2003, array &$idna_info) { }

/**
 * (PHP 5 &gt;= 5.3.0, PHP 7, PECL intl &gt;= 1.0.2, PHP 7, PECL idn &gt;= 0.1)<br/>
 * Convert domain name from IDNA ASCII to Unicode.
 *
 * @link http://php.net/manual/en/function.idn-to-utf8.php
 *
 * @param string $domain     <p>
 *                           Domain to convert in IDNA ASCII-compatible format.
 *                           The ASCII encoded domain name. Looks like "xn--..." if the it originally contained
 *                           non-ASCII characters.
 *                           </p>
 * @param int    $options    [optional] <p>
 *                           Conversion options - combination of IDNA_* constants (except IDNA_ERROR_* constants).
 *                           </p>
 * @param int    $variant    [optional] <p>
 *                           Either INTL_IDNA_VARIANT_2003 for IDNA 2003 or INTL_IDNA_VARIANT_UTS46 for UTS #46.
 *                           </p>
 * @param array    &$idna_info [optional] <p>
 *                           This parameter can be used only if INTL_IDNA_VARIANT_UTS46 was used for variant.
 *                           In that case, it will be filled with an array with the keys 'result',
 *                           the possibly illegal result of the transformation, 'isTransitionalDifferent',
 *                           a boolean indicating whether the usage of the transitional mechanisms of UTS #46
 *                           either has or would have changed the result and 'errors',
 *                           which is an int representing a bitset of the error constants IDNA_ERROR_*.
 *                           </p>
 *
 * @return string|false The UTF-8 encoded version of the domain name or <b>FALSE</b> on failure.
 * RFC 3490 4.2 states though "ToUnicode never fails. If any step fails, then the original input
 * sequence is returned immediately in that step."
 */
function idn_to_utf8($domain, $options = 0, $variant = INTL_IDNA_VARIANT_2003, array &$idna_info) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the global maximum value for a field
 *
 * @link http://www.php.net/manual/en/intlcalendar.getmaximum.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link www.php.net/manual/en/class.intlcalendar.php IntlCalendar}
 *                               date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 *
 * @return string
 * A locale string or <b>FALSE</b> on failure.
 */
function intcal_get_maximum($calendar, $field) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get symbolic name for a given error code
 *
 * @link http://php.net/manual/en/function.intl-error-name.php
 *
 * @param int $error_code <p>
 *                        ICU error code.
 *                        </p>
 *
 * @return string The returned string will be the same as the name of the error code
 * constant.
 */
function intl_error_name($error_code) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the value for a field
 *
 * @link http://www.php.net/manual/en/intlcalendar.get.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 *
 * @return int An integer with the value of the time field.
 */
function intl_get($calendar, $field) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the last error code
 *
 * @link http://php.net/manual/en/function.intl-get-error-code.php
 * @return int Error code returned by the last API function call.
 */
function intl_get_error_code() { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get description of the last error
 *
 * @link http://php.net/manual/en/function.intl-get-error-message.php
 * @return string Description of an error occurred in the last API function call.
 */
function intl_get_error_message() { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Check whether the given error code indicates failure
 *
 * @link http://php.net/manual/en/function.intl-is-failure.php
 *
 * @param int $error_code <p>
 *                        is a value that returned by functions:
 *                        <b>intl_get_error_code</b>,
 *                        <b>collator_get_error_code</b> .
 *                        </p>
 *
 * @return bool <b>TRUE</b> if it the code indicates some failure, and <b>FALSE</b>
 * in case of success or a warning.
 */
function intl_is_failure($error_code) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Add a (signed) amount of time to a field
 *
 * @link http://www.php.net/manual/en/intlcalendar.add.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 * @param int          $amount   <p>The signed amount to add to the current field. If the amount is positive, the
 *                               instant will be moved forward; if it is negative, the instant wil be moved into
 *                               the past. The unit is implicit to the field type. For instance, hours for
 *                               IntlCalendar::FIELD_HOUR_OF_DAY.</p>
 *
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function intlcal_add($calendar, $field, $amount) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Whether this object's time is after that of the passed object
 * http://www.php.net/manual/en/intlcalendar.after.php
 *
 * @param IntlCalendar $calendarObject <p>
 *                                     The calendar object, on the procedural style interface.
 *                                     </p>
 * @param IntlCalendar $calendar       <p>The calendar whose time will be checked against this object's time.</p>
 *
 * @return bool
 * Returns <b>TRUE</b> if this object's current time is after that of the
 * <em>calendar</em> argument's time. Returns <b>FALSE</b> otherwise.
 * Also returns <b>FALSE</b> on failure. You can use {@link
 * http://www.php.net/manual/en/intl.configuration.php#ini.intl.use-exceptions exceptions} or
 * {@link http://www.php.net/manual/en/function.intl-get-error-code.php intl_get_error_code()} to detect error
 * conditions.
 */
function intlcal_after(IntlCalendar $calendarObject, IntlCalendar $calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Whether this object's time is before that of the passed object
 *
 * @link http://www.php.net/manual/en/intlcalendar.before.php
 *
 * @param IntlCalendar $calendarObject <p>
 *                                     The calendar object, on the procedural style interface.
 *                                     </p>
 * @param IntlCalendar $calendar       <p> The calendar whose time will be checked against this object's time.</p>
 *
 * @return bool
 * Returns <b>TRUE</B> if this object's current time is before that of the
 * <em>calendar</em> argument's time. Returns <b>FALSE</b> otherwise.
 * Also returns <b>FALSE</b> on failure. You can use {@link
 * http://www.php.net/manual/en/intl.configuration.php#ini.intl.use-exceptions exceptions} or
 * {@link http://www.php.net/manual/en/function.intl-get-error-code.php intl_get_error_code()} to detect error
 * conditions.
 * </p>
 */
function intlcal_before(IntlCalendar $calendarObject, IntlCalendar $calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Clear a field or all fields
 *
 * @link http://www.php.net/manual/en/intlcalendar.clear.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    [optional] <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 *
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure. Failure can only occur is invalid
 *              arguments are provided.
 */
function intlcal_clear($calendar, $field = null) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Create a new IntlCalendar
 *
 * @link http://www.php.net/manual/en/intlcalendar.createinstance.php
 *
 * @param mixed  $timeZone [optional] <p> <p>
 *                         The timezone to use.
 *                         </p>
 *
 * <ul>
 * <li>
 * <p>
 * <b>NULL</b>, in which case the default timezone will be used, as specified in
 * the ini setting {@link http://www.php.net/manual/en/datetime.configuration.php#ini.date.timezone date.timezone}
 * or through the function  {@link http://www.php.net/manual/en/function.date-default-timezone-set.php
 * date_default_timezone_set()} and as returned by {@link
 * http://www.php.net/manual/en/function.date-default-timezone-get.php date_default_timezone_get()}.
 * </p>
 * </li>
 * <li>
 * <p>
 * An {@link http://www.php.net/manual/en/class.intltimezone.php IntlTimeZone}, which will be used directly.
 * </p>
 * </li>
 * <li>
 * <p>
 * A {@link http://www.php.net/manual/en/class.datetimezone.php DateTimeZone}. Its identifier will be extracted
 * and an ICU timezone object will be created; the timezone will be backed
 * by ICU's database, not PHP's.
 * </p>
 * </li>
 * <li>
 * <p>
 * A {@link http://www.php.net/manual/en/language.types.string.php string}, which should be a valid ICU timezone
 * identifier. See  <b>IntlTimeZone::createTimeZoneIDEnumeration()</b>. Raw offsets such as <em>"GMT+08:30"</em>
 * are also accepted.
 * </p>
 * </li>
 * </ul>
 * </p>
 * @param string $locale   [optional] <p>
 *                         A locale to use or <b>NULL</b> to use {@link
 *                         http://www.php.net/manual/en/intl.configuration.php#ini.intl.default-locale the default
 *                         locale}.
 *                         </p>
 *
 * @return IntlCalendar
 * The created {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} instance or <b>NULL</b> on
 * failure.
 */
function intlcal_create_instance($timeZone = null, $locale = null) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Compare time of two IntlCalendar objects for equality
 *
 * @link http://www.php.net/manual/en/intlcalendar.equals.php
 *
 * @param IntlCalendar $calendarObject <p>
 *                                     The calendar object, on the procedural style interface.
 *                                     </p>
 * @param IntlCalendar $calendar
 *
 * @return bool <p>
 * Returns <b>TRUE</b> if the current time of both this and the passed in
 * {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} object are the same, or <b>FALSE</b>
 * otherwise. The value <b>FALSE</b> can also be returned on failure. This can only
 * happen if bad arguments are passed in. In any case, the two cases can be
 * distinguished by calling  {@link http://www.php.net/manual/en/function.intl-get-error-code.php
 * intl_get_error_code()}.
 * </p>
 */
function intlcal_equals($calendarObject, $calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Calculate difference between given time and this object's time
 *
 * @link http://www.php.net/manual/en/intlcalendar.fielddifference.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param float        $when     <p>
 *                               The time against which to compare the quantity represented by the
 *                               <em>field</em>. For the result to be positive, the time
 *                               given for this parameter must be ahead of the time of the object the
 *                               method is being invoked on.
 *                               </p>
 * @param int          $field    <p>
 *                               The field that represents the quantity being compared.
 *                               </p>
 *
 * <p>
 * One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time {@link
 * http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field constants}. These are integer
 * values between <em>0</em> and
 * <b>IntlCalendar::FIELD_COUNT</b>.
 * </p>
 *
 * @return int Returns a (signed) difference of time in the unit associated with the
 * specified field or <b>FALSE</b> on failure.
 *
 */
function intlcal_field_difference($calendar, $when, $field) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a2)<br/>
 * Create an IntlCalendar from a DateTime object or string
 *
 * @link http://www.php.net/manual/en/intlcalendar.fromdatetime.php
 *
 * @param mixed $dateTime <p>
 *                        A {@link http://www.php.net/manual/en/class.datetime.php DateTime} object or a {@link
 *                        http://www.php.net/manual/en/language.types.string.php string} that can be passed to
 *                        {@link http://www.php.net/manual/en/datetime.construct.php DateTime::__construct()}.
 *                        </p>
 *
 * @return IntlCalendar
 * The created {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} object or <b>NULL</b> in
 * case of failure. If a {@link http://www.php.net/manual/en/language.types.string.php string} is passed, any
 * exception that occurs inside the {@link http://www.php.net/manual/en/class.datetime.php DateTime} constructor is
 * propagated.
 */
function intlcal_from_date_time($dateTime) { }

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get data from the bundle
 *
 * @link http://php.net/manual/en/resourcebundle.get.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param string|int   $index    <p>
 *                               Data index, must be string or integer.
 *                               </p>
 *
 * @return mixed the data located at the index or <b>NULL</b> on error. Strings, integers and binary data strings
 * are returned as corresponding PHP types, integer array is returned as PHP array. Complex types are
 * returned as <b>ResourceBundle</b> object.
 */
function intlcal_get($calendar, $index) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * The maximum value for a field, considering the object's current time
 *
 * @link http://www.php.net/manual/en/intlcalendar.getactualmaximum.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 *
 * @return int
 * An {@link http://www.php.net/manual/en/language.types.integer.php int} representing the maximum value in the
 * units associated with the given <em>field</em> or <b>FALSE</b> on failure.
 */
function intlcal_get_actual_maximum($calendar, $field) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * The minimum value for a field, considering the object's current time
 *
 * @link http://www.php.net/manual/en/intlcalendar.getactualminimum.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 *
 * @return int
 * An {@link http://www.php.net/manual/en/language.types.integer.php int} representing the minimum value in the
 * field's unit or <b>FALSE</b> on failure.
 */
function intlcal_get_actual_minimum($calendar, $field) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get array of locales for which there is data
 *
 * @link http://www.php.net/manual/en/intlcalendar.getavailablelocales.php
 * @return array An array of strings, one for which locale.
 */
function intlcal_get_available_locales() { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 *
 * @link http://www.php.net/manual/en/intlcalendar.getdayofweektype.php
 * Tell whether a day is a weekday, weekend or a day that has a transition between the two
 *
 * @param IntlCalendar $calendar  <p>
 *                                The calendar object, on the procedural style interface.
 *                                </p>
 * @param int          $dayOfWeek <p>
 *                                One of the constants <b>IntlCalendar::DOW_SUNDAY</b>,
 *                                <b>IntlCalendar::DOW_MONDAY</b>, ...,
 *                                <b>IntlCalendar::DOW_SATURDAY</b>.
 *                                </p>
 *
 * @return int
 * Returns one of the constants
 * <b>IntlCalendar::DOW_TYPE_WEEKDAY</b>,
 * <b>IntlCalendar::DOW_TYPE_WEEKEND</b>,
 * <b>IntlCalendar::DOW_TYPE_WEEKEND_OFFSET</b> or
 * <b>IntlCalendar::DOW_TYPE_WEEKEND_CEASE</b> or <b>FALSE</b> on failure.
 *
 */
function intlcal_get_day_of_week_type($calendar, $dayOfWeek) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get last error code on the object
 *
 * @link http://www.php.net/manual/en/intlcalendar.geterrorcode.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return int An ICU error code indicating either success, failure or a warning.
 *
 */
function intlcal_get_error_code($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get last error message on the object
 *
 * @link http://www.php.net/manual/en/intlcalendar.geterrormessage.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return string The error message associated with last error that occurred in a function call on this object, or
 *                a string indicating the non-existance of an error.
 */
function intlcal_get_error_message($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the first day of the week for the calendar's locale
 *
 * @link http://www.php.net/manual/en/intlcalendar.getfirstdayofweek.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return int
 * One of the constants <b>IntlCalendar::DOW_SUNDAY</b>,
 * <b>IntlCalendar::DOW_MONDAY</b>, ...,
 * <b>IntlCalendar::DOW_SATURDAY</b> or <b>FALSE</b> on failure.
 *
 */
function intlcal_get_first_day_of_week($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the largest local minimum value for a field
 *
 * @link http://www.php.net/manual/en/intlcalendar.getgreatestminimum.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *
 * @return int
 * An {@link http://www.php.net/manual/en/language.types.integer.php int} representing a field value, in the
 * field's
 * unit, or <b>FALSE</b> on failure.
 */
function intlcal_get_greatest_minimum($calendar, $field) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get set of locale keyword values
 *
 * @param string $key    <p>
 *                       The locale keyword for which relevant values are to be queried. Only
 *                       <em>'calendar'</em> is supported.
 *                       </p>
 * @param string $locale <p>
 *                       The locale onto which the keyword/value pair are to be appended.
 *                       </p>
 * @param bool   $commonlyUsed
 *                       <p>
 *                       Whether to show only the values commonly used for the specified locale.
 *                       </p>
 *
 * @return Iterator An iterator that yields strings with the locale keyword values or <b>FALSE</b> on failure.
 */
function intlcal_get_keyword_values_for_locale($key, $locale, $commonlyUsed) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the smallest local maximum for a field
 *
 * @link http://www.php.net/manual/en/intlcalendar.getleastmaximum.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 *
 * @return int
 * An {@link http://www.php.net/manual/en/language.types.integer.ph int} representing a field value in the field's
 * unit or <b>FALSE</b> on failure.
 * </p>
 */
function intlcal_get_least_maximum($calendar, $field) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the locale associated with the object
 *
 * @link http://www.php.net/manual/en/intlcalendar.getlocale.php
 *
 * @param IntlCalendar $calendar   <p>
 *                                 The calendar object, on the procedural style interface.
 *                                 </p>
 * @param int          $localeType <p>
 *                                 Whether to fetch the actual locale (the locale from which the calendar
 *                                 data originates, with <b>Locale::ACTUAL_LOCALE</b>) or the
 *                                 valid locale, i.e., the most specific locale supported by ICU relatively
 *                                 to the requested locale – see <b>Locale::VALID_LOCALE</b>.
 *                                 From the most general to the most specific, the locales are ordered in
 *                                 this fashion – actual locale, valid locale, requested locale.
 *                                 </p>
 *
 * @return string
 * A locale string or <b>FALSE</b> on failure.
 *
 */
function intlcal_get_locale($calendar, $localeType) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the global maximum value for a field
 *
 * @link http://www.php.net/manual/en/intlcalendar.getmaximum.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link www.php.net/manual/en/class.intlcalendar.php IntlCalendar}
 *                               date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 *
 * @return string
 * A locale string or <b>FALSE</b> on failure.
 */
function intlcal_get_maximum($calendar, $field) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 *
 * @link http://www.php.net/manual/en/intlcalendar.getminimaldaysinfirstweek.php
 * Get minimal number of days the first week in a year or month can have
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return int
 * An {@link http://www.php.net/manual/en/language.types.integer.php  int} representing a number of days or
 * <b>FALSE</b> on failure.
 */
function intlcal_get_minimal_days_in_first_week($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the global minimum value for a field
 *
 * @link http://www.php.net/manual/en/intlcalendar.getminimum.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field}.
 *                               These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 *
 * @return int
 * An int representing a value for the given field in the field's unit or FALSE on failure.
 */
function intlcal_get_minimum($calendar, $field) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get number representing the current time
 *
 * @link http://www.php.net/manual/en/intlcalendar.getnow.php
 * @return float A float representing a number of milliseconds since the epoch, not counting leap seconds.
 */
function intlcal_get_now() { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get behavior for handling repeating wall time
 *
 * @link http://www.php.net/manual/en/intlcalendar.getrepeatedwalltimeoption.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return int
 * One of the constants <b>IntlCalendar::WALLTIME_FIRST</b> or
 * <b>IntlCalendar::WALLTIME_LAST</b>.
 *
 */
function intlcal_get_repeated_wall_time_option($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get behavior for handling skipped wall time
 *
 * @link http://www.php.net/manual/en/intlcalendar.getskippedwalltimeoption.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return int
 * One of the constants <b>IntlCalendar::WALLTIME_FIRST</b>,
 * <b>IntlCalendar::WALLTIME_LAST</b> or
 * <b>IntlCalendar::WALLTIME_NEXT_VALID</b>.
 */
function intlcal_get_skipped_wall_time_option($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get time currently represented by the object
 *
 * @param IntlCalendar $calendar <p>The calendar whose time will be checked against this object's time.</p>
 *
 * @return float
 * A {@link http://www.php.net/manual/en/language.types.float.php float} representing the number of milliseconds
 * elapsed since the reference time (1 Jan 1970 00:00:00 UTC).
 */
function intlcal_get_time($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the object's timezone
 *
 * @link http://www.php.net/manual/en/intlcalendar.gettimezone.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return IntlTimeZone
 * An {@link http://www.php.net/manual/en/class.intltimezone.php IntlTimeZone} object corresponding to the one used
 * internally in this object.
 */
function intlcal_get_time_zone($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the calendar type
 *
 * @link http://www.php.net/manual/en/intlcalendar.gettype.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return string
 * A {@link http://www.php.net/manual/en/language.types.string.php string} representing the calendar type, such as
 * <em>'gregorian'</em>, <em>'islamic'</em>, etc.
 */
function intlcal_get_type($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get time of the day at which weekend begins or ends
 *
 * @link http://www.php.net/manual/en/intlcalendar.getweekendtransition.php
 *
 * @param IntlCalendar $calendar  <p>
 *                                The calendar object, on the procedural style interface.
 *                                </p>
 * @param string       $dayOfWeek <p>
 *                                One of the constants <b>IntlCalendar::DOW_SUNDAY</b>,
 *                                <b>IntlCalendar::DOW_MONDAY</b>, ...,
 *                                <b>IntlCalendar::DOW_SATURDAY</b>.
 *                                </p>
 *
 * @return int
 * The number of milliseconds into the day at which the the weekend begins or
 * ends or <b>FALSE</b> on failure.
 */
function intlcal_get_weekend_transition($calendar, $dayOfWeek) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the largest local minimum value for a field
 *
 * @link http://www.php.net/manual/en/intlcalendar.getgreatestminimum.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *
 * @return int
 * An {@link http://www.php.net/manual/en/language.types.integer.php int} representing a field value, in the
 * field's
 * unit, or <b>FALSE</b> on failure.
 */
function intlcal_greates_minimum($calendar, $field) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Whether the object's time is in Daylight Savings Time
 *
 * @link http://www.php.net/manual/en/intlcalendar.indaylighttime.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return bool
 * Returns <b>TRUE</b> if the date is in Daylight Savings Time, <b>FALSE</b> otherwise.
 * The value <b>FALSE</b> may also be returned on failure, for instance after
 * specifying invalid field values on non-lenient mode; use {@link
 * http://www.php.net/manual/en/intl.configuration.php#ini.intl.use-exceptions exceptions} or query
 * {@link http://www.php.net/manual/en/function.intl-get-error-code.php intl_get_error_code()} to disambiguate.
 */
function intlcal_in_daylight_time($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Whether another calendar is equal but for a different time
 *
 * @link http://www.php.net/manual/en/intlcalendar.isequivalentto.php
 *
 * @param IntlCalendar $calendarObject <p>
 *                                     The calendar object, on the procedural style interface.
 *                                     </p>
 * @param IntlCalendar $calendar       The other calendar against which the comparison is to be made.
 *
 * @return bool
 * Assuming there are no argument errors, returns <b>TRUE</b> iif the calendars are equivalent except possibly for
 * their set time.
 */
function intlcal_is_equivalent_to(IntlCalendar $calendarObject, IntlCalendar $calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Whether date/time interpretation is in lenient mode
 *
 * @link http://www.php.net/manual/en/intlcalendar.islenient.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return bool
 * A {@link http://www.php.net/manual/en/language.types.boolean.php bool} representing whether the calendar is set
 * to lenient mode.
 */
function intlcal_is_lenient($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Whether a field is set
 *
 * @link http://www.php.net/manual/en/intlcalendar.isset.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param int          $field    <p>
 *                               One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                               IntlCalendar} date/time {@link
 *                               http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                               constants}. These are integer values between <em>0</em> and
 *                               <b>IntlCalendar::FIELD_COUNT</b>.
 *                               </p>
 *
 * @return bool Assuming there are no argument errors, returns <b>TRUE</b> iif the field is set.
 */
function intlcal_is_set($calendar, $field) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Whether a certain date/time is in the weekend
 *
 * @link http://www.php.net/manual/en/intlcalendar.isweekend.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param float        $date     [optional] <p>
 *                               An optional timestamp representing the number of milliseconds since the
 *                               epoch, excluding leap seconds. If <b>NULL</b>, this object's current time is
 *                               used instead.
 *                               </p>
 *
 * @return bool
 * <p> A {@link http://www.php.net/manual/en/language.types.boolean.php bool} indicating whether the given or this
 * object's time occurs in a weekend.
 * </p>
 * <p>
 * The value <b>FALSE</b> may also be returned on failure, for instance after giving
 * a date out of bounds on non-lenient mode; use {@link
 * http://www.php.net/manual/en/intl.configuration.php#ini.intl.use-exceptions exceptions} or query
 * {@link http://www.php.net/manual/en/function.intl-get-error-code.php intl_get_error_code()} to disambiguate.</p>
 */
function intlcal_is_weekend($calendar, $date = null) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Add value to field without carrying into more significant fields
 *
 * @link http://www.php.net/manual/en/intlcalendar.roll.php
 *
 * @param IntlCalendar $calendar         <p>
 *                                       The calendar object, on the procedural style interface.
 *                                       </p>
 * @param int          $field            <p>One of the
 *                                       {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar}
 *                                       date/time
 *                                       {@link
 *                                       http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants
 *                                       field constants}. These are integer values between <em>0</em> and
 *                                       <b>IntlCalendar::FIELD_COUNT</b>.
 *                                       </p>
 * @param mixed        $amountOrUpOrDown <p>
 *                                       The (signed) amount to add to the field, <b>TRUE</b> for rolling up
 *                                       (adding
 *                                       <em>1</em>), or <b>FALSE</b> for rolling down (subtracting
 *                                       <em>1</em>).
 *                                       </p>
 *
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function intlcal_roll($calendar, $field, $amountOrUpOrDown) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Set a time field or several common fields at once
 *
 * @link http://www.php.net/manual/en/intlcalendar.set.php
 *
 * @param IntlCalendar $calendar   <p>
 *                                 The calendar object, on the procedural style interface.
 *                                 </p>
 * @param int          $year       <p>
 *                                 One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
 *                                 IntlCalendar} date/time {@link
 *                                 http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
 *                                 constants}. These are integer values between <em>0</em> and
 *                                 <b>IntlCalendar::FIELD_COUNT</b>.
 *                                 </p>
 * @param int          $month      <p>
 *                                 The new value for <b>IntlCalendar::FIELD_MONTH</b>.
 *                                 </p>
 * @param int          $dayOfMonth [optional] <p>
 *                                 The new value for <b>IntlCalendar::FIELD_DAY_OF_MONTH</b>.
 *                                 The month sequence is zero-based, i.e., January is represented by 0,
 *                                 February by 1, ..., December is 11 and Undecember (if the calendar has
 *                                 it) is 12.
 *                                 </p>
 * @param int          $hour       [optional]
 *                                 <p>
 *                                 The new value for <b>IntlCalendar::FIELD_HOUR_OF_DAY</b>.
 *                                 </p>
 * @param int          $minute     [optional]
 *                                 <p>
 *                                 The new value for <b>IntlCalendar::FIELD_MINUTE</b>.
 *                                 </p>
 * @param int          $second     [optional] <p>
 *                                 The new value for <b>IntlCalendar::FIELD_SECOND</b>.
 *                                 </p>
 *
 * @return bool Returns <b>TRUE</b> on success and <b>FALSE</b> on failure.
 */
function intlcal_set($calendar, $year, $month, $dayOfMonth = null, $hour = null, $minute = null, $second = null) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Set the day on which the week is deemed to start
 *
 * @link http://www.php.net/manual/en/intlcalendar.setfirstdayofweek.php
 *
 * @param IntlCalendar $calendar  <p>
 *                                The calendar object, on the procedural style interface.
 *                                </p>
 * @param int          $dayOfWeek <p>
 *                                One of the constants <b>IntlCalendar::DOW_SUNDAY</b>,
 *                                <b>IntlCalendar::DOW_MONDAY</b>, ...,
 *                                <b>IntlCalendar::DOW_SATURDAY</b>.
 *                                </p>
 *
 * @return bool Returns TRUE on success. Failure can only happen due to invalid parameters.
 */
function intlcal_set_first_day_of_week($calendar, $dayOfWeek) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Set whether date/time interpretation is to be lenient
 *
 * @link http://www.php.net/manual/en/intlcalendar.setlenient.php
 *
 * @param IntlCalendar $calendar  <p>
 *                                The calendar object, on the procedural style interface.
 *                                </p>
 * @param string       $isLenient <p>
 *                                Use <b>TRUE</b> to activate the lenient mode; <b>FALSE</b> otherwise.
 *                                </p>
 *
 * @return boolean Returns <b>TRUE</b> on success. Failure can only happen due to invalid parameters.
 */
function intlcal_set_lenient($calendar, $isLenient) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Set behavior for handling repeating wall times at negative timezone offset transitions
 *
 * @link http://www.php.net/manual/en/intlcalendar.setrepeatedwalltimeoption.php
 *
 * @param IntlCalendar $calendar       <p>
 *                                     The calendar object, on the procedural style interface.
 *                                     </p>
 * @param int          $wallTimeOption <p>
 *                                     One of the constants <b>IntlCalendar::WALLTIME_FIRST</b> or
 *                                     <b>IntlCalendar::WALLTIME_LAST</b>.
 *                                     </p>
 *
 * @return bool
 * Returns <b>TRUE</b> on success. Failure can only happen due to invalid parameters.
 *
 */
function intlcal_set_repeated_wall_time_option($calendar, $wallTimeOption) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Set behavior for handling skipped wall times at positive timezone offset transitions
 *
 * @link http://www.php.net/manual/en/intlcalendar.setskippedwalltimeoption.php
 *
 * @param IntlCalendar $calendar       <p>
 *                                     The calendar object, on the procedural style interface.
 *                                     </p>
 * @param int          $wallTimeOption <p>
 *                                     One of the constants <b>IntlCalendar::WALLTIME_FIRST</b>,
 *                                     <b>IntlCalendar::WALLTIME_LAST</b> or
 *                                     <b>IntlCalendar::WALLTIME_NEXT_VALID</b>.
 *                                     </p>
 *
 * @return bool
 * <p>
 * Returns <b>TRUE</b> on success. Failure can only happen due to invalid parameters.
 * </p>
 */
function intlcal_set_skipped_wall_time_option($calendar, $wallTimeOption) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Set the calendar time in milliseconds since the epoch
 *
 * @link http://www.php.net/manual/en/intlcalendar.settime.php
 *
 * @param float $date <p>
 *                    An instant represented by the number of number of milliseconds between
 *                    such instant and the epoch, ignoring leap seconds.
 *                    </p>
 *
 * @return bool
 * Returns <b>TRUE</b> on success and <b>FALSE</b> on failure.
 */
function intlcal_set_time($date) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Set the timezone used by this calendar
 *
 * @link http://www.php.net/manual/en/intlcalendar.settimezone.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 * @param mixed        $timeZone <p>
 *                               The new timezone to be used by this calendar. It can be specified in the
 *                               following ways:
 *
 * </p><ul>
 * <li>
 * <p>
 * <b>NULL</b>, in which case the default timezone will be used, as specified in
 * the ini setting {@link http://www.php.net/manual/en/datetime.configuration.php#ini.date.timezone date.timezone}
 * or through the function  {@link http://www.php.net/manual/en/function.date-default-timezone-set.php
 * date_default_timezone_set()} and as returned by  {@link
 * http://www.php.net/manual/en/function.date-default-timezone-get.php date_default_timezone_get()}.
 * </p>
 * </li>
 * <li>
 * <p>
 * An {@link http://www.php.net/manual/en/class.intltimezone.php IntlTimeZone}, which will be used directly.
 * </p>
 * </li>
 * <li>
 * <p>
 * A {@link http://www.php.net/manual/en/class.datetimezone.php DateTimeZone}. Its identifier will be extracted
 * and an ICU timezone object will be created; the timezone will be backed
 * by ICU's database, not PHP's.
 * </p>
 * </li>
 * <li>
 * <p>
 * A {@link http://www.php.net/manual/en/language.types.string.php string}, which should be a valid ICU timezone
 * identifier. See  <b>IntlTimeZone::createTimeZoneIDEnumeration()</b>. Raw offsets such as <em>"GMT+08:30"</em>
 * are also accepted.
 * </p>
 * </li>
 * </ul>
 *
 * @return bool Returns <b>TRUE</b> on success and <b>FALSE</b> on failure.
 */
function intlcal_set_time_zone($calendar, $timeZone) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a2)<br/>
 * Convert an IntlCalendar into a DateTime object
 *
 * @link http://www.php.net/manual/en/intlcalendar.todatetime.php
 *
 * @param IntlCalendar $calendar <p>
 *                               The calendar object, on the procedural style interface.
 *                               </p>
 *
 * @return DateTime|bool
 * A {@link http://www.php.net/manual/en/class.datetime.php DateTime} object with the same timezone as this
 * object (though using PHP's database instead of ICU's) and the same time,
 * except for the smaller precision (second precision instead of millisecond).
 * Returns <b>FALSE</b> on failure.
 */
function intlcal_to_date_time($calendar) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 *
 * @param mixed  $timeZone
 * @param string $locale
 *
 * @return IntlGregorianCalendar
 */
function intlgregcal_create_instance($timeZone = null, $locale = null) { }

/**
 * @param IntlGregorianCalendar $obj
 *
 * @return double $change
 */
function intlgregcal_get_gregorian_change($obj) { }

/**
 * @param int $year
 *
 * @return bool
 */
function intlgregcal_is_leap_year($year) { }

/**
 * @param IntlGregorianCalendar $obj
 * @param double                $change
 *
 */
function intlgregcal_set_gregorian_change($obj, $change) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the number of IDs in the equivalency group that includes the given ID
 *
 * @link http://www.php.net/manual/en/intltimezone.countequivalentids.php
 *
 * @param string $zoneId
 *
 * @return int
 */
function intltz_count_equivalent_ids($zoneId) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 *
 * @link http://www.php.net/manual/en/intltimezone.createenumeration.php
 *
 * @param mixed $countryOrRawOffset [optional]
 *
 * @return IntlIterator
 */
function intltz_create_enumeration($countryOrRawOffset) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 *
 * @link http://www.php.net/manual/en/intltimezone.createtimezone.php
 *
 * @param string $zoneId
 *
 * @return IntlTimeZone
 */
function intltz_create_time_zone($zoneId) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 *
 * @link http://www.php.net/manual/en/intltimezone.fromdatetimezone.php
 *
 * @param DateTimeZone $zoneId
 *
 * @return IntlTimeZone
 */
function intltz_from_date_time_zone($zoneId) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Create GMT (UTC) timezone
 *
 * @link http://www.php.net/manual/en/intltimezone.getgmt.php
 * @return IntlTimeZone
 */
function intltz_getGMT() { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the canonical system timezone ID or the normalized custom time zone ID for the given time zone ID
 *
 * @link www.php.net/manual/en/intltimezone.getcanonicalid.php
 *
 * @param string $zoneId
 * @param bool   $isSystemID [optional]
 *
 * @return string
 */
function intltz_get_canonical_id($zoneId, &$isSystemID) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get a name of this time zone suitable for presentation to the user
 *
 * @param IntlTimeZone $obj        - <p>
 *                                 The time zone object, on the procedural style interface.
 *                                 </p>
 * @param bool         $isDaylight [optional]
 * @param int          $style      [optional]
 * @param string       $locale     [optional]
 *
 * @return string
 */
function intltz_get_display_name($obj, $isDaylight, $style, $locale) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the amount of time to be added to local standard time to get local wall clock time
 *
 * @param IntlTimeZone $obj - <p>
 *                          The time zone object, on the procedural style interface.
 *                          </p>
 *
 * @link http://www.php.net/manual/en/intltimezone.getequivalentid.php
 * @return int
 */
function intltz_get_dst_savings($obj) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get an ID in the equivalency group that includes the given ID
 *
 * @link http://www.php.net/manual/en/intltimezone.getequivalentid.php
 *
 * @param string $zoneId
 * @param int    $index
 *
 * @return string
 */
function intltz_get_equivalent_id($zoneId, $index) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get last error code on the object
 *
 * @link http://www.php.net/manual/en/intltimezone.geterrorcode.php
 *
 * @param IntlTimeZone $obj - <p>
 *                          The time zone object, on the procedural style interface.
 *                          </p>
 *
 * @return int
 */
function intltz_get_error_code($obj) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get last error message on the object
 *
 * @link http://www.php.net/manual/en/intltimezone.geterrormessage.php
 *
 * @param IntlTimeZone $obj - <p>
 *                          The time zone object, on the procedural style interface.
 *                          </p>
 *
 * @return string
 */
function intltz_get_error_message($obj) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get timezone ID
 *
 * @link http://www.php.net/manual/en/intltimezone.getid.php
 *
 * @param IntlTimeZone $obj
 *
 * @return string
 */
function intltz_get_id($obj) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the time zone raw and GMT offset for the given moment in time
 *
 * @link http://www.php.net/manual/en/intltimezone.getoffset.php
 *
 * @param IntlTimeZone $obj
 * @param float        $date
 * @param bool         $local
 * @param int          $rawOffset
 * @param int          $dstOffset
 *
 * @return int
 */
function intltz_get_offset($obj, $date, $local, &$rawOffset, &$dstOffset) { }

/**
 * Get the raw GMT offset (before taking daylight savings time into account
 *
 * @link http://www.php.net/manual/en/intltimezone.getrawoffset.php
 *
 * @param IntlTimeZone $obj
 *
 * @return int
 */
function intltz_get_raw_offset($obj) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Get the timezone data version currently used by ICU
 *
 * @link http://www.php.net/manual/en/intltimezone.gettzdataversion.php
 *
 * @param IntlTimeZone $obj
 *
 * @return string
 */
function intltz_get_tz_data_version($obj) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Check if this zone has the same rules and offset as another zone
 *
 * @link http://www.php.net/manual/en/intltimezone.hassamerules.php
 *
 * @param IntlTimeZone $obj
 * @param IntlTimeZone $otherTimeZone
 *
 * @return bool
 */
function intltz_has_same_rules($obj, $otherTimeZone) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Convert to DateTimeZone object
 *
 * @link http://www.php.net/manual/ru/intltimezone.todatetimezone.php
 *
 * @param $obj
 *
 * @return DateTimeZone
 */
function intltz_to_date_time_zone($obj) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Check if this time zone uses daylight savings time
 *
 * @link http://www.php.net/manual/ru/intltimezone.usedaylighttime.php
 *
 * @param $obj
 *
 * @return bool
 */
function intltz_use_daylight_time($obj) { }

/**
 * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
 * Create a new copy of the default timezone for this host
 *
 * @link http://www.php.net/manual/en/intltimezone.createdefault.php
 * @return IntlTimeZone
 */
function intlz_create_default() { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Tries to find out best available locale based on HTTP "Accept-Language" header
 *
 * @link http://php.net/manual/en/locale.acceptfromhttp.php
 *
 * @param string $header <p>
 *                       The string containing the "Accept-Language" header according to format in RFC 2616.
 *                       </p>
 *
 * @return string The corresponding locale identifier.
 */
function locale_accept_from_http($header) { }

/**
 * @param $arg1
 */
function locale_canonicalize($arg1) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns a correctly ordered and delimited locale ID
 *
 * @link http://php.net/manual/en/locale.composelocale.php
 *
 * @param array $subtags <p>
 *                       an array containing a list of key-value pairs, where the keys identify
 *                       the particular locale ID subtags, and the values are the associated
 *                       subtag values.
 *                       <p>
 *                       The 'variant' and 'private' subtags can take maximum 15 values
 *                       whereas 'extlang' can take maximum 3 values.e.g. Variants are allowed
 *                       with the suffix ranging from 0-14. Hence the keys for the input array
 *                       can be variant0, variant1, ...,variant14. In the returned locale id,
 *                       the subtag is ordered by suffix resulting in variant0 followed by
 *                       variant1 followed by variant2 and so on.
 *                       </p>
 *                       <p>
 *                       The 'variant', 'private' and 'extlang' multiple values can be specified both
 *                       as array under specific key (e.g. 'variant') and as multiple numbered keys
 *                       (e.g. 'variant0', 'variant1', etc.).
 *                       </p>
 *                       </p>
 *
 * @return string The corresponding locale identifier.
 */
function locale_compose(array $subtags) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Checks if a language tag filter matches with locale
 *
 * @link http://php.net/manual/en/locale.filtermatches.php
 *
 * @param string $langtag      <p>
 *                             The language tag to check
 *                             </p>
 * @param string $locale       <p>
 *                             The language range to check against
 *                             </p>
 * @param bool   $canonicalize [optional] <p>
 *                             If true, the arguments will be converted to canonical form before
 *                             matching.
 *                             </p>
 *
 * @return bool <b>TRUE</b> if $locale matches $langtag <b>FALSE</b> otherwise.
 */
function locale_filter_matches($langtag, $locale, $canonicalize = false) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the variants for the input locale
 *
 * @link http://php.net/manual/en/locale.getallvariants.php
 *
 * @param string $locale <p>
 *                       The locale to extract the variants from
 *                       </p>
 *
 * @return array The array containing the list of all variants subtag for the locale
 * or <b>NULL</b> if not present
 */
function locale_get_all_variants($locale) { }

/**
 * Get the default Locale
 *
 * @link http://php.net/manual/en/function.locale-get-default.php
 * @return string a string with the current Locale.
 */
function locale_get_default() { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for language of the inputlocale
 *
 * @link http://php.net/manual/en/locale.getdisplaylanguage.php
 *
 * @param string $locale    <p>
 *                          The locale to return a display language for
 *                          </p>
 * @param string $in_locale [optional] <p>
 *                          Optional format locale to use to display the language name
 *                          </p>
 *
 * @return string display name of the language for the $locale in the format appropriate for
 * $in_locale.
 */
function locale_get_display_language($locale, $in_locale = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for the input locale
 *
 * @link http://php.net/manual/en/locale.getdisplayname.php
 *
 * @param string $locale    <p>
 *                          The locale to return a display name for.
 *                          </p>
 * @param string $in_locale [optional] <p>optional format locale</p>
 *
 * @return string Display name of the locale in the format appropriate for $in_locale.
 */
function locale_get_display_name($locale, $in_locale = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for region of the input locale
 *
 * @link http://php.net/manual/en/locale.getdisplayregion.php
 *
 * @param string $locale    <p>
 *                          The locale to return a display region for.
 *                          </p>
 * @param string $in_locale [optional] <p>
 *                          Optional format locale to use to display the region name
 *                          </p>
 *
 * @return string display name of the region for the $locale in the format appropriate for
 * $in_locale.
 */
function locale_get_display_region($locale, $in_locale = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for script of the input locale
 *
 * @link http://php.net/manual/en/locale.getdisplayscript.php
 *
 * @param string $locale    <p>
 *                          The locale to return a display script for
 *                          </p>
 * @param string $in_locale [optional] <p>
 *                          Optional format locale to use to display the script name
 *                          </p>
 *
 * @return string Display name of the script for the $locale in the format appropriate for
 * $in_locale.
 */
function locale_get_display_script($locale, $in_locale = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for variants of the input locale
 *
 * @link http://php.net/manual/en/locale.getdisplayvariant.php
 *
 * @param string $locale    <p>
 *                          The locale to return a display variant for
 *                          </p>
 * @param string $in_locale [optional] <p>
 *                          Optional format locale to use to display the variant name
 *                          </p>
 *
 * @return string Display name of the variant for the $locale in the format appropriate for
 * $in_locale.
 */
function locale_get_display_variant($locale, $in_locale = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the keywords for the input locale
 *
 * @link http://php.net/manual/en/locale.getkeywords.php
 *
 * @param string $locale <p>
 *                       The locale to extract the keywords from
 *                       </p>
 *
 * @return array Associative array containing the keyword-value pairs for this locale
 */
function locale_get_keywords($locale) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the primary language for the input locale
 *
 * @link http://php.net/manual/en/locale.getprimarylanguage.php
 *
 * @param string $locale <p>
 *                       The locale to extract the primary language code from
 *                       </p>
 *
 * @return string The language code associated with the language or <b>NULL</b> in case of error.
 */
function locale_get_primary_language($locale) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the region for the input locale
 *
 * @link http://php.net/manual/en/locale.getregion.php
 *
 * @param string $locale <p>
 *                       The locale to extract the region code from
 *                       </p>
 *
 * @return string The region subtag for the locale or <b>NULL</b> if not present
 */
function locale_get_region($locale) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the script for the input locale
 *
 * @link http://php.net/manual/en/locale.getscript.php
 *
 * @param string $locale <p>
 *                       The locale to extract the script code from
 *                       </p>
 *
 * @return string The script subtag for the locale or <b>NULL</b> if not present
 */
function locale_get_script($locale) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Searches the language tag list for the best match to the language
 *
 * @link http://php.net/manual/en/locale.lookup.php
 *
 * @param array  $langtag      <p>
 *                             An array containing a list of language tags to compare to
 *                             <i>locale</i>. Maximum 100 items allowed.
 *                             </p>
 * @param string $locale       <p>
 *                             The locale to use as the language range when matching.
 *                             </p>
 * @param bool   $canonicalize [optional] <p>
 *                             If true, the arguments will be converted to canonical form before
 *                             matching.
 *                             </p>
 * @param string $default      [optional] <p>
 *                             The locale to use if no match is found.
 *                             </p>
 *
 * @return string The closest matching language tag or default value.
 */
function locale_lookup(array $langtag, $locale, $canonicalize = false, $default = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns a key-value array of locale ID subtag elements.
 *
 * @link http://php.net/manual/en/locale.parselocale.php
 *
 * @param string $locale <p>
 *                       The locale to extract the subtag array from. Note: The 'variant' and
 *                       'private' subtags can take maximum 15 values whereas 'extlang' can take
 *                       maximum 3 values.
 *                       </p>
 *
 * @return array an array containing a list of key-value pairs, where the keys
 * identify the particular locale ID subtags, and the values are the
 * associated subtag values. The array will be ordered as the locale id
 * subtags e.g. in the locale id if variants are '-varX-varY-varZ' then the
 * returned array will have variant0=&gt;varX , variant1=&gt;varY ,
 * variant2=&gt;varZ
 */
function locale_parse($locale) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set the default Locale
 *
 * @link http://php.net/manual/en/function.locale-set-default.php
 *
 * @param string $name <p>
 *                     The new Locale name. A comprehensive list of the supported locales is
 *                     available at .
 *                     </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function locale_set_default($name) { }

/**
 * @param $locale
 * @param $pattern
 */
function msgfmt_create($locale, $pattern) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Format the message
 *
 * @link http://php.net/manual/en/messageformatter.format.php
 *
 * @param MessageFormatter $fmt
 * @param array            $args <p>
 *                               Arguments to insert into the format string
 *                               </p>
 *
 * @return string The formatted string, or <b>FALSE</b> if an error occurred
 */
function msgfmt_format(MessageFormatter $fmt, array $args) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Quick format message
 *
 * @link http://php.net/manual/en/messageformatter.formatmessage.php
 *
 * @param MessageFormatter $fmt
 * @param string           $locale  <p>
 *                                  The locale to use for formatting locale-dependent parts
 *                                  </p>
 * @param string           $pattern <p>
 *                                  The pattern string to insert things into.
 *                                  The pattern uses an 'apostrophe-friendly' syntax; it is run through
 *                                  umsg_autoQuoteApostrophe
 *                                  before being interpreted.
 *                                  </p>
 * @param array            $args    <p>
 *                                  The array of values to insert into the format string
 *                                  </p>
 *
 * @return string The formatted pattern string or <b>FALSE</b> if an error occurred
 */
function msgfmt_format_message(MessageFormatter $fmt, $locale, $pattern, array $args) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the error code from last operation
 *
 * @link http://php.net/manual/en/messageformatter.geterrorcode.php
 *
 * @param MessageFormatter $fmt
 * @param                  $nf
 *
 * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
 */
function msgfmt_get_error_code(MessageFormatter $fmt, $nf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the error text from the last operation
 *
 * @link http://php.net/manual/en/messageformatter.geterrormessage.php
 *
 * @param MessageFormatter $fmt
 * @param                  $coll
 *
 * @return string Description of the last error.
 */
function msgfmt_get_error_message(MessageFormatter $fmt, $coll) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the locale for which the formatter was created.
 *
 * @link http://php.net/manual/en/messageformatter.getlocale.php
 *
 * @param MessageFormatter $fmt
 * @param                  $mf
 *
 * @return string The locale name
 */
function msgfmt_get_locale(MessageFormatter $fmt, $mf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the pattern used by the formatter
 *
 * @link http://php.net/manual/en/messageformatter.getpattern.php
 *
 * @param MessageFormatter $fmt
 * @param                  $mf
 *
 * @return string The pattern string for this message formatter
 */
function msgfmt_get_pattern(MessageFormatter $fmt, $mf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse input string according to pattern
 *
 * @link http://php.net/manual/en/messageformatter.parse.php
 *
 * @param MessageFormatter $fmt
 * @param string           $value <p>
 *                                The string to parse
 *                                </p>
 *
 * @return array An array containing the items extracted, or <b>FALSE</b> on error
 */
function msgfmt_parse(MessageFormatter $fmt, $value) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Quick parse input string
 *
 * @link http://php.net/manual/en/messageformatter.parsemessage.php
 *
 * @param MessageFormatter $fmt
 * @param string           $locale  <p>
 *                                  The locale to use for parsing locale-dependent parts
 *                                  </p>
 * @param string           $pattern <p>
 *                                  The pattern with which to parse the <i>value</i>.
 *                                  </p>
 * @param string           $source  <p>
 *                                  The string to parse, conforming to the <i>pattern</i>.
 *                                  </p>
 *
 * @return array An array containing items extracted, or <b>FALSE</b> on error
 */
function msgfmt_parse_message(MessageFormatter $fmt, $locale, $pattern, $source) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set the pattern used by the formatter
 *
 * @link http://php.net/manual/en/messageformatter.setpattern.php
 *
 * @param MessageFormatter $fmt
 * @param string           $pattern <p>
 *                                  The pattern string to use in this message formatter.
 *                                  The pattern uses an 'apostrophe-friendly' syntax; it is run through
 *                                  umsg_autoQuoteApostrophe
 *                                  before being interpreted.
 *                                  </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function msgfmt_set_pattern(MessageFormatter $fmt, $pattern) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Checks if the provided string is already in the specified normalization
 * form.
 *
 * @link http://php.net/manual/en/normalizer.isnormalized.php
 *
 * @param string $input <p>The input string to normalize</p>
 * @param int $form  [optional] <p>
 *                      One of the normalization forms.
 *                      </p>
 *
 * @return bool <b>TRUE</b> if normalized, <b>FALSE</b> otherwise or if there an error
 */
function normalizer_is_normalized($input, $form = Normalizer::FORM_C) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Normalizes the input provided and returns the normalized string
 *
 * @link http://php.net/manual/en/normalizer.normalize.php
 *
 * @param string $input <p>The input string to normalize</p>
 * @param int $form  [optional] <p>One of the normalization forms.</p>
 *
 * @return string The normalized string or <b>NULL</b> if an error occurred.
 */
function normalizer_normalize($input, $form = Normalizer::FORM_C) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Create a number formatter
 *
 * @link http://php.net/manual/en/numberformatter.create.php
 *
 * @param string $locale  <p>
 *                        Locale in which the number would be formatted (locale name, e.g. en_CA).
 *                        </p>
 * @param int    $style   <p>
 *                        Style of the formatting, one of the
 *                        format style constants. If
 *                        <b>NumberFormatter::PATTERN_DECIMAL</b>
 *                        or <b>NumberFormatter::PATTERN_RULEBASED</b>
 *                        is passed then the number format is opened using the given pattern,
 *                        which must conform to the syntax described in
 *                        ICU DecimalFormat
 *                        documentation or
 *                        ICU RuleBasedNumberFormat
 *                        documentation, respectively.
 *                        </p>
 * @param string $pattern [optional] <p>
 *                        Pattern string if the chosen style requires a pattern.
 *                        </p>
 *
 * @return NumberFormatter <b>NumberFormatter</b> object or <b>FALSE</b> on error.
 */
function numfmt_create($locale, $style, $pattern = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Format a number
 *
 * @link http://php.net/manual/en/numberformatter.format.php
 *
 * @param NumberFormatter $fmt
 * @param number          $value <p>
 *                               The value to format. Can be integer or float,
 *                               other values will be converted to a numeric value.
 *                               </p>
 * @param int             $type  [optional] <p>
 *                               The
 *                               formatting type to use.
 *                               </p>
 *
 * @return string the string containing formatted value, or <b>FALSE</b> on error.
 */
function numfmt_format(NumberFormatter $fmt, $value, $type = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Format a currency value
 *
 * @link http://php.net/manual/en/numberformatter.formatcurrency.php
 *
 * @param NumberFormatter $fmt
 * @param float           $value    <p>
 *                                  The numeric currency value.
 *                                  </p>
 * @param string          $currency <p>
 *                                  The 3-letter ISO 4217 currency code indicating the currency to use.
 *                                  </p>
 *
 * @return string String representing the formatted currency value.
 */
function numfmt_format_currency(NumberFormatter $fmt, $value, $currency) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get an attribute
 *
 * @link http://php.net/manual/en/numberformatter.getattribute.php
 *
 * @param NumberFormatter $fmt
 * @param int             $attr <p>
 *                              Attribute specifier - one of the
 *                              numeric attribute constants.
 *                              </p>
 *
 * @return int Return attribute value on success, or <b>FALSE</b> on error.
 */
function numfmt_get_attribute(NumberFormatter $fmt, $attr) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get formatter's last error code.
 *
 * @link http://php.net/manual/en/numberformatter.geterrorcode.php
 *
 * @param NumberFormatter $fmt
 * @param                 $nf
 *
 * @return int error code from last formatter call.
 */
function numfmt_get_error_code(NumberFormatter $fmt, $nf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get formatter's last error message.
 *
 * @link http://php.net/manual/en/numberformatter.geterrormessage.php
 *
 * @param NumberFormatter $fmt
 * @param                 $nf
 *
 * @return string error message from last formatter call.
 */
function numfmt_get_error_message(NumberFormatter $fmt, $nf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get formatter locale
 *
 * @link http://php.net/manual/en/numberformatter.getlocale.php
 *
 * @param NumberFormatter $fmt
 * @param int             $type [optional] <p>
 *                              You can choose between valid and actual locale (
 *                              <b>Locale::VALID_LOCALE</b>,
 *                              <b>Locale::ACTUAL_LOCALE</b>,
 *                              respectively). The default is the actual locale.
 *                              </p>
 *
 * @return string The locale name used to create the formatter.
 */
function numfmt_get_locale(NumberFormatter $fmt, $type = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get formatter pattern
 *
 * @link http://php.net/manual/en/numberformatter.getpattern.php
 *
 * @param NumberFormatter $fmt
 * @param                 $nf
 *
 * @return string Pattern string that is used by the formatter, or <b>FALSE</b> if an error happens.
 */
function numfmt_get_pattern(NumberFormatter $fmt, $nf) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get a symbol value
 *
 * @link http://php.net/manual/en/numberformatter.getsymbol.php
 *
 * @param NumberFormatter $fmt
 * @param int             $attr <p>
 *                              Symbol specifier, one of the
 *                              format symbol constants.
 *                              </p>
 *
 * @return string The symbol string or <b>FALSE</b> on error.
 */
function numfmt_get_symbol(NumberFormatter $fmt, $attr) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get a text attribute
 *
 * @link http://php.net/manual/en/numberformatter.gettextattribute.php
 *
 * @param NumberFormatter $fmt
 * @param int             $attr <p>
 *                              Attribute specifier - one of the
 *                              text attribute constants.
 *                              </p>
 *
 * @return string Return attribute value on success, or <b>FALSE</b> on error.
 */
function numfmt_get_text_attribute(NumberFormatter $fmt, $attr) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse a number
 *
 * @link http://php.net/manual/en/numberformatter.parse.php
 *
 * @param NumberFormatter $fmt
 * @param string          $value
 * @param int             $type     [optional] <p>
 *                                  The
 *                                  formatting type to use. By default,
 *                                  <b>NumberFormatter::TYPE_DOUBLE</b> is used.
 *                                  </p>
 * @param int             $position [optional] <p>
 *                                  Offset in the string at which to begin parsing. On return, this value
 *                                  will hold the offset at which parsing ended.
 *                                  </p>
 *
 * @return mixed The value of the parsed number or <b>FALSE</b> on error.
 */
function numfmt_parse(NumberFormatter $fmt, $value, $type = null, &$position = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse a currency number
 *
 * @link http://php.net/manual/en/numberformatter.parsecurrency.php
 *
 * @param NumberFormatter $fmt
 * @param string          $value
 * @param string          $currency <p>
 *                                  Parameter to receive the currency name (3-letter ISO 4217 currency
 *                                  code).
 *                                  </p>
 * @param int             $position [optional] <p>
 *                                  Offset in the string at which to begin parsing. On return, this value
 *                                  will hold the offset at which parsing ended.
 *                                  </p>
 *
 * @return float The parsed numeric value or <b>FALSE</b> on error.
 */
function numfmt_parse_currency(NumberFormatter $fmt, $value, &$currency, &$position = null) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set an attribute
 *
 * @link http://php.net/manual/en/numberformatter.setattribute.php
 *
 * @param NumberFormatter $fmt
 * @param int             $attr  <p>
 *                               Attribute specifier - one of the
 *                               numeric attribute constants.
 *                               </p>
 * @param int             $value <p>
 *                               The attribute value.
 *                               </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_attribute(NumberFormatter $fmt, $attr, $value) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set formatter pattern
 *
 * @link http://php.net/manual/en/numberformatter.setpattern.php
 *
 * @param NumberFormatter $fmt
 * @param string          $pattern <p>
 *                                 Pattern in syntax described in
 *                                 ICU DecimalFormat
 *                                 documentation.
 *                                 </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_pattern(NumberFormatter $fmt, $pattern) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set a symbol value
 *
 * @link http://php.net/manual/en/numberformatter.setsymbol.php
 *
 * @param NumberFormatter $fmt
 * @param int             $attr  <p>
 *                               Symbol specifier, one of the
 *                               format symbol constants.
 *                               </p>
 * @param string          $value <p>
 *                               Text for the symbol.
 *                               </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_symbol(NumberFormatter $fmt, $attr, $value) { }

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set a text attribute
 *
 * @link http://php.net/manual/en/numberformatter.settextattribute.php
 *
 * @param NumberFormatter $fmt
 * @param int             $attr  <p>
 *                               Attribute specifier - one of the
 *                               text attribute
 *                               constants.
 *                               </p>
 * @param string          $value <p>
 *                               Text for the attribute value.
 *                               </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_text_attribute(NumberFormatter $fmt, $attr, $value) { }

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get number of elements in the bundle
 *
 * @link http://php.net/manual/en/resourcebundle.count.php
 *
 * @param ResourceBundle $r
 * @param                $bundle
 *
 * @return int number of elements in the bundle.
 */
function resourcebundle_count(ResourceBundle $r, $bundle) { }

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Create a resource bundle
 *
 * @link http://php.net/manual/en/resourcebundle.create.php
 *
 * @param string $locale     <p>
 *                           Locale for which the resources should be loaded (locale name, e.g. en_CA).
 *                           </p>
 * @param string $bundlename <p>
 *                           The directory where the data is stored or the name of the .dat file.
 *                           </p>
 * @param bool   $fallback   [optional] <p>
 *                           Whether locale should match exactly or fallback to parent locale is allowed.
 *                           </p>
 *
 * @return ResourceBundle <b>ResourceBundle</b> object or <b>FALSE</b> on error.
 */
function resourcebundle_create($locale, $bundlename, $fallback = null) { }

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get data from the bundle
 *
 * @link http://php.net/manual/en/resourcebundle.get.php
 *
 * @param ResourceBundle $r
 * @param string|int     $index <p>
 *                              Data index, must be string or integer.
 *                              </p>
 *
 * @return mixed the data located at the index or <b>NULL</b> on error. Strings, integers and binary data strings
 * are returned as corresponding PHP types, integer array is returned as PHP array. Complex types are
 * returned as <b>ResourceBundle</b> object.
 */
function resourcebundle_get(ResourceBundle $r, $index) { }

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get bundle's last error code.
 *
 * @link http://php.net/manual/en/resourcebundle.geterrorcode.php
 *
 * @param $bundle
 *
 * @return int error code from last bundle object call.
 */
function resourcebundle_get_error_code(ResourceBundle $bundle) { }

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get bundle's last error message.
 *
 * @link http://php.net/manual/en/resourcebundle.geterrormessage.php
 *
 * @param $bundle
 *
 * @return string error message from last bundle object's call.
 */
function resourcebundle_get_error_message(ResourceBundle $bundle) { }

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get supported locales
 *
 * @link http://php.net/manual/en/resourcebundle.locales.php
 *
 * @param ResourceBundle $r
 * @param string         $bundlename <p>
 *                                   Path of ResourceBundle for which to get available locales, or
 *                                   empty string for default locales list.
 *                                   </p>
 *
 * @return array the list of locales supported by the bundle.
 */
function resourcebundle_locales(ResourceBundle $r, $bundlename) { }

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Create a transliterator
 *
 * @link http://php.net/manual/en/transliterator.create.php
 *
 * @param string $id        <p>
 *                          The id.
 *                          </p>
 * @param int    $direction [optional] <p>
 *                          The direction, defaults to
 *                          >Transliterator::FORWARD.
 *                          May also be set to
 *                          Transliterator::REVERSE.
 *                          </p>
 *
 * @return Transliterator a <b>Transliterator</b> object on success,
 * or <b>NULL</b> on failure.
 */
function transliterator_create($id, $direction = null) { }

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Create transliterator from rules
 *
 * @link http://php.net/manual/en/transliterator.createfromrules.php
 *
 * @param string $rules     <p>
 *                          The rules.
 *                          </p>
 * @param string $direction [optional] <p>
 *                          The direction, defaults to
 *                          >Transliterator::FORWARD.
 *                          May also be set to
 *                          Transliterator::REVERSE.
 *                          </p>
 *
 * @return Transliterator a <b>Transliterator</b> object on success,
 * or <b>NULL</b> on failure.
 */
function transliterator_create_from_rules($rules, $direction = null) { }

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Create an inverse transliterator
 *
 * @link http://php.net/manual/en/transliterator.createinverse.php
 *
 * @param Transliterator $orig_trans
 *
 * @return Transliterator a <b>Transliterator</b> object on success,
 * or <b>NULL</b> on failure
 */
function transliterator_create_inverse(Transliterator $orig_trans) { }

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Get last error code
 *
 * @link http://php.net/manual/en/transliterator.geterrorcode.php
 *
 * @param Transliterator $trans
 *
 * @return int The error code on success,
 * or <b>FALSE</b> if none exists, or on failure.
 */
function transliterator_get_error_code(Transliterator $trans) { }

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Get last error message
 *
 * @link http://php.net/manual/en/transliterator.geterrormessage.php
 *
 * @param Transliterator $trans
 *
 * @return string The error code on success,
 * or <b>FALSE</b> if none exists, or on failure.
 */
function transliterator_get_error_message(Transliterator $trans) { }

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Get transliterator IDs
 *
 * @link http://php.net/manual/en/transliterator.listids.php
 * @return array An array of registered transliterator IDs on success,
 * or <b>FALSE</b> on failure.
 */
function transliterator_list_ids() { }

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Transliterate a string
 *
 * @link http://php.net/manual/en/transliterator.transliterate.php
 *
 * @param Transliterator|string $transliterator
 * @param string                $subject <p>
 *                                       The string to be transformed.
 *                                       </p>
 * @param int                   $start   [optional] <p>
 *                                       The start index (in UTF-16 code units) from which the string will start
 *                                       to be transformed, inclusive. Indexing starts at 0. The text before will
 *                                       be left as is.
 *                                       </p>
 * @param int                   $end     [optional] <p>
 *                                       The end index (in UTF-16 code units) until which the string will be
 *                                       transformed, exclusive. Indexing starts at 0. The text after will be
 *                                       left as is.
 *                                       </p>
 *
 * @return string The transfomed string on success, or <b>FALSE</b> on failure.
 */
function transliterator_transliterate($transliterator, $subject, $start = null, $end = null) { }
