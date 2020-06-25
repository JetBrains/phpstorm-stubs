<?php

/**
 * @since 8.0
 */
class ReflectionAttribute
{
    /**
     * Indicates that the search for a suitable attribute should not be by
     * strict comparison, but by the inheritance chain.
     *
     * Used for the argument of flags of the "getAttribute" method.
     *
     * @var int
     * @since 8.0
     */
    public const IS_INSTANCEOF = 2;

    /**
     * ReflectionAttribute cannot be created explicitly.
     * @since 8.0
     */
    private function __construct()
    {
    }

    /**
     * Gets attribute name
     *
     * @return string The name of the attribute parameter.
     * @since 8.0
     */
    public function getName(): string
    {
    }

    /**
     * Gets list of passed attribute's arguments
     *
     * @return array
     * @since 8.0
     */
    public function getArguments(): array
    {
    }

    /**
     * Creates a new instance of declarted attribute with passed arguments
     *
     * @return object
     * @since 8.0
     */
    public function newInstance(): object
    {
    }

    /**
     * @return void
     * @since 8.0
     */
    private function __clone()
    {
    }
}
