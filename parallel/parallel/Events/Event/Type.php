<?php

namespace parallel\Events\Event;

/**
 * The values of all constants are an implementation detail and cannot be relied upon.
 * @link https://github.com/krakjoe/parallel/issues/37#issuecomment-493502459
 */
final class Type
{
    /**
     * Event::$object was read into Event::$value
     *
     * @var int
     */
    public const Read = null;

    /**
     * Input for Event::$source written to Event::$object
     *
     * @var int
     */
    public const Write = null;

    /**
     * Event::$object (Channel) was closed
     *
     * @var int
     */
    public const Close = null;

    /**
     * Event::$object (Future) was cancelled
     *
     * @var int
     */
    public const Cancel = null;

    /**
     * Runtime executing Event::$object (Future) was killed
     *
     * @var int
     */
    public const Kill = null;

    /**
     * Event::$object (Future) raised error
     *
     * @var int
     */
    public const Error = null;
}
