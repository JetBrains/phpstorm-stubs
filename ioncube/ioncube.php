<?php

/**
 * Stubs for ioncube 10.2.0 API
 * You can get the user guide from https://www.ioncube.com/sa/USER-GUIDE.pdf
 *
 * Author: Borg Ou
 * Date: Mar 16, 2018
 * Time: 10:10:14 PM
 */

/** File Information and Execution */
/**
 * Checking for an Encoded File
 *
 * This function returns TRUE if the file containing the function call is encoded and FALSE otherwise.
 *
 * @return boolean
 */
function ioncube_file_is_encoded()
{
}

/**
 * General Encoded File Information
 *
 * This function returns FALSE if the file is not encoded. Otherwise it returns an associative array.
 * The contents of the array are as follows:
 * Key | Value |
 * | -  | --: |
 * | FILE_EXPIRY | Either the file expiry time, or the license expiry time if a license file is
 * present. The time is an integer in UNIX timestamp format: the number
 * of seconds elapsed since midnight (00:00:00), January 1, 1970. |
 * | ENCODING_TIME | UNIX timestamp representing the time the file was encoded. |
 * | DEMO | TRUE if the file was encoded with an evaluation Encoder, otherwise FALSE. |
 *
 * @return boolean|array
 */
function ioncube_file_info()
{
}

/**  License and Server Information */
/**
 * Retrieving Properties Stored in an Encoded File
 *
 * This function returns an associative array consisting of file properties that were added to the
 * encoded file with the Encoder --property or --properties options. Only properties
 * defined in the calling script are returned.
 *
 * @return array
 */
function ioncube_file_properties()
{
}

/**
 * Retrieving the Loader String Version
 *
 * This function returns the Loader version as a string.
 *
 * @return string
 */
function ioncube_loader_version()
{
}

/**
 * Retrieving the Loader Integer Version
 *
 * This function returns the Loader version as an integer, e.g. 60100 for version 6.1.0.
 *
 * @return integer
 */
function ioncube_loader_iversion()
{
}

/**
 * Retrieving Properties Stored in a License
 *
 * This function returns an associative array consisting of license properties. Properties are added
 * to a license by specifying the --property command line option to the make_license
 * program. Each value in the associative array retrieved by this API function is itself an array with
 * two values: the license property value itself, and a boolean value to indicate whether the
 * property is enforced.
 * Recall that an enforced property is one that the Loader will attempt to match with an encoded
 * file property if the --license-check auto option is passed to the Encoder on the command line.
 * The return value of this function is FALSE if the calling file is not encoded or has no license file.
 * @return boolean|string
 */
function ioncube_license_properties()
{
}

/**
 * Retrieving the List of Permissioned Servers
 *
 * This function returns an array of server restriction specifications. These are the same strings
 * specified on the command line when the license was created.
 *
 * @return array
 */
function ioncube_licensed_servers()
{
}

/**
 * Creating a Server Data Block
 *
 * When generating a license for an end user it will usually be necessary to retrieve information
 * about the target server. This API function generates a server data block containing information
 * about the network adapters installed on the server and the server’s domain name. The data block
 * can then be used in conjunction with the make_license program to generate a license
 * restricted to the user’s domain and server.
 * This function can be called from either an encoded or non-encoded script.
 *
 * @return boolean
 */
function ioncube_server_data()
{
}

/** License Validation */
/**
 * Validating License Properties
 *
 * This API function returns TRUE if all enforced license properties are matched in the encoded file.
 * Otherwise an array is returned consisting of all unmatched enforced properties.
 *
 * @return boolean|array
 */
function ioncube_check_license_properties()
{
}

/**
 * Validating Licensed Servers
 *
 * This function returns FALSE if the calling file is encoded, requires a license, and if the license
 * has a server restriction that is not met by the current server. In all other cases the function
 * returns TRUE.
 *
 * Note that in the case that an encoded script requires a license but no license could be found, the
 * Loader will prevent execution of the script. The case of a missing license therefore cannot occur
 * when calling the ioncube_license_matches_server() API function
 *
 * @return boolean
 */
function ioncube_license_matches_server()
{
}

/**
 * Validating License Expiry
 *
 * This function returns TRUE if the calling file is encoded and has a license with an expiry time
 * that has passed. In all other cases the function returns FALSE.
 *
 * @return boolean
 */
function ioncube_license_has_expired()
{
}

/** Encrypted File Support */
/**
 * Reading Encrypted Files
 *
 * This API function can be used to read files encrypted by the Encoder with the --encrypt command-line option.
 * If a file is read successfully the contents are returned as a binary-safe string.
 * An integer is returned in the case of an error condition, which can be tested for by calling the PHP function is_int().
 * The error codes are described in section 6.5 below.
 * Both plain text and encrypted files can be read by this function, allowing the function to be used in cases where it is not known whether a file will be encrypted.
 * For example, a template engine could be designed that would accept both encrypted and non-encrypted template files.
 * If it is necessary to know whether the file read was encrypted, the second optional argument (passed by reference) can be examined.
 * If an encrypted file has been written with a custom passphrase (i.e. a non-empty passphrase argument was passed to the ioncube_write_file() API function),
 * the same passphrase should be specified as the third argument.
 * Files encrypted by one Encoder can only be read by PHP scripts encoded by the same Encoder, and encrypted files cannot be read by non-encoded scripts.
 *
 * @param string $path the path of the input encrypted file.
 * @param boolean $was_encrypted wether this input file is encrypted(pass by reference).
 * @param string $passphrase a custom passphrase same with passing to the function ioncube_write_file().
 * @return mixed
 */
function ioncube_read_file($path, &$was_encrypted, $passphrase)
{
}

/**
 * Writing Encrypted Files
 *
 * Encoded PHP scripts can write encrypted files using this API function. Files written in this way can be read with the ioncube_read_file() function.
 *
 * @param string $path the path of the output file.
 * @param string $content a binary-safe string containing the content to encrypt
 * @param boolean $encrypt wether a plain text file or not
 * @param string $passphrase a custom passphrase is used then files encrypted with one installation can be read by a different installation’s encoded files,
 * if the correct custom passphrase is passed to the ioncube_read_file() function.
 * @return int
 */
function ioncube_write_file($path, $content, $encrypt, $passphrase)
{
}