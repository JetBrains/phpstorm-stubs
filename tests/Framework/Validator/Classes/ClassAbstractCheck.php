<?php

namespace StubTests\Framework\Validator\Classes;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Validator\AbstractClassModifierCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Validates that the `abstract` modifier on a class in stubs matches reflection.
 */
class ClassAbstractCheck extends AbstractClassModifierCheck
{
    protected function getCheckName(): CheckType
    {
        return CheckType::CLASS_ABSTRACT;
    }

    protected function modifier(): string
    {
        return 'abstract';
    }

    protected function hasModifier(PHPClassLikeObject $entity): bool
    {
        return $entity instanceof PHPClass && $entity->isAbstract();
    }
}
