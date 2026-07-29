<?php

namespace StubTests\Unit\Validator\Contracts;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Model\PHPProperty;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * The member-kind configuration that used to be six one-line abstract hooks spread across
 * AbstractMethodFlagCheck and AbstractPropertyFlagCheck. Now that it is data rather than
 * inheritance, it can be asserted directly instead of only through the 16 leaf checks.
 *
 * @see MemberKind
 */
class MemberKindTest extends TestCase
{
    public function testMethodIdsUseThePlainScopeResolutionSeparator()
    {
        self::assertSame('\\Foo::bar', MemberKind::METHOD->formatMemberId('\\Foo', 'bar'));
    }

    /** Properties carry the `$` sigil, matching how known-problem definitions are written. */
    public function testPropertyIdsCarryTheDollarSigil()
    {
        self::assertSame('\\Foo::$bar', MemberKind::PROPERTY->formatMemberId('\\Foo', 'bar'));
    }

    public function testKnownProblemEntityTypesMatchTheEntityTypeEnum()
    {
        self::assertSame(EntityType::METHOD->value, MemberKind::METHOD->knownProblemEntityType());
        self::assertSame(EntityType::PROPERTY->value, MemberKind::PROPERTY->knownProblemEntityType());
    }

    /** The two kinds must never collide in known-problem lookups. */
    public function testTheTwoKindsUseDistinctEntityTypes()
    {
        self::assertNotSame(
            MemberKind::METHOD->knownProblemEntityType(),
            MemberKind::PROPERTY->knownProblemEntityType()
        );
    }

    public function testMethodKindReadsMethodsFromTheEntity()
    {
        $class = new PHPClass();
        $method = new PHPMethod();
        $method->setName('doThing');
        $class->addMethod($method);

        $members = MemberKind::METHOD->reflectionMembers($class);

        self::assertCount(1, $members);
        self::assertSame('doThing', reset($members)->getName());
    }

    public function testPropertyKindReadsPropertiesFromAClass()
    {
        $class = new PHPClass();
        $property = new PHPProperty();
        $property->setName('field');
        $class->addProperty($property);

        $members = MemberKind::PROPERTY->reflectionMembers($class);

        self::assertCount(1, $members);
        self::assertSame('field', reset($members)->getName());
    }

    /**
     * Properties are class-only in the model: PHPEnum and PHPInterface have no getProperties(), so
     * the property kind must yield nothing for them rather than erroring. This guard used to live
     * in AbstractPropertyFlagCheck::collectReflectionMembers().
     */
    public function testPropertyKindYieldsNothingForNonClassEntities()
    {
        self::assertSame([], MemberKind::PROPERTY->reflectionMembers(new PHPEnum()));
        self::assertSame([], MemberKind::PROPERTY->reflectionMembers(new PHPInterface()));
    }

    /** Enums and interfaces do have methods, so the method kind still reads them. */
    public function testMethodKindWorksForEnumsAndInterfaces()
    {
        $enum = new PHPEnum();
        $enumMethod = new PHPMethod();
        $enumMethod->setName('cases');
        $enum->addMethod($enumMethod);

        $interface = new PHPInterface();
        $interfaceMethod = new PHPMethod();
        $interfaceMethod->setName('count');
        $interface->addMethod($interfaceMethod);

        self::assertCount(1, MemberKind::METHOD->reflectionMembers($enum));
        self::assertCount(1, MemberKind::METHOD->reflectionMembers($interface));
    }

    /**
     * Every case must answer every accessor. Guards against a third kind being added with only
     * some of the three matches extended — each would otherwise throw UnhandledMatchError at
     * runtime, in a check, rather than here.
     */
    public function testEveryCaseAnswersEveryAccessor()
    {
        foreach (MemberKind::cases() as $kind) {
            self::assertNotSame('', $kind->knownProblemEntityType(), $kind->name);
            self::assertSame(
                '\\Foo',
                substr($kind->formatMemberId('\\Foo', 'bar'), 0, 4),
                $kind->name . ' must prefix the owning entity id'
            );
            self::assertIsIterable($kind->reflectionMembers(new PHPClass()), $kind->name);
        }
    }
}
