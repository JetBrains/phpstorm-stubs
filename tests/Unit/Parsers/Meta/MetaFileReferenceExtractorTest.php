<?php

namespace StubTests\Unit\Parsers\Meta;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Meta\MetaFileReferenceExtractor;
use StubTests\Framework\Parsers\Meta\MetaReference;
use StubTests\Framework\Parsers\Meta\MetaReferenceRole;
use StubTests\Framework\Parsers\Meta\MetaReferenceType;

class MetaFileReferenceExtractorTest extends TestCase
{
    private MetaFileReferenceExtractor $extractor;

    protected function setUp(): void
    {
        $this->extractor = new MetaFileReferenceExtractor();
    }

    public function testExtractExpectedArgumentsFunction(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\array_change_key_case(), 1, CASE_LOWER, CASE_UPPER);
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::FUNCTION, '\\array_change_key_case', $refs);
        $this->assertContainsRef(MetaReferenceType::GLOBAL_CONST, '\\CASE_LOWER', $refs);
        $this->assertContainsRef(MetaReferenceType::GLOBAL_CONST, '\\CASE_UPPER', $refs);
    }

    public function testExtractExpectedArgumentsFunctionHasCallableRole(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\array_change_key_case(), 1, CASE_LOWER);
}
PHP;
        $refs = $this->extractFromCode($code);

        $funcRef = $this->findRef(MetaReferenceType::FUNCTION, '\\array_change_key_case', $refs);
        $this->assertNotNull($funcRef);
        $this->assertSame(MetaReferenceRole::CALLABLE, $funcRef->role);

        $constRef = $this->findRef(MetaReferenceType::GLOBAL_CONST, '\\CASE_LOWER', $refs);
        $this->assertNotNull($constRef);
        $this->assertSame(MetaReferenceRole::VALUE, $constRef->role);
    }

    public function testExtractExpectedArgumentsMethod(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\PDO::setAttribute(), 0, \PDO::ATTR_CASE);
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::METHOD, '\\PDO::setAttribute', $refs);
        $this->assertContainsRef(MetaReferenceType::CLASS_CONST, '\\PDO::ATTR_CASE', $refs);
    }

    public function testExtractExpectedArgumentsMethodHasCallableRole(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\PDO::setAttribute(), 0, \PDO::ATTR_CASE);
}
PHP;
        $refs = $this->extractFromCode($code);

        $methodRef = $this->findRef(MetaReferenceType::METHOD, '\\PDO::setAttribute', $refs);
        $this->assertNotNull($methodRef);
        $this->assertSame(MetaReferenceRole::CALLABLE, $methodRef->role);

        $constRef = $this->findRef(MetaReferenceType::CLASS_CONST, '\\PDO::ATTR_CASE', $refs);
        $this->assertNotNull($constRef);
        $this->assertSame(MetaReferenceRole::VALUE, $constRef->role);
    }

    public function testExtractExpectedReturnValuesFunction(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(\json_last_error(), JSON_ERROR_NONE, JSON_ERROR_DEPTH);
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::FUNCTION, '\\json_last_error', $refs);
        $this->assertContainsRef(MetaReferenceType::GLOBAL_CONST, '\\JSON_ERROR_NONE', $refs);
        $this->assertContainsRef(MetaReferenceType::GLOBAL_CONST, '\\JSON_ERROR_DEPTH', $refs);
    }

    public function testExtractExpectedReturnValuesConstant(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(\PHP_OS_FAMILY, 'Windows', 'Linux');
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::GLOBAL_CONST, '\\PHP_OS_FAMILY', $refs);
        // String literals should not produce refs
        $this->assertCount(1, $refs);
    }

    public function testExtractExpectedReturnValuesConstantHasCallableRole(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(\PHP_OS_FAMILY, 'Windows');
}
PHP;
        $refs = $this->extractFromCode($code);

        $ref = $this->findRef(MetaReferenceType::GLOBAL_CONST, '\\PHP_OS_FAMILY', $refs);
        $this->assertNotNull($ref);
        $this->assertSame(MetaReferenceRole::CALLABLE, $ref->role);
    }

    public function testExtractExpectedReturnValuesMethod(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(\ReflectionClass::getModifiers(), \ReflectionClass::IS_FINAL);
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::METHOD, '\\ReflectionClass::getModifiers', $refs);
        $this->assertContainsRef(MetaReferenceType::CLASS_CONST, '\\ReflectionClass::IS_FINAL', $refs);
    }

    public function testExtractRegisterArgumentsSetWithClassConstants(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet('FFICTypeKind',
        \FFI\CType::TYPE_VOID,
        \FFI\CType::TYPE_FLOAT
    );
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::CLASS_CONST, '\\FFI\\CType::TYPE_VOID', $refs);
        $this->assertContainsRef(MetaReferenceType::CLASS_CONST, '\\FFI\\CType::TYPE_FLOAT', $refs);
        // String name should not produce a ref
        $this->assertNotContainsRefType(MetaReferenceType::FUNCTION, $refs);
    }

    public function testExtractRegisterArgumentsSetSkipsStringValues(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet('FFICType', 'void *', 'bool', 'int');
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertEmpty($refs, 'String-only registerArgumentsSet should produce no refs');
    }

    public function testExtractOverrideFunction(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\array_shift(0), elementType(0));
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::FUNCTION, '\\array_shift', $refs);
        $this->assertCount(1, $refs);
    }

    public function testExtractOverrideMethod(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\DOMDocument::importNode(0), type(0));
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::METHOD, '\\DOMDocument::importNode', $refs);
    }

    public function testExtractOverrideHasCallableRole(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\array_shift(0), elementType(0));
}
PHP;
        $refs = $this->extractFromCode($code);

        $ref = $this->findRef(MetaReferenceType::FUNCTION, '\\array_shift', $refs);
        $this->assertNotNull($ref);
        $this->assertSame(MetaReferenceRole::CALLABLE, $ref->role);
    }

    public function testExtractExitPoint(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    const ANY_ARGUMENT = 1;
    exitPoint(\trigger_error(ANY_ARGUMENT, \E_USER_ERROR));
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::FUNCTION, '\\trigger_error', $refs);
        $this->assertContainsRef(MetaReferenceType::GLOBAL_CONST, '\\E_USER_ERROR', $refs);
    }

    public function testExtractBitwiseOrConstants(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet('test',
        \ReflectionClass::IS_FINAL |
        \ReflectionClass::IS_EXPLICIT_ABSTRACT
    );
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::CLASS_CONST, '\\ReflectionClass::IS_FINAL', $refs);
        $this->assertContainsRef(MetaReferenceType::CLASS_CONST, '\\ReflectionClass::IS_EXPLICIT_ABSTRACT', $refs);
    }

    public function testArgumentsSetCallCollectedAsUsage(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\ini_get(), 0, argumentsSet("ini_values"));
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertContainsRef(MetaReferenceType::FUNCTION, '\\ini_get', $refs);
        // argumentsSet() should not produce a symbol ref
        $this->assertCount(1, $refs);
    }

    public function testExtractArgumentsSetUsagesFromCode(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\ini_get(), 0, argumentsSet("ini_values"));
    expectedArguments(\curl_setopt(), 1, argumentsSet("curl_options"));
    expectedArguments(\curl_setopt(), 1, argumentsSet("ini_values"));
}
PHP;
        $file = $this->writeTempFile($code);
        $usages = $this->extractor->extractArgumentsSetUsages(dirname($file));

        $this->assertContains('ini_values', $usages);
        $this->assertContains('curl_options', $usages);
        // Deduplicated
        $this->assertCount(2, $usages);
    }

    public function testExtractArgumentsSetDefinitionsFromCode(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet('ini_values', 'display_errors', 'error_reporting');
    registerArgumentsSet('curl_options', CURLOPT_RETURNTRANSFER);
}
PHP;
        $file = $this->writeTempFile($code);
        $definitions = $this->extractor->extractArgumentsSetDefinitions(dirname($file));

        $this->assertContains('ini_values', $definitions);
        $this->assertContains('curl_options', $definitions);
        $this->assertCount(2, $definitions);
    }

    public function testExtractArgumentsSetUsagesFromExitPoint(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    exitPoint(\trigger_error(argumentsSet("error_levels"), \E_USER_ERROR));
}
PHP;
        $file = $this->writeTempFile($code);
        $usages = $this->extractor->extractArgumentsSetUsages(dirname($file));

        $this->assertContains('error_levels', $usages);
    }

    public function testExtractArgumentsSetUsagesFromExpectedReturnValues(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(\json_last_error(), argumentsSet("json_errors"));
}
PHP;
        $file = $this->writeTempFile($code);
        $usages = $this->extractor->extractArgumentsSetUsages(dirname($file));

        $this->assertContains('json_errors', $usages);
    }

    public function testExtractCallableRefsFiltersToCallableRole(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\array_change_key_case(), 1, CASE_LOWER);
    registerArgumentsSet('test', \PDO::ATTR_CASE);
}
PHP;
        $file = $this->writeTempFile($code);
        $refs = $this->extractor->extractCallableRefs(dirname($file));

        $this->assertCount(1, $refs);
        $this->assertSame(MetaReferenceType::FUNCTION, $refs[0]->type);
        $this->assertSame('\\array_change_key_case', $refs[0]->fqn);
        $this->assertSame(MetaReferenceRole::CALLABLE, $refs[0]->role);
    }

    public function testExtractConstantRefsFiltersToValueRole(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\array_change_key_case(), 1, CASE_LOWER);
    registerArgumentsSet('test', \PDO::ATTR_CASE);
}
PHP;
        $file = $this->writeTempFile($code);
        $refs = $this->extractor->extractConstantRefs(dirname($file));

        $this->assertCount(2, $refs);
        foreach ($refs as $ref) {
            $this->assertSame(MetaReferenceRole::VALUE, $ref->role);
        }
    }

    public function testSkipsThirdPartyNamespaces(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\PHPUnit\Framework\TestCase::createMock(0), map(["" => "$0"]));
    override(\Mockery::mock(0), map(["" => "@"]));
    expectedArguments(\GuzzleHttp\Client::request(), 0, 'GET');
    expectedArguments(\Psr\Log\LoggerInterface::log(0), 0, 'info');
    expectedArguments(\Illuminate\Support\Facades\Http::send(), 0, 'GET');
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertEmpty($refs, 'All third-party references should be filtered');
    }

    public function testSkipsThirdPartyFunctions(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\mock(0), map(["" => "@"]));
    override(\spy(0), map(["" => "@"]));
    override(\expect(0), type(0));
    exitPoint(\jexit());
    exitPoint(\wp_die());
    exitPoint(\dd());
}
PHP;
        $refs = $this->extractFromCode($code);

        $this->assertEmpty($refs, 'All third-party functions should be filtered');
    }

    public function testExtractAllFromRepo(): void
    {
        $rootDir = dirname(__DIR__, 4); // tests/ -> project root
        $refs = $this->extractor->extractAll($rootDir);

        $this->assertNotEmpty($refs, 'Should extract references from actual meta files');

        // Verify some well-known references exist
        $fqns = array_map(fn (MetaReference $r) => $r->type->value . ':' . $r->fqn, $refs);

        $this->assertContains('function:\\array_shift', $fqns);
        $this->assertContains('function:\\curl_setopt', $fqns);
        $this->assertContains('method:\\FFI::new', $fqns);
        $this->assertContains('class_const:\\FFI\\CType::TYPE_VOID', $fqns);
    }

    public function testDeduplicatesReferences(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\test_func(), 0, \TEST_CONST);
    expectedArguments(\test_func(), 1, \TEST_CONST);
}
PHP;
        $file = $this->writeTempFile($code);
        $refs1 = $this->extractor->extractFromFile($file);
        // Within a single file, duplicates stay (dedup is in extractAll)
        // But extractAll deduplicates
        $allRefs = $this->extractor->extractAll(dirname($file));
        $fqns = array_map(fn (MetaReference $r) => $r->toEntityId(), $allRefs);
        $this->assertCount(count(array_unique($fqns)), $fqns, 'extractAll should deduplicate');
    }

    public function testEntityIdRoundtrip(): void
    {
        $ref = new MetaReference(MetaReferenceType::METHOD, '\\PDO::query', 'test.php', 10, MetaReferenceRole::CALLABLE);
        $entityId = $ref->toEntityId();
        $this->assertSame('method|\\PDO::query', $entityId);

        [$type, $fqn] = MetaReference::parseEntityId($entityId);
        $this->assertSame(MetaReferenceType::METHOD, $type);
        $this->assertSame('\\PDO::query', $fqn);
    }

    // --- Helper methods ---

    /**
     * @param MetaReference[] $refs
     */
    private function assertContainsRef(MetaReferenceType $type, string $fqn, array $refs): void
    {
        foreach ($refs as $ref) {
            if ($ref->type === $type && $ref->fqn === $fqn) {
                $this->addToAssertionCount(1);
                return;
            }
        }
        $actual = array_map(fn (MetaReference $r) => $r->type->value . ':' . $r->fqn, $refs);
        $this->fail("Expected {$type->value}:{$fqn} not found in refs: " . implode(', ', $actual));
    }

    /**
     * @param MetaReference[] $refs
     */
    private function assertNotContainsRefType(MetaReferenceType $type, array $refs): void
    {
        foreach ($refs as $ref) {
            if ($ref->type === $type) {
                $this->fail("Expected no refs of type {$type->value}, found: {$ref->fqn}");
            }
        }
        $this->addToAssertionCount(1);
    }

    /**
     * @param MetaReference[] $refs
     */
    private function findRef(MetaReferenceType $type, string $fqn, array $refs): ?MetaReference
    {
        foreach ($refs as $ref) {
            if ($ref->type === $type && $ref->fqn === $fqn) {
                return $ref;
            }
        }
        return null;
    }

    /**
     * @return MetaReference[]
     */
    private function extractFromCode(string $code): array
    {
        $file = $this->writeTempFile($code);
        return $this->extractor->extractFromFile($file);
    }

    private function writeTempFile(string $code): string
    {
        $dir = sys_get_temp_dir() . '/meta_extractor_test_' . getmypid();
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $file = $dir . '/.phpstorm.meta.php';
        file_put_contents($file, $code);
        return $file;
    }

    protected function tearDown(): void
    {
        $dir = sys_get_temp_dir() . '/meta_extractor_test_' . getmypid();
        if (is_dir($dir)) {
            $files = array_diff(scandir($dir), ['.', '..']);
            foreach ($files as $file) {
                unlink($dir . '/' . $file);
            }
            rmdir($dir);
        }
    }
}
