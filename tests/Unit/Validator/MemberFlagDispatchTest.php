<?php

namespace StubTests\Unit\Validator;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Model\PHPProperty;
use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\DescribesPropertyMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * How AbstractMemberFlagCheck reaches a leaf's comparison now that the two member-kind subclasses
 * are gone.
 *
 * The comparison used to be an abstract method on an intermediate class, so "the leaf supplies a
 * comparison" was enforced at compile time. It is now an interface found by instanceof, which moves
 * two wiring errors from impossible to runtime: implementing neither describer, and implementing one
 * that disagrees with memberKind(). Both are covered here, because that is the cost this design
 * carries and it should fail loudly rather than silently compare nothing.
 *
 * @see AbstractMemberFlagCheck::describeMemberMismatch()
 */
class MemberFlagDispatchTest extends TestCase
{
    private function invokeDescribe(
        AbstractMemberFlagCheck $check,
        mixed $reflectionMember,
        mixed $stubMember
    ): ?string {
        $m = new \ReflectionMethod($check, 'describeMemberMismatch');
        return $m->invoke($check, '\\Foo::bar', $reflectionMember, $stubMember, '8.6');
    }

    public function testMethodDescriberIsReachedWithTypedArguments()
    {
        $check = new class () extends AbstractMemberFlagCheck implements DescribesMethodMismatch {
            protected function getCheckName(): CheckType
            {
                return CheckType::RETURN_TYPES;
            }

            protected function memberKind(): MemberKind
            {
                return MemberKind::METHOD;
            }

            public function describeMethodMismatch(
                string $methodEntityId,
                mixed $reflMethod,
                PHPMethod $stubMethod,
                string $phpVersion
            ): ?string {
                return "method describer saw {$methodEntityId} at {$phpVersion}";
            }
        };

        self::assertSame(
            'method describer saw \\Foo::bar at 8.6',
            $this->invokeDescribe($check, new PHPMethod(), new PHPMethod())
        );
    }

    public function testPropertyDescriberIsReachedWithTypedArguments()
    {
        $check = new class () extends AbstractMemberFlagCheck implements DescribesPropertyMismatch {
            protected function getCheckName(): CheckType
            {
                return CheckType::PROPERTY_TYPES;
            }

            protected function memberKind(): MemberKind
            {
                return MemberKind::PROPERTY;
            }

            public function describePropertyMismatch(
                string $propertyEntityId,
                PHPProperty $reflProperty,
                PHPProperty $stubProperty,
                string $phpVersion
            ): ?string {
                return "property describer saw {$propertyEntityId}";
            }
        };

        self::assertSame(
            'property describer saw \\Foo::bar',
            $this->invokeDescribe($check, new PHPProperty(), new PHPProperty())
        );
    }

    /** A null return (attributes match) must pass straight through, not be treated as "no describer". */
    public function testNullFromTheDescriberIsPropagated()
    {
        $check = new class () extends AbstractMemberFlagCheck implements DescribesMethodMismatch {
            protected function getCheckName(): CheckType
            {
                return CheckType::RETURN_TYPES;
            }

            protected function memberKind(): MemberKind
            {
                return MemberKind::METHOD;
            }

            public function describeMethodMismatch(
                string $methodEntityId,
                mixed $reflMethod,
                PHPMethod $stubMethod,
                string $phpVersion
            ): ?string {
                return null;
            }
        };

        self::assertNull($this->invokeDescribe($check, new PHPMethod(), new PHPMethod()));
    }

    /**
     * Implementing neither describer used to be a compile-time error (an unimplemented abstract
     * method). It is now only detectable at runtime, so it must name the class and the remedy.
     */
    public function testImplementingNoDescriberThrowsADiagnostic()
    {
        $check = new class () extends AbstractMemberFlagCheck {
            protected function getCheckName(): CheckType
            {
                return CheckType::RETURN_TYPES;
            }

            protected function memberKind(): MemberKind
            {
                return MemberKind::METHOD;
            }
        };

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessageMatches('/DescribesMethodMismatch nor DescribesPropertyMismatch/');
        $this->invokeDescribe($check, new PHPMethod(), new PHPMethod());
    }

    /**
     * The kind and the describer are independent, so they can disagree. A PROPERTY kind with only the
     * method describer feeds a PHPProperty to a PHPMethod parameter — which must fail as a TypeError
     * rather than silently comparing the wrong thing.
     */
    public function testKindAndDescriberDisagreeingFailsLoudly()
    {
        $check = new class () extends AbstractMemberFlagCheck implements DescribesMethodMismatch {
            protected function getCheckName(): CheckType
            {
                return CheckType::RETURN_TYPES;
            }

            protected function memberKind(): MemberKind
            {
                return MemberKind::PROPERTY; // deliberately inconsistent with the describer
            }

            public function describeMethodMismatch(
                string $methodEntityId,
                mixed $reflMethod,
                PHPMethod $stubMethod,
                string $phpVersion
            ): ?string {
                return 'should not be reached with a property';
            }
        };

        $this->expectException(\TypeError::class);
        $this->invokeDescribe($check, new PHPProperty(), new PHPProperty());
    }
}
