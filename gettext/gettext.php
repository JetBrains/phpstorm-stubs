<?php

// Start of gettext v.
use JetBrains\PhpStorm\Pure;

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
 * @param string $message <p>
 * The message being translated.
 * </p>
 * @return string a translated string if one is found in the
 * translation table, or the submitted message if not found.
 */
#[Pure]
function _ ($message) {}

/**
 * Lookup a message in the current domain
 * @link https://php.net/manual/en/function.gettext.php
 * @param string $message <p>
 * The message being translated.
 * </p>
 * @return string a translated string if one is found in the
 * translation table, or the submitted message if not found.
 */
#[Pure]
function gettext ($message) {}

/**
 * Override the current domain
 * @link https://php.net/manual/en/function.dgettext.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $message <p>
 * The message
 * </p>
 * @return string A string on success.
 */
function dgettext ($domain, $message) {}

/**
 * Overrides the domain for a single lookup
 * @link https://php.net/manual/en/function.dcgettext.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $message <p>
 * The message
 * </p>
 * @param int $category <p>
 * The category
 * </p>
 * @return string A string on success.
 */
function dcgettext ($domain, $message, $category) {}

/**
 * Sets the path for a domain
 * @link https://php.net/manual/en/function.bindtextdomain.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $directory <p>
 * The directory path
 * </p>
 * @return string The full pathname for the <i>domain</i> currently being set.
 */
function bindtextdomain ($domain, $directory) {}

/**
 * Plural version of gettext
 * @link https://php.net/manual/en/function.ngettext.php
 * @param string $singular
 * @param string $plural
 * @param int $count
 * @return string correct plural form of message identified by
 * <i>msgid1</i> and <i>msgid2</i>
 * for count <i>n</i>.
 */
#[Pure]
function ngettext ($singular, $plural, $count) {}

/**
 * Plural version of dgettext
 * @link https://php.net/manual/en/function.dngettext.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $singular
 * @param string $plural
 * @param int $count
 * @return string A string on success.
 */
#[Pure]
function dngettext ($domain, $singular, $plural, $count) {}

/**
 * Plural version of dcgettext
 * @link https://php.net/manual/en/function.dcngettext.php
 * @param string $domain <p>
 * The domain
 * </p>
 * @param string $singular
 * @param string $plural
 * @param int $count
 * @param int $category
 * @return string A string on success.
 */
#[Pure]
function dcngettext ($domain, $singular, $plural, $count, $category) {}

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
