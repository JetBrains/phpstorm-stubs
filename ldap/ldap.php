<?php

// Start of ldap v.

/**
 * Connect to an LDAP server
 * @link https://php.net/manual/en/function.ldap-connect.php
 * @param string $hostname [optional] <p>
 * If you are using OpenLDAP 2.x.x you can specify a URL instead of the
 * hostname. To use LDAP with SSL, compile OpenLDAP 2.x.x with SSL
 * support, configure PHP with SSL, and set this parameter as
 * ldaps://hostname/.
 * </p>
 * @param int $port [optional] <p>
 * The port to connect to. Not used when using URLs.
 * </p>
 * @return resource|false a positive LDAP link identifier on success, or <b>FALSE</b> on error.
 * When OpenLDAP 2.x.x is used, <b>ldap_connect</b> will always
 * return a resource as it does not actually connect but just
 * initializes the connecting parameters. The actual connect happens with
 * the next calls to ldap_* funcs, usually with
 * <b>ldap_bind</b>.
 * </p>
 * <p>
 * If no arguments are specified then the link identifier of the already
 * opened link will be returned.
 * @since 4.0
 * @since 5.0
 */
function ldap_connect ($hostname = null, $port = 389) {}

/**
 * Alias of <b>ldap_unbind</b>
 * @link https://php.net/manual/en/function.ldap-close.php
 * @param $link_identifier
 * @since 4.0
 * @since 5.0
 */
function ldap_close ($link_identifier) {}

/**
 * Bind to LDAP directory
 * @link https://php.net/manual/en/function.ldap-bind.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $bind_rdn [optional]
 * @param string $bind_password [optional]
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function ldap_bind ($link_identifier, $bind_rdn = null, $bind_password = null) {}

/**
 * Bind to LDAP directory using SASL
 * @link https://php.net/manual/en/function.ldap-sasl-bind.php
 * @param resource $link
 * @param string $binddn [optional]
 * @param string $password [optional]
 * @param string $sasl_mech [optional]
 * @param string $sasl_realm [optional]
 * @param string $sasl_authc_id [optional]
 * @param string $sasl_authz_id [optional]
 * @param string $props [optional]
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.0
 */
function ldap_sasl_bind ($link, $binddn = null, $password = null, $sasl_mech = null, $sasl_realm = null, $sasl_authc_id = null, $sasl_authz_id = null, $props = null) {}

