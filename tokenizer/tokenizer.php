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
 */
function token_get_all ($source, $flags = 0) {}

/**
 * Get the symbolic name of a given PHP token
 * @link https://php.net/manual/en/function.token-name.php
 * @param int $token <p>
 * The token value.
 * </p>
 * @return string The symbolic name of the given <i>token</i>.
 */
function token_name ($token) {}

define('TOKEN_PARSE', 1);
define('T_REQUIRE_ONCE', 262);
define('T_REQUIRE', 261);
define('T_EVAL', 318);
define('T_INCLUDE_ONCE', 260);
define('T_INCLUDE', 259);
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
/**
 * @since 7.4
 */
define('T_COALESCE_EQUAL', 282);
define('T_COALESCE', 283);
define('T_BOOLEAN_OR', 284);
define('T_BOOLEAN_AND', 285);
define('T_SPACESHIP', 290);
define('T_IS_NOT_IDENTICAL', 289);
define('T_IS_IDENTICAL', 288);
define('T_IS_NOT_EQUAL', 287);
define('T_IS_EQUAL', 286);
define('T_IS_GREATER_OR_EQUAL', 292);
define('T_IS_SMALLER_OR_EQUAL', 291);
define('T_SR', 294);
define('T_SL', 293);
define('T_INSTANCEOF', 295);
define('T_UNSET_CAST', 302);
define('T_BOOL_CAST', 301);
define('T_OBJECT_CAST', 300);
define('T_ARRAY_CAST', 299);
define('T_STRING_CAST', 298);
define('T_DOUBLE_CAST', 297);
define('T_INT_CAST', 296);
define('T_DEC', 320);
define('T_INC', 319);
define('T_POW', 303);
define('T_CLONE', 305);
define('T_NEW', 304);
define('T_ELSEIF', 307);
define('T_ELSE', 308);
define('T_ENDIF', 323);
define('T_PUBLIC', 358);
define('T_PROTECTED', 357);
define('T_PRIVATE', 356);
define('T_FINAL', 355);
define('T_ABSTRACT', 354);
define('T_STATIC', 353);
define('T_LNUMBER', 309);
define('T_DNUMBER', 310);
define('T_STRING', 311);
define('T_VARIABLE', 312);
define('T_INLINE_HTML', 313);
define('T_ENCAPSED_AND_WHITESPACE', 314);
define('T_CONSTANT_ENCAPSED_STRING', 315);
define('T_STRING_VARNAME', 316);
define('T_NUM_STRING', 317);
define('T_EXIT', 321);
define('T_IF', 322);
define('T_ECHO', 324);
define('T_DO', 325);
define('T_WHILE', 326);
define('T_ENDWHILE', 327);
define('T_FOR', 328);
define('T_ENDFOR', 329);
define('T_FOREACH', 330);
define('T_ENDFOREACH', 331);
define('T_DECLARE', 332);
define('T_ENDDECLARE', 333);
define('T_AS', 334);
define('T_SWITCH', 335);
define('T_ENDSWITCH', 336);
define('T_CASE', 337);
define('T_DEFAULT', 338);
define('T_BREAK', 339);
define('T_CONTINUE', 340);
define('T_GOTO', 341);
define('T_FUNCTION', 342);
define('T_CONST', 344);
define('T_RETURN', 345);
define('T_TRY', 346);
define('T_CATCH', 347);
define('T_FINALLY', 348);
define('T_THROW', 349);
define('T_USE', 350);
define('T_INSTEADOF', 351);
define('T_GLOBAL', 352);
define('T_VAR', 359);
define('T_UNSET', 360);
define('T_ISSET', 361);
define('T_EMPTY', 362);
define('T_HALT_COMPILER', 363);
define('T_CLASS', 364);
define('T_TRAIT', 365);
define('T_INTERFACE', 366);
define('T_EXTENDS', 367);
define('T_IMPLEMENTS', 368);
define('T_OBJECT_OPERATOR', 369);
define('T_LIST', 370);
define('T_ARRAY', 371);
define('T_CALLABLE', 372);
define('T_LINE', 373);
define('T_FILE', 374);
define('T_DIR', 375);
define('T_CLASS_C', 376);
define('T_TRAIT_C', 377);
define('T_METHOD_C', 378);
define('T_FUNC_C', 379);
define('T_COMMENT', 380);
define('T_DOC_COMMENT', 381);
define('T_OPEN_TAG', 382);
define('T_OPEN_TAG_WITH_ECHO', 383);
define('T_CLOSE_TAG', 384);
define('T_WHITESPACE', 385);
define('T_START_HEREDOC', 386);
define('T_END_HEREDOC', 387);
define('T_DOLLAR_OPEN_CURLY_BRACES', 388);
define('T_CURLY_OPEN', 389);
define('T_PAAMAYIM_NEKUDOTAYIM', 390);
define('T_NAMESPACE', 391);
define('T_NS_C', 392);
define('T_NS_SEPARATOR', 393);
define('T_ELLIPSIS', 394);
define('T_DOUBLE_COLON', 390);
/**
 * @since 7.4
 */
define('T_FN', 343);
define('T_BAD_CHARACTER', 395);


// End of tokenizer v.0.1
