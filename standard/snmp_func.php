<?php
/**
 * PHPStorm stub file for SNMP functions.
 *
 * @link http://php.net/manual/en/book.snmp.php
 */

/**
 * Fetch an SNMP object
 *
 * @link  http://php.net/manual/en/function.snmp2-get.php
 *
 * @param string $host      <p>
 *                          The SNMP agent.
 *                          </p>
 * @param string $community <p>
 *                          The read community.
 *                          </p>
 * @param string $object_id <p>
 *                          The SNMP object.
 *                          </p>
 * @param int    $timeout   [optional] <p>
 *                          The number of microseconds until the first timeout.
 *                          </p>
 * @param int    $retries   [optional] <p>
 *                          The number of times to retry if timeouts occur.
 *                          </p>
 *
 * @return string SNMP object value on success or <b>FALSE</b> on error.
 * @since 5.2.0
 */
function snmp2_get($host, $community, $object_id, $timeout = 1000000, $retries = 5) { }

/**
 * Fetch the SNMP object which follows the given object id
 *
 * @link  http://php.net/manual/en/function.snmp2-getnext.php
 *
 * @param string $host      <p>
 *                          The hostname of the SNMP agent (server).
 *                          </p>
 * @param string $community <p>
 *                          The read community.
 *                          </p>
 * @param string $object_id <p>
 *                          The SNMP object id which precedes the wanted one.
 *                          </p>
 * @param int    $timeout   [optional] <p>
 *                          The number of microseconds until the first timeout.
 *                          </p>
 * @param int    $retries   [optional] <p>
 *                          The number of times to retry if timeouts occur.
 *                          </p>
 *
 * @return string SNMP object value on success or <b>FALSE</b> on error.
 * In case of an error, an E_WARNING message is shown.
 * @since 5.2.0
 */
function snmp2_getnext($host, $community, $object_id, $timeout = 1000000, $retries = 5) { }

/**
 * Return all objects including their respective object ID within the specified one
 *
 * @link  http://php.net/manual/en/function.snmp2-real-walk.php
 *
 * @param string $host      <p>
 *                          The hostname of the SNMP agent (server).
 *                          </p>
 * @param string $community <p>
 *                          The read community.
 *                          </p>
 * @param string $object_id <p>
 *                          The SNMP object id which precedes the wanted one.
 *                          </p>
 * @param int    $timeout   [optional] <p>
 *                          The number of microseconds until the first timeout.
 *                          </p>
 * @param int    $retries   [optional] <p>
 *                          The number of times to retry if timeouts occur.
 *                          </p>
 *
 * @return array an associative array of the SNMP object ids and their values on success or <b>FALSE</b> on error.
 * In case of an error, an E_WARNING message is shown.
 * @since 5.2.0
 */
function snmp2_real_walk($host, $community, $object_id, $timeout = 1000000, $retries = 5) { }

