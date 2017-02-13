<?php
/**
 * PHPStorm stub file for Internationalization classes.
 *
 * @link http://php.net/manual/en/book.intl.php
 */

/**
 * Provides string comparison capability with support for appropriate locale-sensitive sort orderings.
 */
class Collator
{
    /**
     * <p>
     * The Alternate attribute is used to control the handling of the so called
     * variable characters in the UCA: whitespace, punctuation and symbols. If
     * Alternate is set to NonIgnorable
     * (N), then differences among these characters are of the same importance
     * as differences among letters. If Alternate is set to
     * Shifted
     * (S), then these characters are of only minor importance. The
     * Shifted value is often used in combination with
     * Strength
     * set to Quaternary. In such a case, whitespace, punctuation, and symbols
     * are considered when comparing strings, but only if all other aspects of
     * the strings (base letters, accents, and case) are identical. If
     * Alternate is not set to Shifted, then there is no difference between a
     * Strength of 3 and a Strength of 4. For more information and examples,
     * see Variable_Weighting in the
     * UCA.
     * The reason the Alternate values are not simply
     * On and Off
     * is that additional Alternate values may be added in the future. The UCA
     * option Blanked is expressed with Strength set to 3, and Alternate set to
     * Shifted. The default for most locales is NonIgnorable. If Shifted is
     * selected, it may be slower if there are many strings that are the same
     * except for punctuation; sort key length will not be affected unless the
     * strength level is also increased.
     * </p>
     * <p>
     * Possible values are:
     * <b>Collator::NON_IGNORABLE</b>(default)
     * <b>Collator::SHIFTED</b>
     * <b>Collator::DEFAULT_VALUE</b>
     * </p>
     * <p>
     * ALTERNATE_HANDLING rules
     * <p>
     * S=3, A=N di Silva &lt; Di Silva &lt; diSilva &lt; U.S.A. &lt; USA
     * S=3, A=S di Silva = diSilva &lt; Di Silva &lt; U.S.A. = USA
     * S=4, A=S di Silva &lt; diSilva &lt; Di Silva &lt; U.S.A. &lt; USA
     * </p>
     * </p>
     *
     * @link http://php.net/manual/en/intl.collator-constants.php
     */
    const ALTERNATE_HANDLING = 1;
    /**
     * <p>
     * The Case_First attribute is used to control whether uppercase letters
     * come before lowercase letters or vice versa, in the absence of other
     * differences in the strings. The possible values are
     * Uppercase_First
     * (U) and Lowercase_First
     * (L), plus the standard Default
     * and Off.
     * There is almost no difference between the Off and Lowercase_First
     * options in terms of results, so typically users will not use
     * Lowercase_First: only Off or Uppercase_First. (People interested in the
     * detailed differences between X and L should consult the Collation
     * Customization). Specifying either L or U won't affect string comparison
     * performance, but will affect the sort key length.
     * </p>
     * <p>
     * Possible values are:
     * <b>Collator::OFF</b>(default)
     * <b>Collator::LOWER_FIRST</b>
     * <b>Collator::UPPER_FIRST</b>
     * <b>Collator:DEFAULT</b>
     * </p>
     * <p>
     * CASE_FIRST rules
     * <p>
     * C=X or C=L "china" &lt; "China" &lt; "denmark" &lt; "Denmark"
     * C=U "China" &lt; "china" &lt; "Denmark" &lt; "denmark"
     * </p>
     * </p>
     *
     * @link http://php.net/manual/en/intl.collator-constants.php
     */
    const CASE_FIRST = 2;
    /**
     * <p>
     * The Case_Level attribute is used when ignoring accents but not case. In
     * such a situation, set Strength to be Primary,
     * and Case_Level to be On.
     * In most locales, this setting is Off by default. There is a small
     * string comparison performance and sort key impact if this attribute is
     * set to be On.
     * </p>
     * <p>
     * Possible values are:
     * <b>Collator::OFF</b>(default)
     * <b>Collator::ON</b>
     * <b>Collator::DEFAULT_VALUE</b>
     * </p>
     * <p>
     * CASE_LEVEL rules
     * <p>
     * S=1, E=X role = Role = rôle
     * S=1, E=O role = rôle &lt; Role
     * </p>
     * </p>
     *
     * @link http://php.net/manual/en/intl.collator-constants.php
     */
    const CASE_LEVEL = 3;
    const DEFAULT_STRENGTH = 2;
    const DEFAULT_VALUE = -1;
    /**
     * <p>
     * Sort strings with different accents from the back of the string. This
     * attribute is automatically set to
     * On
     * for the French locales and a few others. Users normally would not need
     * to explicitly set this attribute. There is a string comparison
     * performance cost when it is set On,
     * but sort key length is unaffected. Possible values are:
     * <b>Collator::ON</b>
     * <b>Collator::OFF</b>(default)
     * <b>Collator::DEFAULT_VALUE</b>
     * </p>
     * <p>
     * FRENCH_COLLATION rules
     * <p>
     * F=OFF cote &lt; coté &lt; côte &lt; côté
     * F=ON cote &lt; côte &lt; coté &lt; côté
     * </p>
     * </p>
     *
     * @link http://php.net/manual/en/intl.collator-constants.php
     */
    const FRENCH_COLLATION = 0;
    /**
     * <p>
     * Compatibility with JIS x 4061 requires the introduction of an additional
     * level to distinguish Hiragana and Katakana characters. If compatibility
     * with that standard is required, then this attribute should be set
     * On,
     * and the strength set to Quaternary. This will affect sort key length
     * and string comparison string comparison performance.
     * </p>
     * <p>
     * Possible values are:
     * <b>Collator::OFF</b>(default)
     * <b>Collator::ON</b>
     * <b>Collator::DEFAULT_VALUE</b>
     * </p>
     *
     * @link http://php.net/manual/en/intl.collator-constants.php
     */
    const HIRAGANA_QUATERNARY_MODE = 6;
    const IDENTICAL = 15;
    const LOWER_FIRST = 24;
    const NON_IGNORABLE = 21;
    /**
     * <p>
     * The Normalization setting determines whether text is thoroughly
     * normalized or not in comparison. Even if the setting is off (which is
     * the default for many locales), text as represented in common usage will
     * compare correctly (for details, see UTN #5). Only if the accent marks
     * are in noncanonical order will there be a problem. If the setting is
     * On,
     * then the best results are guaranteed for all possible text input.
     * There is a medium string comparison performance cost if this attribute
     * is On,
     * depending on the frequency of sequences that require normalization.
     * There is no significant effect on sort key length. If the input text is
     * known to be in NFD or NFKD normalization forms, there is no need to
     * enable this Normalization option.
     * </p>
     * <p>
     * Possible values are:
     * <b>Collator::OFF</b>(default)
     * <b>Collator::ON</b>
     * <b>Collator::DEFAULT_VALUE</b>
     * </p>
     *
     * @link http://php.net/manual/en/intl.collator-constants.php
     */
    const NORMALIZATION_MODE = 4;
    /**
     * <p>
     * When turned on, this attribute generates a collation key for the numeric
     * value of substrings of digits. This is a way to get '100' to sort AFTER
     * '2'.
     * </p>
     * <p>
     * Possible values are:
     * <b>Collator::OFF</b>(default)
     * <b>Collator::ON</b>
     * <b>Collator::DEFAULT_VALUE</b>
     * </p>
     *
     * @link http://php.net/manual/en/intl.collator-constants.php
     */
    const NUMERIC_COLLATION = 7;
    const OFF = 16;
    const ON = 17;
    const PRIMARY = 0;
    const QUATERNARY = 3;
    const SECONDARY = 1;
    const SHIFTED = 20;
    const SORT_NUMERIC = 2;
    const SORT_REGULAR = 0;
    const SORT_STRING = 1;
    /**
     * <p>
     * The ICU Collation Service supports many levels of comparison (named
     * "Levels", but also known as "Strengths"). Having these categories
     * enables ICU to sort strings precisely according to local conventions.
     * However, by allowing the levels to be selectively employed, searching
     * for a string in text can be performed with various matching conditions.
     * For more detailed information, see
     * <b>collator_set_strength</b> chapter.
     * </p>
     * <p>
     * Possible values are:
     * <b>Collator::PRIMARY</b>
     * <b>Collator::SECONDARY</b>
     * <b>Collator::TERTIARY</b>(<default)
     * <b>Collator::QUATERNARY</b>
     * <b>Collator::IDENTICAL</b>
     * <b>Collator::DEFAULT_VALUE</b>
     * </p>
     *
     * @link http://php.net/manual/en/intl.collator-constants.php
     */
    const STRENGTH = 5;
    const TERTIARY = 2;
    const UPPER_FIRST = 25;

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Create a collator
     *
     * @link http://php.net/manual/en/collator.construct.php
     *
     * @param string $locale
     */
    public function __construct($locale) { }

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
    public static function create($locale) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Sort array maintaining index association
     *
     * @link http://php.net/manual/en/collator.asort.php
     *
     * @param array $arr       <p>Array of strings to sort.</p>
     * @param int   $sort_flag [optional] <p>
     *                         Optional sorting type, one of the following:
     *                         <p>
     *                         <b>Collator::SORT_REGULAR</b>
     *                         - compare items normally (don't change types)
     *                         </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function asort(array &$arr, $sort_flag = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Compare two Unicode strings
     *
     * @link http://php.net/manual/en/collator.compare.php
     *
     * @param string $str1 <p>
     *                     The first string to compare.
     *                     </p>
     * @param string $str2 <p>
     *                     The second string to compare.
     *                     </p>
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
    public function compare($str1, $str2) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get collation attribute value
     *
     * @link http://php.net/manual/en/collator.getattribute.php
     *
     * @param int $attr <p>
     *                  Attribute to get value for.
     *                  </p>
     *
     * @return int Attribute value, or boolean <b>FALSE</b> on error.
     */
    public function getAttribute($attr) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get collator's last error code
     *
     * @link http://php.net/manual/en/collator.geterrorcode.php
     * @return int Error code returned by the last Collator API function call.
     */
    public function getErrorCode() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get text for collator's last error code
     *
     * @link http://php.net/manual/en/collator.geterrormessage.php
     * @return string Description of an error occurred in the last Collator API function call.
     */
    public function getErrorMessage() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the locale name of the collator
     *
     * @link http://php.net/manual/en/collator.getlocale.php
     *
     * @param int $type [optional] <p>
     *                  You can choose between valid and actual locale (
     *                  <b>Locale::VALID_LOCALE</b> and
     *                  <b>Locale::ACTUAL_LOCALE</b>,
     *                  respectively). The default is the actual locale.
     *                  </p>
     *
     * @return string Real locale name from which the collation data comes. If the collator was
     * instantiated from rules or an error occurred, returns
     * boolean <b>FALSE</b>.
     */
    public function getLocale($type = null) { }

    /**
     * (No version information available, might only be in SVN)<br/>
     * Get sorting key for a string
     *
     * @link http://php.net/manual/en/collator.getsortkey.php
     *
     * @param string $str <p>
     *                    The string to produce the key from.
     *                    </p>
     *
     * @return string the collation key for the string. Collation keys can be compared directly instead of strings.
     */
    public function getSortKey($str) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get current collation strength
     *
     * @link http://php.net/manual/en/collator.getstrength.php
     * @return int current collation strength, or boolean <b>FALSE</b> on error.
     */
    public function getStrength() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Set collation attribute
     *
     * @link http://php.net/manual/en/collator.setattribute.php
     *
     * @param int $attr <p>Attribute.</p>
     * @param int $val  <p>
     *                  Attribute value.
     *                  </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setAttribute($attr, $val) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Set collation strength
     *
     * @link http://php.net/manual/en/collator.setstrength.php
     *
     * @param int $strength <p>Strength to set.</p>
     *                      <p>
     *                      Possible values are:
     *                      <p>
     *                      <b>Collator::PRIMARY</b>
     *                      </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setStrength($strength) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Sort array using specified collator
     *
     * @link http://php.net/manual/en/collator.sort.php
     *
     * @param array $arr       <p>
     *                         Array of strings to sort.
     *                         </p>
     * @param int   $sort_flag [optional] <p>
     *                         Optional sorting type, one of the following:
     *                         </p>
     *                         <p>
     *                         <p>
     *                         <b>Collator::SORT_REGULAR</b>
     *                         - compare items normally (don't change types)
     *                         </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function sort(array &$arr, $sort_flag = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Sort array using specified collator and sort keys
     *
     * @link http://php.net/manual/en/collator.sortwithsortkeys.php
     *
     * @param array $arr <p>Array of strings to sort</p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function sortWithSortKeys(array &$arr) { }
}

/**
 * A “break iterator” is an ICU object that exposes methods for locating boundaries in text (e.g. word or sentence
 * boundaries). The PHP IntlBreakIterator serves as the base class for all types of ICU break iterators. Where extra
 * functionality is available, the intl extension may expose the ICU break iterator with suitable subclasses, such as
 * IntlRuleBasedBreakIterator or IntlCodePointBreaIterator.
 *
 * This class implements Traversable. Traversing an IntlBreakIterator yields non-negative integer values representing
 * the successive locations of the text boundaries, expressed as UTF-8 code units (byte) counts, taken from the
 * beggining of the text (which has the location 0). The keys yielded by the iterator simply form the sequence of
 * natural numbers {0, 1, 2, …}.
 */
class IntlBreakIterator implements Traversable
{
    /* Constants */
    const  DONE = -1;
    const  LINE_HARD = 100;
    const  LINE_HARD_LIMIT = 200;
    const  LINE_SOFT = 0;
    const  LINE_SOFT_LIMIT = 100;
    const  SENTENCE_SEP = 100;
    const  SENTENCE_SEP_LIMIT = 200;
    const  SENTENCE_TERM = 0;
    const  SENTENCE_TERM_LIMIT = 100;
    const  WORD_IDEO = 400;
    const WORD_IDEO_LIMIT = 500;
    const  WORD_KANA = 300;
    const  WORD_KANA_LIMIT = 400;
    const  WORD_LETTER = 200;
    const  WORD_LETTER_LIMIT = 300;
    const  WORD_NONE = 0;
    const  WORD_NONE_LIMIT = 100;
    const  WORD_NUMBER = 100;
    const  WORD_NUMBER_LIMIT = 200;
    /* Methods */
    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Private constructor for disallowing instantiation
     */
    private function __construct() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for boundaries of combining character sequences
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createcharacterinstance.php
     *
     * @param string $locale
     *
     * @return IntlBreakIterator
     */
    public static function createCharacterInstance($locale) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for boundaries of code points
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createcodepointinstance.php
     * @return IntlBreakIterator
     */
    public static function createCodePointInstance() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for logically possible line breaks
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createlineinstance.php
     *
     * @param string $locale
     *
     * @return IntlBreakIterator
     */
    public static function createLineInstance($locale) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for sentence breaks
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createsentenceinstance.php
     *
     * @param string $locale
     *
     * @return IntlBreakIterator
     */
    public static function createSentenceInstance($locale) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for title-casing breaks
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createtitleinstance.php
     *
     * @param string $locale
     *
     * @return IntlBreakIterator
     */
    public static function createTitleInstance($locale) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for word breaks
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createwordinstance.php
     *
     * @param string $locale
     *
     * @return IntlBreakIterator
     */
    public static function createWordInstance($locale) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get index of current position
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.current.php
     * @return int
     */
    public function current() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Set position to the first character in the text
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.first.php
     */
    public function first() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Advance the iterator to the first boundary following specified offset
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.following.php
     *
     * @param int $offset
     */
    public function following($offset) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get last error code on the object
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.geterrorcode.php
     * @return int
     */
    public function getErrorCode() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get last error message on the object
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.geterrormessage.php
     * @return string
     */
    public function getErrorMessage() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get the locale associated with the object
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.getlocale.php
     *
     * @param string $locale_type
     */
    public function getLocale($locale_type) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create iterator for navigating fragments between boundaries
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.getpartsiterator.php
     *
     * @param string $key_type [optional]
     */
    public function getPartsIterator($key_type) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get the text being scanned
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.gettext.php
     */
    public function getText() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Tell whether an offset is a boundary's offset
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.isboundary.php
     *
     * @param string $offset
     */
    public function isBoundary($offset) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Set the iterator position to index beyond the last character
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.last.php
     * @return int
     */
    public function last() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.next.php
     *
     * @param string $offset [optional]
     *
     * @return int
     */
    public function next($offset) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.preceding.php
     *
     * @param int $offset
     */
    public function preceding($offset) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Set the iterator position to the boundary immediately before the current
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.previous.php
     * @return int
     */
    public function previous() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Set the text being scanned
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.settext.php
     *
     * @param string $text
     */
    public function setText($text) { }
}

/**
 * Class IntlCalendar
 */
class IntlCalendar
{
    /* Constants */
    const DOW_FRIDAY = 6;
    const DOW_MONDAY = 2;
    const DOW_SATURDAY = 7;
    const DOW_SUNDAY = 1;
    const DOW_THURSDAY = 5;
    const DOW_TUESDAY = 3;
    const DOW_TYPE_WEEKDAY = 0;
    const DOW_TYPE_WEEKEND = 1;
    const DOW_TYPE_WEEKEND_CEASE = 3;
    const DOW_TYPE_WEEKEND_OFFSET = 2;
    const DOW_WEDNESDAY = 4;
    const FIELD_AM_PM = 9;
    const FIELD_DATE = 5;
    const FIELD_DAY_OF_MONTH = 5;
    const FIELD_DAY_OF_WEEK = 7;
    const FIELD_DAY_OF_WEEK_IN_MONTH = 8;
    const FIELD_DAY_OF_YEAR = 6;
    const FIELD_DOW_LOCAL = 18;
    const FIELD_DST_OFFSET = 16;
    const FIELD_ERA = 0;
    const FIELD_EXTENDED_YEAR = 19;
    const FIELD_FIELD_COUNT = 23;
    const FIELD_HOUR = 10;
    const FIELD_HOUR_OF_DAY = 11;
    const FIELD_IS_LEAP_MONTH = 22;
    const FIELD_JULIAN_DAY = 20;
    const FIELD_MILLISECOND = 14;
    const FIELD_MILLISECONDS_IN_DAY = 21;
    const FIELD_MINUTE = 12;
    const FIELD_MONTH = 2;
    const FIELD_SECOND = 13;
    const FIELD_WEEK_OF_MONTH = 4;
    const FIELD_WEEK_OF_YEAR = 3;
    const FIELD_YEAR = 1;
    const FIELD_YEAR_WOY = 17;
    const FIELD_ZONE_OFFSET = 15;
    const WALLTIME_FIRST = 1;
    const WALLTIME_LAST = 0;
    const WALLTIME_NEXT_VALID = 2;
    /* Methods */
    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Private constructor for disallowing instantiation
     *
     * @link http://www.php.net/manual/en/intlcalendar.construct.php
     *
     */
    private function __construct() { }

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
    public static function createInstance($timeZone = null, $locale = null) { }

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
    public static function fromDateTime($dateTime) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get array of locales for which there is data
     *
     * @link http://www.php.net/manual/en/intlcalendar.getavailablelocales.php
     * @return array An array of strings, one for which locale.
     */
    public static function getAvailableLocales() { }

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
    public static function getKeywordValuesForLocale($key, $locale, $commonlyUsed) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get number representing the current time
     *
     * @return float A float representing a number of milliseconds since the epoch, not counting leap seconds.
     */
    public static function getNow() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Add a (signed) amount of time to a field
     *
     * @link http://www.php.net/manual/en/intlcalendar.add.php
     *
     * @param int $field  <p>
     *                    One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time
     *                    {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
     *                    constants}. These are integer values between <em>0</em> and
     *                    <b>IntlCalendar::FIELD_COUNT</b>.
     *                    </p>
     * @param int $amount <p>The signed amount to add to the current field. If the amount is positive, the instant will
     *                    be moved forward; if it is negative, the instant wil be moved into the past. The unit is
     *                    implicit to the field type. For instance, hours for
     *                    <b>IntlCalendar::FIELD_HOUR_OF_DAY</b>.</p>
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function add($field, $amount) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Whether this object's time is after that of the passed object
     * http://www.php.net/manual/en/intlcalendar.after.php
     *
     * @param IntlCalendar $calendar <p>The calendar whose time will be checked against this object's time.</p>
     *
     * @return bool
     * Returns <b>TRUE</b> if this object's current time is after that of the
     * <em>calendar</em> argument's time. Returns <b>FALSE</b> otherwise.
     * Also returns <b>FALSE</b> on failure. You can use {@link
     * http://www.php.net/manual/en/intl.configuration.php#ini.intl.use-exceptions exceptions} or
     * {@link http://www.php.net/manual/en/function.intl-get-error-code.php intl_get_error_code()} to detect error
     * conditions.
     */
    public function after(IntlCalendar $calendar) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Whether this object's time is before that of the passed object
     *
     * @link http://www.php.net/manual/en/intlcalendar.before.php
     *
     * @param IntlCalendar $calendar <p> The calendar whose time will be checked against this object's time.</p>
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
    public function before(IntlCalendar $calendar) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Clear a field or all fields
     *
     * @link http://www.php.net/manual/en/intlcalendar.clear.php
     *
     * @param int $field [optional] <p>
     *                   One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time
     *                   {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
     *                   constants}. These are integer values between <em>0</em> and
     *                   <b>IntlCalendar::FIELD_COUNT</b>.
     *                   </p>
     *
     * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure. Failure can only occur is invalid
     *              arguments are provided.
     */
    public function clear($field = null) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Compare time of two IntlCalendar objects for equality
     *
     * @link http://www.php.net/manual/en/intlcalendar.equals.php
     *
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
    public function equals($calendar) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Calculate difference between given time and this object's time
     *
     * @link http://www.php.net/manual/en/intlcalendar.fielddifference.php
     *
     * @param float $when  <p>
     *                     The time against which to compare the quantity represented by the
     *                     <em>field</em>. For the result to be positive, the time
     *                     given for this parameter must be ahead of the time of the object the
     *                     method is being invoked on.
     *                     </p>
     * @param int   $field <p>
     *                     The field that represents the quantity being compared.
     *                     </p>
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
    public function fieldDifference($when, $field) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the value for a field
     *
     * @link http://www.php.net/manual/en/intlcalendar.get.php
     *
     * @param int $field <p>
     *                   One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time
     *                   {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
     *                   constants}. These are integer values between <em>0</em> and
     *                   <b>IntlCalendar::FIELD_COUNT</b>.
     *                   </p>
     *
     * @return int An integer with the value of the time field.
     */
    public function get($field) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * The maximum value for a field, considering the object's current time
     *
     * @link http://www.php.net/manual/en/intlcalendar.getactualmaximum.php
     *
     * @param int $field <p>
     *                   One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time
     *                   {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
     *                   constants}. These are integer values between <em>0</em> and
     *                   <b>IntlCalendar::FIELD_COUNT</b>.
     *                   </p>
     *
     * @return int
     * An {@link http://www.php.net/manual/en/language.types.integer.php int} representing the maximum value in the
     * units associated with the given <em>field</em> or <b>FALSE</b> on failure.
     */
    public function getActualMaximum($field) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * The minimum value for a field, considering the object's current time
     *
     * @link http://www.php.net/manual/en/intlcalendar.getactualminimum.php
     *
     * @param int $field <p>
     *                   One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time
     *                   {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
     *                   constants}. These are integer values between <em>0</em> and
     *                   <b>IntlCalendar::FIELD_COUNT</b>.
     *                   </p>
     *
     * @return int
     * An {@link http://www.php.net/manual/en/language.types.integer.php int} representing the minimum value in the
     * field's unit or <b>FALSE</b> on failure.
     */
    public function getActualMinimum($field) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Tell whether a day is a weekday, weekend or a day that has a transition between the two
     *
     * @param int $dayOfWeek <p>
     *                       One of the constants <b>IntlCalendar::DOW_SUNDAY</b>,
     *                       <b>IntlCalendar::DOW_MONDAY</b>, ...,
     *                       <b>IntlCalendar::DOW_SATURDAY</b>.
     *                       </p>
     *
     * @return int
     * Returns one of the constants
     * <b>IntlCalendar::DOW_TYPE_WEEKDAY</b>,
     * <b>IntlCalendar::DOW_TYPE_WEEKEND</b>,
     * <b>IntlCalendar::DOW_TYPE_WEEKEND_OFFSET</b> or
     * <b>IntlCalendar::DOW_TYPE_WEEKEND_CEASE</b> or <b>FALSE</b> on failure.
     *
     */
    public function getDayOfWeekType($dayOfWeek) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get last error code on the object
     *
     * @link http://www.php.net/manual/en/intlcalendar.geterrorcode.php
     * @return int An ICU error code indicating either success, failure or a warning.
     *
     */
    public function getErrorCode() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get last error message on the object
     *
     * @link http://www.php.net/manual/en/intlcalendar.geterrormessage.php
     * @return string The error message associated with last error that occurred in a function call on this object, or
     *                a string indicating the non-existance of an error.
     */
    public function getErrorMessage() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the first day of the week for the calendar's locale
     *
     * @link http://www.php.net/manual/en/intlcalendar.getfirstdayofweek.php
     * @return int
     * One of the constants <b>IntlCalendar::DOW_SUNDAY</b>,
     * <b>IntlCalendar::DOW_MONDAY</b>, ...,
     * <b>IntlCalendar::DOW_SATURDAY</b> or <b>FALSE</b> on failure.
     *
     */
    public function getFirstDayOfWeek() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the largest local minimum value for a field
     *
     * @link http://www.php.net/manual/en/intlcalendar.getgreatestminimum.php
     *
     * @param int $field <p>
     *                   One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time
     *                   {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
     *                   constants}. These are integer values between <em>0</em> and
     *                   <b>IntlCalendar::FIELD_COUNT</b>.
     *
     * @return int
     * An {@link http://www.php.net/manual/en/language.types.integer.php int} representing a field value, in the
     * field's
     * unit, or <b>FALSE</b> on failure.
     */
    public function getGreatestMinimum($field) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the smallest local maximum for a field
     *
     * @link http://www.php.net/manual/en/intlcalendar.getleastmaximum.php
     *
     * @param int $field <p>
     *                   One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time
     *                   {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
     *                   constants}. These are integer values between <em>0</em> and
     *                   <b>IntlCalendar::FIELD_COUNT</b>.
     *                   </p>
     *
     * @return int
     * An {@link http://www.php.net/manual/en/language.types.integer.ph int} representing a field value in the field's
     * unit or <b>FALSE</b> on failure.
     * </p>
     */
    public function getLeastMaximum($field) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the locale associated with the object
     *
     * @link http://www.php.net/manual/en/intlcalendar.getlocale.php
     *
     * @param int $localeType <p>
     *                        Whether to fetch the actual locale (the locale from which the calendar
     *                        data originates, with <b>Locale::ACTUAL_LOCALE</b>) or the
     *                        valid locale, i.e., the most specific locale supported by ICU relatively
     *                        to the requested locale – see <b>Locale::VALID_LOCALE</b>.
     *                        From the most general to the most specific, the locales are ordered in
     *                        this fashion – actual locale, valid locale, requested locale.
     *                        </p>
     *
     * @return string
     * A locale string or <b>FALSE</b> on failure.
     *
     */
    public function getLocale($localeType) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the global maximum value for a field
     *
     * @link http://www.php.net/manual/en/intlcalendar.getmaximum.php
     *
     * @param int $field <p>
     *                   One of the {@link www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time {@link
     *                   http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field constants}.
     *                   These are integer values between <em>0</em> and
     *                   <b>IntlCalendar::FIELD_COUNT</b>.
     *                   </p>
     *
     * @return string
     * A locale string or <b>FALSE</b> on failure.
     */
    public function getMaximum($field) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get minimal number of days the first week in a year or month can have
     *
     * @link http://www.php.net/manual/en/intlcalendar.getminimaldaysinfirstweek.php
     * @return int
     * An {@link http://www.php.net/manual/en/language.types.integer.php  int} representing a number of days or
     * <b>FALSE</b> on failure.
     */
    public function getMinimalDaysInFirstWeek() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the global minimum value for a field
     *
     * @link http://www.php.net/manual/en/intlcalendar.getminimum.php
     *
     * @param int $field <p>
     *                   One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time
     *                   {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field}.
     *                   These are integer values between <em>0</em> and
     *                   <b>IntlCalendar::FIELD_COUNT</b>.
     *                   </p>
     *
     * @return int
     * An int representing a value for the given field in the field's unit or FALSE on failure.
     */
    public function getMinimum($field) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get behavior for handling repeating wall time
     *
     * @link http://www.php.net/manual/en/intlcalendar.getrepeatedwalltimeoption.php
     * @return int
     * One of the constants <b>IntlCalendar::WALLTIME_FIRST</b> or
     * <b>IntlCalendar::WALLTIME_LAST</b>.
     *
     */
    public function getRepeatedWallTimeOption() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get behavior for handling skipped wall time
     *
     * @link http://www.php.net/manual/en/intlcalendar.getskippedwalltimeoption.php
     * @return int
     * One of the constants <b>IntlCalendar::WALLTIME_FIRST</b>,
     * <b>IntlCalendar::WALLTIME_LAST</b> or
     * <b>IntlCalendar::WALLTIME_NEXT_VALID</b>.
     */
    public function getSkippedWallTimeOption() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get time currently represented by the object
     *
     * @return float
     * A {@link http://www.php.net/manual/en/language.types.float.php float} representing the number of milliseconds
     * elapsed since the reference time (1 Jan 1970 00:00:00 UTC).
     */
    public function getTime() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the object's timezone
     *
     * @link http://www.php.net/manual/en/intlcalendar.gettimezone.php
     * @return IntlTimeZone
     * An {@link http://www.php.net/manual/en/class.intltimezone.php IntlTimeZone} object corresponding to the one used
     * internally in this object.
     */
    public function getTimeZone() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the calendar type
     *
     * @link http://www.php.net/manual/en/intlcalendar.gettype.php
     * @return string
     * A {@link http://www.php.net/manual/en/language.types.string.php string} representing the calendar type, such as
     * <em>'gregorian'</em>, <em>'islamic'</em>, etc.
     */
    public function getType() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get time of the day at which weekend begins or ends
     *
     * @link http://www.php.net/manual/en/intlcalendar.getweekendtransition.php
     *
     * @param string $dayOfWeek <p>
     *                          One of the constants <b>IntlCalendar::DOW_SUNDAY</b>,
     *                          <b>IntlCalendar::DOW_MONDAY</b>, ...,
     *                          <b>IntlCalendar::DOW_SATURDAY</b>.
     *                          </p>
     *
     * @return int
     * The number of milliseconds into the day at which the the weekend begins or
     * ends or <b>FALSE</b> on failure.
     */
    public function getWeekendTransition($dayOfWeek) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Whether the object's time is in Daylight Savings Time
     *
     * @link http://www.php.net/manual/en/intlcalendar.indaylighttime.php
     * @return bool
     * Returns <b>TRUE</b> if the date is in Daylight Savings Time, <b>FALSE</b> otherwise.
     * The value <b>FALSE</b> may also be returned on failure, for instance after
     * specifying invalid field values on non-lenient mode; use {@link
     * http://www.php.net/manual/en/intl.configuration.php#ini.intl.use-exceptions exceptions} or query
     * {@link http://www.php.net/manual/en/function.intl-get-error-code.php intl_get_error_code()} to disambiguate.
     */
    public function inDaylightTime() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Whether another calendar is equal but for a different time
     *
     * @link http://www.php.net/manual/en/intlcalendar.isequivalentto.php
     *
     * @param IntlCalendar $calendar The other calendar against which the comparison is to be made.
     *
     * @return bool
     * Assuming there are no argument errors, returns <b>TRUE</b> iif the calendars are equivalent except possibly for
     * their set time.
     */
    public function isEquivalentTo(IntlCalendar $calendar) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Whether date/time interpretation is in lenient mode
     *
     * @link http://www.php.net/manual/en/intlcalendar.islenient.php
     * @return bool
     * A {@link http://www.php.net/manual/en/language.types.boolean.php bool} representing whether the calendar is set
     * to lenient mode.
     */
    public function isLenient() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Whether a field is set
     *
     * @link http://www.php.net/manual/en/intlcalendar.isset.php
     *
     * @param int $field <p>
     *                   One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar} date/time
     *                   {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
     *                   constants}. These are integer values between <em>0</em> and
     *                   <b>IntlCalendar::FIELD_COUNT</b>.
     *                   </p>
     *
     * @return bool Assuming there are no argument errors, returns <b>TRUE</b> iif the field is set.
     */
    public function PS_UNRESERVE_PREFIX_isSet($field) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Whether a certain date/time is in the weekend
     *
     * @link http://www.php.net/manual/en/intlcalendar.isweekend.php
     *
     * @param float $date [optional] <p>
     *                    An optional timestamp representing the number of milliseconds since the
     *                    epoch, excluding leap seconds. If <b>NULL</b>, this object's current time is
     *                    used instead.
     *                    </p>
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
    public function isWeekend($date = null) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Add value to field without carrying into more significant fields
     *
     * @link http://www.php.net/manual/en/intlcalendar.roll.php
     *
     * @param int   $field
     *                                <p>One of the {@link http://www.php.net/manual/en/class.intlcalendar.php
     *                                IntlCalendar} date/time
     *                                {@link http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants
     *                                field constants}. These are integer values between <em>0</em> and
     *                                <b>IntlCalendar::FIELD_COUNT</b>.
     *                                </p>
     * @param mixed $amountOrUpOrDown <p>
     *                                The (signed) amount to add to the field, <b>TRUE</b> for rolling up (adding
     *                                <em>1</em>), or <b>FALSE</b> for rolling down (subtracting
     *                                <em>1</em>).
     *                                </p>
     *
     * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function roll($field, $amountOrUpOrDown) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Set a time field or several common fields at once
     *
     * @link http://www.php.net/manual/en/intlcalendar.set.php
     *
     * @param int $year       <p>
     *                        One of the {@link http://www.php.net/manual/en/class.intlcalendar.php IntlCalendar}
     *                        date/time {@link
     *                        http://www.php.net/manual/en/class.intlcalendar.php#intlcalendar.constants field
     *                        constants}. These are integer values between <em>0</em> and
     *                        <b>IntlCalendar::FIELD_COUNT</b>.
     *                        </p>
     * @param int $month      <p>
     *                        The new value for <b>IntlCalendar::FIELD_MONTH</b>.
     *                        </p>
     * @param int $dayOfMonth [optional] <p>
     *                        The new value for <b>IntlCalendar::FIELD_DAY_OF_MONTH</b>.
     *                        The month sequence is zero-based, i.e., January is represented by 0,
     *                        February by 1, ..., December is 11 and Undecember (if the calendar has
     *                        it) is 12.
     *                        </p>
     * @param int $hour       [optional]
     *                        <p>
     *                        The new value for <b>IntlCalendar::FIELD_HOUR_OF_DAY</b>.
     *                        </p>
     * @param int $minute     [optional]
     *                        <p>
     *                        The new value for <b>IntlCalendar::FIELD_MINUTE</b>.
     *                        </p>
     * @param int $second     [optional] <p>
     *                        The new value for <b>IntlCalendar::FIELD_SECOND</b>.
     *                        </p>
     *
     * @return bool Returns <b>TRUE</b> on success and <b>FALSE</b> on failure.
     */
    public function set($year, $month, $dayOfMonth = null, $hour = null, $minute = null, $second = null) { }

    /**
     * (PHP 5 >=5.5.0 PECL intl >= 3.0.0a1)<br/>
     * Set a time field or several common fields at once
     *
     * @link http://www.php.net/manual/en/intlcalendar.set.php
     *
     * @param int $field One of the IntlCalendar date/time field constants. These are integer values between 0 and
     *                   IntlCalendar::FIELD_COUNT.
     * @param int $value The new value of the given field.
     *
     * @return bool Returns <b>TRUE</b> on success and <b>FALSE</b> on failure.
     */
    public function set($field, $value) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Set the day on which the week is deemed to start
     *
     * @link http://www.php.net/manual/en/intlcalendar.setfirstdayofweek.php
     *
     * @param int $dayOfWeek <p>
     *                       One of the constants <b>IntlCalendar::DOW_SUNDAY</b>,
     *                       <b>IntlCalendar::DOW_MONDAY</b>, ...,
     *                       <b>IntlCalendar::DOW_SATURDAY</b>.
     *                       </p>
     *
     * @return bool Returns TRUE on success. Failure can only happen due to invalid parameters.
     */
    public function setFirstDayOfWeek($dayOfWeek) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Set whether date/time interpretation is to be lenient
     *
     * @link http://www.php.net/manual/en/intlcalendar.setlenient.php
     *
     * @param string $isLenient <p>
     *                          Use <b>TRUE</b> to activate the lenient mode; <b>FALSE</b> otherwise.
     *                          </p>
     *
     * @return boolean Returns <b>TRUE</b> on success. Failure can only happen due to invalid parameters.
     */
    public function setLenient($isLenient) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Set behavior for handling repeating wall times at negative timezone offset transitions
     *
     * @link http://www.php.net/manual/en/intlcalendar.setrepeatedwalltimeoption.php
     *
     * @param int $wallTimeOption <p>
     *                            One of the constants <b>IntlCalendar::WALLTIME_FIRST</b> or
     *                            <b>IntlCalendar::WALLTIME_LAST</b>.
     *                            </p>
     *
     * @return bool
     * Returns <b>TRUE</b> on success. Failure can only happen due to invalid parameters.
     *
     */
    public function setRepeatedWallTimeOption($wallTimeOption) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Set behavior for handling skipped wall times at positive timezone offset transitions
     *
     * @link http://www.php.net/manual/en/intlcalendar.setskippedwalltimeoption.php
     *
     * @param int $wallTimeOption <p>
     *                            One of the constants <b>IntlCalendar::WALLTIME_FIRST</b>,
     *                            <b>IntlCalendar::WALLTIME_LAST</b> or
     *                            <b>IntlCalendar::WALLTIME_NEXT_VALID</b>.
     *                            </p>
     *
     * @return bool
     * <p>
     * Returns <b>TRUE</b> on success. Failure can only happen due to invalid parameters.
     * </p>
     */
    public function setSkippedWallTimeOption($wallTimeOption) { }

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
    public function setTime($date) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Set the timezone used by this calendar
     *
     * @link http://www.php.net/manual/en/intlcalendar.settimezone.php
     *
     * @param mixed $timeZone <p>
     *                        The new timezone to be used by this calendar. It can be specified in the
     *                        following ways:
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
     * identifier. See  b>IntlTimeZone::createTimeZoneIDEnumeration()</b>. Raw offsets such as <em>"GMT+08:30"</em> are
     * also accepted.
     * </p>
     * </li>
     * </ul>
     *
     * @return bool Returns <b>TRUE</b> on success and <b>FALSE</b> on failure.
     */
    public function setTimeZone($timeZone) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a2)<br/>
     * Convert an IntlCalendar into a DateTime object
     *
     * @link http://www.php.net/manual/en/intlcalendar.todatetime.php
     * @return DateTime|bool
     * A {@link http://www.php.net/manual/en/class.datetime.php DateTime} object with the same timezone as this
     * object (though using PHP's database instead of ICU's) and the same time,
     * except for the smaller precision (second precision instead of millisecond).
     * Returns <b>FALSE</b> on failure.
     */
    public function toDateTime() { }
}

/**
 * <p>IntlChar provides access to a number of utility methods that can be used to access information about Unicode
 * characters.</p>
 * <p>The methods and constants adhere closely to the names and behavior used by the underlying ICU library.</p>
 *
 * @since 7.0
 */
class IntlChar
{
    const BLOCK_CODE_AEGEAN_NUMBERS = 119;
    const BLOCK_CODE_ALCHEMICAL_SYMBOLS = 208;
    const BLOCK_CODE_ALPHABETIC_PRESENTATION_FORMS = 80;
    const BLOCK_CODE_ANCIENT_GREEK_MUSICAL_NOTATION = 126;
    const BLOCK_CODE_ANCIENT_GREEK_NUMBERS = 127;
    const BLOCK_CODE_ANCIENT_SYMBOLS = 165;
    const BLOCK_CODE_ARABIC = 12;
    const BLOCK_CODE_ARABIC_EXTENDED_A = 210;
    const BLOCK_CODE_ARABIC_MATHEMATICAL_ALPHABETIC_SYMBOLS = 211;
    const BLOCK_CODE_ARABIC_PRESENTATION_FORMS_A = 81;
    const BLOCK_CODE_ARABIC_PRESENTATION_FORMS_B = 85;
    const BLOCK_CODE_ARABIC_SUPPLEMENT = 128;
    const BLOCK_CODE_ARMENIAN = 10;
    const BLOCK_CODE_ARROWS = 46;
    const BLOCK_CODE_AVESTAN = 188;
    const BLOCK_CODE_BALINESE = 147;
    const BLOCK_CODE_BAMUM = 177;
    const BLOCK_CODE_BAMUM_SUPPLEMENT = 202;
    const BLOCK_CODE_BASIC_LATIN = 1;
    const BLOCK_CODE_BASSA_VAH = 221;
    const BLOCK_CODE_BATAK = 199;
    const BLOCK_CODE_BENGALI = 16;
    const BLOCK_CODE_BLOCK_ELEMENTS = 53;
    const BLOCK_CODE_BOPOMOFO = 64;
    const BLOCK_CODE_BOPOMOFO_EXTENDED = 67;
    const BLOCK_CODE_BOX_DRAWING = 52;
    const BLOCK_CODE_BRAHMI = 201;
    const BLOCK_CODE_BRAILLE_PATTERNS = 57;
    const BLOCK_CODE_BUGINESE = 129;
    const BLOCK_CODE_BUHID = 100;
    const BLOCK_CODE_BYZANTINE_MUSICAL_SYMBOLS = 91;
    const BLOCK_CODE_CARIAN = 168;
    const BLOCK_CODE_CAUCASIAN_ALBANIAN = 222;
    const BLOCK_CODE_CHAKMA = 212;
    const BLOCK_CODE_CHAM = 164;
    const BLOCK_CODE_CHEROKEE = 32;
    const BLOCK_CODE_CJK_COMPATIBILITY = 69;
    const BLOCK_CODE_CJK_COMPATIBILITY_FORMS = 83;
    const BLOCK_CODE_CJK_COMPATIBILITY_IDEOGRAPHS = 79;
    const BLOCK_CODE_CJK_COMPATIBILITY_IDEOGRAPHS_SUPPLEMENT = 95;
    const BLOCK_CODE_CJK_RADICALS_SUPPLEMENT = 58;
    const BLOCK_CODE_CJK_STROKES = 130;
    const BLOCK_CODE_CJK_SYMBOLS_AND_PUNCTUATION = 61;
    const BLOCK_CODE_CJK_UNIFIED_IDEOGRAPHS = 71;
    const BLOCK_CODE_CJK_UNIFIED_IDEOGRAPHS_EXTENSION_A = 70;
    const BLOCK_CODE_CJK_UNIFIED_IDEOGRAPHS_EXTENSION_B = 94;
    const BLOCK_CODE_CJK_UNIFIED_IDEOGRAPHS_EXTENSION_C = 197;
    const BLOCK_CODE_CJK_UNIFIED_IDEOGRAPHS_EXTENSION_D = 209;
    const BLOCK_CODE_COMBINING_DIACRITICAL_MARKS = 7;
    const BLOCK_CODE_COMBINING_DIACRITICAL_MARKS_EXTENDED = 224;
    const BLOCK_CODE_COMBINING_DIACRITICAL_MARKS_SUPPLEMENT = 131;
    const BLOCK_CODE_COMBINING_HALF_MARKS = 82;
    const BLOCK_CODE_COMBINING_MARKS_FOR_SYMBOLS = 43;
    const BLOCK_CODE_COMMON_INDIC_NUMBER_FORMS = 178;
    const BLOCK_CODE_CONTROL_PICTURES = 49;
    const BLOCK_CODE_COPTIC = 132;
    const BLOCK_CODE_COPTIC_EPACT_NUMBERS = 223;
    const BLOCK_CODE_COUNT = 263;
    const BLOCK_CODE_COUNTING_ROD_NUMERALS = 154;
    const BLOCK_CODE_CUNEIFORM = 152;
    const BLOCK_CODE_CUNEIFORM_NUMBERS_AND_PUNCTUATION = 153;
    const BLOCK_CODE_CURRENCY_SYMBOLS = 42;
    const BLOCK_CODE_CYPRIOT_SYLLABARY = 123;
    const BLOCK_CODE_CYRILLIC = 9;
    const BLOCK_CODE_CYRILLIC_EXTENDED_A = 158;
    const BLOCK_CODE_CYRILLIC_EXTENDED_B = 160;
    const BLOCK_CODE_CYRILLIC_SUPPLEMENT = 97;
    const BLOCK_CODE_CYRILLIC_SUPPLEMENTARY = 97;
    const BLOCK_CODE_DESERET = 90;
    const BLOCK_CODE_DEVANAGARI = 15;
    const BLOCK_CODE_DEVANAGARI_EXTENDED = 179;
    const BLOCK_CODE_DINGBATS = 56;
    const BLOCK_CODE_DOMINO_TILES = 171;
    const BLOCK_CODE_DUPLOYAN = 225;
    const BLOCK_CODE_EGYPTIAN_HIEROGLYPHS = 194;
    const BLOCK_CODE_ELBASAN = 226;
    const BLOCK_CODE_EMOTICONS = 206;
    const BLOCK_CODE_ENCLOSED_ALPHANUMERICS = 51;
    const BLOCK_CODE_ENCLOSED_ALPHANUMERIC_SUPPLEMENT = 195;
    const BLOCK_CODE_ENCLOSED_CJK_LETTERS_AND_MONTHS = 68;
    const BLOCK_CODE_ENCLOSED_IDEOGRAPHIC_SUPPLEMENT = 196;
    const BLOCK_CODE_ETHIOPIC = 31;
    const BLOCK_CODE_ETHIOPIC_EXTENDED = 133;
    const BLOCK_CODE_ETHIOPIC_EXTENDED_A = 200;
    const BLOCK_CODE_ETHIOPIC_SUPPLEMENT = 134;
    const BLOCK_CODE_GENERAL_PUNCTUATION = 40;
    const BLOCK_CODE_GEOMETRIC_SHAPES = 54;
    const BLOCK_CODE_GEOMETRIC_SHAPES_EXTENDED = 227;
    const BLOCK_CODE_GEORGIAN = 29;
    const BLOCK_CODE_GEORGIAN_SUPPLEMENT = 135;
    const BLOCK_CODE_GLAGOLITIC = 136;
    const BLOCK_CODE_GOTHIC = 89;
    const BLOCK_CODE_GRANTHA = 228;
    const BLOCK_CODE_GREEK = 8;
    const BLOCK_CODE_GREEK_EXTENDED = 39;
    const BLOCK_CODE_GUJARATI = 18;
    const BLOCK_CODE_GURMUKHI = 17;
    const BLOCK_CODE_HALFWIDTH_AND_FULLWIDTH_FORMS = 87;
    const BLOCK_CODE_HANGUL_COMPATIBILITY_JAMO = 65;
    const BLOCK_CODE_HANGUL_JAMO = 30;
    const BLOCK_CODE_HANGUL_JAMO_EXTENDED_A = 180;
    const BLOCK_CODE_HANGUL_JAMO_EXTENDED_B = 185;
    const BLOCK_CODE_HANGUL_SYLLABLES = 74;
    const BLOCK_CODE_HANUNOO = 99;
    const BLOCK_CODE_HEBREW = 11;
    const BLOCK_CODE_HIGH_PRIVATE_USE_SURROGATES = 76;
    const BLOCK_CODE_HIGH_SURROGATES = 75;
    const BLOCK_CODE_HIRAGANA = 62;
    const BLOCK_CODE_IDEOGRAPHIC_DESCRIPTION_CHARACTERS = 60;
    const BLOCK_CODE_IMPERIAL_ARAMAIC = 186;
    const BLOCK_CODE_INSCRIPTIONAL_PAHLAVI = 190;
    const BLOCK_CODE_INSCRIPTIONAL_PARTHIAN = 189;
    const BLOCK_CODE_INVALID_CODE = -1;
    const BLOCK_CODE_IPA_EXTENSIONS = 5;
    const BLOCK_CODE_JAVANESE = 181;
    const BLOCK_CODE_KAITHI = 193;
    const BLOCK_CODE_KANA_SUPPLEMENT = 203;
    const BLOCK_CODE_KANBUN = 66;
    const BLOCK_CODE_KANGXI_RADICALS = 59;
    const BLOCK_CODE_KANNADA = 22;
    const BLOCK_CODE_KATAKANA = 63;
    const BLOCK_CODE_KATAKANA_PHONETIC_EXTENSIONS = 107;
    const BLOCK_CODE_KAYAH_LI = 162;
    const BLOCK_CODE_KHAROSHTHI = 137;
    const BLOCK_CODE_KHMER = 36;
    const BLOCK_CODE_KHMER_SYMBOLS = 113;
    const BLOCK_CODE_KHOJKI = 229;
    const BLOCK_CODE_KHUDAWADI = 230;
    const BLOCK_CODE_LAO = 26;
    const BLOCK_CODE_LATIN_1_SUPPLEMENT = 2;
    const BLOCK_CODE_LATIN_EXTENDED_A = 3;
    const BLOCK_CODE_LATIN_EXTENDED_ADDITIONAL = 38;
    const BLOCK_CODE_LATIN_EXTENDED_B = 4;
    const BLOCK_CODE_LATIN_EXTENDED_C = 148;
    const BLOCK_CODE_LATIN_EXTENDED_D = 149;
    const BLOCK_CODE_LATIN_EXTENDED_E = 231;
    const BLOCK_CODE_LEPCHA = 156;
    const BLOCK_CODE_LETTERLIKE_SYMBOLS = 44;
    const BLOCK_CODE_LIMBU = 111;
    const BLOCK_CODE_LINEAR_A = 232;
    const BLOCK_CODE_LINEAR_B_IDEOGRAMS = 118;
    const BLOCK_CODE_LINEAR_B_SYLLABARY = 117;
    const BLOCK_CODE_LISU = 176;
    const BLOCK_CODE_LOW_SURROGATES = 77;
    const BLOCK_CODE_LYCIAN = 167;
    const BLOCK_CODE_LYDIAN = 169;
    const BLOCK_CODE_MAHAJANI = 233;
    const BLOCK_CODE_MAHJONG_TILES = 170;
    const BLOCK_CODE_MALAYALAM = 23;
    const BLOCK_CODE_MANDAIC = 198;
    const BLOCK_CODE_MANICHAEAN = 234;
    const BLOCK_CODE_MATHEMATICAL_ALPHANUMERIC_SYMBOLS = 93;
    const BLOCK_CODE_MATHEMATICAL_OPERATORS = 47;
    const BLOCK_CODE_MEETEI_MAYEK = 184;
    const BLOCK_CODE_MEETEI_MAYEK_EXTENSIONS = 213;
    const BLOCK_CODE_MENDE_KIKAKUI = 235;
    const BLOCK_CODE_MEROITIC_CURSIVE = 214;
    const BLOCK_CODE_MEROITIC_HIEROGLYPHS = 215;
    const BLOCK_CODE_MIAO = 216;
    const BLOCK_CODE_MISCELLANEOUS_MATHEMATICAL_SYMBOLS_A = 102;
    const BLOCK_CODE_MISCELLANEOUS_MATHEMATICAL_SYMBOLS_B = 105;
    const BLOCK_CODE_MISCELLANEOUS_SYMBOLS = 55;
    const BLOCK_CODE_MISCELLANEOUS_SYMBOLS_AND_ARROWS = 115;
    const BLOCK_CODE_MISCELLANEOUS_SYMBOLS_AND_PICTOGRAPHS = 205;
    const BLOCK_CODE_MISCELLANEOUS_TECHNICAL = 48;
    const BLOCK_CODE_MODI = 236;
    const BLOCK_CODE_MODIFIER_TONE_LETTERS = 138;
    const BLOCK_CODE_MONGOLIAN = 37;
    const BLOCK_CODE_MRO = 237;
    const BLOCK_CODE_MUSICAL_SYMBOLS = 92;
    const BLOCK_CODE_MYANMAR = 28;
    const BLOCK_CODE_MYANMAR_EXTENDED_A = 182;
    const BLOCK_CODE_MYANMAR_EXTENDED_B = 238;
    const BLOCK_CODE_NABATAEAN = 239;
    const BLOCK_CODE_NEW_TAI_LUE = 139;
    const BLOCK_CODE_NKO = 146;
    const BLOCK_CODE_NO_BLOCK = 0;
    const BLOCK_CODE_NUMBER_FORMS = 45;
    const BLOCK_CODE_OGHAM = 34;
    const BLOCK_CODE_OLD_ITALIC = 88;
    const BLOCK_CODE_OLD_NORTH_ARABIAN = 240;
    const BLOCK_CODE_OLD_PERMIC = 241;
    const BLOCK_CODE_OLD_PERSIAN = 140;
    const BLOCK_CODE_OLD_SOUTH_ARABIAN = 187;
    const BLOCK_CODE_OLD_TURKIC = 191;
    const BLOCK_CODE_OL_CHIKI = 157;
    const BLOCK_CODE_OPTICAL_CHARACTER_RECOGNITION = 50;
    const BLOCK_CODE_ORIYA = 19;
    const BLOCK_CODE_ORNAMENTAL_DINGBATS = 242;
    const BLOCK_CODE_OSMANYA = 122;
    const BLOCK_CODE_PAHAWH_HMONG = 243;
    const BLOCK_CODE_PALMYRENE = 244;
    const BLOCK_CODE_PAU_CIN_HAU = 245;
    const BLOCK_CODE_PHAGS_PA = 150;
    const BLOCK_CODE_PHAISTOS_DISC = 166;
    const BLOCK_CODE_PHOENICIAN = 151;
    const BLOCK_CODE_PHONETIC_EXTENSIONS = 114;
    const BLOCK_CODE_PHONETIC_EXTENSIONS_SUPPLEMENT = 141;
    const BLOCK_CODE_PLAYING_CARDS = 204;
    const BLOCK_CODE_PRIVATE_USE = 78;
    const BLOCK_CODE_PRIVATE_USE_AREA = 78;
    const BLOCK_CODE_PSALTER_PAHLAVI = 246;
    const BLOCK_CODE_REJANG = 163;
    const BLOCK_CODE_RUMI_NUMERAL_SYMBOLS = 192;
    const BLOCK_CODE_RUNIC = 35;
    const BLOCK_CODE_SAMARITAN = 172;
    const BLOCK_CODE_SAURASHTRA = 161;
    const BLOCK_CODE_SHARADA = 217;
    const BLOCK_CODE_SHAVIAN = 121;
    const BLOCK_CODE_SHORTHAND_FORMAT_CONTROLS = 247;
    const BLOCK_CODE_SIDDHAM = 248;
    const BLOCK_CODE_SINHALA = 24;
    const BLOCK_CODE_SINHALA_ARCHAIC_NUMBERS = 249;
    const BLOCK_CODE_SMALL_FORM_VARIANTS = 84;
    const BLOCK_CODE_SORA_SOMPENG = 218;
    const BLOCK_CODE_SPACING_MODIFIER_LETTERS = 6;
    const BLOCK_CODE_SPECIALS = 86;
    const BLOCK_CODE_SUNDANESE = 155;
    const BLOCK_CODE_SUNDANESE_SUPPLEMENT = 219;
    const BLOCK_CODE_SUPERSCRIPTS_AND_SUBSCRIPTS = 41;
    const BLOCK_CODE_SUPPLEMENTAL_ARROWS_A = 103;
    const BLOCK_CODE_SUPPLEMENTAL_ARROWS_B = 104;
    const BLOCK_CODE_SUPPLEMENTAL_ARROWS_C = 250;
    const BLOCK_CODE_SUPPLEMENTAL_MATHEMATICAL_OPERATORS = 106;
    const BLOCK_CODE_SUPPLEMENTAL_PUNCTUATION = 142;
    const BLOCK_CODE_SUPPLEMENTARY_PRIVATE_USE_AREA_A = 109;
    const BLOCK_CODE_SUPPLEMENTARY_PRIVATE_USE_AREA_B = 110;
    const BLOCK_CODE_SYLOTI_NAGRI = 143;
    const BLOCK_CODE_SYRIAC = 13;
    const BLOCK_CODE_TAGALOG = 98;
    const BLOCK_CODE_TAGBANWA = 101;
    const BLOCK_CODE_TAGS = 96;
    const BLOCK_CODE_TAI_LE = 112;
    const BLOCK_CODE_TAI_THAM = 174;
    const BLOCK_CODE_TAI_VIET = 183;
    const BLOCK_CODE_TAI_XUAN_JING_SYMBOLS = 124;
    const BLOCK_CODE_TAKRI = 220;
    const BLOCK_CODE_TAMIL = 20;
    const BLOCK_CODE_TELUGU = 21;
    const BLOCK_CODE_THAANA = 14;
    const BLOCK_CODE_THAI = 25;
    const BLOCK_CODE_TIBETAN = 27;
    const BLOCK_CODE_TIFINAGH = 144;
    const BLOCK_CODE_TIRHUTA = 251;
    const BLOCK_CODE_TRANSPORT_AND_MAP_SYMBOLS = 207;
    const BLOCK_CODE_UGARITIC = 120;
    const BLOCK_CODE_UNIFIED_CANADIAN_ABORIGINAL_SYLLABICS = 33;
    const BLOCK_CODE_UNIFIED_CANADIAN_ABORIGINAL_SYLLABICS_EXTENDED = 173;
    const BLOCK_CODE_VAI = 159;
    const BLOCK_CODE_VARIATION_SELECTORS = 108;
    const BLOCK_CODE_VARIATION_SELECTORS_SUPPLEMENT = 125;
    const BLOCK_CODE_VEDIC_EXTENSIONS = 175;
    const BLOCK_CODE_VERTICAL_FORMS = 145;
    const BLOCK_CODE_WARANG_CITI = 252;
    const BLOCK_CODE_YIJING_HEXAGRAM_SYMBOLS = 116;
    const BLOCK_CODE_YI_RADICALS = 73;
    const BLOCK_CODE_YI_SYLLABLES = 72;
    const BPT_CLOSE = 2;
    const BPT_COUNT = 3;
    const BPT_NONE = 0;
    const BPT_OPEN = 1;
    const CHAR_CATEGORY_CHAR_CATEGORY_COUNT = 30;
    const CHAR_CATEGORY_COMBINING_SPACING_MARK = 8;
    const CHAR_CATEGORY_CONNECTOR_PUNCTUATION = 22;
    const CHAR_CATEGORY_CONTROL_CHAR = 15;
    const CHAR_CATEGORY_CURRENCY_SYMBOL = 25;
    const CHAR_CATEGORY_DASH_PUNCTUATION = 19;
    const CHAR_CATEGORY_DECIMAL_DIGIT_NUMBER = 9;
    const CHAR_CATEGORY_ENCLOSING_MARK = 7;
    const CHAR_CATEGORY_END_PUNCTUATION = 21;
    const CHAR_CATEGORY_FINAL_PUNCTUATION = 29;
    const CHAR_CATEGORY_FORMAT_CHAR = 16;
    const CHAR_CATEGORY_GENERAL_OTHER_TYPES = 0;
    const CHAR_CATEGORY_INITIAL_PUNCTUATION = 28;
    const CHAR_CATEGORY_LETTER_NUMBER = 10;
    const CHAR_CATEGORY_LINE_SEPARATOR = 13;
    const CHAR_CATEGORY_LOWERCASE_LETTER = 2;
    const CHAR_CATEGORY_MATH_SYMBOL = 24;
    const CHAR_CATEGORY_MODIFIER_LETTER = 4;
    const CHAR_CATEGORY_MODIFIER_SYMBOL = 26;
    const CHAR_CATEGORY_NON_SPACING_MARK = 6;
    const CHAR_CATEGORY_OTHER_LETTER = 5;
    const CHAR_CATEGORY_OTHER_NUMBER = 11;
    const CHAR_CATEGORY_OTHER_PUNCTUATION = 23;
    const CHAR_CATEGORY_OTHER_SYMBOL = 27;
    const CHAR_CATEGORY_PARAGRAPH_SEPARATOR = 14;
    const CHAR_CATEGORY_PRIVATE_USE_CHAR = 17;
    const CHAR_CATEGORY_SPACE_SEPARATOR = 12;
    const CHAR_CATEGORY_START_PUNCTUATION = 20;
    const CHAR_CATEGORY_SURROGATE = 18;
    const CHAR_CATEGORY_TITLECASE_LETTER = 3;
    const CHAR_CATEGORY_UNASSIGNED = 0;
    const CHAR_CATEGORY_UPPERCASE_LETTER = 1;
    const CHAR_DIRECTION_ARABIC_NUMBER = 5;
    const CHAR_DIRECTION_BLOCK_SEPARATOR = 7;
    const CHAR_DIRECTION_BOUNDARY_NEUTRAL = 18;
    const CHAR_DIRECTION_CHAR_DIRECTION_COUNT = 23;
    const CHAR_DIRECTION_COMMON_NUMBER_SEPARATOR = 6;
    const CHAR_DIRECTION_DIR_NON_SPACING_MARK = 17;
    const CHAR_DIRECTION_EUROPEAN_NUMBER = 2;
    const CHAR_DIRECTION_EUROPEAN_NUMBER_SEPARATOR = 3;
    const CHAR_DIRECTION_EUROPEAN_NUMBER_TERMINATOR = 4;
    const CHAR_DIRECTION_FIRST_STRONG_ISOLATE = 19;
    const CHAR_DIRECTION_LEFT_TO_RIGHT = 0;
    const CHAR_DIRECTION_LEFT_TO_RIGHT_EMBEDDING = 11;
    const CHAR_DIRECTION_LEFT_TO_RIGHT_ISOLATE = 20;
    const CHAR_DIRECTION_LEFT_TO_RIGHT_OVERRIDE = 12;
    const CHAR_DIRECTION_OTHER_NEUTRAL = 10;
    const CHAR_DIRECTION_POP_DIRECTIONAL_FORMAT = 16;
    const CHAR_DIRECTION_POP_DIRECTIONAL_ISOLATE = 22;
    const CHAR_DIRECTION_RIGHT_TO_LEFT = 1;
    const CHAR_DIRECTION_RIGHT_TO_LEFT_ARABIC = 13;
    const CHAR_DIRECTION_RIGHT_TO_LEFT_EMBEDDING = 14;
    const CHAR_DIRECTION_RIGHT_TO_LEFT_ISOLATE = 21;
    const CHAR_DIRECTION_RIGHT_TO_LEFT_OVERRIDE = 15;
    const CHAR_DIRECTION_SEGMENT_SEPARATOR = 8;
    const CHAR_DIRECTION_WHITE_SPACE_NEUTRAL = 9;
    const CHAR_NAME_ALIAS = 3;
    const CHAR_NAME_CHOICE_COUNT = 4;
    const CODEPOINT_MAX = 1114111;
    const CODEPOINT_MIN = 0;
    const DT_CANONICAL = 1;
    const DT_CIRCLE = 3;
    const DT_COMPAT = 2;
    const DT_COUNT = 18;
    const DT_FINAL = 4;
    const DT_FONT = 5;
    const DT_FRACTION = 6;
    const DT_INITIAL = 7;
    const DT_ISOLATED = 8;
    const DT_MEDIAL = 9;
    const DT_NARROW = 10;
    const DT_NOBREAK = 11;
    const DT_NONE = 0;
    const DT_SMALL = 12;
    const DT_SQUARE = 13;
    const DT_SUB = 14;
    const DT_SUPER = 15;
    const DT_VERTICAL = 16;
    const DT_WIDE = 17;
    const EA_AMBIGUOUS = 1;
    const EA_COUNT = 6;
    const EA_FULLWIDTH = 3;
    const EA_HALFWIDTH = 2;
    const EA_NARROW = 4;
    const EA_NEUTRAL = 0;
    const EA_WIDE = 5;
    const EXTENDED_CHAR_NAME = 2;
    const FOLD_CASE_DEFAULT = 0;
    const FOLD_CASE_EXCLUDE_SPECIAL_I = 1;
    const GCB_CONTROL = 1;
    const GCB_COUNT = 13;
    const GCB_CR = 2;
    const GCB_EXTEND = 3;
    const GCB_L = 4;
    const GCB_LF = 5;
    const GCB_LV = 6;
    const GCB_LVT = 7;
    const GCB_OTHER = 0;
    const GCB_PREPEND = 11;
    const GCB_REGIONAL_INDICATOR = 12;
    const GCB_SPACING_MARK = 10;
    const GCB_T = 8;
    const GCB_V = 9;
    const HST_COUNT = 6;
    const HST_LEADING_JAMO = 1;
    const HST_LVT_SYLLABLE = 5;
    const HST_LV_SYLLABLE = 4;
    const HST_NOT_APPLICABLE = 0;
    const HST_TRAILING_JAMO = 3;
    const HST_VOWEL_JAMO = 2;
    const JG_AIN = 1;
    const JG_ALAPH = 2;
    const JG_ALEF = 3;
    const JG_BEH = 4;
    const JG_BETH = 5;
    const JG_BURUSHASKI_YEH_BARREE = 54;
    const JG_COUNT = 86;
    const JG_DAL = 6;
    const JG_DALATH_RISH = 7;
    const JG_E = 8;
    const JG_FARSI_YEH = 55;
    const JG_FE = 51;
    const JG_FEH = 9;
    const JG_FINAL_SEMKATH = 10;
    const JG_GAF = 11;
    const JG_GAMAL = 12;
    const JG_HAH = 13;
    const JG_HAMZA_ON_HEH_GOAL = 14;
    const JG_HE = 15;
    const JG_HEH = 16;
    const JG_HEH_GOAL = 17;
    const JG_HETH = 18;
    const JG_KAF = 19;
    const JG_KAPH = 20;
    const JG_KHAPH = 52;
    const JG_KNOTTED_HEH = 21;
    const JG_LAM = 22;
    const JG_LAMADH = 23;
    const JG_MANICHAEAN_ALEPH = 58;
    const JG_MANICHAEAN_AYIN = 59;
    const JG_MANICHAEAN_BETH = 60;
    const JG_MANICHAEAN_DALETH = 61;
    const JG_MANICHAEAN_DHAMEDH = 62;
    const JG_MANICHAEAN_FIVE = 63;
    const JG_MANICHAEAN_GIMEL = 64;
    const JG_MANICHAEAN_HETH = 65;
    const JG_MANICHAEAN_HUNDRED = 66;
    const JG_MANICHAEAN_KAPH = 67;
    const JG_MANICHAEAN_LAMEDH = 68;
    const JG_MANICHAEAN_MEM = 69;
    const JG_MANICHAEAN_NUN = 70;
    const JG_MANICHAEAN_ONE = 71;
    const JG_MANICHAEAN_PE = 72;
    const JG_MANICHAEAN_QOPH = 73;
    const JG_MANICHAEAN_RESH = 74;
    const JG_MANICHAEAN_SADHE = 75;
    const JG_MANICHAEAN_SAMEKH = 76;
    const JG_MANICHAEAN_TAW = 77;
    const JG_MANICHAEAN_TEN = 78;
    const JG_MANICHAEAN_TETH = 79;
    const JG_MANICHAEAN_THAMEDH = 80;
    const JG_MANICHAEAN_TWENTY = 81;
    const JG_MANICHAEAN_WAW = 82;
    const JG_MANICHAEAN_YODH = 83;
    const JG_MANICHAEAN_ZAYIN = 84;
    const JG_MEEM = 24;
    const JG_MIM = 25;
    const JG_NOON = 26;
    const JG_NO_JOINING_GROUP = 0;
    const JG_NUN = 27;
    const JG_NYA = 56;
    const JG_PE = 28;
    const JG_QAF = 29;
    const JG_QAPH = 30;
    const JG_REH = 31;
    const JG_REVERSED_PE = 32;
    const JG_ROHINGYA_YEH = 57;
    const JG_SAD = 33;
    const JG_SADHE = 34;
    const JG_SEEN = 35;
    const JG_SEMKATH = 36;
    const JG_SHIN = 37;
    const JG_STRAIGHT_WAW = 85;
    const JG_SWASH_KAF = 38;
    const JG_SYRIAC_WAW = 39;
    const JG_TAH = 40;
    const JG_TAW = 41;
    const JG_TEH_MARBUTA = 42;
    const JG_TEH_MARBUTA_GOAL = 14;
    const JG_TETH = 43;
    const JG_WAW = 44;
    const JG_YEH = 45;
    const JG_YEH_BARREE = 46;
    const JG_YEH_WITH_TAIL = 47;
    const JG_YUDH = 48;
    const JG_YUDH_HE = 49;
    const JG_ZAIN = 50;
    const JG_ZHAIN = 53;
    const JT_COUNT = 6;
    const JT_DUAL_JOINING = 2;
    const JT_JOIN_CAUSING = 1;
    const JT_LEFT_JOINING = 3;
    const JT_NON_JOINING = 0;
    const JT_RIGHT_JOINING = 4;
    const JT_TRANSPARENT = 5;
    const LB_ALPHABETIC = 2;
    const LB_AMBIGUOUS = 1;
    const LB_BREAK_AFTER = 4;
    const LB_BREAK_BEFORE = 5;
    const LB_BREAK_BOTH = 3;
    const LB_BREAK_SYMBOLS = 27;
    const LB_CARRIAGE_RETURN = 10;
    const LB_CLOSE_PARENTHESIS = 36;
    const LB_CLOSE_PUNCTUATION = 8;
    const LB_COMBINING_MARK = 9;
    const LB_COMPLEX_CONTEXT = 24;
    const LB_CONDITIONAL_JAPANESE_STARTER = 37;
    const LB_CONTINGENT_BREAK = 7;
    const LB_COUNT = 40;
    const LB_EXCLAMATION = 11;
    const LB_GLUE = 12;
    const LB_H2 = 31;
    const LB_H3 = 32;
    const LB_HEBREW_LETTER = 38;
    const LB_HYPHEN = 13;
    const LB_IDEOGRAPHIC = 14;
    const LB_INFIX_NUMERIC = 16;
    const LB_INSEPARABLE = 15;
    const LB_INSEPERABLE = 15;
    const LB_JL = 33;
    const LB_JT = 34;
    const LB_JV = 35;
    const LB_LINE_FEED = 17;
    const LB_MANDATORY_BREAK = 6;
    const LB_NEXT_LINE = 29;
    const LB_NONSTARTER = 18;
    const LB_NUMERIC = 19;
    const LB_OPEN_PUNCTUATION = 20;
    const LB_POSTFIX_NUMERIC = 21;
    const LB_PREFIX_NUMERIC = 22;
    const LB_QUOTATION = 23;
    const LB_REGIONAL_INDICATOR = 39;
    const LB_SPACE = 26;
    const LB_SURROGATE = 25;
    const LB_UNKNOWN = 0;
    const LB_WORD_JOINER = 30;
    const LB_ZWSPACE = 28;
    const LONG_PROPERTY_NAME = 1;
    const NT_COUNT = 4;
    const NT_DECIMAL = 1;
    const NT_DIGIT = 2;
    const NT_NONE = 0;
    const NT_NUMERIC = 3;
    const PROPERTY_AGE = 16384;
    const PROPERTY_ALPHABETIC = 0;
    const PROPERTY_ASCII_HEX_DIGIT = 1;
    const PROPERTY_BIDI_CLASS = 4096;
    const PROPERTY_BIDI_CONTROL = 2;
    const PROPERTY_BIDI_MIRRORED = 3;
    const PROPERTY_BIDI_MIRRORING_GLYPH = 16385;
    const PROPERTY_BIDI_PAIRED_BRACKET = 16397;
    const PROPERTY_BIDI_PAIRED_BRACKET_TYPE = 4117;
    const PROPERTY_BINARY_LIMIT = 57;
    const PROPERTY_BINARY_START = 0;
    const PROPERTY_BLOCK = 4097;
    const PROPERTY_CANONICAL_COMBINING_CLASS = 4098;
    const PROPERTY_CASED = 49;
    const PROPERTY_CASE_FOLDING = 16386;
    const PROPERTY_CASE_IGNORABLE = 50;
    const PROPERTY_CASE_SENSITIVE = 34;
    const PROPERTY_CHANGES_WHEN_CASEFOLDED = 54;
    const PROPERTY_CHANGES_WHEN_CASEMAPPED = 55;
    const PROPERTY_CHANGES_WHEN_LOWERCASED = 51;
    const PROPERTY_CHANGES_WHEN_NFKC_CASEFOLDED = 56;
    const PROPERTY_CHANGES_WHEN_TITLECASED = 53;
    const PROPERTY_CHANGES_WHEN_UPPERCASED = 52;
    const PROPERTY_DASH = 4;
    const PROPERTY_DECOMPOSITION_TYPE = 4099;
    const PROPERTY_DEFAULT_IGNORABLE_CODE_POINT = 5;
    const PROPERTY_DEPRECATED = 6;
    const PROPERTY_DIACRITIC = 7;
    const PROPERTY_DOUBLE_LIMIT = 12289;
    const PROPERTY_DOUBLE_START = 12288;
    const PROPERTY_EAST_ASIAN_WIDTH = 4100;
    const PROPERTY_EXTENDER = 8;
    const PROPERTY_FULL_COMPOSITION_EXCLUSION = 9;
    const PROPERTY_GENERAL_CATEGORY = 4101;
    const PROPERTY_GENERAL_CATEGORY_MASK = 8192;
    const PROPERTY_GRAPHEME_BASE = 10;
    const PROPERTY_GRAPHEME_CLUSTER_BREAK = 4114;
    const PROPERTY_GRAPHEME_EXTEND = 11;
    const PROPERTY_GRAPHEME_LINK = 12;
    const PROPERTY_HANGUL_SYLLABLE_TYPE = 4107;
    const PROPERTY_HEX_DIGIT = 13;
    const PROPERTY_HYPHEN = 14;
    const PROPERTY_IDEOGRAPHIC = 17;
    const PROPERTY_IDS_BINARY_OPERATOR = 18;
    const PROPERTY_IDS_TRINARY_OPERATOR = 19;
    const PROPERTY_ID_CONTINUE = 15;
    const PROPERTY_ID_START = 16;
    const PROPERTY_INT_LIMIT = 4118;
    const PROPERTY_INT_START = 4096;
    const PROPERTY_INVALID_CODE = -1;
    const PROPERTY_ISO_COMMENT = 16387;
    const PROPERTY_JOINING_GROUP = 4102;
    const PROPERTY_JOINING_TYPE = 4103;
    const PROPERTY_JOIN_CONTROL = 20;
    const PROPERTY_LEAD_CANONICAL_COMBINING_CLASS = 4112;
    const PROPERTY_LINE_BREAK = 4104;
    const PROPERTY_LOGICAL_ORDER_EXCEPTION = 21;
    const PROPERTY_LOWERCASE = 22;
    const PROPERTY_LOWERCASE_MAPPING = 16388;
    const PROPERTY_MASK_LIMIT = 8193;
    const PROPERTY_MASK_START = 8192;
    const PROPERTY_MATH = 23;
    const PROPERTY_NAME = 16389;
    const PROPERTY_NAME_CHOICE_COUNT = 2;
    const PROPERTY_NFC_INERT = 39;
    const PROPERTY_NFC_QUICK_CHECK = 4110;
    const PROPERTY_NFD_INERT = 37;
    const PROPERTY_NFD_QUICK_CHECK = 4108;
    const PROPERTY_NFKC_INERT = 40;
    const PROPERTY_NFKC_QUICK_CHECK = 4111;
    const PROPERTY_NFKD_INERT = 38;
    const PROPERTY_NFKD_QUICK_CHECK = 4109;
    const PROPERTY_NONCHARACTER_CODE_POINT = 24;
    const PROPERTY_NUMERIC_TYPE = 4105;
    const PROPERTY_NUMERIC_VALUE = 12288;
    const PROPERTY_OTHER_PROPERTY_LIMIT = 28673;
    const PROPERTY_OTHER_PROPERTY_START = 28672;
    const PROPERTY_PATTERN_SYNTAX = 42;
    const PROPERTY_PATTERN_WHITE_SPACE = 43;
    const PROPERTY_POSIX_ALNUM = 44;
    const PROPERTY_POSIX_BLANK = 45;
    const PROPERTY_POSIX_GRAPH = 46;
    const PROPERTY_POSIX_PRINT = 47;
    const PROPERTY_POSIX_XDIGIT = 48;
    const PROPERTY_QUOTATION_MARK = 25;
    const PROPERTY_RADICAL = 26;
    const PROPERTY_SCRIPT = 4106;
    const PROPERTY_SCRIPT_EXTENSIONS = 28672;
    const PROPERTY_SEGMENT_STARTER = 41;
    const PROPERTY_SENTENCE_BREAK = 4115;
    const PROPERTY_SIMPLE_CASE_FOLDING = 16390;
    const PROPERTY_SIMPLE_LOWERCASE_MAPPING = 16391;
    const PROPERTY_SIMPLE_TITLECASE_MAPPING = 16392;
    const PROPERTY_SIMPLE_UPPERCASE_MAPPING = 16393;
    const PROPERTY_SOFT_DOTTED = 27;
    const PROPERTY_STRING_LIMIT = 16398;
    const PROPERTY_STRING_START = 16384;
    const PROPERTY_S_TERM = 35;
    const PROPERTY_TERMINAL_PUNCTUATION = 28;
    const PROPERTY_TITLECASE_MAPPING = 16394;
    const PROPERTY_TRAIL_CANONICAL_COMBINING_CLASS = 4113;
    const PROPERTY_UNICODE_1_NAME = 16395;
    const PROPERTY_UNIFIED_IDEOGRAPH = 29;
    const PROPERTY_UPPERCASE = 30;
    const PROPERTY_UPPERCASE_MAPPING = 16396;
    const PROPERTY_VARIATION_SELECTOR = 36;
    const PROPERTY_WHITE_SPACE = 31;
    const PROPERTY_WORD_BREAK = 4116;
    const PROPERTY_XID_CONTINUE = 32;
    const PROPERTY_XID_START = 33;
    const SB_ATERM = 1;
    const SB_CLOSE = 2;
    const SB_COUNT = 15;
    const SB_CR = 11;
    const SB_EXTEND = 12;
    const SB_FORMAT = 3;
    const SB_LF = 13;
    const SB_LOWER = 4;
    const SB_NUMERIC = 5;
    const SB_OLETTER = 6;
    const SB_OTHER = 0;
    const SB_SCONTINUE = 14;
    const SB_SEP = 7;
    const SB_SP = 8;
    const SB_STERM = 9;
    const SB_UPPER = 10;
    const SHORT_PROPERTY_NAME = 0;
    const UNICODE_10_CHAR_NAME = 1;
    const UNICODE_CHAR_NAME = 0;
    const UNICODE_VERSION = 6.3;
    const WB_ALETTER = 1;
    const WB_COUNT = 17;
    const WB_CR = 8;
    const WB_DOUBLE_QUOTE = 16;
    const WB_EXTEND = 9;
    const WB_EXTENDNUMLET = 7;
    const WB_FORMAT = 2;
    const WB_HEBREW_LETTER = 14;
    const WB_KATAKANA = 3;
    const WB_LF = 10;
    const WB_MIDLETTER = 4;
    const WB_MIDNUM = 5;
    const WB_MIDNUMLET = 11;
    const WB_NEWLINE = 12;
    const WB_NUMERIC = 6;
    const WB_OTHER = 0;
    const WB_REGIONAL_INDICATOR = 13;
    const WB_SINGLE_QUOTE = 15;

    /**
     * @link  http://php.net/manual/ru/intlchar.charage.php
     * Get the "age" of the code point
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return array The Unicode version number, as an array. For example, version 1.3.31.2 would be represented as [1,
     *               3, 31, 2].
     * @since 7.0
     */
    public static function charAge($codepoint) { }

    /**
     * @link  http://php.net/manual/ru/intlchar.chardigitvalue.php
     * Get the decimal digit value of a decimal digit character
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return int The decimal digit value of codepoint, or -1 if it is not a decimal digit character.
     * @since 7.0
     */
    public static function charDigitValue($codepoint) { }

    /**
     * Get bidirectional category value for a code point
     *
     * @link  http://php.net/manual/ru/intlchar.chardirection.php
     *
     * @param mixed $codepoint <p>The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character
     *                         encoded as a UTF-8 string (e.g. "\u{2603}")</p>
     *
     * @return int <p>The bidirectional category value; one of the following constants:
     * </p>
     * <ul>
     * <li><b> IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_EUROPEAN_NUMBER </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_EUROPEAN_NUMBER_SEPARATOR </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_EUROPEAN_NUMBER_TERMINATOR </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_ARABIC_NUMBER </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_COMMON_NUMBER_SEPARATOR </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_BLOCK_SEPARATOR </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_SEGMENT_SEPARATOR </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_WHITE_SPACE_NEUTRAL </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_OTHER_NEUTRAL </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT_EMBEDDING </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT_OVERRIDE </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_ARABIC </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_EMBEDDING </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_OVERRIDE </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_POP_DIRECTIONAL_FORMAT </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_DIR_NON_SPACING_MARK </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_BOUNDARY_NEUTRAL </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_FIRST_STRONG_ISOLATE </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_LEFT_TO_RIGHT_ISOLATE </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_RIGHT_TO_LEFT_ISOLATE </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_POP_DIRECTIONAL_ISOLATE </b></li>
     * <li><b> IntlChar::CHAR_DIRECTION_CHAR_DIRECTION_COUNT </b></p>
     * @since 7.0
     */
    public static function charDirection($codepoint) { }

    /**
     * @link  http://php.net/manual/en/intlchar.charfromname.php
     * Find Unicode character by name and return its code point value
     *
     * @param string $characterName <p>Full name of the Unicode character.</p>
     * @param int    $nameChoice    [optional] <p>
     *                              Which set of names to use for the lookup. Can be any of these constants:
     *                              </p><ul>
     *                              <li><b> IntlChar::UNICODE_CHAR_NAME </b> (default)</li>
     *                              <li><b> IntlChar::UNICODE_10_CHAR_NAME </b></li>
     *                              <li><b> IntlChar::EXTENDED_CHAR_NAME </b></li>
     *                              <li><b> IntlChar::CHAR_NAME_ALIAS </b></li>
     *                              <li><b> IntlChar::CHAR_NAME_CHOICE_COUNT </b></li>
     *                              </ul>
     *
     * @return int The Unicode value of the code point with the given name (as an integer), or FALSE if there is no
     *             such code point.
     * @since 7.0
     */
    public static function charFromName($characterName, $nameChoice = IntlChar::UNICODE_CHAR_NAME) { }

    /**
     * @link http://php.net/manual/ru/intlchar.charmirror.php
     * Get the "mirror-image" character for a code point
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return mixed Returns another Unicode code point that may serve as a mirror-image substitute, or codepoint
     *               itself if there is no such mapping or codepoint does not have the Bidi_Mirrored property. The
     *               return type will be integer unless the code point was passed as a UTF-8 string, in which case a
     *               string will be returned.
     */
    public static function charMirror($codepoint) { }

    /**
     * Retrieve the name of a Unicode character
     *
     * @link  http://php.net/manual/ru/intlchar.charname.php
     *
     * @param mixed $codepoint  The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                          as a UTF-8 string (e.g. "\u{2603}")
     * @param int   $nameChoice [optional] Which set of names to use for the lookup. Can be any of these constants:
     *                          </p>
     *                          <ul>
     *                          <li><b> IntlChar::UNICODE_CHAR_NAME </b> (default)</li>
     *                          <li><b> IntlChar::UNICODE_10_CHAR_NAME </b></li>
     *                          <li><b> IntlChar::EXTENDED_CHAR_NAME </b></li>
     *                          <li><b> IntlChar::CHAR_NAME_ALIAS </b></li>
     *                          <li><b> IntlChar::CHAR_NAME_CHOICE_COUNT </b></li>
     *                          </ul>
     *
     * @return string The corresponding name, or an empty string if there is no name for this character.
     * @since 7.0
     */
    public static function charName($codepoint, $nameChoice = IntlChar::UNICODE_CHAR_NAME) { }

    /**
     * Get the general category value for a code point
     *
     * @link  http://php.net/manual/ru/intlchar.chartype.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return int Returns the general category type, which may be one of the following constants:
     * </p><ul>
     * <li><b> IntlChar::CHAR_CATEGORY_UNASSIGNED </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_GENERAL_OTHER_TYPES </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_UPPERCASE_LETTER </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_LOWERCASE_LETTER </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_TITLECASE_LETTER </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_MODIFIER_LETTER </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_OTHER_LETTER </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_NON_SPACING_MARK </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_ENCLOSING_MARK </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_COMBINING_SPACING_MARK </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_DECIMAL_DIGIT_NUMBER </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_LETTER_NUMBER </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_OTHER_NUMBER </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_SPACE_SEPARATOR </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_LINE_SEPARATOR </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_PARAGRAPH_SEPARATOR </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_CONTROL_CHAR </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_FORMAT_CHAR </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_PRIVATE_USE_CHAR </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_SURROGATE </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_DASH_PUNCTUATION </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_START_PUNCTUATION </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_END_PUNCTUATION </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_CONNECTOR_PUNCTUATION </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_OTHER_PUNCTUATION </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_MATH_SYMBOL </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_CURRENCY_SYMBOL </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_MODIFIER_SYMBOL </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_OTHER_SYMBOL </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_INITIAL_PUNCTUATION </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_FINAL_PUNCTUATION </b></li>
     * <li><b> IntlChar::CHAR_CATEGORY_CHAR_CATEGORY_COUNT </b></li></ul>
     * @since 7.0
     */
    public static function charType($codepoint) { }

    /**
     * Return Unicode character by code point value
     *
     * @link  http://php.net/manual/ru/intlchar.chr.php
     *
     * @param mixed $codepoint <p>The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character
     *                         encoded as a UTF-8 string (e.g. "\u{2603}")</p>
     *
     * @return string A string containing the single character specified by the Unicode code point value.
     * @since 7.0
     */
    public static function chr($codepoint) { }

    /**
     * Get the decimal digit value of a code point for a given radix
     *
     * @link  http://php.net/manual/ru/intlchar.digit.php
     *
     * @param string $codepoint <p>The integer codepoint value (e.g. <em>0x2603</em> for <em>U+2603 SNOWMAN</em>), or
     *                          the character encoded as a UTF-8 string (e.g. <em>"\u{2603}"</em>)</p>
     * @param int    $radix     <p>The radix (defaults to 10).</p>
     *
     * @return int Returns the numeric value represented by the character in the specified radix, or <b>FALSE</b> if
     *             there is no value or if the value exceeds the radix.
     * @since 7.0
     */
    public static function digit($codepoint, $radix = 10) { }

    /**
     * Enumerate all assigned Unicode characters within a range
     *
     * @link  http://php.net/manual/ru/intlchar.enumcharnames.php
     *
     * @param mixed    $start      The first code point in the enumeration range.
     * @param mixed    $limit      One more than the last code point in the enumeration range (the first one after the
     *                             range).
     * @param callable $callback   <p>
     *                             The function that is to be called for each character name.  The following three
     *                             arguments will be passed into it:
     *                             </p><ul>
     *                             <li>integer</a> <em>$codepoint</em> - The numeric code point value</li>
     *                             <li>integer <em>$nameChoice</em> - The same value as the <b>nameChoice</b> parameter
     *                             below</li>
     *                             <li>string <em>$name</em> - The name of the character</li>
     *                             </ul>
     * @param int      $nameChoice [optional]  <p>
     *                             Selector for which kind of names to enumerate.  Can be any of these constants:
     *                             </p><ul>
     *                             <li><b>IntlChar::UNICODE_CHAR_NAME</b> (default)</li>
     *                             <li><b>IntlChar::UNICODE_10_CHAR_NAME</b></li>
     *                             <li><b>IntlChar::EXTENDED_CHAR_NAME</b></li>
     *                             <li><b>IntlChar::CHAR_NAME_ALIAS</b></li>
     *                             <li><b>IntlChar::CHAR_NAME_CHOICE_COUNT</b></li>
     *                             </ul>
     *
     * @since 7.0
     */
    public static function enumCharNames($start, $limit, $callback, $nameChoice = IntlChar::UNICODE_CHAR_NAME) { }

    /**
     * Enumerate all code points with their Unicode general categories
     *
     * @link  http://php.net/manual/ru/intlchar.enumchartypes.php
     *
     * @param callable $callable <p>
     *                           The function that is to be called for each contiguous range of code points with the
     *                           same general category. The following three arguments will be passed into it:
     *                           </p><ul>
     *                           <li>integer <em>$start</em> - The starting code point of the range</li>
     *                           <li>integer <em>$end</em> - The ending code point of the range</li>
     *                           <li>integer <em>$name</em> - The category type (one of the
     *                           <em>IntlChar::CHAR_CATEGORY_*</em> constants)</li>
     *                           </ul>
     *
     * @since 7.0
     */
    public static function enumCharTypes($callable) { }

    /**
     * Perform case folding on a code point
     *
     * @link  http://php.net/manual/en/intlchar.foldcase.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     * @param int   $options   [optional] Either IntlChar::FOLD_CASE_DEFAULT (default) or
     *                         IntlChar::FOLD_CASE_EXCLUDE_SPECIAL_I.
     *
     * @return mixed Returns the Simple_Case_Folding of the code point, if any; otherwise the code point itself.
     * @since 7.0
     */
    public static function foldCase($codepoint, $options = IntlChar::FOLD_CASE_DEFAULT) { }

    /**
     * Get character representation for a given digit and radix
     *
     * @link  http://php.net/manual/ru/intlchar.fordigit.php
     *
     * @param int $digit <p>The number to convert to a character.</p>
     * @param int $radix [optional] <p>The radix (defaults to 10).</p>
     *
     * @return int The character representation (as a string) of the specified digit in the specified radix.
     * @since 7.0
     */
    public static function forDigit($digit, $radix = 10) { }

    /**
     * Get the paired bracket character for a code point
     *
     * @link  http://php.net/manual/ru/intlchar.getbidipairedbracket.php
     *
     * @param mixed $codepoint <p>The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character
     *                         encoded as a UTF-8 string (e.g. "\u{2603}")</p>
     *
     * @return mixed  Returns the paired bracket code point, or <em>codepoint</em> itself if there is no such mapping.
     * The return type will be integer unless the code point was passed as a UTF-8 string, in which case a string will
     * be returned.
     * @since 7.0
     */
    public static function getBidiPairedBracket($codepoint) { }

    /**
     * Get the Unicode allocation block containing a code point
     *
     * @link  http://php.net/manual/ru/intlchar.getblockcode.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return int Returns the block value for <em>codepoint</em>.
     * See the <em>IntlChar::BLOCK_CODE_*</em> constants for possible return values.
     * @since 7.0
     */
    public static function getBlockCode($codepoint) { }

    /**
     * Get the combining class of a code point
     *
     * @link  http://php.net/manual/ru/intlchar.getcombiningclass.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return int Returns the combining class of the character.
     * @since 7.0
     */
    public static function getCombiningClass($codepoint) { }

    /**
     * Get the FC_NFKC_Closure property for a code point
     *
     * @link  http://php.net/manual/ru/intlchar.getfc-nfkc-closure.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return string Returns the FC_NFKC_Closure property string for the codepoint, or an empty string if there is
     *                none.
     * @since 7.0
     */
    public static function getFC_NFKC_Closure($codepoint) { }

    /**
     * Get the max value for a Unicode property
     *
     * @link  http://php.net/manual/ru/intlchar.getintpropertymaxvalue.php
     *
     * @param int $property The Unicode property to lookup (see the IntlChar::PROPERTY_* constants).
     *
     * @return int The maximum value returned by {@see IntlChar::getIntPropertyValue()} for a Unicode property. <=0 if
     *             the property selector is out of range.
     * @since 7.0
     */
    public static function getIntPropertyMaxValue($property) { }

    /**
     * Get the min value for a Unicode property
     *
     * @link  http://php.net/manual/ru/intlchar.getintpropertyminvalue.php
     *
     * @param int $property The Unicode property to lookup (see the IntlChar::PROPERTY_* constants).
     *
     * @return int The maximum value returned by {@see IntlChar::getIntPropertyValue()} for a Unicode property. 0 if
     *             the property selector is out of range.
     * @since 7.0
     */
    public static function getIntPropertyMinValue($property) { }

    /**
     * Get the value for a Unicode property for a code point
     *
     * @link  http://php.net/manual/ru/intlchar.getintpropertyvalue.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     * @param int   $property  The Unicode property to lookup (see the IntlChar::PROPERTY_* constants).
     *
     * @return int <p>
     * Returns the numeric value that is directly the property value or, for enumerated properties, corresponds to the
     * numeric value of the enumerated constant of the respective property value enumeration type.
     * </p>
     * <p>
     * Returns <em>0</em> or <em>1</em> (for <b>FALSE</b><b>/</b><b>TRUE</B>) for binary Unicode properties.
     * </p>
     * <p>
     * Returns a bit-mask for mask properties.
     * </p>
     * <p>
     * Returns <em>0</em> if <em>property</em> is out of bounds or if the Unicode version does not
     * have data for the property at all, or not for this code point.
     * </p>
     * @since 7.0
     */
    public static function getIntPropertyValue($codepoint, $property) { }

    /**
     * Get the numeric value for a Unicode code point
     *
     * @link  http://php.net/manual/ru/intlchar.getnumericvalue.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return float Numeric value of codepoint, or float(-123456789) if none is defined.
     * @since 7.0
     */
    public static function getNumericValue($codepoint) { }

    /**
     * Get the property constant value for a given property name
     *
     * @link  http://php.net/manual/ru/intlchar.getpropertyenum.php
     *
     * @param string $alias The property name to be matched. The name is compared using "loose matching" as described
     *                      in PropertyAliases.txt.
     *
     * @return int Returns an IntlChar::PROPERTY_ constant value, or <b>IntlChar::PROPERTY_INVALID_CODE</b> if the
     *             given name does not match any property.
     * @since 7.0
     */
    public static function getPropertyEnum($alias) { }

    /**
     * Get the Unicode name for a property
     *
     * @link  http://php.net/manual/ru/intlchar.getpropertyname.php
     *
     * @param int $property   <p>The Unicode property to lookup (see the IntlChar::PROPERTY_* constants).</p>
     *                        <p><b>IntlChar::PROPERTY_INVALID_CODE</b> should not be used. Also, if property is out of
     *                        range, FALSE is returned.</p>
     * @param int $nameChoice <p> Selector for which name to get. If out of range, FALSE is returned.</p>
     *                        <p>All properties have a long name. Most have a short name, but some do not. Unicode
     *                        allows for additional names; if present these will be returned by adding 1, 2, etc. to
     *                        <b>IntlChar::LONG_PROPERTY_NAME</b>.</p>
     *
     * @return string <p>
     * Returns the name, or <b>FALSE</b> if either the <em>property</em> or the <em>nameChoice</em>
     * is out of range.
     * </p>
     * <p>
     * If a given <em>nameChoice</em> returns <b>FALSE</b>, then all larger values of
     * <em>nameChoice</em> will return <b>FALSE</b>, with one exception: if <b>FALSE</b> is returned for
     * <b>IntlChar::SHORT_PROPERTY_NAME</b>, then <b>IntlChar::LONG_PROPERTY_NAME</b>
     * (and higher) may still return a non-<b>FALSE</b> value.
     * </p>
     * @since 7.0
     */
    public static function getPropertyName($property, $nameChoice = IntlChar::LONG_PROPERTY_NAME) { }

    /**
     * Get the property value for a given value name
     *
     * @link  http://php.net/manual/ru/intlchar.getpropertyvalueenum.php
     *
     * @param int    $property <p>The Unicode property to lookup (see the IntlChar::PROPERTY_* constants).
     *                         If out of range, or this method doesn't work with the given value,
     *                         IntlChar::PROPERTY_INVALID_CODE is returned</p>
     * @param string $name     <p> The value name to be matched. The name is compared using "loose matching" as
     *                         described in PropertyValueAliases.txt.</p>
     *
     * @return int Returns the corresponding value integer, or IntlChar::PROPERTY_INVALID_CODE if the given name does
     *             not match any value of the given property, or if the property is invalid.
     * @since 7.0
     */
    public static function getPropertyValueEnum($property, $name) { }

    /**
     * Get the Unicode name for a property value
     *
     * @link  http://php.net/manual/ru/intlchar.getpropertyvaluename.php
     *
     * @param int $property   <p>
     *                        The Unicode property to lookup (see the IntlChar::PROPERTY_* constants).
     *                        If out of range, or this method doesn't work with the given value, FALSE is returned.
     *                        </p>
     * @param int $value      <p>
     *                        Selector for a value for the given property. If out of range, <b>FALSE</b> is returned.
     *                        </p>
     *                        <p>
     *                        In general, valid values range from <em>0</em> up to some maximum. There are a couple
     *                        exceptions:
     *                        </p><ul>
     *                        <li>
     *                        <b>IntlChar::PROPERTY_BLOCK</b> values begin at the non-zero value
     *                        <b>IntlChar::BLOCK_CODE_BASIC_LATIN</b>
     *                        </li>
     *                        <li>
     *                        <b>IntlChar::PROPERTY_CANONICAL_COMBINING_CLASS</b> values are not contiguous and range
     *                        from 0..240.
     *                        </li>
     *                        </ul>
     * @param int $nameChoice [optional] <p>
     *                        Selector for which name to get. If out of range, FALSE is returned.
     *                        All values have a long name. Most have a short name, but some do not. Unicode allows for
     *                        additional names; if present these will be returned by adding 1, 2, etc. to
     *                        IntlChar::LONG_PROPERTY_NAME.
     *                        </p>
     *
     * @return  string Returns the name, or FALSE if either the property or the nameChoice is out of range.
     * If a given nameChoice returns FALSE, then all larger values of nameChoice will return FALSE, with one exception:
     * if FALSE is returned for IntlChar::SHORT_PROPERTY_NAME, then IntlChar::LONG_PROPERTY_NAME (and higher) may still
     * return a non-FALSE value.
     * @since 7.0
     */
    public static function getPropertyValueName($property, $value, $nameChoice = IntlChar::LONG_PROPERTY_NAME) { }

    /**
     * Get the Unicode version
     *
     * @link  http://php.net/manual/ru/intlchar.getunicodeversion.php
     * @return array An array containing the Unicode version number.
     * @since 7.0
     */
    public static function getUnicodeVersion() { }

    /**
     * Check a binary Unicode property for a code point
     *
     * @link  http://php.net/manual/ru/intlchar.hasbinaryproperty.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     * @param int   $property  The Unicode property to lookup (see the IntlChar::PROPERTY_* constants).
     *
     * @return bool Returns TRUE or FALSE according to the binary Unicode property value for codepoint.
     * Also FALSE if property is out of bounds or if the Unicode version does not have data for the property at all, or
     * not for this code point.
     * @since 7.0
     */
    static public function hasBinaryProperty($codepoint, $property) { }

    /**
     * Check if code point is an ignorable character
     *
     * @link  http://php.net/manual/ru/intlchar.isidignorable.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is ignorable in identifiers, FALSE if not.
     * @since 7.0
     */
    public static function isIDIgnorable($codepoint) { }

    /**
     * Check if code point is permissible in an identifier
     *
     * @link  http://php.net/manual/ru/intlchar.isidpart.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is the code point may occur in an identifier, FALSE if not.
     * @since 7.0
     */
    public static function isIDPart($codepoint) { }

    /**
     * Check if code point is permissible as the first character in an identifier
     *
     * @link  http://php.net/manual/ru/intlchar.isidstart.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint may start an identifier, FALSE if not.
     * @since 7.0
     */
    public static function isIDStart($codepoint) { }

    /**
     * Check if code point is an ISO control code
     *
     * @link  http://php.net/manual/ru/intlchar.isisocontrol.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is an ISO control code, FALSE if not.
     * @since 7.0
     */
    public static function isISOControl($codepoint) { }

    /**
     * Check if code point is permissible in a Java identifier
     *
     * @link  http://php.net/manual/ru/intlchar.isjavaidpart.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint may occur in a Java identifier, FALSE if not.
     * @since 7.0
     */
    public static function isJavaIDPart($codepoint) { }

    /**
     * Check if code point is permissible as the first character in a Java identifier
     *
     * @link  http://php.net/manual/ru/intlchar.isjavaidstart.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint may start a Java identifier, FALSE if not.
     * @since 7.0
     */
    public static function isJavaIDStart($codepoint) { }

    /**
     * Check if code point is a space character according to Java
     *
     * @link  http://php.net/manual/ru/intlchar.isjavaspacechar.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is a space character according to Java, FALSE if not.
     * @since 7.0
     */
    public static function isJavaSpaceChar($codepoint) { }

    /**
     * Check if code point has the Bidi_Mirrored property
     *
     * @link  http://php.net/manual/ru/intlchar.ismirrored.php
     *
     * @param mixed $codepoint <p>The integer codepoint value (e.g. <em>0x2603</em> for <em>U+2603 SNOWMAN</em>), or
     *                         the character encoded as a UTF-8 string (e.g. <em>"\u{2603}"</em>)</p>
     *
     * @return bool Returns TRUE if codepoint has the Bidi_Mirrored property, FALSE if not.
     * @since 7.0
     */
    public static function isMirrored($codepoint) { }

    /**
     * Check if code point has the Alphabetic Unicode property
     *
     * @link  http://php.net/manual/ru/intlchar.isualphabetic.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint has the Alphabetic Unicode property, FALSE if not.
     * @since 7.0
     */
    public static function isUAlphabetic($codepoint) { }

    /**
     * Check if code point has the Lowercase Unicode property
     *
     * @link  http://php.net/manual/ru/intlchar.isulowercase.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint has the Lowercase Unicode property, FALSE if not.
     * @since 7.0
     */
    public static function isULowercase($codepoint) { }

    /**
     * Check if code point has the Uppercase Unicode property
     *
     * @link  http://php.net/manual/ru/intlchar.isuuppercase.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint has the Uppercase Unicode property, FALSE if not.
     * @since 7.0
     */
    public static function isUUppercase($codepoint) { }

    /**
     * Check if code point has the White_Space Unicode property
     *
     * @link  http://php.net/manual/ru/intlchar.isuwhitespace.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint has the White_Space Unicode property, FALSE if not.
     * @since 7.0
     */
    public static function isUWhiteSpace($codepoint) { }

    /**
     * Check if code point is a whitespace character according to ICU
     *
     * @link  http://php.net/manual/ru/intlchar.iswhitespace.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool
     * @since 7.0
     */
    public static function isWhitespace($codepoint) { }

    /**
     * Check if code point is an alphanumeric character
     *
     * @link  http://php.net/manual/ru/intlchar.isalnum.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is an alphanumeric character, FALSE if not.
     * @since 7.0
     */
    public static function isalnum($codepoint) { }

    /**
     * Check if code point is a letter character
     *
     * @link  http://php.net/manual/ru/intlchar.isalpha.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is a letter character, FALSE if not.
     * @since 7.0
     */
    public static function isalpha($codepoint) { }

    /**
     * Check if code point is a base character
     *
     * @link  http://php.net/manual/ru/intlchar.isbase.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is a base character, FALSE if not.
     * @since 7.0
     */
    public static function isbase($codepoint) { }

    /**
     * Check if code point is a "blank" or "horizontal space" character
     *
     * @link  http://php.net/manual/ru/intlchar.isblank.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is either a "blank" or "horizontal space" character, FALSE if not.
     * @since 7.0
     */
    public static function isblank($codepoint) { }

    /**
     * Check if code point is a control character
     *
     * @link  http://php.net/manual/ru/intlchar.iscntrl.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is a control character, FALSE if not.
     * @since 7.0
     */
    public static function iscntrl($codepoint) { }

    /**
     * Check whether the code point is defined
     *
     * @link  http://php.net/manual/ru/intlchar.isdefined.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is a defined character, FALSE if not.
     * @since 7.0
     */
    public static function isdefined($codepoint) { }

    /**
     * Check if code point is a digit character
     *
     * @link  http://php.net/manual/ru/intlchar.isdigit.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is a digit character, FALSE if not.
     * @since 7.0
     */
    public static function isdigit($codepoint) { }

    /**
     * Check if code point is a graphic character
     *
     * @link  http://php.net/manual/ru/intlchar.isgraph.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is a "graphic" character, FALSE if not.
     * @since 7.0
     */
    public static function isgraph($codepoint) { }

    /**
     * Check if code point is a lowercase letter
     *
     * @link  http://php.net/manual/ru/intlchar.islower.php
     *
     * @param mixed $codepoint <p>The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN),
     *                         or the character encoded as a UTF-8 string (e.g. "\u{2603}")</p>
     *
     * @return bool Returns TRUE if codepoint is an Ll lowercase letter, FALSE if not.
     * @since 7.0
     */
    public static function islower($codepoint) { }

    /**
     * Check if code point is a printable character
     *
     * @link  http://php.net/manual/ru/intlchar.isprint.php
     *
     * @param mixed $codepoint <p>The integer codepoint value (e.g. <em>0x2603</em> for <em>U+2603 SNOWMAN</em>), or
     *                         the character encoded as a UTF-8 string (e.g. <em>"\u{2603}"</em>)</p>
     *
     * @return bool Returns TRUE if codepoint is a printable character, FALSE if not.
     * @since 7.0
     */
    public static function isprint($codepoint) { }

    /**
     * Check if code point is punctuation character
     *
     * @link  http://php.net/manual/ru/intlchar.ispunct.php
     *
     * @param mixed $codepoint <p>The integer codepoint value (e.g. <em>0x2603</em> for <em>U+2603 SNOWMAN</em>),
     *                         or the character encoded as a UTF-8 string (e.g. <em>"\u{2603}"</em>)</p>
     *
     * @return bool Returns TRUE if codepoint is a punctuation character, FALSE if not.
     * @since 7.0
     */
    public static function ispunct($codepoint) { }

    /**
     * Check if code point is a space character
     *
     * @link  http://php.net/manual/ru/intlchar.isspace.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is a space character, FALSE if not.
     * @since 7.0
     */
    public static function isspace($codepoint) { }

    /**
     * Check if code point is a titlecase letter
     *
     * @link  http://php.net/manual/ru/intlchar.istitle.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return boolean Returns TRUE if codepoint is a titlecase letter, FALSE if not.
     * @since 7.0
     */
    public static function istitle($codepoint) { }

    /**
     * Check if code point has the general category "Lu" (uppercase letter)
     *
     * @link  http://php.net/manual/ru/intlchar.isupper.php
     *
     * @param mixed $codepoint <p>The integer codepoint value (e.g. <em>0x2603</em> for <em>U+2603 SNOWMAN</em>),
     *                         or the character encoded as a UTF-8 string (e.g. <em>"\u{2603}"</em>)</p>
     *
     * @return bool Returns TRUE if codepoint is an Lu uppercase letter, FALSE if not.
     * @since 7.0
     */
    public static function isupper($codepoint) { }

    /**
     * Check if code point is a hexadecimal digit
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return bool Returns TRUE if codepoint is a hexadecimal character, FALSE if not.
     * @since 7.0
     */
    public static function isxdigit($codepoint) { }

    /**
     * Return Unicode code point value of character
     *
     * @link  http://php.net/manual/ru/intlchar.ord.php
     *
     * @param mixed $character <p>A Unicode character.</p>
     *
     * @return int Returns the Unicode code point value as an integer.
     * @since 7.0
     */
    public static function ord($character) { }

    /**
     * Make Unicode character lowercase
     *
     * @link  http://php.net/manual/en/intlchar.tolower.php
     *
     * @param mixed $codepoint
     *
     * @return mixed Returns the Simple_Lowercase_Mapping of the code point, if any; otherwise the code point itself.
     * The return type will be integer unless the code point was passed as a UTF-8 string, in which case a string will
     * be returned.
     * @since 7.0
     */
    public static function tolower($codepoint) { }

    /**
     * Make Unicode character titlecase
     *
     * @link  http://php.net/manual/ru/intlchar.totitle.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @return mixed  Returns the Simple_Titlecase_Mapping of the code point, if any; otherwise the code point itself.
     * The return type will be integer unless the code point was passed as a UTF-8 string, in which case a string will
     * be returned.
     * @since 7.0
     */
    public static function totitle($codepoint) { }

    /**
     * Make Unicode character uppercase
     *
     * @link  http://php.net/manual/ru/intlchar.toupper.php
     *
     * @param mixed $codepoint The integer codepoint value (e.g. 0x2603 for U+2603 SNOWMAN), or the character encoded
     *                         as a UTF-8 string (e.g. "\u{2603}")
     *
     * @since 7.0
     */
    public static function toupper($codepoint) { }
}

/**
 * This break iterator identifies the boundaries between UTF-8 code points.
 */
class IntlCodePointBreakIterator extends IntlBreakIterator
{
    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get last code point passed over after advancing or receding the iterator
     *
     * @link http://www.php.net/manual/en/intlcodepointbreakiterator.getlastcodepoint.php
     * @return int
     */
    public function getLastCodePoint() { }
}

/**
 * Date Formatter is a concrete class that enables locale-dependent formatting/parsing of dates using pattern strings and/or canned patterns.
 *
 * This class represents the ICU date formatting functionality. It allows users to display dates in a localized format or to parse strings into PHP date values using pattern strings and/or canned patterns.
 */
class IntlDateFormatter
{
    /**
     * Completely specified style (Tuesday, April 12, 1952 AD or 3:30:42pm PST)
     *
     * @link http://php.net/manual/en/intl.intldateformatter-constants.php
     */
    const FULL = 0;
    /**
     * Gregorian Calendar
     *
     * @link http://php.net/manual/en/intl.intldateformatter-constants.php
     */
    const GREGORIAN = 1;
    /**
     * Long style (January 12, 1952 or 3:30:32pm)
     *
     * @link http://php.net/manual/en/intl.intldateformatter-constants.php
     */
    const LONG = 1;
    /**
     * Medium style (Jan 12, 1952)
     *
     * @link http://php.net/manual/en/intl.intldateformatter-constants.php
     */
    const MEDIUM = 2;
    /**
     * Do not include this element
     *
     * @link http://php.net/manual/en/intl.intldateformatter-constants.php
     */
    const NONE = -1;
    /**
     * Most abbreviated style, only essential data (12/13/52 or 3:30pm)
     *
     * @link http://php.net/manual/en/intl.intldateformatter-constants.php
     */
    const SHORT = 3;
    /**
     * Non-Gregorian Calendar
     *
     * @link http://php.net/manual/en/intl.intldateformatter-constants.php
     */
    const TRADITIONAL = 0;

    /**
     * @param $locale
     * @param $datetype
     * @param $timetype
     * @param $timezone [optional]
     * @param $calendar [optional]
     * @param $pattern  [optional]
     */
    public function __construct($locale, $datetype, $timetype, $timezone, $calendar, $pattern) { }

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
    public static function create(
        $locale,
        $datetype,
        $timetype,
        $timezone = null,
        $calendar = null,
        $pattern = null
    )
    {
    }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Format the date/time value as a string
     *
     * @link http://php.net/manual/en/intldateformatter.format.php
     *
     * @param mixed $value <p>
     *                     Value to format. This may be a <b>DateTime</b> object,
     *                     an integer representing a Unix timestamp value (seconds
     *                     since epoch, UTC) or an array in the format output by
     *                     <b>localtime</b>.
     *                     </p>
     *
     * @return string The formatted string or, if an error occurred, <b>FALSE</b>.
     */
    public function format($value) { }

    /**
     * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
     * Formats an object
     *
     * @link http://www.php.net/manual/en/intldateformatter.formatobject.php
     *
     * @param IntlCalendar|DateTime $object <p>
     *                       An object of type {@link "http://www.php.net/manual/en/class.intlcalendar.php"
     *                       IntlCalendar} or {@link "http://www.php.net/manual/en/class.datetime.php" DateTime}. The
     *                       timezone information in the object will be used.
     *                       </p>
     * @param mixed  $format [optional] <p>
     *                       How to format the date/time. This can either be an {@link
     *                       "http://www.php.net/manual/en/language.types.array.php" array} with two elements (first
     *                       the date style, then the time style, these being one of the constants
     *                       <b>IntlDateFormatter::NONE</b>,
     *                       <b>IntlDateFormatter::SHORT</b>,
     *                       <b>IntlDateFormatter::MEDIUM</b>,
     *                       <b>IntlDateFormatter::LONG</b>,
     *                       <b>IntlDateFormatter::FULL</b>), a long with
     *                       the value of one of these constants (in which case it will be used both
     *                       for the time and the date) or a {@link
     *                       "http://www.php.net/manual/en/language.types.string.php" string} with the format described
     *                       in {@link "http://www.icu-project.org/apiref/icu4c/classSimpleDateFormat.html#details" the
     *                       ICU documentation}. If <br>NULL</br>, the default style will be used.
     *                       </p>
     * @param string $locale [optional] <p>
     *                       The locale to use, or <b>NULL</b> to use the {@link
     *                       "http://www.php.net/manual/en/intl.configuration.php#ini.intl.default-locale"default
     *                       one}.</p>
     *
     * @return string A string with result or <b>FALSE</b> on failure.
     */
    public function formatObject($object, $format = null, $locale = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the calendar used for the IntlDateFormatter
     *
     * @link http://php.net/manual/en/intldateformatter.getcalendar.php
     * @return int The calendar being used by the formatter.
     */
    public function getCalendar() { }

    /**
     * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
     * Get copy of formatter's calendar object
     *
     * @link http://www.php.net/manual/en/intldateformatter.getcalendarobject.php
     * @return IntlCalendar A copy of the internal calendar object used by this formatter.
     */
    public function getCalendarObject() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the datetype used for the IntlDateFormatter
     *
     * @link http://php.net/manual/en/intldateformatter.getdatetype.php
     * @return int The current date type value of the formatter.
     */
    public function getDateType() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the error code from last operation
     *
     * @link http://php.net/manual/en/intldateformatter.geterrorcode.php
     * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
     */
    public function getErrorCode() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the error text from the last operation.
     *
     * @link http://php.net/manual/en/intldateformatter.geterrormessage.php
     * @return string Description of the last error.
     */
    public function getErrorMessage() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the locale used by formatter
     *
     * @link http://php.net/manual/en/intldateformatter.getlocale.php
     *
     * @param int $which [optional]
     *
     * @return string the locale of this formatter or 'false' if error
     */
    public function getLocale($which = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the pattern used for the IntlDateFormatter
     *
     * @link http://php.net/manual/en/intldateformatter.getpattern.php
     * @return string The pattern string being used to format/parse.
     */
    public function getPattern() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the timetype used for the IntlDateFormatter
     *
     * @link http://php.net/manual/en/intldateformatter.gettimetype.php
     * @return int The current date type value of the formatter.
     */
    public function getTimeType() { }

    /**
     * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
     *  Get formatter's timezone
     *
     * @link http://www.php.net/manual/en/intldateformatter.gettimezone.php
     * @return IntlTimeZone|bool The associated IntlTimeZone object or FALSE on failure.
     */
    public function getTimeZone() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the timezone-id used for the IntlDateFormatter
     *
     * @link http://php.net/manual/en/intldateformatter.gettimezoneid.php
     * @return string ID string for the time zone used by this formatter.
     */
    public function getTimeZoneId() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the lenient used for the IntlDateFormatter
     *
     * @link http://php.net/manual/en/intldateformatter.islenient.php
     * @return bool <b>TRUE</b> if parser is lenient, <b>FALSE</b> if parser is strict. By default the parser is
     *              lenient.
     */
    public function isLenient() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Parse string to a field-based time value
     *
     * @link http://php.net/manual/en/intldateformatter.localtime.php
     *
     * @param string $value    <p>
     *                         string to convert to a time
     *                         </p>
     * @param int    $position [optional] <p>
     *                         Position at which to start the parsing in $value (zero-based).
     *                         If no error occurs before $value is consumed, $parse_pos will contain -1
     *                         otherwise it will contain the position at which parsing ended .
     *                         If $parse_pos > strlen($value), the parse fails immediately.
     *                         </p>
     *
     * @return array Localtime compatible array of integers : contains 24 hour clock value in tm_hour field
     */
    public function localtime($value, &$position = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Parse string to a timestamp value
     *
     * @link http://php.net/manual/en/intldateformatter.parse.php
     *
     * @param string $value    <p>
     *                         string to convert to a time
     *                         </p>
     * @param int    $position [optional] <p>
     *                         Position at which to start the parsing in $value (zero-based).
     *                         If no error occurs before $value is consumed, $parse_pos will contain -1
     *                         otherwise it will contain the position at which parsing ended (and the error occurred).
     *                         This variable will contain the end position if the parse fails.
     *                         If $parse_pos > strlen($value), the parse fails immediately.
     *                         </p>
     *
     * @return int timestamp parsed value
     */
    public function parse($value, &$position = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * sets the calendar used to the appropriate calendar, which must be
     *
     * @link http://php.net/manual/en/intldateformatter.setcalendar.php
     *
     * @param int $which <p>
     *                   The calendar to use.
     *                   Default is <b>IntlDateFormatter::GREGORIAN</b>.
     *                   </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setCalendar($which) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Set the leniency of the parser
     *
     * @link http://php.net/manual/en/intldateformatter.setlenient.php
     *
     * @param bool $lenient <p>
     *                      Sets whether the parser is lenient or not, default is <b>TRUE</b> (lenient).
     *                      </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setLenient($lenient) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Set the pattern used for the IntlDateFormatter
     *
     * @link http://php.net/manual/en/intldateformatter.setpattern.php
     *
     * @param string $pattern <p>
     *                        New pattern string to use.
     *                        Possible patterns are documented at http://userguide.icu-project.org/formatparse/datetime.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * Bad formatstrings are usually the cause of the failure.
     */
    public function setPattern($pattern) { }

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
    public function setTimeZone($zone) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Sets the time zone to use
     *
     * @link       http://php.net/manual/en/intldateformatter.settimezoneid.php
     *
     * @param string $zone <p>
     *                     The time zone ID string of the time zone to use.
     *                     If <b>NULL</b> or the empty string, the default time zone for the runtime is used.
     *                     </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @deprecated 5.5 http://www.php.net/manual/en/migration55.deprecated.php
     */
    public function setTimeZoneId($zone) { }
}

/**
 * Class IntlGregorianCalendar
 */
class IntlGregorianCalendar
{
    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     *
     * @param mixed  $timeZone
     * @param string $locale
     *
     * @return IntlGregorianCalendar
     */
    public static function createInstance($timeZone = null, $locale = null) { }

    /**
     * @return double $change
     */
    public function getGregorianChange() { }

    /**
     * @param int $year
     *
     * @return bool
     */
    public function isLeapYear($year) { }

    /**
     * @param double $change
     *
     */
    public function setGregorianChange($change) { }
}

/**
 * This class represents iterator objects throughout the intl extension whenever the iterator cannot be identified with any other object provided by the extension. The distinct iterator object used internally by the foreach construct can only be obtained (in the relevant part here) from objects, so objects of this class serve the purpose of providing the hook through which this internal object can be obtained. As a convenience, this class also implements the Iterator interface, allowing the collection of values to be navigated using the methods defined in that interface. Both these methods and the internal iterator objects provided to foreach are backed by the same state (e.g. the position of the iterator and its current value).
 *
 * Subclasses may provide richer functionality.
 */
class IntlIterator implements Iterator
{
    public function current() { }

    public function key() { }

    public function next() { }

    public function rewind() { }

    public function valid() { }
}

/**
 * A subclass of IntlBreakIterator that encapsulates ICU break iterators whose behavior is specified using a set of rules. This is the most common kind of break iterators.
 *
 * These rules are described in the » ICU Boundary Analysis User Guide.
 */
class IntlRuleBasedBreakIterator extends IntlBreakIterator
{
    /* Methods */
    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.construct.php
     *
     * @param string $rules
     * @param string $areCompiled [optional]
     */
    public function __construct($rules, $areCompiled) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for boundaries of combining character sequences
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createcharacterinstance.php
     *
     * @param string $locale
     *
     * @return IntlRuleBasedBreakIterator
     */
    public static function createCharacterInstance($locale) { }

    /*
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for boundaries of code points
     * @link http://www.php.net/manual/en/intlbreakiterator.createcodepointinstance.php
     * @return IntlRuleBasedBreakIterator
     */
    public static function createCodePointInstance() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for logically possible line breaks
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createlineinstance.php
     *
     * @param string $locale
     *
     * @return IntlRuleBasedBreakIterator
     */
    public static function createLineInstance($locale) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for sentence breaks
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createsentenceinstance.php
     *
     * @param string $locale
     *
     * @return IntlRuleBasedBreakIterator
     */
    public static function createSentenceInstance($locale) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for title-casing breaks
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createtitleinstance.php
     *
     * @param string $locale
     *
     * @return IntlRuleBasedBreakIterator
     */
    public static function createTitleInstance($locale) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create break iterator for word breaks
     *
     * @link http://www.php.net/manual/en/intlbreakiterator.createwordinstance.php
     *
     * @param string $locale
     *
     * @return IntlRuleBasedBreakIterator
     */
    public static function createWordInstance($locale) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     *
     * @link http://www.php.net/manual/en/intlrulebasedbreakiterator.getbinaryrules.php
     * Get the binary form of compiled rules
     * @return string
     */
    public function getBinaryRules() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     *
     * @link http://www.php.net/manual/en/intlrulebasedbreakiterator.getrulesstatus.php
     * Get the largest status value from the break rules that determined the current break position
     * @return int
     */
    public function getRuleStatus() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     *
     * @link http://www.php.net/manual/en/intlrulebasedbreakiterator.getrulestatusvec.php
     * Get the status values from the break rules that determined the current break position
     * @return array
     */
    public function getRuleStatusVec() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     *
     * @link http://www.php.net/manual/en/intlrulebasedbreakiterator.getrules.php
     * Get the rule set used to create this object
     * @return string
     */
    public function getRules() { }
}

/**
 * Class IntlTimeZone
 */
class IntlTimeZone
{
    /* Constants */
    const  DISPLAY_LONG = 2;
    const  DISPLAY_SHORT = 1;
    /* Methods */
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
    public static function countEquivalentIDs($zoneId) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Create a new copy of the default timezone for this host
     *
     * @link http://www.php.net/manual/en/intltimezone.createdefault.php
     * @return IntlTimeZone
     */
    public static function createDefault() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     *
     * @link http://www.php.net/manual/en/intltimezone.createenumeration.php
     *
     * @param mixed $countryOrRawOffset [optional]
     *
     * @return IntlIterator
     */
    public static function createEnumeration($countryOrRawOffset) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     *
     * @link http://www.php.net/manual/en/intltimezone.createtimezone.php
     *
     * @param string $zoneId
     *
     * @return IntlTimeZone
     */
    public static function createTimeZone($zoneId) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     *
     * @link http://www.php.net/manual/en/intltimezone.fromdatetimezone.php
     *
     * @param DateTimeZone $zoneId
     *
     * @return IntlTimeZone
     */
    public static function fromDateTimeZone($zoneId) { }

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
    public static function getCanonicalID($zoneId, &$isSystemID) { }

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
    public static function getEquivalentID($zoneId, $index) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Create GMT (UTC) timezone
     *
     * @link http://www.php.net/manual/en/intltimezone.getgmt.php
     * @return IntlTimeZone
     */
    public static function getGMT() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the timezone data version currently used by ICU
     *
     * @link http://www.php.net/manual/en/intltimezone.gettzdataversion.php
     * @return string
     */
    public static function getTZDataVersion() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the amount of time to be added to local standard time to get local wall clock time
     *
     * @link http://www.php.net/manual/en/intltimezone.getequivalentid.php
     * @return int
     */
    public function getDSTSavings() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get a name of this time zone suitable for presentation to the user
     *
     * @param bool   $isDaylight [optional]
     * @param int    $style      [optional]
     * @param string $locale     [optional]
     *
     * @return string
     */
    public function getDisplayName($isDaylight, $style, $locale) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get last error code on the object
     *
     * @link http://www.php.net/manual/en/intltimezone.geterrorcode.php
     * @return int
     */
    public function getErrorCode() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get last error message on the object
     *
     * @link http://www.php.net/manual/en/intltimezone.geterrormessage.php
     * @return string
     */
    public function getErrorMessage() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get timezone ID
     *
     * @return string
     */
    public function getID() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Get the time zone raw and GMT offset for the given moment in time
     *
     * @link http://www.php.net/manual/en/intltimezone.getoffset.php
     *
     * @param float $date
     * @param bool  $local
     * @param int   $rawOffset
     * @param int   $dstOffset
     *
     * @return int
     */
    public function getOffset($date, $local, &$rawOffset, &$dstOffset) { }

    /**
     * Get the raw GMT offset (before taking daylight savings time into account
     *
     * @link http://www.php.net/manual/en/intltimezone.getrawoffset.php
     * @return int
     */
    public function getRawOffset() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Check if this zone has the same rules and offset as another zone
     *
     * @link http://www.php.net/manual/en/intltimezone.hassamerules.php
     *
     * @param IntlTimeZone $otherTimeZone
     *
     * @return bool
     */
    public function hasSameRules(IntlTimeZone $otherTimeZone) { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Convert to DateTimeZone object
     *
     * @link http://www.php.net/manual/ru/intltimezone.todatetimezone.php
     * @return DateTimeZone
     */
    public function toDateTimeZone() { }

    /**
     * (PHP 5 &gt;=5.5.0 PECL intl &gt;= 3.0.0a1)<br/>
     * Check if this time zone uses daylight savings time
     *
     * @link http://www.php.net/manual/ru/intltimezone.usedaylighttime.php
     * @return bool
     */
    public function useDaylightTime() { }
}

/**
 * A "Locale" is an identifier used to get language, culture, or regionally-specific behavior from an API. PHP locales are organized and identified the same way that the CLDR locales used by ICU (and many vendors of Unix-like operating systems, the Mac, Java, and so forth) use. Locales are identified using RFC 4646 language tags (which use hyphen, not underscore) in addition to the more traditional underscore-using identifiers. Unless otherwise noted the functions in this class are tolerant of both formats.
 *
 * Examples of identifiers include:
 *
 * en-US (English, United States)
 * zh-Hant-TW (Chinese, Traditional Script, Taiwan)
 * fr-CA, fr-FR (French for Canada and France respectively)
 *
 * The Locale class (and related procedural functions) are used to interact with locale identifiers--to verify that an ID is well-formed, valid, etc. The extensions used by CLDR in UAX #35 (and inherited by ICU) are valid and used wherever they would be in ICU normally.
 *
 * Locales cannot be instantiated as objects. All of the functions/methods provided are static.
 *
 * The null or empty string obtains the "root" locale. The "root" locale is equivalent to "en_US_POSIX" in CLDR. Language tags (and thus locale identifiers) are case insensitive. There exists a canonicalization function to make case match the specification.
 */
class Locale
{
    /**
     * This is locale the data actually comes from.
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const ACTUAL_LOCALE = 0;
    /**
     * Used as locale parameter with the methods of the various locale affected classes,
     * such as NumberFormatter. This constant would make the methods to use default
     * locale.
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const DEFAULT_LOCALE = null;
    /**
     * Extended language subtag
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const EXTLANG_TAG = 'extlang';
    /**
     * Grandfathered Language subtag
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const GRANDFATHERED_LANG_TAG = 'grandfathered';
    /**
     * Language subtag
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const LANG_TAG = 'language';
    /**
     * Private subtag
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const PRIVATE_TAG = 'private';
    /**
     * Region subtag
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const REGION_TAG = 'region';
    /**
     * Script subtag
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const SCRIPT_TAG = 'script';
    /**
     * This is the most specific locale supported by ICU.
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const VALID_LOCALE = 1;
    /**
     * Variant subtag
     *
     * @link http://php.net/manual/en/intl.locale-constants.php
     */
    const VARIANT_TAG = 'variant';

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
    public static function acceptFromHttp($header) { }

    /**
     * @link http://php.net/manual/en/locale.canonicalize.php
     *
     * @param string $locale
     *
     * @return string
     */
    public static function canonicalize($locale) { }

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
    public static function composeLocale(array $subtags) { }

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
    public static function filterMatches($langtag, $locale, $canonicalize = false) { }

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
    public static function getAllVariants($locale) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Gets the default locale value from the INTL global 'default_locale'
     *
     * @link http://php.net/manual/en/locale.getdefault.php
     * @return string The current runtime locale
     */
    public static function getDefault() { }

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
    public static function getDisplayLanguage($locale, $in_locale = null) { }

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
    public static function getDisplayName($locale, $in_locale = null) { }

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
    public static function getDisplayRegion($locale, $in_locale = null) { }

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
    public static function getDisplayScript($locale, $in_locale = null) { }

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
    public static function getDisplayVariant($locale, $in_locale = null) { }

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
    public static function getKeywords($locale) { }

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
    public static function getPrimaryLanguage($locale) { }

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
    public static function getRegion($locale) { }

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
    public static function getScript($locale) { }

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
    public static function lookup(array $langtag, $locale, $canonicalize = false, $default = null) { }

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
    public static function parseLocale($locale) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * sets the default runtime locale
     *
     * @link http://php.net/manual/en/locale.setdefault.php
     *
     * @param string $locale <p>
     *                       Is a BCP 47 compliant language tag containing the
     *                       </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public static function setDefault($locale) { }
}

/**
 * MessageFormatter is a concrete class that enables users to produce concatenated, language-neutral messages. The methods supplied in this class are used to build all the messages that are seen by end users.
 *
 * The MessageFormatter class assembles messages from various fragments (such as text fragments, numbers, and dates) supplied by the program. Because of the MessageFormatter class, the program does not need to know the order of the fragments. The class uses the formatting specifications for the fragments to assemble them into a message that is contained in a single string within a resource bundle. For example, MessageFormatter enables you to print the phrase "Finished printing x out of y files..." in a manner that still allows for flexibility in translation.
 *
 * Previously, an end user message was created as a sentence and handled as a string. This procedure created problems for localizers because the sentence structure, word order, number format and so on are very different from language to language. The language-neutral way to create messages keeps each part of the message separate and provides keys to the data. Using these keys, the MessageFormatter class can concatenate the parts of the message, localize them, and display a well-formed string to the end user.
 *
 * MessageFormatter takes a set of objects, formats them, and then inserts the formatted strings into the pattern at the appropriate places. Choice formats can be used in conjunction with MessageFormatter to handle plurals, match numbers, and select from an array of items. Typically, the message format will come from resources and the arguments will be dynamically set at runtime.
 */
class MessageFormatter
{
    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Constructs a new Message Formatter
     *
     * @link http://php.net/manual/en/messageformatter.create.php
     *
     * @param string $locale  <p>
     *                        The locale to use when formatting arguments
     *                        </p>
     * @param string $pattern <p>
     *                        The pattern string to stick arguments into.
     *                        The pattern uses an 'apostrophe-friendly' syntax; it is run through
     *                        umsg_autoQuoteApostrophe
     *                        before being interpreted.
     *                        </p>
     */
    public function __construct($locale, $pattern) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Constructs a new Message Formatter
     *
     * @link http://php.net/manual/en/messageformatter.create.php
     *
     * @param string $locale  <p>
     *                        The locale to use when formatting arguments
     *                        </p>
     * @param string $pattern <p>
     *                        The pattern string to stick arguments into.
     *                        The pattern uses an 'apostrophe-friendly' syntax; it is run through
     *                        umsg_autoQuoteApostrophe
     *                        before being interpreted.
     *                        </p>
     *
     * @return MessageFormatter The formatter object
     */
    public static function create($locale, $pattern) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Quick format message
     *
     * @link http://php.net/manual/en/messageformatter.formatmessage.php
     *
     * @param string $locale  <p>
     *                        The locale to use for formatting locale-dependent parts
     *                        </p>
     * @param string $pattern <p>
     *                        The pattern string to insert things into.
     *                        The pattern uses an 'apostrophe-friendly' syntax; it is run through
     *                        umsg_autoQuoteApostrophe
     *                        before being interpreted.
     *                        </p>
     * @param array  $args    <p>
     *                        The array of values to insert into the format string
     *                        </p>
     *
     * @return string The formatted pattern string or <b>FALSE</b> if an error occurred
     */
    public static function formatMessage($locale, $pattern, array $args) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Quick parse input string
     *
     * @link http://php.net/manual/en/messageformatter.parsemessage.php
     *
     * @param string $locale  <p>
     *                        The locale to use for parsing locale-dependent parts
     *                        </p>
     * @param string $pattern <p>
     *                        The pattern with which to parse the <i>value</i>.
     *                        </p>
     * @param string $source  <p>
     *                        The string to parse, conforming to the <i>pattern</i>.
     *                        </p>
     *
     * @return array An array containing items extracted, or <b>FALSE</b> on error
     */
    public static function parseMessage($locale, $pattern, $source) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Format the message
     *
     * @link http://php.net/manual/en/messageformatter.format.php
     *
     * @param array $args <p>
     *                    Arguments to insert into the format string
     *                    </p>
     *
     * @return string The formatted string, or <b>FALSE</b> if an error occurred
     */
    public function format(array $args) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the error code from last operation
     *
     * @link http://php.net/manual/en/messageformatter.geterrorcode.php
     * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
     */
    public function getErrorCode() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the error text from the last operation
     *
     * @link http://php.net/manual/en/messageformatter.geterrormessage.php
     * @return string Description of the last error.
     */
    public function getErrorMessage() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the locale for which the formatter was created.
     *
     * @link http://php.net/manual/en/messageformatter.getlocale.php
     * @return string The locale name
     */
    public function getLocale() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get the pattern used by the formatter
     *
     * @link http://php.net/manual/en/messageformatter.getpattern.php
     * @return string The pattern string for this message formatter
     */
    public function getPattern() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Parse input string according to pattern
     *
     * @link http://php.net/manual/en/messageformatter.parse.php
     *
     * @param string $value <p>
     *                      The string to parse
     *                      </p>
     *
     * @return array An array containing the items extracted, or <b>FALSE</b> on error
     */
    public function parse($value) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Set the pattern used by the formatter
     *
     * @link http://php.net/manual/en/messageformatter.setpattern.php
     *
     * @param string $pattern <p>
     *                        The pattern string to use in this message formatter.
     *                        The pattern uses an 'apostrophe-friendly' syntax; it is run through
     *                        umsg_autoQuoteApostrophe
     *                        before being interpreted.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setPattern($pattern) { }
}

/**
 * Normalization is a process that involves transforming characters and sequences of characters into a formally-defined underlying representation. This process is most important when text needs to be compared for sorting and searching, but it is also used when storing text to ensure that the text is stored in a consistent representation.
 *
 * The Unicode Consortium has defined a number of normalization forms reflecting the various needs of applications:
 *
 * * Normalization Form D (NFD) - Canonical Decomposition
 * * Normalization Form C (NFC) - Canonical Decomposition followed by Canonical Composition
 * * Normalization Form KD (NFKD) - Compatibility Decomposition
 * * Normalization Form KC (NFKC) - Compatibility Decomposition followed by Canonical Composition
 *
 * The different forms are defined in terms of a set of transformations on the text, transformations that are expressed by both an algorithm and a set of data files.
 */
class Normalizer
{
    /**
     * Normalization Form C (NFC) - Canonical Decomposition followed by
     * Canonical Composition
     *
     * @link http://www.php.net/manual/en/class.normalizer.php
     */
    const FORM_C = 4;
    /**
     * Normalization Form D (NFD) - Canonical Decomposition
     *
     * @link http://www.php.net/manual/en/class.normalizer.php
     */
    const FORM_D = 2;
    /**
     * Normalization Form KC (NFKC) - Compatibility Decomposition, followed by
     * Canonical Composition
     *
     * @link http://www.php.net/manual/en/class.normalizer.php
     */
    const FORM_KC = 5;
    /**
     * Normalization Form KD (NFKD) - Compatibility Decomposition
     *
     * @link http://www.php.net/manual/en/class.normalizer.php
     */
    const FORM_KD = 3;
    const NFC = 4;
    const NFD = 2;
    const NFKC = 5;
    const NFKD = 3;
    /**
     * No decomposition/composition
     *
     * @link http://www.php.net/manual/en/class.normalizer.php
     */
    const NONE = 1;
    /**
     * Default normalization options
     *
     * @link http://www.php.net/manual/en/class.normalizer.php
     */
    const OPTION_DEFAULT = 4;

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Checks if the provided string is already in the specified normalization form.
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
    public static function isNormalized($input, $form = Normalizer::FORM_C) { }

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
    public static function normalize($input, $form = Normalizer::FORM_C) { }
}

/**
 * Programs store and operate on numbers using a locale-independent binary representation. When displaying or printing a number it is converted to a locale-specific string. For example, the number 12345.67 is "12,345.67" in the US, "12 345,67" in France and "12.345,67" in Germany.
 *
 * By invoking the methods provided by the NumberFormatter class, you can format numbers, currencies, and percentages according to the specified or default locale. NumberFormatter is locale-sensitive so you need to create a new NumberFormatter for each locale. NumberFormatter methods format primitive-type numbers, such as double and output the number as a locale-specific string.
 *
 * For currencies you can use currency format type to create a formatter that returns a string with the formatted number and the appropriate currency sign. Of course, the NumberFormatter class is unaware of exchange rates so, the number output is the same regardless of the specified currency. This means that the same number has different monetary values depending on the currency locale. If the number is 9988776.65 the results will be:
 *
 * * 9 988 776,65 € in France
 * * 9.988.776,65 € in Germany
 * * $9,988,776.65 in the United States
 *
 * In order to format percentages, create a locale-specific formatter with percentage format type. With this formatter, a decimal fraction such as 0.75 is displayed as 75%.
 *
 * For more complex formatting, like spelled-out numbers, the rule-based number formatters are used.
 */
class NumberFormatter
{
    /**
     * Currency format
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const CURRENCY = 2;
    /**
     * The ISO currency code.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const CURRENCY_CODE = 5;
    /**
     * The currency symbol.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const CURRENCY_SYMBOL = 8;
    /**
     * Decimal format
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const DECIMAL = 1;
    /**
     * Always show decimal point.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const DECIMAL_ALWAYS_SHOWN = 2;
    /**
     * The decimal separator.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const DECIMAL_SEPARATOR_SYMBOL = 0;
    /**
     * The default rule set. This is only available with rule-based
     * formatters.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const DEFAULT_RULESET = 6;
    /**
     * Default format for the locale
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const DEFAULT_STYLE = 1;
    /**
     * Character representing a digit in the pattern.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const DIGIT_SYMBOL = 5;
    /**
     * Duration rule-based format
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const DURATION = 7;
    /**
     * The exponential symbol.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const EXPONENTIAL_SYMBOL = 11;
    /**
     * The width to which the output of format() is padded.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const FORMAT_WIDTH = 13;
    /**
     * Fraction digits.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const FRACTION_DIGITS = 8;
    /**
     * The grouping separator.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const GROUPING_SEPARATOR_SYMBOL = 1;
    /**
     * Grouping size.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const GROUPING_SIZE = 10;
    /**
     * Use grouping separator.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const GROUPING_USED = 1;
    /**
     * Alias for PATTERN_DECIMAL
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const IGNORE = 0;
    /**
     * Infinity symbol.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const INFINITY_SYMBOL = 14;
    /**
     * Integer digits.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const INTEGER_DIGITS = 5;
    /**
     * The international currency symbol.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const INTL_CURRENCY_SYMBOL = 9;
    /**
     * Lenient parse mode used by rule-based formats.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const LENIENT_PARSE = 19;
    /**
     * Maximum fraction digits.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MAX_FRACTION_DIGITS = 6;
    /**
     * Maximum integer digits.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MAX_INTEGER_DIGITS = 3;
    /**
     * Maximum significant digits.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MAX_SIGNIFICANT_DIGITS = 18;
    /**
     * The minus sign.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MINUS_SIGN_SYMBOL = 6;
    /**
     * Minimum fraction digits.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MIN_FRACTION_DIGITS = 7;
    /**
     * Minimum integer digits.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MIN_INTEGER_DIGITS = 4;
    /**
     * Minimum significant digits.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MIN_SIGNIFICANT_DIGITS = 17;
    /**
     * The monetary grouping separator.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MONETARY_GROUPING_SEPARATOR_SYMBOL = 17;
    /**
     * The monetary separator.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MONETARY_SEPARATOR_SYMBOL = 10;
    /**
     * Multiplier.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const MULTIPLIER = 9;
    /**
     * Not-a-number symbol.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const NAN_SYMBOL = 15;
    /**
     * Negative prefix.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const NEGATIVE_PREFIX = 2;
    /**
     * Negative suffix.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const NEGATIVE_SUFFIX = 3;
    /**
     * Ordinal rule-based format
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ORDINAL = 6;
    /**
     * The character used to pad to the format width.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PADDING_CHARACTER = 4;
    /**
     * The position at which padding will take place. See pad position
     * constants for possible argument values.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PADDING_POSITION = 14;
    /**
     * Pad characters inserted after the prefix.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PAD_AFTER_PREFIX = 1;
    /**
     * Pad characters inserted after the suffix.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PAD_AFTER_SUFFIX = 3;
    /**
     * Pad characters inserted before the prefix.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PAD_BEFORE_PREFIX = 0;
    /**
     * Pad characters inserted before the suffix.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PAD_BEFORE_SUFFIX = 2;
    /**
     * Escape padding character.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PAD_ESCAPE_SYMBOL = 13;
    /**
     * Parse integers only.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PARSE_INT_ONLY = 0;
    /**
     * Decimal format defined by pattern
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PATTERN_DECIMAL = 0;
    /**
     * Rule-based format defined by pattern
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PATTERN_RULEBASED = 9;
    /**
     * The pattern separator.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PATTERN_SEPARATOR_SYMBOL = 2;
    /**
     * Percent format
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PERCENT = 3;
    /**
     * The percent sign.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PERCENT_SYMBOL = 3;
    /**
     * Per mill symbol.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PERMILL_SYMBOL = 12;
    /**
     * The plus sign.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PLUS_SIGN_SYMBOL = 7;
    /**
     * Positive prefix.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const POSITIVE_PREFIX = 0;
    /**
     * Positive suffix.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const POSITIVE_SUFFIX = 1;
    /**
     * The public rule sets. This is only available with rule-based
     * formatters. This is a read-only attribute. The public rulesets are
     * returned as a single string, with each ruleset name delimited by ';'
     * (semicolon).
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const PUBLIC_RULESETS = 7;
    /**
     * Rounding increment.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ROUNDING_INCREMENT = 12;
    /**
     * Rounding Mode.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ROUNDING_MODE = 11;
    /**
     * Rounding mode to round towards positive infinity.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ROUND_CEILING = 0;
    /**
     * Rounding mode to round towards zero.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ROUND_DOWN = 2;
    /**
     * Rounding mode to round towards negative infinity.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ROUND_FLOOR = 1;
    /**
     * Rounding mode to round towards "nearest neighbor" unless both neighbors
     * are equidistant, in which case round down.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ROUND_HALFDOWN = 5;
    /**
     * Rounding mode to round towards the "nearest neighbor" unless both
     * neighbors are equidistant, in which case, round towards the even
     * neighbor.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ROUND_HALFEVEN = 4;
    /**
     * Rounding mode to round towards "nearest neighbor" unless both neighbors
     * are equidistant, in which case round up.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ROUND_HALFUP = 6;
    /**
     * Rounding mode to round away from zero.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ROUND_UP = 3;
    /**
     * Scientific format
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const SCIENTIFIC = 4;
    /**
     * Secondary grouping size.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const SECONDARY_GROUPING_SIZE = 15;
    /**
     * Use significant digits.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const SIGNIFICANT_DIGITS_USED = 16;
    /**
     * Significant digit symbol.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const SIGNIFICANT_DIGIT_SYMBOL = 16;
    /**
     * Spellout rule-based format
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const SPELLOUT = 5;
    /**
     * Format/parse as currency value
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const TYPE_CURRENCY = 4;
    /**
     * Derive the type from variable type
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const TYPE_DEFAULT = 0;
    /**
     * Format/parse as floating point value
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const TYPE_DOUBLE = 3;
    /**
     * Format/parse as 32-bit integer
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const TYPE_INT32 = 1;
    /**
     * Format/parse as 64-bit integer
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const TYPE_INT64 = 2;
    /**
     * Zero.
     *
     * @link http://php.net/manual/en/intl.numberformatter-constants.php
     */
    const ZERO_DIGIT_SYMBOL = 4;

    /**
     * @param $locale
     * @param $style
     * @param $pattern [optional]
     */
    public function __construct($locale, $style, $pattern) { }

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
    public static function create($locale, $style, $pattern = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Format a number
     *
     * @link http://php.net/manual/en/numberformatter.format.php
     *
     * @param number $value <p>
     *                      The value to format. Can be integer or float,
     *                      other values will be converted to a numeric value.
     *                      </p>
     * @param int    $type  [optional] <p>
     *                      The
     *                      formatting type to use.
     *                      </p>
     *
     * @return string the string containing formatted value, or <b>FALSE</b> on error.
     */
    public function format($value, $type = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Format a currency value
     *
     * @link http://php.net/manual/en/numberformatter.formatcurrency.php
     *
     * @param float  $value    <p>
     *                         The numeric currency value.
     *                         </p>
     * @param string $currency <p>
     *                         The 3-letter ISO 4217 currency code indicating the currency to use.
     *                         </p>
     *
     * @return string String representing the formatted currency value.
     */
    public function formatCurrency($value, $currency) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get an attribute
     *
     * @link http://php.net/manual/en/numberformatter.getattribute.php
     *
     * @param int $attr <p>
     *                  Attribute specifier - one of the
     *                  numeric attribute constants.
     *                  </p>
     *
     * @return int Return attribute value on success, or <b>FALSE</b> on error.
     */
    public function getAttribute($attr) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get formatter's last error code.
     *
     * @link http://php.net/manual/en/numberformatter.geterrorcode.php
     * @return int error code from last formatter call.
     */
    public function getErrorCode() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get formatter's last error message.
     *
     * @link http://php.net/manual/en/numberformatter.geterrormessage.php
     * @return string error message from last formatter call.
     */
    public function getErrorMessage() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get formatter locale
     *
     * @link http://php.net/manual/en/numberformatter.getlocale.php
     *
     * @param int $type [optional] <p>
     *                  You can choose between valid and actual locale (
     *                  <b>Locale::VALID_LOCALE</b>,
     *                  <b>Locale::ACTUAL_LOCALE</b>,
     *                  respectively). The default is the actual locale.
     *                  </p>
     *
     * @return string The locale name used to create the formatter.
     */
    public function getLocale($type = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get formatter pattern
     *
     * @link http://php.net/manual/en/numberformatter.getpattern.php
     * @return string Pattern string that is used by the formatter, or <b>FALSE</b> if an error happens.
     */
    public function getPattern() { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get a symbol value
     *
     * @link http://php.net/manual/en/numberformatter.getsymbol.php
     *
     * @param int $attr <p>
     *                  Symbol specifier, one of the
     *                  format symbol constants.
     *                  </p>
     *
     * @return string The symbol string or <b>FALSE</b> on error.
     */
    public function getSymbol($attr) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Get a text attribute
     *
     * @link http://php.net/manual/en/numberformatter.gettextattribute.php
     *
     * @param int $attr <p>
     *                  Attribute specifier - one of the
     *                  text attribute constants.
     *                  </p>
     *
     * @return string Return attribute value on success, or <b>FALSE</b> on error.
     */
    public function getTextAttribute($attr) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Parse a number
     *
     * @link http://php.net/manual/en/numberformatter.parse.php
     *
     * @param string $value
     * @param int    $type     [optional] <p>
     *                         The
     *                         formatting type to use. By default,
     *                         <b>NumberFormatter::TYPE_DOUBLE</b> is used.
     *                         </p>
     * @param int    $position [optional] <p>
     *                         Offset in the string at which to begin parsing. On return, this value
     *                         will hold the offset at which parsing ended.
     *                         </p>
     *
     * @return mixed The value of the parsed number or <b>FALSE</b> on error.
     */
    public function parse($value, $type = null, &$position = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Parse a currency number
     *
     * @link http://php.net/manual/en/numberformatter.parsecurrency.php
     *
     * @param string $value
     * @param string $currency <p>
     *                         Parameter to receive the currency name (3-letter ISO 4217 currency
     *                         code).
     *                         </p>
     * @param int    $position [optional] <p>
     *                         Offset in the string at which to begin parsing. On return, this value
     *                         will hold the offset at which parsing ended.
     *                         </p>
     *
     * @return float The parsed numeric value or <b>FALSE</b> on error.
     */
    public function parseCurrency($value, &$currency, &$position = null) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Set an attribute
     *
     * @link http://php.net/manual/en/numberformatter.setattribute.php
     *
     * @param int $attr  <p>
     *                   Attribute specifier - one of the
     *                   numeric attribute constants.
     *                   </p>
     * @param int $value <p>
     *                   The attribute value.
     *                   </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setAttribute($attr, $value) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Set formatter pattern
     *
     * @link http://php.net/manual/en/numberformatter.setpattern.php
     *
     * @param string $pattern <p>
     *                        Pattern in syntax described in
     *                        ICU DecimalFormat
     *                        documentation.
     *                        </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setPattern($pattern) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Set a symbol value
     *
     * @link http://php.net/manual/en/numberformatter.setsymbol.php
     *
     * @param int    $attr  <p>
     *                      Symbol specifier, one of the
     *                      format symbol constants.
     *                      </p>
     * @param string $value <p>
     *                      Text for the symbol.
     *                      </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setSymbol($attr, $value) { }

    /**
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Set a text attribute
     *
     * @link http://php.net/manual/en/numberformatter.settextattribute.php
     *
     * @param int    $attr  <p>
     *                      Attribute specifier - one of the
     *                      text attribute
     *                      constants.
     *                      </p>
     * @param string $value <p>
     *                      Text for the attribute value.
     *                      </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setTextAttribute($attr, $value) { }
}

/**
 * Localized software products often require sets of data that are to be customized depending on current locale, e.g.: messages, labels, formatting patterns. ICU resource mechanism allows to define sets of resources that the application can load on locale basis, while accessing them in unified locale-independent fashion.
 *
 * This class implements access to ICU resource data files. These files are binary data arrays which ICU uses to store the localized data.
 *
 * ICU resource bundle can hold simple resources and complex resources. Complex resources are containers which can be either integer-indexed or string-indexed (just like PHP arrays). Simple resources can be of the following types: string, integer, binary data field or integer array.
 *
 * ResourceBundle supports direct access to the data through array access pattern and iteration via foreach, as well as access via class methods. The result will be PHP value for simple resources and ResourceBundle object for complex ones. All resources are read-only.
 * @since 5.3.2
 */
class ResourceBundle implements Traversable
{
    /**
     * @param $locale
     * @param $bundlename
     * @param $fallback [optional]
     */
    public function __construct($locale, $bundlename, $fallback) { }

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
    public static function create($locale, $bundlename, $fallback = null) { }

    /**
     * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
     * Get supported locales
     *
     * @link http://php.net/manual/en/resourcebundle.locales.php
     *
     * @param string $bundlename <p>
     *                           Path of ResourceBundle for which to get available locales, or
     *                           empty string for default locales list.
     *                           </p>
     *
     * @return array the list of locales supported by the bundle.
     */
    public static function getLocales($bundlename) { }

    /**
     * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
     * Get number of elements in the bundle
     *
     * @link http://php.net/manual/en/resourcebundle.count.php
     * @return int number of elements in the bundle.
     */
    public function count() { }

    /**
     * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
     * Get data from the bundle
     *
     * @link http://php.net/manual/en/resourcebundle.get.php
     *
     * @param string|int $index <p>
     *                          Data index, must be string or integer.
     *                          </p>
     *
     * @return mixed the data located at the index or <b>NULL</b> on error. Strings, integers and binary data strings
     * are returned as corresponding PHP types, integer array is returned as PHP array. Complex types are
     * returned as <b>ResourceBundle</b> object.
     */
    public function get($index) { }

    /**
     * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
     * Get bundle's last error code.
     *
     * @link http://php.net/manual/en/resourcebundle.geterrorcode.php
     * @return int error code from last bundle object call.
     */
    public function getErrorCode() { }

    /**
     * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
     * Get bundle's last error message.
     *
     * @link http://php.net/manual/en/resourcebundle.geterrormessage.php
     * @return string error message from last bundle object's call.
     */
    public function getErrorMessage() { }
}

/**
 * @link http://php.net/manual/en/class.spoofchecker.php
 */
class Spoofchecker
{
    const ANY_CASE = 8;
    const CHAR_LIMIT = 64;
    const INVISIBLE = 32;
    const MIXED_SCRIPT_CONFUSABLE = 2;
    const SINGLE_SCRIPT = 16;
    const SINGLE_SCRIPT_CONFUSABLE = 1;
    const WHOLE_SCRIPT_CONFUSABLE = 4;

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Constructor
     *
     * @link http://php.net/manual/en/spoofchecker.construct.php
     */
    public function __construct() { }

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Checks if a given text contains any confusable characters
     *
     * @link http://php.net/manual/en/spoofchecker.areconfusable.php
     *
     * @param string $s1    <p>
     *                      </p>
     * @param string $s2    <p>
     *                      </p>
     * @param string $error [optional] <p>
     *                      </p>
     *
     * @return bool
     */
    public function areConfusable($s1, $s2, &$error = null) { }

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Checks if a given text contains any suspicious characters
     *
     * @link http://php.net/manual/en/spoofchecker.issuspicious.php
     *
     * @param string $text  <p>
     *                      </p>
     * @param string $error [optional] <p>
     *                      </p>
     *
     * @return bool
     */
    public function isSuspicious($text, &$error = null) { }

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Locales to use when running checks
     *
     * @link http://php.net/manual/en/spoofchecker.setallowedlocales.php
     *
     * @param string $locale_list <p>
     *                            </p>
     *
     * @return void
     */
    public function setAllowedLocales($locale_list) { }

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Set the checks to run
     *
     * @link http://php.net/manual/en/spoofchecker.setchecks.php
     *
     * @param string $checks <p>
     *                       </p>
     *
     * @return void
     */
    public function setChecks($checks) { }
}

/**
 * Transliterator provides transliteration of strings.
 * @since 5.4.0
 */
class Transliterator
{
    const FORWARD = 0;
    const REVERSE = 1;
    public $id;

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Private constructor to deny instantiation
     *
     * @link http://php.net/manual/en/transliterator.construct.php
     */
    final private function __construct() { }

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
    public static function create($id, $direction = null) { }

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
    public static function createFromRules($rules, $direction = null) { }

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Get transliterator IDs
     *
     * @link http://php.net/manual/en/transliterator.listids.php
     * @return array An array of registered transliterator IDs on success,
     * or <b>FALSE</b> on failure.
     */
    public static function listIDs() { }

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Create an inverse transliterator
     *
     * @link http://php.net/manual/en/transliterator.createinverse.php
     * @return Transliterator a <b>Transliterator</b> object on success,
     * or <b>NULL</b> on failure
     */
    public function createInverse() { }

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Get last error code
     *
     * @link http://php.net/manual/en/transliterator.geterrorcode.php
     * @return int The error code on success,
     * or <b>FALSE</b> if none exists, or on failure.
     */
    public function getErrorCode() { }

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Get last error message
     *
     * @link http://php.net/manual/en/transliterator.geterrormessage.php
     * @return string The error code on success,
     * or <b>FALSE</b> if none exists, or on failure.
     */
    public function getErrorMessage() { }

    /**
     * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
     * Transliterate a string
     *
     * @link http://php.net/manual/en/transliterator.transliterate.php
     *
     * @param string $subject <p>
     *                        The string to be transformed.
     *                        </p>
     * @param int    $start   [optional] <p>
     *                        The start index (in UTF-16 code units) from which the string will start
     *                        to be transformed, inclusive. Indexing starts at 0. The text before will
     *                        be left as is.
     *                        </p>
     * @param int    $end     [optional] <p>
     *                        The end index (in UTF-16 code units) until which the string will be
     *                        transformed, exclusive. Indexing starts at 0. The text after will be
     *                        left as is.
     *                        </p>
     *
     * @return string The transfomed string on success, or <b>FALSE</b> on failure.
     */
    public function transliterate($subject, $start = null, $end = null) { }
}

/**
 * Class UConverter
 * @since 5.5.0
 */
class UConverter
{
    /* Constants */
    const BOCU1 = 28;
    const CESU8 = 31;
    const DBCS = 1;
    const EBCDIC_STATEFUL = 9;
    const HZ = 23;
    const IMAP_MAILBOX = 32;
    const ISCII = 25;
    const ISO_2022 = 10;
    const LATIN_1 = 3;
    const LMBCS_1 = 11;
    const LMBCS_11 = 18;
    const LMBCS_16 = 19;
    const LMBCS_17 = 20;
    const LMBCS_18 = 21;
    const LMBCS_19 = 22;
    const LMBCS_2 = 12;
    const LMBCS_3 = 13;
    const LMBCS_4 = 14;
    const LMBCS_5 = 15;
    const LMBCS_6 = 16;
    const LMBCS_8 = 17;
    const LMBCS_LAST = 22;
    const MBCS = 2;
    const REASON_CLONE = 5;
    const REASON_CLOSE = 4;
    const REASON_ILLEGAL = 1;
    const REASON_IRREGULAR = 2;
    const REASON_RESET = 3;
    const REASON_UNASSIGNED = 0;
    const SBCS = 0;
    const SCSU = 24;
    const UNSUPPORTED_CONVERTER = -1;
    const US_ASCII = 26;
    const UTF16 = 29;
    const UTF16_BigEndian = 5;
    const UTF16_LittleEndian = 6;
    const UTF32 = 30;
    const UTF32_BigEndian = 7;
    const UTF32_LittleEndian = 8;
    const UTF7 = 27;
    const UTF8 = 4;
    /* Methods */
    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Create UConverter object
     *
     * @link http://php.net/manual/en/uconverter.construct.php
     *
     * @param string $destination_encoding
     * @param string $source_encoding
     */
    public function __construct($destination_encoding = null, $source_encoding = null) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get the aliases of the given name
     *
     * @link http://php.net/manual/en/uconverter.getaliases.php
     *
     * @param string $name
     *
     * @return array
     */
    public static function getAliases($name = null) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get the available canonical converter names
     *
     * @link http://php.net/manual/en/uconverter.getavailable.php
     * @return array
     */
    public static function getAvailable() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get standards associated to converter names
     *
     * @link http://php.net/manual/en/uconverter.getstandards.php
     * @return array
     */
    public static function getStandards() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get string representation of the callback reason
     *
     * @link http://php.net/manual/en/uconverter.reasontext.php
     *
     * @param int $reason
     *
     * @return string
     */
    public static function reasonText($reason) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Convert string from one charset to another
     *
     * @link http://php.net/manual/en/uconverter.transcode.php
     *
     * @param string $str
     * @param string $toEncoding
     * @param string $fromEncoding
     * @param array  $options
     *
     * @return string
     */
    public static function transcode($str, $toEncoding, $fromEncoding, array $options = []) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Convert string from one charset to anothe
     *
     * @link http://php.net/manual/en/uconverter.convert.php
     *
     * @param string $str
     * @param bool   $reverse
     *
     * @return string
     */
    public function convert($str, $reverse) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Default "from" callback function
     *
     * @link http://php.net/manual/en/uconverter.fromucallback.php
     *
     * @param int    $reason
     * @param string $source
     * @param string $codePoint
     * @param int    $error
     *
     * @return mixed
     */
    public function fromUCallback($reason, $source, $codePoint, &$error) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get the destination encoding
     *
     * @link http://php.net/manual/en/uconverter.getdestinationencoding.php
     * @return string
     */
    public function getDestinationEncoding() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get the destination converter type
     *
     * @link http://php.net/manual/en/uconverter.getdestinationtype.php
     * @return int
     */
    public function getDestinationType() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get last error code on the object
     *
     * @link http://php.net/manual/en/uconverter.geterrorcode.php
     * @return int
     */
    public function getErrorCode() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get last error message on the object
     *
     * @link http://php.net/manual/en/uconverter.geterrormessage.php
     * @return string
     */
    public function getErrorMessage() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get the source encoding
     *
     * @link http://php.net/manual/en/uconverter.getsourceencoding.php
     * @return string
     */
    public function getSourceEncoding() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get the source convertor type
     *
     * @link http://php.net/manual/en/uconverter.getsourcetype.php
     * @return int
     */
    public function getSourceType() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Get substitution chars
     *
     * @link http://php.net/manual/en/uconverter.getsubstchars.php
     * @return string
     */
    public function getSubstChars() { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Set the destination encoding
     *
     * @link http://php.net/manual/en/uconverter.setdestinationencoding.php
     *
     * @param string $encoding
     *
     * @return void
     */
    public function setDestinationEncoding($encoding) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Set the source encoding
     *
     * @link http://php.net/manual/en/uconverter.setsourceencoding.php
     *
     * @param string $encoding
     *
     * @return void
     */
    public function setSourceEncoding($encoding) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Set the substitution chars
     *
     * @link http://php.net/manual/en/uconverter.setsubstchars.php
     *
     * @param string $chars
     *
     * @return void
     */
    public function setSubstChars($chars) { }

    /**
     * (PHP 5 &gt;=5.5.0)<br/>
     * Default "to" callback function
     *
     * @link http://php.net/manual/en/uconverter.toucallback.php
     *
     * @param int    $reason
     * @param string $source
     * @param string $codeUnits
     * @param int    $error
     *
     * @return mixed
     */
    public function toUCallback($reason, $source, $codeUnits, &$error) { }
}
