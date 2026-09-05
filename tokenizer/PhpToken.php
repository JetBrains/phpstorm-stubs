<?php

/**
 * A class for working with PHP tokens, which is an alternative to
 * the {@see token_get_all()} function.
 *
 * @link https://php.net/manual/en/class.phptoken.php
 * @since 8.0
 */
class PhpToken implements Stringable
{
    /**
     * One of the T_* constants, or an integer < 256 representing a
     * single-char token.
     */
    public int $id;

    /**
     * The textual content of the token.
     */
    public string $text;

    /**
     * The starting line number (1-based) of the token.
     */
    public int $line;

    /**
     * The starting position (0-based) in the tokenized string.
     */
    public int $pos;

    /**
     * Returns a new PhpToken object
     * @link https://php.net/manual/en/phptoken.construct.php
     * @param int $id An integer identifier
     * @param string $text Textual content
     * @param int $line Strating line
     * @param int $pos Straring position (line offset)
     */
    final public function __construct(int $id, string $text, int $line = -1, int $pos = -1) {}

    /**
     * Get the name of the token.
     *
     * @link https://php.net/manual/en/phptoken.gettokenname.php
     * @return string|null An ASCII character for single-char tokens, or one of T_* constant names
     * for known tokens (see ), or null for unknown tokens.
     */
    public function getTokenName(): ?string {}

    /**
     * Same as {@see token_get_all()}, but returning array of {@see PhpToken}
     * or an instance of a child class.
     *
     * @link https://php.net/manual/en/phptoken.tokenize.php
     * @param string $code An a PHP source code
     * @param int $flags Valid flags: TOKEN_PARSE - Recognises the ability to use reserved words in
     * specific contexts.
     * @return static[] An array of PHP tokens represented by instances of PhpToken or its
     * descendants. This method returns static[] so that PhpToken can be seamlessly extended.
     */
    public static function tokenize(string $code, int $flags = 0): array {}

    /**
     * Whether the token has the given ID, the given text, or has an ID/text
     * part of the given array.
     *
     * @link https://php.net/manual/en/phptoken.is.php
     * @param int|string|array $kind Either a single value to match the token's id or textual
     * content, or an array thereof.
     * @return bool A boolean value whether the token is of given kind.
     */
    public function is($kind): bool {}

    /**
     * Whether this token would be ignored by the PHP parser.
     *
     * @link https://php.net/manual/en/phptoken.isignorable.php
     * @return bool A boolean value whether the token would be ignored by the PHP parser (such as
     * whitespace or comments).
     */
    public function isIgnorable(): bool {}

    /**
     * {@inheritDoc}
     * @link https://php.net/manual/en/phptoken.tostring.php
     */
    public function __toString(): string {}
}
