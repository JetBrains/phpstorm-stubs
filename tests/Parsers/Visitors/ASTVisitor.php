<?php
declare(strict_types=1);

namespace StubTests\Parsers\Visitors;

use PhpParser\Node;
use PhpParser\Node\Const_;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\NodeVisitorAbstract;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPDefineConstant;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\StubsContainer;
use StubTests\Parsers\Utils;

class ASTVisitor extends NodeVisitorAbstract
{
    private $stubs;

    public function __construct(StubsContainer $stubs)
    {
        $this->stubs = $stubs;
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Function_) {
            $function = (new PHPFunction())->readObjectFromStubNode($node);
            $this->stubs->addFunction($function);
        } elseif ($node instanceof Const_) {
            $constant = (new PHPConst())->readObjectFromStubNode($node);
            if ($constant->parentName === null) {
                $this->stubs->addConstant($constant);
            } elseif ($this->stubs->getClass($constant->parentName) !== null) {
                $this->stubs->getClass($constant->parentName)->constants[$constant->name] = $constant;
            } else {
                $this->stubs->getInterface($constant->parentName)->constants[$constant->name] = $constant;
            }
        } elseif ($node instanceof FuncCall) {
            if ($node->name->parts[0] === 'define') {
                $constant = (new PHPDefineConstant())->readObjectFromStubNode($node);
                $this->stubs->addConstant($constant);
            }
        } elseif ($node instanceof ClassMethod) {
            $method = (new PHPMethod())->readObjectFromStubNode($node);
            if ($this->stubs->getClass($method->parentName) !== null) {
                $this->stubs->getClass($method->parentName)->methods[$method->name] = $method;
            } else {
                $this->stubs->getInterface($method->parentName)->methods[$method->name] = $method;
            }
        } elseif ($node instanceof Interface_) {
            $interface = (new PHPInterface())->readObjectFromStubNode($node);
            $this->stubs->addInterface($interface);
        } elseif ($node instanceof Class_) {
            $class = (new PHPClass())->readObjectFromStubNode($node);
            $this->stubs->addClass($class);
        }
    }

    public function combineParentInterfaces($interface): array
    {
        $parents = [];
        if (empty($interface->parentInterfaces)) {
            return $parents;
        }
        /**@var string $parentInterface */
        foreach ($interface->parentInterfaces as $parentInterface) {
            $parents[] = $parentInterface;
            if ($this->stubs->getInterface($parentInterface) !== null) {
                /**@var string $parentInterface */
                foreach ($this->combineParentInterfaces($this->stubs->getInterface($parentInterface)) as $value) {
                    $parents[] = $value;
                }
            }
        }
        return $parents;
    }

    public function combineImplementedInterfaces($class): array
    {
        $interfaces = [];
        /**@var string $interface */
        foreach ($class->interfaces as $interface) {
            $interfaces[] = $interface;
            if ($this->stubs->getInterface($interface) !== null) {
                $interfaces[] = $this->stubs->getInterface($interface)->parentInterfaces;
            }
        }
        if ($class->parentClass === null) {
            return $interfaces;
        }
        if ($this->stubs->getClass($class->parentClass) !== null) {
            $inherited = $this->combineImplementedInterfaces($this->stubs->getClass($class->parentClass));
            $interfaces[] = Utils::flattenArray($inherited, false);
        }
        return $interfaces;
    }
}
