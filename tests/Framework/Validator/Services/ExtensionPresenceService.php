<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\DataProvider\StubCategory;
use StubTests\Framework\Model\BasePHPElement;
use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\LookupKind;

/**
 * Answers the questions a stubs → reflection check needs before it may call a stub entity stale:
 * does the entity's extension ship with PHP, and was that extension loaded when the reflection
 * data for the version under test was generated?
 *
 * The second question has no direct answer, because the reflection caches do not record which
 * extension an entity belongs to. It is approximated from the stubs side: an extension counts as
 * present in a version when at least one top-level entity declared in its stub directory exists in
 * that version's reflection. That separates "the stub over-declares" from "the container never
 * loaded the extension" (snmp, com_dotnet, the SAPI directories), which otherwise dominates.
 *
 * Indexes are cached per storage object and shared across instances, for the same reason as
 * EntityLookupService: ValidatorTestBase builds a fresh check, and therefore a fresh service, for
 * every data-provider row.
 */
class ExtensionPresenceService
{
    /** The stub categories built from the PHP source tree, and so judgeable against reflection. */
    public const JUDGEABLE_CATEGORIES = [StubCategory::CORE, StubCategory::BUNDLED, StubCategory::EXTERNAL];

    /** @var \WeakMap<StubDataQueryInterface, array<string, mixed>>|null */
    private static ?\WeakMap $cache = null;

    public static function clearCache(): void
    {
        self::$cache = null;
    }

    /**
     * The top-level stub directory an entity is declared in, or null when no source is recorded.
     */
    public function getDirectory(BasePHPElement $entity): ?string
    {
        $sourcePath = $entity->getStubsMetadata()?->getSourcePath();
        if ($sourcePath === null) {
            return null;
        }

        return explode('/', ltrim($sourcePath, '/'))[0];
    }

    /**
     * Is the entity part of the PHP source tree, rather than a PECL or third-party extension?
     */
    public function shipsWithPhp(BasePHPElement $entity): bool
    {
        $directory = $this->getDirectory($entity);
        if ($directory === null) {
            // No recorded source — cannot establish that it ships with PHP, so do not judge it.
            return false;
        }

        foreach (self::JUDGEABLE_CATEGORIES as $category) {
            if ($category->containsDirectory($directory)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Every stub declaration with the given id. Stubs keep version-split declarations of the same
     * entity (one per @since/@removed range) as separate entries, so a lookup that returns only one
     * of them would misjudge the versions the others cover.
     *
     * Functions and class-likes match case-insensitively, like PHP; constants match exactly.
     *
     * @return list<BasePHPElement>
     */
    public function findDeclarations(StubDataQueryInterface $storage, LookupKind $kind, string $id): array
    {
        $index = $this->cached($storage, 'declarations:' . $kind->value, function () use ($storage, $kind): array {
            $index = [];
            foreach ($this->entitiesOfKind($storage, $kind) as $entity) {
                $entityId = $entity->getId();
                if ($entityId !== null) {
                    $index[$this->normalizeId($kind, $entityId)][] = $entity;
                }
            }
            return $index;
        });

        return $index[$this->normalizeId($kind, $id)] ?? [];
    }

    /**
     * Does the reflection storage contain an entity of this kind with this id?
     */
    public function existsIn(StubDataQueryInterface $reflection, LookupKind $kind, string $id): bool
    {
        return $this->findDeclarations($reflection, $kind, $id) !== [];
    }

    /**
     * Was the extension declared in this stub directory loaded when the reflection data was generated?
     */
    public function isExtensionPresent(StubDataQueryInterface $stubs, StubDataQueryInterface $reflection, string $directory): bool
    {
        // The answer depends on both storages, so it is cached per stubs storage and, within that,
        // per reflection storage.
        $presenceByReflection = $this->cached($stubs, 'presence', fn (): \WeakMap => new \WeakMap());
        $presence = $presenceByReflection[$reflection] ?? [];
        if (isset($presence[$directory])) {
            return $presence[$directory];
        }

        $entitiesByDirectory = $this->cached($stubs, 'byDirectory', function () use ($stubs): array {
            $byDirectory = [];
            foreach (LookupKind::cases() as $kind) {
                foreach ($this->entitiesOfKind($stubs, $kind) as $entity) {
                    $entityDirectory = $this->getDirectory($entity);
                    $entityId = $entity->getId();
                    if ($entityDirectory !== null && $entityId !== null) {
                        $byDirectory[$entityDirectory][] = [$kind, $entityId];
                    }
                }
            }
            return $byDirectory;
        });

        $present = false;
        foreach ($entitiesByDirectory[$directory] ?? [] as [$kind, $entityId]) {
            if ($this->existsIn($reflection, $kind, $entityId)) {
                $present = true;
                break;
            }
        }

        $presence[$directory] = $present;
        $presenceByReflection[$reflection] = $presence;

        return $present;
    }

    /**
     * Every entity of one kind in a storage.
     *
     * @return iterable<BasePHPElement>
     */
    public function entitiesOfKind(StubDataQueryInterface $storage, LookupKind $kind): iterable
    {
        return match ($kind) {
            LookupKind::CLASS_TYPE => $storage->getClasses(),
            LookupKind::INTERFACE_TYPE => $storage->getInterfaces(),
            LookupKind::ENUM_TYPE => $storage->getEnums(),
            LookupKind::FUNCTION => $storage->getFunctions(),
            LookupKind::CONSTANT => $storage->getConstants(),
        };
    }

    private function normalizeId(LookupKind $kind, string $id): string
    {
        return $kind === LookupKind::CONSTANT ? $id : strtolower($id);
    }

    private function cached(StubDataQueryInterface $storage, string $key, callable $build): mixed
    {
        self::$cache ??= new \WeakMap();
        $entry = self::$cache[$storage] ?? [];
        if (!array_key_exists($key, $entry)) {
            $entry[$key] = $build();
            self::$cache[$storage] = $entry;
        }

        return $entry[$key];
    }
}
