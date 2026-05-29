<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Services\EntityLookupService;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Services\MethodCollectionService;
use StubTests\Framework\Validator\Services\PhpDocConformanceService;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\Services\ReturnTypeResolver;

/**
 * Validates that PhpDoc types in class stubs are compatible with their signature types.
 *
 * This is a stubs-only check (reflection data is never used). For each class
 * identified by $entityId the validator:
 * 1. Looks up the class in stubs. If not found, silently succeeds.
 * 2. Iterates all version-available stub methods: checks return type and each
 *    parameter type for PhpDoc/signature compatibility.
 * 3. Iterates all version-available stub properties: checks declared type vs PhpDoc type.
 * 4. Reports mismatches where sig and PhpDoc types share no common component.
 *
 * Intentional patterns (typed-array narrowing, phpstan generics, resource widening,
 * bool/false split) are accepted by the algorithm and will not be reported.
 *
 * Known problems are supported at three granularities:
 * - entity-level: entityType + entityId + 'PhpDocConformsSignatureCheck'
 *   → skips all method/property checks for the entity.
 * - method-level: EntityType::METHOD + 'ClassName::methodName' + 'PhpDocConformsSignatureCheck'
 *   → skips only that specific method.
 * - property-level: EntityType::PROPERTY + 'ClassName::$propName' + 'PhpDocConformsSignatureCheck'
 *   → skips only that specific property.
 */
class ClassMethodsPhpDocConformsSignatureCheck extends AbstractClassCheck
{

    private PhpDocConformanceService $conformanceService;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?EntityLookupService $entityLookupService = null,
        ?MethodCollectionService $methodCollectionService = null,
        ?EntityTypeConfig $entityTypeConfig = null,
        ?PhpDocConformanceService $conformanceService = null
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry, $entityLookupService, $methodCollectionService, $entityTypeConfig);
        $this->conformanceService = $conformanceService ?? new PhpDocConformanceService();
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, 'PhpDocConformsSignatureCheck', $phpVersion)) {
            return $results;
        }

        $stubEntity = $this->lookupEntityById($stubs, $entityId);
        if ($stubEntity === null) {
            // Entity absent from stubs — ExistsCheck's responsibility
            $results->addSuccess($entityId);
            return $results;
        }

        $hasMismatch = false;

        // @template variable names declared on the entity (class/enum/interface).
        // These names are used to detect when a PhpDoc type is a type parameter rather than
        // a real class, so we can accept it as compatible with any signature type.
        $templateNames = $this->conformanceService->extractTemplateNames($stubEntity->getStubsMetadata()?->getPhpDoc());

        // Check methods
        foreach ($this->collectEntityMethodsByConfig($stubEntity, $phpVersion) as $methodName => $method) {
            $mismatches = $this->collectMethodMismatches($method, $phpVersion, $templateNames);

            if (empty($mismatches)) {
                continue;
            }

            $methodEntityId = $entityId . '::' . $methodName;
            $hasMismatch = true;

            if (!$this->skipWithKnownProblem($results, EntityType::METHOD->value, $methodEntityId, 'PhpDocConformsSignatureCheck', $phpVersion)) {
                $results->addFailure(
                    $methodEntityId,
                    "{$this->getEntityLabel()} {$methodEntityId} PhpDoc/signature type mismatch in PHP {$phpVersion}: "
                    . implode('; ', $mismatches)
                );
            }
        }

        // Check properties
        foreach ($this->collectEntityPropertiesByConfig($stubEntity, $phpVersion) as $propName => $property) {
            $sigType = $this->conformanceService->getPropertySigTypeForPhpDoc($property, $phpVersion);
            $docType = $property->getStubsMetadata()?->getTypeFromPhpDoc();

            if ($sigType === null || $sigType === '' || $docType === null || $docType === '') {
                continue;
            }

            if (!$this->conformanceService->isPhpDocCompatibleWithSignature($sigType, $docType, $templateNames)) {
                $propEntityId = $entityId . '::$' . $propName;
                $hasMismatch = true;

                if (!$this->skipWithKnownProblem($results, EntityType::PROPERTY->value, $propEntityId, 'PhpDocConformsSignatureCheck', $phpVersion)) {
                    $results->addFailure(
                        $propEntityId,
                        "{$this->getEntityLabel()} {$propEntityId} PhpDoc/signature type mismatch in PHP {$phpVersion}: sig '{$sigType}', phpdoc '{$docType}'"
                    );
                }
            }
        }

        if (!$hasMismatch) {
            $results->addSuccess($entityId);
        }

        return $results;
    }

    // ── Private helpers ────────────────────────────────────────────────────────

    /**
     * Collect PhpDoc/signature mismatches for a single method.
     * Returns an empty array when there are no mismatches.
     *
     * @param string[] $templateNames @template variable names declared on the enclosing entity
     * @return string[]
     */
    private function collectMethodMismatches(PHPMethod $method, string $phpVersion, array $templateNames = []): array
    {
        // Merge entity-level templates with any method-level @template declarations
        $allTemplateNames = array_merge($templateNames, $this->conformanceService->extractTemplateNames($method->getStubsMetadata()?->getPhpDoc()));

        $mismatches = [];

        // Return type
        $sigReturnType = ReturnTypeResolver::getReturnTypeString($method, $phpVersion);
        $docReturnType = $method->getStubsMetadata()?->getTypeFromPhpDoc();

        if ($sigReturnType !== null && $sigReturnType !== ''
            && $docReturnType !== null && $docReturnType !== ''
        ) {
            if (!$this->conformanceService->isPhpDocCompatibleWithSignature($sigReturnType, $docReturnType, $allTemplateNames)) {
                $mismatches[] = "return type: sig '{$sigReturnType}', phpdoc '{$docReturnType}'";
            }
        }

        // Parameters
        foreach ($this->conformanceService->filterAndDeduplicateParamsPhpDoc($method->getParameters(), $phpVersion) as $param) {
            $sigType = $this->conformanceService->getParamSigTypeForPhpDoc($param, $phpVersion);
            $docType = $param->getStubsMetadata()?->getTypeFromPhpDoc();

            if ($sigType === null || $sigType === '' || $docType === null || $docType === '') {
                continue;
            }

            if (!$this->conformanceService->isPhpDocCompatibleWithSignature($sigType, $docType, $allTemplateNames)) {
                $mismatches[] = "\${$param->getName()}: sig '{$sigType}', phpdoc '{$docType}'";
            }
        }

        return $mismatches;
    }
}
