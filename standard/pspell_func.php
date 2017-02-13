<?php
/**
 * PHPStorm stub file for Pspell functions.
 *
 * @link http://php.net/manual/en/book.pspell.php
 */

/**
 * Add the word to a personal wordlist
 *
 * @link  http://php.net/manual/en/function.pspell-add-to-personal.php
 *
 * @param int    $dictionary_link
 * @param string $word <p>
 *                     The added word.
 *                     </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_add_to_personal($dictionary_link, $word) { }

/**
 * Add the word to the wordlist in the current session
 *
 * @link  http://php.net/manual/en/function.pspell-add-to-session.php
 *
 * @param int    $dictionary_link
 * @param string $word <p>
 *                     The added word.
 *                     </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_add_to_session($dictionary_link, $word) { }

/**
 * Check a word
 *
 * @link  http://php.net/manual/en/function.pspell-check.php
 *
 * @param int    $dictionary_link
 * @param string $word <p>
 *                     The tested word.
 *                     </p>
 *
 * @return bool <b>TRUE</b> if the spelling is correct, <b>FALSE</b> if not.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_check($dictionary_link, $word) { }

/**
 * Clear the current session
 *
 * @link  http://php.net/manual/en/function.pspell-clear-session.php
 *
 * @param int $dictionary_link
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_clear_session($dictionary_link) { }

/**
 * Create a config used to open a dictionary
 *
 * @link  http://php.net/manual/en/function.pspell-config-create.php
 *
 * @param string $language <p>
 *                         The language parameter is the language code which consists of the
 *                         two letter ISO 639 language code and an optional two letter ISO
 *                         3166 country code after a dash or underscore.
 *                         </p>
 * @param string $spelling [optional] <p>
 *                         The spelling parameter is the requested spelling for languages
 *                         with more than one spelling such as English. Known values are
 *                         'american', 'british', and 'canadian'.
 *                         </p>
 * @param string $jargon   [optional] <p>
 *                         The jargon parameter contains extra information to distinguish
 *                         two different words lists that have the same language and
 *                         spelling parameters.
 *                         </p>
 * @param string $encoding [optional] <p>
 *                         The encoding parameter is the encoding that words are expected to
 *                         be in. Valid values are 'utf-8', 'iso8859-*', 'koi8-r',
 *                         'viscii', 'cp1252', 'machine unsigned 16', 'machine unsigned
 *                         32'. This parameter is largely untested, so be careful when
 *                         using.
 *                         </p>
 *
 * @return int Retuns a pspell config identifier, or <b>FALSE</b> on error.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_config_create($language, $spelling = null, $jargon = null, $encoding = null) { }

/**
 * location of language data files
 *
 * @link  http://php.net/manual/en/function.pspell-config-data-dir.php
 *
 * @param int    $conf
 * @param string $directory
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.0
 */
function pspell_config_data_dir($conf, $directory) { }

/**
 * Location of the main word list
 *
 * @link  http://php.net/manual/en/function.pspell-config-dict-dir.php
 *
 * @param int    $conf
 * @param string $directory
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 5.0
 */
function pspell_config_dict_dir($conf, $directory) { }

