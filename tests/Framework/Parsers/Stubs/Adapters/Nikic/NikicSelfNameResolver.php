<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Node;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\NodeVisitorAbstract;

/**
 * Resolves `self` in class constant fetches (`$mode = self::LEAVES_ONLY`) to the enclosing
 * class, recorded in the same resolvedName attribute NameResolver sets on other class names.
 *
 * NameResolver leaves `self` as it is, since it does not track the enclosing class. Must run
 * after it in the same traversal: it reads the namespacedName NameResolver gives each class.
 */
class NikicSelfNameResolver extends NodeVisitorAbstract
{
    /** @var array<int, Name|null> namespaced names of the enclosing class-likes, innermost last */
    private array $classes = [];

    public function enterNode(Node $node): null
    {
        if ($node instanceof ClassLike) {
            $this->classes[] = $node->namespacedName;
        } elseif ($node instanceof ClassConstFetch
            && $node->class instanceof Name
            && $node->class->toLowerString() === 'self'
            && end($this->classes) instanceof Name
        ) {
            $node->class->setAttribute('resolvedName', new FullyQualified(end($this->classes)));
        }
        return null;
    }

    public function leaveNode(Node $node): null
    {
        if ($node instanceof ClassLike) {
            array_pop($this->classes);
        }
        return null;
    }
}
