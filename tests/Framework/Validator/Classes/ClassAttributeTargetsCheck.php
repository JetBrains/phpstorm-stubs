<?php

namespace StubTests\Framework\Validator\Classes;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;

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

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, CheckType::CLASS_ATTRIBUTE_TARGETS, $phpVersion)) {
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

        // Target constants are resolved from the reflection data for the version under test,
        // never from the runtime running the suite: TARGET_ALL grew from 63 to 127 when
        // TARGET_CONSTANT was added in 8.5, so a runtime-derived table would be wrong for
        // any other version.
        $targetMap = $this->attributeTargetMap($reflection);

        $refl = $this->extractAttributeTargets($reflClass->getAttributes(), $targetMap);
        $stub = $this->extractAttributeTargets($stubClass->getAttributes(), $targetMap);

        // Neither side marks this class as an attribute - nothing to validate.
        if ($refl === null && $stub === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        // Flags that could not be resolved to a bitmask must never be compared: casting a
        // symbolic value such as "1|Attribute::TARGET_CONSTANT" with (int) silently yields 1
        // and produces a bogus "missing target(s)" report. Fail with the raw value instead.
        foreach ([['reflection', $refl], ['stubs', $stub]] as [$side, $extracted]) {
            if ($extracted !== null && $extracted['flags'] === null) {
                $results->addFailure(
                    $entityId,
                    sprintf(
                        '%s %s: could not resolve #[Attribute] flags from %s (%s). '
                        . 'Add the missing target constant to the map or fix the stub declaration.',
                        $label,
                        $entityId,
                        $side,
                        var_export($extracted['raw'], true)
                    )
                );
                return $results;
            }
        }

        $reflTargets = $refl === null ? null : $refl['flags'];
        $stubTargets = $stub === null ? null : $stub['flags'];

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

        $missing = $this->describeTargets($reflTargets & ~$stubTargets, $targetMap);
        $unexpected = $this->describeTargets($stubTargets & ~$reflTargets, $targetMap);

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
                $this->describeTargets($reflTargets, $targetMap),
                $this->describeTargets($stubTargets, $targetMap)
            )
        );

        return $results;
    }

    /**
     * Return the `#[Attribute(...)]` target flags for a class-like element.
     *
     * Returns null when the element is not an attribute (carries no `#[Attribute]` marker).
     * Otherwise returns `['flags' => int|null, 'raw' => mixed]`, where `flags` is null when
     * the declared value could not be resolved to a bitmask — the caller must treat that as
     * a failure rather than comparing it.
     *
     * An `#[Attribute]` with no explicit flags defaults to `TARGET_ALL`, matching PHP.
     *
     * @param array<int, array{name: string, arguments: array}> $attributes
     * @param array<string, int> $targetMap Constant name => bit, for the version under test
     * @return array{flags: int|null, raw: mixed}|null
     */
    private function extractAttributeTargets(array $attributes, array $targetMap): ?array
    {
        foreach ($attributes as $attribute) {
            $name = ltrim((string)($attribute['name'] ?? ''), '\\');
            if (strcasecmp($name, 'Attribute') !== 0) {
                continue;
            }

            $arguments = $attribute['arguments'] ?? [];
            // The flags are the single (first) constructor argument; support both the
            // positional and the named (`flags:`) form.
            foreach ([0, 'flags'] as $key) {
                if (array_key_exists($key, $arguments)) {
                    return [
                        'flags' => $this->resolveFlags($arguments[$key], $targetMap),
                        'raw' => $arguments[$key],
                    ];
                }
            }

            $all = $targetMap['TARGET_ALL'] ?? null;
            return ['flags' => $all, 'raw' => '#[Attribute] (no explicit flags)'];
        }

        return null;
    }

    /**
     * Resolve a declared flags value to a bitmask, or null when it cannot be resolved.
     *
     * The stub parser evaluates `Attribute::TARGET_*` against the runtime that parsed the
     * stubs, and falls back to the symbolic name — or a `"left|right"` string — whenever a
     * constant is not defined there. Those strings must be resolved properly: `(int)` on
     * them yields 0, or worse, silently truncates `"1|Attribute::TARGET_CONSTANT"` to 1.
     *
     * @param array<string, int> $targetMap
     */
    private function resolveFlags(mixed $value, array $targetMap): ?int
    {
        if (is_int($value)) {
            return $value;
        }

        if (!is_string($value) || trim($value) === '') {
            return null;
        }

        $flags = 0;
        foreach (explode('|', $value) as $part) {
            $part = trim($part);
            if ($part === '') {
                return null;
            }

            if (preg_match('/^\d+$/', $part) === 1) {
                $flags |= (int)$part;
                continue;
            }

            // Accept both `Attribute::TARGET_X` and a bare `TARGET_X`.
            $constant = str_contains($part, '::') ? substr($part, strrpos($part, '::') + 2) : $part;
            if (!array_key_exists($constant, $targetMap)) {
                return null;
            }
            $flags |= $targetMap[$constant];
        }

        return $flags;
    }

    /**
     * Attribute target constants for the PHP version under test, read from reflection data
     * rather than the current runtime.
     *
     * @return array<string, int>
     */
    private function attributeTargetMap(StubDataQueryInterface $reflection): array
    {
        $attributeClass = $this->findClassById($reflection, '\\Attribute');

        $map = [];
        foreach ($attributeClass?->getConstants() ?? [] as $constant) {
            $value = $constant->getValue();
            if (is_int($value)) {
                $map[$constant->getName()] = $value;
            }
        }

        if ($map !== []) {
            return $map;
        }

        // Reflection has no \Attribute (e.g. pre-8.0 data): fall back to the runtime so the
        // check degrades to its previous behaviour rather than failing outright.
        foreach (self::ATOMIC_TARGET_NAMES as $targetName) {
            if (defined('Attribute::' . $targetName)) {
                $map[$targetName] = constant('Attribute::' . $targetName);
            }
        }
        if (defined('Attribute::TARGET_ALL')) {
            $map['TARGET_ALL'] = \Attribute::TARGET_ALL;
        }

        return $map;
    }

    /**
     * Render a target bitmask as a human-readable `TARGET_*|TARGET_*` string.
     *
     * @param array<string, int> $targetMap Constant name => bit, for the version under test
     */
    private function describeTargets(int $flags, array $targetMap): string
    {
        if ($flags === 0) {
            return 'none';
        }

        $parts = [];
        $covered = 0;
        foreach (self::ATOMIC_TARGET_NAMES as $targetName) {
            $bit = $targetMap[$targetName] ?? null;
            if ($bit !== null && ($flags & $bit) === $bit) {
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
}
