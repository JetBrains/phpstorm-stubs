<?php

namespace StubTests\Unit\Validator\Services;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Validator\Services\PhpDocConformanceService;

class PhpDocConformanceServiceTest extends TestCase
{
    private PhpDocConformanceService $service;

    protected function setUp(): void
    {
        $this->service = new PhpDocConformanceService();
    }

    // ── isPhpDocCompatibleWithSignature: exact match ──────────────

    public function testExactMatchIsCompatible(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('string', 'string'));
    }

    public function testExactUnionMatchIsCompatible(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('int|string', 'int|string'));
    }

    public function testReorderedUnionIsCompatible(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('string|false', 'false|string'));
    }

    // ── mixed ─────────────────────────────────────────────────────

    public function testMixedSigIsCompatibleWithAnyDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('mixed', 'string'));
    }

    public function testMixedDocIsCompatibleWithAnySig(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('int', 'mixed'));
    }

    // ── object compatibility ──────────────────────────────────────

    public function testObjectSigWithClassDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('object', 'SomeClass'));
    }

    public function testClassSigWithObjectDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('SomeClass', 'object'));
    }

    public function testObjectSigWithObjectDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('object', 'object'));
    }

    // ── resource→class migration ──────────────────────────────────

    public function testResourceDocWithClassSig(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('GMP', 'resource|GMP'));
    }

    public function testResourceSigWithClassDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('resource', 'OpenSSLCertificate'));
    }

    // ── bool/false expansion ──────────────────────────────────────

    public function testBoolSigWithFalseDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('bool', 'false'));
    }

    public function testFalseSigWithBoolDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('false', 'bool'));
    }

    public function testBoolSigWithTrueDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('bool', 'true'));
    }

    // ── static ↔ class name ───────────────────────────────────────

    public function testStaticDocWithClassSig(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('DateTime', 'static'));
    }

    public function testStaticSigWithClassDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('static', 'DateTime'));
    }

    // ── class-to-class narrowing ──────────────────────────────────

    public function testClassToClassNarrowing(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('Iterator', 'ArrayIterator'));
    }

    // ── short name alias ──────────────────────────────────────────

    public function testFqnSigWithShortNameDoc(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('Some\\Namespace\\MyClass', 'MyClass'));
    }

    // ── @template variables ───────────────────────────────────────

    public function testTemplateVariableIsCompatible(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('SplFileInfo', 'T', ['T']));
    }

    public function testTemplateVariableWithBackslashPrefix(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('SplFileInfo', '\\T', ['T']));
    }

    public function testNonTemplateVariableIsNotCompatible(): void
    {
        $this->assertFalse($this->service->isPhpDocCompatibleWithSignature('string', 'T', []));
    }

    // ── phpstan generics stripping ────────────────────────────────

    public function testGenericArrayDocIsCompatible(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('array', 'array<string, int>'));
    }

    public function testTypedArrayDocIsCompatible(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('array', 'string[]'));
    }

    public function testClassStringStrippedToString(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('string', 'class-string'));
    }

    public function testListStrippedToArray(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('array', 'list'));
    }

    // ── callable stripping ────────────────────────────────────────

    public function testCallableWithSignatureStrippedToCallable(): void
    {
        $this->assertTrue($this->service->isPhpDocCompatibleWithSignature('callable', 'callable(string): bool'));
    }

    // ── genuine mismatches ────────────────────────────────────────

    public function testMismatchStringVsInt(): void
    {
        $this->assertFalse($this->service->isPhpDocCompatibleWithSignature('string', 'int'));
    }

    public function testMismatchArrayVsString(): void
    {
        $this->assertFalse($this->service->isPhpDocCompatibleWithSignature('array', 'string'));
    }

    public function testMismatchVoidVsString(): void
    {
        $this->assertFalse($this->service->isPhpDocCompatibleWithSignature('void', 'string'));
    }

    // ── extractTemplateNames ──────────────────────────────────────

    public function testExtractTemplateNamesFromNull(): void
    {
        $this->assertSame([], $this->service->extractTemplateNames(null));
    }

    public function testExtractTemplateNamesFromEmpty(): void
    {
        $this->assertSame([], $this->service->extractTemplateNames(''));
    }

    public function testExtractTemplateNames(): void
    {
        $phpDoc = <<<'DOC'
/**
 * @template T
 * @template U
 */
DOC;
        $this->assertSame(['T', 'U'], $this->service->extractTemplateNames($phpDoc));
    }

    public function testExtractTemplateNamesFromInvalidDoc(): void
    {
        $this->assertSame([], $this->service->extractTemplateNames('not a valid docblock'));
    }

    // ── normalizeDocType ──────────────────────────────────────────

    public function testNormalizeDocTypeStripsGenerics(): void
    {
        $this->assertSame('array', $this->service->normalizeDocType('array<string, int>'));
    }

    public function testNormalizeDocTypeSortsUnion(): void
    {
        $this->assertSame('int|string', $this->service->normalizeDocType('string|int'));
    }

    public function testNormalizeDocTypeHandlesNullableShorthand(): void
    {
        $this->assertSame('null|string', $this->service->normalizeDocType('?string'));
    }

    // ── splitUnionComponents ──────────────────────────────────────

    public function testSplitSingleType(): void
    {
        $this->assertSame(['string'], $this->service->splitUnionComponents('string'));
    }

    public function testSplitUnionType(): void
    {
        $this->assertSame(['string', 'int'], $this->service->splitUnionComponents('string|int'));
    }

    // ── getParamSigTypeForPhpDoc ──────────────────────────────────

    public function testGetParamSigTypeFromDeclaredType(): void
    {
        $param = new PHPParameter('test');
        $param->setType(new StandaloneType('string'));
        $this->assertSame('string', $this->service->getParamSigTypeForPhpDoc($param, '8.0'));
    }

    public function testGetParamSigTypeFromVersionAware(): void
    {
        $param = new PHPParameter('test');
        $param->initStubsMetadata()->setLanguageLevelTypes(['8.0' => 'string']);
        $this->assertSame('string', $this->service->getParamSigTypeForPhpDoc($param, '8.0'));
    }

    public function testGetParamSigTypeReturnsNullWhenNoType(): void
    {
        $param = new PHPParameter('test');
        $this->assertNull($this->service->getParamSigTypeForPhpDoc($param, '8.0'));
    }

    // ── getPropertySigTypeForPhpDoc ───────────────────────────────

    public function testGetPropertySigTypeFromDeclaredType(): void
    {
        $prop = new PHPProperty();
        $prop->setTypeFromSignature(new StandaloneType('int'));
        $this->assertSame('int', $this->service->getPropertySigTypeForPhpDoc($prop, '8.0'));
    }

    public function testGetPropertySigTypeReturnsNullWhenNoType(): void
    {
        $prop = new PHPProperty();
        $this->assertNull($this->service->getPropertySigTypeForPhpDoc($prop, '8.0'));
    }
}
