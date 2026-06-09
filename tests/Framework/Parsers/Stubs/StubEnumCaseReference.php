<?php

namespace StubTests\Framework\Parsers\Stubs;

/**
 * Placeholder for an enum-case value that the host runtime cannot materialize
 * because the declaring extension is not loaded in the cache-generating process
 * (e.g. ext-uri is absent on the Windows host that regenerates the cache).
 *
 * An enum-case default such as `\Uri\UriComparisonMode::ExcludeFragment` is
 * normally resolved at runtime via constant() to the enum instance, which the
 * serializer renders as "[object:Uri\UriComparisonMode]". When the extension is
 * missing, constant() fails and the case cannot be reconstructed (a pure enum
 * case has no scalar value). This reference carries the declaring enum's FQN so
 * the serializer can emit the identical, environment-independent string instead
 * of letting the default silently degrade to null.
 *
 * @see StubConstantRegistry
 * @see \StubTests\Framework\Parsers\Serializers\SerializerUtilsTrait
 */
final class StubEnumCaseReference
{
    /** Enum FQN without a leading backslash, matching get_class() of a real case. */
    private string $enumFqn;

    public function __construct(string $enumFqn)
    {
        $this->enumFqn = ltrim($enumFqn, '\\');
    }

    public function getEnumFqn(): string
    {
        return $this->enumFqn;
    }
}
