<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeAbstract;

abstract class BasePHPElement
{
    public $name;
    public $parseError;

    /**
     * @param mixed $object
     *
     * @return mixed
     */
    abstract public function readObjectFromReflection($object);

    /**
     * @param mixed $node
     *
     * @return mixed
     */
    abstract public function readObjectFromStubNode($node);

    protected function getConstantFQN(NodeAbstract $node, string $nodeName): string
    {
        $namespace = '';
        if ($node->getAttribute('parent') instanceof Namespace_ && !empty($node->getAttribute('parent')->name)) {
            $namespace = '\\' . implode('\\', $node->getAttribute('parent')->name->parts) . '\\';
        }

        return $namespace . $nodeName;
    }

    protected function getFQN($node): string
    {
        $fqn = '';
        if ($node->namespacedName === null) {
            $fqn = $node->name->parts[0];
        } else {
            /**@var string $part*/
            foreach ($node->namespacedName->parts as $part) {
                $fqn .= "$part\\";
            }
        }
        return rtrim($fqn, "\\");
    }
}