/**
 * Set the value of an SNMP object
 *
 * @link  http://php.net/manual/en/function.snmp2-set.php
 *
 * @param string $host      <p>
 *                          The hostname of the SNMP agent (server).
 *                          </p>
 * @param string $community <p>
 *                          The write community.
 *                          </p>
 * @param string $object_id <p>
 *                          The SNMP object id.
 *                          </p>
 * @param string $type      The MIB defines the type of each object id. It has to be specified as a single
 *                          character from the below list.
 *                          </p>
 *                          types
 *                          <tr valign="top"><td>=</td><td>The type is taken from the MIB</td></tr>
 *                          <tr valign="top"><td>i</td><td>INTEGER</td> </tr>
 *                          <tr valign="top"><td>u</td><td>INTEGER</td></tr>
 *                          <tr valign="top"><td>s</td><td>STRING</td></tr>
 *                          <tr valign="top"><td>x</td><td>HEX STRING</td></tr>
 *                          <tr valign="top"><td>d</td><td>DECIMAL STRING</td></tr>
 *                          <tr valign="top"><td>n</td><td>NULLOBJ</td></tr>
 *                          <tr valign="top"><td>o</td><td>OBJID</td></tr>
 *                          <tr valign="top"><td>t</td><td>TIMETICKS</td></tr>
 *                          <tr valign="top"><td>a</td><td>IPADDRESS</td></tr>
 *                          <tr valign="top"><td>b</td><td>BITS</td></tr>
 *                          </table>
 *                          If <b>OPAQUE_SPECIAL_TYPES</b> was defined while compiling the SNMP library, the
 *                          following are also valid:
 *                          </p>
 *                          types
 *                          <tr valign="top"><td>U</td><td>unsigned int64</td></tr>
 *                          <tr valign="top"><td>I</td><td>signed int64</td></tr>
 *                          <tr valign="top"><td>F</td><td>float</td></tr>
 *                          <tr valign="top"><td>D</td><td>double</td></tr>
 *                          </table>
 *                          Most of these will use the obvious corresponding ASN.1 type. &#x00027;s&#x00027;,
 *                          &#x00027;x&#x00027;, &#x00027;d&#x00027; and &#x00027;b&#x00027; are all different ways
 *                          of specifying an OCTET STRING value, and the &#x00027;u&#x00027; unsigned type is also
 *                          used for handling Gauge32 values.
 *                          </p>
 *                          If the MIB-Files are loaded by into the MIB Tree with "snmp_read_mib" or by specifying
 *                          it in the libsnmp config, &#x00027;=&#x00027; may be used as the <i>type</i> parameter
 *                          for all object ids as the type can then be automatically read from the MIB.
 *                          </p>
 *                          Note that there are two ways to set a variable of the type BITS like e.g.
 *                          "SYNTAX BITS {telnet(0), ftp(1), http(2), icmp(3), snmp(4), ssh(5), https(6)}":
 *                          </p>
 *                          Using type "b" and a list of bit numbers. This method is not recommended since GET
 *                          query for the same OID would return e.g. 0xF8. Using type "x" and a hex number but
 *                          without(!) the usual "0x" prefix. See examples section for more details.
 *                          </p>
 * @param string $value     <p>
 *                          The new value.
 *                          </p>
 * @param int    $timeout   [optional] <p>
 *                          The number of microseconds until the first timeout.
 *                          </p>
 * @param int    $retries   [optional] <p>
 *                          The number of times to retry if timeouts occur.
 *                          </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * If the SNMP host rejects the data type, an E_WARNING message like "Warning: Error in packet. Reason: (badValue)
 * The value given has the wrong type or length." is shown. If an unknown or invalid OID is specified the warning
 * probably reads "Could not add variable".
 * @since 5.2.0
 */
function snmp2_set($host, $community, $object_id, $type, $value, $timeout = 1000000, $retries = 5) { }

/**
 * Fetch all the SNMP objects from an agent
 *
 * @link  http://php.net/manual/en/function.snmp2-walk.php
 *
 * @param string $host      <p>
 *                          The SNMP agent (server).
 *                          </p>
 * @param string $community <p>
 *                          The read community.
 *                          </p>
 * @param string $object_id <p>
 *                          If <b>NULL</b>, <i>object_id</i> is taken as the root of
 *                          the SNMP objects tree and all objects under that tree are returned as
 *                          an array.
 *                          </p>
 *                          <p>
 *                          If <i>object_id</i> is specified, all the SNMP objects
 *                          below that <i>object_id</i> are returned.
 *                          </p>
 * @param int    $timeout   [optional] <p>
 *                          The number of microseconds until the first timeout.
 *                          </p>
 * @param int    $retries   [optional] <p>
 *                          The number of times to retry if timeouts occur.
 *                          </p>
 *
 * @return array an array of SNMP object values starting from the
 * <i>object_id</i> as root or <b>FALSE</b> on error.
 * @since 5.2.0
 */
function snmp2_walk($host, $community, $object_id, $timeout = 1000000, $retries = 5) { }

