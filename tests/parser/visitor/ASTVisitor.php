<?php
declare(strict_types=1);

namespace Parsers\Visitor;

use Model\PHPClass;
use Model\PHPConst;
use Model\PHPDefineConstant;
use Model\PHPFunction;
use Model\PHPInterface;
use Model\PHPMethod;
use PhpParser\Node;
use PhpParser\Node\{Const_, Expr\FuncCall, Stmt\Class_, Stmt\ClassMethod, Stmt\Function_, Stmt\Interface_};
use PhpParser\NodeVisitorAbstract;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use function array_push;
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
            if ($constant->parentName == null) {
                $this->stubs[PHPConst::class][$constant->name] = $constant;
            } else {
                if (array_key_exists($constant->parentName, $this->stubs[PHPClass::class])) {
                    $this->stubs[PHPClass::class][$constant->parentName]->constants[$constant->name] = $constant;
                } else {
                    $this->stubs[PHPInterface::class][$constant->parentName]->constants[$constant->name] = $constant;
                }
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
        } else {
            foreach ($interface->parentInterfaces as $parentInterface) {
                array_push($parents, $parentInterface);
                if (key_exists($parentInterface, $this->stubs[PHPInterface::class])) {
                    foreach ($this->combineParentInterfaces($this->stubs[PHPInterface::class][$parentInterface]) as $value) {
                        array_push($parents, $value);
                    }
                }
            }
        }

        return $parents;
    }

    public function combineImplementedInterfaces($class): array
    {
        $interfaces = [];
        foreach ($class->interfaces as $interface) {
            array_push($interfaces, $interface);
            if (key_exists($interface, $this->stubs[PHPInterface::class])) {
                array_push($interfaces, $this->stubs[PHPInterface::class][$interface]->parentInterfaces);
            }
        }
        if ($class->parentClass == null) {
            return $interfaces;
        } else {
            if (key_exists($class->parentClass,
                    $this->stubs[PHPClass::class]) && $this->stubs[PHPClass::class][$class->parentClass] != null) {
                $inherited = $this->combineImplementedInterfaces($this->stubs[PHPClass::class][$class->parentClass]);
                array_push($interfaces, self::flattenArray($inherited));
            }
        }
        return $interfaces;
    }

    public static function flattenArray(array $arr)
    {
        return iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($arr)), false);
    }

}

