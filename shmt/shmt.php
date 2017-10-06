<?php

/**
 * Creates and uses its own memory-mapped binary file.
 * This enable it to cache and share the loaded pages of the file across multiple processes.
 * Has an extremely fast initial load, regardless of the size of the binary file.
 * Internally implements a "perfect hash function" and guarantees O(1) lookup time in the worst cases.
 * PHP 7 and PHP 7.1 Compatible
 * Limitations
 * - Supported maximum number of data array elements is 2^26 (67,108,864 on 32 bit systems)
 * and 2^31 (2,147,483,648 on 64 bit systems).
 * - The data array keys and values are always cast to string.
 * - Data files cannot be exchanged between 32 bit and 64 bit systems or systems with different endianness.
 * - The code compiles and runs on Linux systems. Other platforms have not been tested.
 * @link https://github.com/sevenval/SHMT/blob/master/README.md
 *
 * Class SHMT
 */
class SHMT
{
    /**
     * Constructs file
     * SHMT constructor.
     * Notes:
     * - Creates a SHMT from the $array and writes it into the file $filename
     * @param string $filename
     *
     * @throws \Exception
     */
    public function __construct($filename){}

    /**
     * Creates binary file in memory from array
     * @param string $filename
     * @param array $array
     *
     * @return boolean
     * @throws \Exception
     */
    public static function create($filename, $array){}

    /**
     * Gets value from binary file array if exists otherwise returns null
     * @param string $string
     *
     * @return string|null
     */
    public static function get($string){}


}
