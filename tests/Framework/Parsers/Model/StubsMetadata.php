<?php

namespace StubTests\Framework\Parsers\Model;

final class StubsMetadata
{
    private ?string $sourcePath = null;
    /** @var string[] */
    private array $duplicates = [];
    private ?string $phpDoc = null;
    private ?string $sinceVersion = null;
    private ?string $removedVersion = null;
    private ?array $languageLevelTypes = null;
    private ?string $defaultType = null;
    private ?string $typeFromPhpDoc = null;

    public function getSourcePath(): ?string
    {
        return $this->sourcePath;
    }

    public function setSourcePath(?string $sourcePath): void
    {
        $this->sourcePath = $sourcePath;
    }

    public function getDuplicates(): array
    {
        return $this->duplicates;
    }

    public function setDuplicates(array $duplicates): void
    {
        $this->duplicates = $duplicates;
    }

    public function addDuplicate(string $sourcePath): void
    {
        if (!in_array($sourcePath, $this->duplicates, true)) {
            $this->duplicates[] = $sourcePath;
        }
    }

    public function getPhpDoc(): ?string
    {
        return $this->phpDoc;
    }

    public function setPhpDoc(?string $phpDoc): void
    {
        $this->phpDoc = $phpDoc;
    }

    public function getSinceVersion(): ?string
    {
        return $this->sinceVersion;
    }

    public function setSinceVersion(?string $sinceVersion): void
    {
        $this->sinceVersion = $sinceVersion;
    }

    public function getRemovedVersion(): ?string
    {
        return $this->removedVersion;
    }

    public function setRemovedVersion(?string $removedVersion): void
    {
        $this->removedVersion = $removedVersion;
    }

    public function getLanguageLevelTypes(): ?array
    {
        return $this->languageLevelTypes;
    }

    public function setLanguageLevelTypes(?array $languageLevelTypes): void
    {
        $this->languageLevelTypes = $languageLevelTypes;
    }

    public function getDefaultType(): ?string
    {
        return $this->defaultType;
    }

    public function setDefaultType(?string $defaultType): void
    {
        $this->defaultType = $defaultType;
    }

    public function getTypeFromPhpDoc(): ?string
    {
        return $this->typeFromPhpDoc;
    }

    public function setTypeFromPhpDoc(?string $typeFromPhpDoc): void
    {
        $this->typeFromPhpDoc = $typeFromPhpDoc;
    }

    /**
     * Check if this element is available in the given PHP version.
     *
     * An element is available when:
     * - sinceVersion is null OR phpVersion >= sinceVersion
     * - AND removedVersion is null OR phpVersion < removedVersion
     */
    public function isAvailableIn(string $phpVersion): bool
    {
        return ($this->sinceVersion === null || version_compare($phpVersion, $this->sinceVersion, '>='))
            && ($this->removedVersion === null || version_compare($phpVersion, $this->removedVersion, '<'));
    }
}
