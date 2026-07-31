<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\DescribesPropertyMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Shared orchestration for checks that compare a per-member attribute (e.g. a method's
 * isStatic flag or a property's visibility) between reflection and stubs.
 *
 * The comparison is reflection-driven: it iterates the reflection members and compares
 * each one that also exists in the version-filtered stub member map. Members present only
 * in reflection (or only in stubs) are ignored here — reporting those is the responsibility
 * of the corresponding *ExistCheck.
 *
 * Concrete member kinds (methods, properties) supply the member-specific behaviour via the
 * hooks below. Constants are NOT modelled here: {@see AbstractConstantFlagCheck} iterates the
 * stub side with per-member version filtering and different known-problem-skip semantics.
 *
 * Subclasses must supply three things, one per axis plus the check's identity:
 * - getCheckName(): the name used for known-problem lookups
 * - memberKind(): which member kind to compare (see {@see MemberKind})
 * - one of {@see DescribesMethodMismatch} / {@see DescribesPropertyMismatch}: the comparison itself
 *
 * Those last two are the two axes this check varies along. They used to be expressed as one
 * inheritance chain — a member-kind subclass per kind, with the comparison abstract below it — so
 * adding a member kind meant adding a level. Now the kind is data and the comparison is an
 * interface, and neither requires a new abstract class.
 */
abstract class AbstractMemberFlagCheck extends AbstractClassCheck
{
    private const NO_DESCRIBER = ' extends AbstractMemberFlagCheck but implements neither'
        . ' DescribesMethodMismatch nor DescribesPropertyMismatch, so it has no comparison to run.';

    abstract protected function getCheckName(): CheckType;

    /**
     * Which member kind this check compares. Supplies the id format, the known-problem entity type
     * and the reflection-member accessor, all of which used to be one-line abstract hooks.
     */
    abstract protected function memberKind(): MemberKind;

    /**
     * Compare the attribute on the reflection and stub member, via whichever describer interface
     * this check implements.
     *
     * The concrete parameter types live on those interfaces rather than on an abstract method here,
     * because PHP forbids narrowing a parameter type in an override — which is the sole reason
     * AbstractMethodFlagCheck and AbstractPropertyFlagCheck used to exist as a layer between this
     * class and the leaves. Implementing an interface declares the type instead of narrowing one, so
     * the leaves keep typed signatures and that layer is gone.
     *
     * The kind and the describer are two independent axes, so a mismatch between them is a wiring
     * error: MemberKind::PROPERTY with only DescribesMethodMismatch implemented would hand a
     * PHPProperty to a PHPMethod parameter. That surfaces as a TypeError from the describer; the
     * LogicException below covers the case where neither interface is implemented at all.
     */
    private function describeMemberMismatch(
        string $memberId,
        mixed $reflectionMember,
        mixed $stubMember,
        string $phpVersion
    ): ?string {
        if ($this instanceof DescribesMethodMismatch) {
            return $this->describeMethodMismatch($memberId, $reflectionMember, $stubMember, $phpVersion);
        }

        if ($this instanceof DescribesPropertyMismatch) {
            return $this->describePropertyMismatch($memberId, $reflectionMember, $stubMember, $phpVersion);
        }

        throw new \LogicException(static::class . self::NO_DESCRIBER);
    }

    /**
     * Look up the owning entity (class/enum/interface) by id.
     *
     * Kept here rather than on MemberKind because both arms need the check's own lookup
     * collaborators, which are protected.
     */
    private function lookupFlagEntity(StubDataQueryInterface $storage, string $entityId): ?PHPClassLikeObject
    {
        return match ($this->memberKind()) {
            MemberKind::METHOD => $this->lookupEntityById($storage, $entityId),
            MemberKind::PROPERTY => $this->findClassById($storage, $entityId),
        };
    }

    /**
     * The version-filtered stub members, keyed by name. Also needs the check's collaborators.
     *
     * @return array<string, mixed>
     */
    private function collectStubMemberMap(PHPClassLikeObject $stubEntity, string $phpVersion): array
    {
        return match ($this->memberKind()) {
            MemberKind::METHOD => $this->collectEntityMethodsByConfig($stubEntity, $phpVersion),
            MemberKind::PROPERTY => $stubEntity instanceof PHPClass
                ? $this->methodCollection->collectPropertiesForClass($stubEntity, $phpVersion)
                : [],
        };
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, $this->getCheckName(), $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $label = $this->getEntityLabel();

        $reflectionEntity = $this->lookupFlagEntity($reflection, $entityId);
        if ($reflectionEntity === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubEntity = $this->lookupFlagEntity($stubs, $entityId);
        if ($stubEntity === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        $stubMemberMap = $this->collectStubMemberMap($stubEntity, $phpVersion);

        $hasMismatch = false;
        foreach ($this->memberKind()->reflectionMembers($reflectionEntity) as $reflMember) {
            $name = $reflMember->getName();
            if ($name === null || !isset($stubMemberMap[$name])) {
                // Null name or member absent from stubs — the corresponding *ExistCheck's responsibility
                continue;
            }

            $memberId = $this->memberKind()->formatMemberId($entityId, $name);
            $mismatchMessage = $this->describeMemberMismatch($memberId, $reflMember, $stubMemberMap[$name], $phpVersion);

            if ($mismatchMessage === null) {
                continue;
            }

            $hasMismatch = true;
            if (!$this->skipWithKnownProblem(
                $results,
                $this->memberKind()->knownProblemEntityType(),
                $memberId,
                $this->getCheckName(),
                $phpVersion
            )) {
                $results->addFailure($memberId, $mismatchMessage);
            }
        }

        if (!$hasMismatch) {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
