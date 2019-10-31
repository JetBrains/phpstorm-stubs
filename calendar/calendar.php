<?php

// Start of calendar v.

/**
 * Converts Julian Day Count to Gregorian date
 * @link https://php.net/manual/en/function.jdtogregorian.php
 * @param int $julianday <p>
 * A julian day number as integer
 * </p>
 * @return string The gregorian date as a string in the form "month/day/year"
 * @since 4.0
 * @since 5.0
 */
function jdtogregorian ($julianday) {}

/**
 * Converts a Gregorian date to Julian Day Count
 * @link https://php.net/manual/en/function.gregoriantojd.php
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
 * @since 4.0
 * @since 5.0
 */
function gregoriantojd ($month, $day, $year) {}

/**
 * Converts a Julian Day Count to a Julian Calendar Date
 * @link https://php.net/manual/en/function.jdtojulian.php
 * @param int $julianday <p>
 * A julian day number as integer
 * </p>
 * @return string The julian date as a string in the form "month/day/year"
 * @since 4.0
 * @since 5.0
 */
function jdtojulian ($julianday) {}

/**
 * Converts a Julian Calendar date to Julian Day Count
 * @link https://php.net/manual/en/function.juliantojd.php
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
 * @since 4.0
 * @since 5.0
 */
function juliantojd ($month, $day, $year) {}

/**
 * Converts a Julian day count to a Jewish calendar date
 * @link https://php.net/manual/en/function.jdtojewish.php
 * @param int $juliandaycount
 * @param bool $hebrew [optional] <p>
 * If the <i>hebrew</i> parameter is set to <b>TRUE</b>, the
 * <i>fl</i> parameter is used for Hebrew, string based,
 * output format.
 * </p>
 * @param int $fl [optional] <p>
 * The available formats are:
 * <b>CAL_JEWISH_ADD_ALAFIM_GERESH</b>,
 * <b>CAL_JEWISH_ADD_ALAFIM</b>,
 * <b>CAL_JEWISH_ADD_GERESHAYIM</b>.
 * </p>
 * @return string The jewish date as a string in the form "month/day/year"
 * @since 4.0
 * @since 5.0
 */
function jdtojewish ($juliandaycount, $hebrew = false, $fl = 0) {}

/**
 * Converts a date in the Jewish Calendar to Julian Day Count
 * @link https://php.net/manual/en/function.jewishtojd.php
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
 * @since 4.0
 * @since 5.0
 */
function jewishtojd ($month, $day, $year) {}

/**
 * Converts a Julian Day Count to the French Republican Calendar
 * @link https://php.net/manual/en/function.jdtofrench.php
 * @param int $juliandaycount
 * @return string The french revolution date as a string in the form "month/day/year"
 * @since 4.0
 * @since 5.0
 */
function jdtofrench ($juliandaycount) {}

/**
 * Converts a date from the French Republican Calendar to a Julian Day Count
 * @link https://php.net/manual/en/function.frenchtojd.php
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
 * @since 4.0
 * @since 5.0
 */
function frenchtojd ($month, $day, $year) {}

/**
 * Returns the day of the week
 * @link https://php.net/manual/en/function.jddayofweek.php
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
 * @since 4.0
 * @since 5.0
 */
function jddayofweek ($julianday, $mode = CAL_DOW_DAYNO) {}

/**
 * Returns a month name
 * @link https://php.net/manual/en/function.jdmonthname.php
 * @param int $julianday
 * @param int $mode
 * @return string The month name for the given Julian Day and <i>calendar</i>.
 * @since 4.0
 * @since 5.0
 */
function jdmonthname ($julianday, $mode) {}

/**
 * Get Unix timestamp for midnight on Easter of a given year
 * @link https://php.net/manual/en/function.easter-date.php
 * @param int $year [optional] <p>
 * The year as a number between 1970 an 2037
 * </p>
 * @return int The easter date as a unix timestamp.
 * @since 4.0
 * @since 5.0
 */
