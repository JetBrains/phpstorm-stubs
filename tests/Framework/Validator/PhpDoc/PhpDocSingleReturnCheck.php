<?php

namespace StubTests\Framework\Validator\PhpDoc;

use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractReflectionCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\Services\EntityLookupService;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;

/**
 * Validates that a phpDoc comment declares at most one @return tag.
 *
 * A docblock can only describe one return type, so a second @return is never
 * additive — every consumer silently keeps one of them and discards the rest.
 * The stub parser (PhpDocumentorParser::extractReturnType) takes the first tag,
 * which means a trailing @return added later looks applied but has no effect,
 * and the two can disagree without anything reporting it.
 *
 * For class-like entities (classes, interfaces, enums) the check examines:
 * - the entity-level phpDoc
 * - the phpDoc of every declared method
 *
 * For functions the check examines the function-level phpDoc only.
 *
 * Known problems are supported at entity level:
 * - entityType + entityId + 'PhpDocSingleReturnCheck' → skips the check for the entity.
 */
class PhpDocSingleReturnCheck extends AbstractReflectionCheck
{
    use PhpDocLocationWalkerTrait;

    /**
     * Matches a block-level "@return ..." tag and captures the rest of the line.
     *
     * The (?![\w-]) guard keeps prefixed variants (@return-something) and longer
     * names (@returns) from counting; those are separately rejected by
     * PhpDocTagsCheck as unrecognized tags.
     */
    private const RETURN_TAG_PATTERN = '/^\s*\*\s+@return(?![\w-])[ \t]*(.*)$/m';
    private EntityLookupService $entityLookup;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?EntityLookupService $entityLookup = null
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry);
        $this->entityLookup = $entityLookup ?? new EntityLookupService();
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        $found = $this->entityLookup->findAnyEntityById($stubs, $entityId);
        if ($found === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        [$entity, $entityType] = $found;

        if ($this->skipWithKnownProblem($results, $entityType->value, $entityId, CheckType::PHPDOC_SINGLE_RETURN, $phpVersion)) {
            return $results;
        }

        $violationsByLocation = $this->collectViolationsByLocation($entity, $entityId);

        if (empty($violationsByLocation)) {
            $results->addSuccess($entityId);
            return $results;
        }

        foreach ($violationsByLocation as $location => $returnTags) {
            $results->addFailure(
                $location,
                "{$location} PhpDoc declares " . count($returnTags) . " @return tags in PHP {$phpVersion}, "
                . 'only one is allowed: @return ' . implode(', @return ', $returnTags)
            );
        }

        return $results;
    }

    /**
     * Collect duplicate @return tags across the entity phpDoc and all method phpDocs.
     *
     * @return array<string, string[]> Map of location (entityId or methodId) → the @return tag
     *                                 bodies found there, only for locations with more than one
     */
    private function collectViolationsByLocation(object $entity, string $entityId): array
    {
        return $this->collectByPhpDocLocation(
            $entity,
            $entityId,
            fn (string $phpDoc): array => $this->findDuplicateReturnTags($phpDoc)
        );
    }

    /**
     * Return the bodies of every @return tag in $phpDoc, but only when there is more than one.
     *
     * The bodies are reported as written (type plus any inline description) so the failure
     * names the competing declarations rather than just their count. Duplicates are kept: two
     * identical @return tags are still two tags.
     *
     * @return string[] Empty when the phpDoc has zero or one @return tag
     */
    private function findDuplicateReturnTags(string $phpDoc): array
    {
        if (!preg_match_all(self::RETURN_TAG_PATTERN, $phpDoc, $matches)) {
            return [];
        }

        if (count($matches[0]) < 2) {
            return [];
        }

        return array_map(
            static fn (string $body): string => trim($body),
            $matches[1]
        );
    }
}
