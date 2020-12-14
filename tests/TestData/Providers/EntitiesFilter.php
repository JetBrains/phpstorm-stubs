<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use StubTests\Model\BasePHPElement;
use StubTests\Model\StubProblemType;

class EntitiesFilter
{
    /**
     * @param BasePHPElement[] $entities
     * @param int ...$problemTypes
     * @return BasePHPElement[]
     */
    public static function getFiltered(array $entities, int ...$problemTypes): array
    {
        $resultArray = [];
        $hasProblem = false;
        foreach ($entities as $entity) {
            foreach ($problemTypes as $problemType) {
                if ($entity->hasMutedProblem($problemType)) {
                    $hasProblem = true;
                }
            }
            if ($entity->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                $hasProblem = true;
            }
            if ($hasProblem) {
                $hasProblem = false;
            } else {
                $resultArray[] = $entity;
            }
        }

        return $resultArray;
    }
}