/**
 * Unbind from LDAP directory
 * @link https://php.net/manual/en/function.ldap-unbind.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function ldap_unbind ($link_identifier) {}

/**
 * Read an entry
 * @link https://php.net/manual/en/function.ldap-read.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $base_dn <p>
 * The base DN for the directory.
 * </p>
 * @param string $filter <p>
 * An empty filter is not allowed. If you want to retrieve absolutely all
 * information for this entry, use a filter of
 * objectClass=*. If you know which entry types are
 * used on the directory server, you might use an appropriate filter such
 * as objectClass=inetOrgPerson.
 * </p>
 * @param array $attributes [optional] <p>
 * An array of the required attributes, e.g. array("mail", "sn", "cn").
 * Note that the "dn" is always returned irrespective of which attributes
 * types are requested.
 * </p>
 * <p>
 * Using this parameter is much more efficient than the default action
 * (which is to return all attributes and their associated values).
 * The use of this parameter should therefore be considered good
 * practice.
 * </p>
 * @param int $attrsonly [optional] <p>
 * Should be set to 1 if only attribute types are wanted. If set to 0
 * both attributes types and attribute values are fetched which is the
 * default behaviour.
 * </p>
 * @param int $sizelimit [optional] <p>
 * Enables you to limit the count of entries fetched. Setting this to 0
 * means no limit.
 * </p>
 * <p>
 * This parameter can NOT override server-side preset sizelimit. You can
 * set it lower though.
 * </p>
 * <p>
 * Some directory server hosts will be configured to return no more than
 * a preset number of entries. If this occurs, the server will indicate
 * that it has only returned a partial results set. This also occurs if
 * you use this parameter to limit the count of fetched entries.
 * </p>
 * @param int $timelimit [optional] <p>
 * Sets the number of seconds how long is spend on the search. Setting
 * this to 0 means no limit.
 * </p>
 * <p>
 * This parameter can NOT override server-side preset timelimit. You can
 * set it lower though.
 * </p>
 * @param int $deref [optional] <p>
 * Specifies how aliases should be handled during the search. It can be
 * one of the following:
 * <b>LDAP_DEREF_NEVER</b> - (default) aliases are never
 * dereferenced.
 * @return resource|false a search result identifier or <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function ldap_read ($link_identifier, $base_dn, $filter, array $attributes = null, $attrsonly = null, $sizelimit = null, $timelimit = null, $deref = null) {}

/**
 * Single-level search
 * @link https://php.net/manual/en/function.ldap-list.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $base_dn <p>
 * The base DN for the directory.
 * </p>
 * @param string $filter
 * @param array $attributes [optional] <p>
 * An array of the required attributes, e.g. array("mail", "sn", "cn").
 * Note that the "dn" is always returned irrespective of which attributes
 * types are requested.
 * </p>
 * <p>
 * Using this parameter is much more efficient than the default action
 * (which is to return all attributes and their associated values).
 * The use of this parameter should therefore be considered good
 * practice.
 * </p>
 * @param int $attrsonly [optional] <p>
 * Should be set to 1 if only attribute types are wanted. If set to 0
 * both attributes types and attribute values are fetched which is the
 * default behaviour.
 * </p>
 * @param int $sizelimit [optional] <p>
 * Enables you to limit the count of entries fetched. Setting this to 0
 * means no limit.
 * </p>
 * <p>
 * This parameter can NOT override server-side preset sizelimit. You can
 * set it lower though.
 * </p>
 * <p>
 * Some directory server hosts will be configured to return no more than
 * a preset number of entries. If this occurs, the server will indicate
 * that it has only returned a partial results set. This also occurs if
 * you use this parameter to limit the count of fetched entries.
 * </p>
 * @param int $timelimit [optional] <p>
 * Sets the number of seconds how long is spend on the search. Setting
 * this to 0 means no limit.
 * </p>
 * <p>
 * This parameter can NOT override server-side preset timelimit. You can
 * set it lower though.
 * </p>
 * @param int $deref [optional] <p>
 * Specifies how aliases should be handled during the search. It can be
 * one of the following:
 * <b>LDAP_DEREF_NEVER</b> - (default) aliases are never
 * dereferenced.
 * @return resource|false a search result identifier or <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function ldap_list ($link_identifier, $base_dn, $filter, array $attributes = null, $attrsonly = null, $sizelimit = null, $timelimit = null, $deref = null) {}

/**
 * Search LDAP tree
 * @link https://php.net/manual/en/function.ldap-search.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $base_dn <p>
 * The base DN for the directory.
 * </p>
 * @param string $filter <p>
 * The search filter can be simple or advanced, using boolean operators in
 * the format described in the LDAP documentation (see the Netscape Directory SDK for full
 * information on filters).
 * </p>
 * @param array $attributes [optional] <p>
 * An array of the required attributes, e.g. array("mail", "sn", "cn").
 * Note that the "dn" is always returned irrespective of which attributes
 * types are requested.
 * </p>
 * <p>
 * Using this parameter is much more efficient than the default action
 * (which is to return all attributes and their associated values).
 * The use of this parameter should therefore be considered good
 * practice.
 * </p>
 * @param int $attrsonly [optional] <p>
 * Should be set to 1 if only attribute types are wanted. If set to 0
 * both attributes types and attribute values are fetched which is the
 * default behaviour.
 * </p>
 * @param int $sizelimit [optional] <p>
 * Enables you to limit the count of entries fetched. Setting this to 0
 * means no limit.
 * </p>
 * <p>
 * This parameter can NOT override server-side preset sizelimit. You can
 * set it lower though.
 * </p>
 * <p>
 * Some directory server hosts will be configured to return no more than
 * a preset number of entries. If this occurs, the server will indicate
 * that it has only returned a partial results set. This also occurs if
 * you use this parameter to limit the count of fetched entries.
 * </p>
 * @param int $timelimit [optional] <p>
 * Sets the number of seconds how long is spend on the search. Setting
 * this to 0 means no limit.
 * </p>
 * <p>
 * This parameter can NOT override server-side preset timelimit. You can
 * set it lower though.
 * </p>
 * @param int $deref [optional] <p>
 * Specifies how aliases should be handled during the search. It can be
 * one of the following:
 * <b>LDAP_DEREF_NEVER</b> - (default) aliases are never
 * dereferenced.
 * @return resource|false a search result identifier or <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function ldap_search ($link_identifier, $base_dn, $filter, array $attributes = null, $attrsonly = null, $sizelimit = null, $timelimit = null, $deref = null) {}

/**
 * Free result memory
 * @link https://php.net/manual/en/function.ldap-free-result.php
 * @param resource $result_identifier
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function ldap_free_result ($result_identifier) {}

/**
 * Count the number of entries in a search
 * @link https://php.net/manual/en/function.ldap-count-entries.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_identifier <p>
 * The internal LDAP result.
 * </p>
 * @return int|false number of entries in the result or <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function ldap_count_entries ($link_identifier, $result_identifier) {}

/**
 * Return first result id
 * @link https://php.net/manual/en/function.ldap-first-entry.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_identifier
 * @return resource the result entry identifier for the first entry on success and
 * <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function ldap_first_entry ($link_identifier, $result_identifier) {}

/**
 * Get next result entry
 * @link https://php.net/manual/en/function.ldap-next-entry.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_entry_identifier
 * @return resource|false entry identifier for the next entry in the result whose entries
 * are being read starting with <b>ldap_first_entry</b>. If
 * there are no more entries in the result then it returns <b>FALSE</b>.
 * @since 4.0
 * @since 5.0
 */