function easter_date ($year = null) {}

/**
 * Get number of days after March 21 on which Easter falls for a given year
 * @link https://php.net/manual/en/function.easter-days.php
 * @param int $year [optional] <p>
 * The year as a positive number
 * </p>
 * @param int $method [optional] <p>
 * Allows to calculate easter dates based
 * on the Gregorian calendar during the years 1582 - 1752 when set to
 * <b>CAL_EASTER_ROMAN</b>. See the calendar constants for more valid
 * constants.
 * </p>
 * @return int The number of days after March 21st that the Easter Sunday
 * is in the given <i>year</i>.
 * @since 4.0
 * @since 5.0
 */
function easter_days ($year = null, $method = CAL_EASTER_DEFAULT) {}

/**
 * Convert Unix timestamp to Julian Day
 * @link https://php.net/manual/en/function.unixtojd.php
 * @param int $timestamp [optional] defaults to time() <p>
 * A unix timestamp to convert.
 * </p>
 * @return int A julian day number as integer.
 * @since 4.0
 * @since 5.0
 */
function unixtojd ($timestamp = 0) {}

/**
 * Convert Julian Day to Unix timestamp
 * @link https://php.net/manual/en/function.jdtounix.php
 * @param int $jday <p>
 * A julian day number between 2440588 and 2465342.
 * </p>
 * @return int The unix timestamp for the start of the given julian day.
 * @since 4.0
 * @since 5.0
 */
function jdtounix ($jday) {}

/**
 * Converts from a supported calendar to Julian Day Count
 * @link https://php.net/manual/en/function.cal-to-jd.php
 * @param int $calendar <p>
 * Calendar to convert from, one of
 * <b>CAL_GREGORIAN</b>,
 * <b>CAL_JULIAN</b>,
 * <b>CAL_JEWISH</b> or
 * <b>CAL_FRENCH</b>.
 * </p>
 * @param int $month <p>
 * The month as a number, the valid range depends
 * on the <i>calendar</i>
 * </p>
 * @param int $day <p>
 * The day as a number, the valid range depends
 * on the <i>calendar</i>
 * </p>
 * @param int $year <p>
 * The year as a number, the valid range depends
 * on the <i>calendar</i>
 * </p>
 * @return int A Julian Day number.
 * @since 4.1
 * @since 5.0
 */
function cal_to_jd ($calendar, $month, $day, $year) {}

/**
 * Converts from Julian Day Count to a supported calendar
 * @link https://php.net/manual/en/function.cal-from-jd.php
 * @param int $jd <p>
 * Julian day as integer
 * </p>
 * @param int $calendar <p>
 * Calendar to convert to
 * </p>
 * @return array an array containing calendar information like month, day, year,
 * day of week, abbreviated and full names of weekday and month and the
 * date in string form "month/day/year".
 * @since 4.1
 * @since 5.0
 */
function cal_from_jd ($jd, $calendar) {}

/**
 * Return the number of days in a month for a given year and calendar
 * @link https://php.net/manual/en/function.cal-days-in-month.php
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
 * @since 4.1
 * @since 5.0
 */
function cal_days_in_month ($calendar, $month, $year) {}

/**
 * Returns information about a particular calendar
 * @link https://php.net/manual/en/function.cal-info.php
 * @param int $calendar [optional] <p>
 * Calendar to return information for. If no calendar is specified
 * information about all calendars is returned.
 * </p>
 * @return array
 * @since 4.1
 * @since 5.0
 */
function cal_info ($calendar = -1) {}

define ('CAL_GREGORIAN', 0);
define ('CAL_JULIAN', 1);
define ('CAL_JEWISH', 2);
define ('CAL_FRENCH', 3);
define ('CAL_NUM_CALS', 4);
define ('CAL_DOW_DAYNO', 0);
define ('CAL_DOW_SHORT', 2);
define ('CAL_DOW_LONG', 1);
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
