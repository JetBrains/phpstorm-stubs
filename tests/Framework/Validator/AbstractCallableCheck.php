<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\Services\EntityLookupService;

/**
 * Base class for checks that look up functions or methods by their entity ID.
 *
 * Provides findCallable() which handles both "functionName" and "ClassName::methodName"
 * formats, and correctly selects the version-appropriate overload when multiple
 * function definitions exist for the same ID.
 */
abstract class AbstractCallableCheck extends AbstractReflectionCheck
{
    protected EntityLookupService $entityLookup;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?EntityLookupService $entityLookup = null
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry);
        $this->entityLookup = $entityLookup ?? new EntityLookupService();
    }

    /**
     * Find a function or method in the given storage.
     *
     * @param string $entityId Format: "functionName" or "ClassName::methodName"
     */
    protected function findCallable(StubDataQueryInterface $storage, string $entityId, string $phpVersion): ?PHPFunction
    {
        if (str_contains($entityId, '::')) {
            [$className, $methodName] = explode('::', $entityId, 2);

            $class = $this->entityLookup->findClassById($storage, $className);
            if ($class === null) {
                return null;
            }

            foreach ($class->getMethods() as $method) {
                if ($method->getName() === $methodName) {
                    return $method;
                }
            }
            return null;
        }

        return $this->findVersionedFunction($storage, $entityId, $phpVersion);
    }

    /**
     * Find the version-appropriate function definition from storage.
     *
     * When multiple definitions exist with different #[PhpStormStubsElementAvailable]
     * attributes, returns the one available for the given PHP version.
     */
    private function findVersionedFunction(StubDataQueryInterface $storage, string $functionId, string $phpVersion): ?PHPFunction
    {
        $candidates = [];

        foreach ($storage->getFunctions() as $function) {
            if ($function->getId() === $functionId || $function->getName() === $functionId) {
                $candidates[] = $function;
            }
        }

        if (empty($candidates)) {
            return null;
        }

        if (count($candidates) === 1) {
            return $candidates[0];
        }

        // Multiple candidates — pick the one available for the target PHP version
        foreach ($candidates as $candidate) {
            if ($candidate->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true) {
                return $candidate;
            }
        }

        return $candidates[0];
    }
}