function ldap_next_entry ($link_identifier, $result_entry_identifier) {}

/**
 * Get all result entries
 * @link https://php.net/manual/en/function.ldap-get-entries.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_identifier
 * @return array a complete result information in a multi-dimensional array on
 * success and <b>FALSE</b> on error.
 * </p>
 * <p>
 * The structure of the array is as follows.
 * The attribute index is converted to lowercase. (Attributes are
 * case-insensitive for directory servers, but not when used as
 * array indices.)
 * <pre>
 * return_value["count"] = number of entries in the result
 * return_value[0] : refers to the details of first entry
 * return_value[i]["dn"] = DN of the ith entry in the result
 * return_value[i]["count"] = number of attributes in ith entry
 * return_value[i][j] = NAME of the jth attribute in the ith entry in the result
 * return_value[i]["attribute"]["count"] = number of values for
 * attribute in ith entry
 * return_value[i]["attribute"][j] = jth value of attribute in ith entry
 * </pre>
 * @since 4.0
 * @since 5.0
 */
function ldap_get_entries ($link_identifier, $result_identifier) {}

/**
 * Return first attribute
 * @link https://php.net/manual/en/function.ldap-first-attribute.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_entry_identifier
 * @return string|false the first attribute in the entry on success and <b>FALSE</b> on
 * error.
 * @since 4.0
 * @since 5.0
 */
function ldap_first_attribute ($link_identifier, $result_entry_identifier) {}

/**
 * Get the next attribute in result
 * @link https://php.net/manual/en/function.ldap-next-attribute.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_entry_identifier
 * @return string|false the next attribute in an entry on success and <b>FALSE</b> on
 * error.
 * @since 4.0
 * @since 5.0
 */
function ldap_next_attribute ($link_identifier, $result_entry_identifier) {}

/**
 * Get attributes from a search result entry
 * @link https://php.net/manual/en/function.ldap-get-attributes.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_entry_identifier
 * @return array a complete entry information in a multi-dimensional array
 * on success and <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function ldap_get_attributes ($link_identifier, $result_entry_identifier) {}

/**
 * Get all values from a result entry
 * @link https://php.net/manual/en/function.ldap-get-values.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_entry_identifier
 * @param string $attribute
 * @return array|false an array of values for the attribute on success and <b>FALSE</b> on
 * error. The number of values can be found by indexing "count" in the
 * resultant array. Individual values are accessed by integer index in the
 * array. The first index is 0.
 * </p>
 * <p>
 * LDAP allows more than one entry for an attribute, so it can, for example,
 * store a number of email addresses for one person's directory entry all
 * labeled with the attribute "mail"
 * return_value["count"] = number of values for attribute
 * return_value[0] = first value of attribute
 * return_value[i] = ith value of attribute
 * @since 4.0
 * @since 5.0
 */
function ldap_get_values ($link_identifier, $result_entry_identifier, $attribute) {}

