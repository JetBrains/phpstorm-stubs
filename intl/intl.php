<?php

/**
 * Limit on locale length, set to 80 in PHP code. Locale names longer
 * than this limit will not be accepted.
 * @link https://php.net/manual/en/intl.constants.php
 */

use JetBrains\PhpStorm\Deprecated;
use JetBrains\PhpStorm\ExpectedValues;
use JetBrains\PhpStorm\Internal\TentativeType;
use JetBrains\PhpStorm\Pure;

define('INTL_MAX_LOCALE_LEN', 156);

define('INTL_ICU_VERSION', "71.1");

define('INTL_ICU_DATA_VERSION', "71.1");

define('ULOC_ACTUAL_LOCALE', 0);

define('ULOC_VALID_LOCALE', 1);

define('GRAPHEME_EXTR_COUNT', 0);

define('GRAPHEME_EXTR_MAXBYTES', 1);

define('GRAPHEME_EXTR_MAXCHARS', 2);

define('U_USING_FALLBACK_WARNING', -128);

define('U_ERROR_WARNING_START', -128);

define('U_USING_DEFAULT_WARNING', -127);

define('U_SAFECLONE_ALLOCATED_WARNING', -126);

define('U_STATE_OLD_WARNING', -125);

define('U_STRING_NOT_TERMINATED_WARNING', -124);

define('U_SORT_KEY_TOO_SHORT_WARNING', -123);

define('U_AMBIGUOUS_ALIAS_WARNING', -122);

define('U_DIFFERENT_UCA_VERSION', -121);

define('U_ERROR_WARNING_LIMIT', -119);

define('U_ZERO_ERROR', 0);

define('U_ILLEGAL_ARGUMENT_ERROR', 1);

define('U_MISSING_RESOURCE_ERROR', 2);

define('U_INVALID_FORMAT_ERROR', 3);

define('U_FILE_ACCESS_ERROR', 4);

define('U_INTERNAL_PROGRAM_ERROR', 5);

define('U_MESSAGE_PARSE_ERROR', 6);

define('U_MEMORY_ALLOCATION_ERROR', 7);

define('U_INDEX_OUTOFBOUNDS_ERROR', 8);

define('U_PARSE_ERROR', 9);

define('U_INVALID_CHAR_FOUND', 10);

define('U_TRUNCATED_CHAR_FOUND', 11);

define('U_ILLEGAL_CHAR_FOUND', 12);

define('U_INVALID_TABLE_FORMAT', 13);

define('U_INVALID_TABLE_FILE', 14);

define('U_BUFFER_OVERFLOW_ERROR', 15);

define('U_UNSUPPORTED_ERROR', 16);

define('U_RESOURCE_TYPE_MISMATCH', 17);

define('U_ILLEGAL_ESCAPE_SEQUENCE', 18);

define('U_UNSUPPORTED_ESCAPE_SEQUENCE', 19);

define('U_NO_SPACE_AVAILABLE', 20);

define('U_CE_NOT_FOUND_ERROR', 21);

define('U_PRIMARY_TOO_LONG_ERROR', 22);

define('U_STATE_TOO_OLD_ERROR', 23);

define('U_TOO_MANY_ALIASES_ERROR', 24);

define('U_ENUM_OUT_OF_SYNC_ERROR', 25);

define('U_INVARIANT_CONVERSION_ERROR', 26);

define('U_INVALID_STATE_ERROR', 27);

define('U_COLLATOR_VERSION_MISMATCH', 28);

define('U_USELESS_COLLATOR_ERROR', 29);

define('U_NO_WRITE_PERMISSION', 30);

define('U_STANDARD_ERROR_LIMIT', 32);

define('U_BAD_VARIABLE_DEFINITION', 65536);

define('U_PARSE_ERROR_START', 65536);

define('U_MALFORMED_RULE', 65537);

define('U_MALFORMED_SET', 65538);

define('U_MALFORMED_SYMBOL_REFERENCE', 65539);

define('U_MALFORMED_UNICODE_ESCAPE', 65540);

define('U_MALFORMED_VARIABLE_DEFINITION', 65541);

define('U_MALFORMED_VARIABLE_REFERENCE', 65542);

define('U_MISMATCHED_SEGMENT_DELIMITERS', 65543);

define('U_MISPLACED_ANCHOR_START', 65544);

define('U_MISPLACED_CURSOR_OFFSET', 65545);

define('U_MISPLACED_QUANTIFIER', 65546);

define('U_MISSING_OPERATOR', 65547);

define('U_MISSING_SEGMENT_CLOSE', 65548);

define('U_MULTIPLE_ANTE_CONTEXTS', 65549);

define('U_MULTIPLE_CURSORS', 65550);

define('U_MULTIPLE_POST_CONTEXTS', 65551);

define('U_TRAILING_BACKSLASH', 65552);

define('U_UNDEFINED_SEGMENT_REFERENCE', 65553);

define('U_UNDEFINED_VARIABLE', 65554);

define('U_UNQUOTED_SPECIAL', 65555);

define('U_UNTERMINATED_QUOTE', 65556);

define('U_RULE_MASK_ERROR', 65557);

define('U_MISPLACED_COMPOUND_FILTER', 65558);

define('U_MULTIPLE_COMPOUND_FILTERS', 65559);

define('U_INVALID_RBT_SYNTAX', 65560);

define('U_INVALID_PROPERTY_PATTERN', 65561);

define('U_MALFORMED_PRAGMA', 65562);

define('U_UNCLOSED_SEGMENT', 65563);

define('U_ILLEGAL_CHAR_IN_SEGMENT', 65564);

define('U_VARIABLE_RANGE_EXHAUSTED', 65565);

define('U_VARIABLE_RANGE_OVERLAP', 65566);

define('U_ILLEGAL_CHARACTER', 65567);

define('U_INTERNAL_TRANSLITERATOR_ERROR', 65568);

define('U_INVALID_ID', 65569);

define('U_INVALID_FUNCTION', 65570);

define('U_PARSE_ERROR_LIMIT', 65571);

define('U_UNEXPECTED_TOKEN', 65792);

define('U_FMT_PARSE_ERROR_START', 65792);

define('U_MULTIPLE_DECIMAL_SEPARATORS', 65793);

define('U_MULTIPLE_DECIMAL_SEPERATORS', 65793);

define('U_MULTIPLE_EXPONENTIAL_SYMBOLS', 65794);

define('U_MALFORMED_EXPONENTIAL_PATTERN', 65795);

define('U_MULTIPLE_PERCENT_SYMBOLS', 65796);

define('U_MULTIPLE_PERMILL_SYMBOLS', 65797);

define('U_MULTIPLE_PAD_SPECIFIERS', 65798);

define('U_PATTERN_SYNTAX_ERROR', 65799);

define('U_ILLEGAL_PAD_POSITION', 65800);

define('U_UNMATCHED_BRACES', 65801);

define('U_UNSUPPORTED_PROPERTY', 65802);

define('U_UNSUPPORTED_ATTRIBUTE', 65803);

define('U_FMT_PARSE_ERROR_LIMIT', 65812);

define('U_BRK_INTERNAL_ERROR', 66048);

define('U_BRK_ERROR_START', 66048);

define('U_BRK_HEX_DIGITS_EXPECTED', 66049);

define('U_BRK_SEMICOLON_EXPECTED', 66050);

define('U_BRK_RULE_SYNTAX', 66051);

define('U_BRK_UNCLOSED_SET', 66052);

define('U_BRK_ASSIGN_ERROR', 66053);

define('U_BRK_VARIABLE_REDFINITION', 66054);

define('U_BRK_MISMATCHED_PAREN', 66055);

define('U_BRK_NEW_LINE_IN_QUOTED_STRING', 66056);

define('U_BRK_UNDEFINED_VARIABLE', 66057);

define('U_BRK_INIT_ERROR', 66058);

define('U_BRK_RULE_EMPTY_SET', 66059);

define('U_BRK_UNRECOGNIZED_OPTION', 66060);

define('U_BRK_MALFORMED_RULE_TAG', 66061);

define('U_BRK_ERROR_LIMIT', 66062);

define('U_REGEX_INTERNAL_ERROR', 66304);

define('U_REGEX_ERROR_START', 66304);

define('U_REGEX_RULE_SYNTAX', 66305);

define('U_REGEX_INVALID_STATE', 66306);

define('U_REGEX_BAD_ESCAPE_SEQUENCE', 66307);

define('U_REGEX_PROPERTY_SYNTAX', 66308);

define('U_REGEX_UNIMPLEMENTED', 66309);

define('U_REGEX_MISMATCHED_PAREN', 66310);

define('U_REGEX_NUMBER_TOO_BIG', 66311);

define('U_REGEX_BAD_INTERVAL', 66312);

define('U_REGEX_MAX_LT_MIN', 66313);

define('U_REGEX_INVALID_BACK_REF', 66314);

define('U_REGEX_INVALID_FLAG', 66315);

define('U_REGEX_LOOK_BEHIND_LIMIT', 66316);

define('U_REGEX_SET_CONTAINS_STRING', 66317);

define('U_REGEX_ERROR_LIMIT', 66326);

define('U_IDNA_PROHIBITED_ERROR', 66560);

define('U_IDNA_ERROR_START', 66560);

define('U_IDNA_UNASSIGNED_ERROR', 66561);

define('U_IDNA_CHECK_BIDI_ERROR', 66562);

define('U_IDNA_STD3_ASCII_RULES_ERROR', 66563);

define('U_IDNA_ACE_PREFIX_ERROR', 66564);

define('U_IDNA_VERIFICATION_ERROR', 66565);

define('U_IDNA_LABEL_TOO_LONG_ERROR', 66566);

define('U_IDNA_ZERO_LENGTH_LABEL_ERROR', 66567);

define('U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR', 66568);

define('U_IDNA_ERROR_LIMIT', 66569);

define('U_STRINGPREP_PROHIBITED_ERROR', 66560);

define('U_STRINGPREP_UNASSIGNED_ERROR', 66561);

define('U_STRINGPREP_CHECK_BIDI_ERROR', 66562);

define('U_ERROR_LIMIT', 66818);

/**
 * Prohibit processing of unassigned codepoints in the input for IDN
 * functions and do not check if the input conforms to domain name ASCII rules.
 * @link https://php.net/manual/en/intl.constants.php
 */
define('IDNA_DEFAULT', 0);

/**
 * Allow processing of unassigned codepoints in the input for IDN functions.
 * @link https://php.net/manual/en/intl.constants.php
 */
define('IDNA_ALLOW_UNASSIGNED', 1);

/**
 * Check if the input for IDN functions conforms to domain name ASCII rules.
 * @link https://php.net/manual/en/intl.constants.php
 */
define('IDNA_USE_STD3_RULES', 2);

/**
 * Check whether the input conforms to the BiDi rules.
 * Ignored by the IDNA2003 implementation, which always performs this check.
 * @link https://php.net/manual/en/intl.constants.php
 */
define('IDNA_CHECK_BIDI', 4);

/**
 * Check whether the input conforms to the CONTEXTJ rules.
 * Ignored by the IDNA2003 implementation, as this check is new in IDNA2008.
 * @link https://php.net/manual/en/intl.constants.php
 */
define('IDNA_CHECK_CONTEXTJ', 8);

/**
 * Option for nontransitional processing in
 * <b>idn_to_ascii</b>. Transitional processing is activated
 * by default. This option is ignored by the IDNA2003 implementation.
 * @link https://php.net/manual/en/intl.constants.php
 */
define('IDNA_NONTRANSITIONAL_TO_ASCII', 16);

/**
 * Option for nontransitional processing in
 * <b>idn_to_utf8</b>. Transitional processing is activated
 * by default. This option is ignored by the IDNA2003 implementation.
 * @link https://php.net/manual/en/intl.constants.php
 */
define('IDNA_NONTRANSITIONAL_TO_UNICODE', 32);

/**
 * Use IDNA 2003 algorithm in {@see idn_to_utf8} and
 * {@see idn_to_ascii}. This is the default.
 * @link https://php.net/manual/en/intl.constants.php
 * @deprecated 7.2 Use {@see INTL_IDNA_VARIANT_UTS46} instead.
 */
define('INTL_IDNA_VARIANT_2003', 0);

/**
 * Use UTS #46 algorithm in <b>idn_to_utf8</b> and
 * <b>idn_to_ascii</b>.
 * @link https://php.net/manual/en/intl.constants.php
 */
define('INTL_IDNA_VARIANT_UTS46', 1);

/**
 * Errors reported in a bitset returned by the UTS #46 algorithm in
 * <b>idn_to_utf8</b> and
 * <b>idn_to_ascii</b>.
 * @link https://php.net/manual/en/intl.constants.php
 */
define('IDNA_ERROR_EMPTY_LABEL', 1);

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Create a collator
 * @link https://php.net/manual/en/collator.create.php
 * @param string $locale <p>
 * The locale containing the required collation rules. Special values for
 * locales can be passed in - if null is passed for the locale, the
 * default locale collation rules will be used. If empty string ("") or
 * "root" are passed, UCA rules will be used.
 * </p>
 * @return Collator|null Return new instance of <b>Collator</b> object, or <b>NULL</b>
 * on error.
 */
