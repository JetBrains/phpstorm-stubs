<?php
declare(strict_types=1);

namespace StubTests\Parsers;

use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use StubTests\Model\BasePHPElement;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPMethod;
use StubTests\Model\PhpVersions;
use StubTests\Model\Tags\RemovedTag;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class Utils
{
    public static function flattenArray(array $array, bool $group): array
    {
        return iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($array)), $group);
    }

    /**
     * @param Since|Deprecated|RemovedTag $tag
     * @return bool
     */
    public static function tagDoesNotHaveZeroPatchVersion(Since|RemovedTag|Deprecated $tag): bool
    {
        return (bool)preg_match('/^[1-9]+\.\d+(\.[1-9]+\d*)*$/', $tag->getVersion()); //find version like any but 7.4.0
    }

    public static function getDeclaredSinceVersion(BasePHPElement $element): null|string|float
    {
        $allSinceVersions = self::getSinceVersionsFromPhpDoc($element);
        $allSinceVersions[] = self::getSinceVersionsFromAttribute($element);
        if ($element instanceof PHPMethod) {
            if ($element->hasInheritDocTag || $element->parentName === '___PHPSTORM_HELPERS\object') {
                return null;
            }
            $allSinceVersions[] = self::getSinceVersionsFromParentClass($element);
        } elseif ($element instanceof PHPConst) {
            $allSinceVersions[] = self::getSinceVersionsFromParentClass($element);
        }
        $flattenedArray = Utils::flattenArray($allSinceVersions, false);
        sort($flattenedArray, SORT_DESC);
        return array_pop($flattenedArray);
    }

    public static function getLatestAvailableVersion(BasePHPElement $element): ?string
    {
        $latestVersions = self::getRemovedVersionsFromPhpDoc($element);
        $latestVersions[] = self::getLatestAvailableVersionsFromAttribute($element);
        if ($element instanceof PHPMethod) {
            if ($element->hasInheritDocTag || $element->parentName === '___PHPSTORM_HELPERS\object') {
                return null;
            }
            $latestVersions[] = self::getLatestAvailableVersionsFromParentClass($element);
        } elseif ($element instanceof PHPConst) {
            $latestVersions[] = self::getLatestAvailableVersionsFromParentClass($element);
        }
        $flattenedArray = Utils::flattenArray($latestVersions, false);
        sort($flattenedArray, SORT_DESC);
        return array_pop($flattenedArray);
    }

    public static function getAvailableInVersions(BasePHPElement $element): array
    {
        $firstSinceVersion = self::getDeclaredSinceVersion($element);
        if ($firstSinceVersion === null) {
            $firstSinceVersion = PhpVersions::getFirst();
        }
        $lastAvailableVersion = self::getLatestAvailableVersion($element);
        if ($lastAvailableVersion === null) {
            $lastAvailableVersion = PhpVersions::getLatest();
        }
        return array_filter(iterator_to_array(new PhpVersions()), fn($version) =>
            $version >= $firstSinceVersion && $version <= (float)$lastAvailableVersion);
    }

    /**
     * @param BasePHPElement $element
     * @return array
     */
    private static function getSinceVersionsFromPhpDoc(BasePHPElement $element): array
    {
        $allSinceVersions = [];
        if (!empty($element->sinceTags) && $element->stubBelongsToCore) {
            $allSinceVersions[] = array_map(fn(Since $tag) => $tag->getVersion(), $element->sinceTags);
        }
        return $allSinceVersions;
    }

    /**
     * @param BasePHPElement $element
     * @return array
     */
    private static function getRemovedVersionsFromPhpDoc(BasePHPElement $element): array
    {
        $allRemovedVersions = [];
        if (!empty($element->removedTags) && $element->stubBelongsToCore) {
            $allRemovedVersions[] = array_map(fn(RemovedTag $tag) => $tag->getVersion(), $element->removedTags);
        }
        return $allRemovedVersions;
    }

    /**
     * @param PHPMethod|PHPConst $element
     * @return array
     */
    private static function getSinceVersionsFromParentClass(PHPMethod|PHPConst $element): array
    {
        $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($element->parentName);
        if ($parentClass === null) {
            $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($element->parentName);
        }
        $allSinceVersions[] = self::getSinceVersionsFromPhpDoc($parentClass);
        $allSinceVersions[] = self::getSinceVersionsFromAttribute($parentClass);
        return $allSinceVersions;
    }

    public static function getLatestAvailableVersionsFromParentClass(PHPMethod|PHPConst $element): array
    {
        $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($element->parentName);
        if ($parentClass === null) {
            $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($element->parentName);
        }
        $allRemovedVersions[] = self::getRemovedVersionsFromPhpDoc($parentClass);
        $allRemovedVersions[] = self::getLatestAvailableVersionsFromAttribute($parentClass);
        return $allRemovedVersions;
    }

    /**
     * @param BasePHPElement $element
     * @return array
     */
    private static function getSinceVersionsFromAttribute(BasePHPElement $element): array
    {
        $allSinceVersions = [];
        if (!empty($element->availableVersionsRangeFromAttribute)) {
            $allSinceVersions[] = $element->availableVersionsRangeFromAttribute['from'];
        }
        return $allSinceVersions;
    }

    /**
     * @param BasePHPElement $element
     * @return array
     */
    private static function getLatestAvailableVersionsFromAttribute(BasePHPElement $element): array
    {
        $latestAvailableVersions = [];
        if (!empty($element->availableVersionsRangeFromAttribute)) {
            $latestAvailableVersions[] = (string)($element->availableVersionsRangeFromAttribute['to']);
        }
        return $latestAvailableVersions;
    }
}
