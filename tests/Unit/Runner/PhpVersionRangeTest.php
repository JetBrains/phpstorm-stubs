<?php

namespace StubTests\Unit\Runner;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class PhpVersionRangeTest extends TestCase
{
    public function testIncludesVersionWithinRange(): void
    {
        $range = new PhpVersionRange('7.0', '8.0');
        $this->assertTrue($range->includes('7.4'));
    }

    public function testIncludesLowerBound(): void
    {
        $range = new PhpVersionRange('7.0', '8.0');
        $this->assertTrue($range->includes('7.0'));
    }

    public function testIncludesUpperBound(): void
    {
        $range = new PhpVersionRange('7.0', '8.0');
        $this->assertTrue($range->includes('8.0'));
    }

    public function testExcludesVersionBelowRange(): void
    {
        $range = new PhpVersionRange('7.0', '8.0');
        $this->assertFalse($range->includes('5.6'));
    }

    public function testExcludesVersionAboveRange(): void
    {
        $range = new PhpVersionRange('7.0', '8.0');
        $this->assertFalse($range->includes('8.1'));
    }

    public function testSingleVersionRangeWhenToIsNull(): void
    {
        $range = new PhpVersionRange('8.0');
        $this->assertEquals('8.0', $range->from);
        $this->assertEquals('8.0', $range->to);
        $this->assertTrue($range->includes('8.0'));
        $this->assertFalse($range->includes('7.4'));
        $this->assertFalse($range->includes('8.1'));
    }

    public function testAcceptsPhpVersionsEnum(): void
    {
        $range = new PhpVersionRange(PhpVersions::PHP_7_0, PhpVersions::PHP_8_4);
        $this->assertEquals('7.0', $range->from);
        $this->assertEquals('8.4', $range->to);
        $this->assertTrue($range->includes('8.0'));
    }

    public function testAcceptsMixedEnumAndString(): void
    {
        $range = new PhpVersionRange(PhpVersions::PHP_7_0, '8.0');
        $this->assertEquals('7.0', $range->from);
        $this->assertEquals('8.0', $range->to);
    }

    public function testSingleVersionWithEnum(): void
    {
        $range = new PhpVersionRange(PhpVersions::PHP_8_1);
        $this->assertEquals('8.1', $range->from);
        $this->assertEquals('8.1', $range->to);
    }

    public function testEarliestToLatest(): void
    {
        $range = new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST);
        foreach (PhpVersions::cases() as $version) {
            $this->assertTrue($range->includes($version->value), "Should include {$version->value}");
        }
    }
}
