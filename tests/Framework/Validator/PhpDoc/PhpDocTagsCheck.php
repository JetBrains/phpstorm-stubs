<?php

namespace StubTests\Framework\Validator\PhpDoc;

use StubTests\Framework\Parsers\Model\PHPClassLikeObject;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractReflectionCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Services\EntityLookupService;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;

/**
 * Validates that PhpDoc comments contain only recognized tag names.
 *
 * Valid tags are those from phpDocumentor v3, PHPStan (non-prefixed forms only),
 * and a small set of custom tags used in phpstorm-stubs.
 *
 * Tags with phpstan-*, psalm-*, or phan-* prefixes are explicitly invalid.
 * Any tag not in the whitelist is also flagged.
 *
 * For class-like entities (classes, interfaces, enums) the check examines:
 * - the entity-level phpDoc
 * - the phpDoc of every declared method
 *
 * For functions the check examines the function-level phpDoc only.
 *
 * Known problems are supported at entity level:
 * - entityType + entityId + 'PhpDocTagsCheck' → skips all tag checks for the entity.
 */
class PhpDocTagsCheck extends AbstractReflectionCheck
{
    private EntityLookupService $entityLookup;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?EntityLookupService $entityLookup = null
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry);
        $this->entityLookup = $entityLookup ?? new EntityLookupService();
    }

    private const VALID_TAGS = [
        // phpDocumentor v3 standard tags
        'api', 'author', 'category', 'copyright', 'deprecated', 'example',
        'filesource', 'global', 'ignore', 'inheritdoc', 'internal', 'license',
        'link', 'method', 'mixin', 'package', 'param', 'property',
        'property-read', 'property-write', 'return', 'see', 'since', 'source',
        'subpackage', 'throws', 'todo', 'uses', 'used-by', 'var', 'version',
        // PHPStan non-prefixed tags (template system, type-level contracts)
        'template', 'template-covariant', 'template-contravariant',
        'template-implements', 'template-extends',
        'extends', 'implements', 'use',
        'require-extends', 'require-implements',
        'immutable', 'readonly', 'pure', 'impure',
        'consistent-constructor', 'no-named-arguments',
        'param-out', 'type',
        'assert', 'assert-if-true', 'assert-if-false',
        // Custom tags used in phpstorm-stubs
        'removed',  // marks when an entity was removed from PHP
        'xglobal',  // documents PHP global variables
        'meta',     // PhpStorm metadata hint
        'public',   // accessibility marker (pq extension stubs)
    ];

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

        if ($this->skipWithKnownProblem($results, $entityType->value, $entityId, 'PhpDocTagsCheck', $phpVersion)) {
            return $results;
        }

        $invalidTagsByLocation = $this->collectInvalidTagsByLocation($entity, $entityId);

        if (empty($invalidTagsByLocation)) {
            $results->addSuccess($entityId);
            return $results;
        }

        foreach ($invalidTagsByLocation as $location => $tags) {
            $results->addFailure(
                $location,
                "{$location} PhpDoc contains invalid tags in PHP {$phpVersion}: @" . implode(', @', $tags)
            );
        }

        return $results;
    }

    /**
     * Collect invalid tags across the entity phpDoc and all method phpDocs.
     *
     * @return array<string, string[]> Map of location (entityId or methodId) → invalid tag names
     */
    private function collectInvalidTagsByLocation(object $entity, string $entityId): array
    {
        $result = [];

        // Entity-level phpDoc
        $phpDoc = $entity->getStubsMetadata()?->getPhpDoc();
        if ($phpDoc !== null && $phpDoc !== '') {
            $invalid = $this->findInvalidTagNames($phpDoc);
            if (!empty($invalid)) {
                $result[$entityId] = $invalid;
            }
        }

        // Method-level phpDocs for class-like entities
        if ($entity instanceof PHPClassLikeObject) {
            foreach ($entity->getMethods() as $method) {
                $phpDoc = $method->getStubsMetadata()?->getPhpDoc();
                if ($phpDoc === null || $phpDoc === '') {
                    continue;
                }
                $invalid = $this->findInvalidTagNames($phpDoc);
                if (!empty($invalid)) {
                    $methodId = $entityId . '::' . $method->getName();
                    $result[$methodId] = $invalid;
                }
            }
        }

        return $result;
    }

    /**
     * Return tag names present in $phpDoc that are not in the whitelist.
     *
     * @return string[] Sorted, deduplicated list of invalid lowercase tag names
     */
    private function findInvalidTagNames(string $phpDoc): array
    {
        $invalid = [];
        foreach ($this->extractTagNames($phpDoc) as $tag) {
            if (!in_array($tag, self::VALID_TAGS, true)) {
                $invalid[] = $tag;
            }
        }
        $invalid = array_unique($invalid);
        sort($invalid);
        return $invalid;
    }

    /**
     * Extract all distinct lowercase tag names from a phpDoc string.
     *
     * Matches:
     * - Block tags: lines of the form <whitespace>*<whitespace>@tagname
     * - Inline tags: {@tagname}
     *
     * Does NOT match @-signs inside email addresses or URLs because those are
     * not at the start of a phpDoc comment line and are not wrapped in {}.
     *
     * @return string[]
     */
    private function extractTagNames(string $phpDoc): array
    {
        $tags = [];

        // Block tags (line starts with optional whitespace, *, optional whitespace, then @tag)
        preg_match_all('/^\s*\*\s+@([a-zA-Z][a-zA-Z0-9_-]*)/m', $phpDoc, $blockMatches);
        foreach ($blockMatches[1] as $tag) {
            $tags[] = strtolower($tag);
        }

        // Inline tags: {@tagname}
        preg_match_all('/\{@([a-zA-Z][a-zA-Z0-9_-]*)\}/', $phpDoc, $inlineMatches);
        foreach ($inlineMatches[1] as $tag) {
            $tags[] = strtolower($tag);
        }

        return array_unique($tags);
    }

}
