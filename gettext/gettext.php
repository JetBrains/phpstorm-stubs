<?php

// Start of gettext v.

/**
 * Sets the default domain
 * @link https://php.net/manual/en/function.textdomain.php
 * @param string|null $domain <p>
 * The new message domain, or <b>NULL</b> to get the current setting without
 * changing it
 * </p>
 * @return string If successful, this function returns the current message
 * domain, after possibly changing it.
 */
function textdomain ($domain) {}

/**
 * Lookup a message in the current domain
 * @link https://php.net/manual/en/function.gettext.php
 * @param string $msgid <p>
 * The message being translated.
 * </p>
 * @return string a translated string if one is found in the
 * translation table, or the submitted message if not found.
 */
function gettext ($msgid) {}

/**
 * Lookup a message in the current domain
 * @link https://php.net/manual/en/function.gettext.php
 * @param string $msgid <p>
 * The message being translated.
 * </p>
 * @return string a translated string if one is found in the
 * translation table, or the submitted message if not found.
 */
function _ ($msgid) {}

/**
 * Override the current domain
 * @link https://php.net/manual/en/function.dgettext.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $msgid <p>
 * The message
 * </p>
 * @return string A string on success.
 */
function dgettext ($domain, $msgid) {}

/**
 * Overrides the domain for a single lookup
 * @link https://php.net/manual/en/function.dcgettext.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $msgid <p>
 * The message
 * </p>
 * @param int $category <p>
 * The category
 * </p>
 * @return string A string on success.
 */
function dcgettext ($domain, $msgid, $category) {}

/**
 * Sets the path for a domain
 * @link https://php.net/manual/en/function.bindtextdomain.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $dir <p>
 * The directory path
 * </p>
 * @return string The full pathname for the <i>domain</i> currently being set.
 */
function bindtextdomain ($domain, $dir) {}

/**
 * Plural version of gettext
 * @link https://php.net/manual/en/function.ngettext.php
 * @param string $msgid1
 * @param string $msgid2
 * @param int $n
 * @return string correct plural form of message identified by
 * <i>msgid1</i> and <i>msgid2</i>
 * for count <i>n</i>.
 */
function ngettext ($msgid1, $msgid2, $n) {}

/**
 * Plural version of dgettext
 * @link https://php.net/manual/en/function.dngettext.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $msgid1
 * @param string $msgid2
 * @param int $count
 * @return string A string on success.
 */
function dngettext ($domain, $msgid1, $msgid2, $count) {}

/**
 * Plural version of dcgettext
 * @link https://php.net/manual/en/function.dcngettext.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $msgid1
 * @param string $msgid2
 * @param int $count
 * @param int $category
 * @return string A string on success.
 */
function dcngettext ($domain, $msgid1, $msgid2, $count, $category) {}

/**
 * Specify the character encoding in which the messages from the DOMAIN message catalog will be returned
 * @link https://php.net/manual/en/function.bind-textdomain-codeset.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $codeset <p>
 * The code set
 * </p>
 * @return string A string on success.
 */
function bind_textdomain_codeset ($domain, $codeset) {}

// End of gettext v.
?>
