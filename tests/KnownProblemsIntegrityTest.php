<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Runner\RunnerScope;
use StubTests\Framework\Validator\KnownProblems\DefaultKnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;

/**
 * Guards `DefaultKnownProblemsProvider` against becoming dead config.
 *
 * A known problem suppresses a check for a named entity. If that entity is later renamed or
 * removed from the stubs, the entry stops matching anything — but nothing fails, because a
 * suppression that never fires looks exactly like a suppression that was not needed. The entry
 * survives as documentation of a problem that no longer exists at an id that no longer exists,
 * and the next reader trusts it.
 *
 * A typo made when *writing* an entry is already caught: the failure it was meant to suppress
 * simply stays red. This test covers the other direction — an entry that was correct when
 * written and has since drifted.
 *
 * Scope, stated plainly: this asserts the entity **exists**. It does not assert the suppression
 * is still **needed** — an entry whose underlying divergence PHP has since fixed keeps passing
 * here. Detecting that means re-running each affected check with the suppression lifted, which
 * is a larger piece of work; see T-W4 in `.claude/reviews/REVIEW-2026-08-04-deprecated-since.md`.
 */
class KnownProblemsIntegrityTest extends TestCase
{
    /**
     * @return array<string, array{ProblemDefinition, string}>
     */
    public static function knownProblemEntityIdProvider(): array
    {
        $cases = [];

        foreach ((new DefaultKnownProblemsProvider())->getProblems() as $problem) {
            // $entityIds, when present, replaces $entityId — which is then only a grouping label
            // and must not be resolved as an entity in its own right.
            foreach ($problem->entityIds ?: [$problem->entityId] as $entityId) {
                $cases[$problem->entityType->value . ' ' . $entityId] = [$problem, $entityId];
            }
        }

        return $cases;
    }

    #[DataProvider('knownProblemEntityIdProvider')]
    public function testKnownProblemEntityStillExistsInStubs(ProblemDefinition $problem, string $entityId): void
    {
        $exists = self::entityExistsInStubs($problem->entityType, $entityId);

        // Some problems describe an entity reflection reports but the stubs deliberately omit —
        // \TRUE, \FALSE and \NULL are language keywords the runtime lists as constants. Those
        // must not be read as dead config, so reflection is consulted before failing.
        if ($exists === false && self::entityExistsInReflection($problem, $entityId)) {
            $exists = true;
        }

        if ($exists === null) {
            // The model cannot answer for this entity kind. Failing would blame the entry for a
            // framework gap, so the gap is surfaced as a skip instead.
            self::markTestSkipped(sprintf(
                "Cannot resolve %s '%s': PHPInterface and PHPEnum do not model properties, and "
                . "StubInterfaceParser does not parse them. PHP 8.4 permits property declarations "
                . "in interfaces, so this is a modelling gap, not a stale entry.",
                $problem->entityType->value,
                $entityId
            ));
        }

        self::assertTrue(
            $exists,
            sprintf(
                "Known problem references %s '%s', which no longer exists in the stubs.\n"
                . "The suppression can never fire, so it is dead config. Either the entity was "
                . "renamed/removed and the entry should follow it, or the entry should be deleted.\n"
                . "Reason recorded on the entry: %s",
                $problem->entityType->value,
                $entityId,
                $problem->reason
            )
        );
    }

