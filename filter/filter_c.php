<?php

namespace Filter;

    /**
     * The base class for Exceptions thrown by the Filter extension.
     * @link https://php.net/manual/en/class.filter-filterexception.php
     * @since 8.5
     */
    class FilterException extends \Exception {}

    /**
     * Thrown when a validation filter fails and the FILTER_THROW_ON_FAILURE flag is set.
     * @link https://php.net/manual/en/class.filter-filterfailedexception.php
     * @since 8.5
     */
    class FilterFailedException extends FilterException {}
