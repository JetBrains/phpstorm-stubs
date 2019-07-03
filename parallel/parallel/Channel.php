<?php

namespace parallel;

use parallel\Channel\Error\Closed;
use parallel\Channel\Error\Existence;
use parallel\Channel\Error\IllegalValue;

final class Channel
{
    public const Infinite = -1;

    /**
     * Without capacity argument: Shall make an unbuffered channel with the given name.
     * With capacity argument: Shall make a buffered channel with the given name and capacity
     *
     * @param string   $name     The name of the channel.
     * @param int|null $capacity May be Channel::Infinite or a positive integer
     *
     * @return Channel
     *
     * @throws Existence if channel already exists.
     */
    public static function make(string $name, int $capacity = null): Channel {}

    /**
     * Shall open the channel with the given name.
     *
     * @param string $name The name of the channel.
     *
     * @return Channel
     *
     * @throws Existence  if channel does not exist.
     */
    public static function open(string $name): Channel {}

    /**
     * Shall recv a value from this channel.
     *
     * @return mixed
     *
     * @throws Closed if channel is closed.
     */
    public function recv() {}

    /**
     * Shall send the given value on this channel
     *
     * @param mixed $value
     *
     * @throws Closed if channel is closed.
     * @throws IllegalValue if value is illegal. (Same arguments characteristics apply as for Runtime::run.)
     */
    public function send($value): void {}

    /**
     * Shall close this channel.
     *
     * @throws Closed if channel is closed.
     */
    public function close(): void {}
}
