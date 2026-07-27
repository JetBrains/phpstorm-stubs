<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;

/**
 * Renders a class-like reference (parent class, implemented interface, parent interface)
 * while preserving whether the source wrote it fully qualified.
 *
 * `Name::toString()` drops the leading separator, so `extends \Countable` and
 * `extends Countable` both come through as "Countable". Downstream, TypeNameResolver then
 * treats the qualified form as namespace-relative and produces ids such as
 * `\Dom\Countable`. Those ids are wrong, and while ClassHierarchyResolver currently
 * repairs them through its short-name fallback, the repair picks the *global* interface —
 * which is the same failure mode that made `MongoDB\BSON\Persistable` resolve its
 * `Serializable` parent to the global `\Serializable` (see the interface serializer).
 *
 * Keeping the leading separator lets TypeNameResolver short-circuit on "already fully
 * qualified" and yields the id the source actually meant.
 */
trait NikicClassLikeNameTrait
{
    /**
     * @param Name $name Reference as parsed from the source
     * @return string The name, with a leading "\" when the source wrote it fully qualified
     */
    private function classLikeName(Name $name): string
    {
        return $name instanceof FullyQualified
            ? '\\' . $name->toString()
            : $name->toString();
    }
}
