<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Model\PHPProperty;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Base class for checks that compare a boolean property flag (e.g. isStatic, visibility)
 * between reflection and stubs.
 *
 * The comparison loop lives in {@see AbstractMemberFlagCheck}; this class only supplies
 * the property-specific member accessors.
 *
 * Currently supports PHPClass entities only. Properties are class-specific
 * in the model (PHPEnum/PHPInterface do not have getProperties()).
 *
 * Subclasses must implement:
 * - getCheckName(): the name used for known-problem lookups
 * - describeMismatch(): returns a failure message when the flags differ, or null when they match
 */
abstract class AbstractPropertyFlagCheck extends AbstractMemberFlagCheck
{
    /**
     * Compare a flag on the reflection and stub property.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     */
    abstract protected function describeMismatch(
        string $propertyEntityId,
        PHPProperty $reflProperty,
        PHPProperty $stubProperty,
        string $phpVersion
    ): ?string;

    protected function lookupFlagEntity(StubDataQueryInterface $storage, string $entityId): ?PHPClassLikeObject
    {
        return $this->findClassById($storage, $entityId);
    }

    protected function collectReflectionMembers(PHPClassLikeObject $reflectionEntity): iterable
    {
        return $reflectionEntity instanceof PHPClass ? $reflectionEntity->getProperties() : [];
    }

    protected function collectStubMemberMap(PHPClassLikeObject $stubEntity, string $phpVersion): array
    {
        return $stubEntity instanceof PHPClass
            ? $this->methodCollection->collectPropertiesForClass($stubEntity, $phpVersion)
            : [];
    }

    protected function formatMemberId(string $entityId, string $memberName): string
    {
        return $entityId . '::$' . $memberName;
    }

    protected function getMemberEntityType(): string
    {
        return EntityType::PROPERTY->value;
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