/**
 * Fetch an SNMP object
 *
 * @link  http://php.net/manual/en/function.snmp3-get.php
 *
 * @param string $host            <p>
 *                                The hostname of the SNMP agent (server).
 *                                </p>
 * @param string $sec_name        <p>
 *                                the security name, usually some kind of username
 *                                </p>
 * @param string $sec_level       <p>
 *                                the security level (noAuthNoPriv|authNoPriv|authPriv)
 *                                </p>
 * @param string $auth_protocol   <p>
 *                                the authentication protocol (MD5 or SHA)
 *                                </p>
 * @param string $auth_passphrase <p>
 *                                the authentication pass phrase
 *                                </p>
 * @param string $priv_protocol   <p>
 *                                the privacy protocol (DES or AES)
 *                                </p>
 * @param string $priv_passphrase <p>
 *                                the privacy pass phrase
 *                                </p>
 * @param string $object_id       <p>
 *                                The SNMP object id.
 *                                </p>
 * @param int    $timeout         [optional] <p>
 *                                The number of microseconds until the first timeout.
 *                                </p>
 * @param int    $retries         [optional] <p>
 *                                The number of times to retry if timeouts occur.
 *                                </p>
 *
 * @return string SNMP object value on success or <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function snmp3_get(
    $host,
    $sec_name,
    $sec_level,
    $auth_protocol,
    $auth_passphrase,
    $priv_protocol,
    $priv_passphrase,
    $object_id,
    $timeout = 1000000,
    $retries = 5
) {
}

/**
 * Fetch the SNMP object which follows the given object id
 *
 * @link  http://php.net/manual/en/function.snmp3-getnext.php
 *
 * @param string $host            <p>
 *                                The hostname of the
 *                                SNMP agent (server).
 *                                </p>
 * @param string $sec_name        <p>
 *                                the security name, usually some kind of username
 *                                </p>
 * @param string $sec_level       <p>
 *                                the security level (noAuthNoPriv|authNoPriv|authPriv)
 *                                </p>
 * @param string $auth_protocol   <p>
 *                                the authentication protocol (MD5 or SHA)
 *                                </p>
 * @param string $auth_passphrase <p>
 *                                the authentication pass phrase
 *                                </p>
 * @param string $priv_protocol   <p>
 *                                the privacy protocol (DES or AES)
 *                                </p>
 * @param string $priv_passphrase <p>
 *                                the privacy pass phrase
 *                                </p>
 * @param string $object_id       <p>
 *                                The SNMP object id.
 *                                </p>
 * @param int    $timeout         [optional] <p>
 *                                The number of microseconds until the first timeout.
 *                                </p>
 * @param int    $retries         [optional] <p>
 *                                The number of times to retry if timeouts occur.
 *                                </p>
 *
 * @return string SNMP object value on success or <b>FALSE</b> on error.
 * In case of an error, an E_WARNING message is shown.
 * @since 5.0
 */
function snmp3_getnext(
    $host,
    $sec_name,
    $sec_level,
    $auth_protocol,
    $auth_passphrase,
    $priv_protocol,
    $priv_passphrase,
    $object_id,
    $timeout = 1000000,
    $retries = 5
) {
}

/**
 * Return all objects including their respective object ID within the specified one
 *
 * @link  http://php.net/manual/en/function.snmp3-real-walk.php
 *
 * @param string $host            <p>
 *                                The hostname of the
 *                                SNMP agent (server).
 *                                </p>
 * @param string $sec_name        <p>
 *                                the security name, usually some kind of username
 *                                </p>
 * @param string $sec_level       <p>
 *                                the security level (noAuthNoPriv|authNoPriv|authPriv)
 *                                </p>
 * @param string $auth_protocol   <p>
 *                                the authentication protocol (MD5 or SHA)
 *                                </p>
 * @param string $auth_passphrase <p>
 *                                the authentication pass phrase
 *                                </p>
 * @param string $priv_protocol   <p>
 *                                the privacy protocol (DES or AES)
 *                                </p>
 * @param string $priv_passphrase <p>
 *                                the privacy pass phrase
 *                                </p>
 * @param string $object_id       <p>
 *                                The SNMP object id.
 *                                </p>
 * @param string $timeout         [optional] <p>
 *                                The number of microseconds until the first timeout.
 *                                </p>
 * @param string $retries         [optional] <p>
 *                                The number of times to retry if timeouts occur.
 *                                </p>
 *
 * @return array an associative array of the
 * SNMP object ids and their values on success or <b>FALSE</b> on error.
 * In case of an error, an E_WARNING message is shown.
 * @since 4.0
 * @since 5.0
 */
