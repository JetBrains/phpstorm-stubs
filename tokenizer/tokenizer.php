<?php

// Start of tokenizer v.0.1

/**
 * Split given source into PHP tokens
 * @link https://php.net/manual/en/function.token-get-all.php
 * @param string $source <p>
 * The PHP source to parse.
 * </p>
 * @param int $flags
 * <p>
 * <p>
 * Valid flags:
 * </p><ul>
 * <li>
 *
 * <b>TOKEN_PARSE</b> - Recognises the ability to use
 * reserved words in specific contexts.
 * </li>
 * </ul>
 * </p>
 * @return array An array of token identifiers. Each individual token identifier is either
 * a single character (i.e.: ;, .,
 * &gt;, !, etc...),
 * or a three element array containing the token index in element 0, the string
 * content of the original token in element 1 and the line number in element 2.
 * @since 4.2.0
 * @since 5.0
 */
function token_get_all ($source, $flags = 0) {}

/**
 * Get the symbolic name of a given PHP token
 * @link https://php.net/manual/en/function.token-name.php
 * @param int $token <p>
 * The token value.
 * </p>
 * @return string The symbolic name of the given <i>token</i>.
 * @since 4.2.0
 * @since 5.0
 */
function token_name ($token) {}

define('TOKEN_PARSE', 1);
define('T_REQUIRE_ONCE', 262);
define('T_REQUIRE', 261);
define('T_EVAL', 260);
define('T_INCLUDE_ONCE', 259);
define('T_INCLUDE', 258);
define('T_LOGICAL_OR', 263);
define('T_LOGICAL_XOR', 264);
define('T_LOGICAL_AND', 265);
define('T_PRINT', 266);
define('T_YIELD', 267);
define('T_DOUBLE_ARROW', 268);
define('T_YIELD_FROM', 269);
define('T_POW_EQUAL', 281);
define('T_SR_EQUAL', 280);
define('T_SL_EQUAL', 279);
define('T_XOR_EQUAL', 278);
define('T_OR_EQUAL', 277);
define('T_AND_EQUAL', 276);
define('T_MOD_EQUAL', 275);
define('T_CONCAT_EQUAL', 274);
define('T_DIV_EQUAL', 273);
define('T_MUL_EQUAL', 272);
define('T_MINUS_EQUAL', 271);
define('T_PLUS_EQUAL', 270);
define('T_COALESCE', 282);
define('T_BOOLEAN_OR', 283);
define('T_BOOLEAN_AND', 284);
define('T_SPACESHIP', 289);
define('T_IS_NOT_IDENTICAL', 288);
define('T_IS_IDENTICAL', 287);
define('T_IS_NOT_EQUAL', 286);
define('T_IS_EQUAL', 285);
define('T_IS_GREATER_OR_EQUAL', 291);
define('T_IS_SMALLER_OR_EQUAL', 290);
define('T_SR', 293);
define('T_SL', 292);
define('T_INSTANCEOF', 294);
define('T_UNSET_CAST', 303);
define('T_BOOL_CAST', 302);
define('T_OBJECT_CAST', 301);
define('T_ARRAY_CAST', 300);
define('T_STRING_CAST', 299);
define('T_DOUBLE_CAST', 298);
define('T_INT_CAST', 297);
define('T_DEC', 296);
define('T_INC', 295);
define('T_POW', 304);
define('T_CLONE', 306);
define('T_NEW', 305);
define('T_ELSEIF', 308);
define('T_ELSE', 309);
define('T_ENDIF', 310);
define('T_PUBLIC', 316);
define('T_PROTECTED', 315);
define('T_PRIVATE', 314);
define('T_FINAL', 313);
define('T_ABSTRACT', 312);
define('T_STATIC', 311);
define('T_LNUMBER', 317);
define('T_DNUMBER', 318);
define('T_STRING', 319);
define('T_VARIABLE', 320);
define('T_INLINE_HTML', 321);
define('T_ENCAPSED_AND_WHITESPACE', 322);
define('T_CONSTANT_ENCAPSED_STRING', 323);
define('T_STRING_VARNAME', 324);
define('T_NUM_STRING', 325);
define('T_EXIT', 326);
define('T_IF', 327);
define('T_ECHO', 328);
define('T_DO', 329);
define('T_WHILE', 330);
define('T_ENDWHILE', 331);
define('T_FOR', 332);
define('T_ENDFOR', 333);
define('T_FOREACH', 334);
define('T_ENDFOREACH', 335);
define('T_DECLARE', 336);
define('T_ENDDECLARE', 337);
define('T_AS', 338);
define('T_SWITCH', 339);
define('T_ENDSWITCH', 340);
define('T_CASE', 341);
define('T_DEFAULT', 342);
define('T_BREAK', 343);
define('T_CONTINUE', 344);
define('T_GOTO', 345);
define('T_FUNCTION', 346);
define('T_CONST', 347);
define('T_RETURN', 348);
define('T_TRY', 349);
define('T_CATCH', 350);
define('T_FINALLY', 351);
define('T_THROW', 352);
define('T_USE', 353);
define('T_INSTEADOF', 354);
define('T_GLOBAL', 355);
define('T_VAR', 356);
define('T_UNSET', 357);
define('T_ISSET', 358);
define('T_EMPTY', 359);
define('T_HALT_COMPILER', 360);
define('T_CLASS', 361);
define('T_TRAIT', 362);
define('T_INTERFACE', 363);
define('T_EXTENDS', 364);
define('T_IMPLEMENTS', 365);
define('T_OBJECT_OPERATOR', 366);
define('T_LIST', 367);
define('T_ARRAY', 368);
define('T_CALLABLE', 369);
define('T_LINE', 370);
define('T_FILE', 371);
define('T_DIR', 372);
define('T_CLASS_C', 373);
define('T_TRAIT_C', 374);
define('T_METHOD_C', 375);
define('T_FUNC_C', 376);
define('T_COMMENT', 377);
define('T_DOC_COMMENT', 378);
define('T_OPEN_TAG', 379);
define('T_OPEN_TAG_WITH_ECHO', 380);
define('T_CLOSE_TAG', 381);
define('T_WHITESPACE', 382);
define('T_START_HEREDOC', 383);
define('T_END_HEREDOC', 384);
define('T_DOLLAR_OPEN_CURLY_BRACES', 385);
define('T_CURLY_OPEN', 386);
define('T_PAAMAYIM_NEKUDOTAYIM', 387);
define('T_NAMESPACE', 388);
define('T_NS_C', 389);
define('T_NS_SEPARATOR', 390);
define('T_ELLIPSIS', 391);
define('T_DOUBLE_COLON', 387);

// End of tokenizer v.0.1
