<?php

namespace StubTests\Unit\Validator\Contracts;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Contracts\LookupKind;
use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\Classes\ClassFinalCheck;
use StubTests\Framework\Validator\KnownProblems\EntityType;

class EntityTypeConfigTest extends TestCase
{
    public function testForClassMapsCorrectly(): void
    {
        $config = EntityTypeConfig::forClass();
        $this->assertSame(LookupKind::CLASS_TYPE, $config->lookupKind);
        $this->assertSame(EntityType::CLASS_TYPE, $config->entityType);
        $this->assertSame('Class', $config->label);
        $this->assertSame(EntityType::CLASS_CONSTANT, $config->constantEntityType);
    }

    public function testForEnumMapsCorrectly(): void
    {
        $config = EntityTypeConfig::forEnum();
        $this->assertSame(LookupKind::ENUM_TYPE, $config->lookupKind);
        $this->assertSame(EntityType::ENUM_TYPE, $config->entityType);
        $this->assertSame('Enum', $config->label);
        $this->assertSame(EntityType::ENUM_CONSTANT, $config->constantEntityType);
    }

    public function testForInterfaceMapsCorrectly(): void
    {
        $config = EntityTypeConfig::forInterface();
        $this->assertSame(LookupKind::INTERFACE_TYPE, $config->lookupKind);
        $this->assertSame(EntityType::INTERFACE_TYPE, $config->entityType);
        $this->assertSame('Interface', $config->label);
        $this->assertSame(EntityType::INTERFACE_CONSTANT, $config->constantEntityType);
    }

    public function testCustomConfigWithNullConstantEntityType(): void
    {
        $config = new EntityTypeConfig(
            lookupKind: LookupKind::CLASS_TYPE,
            entityType: EntityType::CLASS_TYPE,
            label: 'Custom',
        );
        $this->assertNull($config->constantEntityType);
    }

    /**
     * A class-like check configured with forFunction() used to die on an UnhandledMatchError
     * from a match with no FUNCTION arm, which named neither the check nor the cause.
     * The match arms now throw a LogicException that says what to do instead.
     *
     * Function checks belong on AbstractReflectionCheck (see EntityExistsCheck), which
     * handles all four lookup kinds.
     */
    public function testClassLikeCheckRejectsFunctionLookupKindWithADiagnostic(): void
    {
        $check = new ClassFinalCheck(entityTypeConfig: EntityTypeConfig::forFunction());
        $lookup = new \ReflectionMethod($check, 'lookupEntityById');

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessageMatches('/LookupKind::FUNCTION/');
        $lookup->invoke($check, $this->createStub(StubDataQueryInterface::class), '\\foo');
    }

    /**
     * forFunction() leaves constantEntityType null, and getConstantEntityType() must then
     * yield the CLASS_CONSTANT default.
     *
     * Note this held before the nullsafe was added too: `$c?->constantEntityType->value ?? X`
     * sits inside ??, which suppresses property-access diagnostics on its left operand, so
     * no warning was ever emitted. The extra ?- is readability only. This test pins the
     * fallback contract, which had no coverage.
     */
    public function testGetConstantEntityTypeFallsBackWhenConstantEntityTypeIsNull(): void
    {
        $check = new ClassFinalCheck(entityTypeConfig: EntityTypeConfig::forFunction());
        $getter = new \ReflectionMethod($check, 'getConstantEntityType');

        $this->assertSame(EntityType::CLASS_CONSTANT->value, $getter->invoke($check));
    }
}