/**
 * Get all binary values from a result entry
 * @link https://php.net/manual/en/function.ldap-get-values-len.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_entry_identifier
 * @param string $attribute
 * @return array|false an array of values for the attribute on success and <b>FALSE</b> on
 * error. Individual values are accessed by integer index in the array. The
 * first index is 0. The number of values can be found by indexing "count"
 * in the resultant array.
 * @since 4.0
 * @since 5.0
 */
function ldap_get_values_len ($link_identifier, $result_entry_identifier, $attribute) {}

/**
 * Get the DN of a result entry
 * @link https://php.net/manual/en/function.ldap-get-dn.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result_entry_identifier
 * @return string|false the DN of the result entry and <b>FALSE</b> on error.
 * @since 4.0
 * @since 5.0
 */
function ldap_get_dn ($link_identifier, $result_entry_identifier) {}

/**
 * Splits DN into its component parts
 * @link https://php.net/manual/en/function.ldap-explode-dn.php
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @param int $with_attrib <p>
 * Used to request if the RDNs are returned with only values or their
 * attributes as well. To get RDNs with the attributes (i.e. in
 * attribute=value format) set <i>with_attrib</i> to 0
 * and to get only values set it to 1.
 * </p>
 * @return array an array of all DN components.
 * The first element in this array has count key and
 * represents the number of returned values, next elements are numerically
 * indexed DN components.
 * @since 4.0
 * @since 5.0
 */
function ldap_explode_dn ($dn, $with_attrib) {}

/**
 * Convert DN to User Friendly Naming format
 * @link https://php.net/manual/en/function.ldap-dn2ufn.php
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @return string the user friendly name.
 * @since 4.0
 * @since 5.0
 */
function ldap_dn2ufn ($dn) {}

/**
 * Add entries to LDAP directory
 * @link https://php.net/manual/en/function.ldap-add.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @param array $entry <p>
 * An array that specifies the information about the entry. The values in
 * the entries are indexed by individual attributes.
 * In case of multiple values for an attribute, they are indexed using
 * integers starting with 0.
 * <code>
 * $entree["attribut1"] = "value";
 * $entree["attribut2"][0] = "value1";
 * $entree["attribut2"][1] = "value2";
 * </code>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function ldap_add ($link_identifier, $dn, array $entry) {}

/**
 * Delete an entry from a directory
 * @link https://php.net/manual/en/function.ldap-delete.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function ldap_delete ($link_identifier, $dn) {}

/**
 * Modify an LDAP entry
 * @link https://php.net/manual/en/function.ldap-modify.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @param array $entry
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function ldap_modify ($link_identifier, $dn, array $entry) {}

/**
 * Add attribute values to current attributes
 * @link https://php.net/manual/en/function.ldap-mod-add.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @param array $entry
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function ldap_mod_add ($link_identifier, $dn, array $entry) {}

/**
 * Replace attribute values with new ones
 * @link https://php.net/manual/en/function.ldap-mod-replace.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @param array $entry
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function ldap_mod_replace ($link_identifier, $dn, array $entry) {}

/**
 * Delete attribute values from current attributes
 * @link https://php.net/manual/en/function.ldap-mod-del.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @param array $entry
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function ldap_mod_del ($link_identifier, $dn, array $entry) {}

/**
 * Return the LDAP error number of the last LDAP command
 * @link https://php.net/manual/en/function.ldap-errno.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @return int Return the LDAP error number of the last LDAP command for this
 * link.
 * @since 4.0
 * @since 5.0
 */
function ldap_errno ($link_identifier) {}

/**
 * Convert LDAP error number into string error message
 * @link https://php.net/manual/en/function.ldap-err2str.php
 * @param int $errno <p>
 * The error number.
 * </p>
 * @return string the error message, as a string.
 * @since 4.0
 * @since 5.0
 */
function ldap_err2str ($errno) {}

/**
 * Return the LDAP error message of the last LDAP command
 * @link https://php.net/manual/en/function.ldap-error.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @return string string error message.
 * @since 4.0
 * @since 5.0
 */
function ldap_error ($link_identifier) {}

/**
 * Compare value of attribute found in entry specified with DN
 * @link https://php.net/manual/en/function.ldap-compare.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @param string $attribute <p>
 * The attribute name.
 * </p>
 * @param string $value <p>
 * The compared value.
 * </p>
 * @return mixed <b>TRUE</b> if <i>value</i> matches otherwise returns
 * <b>FALSE</b>. Returns -1 on error.
 * @since 4.0.2
 * @since 5.0
 */
