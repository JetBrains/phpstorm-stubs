<?php

// Start of snmp namespaced enums (PHP 8.6)

namespace Snmp;

/**
 * MIB parsing options, accepted by snmp_set_mib_option().
 * @since 8.6
 */
enum Mib implements \UnitEnum
{
    case AllowUnderscores;
    case CommentTerm;
    case Replace;

    public static function cases(): array {}
}

/**
 * OID output formats, accepted by snmp_set_oid_output_format(),
 * snmp_set_oid_numeric_print(), and SNMP::setOidOutputFormat().
 * @link https://php.net/manual/en/function.snmp-set-oid-output-format.php
 * @since 8.6
 */
enum OidOutput implements \UnitEnum
{
    case Suffix;
    case Module;
    case Full;
    case Numeric;
    case Ucd;
    case None;

    public static function cases(): array {}
}

/**
 * Value output options, accepted by snmp_set_output_option().
 * @since 8.6
 */
enum Output implements \UnitEnum
{
    case NumericIndex;
    case EnumPrint;
    case EscapeQuotes;
    case QuickPrint;
    case NumericTimeticks;
    case HexText;
    case DontPrintUnits;
    case ExtendedIndex;

    public static function cases(): array {}
}

/**
 * String output formats, accepted by snmp_set_string_output_format() and
 * SNMP::setStringOutputFormat().
 * @since 8.6
 */
enum StringOutput implements \UnitEnum
{
    case Guess;
    case Ascii;
    case Hex;

    public static function cases(): array {}
}
