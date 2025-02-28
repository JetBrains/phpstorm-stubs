<?php

/**
 * Stubs for JsonPath
 * https://pecl.php.net/package/jsonpath
 * https://github.com/supermetrics-public/pecl-jsonpath
 */

namespace JsonPath;

/**
 * @since 7.4
 */
class JsonPath
{
    /**
     * @param array $data
     * @param string $expression
     * @return array|false an array on success or <b>FALSE</b> on failure (not found).
     * @throws JsonPathException
     * @since 7.4
     */
    public function find(array $data, string $expression): array|false {}
}

/**
 * @since 7.4
 */
class JsonPathException extends \RuntimeException {}
