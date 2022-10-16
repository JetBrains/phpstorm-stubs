<?php

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Internal\TentativeType;

/**
 * Representation of date and time.
 * @link https://php.net/manual/en/class.datetime.php
 */
class DateTime
{
    /**
     * @removed 7.2
     */
    public const ATOM = 'Y-m-d\TH:i:sP';

    /**
     * @removed 7.2
     */
    public const COOKIE = 'l, d-M-Y H:i:s T';

    /**
     * @removed 7.2
     */
    public const ISO8601 = 'Y-m-d\TH:i:sO';

    /**
     * @removed 7.2
     */
    public const RFC822 = 'D, d M y H:i:s O';

    /**
     * @removed 7.2
     */
    public const RFC850 = 'l, d-M-y H:i:s T';

    /**
     * @removed 7.2
     */
    public const RFC1036 = 'D, d M y H:i:s O';

    /**
     * @removed 7.2
     */
    public const RFC1123 = 'D, d M Y H:i:s O';

    /**
     * @removed 7.2
     */
    public const RFC2822 = 'D, d M Y H:i:s O';

    /**
     * @removed 7.2
     */
    public const RFC3339 = 'Y-m-d\TH:i:sP';

    /**
     * @removed 7.2
     */
    public const RFC3339_EXTENDED = 'Y-m-d\TH:i:s.vP';

    /**
     * @removed 7.2
     */
    public const RFC7231 = 'D, d M Y H:i:s \G\M\T';

    /**
     * @removed 7.2
     */
    public const RSS = 'D, d M Y H:i:s O';

    /**
     * @removed 7.2
     */
    public const W3C = 'Y-m-d\TH:i:sP';

    /**
     * (PHP 5 >=5.2.0)<br/>
     * @link https://php.net/manual/en/datetime.construct.php
     * @param string $datetime [optional]
     * <p>A date/time string. Valid formats are explained in {@link https://php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
     * <p>
     * Enter <b>now</b> here to obtain the current time when using
     * the <em>$timezone</em> parameter.
     * </p>
     * @param null|DateTimeZone $timezone [optional] <p>
     * A {@link https://php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the
     * timezone of <em>$datetime</em>.
     * </p>
     * <p>
     * If <em>$timezone</em> is omitted,
     * the current timezone will be used.
     * </p>
     * <blockquote><p><b>Note</b>:
     * </p><p>
     * The <em>$timezone</em> parameter
     * and the current timezone are ignored when the
     * <em>$time</em> parameter either
     * is a UNIX timestamp (e.g. <em>@946684800</em>)
     * or specifies a timezone
     * (e.g. <em>2010-01-28T15:00:00+02:00</em>).
     * </p> <p></p></blockquote>
     * @throws Exception Emits Exception in case of an error.
     * @since 5.2
     */
    public function __construct($datetime = 'now', DateTimeZone $timezone = null) {}

    /**
     * Parse a string into a new DateTime object according to the specified format
     * @param string $format Format accepted by date().
     * @param string $datetime String representing the time.
     * @param null|DateTimeZone $timezone A DateTimeZone object representing the desired time zone.
     * @return DateTime|false
     * @link https://php.net/manual/en/datetime.createfromformat.php
     */
    #[TentativeType]
    public static function createFromFormat($format, $datetime, DateTimeZone $timezone = null): DateTime|false {}

    /**
     * Returns an array of warnings and errors found while parsing a date/time string
     * @return array|false
     * @link https://php.net/manual/en/datetime.getlasterrors.php
     */
    #[ArrayShape(["warning_count" => "int", "warnings" => "string[]", "error_count" => "int", "errors" => "string[]"])]
    #[TentativeType]
    public static function getLastErrors(): array|false {}

    /**
     * The __set_state handler
     * @link https://php.net/manual/en/datetime.set-state.php
     * @param array $array <p>Initialization array.</p>
     * @return DateTime <p>Returns a new instance of a DateTime object.</p>
     */
    public static function __set_state($array) {}

    /**
     * @return void
     * @link https://php.net/manual/en/datetime.wakeup.php
     */
    #[TentativeType]
    public function __wakeup(): void {}

    /**
     * Returns date formatted according to given format.
     * @param string $format
     * @return string
     * @link https://php.net/manual/en/datetime.format.php
     */
    #[TentativeType]
    public function format($format): string {}

    /**
     * Alter the timestamp of a DateTime object by incrementing or decrementing
     * in a format accepted by strtotime().
     * @param string $modifier A date/time string. Valid formats are explained in <a href="https://secure.php.net/manual/en/datetime.formats.php">Date and Time Formats</a>.
     * @return static|false Returns the DateTime object for method chaining or FALSE on failure.
     * @link https://php.net/manual/en/datetime.modify.php
     */
    #[TentativeType]
    public function modify($modifier): DateTime|false {}

