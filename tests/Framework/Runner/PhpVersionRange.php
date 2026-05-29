<?php

namespace StubTests\Framework\Runner;

use Attribute;
use StubTests\Framework\Runner\PhpVersions;

#[Attribute(Attribute::TARGET_METHOD)]
class PhpVersionRange
{
    public string $from;
    public string $to;

    public function __construct(PhpVersions|string $from, PhpVersions|string|null $to = null)
    {
        $this->from = $from instanceof PhpVersions ? $from->value : self::validateVersion($from);
        $to ??= $from;
        $this->to = $to instanceof PhpVersions ? $to->value : self::validateVersion($to);
    }

    private static function validateVersion(string $version): string
    {
        if (!preg_match('/^\d+\.\d+$/', $version)) {
            throw new \InvalidArgumentException(
                "Invalid PHP version format '{$version}'. Expected 'major.minor' (e.g. '8.0')."
            );
        }
        return $version;
    }

    public function includes(string $version): bool
    {
        return version_compare($version, $this->from, '>=') && version_compare($version, $this->to, '<=');
    }
}
