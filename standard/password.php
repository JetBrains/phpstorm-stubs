<?php

define('PASSWORD_DEFAULT', "2y");

/**
 * <p>
 * The default cost used for the BCRYPT hashing algorithm.
 * </p>
 * <p>
 * Values for this constant:
 * </p>
 * <ul>
 * <li>
 * PHP 5.6.0 - <b>PASSWORD_BCRYPT_DEFAULT_COST</b>
 * </li>
 * </ul>
 */
define('PASSWORD_BCRYPT_DEFAULT_COST', 10);

/**
 * <p>
 * The default algorithm to use for hashing if no algorithm is provided.
 * This may change in newer PHP releases when newer, stronger hashing
 * algorithms are supported.
 * </p>
 * <p>
 * It is worth noting that over time this constant can (and likely will)
 * change. Therefore you should be aware that the length of the resulting
 * hash can change. Therefore, if you use <b>PASSWORD_DEFAULT</b>
 * you should store the resulting hash in a way that can store more than 60
 * characters (255 is the recommended width).
 * </p>
 * <p>
 * Values for this constant:
 * </p>
 * <ul>
 * <li>
 * PHP 5.5.0 - <b>PASSWORD_BCRYPT</b>
 * </li>
 * </ul>
 */
define('PASSWORD_BCRYPT', "2y");