    /**
     * Adds an amount of days, months, years, hours, minutes and seconds to a DateTime object
     * @param DateInterval $interval
     * @return static
     * @link https://php.net/manual/en/datetime.add.php
     */
    #[TentativeType]
    public function add(DateInterval $interval): DateTime {}

    /**
     * Subtracts an amount of days, months, years, hours, minutes and seconds from a DateTime object
     * @param DateInterval $interval
     * @return static
     * @link https://php.net/manual/en/datetime.sub.php
     */
    #[TentativeType]
    public function sub(DateInterval $interval): DateTime {}

    /**
     * Get the TimeZone associated with the DateTime
     * @return DateTimeZone|false
     * @link https://php.net/manual/en/datetime.gettimezone.php
     */
    #[TentativeType]
    public function getTimezone(): DateTimeZone|false {}

    /**
     * Set the TimeZone associated with the DateTime
     * @param DateTimeZone $timezone
     * @return static
     * @link https://php.net/manual/en/datetime.settimezone.php
     */
    #[TentativeType]
    public function setTimezone($timezone): DateTime {}

    /**
     * Returns the timezone offset
     * @return int
     * @link https://php.net/manual/en/datetime.getoffset.php
     */
    #[TentativeType]
    public function getOffset(): int {}

    /**
     * Sets the current time of the DateTime object to a different time.
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param int $microsecond Added since 7.1
     * @return static
     * @link https://php.net/manual/en/datetime.settime.php
     */
    #[TentativeType]
    public function setTime($hour, $minute, $second = 0): DateTime {}

    /**
     * Sets the current date of the DateTime object to a different date.
     * @param int $year
     * @param int $month
     * @param int $day
     * @return static
     * @link https://php.net/manual/en/datetime.setdate.php
     */
    #[TentativeType]
    public function setDate($year, $month, $day): DateTime {}

    /**
     * Set a date according to the ISO 8601 standard - using weeks and day offsets rather than specific dates.
     * @param int $year
     * @param int $week
     * @param int $dayOfWeek
     * @return static
     * @link https://php.net/manual/en/datetime.setisodate.php
     */
    #[TentativeType]
    public function setISODate($year, $week, $dayOfWeek = 1): DateTime {}

    /**
     * Sets the date and time based on a Unix timestamp.
     * @param int $timestamp
     * @return static
     * @link https://php.net/manual/en/datetime.settimestamp.php
     */
    #[TentativeType]
    public function setTimestamp($timestamp): DateTime {}

    /**
     * Gets the Unix timestamp.
     * @return int
     * @link https://php.net/manual/en/datetime.gettimestamp.php
     */
    #[TentativeType]
    public function getTimestamp(): int {}

    /**
     * Returns the difference between two DateTime objects represented as a DateInterval.
     * @param DateTime $targetObject The date to compare to.
     * @param bool $absolute [optional] Whether to return absolute difference.
     * @return DateInterval|false The DateInterval object representing the difference between the two dates.
     * @link https://php.net/manual/en/datetime.diff.php
     */
    #[TentativeType]
    public function diff($targetObject, $absolute = false): DateInterval {}
}

/**
 * Representation of time zone
 * @link https://php.net/manual/en/class.datetimezone.php
 */
class DateTimeZone
{
    public const AFRICA = 1;
    public const AMERICA = 2;
    public const ANTARCTICA = 4;
    public const ARCTIC = 8;
    public const ASIA = 16;
    public const ATLANTIC = 32;
    public const AUSTRALIA = 64;
    public const EUROPE = 128;
    public const INDIAN = 256;
    public const PACIFIC = 512;
    public const UTC = 1024;
    public const ALL = 2047;
    public const ALL_WITH_BC = 4095;
    public const PER_COUNTRY = 4096;

    /**
     * @param string $timezone
     * @link https://php.net/manual/en/datetimezone.construct.php
     */
    public function __construct($timezone) {}

    /**
     * Returns associative array containing dst, offset and the timezone name
     * @return array
     * @link https://php.net/manual/en/datetimezone.listabbreviations.php
     */
    #[TentativeType]
    public static function listAbbreviations(): array {}

    /**
     * Returns a numerically indexed array with all timezone identifiers
     * @param int $timezoneGroup
     * @param string $countryCode
     * @return array|false Returns the array of timezone identifiers, or <b>FALSE</b> on failure. Since PHP8, always returns <b>array</b>.
     * @link https://php.net/manual/en/datetimezone.listidentifiers.php
     */
    #[TentativeType]
    public static function listIdentifiers($timezoneGroup = DateTimeZone::ALL, $countryCode = null): array|false {}

