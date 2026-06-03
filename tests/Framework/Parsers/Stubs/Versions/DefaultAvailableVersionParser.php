<?php

namespace StubTests\Framework\Parsers\Stubs\Versions;

use StubTests\Framework\Parsers\Stubs\PhpDoc\ParsedPhpDoc;
use StubTests\Framework\Parsers\Stubs\Nodes\AttributeNode;
use StubTests\Framework\Runner\PhpVersions;

/**
 * Default implementation of available version parser.
 *
 * Merges version information from PhpDoc tags (@since/@removed) and attributes
 * (PhpStormStubsElementAvailable), with attributes taking precedence.
 */
class DefaultAvailableVersionParser implements AvailableVersionParserInterface
{
    /**
     * @inheritDoc
     */
    public function parseAvailableVersion(ParsedPhpDoc $phpDoc, array $attributes, array $imports = []): array
    {
        // Start with PhpDoc versions
        $sinceVersion = $phpDoc->sinceVersion;
        $removedVersion = $phpDoc->removedVersion;

        // Override with attribute values if present (attributes take precedence)
        $availability = $this->parsePhpStormStubsElementAvailable($attributes, $imports);
        if ($availability['from'] !== null) {
            $sinceVersion = $availability['from'];
        }
        if ($availability['to'] !== null) {
            // ElementAvailable(to: X.Y) is inclusive: the element IS available in X.Y.
            // removedVersion semantics use exclusive comparison (< removedVersion),
            // so convert X.Y → nextPhpVersion(X.Y) to keep filter logic uniform.
            $removedVersion = $this->nextPhpVersion($availability['to']);
        }

        return [
            'sinceVersion' => $sinceVersion,
            'removedVersion' => $removedVersion,
        ];
    }

    /**
     * Parse PhpStormStubsElementAvailable attribute to extract from/to versions.
     * Returns ['from' => version|null, 'to' => version|null].
     *
     * @param array $attributes Array of AttributeNode objects
     * @param array $imports Map of import aliases to fully qualified names
     * @return array ['from' => string|null, 'to' => string|null]
     */
    private function parsePhpStormStubsElementAvailable(array $attributes, array $imports): array
    {
        $result = ['from' => null, 'to' => null];

        foreach ($attributes as $attribute) {
            if (!($attribute instanceof AttributeNode)) {
                continue;
            }

            $name = $attribute->getName();

            // Resolve the attribute name through imports if it's an alias
            $fullName = $this->resolveAttributeName($name, $imports);

            if ($this->isPhpStormStubsElementAvailable($fullName)) {
                $args = $attribute->getArguments();

                // Extract 'from' parameter
                if (isset($args['from'])) {
                    $result['from'] = (string)$args['from'];
                } elseif (isset($args[0])) {
                    $result['from'] = (string)$args[0];
                }

                // Extract 'to' parameter
                if (isset($args['to'])) {
                    $result['to'] = (string)$args['to'];
                } elseif (isset($args[1])) {
                    $result['to'] = (string)$args[1];
                }

                break; // Only process the first matching attribute
            }
        }

        return $result;
    }

    /**
     * Resolve an attribute name through imports.
     * If the name is an alias, returns the fully qualified name.
     * Otherwise, returns the name as-is.
     *
     * @param string $name Attribute name (may be alias or FQN)
     * @param array $imports Map of import aliases to fully qualified names
     * @return string Fully qualified attribute name or original name
     */
    private function resolveAttributeName(string $name, array $imports): string
    {
        // If it's an alias in the imports map, resolve it
        if (isset($imports[$name])) {
            return $imports[$name];
        }

        // Already fully qualified or not aliased
        return $name;
    }

    /**
     * Return the next known PHP version after $version.
     * If $version is not a known version or is the last one, fall back to incrementing the minor part.
     */
    private function nextPhpVersion(string $version): string
    {
        $versions = array_map(fn (PhpVersions $v) => $v->value, PhpVersions::cases());
        $idx = array_search($version, $versions, true);
        if ($idx !== false && $idx < count($versions) - 1) {
            return $versions[$idx + 1];
        }
        [$major, $minor] = explode('.', $version, 2);
        return $major . '.' . ((int)$minor + 1);
    }

    /**
     * Check if a fully qualified name represents PhpStormStubsElementAvailable.
     *
     * @param string $fullName Fully qualified attribute name
     * @return bool True if this is the PhpStormStubsElementAvailable attribute
     */
    private function isPhpStormStubsElementAvailable(string $fullName): bool
    {
        // Check for exact matches with various forms of the attribute name
        return $fullName === 'JetBrains\\PhpStorm\\Internal\\PhpStormStubsElementAvailable' ||
               $fullName === 'PhpStormStubsElementAvailable' ||
               // Handle cases where the name might end with the class name
               str_ends_with($fullName, '\\PhpStormStubsElementAvailable');
    }
}
