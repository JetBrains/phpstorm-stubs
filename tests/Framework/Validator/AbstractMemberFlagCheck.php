<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
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
 * Subclasses must implement three things:
 * - getCheckName(): the name used for known-problem lookups
 * - memberKind(): which member kind to compare, supplying the former one-line config hooks
 * - describeMemberMismatch(): the actual attribute comparison
 */
abstract class AbstractMemberFlagCheck extends AbstractClassCheck
{
    abstract protected function getCheckName(): CheckType;

    /**
     * Which member kind this check compares. Supplies the id format, the known-problem entity type
     * and the reflection-member accessor, all of which used to be one-line abstract hooks.
     */
    abstract protected function memberKind(): MemberKind;

    /**
     * Compare the attribute on the reflection and stub member.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     *
     * This stays abstract rather than collapsing into the leaves' describeMismatch(): the two
     * member-kind subclasses re-declare it with concrete parameter types (PHPMethod, PHPProperty)
     * and forward to it, which is what lets 16 leaf checks keep typed signatures. PHP forbids
     * narrowing a parameter type in an override, so a single `mixed` declaration here would force
     * every leaf to widen to `mixed` and lose that typing.
     */
    abstract protected function describeMemberMismatch(
        string $memberId,
        mixed $reflectionMember,
        mixed $stubMember,
        string $phpVersion
    ): ?string;

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
