<?php
/**
 * PHPStorm stub file for SNMP classes.
 *
 * @link http://php.net/manual/en/book.snmp.php
 */

/**
 * Represents SNMP session.
 *
 * @link http://php.net/manual/en/class.snmp.php
 */
class SNMP
{
    const ERRNO_ANY = 126;
    const ERRNO_ERROR_IN_REPLY = 8;
    const ERRNO_GENERIC = 2;
    const ERRNO_MULTIPLE_SET_QUERIES = 64;
    const ERRNO_NOERROR = 0;
    const ERRNO_OID_NOT_INCREASING = 16;
    const ERRNO_OID_PARSING_ERROR = 32;
    const ERRNO_TIMEOUT = 4;
    const VERSION_1 = 0;
    const VERSION_2C = 1;
    const VERSION_2c = 1;
    const VERSION_3 = 3;
    /**
     * @var bool Controls the way enum values are printed
     * <p>Parameter toggles if walk/get etc. should automatically lookup enum values in the MIB and return them
     * together with their human readable string.
     * @link http://www.php.net/manual/en/class.snmp.php#snmp.props.enum-print
     */
    public $enum_print;
    /**
     * @var int Controls which failures will raise SNMPException instead of warning. Use bitwise OR'ed SNMP::ERRNO_*
     *      constants. By default all SNMP exceptions are disabled.
     * @link http://www.php.net/manual/en/class.snmp.php#snmp.props.exceptions-enabled
     */
    public $exceptions_enabled;
    /**
     * @var array Read-only property with remote agent configuration: hostname, port, default timeout, default retries
     *      count
     * @link http://www.php.net/manual/en/class.snmp.php#snmp.props.info
     */
    public $info;
    /**
     * @var int Maximum OID per GET/SET/GETBULK request
     * @link http://www.php.net/manual/en/class.snmp.php#snmp.props.max-oids
     */
    public $max_oids;
    /**
     * @var bool Controls disabling check for increasing OID while walking OID tree
     * <p> Some SNMP agents are known for returning OIDs out of order but can complete the walk anyway. Other agents
     * return OIDs that are out of order and can cause SNMP::walk() to loop indefinitely until memory limit will be
     * reached. PHP SNMP library by default performs OID increasing check and stops walking on OID tree when it detects
     * possible loop with issuing warning about non-increasing OID faced. Set oid_increasing_check to <b>FALSE</b> to
     * disable this check.
     * @link http://www.php.net/manual/en/class.snmp.php#snmp.props.oid-increasing-check
     */
    public $oid_increasing_check;
    /**
     * @var int Controls OID output format
     * <p>OID .1.3.6.1.2.1.1.3.0 representation for various oid_output_format values
     * <dl>
     * <dt>SNMP_OID_OUTPUT_FULL    <dd>.iso.org.dod.internet.mgmt.mib-2.system.sysUpTime.sysUpTimeInstance
     * <dt>SNMP_OID_OUTPUT_NUMERIC    <dd>.1.3.6.1.2.1.1.3.0
     * <dt>SNMP_OID_OUTPUT_MODULE    <dd>DISMAN-EVENT-MIB::sysUpTimeInstance
     * <dt>SNMP_OID_OUTPUT_SUFFIX    <dd>sysUpTimeInstance
     * <dt>SNMP_OID_OUTPUT_UCD    <dd>system.sysUpTime.sysUpTimeInstance
     * <dt>SNMP_OID_OUTPUT_NONE    <dd>Undefined
     * </dl>
     * @link http://www.php.net/manual/en/class.snmp.php#snmp.props.oid-output-format
     */
    public $oid_output_format;
    /**
     * @var bool Value of quick_print within the NET-SNMP library
     * <p>Sets the value of quick_print within the NET-SNMP library. When this is set (1), the SNMP library will return
     * 'quick printed' values. This means that just the value will be printed. When quick_print is not enabled
     * (default) the UCD SNMP library prints extra information including the type of the value (i.e. IpAddress or OID).
     * Additionally, if quick_print is not enabled, the library prints additional hex values for all strings of three
     * characters or less.
     * @link http://www.php.net/manual/en/class.snmp.php#snmp.props.quick-print
     */
    public $quick_print;
    /**
     * @var int Controls the method how the SNMP values will be returned
     * <dl>
     * <dt>SNMP_VALUE_LIBRARY    <dd>The return values will be as returned by the Net-SNMP library.
     * <dt>SNMP_VALUE_PLAIN    <dd>The return values will be the plain value without the SNMP type hint.
     * <dt>SNMP_VALUE_OBJECT     <dd>The return values will be objects with the properties "value" and "type", where
     * the latter is one of the SNMP_OCTET_STR, SNMP_COUNTER etc. constants. The way "value" is returned is based on
     * which one of SNMP_VALUE_LIBRARY, SNMP_VALUE_PLAIN is set
     * <dl>
     * @link http://www.php.net/manual/en/class.snmp.php#snmp.props.max-oids
     */
    public $valueretrieval;

