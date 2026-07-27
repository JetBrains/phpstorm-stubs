<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Base class for checks that compare a boolean method flag (e.g. isFinal, isStatic)
 * between reflection and stubs.
 *
 * The comparison loop lives in {@see AbstractMemberFlagCheck}; this class only supplies
 * the method-specific member accessors.
 *
 * Subclasses must implement:
 * - getCheckName(): the name used for known-problem lookups
 * - describeMismatch(): returns a failure message when the flags differ, or null when they match
 */
abstract class AbstractMethodFlagCheck extends AbstractMemberFlagCheck
{
    /**
     * Compare a flag on the reflection and stub method.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     *
     * @param mixed $reflMethod reflection method object
     */
    abstract protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string;

    protected function lookupFlagEntity(StubDataQueryInterface $storage, string $entityId): ?PHPClassLikeObject
    {
        return $this->lookupEntityById($storage, $entityId);
    }

    protected function collectReflectionMembers(PHPClassLikeObject $reflectionEntity): iterable
    {
        return $reflectionEntity->getMethods();
    }

    protected function collectStubMemberMap(PHPClassLikeObject $stubEntity, string $phpVersion): array
    {
        return $this->collectEntityMethodsByConfig($stubEntity, $phpVersion);
    }

    protected function formatMemberId(string $entityId, string $memberName): string
    {
        return $entityId . '::' . $memberName;
    }

    protected function getMemberEntityType(): string
    {
        return EntityType::METHOD->value;
    }

    protected function describeMemberMismatch(
        string $memberId,
        mixed $reflectionMember,
        mixed $stubMember,
        string $phpVersion
    ): ?string {
        return $this->describeMismatch($memberId, $reflectionMember, $stubMember, $phpVersion);
    }
}
