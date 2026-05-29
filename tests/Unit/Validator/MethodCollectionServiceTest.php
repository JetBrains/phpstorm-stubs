<?php

namespace StubTests\Unit\Validator;

use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Services\MethodCollectionService;

class MethodCollectionServiceTest extends CheckTestCase
{
    private MethodCollectionService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new MethodCollectionService();
    }

    // ── Helpers ──────────────────────────────────────────────────────────────

    private function makeProperty(
        string $name,
        ?string $sinceVersion = null,
        ?string $removedVersion = null
    ): PHPProperty {
        $prop = new PHPProperty();
        $prop->setName($name);
        if ($sinceVersion !== null || $removedVersion !== null) {
            $prop->initStubsMetadata()->setSinceVersion($sinceVersion);
            $prop->initStubsMetadata()->setRemovedVersion($removedVersion);
        }
        return $prop;
    }

    // ── collectForClass: basic ───────────────────────────────────────────────

    public function testCollectsMethodsFromClassItself(): void
    {
        $method = $this->makeMethod('format');
        $class  = $this->makeClass('\\DateTime', [$method]);

        $result = $this->service->collectForClass($class, PhpVersions::LATEST->value);

        $this->assertArrayHasKey('format', $result);
        $this->assertSame($method, $result['format']);
    }

    public function testCollectsMultipleMethodsFromClass(): void
    {
        $m1    = $this->makeMethod('getTimestamp');
        $m2    = $this->makeMethod('format');
        $class = $this->makeClass('\\DateTime', [$m1, $m2]);

        $result = $this->service->collectForClass($class, PhpVersions::LATEST->value);

        $this->assertCount(2, $result);
        $this->assertArrayHasKey('getTimestamp', $result);
        $this->assertArrayHasKey('format', $result);
    }

    // ── collectForClass: child wins over parent ──────────────────────────────

    public function testChildDefinitionWinsOverParentForSameMethodName(): void
    {
        $parentMethod = $this->makeMethod('format');
        $childMethod  = $this->makeMethod('format');
        $parent = $this->makeClass('\\DateTimeBase', [$parentMethod]);
        $child  = $this->makeClass('\\DateTime', [$childMethod], parentClass: $parent);

        $result = $this->service->collectForClass($child, PhpVersions::LATEST->value);

        $this->assertArrayHasKey('format', $result);
        $this->assertSame($childMethod, $result['format']);
        $this->assertNotSame($parentMethod, $result['format']);
    }

    public function testParentMethodIncludedWhenChildDoesNotOverride(): void
    {
        $parentMethod = $this->makeMethod('parentOnly');
        $childMethod  = $this->makeMethod('childOnly');
        $parent = $this->makeClass('\\Base', [$parentMethod]);
        $child  = $this->makeClass('\\Derived', [$childMethod], parentClass: $parent);

        $result = $this->service->collectForClass($child, PhpVersions::LATEST->value);

        $this->assertCount(2, $result);
        $this->assertArrayHasKey('childOnly', $result);
        $this->assertArrayHasKey('parentOnly', $result);
    }

    // ── collectForClass: cycle detection ─────────────────────────────────────

    public function testCycleDetectionStopsInfiniteTraversal(): void
    {
        $classA = $this->makeClass('\\A', [$this->makeMethod('methodA')]);
        $classB = $this->makeClass('\\B', [$this->makeMethod('methodB')]);

        // Create cycle: A -> B -> A
        $classA->setParentClass($classB);
        $classB->setParentClass($classA);

        $result = $this->service->collectForClass($classA, PhpVersions::LATEST->value);

        // Should collect methods from both without infinite loop
        $this->assertArrayHasKey('methodA', $result);
        $this->assertArrayHasKey('methodB', $result);
    }

    // ── collectForClass: PS_UNRESERVE_PREFIX_ stripping ──────────────────────

    public function testPsUnreservePrefixIsStrippedFromMethodName(): void
    {
        $method = $this->makeMethod('PS_UNRESERVE_PREFIX_throw');
        $class  = $this->makeClass('\\Generator', [$method]);

        $result = $this->service->collectForClass($class, PhpVersions::LATEST->value);

        $this->assertArrayHasKey('throw', $result);
        $this->assertArrayNotHasKey('PS_UNRESERVE_PREFIX_throw', $result);
        $this->assertSame($method, $result['throw']);
    }

    // ── collectForClass: version filtering ───────────────────────────────────

    public function testVersionFilteringRespectsRemoveVersion(): void
    {
        // Method removed in 8.0, so asking for 8.0 should exclude it
        $removedMethod = $this->makeMethod('oldMethod', removedVersion: '8.0');
        $activeMethod  = $this->makeMethod('activeMethod');
        $class = $this->makeClass('\\MyClass', [$removedMethod, $activeMethod]);

        $result = $this->service->collectForClass($class, '8.0');

        $this->assertArrayNotHasKey('oldMethod', $result);
        $this->assertArrayHasKey('activeMethod', $result);
    }

    public function testVersionFilteringRespectsSinceVersion(): void
    {
        // Method available since 8.0, asking for 7.4 should exclude it
        $newMethod = $this->makeMethod('newMethod', sinceVersion: '8.0');
        $class = $this->makeClass('\\MyClass', [$newMethod]);

        $result = $this->service->collectForClass($class, '7.4');

        $this->assertArrayNotHasKey('newMethod', $result);
    }

    public function testVersionFilteringIncludesMethodWhenInRange(): void
    {
        $method = $this->makeMethod('rangeMethod', sinceVersion: '7.0', removedVersion: '9.0');
        $class  = $this->makeClass('\\MyClass', [$method]);

        $result = $this->service->collectForClass($class, '8.0');

        $this->assertArrayHasKey('rangeMethod', $result);
    }

    // ── collectForClass: collects from implemented interfaces ────────────────

    public function testCollectsMethodsFromImplementedInterfaces(): void
    {
        $ifaceMethod = $this->makeMethod('count');
        $iface = $this->makeInterface('\\Countable', [$ifaceMethod]);
        $class = $this->makeClass('\\MyCollection', [], interfaces: [$iface]);

        $result = $this->service->collectForClass($class, PhpVersions::LATEST->value);

        $this->assertArrayHasKey('count', $result);
        $this->assertSame($ifaceMethod, $result['count']);
    }

    public function testClassMethodWinsOverInterfaceMethod(): void
    {
        $ifaceMethod = $this->makeMethod('count');
        $classMethod = $this->makeMethod('count');
        $iface = $this->makeInterface('\\Countable', [$ifaceMethod]);
        $class = $this->makeClass('\\MyCollection', [$classMethod], interfaces: [$iface]);

        $result = $this->service->collectForClass($class, PhpVersions::LATEST->value);

        $this->assertSame($classMethod, $result['count']);
        $this->assertNotSame($ifaceMethod, $result['count']);
    }

    // ── collectForEnum ───────────────────────────────────────────────────────

    public function testCollectForEnumIncludesOwnMethods(): void
    {
        $method = $this->makeMethod('label');
        $enum   = $this->makeEnum('\\Suit', [$method]);

        $result = $this->service->collectForEnum($enum, PhpVersions::LATEST->value);

        $this->assertArrayHasKey('label', $result);
        $this->assertSame($method, $result['label']);
    }

    public function testCollectForEnumIncludesInterfaceMethods(): void
    {
        $ifaceMethod = $this->makeMethod('jsonSerialize');
        $iface = $this->makeInterface('\\JsonSerializable', [$ifaceMethod]);
        $enum  = $this->makeEnum('\\Suit', [], interfaces: [$iface]);

        $result = $this->service->collectForEnum($enum, PhpVersions::LATEST->value);

        $this->assertArrayHasKey('jsonSerialize', $result);
    }

    public function testCollectForEnumOwnMethodWinsOverInterface(): void
    {
        $enumMethod  = $this->makeMethod('jsonSerialize');
        $ifaceMethod = $this->makeMethod('jsonSerialize');
        $iface = $this->makeInterface('\\JsonSerializable', [$ifaceMethod]);
        $enum  = $this->makeEnum('\\Suit', [$enumMethod], interfaces: [$iface]);

        $result = $this->service->collectForEnum($enum, PhpVersions::LATEST->value);

        $this->assertSame($enumMethod, $result['jsonSerialize']);
    }

    // ── collectForInterface ──────────────────────────────────────────────────

    public function testCollectForInterfaceIncludesOwnMethods(): void
    {
        $method = $this->makeMethod('current');
        $iface  = $this->makeInterface('\\Iterator', [$method]);

        $result = $this->service->collectForInterface($iface, PhpVersions::LATEST->value);

        $this->assertArrayHasKey('current', $result);
        $this->assertSame($method, $result['current']);
    }

    public function testCollectForInterfaceTraversesParentChain(): void
    {
        $parentMethod = $this->makeMethod('rewind');
        $childMethod  = $this->makeMethod('current');

        $parentIface = $this->makeInterface('\\Traversable', [$parentMethod]);
        $childIface  = $this->makeInterface('\\Iterator', [$childMethod], parentInterfaces: [$parentIface]);

        $result = $this->service->collectForInterface($childIface, PhpVersions::LATEST->value);

        $this->assertCount(2, $result);
        $this->assertArrayHasKey('current', $result);
        $this->assertArrayHasKey('rewind', $result);
    }

    public function testCollectForInterfaceChildWinsOverParent(): void
    {
        $parentMethod = $this->makeMethod('getIterator');
        $childMethod  = $this->makeMethod('getIterator');

        $parentIface = $this->makeInterface('\\Traversable', [$parentMethod]);
        $childIface  = $this->makeInterface('\\IteratorAggregate', [$childMethod], parentInterfaces: [$parentIface]);

        $result = $this->service->collectForInterface($childIface, PhpVersions::LATEST->value);

        $this->assertSame($childMethod, $result['getIterator']);
    }

    // ── collectPropertiesForClass ────────────────────────────────────────────

    public function testCollectsPropertiesFromClassItself(): void
    {
        $prop  = $this->makeProperty('timezone');
        $class = new PHPClass();
        $class->setId('\\DateTime');
        $class->setName('DateTime');
        $class->setProperties([$prop]);

        $result = $this->service->collectPropertiesForClass($class, PhpVersions::LATEST->value);

        $this->assertArrayHasKey('timezone', $result);
        $this->assertSame($prop, $result['timezone']);
    }

    public function testCollectsPropertiesFromParentChain(): void
    {
        $parentProp = $this->makeProperty('parentProp');
        $childProp  = $this->makeProperty('childProp');

        $parent = new PHPClass();
        $parent->setId('\\Base');
        $parent->setName('Base');
        $parent->setProperties([$parentProp]);

        $child = new PHPClass();
        $child->setId('\\Derived');
        $child->setName('Derived');
        $child->setProperties([$childProp]);
        $child->setParentClass($parent);

        $result = $this->service->collectPropertiesForClass($child, PhpVersions::LATEST->value);

        $this->assertCount(2, $result);
        $this->assertArrayHasKey('childProp', $result);
        $this->assertArrayHasKey('parentProp', $result);
    }

    public function testChildPropertyWinsOverParentProperty(): void
    {
        $parentProp = $this->makeProperty('shared');
        $childProp  = $this->makeProperty('shared');

        $parent = new PHPClass();
        $parent->setId('\\Base');
        $parent->setName('Base');
        $parent->setProperties([$parentProp]);

        $child = new PHPClass();
        $child->setId('\\Derived');
        $child->setName('Derived');
        $child->setProperties([$childProp]);
        $child->setParentClass($parent);

        $result = $this->service->collectPropertiesForClass($child, PhpVersions::LATEST->value);

        $this->assertSame($childProp, $result['shared']);
        $this->assertNotSame($parentProp, $result['shared']);
    }

    public function testPropertyVersionFilteringWorks(): void
    {
        $oldProp = $this->makeProperty('oldProp', removedVersion: '8.0');
        $newProp = $this->makeProperty('newProp', sinceVersion: '8.0');

        $class = new PHPClass();
        $class->setId('\\MyClass');
        $class->setName('MyClass');
        $class->setProperties([$oldProp, $newProp]);

        $result = $this->service->collectPropertiesForClass($class, '8.0');

        $this->assertArrayNotHasKey('oldProp', $result);
        $this->assertArrayHasKey('newProp', $result);
    }

    public function testPropertyCycleDetection(): void
    {
        $propA = $this->makeProperty('propA');
        $propB = $this->makeProperty('propB');

        $classA = new PHPClass();
        $classA->setId('\\A');
        $classA->setName('A');
        $classA->setProperties([$propA]);

        $classB = new PHPClass();
        $classB->setId('\\B');
        $classB->setName('B');
        $classB->setProperties([$propB]);

        // Create cycle: A -> B -> A
        $classA->setParentClass($classB);
        $classB->setParentClass($classA);

        $result = $this->service->collectPropertiesForClass($classA, PhpVersions::LATEST->value);

        $this->assertArrayHasKey('propA', $result);
        $this->assertArrayHasKey('propB', $result);
    }

    // ── filterAndDeduplicateParams (delegates to ParameterFilterHelper) ──────

    public function testFilterAndDeduplicateParamsDelegatesToHelper(): void
    {
        $param = new \StubTests\Framework\Parsers\Model\PHPParameter('value');

        $result = $this->service->filterAndDeduplicateParams([$param], PhpVersions::LATEST->value);

        $this->assertCount(1, $result);
        $this->assertSame($param, $result[0]);
    }

    // ── Methods with null name are skipped ───────────────────────────────────

    public function testMethodsWithNullNameAreSkipped(): void
    {
        $nullMethod = new PHPMethod();
        // No setName() — getName() returns null
        $namedMethod = $this->makeMethod('valid');

        $class = $this->makeClass('\\MyClass', [$nullMethod, $namedMethod]);

        $result = $this->service->collectForClass($class, PhpVersions::LATEST->value);

        $this->assertCount(1, $result);
        $this->assertArrayHasKey('valid', $result);
    }
}