function snmp3_real_walk(
    $host,
    $sec_name,
    $sec_level,
    $auth_protocol,
    $auth_passphrase,
    $priv_protocol,
    $priv_passphrase,
    $object_id,
    $timeout = null,
    $retries = null
) {
}

/**
 * Set the value of an SNMP object
 *
 * @link  http://php.net/manual/en/function.snmp3-set.php
 *
 * @param string $host            <p>
 *                                The hostname of the SNMP agent (server).
 *                                </p>
 * @param string $sec_name        <p>
 *                                the security name, usually some kind of username
 *                                </p>
 * @param string $sec_level       <p>
 *                                the security level (noAuthNoPriv|authNoPriv|authPriv)
 *                                </p>
 * @param string $auth_protocol   <p>
 *                                the authentication protocol (MD5 or SHA)
 *                                </p>
 * @param string $auth_passphrase <p>
 *                                the authentication pass phrase
 *                                </p>
 * @param string $priv_protocol   <p>
 *                                the privacy protocol (DES or AES)
 *                                </p>
 * @param string $priv_passphrase <p>
 *                                the privacy pass phrase
 *                                </p>
 * @param string $object_id       <p>
 *                                The SNMP object id.
 *                                </p>
 * @param string $type            The MIB defines the type of each object id. It has to be specified as a single
 *                                character from the below list.
 *                                </p>
 *                                types
 *                                <tr valign="top"><td>=</td><td>The type is taken from the MIB</td></tr>
 *                                <tr valign="top"><td>i</td><td>INTEGER</td> </tr>
 *                                <tr valign="top"><td>u</td><td>INTEGER</td></tr>
 *                                <tr valign="top"><td>s</td><td>STRING</td></tr>
 *                                <tr valign="top"><td>x</td><td>HEX STRING</td></tr>
 *                                <tr valign="top"><td>d</td><td>DECIMAL STRING</td></tr>
 *                                <tr valign="top"><td>n</td><td>NULLOBJ</td></tr>
 *                                <tr valign="top"><td>o</td><td>OBJID</td></tr>
 *                                <tr valign="top"><td>t</td><td>TIMETICKS</td></tr>
 *                                <tr valign="top"><td>a</td><td>IPADDRESS</td></tr>
 *                                <tr valign="top"><td>b</td><td>BITS</td></tr>
 *                                </table>
 *                                If <b>OPAQUE_SPECIAL_TYPES</b> was defined while compiling the SNMP library, the
 *                                following are also valid:
 *                                </p>
 *                                types
 *                                <tr valign="top"><td>U</td><td>unsigned int64</td></tr>
 *                                <tr valign="top"><td>I</td><td>signed int64</td></tr>
 *                                <tr valign="top"><td>F</td><td>float</td></tr>
 *                                <tr valign="top"><td>D</td><td>double</td></tr>
 *                                </table>
 *                                Most of these will use the obvious corresponding ASN.1 type. &#x00027;s&#x00027;,
 *                                &#x00027;x&#x00027;, &#x00027;d&#x00027; and &#x00027;b&#x00027; are all
 *                                different ways of specifying an OCTET STRING value, and the &#x00027;u&#x00027;
 *                                unsigned type is also used for handling Gauge32 values.
 *                                </p>
 *                                If the MIB-Files are loaded by into the MIB Tree with "snmp_read_mib" or by
 *                                specifying it in the libsnmp config, &#x00027;=&#x00027; may be used as the
 *                                <i>type</i> parameter for all object ids as the type can then be automatically
 *                                read from the MIB.
 *                                </p>
 *                                Note that there are two ways to set a variable of the type BITS like e.g.
 *                                "SYNTAX BITS {telnet(0), ftp(1), http(2), icmp(3), snmp(4), ssh(5), https(6)}":
 *                                </p>
 *                                Using type "b" and a list of bit numbers. This method is not recommended since
 *                                GET query for the same OID would return e.g. 0xF8. Using type "x" and a hex
 *                                number but without(!) the usual "0x" prefix. See examples section for more
 *                                details.
 *                                </p>
 * @param string $value           <p>
 *                                The new value
 *                                </p>
 * @param int    $timeout         [optional] <p>
 *                                The number of microseconds until the first timeout.
 *                                </p>
 * @param int    $retries         [optional] <p>
 *                                The number of times to retry if timeouts occur.
 *                                </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * If the SNMP host rejects the data type, an E_WARNING message like "Warning: Error in packet. Reason: (badValue)
 * The value given has the wrong type or length." is shown. If an unknown or invalid OID is specified the warning
 * probably reads "Could not add variable".
 * @since 4.0
 * @since 5.0
 */
