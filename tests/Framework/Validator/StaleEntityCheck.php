<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Contracts\LookupKind;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\ExtensionPresenceService;

/**
 * Validates that a top-level entity declared in stubs exists in reflection for the version under
 * test, whenever its @since/@removed range says it should. This is the stubs → reflection
 * counterpart of EntityExistsCheck and ConstantExistsCheck, which only ask whether each reflection
 * entity is in the stubs.
 *
 * Without it, a stub PHP never defined (misspelled intl functions such as intltz_getGMT(), the
 * libsodium-only sodium_randombytes_buf()), and a missing or wrong @since/@removed tag
 * (preg_replace_callback_array() shown as available in 5.6, is_real() shown after its removal in
 * 8.0) passed the whole suite.
 *
 * ## Why the scope is narrow
 *
 * Unscoped, most stub-only entities belong to extensions the reflecting containers never load.
 * Two restrictions keep the signal usable:
 *
 * 1. **Extensions built from the PHP source tree only** ({@see ExtensionPresenceService::JUDGEABLE_CATEGORIES}).
 *    PECL and third-party stubs say nothing about PHP.
 * 2. **Only versions in which the entity's extension is loaded.** An extension counts as loaded
 *    when any entity from its stub directory exists in that version's reflection; see
 *    ExtensionPresenceService. This drops snmp, com_dotnet and the SAPI directories, and the
 *    versions whose image was built without an extension.
 *
 * Two kinds of name are intentional stub-only declarations and are never judged:
 * `PS_UNRESERVE_PREFIX_*` and `___PHPSTORM_HELPERS\*` (this project's workarounds for reserved
 * keywords and IDE-only types), and the compile-time magic constants such as `__CLASS__`.
 *
 * What remains legitimately stub-only — platform-specific entities (Windows, macOS), and entities
 * that depend on how PHP or a library was built — is carried as known problems.
 */
class StaleEntityCheck extends AbstractReflectionCheck
{
    private LookupKind $lookupKind;
    private string $label;
    private EntityType $entityType;
    private ExtensionPresenceService $extensionPresence;

    public function __construct(
        ?EntityTypeConfig $entityTypeConfig = null,
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?ExtensionPresenceService $extensionPresence = null,
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry);
        $config = $entityTypeConfig ?? EntityTypeConfig::forFunction();
        $this->lookupKind = $config->lookupKind;
        $this->label = $config->label;
        $this->entityType = $config->entityType;
        $this->extensionPresence = $extensionPresence ?? new ExtensionPresenceService();
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->entityType->value, $entityId, CheckType::STALE_ENTITY, $phpVersion)) {
            return $results;
        }

        if ($this->isIntentionallyStubOnly($entityId)) {
            $results->addSuccess($entityId . ' (intentional stub-only declaration)');
            return $results;
        }

        // Only declarations that ship with PHP and claim this version are judged; a version-split
        // entity is available when any of its declarations is.
        $directories = [];
        foreach ($this->extensionPresence->findDeclarations($stubs, $this->lookupKind, $entityId) as $declaration) {
            if (!$this->extensionPresence->shipsWithPhp($declaration)) {
                continue;
            }
            if (!($declaration->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true)) {
                continue;
            }
            $directories[$this->extensionPresence->getDirectory($declaration)] = true;
        }

        if ($directories === []) {
            $results->addSuccess($entityId . ' (not declared for this version in an extension that ships with PHP)');
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        if ($this->extensionPresence->existsIn($reflection, $this->lookupKind, $entityId)) {
            $results->addSuccess($entityId);
            return $results;
        }

        foreach (array_keys($directories) as $directory) {
            if ($this->extensionPresence->isExtensionPresent($stubs, $reflection, $directory)) {
                $results->addFailure(
                    $entityId,
                    "{$this->label} {$entityId} is declared in stubs but does not exist in PHP {$phpVersion}"
                    . ' — add @removed if it was removed, @since if it was added later,'
                    . ' or delete it if PHP never defined it'
                );
                return $results;
            }
        }

        $results->addSuccess($entityId . ' (extension not loaded in the reflection data for this version)');
        return $results;
    }

    /**
     * Names that are stub-only on purpose and can never appear in reflection.
     *
     * - `PS_UNRESERVE_PREFIX_*` and the `___PHPSTORM_HELPERS` namespace: this project's
     *   workarounds for names that are reserved keywords, and for IDE-only types.
     * - `__CLASS__` and the other magic constants: resolved at compile time, never registered.
     */
    private function isIntentionallyStubOnly(string $entityId): bool
    {
        $name = ltrim($entityId, '\\');
        $shortName = substr(strrchr('\\' . $name, '\\'), 1);

        return str_starts_with($shortName, 'PS_UNRESERVE_PREFIX_')
            || str_starts_with($name, '___PHPSTORM_HELPERS\\')
            || preg_match('/^__[A-Z_]+__$/', $shortName) === 1;
    }
}