    /**
     * Creates SNMP instance representing session to remote SNMP agent
     *
     * @link  http://php.net/manual/en/snmp.construct.php
     *
     * @param $version   SNMP protocol version:
     *                   <b>SNMP::VERSION_1</b>,
     *                   <b>SNMP::VERSION_2C</b>,
     *                   <b>SNMP::VERSION_3</b>.
     * @param $hostname  string The SNMP agent. <i>hostname</i> may be suffixed with
     *                   optional <acronym title="Simple Network Management Protocol">SNMP</acronym> agent port after
     *                   colon. IPv6 addresses must be enclosed in square brackets if used with port. If FQDN is used
     *                   for <i>hostname</i> it will be resolved by php-snmp library, not by Net-SNMP engine. Usage of
     *                   IPv6 addresses when specifying FQDN may be forced by enclosing FQDN into square brackets. Here
     *                   it is some examples:
     *                   <table>
     *                   <tbody>
     *                   <tr><td>IPv4 with default port</td><td>127.0.0.1</td></tr>
     *                   <tr><td>IPv6 with default port</td><td>::1 or [::1]</td></tr>
     *                   <tr><td>IPv4 with specific port</td><td>127.0.0.1:1161</td></tr>
     *                   <tr><td>IPv6 with specific port</td><td>[::1]:1161</td></tr>
     *                   <tr><td>FQDN with default port</td><td>host.domain</td></tr>
     *                   <tr><td>FQDN with specific port</td><td>host.domain:1161</td></tr>
     *                   <tr><td>FQDN with default port, force usage of IPv6 address</td><td>[host.domain]</td></tr>
     *                   <tr><td>FQDN with specific port, force usage of IPv6 address</td><td>[host.domain]:1161</td>
     *                   </tbody>
     *                   </table>
     * @param $community string <p>The purpuse of <i>community</i> is
     *                   <acronym title="Simple Network Management Protocol">SNMP</acronym> version specific:</p>
     *                   <table>
     *
     * @since 5.4.0
     *
     * <tbody>
     * <tr><td>SNMP::VERSION_1</td><td><acronym title="Simple Network Management Protocol">SNMP</acronym>
     * community</td></tr>
     * <tr><td>SNMP::VERSION_2C</td><td><acronym title="Simple Network Management Protocol">SNMP</acronym>
     * community</td></tr>
     *
     * <tr><td>SNMP::VERSION_3</td><td><acronym title="Simple Network Management Protocol">SNMP</acronym>v3
     * securityName</td></tr>
     * </tbody>
     * </table>
     *
     * @param $timeout   [optional] int The number of microseconds until the first timeout.
     * @param $retries   [optional] int The number of retries in case timeout occurs.
     */
    public function __construct($version, $hostname, $community, $timeout = 1000000, $retries = 5) { }

