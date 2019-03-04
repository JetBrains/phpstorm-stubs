<?php

interface DateTimeInterface {
    const ATOM = 'Y-m-d\TH:i:sP';
    const COOKIE = 'l, d-M-y H:i:s T';
    const ISO8601 = 'Y-m-d\TH:i:sO';
    const RFC822 = 'D, d M y H:i:s O';
    const RFC850 = 'l, d-M-y H:i:s T';
    const RFC1036 = 'D, d M y H:i:s O';
    const RFC1123 = 'D, d M Y H:i:s O';
    const RFC2822 = 'D, d M Y H:i:s O';
    const RFC3339 = 'Y-m-d\TH:i:sP';
    const RFC3339_EXTENDED = 'Y-m-d\TH:i:s.vP';
    const RFC7231 = 'D, d M Y H:i:s \G\M\T';
    const RSS = 'D, d M Y H:i:s O';
    const W3C = 'Y-m-d\TH:i:sP';
    
    /* Methods */
    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the difference between two DateTime objects
     * @link https://secure.php.net/manual/en/datetime.diff.php
     * @param DateTimeInterface $datetime2 <p>The date to compare to.</p>
     * @param bool $absolute <p>Should the interval be forced to be positive?</p>
     * @return DateInterval
     * The https://secure.php.net/manual/en/class.dateinterval.php DateInterval} object representing the
     * difference between the two dates or <b>FALSE</b> on failure.
     *
     */
    public function diff($datetime2, $absolute = false);

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns date formatted according to given format
     * @link https://secure.php.net/manual/en/datetime.format.php
     * @param string $format <p>
     * Format accepted by  {@link https://secure.php.net/manual/en/function.date.php date()}.
     * </p>
     * @return string
     * Returns the formatted date string on success or <b>FALSE</b> on failure.
     *
     */
    public function format($format);

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the timezone offset
     * @return int
     * Returns the timezone offset in seconds from UTC on success
     * or <b>FALSE</b> on failure.
     *
     */
    public function getOffset();

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Gets the Unix timestamp
     * @return int
     * Returns the Unix timestamp representing the date.
     */
    public function getTimestamp();

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Return time zone relative to given DateTime
     * @link https://secure.php.net/manual/en/datetime.gettimezone.php
     * @return DateTimeZone
     * Returns a {@link https://secure.php.net/manual/en/class.datetimezone.php DateTimeZone} object on success
     * or <b>FALSE</b> on failure.
     */
    public function getTimezone();

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * The __wakeup handler
     * @link https://secure.php.net/manual/en/datetime.wakeup.php
     * @return void Initializes a DateTime object.
     */
    public function __wakeup();
}

class DateTimeImmutable implements DateTimeInterface {
    /* Methods */
    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * @link https://secure.php.net/manual/en/datetimeimmutable.construct.php
     * @param string $time [optional]
     * <p>A date/time string. Valid formats are explained in {@link https://secure.php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
     * <p>
     * Enter <b>NULL</b> here to obtain the current time when using
     * the <em>$timezone</em> parameter.
     * </p>
     * @param DateTimeZone $timezone [optional] <p>
     * A {@link https://secure.php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the
     * timezone of <em>$time</em>.
     * </p>
     * <p>
     * If <em>$timezone</em> is omitted,
     * the current timezone will be used.
     * </p>
     * <blockquote><p><b>Note</b>:
     * </p><p>
     * The <em>$timezone</em> parameter
     * and the current timezone are ignored when the
     *<em>$time</em> parameter either
     * is a UNIX timestamp (e.g. <em>@946684800</em>)
     * or specifies a timezone
     * (e.g. <em>2010-01-28T15:00:00+02:00</em>).
     * </p> <p></p></blockquote>
     * @throws Exception Emits Exception in case of an error.
     */
    public function __construct($time = "now", $timezone = NULL) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Adds an amount of days, months, years, hours, minutes and seconds
     * @param DateInterval $interval
     * @return static
     */
    public function add(DateInterval $interval) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns new DateTimeImmutable object formatted according to the specified format
     * @link https://secure.php.net/manual/en/datetimeimmutable.createfromformat.php
     * @param string $format
     * @param string $time
     * @param DateTimeZone $timezone [optional]
     * @return DateTimeImmutable|false
     */
    public static function createFromFormat($format, $time, DateTimeZone $timezone = null) { }

    /**
     * (PHP 5 &gt;=5.6.0)<br/>
     * Returns new DateTimeImmutable object encapsulating the given DateTime object
     * @link https://secure.php.net/manual/en/datetimeimmutable.createfrommutable.php
     * @param DateTime $dateTime The mutable DateTime object that you want to convert to an immutable version. This object is not modified, but instead a new DateTimeImmutable object is created containing the same date time and timezone information.
     * @return DateTimeImmutable returns a new DateTimeImmutable instance.
     */
    public static function createFromMutable(DateTime $dateTime) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the warnings and errors
     * @link https://secure.php.net/manual/en/datetimeimmutable.getlasterrors.php
     * @return array Returns array containing info about warnings and errors.
     */
    public static function getLastErrors() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Alters the timestamp
     * @link https://secure.php.net/manual/en/datetimeimmutable.modify.php
     * @param string $modify  <p>A date/time string. Valid formats are explained in
     * {@link https://secure.php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
     * @return static
     * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     */

    public function modify($modify) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * The __set_state handler
     * @link https://secure.php.net/manual/en/datetimeimmutable.set-state.php
     * @param array $array <p>Initialization array.</p>
     * @return DateTimeImmutable
     * Returns a new instance of a {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object.
     */
    public static function __set_state(array $array) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the date
     * @link https://secure.php.net/manual/en/datetimeimmutable.setdate.php
     * @param int $year <p>Year of the date.</p>
     * @param int $month <p>Month of the date.</p>
     * @param int $day <p>Day of the date.</p>
     * @return static|bool
     * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     *
     */
    public function setDate($year, $month, $day) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the ISO date
     * @link https://php.net/manual/en/class.datetimeimmutable.php
     * @param int $year <p>Year of the date.</p>
     * @param int $week  <p>Week of the date.</p>
     * @param int $day [optional] <p>Offset from the first day of the week.</p>
     * @return static|bool
     * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     */
    public function setISODate($year, $week, $day = 1) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the time
     * @link https://secure.php.net/manual/en/datetimeimmutable.settime.php
     * @param int $hour <p> Hour of the time. </p>
     * @param int $minute <p> Minute of the time. </p>
     * @param int $second [optional] <p> Second of the time. </p>
     * @param int $microseconds [optional] <p> Microseconds of the time. </p>
     * @return static|false
     * @since 7.1.0 $microseconds parameter added.
     * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     */
    public function setTime($hour, $minute, $second = 0, $microseconds = 0) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the date and time based on an Unix timestamp
     * @link https://secure.php.net/manual/en/datetimeimmutable.settimestamp.php
     * @param int $unixtimestamp <p>Unix timestamp representing the date.</p>
     * @return static|bool
     * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     */
    public function setTimestamp($unixtimestamp) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the time zone
     * @link https://secure.php.net/manual/en/datetimeimmutable.settimezone.php
     * @param DateTimeZone $timezone <p>
     * A {@link https://secure.php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the
     * desired time zone.
     * </p>
     * @return static|bool
     * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     */
    public function setTimezone(DateTimeZone $timezone) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Subtracts an amount of days, months, years, hours, minutes and seconds
     * @link https://secure.php.net/manual/en/datetimeimmutable.sub.php
     * @param DateInterval $interval <p>
     * A {@link https://secure.php.net/manual/en/class.dateinterval.php DateInterval} object
     * </p>
     * @return static|bool
     * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     */
    public function sub(DateInterval $interval) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the difference between two DateTime objects
     * @link https://secure.php.net/manual/en/datetime.diff.php
     * @param DateTimeInterface $datetime2 <p>The date to compare to.</p>
     * @param bool $absolute [optional] <p>Should the interval be forced to be positive?</p>
     * @return DateInterval
     * The {@link https://secure.php.net/manual/en/class.dateinterval.php DateInterval} object representing the
     * difference between the two dates or <b>FALSE</b> on failure.
     */
    public function diff($datetime2, $absolute = false) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns date formatted according to given format
     * @link https://secure.php.net/manual/en/datetime.format.php
     * @param string $format <p>
     * Format accepted by  {@link https://secure.php.net/manual/en/function.date.php date()}.
     * </p>
     * @return string
     * Returns the formatted date string on success or <b>FALSE</b> on failure.
     *
     */
    public function format($format) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the timezone offset
     * @return int
     * Returns the timezone offset in seconds from UTC on success
     * or <b>FALSE</b> on failure.
     *
     */
    public function getOffset() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Gets the Unix timestamp
     * @return int
     * Returns the Unix timestamp representing the date.
     */
    public function getTimestamp() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Return time zone relative to given DateTime
     * @link https://secure.php.net/manual/en/datetime.gettimezone.php
     * @return DateTimeZone
     * Returns a {@link https://secure.php.net/manual/en/class.datetimezone.php DateTimeZone} object on success
     * or <b>FALSE</b> on failure.
     */
    public function getTimezone() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * The __wakeup handler
     * @link https://secure.php.net/manual/en/datetime.wakeup.php
     * @return void Initializes a DateTime object.
     */
    public function __wakeup() { }
}


/**
 * Representation of date and time.
 * @link https://php.net/manual/en/class.datetime.php
 */
class DateTime implements DateTimeInterface {
    /**
     * (PHP 5 &gt;=5.2.0)<br/>
     * @link https://php.net/manual/en/datetime.construct.php
     * @param string $time [optional]
     * <p>A date/time string. Valid formats are explained in {@link www.php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
     * <p>
     * Enter <b>now</b> here to obtain the current time when using
     * the <em>$timezone</em> parameter.
     * </p>
     * @param DateTimeZone $timezone [optional] <p>
     * A {@link https://php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the
     * timezone of <em>$time</em>.
     * </p>
     * <p>
     * If <em>$timezone</em> is omitted,
     * the current timezone will be used.
     * </p>
     * <blockquote><p><b>Note</b>:
     * </p><p>
     * The <em>$timezone</em> parameter
     * and the current timezone are ignored when the
     *<em>$time</em> parameter either
     * is a UNIX timestamp (e.g. <em>@946684800</em>)
     * or specifies a timezone
     * (e.g. <em>2010-01-28T15:00:00+02:00</em>).
     * </p> <p></p></blockquote>
     * @throws Exception Emits Exception in case of an error.
     */
    public function __construct ($time='now', DateTimeZone $timezone=null) {}

    /**
     * @return void
     * @link https://php.net/manual/en/datetime.wakeup.php
     */
    public function __wakeup () {}


    /**
     * Returns date formatted according to given format.
     * @param string $format
     * @return string
     * @link https://php.net/manual/en/datetime.format.php
     */
    public function format ($format) {}

    /**
     * Alter the timestamp of a DateTime object by incrementing or decrementing
     * in a format accepted by strtotime().
     * @param string $modify A date/time string. Valid formats are explained in <a href="https://secure.php.net/manual/en/datetime.formats.php">Date and Time Formats</a>.
     * @return static Returns the DateTime object for method chaining or FALSE on failure.
     * @link https://php.net/manual/en/datetime.modify.php
     */
    public function modify ($modify) {}

    /**
     * Adds an amount of days, months, years, hours, minutes and seconds to a DateTime object
     * @param DateInterval $interval
     * @return static
     * @link https://php.net/manual/en/datetime.add.php
     */
    public function add (DateInterval $interval) {}


    /**
     * @since 7.3
     * @return DateTime
     */
    public static function createFromImmutable(DateTimeImmutable $datetTimeImmutable) {}

    /**
     * Subtracts an amount of days, months, years, hours, minutes and seconds from a DateTime object
     * @param DateInterval $interval
     * @return static
     * @link https://php.net/manual/en/datetime.sub.php
     */
    public function sub (DateInterval $interval) {}

    /**
     * Get the TimeZone associated with the DateTime
     * @return DateTimeZone
     * @link https://php.net/manual/en/datetime.gettimezone.php
     */
    public function getTimezone () {}

    /**
     * Set the TimeZone associated with the DateTime
     * @param DateTimeZone $timezone
     * @return static
     * @link https://php.net/manual/en/datetime.settimezone.php
     */
    public function setTimezone ($timezone) {}

    /**
     * Returns the timezone offset
     * @return int
     * @link https://php.net/manual/en/datetime.getoffset.php
     */
    public function getOffset () {}

    /**
     * Sets the current time of the DateTime object to a different time.
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param int $microseconds
     * @return static|false
     * @since 7.1.0 $microseconds parameter added.
     * @link https://php.net/manual/en/datetime.settime.php
     */
    public function setTime ($hour, $minute, $second=0, $microseconds=0) {}

    /**
     * Sets the current date of the DateTime object to a different date.
     * @param int $year
     * @param int $month
     * @param int $day
     * @return static
     * @link https://php.net/manual/en/datetime.setdate.php
     */
    public function setDate ($year, $month, $day) {}

    /**
     * Set a date according to the ISO 8601 standard - using weeks and day offsets rather than specific dates.
     * @param int $year
     * @param int $week
     * @param int $day
     * @return static
     * @link https://php.net/manual/en/datetime.setisodate.php
     */
    public function setISODate ($year, $week, $day=1) {}

    /**
     * Sets the date and time based on a Unix timestamp.
     * @param int $unixtimestamp
     * @return static
     * @link https://php.net/manual/en/datetime.settimestamp.php
     */
    public function setTimestamp ($unixtimestamp) {}

    /**
     * Gets the Unix timestamp.
     * @return int
     * @link https://php.net/manual/en/datetime.gettimestamp.php
     */
    public function getTimestamp () {}

    /**
     * Returns the difference between two DateTime objects represented as a DateInterval.
     * @param DateTimeInterface $datetime2 The date to compare to.
     * @param boolean $absolute [optional] Whether to return absolute difference.
     * @return DateInterval|boolean The DateInterval object representing the difference between the two dates or FALSE on failure.
     * @link https://php.net/manual/en/datetime.diff.php
     */
    public function diff ($datetime2, $absolute = false) {}


    /**
     * Parse a string into a new DateTime object according to the specified format
     * @param string $format Format accepted by date().
     * @param string $time String representing the time.
     * @param DateTimeZone $timezone A DateTimeZone object representing the desired time zone.
     * @return DateTime|boolean
     * @link https://php.net/manual/en/datetime.createfromformat.php
     */
    public static function createFromFormat ($format, $time, DateTimeZone $timezone=null) {}

    /**
     * Returns an array of warnings and errors found while parsing a date/time string
     * @return array
     * @link https://php.net/manual/en/datetime.getlasterrors.php
     */
    public static function getLastErrors () {}

    /**
     * The __set_state handler
     * @link https://php.net/manual/en/datetime.set-state.php
     * @param array $array <p>Initialization array.</p>
     * @return DateTime <p>Returns a new instance of a DateTime object.</p>
     */
    public static function __set_state ($array) {}
}

/**
 * Representation of time zone
 * @link https://php.net/manual/en/class.datetimezone.php
 */
class DateTimeZone {
    const AFRICA = 1;
    const AMERICA = 2;
    const ANTARCTICA = 4;
    const ARCTIC = 8;
    const ASIA = 16;
    const ATLANTIC = 32;
    const AUSTRALIA = 64;
    const EUROPE = 128;
    const INDIAN = 256;
    const PACIFIC = 512;
    const UTC = 1024;
    const ALL = 2047;
    const ALL_WITH_BC = 4095;
    const PER_COUNTRY = 4096;


    /**
     * @param string $timezone
     * @link https://php.net/manual/en/datetimezone.construct.php
     */
    public function __construct ($timezone) {}

    /**
     * Returns the name of the timezone
     * @return string
     * @link https://php.net/manual/en/datetimezone.getname.php
     */
    public function getName () {}

    /**
     * Returns location information for a timezone
     * @return array
     * @link https://php.net/manual/en/datetimezone.getlocation.php
     */
    public function getLocation () {}

    /**
     * Returns the timezone offset from GMT
     * @param DateTimeInterface $datetime
     * @return int
     * @link https://php.net/manual/en/datetimezone.getoffset.php
     */
    public function getOffset (DateTimeInterface $datetime) {}

    /**
     * Returns all transitions for the timezone
     * @param int $timestamp_begin [optional]
     * @param int $timestamp_end [optional]
     * @return array
     * @link https://php.net/manual/en/datetimezone.gettransitions.php
     */
    public function getTransitions ($timestamp_begin=null, $timestamp_end=null) {}


    /**
     * Returns associative array containing dst, offset and the timezone name
     * @return array
     * @link https://php.net/manual/en/datetimezone.listabbreviations.php
     */
    public static function listAbbreviations () {}

    /**
     * Returns a numerically indexed array with all timezone identifiers
     * @param int $what
     * @param string $country
     * @return array
     * @link https://php.net/manual/en/datetimezone.listidentifiers.php
     */
    public static function listIdentifiers ($what=DateTimeZone::ALL, $country=null) {}

    /**
     * @link https://php.net/manual/en/datetime.wakeup.php
     */
    public function __wakeup(){}


    public static function __set_state($an_array) {}
}

/**
 * Representation of date interval. A date interval stores either a fixed amount of
 * time (in years, months, days, hours etc) or a relative time string in the format
 * that DateTime's constructor supports.
 * @link https://php.net/manual/en/class.dateinterval.php
 */
class DateInterval {
    /**
     * Number of years
     * @var int
     */
    public $y;

    /**
     * Number of months
     * @var int
     */
    public $m;

    /**
     * Number of days
     * @var int
     */
    public $d;

    /**
     * Number of hours
     * @var int
     */
    public $h;

    /**
     * Number of minutes
     * @var int
     */
    public $i;

    /**
     * Number of seconds
     * @var int
     */
    public $s;

    /**
     * Number of microseconds
     * @since 7.1.0
     * @var float
     */
    public $f;

    /**
     * Is 1 if the interval is inverted and 0 otherwise
     * @var int
     */
    public $invert;

    /**
     * Total number of days the interval spans. If this is unknown, days will be FALSE.
     * @var mixed
     */
    public $days;


    /**
     * @param string $interval_spec
     * @link https://php.net/manual/en/dateinterval.construct.php
     * @throws \Exception when the interval_spec cannot be parsed as an interval.
     */
    public function __construct ($interval_spec) {}

    /**
     * Formats the interval
     * @param $format
     * @return string
     * @link https://php.net/manual/en/dateinterval.format.php
     */
    public function format ($format) {}

    /**
     * Sets up a DateInterval from the relative parts of the string
     * @param string $time
     * @return DateInterval
     * @link https://php.net/manual/en/dateinterval.createfromdatestring.php
     */
    public static function createFromDateString ($time) {}

    public function __wakeup() {}

    public static function __set_state($an_array) {}
}

/**
 * Representation of date period.
 * @link https://php.net/manual/en/class.dateperiod.php
 * @since 5.3.0
 */
class DatePeriod implements Traversable {
    const EXCLUDE_START_DATE = 1;
    
    /**
     * Start date
     * @var DateTimeInterface
     */
    public $start;

    /**
     * Current iterator value.
     * @var DateTimeInterface|null
     */
    public $current;
    
    /**
     * End date.
     * @var DateTimeInterface|null
     */
    public $end;
    
    /**
     * The interval
     * @var DateInterval
     */
    public $interval;
    
    /**
     * Number of recurrences.
     * @var int
     */
    public $recurrences;
    
    /**
     * Start of period.
     * @var bool
     */
    public $include_start_date;
    
    /**
     * @param DateTimeInterface $start
     * @param DateInterval $interval
     * @param DateTimeInterface $end
     * @param int $options Can be set to DatePeriod::EXCLUDE_START_DATE.
     * @link https://php.net/manual/en/dateperiod.construct.php
     * @since 5.3.0
     */
    public function __construct (DateTimeInterface $start, DateInterval $interval, DateTimeInterface $end, $options=0) {}

    /**
     * @param DateTimeInterface $start
     * @param DateInterval $interval
     * @param int $recurrences Number of recurrences
     * @param int $options Can be set to DatePeriod::EXCLUDE_START_DATE.
     * @link https://php.net/manual/en/dateperiod.construct.php
     * @since 5.3.0
     */
    public function __construct (DateTimeInterface $start, DateInterval $interval, $recurrences, $options=0) {}

    /**
     * @param string $isostr String containing the ISO interval.
     * @param int $options Can be set to DatePeriod::EXCLUDE_START_DATE.
     * @link https://php.net/manual/en/dateperiod.construct.php
     * @since 5.3.0
     */
    public function __construct ($isostr, $options=0) {}

    /**
     * Gets the interval
     * @return DateInterval
     * @link https://php.net/manual/en/dateperiod.getdateinterval.php
     * @since 5.6.5
     */
    public function getDateInterval () {}

    /**
     * Gets the end date
     * @return DateTimeInterface|null
     * @link https://php.net/manual/en/dateperiod.getenddate.php
     * @since 5.6.5
     */
    public function getEndDate () {}

    /**
     * Gets the start date
     * @return DateTimeInterface
     * @link https://php.net/manual/en/dateperiod.getstartdate.php
     * @since 5.6.5
     */
    public function getStartDate () {}

    public static function __set_state ($array){}

    public function __wakeup() {}

}