function snmp3_set(
    $host,
    $sec_name,
    $sec_level,
    $auth_protocol,
    $auth_passphrase,
    $priv_protocol,
    $priv_passphrase,
    $object_id,
    $type,
    $value,
    $timeout = 1000000,
    $retries = 5
) {
}

/**
 * Fetch all the SNMP objects from an agent
 *
 * @link  http://php.net/manual/en/function.snmp3-walk.php
 *
 * @param string $host            <p>
 *                                The hostname of the SNMP agent (server).
 *                                </p>
 * @param string $sec_name        <p>
 *                                the security name, usually some kind of username
 *                                </p>
 * @param string $sec_level       <p>
 *                                the security level (noAuthNoPriv|authNoPriv|authPriv)
 *                                </p>
 * @param string $auth_protocol   <p>
 *                                the authentication protocol (MD5 or SHA)
 *                                </p>
 * @param string $auth_passphrase <p>
 *                                the authentication pass phrase
 *                                </p>
 * @param string $priv_protocol   <p>
 *                                the privacy protocol (DES or AES)
 *                                </p>
 * @param string $priv_passphrase <p>
 *                                the privacy pass phrase
 *                                </p>
 * @param string $object_id       <p>
 *                                If <b>NULL</b>, <i>object_id</i> is taken as the root of
 *                                the SNMP objects tree and all objects under that tree are returned as
 *                                an array.
 *                                </p>
 *                                <p>
 *                                If <i>object_id</i> is specified, all the SNMP objects
 *                                below that <i>object_id</i> are returned.
 *                                </p>
 * @param int    $timeout         [optional] <p>
 *                                The number of microseconds until the first timeout.
 *                                </p>
 * @param int    $retries         [optional] <p>
 *                                The number of times to retry if timeouts occur.
 *                                </p>
 *
 * @return array an array of SNMP object values starting from the
 * <i>object_id</i> as root or <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function snmp3_walk(
    $host,
    $sec_name,
    $sec_level,
    $auth_protocol,
    $auth_passphrase,
    $priv_protocol,
    $priv_passphrase,
    $object_id,
    $timeout = 1000000,
    $retries = 5
) {
}

/**
 * Fetches the current value of the UCD library's quick_print setting
 *
 * @link  http://php.net/manual/en/function.snmp-get-quick-print.php
 * @return bool <b>TRUE</b> if quick_print is on, <b>FALSE</b> otherwise.
 * @since 4.0
 * @since 5.0
 */
function snmp_get_quick_print() { }

/**
 * Return the method how the SNMP values will be returned
 *
 * @link  http://php.net/manual/en/function.snmp-get-valueretrieval.php
 * @return int OR-ed combitantion of constants ( <b>SNMP_VALUE_LIBRARY</b> or
 * <b>SNMP_VALUE_PLAIN</b> ) with
 * possible SNMP_VALUE_OBJECT set.
 * @since 4.3.3
 * @since 5.0
 */
function snmp_get_valueretrieval() { }

/**
 * Reads and parses a MIB file into the active MIB tree
 *
 * @link  http://php.net/manual/en/function.snmp-read-mib.php
 *
 * @param string $filename <p>The filename of the MIB.</p>
 *
 * @return bool
 * @since 5.0
 */
function snmp_read_mib($filename) { }