function ldap_compare ($link_identifier, $dn, $attribute, $value) {}

/**
 * Sort LDAP result entries
 * @link https://php.net/manual/en/function.ldap-sort.php
 * @param resource $link <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result <p>
 * An search result identifier, returned by
 * <b>ldap_search</b>.
 * </p>
 * @param string $sortfilter <p>
 * The attribute to use as a key in the sort.
 * </p>
 * @deprecated 7.0
 * @return bool
 * @since 4.2.0
 * @since 5.0
 */
function ldap_sort ($link, $result, $sortfilter) {}

/**
 * Modify the name of an entry
 * @link https://php.net/manual/en/function.ldap-rename.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param string $dn <p>
 * The distinguished name of an LDAP entity.
 * </p>
 * @param string $newrdn <p>
 * The new RDN.
 * </p>
 * @param string $newparent <p>
 * The new parent/superior entry.
 * </p>
 * @param bool $deleteoldrdn <p>
 * If <b>TRUE</b> the old RDN value(s) is removed, else the old RDN value(s)
 * is retained as non-distinguished values of the entry.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.5
 * @since 5.0
 */
function ldap_rename ($link_identifier, $dn, $newrdn, $newparent, $deleteoldrdn) {}

/**
 * Get the current value for given option
 * @link https://php.net/manual/en/function.ldap-get-option.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param int $option <p>
 * The parameter <i>option</i> can be one of:
 * <tr valign="top">
 * <td>Option</td>
 * <td>Type</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_DEREF</b></td>
 * <td>integer</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_SIZELIMIT</b></td>
 * <td>integer</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_TIMELIMIT</b></td>
 * <td>integer</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_NETWORK_TIMEOUT</b></td>
 * <td>integer</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_PROTOCOL_VERSION</b></td>
 * <td>integer</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_ERROR_NUMBER</b></td>
 * <td>integer</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_REFERRALS</b></td>
 * <td>bool</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_RESTART</b></td>
 * <td>bool</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_HOST_NAME</b></td>
 * <td>string</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_ERROR_STRING</b></td>
 * <td>string</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_MATCHED_DN</b></td>
 * <td>string</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_SERVER_CONTROLS</b></td>
 * <td>array</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_CLIENT_CONTROLS</b></td>
 * <td>array</td>
 * </tr>
 * </p>
 * @param mixed $retval <p>
 * This will be set to the option value.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.4
 * @since 5.0
 */
function ldap_get_option ($link_identifier, $option, &$retval) {}

/**
 * Set the value of the given option
 * @link https://php.net/manual/en/function.ldap-set-option.php
 * @param resource $link_identifier <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param int $option <p>
 * The parameter <i>option</i> can be one of:
 * <tr valign="top">
 * <td>Option</td>
 * <td>Type</td>
 * <td>Available since</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_DEREF</b></td>
 * <td>integer</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_SIZELIMIT</b></td>
 * <td>integer</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_TIMELIMIT</b></td>
 * <td>integer</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_NETWORK_TIMEOUT</b></td>
 * <td>integer</td>
 * <td>PHP 5.3.0</td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_PROTOCOL_VERSION</b></td>
 * <td>integer</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_ERROR_NUMBER</b></td>
 * <td>integer</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_REFERRALS</b></td>
 * <td>bool</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_RESTART</b></td>
 * <td>bool</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_HOST_NAME</b></td>
 * <td>string</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_ERROR_STRING</b></td>
 * <td>string</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_MATCHED_DN</b></td>
 * <td>string</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_SERVER_CONTROLS</b></td>
 * <td>array</td>
 * <td></td>
 * </tr>
 * <tr valign="top">
 * <td><b>LDAP_OPT_CLIENT_CONTROLS</b></td>
 * <td>array</td>
 * <td></td>
 * </tr>
 * </p>
 * <p>
 * <b>LDAP_OPT_SERVER_CONTROLS</b> and
 * <b>LDAP_OPT_CLIENT_CONTROLS</b> require a list of
 * controls, this means that the value must be an array of controls. A
 * control consists of an oid identifying the control,
 * an optional value, and an optional flag for
 * criticality. In PHP a control is given by an
 * array containing an element with the key oid
 * and string value, and two optional elements. The optional
 * elements are key value with string value
 * and key iscritical with boolean value.
 * iscritical defaults to <b>FALSE</b>
 * if not supplied. See draft-ietf-ldapext-ldap-c-api-xx.txt
 * for details. See also the second example below.
 * </p>
 * @param mixed $newval <p>
 * The new value for the specified <i>option</i>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.4
 * @since 5.0
 */
