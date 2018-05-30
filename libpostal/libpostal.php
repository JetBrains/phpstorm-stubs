<?php
namespace Postal;
// Start of libpostal v.

class Expand
{
    /**
     * Expand a postal address
     * @link https://github.com/openvenues/php-postal
     * @param string $address [required] <p>
     * The address is a partial or whole international postal address.
     * </p>
     * <p>
     * <p>
     * The address can be abbreviations or whole words in any language supported
     * by UTF-8 and this function expands the abbreviations in the address to whole words.
     * </p>
     * </p>
     * @return array of possible address expansion strings with
     * abbreviations expanded to whole words.
     * @since 5.5
     */
    public static function expand_address($address){}
}
class Parser
{
    /**
     * Parse a postal address into array
     * @link https://github.com/openvenues/php-postal
     * @param string $address [required] <p>
     * Parses address into best guess components
     * </p>
     * @return array of indexes named after address components, with values of
     * corresponding components parsed from input address string.
     * @since 5.5
     */
    public static function parse_address($address){}
}

// End of libpostal v.
?>
