<?php

namespace StubTests\Framework\Parsers\Types;

/**
 * Resolves a type or class-like name written in a stub source to its fully qualified
 * name, using PHP name-resolution rules (imports + current namespace).
 *
 * Shared by {@see \StubTests\Framework\Parsers\Stubs\Types\TypeNodeConverter} (type hints)
 * and {@see \StubTests\Framework\Parsers\Stubs\StubClassParser} (parent class / interfaces)
 * so class references and type hints resolve identically.
 */
class TypeNameResolver
{
    private const BUILT_IN_TYPES = [
        'int', 'string', 'bool', 'float', 'array', 'object', 'mixed',
        'void', 'never', 'null', 'false', 'true', 'callable', 'iterable',
        'resource', 'self', 'parent', 'static',
    ];

    /**
     * @param string $name      The name as written in the stub source (e.g. "Result", "int", "LDAP\Result", "Attr")
     * @param array  $imports   Map of import aliases to fully qualified names
     * @param string $namespace Current namespace context (e.g. '\Dom' or '\\' for global)
     * @return string Fully qualified name with leading backslash (built-in types are returned as-is)
     */
    public function resolve(string $name, array $imports, string $namespace): string
    {
        // Built-in types don't need resolution.
        if (in_array(strtolower($name), self::BUILT_IN_TYPES, true)) {
            return $name;
        }

        // Already fully qualified.
        if (str_starts_with($name, '\\')) {
            return $name;
        }

        // Aliased/imported name (e.g. `use FFI\Exception;` then `extends Exception`).
        if (isset($imports[$name])) {
            $resolved = $imports[$name];
            return str_starts_with($resolved, '\\') ? $resolved : '\\' . $resolved;
        }

        // Qualified but not imported (contains a separator) — treat as global-qualified.
        if (str_contains($name, '\\')) {
            return '\\' . $name;
        }

        // Unqualified name resolves relative to the current namespace.
        return $namespace === '\\' ? '\\' . $name : $namespace . '\\' . $name;
    }
}
