<?php

namespace Swoole\Thread\Atomic;

class Long
{
    public function __construct(int $value = 0) {}

    public function add(int $add_value = 1): int {}

    public function sub(int $sub_value = 1): int {}

    public function get(): int {}

    public function set(int $value): void {}

    public function cmpset(int $cmp_value, int $new_value): bool {}
}
