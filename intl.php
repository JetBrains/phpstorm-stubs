<?php

// Start of intl v.1.1.0

class Collator  {
	const DEFAULT_VALUE = -1;
	const PRIMARY = 0;
	const SECONDARY = 1;
	const TERTIARY = 2;
	const DEFAULT_STRENGTH = 2;
	const QUATERNARY = 3;
	const IDENTICAL = 15;
	const OFF = 16;
	const ON = 17;
	const SHIFTED = 20;
	const NON_IGNORABLE = 21;
	const LOWER_FIRST = 24;
	const UPPER_FIRST = 25;

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
	 * @link http://php.net/manual/en/intl.collator-constants.php
	 */
	const FRENCH_COLLATION = 0;

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
	 * @link http://php.net/manual/en/intl.collator-constants.php
	 */
	const CASE_LEVEL = 3;

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
	 * @link http://php.net/manual/en/intl.collator-constants.php
	 */
	const NORMALIZATION_MODE = 4;

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
	 * @link http://php.net/manual/en/intl.collator-constants.php
	 */
	const STRENGTH = 5;

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
	 * @link http://php.net/manual/en/intl.collator-constants.php
	 */
	const HIRAGANA_QUATERNARY_MODE = 6;

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
	 * @link http://php.net/manual/en/intl.collator-constants.php
	 */
	const NUMERIC_COLLATION = 7;
	const SORT_REGULAR = 0;
	const SORT_STRING = 1;
	const SORT_NUMERIC = 2;


	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Create a collator
	 * @link http://php.net/manual/en/collator.construct.php
	 * @param $arg1
	 */
	public function __construct ($arg1) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Create a collator
	 * @link http://php.net/manual/en/collator.create.php
	 * @param string $locale <p>
	 * The locale containing the required collation rules. Special values for
	 * locales can be passed in - if null is passed for the locale, the
	 * default locale collation rules will be used. If empty string ("") or
	 * "root" are passed, UCA rules will be used.
	 * </p>
	 * @return Collator Return new instance of <b>Collator</b> object, or <b>NULL</b>
	 * on error.
	 */
	public static function create ($locale) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Compare two Unicode strings
	 * @link http://php.net/manual/en/collator.compare.php
	 * @param string $str1 <p>
	 * The first string to compare.
	 * </p>
	 * @param string $str2 <p>
	 * The second string to compare.
	 * </p>
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
	public function compare ($str1, $str2) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Sort array using specified collator
	 * @link http://php.net/manual/en/collator.sort.php
	 * @param array $arr <p>
	 * Array of strings to sort.
	 * </p>
	 * @param int $sort_flag [optional] <p>
	 * Optional sorting type, one of the following:
	 * </p>
	 * <p>
	 * <p>
	 * <b>Collator::SORT_REGULAR</b>
	 * - compare items normally (don't change types)
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function sort (array &$arr, $sort_flag = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Sort array using specified collator and sort keys
	 * @link http://php.net/manual/en/collator.sortwithsortkeys.php
	 * @param array $arr <p>Array of strings to sort</p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function sortWithSortKeys (array &$arr) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Sort array maintaining index association
	 * @link http://php.net/manual/en/collator.asort.php
	 * @param array $arr <p>Array of strings to sort.</p>
	 * @param int $sort_flag [optional] <p>
	 * Optional sorting type, one of the following:
	 * <p>
	 * <b>Collator::SORT_REGULAR</b>
	 * - compare items normally (don't change types)
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function asort (array &$arr, $sort_flag = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get collation attribute value
	 * @link http://php.net/manual/en/collator.getattribute.php
	 * @param int $attr <p>
	 * Attribute to get value for.
	 * </p>
	 * @return int Attribute value, or boolean <b>FALSE</b> on error.
	 */
	public function getAttribute ($attr) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Set collation attribute
	 * @link http://php.net/manual/en/collator.setattribute.php
	 * @param int $attr <p>Attribute.</p>
	 * @param int $val <p>
	 * Attribute value.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setAttribute ($attr, $val) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get current collation strength
	 * @link http://php.net/manual/en/collator.getstrength.php
	 * @return int current collation strength, or boolean <b>FALSE</b> on error.
	 */
	public function getStrength () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Set collation strength
	 * @link http://php.net/manual/en/collator.setstrength.php
	 * @param int $strength <p>Strength to set.</p>
	 * <p>
	 * Possible values are:
	 * <p>
	 * <b>Collator::PRIMARY</b>
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setStrength ($strength) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the locale name of the collator
	 * @link http://php.net/manual/en/collator.getlocale.php
	 * @param int $type [optional] <p>
	 * You can choose between valid and actual locale (
	 * <b>Locale::VALID_LOCALE</b> and
	 * <b>Locale::ACTUAL_LOCALE</b>,
	 * respectively). The default is the actual locale.
	 * </p>
	 * @return string Real locale name from which the collation data comes. If the collator was
	 * instantiated from rules or an error occurred, returns
	 * boolean <b>FALSE</b>.
	 */
	public function getLocale ($type = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get collator's last error code
	 * @link http://php.net/manual/en/collator.geterrorcode.php
	 * @return int Error code returned by the last Collator API function call.
	 */
	public function getErrorCode () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get text for collator's last error code
	 * @link http://php.net/manual/en/collator.geterrormessage.php
	 * @return string Description of an error occurred in the last Collator API function call.
	 */
	public function getErrorMessage () {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Get sorting key for a string
	 * @link http://php.net/manual/en/collator.getsortkey.php
	 * @param string $str <p>
	 * The string to produce the key from.
	 * </p>
	 * @return string the collation key for the string. Collation keys can be compared directly instead of strings.
	 */
	public function getSortKey ($str) {}

}

class NumberFormatter  {

	/**
	 * Decimal format defined by pattern
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PATTERN_DECIMAL = 0;

	/**
	 * Decimal format
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const DECIMAL = 1;

	/**
	 * Currency format
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const CURRENCY = 2;

	/**
	 * Percent format
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PERCENT = 3;

	/**
	 * Scientific format
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const SCIENTIFIC = 4;

	/**
	 * Spellout rule-based format
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const SPELLOUT = 5;

	/**
	 * Ordinal rule-based format
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ORDINAL = 6;

	/**
	 * Duration rule-based format
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const DURATION = 7;

	/**
	 * Rule-based format defined by pattern
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PATTERN_RULEBASED = 9;

	/**
	 * Alias for PATTERN_DECIMAL
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const IGNORE = 0;

	/**
	 * Default format for the locale
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const DEFAULT_STYLE = 1;

	/**
	 * Rounding mode to round towards positive infinity.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ROUND_CEILING = 0;

	/**
	 * Rounding mode to round towards negative infinity.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ROUND_FLOOR = 1;

	/**
	 * Rounding mode to round towards zero.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ROUND_DOWN = 2;

	/**
	 * Rounding mode to round away from zero.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ROUND_UP = 3;

	/**
	 * Rounding mode to round towards the "nearest neighbor" unless both
	 * neighbors are equidistant, in which case, round towards the even
	 * neighbor.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ROUND_HALFEVEN = 4;

	/**
	 * Rounding mode to round towards "nearest neighbor" unless both neighbors
	 * are equidistant, in which case round down.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ROUND_HALFDOWN = 5;

	/**
	 * Rounding mode to round towards "nearest neighbor" unless both neighbors
	 * are equidistant, in which case round up.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ROUND_HALFUP = 6;

	/**
	 * Pad characters inserted before the prefix.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PAD_BEFORE_PREFIX = 0;

	/**
	 * Pad characters inserted after the prefix.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PAD_AFTER_PREFIX = 1;

	/**
	 * Pad characters inserted before the suffix.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PAD_BEFORE_SUFFIX = 2;

	/**
	 * Pad characters inserted after the suffix.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PAD_AFTER_SUFFIX = 3;

	/**
	 * Parse integers only.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PARSE_INT_ONLY = 0;

	/**
	 * Use grouping separator.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const GROUPING_USED = 1;

	/**
	 * Always show decimal point.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const DECIMAL_ALWAYS_SHOWN = 2;

	/**
	 * Maximum integer digits.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MAX_INTEGER_DIGITS = 3;

	/**
	 * Minimum integer digits.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MIN_INTEGER_DIGITS = 4;

	/**
	 * Integer digits.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const INTEGER_DIGITS = 5;

	/**
	 * Maximum fraction digits.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MAX_FRACTION_DIGITS = 6;

	/**
	 * Minimum fraction digits.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MIN_FRACTION_DIGITS = 7;

	/**
	 * Fraction digits.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const FRACTION_DIGITS = 8;

	/**
	 * Multiplier.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MULTIPLIER = 9;

	/**
	 * Grouping size.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const GROUPING_SIZE = 10;

	/**
	 * Rounding Mode.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ROUNDING_MODE = 11;

	/**
	 * Rounding increment.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ROUNDING_INCREMENT = 12;

	/**
	 * The width to which the output of format() is padded.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const FORMAT_WIDTH = 13;

	/**
	 * The position at which padding will take place. See pad position
	 * constants for possible argument values.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PADDING_POSITION = 14;

	/**
	 * Secondary grouping size.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const SECONDARY_GROUPING_SIZE = 15;

	/**
	 * Use significant digits.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const SIGNIFICANT_DIGITS_USED = 16;

	/**
	 * Minimum significant digits.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MIN_SIGNIFICANT_DIGITS = 17;

	/**
	 * Maximum significant digits.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MAX_SIGNIFICANT_DIGITS = 18;

	/**
	 * Lenient parse mode used by rule-based formats.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const LENIENT_PARSE = 19;

	/**
	 * Positive prefix.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const POSITIVE_PREFIX = 0;

	/**
	 * Positive suffix.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const POSITIVE_SUFFIX = 1;

	/**
	 * Negative prefix.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const NEGATIVE_PREFIX = 2;

	/**
	 * Negative suffix.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const NEGATIVE_SUFFIX = 3;

	/**
	 * The character used to pad to the format width.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PADDING_CHARACTER = 4;

	/**
	 * The ISO currency code.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const CURRENCY_CODE = 5;

	/**
	 * The default rule set. This is only available with rule-based
	 * formatters.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const DEFAULT_RULESET = 6;

	/**
	 * The public rule sets. This is only available with rule-based
	 * formatters. This is a read-only attribute. The public rulesets are
	 * returned as a single string, with each ruleset name delimited by ';'
	 * (semicolon).
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PUBLIC_RULESETS = 7;

	/**
	 * The decimal separator.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const DECIMAL_SEPARATOR_SYMBOL = 0;

	/**
	 * The grouping separator.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const GROUPING_SEPARATOR_SYMBOL = 1;

	/**
	 * The pattern separator.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PATTERN_SEPARATOR_SYMBOL = 2;

	/**
	 * The percent sign.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PERCENT_SYMBOL = 3;

	/**
	 * Zero.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const ZERO_DIGIT_SYMBOL = 4;

	/**
	 * Character representing a digit in the pattern.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const DIGIT_SYMBOL = 5;

	/**
	 * The minus sign.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MINUS_SIGN_SYMBOL = 6;

	/**
	 * The plus sign.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PLUS_SIGN_SYMBOL = 7;

	/**
	 * The currency symbol.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const CURRENCY_SYMBOL = 8;

	/**
	 * The international currency symbol.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const INTL_CURRENCY_SYMBOL = 9;

	/**
	 * The monetary separator.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MONETARY_SEPARATOR_SYMBOL = 10;

	/**
	 * The exponential symbol.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const EXPONENTIAL_SYMBOL = 11;

	/**
	 * Per mill symbol.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PERMILL_SYMBOL = 12;

	/**
	 * Escape padding character.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const PAD_ESCAPE_SYMBOL = 13;

	/**
	 * Infinity symbol.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const INFINITY_SYMBOL = 14;

	/**
	 * Not-a-number symbol.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const NAN_SYMBOL = 15;

	/**
	 * Significant digit symbol.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const SIGNIFICANT_DIGIT_SYMBOL = 16;

	/**
	 * The monetary grouping separator.
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const MONETARY_GROUPING_SEPARATOR_SYMBOL = 17;

	/**
	 * Derive the type from variable type
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const TYPE_DEFAULT = 0;

	/**
	 * Format/parse as 32-bit integer
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const TYPE_INT32 = 1;

	/**
	 * Format/parse as 64-bit integer
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const TYPE_INT64 = 2;

	/**
	 * Format/parse as floating point value
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const TYPE_DOUBLE = 3;

	/**
	 * Format/parse as currency value
	 * @link http://php.net/manual/en/intl.numberformatter-constants.php
	 */
	const TYPE_CURRENCY = 4;


	/**
	 * @param $locale
	 * @param $style
	 * @param $pattern [optional]
	 */
	public function __construct ($locale, $style, $pattern) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Create a number formatter
	 * @link http://php.net/manual/en/numberformatter.create.php
	 * @param string $locale <p>
	 * Locale in which the number would be formatted (locale name, e.g. en_CA).
	 * </p>
	 * @param int $style <p>
	 * Style of the formatting, one of the
	 * format style constants. If
	 * <b>NumberFormatter::PATTERN_DECIMAL</b>
	 * or <b>NumberFormatter::PATTERN_RULEBASED</b>
	 * is passed then the number format is opened using the given pattern,
	 * which must conform to the syntax described in
	 * ICU DecimalFormat
	 * documentation or
	 * ICU RuleBasedNumberFormat
	 * documentation, respectively.
	 * </p>
	 * @param string $pattern [optional] <p>
	 * Pattern string if the chosen style requires a pattern.
	 * </p>
	 * @return NumberFormatter <b>NumberFormatter</b> object or <b>FALSE</b> on error.
	 */
	public static function create ($locale, $style, $pattern = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Format a number
	 * @link http://php.net/manual/en/numberformatter.format.php
	 * @param number $value <p>
	 * The value to format. Can be integer or float,
	 * other values will be converted to a numeric value.
	 * </p>
	 * @param int $type [optional] <p>
	 * The
	 * formatting type to use.
	 * </p>
	 * @return string the string containing formatted value, or <b>FALSE</b> on error.
	 */
	public function format ($value, $type = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Parse a number
	 * @link http://php.net/manual/en/numberformatter.parse.php
	 * @param string $value
	 * @param int $type [optional] <p>
	 * The
	 * formatting type to use. By default,
	 * <b>NumberFormatter::TYPE_DOUBLE</b> is used.
	 * </p>
	 * @param int $position [optional] <p>
	 * Offset in the string at which to begin parsing. On return, this value
	 * will hold the offset at which parsing ended.
	 * </p>
	 * @return mixed The value of the parsed number or <b>FALSE</b> on error.
	 */
	public function parse ($value, $type = null, &$position = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Format a currency value
	 * @link http://php.net/manual/en/numberformatter.formatcurrency.php
	 * @param float $value <p>
	 * The numeric currency value.
	 * </p>
	 * @param string $currency <p>
	 * The 3-letter ISO 4217 currency code indicating the currency to use.
	 * </p>
	 * @return string String representing the formatted currency value.
	 */
	public function formatCurrency ($value, $currency) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Parse a currency number
	 * @link http://php.net/manual/en/numberformatter.parsecurrency.php
	 * @param string $value
	 * @param string $currency <p>
	 * Parameter to receive the currency name (3-letter ISO 4217 currency
	 * code).
	 * </p>
	 * @param int $position [optional] <p>
	 * Offset in the string at which to begin parsing. On return, this value
	 * will hold the offset at which parsing ended.
	 * </p>
	 * @return float The parsed numeric value or <b>FALSE</b> on error.
	 */
	public function parseCurrency ($value, &$currency, &$position = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Set an attribute
	 * @link http://php.net/manual/en/numberformatter.setattribute.php
	 * @param int $attr <p>
	 * Attribute specifier - one of the
	 * numeric attribute constants.
	 * </p>
	 * @param int $value <p>
	 * The attribute value.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setAttribute ($attr, $value) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get an attribute
	 * @link http://php.net/manual/en/numberformatter.getattribute.php
	 * @param int $attr <p>
	 * Attribute specifier - one of the
	 * numeric attribute constants.
	 * </p>
	 * @return int Return attribute value on success, or <b>FALSE</b> on error.
	 */
	public function getAttribute ($attr) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Set a text attribute
	 * @link http://php.net/manual/en/numberformatter.settextattribute.php
	 * @param int $attr <p>
	 * Attribute specifier - one of the
	 * text attribute
	 * constants.
	 * </p>
	 * @param string $value <p>
	 * Text for the attribute value.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setTextAttribute ($attr, $value) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get a text attribute
	 * @link http://php.net/manual/en/numberformatter.gettextattribute.php
	 * @param int $attr <p>
	 * Attribute specifier - one of the
	 * text attribute constants.
	 * </p>
	 * @return string Return attribute value on success, or <b>FALSE</b> on error.
	 */
	public function getTextAttribute ($attr) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Set a symbol value
	 * @link http://php.net/manual/en/numberformatter.setsymbol.php
	 * @param int $attr <p>
	 * Symbol specifier, one of the
	 * format symbol constants.
	 * </p>
	 * @param string $value <p>
	 * Text for the symbol.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setSymbol ($attr, $value) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get a symbol value
	 * @link http://php.net/manual/en/numberformatter.getsymbol.php
	 * @param int $attr <p>
	 * Symbol specifier, one of the
	 * format symbol constants.
	 * </p>
	 * @return string The symbol string or <b>FALSE</b> on error.
	 */
	public function getSymbol ($attr) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Set formatter pattern
	 * @link http://php.net/manual/en/numberformatter.setpattern.php
	 * @param string $pattern <p>
	 * Pattern in syntax described in
	 * ICU DecimalFormat
	 * documentation.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setPattern ($pattern) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get formatter pattern
	 * @link http://php.net/manual/en/numberformatter.getpattern.php
	 * @return string Pattern string that is used by the formatter, or <b>FALSE</b> if an error happens.
	 */
	public function getPattern () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get formatter locale
	 * @link http://php.net/manual/en/numberformatter.getlocale.php
	 * @param int $type [optional] <p>
	 * You can choose between valid and actual locale (
	 * <b>Locale::VALID_LOCALE</b>,
	 * <b>Locale::ACTUAL_LOCALE</b>,
	 * respectively). The default is the actual locale.
	 * </p>
	 * @return string The locale name used to create the formatter.
	 */
	public function getLocale ($type = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get formatter's last error code.
	 * @link http://php.net/manual/en/numberformatter.geterrorcode.php
	 * @return int error code from last formatter call.
	 */
	public function getErrorCode () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get formatter's last error message.
	 * @link http://php.net/manual/en/numberformatter.geterrormessage.php
	 * @return string error message from last formatter call.
	 */
	public function getErrorMessage () {}

}

class Normalizer  {

    /**
     * Default normalization options
     * @link http://www.php.net/manual/en/class.normalizer.php
     */
    const OPTION_DEFAULT = "";

    /**
	 * No decomposition/composition
	 * @link http://www.php.net/manual/en/class.normalizer.php
	 */
	const NONE = "1";

	/**
	 * Normalization Form D (NFD) - Canonical Decomposition
	 * @link http://www.php.net/manual/en/class.normalizer.php
	 */
	const FORM_D = "2";
	const NFD = 2;

	/**
	 * Normalization Form KD (NFKD) - Compatibility Decomposition
	 * @link http://www.php.net/manual/en/class.normalizer.php
	 */
	const FORM_KD = "3";
	const NFKD = 3;

	/**
	 * Normalization Form C (NFC) - Canonical Decomposition followed by
	 * Canonical Composition
	 * @link http://www.php.net/manual/en/class.normalizer.php
	 */
	const FORM_C = "4";
	const NFC = 4;

	/**
	 * Normalization Form KC (NFKC) - Compatibility Decomposition, followed by
	 * Canonical Composition
	 * @link http://www.php.net/manual/en/class.normalizer.php
	 */
	const FORM_KC =  "5";
	const NFKC = 5;


	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Normalizes the input provided and returns the normalized string
	 * @link http://php.net/manual/en/normalizer.normalize.php
	 * @param string $input <p>The input string to normalize</p>
	 * @param string $form [optional] <p>One of the normalization forms.</p>
	 * @return string The normalized string or <b>NULL</b> if an error occurred.
	 */
	public static function normalize ($input, $form = Normalizer::FORM_C) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Checks if the provided string is already in the specified normalization form.
	 * @link http://php.net/manual/en/normalizer.isnormalized.php
	 * @param string $input <p>The input string to normalize</p>
	 * @param string $form [optional] <p>
	 * One of the normalization forms.
	 * </p>
	 * @return bool <b>TRUE</b> if normalized, <b>FALSE</b> otherwise or if there an error
	 */
	public static function isNormalized ($input, $form = Normalizer::FORM_C) {}

}

class Locale  {

	/**
	 * This is locale the data actually comes from.
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const ACTUAL_LOCALE = 0;

	/**
	 * This is the most specific locale supported by ICU.
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const VALID_LOCALE = 1;

	/**
	 * Used as locale parameter with the methods of the various locale affected classes,
	 * such as NumberFormatter. This constant would make the methods to use default
	 * locale.
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const DEFAULT_LOCALE = null;

	/**
	 * Language subtag
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const LANG_TAG = "language";

	/**
	 * Extended language subtag
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const EXTLANG_TAG = "extlang";

	/**
	 * Script subtag
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const SCRIPT_TAG = "script";

	/**
	 * Region subtag
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const REGION_TAG = "region";

	/**
	 * Variant subtag
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const VARIANT_TAG = "variant";

	/**
	 * Grandfathered Language subtag
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const GRANDFATHERED_LANG_TAG = "grandfathered";

	/**
	 * Private subtag
	 * @link http://php.net/manual/en/intl.locale-constants.php
	 */
	const PRIVATE_TAG = "private";


	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Gets the default locale value from the INTL global 'default_locale'
	 * @link http://php.net/manual/en/locale.getdefault.php
	 * @return string The current runtime locale
	 */
	public static function getDefault () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * sets the default runtime locale
	 * @link http://php.net/manual/en/locale.setdefault.php
	 * @param string $locale <p>
	 * Is a BCP 47 compliant language tag containing the
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public static function setDefault ($locale) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Gets the primary language for the input locale
	 * @link http://php.net/manual/en/locale.getprimarylanguage.php
	 * @param string $locale <p>
	 * The locale to extract the primary language code from
	 * </p>
	 * @return string The language code associated with the language or <b>NULL</b> in case of error.
	 */
	public static function getPrimaryLanguage ($locale) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Gets the script for the input locale
	 * @link http://php.net/manual/en/locale.getscript.php
	 * @param string $locale <p>
	 * The locale to extract the script code from
	 * </p>
	 * @return string The script subtag for the locale or <b>NULL</b> if not present
	 */
	public static function getScript ($locale) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Gets the region for the input locale
	 * @link http://php.net/manual/en/locale.getregion.php
	 * @param string $locale <p>
	 * The locale to extract the region code from
	 * </p>
	 * @return string The region subtag for the locale or <b>NULL</b> if not present
	 */
	public static function getRegion ($locale) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Gets the keywords for the input locale
	 * @link http://php.net/manual/en/locale.getkeywords.php
	 * @param string $locale <p>
	 * The locale to extract the keywords from
	 * </p>
	 * @return array Associative array containing the keyword-value pairs for this locale
	 */
	public static function getKeywords ($locale) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Returns an appropriately localized display name for script of the input locale
	 * @link http://php.net/manual/en/locale.getdisplayscript.php
	 * @param string $locale <p>
	 * The locale to return a display script for
	 * </p>
	 * @param string $in_locale [optional] <p>
	 * Optional format locale to use to display the script name
	 * </p>
	 * @return string Display name of the script for the $locale in the format appropriate for
	 * $in_locale.
	 */
	public static function getDisplayScript ($locale, $in_locale = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Returns an appropriately localized display name for region of the input locale
	 * @link http://php.net/manual/en/locale.getdisplayregion.php
	 * @param string $locale <p>
	 * The locale to return a display region for.
	 * </p>
	 * @param string $in_locale [optional] <p>
	 * Optional format locale to use to display the region name
	 * </p>
	 * @return string display name of the region for the $locale in the format appropriate for
	 * $in_locale.
	 */
	public static function getDisplayRegion ($locale, $in_locale = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Returns an appropriately localized display name for the input locale
	 * @link http://php.net/manual/en/locale.getdisplayname.php
	 * @param string $locale <p>
	 * The locale to return a display name for.
	 * </p>
	 * @param string $in_locale [optional] <p>optional format locale</p>
	 * @return string Display name of the locale in the format appropriate for $in_locale.
	 */
	public static function getDisplayName ($locale, $in_locale = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Returns an appropriately localized display name for language of the inputlocale
	 * @link http://php.net/manual/en/locale.getdisplaylanguage.php
	 * @param string $locale <p>
	 * The locale to return a display language for
	 * </p>
	 * @param string $in_locale [optional] <p>
	 * Optional format locale to use to display the language name
	 * </p>
	 * @return string display name of the language for the $locale in the format appropriate for
	 * $in_locale.
	 */
	public static function getDisplayLanguage ($locale, $in_locale = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Returns an appropriately localized display name for variants of the input locale
	 * @link http://php.net/manual/en/locale.getdisplayvariant.php
	 * @param string $locale <p>
	 * The locale to return a display variant for
	 * </p>
	 * @param string $in_locale [optional] <p>
	 * Optional format locale to use to display the variant name
	 * </p>
	 * @return string Display name of the variant for the $locale in the format appropriate for
	 * $in_locale.
	 */
	public static function getDisplayVariant ($locale, $in_locale = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Returns a correctly ordered and delimited locale ID
	 * @link http://php.net/manual/en/locale.composelocale.php
	 * @param array $subtags <p>
	 * an array containing a list of key-value pairs, where the keys identify
	 * the particular locale ID subtags, and the values are the associated
	 * subtag values.
	 * <p>
	 * The 'variant' and 'private' subtags can take maximum 15 values
	 * whereas 'extlang' can take maximum 3 values.e.g. Variants are allowed
	 * with the suffix ranging from 0-14. Hence the keys for the input array
	 * can be variant0, variant1, ...,variant14. In the returned locale id,
	 * the subtag is ordered by suffix resulting in variant0 followed by
	 * variant1 followed by variant2 and so on.
	 * </p>
	 * <p>
	 * The 'variant', 'private' and 'extlang' multiple values can be specified both
	 * as array under specific key (e.g. 'variant') and as multiple numbered keys
	 * (e.g. 'variant0', 'variant1', etc.).
	 * </p>
	 * </p>
	 * @return string The corresponding locale identifier.
	 */
	public static function composeLocale (array $subtags) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Returns a key-value array of locale ID subtag elements.
	 * @link http://php.net/manual/en/locale.parselocale.php
	 * @param string $locale <p>
	 * The locale to extract the subtag array from. Note: The 'variant' and
	 * 'private' subtags can take maximum 15 values whereas 'extlang' can take
	 * maximum 3 values.
	 * </p>
	 * @return array an array containing a list of key-value pairs, where the keys
	 * identify the particular locale ID subtags, and the values are the
	 * associated subtag values. The array will be ordered as the locale id
	 * subtags e.g. in the locale id if variants are '-varX-varY-varZ' then the
	 * returned array will have variant0=&gt;varX , variant1=&gt;varY ,
	 * variant2=&gt;varZ
	 */
	public static function parseLocale ($locale) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Gets the variants for the input locale
	 * @link http://php.net/manual/en/locale.getallvariants.php
	 * @param string $locale <p>
	 * The locale to extract the variants from
	 * </p>
	 * @return array The array containing the list of all variants subtag for the locale
	 * or <b>NULL</b> if not present
	 */
	public static function getAllVariants ($locale) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Checks if a language tag filter matches with locale
	 * @link http://php.net/manual/en/locale.filtermatches.php
	 * @param string $langtag <p>
	 * The language tag to check
	 * </p>
	 * @param string $locale <p>
	 * The language range to check against
	 * </p>
	 * @param bool $canonicalize [optional] <p>
	 * If true, the arguments will be converted to canonical form before
	 * matching.
	 * </p>
	 * @return bool <b>TRUE</b> if $locale matches $langtag <b>FALSE</b> otherwise.
	 */
	public static function filterMatches ($langtag, $locale, $canonicalize = false) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Searches the language tag list for the best match to the language
	 * @link http://php.net/manual/en/locale.lookup.php
	 * @param array $langtag <p>
	 * An array containing a list of language tags to compare to
	 * <i>locale</i>. Maximum 100 items allowed.
	 * </p>
	 * @param string $locale <p>
	 * The locale to use as the language range when matching.
	 * </p>
	 * @param bool $canonicalize [optional] <p>
	 * If true, the arguments will be converted to canonical form before
	 * matching.
	 * </p>
	 * @param string $default [optional] <p>
	 * The locale to use if no match is found.
	 * </p>
	 * @return string The closest matching language tag or default value.
	 */
	public static function lookup (array $langtag, $locale, $canonicalize = false, $default = null) {}

	/**
	 * @param $arg1
	 */
	public static function canonicalize ($arg1) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Tries to find out best available locale based on HTTP "Accept-Language" header
	 * @link http://php.net/manual/en/locale.acceptfromhttp.php
	 * @param string $header <p>
	 * The string containing the "Accept-Language" header according to format in RFC 2616.
	 * </p>
	 * @return string The corresponding locale identifier.
	 */
	public static function acceptFromHttp ($header) {}

}

class MessageFormatter  {

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Constructs a new Message Formatter
	 * @link http://php.net/manual/en/messageformatter.create.php
	 * @param string $locale <p>
	 * The locale to use when formatting arguments
	 * </p>
	 * @param string $pattern <p>
	 * The pattern string to stick arguments into.
	 * The pattern uses an 'apostrophe-friendly' syntax; it is run through
	 * umsg_autoQuoteApostrophe
	 * before being interpreted.
	 * </p>
	 */
	public function __construct ($locale, $pattern) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Constructs a new Message Formatter
	 * @link http://php.net/manual/en/messageformatter.create.php
	 * @param string $locale <p>
	 * The locale to use when formatting arguments
	 * </p>
	 * @param string $pattern <p>
	 * The pattern string to stick arguments into.
	 * The pattern uses an 'apostrophe-friendly' syntax; it is run through
	 * umsg_autoQuoteApostrophe
	 * before being interpreted.
	 * </p>
	 * @return MessageFormatter The formatter object
	 */
	public static function create ($locale, $pattern) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Format the message
	 * @link http://php.net/manual/en/messageformatter.format.php
	 * @param array $args <p>
	 * Arguments to insert into the format string
	 * </p>
	 * @return string The formatted string, or <b>FALSE</b> if an error occurred
	 */
	public function format (array $args) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Quick format message
	 * @link http://php.net/manual/en/messageformatter.formatmessage.php
	 * @param string $locale <p>
	 * The locale to use for formatting locale-dependent parts
	 * </p>
	 * @param string $pattern <p>
	 * The pattern string to insert things into.
	 * The pattern uses an 'apostrophe-friendly' syntax; it is run through
	 * umsg_autoQuoteApostrophe
	 * before being interpreted.
	 * </p>
	 * @param array $args <p>
	 * The array of values to insert into the format string
	 * </p>
	 * @return string The formatted pattern string or <b>FALSE</b> if an error occurred
	 */
	public static function formatMessage ($locale, $pattern, array $args) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Parse input string according to pattern
	 * @link http://php.net/manual/en/messageformatter.parse.php
	 * @param string $value <p>
	 * The string to parse
	 * </p>
	 * @return array An array containing the items extracted, or <b>FALSE</b> on error
	 */
	public function parse ($value) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Quick parse input string
	 * @link http://php.net/manual/en/messageformatter.parsemessage.php
	 * @param string $locale <p>
	 * The locale to use for parsing locale-dependent parts
	 * </p>
	 * @param string $pattern <p>
	 * The pattern with which to parse the <i>value</i>.
	 * </p>
	 * @param string $source <p>
	 * The string to parse, conforming to the <i>pattern</i>.
	 * </p>
	 * @return array An array containing items extracted, or <b>FALSE</b> on error
	 */
	public static function parseMessage ($locale, $pattern, $source) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Set the pattern used by the formatter
	 * @link http://php.net/manual/en/messageformatter.setpattern.php
	 * @param string $pattern <p>
	 * The pattern string to use in this message formatter.
	 * The pattern uses an 'apostrophe-friendly' syntax; it is run through
	 * umsg_autoQuoteApostrophe
	 * before being interpreted.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setPattern ($pattern) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the pattern used by the formatter
	 * @link http://php.net/manual/en/messageformatter.getpattern.php
	 * @return string The pattern string for this message formatter
	 */
	public function getPattern () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the locale for which the formatter was created.
	 * @link http://php.net/manual/en/messageformatter.getlocale.php
	 * @return string The locale name
	 */
	public function getLocale () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the error code from last operation
	 * @link http://php.net/manual/en/messageformatter.geterrorcode.php
	 * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
	 */
	public function getErrorCode () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the error text from the last operation
	 * @link http://php.net/manual/en/messageformatter.geterrormessage.php
	 * @return string Description of the last error.
	 */
	public function getErrorMessage () {}

}

class IntlDateFormatter  {

	/**
	 * Completely specified style (Tuesday, April 12, 1952 AD or 3:30:42pm PST)
	 * @link http://php.net/manual/en/intl.intldateformatter-constants.php
	 */
	const FULL = 0;

	/**
	 * Long style (January 12, 1952 or 3:30:32pm)
	 * @link http://php.net/manual/en/intl.intldateformatter-constants.php
	 */
	const LONG = 1;

	/**
	 * Medium style (Jan 12, 1952)
	 * @link http://php.net/manual/en/intl.intldateformatter-constants.php
	 */
	const MEDIUM = 2;

	/**
	 * Most abbreviated style, only essential data (12/13/52 or 3:30pm)
	 * @link http://php.net/manual/en/intl.intldateformatter-constants.php
	 */
	const SHORT = 3;

	/**
	 * Do not include this element
	 * @link http://php.net/manual/en/intl.intldateformatter-constants.php
	 */
	const NONE = -1;

	/**
	 * Gregorian Calendar
	 * @link http://php.net/manual/en/intl.intldateformatter-constants.php
	 */
	const GREGORIAN = 1;

	/**
	 * Non-Gregorian Calendar
	 * @link http://php.net/manual/en/intl.intldateformatter-constants.php
	 */
	const TRADITIONAL = 0;


	/**
	 * @param $locale
	 * @param $datetype
	 * @param $timetype
	 * @param $timezone [optional]
	 * @param $calendar [optional]
	 * @param $pattern [optional]
	 */
	public function __construct ($locale, $datetype, $timetype, $timezone, $calendar, $pattern) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Create a date formatter
	 * @link http://php.net/manual/en/intldateformatter.create.php
	 * @param string $locale <p>
	 * Locale to use when formatting or parsing.
	 * </p>
	 * @param int $datetype <p>
	 * Date type to use (<b>none</b>,
	 * <b>short</b>, <b>medium</b>,
	 * <b>long</b>, <b>full</b>).
	 * This is one of the
	 * IntlDateFormatter constants.
	 * </p>
	 * @param int $timetype <p>
	 * Time type to use (<b>none</b>,
	 * <b>short</b>, <b>medium</b>,
	 * <b>long</b>, <b>full</b>).
	 * This is one of the
	 * IntlDateFormatter constants.
	 * </p>
	 * @param string $timezone [optional] <p>
	 * Time zone ID, default is system default.
	 * </p>
	 * @param int $calendar [optional] <p>
	 * Calendar to use for formatting or parsing; default is Gregorian.
	 * This is one of the
	 * IntlDateFormatter calendar constants.
	 * </p>
	 * @param string $pattern [optional] <p>
	 * Optional pattern to use when formatting or parsing.
	 * Possible patterns are documented at http://userguide.icu-project.org/formatparse/datetime.
	 * </p>
	 * @return IntlDateFormatter
	 */
	public static function create ($locale, $datetype, $timetype, $timezone = null, $calendar = null, $pattern = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the datetype used for the IntlDateFormatter
	 * @link http://php.net/manual/en/intldateformatter.getdatetype.php
	 * @return int The current date type value of the formatter.
	 */
	public function getDateType () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the timetype used for the IntlDateFormatter
	 * @link http://php.net/manual/en/intldateformatter.gettimetype.php
	 * @return int The current date type value of the formatter.
	 */
	public function getTimeType () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the calendar used for the IntlDateFormatter
	 * @link http://php.net/manual/en/intldateformatter.getcalendar.php
	 * @return int The calendar being used by the formatter.
	 */
	public function getCalendar () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * sets the calendar used to the appropriate calendar, which must be
	 * @link http://php.net/manual/en/intldateformatter.setcalendar.php
	 * @param int $which <p>
	 * The calendar to use.
	 * Default is <b>IntlDateFormatter::GREGORIAN</b>.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setCalendar ($which) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the timezone-id used for the IntlDateFormatter
	 * @link http://php.net/manual/en/intldateformatter.gettimezoneid.php
	 * @return string ID string for the time zone used by this formatter.
	 */
	public function getTimeZoneId () {}

    /**
     * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
     * Get copy of formatter's calendar object
     * @link http://www.php.net/manual/en/intldateformatter.getcalendarobject.php
     * @return IntlCalendar A copy of the internal calendar object used by this formatter.
     */
    public function getCalendarObject () {}

    /**
     * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
     *  Get formatter's timezone
     * @link http://www.php.net/manual/en/intldateformatter.gettimezone.php
     * @return IntlTimeZone|bool The associated IntlTimeZone object or FALSE on failure.
     */
    public function getTimeZone () {}

    /**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Sets the time zone to use
	 * @link http://php.net/manual/en/intldateformatter.settimezoneid.php
	 * @param string $zone <p>
	 * The time zone ID string of the time zone to use.
	 * If <b>NULL</b> or the empty string, the default time zone for the runtime is used.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @deprecated in 5.5 http://www.php.net/manual/en/migration55.deprecated.php
	 */
	public function setTimeZoneId ($zone) {}

    /**
     * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
     * Sets formatter's timezone
     * @link http://php.net/manual/en/intldateformatter.settimezone.php
     * @param mixed $zone <p>
     * The timezone to use for this formatter. This can be specified in the
     * following forms:
     * <ul>
     * <li>
     * <p>
     * <b>NULL</b>, in which case the default timezone will be used, as specified in
     * the ini setting {@link "http://php.net/manual/en/datetime.configuration.php#ini.date.timezone" date.timezone} or
     * through the function  {@link "http://php.net/manual/en/function.date-default-timezone-set.php" date_default_timezone_set()} and as
     * returned by {@link "http://php.net/manual/en/function.date-default-timezone-get.php" date_default_timezone_get()}.
     * </p>
     * </li>
     * <li>
     * <p>
     * An {@link "http://php.net/manual/en/class.intltimezone.php" IntlTimeZone}, which will be used directly.
     * </p>
     * </li>
     * <li>
     * <p>
     * A {@link "http://php.net/manual/en/class.datetimezone.php" DateTimeZone}. Its identifier will be extracted
     * and an ICU timezone object will be created; the timezone will be backed
     * by ICU's database, not PHP's.
     * </p>
     * </li>
     *<li>
     * <p>
     * A {@link "http://php.net/manual/en/language.types.string.php" string}, which should be a valid ICU timezone identifier.
     * See <b>IntlTimeZone::createTimeZoneIDEnumeration()</b>. Raw offsets such as <em>"GMT+08:30"</em> are also accepted.
     * </p>
     * </li>
     * </ul>
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setTimezone ($zone) {}

    /**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Set the pattern used for the IntlDateFormatter
	 * @link http://php.net/manual/en/intldateformatter.setpattern.php
	 * @param string $pattern <p>
	 * New pattern string to use.
	 * Possible patterns are documented at http://userguide.icu-project.org/formatparse/datetime.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * Bad formatstrings are usually the cause of the failure.
	 */
	public function setPattern ($pattern) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the pattern used for the IntlDateFormatter
	 * @link http://php.net/manual/en/intldateformatter.getpattern.php
	 * @return string The pattern string being used to format/parse.
	 */
	public function getPattern () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the locale used by formatter
	 * @link http://php.net/manual/en/intldateformatter.getlocale.php
	 * @param int $which [optional]
	 * @return string the locale of this formatter or 'false' if error
	 */
	public function getLocale ($which = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Set the leniency of the parser
	 * @link http://php.net/manual/en/intldateformatter.setlenient.php
	 * @param bool $lenient <p>
	 * Sets whether the parser is lenient or not, default is <b>TRUE</b> (lenient).
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setLenient ($lenient) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the lenient used for the IntlDateFormatter
	 * @link http://php.net/manual/en/intldateformatter.islenient.php
	 * @return bool <b>TRUE</b> if parser is lenient, <b>FALSE</b> if parser is strict. By default the parser is lenient.
	 */
	public function isLenient () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Format the date/time value as a string
	 * @link http://php.net/manual/en/intldateformatter.format.php
	 * @param mixed $value <p>
	 * Value to format. This may be a <b>DateTime</b> object,
	 * an integer representing a Unix timestamp value (seconds
	 * since epoch, UTC) or an array in the format output by
	 * <b>localtime</b>.
	 * </p>
	 * @return string The formatted string or, if an error occurred, <b>FALSE</b>.
	 */
	public function format ($value) {}

    /**
     * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
     * Formats an object
     * @link http://www.php.net/manual/en/intldateformatter.formatobject.php
     * @param object $object <p>
     * An object of type {@link "http://www.php.net/manual/en/class.intlcalendar.php" IntlCalendar} or {@link "http://www.php.net/manual/en/class.datetime.php" DateTime}. The timezone information in the object will be used.
     * </p>
     * @param mixed $format [optional] <p>
     * How to format the date/time. This can either be an {@link "http://www.php.net/manual/en/language.types.array.php" array} with
     * two elements (first the date style, then the time style, these being one
     * of the constants <b>IntlDateFormatter::NONE</b>,
     * <b>IntlDateFormatter::SHORT</b>,
     * <b>IntlDateFormatter::MEDIUM</b>,
     * <b>IntlDateFormatter::LONG</b>,
     * <b>IntlDateFormatter::FULL</b>), a long with
     * the value of one of these constants (in which case it will be used both
     * for the time and the date) or a {@link "http://www.php.net/manual/en/language.types.string.php" string} with the format
     * described in {@link "http://www.icu-project.org/apiref/icu4c/classSimpleDateFormat.html#details" the ICU
     * documentation}. If <br>NULL</br>, the default style will be used.
     * </p>
     * @param string $locale [optional] <p>
     * The locale to use, or <b>NULL</b> to use the {@link "http://www.php.net/manual/en/intl.configuration.php#ini.intl.default-locale"default one}.</p>
     * @return string A string with result or <b>FALSE</b> on failure.
     */
    public function formatObject($object, $format = NULL, $locale = NULL) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Parse string to a timestamp value
	 * @link http://php.net/manual/en/intldateformatter.parse.php
	 * @param string $value <p>
	 * string to convert to a time
	 * </p>
	 * @param int $position [optional] <p>
	 * Position at which to start the parsing in $value (zero-based).
	 * If no error occurs before $value is consumed, $parse_pos will contain -1
	 * otherwise it will contain the position at which parsing ended (and the error occurred).
	 * This variable will contain the end position if the parse fails.
	 * If $parse_pos > strlen($value), the parse fails immediately.
	 * </p>
	 * @return int timestamp parsed value
	 */
	public function parse ($value, &$position = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Parse string to a field-based time value
	 * @link http://php.net/manual/en/intldateformatter.localtime.php
	 * @param string $value <p>
	 * string to convert to a time
	 * </p>
	 * @param int $position [optional] <p>
	 * Position at which to start the parsing in $value (zero-based).
	 * If no error occurs before $value is consumed, $parse_pos will contain -1
	 * otherwise it will contain the position at which parsing ended .
	 * If $parse_pos > strlen($value), the parse fails immediately.
	 * </p>
	 * @return array Localtime compatible array of integers : contains 24 hour clock value in tm_hour field
	 */
	public function localtime ($value, &$position = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the error code from last operation
	 * @link http://php.net/manual/en/intldateformatter.geterrorcode.php
	 * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
	 */
	public function getErrorCode () {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
	 * Get the error text from the last operation.
	 * @link http://php.net/manual/en/intldateformatter.geterrormessage.php
	 * @return string Description of the last error.
	 */
	public function getErrorMessage () {}

}

class ResourceBundle implements Traversable {

	/**
	 * @param $locale
	 * @param $bundlename
	 * @param $fallback [optional]
	 */
	public function __construct ($locale, $bundlename, $fallback) {}

	/**
	 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
	 * Create a resource bundle
	 * @link http://php.net/manual/en/resourcebundle.create.php
	 * @param string $locale <p>
	 * Locale for which the resources should be loaded (locale name, e.g. en_CA).
	 * </p>
	 * @param string $bundlename <p>
	 * The directory where the data is stored or the name of the .dat file.
	 * </p>
	 * @param bool $fallback [optional] <p>
	 * Whether locale should match exactly or fallback to parent locale is allowed.
	 * </p>
	 * @return ResourceBundle <b>ResourceBundle</b> object or <b>FALSE</b> on error.
	 */
	public static function create ($locale, $bundlename, $fallback = null) {}

	/**
	 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
	 * Get data from the bundle
	 * @link http://php.net/manual/en/resourcebundle.get.php
	 * @param string|int $index <p>
	 * Data index, must be string or integer.
	 * </p>
	 * @return mixed the data located at the index or <b>NULL</b> on error. Strings, integers and binary data strings
	 * are returned as corresponding PHP types, integer array is returned as PHP array. Complex types are
	 * returned as <b>ResourceBundle</b> object.
	 */
	public function get ($index) {}

	/**
	 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
	 * Get number of elements in the bundle
	 * @link http://php.net/manual/en/resourcebundle.count.php
	 * @return int number of elements in the bundle.
	 */
	public function count () {}

	/**
	 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
	 * Get supported locales
	 * @link http://php.net/manual/en/resourcebundle.locales.php
	 * @param string $bundlename <p>
	 * Path of ResourceBundle for which to get available locales, or
	 * empty string for default locales list.
	 * </p>
	 * @return array the list of locales supported by the bundle.
	 */
	public static function getLocales ($bundlename) {}

	/**
	 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
	 * Get bundle's last error code.
	 * @link http://php.net/manual/en/resourcebundle.geterrorcode.php
	 * @return int error code from last bundle object call.
	 */
	public function getErrorCode () {}

	/**
	 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
	 * Get bundle's last error message.
	 * @link http://php.net/manual/en/resourcebundle.geterrormessage.php
	 * @return string error message from last bundle object's call.
	 */
	public function getErrorMessage () {}

}

class Transliterator  {
	const FORWARD = 0;
	const REVERSE = 1;

	public $id;


	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Private constructor to deny instantiation
	 * @link http://php.net/manual/en/transliterator.construct.php
	 */
	final private function __construct () {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Create a transliterator
	 * @link http://php.net/manual/en/transliterator.create.php
	 * @param string $id <p>
	 * The id.
	 * </p>
	 * @param int $direction [optional] <p>
	 * The direction, defaults to
	 * >Transliterator::FORWARD.
	 * May also be set to
	 * Transliterator::REVERSE.
	 * </p>
	 * @return Transliterator a <b>Transliterator</b> object on success,
	 * or <b>NULL</b> on failure.
	 */
	public static function create ($id, $direction = null) {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Create transliterator from rules
	 * @link http://php.net/manual/en/transliterator.createfromrules.php
	 * @param string $rules <p>
	 * The rules.
	 * </p>
	 * @param string $direction [optional] <p>
	 * The direction, defaults to
	 * >Transliterator::FORWARD.
	 * May also be set to
	 * Transliterator::REVERSE.
	 * </p>
	 * @return Transliterator a <b>Transliterator</b> object on success,
	 * or <b>NULL</b> on failure.
	 */
	public static function createFromRules ($rules, $direction = null) {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Create an inverse transliterator
	 * @link http://php.net/manual/en/transliterator.createinverse.php
	 * @return Transliterator a <b>Transliterator</b> object on success,
	 * or <b>NULL</b> on failure
	 */
	public function createInverse () {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Get transliterator IDs
	 * @link http://php.net/manual/en/transliterator.listids.php
	 * @return array An array of registered transliterator IDs on success,
	 * or <b>FALSE</b> on failure.
	 */
	public static function listIDs () {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Transliterate a string
	 * @link http://php.net/manual/en/transliterator.transliterate.php
	 * @param string $subject <p>
	 * The string to be transformed.
	 * </p>
	 * @param int $start [optional] <p>
	 * The start index (in UTF-16 code units) from which the string will start
	 * to be transformed, inclusive. Indexing starts at 0. The text before will
	 * be left as is.
	 * </p>
	 * @param int $end [optional] <p>
	 * The end index (in UTF-16 code units) until which the string will be
	 * transformed, exclusive. Indexing starts at 0. The text after will be
	 * left as is.
	 * </p>
	 * @return string The transfomed string on success, or <b>FALSE</b> on failure.
	 */
	public function transliterate ($subject, $start = null, $end = null) {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Get last error code
	 * @link http://php.net/manual/en/transliterator.geterrorcode.php
	 * @return int The error code on success,
	 * or <b>FALSE</b> if none exists, or on failure.
	 */
	public function getErrorCode () {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Get last error message
	 * @link http://php.net/manual/en/transliterator.geterrormessage.php
	 * @return string The error code on success,
	 * or <b>FALSE</b> if none exists, or on failure.
	 */
	public function getErrorMessage () {}

}

/**
 * @link http://php.net/manual/en/class.spoofchecker.php
 */
class Spoofchecker  {
	const SINGLE_SCRIPT_CONFUSABLE = 1;
	const MIXED_SCRIPT_CONFUSABLE = 2;
	const WHOLE_SCRIPT_CONFUSABLE = 4;
	const ANY_CASE = 8;
	const SINGLE_SCRIPT = 16;
	const INVISIBLE = 32;
	const CHAR_LIMIT = 64;


	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Constructor
	 * @link http://php.net/manual/en/spoofchecker.construct.php
	 */
	public function __construct () {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Checks if a given text contains any suspicious characters
	 * @link http://php.net/manual/en/spoofchecker.issuspicious.php
	 * @param string $text <p>
	 * </p>
	 * @param string $error [optional] <p>
	 * </p>
	 * @return bool
	 */
	public function isSuspicious ($text, &$error = null) {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Checks if a given text contains any confusable characters
	 * @link http://php.net/manual/en/spoofchecker.areconfusable.php
	 * @param string $s1 <p>
	 * </p>
	 * @param string $s2 <p>
	 * </p>
	 * @param string $error [optional] <p>
	 * </p>
	 * @return bool
	 */
	public function areConfusable ($s1, $s2, &$error = null) {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Locales to use when running checks
	 * @link http://php.net/manual/en/spoofchecker.setallowedlocales.php
	 * @param string $locale_list <p>
	 * </p>
	 * @return void
	 */
	public function setAllowedLocales ($locale_list) {}

	/**
	 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
	 * Set the checks to run
	 * @link http://php.net/manual/en/spoofchecker.setchecks.php
	 * @param string $checks <p>
	 * </p>
	 * @return void
	 */
	public function setChecks ($checks) {}

}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Create a collator
 * @link http://php.net/manual/en/collator.create.php
 * @param string $locale <p>
 * The locale containing the required collation rules. Special values for
 * locales can be passed in - if null is passed for the locale, the
 * default locale collation rules will be used. If empty string ("") or
 * "root" are passed, UCA rules will be used.
 * </p>
 * @return Collator Return new instance of <b>Collator</b> object, or <b>NULL</b>
 * on error.
 */
function collator_create ($locale) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Compare two Unicode strings
 * @link http://php.net/manual/en/collator.compare.php
 * @param Collator $object
 * @param string $str1 <p>
 * The first string to compare.
 * </p>
 * @param string $str2 <p>
 * The second string to compare.
 * </p>
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
function collator_compare (Collator $object, $str1, $str2) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get collation attribute value
 * @link http://php.net/manual/en/collator.getattribute.php
 * @param Collator $object
 * @param int $attr <p>
 * Attribute to get value for.
 * </p>
 * @return int Attribute value, or boolean <b>FALSE</b> on error.
 */
function collator_get_attribute (Collator $object, $attr) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set collation attribute
 * @link http://php.net/manual/en/collator.setattribute.php
 * @param Collator $object
 * @param int $attr <p>Attribute.</p>
 * @param int $val <p>
 * Attribute value.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_set_attribute (Collator $object, $attr, $val) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get current collation strength
 * @link http://php.net/manual/en/collator.getstrength.php
 * @param Collator $object
 * @return int current collation strength, or boolean <b>FALSE</b> on error.
 */
function collator_get_strength (Collator $object) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set collation strength
 * @link http://php.net/manual/en/collator.setstrength.php
 * @param Collator $object
 * @param int $strength <p>Strength to set.</p>
 * <p>
 * Possible values are:
 * <p>
 * <b>Collator::PRIMARY</b>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_set_strength (Collator $object, $strength) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Sort array using specified collator
 * @link http://php.net/manual/en/collator.sort.php
 * @param Collator $object
 * @param array $arr <p>
 * Array of strings to sort.
 * </p>
 * @param int $sort_flag [optional] <p>
 * Optional sorting type, one of the following:
 * </p>
 * <p>
 * <p>
 * <b>Collator::SORT_REGULAR</b>
 * - compare items normally (don't change types)
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_sort (Collator $object, array &$arr, $sort_flag = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Sort array using specified collator and sort keys
 * @link http://php.net/manual/en/collator.sortwithsortkeys.php
 * @param Collator $object
 * @param array $arr <p>Array of strings to sort</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_sort_with_sort_keys (Collator $object, array &$arr) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Sort array maintaining index association
 * @link http://php.net/manual/en/collator.asort.php
 * @param Collator $object
 * @param array $arr <p>Array of strings to sort.</p>
 * @param int $sort_flag [optional] <p>
 * Optional sorting type, one of the following:
 * <p>
 * <b>Collator::SORT_REGULAR</b>
 * - compare items normally (don't change types)
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_asort (Collator $object, array &$arr, $sort_flag = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the locale name of the collator
 * @link http://php.net/manual/en/collator.getlocale.php
 * @param Collator $object
 * @param int $type [optional] <p>
 * You can choose between valid and actual locale (
 * <b>Locale::VALID_LOCALE</b> and
 * <b>Locale::ACTUAL_LOCALE</b>,
 * respectively). The default is the actual locale.
 * </p>
 * @return string Real locale name from which the collation data comes. If the collator was
 * instantiated from rules or an error occurred, returns
 * boolean <b>FALSE</b>.
 */
function collator_get_locale (Collator $object, $type = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get collator's last error code
 * @link http://php.net/manual/en/collator.geterrorcode.php
 * @param Collator $object
 * @return int Error code returned by the last Collator API function call.
 */
function collator_get_error_code (Collator $object) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get text for collator's last error code
 * @link http://php.net/manual/en/collator.geterrormessage.php
 * @param Collator $object
 * @return string Description of an error occurred in the last Collator API function call.
 */
function collator_get_error_message (Collator $object) {}

/**
 * (No version information available, might only be in SVN)<br/>
 * Get sorting key for a string
 * @link http://php.net/manual/en/collator.getsortkey.php
 * @param Collator $object
 * @param string $str <p>
 * The string to produce the key from.
 * </p>
 * @return string the collation key for the string. Collation keys can be compared directly instead of strings.
 */
function collator_get_sort_key (Collator $object, $str) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Create a number formatter
 * @link http://php.net/manual/en/numberformatter.create.php
 * @param string $locale <p>
 * Locale in which the number would be formatted (locale name, e.g. en_CA).
 * </p>
 * @param int $style <p>
 * Style of the formatting, one of the
 * format style constants. If
 * <b>NumberFormatter::PATTERN_DECIMAL</b>
 * or <b>NumberFormatter::PATTERN_RULEBASED</b>
 * is passed then the number format is opened using the given pattern,
 * which must conform to the syntax described in
 * ICU DecimalFormat
 * documentation or
 * ICU RuleBasedNumberFormat
 * documentation, respectively.
 * </p>
 * @param string $pattern [optional] <p>
 * Pattern string if the chosen style requires a pattern.
 * </p>
 * @return NumberFormatter <b>NumberFormatter</b> object or <b>FALSE</b> on error.
 */
function numfmt_create ($locale, $style, $pattern = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Format a number
 * @link http://php.net/manual/en/numberformatter.format.php
 * @param NumberFormatter $fmt
 * @param number $value <p>
 * The value to format. Can be integer or float,
 * other values will be converted to a numeric value.
 * </p>
 * @param int $type [optional] <p>
 * The
 * formatting type to use.
 * </p>
 * @return string the string containing formatted value, or <b>FALSE</b> on error.
 */
function numfmt_format (NumberFormatter $fmt, $value, $type = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse a number
 * @link http://php.net/manual/en/numberformatter.parse.php
 * @param NumberFormatter $fmt
 * @param string $value
 * @param int $type [optional] <p>
 * The
 * formatting type to use. By default,
 * <b>NumberFormatter::TYPE_DOUBLE</b> is used.
 * </p>
 * @param int $position [optional] <p>
 * Offset in the string at which to begin parsing. On return, this value
 * will hold the offset at which parsing ended.
 * </p>
 * @return mixed The value of the parsed number or <b>FALSE</b> on error.
 */
function numfmt_parse (NumberFormatter $fmt, $value, $type = null, &$position = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Format a currency value
 * @link http://php.net/manual/en/numberformatter.formatcurrency.php
 * @param NumberFormatter $fmt
 * @param float $value <p>
 * The numeric currency value.
 * </p>
 * @param string $currency <p>
 * The 3-letter ISO 4217 currency code indicating the currency to use.
 * </p>
 * @return string String representing the formatted currency value.
 */
function numfmt_format_currency (NumberFormatter $fmt, $value, $currency) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse a currency number
 * @link http://php.net/manual/en/numberformatter.parsecurrency.php
 * @param NumberFormatter $fmt
 * @param string $value
 * @param string $currency <p>
 * Parameter to receive the currency name (3-letter ISO 4217 currency
 * code).
 * </p>
 * @param int $position [optional] <p>
 * Offset in the string at which to begin parsing. On return, this value
 * will hold the offset at which parsing ended.
 * </p>
 * @return float The parsed numeric value or <b>FALSE</b> on error.
 */
function numfmt_parse_currency (NumberFormatter $fmt, $value, &$currency, &$position = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set an attribute
 * @link http://php.net/manual/en/numberformatter.setattribute.php
 * @param NumberFormatter $fmt
 * @param int $attr <p>
 * Attribute specifier - one of the
 * numeric attribute constants.
 * </p>
 * @param int $value <p>
 * The attribute value.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_attribute (NumberFormatter $fmt, $attr, $value) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get an attribute
 * @link http://php.net/manual/en/numberformatter.getattribute.php
 * @param NumberFormatter $fmt
 * @param int $attr <p>
 * Attribute specifier - one of the
 * numeric attribute constants.
 * </p>
 * @return int Return attribute value on success, or <b>FALSE</b> on error.
 */
function numfmt_get_attribute (NumberFormatter $fmt, $attr) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set a text attribute
 * @link http://php.net/manual/en/numberformatter.settextattribute.php
 * @param NumberFormatter $fmt
 * @param int $attr <p>
 * Attribute specifier - one of the
 * text attribute
 * constants.
 * </p>
 * @param string $value <p>
 * Text for the attribute value.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_text_attribute (NumberFormatter $fmt, $attr, $value) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get a text attribute
 * @link http://php.net/manual/en/numberformatter.gettextattribute.php
 * @param NumberFormatter $fmt
 * @param int $attr <p>
 * Attribute specifier - one of the
 * text attribute constants.
 * </p>
 * @return string Return attribute value on success, or <b>FALSE</b> on error.
 */
function numfmt_get_text_attribute (NumberFormatter $fmt, $attr) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set a symbol value
 * @link http://php.net/manual/en/numberformatter.setsymbol.php
 * @param NumberFormatter $fmt
 * @param int $attr <p>
 * Symbol specifier, one of the
 * format symbol constants.
 * </p>
 * @param string $value <p>
 * Text for the symbol.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_symbol (NumberFormatter $fmt, $attr, $value) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get a symbol value
 * @link http://php.net/manual/en/numberformatter.getsymbol.php
 * @param NumberFormatter $fmt
 * @param int $attr <p>
 * Symbol specifier, one of the
 * format symbol constants.
 * </p>
 * @return string The symbol string or <b>FALSE</b> on error.
 */
function numfmt_get_symbol (NumberFormatter $fmt, $attr) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set formatter pattern
 * @link http://php.net/manual/en/numberformatter.setpattern.php
 * @param NumberFormatter $fmt
 * @param string $pattern <p>
 * Pattern in syntax described in
 * ICU DecimalFormat
 * documentation.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_pattern (NumberFormatter $fmt, $pattern) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get formatter pattern
 * @link http://php.net/manual/en/numberformatter.getpattern.php
 * @param NumberFormatter $fmt
 * @param $nf
 * @return string Pattern string that is used by the formatter, or <b>FALSE</b> if an error happens.
 */
function numfmt_get_pattern (NumberFormatter $fmt, $nf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get formatter locale
 * @link http://php.net/manual/en/numberformatter.getlocale.php
 * @param NumberFormatter $fmt
 * @param int $type [optional] <p>
 * You can choose between valid and actual locale (
 * <b>Locale::VALID_LOCALE</b>,
 * <b>Locale::ACTUAL_LOCALE</b>,
 * respectively). The default is the actual locale.
 * </p>
 * @return string The locale name used to create the formatter.
 */
function numfmt_get_locale (NumberFormatter $fmt, $type = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get formatter's last error code.
 * @link http://php.net/manual/en/numberformatter.geterrorcode.php
 * @param NumberFormatter $fmt
 * @param $nf
 * @return int error code from last formatter call.
 */
function numfmt_get_error_code (NumberFormatter $fmt, $nf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get formatter's last error message.
 * @link http://php.net/manual/en/numberformatter.geterrormessage.php
 * @param NumberFormatter $fmt
 * @param $nf
 * @return string error message from last formatter call.
 */
function numfmt_get_error_message (NumberFormatter $fmt, $nf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Normalizes the input provided and returns the normalized string
 * @link http://php.net/manual/en/normalizer.normalize.php
 * @param string $input <p>The input string to normalize</p>
 * @param string $form [optional] <p>One of the normalization forms.</p>
 * @return string The normalized string or <b>NULL</b> if an error occurred.
 */
function normalizer_normalize ($input, $form = Normalizer::FORM_C) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Checks if the provided string is already in the specified normalization
form.
 * @link http://php.net/manual/en/normalizer.isnormalized.php
 * @param string $input <p>The input string to normalize</p>
 * @param string $form [optional] <p>
 * One of the normalization forms.
 * </p>
 * @return bool <b>TRUE</b> if normalized, <b>FALSE</b> otherwise or if there an error
 */
function normalizer_is_normalized ($input, $form = Normalizer::FORM_C) {}

/**
 * Get the default Locale
 * @link http://php.net/manual/en/function.locale-get-default.php
 * @return string a string with the current Locale.
 */
function locale_get_default () {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set the default Locale
 * @link http://php.net/manual/en/function.locale-set-default.php
 * @param string $name <p>
 * The new Locale name. A comprehensive list of the supported locales is
 * available at .
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function locale_set_default ($name) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the primary language for the input locale
 * @link http://php.net/manual/en/locale.getprimarylanguage.php
 * @param string $locale <p>
 * The locale to extract the primary language code from
 * </p>
 * @return string The language code associated with the language or <b>NULL</b> in case of error.
 */
function locale_get_primary_language ($locale) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the script for the input locale
 * @link http://php.net/manual/en/locale.getscript.php
 * @param string $locale <p>
 * The locale to extract the script code from
 * </p>
 * @return string The script subtag for the locale or <b>NULL</b> if not present
 */
function locale_get_script ($locale) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the region for the input locale
 * @link http://php.net/manual/en/locale.getregion.php
 * @param string $locale <p>
 * The locale to extract the region code from
 * </p>
 * @return string The region subtag for the locale or <b>NULL</b> if not present
 */
function locale_get_region ($locale) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the keywords for the input locale
 * @link http://php.net/manual/en/locale.getkeywords.php
 * @param string $locale <p>
 * The locale to extract the keywords from
 * </p>
 * @return array Associative array containing the keyword-value pairs for this locale
 */
function locale_get_keywords ($locale) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for script of the input locale
 * @link http://php.net/manual/en/locale.getdisplayscript.php
 * @param string $locale <p>
 * The locale to return a display script for
 * </p>
 * @param string $in_locale [optional] <p>
 * Optional format locale to use to display the script name
 * </p>
 * @return string Display name of the script for the $locale in the format appropriate for
 * $in_locale.
 */
function locale_get_display_script ($locale, $in_locale = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for region of the input locale
 * @link http://php.net/manual/en/locale.getdisplayregion.php
 * @param string $locale <p>
 * The locale to return a display region for.
 * </p>
 * @param string $in_locale [optional] <p>
 * Optional format locale to use to display the region name
 * </p>
 * @return string display name of the region for the $locale in the format appropriate for
 * $in_locale.
 */
function locale_get_display_region ($locale, $in_locale = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for the input locale
 * @link http://php.net/manual/en/locale.getdisplayname.php
 * @param string $locale <p>
 * The locale to return a display name for.
 * </p>
 * @param string $in_locale [optional] <p>optional format locale</p>
 * @return string Display name of the locale in the format appropriate for $in_locale.
 */
function locale_get_display_name ($locale, $in_locale = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for language of the inputlocale
 * @link http://php.net/manual/en/locale.getdisplaylanguage.php
 * @param string $locale <p>
 * The locale to return a display language for
 * </p>
 * @param string $in_locale [optional] <p>
 * Optional format locale to use to display the language name
 * </p>
 * @return string display name of the language for the $locale in the format appropriate for
 * $in_locale.
 */
function locale_get_display_language ($locale, $in_locale = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns an appropriately localized display name for variants of the input locale
 * @link http://php.net/manual/en/locale.getdisplayvariant.php
 * @param string $locale <p>
 * The locale to return a display variant for
 * </p>
 * @param string $in_locale [optional] <p>
 * Optional format locale to use to display the variant name
 * </p>
 * @return string Display name of the variant for the $locale in the format appropriate for
 * $in_locale.
 */
function locale_get_display_variant ($locale, $in_locale = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns a correctly ordered and delimited locale ID
 * @link http://php.net/manual/en/locale.composelocale.php
 * @param array $subtags <p>
 * an array containing a list of key-value pairs, where the keys identify
 * the particular locale ID subtags, and the values are the associated
 * subtag values.
 * <p>
 * The 'variant' and 'private' subtags can take maximum 15 values
 * whereas 'extlang' can take maximum 3 values.e.g. Variants are allowed
 * with the suffix ranging from 0-14. Hence the keys for the input array
 * can be variant0, variant1, ...,variant14. In the returned locale id,
 * the subtag is ordered by suffix resulting in variant0 followed by
 * variant1 followed by variant2 and so on.
 * </p>
 * <p>
 * The 'variant', 'private' and 'extlang' multiple values can be specified both
 * as array under specific key (e.g. 'variant') and as multiple numbered keys
 * (e.g. 'variant0', 'variant1', etc.).
 * </p>
 * </p>
 * @return string The corresponding locale identifier.
 */
function locale_compose (array $subtags) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns a key-value array of locale ID subtag elements.
 * @link http://php.net/manual/en/locale.parselocale.php
 * @param string $locale <p>
 * The locale to extract the subtag array from. Note: The 'variant' and
 * 'private' subtags can take maximum 15 values whereas 'extlang' can take
 * maximum 3 values.
 * </p>
 * @return array an array containing a list of key-value pairs, where the keys
 * identify the particular locale ID subtags, and the values are the
 * associated subtag values. The array will be ordered as the locale id
 * subtags e.g. in the locale id if variants are '-varX-varY-varZ' then the
 * returned array will have variant0=&gt;varX , variant1=&gt;varY ,
 * variant2=&gt;varZ
 */
function locale_parse ($locale) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Gets the variants for the input locale
 * @link http://php.net/manual/en/locale.getallvariants.php
 * @param string $locale <p>
 * The locale to extract the variants from
 * </p>
 * @return array The array containing the list of all variants subtag for the locale
 * or <b>NULL</b> if not present
 */
function locale_get_all_variants ($locale) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Checks if a language tag filter matches with locale
 * @link http://php.net/manual/en/locale.filtermatches.php
 * @param string $langtag <p>
 * The language tag to check
 * </p>
 * @param string $locale <p>
 * The language range to check against
 * </p>
 * @param bool $canonicalize [optional] <p>
 * If true, the arguments will be converted to canonical form before
 * matching.
 * </p>
 * @return bool <b>TRUE</b> if $locale matches $langtag <b>FALSE</b> otherwise.
 */
function locale_filter_matches ($langtag, $locale, $canonicalize = false) {}

/**
 * @param $arg1
 */
function locale_canonicalize ($arg1) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Searches the language tag list for the best match to the language
 * @link http://php.net/manual/en/locale.lookup.php
 * @param array $langtag <p>
 * An array containing a list of language tags to compare to
 * <i>locale</i>. Maximum 100 items allowed.
 * </p>
 * @param string $locale <p>
 * The locale to use as the language range when matching.
 * </p>
 * @param bool $canonicalize [optional] <p>
 * If true, the arguments will be converted to canonical form before
 * matching.
 * </p>
 * @param string $default [optional] <p>
 * The locale to use if no match is found.
 * </p>
 * @return string The closest matching language tag or default value.
 */
function locale_lookup (array $langtag, $locale, $canonicalize = false, $default = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Tries to find out best available locale based on HTTP "Accept-Language" header
 * @link http://php.net/manual/en/locale.acceptfromhttp.php
 * @param string $header <p>
 * The string containing the "Accept-Language" header according to format in RFC 2616.
 * </p>
 * @return string The corresponding locale identifier.
 */
function locale_accept_from_http ($header) {}

/**
 * @param $locale
 * @param $pattern
 */
function msgfmt_create ($locale, $pattern) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Format the message
 * @link http://php.net/manual/en/messageformatter.format.php
 * @param MessageFormatter $fmt
 * @param array $args <p>
 * Arguments to insert into the format string
 * </p>
 * @return string The formatted string, or <b>FALSE</b> if an error occurred
 */
function msgfmt_format (MessageFormatter $fmt, array $args) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Quick format message
 * @link http://php.net/manual/en/messageformatter.formatmessage.php
 * @param MessageFormatter $fmt
 * @param string $locale <p>
 * The locale to use for formatting locale-dependent parts
 * </p>
 * @param string $pattern <p>
 * The pattern string to insert things into.
 * The pattern uses an 'apostrophe-friendly' syntax; it is run through
 * umsg_autoQuoteApostrophe
 * before being interpreted.
 * </p>
 * @param array $args <p>
 * The array of values to insert into the format string
 * </p>
 * @return string The formatted pattern string or <b>FALSE</b> if an error occurred
 */
function msgfmt_format_message (MessageFormatter $fmt, $locale, $pattern, array $args) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse input string according to pattern
 * @link http://php.net/manual/en/messageformatter.parse.php
 * @param MessageFormatter $fmt
 * @param string $value <p>
 * The string to parse
 * </p>
 * @return array An array containing the items extracted, or <b>FALSE</b> on error
 */
function msgfmt_parse (MessageFormatter $fmt, $value) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Quick parse input string
 * @link http://php.net/manual/en/messageformatter.parsemessage.php
 * @param MessageFormatter $fmt
 * @param string $locale <p>
 * The locale to use for parsing locale-dependent parts
 * </p>
 * @param string $pattern <p>
 * The pattern with which to parse the <i>value</i>.
 * </p>
 * @param string $source <p>
 * The string to parse, conforming to the <i>pattern</i>.
 * </p>
 * @return array An array containing items extracted, or <b>FALSE</b> on error
 */
function msgfmt_parse_message (MessageFormatter $fmt, $locale, $pattern, $source) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set the pattern used by the formatter
 * @link http://php.net/manual/en/messageformatter.setpattern.php
 * @param MessageFormatter $fmt
 * @param string $pattern <p>
 * The pattern string to use in this message formatter.
 * The pattern uses an 'apostrophe-friendly' syntax; it is run through
 * umsg_autoQuoteApostrophe
 * before being interpreted.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function msgfmt_set_pattern (MessageFormatter $fmt, $pattern) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the pattern used by the formatter
 * @link http://php.net/manual/en/messageformatter.getpattern.php
 * @param MessageFormatter $fmt
 * @param $mf
 * @return string The pattern string for this message formatter
 */
function msgfmt_get_pattern (MessageFormatter $fmt, $mf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the locale for which the formatter was created.
 * @link http://php.net/manual/en/messageformatter.getlocale.php
 * @param MessageFormatter $fmt
 * @param $mf
 * @return string The locale name
 */
function msgfmt_get_locale (MessageFormatter $fmt, $mf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the error code from last operation
 * @link http://php.net/manual/en/messageformatter.geterrorcode.php
 * @param MessageFormatter $fmt
 * @param $nf
 * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
 */
function msgfmt_get_error_code (MessageFormatter $fmt, $nf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the error text from the last operation
 * @link http://php.net/manual/en/messageformatter.geterrormessage.php
 * @param MessageFormatter $fmt
 * @param $coll
 * @return string Description of the last error.
 */
function msgfmt_get_error_message (MessageFormatter $fmt, $coll) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Create a date formatter
 * @link http://php.net/manual/en/intldateformatter.create.php
 * @param string $locale <p>
 * Locale to use when formatting or parsing.
 * </p>
 * @param int $datetype <p>
 * Date type to use (<b>none</b>,
 * <b>short</b>, <b>medium</b>,
 * <b>long</b>, <b>full</b>).
 * This is one of the
 * IntlDateFormatter constants.
 * </p>
 * @param int $timetype <p>
 * Time type to use (<b>none</b>,
 * <b>short</b>, <b>medium</b>,
 * <b>long</b>, <b>full</b>).
 * This is one of the
 * IntlDateFormatter constants.
 * </p>
 * @param string $timezone [optional] <p>
 * Time zone ID, default is system default.
 * </p>
 * @param int $calendar [optional] <p>
 * Calendar to use for formatting or parsing; default is Gregorian.
 * This is one of the
 * IntlDateFormatter calendar constants.
 * </p>
 * @param string $pattern [optional] <p>
 * Optional pattern to use when formatting or parsing.
 * Possible patterns are documented at http://userguide.icu-project.org/formatparse/datetime.
 * </p>
 * @return IntlDateFormatter
 */
function datefmt_create ($locale, $datetype, $timetype, $timezone = null, $calendar = null, $pattern = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the datetype used for the IntlDateFormatter
 * @link http://php.net/manual/en/intldateformatter.getdatetype.php
 * @param $mf
 * @return int The current date type value of the formatter.
 */
function datefmt_get_datetype (MessageFormatter $mf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the timetype used for the IntlDateFormatter
 * @link http://php.net/manual/en/intldateformatter.gettimetype.php
 * @param $mf
 * @return int The current date type value of the formatter.
 */
function datefmt_get_timetype (MessageFormatter $mf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the calendar used for the IntlDateFormatter
 * @link http://php.net/manual/en/intldateformatter.getcalendar.php
 * @param $mf
 * @return int The calendar being used by the formatter.
 */
function datefmt_get_calendar (MessageFormatter $mf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * sets the calendar used to the appropriate calendar, which must be
 * @link http://php.net/manual/en/intldateformatter.setcalendar.php
 * @param MessageFormatter $mf
 * @param int $which <p>
 * The calendar to use.
 * Default is <b>IntlDateFormatter::GREGORIAN</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function datefmt_set_calendar (MessageFormatter $mf, $which) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the locale used by formatter
 * @link http://php.net/manual/en/intldateformatter.getlocale.php
 * @param MessageFormatter $mf
 * @param int $which [optional]
 * @return string the locale of this formatter or 'false' if error
 */
function datefmt_get_locale (MessageFormatter $mf, $which = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the timezone-id used for the IntlDateFormatter
 * @link http://php.net/manual/en/intldateformatter.gettimezoneid.php
 * @param $mf
 * @return string ID string for the time zone used by this formatter.
 */
function datefmt_get_timezone_id (MessageFormatter $mf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 3.0.0)<br/>
 * Get copy of formatter's calendar object
 * @link http://www.php.net/manual/en/intldateformatter.getcalendarobject.php
 * @return IntlCalendar A copy of the internal calendar object used by this formatter.
 */
function datefmt_get_calendar_object() {}

/**
 * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
 *  Get formatter's timezone
 * @link http://www.php.net/manual/en/intldateformatter.gettimezone.php
 * @return IntlTimeZone|bool The associated IntlTimeZone object or FALSE on failure.
 */
function datefmt_get_timezone() {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Sets the time zone to use
 * @link http://php.net/manual/en/intldateformatter.settimezoneid.php
 * @param MessageFormatter $mf
 * @param string $zone <p>
 * The time zone ID string of the time zone to use.
 * If <b>NULL</b> or the empty string, the default time zone for the runtime is used.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @deprecated in 5.5 http://www.php.net/manual/en/migration55.deprecated.php
 */
function datefmt_set_timezone_id (MessageFormatter $mf, $zone) {}

/**
 * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
 * Sets formatter's timezone
 * @link http://php.net/manual/en/intldateformatter.settimezone.php
 * @param mixed $zone <p>
 * The timezone to use for this formatter. This can be specified in the
 * following forms:
 * <ul>
 * <li>
 * <p>
 * <b>NULL</b>, in which case the default timezone will be used, as specified in
 * the ini setting {@link "http://php.net/manual/en/datetime.configuration.php#ini.date.timezone" date.timezone} or
 * through the function  {@link "http://php.net/manual/en/function.date-default-timezone-set.php" date_default_timezone_set()} and as
 * returned by {@link "http://php.net/manual/en/function.date-default-timezone-get.php" date_default_timezone_get()}.
 * </p>
 * </li>
 * <li>
 * <p>
 * An {@link "http://php.net/manual/en/class.intltimezone.php" IntlTimeZone}, which will be used directly.
 * </p>
 * </li>
 * <li>
 * <p>
 * A {@link "http://php.net/manual/en/class.datetimezone.php" DateTimeZone}. Its identifier will be extracted
 * and an ICU timezone object will be created; the timezone will be backed
 * by ICU's database, not PHP's.
 * </p>
 * </li>
 * <li>
 * <p>
 * A {@link "http://php.net/manual/en/language.types.string.php" string}, which should be a valid ICU timezone identifier.
 * See <b>IntlTimeZone::createTimeZoneIDEnumeration()</b>. Raw offsets such as <em>"GMT+08:30"</em> are also accepted.
 * </p>
 * </li>
 * </ul>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function datefmt_set_timezone ($zone) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the pattern used for the IntlDateFormatter
 * @link http://php.net/manual/en/intldateformatter.getpattern.php
 * @param $mf
 * @return string The pattern string being used to format/parse.
 */
function datefmt_get_pattern (MessageFormatter $mf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set the pattern used for the IntlDateFormatter
 * @link http://php.net/manual/en/intldateformatter.setpattern.php
 * @param MessageFormatter $mf
 * @param string $pattern <p>
 * New pattern string to use.
 * Possible patterns are documented at http://userguide.icu-project.org/formatparse/datetime.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * Bad formatstrings are usually the cause of the failure.
 */
function datefmt_set_pattern (MessageFormatter $mf, $pattern) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the lenient used for the IntlDateFormatter
 * @link http://php.net/manual/en/intldateformatter.islenient.php
 * @param $mf
 * @return bool <b>TRUE</b> if parser is lenient, <b>FALSE</b> if parser is strict. By default the parser is lenient.
 */
function datefmt_is_lenient (MessageFormatter $mf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Set the leniency of the parser
 * @link http://php.net/manual/en/intldateformatter.setlenient.php
 * @param MessageFormatter $mf
 * @param bool $lenient <p>
 * Sets whether the parser is lenient or not, default is <b>TRUE</b> (lenient).
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function datefmt_set_lenient (MessageFormatter $mf, $lenient) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Format the date/time value as a string
 * @link http://php.net/manual/en/intldateformatter.format.php
 * @param MessageFormatter $mf
 * @param mixed $value <p>
 * Value to format. This may be a <b>DateTime</b> object,
 * an integer representing a Unix timestamp value (seconds
 * since epoch, UTC) or an array in the format output by
 * <b>localtime</b>.
 * </p>
 * @return string The formatted string or, if an error occurred, <b>FALSE</b>.
 */
function datefmt_format (MessageFormatter $mf, $value) {}

/**
 * (PHP 5 &gt;= 5.5.0, PECL intl &gt;= 3.0.0)<br/>
 * Formats an object
 * @link http://www.php.net/manual/en/intldateformatter.formatobject.php
 * @param object $object <p>
 * An object of type IntlCalendar or DateTime. The timezone information in the object will be used.
 * </p>
 * @param mixed $format [optional] <p>
 * How to format the date/time. This can either be an {http://www.php.net/manual/en/language.types.array.php array}  with
 * two elements (first the date style, then the time style, these being one
 * of the constants <b>IntlDateFormatter::NONE</b>,
 * <b>IntlDateFormatter::SHORT</b>,
 * <b>IntlDateFormatter::MEDIUM</b>,
 * <b>IntlDateFormatter::LONG</b>,
 * <b>IntlDateFormatter::FULL</b>), a long with
 * the value of one of these constants (in which case it will be used both
 * for the time and the date) or a {@link http://www.php.net/manual/en/language.types.string.php} with the format
 * described in {@link http://www.icu-project.org/apiref/icu4c/classSimpleDateFormat.html#details the ICU}
 * documentation. If <b>NULL</b>, the default style will be used.
 * </p>
 * @param string $locale [optional] <p>
 * The locale to use, or NULL to use the default one.</p>
 * @return string The formatted string or, if an error occurred, <b>FALSE</b>.
 */
 function datefmt_format_object($object, $format = NULL, $locale = NULL) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse string to a timestamp value
 * @link http://php.net/manual/en/intldateformatter.parse.php
 * @param MessageFormatter $mf
 * @param string $value <p>
 * string to convert to a time
 * </p>
 * @param int $position [optional] <p>
 * Position at which to start the parsing in $value (zero-based).
 * If no error occurs before $value is consumed, $parse_pos will contain -1
 * otherwise it will contain the position at which parsing ended (and the error occurred).
 * This variable will contain the end position if the parse fails.
 * If $parse_pos > strlen($value), the parse fails immediately.
 * </p>
 * @return int timestamp parsed value
 */
function datefmt_parse (MessageFormatter $mf, $value, &$position = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Parse string to a field-based time value
 * @link http://php.net/manual/en/intldateformatter.localtime.php
 * @param MessageFormatter $mf
 * @param string $value <p>
 * string to convert to a time
 * </p>
 * @param int $position [optional] <p>
 * Position at which to start the parsing in $value (zero-based).
 * If no error occurs before $value is consumed, $parse_pos will contain -1
 * otherwise it will contain the position at which parsing ended .
 * If $parse_pos > strlen($value), the parse fails immediately.
 * </p>
 * @return array Localtime compatible array of integers : contains 24 hour clock value in tm_hour field
 */
function datefmt_localtime (MessageFormatter $mf, $value, &$position = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the error code from last operation
 * @link http://php.net/manual/en/intldateformatter.geterrorcode.php
 * @param MessageFormatter $mf
 * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
 */
function datefmt_get_error_code (MessageFormatter $mf) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the error text from the last operation.
 * @link http://php.net/manual/en/intldateformatter.geterrormessage.php
 * @param MessageFormatter $mf
 * @param $coll
 * @return string Description of the last error.
 */
function datefmt_get_error_message (MessageFormatter $mf, $coll) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get string length in grapheme units
 * @link http://php.net/manual/en/function.grapheme-strlen.php
 * @param string $input <p>
 * The string being measured for length. It must be a valid UTF-8 string.
 * </p>
 * @return int The length of the string on success, and 0 if the string is empty.
 */
function grapheme_strlen ($input) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Find position (in grapheme units) of first occurrence of a string
 * @link http://php.net/manual/en/function.grapheme-strpos.php
 * @param string $haystack <p>
 * The string to look in. Must be valid UTF-8.
 * </p>
 * @param string $needle <p>
 * The string to look for. Must be valid UTF-8.
 * </p>
 * @param int $offset [optional] <p>
 * The optional $offset parameter allows you to specify where in $haystack to
 * start searching as an offset in grapheme units (not bytes or characters).
 * The position returned is still relative to the beginning of haystack
 * regardless of the value of $offset.
 * </p>
 * @return int the position as an integer. If needle is not found, strpos() will return boolean FALSE.
 */
function grapheme_strpos ($haystack, $needle, $offset = 0) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Find position (in grapheme units) of first occurrence of a case-insensitive string
 * @link http://php.net/manual/en/function.grapheme-stripos.php
 * @param string $haystack <p>
 * The string to look in. Must be valid UTF-8.
 * </p>
 * @param string $needle <p>
 * The string to look for. Must be valid UTF-8.
 * </p>
 * @param int $offset [optional] <p>
 * The optional $offset parameter allows you to specify where in haystack to
 * start searching as an offset in grapheme units (not bytes or characters).
 * The position returned is still relative to the beginning of haystack
 * regardless of the value of $offset.
 * </p>
 * @return int the position as an integer. If needle is not found, grapheme_stripos() will return boolean FALSE.
 */
function grapheme_stripos ($haystack, $needle, $offset = 0) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Find position (in grapheme units) of last occurrence of a string
 * @link http://php.net/manual/en/function.grapheme-strrpos.php
 * @param string $haystack <p>
 * The string to look in. Must be valid UTF-8.
 * </p>
 * @param string $needle <p>
 * The string to look for. Must be valid UTF-8.
 * </p>
 * @param int $offset [optional] <p>
 * The optional $offset parameter allows you to specify where in $haystack to
 * start searching as an offset in grapheme units (not bytes or characters).
 * The position returned is still relative to the beginning of haystack
 * regardless of the value of $offset.
 * </p>
 * @return int the position as an integer. If needle is not found, grapheme_strrpos() will return boolean FALSE.
 */
function grapheme_strrpos ($haystack, $needle, $offset = 0) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Find position (in grapheme units) of last occurrence of a case-insensitive string
 * @link http://php.net/manual/en/function.grapheme-strripos.php
 * @param string $haystack <p>
 * The string to look in. Must be valid UTF-8.
 * </p>
 * @param string $needle <p>
 * The string to look for. Must be valid UTF-8.
 * </p>
 * @param int $offset [optional] <p>
 * The optional $offset parameter allows you to specify where in $haystack to
 * start searching as an offset in grapheme units (not bytes or characters).
 * The position returned is still relative to the beginning of haystack
 * regardless of the value of $offset.
 * </p>
 * @return int the position as an integer. If needle is not found, grapheme_strripos() will return boolean FALSE.
 */
function grapheme_strripos ($haystack, $needle, $offset = 0) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Return part of a string
 * @link http://php.net/manual/en/function.grapheme-substr.php
 * @param string $string <p>
 * The input string. Must be valid UTF-8.
 * </p>
 * @param int $start <p>
 * Start position in default grapheme units.
 * If $start is non-negative, the returned string will start at the
 * $start'th position in $string, counting from zero. If $start is negative,
 * the returned string will start at the $start'th grapheme unit from the
 * end of string.
 * </p>
 * @param int $length [optional] <p>
 * Length in grapheme units.
 * If $length is given and is positive, the string returned will contain
 * at most $length grapheme units beginning from $start (depending on the
 * length of string). If $length is given and is negative, then
 * that many grapheme units will be omitted from the end of string (after the
 * start position has been calculated when a start is negative). If $start
 * denotes a position beyond this truncation, <b>FALSE</b> will be returned.
 * </p>
 * @return int the extracted part of $string.
 */
function grapheme_substr ($string, $start, $length = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns part of haystack string from the first occurrence of needle to the end of haystack.
 * @link http://php.net/manual/en/function.grapheme-strstr.php
 * @param string $haystack <p>
 * The input string. Must be valid UTF-8.
 * </p>
 * @param string $needle <p>
 * The string to look for. Must be valid UTF-8.
 * </p>
 * @param bool $before_needle [optional] <p>
 * If <b>TRUE</b>, grapheme_strstr() returns the part of the
 * haystack before the first occurrence of the needle (excluding the needle).
 * </p>
 * @return string the portion of string, or FALSE if needle is not found.
 */
function grapheme_strstr ($haystack, $needle, $before_needle = false) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Returns part of haystack string from the first occurrence of case-insensitive needle to the end of haystack.
 * @link http://php.net/manual/en/function.grapheme-stristr.php
 * @param string $haystack <p>
 * The input string. Must be valid UTF-8.
 * </p>
 * @param string $needle <p>
 * The string to look for. Must be valid UTF-8.
 * </p>
 * @param bool $before_needle [optional] <p>
 * If <b>TRUE</b>, grapheme_strstr() returns the part of the
 * haystack before the first occurrence of the needle (excluding needle).
 * </p>
 * @return string the portion of $haystack, or FALSE if $needle is not found.
 */
function grapheme_stristr ($haystack, $needle, $before_needle = false) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Function to extract a sequence of default grapheme clusters from a text buffer, which must be encoded in UTF-8.
 * @link http://php.net/manual/en/function.grapheme-extract.php
 * @param string $haystack <p>
 * String to search.
 * </p>
 * @param int $size <p>
 * Maximum number items - based on the $extract_type - to return.
 * </p>
 * @param int $extract_type [optional] <p>
 * Defines the type of units referred to by the $size parameter:
 * </p>
 * <p>
 * GRAPHEME_EXTR_COUNT (default) - $size is the number of default
 * grapheme clusters to extract.
 * GRAPHEME_EXTR_MAXBYTES - $size is the maximum number of bytes
 * returned.
 * GRAPHEME_EXTR_MAXCHARS - $size is the maximum number of UTF-8
 * characters returned.
 * </p>
 * @param int $start [optional] <p>
 * Starting position in $haystack in bytes - if given, it must be zero or a
 * positive value that is less than or equal to the length of $haystack in
 * bytes. If $start does not point to the first byte of a UTF-8
 * character, the start position is moved to the next character boundary.
 * </p>
 * @param int $next [optional] <p>
 * Reference to a value that will be set to the next starting position.
 * When the call returns, this may point to the first byte position past the end of the string.
 * </p>
 * @return string A string starting at offset $start and ending on a default grapheme cluster
 * boundary that conforms to the $size and $extract_type specified.
 */
function grapheme_extract ($haystack, $size, $extract_type = null, $start = 0, &$next = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.2, PECL idn &gt;= 0.1)<br/>
 * Convert UTF-8 encoded domain name to ASCII
 * @link http://php.net/manual/en/function.idn-to-ascii.php
 * @param string $utf8_domain <p>
 * The UTF-8 encoded domain name.
 * <p>
 * If e.g. an ISO-8859-1 (aka Western Europe latin1) encoded string is
 * passed it will be converted into an ACE encoded "xn--" string.
 * It will not be the one you expected though!
 * </p>
 * @param int $errorcode [optional] <p>
 * Will be set to the IDNA error code.
 * </p>
 * @return string The ACE encoded version of the domain name or <b>FALSE</b> on failure.
 */
function idn_to_ascii ($utf8_domain, &$errorcode = null) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.2, PECL idn &gt;= 0.1)<br/>
 * Convert ASCII encoded domain name to UTF-8
 * @link http://php.net/manual/en/function.idn-to-utf8.php
 * @param string $ascii_domain <p>
 * The ASCII encoded domain name. Looks like "xn--..." if the it originally contained non-ASCII characters.
 * </p>
 * @param int $errorcode [optional] <p>
 * Will be set to the IDNA error code.
 * </p>
 * @return string The UTF-8 encoded version of the domain name or <b>FALSE</b> on failure.
 * RFC 3490 4.2 states though "ToUnicode never fails. If any step fails, then the original input
 * sequence is returned immediately in that step."
 */
function idn_to_utf8 ($ascii_domain, &$errorcode = null) {}

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Create a resource bundle
 * @link http://php.net/manual/en/resourcebundle.create.php
 * @param string $locale <p>
 * Locale for which the resources should be loaded (locale name, e.g. en_CA).
 * </p>
 * @param string $bundlename <p>
 * The directory where the data is stored or the name of the .dat file.
 * </p>
 * @param bool $fallback [optional] <p>
 * Whether locale should match exactly or fallback to parent locale is allowed.
 * </p>
 * @return ResourceBundle <b>ResourceBundle</b> object or <b>FALSE</b> on error.
 */
function resourcebundle_create ($locale, $bundlename, $fallback = null) {}

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get data from the bundle
 * @link http://php.net/manual/en/resourcebundle.get.php
 * @param ResourceBundle $r
 * @param string|int $index <p>
 * Data index, must be string or integer.
 * </p>
 * @return mixed the data located at the index or <b>NULL</b> on error. Strings, integers and binary data strings
 * are returned as corresponding PHP types, integer array is returned as PHP array. Complex types are
 * returned as <b>ResourceBundle</b> object.
 */
function resourcebundle_get (ResourceBundle $r, $index) {}

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get number of elements in the bundle
 * @link http://php.net/manual/en/resourcebundle.count.php
 * @param ResourceBundle $r
 * @param $bundle
 * @return int number of elements in the bundle.
 */
function resourcebundle_count (ResourceBundle $r, $bundle) {}

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get supported locales
 * @link http://php.net/manual/en/resourcebundle.locales.php
 * @param ResourceBundle $r
 * @param string $bundlename <p>
 * Path of ResourceBundle for which to get available locales, or
 * empty string for default locales list.
 * </p>
 * @return array the list of locales supported by the bundle.
 */
function resourcebundle_locales (ResourceBundle $r, $bundlename) {}

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get bundle's last error code.
 * @link http://php.net/manual/en/resourcebundle.geterrorcode.php
 * @param $bundle
 * @return int error code from last bundle object call.
 */
function resourcebundle_get_error_code (ResourceBundle $bundle) {}

/**
 * (PHP &gt;= 5.3.2, PECL intl &gt;= 2.0.0)<br/>
 * Get bundle's last error message.
 * @link http://php.net/manual/en/resourcebundle.geterrormessage.php
 * @param $bundle
 * @return string error message from last bundle object's call.
 */
function resourcebundle_get_error_message (ResourceBundle $bundle) {}

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Create a transliterator
 * @link http://php.net/manual/en/transliterator.create.php
 * @param string $id <p>
 * The id.
 * </p>
 * @param int $direction [optional] <p>
 * The direction, defaults to
 * >Transliterator::FORWARD.
 * May also be set to
 * Transliterator::REVERSE.
 * </p>
 * @return Transliterator a <b>Transliterator</b> object on success,
 * or <b>NULL</b> on failure.
 */
function transliterator_create ($id, $direction = null) {}

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Create transliterator from rules
 * @link http://php.net/manual/en/transliterator.createfromrules.php
 * @param string $rules <p>
 * The rules.
 * </p>
 * @param string $direction [optional] <p>
 * The direction, defaults to
 * >Transliterator::FORWARD.
 * May also be set to
 * Transliterator::REVERSE.
 * </p>
 * @return Transliterator a <b>Transliterator</b> object on success,
 * or <b>NULL</b> on failure.
 */
function transliterator_create_from_rules ($rules, $direction = null) {}

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Get transliterator IDs
 * @link http://php.net/manual/en/transliterator.listids.php
 * @return array An array of registered transliterator IDs on success,
 * or <b>FALSE</b> on failure.
 */
function transliterator_list_ids () {}

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Create an inverse transliterator
 * @link http://php.net/manual/en/transliterator.createinverse.php
 * @param Transliterator $orig_trans
 * @return Transliterator a <b>Transliterator</b> object on success,
 * or <b>NULL</b> on failure
 */
function transliterator_create_inverse (Transliterator $orig_trans) {}

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Transliterate a string
 * @link http://php.net/manual/en/transliterator.transliterate.php
 * @param Transliterator|string $transliterator
 * @param string $subject <p>
 * The string to be transformed.
 * </p>
 * @param int $start [optional] <p>
 * The start index (in UTF-16 code units) from which the string will start
 * to be transformed, inclusive. Indexing starts at 0. The text before will
 * be left as is.
 * </p>
 * @param int $end [optional] <p>
 * The end index (in UTF-16 code units) until which the string will be
 * transformed, exclusive. Indexing starts at 0. The text after will be
 * left as is.
 * </p>
 * @return string The transfomed string on success, or <b>FALSE</b> on failure.
 */
function transliterator_transliterate ($transliterator, $subject, $start = null, $end = null) {}

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Get last error code
 * @link http://php.net/manual/en/transliterator.geterrorcode.php
 * @param Transliterator $trans
 * @return int The error code on success,
 * or <b>FALSE</b> if none exists, or on failure.
 */
function transliterator_get_error_code (Transliterator $trans) {}

/**
 * (PHP &gt;= 5.4.0, PECL intl &gt;= 2.0.0)<br/>
 * Get last error message
 * @link http://php.net/manual/en/transliterator.geterrormessage.php
 * @param Transliterator $trans
 * @return string The error code on success,
 * or <b>FALSE</b> if none exists, or on failure.
 */
function transliterator_get_error_message (Transliterator $trans) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get the last error code
 * @link http://php.net/manual/en/function.intl-get-error-code.php
 * @return int Error code returned by the last API function call.
 */
function intl_get_error_code () {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get description of the last error
 * @link http://php.net/manual/en/function.intl-get-error-message.php
 * @return string Description of an error occurred in the last API function call.
 */
function intl_get_error_message () {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Check whether the given error code indicates failure
 * @link http://php.net/manual/en/function.intl-is-failure.php
 * @param int $error_code <p>
 * is a value that returned by functions:
 * <b>intl_get_error_code</b>,
 * <b>collator_get_error_code</b> .
 * </p>
 * @return bool <b>TRUE</b> if it the code indicates some failure, and <b>FALSE</b>
 * in case of success or a warning.
 */
function intl_is_failure ($error_code) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
 * Get symbolic name for a given error code
 * @link http://php.net/manual/en/function.intl-error-name.php
 * @param int $error_code <p>
 * ICU error code.
 * </p>
 * @return string The returned string will be the same as the name of the error code
 * constant.
 */
function intl_error_name ($error_code) {}


/**
 * Limit on locale length, set to 80 in PHP code. Locale names longer
 * than this limit will not be accepted.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('INTL_MAX_LOCALE_LEN', 80);
define ('INTL_ICU_VERSION', "4.8.1.1");
define ('INTL_ICU_DATA_VERSION', "4.8.1");
define ('ULOC_ACTUAL_LOCALE', 0);
define ('ULOC_VALID_LOCALE', 1);
define ('GRAPHEME_EXTR_COUNT', 0);
define ('GRAPHEME_EXTR_MAXBYTES', 1);
define ('GRAPHEME_EXTR_MAXCHARS', 2);
define ('U_USING_FALLBACK_WARNING', -128);
define ('U_ERROR_WARNING_START', -128);
define ('U_USING_DEFAULT_WARNING', -127);
define ('U_SAFECLONE_ALLOCATED_WARNING', -126);
define ('U_STATE_OLD_WARNING', -125);
define ('U_STRING_NOT_TERMINATED_WARNING', -124);
define ('U_SORT_KEY_TOO_SHORT_WARNING', -123);
define ('U_AMBIGUOUS_ALIAS_WARNING', -122);
define ('U_DIFFERENT_UCA_VERSION', -121);
define ('U_ERROR_WARNING_LIMIT', -119);
define ('U_ZERO_ERROR', 0);
define ('U_ILLEGAL_ARGUMENT_ERROR', 1);
define ('U_MISSING_RESOURCE_ERROR', 2);
define ('U_INVALID_FORMAT_ERROR', 3);
define ('U_FILE_ACCESS_ERROR', 4);
define ('U_INTERNAL_PROGRAM_ERROR', 5);
define ('U_MESSAGE_PARSE_ERROR', 6);
define ('U_MEMORY_ALLOCATION_ERROR', 7);
define ('U_INDEX_OUTOFBOUNDS_ERROR', 8);
define ('U_PARSE_ERROR', 9);
define ('U_INVALID_CHAR_FOUND', 10);
define ('U_TRUNCATED_CHAR_FOUND', 11);
define ('U_ILLEGAL_CHAR_FOUND', 12);
define ('U_INVALID_TABLE_FORMAT', 13);
define ('U_INVALID_TABLE_FILE', 14);
define ('U_BUFFER_OVERFLOW_ERROR', 15);
define ('U_UNSUPPORTED_ERROR', 16);
define ('U_RESOURCE_TYPE_MISMATCH', 17);
define ('U_ILLEGAL_ESCAPE_SEQUENCE', 18);
define ('U_UNSUPPORTED_ESCAPE_SEQUENCE', 19);
define ('U_NO_SPACE_AVAILABLE', 20);
define ('U_CE_NOT_FOUND_ERROR', 21);
define ('U_PRIMARY_TOO_LONG_ERROR', 22);
define ('U_STATE_TOO_OLD_ERROR', 23);
define ('U_TOO_MANY_ALIASES_ERROR', 24);
define ('U_ENUM_OUT_OF_SYNC_ERROR', 25);
define ('U_INVARIANT_CONVERSION_ERROR', 26);
define ('U_INVALID_STATE_ERROR', 27);
define ('U_COLLATOR_VERSION_MISMATCH', 28);
define ('U_USELESS_COLLATOR_ERROR', 29);
define ('U_NO_WRITE_PERMISSION', 30);
define ('U_STANDARD_ERROR_LIMIT', 31);
define ('U_BAD_VARIABLE_DEFINITION', 65536);
define ('U_PARSE_ERROR_START', 65536);
define ('U_MALFORMED_RULE', 65537);
define ('U_MALFORMED_SET', 65538);
define ('U_MALFORMED_SYMBOL_REFERENCE', 65539);
define ('U_MALFORMED_UNICODE_ESCAPE', 65540);
define ('U_MALFORMED_VARIABLE_DEFINITION', 65541);
define ('U_MALFORMED_VARIABLE_REFERENCE', 65542);
define ('U_MISMATCHED_SEGMENT_DELIMITERS', 65543);
define ('U_MISPLACED_ANCHOR_START', 65544);
define ('U_MISPLACED_CURSOR_OFFSET', 65545);
define ('U_MISPLACED_QUANTIFIER', 65546);
define ('U_MISSING_OPERATOR', 65547);
define ('U_MISSING_SEGMENT_CLOSE', 65548);
define ('U_MULTIPLE_ANTE_CONTEXTS', 65549);
define ('U_MULTIPLE_CURSORS', 65550);
define ('U_MULTIPLE_POST_CONTEXTS', 65551);
define ('U_TRAILING_BACKSLASH', 65552);
define ('U_UNDEFINED_SEGMENT_REFERENCE', 65553);
define ('U_UNDEFINED_VARIABLE', 65554);
define ('U_UNQUOTED_SPECIAL', 65555);
define ('U_UNTERMINATED_QUOTE', 65556);
define ('U_RULE_MASK_ERROR', 65557);
define ('U_MISPLACED_COMPOUND_FILTER', 65558);
define ('U_MULTIPLE_COMPOUND_FILTERS', 65559);
define ('U_INVALID_RBT_SYNTAX', 65560);
define ('U_INVALID_PROPERTY_PATTERN', 65561);
define ('U_MALFORMED_PRAGMA', 65562);
define ('U_UNCLOSED_SEGMENT', 65563);
define ('U_ILLEGAL_CHAR_IN_SEGMENT', 65564);
define ('U_VARIABLE_RANGE_EXHAUSTED', 65565);
define ('U_VARIABLE_RANGE_OVERLAP', 65566);
define ('U_ILLEGAL_CHARACTER', 65567);
define ('U_INTERNAL_TRANSLITERATOR_ERROR', 65568);
define ('U_INVALID_ID', 65569);
define ('U_INVALID_FUNCTION', 65570);
define ('U_PARSE_ERROR_LIMIT', 65571);
define ('U_UNEXPECTED_TOKEN', 65792);
define ('U_FMT_PARSE_ERROR_START', 65792);
define ('U_MULTIPLE_DECIMAL_SEPARATORS', 65793);
define ('U_MULTIPLE_DECIMAL_SEPERATORS', 65793);
define ('U_MULTIPLE_EXPONENTIAL_SYMBOLS', 65794);
define ('U_MALFORMED_EXPONENTIAL_PATTERN', 65795);
define ('U_MULTIPLE_PERCENT_SYMBOLS', 65796);
define ('U_MULTIPLE_PERMILL_SYMBOLS', 65797);
define ('U_MULTIPLE_PAD_SPECIFIERS', 65798);
define ('U_PATTERN_SYNTAX_ERROR', 65799);
define ('U_ILLEGAL_PAD_POSITION', 65800);
define ('U_UNMATCHED_BRACES', 65801);
define ('U_UNSUPPORTED_PROPERTY', 65802);
define ('U_UNSUPPORTED_ATTRIBUTE', 65803);
define ('U_FMT_PARSE_ERROR_LIMIT', 65810);
define ('U_BRK_INTERNAL_ERROR', 66048);
define ('U_BRK_ERROR_START', 66048);
define ('U_BRK_HEX_DIGITS_EXPECTED', 66049);
define ('U_BRK_SEMICOLON_EXPECTED', 66050);
define ('U_BRK_RULE_SYNTAX', 66051);
define ('U_BRK_UNCLOSED_SET', 66052);
define ('U_BRK_ASSIGN_ERROR', 66053);
define ('U_BRK_VARIABLE_REDFINITION', 66054);
define ('U_BRK_MISMATCHED_PAREN', 66055);
define ('U_BRK_NEW_LINE_IN_QUOTED_STRING', 66056);
define ('U_BRK_UNDEFINED_VARIABLE', 66057);
define ('U_BRK_INIT_ERROR', 66058);
define ('U_BRK_RULE_EMPTY_SET', 66059);
define ('U_BRK_UNRECOGNIZED_OPTION', 66060);
define ('U_BRK_MALFORMED_RULE_TAG', 66061);
define ('U_BRK_ERROR_LIMIT', 66062);
define ('U_REGEX_INTERNAL_ERROR', 66304);
define ('U_REGEX_ERROR_START', 66304);
define ('U_REGEX_RULE_SYNTAX', 66305);
define ('U_REGEX_INVALID_STATE', 66306);
define ('U_REGEX_BAD_ESCAPE_SEQUENCE', 66307);
define ('U_REGEX_PROPERTY_SYNTAX', 66308);
define ('U_REGEX_UNIMPLEMENTED', 66309);
define ('U_REGEX_MISMATCHED_PAREN', 66310);
define ('U_REGEX_NUMBER_TOO_BIG', 66311);
define ('U_REGEX_BAD_INTERVAL', 66312);
define ('U_REGEX_MAX_LT_MIN', 66313);
define ('U_REGEX_INVALID_BACK_REF', 66314);
define ('U_REGEX_INVALID_FLAG', 66315);
define ('U_REGEX_LOOK_BEHIND_LIMIT', 66316);
define ('U_REGEX_SET_CONTAINS_STRING', 66317);
define ('U_REGEX_ERROR_LIMIT', 66324);
define ('U_IDNA_PROHIBITED_ERROR', 66560);
define ('U_IDNA_ERROR_START', 66560);
define ('U_IDNA_UNASSIGNED_ERROR', 66561);
define ('U_IDNA_CHECK_BIDI_ERROR', 66562);
define ('U_IDNA_STD3_ASCII_RULES_ERROR', 66563);
define ('U_IDNA_ACE_PREFIX_ERROR', 66564);
define ('U_IDNA_VERIFICATION_ERROR', 66565);
define ('U_IDNA_LABEL_TOO_LONG_ERROR', 66566);
define ('U_IDNA_ZERO_LENGTH_LABEL_ERROR', 66567);
define ('U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR', 66568);
define ('U_IDNA_ERROR_LIMIT', 66569);
define ('U_STRINGPREP_PROHIBITED_ERROR', 66560);
define ('U_STRINGPREP_UNASSIGNED_ERROR', 66561);
define ('U_STRINGPREP_CHECK_BIDI_ERROR', 66562);
define ('U_ERROR_LIMIT', 66818);

/**
 * Prohibit processing of unassigned codepoints in the input for IDN
 * functions and do not check if the input conforms to domain name ASCII rules.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('IDNA_DEFAULT', 0);

/**
 * Allow processing of unassigned codepoints in the input for IDN functions.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('IDNA_ALLOW_UNASSIGNED', 1);

/**
 * Check if the input for IDN functions conforms to domain name ASCII rules.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('IDNA_USE_STD3_RULES', 2);

/**
 * Check whether the input conforms to the BiDi rules.
 * Ignored by the IDNA2003 implementation, which always performs this check.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('IDNA_CHECK_BIDI', 4);

/**
 * Check whether the input conforms to the CONTEXTJ rules.
 * Ignored by the IDNA2003 implementation, as this check is new in IDNA2008.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('IDNA_CHECK_CONTEXTJ', 8);

/**
 * Option for nontransitional processing in
 * <b>idn_to_ascii</b>. Transitional processing is activated
 * by default. This option is ignored by the IDNA2003 implementation.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('IDNA_NONTRANSITIONAL_TO_ASCII', 16);

/**
 * Option for nontransitional processing in
 * <b>idn_to_utf8</b>. Transitional processing is activated
 * by default. This option is ignored by the IDNA2003 implementation.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('IDNA_NONTRANSITIONAL_TO_UNICODE', 32);

/**
 * Use IDNA 2003 algorithm in <b>idn_to_utf8</b> and
 * <b>idn_to_ascii</b>. This is the default.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('INTL_IDNA_VARIANT_2003', 0);

/**
 * Use UTS #46 algorithm in <b>idn_to_utf8</b> and
 * <b>idn_to_ascii</b>.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('INTL_IDNA_VARIANT_UTS46', 1);

/**
 * Errors reported in a bitset returned by the UTS #46 algorithm in
 * <b>idn_to_utf8</b> and
 * <b>idn_to_ascii</b>.
 * @link http://php.net/manual/en/intl.constants.php
 */
define ('IDNA_ERROR_EMPTY_LABEL', 1);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_LABEL_TOO_LONG', 2);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_DOMAIN_NAME_TOO_LONG', 4);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_LEADING_HYPHEN', 8);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_TRAILING_HYPHEN', 16);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_HYPHEN_3_4', 32);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_LEADING_COMBINING_MARK', 64);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_DISALLOWED', 128);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_PUNYCODE', 256);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_LABEL_HAS_DOT', 512);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_INVALID_ACE_LABEL', 1024);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_BIDI', 2048);
/**
 * @since 5.4
 * @link http://www.php.net/manual/en/migration54.global-constants.php
 */
define ('IDNA_ERROR_CONTEXTJ', 4096);


// End of intl v.1.1.0
?>
