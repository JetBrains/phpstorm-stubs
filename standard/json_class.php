<?php
/**
 * PHPStorm stub file for JavaScript Object Notation(JSON) classes.
 *
 * @link http://php.net/manual/en/book.json.php
 */

/**
 * Objects implementing JsonSerializable
 * can customize their JSON representation when encoded with
 * <b>json_encode</b>.
 *
 * @link http://php.net/manual/en/class.jsonserializable.php
 * @since 5.4.0
 */
interface JsonSerializable
{
    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize();
}

/**
 * Class JsonIncrementalParser.
 *
 * __WARNING:__
 * Class does not appear in the PHP docs.
 *
 * @todo Verify this class actual exists since it doesn't appear any where in the PHP docs. Maybe part of old JSON?
 */
class JsonIncrementalParser
{
    const JSON_PARSER_CONTINUE = 1;
    const JSON_PARSER_SUCCESS = 0;

    /**
     * @param $depth   [optional]
     * @param $options [optional]
     */
    public function __construct($depth, $options) { }

    /**
     * @param $options [optional]
     */
    public function get($options) { }

    public function getError() { }

    /**
     * @param $json
     */
    public function parse($json) { }

    /**
     * @param $filename
     */
    public function parseFile($filename) { }

    public function reset() { }
}
