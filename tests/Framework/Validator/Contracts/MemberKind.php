<?php

namespace StubTests\Framework\Validator\Contracts;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * The kind of class member a flag check compares — a method or a property.
 *
 * AbstractMemberFlagCheck previously declared seven abstract hooks, six of which were pure
 * configuration rather than behaviour: both member-kind subclasses implemented them as
 * identically-shaped one-liners that returned a constant or forwarded a single call. That made the
 * abstract class a configuration point, where the differences between the two kinds were spread
 * across two files instead of being stated once. They are stated here instead.
 *
 * Note the two remaining operations that are *not* here — entity lookup and stub member collection.
 * Both need the check's own collaborators (EntityLookupService, MethodCollectionService, the
 * EntityTypeConfig), so they stay as small matches in AbstractMemberFlagCheck rather than forcing
 * those collaborators to become public just to be reachable from an enum.
 */
enum MemberKind
{
    case METHOD;
    case PROPERTY;

    /**
     * The EntityType (as its string value) used for per-member known-problem lookups.
     */
    public function knownProblemEntityType(): string
    {
        return match ($this) {
            self::METHOD => EntityType::METHOD->value,
            self::PROPERTY => EntityType::PROPERTY->value,
        };
    }

    /**
     * Build the fully-qualified member id used for failures and known-problem lookups.
     * Properties carry the `$` sigil, matching how they are written in known-problem definitions.
     */
    public function formatMemberId(string $entityId, string $memberName): string
    {
        return match ($this) {
            self::METHOD => $entityId . '::' . $memberName,
            self::PROPERTY => $entityId . '::$' . $memberName,
        };
    }

    /**
     * The reflection members to iterate. Each element exposes getName().
     *
     * Properties are class-specific in the model — PHPEnum and PHPInterface have no
     * getProperties() — so a non-class entity yields nothing rather than erroring.
     *
     * @return iterable<mixed>
     */
    public function reflectionMembers(PHPClassLikeObject $reflectionEntity): iterable
    {
        return match ($this) {
            self::METHOD => $reflectionEntity->getMethods(),
            self::PROPERTY => $reflectionEntity instanceof PHPClass ? $reflectionEntity->getProperties() : [],
        };
    }
}
