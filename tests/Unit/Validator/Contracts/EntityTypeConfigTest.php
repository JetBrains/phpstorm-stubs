<?php

namespace StubTests\Unit\Validator\Contracts;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Contracts\LookupKind;
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
}