function ldap_set_option ($link_identifier, $option, $newval) {}

/**
 * Return first reference
 * @link https://php.net/manual/en/function.ldap-first-reference.php
 * @param resource $link
 * @param resource $result
 * @return resource
 * @since 4.0.5
 * @since 5.0
 */
function ldap_first_reference ($link, $result) {}

/**
 * Get next reference
 * @link https://php.net/manual/en/function.ldap-next-reference.php
 * @param resource $link
 * @param resource $entry
 * @return resource
 * @since 4.0.5
 * @since 5.0
 */
function ldap_next_reference ($link, $entry) {}

/**
 * Extract information from reference entry
 * @link https://php.net/manual/en/function.ldap-parse-reference.php
 * @param resource $link
 * @param resource $entry
 * @param array $referrals
 * @return bool
 * @since 4.0.5
 * @since 5.0
 */
function ldap_parse_reference ($link, $entry, array &$referrals) {}

/**
 * Extract information from result
 * @link https://php.net/manual/en/function.ldap-parse-result.php
 * @param resource $link
 * @param resource $result
 * @param int $errcode
 * @param string $matcheddn [optional]
 * @param string $errmsg [optional]
 * @param array $referrals [optional]
 * @return bool
 * @since 4.0.5
 * @since 5.0
 */
function ldap_parse_result ($link, $result, &$errcode, &$matcheddn = null, &$errmsg = null, array &$referrals = null) {}

/**
 * Start TLS
 * @link https://php.net/manual/en/function.ldap-start-tls.php
 * @param resource $link
 * @return bool
 * @since 4.2.0
 * @since 5.0
 */
function ldap_start_tls ($link) {}

/**
 * Set a callback function to do re-binds on referral chasing
 * @link https://php.net/manual/en/function.ldap-set-rebind-proc.php
 * @param resource $link
 * @param callable $callback
 * @return bool
 * @since 4.2.0
 * @since 5.0
 */
function ldap_set_rebind_proc ($link, callable $callback) {}

/**
 * Send LDAP pagination control
 * @link https://php.net/manual/en/function.ldap-control-paged-result.php
 * @param resource $link <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param int $pagesize <p>
 * The number of entries by page.
 * </p>
 * @param bool $iscritical [optional] <p>
 * Indicates whether the pagination is critical of not.
 * If true and if the server doesn't support pagination, the search
 * will return no result.
 * </p>
 * @param string $cookie [optional] <p>
 * An opaque structure sent by the server
 * (<b>ldap_control_paged_result_response</b>).
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.4.0
 */
function ldap_control_paged_result ($link, $pagesize, $iscritical = false, $cookie = "") {}

/**
 * Retrieve the LDAP pagination cookie
 * @link https://php.net/manual/en/function.ldap-control-paged-result-response.php
 * @param resource $link <p>
 * An LDAP link identifier, returned by <b>ldap_connect</b>.
 * </p>
 * @param resource $result
 * @param string $cookie [optional] <p>
 * An opaque structure sent by the server.
 * </p>
 * @param int $estimated [optional] <p>
 * The estimated number of entries to retrieve.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.4.0
 */
function ldap_control_paged_result_response ($link, $result, &$cookie = null, &$estimated = null) {}

/**
 * @param $subject
 * @param $ignore [optional]
 * @param $escape [optional] LDAP_ESCAPE_FILTER|LDAP_ESCAPE_DN or null
 * @return string
 * @since 5.6.0
 */

function ldap_escape($subject, $ignore = null, $escape = null) {}

