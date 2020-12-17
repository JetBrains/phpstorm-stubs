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

    public static function getDeclaredSinceVersion(BasePHPElement $element): ?string
    {
        $allSinceVersions = self::getSinceVersionsFromPhpDoc($element);
        if ($element->sinceVersionFromAttribute !== null) {
            $allSinceVersions[] = $element->sinceVersionFromAttribute;
        }
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

    /**
     * @param BasePHPElement $element
     * @return array
     */
    private static function getSinceVersionsFromPhpDoc(BasePHPElement $element): array
    {
        $allSinceVersions = [];
        if (!empty($element->sinceTags)) {
            $allSinceVersions[] = array_map(fn(Since $tag) => $tag->getVersion(), $element->sinceTags);
        }
        return $allSinceVersions;
    }

    /**
     * @param PHPMethod|PHPConst $element
     * @return array
     */
    private static function getSinceVersionsFromParentClass(PHPMethod|PHPConst $element): array
    {
        $allSinceVersions = [];
        $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($element->parentName);
        if ($parentClass === null){
            $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($element->parentName);
        }
        if (!empty($parentClass->sinceTags)) {
            $allSinceVersions[] = array_map(fn(Since $tag) => $tag->getVersion(), $parentClass->sinceTags);
        }
        return $allSinceVersions;
    }
}
