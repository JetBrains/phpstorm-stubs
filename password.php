<?php
// Start of password v.
/**
 * (PHP 5 &gt;= 5.5.0, PHP 5)<br/>
 *
 * Returns information about the given hash
 * @link http://www.php.net/manual/en/function.password-get-info.php
 * @param string $hash A hash created by password_hash().
 * @return array Returns an associative array with three elements:
 * <ul>
 * <li>
 * <em>algo</em>, which will match a
 * @link http://www.php.net/manual/en/password.constants.php" password algorithm constant
 * </li>
 * <li>
 * <em>algoName</em>, which has the human readable name of the algorithm
 * </li>
 * <li>
 * <em>options</em>, which includes the options
 * provided when calling  @link http://www.php.net/manual/en/function.password-hash.php" password_hash()
 * </li>
 * </ul>
 */
function password_get_info ($hash) {}

/**
 * (PHP 5 &gt;= 5.5.0, PHP 5)<br/>
 *
 * Creates a password hash.
 * @link http://www.php.net/manual/en/function.password-hash.php
 * @param string $password The user's password.
 * @param int $algo A password algorithm constant denoting the algorithm to use when hashing the password.
 * @param array $options [optional] <p> An associative array containing options. See the password algorithm constants for documentation on the supported options for each algorithm.
 * If omitted, a random salt will be created and the default cost will be used.
 * @return string|bool Returns the hashed password, or FALSE on failure.
 */
function password_hash ($password, $algo, $options = null) {}

/**
 * (PHP 5 &gt;= 5.5.0, PHP 5)<br/>
 *
 * Checks if the given hash matches the given options.
 * @link http://www.php.net/manual/en/function.password-needs-rehash.php
 * @param string $hash A hash created by password_hash().
 * @param int $algo A password algorithm constant denoting the algorithm to use when hashing the password.
 * @param array $options [optional] <p> An associative array containing options. See the password algorithm constants for documentation on the supported options for each algorithm.
 * @return string Returns TRUE if the hash should be rehashed to match the given algo and options, or FALSE otherwise.
 */
function password_needs_rehash ($hash, $algo, $options = null) {}

/**
 * (PHP 5 &gt;= 5.5.0, PHP 5)<br/>
 *
 * Checks if the given hash matches the given options.
 * @link http://www.php.net/manual/en/function.password-verify.php
 * @param string $password The user's password.
 * @param string $hash A hash created by password_hash().
 * @return boolean Returns TRUE if the password and hash match, or FALSE otherwise.
 */
function password_verify ($password, $hash) {}

// End of password v.