/**
 * (PHP 5.4 &gt;= 5.4.26, PHP 5.5 &gt;= 5.5.10, PHP 5.6 &gt;= 5.6.0)
 * Batch and execute modifications on an LDAP entry
 * @link https://php.net/manual/en/function.ldap-modify-batch.php
 * @param $link_identifier <p>
 * An LDAP link identifier, returned by
 * {@see ldap_connect()}.
 * </p>
 * @param $dn <p>The distinguished name of an LDAP entity.</p>
 * @param $entry <p>An array that specifies the modifications to make. Each entry in this
 * array is an associative array with two or three keys:
 * <em>attrib</em> maps to the name of the attribute to modify,
 * <em>modtype</em> maps to the type of modification to perform,
 * and (depending on the type of modification) <em>values</em>
 * maps to an array of attribute values relevant to the modification.
 * </p>
 * <p>
 * Possible values for <em>modtype</em> include:
 * </p><dl>
 *
 *
 * <dt>
 * <b>LDAP_MODIFY_BATCH_ADD</b></dt>
 *
 * <dd>
 *
 * <p>
 * Each value specified through <em>values</em> is added (as
 * an additional value) to the attribute named by
 * <em>attrib</em>.
 * </p>
 * </dd>
 *
 * <dt>
 * <b>LDAP_MODIFY_BATCH_REMOVE</b></dt>
 *
 * <dd>
 *
 * <p>
 * Each value specified through <em>values</em> is removed
 * from the attribute named by <em>attrib</em>. Any value of
 * the attribute not contained in the <em>values</em> array
 * will remain untouched.
 * </p>
 * </dd>
 * <dt>
 * <b>LDAP_MODIFY_BATCH_REMOVE_ALL</b></dt>
 *
 * <dd>
 *
 * <p>
 * All values are removed from the attribute named by
 * <em>attrib</em>. A <em>values</em> entry must
 * not be provided.
 * </p>
 * </dd>
 *
 * <dt>
 * <b>LDAP_MODIFY_BATCH_REPLACE</b></dt>
 *
 * <dd>
 *
 * <p>
 * All current values of the attribute named by
 * <em>attrib</em> are replaced with the values specified
 * through <em>values</em>.
 * </p>
 * </dd>
 * </dl>
 * <p>
 * Note that any value for <em>attrib</em> must be a string, any
 * value for <em>values</em> must be an array of strings, and
 * any value for <em>modtype</em> must be one of the
 * <b>LDAP_MODIFY_BATCH_*</b> constants listed above.
 * </p></p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.4.0
 */
function ldap_modify_batch ( $link_identifier , $dn , $entry) {}

define('LDAP_ESCAPE_FILTER', 1);
define ('LDAP_ESCAPE_DN', 2);
define ('LDAP_DEREF_NEVER', 0);
define ('LDAP_DEREF_SEARCHING', 1);
define ('LDAP_DEREF_FINDING', 2);
define ('LDAP_DEREF_ALWAYS', 3);
define ('LDAP_MODIFY_BATCH_REMOVE',2);
define('LDAP_MODIFY_BATCH_ADD', 1);
define('LDAP_MODIFY_BATCH_REMOVE_ALL', 18);
define('LDAP_MODIFY_BATCH_REPLACE', 3);

define('LDAP_OPT_X_TLS_REQUIRE_CERT', 24582);
define('LDAP_OPT_X_TLS_NEVER', 0);
define('LDAP_OPT_X_TLS_HARD', 1);
define('LDAP_OPT_X_TLS_DEMAND', 2);
define('LDAP_OPT_X_TLS_ALLOW', 3);
define('LDAP_OPT_X_TLS_TRY', 4);
define('LDAP_OPT_X_TLS_CERTFILE', 24580);
define('LDAP_OPT_X_TLS_CIPHER_SUITE', 24584);
define('LDAP_OPT_X_TLS_KEYFILE', 24581);
define('LDAP_OPT_X_TLS_DHFILE', 24590);
define('LDAP_OPT_X_TLS_CRLFILE', 24592);
define('LDAP_OPT_X_TLS_RANDOM_FILE', 24585);
define('LDAP_OPT_X_TLS_CRLCHECK', 24587);
define('LDAP_OPT_X_TLS_CRL_NONE', 0);
define('LDAP_OPT_X_TLS_CRL_PEER', 1);
define('LDAP_OPT_X_TLS_CRL_ALL', 2);
define('LDAP_OPT_X_TLS_PROTOCOL_MIN', 24583);
define('LDAP_OPT_X_TLS_PROTOCOL_SSL2', 512);
define('LDAP_OPT_X_TLS_PROTOCOL_SSL3', 768);
define('LDAP_OPT_X_TLS_PROTOCOL_TLS1_0', 769);
define('LDAP_OPT_X_TLS_PROTOCOL_TLS1_1', 770);
define('LDAP_OPT_X_TLS_PROTOCOL_TLS1_2', 771);
define('LDAP_OPT_X_TLS_PACKAGE', 24593);
define('LDAP_OPT_X_KEEPALIVE_IDLE', 25344);
define('LDAP_OPT_X_KEEPALIVE_PROBES', 25345);
define('LDAP_OPT_X_KEEPALIVE_INTERVAL', 25346);
define('LDAP_OPT_X_SASL_USERNAME', 24844);
define('LDAP_OPT_X_SASL_NOCANON', 24843);

