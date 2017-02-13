<?php
/**
 * PHPStorm stub file for Tokenizer functions.
 *
 * @link http://php.net/manual/en/book.tokenizer.php
 */

/**
 * Split given source into PHP tokens
 *
 * @link  http://php.net/manual/en/function.token-get-all.php
 *
 * @param string $source <p>
 *                       The PHP source to parse.
 *                       </p>
 *
 * @return array An array of token identifiers. Each individual token identifier is either
 * a single character (i.e.: ;, .,
 * &gt;, !, etc...),
 * or a three element array containing the token index in element 0, the string
 * content of the original token in element 1 and the line number in element 2.
 * @since 4.2.0
 * @since 5.0
 */
function token_get_all($source) { }

/**
 * Get the symbolic name of a given PHP token
 *
 * @link  http://php.net/manual/en/function.token-name.php
 *
 * @param int $token <p>
 *                   The token value.
 *                   </p>
 *
 * @return string The symbolic name of the given <i>token</i>.
 * @since 4.2.0
 * @since 5.0
 */
function token_name($token) { }
