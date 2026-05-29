<?php

namespace StubTests\Framework\Validator\Contracts;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\CheckInterface;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\ValidatorTestBase;

/**
 * Describes a validation check for declarative registration in ValidatorTestBase.
 *
 * @see ValidatorTestBase::getCheckDescriptors()
 */
final readonly class CheckDescriptor
{
    /**
     * @param class-string<CheckInterface> $checkClass The check class to instantiate
     * @param PhpVersions $fromVersion Earliest PHP version this check applies to
     * @param PhpVersions $toVersion Latest PHP version this check applies to
     * @param string $messageTemplate Assertion message template ({entityId}, {phpVersion} placeholders)
     * @param EntityTypeConfig|null $entityTypeConfig Optional config for entity-type-polymorphic checks
     */
    public function __construct(
        public string $checkClass,
        public PhpVersions $fromVersion,
        public PhpVersions $toVersion,
        public string $messageTemplate,
        public ?EntityTypeConfig $entityTypeConfig = null,
    ) {}
}
