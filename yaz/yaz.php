<?php

// Start of yaz v.1.2.4

/**
 * Event codes reported by yaz_wait() in event mode, as the 'eventcode' entry of its
 * options array. Undocumented in the PHP manual; the names come from the ZOOM
 * framework the extension is built on.
 */
define('ZOOM_EVENT_NONE', 0);
define('ZOOM_EVENT_CONNECT', 1);
define('ZOOM_EVENT_SEND_DATA', 2);
define('ZOOM_EVENT_RECV_DATA', 3);
define('ZOOM_EVENT_TIMEOUT', 4);
define('ZOOM_EVENT_UNKNOWN', 5);
define('ZOOM_EVENT_SEND_APDU', 6);
define('ZOOM_EVENT_RECV_APDU', 7);
define('ZOOM_EVENT_RECV_RECORD', 8);
define('ZOOM_EVENT_RECV_SEARCH', 9);

/**
 * Prepares for a connection to a Z39.50 server
 *
 * Non-blocking: no connection is made here, only prepared. It is established by the
 * following yaz_wait() call.
 *
 * $options is either the Z39.50 V2 authentication string ("user/password"), or an array
 * with any of the keys user, group, password, cookie, proxy, persistent, piggyback,
 * charset, preferredMessageSize and maximumRecordSize.
 *
 * Note that failure yields the integer 0, not false, so a `=== false` check never fires.
 *
 * @link https://php.net/manual/en/function.yaz-connect.php
 *
 * @param string       $url
 * @param array|string $options
 *
 * @return resource|int
 */
function yaz_connect($url, $options = null) {}

/**
 * Close YAZ connection
 *
 * @link https://php.net/manual/en/function.yaz-close.php
 *
 * @param resource $id
 *
 * @return bool
 */
function yaz_close($id) {}

/**
 * Prepares for a search
 *
 * @link https://php.net/manual/en/function.yaz-search.php
 *
 * @param resource $id
 * @param string   $type
 * @param string   $query
 *
 * @return bool
 */
function yaz_search($id, $type, $query) {}

/**
 * Wait for Z39.50 requests to complete
 *
 * In event mode — the 'event' key of $options — the completed connection is returned
 * instead of true, and $options receives the 'connid' and 'eventcode' entries.
 *
 * @link https://php.net/manual/en/function.yaz-wait.php
 *
 * @param array &$options
 *
 * @return bool|resource
 */
function yaz_wait(&$options = null) {}

/**
 * Returns error number
 *
 * @link https://php.net/manual/en/function.yaz-errno.php
 *
 * @param resource $id
 *
 * @return int
 */
function yaz_errno($id) {}

/**
 * Returns error description
 *
 * @link https://php.net/manual/en/function.yaz-error.php
 *
 * @param resource $id
 *
 * @return string
 */
function yaz_error($id) {}

/**
 * Returns additional error information
 *
 * @link https://php.net/manual/en/function.yaz-addinfo.php
 *
 * @param resource $id
 *
 * @return string
 */
function yaz_addinfo($id) {}

/**
 * Returns number of hits for last search
 *
 * @link https://php.net/manual/en/function.yaz-hits.php
 *
 * @param resource $id
 * @param array    &$searchresult
 *
 * @return int
 */
function yaz_hits($id, &$searchresult = null) {}

/**
 * Returns a record
 *
 * @link https://php.net/manual/en/function.yaz-record.php
 *
 * @param resource $id
 * @param int      $pos
 * @param string   $type
 *
 * @return string
 */
function yaz_record($id, $pos, $type) {}

/**
 * Specifies the preferred record syntax for retrieval
 *
 * @link https://php.net/manual/en/function.yaz-syntax.php
 *
 * @param resource $id
 * @param string   $syntax
 *
 * @return void
 */
function yaz_syntax($id, $syntax) {}

/**
 * Specifies Element-Set Name for retrieval
 *
 * @link https://php.net/manual/en/function.yaz-element.php
 *
 * @param resource $id
 * @param string   $elementsetname
 *
 * @return void
 */
function yaz_element($id, $elementsetname) {}

