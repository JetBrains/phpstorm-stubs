<?php
/**
 * Extension stub file for PECL HTTP version 3.x
 * @author Katherine Rossiter <signe@users.noreply.github.com>
 * @see https://mdref.m6w6.name/http
 */

namespace http {

    interface Exception
    {
    }

    class QueryString implements \Serializable, \ArrayAccess, \IteratorAggregate
    {

        const TYPE_ARRAY  = 7;
        const TYPE_BOOL   = 13;
        const TYPE_FLOAT  = 5;
        const TYPE_INT    = 4;
        const TYPE_OBJECT = 8;
        const TYPE_STRING = 6;

        /**
         * The global instance. See http\QueryString::getGlobalInstance().
         * @var QueryString
         */
        private $instance;

        /**
         * The data
         * @var mixed[]
         */
        private $queryArray = null;

        /**
         * QueryString constructor.
         * @param string $querystring
         */
        public function __construct($querystring)
        {
        }

        /**
         * @return string
         */
        public function __toString()
        {
        }

        /**
         * Retrieve an querystring value
         * @param string $name
         * @param mixed $type
         * @param mixed $defval
         * @param bool $delete
         */
        public function get($name = null, $type = null, $defval = null, $delete = false)
        {
        }

        /**
         * Retrieve an array value at offset $name
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         * @return array
         */
        public function getArray($name, $defval = null, $delete = false)
        {
        }

        /**
         * Retrieve an array value at offset $name
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         * @return bool
         */
        public function getBool($name, $defval = null, $delete = false)
        {
        }

        /**
         * Retrieve an array value at offset $name
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         * @return float
         */
        public function getFloat($name, $defval = null, $delete = false)
        {
        }

        /**
         * Retrieve the global querystring instance referencing $_GET
         * @return QueryString
         */
        public static function getGlobalInstance()
        {
        }

        /**
         * Retrieve an array value at offset $name
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         * @return int
         */
        public function getInt($name, $defval = null, $delete = false)
        {
        }

        /**
         * @return \IteratorAggregate
         */
        public function getIterator()
        {
        }

        /**
         * Retrieve an array value at offset $name
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         */
        public function getObject($name, $defval = null, $delete = false)
        {
        }

        /**
         * Retrieve an array value at offset $name
         * @param string $name
         * @param mixed $defval
         * @param bool $delete
         * @return string
         */
        public function getString($name, $defval = null, $delete = false)
        {
        }

        /**
         * Set additional $params to a clone of this instance
         * @param mixed $params
         * @return QueryString
         */
        public function mod($params = null)
        {
        }

        public function offsetExists($offset)
        {
        }

        public function offsetGet($offset)
        {
        }

        public function offsetSet($offset, $value)
        {
        }

        public function offsetUnset($offset)
        {
        }

        public function serialize()
        {
        }

        /**
         * Set additional querystring entries
         * @param mixed $params
         * @return QueryString
         */
        public function set($params)
        {
        }

        /**
         * Returns http\QueryString::$queryArray
         * @return mixed[]
         */
        public function toArray()
        {
        }

        /**
         * Get the string represenation of the querystring (x-www-form-urlencoded)
         * @return string
         */
        public function toString()
        {
        }

        public function unserialize($serialized)
        {
        }

        /**
         * Translate character encodings of the querystring with ext/iconv
         * @param string $from_enc
         * @param string $to_enc
         * @return QueryString
         */
        public function xlate()
        {
        }
    }

    class Url
    {
        const FROM_ENV         = 0x1000;
        const IGNORE_ERRORS    = 0x10000000;
        const JOIN_PATH        = 0x1;
        const JOIN_QUERY       = 0x2;
        const PARSE_MBLOC      = 0x10000;
        const PARSE_MBUTF8     = 0x20000;
        const PARSE_TOIDN      = 0x100000;
        const PARSE_TOIDN_2003 = 0x900000;
        const PARSE_TOIDN_2008 = 0x500000;
        const PARSE_TOPCT      = 0x200000;
        const REPLACE          = 0x0;
        const SANITIZE_PATH    = 0x2000;
        const SILENT_ERRORS    = 0x20000000;
        const STDFLAGS         = 0x332003;
        const STRIP_ALL        = 0x1EC;
        const STRIP_AUTH       = 0xC;
        const STRIP_FRAGMENT   = 0x100;
        const STRIP_PASS       = 0x8;
        const STRIP_PATH       = 0x40;
        const STRIP_PORT       = 0x20;
        const STRIP_QUERY      = 0x80;
        const STRIP_USER       = 0x4;

        /** @var string */
        public $scheme = null;

        /** @var string */
        public $user = null;

        /** @var string */
        public $pass = null;

        /** @var string */
        public $host = null;

        /** @var string */
        public $port = null;

        /** @var string */
        public $path = null;

        /** @var string */
        public $query = null;

        /** @var string */
        public $fragment = null;

        /**
         * Url constructor.
         * @param mixed $old_url
         * @param mixed $new_url
         * @param int $flags
         */
        public function __construct($old_url = null, $new_url = null, $flags = 0)
        {
        }

        /**
         * Alias of Url::toString()
         */
        public function __toString()
        {
        }

        /**
         * Clone this URL and apply $parts to the cloned URL
         * @param mixed $parts
         * @param $flags
         * @return Url
         */
        public function mod($parts, $flags = http\Url::JOIN_PATH | http\Url::JOIN_QUERY | http\Url::SANITIZE_PATH)
        {
        }

        /**
         * Retrieve the URL parts as array
         * @return string[]
         */
        public function toArray()
        {
        }

        /**
         * Get the string prepresentation of the URL
         * @return string
         */
        public function toString()
        {
        }
    }
}

namespace http\Exception {

    class BadConversionException extends \DomainException implements \http\Exception
    {
    }

    class BadHeaderException extends \DomainException implements \http\Exception
    {
    }

    class BadMessageException extends \DomainException implements \http\Exception
    {
    }

    class BadMethodCallException extends \BadMethodCallException implements \http\Exception
    {
    }

    class BadQueryStringException extends \DomainException implements \http\Exception
    {
    }

    class BadUrlException extends \DomainException implements \http\Exception
    {
    }

    class InvalidArgumentException extends \InvalidArgumentException implements \http\Exception
    {
    }

    class RuntimeException extends \RuntimeException implements \http\Exception
    {
    }

    class UnexpectedValueException extends \UnexpectedValueException implements \http\Exception
    {
    }
}