/**
 * Specifies alternative rules for following aliases at the server.
 * @link https://php.net/manual/en/ldap.constants.php
 */
define ('LDAP_OPT_DEREF', 2);

/**
 * <p>
 * Specifies the maximum number of entries that can be
 * returned on a search operation.
 * </p>
 * The actual size limit for operations is also bounded
 * by the server's configured maximum number of return entries.
 * The lesser of these two settings is the actual size limit.
 * @link https://php.net/manual/en/ldap.constants.php
 */
define ('LDAP_OPT_SIZELIMIT', 3);

/**
 * Specifies the number of seconds to wait for search results.
 * The actual time limit for operations is also bounded
 * by the server's configured maximum time.
 * The lesser of these two settings is the actual time limit.
 * @link https://php.net/manual/en/ldap.constants.php
 */
define ('LDAP_OPT_TIMELIMIT', 4);

/**
 * Option for <b>ldap_set_option</b> to allow setting network timeout.
 * (Available as of PHP 5.3.0)
 * @link https://php.net/manual/en/ldap.constants.php
 */
define ('LDAP_OPT_NETWORK_TIMEOUT', 20485);

/**
 * Specifies the LDAP protocol to be used (V2 or V3).
 * @link https://php.net/manual/en/ldap.constants.php
 */
define ('LDAP_OPT_PROTOCOL_VERSION', 17);
define ('LDAP_OPT_ERROR_NUMBER', 49);

/**
 * Specifies whether to automatically follow referrals returned
 * by the LDAP server.
 * @link https://php.net/manual/en/ldap.constants.php
 */
define ('LDAP_OPT_REFERRALS', 8);
define ('LDAP_OPT_RESTART', 9);
define ('LDAP_OPT_HOST_NAME', 48);
define ('LDAP_OPT_ERROR_STRING', 50);
define ('LDAP_OPT_MATCHED_DN', 51);

/**
 * Specifies a default list of server controls to be sent with each request.
 * @link https://php.net/manual/en/ldap.constants.php
 */
define ('LDAP_OPT_SERVER_CONTROLS', 18);

/**
 * Specifies a default list of client controls to be processed with each request.
 * @link https://php.net/manual/en/ldap.constants.php
 */
define ('LDAP_OPT_CLIENT_CONTROLS', 19);

/**
 * Specifies a bitwise level for debug traces.
 * @link https://php.net/manual/en/ldap.constants.php
 */
define ('LDAP_OPT_DEBUG_LEVEL', 20481);
define ('LDAP_OPT_X_SASL_MECH', 24832);
define ('LDAP_OPT_X_SASL_REALM', 24833);
define ('LDAP_OPT_X_SASL_AUTHCID', 24834);
define ('LDAP_OPT_X_SASL_AUTHZID', 24835);

/**
 * Specifies the path of the directory containing CA certificates.
 * @link https://php.net/manual/en/ldap.constants.php
 * @since 7.1
 */
define('LDAP_OPT_X_TLS_CACERTDIR', 24579);

/**
 * Specifies the full-path of the CA certificate file.
 * @link https://php.net/manual/en/ldap.constants.php
 * @since 7.1
 */
define('LDAP_OPT_X_TLS_CACERTFILE', 24578);

define('LDAP_MODIFY_BATCH_ATTRIB', 'attrib');
define('LDAP_MODIFY_BATCH_MODTYPE', 'modtype');
define('LDAP_MODIFY_BATCH_VALUES', 'values');
define('LDAP_OPT_TIMEOUT', 20482);
define('LDAP_OPT_DIAGNOSTIC_MESSAGE', 50);


// End of ldap v.
?>