/**
 * Return all values that are enums with their enum value instead of the raw integer
 *
 * @link  http://php.net/manual/en/function.snmp-set-enum-print.php
 *
 * @param int $enum_print <p>
 *                        As the value is interpreted as boolean by the Net-SNMP library, it can only be "0" or "1".
 *                        </p>
 *
 * @return bool
 * @since 4.3.0
 * @since 5.0
 */
function snmp_set_enum_print($enum_print) { }

/**
 * Return all objects including their respective object id within the specified one
 *
 * @link  http://php.net/manual/en/function.snmp-set-oid-numeric-print.php
 *
 * @param int $oid_format
 *
 * @return void
 * @since 4.3.0
 * @since 5.0
 */
function snmp_set_oid_numeric_print($oid_format) { }

/**
 * Set the OID output format
 *
 * @link  http://php.net/manual/en/function.snmp-set-oid-output-format.php
 *
 * @param int $oid_format [optional] <table>
 *                        OID .1.3.6.1.2.1.1.3.0 representation for various <i>oid_format</i> values
 *                        <tr
 *                        valign="top"><td><b>SNMP_OID_OUTPUT_FULL</b></td><td>.iso.org.dod.internet.mgmt.mib-2.system.sysUpTime.sysUpTimeInstance</td></tr>
 *                        <tr valign="top"><td><b>SNMP_OID_OUTPUT_NUMERIC</b></td><td>.1.3.6.1.2.1.1.3.0</td> </tr>
 *                        </table>
 *                        <p>Begining from PHP 5.4.0 four additional constants available:
 *                        <table>
 *                        <tr
 *                        valign="top"><td><b>SNMP_OID_OUTPUT_MODULE</b></td><td>DISMAN-EVENT-MIB::sysUpTimeInstance</td></tr>
 *                        <tr valign="top"><td><b>SNMP_OID_OUTPUT_SUFFIX</b></td><td>sysUpTimeInstance</td></tr>
 *                        <tr
 *                        valign="top"><td><b>SNMP_OID_OUTPUT_UCD</b></td><td>system.sysUpTime.sysUpTimeInstance</td></tr>
 *                        <tr valign="top"><td><b>SNMP_OID_OUTPUT_NONE</b></td><td>Undefined</td></tr>
 *                        </table>
 *                        </p>
 *
 * @return bool No value is returned.
 * @since 5.2.0
 */
function snmp_set_oid_output_format($oid_format = SNMP_OID_OUTPUT_MODULE) { }

/**
 * Set the value of <i>quick_print</i> within the UCD SNMP library
 *
 * @link  http://php.net/manual/en/function.snmp-set-quick-print.php
 *
 * @param bool $quick_print
 *
 * @return bool No value is returned.
 * @since 4.0
 * @since 5.0
 */
function snmp_set_quick_print($quick_print) { }

/**
 * Specify the method how the SNMP values will be returned
 *
 * @link  http://php.net/manual/en/function.snmp-set-valueretrieval.php
 *
 * @param int $method <table>
 *                    types
 *                    <tr valign="top">
 *                    <td>SNMP_VALUE_LIBRARY</td>
 *                    <td>The return values will be as returned by the Net-SNMP library.</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>SNMP_VALUE_PLAIN</td>
 *                    <td>The return values will be the plain value without the SNMP type hint.</td>
 *                    </tr>
 *                    <tr valign="top">
 *                    <td>SNMP_VALUE_OBJECT</td>
 *                    <td>
 *                    The return values will be objects with the properties "value" and "type", where the latter
 *                    is one of the SNMP_OCTET_STR, SNMP_COUNTER etc. constants. The
 *                    way "value" is returned is based on which one of constants
 *                    <b>SNMP_VALUE_LIBRARY</b>, <b>SNMP_VALUE_PLAIN</b> is set.
 *                    </td>
 *                    </tr>
 *                    </table>
 *
 * @return bool
 * @since 4.3.3
 * @since 5.0
 */
function snmp_set_valueretrieval($method) { }

