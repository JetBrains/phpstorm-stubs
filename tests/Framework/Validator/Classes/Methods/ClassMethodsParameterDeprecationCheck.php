<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Validator\AbstractMethodFlagCheck;

/**
 * Validates that parameters deprecated in reflection are also deprecated in stubs.
 *
 * For each class/interface/enum method the validator compares parameter deprecation
 * status between reflection and stubs. The check is one-directional:
 * reflection-deprecated → stub must be deprecated. The reverse is not enforced.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::{CLASS_TYPE|ENUM_TYPE|INTERFACE_TYPE} + entityId + 'ParameterDeprecationCheck'
 *   → skips all parameter deprecation checks for the entity.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ParameterDeprecationCheck'
 *   → skips only that specific method.
 */
class ClassMethodsParameterDeprecationCheck extends AbstractMethodFlagCheck
{
    protected function getCheckName(): string
    {
        return 'ParameterDeprecationCheck';
    }

    protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $reflParams = $reflMethod->getParameters();
        $stubParams = $this->methodCollection->filterAndDeduplicateParams($stubMethod->getParameters(), $phpVersion);

        // Build stub param map by name
        $stubParamsByName = [];
        foreach ($stubParams as $stubParam) {
            $stubParamsByName[$stubParam->getName()] = $stubParam;
        }

        $mismatches = [];
        foreach ($reflParams as $reflParam) {
            $reflName = $reflParam->getName();
            $reflDeprecated = $reflParam->isDeprecated();

            if (!$reflDeprecated) {
                continue;
            }

            if (!isset($stubParamsByName[$reflName])) {
                // Parameter absent from stubs — not our responsibility
                continue;
            }

            $stubDeprecated = $stubParamsByName[$reflName]->isDeprecated();

            if (!$stubDeprecated) {
                $mismatches[] = "\${$reflName}";
            }
        }

        if (empty($mismatches)) {
            return null;
        }

        return "Method {$methodEntityId}: parameter(s) deprecated in PHP {$phpVersion} but not in stubs: "
            . implode(', ', $mismatches);
    }
}
