<?php

// Start of snmp v.

/**
 * (PHP 4, PHP 5)<br/>
 * Fetch an <acronym>SNMP</acronym> object
 * @link http://php.net/manual/en/function.snmpget.php
 * @param string $hostname <p>
 * The SNMP agent.
 * </p>
 * @param string $community <p>
 * The read community.
 * </p>
 * @param string $object_id <p>
 * The SNMP object.
 * </p>
 * @param int $timeout [optional] <p>
 * The number of microseconds until the first timeout.
 * </p>
 * @param int $retries [optional] <p>
 * </p>
 * @return string SNMP object value on success or false on error.
 */
function snmpget ($hostname, $community, $object_id, $timeout = null, $retries = null) {}

/**
 * (PHP 5)<br/>
 * Fetch a SNMP object
 * @link http://php.net/manual/en/function.snmpgetnext.php
 * @param string $host 
 * @param string $community 
 * @param string $object_id 
 * @param int $timeout [optional] 
 * @param int $retries [optional] 
 * @return string
 */
function snmpgetnext ($host, $community, $object_id, $timeout = null, $retries = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Fetch all the <acronym>SNMP</acronym> objects from an agent
 * @link http://php.net/manual/en/function.snmpwalk.php
 * @param string $hostname <p>
 * The SNMP agent.
 * </p>
 * @param string $community <p>
 * The read community.
 * </p>
 * @param string $object_id <p>
 * If &null;, object_id is taken as the root of
 * the SNMP objects tree and all objects under that tree are returned as
 * an array. 
 * </p>
 * <p>
 * If object_id is specified, all the SNMP objects
 * below that object_id are returned.
 * </p>
 * @param int $timeout [optional] <p>
 * The number of microseconds until the first timeout.
 * </p>
 * @param int $retries [optional] <p>
 * </p>
 * @return array an array of SNMP object values starting from the
 * object_id as root or false on error.
 */
function snmpwalk ($hostname, $community, $object_id, $timeout = null, $retries = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Return all objects including their respective object ID within the specified one
 * @link http://php.net/manual/en/function.snmprealwalk.php
 * @param string $host 
 * @param string $community 
 * @param string $object_id 
 * @param int $timeout [optional] 
 * @param int $retries [optional] 
 * @return array
 */
function snmprealwalk ($host, $community, $object_id, $timeout = null, $retries = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Query for a tree of information about a network entity
 * @link http://php.net/manual/en/function.snmpwalkoid.php
 * @param string $hostname <p>
 * The SNMP agent.
 * </p>
 * @param string $community <p>
 * The read community.
 * </p>
 * @param string $object_id <p>
 * If &null;, object_id is taken as the root of
 * the SNMP objects tree and all objects under that tree are returned as
 * an array. 
 * </p>
 * <p>
 * If object_id is specified, all the SNMP objects
 * below that object_id are returned.
 * </p>
 * @param int $timeout [optional] <p>
 * The number of microseconds until the first timeout.
 * </p>
 * @param int $retries [optional] <p>
 * </p>
 * @return array an associative array with object ids and their respective
 * object value starting from the object_id
 * as root or false on error.
 */
function snmpwalkoid ($hostname, $community, $object_id, $timeout = null, $retries = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Fetches the current value of the UCD library's quick_print setting
 * @link http://php.net/manual/en/function.snmp-get-quick-print.php
 * @param $d
 * @return bool true if quick_print is on, false otherwise.
 */
function snmp_get_quick_print ($d) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Set the value of <parameter>quick_print</parameter> within the UCD <acronym>SNMP</acronym> library
 * @link http://php.net/manual/en/function.snmp-set-quick-print.php
 * @param bool $quick_print <p>
 * </p>
 * @return void
 */
function snmp_set_quick_print ($quick_print) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Return all values that are enums with their enum value instead of the raw integer
 * @link http://php.net/manual/en/function.snmp-set-enum-print.php
 * @param int $enum_print 
 * @return void
 */
function snmp_set_enum_print ($enum_print) {}

/**
 * (PHP 5 &gt;= 5.2.0)<br/>
 * Set the OID output format
 * @link http://php.net/manual/en/function.snmp-set-oid-output-format.php
 * @param int $oid_format <p>
 * Set it to SNMP_OID_OUTPUT_FULL if you want a full
 * output, SNMP_OID_OUTPUT_NUMERIC otherwise.
 * </p>
 * @return void
 */
function snmp_set_oid_output_format ($oid_format) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Return all objects including their respective object id within the specified one
 * @link http://php.net/manual/en/function.snmp-set-oid-numeric-print.php
 * @param int $oid_numeric_print 
 * @return void
 */
function snmp_set_oid_numeric_print ($oid_numeric_print) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Set an <acronym>SNMP</acronym> object
 * @link http://php.net/manual/en/function.snmpset.php
 * @param string $hostname <p>
 * The SNMP agent.
 * </p>
 * @param string $community <p>
 * The write community.
 * </p>
 * @param string $object_id <p>
 * The SNMP object.
 * </p>
 * @param string $type <p>
 * </p>
 * @param mixed $value <p>
 * </p>
 * @param int $timeout [optional] <p>
 * The number of microseconds until the first timeout.
 * </p>
 * @param int $retries [optional] <p>
 * </p>
 * @return bool true on success or false on failure.
 */
function snmpset ($hostname, $community, $object_id, $type, $value, $timeout = null, $retries = null) {}

/**
 * @param $host
 * @param $community
 * @param $object_id
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp2_get ($host, $community, $object_id, $timeout, $retries) {}

/**
 * @param $host
 * @param $community
 * @param $object_id
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp2_getnext ($host, $community, $object_id, $timeout, $retries) {}

/**
 * @param $host
 * @param $community
 * @param $object_id
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp2_walk ($host, $community, $object_id, $timeout, $retries) {}

/**
 * @param $host
 * @param $community
 * @param $object_id
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp2_real_walk ($host, $community, $object_id, $timeout, $retries) {}

/**
 * @param $host
 * @param $community
 * @param $object_id
 * @param $type
 * @param $value
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp2_set ($host, $community, $object_id, $type, $value, $timeout, $retries) {}

/**
 * @param $host
 * @param $sec_name
 * @param $sec_level
 * @param $auth_protocol
 * @param $auth_passphrase
 * @param $priv_protocol
 * @param $priv_passphrase
 * @param $object_id
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp3_get ($host, $sec_name, $sec_level, $auth_protocol, $auth_passphrase, $priv_protocol, $priv_passphrase, $object_id, $timeout, $retries) {}

/**
 * @param $host
 * @param $sec_name
 * @param $sec_level
 * @param $auth_protocol
 * @param $auth_passphrase
 * @param $priv_protocol
 * @param $priv_passphrase
 * @param $object_id
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp3_getnext ($host, $sec_name, $sec_level, $auth_protocol, $auth_passphrase, $priv_protocol, $priv_passphrase, $object_id, $timeout, $retries) {}

/**
 * @param $host
 * @param $sec_name
 * @param $sec_level
 * @param $auth_protocol
 * @param $auth_passphrase
 * @param $priv_protocol
 * @param $priv_passphrase
 * @param $object_id
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp3_walk ($host, $sec_name, $sec_level, $auth_protocol, $auth_passphrase, $priv_protocol, $priv_passphrase, $object_id, $timeout, $retries) {}

/**
 * @param $host
 * @param $sec_name
 * @param $sec_level
 * @param $auth_protocol
 * @param $auth_passphrase
 * @param $priv_protocol
 * @param $priv_passphrase
 * @param $object_id
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp3_real_walk ($host, $sec_name, $sec_level, $auth_protocol, $auth_passphrase, $priv_protocol, $priv_passphrase, $object_id, $timeout, $retries) {}

/**
 * @param $host
 * @param $sec_name
 * @param $sec_level
 * @param $auth_protocol
 * @param $auth_passphrase
 * @param $priv_protocol
 * @param $priv_passphrase
 * @param $object_id
 * @param $type
 * @param $value
 * @param $timeout [optional]
 * @param $retries [optional]
 */
function snmp3_set ($host, $sec_name, $sec_level, $auth_protocol, $auth_passphrase, $priv_protocol, $priv_passphrase, $object_id, $type, $value, $timeout, $retries) {}

/**
 * (PHP 4 &gt;= 4.3.3, PHP 5)<br/>
 * Specify the method how the SNMP values will be returned
 * @link http://php.net/manual/en/function.snmp-set-valueretrieval.php
 * @param int $method 
 * @return void 
 */
function snmp_set_valueretrieval ($method) {}

/**
 * (PHP 4 &gt;= 4.3.3, PHP 5)<br/>
 * Return the method how the SNMP values will be returned
 * @link http://php.net/manual/en/function.snmp-get-valueretrieval.php
 * @return int 
 */
function snmp_get_valueretrieval () {}

/**
 * (PHP 5)<br/>
 * Reads and parses a MIB file into the active MIB tree
 * @link http://php.net/manual/en/function.snmp-read-mib.php
 * @param string $filename 
 * @return bool 
 */
function snmp_read_mib ($filename) {}


/**
 * As of 5.2.0
 * @link http://php.net/manual/en/snmp.constants.php
 */
define ('SNMP_OID_OUTPUT_FULL', 3);

/**
 * As of 5.2.0
 * @link http://php.net/manual/en/snmp.constants.php
 */
define ('SNMP_OID_OUTPUT_NUMERIC', 4);
define ('SNMP_VALUE_LIBRARY', 0);
define ('SNMP_VALUE_PLAIN', 1);
define ('SNMP_VALUE_OBJECT', 2);
define ('SNMP_BIT_STR', 3);
define ('SNMP_OCTET_STR', 4);
define ('SNMP_OPAQUE', 68);
define ('SNMP_NULL', 5);
define ('SNMP_OBJECT_ID', 6);
define ('SNMP_IPADDRESS', 64);
define ('SNMP_COUNTER', 66);
define ('SNMP_UNSIGNED', 66);
define ('SNMP_TIMETICKS', 67);
define ('SNMP_UINTEGER', 71);
define ('SNMP_INTEGER', 2);
define ('SNMP_COUNTER64', 70);

// End of snmp v.
?>