/**
 * Specifies a range of records to retrieve
 *
 * @link https://php.net/manual/en/function.yaz-range.php
 *
 * @param resource $id
 * @param int      $start
 * @param int      $number
 *
 * @return void
 */
function yaz_range($id, $start, $number) {}

/**
 * Prepares for Z39.50 Item Order with an ILL-Request package
 *
 * @link https://php.net/manual/en/function.yaz-itemorder.php
 *
 * @param resource $id
 * @param array    $package
 *
 * @return void
 */
function yaz_itemorder($id, $package) {}

/**
 * Inspects Extended Services Result
 *
 * @link https://php.net/manual/en/function.yaz-es-result.php
 *
 * @param resource $id
 *
 * @return array
 */
function yaz_es_result($id) {}

/**
 * Prepares for a scan
 *
 * @link https://php.net/manual/en/function.yaz-scan.php
 *
 * @param resource $id
 * @param string   $type
 * @param string   $query
 * @param array    $flags
 *
 * @return void
 */
function yaz_scan($id, $type, $query, $flags = null) {}

/**
 * Returns Scan Response result
 *
 * @link https://php.net/manual/en/function.yaz-scan-result.php
 *
 * @param resource $id
 * @param array    &$options
 *
 * @return array
 */
function yaz_scan_result($id, &$options = null) {}

/**
 * Prepares for retrieval (Z39.50 present)
 *
 * @link https://php.net/manual/en/function.yaz-present.php
 *
 * @param resource $id
 *
 * @return bool
 */
function yaz_present($id) {}

/**
 * Configure CCL parser
 *
 * @link https://php.net/manual/en/function.yaz-ccl-conf.php
 *
 * @param resource $id
 * @param array    $package
 *
 * @return void
 */
function yaz_ccl_conf($id, $package) {}

/**
 * Invoke CCL Parser
 *
 * @link https://php.net/manual/en/function.yaz-ccl-parse.php
 *
 * @param resource $id
 * @param string   $query
 * @param array    &$result
 *
 * @return bool
 */
function yaz_ccl_parse($id, $query, &$result) {}

/**
 * Converts a CQL query to RPN
 *
 * @param resource $id
 * @param string   $cql
 * @param array    &$result
 * @param bool     $rev
 *
 * @return bool
 */
function yaz_cql_parse($id, $cql, &$result, $rev) {}

/**
 * Configures the CQL to RPN conversion
 *
 * @param resource $id
 * @param array    $package
 *
 * @return void
 */
function yaz_cql_conf($id, $package) {}

/**
 * Specifies the databases within a session
 *
 * @link https://php.net/manual/en/function.yaz-database.php
 *
 * @param resource $id
 * @param string   $databases
 *
 * @return bool
 */
function yaz_database($id, $databases) {}

/**
 * Sets sorting criteria
 *
 * @link https://php.net/manual/en/function.yaz-sort.php
 *
 * @param resource $id
 * @param string   $sortspec
 *
 * @return void
 */
function yaz_sort($id, $sortspec) {}

/**
 * Specifies schema for retrieval
 *
 * @link https://php.net/manual/en/function.yaz-schema.php
 *
 * @param resource $id
 * @param string   $schema
 *
 * @return void
 */
function yaz_schema($id, $schema) {}

/**
 * Sets one or more options for connection
 *
 * @link https://php.net/manual/en/function.yaz-set-option.php
 *
 * @param resource     $id
 * @param array|string $options_or_name
 * @param string       $value
 *
 * @return void
 */
function yaz_set_option($id, $options_or_name, $value = null) {}

/**
 * Returns value of option for connection
 *
 * @link https://php.net/manual/en/function.yaz-get-option.php
 *
 * @param resource $id
 * @param string   $name
 *
 * @return string|false
 */
function yaz_get_option($id, $name) {}

/**
 * Prepares for an Extended Service Request
 *
 * @link https://php.net/manual/en/function.yaz-es.php
 *
 * @param resource $id
 * @param string   $type
 * @param array    $package
 *
 * @return void
 */
function yaz_es($id, $type, $package) {}

// End of yaz v.1.2.4