    /**
     * Does the entity appear in the reflection data for any version the problem covers?
     *
     * Only the versions in the entry's own range are loaded: a problem scoped to 5.6 says
     * nothing about 8.6, and loading all 13 caches to answer would be wasted work.
     */
    private static function entityExistsInReflection(ProblemDefinition $problem, string $entityId): bool
    {
        foreach (PhpVersions::cases() as $version) {
            if (!$problem->versionRange->includes($version->value)) {
                continue;
            }

            $reflection = RunnerScope::get()->getReflection($version->value);

            $found = match ($problem->entityType) {
                EntityType::FUNCTION => self::hasId($reflection->getFunctions(), $entityId),
                EntityType::GLOBAL_CONSTANT => self::hasId($reflection->getConstants(), $entityId),
                EntityType::CLASS_TYPE => $reflection->hasClass($entityId),
                EntityType::INTERFACE_TYPE => $reflection->hasInterface($entityId),
                EntityType::ENUM_TYPE => $reflection->hasEnum($entityId),
                // Members are only cross-checked at the class-like level here; a member entry
                // whose owner is missing from the stubs is reported against the stubs.
                default => false,
            };

            if ($found) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool|null True/false when the stubs can answer, null when the model cannot
     *                   represent the entity kind at all (see the PROPERTY branch).
     */
    private static function entityExistsInStubs(EntityType $entityType, string $entityId): ?bool
    {
        $stubs = RunnerScope::get()->getStubs();

        return match ($entityType) {
            EntityType::FUNCTION => self::hasId($stubs->getFunctions(), $entityId),
            EntityType::GLOBAL_CONSTANT => self::hasId($stubs->getConstants(), $entityId),
            EntityType::CLASS_TYPE => $stubs->hasClass($entityId),
            EntityType::INTERFACE_TYPE => $stubs->hasInterface($entityId),
            EntityType::ENUM_TYPE => $stubs->hasEnum($entityId),
            EntityType::METHOD => self::hasMember($entityId, 'method'),
            EntityType::PROPERTY => self::hasMember($entityId, 'property'),
            EntityType::CLASS_CONSTANT,
            EntityType::INTERFACE_CONSTANT,
            EntityType::ENUM_CONSTANT => self::hasMember($entityId, 'constant'),
        };
    }

    /**
     * @param array<mixed> $entities
     */
    private static function hasId(array $entities, string $entityId): bool
    {
        foreach ($entities as $entity) {
            if ($entity->getId() === $entityId) {
                return true;
            }
        }

        return false;
    }

    /**
     * Resolve `\Owner::member` against the class, interface and enum tables.
     *
     * Inheritance is followed. Validators resolve a member through the stub hierarchy and then
     * report it under the id they were asked about, so `\SplTempFileObject::fgetss` is a correct
     * entry id even though only `\SplFileObject` declares the method. Looking at the declaring
     * type alone would report every such entry as dead config.
     */
    private static function hasMember(string $entityId, string $kind): ?bool
    {
        $separator = strpos($entityId, '::');
        if ($separator === false) {
            return false;
        }

        $ownerId = substr($entityId, 0, $separator);
        $memberName = substr($entityId, $separator + 2);

        $owner = self::findClassLike($ownerId);
        if ($owner === null) {
            return false;
        }

        $sawNonClassOwner = false;

        foreach (self::selfAndAncestors($owner) as $type) {
            $found = match ($kind) {
                // Method names are case-insensitive in PHP.
                'method' => self::hasNamed($type->getMethods(), $memberName, caseInsensitive: true),
                'constant' => self::hasNamed($type->getConstants(), $memberName),
                // Since PHP 8.4 an interface may declare properties too, but only PHPClass models
                // them and StubInterfaceParser never parses them. Reporting false for an
                // interface would blame the entry for a framework gap, so that case is tracked
                // and surfaced as "unknown" if nothing else matches.
                default => $type instanceof PHPClass
                    ? self::hasNamed($type->getProperties(), ltrim($memberName, '$'))
                    : self::note($sawNonClassOwner),
            };

            if ($found) {
                return true;
            }
        }

        return $sawNonClassOwner ? null : false;
    }

    /**
     * Flags that a property lookup hit a type the model cannot answer for, and reports "not
     * found" so the walk continues to the remaining ancestors.
     */
    private static function note(bool &$sawNonClassOwner): bool
    {
        $sawNonClassOwner = true;

        return false;
    }

    /**
     * The type itself plus every ancestor reachable through `extends` and `implements`.
     *
     * @return list<PHPClassLikeObject>
     */
    private static function selfAndAncestors(PHPClassLikeObject $type): array
    {
        $seen = [];
        $queue = [$type];

        while ($queue !== []) {
            $current = array_shift($queue);
            $id = $current->getId() ?? spl_object_hash($current);
            if (isset($seen[$id])) {
                continue; // guards against a malformed cyclic hierarchy
            }
            $seen[$id] = $current;

            if ($current instanceof PHPClass && $current->getParentClass() !== null) {
                $queue[] = $current->getParentClass();
            }
            if ($current instanceof PHPInterface) {
                foreach ($current->getParentInterfaces() as $parent) {
                    $queue[] = $parent;
                }
            }
            foreach ($current->getImplementedInterfaces() as $interface) {
                // Implemented interfaces may be stored as names rather than resolved objects.
                $resolved = is_string($interface) ? self::findClassLike($interface) : $interface;
                if ($resolved !== null) {
                    $queue[] = $resolved;
                }
            }
        }

        return array_values($seen);
    }

    private static function findClassLike(string $ownerId): ?PHPClassLikeObject
    {
        $stubs = RunnerScope::get()->getStubs();

        foreach ([$stubs->getClasses(), $stubs->getInterfaces(), $stubs->getEnums()] as $table) {
            foreach ($table as $entity) {
                if ($entity->getId() === $ownerId) {
                    return $entity;
                }
            }
        }

        return null;
    }

    /**
     * @param array<mixed> $members
     */
    private static function hasNamed(array $members, string $name, bool $caseInsensitive = false): bool
    {
        foreach ($members as $member) {
            $matches = $caseInsensitive
                ? strcasecmp($member->getName(), $name) === 0
                : $member->getName() === $name;
            if ($matches) {
                return true;
            }
        }

        return false;
    }
}
