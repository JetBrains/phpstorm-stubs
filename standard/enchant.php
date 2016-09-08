<?php

// Start of enchant v.1.1.0

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * create a new broker object capable of requesting
 * @link http://php.net/manual/en/function.enchant-broker-init.php
 * @return resource a broker resource on success or <b>FALSE</b>.
 */
function enchant_broker_init () {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Free the broker resource and its dictionnaries
 * @link http://php.net/manual/en/function.enchant-broker-free.php
 * @param resource $broker <p>
 * Broker resource
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function enchant_broker_free ($broker) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Returns the last error of the broker
 * @link http://php.net/manual/en/function.enchant-broker-get-error.php
 * @param resource $broker <p>
 * Broker resource.
 * </p>
 * @return string Return the msg string if an error was found or <b>FALSE</b>
 */
function enchant_broker_get_error ($broker) {}

/**
 * @param $broker
 * @param $name
 * @param $value
 */
function enchant_broker_set_dict_path ($broker, $name, $value) {}

/**
 * @param $broker
 * @param $name
 */
function enchant_broker_get_dict_path ($broker, $name) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 1.0.1)<br/>
 * Returns a list of available dictionaries
 * @link http://php.net/manual/en/function.enchant-broker-list-dicts.php
 * @param resource $broker <p>
 * Broker resource
 * </p>
 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function enchant_broker_list_dicts ($broker) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * create a new dictionary using a tag
 * @link http://php.net/manual/en/function.enchant-broker-request-dict.php
 * @param resource $broker <p>
 * Broker resource
 * </p>
 * @param string $tag <p>
 * A tag describing the locale, for example en_US, de_DE
 * </p>
 * @return resource a dictionary resource on success or <b>FALSE</b> on failure.
 */
function enchant_broker_request_dict ($broker, $tag) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * creates a dictionary using a PWL file
 * @link http://php.net/manual/en/function.enchant-broker-request-pwl-dict.php
 * @param resource $broker <p>
 * Broker resource
 * </p>
 * @param string $filename <p>
 * Path to the PWL file.
 * </p>
 * @return resource a dictionary resource on success or <b>FALSE</b> on failure.
 */
function enchant_broker_request_pwl_dict ($broker, $filename) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Free a dictionary resource
 * @link http://php.net/manual/en/function.enchant-broker-free-dict.php
 * @param resource $dict <p>
 * Dictionary resource.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function enchant_broker_free_dict ($dict) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Whether a dictionary exists or not. Using non-empty tag
 * @link http://php.net/manual/en/function.enchant-broker-dict-exists.php
 * @param resource $broker <p>
 * Broker resource
 * </p>
 * @param string $tag <p>
 * non-empty tag in the LOCALE format, ex: us_US, ch_DE, etc.
 * </p>
 * @return bool <b>TRUE</b> when the tag exist or <b>FALSE</b> when not.
 */
function enchant_broker_dict_exists ($broker, $tag) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Declares a preference of dictionaries to use for the language
 * @link http://php.net/manual/en/function.enchant-broker-set-ordering.php
 * @param resource $broker <p>
 * Broker resource
 * </p>
 * @param string $tag <p>
 * Language tag. The special "*" tag can be used as a language tag
 * to declare a default ordering for any language that does not
 * explicitly declare an ordering.
 * </p>
 * @param string $ordering <p>
 * Comma delimited list of provider names
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function enchant_broker_set_ordering ($broker, $tag, $ordering) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0)<br/>
 * Enumerates the Enchant providers
 * @link http://php.net/manual/en/function.enchant-broker-describe.php
 * @param resource $broker <p>
 * Broker resource
 * </p>
 * @return array <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function enchant_broker_describe ($broker) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Check whether a word is correctly spelled or not
 * @link http://php.net/manual/en/function.enchant-dict-check.php
 * @param resource $dict <p>
 * Dictionary resource
 * </p>
 * @param string $word <p>
 * The word to check
 * </p>
 * @return bool <b>TRUE</b> if the word is spelled correctly, <b>FALSE</b> if not.
 */
function enchant_dict_check ($dict, $word) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Will return a list of values if any of those pre-conditions are not met
 * @link http://php.net/manual/en/function.enchant-dict-suggest.php
 * @param resource $dict <p>
 * Dictionary resource
 * </p>
 * @param string $word <p>
 * Word to use for the suggestions.
 * </p>
 * @return array Will returns an array of suggestions if the word is bad spelled.
 */
function enchant_dict_suggest ($dict, $word) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * add a word to personal word list
 * @link http://php.net/manual/en/function.enchant-dict-add-to-personal.php
 * @param resource $dict <p>
 * Dictionary resource
 * </p>
 * @param string $word <p>
 * The word to add
 * </p>
 * @return void <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function enchant_dict_add_to_personal ($dict, $word) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * add 'word' to this spell-checking session
 * @link http://php.net/manual/en/function.enchant-dict-add-to-session.php
 * @param resource $dict <p>
 * Dictionary resource
 * </p>
 * @param string $word <p>
 * The word to add
 * </p>
 * @return void <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function enchant_dict_add_to_session ($dict, $word) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * whether or not 'word' exists in this spelling-session
 * @link http://php.net/manual/en/function.enchant-dict-is-in-session.php
 * @param resource $dict <p>
 * Dictionary resource
 * </p>
 * @param string $word <p>
 * The word to lookup
 * </p>
 * @return bool <b>TRUE</b> if the word exists or <b>FALSE</b>
 */
function enchant_dict_is_in_session ($dict, $word) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Add a correction for a word
 * @link http://php.net/manual/en/function.enchant-dict-store-replacement.php
 * @param resource $dict <p>
 * Dictionary resource
 * </p>
 * @param string $mis <p>
 * The work to fix
 * </p>
 * @param string $cor <p>
 * The correct word
 * </p>
 * @return void <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function enchant_dict_store_replacement ($dict, $mis, $cor) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Returns the last error of the current spelling-session
 * @link http://php.net/manual/en/function.enchant-dict-get-error.php
 * @param resource $dict <p>
 * Dictinaray resource
 * </p>
 * @return string the error message as string or <b>FALSE</b> if no error occurred.
 */
function enchant_dict_get_error ($dict) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant &gt;= 0.1.0 )<br/>
 * Describes an individual dictionary
 * @link http://php.net/manual/en/function.enchant-dict-describe.php
 * @param resource $dict <p>
 * Dictionary resource
 * </p>
 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function enchant_dict_describe ($dict) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL enchant:0.2.0-1.0.1)<br/>
 * Check the word is correctly spelled and provide suggestions
 * @link http://php.net/manual/en/function.enchant-dict-quick-check.php
 * @param resource $dict <p>
 * Dictionary resource
 * </p>
 * @param string $word <p>
 * The word to check
 * </p>
 * @param array $suggestions [optional] <p>
 * If the word is not correctly spelled, this variable will
 * contain an array of suggestions.
 * </p>
 * @return bool <b>TRUE</b> if the word is correctly spelled or <b>FALSE</b>
 */
function enchant_dict_quick_check ($dict, $word, array &$suggestions = null) {}

define ('ENCHANT_MYSPELL', 1);
define ('ENCHANT_ISPELL', 2);

// End of enchant v.1.1.0
?>
