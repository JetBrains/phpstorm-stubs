<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Model\PHPClassLikeObject;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Base for entity-level final-flag checks.
 *
 * Compares the `isFinal` property of an entity in stubs against its reflection
 * counterpart and reports a failure on any mismatch.
 *
 * Pass an EntityTypeConfig to target a different entity type (e.g. enums);
 * the defaults work for classes.
 */
abstract class AbstractFinalCheck extends AbstractClassModifierCheck
{
    protected function getCheckName(): CheckType
    {
        return CheckType::CLASS_FINAL;
    }

    protected function modifier(): string
    {
        return 'final';
    }

    protected function hasModifier(PHPClassLikeObject $entity): bool
    {
        return $entity->isFinal();
    }
}