#[Pure]
function collator_create(string $locale): ?Collator {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Compare two Unicode strings
 * @link https://php.net/manual/en/collator.compare.php
 * @param Collator $object
 * @param string $string1 <p>
 * The first string to compare.
 * </p>
 * @param string $string2 <p>
 * The second string to compare.
 * </p>
 * @return int|false Return comparison result:</p>
 * <p>
 * <p>
 * 1 if <i>string1</i> is greater than
 * <i>string2</i> ;
 * </p>
 * <p>
 * 0 if <i>string1</i> is equal to
 * <i>string2</i>;
 * </p>
 * <p>
 * -1 if <i>string1</i> is less than
 * <i>string2</i> .
 * </p>
 * On error
 * boolean
 * <b>FALSE</b>
 * is returned.
 */
#[Pure]
function collator_compare(Collator $object, string $string1, string $string2): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get collation attribute value
 * @link https://php.net/manual/en/collator.getattribute.php
 * @param Collator $object
 * @param int $attribute <p>
 * Attribute to get value for.
 * </p>
 * @return int|false Attribute value, or boolean <b>FALSE</b> on error.
 */
#[Pure]
function collator_get_attribute(Collator $object, int $attribute): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set collation attribute
 * @link https://php.net/manual/en/collator.setattribute.php
 * @param Collator $object
 * @param int $attribute <p>Attribute.</p>
 * @param int $value <p>
 * Attribute value.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_set_attribute(Collator $object, int $attribute, int $value): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get current collation strength
 * @link https://php.net/manual/en/collator.getstrength.php
 * @param Collator $object
 * @return int|false current collation strength, or boolean <b>FALSE</b> on error.
 */
#[Pure]
function collator_get_strength(Collator $object): int {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set collation strength
 * @link https://php.net/manual/en/collator.setstrength.php
 * @param Collator $object
 * @param int $strength <p>Strength to set.</p>
 * <p>
 * Possible values are:
 * <b>Collator::PRIMARY</b>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_set_strength(Collator $object, int $strength): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Sort array using specified collator
 * @link https://php.net/manual/en/collator.sort.php
 * @param Collator $object
 * @param string[] &$array <p>
 * Array of strings to sort.
 * </p>
 * @param int $flags <p>
 * Optional sorting type, one of the following:
 * </p>
 * <p>
 * <b>Collator::SORT_REGULAR</b>
 * - compare items normally (don't change types)
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_sort(Collator $object, array &$array, int $flags = 0): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Sort array using specified collator and sort keys
 * @link https://php.net/manual/en/collator.sortwithsortkeys.php
 * @param Collator $object
 * @param string[] &$array <p>Array of strings to sort</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_sort_with_sort_keys(Collator $object, array &$array, $sort_flags = []): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Sort array maintaining index association
 * @link https://php.net/manual/en/collator.asort.php
 * @param Collator $object
 * @param string[] &$array <p>Array of strings to sort.</p>
 * @param int $flags <p>
 * Optional sorting type, one of the following:
 * <b>Collator::SORT_REGULAR</b>
 * - compare items normally (don't change types)
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function collator_asort(Collator $object, array &$array, int $flags = 0): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the locale name of the collator
 * @link https://php.net/manual/en/collator.getlocale.php
 * @param Collator $object
 * @param int $type <p>
 * You can choose between valid and actual locale (
 * <b>Locale::VALID_LOCALE</b> and
 * <b>Locale::ACTUAL_LOCALE</b>,
 * respectively). The default is the actual locale.
 * </p>
 * @return string|false Real locale name from which the collation data comes. If the collator was
 * instantiated from rules or an error occurred, returns
 * boolean <b>FALSE</b>.
 */
#[Pure]
function collator_get_locale(Collator $object, int $type): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get collator's last error code
 * @link https://php.net/manual/en/collator.geterrorcode.php
 * @param Collator $object
 * @return int|false Error code returned by the last Collator API function call.
 */
#[Pure(true)]
function collator_get_error_code(Collator $object): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get text for collator's last error code
 * @link https://php.net/manual/en/collator.geterrormessage.php
 * @param Collator $object
 * @return string|false Description of an error occurred in the last Collator API function call.
 */
#[Pure]
function collator_get_error_message(Collator $object): string|false {}

/**
 * (PHP 5 >= 5.3.2, PHP 7, PECL intl >= 1.0.3)<br/>
 * Get sorting key for a string
 * @link https://php.net/manual/en/collator.getsortkey.php
 * @param Collator $object
 * @param string $string <p>
 * The string to produce the key from.
 * </p>
 * @return string|false the collation key for the string. Collation keys can be compared directly instead of strings.
 */
#[Pure]
function collator_get_sort_key(Collator $object, string $string, $arg3): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Create a number formatter
 * @link https://php.net/manual/en/numberformatter.create.php
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
 * @param string|null $pattern [optional] <p>
 * Pattern string if the chosen style requires a pattern.
 * </p>
 * @return NumberFormatter|false|null <b>NumberFormatter</b> object or <b>FALSE</b> on error.
 */
#[Pure]
function numfmt_create(string $locale, int $style, string $pattern = null): ?NumberFormatter {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Format a number
 * @link https://php.net/manual/en/numberformatter.format.php
 * @param NumberFormatter $formatter
 * @param int|float $num <p>
 * The value to format. Can be integer or float,
 * other values will be converted to a numeric value.
 * </p>
 * @param int $type <p>
 * The
 * formatting type to use.
 * </p>
 * @return string|false the string containing formatted value, or <b>FALSE</b> on error.
 */
#[Pure]
function numfmt_format(NumberFormatter $formatter, int|float $num, int $type = 0): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Parse a number
 * @link https://php.net/manual/en/numberformatter.parse.php
 * @param NumberFormatter $formatter
 * @param string $string
 * @param int $type [optional] <p>
 * The
 * formatting type to use. By default,
 * <b>NumberFormatter::TYPE_DOUBLE</b> is used.
 * </p>
 * @param int &$offset [optional] <p>
 * Offset in the string at which to begin parsing. On return, this value
 * will hold the offset at which parsing ended.
 * </p>
 * @return int|float|false The value of the parsed number or <b>FALSE</b> on error.
 */
#[Pure]
function numfmt_parse(NumberFormatter $formatter, string $string, int $type = NumberFormatter::TYPE_DOUBLE, &$offset = null): int|float|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Format a currency value
 * @link https://php.net/manual/en/numberformatter.formatcurrency.php
 * @param NumberFormatter $formatter
 * @param float $amount <p>
 * The numeric currency value.
 * </p>
 * @param string $currency <p>
 * The 3-letter ISO 4217 currency code indicating the currency to use.
 * </p>
 * @return string|false String representing the formatted currency value.
 */
#[Pure]
function numfmt_format_currency(NumberFormatter $formatter, float $amount, string $currency): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Parse a currency number
 * @link https://php.net/manual/en/numberformatter.parsecurrency.php
 * @param NumberFormatter $formatter
 * @param string $string
 * @param string &$currency <p>
 * Parameter to receive the currency name (3-letter ISO 4217 currency
 * code).
 * </p>
 * @param int &$offset [optional] <p>
 * Offset in the string at which to begin parsing. On return, this value
 * will hold the offset at which parsing ended.
 * </p>
 * @return float|false The parsed numeric value or <b>FALSE</b> on error.
 */
function numfmt_parse_currency(NumberFormatter $formatter, string $string, &$currency, &$offset = null): float|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set an attribute
 * @link https://php.net/manual/en/numberformatter.setattribute.php
 * @param NumberFormatter $formatter
 * @param int $attribute <p>
 * Attribute specifier - one of the
 * numeric attribute constants.
 * </p>
 * @param int|float $value <p>
 * The attribute value.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_attribute(NumberFormatter $formatter, int $attribute, int|float $value): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get an attribute
 * @link https://php.net/manual/en/numberformatter.getattribute.php
 * @param NumberFormatter $formatter
 * @param int $attribute <p>
 * Attribute specifier - one of the
 * numeric attribute constants.
 * </p>
 * @return int|float|false Return attribute value on success, or <b>FALSE</b> on error.
 */
#[Pure]
function numfmt_get_attribute(NumberFormatter $formatter, int $attribute): int|float|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set a text attribute
 * @link https://php.net/manual/en/numberformatter.settextattribute.php
 * @param NumberFormatter $formatter
 * @param int $attribute <p>
 * Attribute specifier - one of the
 * text attribute
 * constants.
 * </p>
 * @param string $value <p>
 * Text for the attribute value.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_text_attribute(NumberFormatter $formatter, int $attribute, string $value): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get a text attribute
 * @link https://php.net/manual/en/numberformatter.gettextattribute.php
 * @param NumberFormatter $formatter
 * @param int $attribute <p>
 * Attribute specifier - one of the
 * text attribute constants.
 * </p>
 * @return string|false Return attribute value on success, or <b>FALSE</b> on error.
 */
#[Pure]
function numfmt_get_text_attribute(NumberFormatter $formatter, int $attribute): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set a symbol value
 * @link https://php.net/manual/en/numberformatter.setsymbol.php
 * @param NumberFormatter $formatter
 * @param int $symbol <p>
 * Symbol specifier, one of the
 * format symbol constants.
 * </p>
 * @param string $value <p>
 * Text for the symbol.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_symbol(NumberFormatter $formatter, int $symbol, string $value): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get a symbol value
 * @link https://php.net/manual/en/numberformatter.getsymbol.php
 * @param NumberFormatter $formatter
 * @param int $symbol <p>
 * Symbol specifier, one of the
 * format symbol constants.
 * </p>
 * @return string|false The symbol string or <b>FALSE</b> on error.
 */
#[Pure]
function numfmt_get_symbol(NumberFormatter $formatter, int $symbol): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set formatter pattern
 * @link https://php.net/manual/en/numberformatter.setpattern.php
 * @param NumberFormatter $formatter
 * @param string $pattern <p>
 * Pattern in syntax described in
 * ICU DecimalFormat
 * documentation.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function numfmt_set_pattern(NumberFormatter $formatter, string $pattern): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get formatter pattern
 * @link https://php.net/manual/en/numberformatter.getpattern.php
 * @param NumberFormatter $formatter
 * @return string|false Pattern string that is used by the formatter, or <b>FALSE</b> if an error happens.
 */
#[Pure]
function numfmt_get_pattern(NumberFormatter $formatter): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get formatter locale
 * @link https://php.net/manual/en/numberformatter.getlocale.php
 * @param NumberFormatter $formatter
 * @param int $type <p>
 * You can choose between valid and actual locale (
 * <b>Locale::VALID_LOCALE</b>,
 * <b>Locale::ACTUAL_LOCALE</b>,
 * respectively). The default is the actual locale.
 * </p>
 * @return string|false The locale name used to create the formatter.
 */
#[Pure]
function numfmt_get_locale(NumberFormatter $formatter, int $type = 0): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get formatter's last error code.
 * @link https://php.net/manual/en/numberformatter.geterrorcode.php
 * @param NumberFormatter $formatter
 * @return int error code from last formatter call.
 */
#[Pure(true)]
function numfmt_get_error_code(NumberFormatter $formatter): int {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get formatter's last error message.
 * @link https://php.net/manual/en/numberformatter.geterrormessage.php
 * @param NumberFormatter $formatter
 * @return string error message from last formatter call.
 */
#[Pure(true)]
function numfmt_get_error_message(NumberFormatter $formatter): string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Normalizes the input provided and returns the normalized string
 * @link https://php.net/manual/en/normalizer.normalize.php
 * @param string $string <p>The input string to normalize</p>
 * @param int $form [optional] <p>One of the normalization forms.</p>
 * @return string|false The normalized string or <b>FALSE</b> if an error occurred.
 */
#[Pure]
function normalizer_normalize(string $string, int $form = Normalizer::FORM_C): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Checks if the provided string is already in the specified normalization
 * form.
 * @link https://php.net/manual/en/normalizer.isnormalized.php
 * @param string $string <p>The input string to normalize</p>
 * @param int $form [optional] <p>
 * One of the normalization forms.
 * </p>
 * @return bool <b>TRUE</b> if normalized, <b>FALSE</b> otherwise or if there an error
 */
#[Pure]
function normalizer_is_normalized(string $string, int $form = Normalizer::FORM_C): bool {}

/**
 * Gets the default locale value from the intl global 'default_locale'
 * @link https://php.net/manual/en/function.locale-get-default.php
 * @return string a string with the current Locale.
 */
#[Pure]
function locale_get_default(): string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set the default runtime Locale
 * @link https://php.net/manual/en/function.locale-set-default.php
 * @param string $locale <p>
 * The new Locale name. A comprehensive list of the supported locales is
 * available at .
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function locale_set_default(string $locale): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Gets the primary language for the input locale
 * @link https://php.net/manual/en/locale.getprimarylanguage.php
 * @param string $locale <p>
 * The locale to extract the primary language code from
 * </p>
 * @return string|null The language code associated with the language or <b>NULL</b> in case of error.
 */
#[Pure]
function locale_get_primary_language(string $locale): ?string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Gets the script for the input locale
 * @link https://php.net/manual/en/locale.getscript.php
 * @param string $locale <p>
 * The locale to extract the script code from
 * </p>
 * @return string|null The script subtag for the locale or <b>NULL</b> if not present
 */
#[Pure]
function locale_get_script(string $locale): ?string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Gets the region for the input locale
 * @link https://php.net/manual/en/locale.getregion.php
 * @param string $locale <p>
 * The locale to extract the region code from
 * </p>
 * @return string|null The region subtag for the locale or <b>NULL</b> if not present
 */
#[Pure]
function locale_get_region(string $locale): ?string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Gets the keywords for the input locale
 * @link https://php.net/manual/en/locale.getkeywords.php
 * @param string $locale <p>
 * The locale to extract the keywords from
 * </p>
 * @return array|false|null Associative array containing the keyword-value pairs for this locale
 */
#[Pure]
function locale_get_keywords(string $locale): array|false|null {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Returns an appropriately localized display name for script of the input locale
 * @link https://php.net/manual/en/locale.getdisplayscript.php
 * @param string $locale <p>
 * The locale to return a display script for
 * </p>
 * @param string|null $displayLocale <p>
 * Optional format locale to use to display the script name
 * </p>
 * @return string|false Display name of the script for the $locale in the format appropriate for
 * $in_locale.
 */
#[Pure]
function locale_get_display_script(string $locale, ?string $displayLocale): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Returns an appropriately localized display name for region of the input locale
 * @link https://php.net/manual/en/locale.getdisplayregion.php
 * @param string $locale <p>
 * The locale to return a display region for.
 * </p>
 * @param string|null $displayLocale <p>
 * Optional format locale to use to display the region name
 * </p>
 * @return string|false display name of the region for the $locale in the format appropriate for
 * $in_locale.
 */
#[Pure]
function locale_get_display_region(string $locale, ?string $displayLocale): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Returns an appropriately localized display name for the input locale
 * @link https://php.net/manual/en/locale.getdisplayname.php
 * @param string $locale <p>
 * The locale to return a display name for.
 * </p>
 * @param string|null $displayLocale <p>optional format locale</p>
 * @return string|false Display name of the locale in the format appropriate for $in_locale.
 */
#[Pure]
function locale_get_display_name(string $locale, ?string $displayLocale): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Returns an appropriately localized display name for language of the inputlocale
 * @link https://php.net/manual/en/locale.getdisplaylanguage.php
 * @param string $locale <p>
 * The locale to return a display language for
 * </p>
 * @param string|null $displayLocale <p>
 * Optional format locale to use to display the language name
 * </p>
 * @return string|false display name of the language for the $locale in the format appropriate for
 * $in_locale.
 */
#[Pure]
function locale_get_display_language(string $locale, ?string $displayLocale): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Returns an appropriately localized display name for variants of the input locale
 * @link https://php.net/manual/en/locale.getdisplayvariant.php
 * @param string $locale <p>
 * The locale to return a display variant for
 * </p>
 * @param string|null $displayLocale <p>
 * Optional format locale to use to display the variant name
 * </p>
 * @return string|false Display name of the variant for the $locale in the format appropriate for
 * $in_locale.
 */
#[Pure]
function locale_get_display_variant(string $locale, ?string $displayLocale): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Returns a correctly ordered and delimited locale ID
 * @link https://php.net/manual/en/locale.composelocale.php
 * @param string[] $subtags <p>
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
 * @return string|false The corresponding locale identifier.
 */
#[Pure]
function locale_compose(array $subtags): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Returns a key-value array of locale ID subtag elements.
 * @link https://php.net/manual/en/locale.parselocale.php
 * @param string $locale <p>
 * The locale to extract the subtag array from. Note: The 'variant' and
 * 'private' subtags can take maximum 15 values whereas 'extlang' can take
 * maximum 3 values.
 * </p>
 * @return string[]|null an array containing a list of key-value pairs, where the keys
 * identify the particular locale ID subtags, and the values are the
 * associated subtag values. The array will be ordered as the locale id
 * subtags e.g. in the locale id if variants are '-varX-varY-varZ' then the
 * returned array will have variant0=&gt;varX , variant1=&gt;varY ,
 * variant2=&gt;varZ
 */
#[Pure]
function locale_parse(string $locale): ?array {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Gets the variants for the input locale
 * @link https://php.net/manual/en/locale.getallvariants.php
 * @param string $locale <p>
 * The locale to extract the variants from
 * </p>
 * @return array|null The array containing the list of all variants subtag for the locale
 * or <b>NULL</b> if not present
 */
#[Pure]
function locale_get_all_variants(string $locale): ?array {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Checks if a language tag filter matches with locale
 * @link https://php.net/manual/en/locale.filtermatches.php
 * @param string $languageTag <p>
 * The language tag to check
 * </p>
 * @param string $locale <p>
 * The language range to check against
 * </p>
 * @param bool $canonicalize <p>
 * If true, the arguments will be converted to canonical form before
 * matching.
 * </p>
 * @return bool|null <b>TRUE</b> if $locale matches $langtag <b>FALSE</b> otherwise.
 */
#[Pure]
function locale_filter_matches(string $languageTag, string $locale, bool $canonicalize): ?bool {}

/**
 * Canonicalize the locale string
 * @param string $locale
 *
 * @return null|string
 */
#[Pure]
function locale_canonicalize(string $locale): ?string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Searches the language tag list for the best match to the language
 * @link https://php.net/manual/en/locale.lookup.php
 * @param string[] $languageTag <p>
 * An array containing a list of language tags to compare to
 * <i>locale</i>. Maximum 100 items allowed.
 * </p>
 * @param string $locale <p>
 * The locale to use as the language range when matching.
 * </p>
 * @param bool $canonicalize <p>
 * If true, the arguments will be converted to canonical form before
 * matching.
 * </p>
 * @param string|null $defaultLocale <p>
 * The locale to use if no match is found.
 * </p>
 * @return string|null The closest matching language tag or default value.
 */
#[Pure]
function locale_lookup(array $languageTag, string $locale, bool $canonicalize, ?string $defaultLocale): ?string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Tries to find out best available locale based on HTTP "Accept-Language" header
 * @link https://php.net/manual/en/locale.acceptfromhttp.php
 * @param string $header <p>
 * The string containing the "Accept-Language" header according to format in RFC 2616.
 * </p>
 * @return string|false The corresponding locale identifier.
 */
#[Pure]
function locale_accept_from_http(string $header): string|false {}

/**
 * Constructs a new message formatter
 * @param string $locale
 * @param string $pattern
 * @return MessageFormatter|null
 */
#[Pure]
function msgfmt_create(string $locale, string $pattern): ?MessageFormatter {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Format the message
 * @link https://php.net/manual/en/messageformatter.format.php
 * @param MessageFormatter $formatter
 * @param array $values <p>
 * Arguments to insert into the format string
 * </p>
 * @return string|false The formatted string, or <b>FALSE</b> if an error occurred
 */
#[Pure]
function msgfmt_format(MessageFormatter $formatter, array $values): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Quick format message
 * @link https://php.net/manual/en/messageformatter.formatmessage.php
 * @param string $locale <p>
 * The locale to use for formatting locale-dependent parts
 * </p>
 * @param string $pattern <p>
 * The pattern string to insert things into.
 * The pattern uses an 'apostrophe-friendly' syntax; it is run through
 * umsg_autoQuoteApostrophe
 * before being interpreted.
 * </p>
 * @param array $values <p>
 * The array of values to insert into the format string
 * </p>
 * @return string|false The formatted pattern string or <b>FALSE</b> if an error occurred
 */
#[Pure]
function msgfmt_format_message(string $locale, string $pattern, array $values): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Parse input string according to pattern
 * @link https://php.net/manual/en/messageformatter.parse.php
 * @param MessageFormatter $formatter
 * @param string $string <p>
 * The string to parse
 * </p>
 * @return array|false An array containing the items extracted, or <b>FALSE</b> on error
 */
#[Pure]
function msgfmt_parse(MessageFormatter $formatter, string $string): array|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Quick parse input string
 * @link https://php.net/manual/en/messageformatter.parsemessage.php
 * @param string $locale <p>
 * The locale to use for parsing locale-dependent parts
 * </p>
 * @param string $pattern <p>
 * The pattern with which to parse the <i>value</i>.
 * </p>
 * @param string $message <p>
 * The string to parse, conforming to the <i>pattern</i>.
 * </p>
 * @return array|false An array containing items extracted, or <b>FALSE</b> on error
 */
#[Pure]
function msgfmt_parse_message(string $locale, string $pattern, string $message): array|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set the pattern used by the formatter
 * @link https://php.net/manual/en/messageformatter.setpattern.php
 * @param MessageFormatter $formatter
 * @param string $pattern <p>
 * The pattern string to use in this message formatter.
 * The pattern uses an 'apostrophe-friendly' syntax; it is run through
 * umsg_autoQuoteApostrophe
 * before being interpreted.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function msgfmt_set_pattern(MessageFormatter $formatter, string $pattern): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the pattern used by the formatter
 * @link https://php.net/manual/en/messageformatter.getpattern.php
 * @param MessageFormatter $formatter
 * @return string|false The pattern string for this message formatter
 */
#[Pure]
function msgfmt_get_pattern(MessageFormatter $formatter): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the locale for which the formatter was created.
 * @link https://php.net/manual/en/messageformatter.getlocale.php
 * @param MessageFormatter $formatter
 * @return string The locale name
 */
#[Pure]
function msgfmt_get_locale(MessageFormatter $formatter): string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the error code from last operation
 * @link https://php.net/manual/en/messageformatter.geterrorcode.php
 * @param MessageFormatter $formatter
 * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
 */
#[Pure(true)]
function msgfmt_get_error_code(MessageFormatter $formatter): int {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the error text from the last operation
 * @link https://php.net/manual/en/messageformatter.geterrormessage.php
 * @param MessageFormatter $formatter
 * @return string Description of the last error.
 */
#[Pure(true)]
function msgfmt_get_error_message(MessageFormatter $formatter): string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Create a date formatter
 * @link https://php.net/manual/en/intldateformatter.create.php
 * @param string|null $locale <p>
 * Locale to use when formatting or parsing.
 * </p>
 * @param int $dateType <p>
 * Date type to use (<b>none</b>,
 * <b>short</b>, <b>medium</b>,
 * <b>long</b>, <b>full</b>).
 * This is one of the
 * IntlDateFormatter constants.
 * </p>
 * @param int $timeType <p>
 * Time type to use (<b>none</b>,
 * <b>short</b>, <b>medium</b>,
 * <b>long</b>, <b>full</b>).
 * This is one of the
 * IntlDateFormatter constants.
 * </p>
 * @param string|null $timezone [optional] <p>
 * Time zone ID, default is system default.
 * </p>
 * @param IntlCalendar|int|null $calendar [optional] <p>
 * Calendar to use for formatting or parsing; default is Gregorian.
 * This is one of the
 * IntlDateFormatter calendar constants.
 * </p>
 * @param string|null $pattern [optional] <p>
 * Optional pattern to use when formatting or parsing.
 * Possible patterns are documented at http://userguide.icu-project.org/formatparse/datetime.
 * </p>
 * @return IntlDateFormatter|null
 */
#[Pure]
function datefmt_create(?string $locale, int $dateType, int $timeType, $timezone = null, $calendar = null, string $pattern = null): ?IntlDateFormatter {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the datetype used for the IntlDateFormatter
 * @link https://php.net/manual/en/intldateformatter.getdatetype.php
 * @param IntlDateFormatter $formatter
 * @return int|false The current date type value of the formatter.
 */
#[Pure]
function datefmt_get_datetype(IntlDateFormatter $formatter): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the timetype used for the IntlDateFormatter
 * @link https://php.net/manual/en/intldateformatter.gettimetype.php
 * @param IntlDateFormatter $formatter
 * @return int|false The current date type value of the formatter.
 */
#[Pure]
function datefmt_get_timetype(IntlDateFormatter $formatter): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the calendar type used for the IntlDateFormatter
 * @link https://php.net/manual/en/intldateformatter.getcalendar.php
 * @param IntlDateFormatter $formatter
 * @return int|false The calendar being used by the formatter.
 */
#[Pure]
function datefmt_get_calendar(IntlDateFormatter $formatter): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * sets the calendar used to the appropriate calendar, which must be
 * @link https://php.net/manual/en/intldateformatter.setcalendar.php
 * @param IntlDateFormatter $formatter $mf
 * @param IntlCalendar|int|null $calendar <p>
 * The calendar to use.
 * Default is <b>IntlDateFormatter::GREGORIAN</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function datefmt_set_calendar(IntlDateFormatter $formatter, $calendar): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the locale used by formatter
 * @link https://php.net/manual/en/intldateformatter.getlocale.php
 * @param IntlDateFormatter $formatter
 * @param int $type [optional]
 * @return string|false the locale of this formatter or 'false' if error
 */
#[Pure]
function datefmt_get_locale(IntlDateFormatter $formatter): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the timezone-id used for the IntlDateFormatter
 * @link https://php.net/manual/en/intldateformatter.gettimezoneid.php
 * @param IntlDateFormatter $formatter
 * @return string|false ID string for the time zone used by this formatter.
 */
#[Pure]
function datefmt_get_timezone_id(IntlDateFormatter $formatter): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 3.0.0)<br/>
 * Get copy of formatter's calendar object
 * @link https://secure.php.net/manual/en/intldateformatter.getcalendarobject.php
 * @param IntlDateFormatter $formatter
 * @return IntlCalendar|false|null A copy of the internal calendar object used by this formatter.
 */
#[Pure]
function datefmt_get_calendar_object(IntlDateFormatter $formatter) {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Sets the time zone to use
 * @link https://php.net/manual/en/intldateformatter.settimezoneid.php
 * @param MessageFormatter $mf
 * @param string $zone <p>
 * The time zone ID string of the time zone to use.
 * If <b>NULL</b> or the empty string, the default time zone for the runtime is used.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @removed 7.0
 * @see datefmt_set_timezone()
 */
#[Deprecated(replacement: "datefmt_set_timezone(%parametersList%)", since: "5.5")]
function datefmt_set_timezone_id(MessageFormatter $mf, $zone) {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the pattern used for the IntlDateFormatter
 * @link https://php.net/manual/en/intldateformatter.getpattern.php
 * @param IntlDateFormatter $formatter
 * @return string|false The pattern string being used to format/parse.
 */
#[Pure]
function datefmt_get_pattern(IntlDateFormatter $formatter): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set the pattern used for the IntlDateFormatter
 * @link https://php.net/manual/en/intldateformatter.setpattern.php
 * @param IntlDateFormatter $formatter
 * @param string $pattern <p>
 * New pattern string to use.
 * Possible patterns are documented at http://userguide.icu-project.org/formatparse/datetime.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * Bad formatstrings are usually the cause of the failure.
 */
function datefmt_set_pattern(IntlDateFormatter $formatter, string $pattern): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the lenient used for the IntlDateFormatter
 * @link https://php.net/manual/en/intldateformatter.islenient.php
 * @param IntlDateFormatter $formatter
 * @return bool <b>TRUE</b> if parser is lenient, <b>FALSE</b> if parser is strict. By default the parser is lenient.
 */
#[Pure]
function datefmt_is_lenient(IntlDateFormatter $formatter): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Set the leniency of the parser
 * @link https://php.net/manual/en/intldateformatter.setlenient.php
 * @param IntlDateFormatter $formatter
 * @param bool $lenient <p>
 * Sets whether the parser is lenient or not, default is <b>TRUE</b> (lenient).
 * </p>
 * @return void
 */
function datefmt_set_lenient(IntlDateFormatter $formatter): void {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Format the date/time value as a string
 * @link https://php.net/manual/en/intldateformatter.format.php
 * @param IntlDateFormatter $formatter
 * @param object|array|string|int|float $datetime <p>
 * Value to format. This may be a <b>DateTime</b> object,
 * an integer representing a Unix timestamp value (seconds
 * since epoch, UTC) or an array in the format output by
 * <b>localtime</b>.
 * </p>
 * @return string|false The formatted string or, if an error occurred, <b>FALSE</b>.
 */
#[Pure]
function datefmt_format($formatter = null, $datetime = null): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Parse string to a timestamp value
 * @link https://php.net/manual/en/intldateformatter.parse.php
 * @param IntlDateFormatter $formatter
 * @param string $string <p>
 * string to convert to a time
 * </p>
 * @param int &$offset [optional] <p>
 * Position at which to start the parsing in $value (zero-based).
 * If no error occurs before $value is consumed, $parse_pos will contain -1
 * otherwise it will contain the position at which parsing ended (and the error occurred).
 * This variable will contain the end position if the parse fails.
 * If $parse_pos > strlen($value), the parse fails immediately.
 * </p>
 * @return int|float|false timestamp parsed value
 */
function datefmt_parse(IntlDateFormatter $formatter, string $string, &$offset = null): int|float|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Parse string to a field-based time value
 * @link https://php.net/manual/en/intldateformatter.localtime.php
 * @param IntlDateFormatter $formatter
 * @param string $string <p>
 * string to convert to a time
 * </p>
 * @param int &$offset [optional] <p>
 * Position at which to start the parsing in $value (zero-based).
 * If no error occurs before $value is consumed, $parse_pos will contain -1
 * otherwise it will contain the position at which parsing ended .
 * If $parse_pos > strlen($value), the parse fails immediately.
 * </p>
 * @return array|false Localtime compatible array of integers : contains 24 hour clock value in tm_hour field
 */
function datefmt_localtime(IntlDateFormatter $formatter, string $string, &$offset = null): array|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the error code from last operation
 * @link https://php.net/manual/en/intldateformatter.geterrorcode.php
 * @param IntlDateFormatter $formatter
 * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
 */
#[Pure(true)]
function datefmt_get_error_code(IntlDateFormatter $formatter): int {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the error text from the last operation.
 * @link https://php.net/manual/en/intldateformatter.geterrormessage.php
 * @param IntlDateFormatter $formatter
 * @return string Description of the last error.
 */
#[Pure(true)]
function datefmt_get_error_message(IntlDateFormatter $formatter): string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get string length in grapheme units
 * @link https://php.net/manual/en/function.grapheme-strlen.php
 * @param string $string <p>
 * The string being measured for length. It must be a valid UTF-8 string.
 * </p>
 * @return int|false|null The length of the string on success, and 0 if the string is empty.
 */
#[Pure]
function grapheme_strlen(string $string): int|false|null {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Find position (in grapheme units) of first occurrence of a string
 * @link https://php.net/manual/en/function.grapheme-strpos.php
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
 * @return int|false the position as an integer. If needle is not found, strpos() will return boolean FALSE.
 */
#[Pure]
function grapheme_strpos(string $haystack, string $needle, int $offset = 0): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Find position (in grapheme units) of first occurrence of a case-insensitive string
 * @link https://php.net/manual/en/function.grapheme-stripos.php
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
 * @return int|false the position as an integer. If needle is not found, grapheme_stripos() will return boolean FALSE.
 */
#[Pure]
function grapheme_stripos(string $haystack, string $needle, int $offset = 0): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Find position (in grapheme units) of last occurrence of a string
 * @link https://php.net/manual/en/function.grapheme-strrpos.php
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
 * @return int|false the position as an integer. If needle is not found, grapheme_strrpos() will return boolean FALSE.
 */
#[Pure]
function grapheme_strrpos(string $haystack, string $needle, int $offset = 0): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Find position (in grapheme units) of last occurrence of a case-insensitive string
 * @link https://php.net/manual/en/function.grapheme-strripos.php
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
 * @return int|false the position as an integer. If needle is not found, grapheme_strripos() will return boolean FALSE.
 */
#[Pure]
function grapheme_strripos(string $haystack, string $needle, int $offset = 0): int|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Return part of a string
 * @link https://php.net/manual/en/function.grapheme-substr.php
 * @param string $string <p>
 * The input string. Must be valid UTF-8.
 * </p>
 * @param int $offset <p>
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
 * @return string|false <p>the extracted part of $string,<br />
 * or <strong>FALSE</strong> if $length is negative and $start denotes a position beyond truncation $length,<br />
 * or also <strong>FALSE</strong> if $start denotes a position beyond $string length</p>
 */
#[Pure]
function grapheme_substr(string $string, int $offset, ?int $length = null): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Returns part of haystack string from the first occurrence of needle to the end of haystack.
 * @link https://php.net/manual/en/function.grapheme-strstr.php
 * @param string $haystack <p>
 * The input string. Must be valid UTF-8.
 * </p>
 * @param string $needle <p>
 * The string to look for. Must be valid UTF-8.
 * </p>
 * @param bool $beforeNeedle [optional] <p>
 * If <b>TRUE</b>, grapheme_strstr() returns the part of the
 * haystack before the first occurrence of the needle (excluding the needle).
 * </p>
 * @return string|false the portion of string, or FALSE if needle is not found.
 */
#[Pure]
function grapheme_strstr(string $haystack, string $needle, bool $beforeNeedle = false): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Returns part of haystack string from the first occurrence of case-insensitive needle to the end of haystack.
 * @link https://php.net/manual/en/function.grapheme-stristr.php
 * @param string $haystack <p>
 * The input string. Must be valid UTF-8.
 * </p>
 * @param string $needle <p>
 * The string to look for. Must be valid UTF-8.
 * </p>
 * @param bool $beforeNeedle [optional] <p>
 * If <b>TRUE</b>, grapheme_strstr() returns the part of the
 * haystack before the first occurrence of the needle (excluding needle).
 * </p>
 * @return string|false the portion of $haystack, or FALSE if $needle is not found.
 */
#[Pure]
function grapheme_stristr(string $haystack, string $needle, bool $beforeNeedle = false): string|false {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Function to extract a sequence of default grapheme clusters from a text buffer, which must be encoded in UTF-8.
 * @link https://php.net/manual/en/function.grapheme-extract.php
 * @param string $haystack <p>
 * String to search.
 * </p>
 * @param int $size <p>
 * Maximum number items - based on the $extract_type - to return.
 * </p>
 * @param int $type <p>
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
 * @param int $offset [optional] <p>
 * Starting position in $haystack in bytes - if given, it must be zero or a
 * positive value that is less than or equal to the length of $haystack in
 * bytes. If $start does not point to the first byte of a UTF-8
 * character, the start position is moved to the next character boundary.
 * </p>
 * @param int &$next [optional] <p>
 * Reference to a value that will be set to the next starting position.
 * When the call returns, this may point to the first byte position past the end of the string.
 * </p>
 * @return string|false A string starting at offset $start and ending on a default grapheme cluster
 * boundary that conforms to the $size and $extract_type specified.
 */
function grapheme_extract(string $haystack, int $size, int $type = 0, int $offset = 0, &$next = null): string|false {}

/**
 * (PHP 5 >= 5.3.0, PHP 7, PECL intl >= 1.0.2, PHP 7, PECL idn >= 0.1)<br/>
 * Convert domain name to IDNA ASCII form.
 * @link https://php.net/manual/en/function.idn-to-ascii.php
 * @param string $domain <p>
 * Domain to convert. In PHP 5 must be UTF-8 encoded.
 * If e.g. an ISO-8859-1 (aka Western Europe latin1) encoded string is
 * passed it will be converted into an ACE encoded "xn--" string.
 * It will not be the one you expected though!
 * </p>
 * @param int $flags [optional] <p>
 * Conversion options - combination of IDNA_* constants (except IDNA_ERROR_* constants).
 * </p>
 * @param int $variant [optional] <p>
 * Either INTL_IDNA_VARIANT_2003 for IDNA 2003 or INTL_IDNA_VARIANT_UTS46 for UTS #46.
 * </p>
 * @param array &$idna_info [optional] <p>
 * This parameter can be used only if INTL_IDNA_VARIANT_UTS46 was used for variant.
 * In that case, it will be filled with an array with the keys 'result',
 * the possibly illegal result of the transformation, 'isTransitionalDifferent',
 * a boolean indicating whether the usage of the transitional mechanisms of UTS #46
 * either has or would have changed the result and 'errors',
 * which is an int representing a bitset of the error constants IDNA_ERROR_*.
 * </p>
 * @return string|false The ACE encoded version of the domain name or <b>FALSE</b> on failure.
 */
function idn_to_ascii(string $domain, int $flags = 0, int $variant = INTL_IDNA_VARIANT_UTS46, &$idna_info): string|false {}

/**
 * (PHP 5 >= 5.3.0, PHP 7, PECL intl >= 1.0.2, PHP 7, PECL idn >= 0.1)<br/>
 * Convert domain name from IDNA ASCII to Unicode.
 * @link https://php.net/manual/en/function.idn-to-utf8.php
 * @param string $domain <p>
 * Domain to convert in IDNA ASCII-compatible format.
 * The ASCII encoded domain name. Looks like "xn--..." if the it originally contained non-ASCII characters.
 * </p>
 * @param int $flags [optional] <p>
 * Conversion options - combination of IDNA_* constants (except IDNA_ERROR_* constants).
 * </p>
 * @param int $variant [optional] <p>
 * Either INTL_IDNA_VARIANT_2003 for IDNA 2003 or INTL_IDNA_VARIANT_UTS46 for UTS #46.
 * </p>
 * @param array &$idna_info [optional] <p>
 * This parameter can be used only if INTL_IDNA_VARIANT_UTS46 was used for variant.
 * In that case, it will be filled with an array with the keys 'result',
 * the possibly illegal result of the transformation, 'isTransitionalDifferent',
 * a boolean indicating whether the usage of the transitional mechanisms of UTS #46
 * either has or would have changed the result and 'errors',
 * which is an int representing a bitset of the error constants IDNA_ERROR_*.
 * </p>
 * @return string|false The UTF-8 encoded version of the domain name or <b>FALSE</b> on failure.
 * RFC 3490 4.2 states though "ToUnicode never fails. If any step fails, then the original input
 * sequence is returned immediately in that step."
 */
function idn_to_utf8(string $domain, int $flags = 0, int $variant = INTL_IDNA_VARIANT_UTS46, &$idna_info): string|false {}

/**
 * Get the raw GMT offset (before taking daylight savings time into account
 * @link https://secure.php.net/manual/en/intltimezone.getrawoffset.php
 * @param IntlTimeZone $timezone
 * @return int
 */
#[Pure]
function intltz_get_raw_offset($timezone): int {}

/**
 * @param IntlGregorianCalendar $calendar
 * @param float $timestamp
 * @return bool
 */
function intlgregcal_set_gregorian_change($calendar, float $timestamp): bool {}

/**
 * @param IntlGregorianCalendar $calendar
 * @return float
 */
#[Pure]
function intlgregcal_get_gregorian_change($calendar): float {}

/**
 * @param IntlGregorianCalendar $calendar
 * @param int $year
 * @return bool
 */
#[Pure]
function intlgregcal_is_leap_year($calendar, int $year): bool {}

/**
 * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
 * Create a resource bundle
 * @link https://php.net/manual/en/resourcebundle.create.php
 * @param string|null $locale <p>
 * Locale for which the resources should be loaded (locale name, e.g. en_CA).
 * </p>
 * @param string|null $bundle <p>
 * The directory where the data is stored or the name of the .dat file.
 * </p>
 * @param bool $fallback [optional] <p>
 * Whether locale should match exactly or fallback to parent locale is allowed.
 * </p>
 * @return ResourceBundle|false|null <b>ResourceBundle</b> object or <b>FALSE</b> on error.
 */
#[Pure]
function resourcebundle_create(?string $locale, ?string $bundle, bool $fallback = true): ?ResourceBundle {}

/**
 * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
 * Get data from the bundle
 * @link https://php.net/manual/en/resourcebundle.get.php
 * @param ResourceBundle $bundle
 * @param string|int $index <p>
 * Data index, must be string or integer.
 * </p>
 * @param bool $fallback
 * @return mixed the data located at the index or <b>NULL</b> on error. Strings, integers and binary data strings
 * are returned as corresponding PHP types, integer array is returned as PHP array. Complex types are
 * returned as <b>ResourceBundle</b> object.
 */
#[Pure]
function resourcebundle_get(ResourceBundle $bundle, $index, bool $fallback = true): mixed {}

/**
 * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
 * Get number of elements in the bundle
 * @link https://php.net/manual/en/resourcebundle.count.php
 * @param ResourceBundle $bundle
 * @return int number of elements in the bundle.
 */
#[Pure]
function resourcebundle_count(ResourceBundle $bundle): int {}

/**
 * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
 * Get supported locales
 * @link https://php.net/manual/en/resourcebundle.locales.php
 * @param string $bundle <p>
 * Path of ResourceBundle for which to get available locales, or
 * empty string for default locales list.
 * </p>
 * @return array|false the list of locales supported by the bundle.
 */
#[Pure]
function resourcebundle_locales(string $bundle): array|false {}

/**
 * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
 * Get bundle's last error code.
 * @link https://php.net/manual/en/resourcebundle.geterrorcode.php
 * @param $bundle
 * @return int error code from last bundle object call.
 */
#[Pure(true)]
function resourcebundle_get_error_code(ResourceBundle $bundle): int {}

/**
 * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
 * Get bundle's last error message.
 * @link https://php.net/manual/en/resourcebundle.geterrormessage.php
 * @param $bundle
 * @return string error message from last bundle object's call.
 */
#[Pure(true)]
function resourcebundle_get_error_message(ResourceBundle $bundle): string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get the last error code
 * @link https://php.net/manual/en/function.intl-get-error-code.php
 * @return int Error code returned by the last API function call.
 */
#[Pure(true)]
function intl_get_error_code(): int {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get description of the last error
 * @link https://php.net/manual/en/function.intl-get-error-message.php
 * @return string Description of an error occurred in the last API function call.
 */
#[Pure(true)]
function intl_get_error_message(): string {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Check whether the given error code indicates failure
 * @link https://php.net/manual/en/function.intl-is-failure.php
 * @param int $errorCode <p>
 * is a value that returned by functions:
 * <b>intl_get_error_code</b>,
 * <b>collator_get_error_code</b> .
 * </p>
 * @return bool <b>TRUE</b> if it the code indicates some failure, and <b>FALSE</b>
 * in case of success or a warning.
 */
#[Pure]
function intl_is_failure(int $errorCode): bool {}

/**
 * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
 * Get symbolic name for a given error code
 * @link https://php.net/manual/en/function.intl-error-name.php
 * @param int $errorCode <p>
 * ICU error code.
 * </p>
 * @return string The returned string will be the same as the name of the error code
 * constant.
 */
#[Pure]
function intl_error_name(int $errorCode): string {}

function intltz_get_windows_id(string $timezoneId): string|false {}

function intltz_get_id_for_windows_id(string $timezoneId, ?string $region = null): string|false {}

class Collator
{
    public const DEFAULT_VALUE = -1;
    public const PRIMARY = 0;
    public const SECONDARY = 1;
    public const TERTIARY = 2;
    public const DEFAULT_STRENGTH = 2;
    public const QUATERNARY = 3;
    public const IDENTICAL = 15;
    public const OFF = 16;
    public const ON = 17;
    public const SHIFTED = 20;
    public const NON_IGNORABLE = 21;
    public const LOWER_FIRST = 24;
    public const UPPER_FIRST = 25;

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
     * @link https://php.net/manual/en/class.collator.php#intl.collator-constants
     */
    public const FRENCH_COLLATION = 0;

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
     * @link https://php.net/manual/en/class.collator.php#intl.collator-constants
     */
    public const ALTERNATE_HANDLING = 1;

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
     * @link https://php.net/manual/en/class.collator.php#intl.collator-constants
     */
    public const CASE_FIRST = 2;

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
     * @link https://php.net/manual/en/class.collator.php#intl.collator-constants
     */
    public const CASE_LEVEL = 3;

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
     * @link https://php.net/manual/en/class.collator.php#intl.collator-constants
     */
    public const NORMALIZATION_MODE = 4;

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
     * <b>Collator::TERTIARY</b>(default)
     * <b>Collator::QUATERNARY</b>
     * <b>Collator::IDENTICAL</b>
     * <b>Collator::DEFAULT_VALUE</b>
     * </p>
     * @link https://php.net/manual/en/class.collator.php#intl.collator-constants
     */
    public const STRENGTH = 5;

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
     * @link https://php.net/manual/en/class.collator.php#intl.collator-constants
     */
    public const HIRAGANA_QUATERNARY_MODE = 6;

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
     * @link https://php.net/manual/en/class.collator.php#intl.collator-constants
     */
    public const NUMERIC_COLLATION = 7;
    public const SORT_REGULAR = 0;
    public const SORT_STRING = 1;
    public const SORT_NUMERIC = 2;

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Create a collator
     * @link https://php.net/manual/en/collator.construct.php
     * @param string $locale
     */
    #[Pure]
    public function __construct($locale) {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Create a collator
     * @link https://php.net/manual/en/collator.create.php
     * @param string $locale <p>
     * The locale containing the required collation rules. Special values for
     * locales can be passed in - if null is passed for the locale, the
     * default locale collation rules will be used. If empty string ("") or
     * "root" are passed, UCA rules will be used.
     * </p>
     * @return Collator|null Return new instance of <b>Collator</b> object, or <b>NULL</b>
     * on error.
     */
    #[TentativeType]
    public static function create($locale): ?Collator {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Compare two Unicode strings
     * @link https://php.net/manual/en/collator.compare.php
     * @param string $string1 <p>
     * The first string to compare.
     * </p>
     * @param string $string2 <p>
     * The second string to compare.
     * </p>
     * @return int|false Return comparison result:</p>
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
    #[Pure]
    #[TentativeType]
    public function compare($string1, $string2): int|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Sort array using specified collator
     * @link https://php.net/manual/en/collator.sort.php
     * @param string[] &$array <p>
     * Array of strings to sort.
     * </p>
     * @param int $flags [optional] <p>
     * Optional sorting type, one of the following:
     * </p>
     * <p>
     * <b>Collator::SORT_REGULAR</b>
     * - compare items normally (don't change types)
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function sort(array &$array, #[ExpectedValues([Collator::SORT_REGULAR])] $flags = null): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Sort array using specified collator and sort keys
     * @link https://php.net/manual/en/collator.sortwithsortkeys.php
     * @param string[] &$array <p>Array of strings to sort</p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function sortWithSortKeys(array &$array, $flags = []): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Sort array maintaining index association
     * @link https://php.net/manual/en/collator.asort.php
     * @param string[] &$array <p>Array of strings to sort.</p>
     * @param int $flags [optional] <p>
     * Optional sorting type, one of the following:
     * <b>Collator::SORT_REGULAR</b>
     * - compare items normally (don't change types)
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function asort(array &$array, #[ExpectedValues([Collator::SORT_REGULAR])] $flags = null): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get collation attribute value
     * @link https://php.net/manual/en/collator.getattribute.php
     * @param int $attribute <p>
     * Attribute to get value for.
     * </p>
     * @return int|false Attribute value, or boolean <b>FALSE</b> on error.
     */
    #[Pure]
    #[TentativeType]
    public function getAttribute($attribute): int|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Set collation attribute
     * @link https://php.net/manual/en/collator.setattribute.php
     * @param int $attribute <p>Attribute.</p>
     * @param int $value <p>
     * Attribute value.
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function setAttribute($attribute, $value): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get current collation strength
     * @link https://php.net/manual/en/collator.getstrength.php
     * @return int current collation strength, or boolean <b>FALSE</b> on error.
     */
    #[Pure]
    #[TentativeType]
    public function getStrength(): int {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Set collation strength
     * @link https://php.net/manual/en/collator.setstrength.php
     * @param int $strength <p>Strength to set.</p>
     * <p>
     * Possible values are:
     * <b>Collator::PRIMARY</b>
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function setStrength(#[ExpectedValues([Collator::PRIMARY])] $strength) {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get collator's last error code
     * @link https://php.net/manual/en/collator.geterrorcode.php
     * @return int|false Error code returned by the last Collator API function call.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorCode(): int|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the locale name of the collator
     * @link https://php.net/manual/en/collator.getlocale.php
     * @param int $type <p>
     * You can choose between valid and actual locale (
     * <b>Locale::VALID_LOCALE</b> and
     * <b>Locale::ACTUAL_LOCALE</b>,
     * respectively).
     * </p>
     * @return string|false Real locale name from which the collation data comes. If the collator was
     * instantiated from rules or an error occurred, returns
     * boolean <b>FALSE</b>.
     */
    #[Pure]
    #[TentativeType]
    public function getLocale(#[ExpectedValues([Locale::VALID_LOCALE, Locale::ACTUAL_LOCALE])] $type): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get text for collator's last error code
     * @link https://php.net/manual/en/collator.geterrormessage.php
     * @return string|false Description of an error occurred in the last Collator API function call.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorMessage(): string|false {}

    /**
     * (PHP 5 >= 5.3.2, PECL intl >= 1.0.3)<br/>
     * Get sorting key for a string
     * @link https://php.net/manual/en/collator.getsortkey.php
     * @param string $string <p>
     * The string to produce the key from.
     * </p>
     * @return string|false the collation key for the string. Collation keys can be compared directly instead of strings.
     */
    #[Pure]
    #[TentativeType]
    public function getSortKey($string, $arg2): string|false {}
}

class NumberFormatter
{
    public const CURRENCY_ACCOUNTING = 12;

    /**
     * Decimal format defined by pattern
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PATTERN_DECIMAL = 0;

    /**
     * Decimal format
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const DECIMAL = 1;

    /**
     * Currency format
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const CURRENCY = 2;

    /**
     * Percent format
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PERCENT = 3;

    /**
     * Scientific format
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const SCIENTIFIC = 4;

    /**
     * Spellout rule-based format
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const SPELLOUT = 5;

    /**
     * Ordinal rule-based format
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ORDINAL = 6;

    /**
     * Duration rule-based format
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const DURATION = 7;

    /**
     * Rule-based format defined by pattern
     * @link https://php.net/manual/en/class.locale.php#intl.locale-constants
     */
    public const PATTERN_RULEBASED = 9;

    /**
     * Alias for PATTERN_DECIMAL
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const IGNORE = 0;

    /**
     * Default format for the locale
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const DEFAULT_STYLE = 1;

    /**
     * Rounding mode to round towards positive infinity.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ROUND_CEILING = 0;

    /**
     * Rounding mode to round towards negative infinity.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ROUND_FLOOR = 1;

    /**
     * Rounding mode to round towards zero.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ROUND_DOWN = 2;

    /**
     * Rounding mode to round away from zero.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ROUND_UP = 3;

    /**
     * Rounding mode to round towards the "nearest neighbor" unless both
     * neighbors are equidistant, in which case, round towards the even
     * neighbor.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ROUND_HALFEVEN = 4;

    /**
     * Rounding mode to round towards "nearest neighbor" unless both neighbors
     * are equidistant, in which case round down.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ROUND_HALFDOWN = 5;

    /**
     * Rounding mode to round towards "nearest neighbor" unless both neighbors
     * are equidistant, in which case round up.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ROUND_HALFUP = 6;

    /**
     * Pad characters inserted before the prefix.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PAD_BEFORE_PREFIX = 0;

    /**
     * Pad characters inserted after the prefix.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PAD_AFTER_PREFIX = 1;

    /**
     * Pad characters inserted before the suffix.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PAD_BEFORE_SUFFIX = 2;

    /**
     * Pad characters inserted after the suffix.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PAD_AFTER_SUFFIX = 3;

    /**
     * Parse integers only.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PARSE_INT_ONLY = 0;

    /**
     * Use grouping separator.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const GROUPING_USED = 1;

    /**
     * Always show decimal point.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const DECIMAL_ALWAYS_SHOWN = 2;

    /**
     * Maximum integer digits.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MAX_INTEGER_DIGITS = 3;

    /**
     * Minimum integer digits.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MIN_INTEGER_DIGITS = 4;

    /**
     * Integer digits.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const INTEGER_DIGITS = 5;

    /**
     * Maximum fraction digits.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MAX_FRACTION_DIGITS = 6;

    /**
     * Minimum fraction digits.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MIN_FRACTION_DIGITS = 7;

    /**
     * Fraction digits.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const FRACTION_DIGITS = 8;

    /**
     * Multiplier.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MULTIPLIER = 9;

    /**
     * Grouping size.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const GROUPING_SIZE = 10;

    /**
     * Rounding Mode.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ROUNDING_MODE = 11;

    /**
     * Rounding increment.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ROUNDING_INCREMENT = 12;

    /**
     * The width to which the output of format() is padded.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const FORMAT_WIDTH = 13;

    /**
     * The position at which padding will take place. See pad position
     * constants for possible argument values.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PADDING_POSITION = 14;

    /**
     * Secondary grouping size.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const SECONDARY_GROUPING_SIZE = 15;

    /**
     * Use significant digits.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const SIGNIFICANT_DIGITS_USED = 16;

    /**
     * Minimum significant digits.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MIN_SIGNIFICANT_DIGITS = 17;

    /**
     * Maximum significant digits.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MAX_SIGNIFICANT_DIGITS = 18;

    /**
     * Lenient parse mode used by rule-based formats.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const LENIENT_PARSE = 19;

    /**
     * Positive prefix.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const POSITIVE_PREFIX = 0;

    /**
     * Positive suffix.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const POSITIVE_SUFFIX = 1;

    /**
     * Negative prefix.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const NEGATIVE_PREFIX = 2;

    /**
     * Negative suffix.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const NEGATIVE_SUFFIX = 3;

    /**
     * The character used to pad to the format width.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PADDING_CHARACTER = 4;

    /**
     * The ISO currency code.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const CURRENCY_CODE = 5;

    /**
     * The default rule set. This is only available with rule-based
     * formatters.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const DEFAULT_RULESET = 6;

    /**
     * The public rule sets. This is only available with rule-based
     * formatters. This is a read-only attribute. The public rulesets are
     * returned as a single string, with each ruleset name delimited by ';'
     * (semicolon).
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PUBLIC_RULESETS = 7;

    /**
     * The decimal separator.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const DECIMAL_SEPARATOR_SYMBOL = 0;

    /**
     * The grouping separator.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const GROUPING_SEPARATOR_SYMBOL = 1;

    /**
     * The pattern separator.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PATTERN_SEPARATOR_SYMBOL = 2;

    /**
     * The percent sign.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PERCENT_SYMBOL = 3;

    /**
     * Zero.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ZERO_DIGIT_SYMBOL = 4;

    /**
     * Character representing a digit in the pattern.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const DIGIT_SYMBOL = 5;

    /**
     * The minus sign.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MINUS_SIGN_SYMBOL = 6;

    /**
     * The plus sign.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PLUS_SIGN_SYMBOL = 7;

    /**
     * The currency symbol.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const CURRENCY_SYMBOL = 8;

    /**
     * The international currency symbol.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const INTL_CURRENCY_SYMBOL = 9;

    /**
     * The monetary separator.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MONETARY_SEPARATOR_SYMBOL = 10;

    /**
     * The exponential symbol.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const EXPONENTIAL_SYMBOL = 11;

    /**
     * Per mill symbol.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PERMILL_SYMBOL = 12;

    /**
     * Escape padding character.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PAD_ESCAPE_SYMBOL = 13;

    /**
     * Infinity symbol.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const INFINITY_SYMBOL = 14;

    /**
     * Not-a-number symbol.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const NAN_SYMBOL = 15;

    /**
     * Significant digit symbol.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const SIGNIFICANT_DIGIT_SYMBOL = 16;

    /**
     * The monetary grouping separator.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const MONETARY_GROUPING_SEPARATOR_SYMBOL = 17;

    /**
     * Derive the type from variable type
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const TYPE_DEFAULT = 0;

    /**
     * Format/parse as 32-bit integer
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const TYPE_INT32 = 1;

    /**
     * Format/parse as 64-bit integer
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const TYPE_INT64 = 2;

    /**
     * Format/parse as floating point value
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const TYPE_DOUBLE = 3;

    /**
     * Format/parse as currency value
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const TYPE_CURRENCY = 4;

    /**
     * @link https://www.php.net/manual/en/class.numberformatter.php
     * @param string $locale
     * @param int $style
     * @param string $pattern [optional]
     */
    #[Pure]
    public function __construct($locale, $style, $pattern = null) {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Create a number formatter
     * @link https://php.net/manual/en/numberformatter.create.php
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
     * @return NumberFormatter|false <b>NumberFormatter</b> object or <b>FALSE</b> on error.
     */
    #[TentativeType]
    public static function create($locale, #[ExpectedValues([NumberFormatter::PATTERN_DECIMAL, NumberFormatter::PATTERN_RULEBASED])] $style, $pattern = null): ?NumberFormatter {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Format a number
     * @link https://php.net/manual/en/numberformatter.format.php
     * @param int|float $num <p>
     * The value to format. Can be integer or float,
     * other values will be converted to a numeric value.
     * </p>
     * @param int $type [optional] <p>
     * The
     * formatting type to use.
     * </p>
     * @return string|false the string containing formatted value, or <b>FALSE</b> on error.
     */
    #[Pure]
    #[TentativeType]
    public function format($num, $type = null): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Parse a number
     * @link https://php.net/manual/en/numberformatter.parse.php
     * @param string $string
     * @param int $type [optional] <p>
     * The
     * formatting type to use. By default,
     * <b>NumberFormatter::TYPE_DOUBLE</b> is used.
     * </p>
     * @param int &$offset [optional] <p>
     * Offset in the string at which to begin parsing. On return, this value
     * will hold the offset at which parsing ended.
     * </p>
     * @return mixed The value of the parsed number or <b>FALSE</b> on error.
     */
    #[TentativeType]
    public function parse($string, $type = NumberFormatter::TYPE_DOUBLE, &$offset = null): int|float|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Format a currency value
     * @link https://php.net/manual/en/numberformatter.formatcurrency.php
     * @param float $amount <p>
     * The numeric currency value.
     * </p>
     * @param string $currency <p>
     * The 3-letter ISO 4217 currency code indicating the currency to use.
     * </p>
     * @return string|false String representing the formatted currency value.
     */
    #[Pure]
    #[TentativeType]
    public function formatCurrency($amount, $currency): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Parse a currency number
     * @link https://php.net/manual/en/numberformatter.parsecurrency.php
     * @param string $string
     * @param string &$currency <p>
     * Parameter to receive the currency name (3-letter ISO 4217 currency
     * code).
     * </p>
     * @param int &$offset [optional] <p>
     * Offset in the string at which to begin parsing. On return, this value
     * will hold the offset at which parsing ended.
     * </p>
     * @return float|false The parsed numeric value or <b>FALSE</b> on error.
     */
    #[TentativeType]
    public function parseCurrency($string, &$currency, &$offset = null): float|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Set an attribute
     * @link https://php.net/manual/en/numberformatter.setattribute.php
     * @param int $attribute <p>
     * Attribute specifier - one of the
     * numeric attribute constants.
     * </p>
     * @param int $value <p>
     * The attribute value.
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function setAttribute($attribute, $value): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get an attribute
     * @link https://php.net/manual/en/numberformatter.getattribute.php
     * @param int $attribute <p>
     * Attribute specifier - one of the
     * numeric attribute constants.
     * </p>
     * @return int|float|false Return attribute value on success, or <b>FALSE</b> on error.
     */
    #[Pure]
    #[TentativeType]
    public function getAttribute($attribute): int|float|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Set a text attribute
     * @link https://php.net/manual/en/numberformatter.settextattribute.php
     * @param int $attribute <p>
     * Attribute specifier - one of the
     * text attribute
     * constants.
     * </p>
     * @param string $value <p>
     * Text for the attribute value.
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function setTextAttribute($attribute, $value): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get a text attribute
     * @link https://php.net/manual/en/numberformatter.gettextattribute.php
     * @param int $attribute <p>
     * Attribute specifier - one of the
     * text attribute constants.
     * </p>
     * @return string|false Return attribute value on success, or <b>FALSE</b> on error.
     */
    #[Pure]
    #[TentativeType]
    public function getTextAttribute($attribute): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Set a symbol value
     * @link https://php.net/manual/en/numberformatter.setsymbol.php
     * @param int $symbol <p>
     * Symbol specifier, one of the
     * format symbol constants.
     * </p>
     * @param string $value <p>
     * Text for the symbol.
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function setSymbol($symbol, $value): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get a symbol value
     * @link https://php.net/manual/en/numberformatter.getsymbol.php
     * @param int $symbol <p>
     * Symbol specifier, one of the
     * format symbol constants.
     * </p>
     * @return string|false The symbol string or <b>FALSE</b> on error.
     */
    #[Pure]
    #[TentativeType]
    public function getSymbol($symbol): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Set formatter pattern
     * @link https://php.net/manual/en/numberformatter.setpattern.php
     * @param string $pattern <p>
     * Pattern in syntax described in
     * ICU DecimalFormat
     * documentation.
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function setPattern($pattern): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get formatter pattern
     * @link https://php.net/manual/en/numberformatter.getpattern.php
     * @return string|false Pattern string that is used by the formatter, or <b>FALSE</b> if an error happens.
     */
    #[Pure]
    #[TentativeType]
    public function getPattern(): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get formatter locale
     * @link https://php.net/manual/en/numberformatter.getlocale.php
     * @param int $type [optional] <p>
     * You can choose between valid and actual locale (
     * <b>Locale::VALID_LOCALE</b>,
     * <b>Locale::ACTUAL_LOCALE</b>,
     * respectively). The default is the actual locale.
     * </p>
     * @return string The locale name used to create the formatter.
     */
    #[Pure]
    #[TentativeType]
    public function getLocale(#[ExpectedValues([Locale::VALID_LOCALE, Locale::ACTUAL_LOCALE])] $type = null): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get formatter's last error code.
     * @link https://php.net/manual/en/numberformatter.geterrorcode.php
     * @return int error code from last formatter call.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorCode(): int {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get formatter's last error message.
     * @link https://php.net/manual/en/numberformatter.geterrormessage.php
     * @return string error message from last formatter call.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorMessage(): string {}
}

class Normalizer
{
    public const NFKC_CF = 48;
    public const FORM_KC_CF = 48;

    /**
     * Default normalization options
     * @link https://secure.php.net/manual/en/class.normalizer.php
     */
    public const OPTION_DEFAULT = '';

    /**
     * No decomposition/composition
     * @link https://secure.php.net/manual/en/class.normalizer.php
     * @removed 8.0
     */
    public const NONE = '1';

    /**
     * Normalization Form D (NFD) - Canonical Decomposition
     * @link https://secure.php.net/manual/en/class.normalizer.php
     */
    public const FORM_D = 4;
    public const NFD = 4;

    /**
     * Normalization Form KD (NFKD) - Compatibility Decomposition
     * @link https://secure.php.net/manual/en/class.normalizer.php
     */
    public const FORM_KD = 8;
    public const NFKD = 8;

    /**
     * Normalization Form C (NFC) - Canonical Decomposition followed by
     * Canonical Composition
     * @link https://secure.php.net/manual/en/class.normalizer.php
     */
    public const FORM_C = 16;
    public const NFC = 16;

    /**
     * Normalization Form KC (NFKC) - Compatibility Decomposition, followed by
     * Canonical Composition
     * @link https://secure.php.net/manual/en/class.normalizer.php
     */
    public const FORM_KC = 32;
    public const NFKC = 32;

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Normalizes the input provided and returns the normalized string
     * @link https://php.net/manual/en/normalizer.normalize.php
     * @param string $string <p>The input string to normalize</p>
     * @param int $form <p>One of the normalization forms.</p>
     * @return string|false The normalized string or <b>FALSE</b> if an error occurred.
     */
    #[TentativeType]
    public static function normalize($string, $form, $arg3): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Checks if the provided string is already in the specified normalization form.
     * @link https://php.net/manual/en/normalizer.isnormalized.php
     * @param string $string <p>The input string to normalize</p>
     * @param int $form <p>
     * One of the normalization forms.
     * </p>
     * @return bool <b>TRUE</b> if normalized, <b>FALSE</b> otherwise or if there an error
     */
    #[TentativeType]
    public static function isNormalized($string, $form, $arg3): bool {}
}

class Locale
{
    /**
     * This is locale the data actually comes from.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const ACTUAL_LOCALE = 0;

    /**
     * This is the most specific locale supported by ICU.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const VALID_LOCALE = 1;

    /**
     * Used as locale parameter with the methods of the various locale affected classes,
     * such as NumberFormatter. This constant would make the methods to use default
     * locale.
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const DEFAULT_LOCALE = null;

    /**
     * Language subtag
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const LANG_TAG = 'language';

    /**
     * Extended language subtag
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const EXTLANG_TAG = 'extlang';

    /**
     * Script subtag
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const SCRIPT_TAG = 'script';

    /**
     * Region subtag
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const REGION_TAG = 'region';

    /**
     * Variant subtag
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const VARIANT_TAG = 'variant';

    /**
     * Grandfathered Language subtag
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const GRANDFATHERED_LANG_TAG = 'grandfathered';

    /**
     * Private subtag
     * @link https://php.net/manual/en/class.numberformatter.php#intl.numberformatter-constants
     */
    public const PRIVATE_TAG = 'private';

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Gets the default locale value from the INTL global 'default_locale'
     * @link https://php.net/manual/en/locale.getdefault.php
     * @return string The current runtime locale
     */
    #[TentativeType]
    public static function getDefault(): string {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * sets the default runtime locale
     * @link https://php.net/manual/en/locale.setdefault.php
     * @param string $locale <p>
     * Is a BCP 47 compliant language tag containing the
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public static function setDefault($locale) {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Gets the primary language for the input locale
     * @link https://php.net/manual/en/locale.getprimarylanguage.php
     * @param string $locale <p>
     * The locale to extract the primary language code from
     * </p>
     * @return string|null The language code associated with the language or <b>NULL</b> in case of error.
     */
    #[TentativeType]
    public static function getPrimaryLanguage($locale): ?string {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Gets the script for the input locale
     * @link https://php.net/manual/en/locale.getscript.php
     * @param string $locale <p>
     * The locale to extract the script code from
     * </p>
     * @return string|null The script subtag for the locale or <b>NULL</b> if not present
     */
    #[TentativeType]
    public static function getScript($locale): ?string {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Gets the region for the input locale
     * @link https://php.net/manual/en/locale.getregion.php
     * @param string $locale <p>
     * The locale to extract the region code from
     * </p>
     * @return string|null The region subtag for the locale or <b>NULL</b> if not present
     */
    #[TentativeType]
    public static function getRegion($locale): ?string {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Gets the keywords for the input locale
     * @link https://php.net/manual/en/locale.getkeywords.php
     * @param string $locale <p>
     * The locale to extract the keywords from
     * </p>
     * @return array|false|null Associative array containing the keyword-value pairs for this locale
     */
    #[TentativeType]
    public static function getKeywords($locale): array|false|null {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Returns an appropriately localized display name for script of the input locale
     * @link https://php.net/manual/en/locale.getdisplayscript.php
     * @param string $locale <p>
     * The locale to return a display script for
     * </p>
     * @param string $displayLocale <p>
     * Optional format locale to use to display the script name
     * </p>
     * @return string Display name of the script for the $locale in the format appropriate for
     * $in_locale.
     */
    #[TentativeType]
    public static function getDisplayScript($locale, $displayLocale): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Returns an appropriately localized display name for region of the input locale
     * @link https://php.net/manual/en/locale.getdisplayregion.php
     * @param string $locale <p>
     * The locale to return a display region for.
     * </p>
     * @param string $displayLocale <p>
     * Optional format locale to use to display the region name
     * </p>
     * @return string display name of the region for the $locale in the format appropriate for
     * $in_locale.
     */
    #[TentativeType]
    public static function getDisplayRegion($locale, $displayLocale): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Returns an appropriately localized display name for the input locale
     * @link https://php.net/manual/en/locale.getdisplayname.php
     * @param string $locale <p>
     * The locale to return a display name for.
     * </p>
     * @param string $displayLocale <p>optional format locale</p>
     * @return string|false Display name of the locale in the format appropriate for $in_locale.
     */
    #[TentativeType]
    public static function getDisplayName($locale, $displayLocale): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Returns an appropriately localized display name for language of the inputlocale
     * @link https://php.net/manual/en/locale.getdisplaylanguage.php
     * @param string $locale <p>
     * The locale to return a display language for
     * </p>
     * @param string $displayLocale <p>
     * Optional format locale to use to display the language name
     * </p>
     * @return string|false display name of the language for the $locale in the format appropriate for
     * $in_locale.
     */
    #[TentativeType]
    public static function getDisplayLanguage($locale, $displayLocale): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Returns an appropriately localized display name for variants of the input locale
     * @link https://php.net/manual/en/locale.getdisplayvariant.php
     * @param string $locale <p>
     * The locale to return a display variant for
     * </p>
     * @param string $displayLocale <p>
     * Optional format locale to use to display the variant name
     * </p>
     * @return string|false Display name of the variant for the $locale in the format appropriate for
     * $in_locale.
     */
    #[TentativeType]
    public static function getDisplayVariant($locale, $displayLocale): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Returns a correctly ordered and delimited locale ID
     * @link https://php.net/manual/en/locale.composelocale.php
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
    #[TentativeType]
    public static function composeLocale(array $subtags): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Returns a key-value array of locale ID subtag elements.
     * @link https://php.net/manual/en/locale.parselocale.php
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
    #[TentativeType]
    public static function parseLocale($locale): ?array {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Gets the variants for the input locale
     * @link https://php.net/manual/en/locale.getallvariants.php
     * @param string $locale <p>
     * The locale to extract the variants from
     * </p>
     * @return array|null The array containing the list of all variants subtag for the locale
     * or <b>NULL</b> if not present
     */
    #[TentativeType]
    public static function getAllVariants($locale): ?array {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Checks if a language tag filter matches with locale
     * @link https://php.net/manual/en/locale.filtermatches.php
     * @param string $languageTag <p>
     * The language tag to check
     * </p>
     * @param string $locale <p>
     * The language range to check against
     * </p>
     * @param bool $canonicalize <p>
     * If true, the arguments will be converted to canonical form before
     * matching.
     * </p>
     * @return bool <b>TRUE</b> if $locale matches $langtag <b>FALSE</b> otherwise.
     */
    #[TentativeType]
    public static function filterMatches($languageTag, $locale, $canonicalize): ?bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Searches the language tag list for the best match to the language
     * @link https://php.net/manual/en/locale.lookup.php
     * @param array $languageTag <p>
     * An array containing a list of language tags to compare to
     * <i>locale</i>. Maximum 100 items allowed.
     * </p>
     * @param string $locale <p>
     * The locale to use as the language range when matching.
     * </p>
     * @param bool $canonicalize <p>
     * If true, the arguments will be converted to canonical form before
     * matching.
     * </p>
     * @param string $defaultLocale <p>
     * The locale to use if no match is found.
     * </p>
     * @return string The closest matching language tag or default value.
     */
    #[TentativeType]
    public static function lookup(array $languageTag, $locale, $canonicalize, $defaultLocale): ?string {}

    /**
     * @link https://php.net/manual/en/locale.canonicalize.php
     * @param string $locale
     * @return string
     */
    #[TentativeType]
    public static function canonicalize($locale): ?string {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Tries to find out best available locale based on HTTP "Accept-Language" header
     * @link https://php.net/manual/en/locale.acceptfromhttp.php
     * @param string $header <p>
     * The string containing the "Accept-Language" header according to format in RFC 2616.
     * </p>
     * @return string The corresponding locale identifier.
     */
    #[TentativeType]
    public static function acceptFromHttp($header): string|false {}
}

class MessageFormatter
{
    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Constructs a new Message Formatter
     * @link https://php.net/manual/en/messageformatter.create.php
     * @param string $locale <p>
     * The locale to use when formatting arguments
     * </p>
     * @param string $pattern <p>
     * The pattern string to stick arguments into.
     * The pattern uses an 'apostrophe-friendly' syntax; it is run through
     * umsg_autoQuoteApostrophe
     * before being interpreted.
     * </p>
     * @throws IntlException on failure.
     */
    #[Pure]
    public function __construct($locale, $pattern) {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Constructs a new Message Formatter
     * @link https://php.net/manual/en/messageformatter.create.php
     * @param string $locale <p>
     * The locale to use when formatting arguments
     * </p>
     * @param string $pattern <p>
     * The pattern string to stick arguments into.
     * The pattern uses an 'apostrophe-friendly' syntax; it is run through
     * umsg_autoQuoteApostrophe
     * before being interpreted.
     * </p>
     * @return MessageFormatter|null The formatter object
     */
    #[TentativeType]
    public static function create($locale, $pattern): ?MessageFormatter {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Quick format message
     * @link https://php.net/manual/en/messageformatter.formatmessage.php
     * @param string $locale <p>
     * The locale to use for formatting locale-dependent parts
     * </p>
     * @param string $pattern <p>
     * The pattern string to insert things into.
     * The pattern uses an 'apostrophe-friendly' syntax; it is run through
     * umsg_autoQuoteApostrophe
     * before being interpreted.
     * </p>
     * @param array $values <p>
     * The array of values to insert into the format string
     * </p>
     * @return string|false The formatted pattern string or <b>FALSE</b> if an error occurred
     */
    #[TentativeType]
    public static function formatMessage($locale, $pattern, array $values): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Quick parse input string
     * @link https://php.net/manual/en/messageformatter.parsemessage.php
     * @param string $locale <p>
     * The locale to use for parsing locale-dependent parts
     * </p>
     * @param string $pattern <p>
     * The pattern with which to parse the <i>value</i>.
     * </p>
     * @param string $message <p>
     * The string to parse, conforming to the <i>pattern</i>.
     * </p>
     * @return array|false An array containing items extracted, or <b>FALSE</b> on error
     */
    #[TentativeType]
    public static function parseMessage($locale, $pattern, $message): array|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Format the message
     * @link https://php.net/manual/en/messageformatter.format.php
     * @param array $values <p>
     * Arguments to insert into the format string
     * </p>
     * @return string|false The formatted string, or <b>FALSE</b> if an error occurred
     */
    #[Pure]
    #[TentativeType]
    public function format(array $values): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Parse input string according to pattern
     * @link https://php.net/manual/en/messageformatter.parse.php
     * @param string $string <p>
     * The string to parse
     * </p>
     * @return array|false An array containing the items extracted, or <b>FALSE</b> on error
     */
    #[Pure]
    #[TentativeType]
    public function parse($string): array|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Set the pattern used by the formatter
     * @link https://php.net/manual/en/messageformatter.setpattern.php
     * @param string $pattern <p>
     * The pattern string to use in this message formatter.
     * The pattern uses an 'apostrophe-friendly' syntax; it is run through
     * umsg_autoQuoteApostrophe
     * before being interpreted.
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function setPattern($pattern): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the pattern used by the formatter
     * @link https://php.net/manual/en/messageformatter.getpattern.php
     * @return string The pattern string for this message formatter
     */
    #[Pure]
    #[TentativeType]
    public function getPattern(): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the locale for which the formatter was created.
     * @link https://php.net/manual/en/messageformatter.getlocale.php
     * @return string The locale name
     */
    #[Pure]
    #[TentativeType]
    public function getLocale(): string {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the error code from last operation
     * @link https://php.net/manual/en/messageformatter.geterrorcode.php
     * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorCode(): int {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the error text from the last operation
     * @link https://php.net/manual/en/messageformatter.geterrormessage.php
     * @return string Description of the last error.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorMessage(): string {}
}

class IntlDateFormatter
{
    /**
     * Completely specified style (Tuesday, April 12, 1952 AD or 3:30:42pm PST)
     * @link https://php.net/manual/en/class.intldateformatter.php#intl.intldateformatter-constants
     */
    public const FULL = 0;

    /**
     * Long style (January 12, 1952 or 3:30:32pm)
     * @link https://php.net/manual/en/class.intldateformatter.php#intl.intldateformatter-constants
     */
    public const LONG = 1;

    /**
     * Medium style (Jan 12, 1952)
     * @link https://php.net/manual/en/class.intldateformatter.php#intl.intldateformatter-constants
     */
    public const MEDIUM = 2;

    /**
     * Most abbreviated style, only essential data (12/13/52 or 3:30pm)
     * @link https://php.net/manual/en/class.intldateformatter.php#intl.intldateformatter-constants
     */
    public const SHORT = 3;

    /**
     * Do not include this element
     * @link https://php.net/manual/en/class.intldateformatter.php#intl.intldateformatter-constants
     */
    public const NONE = -1;

    /**
     * Gregorian Calendar
     * @link https://php.net/manual/en/class.intldateformatter.php#intl.intldateformatter-constants
     */
    public const GREGORIAN = 1;

    /**
     * Non-Gregorian Calendar
     * @link https://php.net/manual/en/class.intldateformatter.php#intl.intldateformatter-constants
     */
    public const TRADITIONAL = 0;
    public const RELATIVE_FULL = 128;
    public const RELATIVE_LONG = 129;
    public const RELATIVE_MEDIUM = 130;
    public const RELATIVE_SHORT = 131;

    /**
     * @param string|null $locale
     * @param int $dateType
     * @param int $timeType
     * @param mixed|null $timezone [optional]
     * @param mixed|null $calendar [optional]
     * @param string $pattern [optional]
     */
    #[Pure]
    public function __construct($locale, $dateType, $timeType, $timezone = null, $calendar = null, $pattern = '') {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Create a date formatter
     * @link https://php.net/manual/en/intldateformatter.create.php
     * @param string $locale <p>
     * Locale to use when formatting or parsing; default is specified in the ini setting intl.default_locale.
     * </p>
     * @param int $dateType <p>
     * Date type to use (<b>none</b>,
     * <b>short</b>, <b>medium</b>,
     * <b>long</b>, <b>full</b>).
     * This is one of the
     * IntlDateFormatter constants.
     * </p>
     * @param int $timeType <p>
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
    #[TentativeType]
    public static function create($locale, $dateType, $timeType, $timezone = null, $calendar = null, $pattern = ''): ?IntlDateFormatter {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the datetype used for the IntlDateFormatter
     * @link https://php.net/manual/en/intldateformatter.getdatetype.php
     * @return int|false The current date type value of the formatter.
     */
    #[Pure]
    #[TentativeType]
    public function getDateType(): int|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the timetype used for the IntlDateFormatter
     * @link https://php.net/manual/en/intldateformatter.gettimetype.php
     * @return int|false The current date type value of the formatter.
     */
    #[Pure]
    #[TentativeType]
    public function getTimeType(): int|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the calendar used for the IntlDateFormatter
     * @link https://php.net/manual/en/intldateformatter.getcalendar.php
     * @return int|false The calendar being used by the formatter.
     */
    #[Pure]
    #[TentativeType]
    public function getCalendar(): int|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * sets the calendar used to the appropriate calendar, which must be
     * @link https://php.net/manual/en/intldateformatter.setcalendar.php
     * @param int $calendar <p>
     * The calendar to use.
     * Default is <b>IntlDateFormatter::GREGORIAN</b>.
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function setCalendar($calendar): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the timezone-id used for the IntlDateFormatter
     * @link https://php.net/manual/en/intldateformatter.gettimezoneid.php
     * @return string|false ID string for the time zone used by this formatter.
     */
    #[Pure]
    #[TentativeType]
    public function getTimeZoneId(): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Sets the time zone to use
     * @link https://php.net/manual/en/intldateformatter.settimezoneid.php
     * @param string $zone <p>
     * The time zone ID string of the time zone to use.
     * If <b>NULL</b> or the empty string, the default time zone for the runtime is used.
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @removed 7.0
     * @see IntlDateFormatter::setTimeZone()
     */
    #[Deprecated(replacement: "%class%->setTimeZone(%parametersList%)", since: "5.5")]
    public function setTimeZoneId($zone) {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Set the pattern used for the IntlDateFormatter
     * @link https://php.net/manual/en/intldateformatter.setpattern.php
     * @param string $pattern <p>
     * New pattern string to use.
     * Possible patterns are documented at http://userguide.icu-project.org/formatparse/datetime.
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * Bad formatstrings are usually the cause of the failure.
     */
    #[TentativeType]
    public function setPattern($pattern): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the pattern used for the IntlDateFormatter
     * @link https://php.net/manual/en/intldateformatter.getpattern.php
     * @return string The pattern string being used to format/parse.
     */
    #[Pure]
    #[TentativeType]
    public function getPattern(): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the locale used by formatter
     * @link https://php.net/manual/en/intldateformatter.getlocale.php
     * @param int $type [optional]
     * @return string|false the locale of this formatter or 'false' if error
     */
    #[Pure]
    #[TentativeType]
    public function getLocale(): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Set the leniency of the parser
     * @link https://php.net/manual/en/intldateformatter.setlenient.php
     * @param bool $lenient <p>
     * Sets whether the parser is lenient or not, default is <b>TRUE</b> (lenient).
     * </p>
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    #[TentativeType]
    public function setLenient($lenient): void {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the lenient used for the IntlDateFormatter
     * @link https://php.net/manual/en/intldateformatter.islenient.php
     * @return bool <b>TRUE</b> if parser is lenient, <b>FALSE</b> if parser is strict. By default the parser is lenient.
     */
    #[Pure]
    #[TentativeType]
    public function isLenient(): bool {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Format the date/time value as a string
     * @link https://php.net/manual/en/intldateformatter.format.php
     * @param mixed $datetime <p>
     * Value to format. This may be a <b>DateTime</b> object,
     * an integer representing a Unix timestamp value (seconds
     * since epoch, UTC) or an array in the format output by
     * <b>localtime</b>.
     * </p>
     * @return string|false The formatted string or, if an error occurred, <b>FALSE</b>.
     */
    #[TentativeType]
    public function format($datetime = null, $array = null): string|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Parse string to a timestamp value
     * @link https://php.net/manual/en/intldateformatter.parse.php
     * @param string $string <p>
     * string to convert to a time
     * </p>
     * @param int &$offset [optional] <p>
     * Position at which to start the parsing in $value (zero-based).
     * If no error occurs before $value is consumed, $parse_pos will contain -1
     * otherwise it will contain the position at which parsing ended (and the error occurred).
     * This variable will contain the end position if the parse fails.
     * If $parse_pos > strlen($value), the parse fails immediately.
     * </p>
     * @return int|float|false timestamp parsed value
     */
    #[TentativeType]
    public function parse($string, &$offset = null): int|float|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Parse string to a field-based time value
     * @link https://php.net/manual/en/intldateformatter.localtime.php
     * @param string $string <p>
     * string to convert to a time
     * </p>
     * @param int &$offset [optional] <p>
     * Position at which to start the parsing in $value (zero-based).
     * If no error occurs before $value is consumed, $parse_pos will contain -1
     * otherwise it will contain the position at which parsing ended .
     * If $parse_pos > strlen($value), the parse fails immediately.
     * </p>
     * @return array|false Localtime compatible array of integers : contains 24 hour clock value in tm_hour field
     */
    #[TentativeType]
    public function localtime($string, &$offset = null): array|false {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the error code from last operation
     * @link https://php.net/manual/en/intldateformatter.geterrorcode.php
     * @return int The error code, one of UErrorCode values. Initial value is U_ZERO_ERROR.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorCode(): int {}

    /**
     * (PHP 5 >= 5.3.0, PECL intl >= 1.0.0)<br/>
     * Get the error text from the last operation.
     * @link https://php.net/manual/en/intldateformatter.geterrormessage.php
     * @return string Description of the last error.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorMessage(): string {}
}

class ResourceBundle implements IteratorAggregate, Countable
{
    /**
     * @link https://www.php.net/manual/en/resourcebundle.create.php
     * @param string $locale <p>Locale for which the resources should be loaded (locale name, e.g. en_CA).</p>
     * @param string $bundle <p>The directory where the data is stored or the name of the .dat file.</p>
     * @param bool $fallback [optional] <p>Whether locale should match exactly or fallback to parent locale is allowed.</p>
     */
    #[Pure]
    public function __construct($locale, $bundle, $fallback = true) {}

    /**
     * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
     * Create a resource bundle
     * @link https://php.net/manual/en/resourcebundle.create.php
     * @param string $locale <p>
     * Locale for which the resources should be loaded (locale name, e.g. en_CA).
     * </p>
     * @param string $bundle <p>
     * The directory where the data is stored or the name of the .dat file.
     * </p>
     * @param bool $fallback [optional] <p>
     * Whether locale should match exactly or fallback to parent locale is allowed.
     * </p>
     * @return ResourceBundle|null <b>ResourceBundle</b> object or <b>null</b> on error.
     */
    #[TentativeType]
    public static function create($locale, $bundle, $fallback = true): ?ResourceBundle {}

    /**
     * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
     * Get supported locales
     * @link https://php.net/manual/en/resourcebundle.locales.php
     * @param string $bundle <p>
     * Path of ResourceBundle for which to get available locales, or
     * empty string for default locales list.
     * </p>
     * @return array the list of locales supported by the bundle.
     */
    #[TentativeType]
    public static function getLocales($bundle): array|false {}

    /**
     * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
     * Get data from the bundle
     * @link https://php.net/manual/en/resourcebundle.get.php
     * @param string|int $index <p>
     * Data index, must be string or integer.
     * </p>
     * @param bool $fallback
     * @return mixed the data located at the index or <b>NULL</b> on error. Strings, integers and binary data strings
     * are returned as corresponding PHP types, integer array is returned as PHP array. Complex types are
     * returned as <b>ResourceBundle</b> object.
     */
    #[Pure]
    #[TentativeType]
    public function get($index, $fallback = true): mixed {}

    /**
     * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
     * Get number of elements in the bundle
     * @link https://php.net/manual/en/resourcebundle.count.php
     * @return int<0,max> number of elements in the bundle.
     */
    #[Pure]
    #[TentativeType]
    public function count(): int {}

    /**
     * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
     * Get bundle's last error code.
     * @link https://php.net/manual/en/resourcebundle.geterrorcode.php
     * @return int error code from last bundle object call.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorCode(): int {}

    /**
     * (PHP >= 5.3.2, PECL intl >= 2.0.0)<br/>
     * Get bundle's last error message.
     * @link https://php.net/manual/en/resourcebundle.geterrormessage.php
     * @return string error message from last bundle object's call.
     */
    #[Pure]
    #[TentativeType]
    public function getErrorMessage(): string {}
}

/**
 * @link https://php.net/manual/en/class.spoofchecker.php
 */
class Spoofchecker
{
    public const SINGLE_SCRIPT_CONFUSABLE = 1;
    public const MIXED_SCRIPT_CONFUSABLE = 2;
    public const WHOLE_SCRIPT_CONFUSABLE = 4;
    public const ANY_CASE = 8;
    public const SINGLE_SCRIPT = 16;
    public const INVISIBLE = 32;
    public const CHAR_LIMIT = 64;
    public const ASCII = 268435456;
    public const HIGHLY_RESTRICTIVE = 805306368;
    public const MODERATELY_RESTRICTIVE = 1073741824;
    public const MINIMALLY_RESTRICTIVE = 1342177280;
    public const UNRESTRICTIVE = 1610612736;
    public const SINGLE_SCRIPT_RESTRICTIVE = 536870912;

    #[TentativeType]
    public function setRestrictionLevel(int $level): void {}
}

class IntlRuleBasedBreakIterator implements Traversable {}

class IntlCodePointBreakIterator implements Traversable {}

class UConverter
{
    public const REASON_UNASSIGNED = 0;
    public const REASON_ILLEGAL = 1;
    public const REASON_IRREGULAR = 2;
    public const REASON_RESET = 3;
    public const REASON_CLOSE = 4;
    public const REASON_CLONE = 5;
    public const UNSUPPORTED_CONVERTER = -1;
    public const SBCS = 0;
    public const DBCS = 1;
    public const MBCS = 2;
    public const LATIN_1 = 3;
    public const UTF8 = 4;
    public const UTF16_BigEndian = 5;
    public const UTF16_LittleEndian = 6;
    public const UTF32_BigEndian = 7;
    public const UTF32_LittleEndian = 8;
    public const EBCDIC_STATEFUL = 9;
    public const ISO_2022 = 10;
    public const LMBCS_1 = 11;
    public const LMBCS_2 = 12;
    public const LMBCS_3 = 13;
    public const LMBCS_4 = 14;
    public const LMBCS_5 = 15;
    public const LMBCS_6 = 16;
    public const LMBCS_8 = 17;
    public const LMBCS_11 = 18;
    public const LMBCS_16 = 19;
    public const LMBCS_17 = 20;
    public const LMBCS_18 = 21;
    public const LMBCS_19 = 22;
    public const LMBCS_LAST = 22;
    public const HZ = 23;
    public const SCSU = 24;
    public const ISCII = 25;
    public const US_ASCII = 26;
    public const UTF7 = 27;
    public const BOCU1 = 28;
    public const UTF16 = 29;
    public const UTF32 = 30;
    public const CESU8 = 31;
    public const IMAP_MAILBOX = 32;
}
