<?php
/**
 * PHPStorm stub file for Internationalization constants.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */

/**
 *
 */
const GRAPHEME_EXTR_COUNT = 0;
const GRAPHEME_EXTR_MAXBYTES = 1;
const GRAPHEME_EXTR_MAXCHARS = 2;
/**
 * Allow processing of unassigned codepoints in the input for IDN functions.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const IDNA_ALLOW_UNASSIGNED = 1;
/**
 * Check whether the input conforms to the BiDi rules.
 * Ignored by the IDNA2003 implementation, which always performs this check.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const IDNA_CHECK_BIDI = 4;
/**
 * Check whether the input conforms to the CONTEXTJ rules.
 * Ignored by the IDNA2003 implementation, as this check is new in IDNA2008.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const IDNA_CHECK_CONTEXTJ = 8;
/**
 * Prohibit processing of unassigned codepoints in the input for IDN
 * functions and do not check if the input conforms to domain name ASCII rules.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const IDNA_DEFAULT = 0;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_BIDI = 2048;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_CONTEXTJ = 4096;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_DISALLOWED = 128;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_DOMAIN_NAME_TOO_LONG = 4;
/**
 * Errors reported in a bitset returned by the UTS #46 algorithm in
 * <b>idn_to_utf8</b> and
 * <b>idn_to_ascii</b>.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const IDNA_ERROR_EMPTY_LABEL = 1;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_HYPHEN_3_4 = 32;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_INVALID_ACE_LABEL = 1024;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_LABEL_HAS_DOT = 512;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_LABEL_TOO_LONG = 2;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_LEADING_COMBINING_MARK = 64;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_LEADING_HYPHEN = 8;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_PUNYCODE = 256;
/**
 * @link  http://www.php.net/manual/en/migration54.global-constants.php
 * @since 5.4
 */
const IDNA_ERROR_TRAILING_HYPHEN = 16;
/**
 * Option for nontransitional processing in
 * <b>idn_to_ascii</b>. Transitional processing is activated
 * by default. This option is ignored by the IDNA2003 implementation.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const IDNA_NONTRANSITIONAL_TO_ASCII = 16;
/**
 * Option for nontransitional processing in
 * <b>idn_to_utf8</b>. Transitional processing is activated
 * by default. This option is ignored by the IDNA2003 implementation.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const IDNA_NONTRANSITIONAL_TO_UNICODE = 32;
/**
 * Check if the input for IDN functions conforms to domain name ASCII rules.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const IDNA_USE_STD3_RULES = 2;
const INTL_ICU_DATA_VERSION = '4.8.1';
const INTL_ICU_VERSION = '4.8.1.1';
/**
 * Use IDNA 2003 algorithm in <b>idn_to_utf8</b> and
 * <b>idn_to_ascii</b>. This is the default.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const INTL_IDNA_VARIANT_2003 = 0;
/**
 * Use UTS #46 algorithm in <b>idn_to_utf8</b> and
 * <b>idn_to_ascii</b>.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const INTL_IDNA_VARIANT_UTS46 = 1;
/**
 * Limit on locale length, set to 80 in PHP code. Locale names longer
 * than this limit will not be accepted.
 *
 * @link http://php.net/manual/en/intl.constants.php
 */
