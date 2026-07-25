<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\Model\PHPClassLikeObject;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;

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
 * Subclasses must implement:
 * - getCheckName(): the name used for known-problem lookups
 * - the member-kind hooks (lookup, member collection, id formatting, member entity type)
 * - describeMemberMismatch(): the actual attribute comparison
 */
abstract class AbstractMemberFlagCheck extends AbstractClassCheck
{
    abstract protected function getCheckName(): string;

    /**
     * Look up the owning entity (class/enum/interface) by id in the given storage.
     */
    abstract protected function lookupFlagEntity(StubDataQueryInterface $storage, string $entityId): ?PHPClassLikeObject;

    /**
     * Return the reflection members to iterate. Each element must expose getName().
     *
     * @return iterable<mixed>
     */
    abstract protected function collectReflectionMembers(PHPClassLikeObject $reflectionEntity): iterable;

    /**
     * Return the version-filtered stub members keyed by name.
     *
     * @return array<string, mixed>
     */
    abstract protected function collectStubMemberMap(PHPClassLikeObject $stubEntity, string $phpVersion): array;

    /**
     * Build the fully-qualified member id used for failures and known-problem lookups.
     */
    abstract protected function formatMemberId(string $entityId, string $memberName): string;

    /**
     * The EntityType (as its string value) used for per-member known-problem lookups.
     */
    abstract protected function getMemberEntityType(): string;

    /**
     * Compare the attribute on the reflection and stub member.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     */
    abstract protected function describeMemberMismatch(
        string $memberId,
        mixed $reflectionMember,
        mixed $stubMember,
        string $phpVersion
    ): ?string;

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
        foreach ($this->collectReflectionMembers($reflectionEntity) as $reflMember) {
            $name = $reflMember->getName();
            if ($name === null || !isset($stubMemberMap[$name])) {
                // Null name or member absent from stubs — the corresponding *ExistCheck's responsibility
                continue;
            }

            $memberId = $this->formatMemberId($entityId, $name);
            $mismatchMessage = $this->describeMemberMismatch($memberId, $reflMember, $stubMemberMap[$name], $phpVersion);

            if ($mismatchMessage === null) {
                continue;
            }

            $hasMismatch = true;
            if (!$this->skipWithKnownProblem($results, $this->getMemberEntityType(), $memberId, $this->getCheckName(), $phpVersion)) {
                $results->addFailure($memberId, $mismatchMessage);
            }
        }

        if (!$hasMismatch) {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
