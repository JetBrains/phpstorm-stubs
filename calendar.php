<?php

// Start of calendar v.

/**
 * (PHP 4, PHP 5)<br/>
 * Converts Julian Day Count to Gregorian date
 * @link http://php.net/manual/en/function.jdtogregorian.php
 * @param int $julianday <p>
 * A julian day number as integer
 * </p>
 * @return string The gregorian date as a string in the form "month/day/year"
 */
function jdtogregorian ($julianday) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Converts a Gregorian date to Julian Day Count
 * @link http://php.net/manual/en/function.gregoriantojd.php
 * @param int $month <p>
 * The month as a number from 1 (for January) to 12 (for December)
 * </p>
 * @param int $day <p>
 * The day as a number from 1 to 31
 * </p>
 * @param int $year <p>
 * The year as a number between -4714 and 9999
 * </p>
 * @return int The julian day for the given gregorian date as an integer.
 */
function gregoriantojd ($month, $day, $year) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Converts a Julian Day Count to a Julian Calendar Date
 * @link http://php.net/manual/en/function.jdtojulian.php
 * @param int $julianday <p>
 * A julian day number as integer
 * </p>
 * @return string The julian date as a string in the form "month/day/year"
 */
function jdtojulian ($julianday) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Converts a Julian Calendar date to Julian Day Count
 * @link http://php.net/manual/en/function.juliantojd.php
 * @param int $month <p>
 * The month as a number from 1 (for January) to 12 (for December)
 * </p>
 * @param int $day <p>
 * The day as a number from 1 to 31
 * </p>
 * @param int $year <p>
 * The year as a number between -4713 and 9999
 * </p>
 * @return int The julian day for the given julian date as an integer.
 */
function juliantojd ($month, $day, $year) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Converts a Julian day count to a Jewish calendar date
 * @link http://php.net/manual/en/function.jdtojewish.php
 * @param int $juliandaycount 
 * @param bool $hebrew [optional] <p>
 * If the hebrew parameter is set to true, the
 * fl parameter is used for Hebrew, string based,
 * output format. 
 * </p>
 * @param int $fl [optional] <p>
 * The available formats are: 
 * CAL_JEWISH_ADD_ALAFIM_GERESH,
 * CAL_JEWISH_ADD_ALAFIM,
 * CAL_JEWISH_ADD_GERESHAYIM.
 * </p>
 * @return string The jewish date as a string in the form "month/day/year"
 */
