<?php

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use JetBrains\PhpStorm\Internal\PhpStormStubsElementAvailable;
use JetBrains\PhpStorm\Internal\TentativeType;
use JetBrains\PhpStorm\Pure;

/**
 * DateTimeInterface was created so that parameter, return, or property type declarations may accept
 * either DateTimeImmutable or DateTime as a value. It is not possible to implement this interface
 * with userland classes.
 *
 * Common constants that allow for formatting DateTimeImmutable or DateTime objects through
 * DateTimeImmutable::format and DateTime::format are also defined on this interface.
 *
 * @link https://php.net/manual/en/class.datetimeinterface.php
 * @since 5.5
 */
interface DateTimeInterface
{
    /**
     * @since 7.2
     */
    public const ATOM = 'Y-m-d\TH:i:sP';

    /**
     * @since 7.2
     */
    public const COOKIE = 'l, d-M-Y H:i:s T';

    /**
     * This format is not compatible with ISO-8601, but is left this way for backward compatibility reasons.
     * Use DateTime::ATOM or DATE_ATOM for compatibility with ISO-8601 instead.
     * @since 7.2
     * @deprecated
     */
    public const ISO8601 = 'Y-m-d\TH:i:sO';

    /**
     * @since 8.2
     */
    public const ISO8601_EXPANDED = DATE_ISO8601_EXPANDED;

    /**
     * @since 7.2
     */
    public const RFC822 = 'D, d M y H:i:s O';

    /**
     * @since 7.2
     */
    public const RFC850 = 'l, d-M-y H:i:s T';

    /**
     * @since 7.2
     */
    public const RFC1036 = 'D, d M y H:i:s O';

    /**
     * @since 7.2
     */
    public const RFC1123 = 'D, d M Y H:i:s O';

    /**
     * @since 7.2
     */
    public const RFC2822 = 'D, d M Y H:i:s O';

    /**
     * @since 7.2
     */
    public const RFC3339 = 'Y-m-d\TH:i:sP';

    /**
     * @since 7.2
     */
    public const RFC3339_EXTENDED = 'Y-m-d\TH:i:s.vP';

    /**
     * @since 7.2
     */
    #[\JetBrains\PhpStorm\Deprecated(since: '8.5')]
    public const RFC7231 = 'D, d M Y H:i:s \G\M\T';

    /**
     * @since 7.2
     */
    public const RSS = 'D, d M Y H:i:s O';

    /**
     * @since 7.2
     */
    public const W3C = 'Y-m-d\TH:i:sP';

