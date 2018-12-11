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
use StubTests\Parsers\Utils;
use function key_exists;

class ASTVisitor extends NodeVisitorAbstract
{
    public $stubs;

    public function __construct(array &$stubs)
    {
        $this->stubs = &$stubs;
        $this->stubs[PHPFunction::class] = [];
        $this->stubs[PHPConst::class] = [];
        $this->stubs[PHPClass::class] = [];
        $this->stubs[PHPInterface::class] = [];
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Function_) {
            $function = (new PHPFunction())->readObjectFromStubNode($node);
            $this->stubs[PHPFunction::class][$function->name] = $function;
        } elseif ($node instanceof Const_) {
            $constant = (new PHPConst())->readObjectFromStubNode($node);
            if ($constant->parentName === null) {
                $this->stubs[PHPConst::class][$constant->name] = $constant;
            } elseif (array_key_exists($constant->parentName, $this->stubs[PHPClass::class])) {
                $this->stubs[PHPClass::class][$constant->parentName]->constants[$constant->name] = $constant;
            } else {
                $this->stubs[PHPInterface::class][$constant->parentName]->constants[$constant->name] = $constant;
            }
        } elseif ($node instanceof FuncCall) {
            if ($node->name->parts[0] === 'define') {
                $constant = (new PHPDefineConstant())->readObjectFromStubNode($node);
                $this->stubs[PHPConst::class][$constant->name] = $constant;
            }
        } elseif ($node instanceof ClassMethod) {
            $method = (new PHPMethod())->readObjectFromStubNode($node);
            if (array_key_exists($method->parentName, $this->stubs[PHPClass::class])) {
                $this->stubs[PHPClass::class][$method->parentName]->methods[$method->name] = $method;
            } else {
                $this->stubs[PHPInterface::class][$method->parentName]->methods[$method->name] = $method;
            }
        } elseif ($node instanceof Interface_) {
            $interface = (new PHPInterface())->readObjectFromStubNode($node);
            $this->stubs[PHPInterface::class][$interface->name] = $interface;
        } elseif ($node instanceof Class_) {
            $class = (new PHPClass())->readObjectFromStubNode($node);
            $this->stubs[PHPClass::class][$class->name] = $class;
        }
    }

    public function combineParentInterfaces($interface): array
    {
        $parents = [];
        if (empty($interface->parentInterfaces)) {
            return $parents;
        }
        /**@var PHPInterface $parentInterface */
        foreach ($interface->parentInterfaces as $parentInterface) {
            $parents[] = $parentInterface;
            if (key_exists($parentInterface, $this->stubs[PHPInterface::class])) {
                /**@var PHPInterface $parentInterface */
                foreach ($this->combineParentInterfaces($this->stubs[PHPInterface::class][$parentInterface]) as $value) {
                    $parents[] = $value;
                }
            }
        }
        return $parents;
    }

    public function combineImplementedInterfaces($class): array
    {
        $interfaces = [];
        /**@var PHPInterface $interface */
        foreach ($class->interfaces as $interface) {
            $interfaces[] = $interface;
            if (key_exists($interface, $this->stubs[PHPInterface::class])) {
                $interfaces[] = $this->stubs[PHPInterface::class][$interface]->parentInterfaces;
            }
        }
        if ($class->parentClass === null) {
            return $interfaces;
        }
        if (key_exists($class->parentClass, $this->stubs[PHPClass::class])
            && $this->stubs[PHPClass::class][$class->parentClass] !== null
        ) {
            $inherited = $this->combineImplementedInterfaces($this->stubs[PHPClass::class][$class->parentClass]);
            $interfaces[] = Utils::flattenArray($inherited, false);
        }
        return $interfaces;
    }
}
