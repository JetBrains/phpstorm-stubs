<?php

// Start of snmp namespaced enums (PHP 8.6)

namespace Snmp;

    /**
     * MIB parsing options, accepted by snmp_set_mib_option().
     * @link https://php.net/manual/en/function.snmp-set-mib-option.php
     * @since 8.6
     */
    enum Mib
    {
        case AllowUnderscores;
        case CommentTerm;
        case Replace;
    }

    /**
     * OID output formats, accepted by snmp_set_oid_output_format(),
     * snmp_set_oid_numeric_print(), and SNMP::setOidOutputFormat().
     * @link https://php.net/manual/en/function.snmp-set-oid-output-format.php
     * @since 8.6
     */
    enum OidOutput
    {
        case Suffix;
        case Module;
        case Full;
        case Numeric;
        case Ucd;
        case None;
    }

    /**
     * Value output options, accepted by snmp_set_output_option().
     * @link https://php.net/manual/en/function.snmp-set-output-option.php
     * @since 8.6
     */
    enum Output
    {
        case NumericIndex;
        case EnumPrint;
        case EscapeQuotes;
        case QuickPrint;
        case NumericTimeticks;
        case HexText;
        case DontPrintUnits;
        case ExtendedIndex;
    }

    /**
     * String output formats, accepted by snmp_set_string_output_format() and
     * SNMP::setStringOutputFormat().
     * @link https://php.net/manual/en/function.snmp-set-string-output-format.php
     * @since 8.6
     */
    enum StringOutput
    {
        case Guess;
        case Ascii;
        case Hex;
    }