    /* Methods */
    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the difference between two DateTime objects
     * @link https://php.net/manual/en/datetime.diff.php
     * @param DateTimeInterface $targetObject <p>The date to compare to.</p>
     * @param bool $absolute <p>Should the interval be forced to be positive?</p>
     * @return DateInterval
     * The https://secure.php.net/manual/en/class.dateinterval.php DateInterval} object representing the
     * difference between the two dates.
     */
    #[TentativeType]
    public function diff(
        DateTimeInterface $targetObject,
        #[LanguageLevelTypeAware(['8.0' => 'bool'], default: '')] $absolute = false
    ): DateInterval;

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns date formatted according to given format
     * @link https://php.net/manual/en/datetime.format.php
     * @param string $format <p>
     * Format accepted by  {@link https://php.net/manual/en/function.date.php date()}.
     * </p>
     * @return string
     * Returns the formatted date string on success.
     * Prior to PHP 8.1, <b>FALSE</b> was returned on failure.
     */
    #[Pure(true)]
    #[TentativeType]
    public function format(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $format): string;

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the timezone offset
     * @link https://php.net/manual/en/datetime.getoffset.php
     * @return int|false
     * Returns the timezone offset in seconds from UTC on success.
     * Prior to PHP 8.0, <b>FALSE</b> was returned on failure.
     */
    #[LanguageLevelTypeAware(["8.0" => "int"], default: "int|false")]
    #[TentativeType]
    public function getOffset();

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Gets the Unix timestamp
     * @link https://php.net/manual/en/datetime.gettimestamp.php
     * @return int
     * Returns the Unix timestamp representing the date.
     */
    #[TentativeType]
    #[LanguageLevelTypeAware(['8.1' => 'int'], default: 'int|false')]
    public function getTimestamp();

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Return time zone relative to given DateTime
     * @link https://php.net/manual/en/datetime.gettimezone.php
     * @return DateTimeZone|false
     * Returns a {@link https://php.net/manual/en/class.datetimezone.php DateTimeZone} object on success
     * or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function getTimezone(): DateTimeZone|false;

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * The __wakeup handler
     * @link https://php.net/manual/en/datetime.wakeup.php
     * @return void Initializes a DateTime object.
     */
    #[TentativeType]
    #[\JetBrains\PhpStorm\Deprecated(since: '8.5')]
    public function __wakeup(): void;

    /**
     * Serialize a DateTime
     *
     * The __serialize() handler.
     *
     * @link https://php.net/manual/en/datetime.serialize.php
     * @return array The serialized representation of the DateTime object.
     */
    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __serialize(): array;

    /**
     * Unserialize an Datetime
     *
     * The __unserialize() handler.
     *
     * @link https://php.net/manual/en/datetime.unserialize.php
     * @param array $data The serialized DateTime.
     */
    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __unserialize(array $data): void;

    /**
     * Gets the microsecond part of the Unix timestamp
     * @link https://php.net/manual/en/datetimeinterface.getmicrosecond.php
     * @since 8.4
     */
    public function getMicrosecond(): int;
}

/**
 * Representation of date and time.
 *
 * This class behaves the same as DateTime except new objects are returned when modification methods
 * such as DateTime::modify are called.
 *
 * @link https://php.net/manual/en/class.datetimeimmutable.php
 * @since 5.5
 */
class DateTimeImmutable implements DateTimeInterface
{
    /* Methods */
    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * @link https://php.net/manual/en/datetimeimmutable.construct.php
     * @param string $datetime [optional]
     * <p>A date/time string. Valid formats are explained in {@link https://php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
     * <p>Enter <b>'now'</b> here to obtain the current time when using the <em>$timezone</em> parameter.</p>
     * @param null|DateTimeZone $timezone [optional] <p>
     * A {@link https://php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the timezone of <em>$datetime</em>.
     * </p>
     * <p>If <em>$timezone</em> is omitted, the current timezone will be used.</p>
     * <blockquote><p><b>Note</b>:</p><p>
     * The <em>$timezone</em> parameter and the current timezone are ignored when the <em>$datetime</em> parameter either
     * is a UNIX timestamp (e.g. <em>@946684800</em>) or specifies a timezone (e.g. <em>2010-01-28T15:00:00+02:00</em>).
     * </p></blockquote>
     * @throws Exception Emits Exception in case of an error.
     */
    #[PhpStormStubsElementAvailable(from: '5.5', to: '8.2')]
    public function __construct(
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime = "now",
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeZone|null'], default: 'DateTimeZone')] $timezone = null
    ) {}

    /**
     * (PHP 8 &gt;=8.3.0)<br/>
     * @link https://php.net/manual/en/datetimeimmutable.construct.php
     * @param string $datetime [optional]
     * <p>A date/time string. Valid formats are explained in {@link https://php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
     * <p>Enter <b>'now'</b> here to obtain the current time when using the <em>$timezone</em> parameter.</p>
     * @param null|DateTimeZone $timezone [optional] <p>
     * A {@link https://php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the timezone of <em>$datetime</em>.
     * </p>
     * <p>If <em>$timezone</em> is omitted, the current timezone will be used.</p>
     * <blockquote><p><b>Note</b>:</p><p>
     * The <em>$timezone</em> parameter and the current timezone are ignored when the <em>$datetime</em> parameter either
     * is a UNIX timestamp (e.g. <em>@946684800</em>) or specifies a timezone (e.g. <em>2010-01-28T15:00:00+02:00</em>).
     * </p></blockquote>
     * @throws DateMalformedStringException Emits Exception in case of an error.
     */
    #[PhpStormStubsElementAvailable(from: '8.3')]
    public function __construct(
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime = "now",
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeZone|null'], default: 'DateTimeZone')] $timezone = null
    ) {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Adds an amount of days, months, years, hours, minutes and seconds
     * @param DateInterval $interval A DateInterval object
     * @return static Returns a new DateTimeImmutable object with the modified data.
     * @link https://php.net/manual/en/datetimeimmutable.add.php
     */
    #[TentativeType]
    #[\NoDiscard(message: "as DateTimeImmutable::add() does not modify the object itself")]
    public function add(DateInterval $interval): DateTimeImmutable {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns new DateTimeImmutable object formatted according to the specified format
     * @link https://php.net/manual/en/datetimeimmutable.createfromformat.php
     * @param string $format
     * @param string $datetime
     * @param null|DateTimeZone $timezone [optional]
     * @return DateTimeImmutable|false
     */
    #[TentativeType]
    #[PhpStormStubsElementAvailable(from: '5.5', to: '7.4')]
    public static function createFromFormat(
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $format,
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime,
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeZone|null'], default: 'DateTimeZone')] $timezone = null
    ): DateTimeImmutable|false {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns new DateTimeImmutable object formatted according to the specified format
     * @link https://php.net/manual/en/datetimeimmutable.createfromformat.php
     * @param string $format The format that the passed in string should be in. See the formatting
     * options below. In most cases, the same letters as for the date can be used. All fields are
     * initialised with the current date/time. In most cases you would want to reset these to "zero"
     * (the Unix epoch, 1970-01-01 00:00:00 UTC). You do that by including the ! character as first
     * character in your format, or | as your last. Please see the documentation for each character
     * below for more information. The format is parsed from left to right, which means that in some
     * situations the order in which the format characters are present affects the result. In the
     * case of z (the day of the year), it is required that a year has already been parsed, for
     * example through the Y or y characters. Letters that are used for parsing numbers allow a wide
     * range of values, outside of what the logical range would be. For example, the d (day of the
     * month) accepts values in the range from 00 to 99. The only constraint is on the amount of
     * digits. The date/time parser's overflow mechanism is used when out-of-range values are given.
     * The examples below show some of this behaviour. This also means that the data parsed for a
     * format letter is greedy, and will read up to the amount of digits its format allows for. That
     * can then also mean that there are no longer enough characters in the datetime string for
     * following format characters. An example on this page also illustrates this issue. The
     * following characters are recognized in the format parameter string format character
     * Description Example parsable values Day --- --- d and j Day of the month, 2 digits with or
     * without leading zeros 01 to 31 or 1 to 31. (2 digit numbers higher than the number of days in
     * the month are accepted, in which case they will make the month overflow. For example using 33
     * with January, means February 2nd) D and l A textual representation of a day Mon through Sun
     * or Sunday through Saturday. If the day name given is different than the day name belonging to
     * a parsed (or default) date is different, then an overflow occurs to the next date with the
     * given day name. See the examples below for an explanation. S English ordinal suffix for the
     * day of the month, 2 characters. It's ignored while processing. st, nd, rd or th. z The day of
     * the year (starting from 0); must be preceded by Y or y. 0 through 365. (3 digit numbers
     * higher than the numbers in a year are accepted, in which case they will make the year
     * overflow. For example using 366 with 2022, means January 2nd, 2023) Month --- --- F and M A
     * textual representation of a month, such as January or Sept January through December or Jan
     * through Dec m and n Numeric representation of a month, with or without leading zeros 01
     * through 12 or 1 through 12. (2 digit numbers higher than 12 are accepted, in which case they
     * will make the year overflow. For example using 13 means January in the next year) Year ---
     * --- X and x A full numeric representation of a year, up to 19 digits, optionally prefixed by
     * + or - Examples: 0055, 787, 1999, -2003, +10191 Y A full numeric representation of a year, up
     * to 4 digits Examples: 25 (same as 0025), 787, 1999, 2003 y A two digit representation of a
     * year (which is assumed to be in the range 1970-2069, inclusive) Examples: 99 or 03 (which
     * will be interpreted as 1999 and 2003, respectively) Time --- --- a and A Ante meridiem and
     * Post meridiem am or pm g and h 12-hour format of an hour with or without leading zero 1
     * through 12 or 01 through 12 (2 digit numbers higher than 12 are accepted, in which case they
     * will make the day overflow. For example using 14 means 02 in the next AM/PM period) G and H
     * 24-hour format of an hour with or without leading zeros 0 through 23 or 00 through 23 (2
     * digit numbers higher than 24 are accepted, in which case they will make the day overflow. For
     * example using 26 means 02:00 the next day) i Minutes with leading zeros 00 to 59. (2 digit
     * numbers higher than 59 are accepted, in which case they will make the hour overflow. For
     * example using 66 means :06 the next hour) s Seconds, with leading zeros 00 through 59 (2
     * digit numbers higher than 59 are accepted, in which case they will make the minute overflow.
     * For example using 90 means :30 the next minute) v Fraction in milliseconds (up to three
     * digits) Example: 12 (0.12 seconds), 345 (0.345 seconds) u Fraction in microseconds (up to six
     * digits) Example: 45 (0.45 seconds), 654321 (0.654321 seconds) Timezone --- --- e, O, p, P and
     * T Timezone identifier, or difference to UTC in hours, or difference to UTC with colon between
     * hours and minutes, or timezone abbreviation Examples: UTC, GMT, Atlantic/Azores or +0200 or
     * +02:00 or EST, MDT Full Date/Time --- --- U Seconds since the Unix Epoch (January 1 1970
     * 00:00:00 GMT) Example: 1292177455 Whitespace and Separators --- --- (space) Zero or more
     * spaces, tabs, NBSP (U+A0), or NNBSP (U+202F) characters Example: "\t", " " # One of the
     * following separation symbol: ;, :, /, ., ,, -, ( or ) Example: / ;, :, /, ., ,, -, ( or ) The
     * specified character. Example: - ? A random byte Example: ^ (Be aware that for UTF-8
     * characters you might need more than one ?. In this case, using * is probably what you want
     * instead) * Random bytes until the next separator or digit Example: * in Y-*-d with the string
     * 2009-aWord-08 will match aWord ! Resets all fields (year, month, day, hour, minute, second,
     * fraction and timezone information) to zero-like values ( 0 for hour, minute, second and
     * fraction, 1 for month and day, 1970 for year and the default timezone) Without !, all fields
     * will be set to the current date and time. | Resets all fields (year, month, day, hour,
     * minute, second, fraction and timezone information) to zero-like values if they have not been
     * parsed yet Y-m-d| will set the year, month and day to the information found in the string to
     * parse, and sets the hour, minute and second to 0. + If this format specifier is present,
     * trailing data in the string will not cause an error, but a warning instead Use
     * DateTimeImmutable::getLastErrors to find out whether trailing data was present. Unrecognized
     * characters in the format string will cause the parsing to fail and an error message is
     * appended to the returned structure. You can query error messages with
     * DateTimeImmutable::getLastErrors. To include literal characters in format, you have to escape
     * them with a backslash (\). If format does not contain the character ! then portions of the
     * generated date/time which are not specified in format will be set to the current system time.
     * If format contains the character !, then portions of the generated date/time not provided in
     * format, as well as values to the left-hand side of the !, will be set to corresponding values
     * from the Unix epoch. If any time character is parsed, then all other time-related fields are
     * set to "0", unless also parsed. The Unix epoch is 1970-01-01 00:00:00 UTC.
     * @param string $datetime String representing the time.
     * @param null|DateTimeZone $timezone [optional]
     * @return DateTimeImmutable|false Returns a new DateTimeImmutable instance or false on failure.
     * @throws ValueError when the datetime contains NULL-bytes.
     */
    #[TentativeType]
    #[PhpStormStubsElementAvailable(from: '8.0')]
    public static function createFromFormat(
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $format,
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime,
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeZone|null'], default: 'DateTimeZone')] $timezone = null
    ): DateTimeImmutable|false {}

    /**
     * (PHP 5 &gt;=5.6.0)<br/>
     * Returns new DateTimeImmutable object encapsulating the given DateTime object
     * @link https://php.net/manual/en/datetimeimmutable.createfrommutable.php
     * @param DateTime $object The mutable DateTime object that you want to convert to an immutable version. This object is not modified, but instead a new DateTimeImmutable object is created containing the same date time and timezone information.
     * @return DateTimeImmutable returns a new DateTimeImmutable instance.
     */
    #[TentativeType]
    #[LanguageLevelTypeAware(['8.2' => 'static'], default: 'DateTimeImmutable')]
    public static function createFromMutable(DateTime $object) {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the warnings and errors
     * @link https://php.net/manual/en/datetimeimmutable.getlasterrors.php
     * @return array|false Returns array containing info about warnings and errors.
     */
    #[ArrayShape(["warning_count" => "int", "warnings" => "string[]", "error_count" => "int", "errors" => "string[]"])]
    #[TentativeType]
    public static function getLastErrors(): array|false {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Alters the timestamp
     * @link https://php.net/manual/en/datetimeimmutable.modify.php
     * @param string $modifier <p>A date/time string. Valid formats are explained in
     * {@link https://php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
     * @return static|false Returns the newly created object or false on failure.
     * Returns the {@link https://php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     */
    #[PhpStormStubsElementAvailable(from: '5.5', to: '8.2')]
    #[Pure]
    #[TentativeType]
    #[LanguageLevelTypeAware(['8.4' => 'DateTimeImmutable'], default: 'static|false')]
    public function modify(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $modifier) {}

    /**
     * (PHP 8 &gt;=8.3.0)<br/>
     * Alters the timestamp
     * @link https://php.net/manual/en/datetimeimmutable.modify.php
     * @param string $modifier <p>A date/time string. Valid formats are explained in
     * {@link https://php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
     * @return static|false Returns the newly created object or false on failure.
     * @throws DateMalformedStringException
     * Returns the {@link https://php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     */
    #[PhpStormStubsElementAvailable(from: '8.3')]
    #[Pure]
    #[TentativeType]
    #[LanguageLevelTypeAware(['8.4' => 'DateTimeImmutable'], default: 'DateTimeImmutable|false')]
    #[\NoDiscard(message: "as DateTimeImmutable::modify() does not modify the object itself")]
    public function modify(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $modifier) {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * The __set_state handler
     * @link https://php.net/manual/en/datetimeimmutable.set-state.php
     * @param array $array <p>Initialization array.</p>
     * @return DateTimeImmutable
     * Returns a new instance of a {@link https://php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object.
     */
    #[TentativeType]
    public static function __set_state(array $array): static {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the date
     * @link https://php.net/manual/en/datetimeimmutable.setdate.php
     * @param int $year <p>Year of the date.</p>
     * @param int $month <p>Month of the date.</p>
     * @param int $day <p>Day of the date.</p>
     * @return static
     * Returns the {@link https://php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining.
     * Prior to PHP 8.1, <b>FALSE</b> was returned on failure.
     */
    #[TentativeType]
    #[\NoDiscard(message: "as DateTimeImmutable::setDate() does not modify the object itself")]
    public function setDate(
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $year,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $month,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $day
    ): DateTimeImmutable {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the ISO date
     * @link https://php.net/manual/en/class.datetimeimmutable.php
     * @param int $year <p>Year of the date.</p>
     * @param int $week <p>Week of the date.</p>
     * @param int $dayOfWeek [optional] <p>Offset from the first day of the week.</p>
     * @return static
     * Returns the {@link https://php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining.
     * Prior to PHP 8.1, <b>FALSE</b> was returned on failure.
     */
    #[TentativeType]
    #[\NoDiscard(message: "as DateTimeImmutable::setISODate() does not modify the object itself")]
    public function setISODate(
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $year,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $week,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $dayOfWeek = 1
    ): DateTimeImmutable {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the time
     * @link https://php.net/manual/en/datetimeimmutable.settime.php
     * @param int $hour <p> Hour of the time. </p>
     * @param int $minute <p> Minute of the time. </p>
     * @param int $second [optional] <p> Second of the time. </p>
     * @param int $microsecond [optional] <p> Microseconds of the time. Added since 7.1</p>
     * @return static
     * Returns the {@link https://php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining.
     * Prior to PHP 8.1, <b>FALSE</b> was returned on failure.
     */
    #[TentativeType]
    #[\NoDiscard(message: "as DateTimeImmutable::setTime() does not modify the object itself")]
    #[Pure]
    public function setTime(
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $hour,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $minute,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $second = 0,
        #[PhpStormStubsElementAvailable(from: '7.1')] #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $microsecond = 0
    ): DateTimeImmutable {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the date and time based on an Unix timestamp
     * @link https://php.net/manual/en/datetimeimmutable.settimestamp.php
     * @param int $timestamp <p>Unix timestamp representing the date.</p>
     * @return static
     * Returns the {@link https://php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining.
     * Prior to PHP 8.1, <b>FALSE</b> was returned on failure.
     */
    #[TentativeType]
    #[\NoDiscard(message: "as DateTimeImmutable::setTimestamp() does not modify the object itself")]
    public function setTimestamp(#[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $timestamp): DateTimeImmutable {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Sets the time zone
     * @link https://php.net/manual/en/datetimeimmutable.settimezone.php
     * @param DateTimeZone $timezone <p>
     * A {@link https://php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the
     * desired time zone.
     * </p>
     * @return static
     * Returns the {@link https://php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining.
     * Prior to PHP 8.1, <b>FALSE</b> was returned on failure.
     */
    #[TentativeType]
    #[\NoDiscard(message: "as DateTimeImmutable::setTimezone() does not modify the object itself")]
    public function setTimezone(DateTimeZone $timezone): DateTimeImmutable {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Subtracts an amount of days, months, years, hours, minutes and seconds
     * @link https://php.net/manual/en/datetimeimmutable.sub.php
     * @param DateInterval $interval <p>
     * A {@link https://php.net/manual/en/class.dateinterval.php DateInterval} object
     * </p>
     * @return static Returns a new DateTimeImmutable object with the modified data.
     * @throws DateInvalidOperationException
     * Returns the {@link https://php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    #[\NoDiscard(message: "as DateTimeImmutable::sub() does not modify the object itself")]
    public function sub(DateInterval $interval): DateTimeImmutable {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the difference between two DateTime objects
     * @link https://php.net/manual/en/datetime.diff.php
     * @param DateTimeInterface $targetObject <p>The date to compare to.</p>
     * @param bool $absolute [optional] <p>Should the interval be forced to be positive?</p>
     * @return DateInterval
     * The {@link https://php.net/manual/en/class.dateinterval.php DateInterval} object representing the
     * difference between the two dates.
     */
    #[TentativeType]
    public function diff(
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeInterface'], default: '')] $targetObject,
        #[LanguageLevelTypeAware(['8.0' => 'bool'], default: '')] $absolute = false
    ): DateInterval {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns date formatted according to given format
     * @link https://php.net/manual/en/datetime.format.php
     * @param string $format <p>
     * Format accepted by  {@link https://php.net/manual/en/function.date.php date()}.
     * </p>
     * @return string
     * Returns the formatted date string on success.
     * Prior to PHP 8.1, <b>FALSE</b> was returned on failure.
     */
    #[Pure(true)]
    #[TentativeType]
    public function format(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $format): string {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Returns the timezone offset
     * @link https://php.net/manual/en/datetime.getoffset.php
     * @return int
     * Returns the timezone offset in seconds from UTC on success.
     * Prior to PHP 8.1, <b>FALSE</b> was returned on failure.
     */
    #[TentativeType]
    public function getOffset(): int {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Gets the Unix timestamp
     * @link https://php.net/manual/en/datetime.gettimestamp.php
     * @return int
     * Returns the Unix timestamp representing the date.
     */
    #[TentativeType]
    public function getTimestamp(): int {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Return time zone relative to given DateTime
     * @link https://php.net/manual/en/datetime.gettimezone.php
     * @return DateTimeZone|false
     * Returns a {@link https://php.net/manual/en/class.datetimezone.php DateTimeZone} object on success
     * or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function getTimezone(): DateTimeZone|false {}

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * The __wakeup handler
     * @link https://php.net/manual/en/datetime.wakeup.php
     * @return void Initializes a DateTime object.
     */
    #[TentativeType]
    #[Deprecated(since: '8.5')]
    public function __wakeup(): void {}

    /**
     * Returns new DateTimeImmutable object encapsulating the given DateTimeInterface object
     * @link https://php.net/manual/en/datetimeimmutable.createfrominterface.php
     * @param DateTimeInterface $object The DateTimeInterface object that needs to be converted to
     * an immutable version. This object is not modified, but instead a new DateTimeImmutable object
     * is created containing the same date, time, and timezone information.
     * @return static Returns a new DateTimeImmutable instance.
     * @since 8.0
     */
    public static function createFromInterface(DateTimeInterface $object): DateTimeImmutable {}

    /**
     * Serialize a DateTime
     *
     * The __serialize() handler.
     *
     * @link https://php.net/manual/en/datetime.serialize.php
     * @return array The serialized representation of the DateTime object.
     */
    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __serialize(): array {}

    /**
     * Unserialize an Datetime
     *
     * The __unserialize() handler.
     *
     * @link https://php.net/manual/en/datetime.unserialize.php
     * @param array $data The serialized DateTime.
     */
    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __unserialize(array $data): void {}

    /**
     * Creates an instance from a Unix timestamp
     * @link https://php.net/manual/en/datetimeimmutable.createfromtimestamp.php
     * @since 8.4
     * @throws \DateRangeError If the timestamp is outside the range [PHP_INT_MIN, PHP_INT_MAX], a
     * DateRangeError is thrown.
     */
    #[TentativeType]
    public static function createFromTimestamp(int|float $timestamp): static {}

    /**
     * Gets the microsecond part of the Unix timestamp
     * @link https://php.net/manual/en/datetimeinterface.getmicrosecond.php
     * @since 8.4
     */
    public function getMicrosecond(): int {}

    /**
     * Sets microsecond part of the time
     *
     * Returns a new DateTimeImmutable object constructed from the old one, with modified
     * microsecond part.
     *
     * @link https://php.net/manual/en/datetimeimmutable.setmicrosecond.php
     * @since 8.4
     * @throws \DateRangeError If the microsecond is outside the range [0, 999999], a DateRangeError
     * is thrown.
     */
    #[\NoDiscard(message: "as DateTimeImmutable::setMicrosecond() does not modify the object itself")]
    public function setMicrosecond(int $microsecond): static {}
}

/**
 * Representation of date and time.
 * @link https://php.net/manual/en/class.datetime.php
 */
class DateTime implements DateTimeInterface
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
     * @since 7.0
     * @removed 7.2
     */
    public const RFC3339_EXTENDED = 'Y-m-d\TH:i:s.vP';

    /**
     * @since 7.0
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
     * (PHP 5 &gt;=5.2.0)<br/>
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
     */
    #[PhpStormStubsElementAvailable(from: '5.3', to: '8.2')]
    public function __construct(
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime = 'now',
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeZone|null'], default: 'DateTimeZone')] $timezone = null
    ) {}

    /**
     * (PHP 8 &gt;=8.3.0)<br/>
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
     * @throws DateMalformedStringException Emits Exception in case of an error.
     */
    #[PhpStormStubsElementAvailable(from: '8.3')]
    public function __construct(
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime = 'now',
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeZone|null'], default: 'DateTimeZone')] $timezone = null
    ) {}

    /**
     * The __wakeup handler
     * @return void Initializes a DateTime object.
     * @link https://php.net/manual/en/datetime.wakeup.php
     */
    #[TentativeType]
    #[Deprecated(since: '8.5')]
    public function __wakeup(): void {}

    /**
     * Returns date formatted according to given format.
     * @param string $format The format of the outputted date string. See the formatting options
     * below. There are also several predefined date constants that may be used instead, so for
     * example DATE_RSS contains the format string 'D, d M Y H:i:s'. The following characters are
     * recognized in the format parameter string format character Description Example returned
     * values Day --- --- d Day of the month, 2 digits with leading zeros 01 to 31 D A textual
     * representation of a day, three letters Mon through Sun j Day of the month without leading
     * zeros 1 to 31 l (lowercase 'L') A full textual representation of the day of the week Sunday
     * through Saturday N ISO 8601 numeric representation of the day of the week 1 (for Monday)
     * through 7 (for Sunday) S English ordinal suffix for the day of the month, 2 characters st,
     * nd, rd or th. Works well with j w Numeric representation of the day of the week 0 (for
     * Sunday) through 6 (for Saturday) z The day of the year (starting from 0) 0 through 365 Week
     * --- --- W ISO 8601 week number of year, weeks starting on Monday Example: 42 (the 42nd week
     * in the year) Month --- --- F A full textual representation of a month, such as January or
     * March January through December m Numeric representation of a month, with leading zeros 01
     * through 12 M A short textual representation of a month, three letters Jan through Dec n
     * Numeric representation of a month, without leading zeros 1 through 12 t Number of days in the
     * given month 28 through 31 Year --- --- L Whether it's a leap year 1 if it is a leap year, 0
     * otherwise. o ISO 8601 week-numbering year. This has the same value as Y, except that if the
     * ISO week number (W) belongs to the previous or next year, that year is used instead.
     * Examples: 1999 or 2003 X An expanded full numeric representation of a year, at least 4
     * digits, with - for years BCE, and + for years CE. Examples: -0055, +0787, +1999, +10191 x An
     * expanded full numeric representation if required, or a standard full numeral representation
     * if possible (like Y). At least four digits. Years BCE are prefixed with a -. Years beyond
     * (and including) 10000 are prefixed by a +. Examples: -0055, 0787, 1999, +10191 Y A full
     * numeric representation of a year, at least 4 digits, with - for years BCE. Examples: -0055,
     * 0787, 1999, 2003, 10191 y A two digit representation of a year Examples: 99 or 03 Time ---
     * --- a Lowercase Ante meridiem and Post meridiem am or pm A Uppercase Ante meridiem and Post
     * meridiem AM or PM B Swatch Internet time 000 through 999 g 12-hour format of an hour without
     * leading zeros 1 through 12 G 24-hour format of an hour without leading zeros 0 through 23 h
     * 12-hour format of an hour with leading zeros 01 through 12 H 24-hour format of an hour with
     * leading zeros 00 through 23 i Minutes with leading zeros 00 to 59 s Seconds with leading
     * zeros 00 through 59 u Microseconds. Note that date will always generate 000000 since it takes
     * an int parameter, whereas DateTimeInterface::format does support microseconds if an object of
     * type DateTimeInterface was created with microseconds. Example: 654321 v Milliseconds. Same
     * note applies as for u. Example: 654 Timezone --- --- e Timezone identifier Examples: UTC,
     * GMT, Atlantic/Azores I (capital i) Whether or not the date is in daylight saving time 1 if
     * Daylight Saving Time, 0 otherwise. O Difference to Greenwich time (GMT) without colon between
     * hours and minutes Example: +0200 P Difference to Greenwich time (GMT) with colon between
     * hours and minutes Example: +02:00 p The same as P, but returns Z instead of +00:00 (available
     * as of PHP 8.0.0) Examples: Z or +02:00 T Timezone abbreviation, if known; otherwise the GMT
     * offset. Examples: EST, MDT, +05 Z Timezone offset in seconds. The offset for timezones west
     * of UTC is always negative, and for those east of UTC is always positive. -43200 through 50400
     * Full Date/Time --- --- c ISO 8601 date. Only compatible with the non-expanded format (up to
     * year 9999). Later dates will result in an invalid string. For later dates and expanded
     * format, see x and X. 2004-02-12T15:19:21+00:00 r RFC 2822/RFC 5322 formatted date Example:
     * Thu, 21 Dec 2000 16:01:07 +0200 U Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)
     * See also time Unrecognized characters in the format string will be printed as-is. The Z
     * format will always return 0 when using gmdate. Since this function only accepts int
     * timestamps the u format character is only useful when using the date_format function with
     * user based timestamps created with date_create.
     * @return string Returns the formatted date string on success.
     * @link https://php.net/manual/en/datetime.format.php
     */
    #[Pure(true)]
    #[TentativeType]
    public function format(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $format): string {}

    /**
     * Alter the timestamp of a DateTime object by incrementing or decrementing
     * in a format accepted by strtotime().
     * @param string $modifier A date/time string. Valid formats are explained in <a href="https://secure.php.net/manual/en/datetime.formats.php">Date and Time Formats</a>.
     * @return static|false Returns the DateTime object for method chaining or FALSE on failure.
     * @link https://php.net/manual/en/datetime.modify.php
     */
    #[PhpStormStubsElementAvailable(from: '5.3', to: '8.2')]
    #[TentativeType]
    #[LanguageLevelTypeAware(['8.4' => 'DateTime'], default: 'static|false')]
    public function modify(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $modifier) {}

    /**
     * Alter the timestamp of a DateTime object by incrementing or decrementing
     * in a format accepted by strtotime().
     * @param string $modifier A date/time string. Valid formats are explained in <a href="https://secure.php.net/manual/en/datetime.formats.php">Date and Time Formats</a>.
     * @return static|false Returns the DateTime object for method chaining or FALSE on failure.
     * @throws DateMalformedStringException
     * @link https://php.net/manual/en/datetime.modify.php
     */
    #[PhpStormStubsElementAvailable(from: '8.3')]
    #[TentativeType]
    #[LanguageLevelTypeAware(['8.4' => 'DateTime'], default: 'static|false')]
    public function modify(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $modifier) {}

    /**
     * Adds an amount of days, months, years, hours, minutes and seconds to a DateTime object
     * @param DateInterval $interval A DateInterval object
     * @return static Returns the modified DateTime object for method chaining.
     * @link https://php.net/manual/en/datetime.add.php
     */
    #[TentativeType]
    public function add(DateInterval $interval): DateTime {}

    /**
     * Returns new DateTime instance encapsulating the given DateTimeImmutable object
     * @link https://php.net/manual/en/datetime.createfromimmutable.php
     * @param DateTimeImmutable $object The immutable DateTimeImmutable object that needs to be
     * converted to a mutable version. This object is not modified, but instead a new DateTime
     * instance is created containing the same date, time, and timezone information.
     * @return DateTime Returns a new DateTime instance.
     * @since 7.3
     */
    #[TentativeType]
    #[LanguageLevelTypeAware(['8.2' => 'static'], default: 'DateTime')]
    public static function createFromImmutable(DateTimeImmutable $object) {}

    /**
     * Subtracts an amount of days, months, years, hours, minutes and seconds from a DateTime object
     * @param DateInterval $interval A DateInterval object
     * @return static Returns the modified DateTime object for method chaining.
     * @link https://php.net/manual/en/datetime.sub.php
     * @throws DateInvalidOperationException
     */
    #[TentativeType]
    public function sub(DateInterval $interval): DateTime {}

    /**
     * Get the TimeZone associated with the DateTime
     * @return DateTimeZone|false Returns a DateTimeZone object on success or false on failure.
     * @link https://php.net/manual/en/datetime.gettimezone.php
     */
    #[TentativeType]
    public function getTimezone(): DateTimeZone|false {}

    /**
     * Set the TimeZone associated with the DateTime
     * @param DateTimeZone $timezone A DateTimeZone object representing the desired time zone.
     * @return static Returns the DateTime object for method chaining. The underlying point-in-time
     * is not changed when calling this method.
     * @link https://php.net/manual/en/datetime.settimezone.php
     */
    #[TentativeType]
    public function setTimezone(#[LanguageLevelTypeAware(['8.0' => 'DateTimeZone'], default: '')] $timezone): DateTime {}

    /**
     * Returns the timezone offset
     * @return int Returns the timezone offset in seconds from UTC on success.
     * @link https://php.net/manual/en/datetime.getoffset.php
     */
    #[TentativeType]
    public function getOffset(): int {}

    /**
     * Sets the current time of the DateTime object to a different time.
     * @param int $hour Hour of the time.
     * @param int $minute Minute of the time.
     * @param int $second Second of the time.
     * @param int $microsecond Added since 7.1
     * @return static Returns the modified DateTime object for method chaining.
     * @link https://php.net/manual/en/datetime.settime.php
     */
    #[TentativeType]
    public function setTime(
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $hour,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $minute,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $second = 0,
        #[PhpStormStubsElementAvailable(from: '7.1')] #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $microsecond = 0
    ): DateTime {}

    /**
     * Sets the current date of the DateTime object to a different date.
     * @param int $year Year of the date.
     * @param int $month Month of the date.
     * @param int $day Day of the date.
     * @return static Returns the modified DateTime object for method chaining.
     * @link https://php.net/manual/en/datetime.setdate.php
     */
    #[TentativeType]
    public function setDate(
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $year,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $month,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $day
    ): DateTime {}

    /**
     * Set a date according to the ISO 8601 standard - using weeks and day offsets rather than specific dates.
     * @param int $year Year of the date.
     * @param int $week Week of the date.
     * @param int $dayOfWeek Offset from the first day of the week.
     * @return static Returns the modified DateTime object for method chaining.
     * @link https://php.net/manual/en/datetime.setisodate.php
     */
    #[TentativeType]
    public function setISODate(
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $year,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $week,
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $dayOfWeek = 1
    ): DateTime {}

    /**
     * Sets the date and time based on a Unix timestamp.
     * @param int $timestamp Unix timestamp representing the date. Setting timestamps outside the
     * range of integer is possible by using DateTimeImmutable::modify with the @ format.
     * @return static Returns the modified DateTime object for method chaining.
     * @link https://php.net/manual/en/datetime.settimestamp.php
     */
    #[TentativeType]
    public function setTimestamp(#[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $timestamp): DateTime {}

    /**
     * Gets the Unix timestamp.
     * @return int Returns the Unix timestamp representing the date.
     * @link https://php.net/manual/en/datetime.gettimestamp.php
     */
    #[TentativeType]
    public function getTimestamp(): int {}

    /**
     * Returns the difference between two DateTime objects represented as a DateInterval.
     * @param DateTimeInterface $targetObject The date to compare to.
     * @param bool $absolute [optional] Whether to return absolute difference.
     * @return DateInterval The DateInterval object representing the difference between the two dates.
     * @link https://php.net/manual/en/datetime.diff.php
     */
    #[TentativeType]
    public function diff(
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeInterface'], default: '')] $targetObject,
        #[LanguageLevelTypeAware(['8.0' => 'bool'], default: '')] $absolute = false
    ): DateInterval {}

    /**
     * Parse a string into a new DateTime object according to the specified format
     * @param string $format Format accepted by date().
     * @param string $datetime String representing the time.
     * @param null|DateTimeZone $timezone A DateTimeZone object representing the desired time zone.
     * @return DateTime|false
     * @link https://php.net/manual/en/datetime.createfromformat.php
     */
    #[TentativeType]
    #[PhpStormStubsElementAvailable(from: '5.3', to: '7.4')]
    public static function createFromFormat(
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $format,
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime,
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeZone|null'], default: 'DateTimeZone')] $timezone = null
    ): DateTime|false {}

    /**
     * Parse a string into a new DateTime object according to the specified format
     * @param string $format Format accepted by date().
     * @param string $datetime String representing the time.
     * @param null|DateTimeZone $timezone A DateTimeZone object representing the desired time zone.
     * @return DateTime|false Returns a new DateTime instance or false on failure.
     * @link https://php.net/manual/en/datetime.createfromformat.php
     * @throws ValueError when the datetime contains NULL-bytes.
     */
    #[TentativeType]
    #[PhpStormStubsElementAvailable(from: '8.0')]
    public static function createFromFormat(
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $format,
        #[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime,
        #[LanguageLevelTypeAware(['8.0' => 'DateTimeZone|null'], default: 'DateTimeZone')] $timezone = null
    ): DateTime|false {}

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
    #[TentativeType]
    public static function __set_state(array $array): static {}

    /**
     * Returns new DateTime object encapsulating the given DateTimeInterface object
     * @link https://php.net/manual/en/datetime.createfrominterface.php
     * @param DateTimeInterface $object The DateTimeInterface object that needs to be converted to a
     * mutable version. This object is not modified, but instead a new DateTime object is created
     * containing the same date, time, and timezone information.
     * @return static Returns a new DateTime instance.
     * @since 8.0
     */
    public static function createFromInterface(DateTimeInterface $object): DateTime {}

    /**
     * Serialize a DateTime
     *
     * The __serialize() handler.
     *
     * @link https://php.net/manual/en/datetime.serialize.php
     * @return array The serialized representation of the DateTime object.
     */
    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __serialize(): array {}

    /**
     * Unserialize an Datetime
     *
     * The __unserialize() handler.
     *
     * @link https://php.net/manual/en/datetime.unserialize.php
     * @param array $data The serialized DateTime.
     */
    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __unserialize(array $data): void {}

    /**
     * Creates an instance from a Unix timestamp
     * @link https://php.net/manual/en/datetime.createfromtimestamp.php
     * @since 8.4
     * @throws \DateRangeError If the timestamp is outside the range [PHP_INT_MIN, PHP_INT_MAX], a
     * DateRangeError is thrown.
     */
    #[TentativeType]
    public static function createFromTimestamp(int|float $timestamp): static {}

    /**
     * Gets the microsecond part of the Unix timestamp
     * @link https://php.net/manual/en/datetimeinterface.getmicrosecond.php
     * @since 8.4
     */
    public function getMicrosecond(): int {}

    /**
     * Sets microsecond part of the time
     * @link https://php.net/manual/en/datetime.setmicrosecond.php
     * @since 8.4
     * @throws \DateRangeError If the microsecond is outside the range [0, 999999], a DateRangeError
     * is thrown.
     */
    public function setMicrosecond(int $microsecond): static {}
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
     * Creates new DateTimeZone object
     *
     * Creates a new DateTimeZone object.
     *
     * @param string $timezone One of the supported timezone names, an offset value (+0200), or a
     * timezone abbreviation (BST).
     * @link https://php.net/manual/en/datetimezone.construct.php
     * @throws DateInvalidTimeZoneException Emits Exception in case of an error.
     */
    public function __construct(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $timezone) {}

    /**
     * Returns the name of the timezone
     * @return string Depending on zone type, UTC offset (type 1), timezone abbreviation (type 2),
     * and timezone identifiers as published in the IANA timezone database (type 3), the descriptor
     * string to create a new DateTimeZone object with the same offset and/or rules. For example
     * 02:00, CEST, or one of the timezone names in the list of timezones.
     * @link https://php.net/manual/en/datetimezone.getname.php
     */
    #[TentativeType]
    public function getName(): string {}

    /**
     * Returns location information for a timezone
     * @return array|false Array containing location information about timezone or false on failure.
     * @link https://php.net/manual/en/datetimezone.getlocation.php
     */
    #[TentativeType]
    #[ArrayShape([
        'country_code' => 'string',
        'latitude' => 'double',
        'longitude' => 'double',
        'comments' => 'string',
    ])]
    public function getLocation(): array|false {}

    /**
     * Returns the timezone offset from GMT
     * @param DateTimeInterface $datetime DateTime that contains the date/time to compute the offset
     * from.
     * @return int Returns time zone offset in seconds.
     * @link https://php.net/manual/en/datetimezone.getoffset.php
     */
    #[TentativeType]
    public function getOffset(DateTimeInterface $datetime): int {}

    /**
     * Returns all transitions for the timezone
     * @param int $timestampBegin Begin timestamp.
     * @param int $timestampEnd End timestamp.
     * @return array|false Returns a numerically indexed array of transition arrays on success, or
     * false on failure. DateTimeZone objects wrapping type 1 (UTC offsets) and type 2
     * (abbreviations) do not contain any transitions, and calling this method on them will return
     * false. If timestampBegin is given, the first entry in the returned array will contain a
     * transition element at the time of timestampBegin. Transition Array Structure Key Type
     * Description ts int Unix timestamp time string DateTimeInterface::ISO8601_EXPANDED (PHP 8.2
     * and later), or DateTimeInterface::ISO8601 (PHP 8.1 and lower) time string offset int Offset
     * to UTC in seconds isdst bool Whether daylight saving time is active abbr string Timezone
     * abbreviation
     * @link https://php.net/manual/en/datetimezone.gettransitions.php
     */
    #[TentativeType]
    public function getTransitions(
        #[PhpStormStubsElementAvailable(from: '5.3', to: '5.6')] $timestampBegin = PHP_INT_MIN,
        #[PhpStormStubsElementAvailable(from: '5.3', to: '5.6')] $timestampEnd = 2147483647,
        #[PhpStormStubsElementAvailable(from: '7.0')] #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $timestampBegin = PHP_INT_MIN,
        #[PhpStormStubsElementAvailable(from: '7.0')] #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $timestampEnd = 2147483647
    ): array|false {}

    /**
     * Returns associative array containing dst, offset and the timezone name
     * @return array<string, list<array{dst: bool, offset: int, timezone_id: string|null}>> Returns
     * the array of timezone abbreviations.
     * @link https://php.net/manual/en/datetimezone.listabbreviations.php
     */
    #[TentativeType]
    public static function listAbbreviations(): array {}

    /**
     * Returns a numerically indexed array with all timezone identifiers
     * @param int $timezoneGroup One of the DateTimeZone class constants (or a combination).
     * @param string $countryCode A two-letter (uppercase) ISO 3166-1 compatible country code. This
     * option is only used when timezoneGroup is set to DateTimeZone::PER_COUNTRY.
     * @return array|false Returns the array of timezone identifiers, or <b>FALSE</b> on failure. Since PHP8, always returns <b>array</b>.
     * @link https://php.net/manual/en/datetimezone.listidentifiers.php
     */
    #[LanguageLevelTypeAware(["8.0" => "array"], default: "array|false")]
    #[TentativeType]
    public static function listIdentifiers(
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')] $timezoneGroup = DateTimeZone::ALL,
        #[LanguageLevelTypeAware(['8.0' => 'string|null'], default: '')] $countryCode = null
    ) {}

    /**
     * @link https://php.net/manual/en/datetime.wakeup.php
     */
    #[TentativeType]
    #[Deprecated(since: '8.5')]
    public function __wakeup(): void {}

    #[TentativeType]
    public static function __set_state(array $array): static {}

    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __serialize(): array {}

    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __unserialize(array $data): void {}
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
    #[PhpStormStubsElementAvailable(from: '5.3', to: '8.2')]
    public function __construct(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $duration) {}

    /**
     * Creates a new DateInterval object
     * @param string $duration An interval specification. The format starts with the letter P, for
     * period. Each duration period is represented by an integer value followed by a period
     * designator. If the duration contains time elements, that portion of the specification is
     * preceded by the letter T. duration Period Designators Period Designator Description Y years M
     * months D days W weeks. Converted into days. Prior to PHP 8.0.0, can not be combined with D. H
     * hours M minutes S seconds Here are some simple examples. Two days is P2D. Two seconds is
     * PT2S. Six years and five minutes is P6YT5M. The unit types must be entered from the largest
     * scale unit on the left to the smallest scale unit on the right. So years before months,
     * months before days, days before minutes, etc. Thus one year and four days must be represented
     * as P1Y4D, not P4D1Y. The specification can also be represented as a date time. A sample of
     * one year and four days would be P0001-00-04T00:00:00. But the values in this format can not
     * exceed a given period's roll-over-point (e.g. 25 hours is invalid). These formats are based
     * on the ISO 8601 duration specification.
     * @throws DateMalformedIntervalStringException when the $duration cannot be parsed as an interval.
     * @link https://php.net/manual/en/dateinterval.construct.php
     */
    #[PhpStormStubsElementAvailable(from: '8.3')]
    public function __construct(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $duration) {}

    /**
     * Formats the interval
     * @param string $format The following characters are recognized in the format parameter string.
     * Each format character must be prefixed by a percent sign (%). format character Description
     * Example values % Literal % % Y Years, numeric, at least 2 digits with leading 0 01, 03 y
     * Years, numeric 1, 3 M Months, numeric, at least 2 digits with leading 0 01, 03, 12 m Months,
     * numeric 1, 3, 12 D Days, numeric, at least 2 digits with leading 0 01, 03, 31 d Days, numeric
     * 1, 3, 31 a Total number of days as a result of a DateTime::diff or (unknown) otherwise 4, 18,
     * 8123 H Hours, numeric, at least 2 digits with leading 0 01, 03, 23 h Hours, numeric 1, 3, 23
     * I Minutes, numeric, at least 2 digits with leading 0 01, 03, 59 i Minutes, numeric 1, 3, 59 S
     * Seconds, numeric, at least 2 digits with leading 0 01, 03, 57 s Seconds, numeric 1, 3, 57 F
     * Microseconds, numeric, at least 6 digits with leading 0 007701, 052738, 428291 f
     * Microseconds, numeric 7701, 52738, 428291 R Sign "-" when negative, "+" when positive -, + r
     * Sign "-" when negative, empty when positive -,
     * @return string Returns the formatted interval.
     * @link https://php.net/manual/en/dateinterval.format.php
     */
    #[TentativeType]
    public function format(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $format): string {}

    /**
     * Sets up a DateInterval from the relative parts of the string
     * @param string $datetime
     * @return DateInterval|false Returns a new {@link https://www.php.net/manual/en/class.dateinterval.php DateInterval}
     * instance on success, or <b>FALSE</b> on failure.
     * @link https://php.net/manual/en/dateinterval.createfromdatestring.php
     */
    #[TentativeType]
    #[PhpStormStubsElementAvailable(from: '5.3', to: '8.2')]
    #[LanguageLevelTypeAware(['8.4' => 'DateInterval'], default: 'DateInterval|false')]
    public static function createFromDateString(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime) {}

    /**
     * Sets up a DateInterval from the relative parts of the string
     * @param string $datetime A date with relative parts. Specifically, the relative formats
     * supported by the parser used for DateTimeImmutable, DateTime, and strtotime will be used to
     * construct the DateInterval. To use an ISO-8601 format string like P7D, you must use the
     * DateInterval::__construct.
     * @return DateInterval|false Returns a new {@link https://www.php.net/manual/en/class.dateinterval.php DateInterval}
     * instance on success, or <b>FALSE</b> on failure.
     * @throws DateMalformedIntervalStringException
     * @link https://php.net/manual/en/dateinterval.createfromdatestring.php
     */
    #[TentativeType]
    #[PhpStormStubsElementAvailable(from: '8.3')]
    #[LanguageLevelTypeAware(['8.4' => 'DateInterval'], default: 'DateInterval|false')]
    public static function createFromDateString(#[LanguageLevelTypeAware(['8.0' => 'string'], default: '')] $datetime) {}

    #[TentativeType]
    #[Deprecated(since: '8.5')]
    public function __wakeup(): void {}

    #[TentativeType]
    public static function __set_state(array $array): static {}

    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __serialize(): array {}

    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __unserialize(array $data): void {}
}

/**
 * Representation of date period.
 * @link https://php.net/manual/en/class.dateperiod.php
 * @template TDate of DateTimeInterface
 * @template TEnd of ?DateTimeInterface
 * @implements \IteratorAggregate<int, TDate>
 */
class DatePeriod implements IteratorAggregate
{
    public const EXCLUDE_START_DATE = 1;

    /**
     * @since 8.2
     */
    public const INCLUDE_END_DATE = 2;

    /**
     * Start date
     * @var DateTimeInterface
     */
    #[LanguageLevelTypeAware(['8.2' => 'DateTimeInterface|null'], default: '')]
    #[Immutable]
    public $start;

    /**
     * Current iterator value.
     * @var DateTimeInterface|null
     */
    #[LanguageLevelTypeAware(['8.2' => 'DateTimeInterface|null'], default: '')]
    public $current;

    /**
     * End date.
     * @var DateTimeInterface|null
     */
    #[LanguageLevelTypeAware(['8.2' => 'DateTimeInterface|null'], default: '')]
    #[Immutable]
    public $end;

    /**
     * The interval
     * @var DateInterval
     */
    #[LanguageLevelTypeAware(['8.2' => 'DateInterval|null'], default: '')]
    #[Immutable]
    public $interval;

    /**
     * Number of recurrences.
     * @var int
     */
    #[LanguageLevelTypeAware(['8.2' => 'int'], default: '')]
    #[Immutable]
    public $recurrences;

    /**
     * Start of period.
     * @var bool
     */
    #[LanguageLevelTypeAware(['8.2' => 'bool'], default: '')]
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
    public function __construct(DateTimeInterface $start, DateInterval $interval, DateTimeInterface $end, $options = 0) {}

    /**
     * @param TDate $start
     * @param DateInterval $interval
     * @param int $recurrences Number of recurrences
     * @param int $options Can be set to DatePeriod::EXCLUDE_START_DATE.
     * @link https://php.net/manual/en/dateperiod.construct.php
     */
    public function __construct(DateTimeInterface $start, DateInterval $interval, $recurrences, $options = 0) {}

    /**
     * Creates a new DatePeriod object
     * @param string $isostr String containing the ISO interval.
     * @param int $options Can be set to DatePeriod::EXCLUDE_START_DATE.
     * @throws DateMalformedPeriodStringException
     * @link https://php.net/manual/en/dateperiod.construct.php
     */
    public function __construct($isostr, $options = 0) {}

    /**
     * Gets the interval
     * @return DateInterval Returns a DateInterval object
     * @link https://php.net/manual/en/dateperiod.getdateinterval.php
     * @since 5.6
     */
    #[TentativeType]
    public function getDateInterval(): DateInterval {}

    /**
     * Gets the end date
     * @return TEnd Returns null if the DatePeriod does not have an end date. For
     * example, when initialized with the recurrences parameter, or the isostr parameter without an
     * end date. Returns a DateTimeImmutable object when the DatePeriod is initialized with a
     * DateTimeImmutable object as the end parameter. Returns a cloned DateTime object representing
     * the end date otherwise.
     * @link https://php.net/manual/en/dateperiod.getenddate.php
     * @since 5.6
     */
    #[TentativeType]
    public function getEndDate(): ?DateTimeInterface {}

    /**
     * Gets the start date
     * @return TDate Returns a DateTimeImmutable object when the DatePeriod is
     * initialized with a DateTimeImmutable object as the start parameter. Returns a DateTime object
     * otherwise.
     * @link https://php.net/manual/en/dateperiod.getstartdate.php
     * @since 5.6
     */
    #[TentativeType]
    public function getStartDate(): DateTimeInterface {}

    #[TentativeType]
    public static function __set_state(#[PhpStormStubsElementAvailable(from: '7.3')] array $array): DatePeriod {}

    #[TentativeType]
    #[Deprecated(since: '8.5')]
    public function __wakeup(): void {}

    /**
     * Get the number of recurrences
     * @return int|null The number of recurrences as set by explicitly passing the $recurrences to
     * the constructor of the DatePeriod class, or null otherwise.
     * @link https://php.net/manual/en/dateperiod.getrecurrences.php
     * @since 7.2
     */
    #[TentativeType]
    public function getRecurrences(): ?int {}

    /**
     * @return \Iterator<int, TDate>
     * @since 8.0
     */
    public function getIterator(): Iterator {}

    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __serialize(): array {}

    #[PhpStormStubsElementAvailable(from: '8.2')]
    public function __unserialize(array $data): void {}

    /**
     * Creates a new DatePeriod object from an ISO8601 string
     *
     * Creates a new DatePeriod object from an ISO8601 string, as specified with specification.
     *
     * @link https://php.net/manual/en/dateperiod.createfromiso8601string.php
     * @since 8.3
     * @throws \DateMalformedPeriodStringException Throws an DateMalformedPeriodStringException when
     * the specification cannot be parsed as a valid ISO 8601 period.
     */
    public static function createFromISO8601String(string $specification, int $options = 0): static {}
}

/**
 * @since 8.3
 */
class DateError extends Error {}

/**
 * @since 8.3
 */
class DateObjectError extends DateError {}

/**
 * @since 8.3
 */
class DateRangeError extends DateError {}

/**
 * @since 8.3
 */
class DateException extends Exception {}

/**
 * @since 8.3
 */
class DateInvalidTimeZoneException extends DateException {}

/**
 * @since 8.3
 */
class DateInvalidOperationException extends DateException {}

/**
 * @since 8.3
 */
class DateMalformedStringException extends DateException {}

/**
 * @since 8.3
 */
class DateMalformedIntervalStringException extends DateException {}

/**
 * @since 8.3
 */
class DateMalformedPeriodStringException extends DateException {}
