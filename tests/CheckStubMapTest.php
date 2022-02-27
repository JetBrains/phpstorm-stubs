<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\TestCase;

class CheckStubMapTest extends TestCase
{
    public function testStubMapIsUpToDate(): void
    {
        $this->assertFileEquals(
            $this->getNewStubMapFile(),
            $this->getOldStubMapFile(),
            'The commited stub map is not up to date. Please regenerate it using ./generate-stub-map'
        );
    }

    private function getOldStubMapFile(): string
    {
        return __DIR__ . '/../PhpStormStubsMap.php';
    }

    private function getNewStubMapFile(): string
    {
        $tempStubMap = tempnam(sys_get_temp_dir(), 'stub');
        $generator = escapeshellarg(__DIR__ . '/Tools/generate-stub-map');
        $newStubMap = escapeshellarg($tempStubMap);
        exec("php $generator $newStubMap", $output, $exitCode);
        if ($exitCode) {
            $this->fail("PHP script $generator exited with code $exitCode: " . implode("\n", $output));
        }
        return $tempStubMap;
    }
}
