<?php

namespace StubTests\Framework\DataProvider;

interface ReflectionDataProvider
{
    /**
     * Get internal class names (excluding enums and interfaces).
     *
     * @return string[] Canonical class names
     */
    public function getReflectionClasses();

    /**
     * Get internal interface names.
     *
     * @return string[] Interface names
     */
    public function getReflectionInterfaces();

    /**
     * Get internal enum names (PHP 8.1+).
     *
     * @return string[] Enum names
     */
    public function getReflectionEnums();

    /**
     * Get internal function names.
     *
     * @return string[] Function names
     */
    public function getReflectionFunctions();

    /**
     * Get internal constants as name => value pairs.
     *
     * @return array<string, mixed> Constant name => value
     */
    public function getReflectionConstants();
}