    /**
     * Close SNMP session
     *
     * @link  http://php.net/manual/en/snmp.close.php
     * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.4.0
     */
    public function close() { }

    /**
     * Fetch an SNMP object
     *
     * @link  http://php.net/manual/en/snmp.get.php
     *
     * @param $object_id     mixed The SNMP object (OID) or objects
     * @param $preserve_keys bool [optional] When object_id is a array and preserve_keys set to <b>TRUE</b> keys in
     *                       results will be taken exactly as in object_id, otherwise SNMP::oid_output_format property
     *                       is used to determinate the form of keys.
     *
     * @return mixed SNMP objects requested as string or array
     * depending on <i>object_id</i> type or <b>FALSE</b> on error.
     * @since 5.4.0
     */
    public function get($object_id, $preserve_keys = false) { }

    /**
     * Get last error code
     *
     * @link  http://php.net/manual/en/snmp.geterrno.php
     * @return int one of SNMP error code values described in constants chapter.
     * @since 5.4.0
     */
    public function getErrno() { }

    /**
     * Get last error message
     *
     * @link  http://php.net/manual/en/snmp.geterror.php
     * @return string String describing error from last SNMP request.
     * @since 5.4.0
     */
    public function getError() { }

    /**
     * Fetch an SNMP object which
     * follows the given object id
     *
     * @link  http://php.net/manual/en/snmp.getnext.php
     *
     * @param $object_id mixed <p>
     *                   The <acronym title="Simple Network Management Protocol">SNMP</acronym> object (OID) or objects
     *                   </p>
     *
     * @return mixed SNMP objects requested as string or array
     * depending on <i>object_id</i> type or <b>FALSE</b> on error.
     * @since 5.4.0
     */
    public function getnext($object_id) { }