function jdtojewish ($juliandaycount, $hebrew = null, $fl = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Converts a date in the Jewish Calendar to Julian Day Count
 * @link http://php.net/manual/en/function.jewishtojd.php
 * @param int $month <p>
 * The month as a number from 1 to 13
 * </p>
 * @param int $day <p>
 * The day as a number from 1 to 30
 * </p>
 * @param int $year <p>
 * The year as a number between 1 and 9999
 * </p>
 * @return int The julian day for the given jewish date as an integer.
 */
function jewishtojd ($month, $day, $year) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Converts a Julian Day Count to the French Republican Calendar
 * @link http://php.net/manual/en/function.jdtofrench.php
 * @param int $juliandaycount 
 * @return string The french revolution date as a string in the form "month/day/year"
 */
function jdtofrench ($juliandaycount) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Converts a date from the French Republican Calendar to a Julian Day Count
 * @link http://php.net/manual/en/function.frenchtojd.php
 * @param int $month <p>
 * The month as a number from 1 (for Vendémiaire) to 13 (for the period of 5-6 days at the end of each year)
 * </p>
 * @param int $day <p>
 * The day as a number from 1 to 30
 * </p>
 * @param int $year <p>
 * The year as a number between 1 and 14
 * </p>
 * @return int The julian day for the given french revolution date as an integer.
 */
function frenchtojd ($month, $day, $year) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Returns the day of the week
 * @link http://php.net/manual/en/function.jddayofweek.php
 * @param int $julianday <p>
 * A julian day number as integer
 * </p>
 * @param int $mode [optional] <table>
 * Calendar week modes
 * <tr valign="top">
 * <td>Mode</td>
 * <td>Meaning</td>
 * </tr>
 * <tr valign="top">
 * <td>0 (Default)</td> 
 * <td>
 * Return the day number as an int (0=Sunday, 1=Monday, etc)
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>1</td> 
 * <td>
 * Returns string containing the day of week
 * (English-Gregorian)
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>2</td> 
 * <td>
 * Return a string containing the abbreviated day of week
 * (English-Gregorian)
 * </td>
 * </tr>
 * </table>
 * @return mixed The gregorian weekday as either an integer or string.
 */
function jddayofweek ($julianday, $mode = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Returns a month name
 * @link http://php.net/manual/en/function.jdmonthname.php
 * @param int $julianday 
 * @param int $mode 
 * @return string The month name for the given Julian Day and calendar.
 */
function jdmonthname ($julianday, $mode) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get Unix timestamp for midnight on Easter of a given year
 * @link http://php.net/manual/en/function.easter-date.php
 * @param int $year [optional] <p>
 * The year as a number between 1970 an 2037
 * </p>
 * @return int The easter date as a unix timestamp.
 */
function easter_date ($year = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get number of days after March 21 on which Easter falls for a given year
 * @link http://php.net/manual/en/function.easter-days.php
 * @param int $year [optional] <p>
 * The year as a positive number
 * </p>
 * @param int $method [optional] <p>
 * Allows to calculate easter dates based
 * on the Gregorian calendar during the years 1582 - 1752 when set to
 * CAL_EASTER_ROMAN. See the calendar constants for more valid
 * constants. 
 * </p>
 * @return int The number of days after March 21st that the Easter Sunday
 * is in the given year.
 */
function easter_days ($year = null, $method = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Convert Unix timestamp to Julian Day
 * @link http://php.net/manual/en/function.unixtojd.php
 * @param int $timestamp [optional] <p>
 * A unix timestamp to convert.
 * </p>
 * @return int A julian day number as integer.
 */
function unixtojd ($timestamp = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Convert Julian Day to Unix timestamp
 * @link http://php.net/manual/en/function.jdtounix.php
 * @param int $jday <p>
 * A julian day number between 2440588 and 2465342.
 * </p>
 * @return int The unix timestamp for the start of the given julian day.
 */
function jdtounix ($jday) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5)<br/>
 * Converts from a supported calendar to Julian Day Count
 * @link http://php.net/manual/en/function.cal-to-jd.php
 * @param int $calendar <p>
 * Calendar to convert from, one of 
 * CAL_GREGORIAN,
 * CAL_JULIAN,
 * CAL_JEWISH or
 * CAL_FRENCH.
 * </p>
 * @param int $month <p>
 * The month as a number, the valid range depends 
 * on the calendar
 * </p>
 * @param int $day <p>
 * The day as a number, the valid range depends 
 * on the calendar
 * </p>
 * @param int $year <p>
 * The year as a number, the valid range depends 
 * on the calendar
 * </p>
 * @return int A Julian Day number.
 */
function cal_to_jd ($calendar, $month, $day, $year) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5)<br/>
 * Converts from Julian Day Count to a supported calendar
 * @link http://php.net/manual/en/function.cal-from-jd.php
 * @param int $jd <p>
 * Julian day as integer
 * </p>
 * @param int $calendar <p>
 * Calendar to convert to
 * </p>
 * @return array an array containing calendar information like month, day, year,
 * day of week, abbreviated and full names of weekday and month and the
 * date in string form "month/day/year".
 */
function cal_from_jd ($jd, $calendar) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5)<br/>
 * Return the number of days in a month for a given year and calendar
 * @link http://php.net/manual/en/function.cal-days-in-month.php
 * @param int $calendar <p>
 * Calendar to use for calculation
 * </p>
 * @param int $month <p>
 * Month in the selected calendar
 * </p>
 * @param int $year <p>
 * Year in the selected calendar
 * </p>
 * @return int The length in days of the selected month in the given calendar
 */
function cal_days_in_month ($calendar, $month, $year) {}

/**
 * (PHP 4 &gt;= 4.1.0, PHP 5)<br/>
 * Returns information about a particular calendar
 * @link http://php.net/manual/en/function.cal-info.php
 * @param int $calendar [optional] <p>
 * Calendar to return information for. If no calendar is specified
 * information about all calendars is returned.
 * </p>
 * @return array 
 */
function cal_info ($calendar = null) {}

define ('CAL_GREGORIAN', 0);
define ('CAL_JULIAN', 1);
define ('CAL_JEWISH', 2);
define ('CAL_FRENCH', 3);
define ('CAL_NUM_CALS', 4);
define ('CAL_DOW_DAYNO', 0);
define ('CAL_DOW_SHORT', 1);
define ('CAL_DOW_LONG', 2);
define ('CAL_MONTH_GREGORIAN_SHORT', 0);
define ('CAL_MONTH_GREGORIAN_LONG', 1);
define ('CAL_MONTH_JULIAN_SHORT', 2);
define ('CAL_MONTH_JULIAN_LONG', 3);
define ('CAL_MONTH_JEWISH', 4);
define ('CAL_MONTH_FRENCH', 5);
define ('CAL_EASTER_DEFAULT', 0);
define ('CAL_EASTER_ROMAN', 1);
define ('CAL_EASTER_ALWAYS_GREGORIAN', 2);
define ('CAL_EASTER_ALWAYS_JULIAN', 3);
define ('CAL_JEWISH_ADD_ALAFIM_GERESH', 2);
define ('CAL_JEWISH_ADD_ALAFIM', 4);
define ('CAL_JEWISH_ADD_GERESHAYIM', 8);

// End of calendar v.
?>
