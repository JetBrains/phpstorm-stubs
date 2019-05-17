<?php

namespace parallel\Events\Event;

/**
 * The values of all constants are an implementation detail and cannot be relied upon.
 * @link https://github.com/krakjoe/parallel/issues/37#issuecomment-493502459
 */
final class Type
{
    /* Event::$object was read into Event::$value */
    public const Read = null;

    /* Input for Event::$source written to Event::$object */
    public const Write = null;

    /* Event::$object (Channel) was closed */
    public const Close = null;

    /* Event::$object (Future) was cancelled */
    public const Cancel = null;

    /* Runtime executing Event::$object (Future) was killed */
    public const Kill = null;

    /* Event::$object (Future) raised error */
    public const Error = null;
}