    /**
     * Set the value of an SNMP object
     *
     * @link  http://php.net/manual/en/snmp.set.php
     *
     * @param $object_id string <p>The SNMP object id</p>
     *
     * @since 5.4.0
     *
     * <p>When count of OIDs in object_id array is greater than
     * max_oids object property set method will have to use multiple queries
     * to perform requested value updates. In this case type and value checks
     * are made per-chunk so second or subsequent requests may fail due to
     * wrong type or value for OID requested. To mark this a warning is
     * raised when count of OIDs in object_id array is greater than max_oids.
     * When count of OIDs in object_id array is greater than max_oids object property set method will have to use
     * multiple queries to perform requested value updates. In this case type and value checks are made per-chunk so
     * second or subsequent requests may fail due to wrong type or value for OID requested. To mark this a warning is
     * raised when count of OIDs in object_id array is greater than max_oids.</p>
     *
     * @param $type      mixed <p>The MIB defines the type of each object id. It has to be specified as a single
     *                   character from the below list.</p>
     *                   <table>
     *                   <b>types</b>
     *                   <tbody>
     *                   <tr><td>=</td><td>The type is taken from the MIB</td></tr>
     *                   <tr><td>i</td><td>INTEGER</td> </tr>
     *                   <tr><td>u</td><td>INTEGER</td></tr>
     *                   <tr><td>s</td><td>STRING</td></tr>
     *                   <tr><td>x</td><td>HEX STRING</td></tr>
     *                   <tr><td>d</td><td>DECIMAL STRING</td></tr>
     *                   <tr><td>n</td><td>NULLOBJ</td></tr>
     *                   <tr><td>o</td><td>OBJID</td></tr>
     *                   <tr><td>t</td><td>TIMETICKS</td></tr>
     *                   <tr><td>a</td><td>IPADDRESS</td></tr>
     *                   <tr><td>b</td><td>BITS</td></tr>
     *                   </tbody>
     *                   </table>
     *                   <p>
     *                   If <b>OPAQUE_SPECIAL_TYPES</b> was defined while compiling the SNMP library, the following are
     *                   also valid:
     *                   </p>
     *                   <table>
     *                   <b>types</b>
     *                   <tbody>
     *                   <tr><td>U</td><td>unsigned int64</td></tr>
     *                   <tr><td>I</td><td>signed int64</td></tr>
     *                   <tr><td>F</td><td>float</td></tr>
     *                   <tr><td>D</td><td>double</td></tr>
     *                   </tbody>
     *                   </table>
     *                   <p>
     *                   Most of these will use the obvious corresponding ASN.1 type.  's', 'x', 'd' and 'b' are all
     *                   different ways of specifying an OCTET STRING value, and the 'u' unsigned type is also used for
     *                   handling Gauge32 values.
     *                   </p>
     *
     * <p>
     * If the MIB-Files are loaded by into the MIB Tree with "snmp_read_mib" or by specifying it in the libsnmp config,
     * '=' may be used as the <i>type</code></i> parameter for all object ids as the type can then be automatically
     * read from the MIB.
     * </p>
     * <p>
     * Note that there are two ways to set a variable of the type BITS like e.g.
     * "SYNTAX    BITS {telnet(0), ftp(1), http(2), icmp(3), snmp(4), ssh(5), https(6)}":
     * </p>
     * <ul>
     * <li>
     * Using type "b" and a list of bit numbers. This method is not recommended since GET query for the same OID would
     * return e.g. 0xF8.
     * </li>
     * <li>
     * Using type "x" and a hex number but without(!) the usual "0x" prefix.
     * </li>
     * </ul>
     * <p>
     * See examples section for more details.
     * </p>
     * @param $value     mixed <p>
     *                   The new value.</p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function set($object_id, $type, $value) { }

    /**
     * Configures security-related SNMPv3 session parameters
     *
     * @link  http://php.net/manual/en/snmp.setsecurity.php
     *
     * @param $sec_level       string the security level (noAuthNoPriv|authNoPriv|authPriv)
     * @param $auth_protocol   string [optional] the authentication protocol (MD5 or SHA)
     * @param $auth_passphrase string [optional] the authentication pass phrase
     * @param $priv_protocol   string [optional] the privacy protocol (DES or AES)
     * @param $priv_passphrase string [optional] the privacy pass phrase
     * @param $contextName     string [optional] the context name
     * @param $contextEngineID string [optional] the context EngineID
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.4.0
     */
    public function setSecurity(
        $sec_level,
        $auth_protocol,
        $auth_passphrase,
        $priv_protocol,
        $priv_passphrase,
        $contextName,
        $contextEngineID
    ) {
    }

    /**
     * Fetch SNMP object subtree
     *
     * @link  http://php.net/manual/en/snmp.walk.php
     *
     * @param $object_id       string <p>Root of subtree to be fetched</p>
     * @param $suffix_as_keys  bool [optional] <p>By default full OID notation is used for keys in output array. If set
     *                         to <b>TRUE</b> subtree prefix will be removed from keys leaving only suffix of
     *                         object_id.</p>
     * @param $max_repetitions int [optional] <p>This specifies the maximum number of iterations over the repeating
     *                         variables. The default is to use this value from SNMP object.</p>
     * @param $non_repeaters   int [optional] <p>This specifies the number of supplied variables that should not be
     *                         iterated over. The default is to use this value from SNMP object.</p>
     *
     * @return array associative array of the SNMP object ids and their values on success or <b>FALSE</b> on error.
     * When a SNMP error occures <b>SNMP::getErrno</b> and
     * <b>SNMP::getError</b> can be used for retrieving error
     * number (specific to SNMP extension, see class constants) and error message
     * respectively.
     * @since 5.4.0
     */
    public function walk($object_id, $suffix_as_keys = false, $max_repetitions, $non_repeaters) { }
}

/**
 * Represents an error raised by SNMP. You should not throw a
 * <b>SNMPException</b> from your own code.
 * See Exceptions for more
 * information about Exceptions in PHP.
 *
 * @link http://php.net/manual/en/class.snmpexception.php
 */
class SNMPException extends RuntimeException
{
}