const INTL_MAX_LOCALE_LEN = 80;
const ULOC_ACTUAL_LOCALE = 0;
const ULOC_VALID_LOCALE = 1;
const U_AMBIGUOUS_ALIAS_WARNING = -122;
const U_BAD_VARIABLE_DEFINITION = 65536;
const U_BRK_ASSIGN_ERROR = 66053;
const U_BRK_ERROR_LIMIT = 66062;
const U_BRK_ERROR_START = 66048;
const U_BRK_HEX_DIGITS_EXPECTED = 66049;
const U_BRK_INIT_ERROR = 66058;
const U_BRK_INTERNAL_ERROR = 66048;
const U_BRK_MALFORMED_RULE_TAG = 66061;
const U_BRK_MISMATCHED_PAREN = 66055;
const U_BRK_NEW_LINE_IN_QUOTED_STRING = 66056;
const U_BRK_RULE_EMPTY_SET = 66059;
const U_BRK_RULE_SYNTAX = 66051;
const U_BRK_SEMICOLON_EXPECTED = 66050;
const U_BRK_UNCLOSED_SET = 66052;
const U_BRK_UNDEFINED_VARIABLE = 66057;
const U_BRK_UNRECOGNIZED_OPTION = 66060;
const U_BRK_VARIABLE_REDFINITION = 66054;
const U_BUFFER_OVERFLOW_ERROR = 15;
const U_CE_NOT_FOUND_ERROR = 21;
const U_COLLATOR_VERSION_MISMATCH = 28;
const U_DIFFERENT_UCA_VERSION = -121;
const U_ENUM_OUT_OF_SYNC_ERROR = 25;
const U_ERROR_LIMIT = 66818;
const U_ERROR_WARNING_LIMIT = -119;
const U_ERROR_WARNING_START = -128;
const U_FILE_ACCESS_ERROR = 4;
const U_FMT_PARSE_ERROR_LIMIT = 65810;
const U_FMT_PARSE_ERROR_START = 65792;
const U_IDNA_ACE_PREFIX_ERROR = 66564;
const U_IDNA_CHECK_BIDI_ERROR = 66562;
const U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR = 66568;
const U_IDNA_ERROR_LIMIT = 66569;
const U_IDNA_ERROR_START = 66560;
const U_IDNA_LABEL_TOO_LONG_ERROR = 66566;
const U_IDNA_PROHIBITED_ERROR = 66560;
const U_IDNA_STD3_ASCII_RULES_ERROR = 66563;
const U_IDNA_UNASSIGNED_ERROR = 66561;
const U_IDNA_VERIFICATION_ERROR = 66565;
const U_IDNA_ZERO_LENGTH_LABEL_ERROR = 66567;
const U_ILLEGAL_ARGUMENT_ERROR = 1;
const U_ILLEGAL_CHARACTER = 65567;
const U_ILLEGAL_CHAR_FOUND = 12;
const U_ILLEGAL_CHAR_IN_SEGMENT = 65564;
const U_ILLEGAL_ESCAPE_SEQUENCE = 18;
const U_ILLEGAL_PAD_POSITION = 65800;
const U_INDEX_OUTOFBOUNDS_ERROR = 8;
const U_INTERNAL_PROGRAM_ERROR = 5;
const U_INTERNAL_TRANSLITERATOR_ERROR = 65568;
const U_INVALID_CHAR_FOUND = 10;
const U_INVALID_FORMAT_ERROR = 3;
const U_INVALID_FUNCTION = 65570;
const U_INVALID_ID = 65569;
const U_INVALID_PROPERTY_PATTERN = 65561;
const U_INVALID_RBT_SYNTAX = 65560;
const U_INVALID_STATE_ERROR = 27;
const U_INVALID_TABLE_FILE = 14;
const U_INVALID_TABLE_FORMAT = 13;
const U_INVARIANT_CONVERSION_ERROR = 26;
const U_MALFORMED_EXPONENTIAL_PATTERN = 65795;
const U_MALFORMED_PRAGMA = 65562;
const U_MALFORMED_RULE = 65537;
const U_MALFORMED_SET = 65538;
const U_MALFORMED_SYMBOL_REFERENCE = 65539;
const U_MALFORMED_UNICODE_ESCAPE = 65540;
const U_MALFORMED_VARIABLE_DEFINITION = 65541;
const U_MALFORMED_VARIABLE_REFERENCE = 65542;
const U_MEMORY_ALLOCATION_ERROR = 7;
const U_MESSAGE_PARSE_ERROR = 6;
const U_MISMATCHED_SEGMENT_DELIMITERS = 65543;
const U_MISPLACED_ANCHOR_START = 65544;
const U_MISPLACED_COMPOUND_FILTER = 65558;
const U_MISPLACED_CURSOR_OFFSET = 65545;
const U_MISPLACED_QUANTIFIER = 65546;
const U_MISSING_OPERATOR = 65547;
const U_MISSING_RESOURCE_ERROR = 2;
const U_MISSING_SEGMENT_CLOSE = 65548;
const U_MULTIPLE_ANTE_CONTEXTS = 65549;
const U_MULTIPLE_COMPOUND_FILTERS = 65559;
const U_MULTIPLE_CURSORS = 65550;
const U_MULTIPLE_DECIMAL_SEPARATORS = 65793;
const U_MULTIPLE_DECIMAL_SEPERATORS = 65793;
const U_MULTIPLE_EXPONENTIAL_SYMBOLS = 65794;
const U_MULTIPLE_PAD_SPECIFIERS = 65798;
const U_MULTIPLE_PERCENT_SYMBOLS = 65796;
const U_MULTIPLE_PERMILL_SYMBOLS = 65797;
const U_MULTIPLE_POST_CONTEXTS = 65551;
const U_NO_SPACE_AVAILABLE = 20;
const U_NO_WRITE_PERMISSION = 30;
const U_PARSE_ERROR = 9;
const U_PARSE_ERROR_LIMIT = 65571;
const U_PARSE_ERROR_START = 65536;
const U_PATTERN_SYNTAX_ERROR = 65799;
const U_PRIMARY_TOO_LONG_ERROR = 22;
const U_REGEX_BAD_ESCAPE_SEQUENCE = 66307;
const U_REGEX_BAD_INTERVAL = 66312;
const U_REGEX_ERROR_LIMIT = 66324;
const U_REGEX_ERROR_START = 66304;
const U_REGEX_INTERNAL_ERROR = 66304;
const U_REGEX_INVALID_BACK_REF = 66314;
const U_REGEX_INVALID_FLAG = 66315;
const U_REGEX_INVALID_STATE = 66306;
const U_REGEX_LOOK_BEHIND_LIMIT = 66316;
const U_REGEX_MAX_LT_MIN = 66313;
const U_REGEX_MISMATCHED_PAREN = 66310;
const U_REGEX_NUMBER_TOO_BIG = 66311;
const U_REGEX_PROPERTY_SYNTAX = 66308;
const U_REGEX_RULE_SYNTAX = 66305;
const U_REGEX_SET_CONTAINS_STRING = 66317;
const U_REGEX_UNIMPLEMENTED = 66309;
const U_RESOURCE_TYPE_MISMATCH = 17;
const U_RULE_MASK_ERROR = 65557;
const U_SAFECLONE_ALLOCATED_WARNING = -126;
const U_SORT_KEY_TOO_SHORT_WARNING = -123;
const U_STANDARD_ERROR_LIMIT = 31;
const U_STATE_OLD_WARNING = -125;
const U_STATE_TOO_OLD_ERROR = 23;
const U_STRINGPREP_CHECK_BIDI_ERROR = 66562;
const U_STRINGPREP_PROHIBITED_ERROR = 66560;
const U_STRINGPREP_UNASSIGNED_ERROR = 66561;
const U_STRING_NOT_TERMINATED_WARNING = -124;
const U_TOO_MANY_ALIASES_ERROR = 24;
const U_TRAILING_BACKSLASH = 65552;
const U_TRUNCATED_CHAR_FOUND = 11;
const U_UNCLOSED_SEGMENT = 65563;
const U_UNDEFINED_SEGMENT_REFERENCE = 65553;
const U_UNDEFINED_VARIABLE = 65554;
const U_UNEXPECTED_TOKEN = 65792;
const U_UNMATCHED_BRACES = 65801;
const U_UNQUOTED_SPECIAL = 65555;
const U_UNSUPPORTED_ATTRIBUTE = 65803;
const U_UNSUPPORTED_ERROR = 16;
const U_UNSUPPORTED_ESCAPE_SEQUENCE = 19;
const U_UNSUPPORTED_PROPERTY = 65802;
const U_UNTERMINATED_QUOTE = 65556;
const U_USELESS_COLLATOR_ERROR = 29;
const U_USING_DEFAULT_WARNING = -127;
const U_USING_FALLBACK_WARNING = -128;
const U_VARIABLE_RANGE_EXHAUSTED = 65565;
const U_VARIABLE_RANGE_OVERLAP = 65566;
const U_ZERO_ERROR = 0;
