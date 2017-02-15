<?php
/**
 * PHPStorm stub file for YAML Data Serialization constants.
 *
 * @link http://php.net/manual/en/yaml.constants.php
 */

/**
 * Linebreak types for yaml_emit()
 *
 * @link  http://php.net/manual/en/yaml.constants.php
 * @const YAML_ANY_BREAK Let emitter choose linebreak character.
 * @const YAML_CR_BREAK Use \r as break character (Mac style).
 * @const YAML_LN_BREAK Use \n as break character (Unix style).
 * @const YAML_CRLN_BREAK Use \r\n as break character (DOS style).
 */
const YAML_ANY_BREAK = 0;
/**
 * Encoding types for yaml_emit()
 *
 * @link http://php.net/manual/en/yaml.constants.php
 */
const YAML_ANY_ENCODING = 0;
/**
 * Scalar entity styles usable by yaml_parse() callback methods.
 *
 * @link http://php.net/manual/en/yaml.constants.php
 */
const YAML_ANY_SCALAR_STYLE = 0;
const YAML_BOOL_TAG = 'tag:yaml.org,2002:bool';
const YAML_CRLN_BREAK = 3;
const YAML_CR_BREAK = 1;
const YAML_DOUBLE_QUOTED_SCALAR_STYLE = 3;
const YAML_FLOAT_TAG = 'tag:yaml.org,2002:float';
const YAML_FOLDED_SCALAR_STYLE = 5;
const YAML_INT_TAG = 'tag:yaml.org,2002:int';
const YAML_LITERAL_SCALAR_STYLE = 4;
const YAML_LN_BREAK = 2;
const YAML_MAP_TAG = 'tag:yaml.org,2002:map';
/**
 * Common tags usable by yaml_parse() callback methods.
 *
 * @link http://php.net/manual/en/yaml.constants.php
 */
const YAML_NULL_TAG = 'tag:yaml.org,2002:null';
const YAML_PHP_TAG = '!php/object';
const YAML_PLAIN_SCALAR_STYLE = 1;
const YAML_SEQ_TAG = 'tag:yaml.org,2002:seq';
const YAML_SINGLE_QUOTED_SCALAR_STYLE = 2;
const YAML_STR_TAG = 'tag:yaml.org,2002:str';
const YAML_TIMESTAMP_TAG = 'tag:yaml.org,2002:timestamp';
const YAML_UTF16BE_ENCODING = 3;
const YAML_UTF16LE_ENCODING = 2;
const YAML_UTF8_ENCODING = 1;