    public static function __set_state($an_array) {}

    /**
     * Returns the name of the timezone
     * @return string
     * @link https://php.net/manual/en/datetimezone.getname.php
     */
    #[TentativeType]
    public function getName(): string {}

    /**
     * Returns location information for a timezone
     * @return array|false
     * @link https://php.net/manual/en/datetimezone.getlocation.php
     */
    #[TentativeType]
    #[ArrayShape(["country_code" => "string", "latitude" => "double", "longitude" => "double", "comments" => "string"])]
    public function getLocation(): array|false {}

    /**
     * Returns the timezone offset from GMT
     * @param DateTime $datetime
     * @return int
     * @link https://php.net/manual/en/datetimezone.getoffset.php
     */
    #[TentativeType]
    public function getOffset($datetime): int {}

    /**
     * Returns all transitions for the timezone
     * @param int $timestampBegin
     * @param int $timestampEnd
     * @return array|false
     * @link https://php.net/manual/en/datetimezone.gettransitions.php
     */
    #[TentativeType]
    public function getTransitions($timestampBegin, $timestampEnd): array|false {}

    /**
     * @link https://php.net/manual/en/datetime.wakeup.php
     */
    #[TentativeType]
    public function __wakeup(): void {}
}

/**
 * Representation of date interval. A date interval stores either a fixed amount of
 * time (in years, months, days, hours etc) or a relative time string in the format
 * that DateTime's constructor supports.
 * @link https://php.net/manual/en/class.dateinterval.php
 */
class DateInterval
{
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
     * @var int|false
     */
    public $days;

    /**
     * @param string $duration
     * @throws Exception when the $duration cannot be parsed as an interval.
     * @link https://php.net/manual/en/dateinterval.construct.php
     */
    public function __construct($duration) {}

    /**
     * Sets up a DateInterval from the relative parts of the string
     * @param string $datetime
     * @return DateInterval|false Returns a new {@link https://www.php.net/manual/en/class.dateinterval.php DateInterval}
     * instance on success, or <b>FALSE</b> on failure.
     * @link https://php.net/manual/en/dateinterval.createfromdatestring.php
     */
    #[TentativeType]
    public static function createFromDateString($datetime): DateInterval|false {}

    public static function __set_state($an_array) {}

    /**
     * Formats the interval
     * @param string $format
     * @return string
     * @link https://php.net/manual/en/dateinterval.format.php
     */
    #[TentativeType]
    public function format($format): string {}

    #[TentativeType]
    public function __wakeup(): void {}
}

/**
 * Representation of date period.
 * @link https://php.net/manual/en/class.dateperiod.php
 * @template TDate of DateTime
 * @template TEnd of ?DateTime
 * @implements IteratorAggregate<int, TDate>
 */
class DatePeriod implements IteratorAggregate
{
    public const EXCLUDE_START_DATE = 1;

    /**
     * Start date
     * @var DateTime
     */
    #[Immutable]
    public $start;

    /**
     * Current iterator value.
     * @var DateTime|null
     */
    public $current;

    /**
     * End date.
     * @var DateTime|null
     */
    #[Immutable]
    public $end;

    /**
     * The interval
     * @var DateInterval
     */
    #[Immutable]
    public $interval;

    /**
     * Number of recurrences.
     * @var int
     */
    #[Immutable]
    public $recurrences;

    /**
     * Start of period.
     * @var bool
     */
    #[Immutable]
    public $include_start_date;

    /**
     * @since 8.2
     */
    #[Immutable]
    public bool $include_end_date;

    /**
     * @param TDate $start
     * @param DateInterval $interval
     * @param TEnd $end
     * @param int $options Can be set to DatePeriod::EXCLUDE_START_DATE.
     * @link https://php.net/manual/en/dateperiod.construct.php
     */
    public function __construct($start, DateInterval $interval, $end, $options = 0) {}

    /**
     * @param TDate $start
     * @param DateInterval $interval
     * @param int $recurrences Number of recurrences
     * @param int $options Can be set to DatePeriod::EXCLUDE_START_DATE.
     * @link https://php.net/manual/en/dateperiod.construct.php
     */
    public function __construct($start, DateInterval $interval, $recurrences, $options = 0) {}

    /**
     * @param string $isostr String containing the ISO interval.
     * @param int $options Can be set to DatePeriod::EXCLUDE_START_DATE.
     * @link https://php.net/manual/en/dateperiod.construct.php
     */
    public function __construct($isostr, $options = 0) {}

    #[TentativeType]
    public static function __set_state(): DatePeriod {}

    #[TentativeType]
    public function __wakeup(): void {}
}