/**
 * Fetch an SNMP object
 *
 * @link  http://php.net/manual/en/function.snmpget.php
 *
 * @param string $hostname  <p>
 *                          The SNMP agent.
 *                          </p>
 * @param string $community <p>
 *                          The read community.
 *                          </p>
 * @param string $object_id <p>
 *                          The SNMP object.
 *                          </p>
 * @param int    $timeout   [optional] <p>
 *                          The number of microseconds until the first timeout.
 *                          </p>
 * @param int    $retries   [optional] <p>
 *                          The number of times to retry if timeouts occur.
 *                          </p>
 *
 * @return string SNMP object value on success or <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function snmpget($hostname, $community, $object_id, $timeout = 1000000, $retries = 5) { }

/**
 * Fetch the SNMP object which follows the given object id
 *
 * @link  http://php.net/manual/en/function.snmpgetnext.php
 *
 * @param string $host      <p>The hostname of the SNMP agent (server).</p>
 * @param string $community <p>The read community.</p>
 * @param string $object_id <p>The SNMP object id which precedes the wanted one.</p>
 * @param int    $timeout   [optional] <p>The number of microseconds until the first timeout.</p>
 * @param int    $retries   [optional] <p>The number of times to retry if timeouts occur.</p>
 *
 * @return string SNMP object value on success or <b>FALSE</b> on error.
 * In case of an error, an E_WARNING message is shown.
 * @since 5.0
 */
function snmpgetnext($host, $community, $object_id, $timeout = 1000000, $retries = 5) { }

/**
 * Return all objects including their respective object ID within the specified one
 *
 * @link  http://php.net/manual/en/function.snmprealwalk.php
 *
 * @param string $host      <p>The hostname of the SNMP agent (server).</p>
 * @param string $community <p>The read community.</p>
 * @param string $object_id <p>The SNMP object id which precedes the wanted one.</p>
 * @param int    $timeout   [optional] <p>The number of microseconds until the first timeout.</p>
 * @param int    $retries   [optional] <p>The number of times to retry if timeouts occur.</p>
 *
 * @return array an associative array of the SNMP object ids and their values on success or <b>FALSE</b> on error.
 * In case of an error, an E_WARNING message is shown.
 * @since 4.0
 * @since 5.0
 */
function snmprealwalk($host, $community, $object_id, $timeout = 1000000, $retries = 5) { }

/**
 * Set the value of an SNMP object
 *
 * @link  http://php.net/manual/en/function.snmpset.php
 *
 * @param string $host      <p>
 *                          The hostname of the SNMP agent (server).
 *                          </p>
 * @param string $community <p>
 *                          The write community.
 *                          </p>
 * @param string $object_id <p>
 *                          The SNMP object id.
 *                          </p>
 * @param string $type      The MIB defines the type of each object id. It has to be specified as a single
 *                          character from the below list.
 *                          </p>
 *                          types
 *                          <tr valign="top"><td>=</td><td>The type is taken from the MIB</td></tr>
 *                          <tr valign="top"><td>i</td><td>INTEGER</td> </tr>
 *                          <tr valign="top"><td>u</td><td>INTEGER</td></tr>
 *                          <tr valign="top"><td>s</td><td>STRING</td></tr>
 *                          <tr valign="top"><td>x</td><td>HEX STRING</td></tr>
 *                          <tr valign="top"><td>d</td><td>DECIMAL STRING</td></tr>
 *                          <tr valign="top"><td>n</td><td>NULLOBJ</td></tr>
 *                          <tr valign="top"><td>o</td><td>OBJID</td></tr>
 *                          <tr valign="top"><td>t</td><td>TIMETICKS</td></tr>
 *                          <tr valign="top"><td>a</td><td>IPADDRESS</td></tr>
 *                          <tr valign="top"><td>b</td><td>BITS</td></tr>
 *                          </table>
 *                          If <b>OPAQUE_SPECIAL_TYPES</b> was defined while compiling the SNMP library, the
 *                          following are also valid:
 *                          </p>
 *                          types
 *                          <tr valign="top"><td>U</td><td>unsigned int64</td></tr>
 *                          <tr valign="top"><td>I</td><td>signed int64</td></tr>
 *                          <tr valign="top"><td>F</td><td>float</td></tr>
 *                          <tr valign="top"><td>D</td><td>double</td></tr>
 *                          </table>
 *                          Most of these will use the obvious corresponding ASN.1 type. &#x00027;s&#x00027;,
 *                          &#x00027;x&#x00027;, &#x00027;d&#x00027; and &#x00027;b&#x00027; are all different ways
 *                          of specifying an OCTET STRING value, and the &#x00027;u&#x00027; unsigned type is also
 *                          used for handling Gauge32 values.
 *                          </p>
 *                          If the MIB-Files are loaded by into the MIB Tree with "snmp_read_mib" or by specifying
 *                          it in the libsnmp config, &#x00027;=&#x00027; may be used as the <i>type</i> parameter
 *                          for all object ids as the type can then be automatically read from the MIB.
 *                          </p>
 *                          Note that there are two ways to set a variable of the type BITS like e.g.
 *                          "SYNTAX BITS {telnet(0), ftp(1), http(2), icmp(3), snmp(4), ssh(5), https(6)}":
 *                          </p>
 *                          Using type "b" and a list of bit numbers. This method is not recommended since GET
 *                          query for the same OID would return e.g. 0xF8. Using type "x" and a hex number but
 *                          without(!) the usual "0x" prefix. See examples section for more details.
 *                          </p>
 * @param mixed  $value     <p>
 *                          The new value.
 *                          </p>
 * @param int    $timeout   [optional] <p>
 *                          The number of microseconds until the first timeout.
 *                          </p>
 * @param int    $retries   [optional] <p>
 *                          The number of times to retry if timeouts occur.
 *                          </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * If the SNMP host rejects the data type, an E_WARNING message like "Warning: Error in packet. Reason: (badValue)
 * The value given has the wrong type or length." is shown. If an unknown or invalid OID is specified the warning
 * probably reads "Could not add variable".
 * @since 4.0
 * @since 5.0
 */
