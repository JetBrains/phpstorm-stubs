<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\ParameterNamesCheck;
use StubTests\Unit\Validator\CheckTestCase;

class ParameterNamesCheckTest extends CheckTestCase
{
    public function testSupportsPhp80AndAbove(): void
    {
        $check = new ParameterNamesCheck();

        $this->assertFalse($check->supports(PhpVersions::EARLIEST->value));
        $this->assertFalse($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertFalse($check->supports(PhpVersions::PHP_7_4->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testMatchingParameterNamesForFunction(): void
    {
        $functionName = 'array_map';
        $param1 = $this->createMockParameter('callback');
        $param2 = $this->createMockParameter('array');

        $reflectionFunction = $this->createMockFunction($functionName, [$param1, $param2]);
        $stubFunction = $this->createMockFunction($functionName, [$param1, $param2]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testParameterNameMismatch(): void
    {
        $functionName = 'test_function';
        $reflectionParam = $this->createMockParameter('callback');
        $stubParam = $this->createMockParameter('wrongName');

        $reflectionFunction = $this->createMockFunction($functionName, [$reflectionParam]);
        $stubFunction = $this->createMockFunction($functionName, [$stubParam]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($functionName, $failures);
        $this->assertStringContainsString('#0: reflection \'$callback\'', $failures[$functionName]);
        $this->assertStringContainsString('stubs \'$wrongName\'', $failures[$functionName]);
        $this->assertStringContainsString('parameter name mismatch(es)', $failures[$functionName]);
    }

    public function testParameterCountMismatchSilentlySucceeds(): void
    {
        // Parameter count mismatches are ParametersCountCheck's responsibility — silently skip
        $functionName = 'test_function';
        $param1 = $this->createMockParameter('param1');
        $param2 = $this->createMockParameter('param2');

        $reflectionFunction = $this->createMockFunction($functionName, [$param1, $param2]);
        $stubFunction = $this->createMockFunction($functionName, [$param1]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testFunctionNotFoundInReflection(): void
    {
        $functionName = 'missing_function';
        $stubFunction = $this->createMockFunction($functionName);

        $reflectionProvider = $this->createMockReflectionProvider([]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertStringContainsString('not found in reflection data', $failures[$functionName]);
    }

    public function testFunctionNotFoundInStubsSilentlySucceeds(): void
    {
        // Stub not found — FunctionExistsCheck's responsibility; silently skip
        $functionName = 'missing_function';
        $reflectionFunction = $this->createMockFunction($functionName);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMatchingParameterNamesForMethod(): void
    {
        $methodId = 'DateTime::format';
        $param = $this->createMockParameter('format');

        $reflectionMethod = $this->createMockMethod('format', [$param]);
        $reflectionClass = $this->createMockClass('DateTime', [$reflectionMethod]);

        $stubMethod = $this->createMockMethod('format', [$param]);
        $stubClass = $this->createMockClass('DateTime', [$stubMethod]);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $methodId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMultipleParameterNameMismatchesReportedInOneMessage(): void
    {
        $functionName = 'test_function';
        $reflParam1 = $this->createMockParameter('callback');
        $reflParam2 = $this->createMockParameter('array');
        $stubParam1 = $this->createMockParameter('wrongName1');
        $stubParam2 = $this->createMockParameter('wrongName2');

        $reflectionFunction = $this->createMockFunction($functionName, [$reflParam1, $reflParam2]);
        $stubFunction = $this->createMockFunction($functionName, [$stubParam1, $stubParam2]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($functionName, $failures);
        // Both mismatches must appear in the single combined message
        $this->assertStringContainsString('#0', $failures[$functionName]);
        $this->assertStringContainsString('$callback', $failures[$functionName]);
        $this->assertStringContainsString('$wrongName1', $failures[$functionName]);
        $this->assertStringContainsString('#1', $failures[$functionName]);
        $this->assertStringContainsString('$array', $failures[$functionName]);
        $this->assertStringContainsString('$wrongName2', $failures[$functionName]);
    }

    public function testParametersWithVersionAttributes(): void
    {
        // Old parameter (5.3–7.4) filtered out at PHP 8.0; only new one (8.0+) remains
        $functionName = 'mktime';

        $reflectionParam = $this->createMockParameter('hour');
        $reflectionFunction = $this->createMockFunction($functionName, [$reflectionParam]);

        $stubParamOld = $this->createMockParameter('hour', null, '5.3', '7.4');
        $stubParamNew = $this->createMockParameter('hour', null, '8.0', null);
        $stubFunction = $this->createMockFunction($functionName, [$stubParamOld, $stubParamNew]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertFalse($result->hasFailures(), 'Expected no failures when filtering parameters by version');
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testParametersWithAliasedVersionAttributes(): void
    {
        // $sort_flags removed after 5.6 — filtered out at PHP 8.0; count matches reflection (2)
        $functionName = 'collator_sort_with_sort_keys';

        $reflParam1 = $this->createMockParameter('object');
        $reflParam2 = $this->createMockParameter('array');
        $reflectionFunction = $this->createMockFunction($functionName, [$reflParam1, $reflParam2]);

        $stubParam1 = $this->createMockParameter('object');
        $stubParam2 = $this->createMockParameter('array');
        $stubParam3 = $this->createMockParameter('sort_flags', null, '5.3', '5.6');
        $stubFunction = $this->createMockFunction($functionName, [$stubParam1, $stubParam2, $stubParam3]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertFalse($result->hasFailures(), 'Expected no failures when filtering parameters with version attributes');
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testParameterIncludedAtBoundaryVersion(): void
    {
        // Parameter with removedVersion='8.2' must still be counted for PHP 8.2
        $functionName = 'imagerotate';

        $reflParams = array_map(
            fn ($n) => $this->createMockParameter($n),
            ['image', 'angle', 'background_color', 'ignore_transparent']
        );
        $reflectionFunction = $this->createMockFunction($functionName, $reflParams);

        $stubParams = [
            $this->createMockParameter('image'),
            $this->createMockParameter('angle'),
            $this->createMockParameter('background_color'),
            $this->createMockParameter('ignore_transparent', null, null, '8.2'),
        ];
        $stubFunction = $this->createMockFunction($functionName, $stubParams);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.2');

        $this->assertFalse($result->hasFailures(), 'Parameter with removedVersion=8.2 should be included in PHP 8.2');
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testParameterExcludedAfterBoundaryVersion(): void
    {
        // Parameter with removedVersion='8.2' is filtered out for PHP 8.3 — count drops to 3
        // which matches the 3 reflection params, so names still match
        $functionName = 'imagerotate';

        $reflParams = array_map(
            fn ($n) => $this->createMockParameter($n),
            ['image', 'angle', 'background_color']
        );
        $reflectionFunction = $this->createMockFunction($functionName, $reflParams);

        $stubParams = [
            $this->createMockParameter('image'),
            $this->createMockParameter('angle'),
            $this->createMockParameter('background_color'),
            $this->createMockParameter('ignore_transparent', null, null, '8.2'),
        ];
        $stubFunction = $this->createMockFunction($functionName, $stubParams);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.3');

        $this->assertFalse($result->hasFailures(), 'Parameter with removedVersion=8.2 should be excluded in PHP 8.3');
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testVariadicDeduplicationMergesSameNamedPair(): void
    {
        // Stub pattern: $vals[to:'7.4'], ...$vals  → deduplicates to 1 param named 'vals' at PHP 8.0
        $functionName = 'test_variadic';

        $reflParam = $this->createMockParameter('vals');
        $reflectionFunction = $this->createMockFunction($functionName, [$reflParam]);

        $stubParamFixed = $this->createMockParameter('vals', null, null, '7.4');
        $stubParamVariadic = new \StubTests\Framework\Parsers\Model\PHPParameter('vals');
        $stubParamVariadic->setIsVariadic(true);

        $stubFunction = $this->createMockFunction($functionName, [$stubParamFixed, $stubParamVariadic]);

        $reflectionProvider = $this->createMockReflectionProvider([$reflectionFunction]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$stubFunction]);

        $check = new ParameterNamesCheck($reflectionProvider);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertFalse($result->hasFailures(), 'Variadic deduplication should merge same-named pair to 1 param');
        $this->assertEquals(1, $result->getSuccessCount());
    }
}
