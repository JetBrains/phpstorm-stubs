<?php

namespace StubTests\Unit\Validator;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;

class KnownProblemsRegistryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Reset singleton between tests
        KnownProblemsRegistry::reset();
    }

    protected function tearDown(): void
    {
        // Reset singleton after tests
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    public function testSingletonInstance(): void
    {
        $instance1 = KnownProblemsRegistry::getInstance();
        $instance2 = KnownProblemsRegistry::getInstance();

        $this->assertSame($instance1, $instance2);
    }

    public function testGetAllProblems(): void
    {
        $registry = KnownProblemsRegistry::getInstance();
        $problems = $registry->getAllProblems();

        $this->assertIsArray($problems);
        $this->assertNotEmpty($problems);
        $this->assertContainsOnlyInstancesOf(
			\StubTests\Framework\Validator\KnownProblems\ProblemDefinition::class,
	        $problems
        );
    }

    public function testHasProblemForOverloadedFunction(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // dba_fetch should have known problem for ParameterNamesCheck in PHP 8.0
        $hasProblem = $registry->hasProblem(
            'functions',
            '\\dba_fetch',
            'ParameterNamesCheck',
            '8.0'
        );

        $this->assertTrue($hasProblem);
    }

    public function testNoProblemForUnaffectedCheck(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // dba_fetch should NOT have problem for ReturnTypesCheck
        $hasProblem = $registry->hasProblem(
            'functions',
            '\\dba_fetch',
            'ReturnTypesCheck',
            '8.0'
        );

        $this->assertFalse($hasProblem);
    }

    public function testNoProblemForNonExistentFunction(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        $hasProblem = $registry->hasProblem(
            'functions',
            '\\non_existent_function',
            'ParameterNamesCheck',
            '8.0'
        );

        $this->assertFalse($hasProblem);
    }

    public function testShouldSkipValidation(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        $shouldSkip = $registry->shouldSkipValidation(
            'functions',
            '\\dba_fetch',
            'ParameterNamesCheck',
            '8.0'
        );

        $this->assertTrue($shouldSkip);
    }

    public function testGetSkipReason(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        $reason = $registry->getSkipReason(
            'functions',
            '\\dba_fetch',
            'ParameterNamesCheck',
            '8.0'
        );

        $this->assertNotNull($reason);
        $this->assertStringContainsString('overload', strtolower($reason));
    }

    public function testVersionRangeFiltering(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // Test version within range
        $hasProblemInRange = $registry->hasProblem(
            'functions',
            '\\dba_fetch',
            'ParameterNamesCheck',
            '8.0'
        );
        $this->assertTrue($hasProblemInRange, 'PHP 8.0 should be within affected range');

        // Test version at upper boundary
        $hasProblemAtBoundary = $registry->hasProblem(
            'functions',
            '\\dba_fetch',
            'ParameterNamesCheck',
            '8.4'
        );
        $this->assertTrue($hasProblemAtBoundary, 'PHP 8.4 should be within affected range');
    }

    public function testMultipleAffectedChecks(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // dba_fetch affects both ParameterNamesCheck and ParameterTypesCheck
        $hasNamesProblem = $registry->hasProblem(
            'functions',
            '\\dba_fetch',
            'ParameterNamesCheck',
            '8.0'
        );

        $hasTypesProblem = $registry->hasProblem(
            'functions',
            '\\dba_fetch',
            'ParameterTypesCheck',
            '8.0'
        );

        $this->assertTrue($hasNamesProblem);
        $this->assertTrue($hasTypesProblem);
    }

    public function testResetClearsSingleton(): void
    {
        $instance1 = KnownProblemsRegistry::getInstance();

        KnownProblemsRegistry::reset();

        $instance2 = KnownProblemsRegistry::getInstance();

        $this->assertNotSame($instance1, $instance2);
    }

    public function testProblemsIndex(): void
    {
        $registry = KnownProblemsRegistry::getInstance();
        $index = $registry->getProblemsIndex();

        $this->assertIsArray($index);
        $this->assertArrayHasKey('functions', $index);
        $this->assertArrayHasKey('\\dba_fetch', $index['functions']);
    }

    public function testAllKnownProblemsAreAccessible(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // Test a few known overloaded functions
        $knownFunctions = [
            '\\dba_fetch',
            '\\dba_open',
            '\\strtr',
            '\\setcookie',
            '\\session_set_save_handler',
        ];

        foreach ($knownFunctions as $function) {
            $hasProblem = $registry->hasProblem(
                'functions',
                $function,
                'ParameterNamesCheck',
                '8.0'
            );
            $this->assertTrue(
                $hasProblem,
                "Expected {$function} to have a known problem"
            );
        }
    }

    // ── CLASS_INTERFACES check ────────────────────────────────────────────────

    public function testHasProblemForClassInterfacesCheck(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // SimpleXMLElement implements ArrayAccess at C level (visible in no PHP version via reflection)
        $this->assertTrue(
            $registry->hasProblem('classes', '\SimpleXMLElement', 'ClassInterfacesCheck', '8.0')
        );
    }

    public function testSimpleXmlElementSkippedAcrossAllVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        foreach (['5.6', '7.0', '7.4', '8.0', '8.4'] as $version) {
            $this->assertTrue(
                $registry->hasProblem('classes', '\SimpleXMLElement', 'ClassInterfacesCheck', $version),
                "SimpleXMLElement should skip ClassInterfacesCheck for PHP {$version}"
            );
        }
    }

    public function testSplObjectStorageSkippedForLegacyVersionsNotPhp84(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // SeekableIterator was added in PHP 8.4 — problem applies to 5.6–8.3
        foreach (['5.6', '7.0', '8.0', '8.3'] as $version) {
            $this->assertTrue(
                $registry->hasProblem('classes', '\SplObjectStorage', 'ClassInterfacesCheck', $version),
                "SplObjectStorage should skip ClassInterfacesCheck for PHP {$version}"
            );
        }

        $this->assertFalse(
            $registry->hasProblem('classes', '\SplObjectStorage', 'ClassInterfacesCheck', '8.4'),
            'SplObjectStorage should NOT skip ClassInterfacesCheck for PHP 8.4 (SeekableIterator is present)'
        );
    }

    public function testSplFileInfoSkippedForLegacyVersionsNotPhp80(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // Stringable was added in PHP 8.0 — problem applies to 5.6–7.4
        foreach (['5.6', '7.0', '7.4'] as $version) {
            $this->assertTrue(
                $registry->hasProblem('classes', '\SplFileInfo', 'ClassInterfacesCheck', $version),
                "SplFileInfo should skip ClassInterfacesCheck for PHP {$version}"
            );
        }

        foreach (['8.0', '8.1', '8.4'] as $version) {
            $this->assertFalse(
                $registry->hasProblem('classes', '\SplFileInfo', 'ClassInterfacesCheck', $version),
                "SplFileInfo should NOT skip ClassInterfacesCheck for PHP {$version}"
            );
        }
    }

    public function testGetSkipReasonForClassProblemContainsDescription(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        $reason = $registry->getSkipReason('classes', '\SimpleXMLElement', 'ClassInterfacesCheck', '8.0');

        $this->assertNotNull($reason);
        $this->assertStringContainsString('ArrayAccess', $reason);
    }

    public function testUnknownCheckNameReturnsFalse(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // Non-existent check name hits the default branch of stringToCheckType → null → false
        $this->assertFalse(
            $registry->hasProblem('functions', '\dba_fetch', 'NonExistentCheck', '8.0')
        );
    }

    public function testProblemsIndexContainsClassesKey(): void
    {
        $registry = KnownProblemsRegistry::getInstance();
        $index = $registry->getProblemsIndex();

        $this->assertArrayHasKey('classes', $index);
        $this->assertArrayHasKey('\SimpleXMLElement', $index['classes']);
    }

    // ── CLASS_METHODS_EXIST check ─────────────────────────────────────────────

    public function testClassMethodsExistCheckNameMapsCorrectly(): void
    {
        // Register a custom known problem for CheckType::CLASS_METHODS_EXIST and verify
        // that querying with the string 'ClassMethodsExistCheck' correctly resolves it.
        // This tests the 'ClassMethodsExistCheck' → CheckType::CLASS_METHODS_EXIST branch
        // of KnownProblemsRegistry::stringToCheckType().
        $provider = $this->createMock(KnownProblemsProvider::class);
        $provider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\SomeSpecialClass',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_METHODS_EXIST],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::LATEST),
                reason: 'Test CLASS_METHODS_EXIST mapping'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($provider);

        // Version within range → problem found
        $this->assertTrue(
            $registry->hasProblem('classes', '\SomeSpecialClass', 'ClassMethodsExistCheck', '8.0'),
            "'ClassMethodsExistCheck' should map to CheckType::CLASS_METHODS_EXIST"
        );

        // Version outside range → problem not found
        $this->assertFalse(
            $registry->hasProblem('classes', '\SomeSpecialClass', 'ClassMethodsExistCheck', '7.4'),
            "Version outside registered range should return false"
        );
    }

    // ── CLASS_FINAL_METHODS check ─────────────────────────────────────────────

    public function testClassFinalMethodsCheckNameMapsCorrectly(): void
    {
        // Verifies the 'ClassFinalMethodsCheck' → CheckType::CLASS_FINAL_METHODS branch
        // of KnownProblemsRegistry::stringToCheckType().
        $provider = $this->createMock(KnownProblemsProvider::class);
        $provider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: '\SomeClass::doWork',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::CLASS_FINAL_METHODS],
                versionRange: new PhpVersionRange(PhpVersions::PHP_8_0, PhpVersions::LATEST),
                reason: 'Test CLASS_FINAL_METHODS mapping'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($provider);

        // Version within range → problem found
        $this->assertTrue(
            $registry->hasProblem('methods', '\SomeClass::doWork', 'ClassFinalMethodsCheck', '8.0'),
            "'ClassFinalMethodsCheck' should map to CheckType::CLASS_FINAL_METHODS"
        );

        // Version outside range → problem not found
        $this->assertFalse(
            $registry->hasProblem('methods', '\SomeClass::doWork', 'ClassFinalMethodsCheck', '7.4'),
            "Version outside registered range should return false"
        );

        // Different check name → no problem (string unmapped)
        $this->assertFalse(
            $registry->hasProblem('methods', '\SomeClass::doWork', 'ClassMethodsExistCheck', '8.0'),
            "A different check name should not match the CLASS_FINAL_METHODS problem"
        );
    }

    // ── SimpleXMLElement::__construct final/non-final version boundary ────────

    public function testSimpleXmlConstructorSkippedForLegacyVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // PHP 5.6–7.4: reflection reports __construct as final; stub is non-final → known problem
        foreach (['5.6', '7.0', '7.1', '7.2', '7.3', '7.4'] as $version) {
            $this->assertTrue(
                $registry->hasProblem('methods', '\SimpleXMLElement::__construct', 'ClassFinalMethodsCheck', $version),
                "SimpleXMLElement::__construct should be a known problem for ClassFinalMethodsCheck on PHP {$version}"
            );
        }
    }

    public function testSimpleXmlConstructorNotSkippedForModernVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // PHP 8.0+: reflection also reports __construct as non-final → no mismatch, no skip needed
        foreach (['8.0', '8.1', '8.2', '8.3', '8.4'] as $version) {
            $this->assertFalse(
                $registry->hasProblem('methods', '\SimpleXMLElement::__construct', 'ClassFinalMethodsCheck', $version),
                "SimpleXMLElement::__construct should NOT be a known problem for ClassFinalMethodsCheck on PHP {$version}"
            );
        }
    }

    public function testSimpleXmlConstructorSkipReasonMentionsFinalAndVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        $reason = $registry->getSkipReason('methods', '\SimpleXMLElement::__construct', 'ClassFinalMethodsCheck', '7.4');

        $this->assertNotNull($reason);
        $this->assertStringContainsString('final', strtolower($reason));
        $this->assertStringContainsString('8.0', $reason);
    }

    public function testSimpleXmlConstructorUnaffectedByOtherChecks(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // The known problem is specific to ClassFinalMethodsCheck; other checks are unaffected
        foreach (['ClassMethodsExistCheck', 'ClassExistsCheck', 'ParameterNamesCheck'] as $check) {
            $this->assertFalse(
                $registry->hasProblem('methods', '\SimpleXMLElement::__construct', $check, '7.4'),
                "SimpleXMLElement::__construct should not affect {$check}"
            );
        }
    }

    public function testSimpleXmlConstructorProblemIsMethodEntityType(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // The entry must be indexed under 'methods', not 'classes' or 'functions'
        $this->assertTrue(
            $registry->hasProblem('methods', '\SimpleXMLElement::__construct', 'ClassFinalMethodsCheck', '7.0')
        );
        $this->assertFalse(
            $registry->hasProblem('classes', '\SimpleXMLElement::__construct', 'ClassFinalMethodsCheck', '7.0')
        );
        $this->assertFalse(
            $registry->hasProblem('functions', '\SimpleXMLElement::__construct', 'ClassFinalMethodsCheck', '7.0')
        );
    }

    public function testSimpleXmlConstructorBoundaryVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // 7.4 is the last affected version (inclusive upper bound)
        $this->assertTrue(
            $registry->hasProblem('methods', '\SimpleXMLElement::__construct', 'ClassFinalMethodsCheck', '7.4'),
            'PHP 7.4 is within the affected range (inclusive)'
        );

        // 8.0 is the first unaffected version
        $this->assertFalse(
            $registry->hasProblem('methods', '\SimpleXMLElement::__construct', 'ClassFinalMethodsCheck', '8.0'),
            'PHP 8.0 is outside the affected range'
        );
    }

    // ── SimpleXMLIterator::__construct (inherited final from SimpleXMLElement) ─

    public function testSimpleXmlIteratorConstructorSkippedForLegacyVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        foreach (['5.6', '7.0', '7.1', '7.2', '7.3', '7.4'] as $version) {
            $this->assertTrue(
                $registry->hasProblem('methods', '\SimpleXMLIterator::__construct', 'ClassFinalMethodsCheck', $version),
                "SimpleXMLIterator::__construct should be a known problem for ClassFinalMethodsCheck on PHP {$version}"
            );
        }
    }

    public function testSimpleXmlIteratorConstructorNotSkippedForModernVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        foreach (['8.0', '8.1', '8.2', '8.3', '8.4'] as $version) {
            $this->assertFalse(
                $registry->hasProblem('methods', '\SimpleXMLIterator::__construct', 'ClassFinalMethodsCheck', $version),
                "SimpleXMLIterator::__construct should NOT be a known problem for ClassFinalMethodsCheck on PHP {$version}"
            );
        }
    }

    public function testSimpleXmlIteratorConstructorSkipReasonMentionsInheritanceAndVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        $reason = $registry->getSkipReason('methods', '\SimpleXMLIterator::__construct', 'ClassFinalMethodsCheck', '7.0');

        $this->assertNotNull($reason);
        $this->assertStringContainsString('SimpleXMLElement', $reason);
        $this->assertStringContainsString('8.0', $reason);
    }

    public function testSimpleXmlIteratorConstructorBoundaryVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        $this->assertTrue(
            $registry->hasProblem('methods', '\SimpleXMLIterator::__construct', 'ClassFinalMethodsCheck', '7.4'),
            'PHP 7.4 is within the affected range (inclusive)'
        );
        $this->assertFalse(
            $registry->hasProblem('methods', '\SimpleXMLIterator::__construct', 'ClassFinalMethodsCheck', '8.0'),
            'PHP 8.0 is outside the affected range'
        );
    }

    public function testSimpleXmlIteratorAndElementHaveIndependentEntries(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // Both entries must exist independently — the iterator entry must not
        // accidentally suppress checks on the element and vice-versa.
        $this->assertTrue(
            $registry->hasProblem('methods', '\SimpleXMLElement::__construct', 'ClassFinalMethodsCheck', '7.4')
        );
        $this->assertTrue(
            $registry->hasProblem('methods', '\SimpleXMLIterator::__construct', 'ClassFinalMethodsCheck', '7.4')
        );
    }

    // ── XMLReader::open static/non-static version boundary ───────────────────

    public function testXmlReaderOpenSkippedForLegacyVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // PHP 5.6–7.4: reflection reports open() as non-static; stub is static → known problem
        foreach (['5.6', '7.0', '7.1', '7.2', '7.3', '7.4'] as $version) {
            $this->assertTrue(
                $registry->hasProblem('methods', '\XMLReader::open', 'ClassStaticMethodsCheck', $version),
                "XMLReader::open should be a known problem for ClassStaticMethodsCheck on PHP {$version}"
            );
        }
    }

    public function testXmlReaderOpenNotSkippedForModernVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // PHP 8.0+: open() is officially static → no mismatch, no skip needed
        foreach (['8.0', '8.1', '8.2', '8.3', '8.4'] as $version) {
            $this->assertFalse(
                $registry->hasProblem('methods', '\XMLReader::open', 'ClassStaticMethodsCheck', $version),
                "XMLReader::open should NOT be a known problem for ClassStaticMethodsCheck on PHP {$version}"
            );
        }
    }

    public function testXmlReaderOpenBoundaryVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // 7.4 is the last affected version (inclusive upper bound)
        $this->assertTrue(
            $registry->hasProblem('methods', '\XMLReader::open', 'ClassStaticMethodsCheck', '7.4'),
            'PHP 7.4 is within the affected range (inclusive)'
        );

        // 8.0 is the first unaffected version
        $this->assertFalse(
            $registry->hasProblem('methods', '\XMLReader::open', 'ClassStaticMethodsCheck', '8.0'),
            'PHP 8.0 is outside the affected range'
        );
    }

    public function testXmlReaderOpenSkipReasonMentionsStaticAndVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        $reason = $registry->getSkipReason('methods', '\XMLReader::open', 'ClassStaticMethodsCheck', '7.4');

        $this->assertNotNull($reason);
        $this->assertStringContainsString('static', strtolower($reason));
        $this->assertStringContainsString('8.0', $reason);
    }

    public function testXmlReaderOpenUnaffectedByOtherChecks(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // The known problem is specific to ClassStaticMethodsCheck; other checks are unaffected
        foreach (['ClassFinalMethodsCheck', 'ClassMethodsExistCheck', 'ParameterNamesCheck'] as $check) {
            $this->assertFalse(
                $registry->hasProblem('methods', '\XMLReader::open', $check, '7.4'),
                "XMLReader::open should not affect {$check}"
            );
        }
    }

    public function testXmlReaderOpenIsMethodEntityType(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // The entry must be indexed under 'methods', not 'classes' or 'functions'
        $this->assertTrue(
            $registry->hasProblem('methods', '\XMLReader::open', 'ClassStaticMethodsCheck', '7.0')
        );
        $this->assertFalse(
            $registry->hasProblem('classes', '\XMLReader::open', 'ClassStaticMethodsCheck', '7.0')
        );
        $this->assertFalse(
            $registry->hasProblem('functions', '\XMLReader::open', 'ClassStaticMethodsCheck', '7.0')
        );
    }

    // ── XMLReader::XML static/non-static version boundary ────────────────────

    public function testXmlReaderXmlMethodSkippedForLegacyVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // PHP 5.6–7.4: reflection reports XML() as non-static; stub is static → known problem
        foreach (['5.6', '7.0', '7.1', '7.2', '7.3', '7.4'] as $version) {
            $this->assertTrue(
                $registry->hasProblem('methods', '\XMLReader::XML', 'ClassStaticMethodsCheck', $version),
                "XMLReader::XML should be a known problem for ClassStaticMethodsCheck on PHP {$version}"
            );
        }
    }

    public function testXmlReaderXmlMethodNotSkippedForModernVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // PHP 8.0+: XML() is officially static → no mismatch, no skip needed
        foreach (['8.0', '8.1', '8.2', '8.3', '8.4'] as $version) {
            $this->assertFalse(
                $registry->hasProblem('methods', '\XMLReader::XML', 'ClassStaticMethodsCheck', $version),
                "XMLReader::XML should NOT be a known problem for ClassStaticMethodsCheck on PHP {$version}"
            );
        }
    }

    public function testXmlReaderXmlMethodBoundaryVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // 7.4 is the last affected version (inclusive upper bound)
        $this->assertTrue(
            $registry->hasProblem('methods', '\XMLReader::XML', 'ClassStaticMethodsCheck', '7.4'),
            'PHP 7.4 is within the affected range (inclusive)'
        );

        // 8.0 is the first unaffected version
        $this->assertFalse(
            $registry->hasProblem('methods', '\XMLReader::XML', 'ClassStaticMethodsCheck', '8.0'),
            'PHP 8.0 is outside the affected range'
        );
    }

    public function testXmlReaderXmlMethodSkipReasonMentionsStaticAndVersions(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        $reason = $registry->getSkipReason('methods', '\XMLReader::XML', 'ClassStaticMethodsCheck', '7.4');

        $this->assertNotNull($reason);
        $this->assertStringContainsString('static', strtolower($reason));
        $this->assertStringContainsString('8.0', $reason);
    }

    public function testXmlReaderXmlMethodUnaffectedByOtherChecks(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // The known problem is specific to ClassStaticMethodsCheck; other checks are unaffected
        foreach (['ClassFinalMethodsCheck', 'ClassMethodsExistCheck', 'ParameterNamesCheck'] as $check) {
            $this->assertFalse(
                $registry->hasProblem('methods', '\XMLReader::XML', $check, '7.4'),
                "XMLReader::XML should not affect {$check}"
            );
        }
    }

    public function testXmlReaderXmlMethodIsMethodEntityType(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // The entry must be indexed under 'methods', not 'classes' or 'functions'
        $this->assertTrue(
            $registry->hasProblem('methods', '\XMLReader::XML', 'ClassStaticMethodsCheck', '7.0')
        );
        $this->assertFalse(
            $registry->hasProblem('classes', '\XMLReader::XML', 'ClassStaticMethodsCheck', '7.0')
        );
        $this->assertFalse(
            $registry->hasProblem('functions', '\XMLReader::XML', 'ClassStaticMethodsCheck', '7.0')
        );
    }

    // ── XMLReader::open and ::XML independence ────────────────────────────────

    public function testXmlReaderOpenAndXmlMethodHaveIndependentEntries(): void
    {
        $registry = KnownProblemsRegistry::getInstance();

        // Both entries must exist independently of one another
        $this->assertTrue(
            $registry->hasProblem('methods', '\XMLReader::open', 'ClassStaticMethodsCheck', '7.4')
        );
        $this->assertTrue(
            $registry->hasProblem('methods', '\XMLReader::XML', 'ClassStaticMethodsCheck', '7.4')
        );
    }
}