function snmpset($host, $community, $object_id, $type, $value, $timeout = 1000000, $retries = 5) { }

/**
 * Fetch all the SNMP objects from an agent
 *
 * @link  http://php.net/manual/en/function.snmpwalk.php
 *
 * @param string $hostname  <p>
 *                          The SNMP agent (server).
 *                          </p>
 * @param string $community <p>
 *                          The read community.
 *                          </p>
 * @param string $object_id <p>
 *                          If <b>NULL</b>, <i>object_id</i> is taken as the root of
 *                          the SNMP objects tree and all objects under that tree are returned as
 *                          an array.
 *                          </p>
 *                          <p>
 *                          If <i>object_id</i> is specified, all the SNMP objects
 *                          below that <i>object_id</i> are returned.
 *                          </p>
 * @param int    $timeout   [optional] <p>
 *                          The number of microseconds until the first timeout.
 *                          </p>
 * @param int    $retries   [optional] <p>The number of times to retry if timeouts occur.</p>
 *
 * @return array an array of SNMP object values starting from the
 * <i>object_id</i> as root or <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function snmpwalk($hostname, $community, $object_id, $timeout = 1000000, $retries = 5) { }

/**
 * Query for a tree of information about a network entity
 *
 * @link  http://php.net/manual/en/function.snmpwalkoid.php
 *
 * @param string $hostname  <p>
 *                          The SNMP agent.
 *                          </p>
 * @param string $community <p>
 *                          The read community.
 *                          </p>
 * @param string $object_id <p>
 *                          If <b>NULL</b>, <i>object_id</i> is taken as the root of
 *                          the SNMP objects tree and all objects under that tree are returned as
 *                          an array.
 *                          </p>
 *                          <p>
 *                          If <i>object_id</i> is specified, all the SNMP objects
 *                          below that <i>object_id</i> are returned.
 *                          </p>
 * @param int    $timeout   [optional] <p>
 *                          The number of microseconds until the first timeout.
 *                          </p>
 * @param int    $retries   [optional] <p>
 *                          The number of times to retry if timeouts occur.
 *                          </p>
 *
 * @return array an associative array with object ids and their respective
 * object value starting from the <i>object_id</i>
 * as root or <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function snmpwalkoid($hostname, $community, $object_id, $timeout = 1000000, $retries = 5) { }
