<?php
/**
 * PHPStorm stub file for Data Filtering constants.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */

/**
 * ID of "callback" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_CALLBACK = 1024;
/**
 * ID of default ("string") filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_DEFAULT = 516;
/**
 * Allow fractional part in "number_float" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_ALLOW_FRACTION = 4096;
/**
 * Allow hex notation (0x[0-9a-fA-F]+) in "int" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_ALLOW_HEX = 2;
/**
 * Allow octal notation (0[0-7]+) in "int" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_ALLOW_OCTAL = 1;
/**
 * Allow scientific notation (e, E) in
 * "number_float" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_ALLOW_SCIENTIFIC = 16384;
/**
 * Allow thousand separator (,) in "number_float" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_ALLOW_THOUSAND = 8192;
const FILTER_FLAG_EMAIL_UNICODE = 1048576;
/**
 * (No use for now.)
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_EMPTY_STRING_NULL = 256;
/**
 * Encode &#38;#38;.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_ENCODE_AMP = 64;
/**
 * Encode characters with ASCII value greater than 127.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_ENCODE_HIGH = 32;
/**
 * Encode characters with ASCII value less than 32.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_ENCODE_LOW = 16;
/**
 * Require host in "validate_url" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_HOST_REQUIRED = 131072;
/**
 * Allow only IPv4 address in "validate_ip" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_IPV4 = 1048576;
/**
 * Allow only IPv6 address in "validate_ip" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_IPV6 = 2097152;
/**
 * No flags.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_NONE = 0;
/**
 * Don't encode ' and ".
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_NO_ENCODE_QUOTES = 128;
/**
 * Deny private addresses in "validate_ip" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_NO_PRIV_RANGE = 8388608;
/**
 * Deny reserved addresses in "validate_ip" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_NO_RES_RANGE = 4194304;
/**
 * Require path in "validate_url" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_PATH_REQUIRED = 262144;
/**
 * Require query in "validate_url" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_QUERY_REQUIRED = 524288;
/**
 * Require scheme in "validate_url" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_SCHEME_REQUIRED = 65536;
const FILTER_FLAG_STRIP_BACKTICK = 512;
/**
 * Strip characters with ASCII value greater than 127.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_STRIP_HIGH = 8;
/**
 * Strip characters with ASCII value less than 32.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FLAG_STRIP_LOW = 4;
/**
 * Always returns an array.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_FORCE_ARRAY = 67108864;
/**
 * Use NULL instead of FALSE on failure.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_NULL_ON_FAILURE = 134217728;
/**
 * Require an array as input.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_REQUIRE_ARRAY = 16777216;
/**
 * Flag used to require scalar as input
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_REQUIRE_SCALAR = 33554432;
/**
 * ID of "email" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_SANITIZE_EMAIL = 517;
/**
 * ID of "encoded" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_SANITIZE_ENCODED = 514;
/**
 * Equivalent to calling htmlspecialchars() with ENT_QUOTES set.
 * Encoding quotes can be disabled by setting FILTER_FLAG_NO_ENCODE_QUOTES.
 * Like htmlspecialchars(), this filter is aware of the default_charset
 * and if a sequence of bytes is detected that makes up an invalid character
 * in the current character set then the entire string is rejected resulting in
 * a 0-length string.
 *
 * @link http://php.net/manual/en/filter.filters.sanitize.php
 */
const FILTER_SANITIZE_FULL_SPECIAL_CHARS = 515;
/**
 * ID of "magic_quotes" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_SANITIZE_MAGIC_QUOTES = 521;
/**
 * ID of "number_float" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_SANITIZE_NUMBER_FLOAT = 520;
/**
 * ID of "number_int" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_SANITIZE_NUMBER_INT = 519;
/**
 * ID of "special_chars" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_SANITIZE_SPECIAL_CHARS = 515;
/**
 * ID of "string" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_SANITIZE_STRING = 513;
/**
 * ID of "stripped" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_SANITIZE_STRIPPED = 513;
/**
 * ID of "url" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_SANITIZE_URL = 518;
/**
 * ID of "unsafe_raw" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_UNSAFE_RAW = 516;
/**
 * ID of "boolean" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_VALIDATE_BOOLEAN = 258;
/**
 * ID of "validate_email" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_VALIDATE_EMAIL = 274;
/**
 * ID of "float" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_VALIDATE_FLOAT = 259;
/**
 * ID of "int" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_VALIDATE_INT = 257;
/**
 * ID of "validate_ip" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_VALIDATE_IP = 275;
const FILTER_VALIDATE_MAC = 276;
/**
 * ID of "validate_regexp" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_VALIDATE_REGEXP = 272;
/**
 * ID of "validate_url" filter.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const FILTER_VALIDATE_URL = 273;
/**
 * COOKIE variables.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const INPUT_COOKIE = 2;
/**
 * ENV variables.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const INPUT_ENV = 4;
/**
 * GET variables.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const INPUT_GET = 1;
/**
 * POST variables.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const INPUT_POST = 0;
/**
 * REQUEST variables.
 * (not implemented yet)
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const INPUT_REQUEST = 99;
/**
 * SERVER variables.
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const INPUT_SERVER = 5;
/**
 * SESSION variables.
 * (not implemented yet)
 *
 * @link http://php.net/manual/en/filter.constants.php
 */
const INPUT_SESSION = 6;
