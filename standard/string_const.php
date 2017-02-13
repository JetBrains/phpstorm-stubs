<?php
const ABDAY_1 = 131072;
const ABDAY_2 = 131073;
const ABDAY_3 = 131074;
const ABDAY_4 = 131075;
const ABDAY_5 = 131076;
const ABDAY_6 = 131077;
const ABDAY_7 = 131078;
const ABMON_1 = 131086;
const ABMON_10 = 131095;
const ABMON_11 = 131096;
const ABMON_12 = 131097;
const ABMON_2 = 131087;
const ABMON_3 = 131088;
const ABMON_4 = 131089;
const ABMON_5 = 131090;
const ABMON_6 = 131091;
const ABMON_7 = 131092;
const ABMON_8 = 131093;
const ABMON_9 = 131094;
const ALT_DIGITS = 131119;
const AM_STR = 131110;
const CHAR_MAX = 127;
const CODESET = 14;
const CRNCYSTR = 262159;
const CRYPT_BLOWFISH = 1;
const CRYPT_EXT_DES = 1;
const CRYPT_MD5 = 1;
const CRYPT_SALT_LENGTH = 123;
const CRYPT_SHA256 = 1;
const CRYPT_SHA512 = 1;
const CRYPT_STD_DES = 1;
const DAY_1 = 131079;
const DAY_2 = 131080;
const DAY_3 = 131081;
const DAY_4 = 131082;
const DAY_5 = 131083;
const DAY_6 = 131084;
const DAY_7 = 131085;
const D_FMT = 131113;
const D_T_FMT = 131112;
const ENT_COMPAT = 2;
/**
 * Replace invalid code points for the given document type with
 * a Unicode Replacement Character U+FFFD (UTF-8) or &#FFFD;
 * (otherwise) instead of leaving them as is. This may be useful,
 * for instance, to ensure the well-formedness of XML documents
 * with embedded external content.
 *
 * @link  http://php.net/manual/en/function.htmlspecialchars.php
 * @since 5.4.0
 */
const ENT_DISALLOWED = 128;
/**
 * Handle code as HTML 4.01.
 *
 * @link  http://php.net/manual/en/function.htmlspecialchars.php
 * @since 5.4.0
 */
const ENT_HTML401 = 0;
/**
 * Handle code as HTML 5.
 *
 * @link  http://php.net/manual/en/function.htmlspecialchars.php
 * @since 5.4.0
 */
const ENT_HTML5 = 48;
/**
 * @since 5.3.0
 */
const ENT_IGNORE = 4;
const ENT_NOQUOTES = 0;
const ENT_QUOTES = 3;
/**
 * Replace invalid code unit sequences with a Unicode Replacement Character
 * U+FFFD (UTF-8) or &#FFFD; (otherwise) instead of returning an empty string.
 *
 * @link  http://php.net/manual/en/function.htmlspecialchars.php
 * @since 5.4.0
 */
const ENT_SUBSTITUTE = 8;
/**
 * Handle code as XHTML.
 *
 * @link  http://php.net/manual/en/function.htmlspecialchars.php
 * @since 5.4.0
 */
const ENT_XHTML = 32;
/**
 * Handle code as XML 1.
 *
 * @link  http://php.net/manual/en/function.htmlspecialchars.php
 * @since 5.4.0
 */
const ENT_XML1 = 16;
const ERA = 131116;
const ERA_D_FMT = 131118;
const ERA_D_T_FMT = 131120;
const ERA_T_FMT = 131121;
const HTML_ENTITIES = 1;
const HTML_SPECIALCHARS = 0;
const LC_ALL = 6;
const LC_COLLATE = 3;
const LC_CTYPE = 0;
const LC_MESSAGES = 5;
const LC_MONETARY = 4;
const LC_NUMERIC = 1;
const LC_TIME = 2;
const MON_1 = 131098;
const MON_10 = 131107;
const MON_11 = 131108;
const MON_12 = 131109;
const MON_2 = 131099;
const MON_3 = 131100;
const MON_4 = 131101;
const MON_5 = 131102;
const MON_6 = 131103;
const MON_7 = 131104;
const MON_8 = 131105;
const MON_9 = 131106;
const NOEXPR = 327681;
const PM_STR = 131111;
const RADIXCHAR = 65536;
const STR_PAD_BOTH = 2;
const STR_PAD_LEFT = 0;
const STR_PAD_RIGHT = 1;
const THOUSEP = 65537;
const T_FMT = 131114;
const T_FMT_AMPM = 131115;
const YESEXPR = 327680;