/**
 * Ignore words less than N characters long
 *
 * @link  http://php.net/manual/en/function.pspell-config-ignore.php
 *
 * @param int $dictionary_link
 * @param int $n <p>
 *               Words less than <i>n</i> characters will be skipped.
 *               </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_config_ignore($dictionary_link, $n) { }

/**
 * Change the mode number of suggestions returned
 *
 * @link  http://php.net/manual/en/function.pspell-config-mode.php
 *
 * @param int $dictionary_link
 * @param int $mode <p>
 *                  The mode parameter is the mode in which spellchecker will work.
 *                  There are several modes available:
 *                  <b>PSPELL_FAST</b> - Fast mode (least number of
 *                  suggestions)
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_config_mode($dictionary_link, $mode) { }

/**
 * Set a file that contains personal wordlist
 *
 * @link  http://php.net/manual/en/function.pspell-config-personal.php
 *
 * @param int    $dictionary_link
 * @param string $file <p>
 *                     The personal wordlist. If the file does not exist, it will be created.
 *                     The file should be writable by whoever PHP runs as (e.g. nobody).
 *                     </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_config_personal($dictionary_link, $file) { }

/**
 * Set a file that contains replacement pairs
 *
 * @link  http://php.net/manual/en/function.pspell-config-repl.php
 *
 * @param int    $dictionary_link
 * @param string $file <p>
 *                     The file should be writable by whoever PHP runs as (e.g. nobody).
 *                     </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_config_repl($dictionary_link, $file) { }

/**
 * Consider run-together words as valid compounds
 *
 * @link  http://php.net/manual/en/function.pspell-config-runtogether.php
 *
 * @param int  $dictionary_link
 * @param bool $flag <p>
 *                   <b>TRUE</b> if run-together words should be treated as legal compounds,
 *                   <b>FALSE</b> otherwise.
 *                   </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_config_runtogether($dictionary_link, $flag) { }

/**
 * Determine whether to save a replacement pairs list
 *
 * @since 4.0.2
 * @since 5.0
 * along with the wordlist
 * @link  http://php.net/manual/en/function.pspell-config-save-repl.php
 *
 * @param int  $dictionary_link
 * @param bool $flag <p>
 *                   <b>TRUE</b> if replacement pairs should be saved, <b>FALSE</b> otherwise.
 *                   </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function pspell_config_save_repl($dictionary_link, $flag) { }

/**
 * Load a new dictionary
 *
 * @link  http://php.net/manual/en/function.pspell-new.php
 *
 * @param string $language <p>
 *                         The language parameter is the language code which consists of the
 *                         two letter ISO 639 language code and an optional two letter ISO
 *                         3166 country code after a dash or underscore.
 *                         </p>
 * @param string $spelling [optional] <p>
 *                         The spelling parameter is the requested spelling for languages
 *                         with more than one spelling such as English. Known values are
 *                         'american', 'british', and 'canadian'.
 *                         </p>
 * @param string $jargon   [optional] <p>
 *                         The jargon parameter contains extra information to distinguish
 *                         two different words lists that have the same language and
 *                         spelling parameters.
 *                         </p>
 * @param string $encoding [optional] <p>
 *                         The encoding parameter is the encoding that words are expected to
 *                         be in. Valid values are 'utf-8', 'iso8859-*', 'koi8-r',
 *                         'viscii', 'cp1252', 'machine unsigned 16', 'machine unsigned
 *                         32'. This parameter is largely untested, so be careful when
 *                         using.
 *                         </p>
 * @param int    $mode     [optional] <p>
 *                         The mode parameter is the mode in which spellchecker will work.
 *                         There are several modes available:
 *                         <b>PSPELL_FAST</b> - Fast mode (least number of
 *                         suggestions)
 *
 * @return int the dictionary link identifier on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_new($language, $spelling = null, $jargon = null, $encoding = null, $mode = 0) { }

/**
 * Load a new dictionary with settings based on a given config
 *
 * @link  http://php.net/manual/en/function.pspell-new-config.php
 *
 * @param int $config <p>
 *                    The <i>config</i> parameter is the one returned by
 *                    <b>pspell_config_create</b> when the config was created.
 *                    </p>
 *
 * @return int a dictionary link identifier on success.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_new_config($config) { }

/**
 * Load a new dictionary with personal wordlist
 *
 * @link  http://php.net/manual/en/function.pspell-new-personal.php
 *
 * @param string $personal <p>
 *                         The file where words added to the personal list will be stored.
 *                         It should be an absolute filename beginning with '/' because otherwise
 *                         it will be relative to $HOME, which is "/root" for most systems, and
 *                         is probably not what you want.
 *                         </p>
 * @param string $language <p>
 *                         The language code which consists of the two letter ISO 639 language
 *                         code and an optional two letter ISO 3166 country code after a dash
 *                         or underscore.
 *                         </p>
 * @param string $spelling [optional] <p>
 *                         The requested spelling for languages with more than one spelling such
 *                         as English. Known values are 'american', 'british', and 'canadian'.
 *                         </p>
 * @param string $jargon   [optional] <p>
 *                         Extra information to distinguish two different words lists that have
 *                         the same language and spelling parameters.
 *                         </p>
 * @param string $encoding [optional] <p>
 *                         The encoding that words are expected to be in. Valid values are
 *                         utf-8, iso8859-*,
 *                         koi8-r, viscii,
 *                         cp1252, machine unsigned 16,
 *                         machine unsigned 32.
 *                         </p>
 * @param int    $mode     [optional] <p>
 *                         The mode in which spellchecker will work. There are several modes available:
 *                         <b>PSPELL_FAST</b> - Fast mode (least number of
 *                         suggestions)
 *
 * @return int the dictionary link identifier for use in other pspell functions.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_new_personal($personal, $language, $spelling = null, $jargon = null, $encoding = null, $mode = 0) { }

/**
 * Save the personal wordlist to a file
 *
 * @link  http://php.net/manual/en/function.pspell-save-wordlist.php
 *
 * @param int $dictionary_link <p>
 *                             A dictionary link identifier opened with
 *                             <b>pspell_new_personal</b>.
 *                             </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_save_wordlist($dictionary_link) { }

/**
 * Store a replacement pair for a word
 *
 * @link  http://php.net/manual/en/function.pspell-store-replacement.php
 *
 * @param int    $dictionary_link <p>
 *                                A dictionary link identifier, opened with
 *                                <b>pspell_new_personal</b>
 *                                </p>
 * @param string $misspelled      <p>
 *                                The misspelled word.
 *                                </p>
 * @param string $correct         <p>
 *                                The fixed spelling for the <i>misspelled</i> word.
 *                                </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_store_replacement($dictionary_link, $misspelled, $correct) { }

/**
 * Suggest spellings of a word
 *
 * @link  http://php.net/manual/en/function.pspell-suggest.php
 *
 * @param int    $dictionary_link
 * @param string $word <p>
 *                     The tested word.
 *                     </p>
 *
 * @return array an array of possible spellings.
 * @since 4.0.2
 * @since 5.0
 */
function pspell_suggest($dictionary_link, $word) { }
