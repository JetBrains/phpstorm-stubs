<?php

namespace StubTests\Framework\Validator\Classes;

use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Validator\AbstractClassModifierCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Validates that the `readonly` modifier on a class in stubs matches reflection.
 */
class ClassReadonlyCheck extends AbstractClassModifierCheck
{
    public function supports(string $phpVersion): bool
    {
        // Readonly classes were introduced in PHP 8.2
        return version_compare($phpVersion, '8.2', '>=');
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::CLASS_READONLY;
    }

    protected function modifier(): string
    {
        return 'readonly';
    }

    protected function hasModifier(PHPClassLikeObject $entity): bool
    {
        return $entity->isReadonly();
    }
}
