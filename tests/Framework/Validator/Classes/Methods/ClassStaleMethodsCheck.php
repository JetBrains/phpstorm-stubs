<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\DataProvider\StubCategory;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Validates that a method declared in stubs actually exists in reflection for the version under test.
 *
 * This is the only check in the suite that runs **stubs → reflection**. Every other one iterates the
 * reflection side and skips members absent from stubs — `ClassMethodsExistCheck` reduces to
 * `array_diff(reflectionMethods, stubMethods)`, and the attribute checks `continue` on any reflection
 * member missing from the stub map. A stub declaring a method the runtime does not have was therefore
 * visited by nothing: five `SplFixedArray` iterator methods, `DOMDocument::renameNode`,
 * `DOMText::replaceWholeText` and `ReflectionZendExtension::export` stayed unbounded past their
 * removal in PHP 8.0 while the full 412k-test suite passed. Reverting one of those annotations and
 * re-running the suite reproduced that: still green.
 *
 * ## Why the scope is narrow
 *
 * A general stubs → reflection check is not viable — measured, not assumed. Unscoped it reports 9,391
 * absent entities (63% of all stubs), dominated by 58 PECL extensions the container never loads; and
 * 91 of 93 stale *constants* are driver-contributed `PDO::{MYSQL_ATTR,SQLSRV,OCI,FB_ATTR}_*` that
 * reflection cannot judge. Three restrictions make the signal usable:
 *
 * 1. **Methods only.** Constants and properties are dominated by driver-contributed and dynamic
 *    members respectively.
 * 2. **{@see StubCategory::CORE} and {@see StubCategory::BUNDLED} only** — the same definition
 *    PhpDocValidatorTest uses for "core stubs". EXTERNAL and PECL extensions are frequently absent
 *    from the reflecting container, so their stub-only members say nothing about the stub.
 * 3. **Skip magic methods and `PS_UNRESERVE_PREFIX_*`.** Both are intentional stub-only
 *    declarations: PHP does not report `__wakeup`/`__sleep`/`__construct` on many internal classes
 *    even where they work, and the prefix is this project's workaround for methods whose real name
 *    is a reserved keyword (`Generator::throw`). These two account for 25 of the 57 otherwise-stale
 *    members.
 *
 * ## Own methods only, not the hierarchy
 *
 * This deliberately reads `$stubEntity->getMethods()` rather than
 * `collectEntityMethodsByConfig()`, which the other checks use. That helper walks parent classes and
 * interfaces, so an interface's own (correctly unbounded) `Iterator::rewind` would be attributed to
 * every implementor — reporting `SplFixedArray::rewind` again even after its class-level declaration
 * was bounded, and adding `SplObjectStorage::seek` from SeekableIterator. The question here is
 * specifically "does the stub file that declares this method on this class over-declare it", so only
 * own declarations are considered.
 *
 * A class the reflecting runtime does not have at all is skipped: that is
 * {@see \StubTests\Framework\Validator\EntityExistsCheck}'s subject, and judging its members here
 * would report every one of them.
 *
 * Remaining legitimate exceptions are carried as known problems rather than as more code — chiefly
 * PDO's driver-conditional methods and `SimpleXMLElement`'s ArrayAccess members, which PHP implements
 * through internal handlers rather than declared methods.
 */
class ClassStaleMethodsCheck extends AbstractClassCheck
{
    /** The stub categories that ship with PHP itself, and so can be judged against reflection. */
    private const JUDGEABLE_CATEGORIES = [StubCategory::CORE, StubCategory::BUNDLED];

    protected function getCheckName(): CheckType
    {
        return CheckType::CLASS_STALE_METHODS;
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, $this->getCheckName(), $phpVersion)) {
            return $results;
        }

        $stubEntity = $this->lookupEntityById($stubs, $entityId);
        if ($stubEntity === null) {
            $results->addFailure($entityId, "{$this->getEntityLabel()} {$entityId} not found in stubs");
            return $results;
        }

        if (!$this->shipsWithPhp($stubEntity)) {
            $results->addSuccess($entityId . ' (not a core or bundled extension)');
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $reflectionEntity = $this->lookupEntityById($reflection, $entityId);
        if ($reflectionEntity === null) {
            // The class itself is absent — EntityExistsCheck's subject, not ours.
            $results->addSuccess($entityId . ' (class not present in reflection for this version)');
            return $results;
        }

        $reflectionMethods = [];
        foreach ($reflectionEntity->getMethods() as $method) {
            $name = $method->getName();
            if ($name !== null) {
                $reflectionMethods[strtolower($name)] = true;
            }
        }

        $stale = [];
        foreach ($stubEntity->getMethods() as $stubMethod) {
            $methodName = $stubMethod->getName();
            if ($methodName === null || $this->isIntentionallyStubOnly($methodName)) {
                continue;
            }
            if (!($stubMethod->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true)) {
                continue;
            }
            if (!isset($reflectionMethods[strtolower($methodName)])) {
                $stale[] = $methodName;
            }
        }

        if (empty($stale)) {
            $results->addSuccess($entityId);
            return $results;
        }

        sort($stale);
        foreach ($stale as $methodName) {
            $methodEntityId = $entityId . '::' . $methodName;

            if (!$this->skipWithKnownProblem($results, EntityType::METHOD->value, $methodEntityId, $this->getCheckName(), $phpVersion)) {
                $results->addFailure(
                    $methodEntityId,
                    "Method {$methodEntityId} is declared in stubs but does not exist in PHP {$phpVersion}"
                    . ' — add @removed (or a #[PhpStormStubsElementAvailable] bound) if it was removed,'
                    . ' or @since if it was added later'
                );
            }
        }

        return $results;
    }

    /**
     * Is this entity part of the PHP distribution, rather than an EXTERNAL/PECL extension?
     */
    private function shipsWithPhp(object $stubEntity): bool
    {
        $sourcePath = $stubEntity->getStubsMetadata()?->getSourcePath();
        if ($sourcePath === null) {
            // No recorded source — cannot establish that it ships with PHP, so do not judge it.
            return false;
        }

        $topLevelDirectory = explode('/', ltrim($sourcePath, '/'))[0];

        foreach (self::JUDGEABLE_CATEGORIES as $category) {
            if ($category->containsDirectory($topLevelDirectory)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Methods that stubs declare on purpose even though reflection does not report them.
     *
     * - `__*`: PHP omits magic methods from many internal classes (hidden `__construct` on opaque
     *   handles such as `CurlHandle`, `__wakeup`/`__serialize` on `GMP`), yet stubs must declare them
     *   for completion and for serialization diagnostics.
     * - `PS_UNRESERVE_PREFIX_*`: this project's workaround for a method whose real name is a reserved
     *   keyword, e.g. `Generator::throw`. No such method can ever appear in reflection under the
     *   prefixed name.
     */
    private function isIntentionallyStubOnly(string $methodName): bool
    {
        return str_starts_with($methodName, '__')
            || str_starts_with($methodName, 'PS_UNRESERVE_PREFIX_');
    }
}
