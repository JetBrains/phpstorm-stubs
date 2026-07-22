<?php

namespace StubTests\Framework\Validator\Classes;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;

/**
 * Validates that the target flags of an attribute class - declared in stubs via
 * `#[Attribute(...)]` - match reflection.
 *
 * PHP attributes carry a bitmask of the syntactic targets they may be applied to
 * (class, function, method, property, class constant, parameter, ...). This check
 * ensures the stub declaration lists exactly the same targets reflection reports,
 * so that a target added in a newer PHP version (for example `\Override` gaining
 * `TARGET_CLASS_CONSTANT` in PHP 8.6) is not silently missing from the stubs.
 *
 * Attributes are declared without version awareness in stubs, so - like the
 * constant-value checks - the comparison is only meaningful against the latest
 * PHP version and the check is registered for that version alone.
 */
class ClassAttributeTargetsCheck extends AbstractClassCheck
{
    /**
     * The composite `TARGET_ALL` value is intentionally excluded so that a missing
     * or default `#[Attribute]` (which defaults to all targets) is described in
     * terms of its individual atomic targets.
     */
    private const ATOMIC_TARGET_NAMES = [
        'TARGET_CLASS',
        'TARGET_FUNCTION',
        'TARGET_METHOD',
        'TARGET_PROPERTY',
        'TARGET_CLASS_CONSTANT',
        'TARGET_PARAMETER',
        'TARGET_CONSTANT',
    ];

    public function supports(string $phpVersion): bool
    {
        // Attributes were introduced in PHP 8.0.
        return version_compare($phpVersion, '8.0', '>=');
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, 'ClassAttributeTargetsCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $label = $this->getEntityLabel();

        $reflClass = $this->lookupEntityById($reflection, $entityId);
        if ($reflClass === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubClass = $this->lookupEntityById($stubs, $entityId);
        if ($stubClass === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        $reflTargets = $this->extractAttributeTargets($reflClass->getAttributes());
        $stubTargets = $this->extractAttributeTargets($stubClass->getAttributes());

        // Neither side marks this class as an attribute - nothing to validate.
        if ($reflTargets === null && $stubTargets === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        if ($reflTargets === null) {
            $results->addFailure(
                $entityId,
                "{$label} {$entityId} is marked #[Attribute] in stubs but is not an attribute in PHP {$phpVersion}"
            );
            return $results;
        }

        if ($stubTargets === null) {
            $results->addFailure(
                $entityId,
                "{$label} {$entityId} is an attribute in PHP {$phpVersion} but is not marked #[Attribute] in stubs"
            );
            return $results;
        }

        if ($reflTargets === $stubTargets) {
            $results->addSuccess($entityId);
            return $results;
        }

        $missing = $this->describeTargets($reflTargets & ~$stubTargets);
        $unexpected = $this->describeTargets($stubTargets & ~$reflTargets);

        $detail = [];
        if ($missing !== '') {
            $detail[] = "missing target(s) in stubs: {$missing}";
        }
        if ($unexpected !== '') {
            $detail[] = "unexpected target(s) in stubs: {$unexpected}";
        }

        $results->addFailure(
            $entityId,
            sprintf(
                '%s %s #[Attribute] targets mismatch in PHP %s (%s). Reflection allows %s, stubs declare %s',
                $label,
                $entityId,
                $phpVersion,
                implode('; ', $detail),
                $this->describeTargets($reflTargets),
                $this->describeTargets($stubTargets)
            )
        );

        return $results;
    }

    /**
     * Return the `#[Attribute(...)]` target bitmask for a class-like element, or null
     * when the element is not an attribute (i.e. carries no `#[Attribute]` marker).
     *
     * An `#[Attribute]` with no explicit flags defaults to `TARGET_ALL`, matching PHP.
     *
     * @param array<int, array{name: string, arguments: array}> $attributes
     */
    private function extractAttributeTargets(array $attributes): ?int
    {
        foreach ($attributes as $attribute) {
            $name = ltrim((string)($attribute['name'] ?? ''), '\\');
            if (strcasecmp($name, 'Attribute') !== 0) {
                continue;
            }

            $arguments = $attribute['arguments'] ?? [];
            // The flags are the single (first) constructor argument; support both the
            // positional and the named (`flags:`) form.
            if (array_key_exists(0, $arguments)) {
                return (int)$arguments[0];
            }
            if (array_key_exists('flags', $arguments)) {
                return (int)$arguments['flags'];
            }

            return $this->targetAll();
        }

        return null;
    }

    /**
     * Render a target bitmask as a human-readable `TARGET_*|TARGET_*` string.
     */
    private function describeTargets(int $flags): string
    {
        if ($flags === 0) {
            return 'none';
        }

        $parts = [];
        $covered = 0;
        foreach ($this->targetNameMap() as $bit => $targetName) {
            if (($flags & $bit) === $bit) {
                $parts[] = $targetName;
                $covered |= $bit;
            }
        }

        // Surface any bits not covered by the known target constants so nothing is hidden.
        $remaining = $flags & ~$covered;
        if ($remaining !== 0) {
            $parts[] = '0x' . dechex($remaining);
        }

        return $parts === [] ? (string)$flags : implode('|', $parts);
    }

    /**
     * Map of atomic target bit value => constant name, built for the current runtime so
     * that constants absent on older PHP versions are simply skipped.
     *
     * @return array<int, string>
     */
    private function targetNameMap(): array
    {
        $map = [];
        foreach (self::ATOMIC_TARGET_NAMES as $targetName) {
            $const = 'Attribute::' . $targetName;
            if (defined($const)) {
                $map[constant($const)] = $targetName;
            }
        }
        return $map;
    }

    private function targetAll(): int
    {
        return defined('Attribute::TARGET_ALL') ? \Attribute::TARGET_ALL : 63;
    }
}
