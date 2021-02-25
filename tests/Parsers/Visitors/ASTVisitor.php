<?php
declare(strict_types=1);

namespace StubTests\Parsers\Visitors;

use Exception;
use PhpParser\Node;
use PhpParser\Node\Const_;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\NodeVisitorAbstract;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPDefineConstant;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPProperty;
use StubTests\Model\StubsContainer;
use StubTests\Parsers\Utils;

class ASTVisitor extends NodeVisitorAbstract
{
    public function __construct(protected StubsContainer $stubs,
                                protected bool $isStubCore = false,
                                public ?string $sourceFilePath = null)
    {
    }

    /**
     * @param Node $node
     * @return void
     * @throws Exception
     */
    public function enterNode(Node $node): void
    {
        if ($node instanceof Function_) {
            $function = (new PHPFunction())->readObjectFromStubNode($node);
            $function->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $function->stubBelongsToCore = true;
            }
            $this->stubs->addFunction($function);
        } elseif ($node instanceof Const_) {
            $constant = (new PHPConst())->readObjectFromStubNode($node);
            $constant->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $constant->stubBelongsToCore = true;
            }
            if ($constant->parentName === null) {
                $this->stubs->addConstant($constant);
            } elseif ($this->stubs->getClass($constant->parentName, $this->sourceFilePath) !== null) {
                $this->stubs->getClass($constant->parentName, $this->sourceFilePath)->constants[$constant->name] = $constant;
            } else {
                $this->stubs->getInterface($constant->parentName, $this->sourceFilePath)->constants[$constant->name] = $constant;
            }
        } elseif ($node instanceof FuncCall) {
            if ($node->name->parts[0] === 'define') {
                $constant = (new PHPDefineConstant())->readObjectFromStubNode($node);
                $constant->sourceFilePath = $this->sourceFilePath;
                if ($this->isStubCore) {
                    $constant->stubBelongsToCore = true;
                }
                $this->stubs->addConstant($constant);
            }
        } elseif ($node instanceof ClassMethod) {
            $method = (new PHPMethod())->readObjectFromStubNode($node);
            $method->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $method->stubBelongsToCore = true;
            }
            if ($this->stubs->getClass($method->parentName, $this->sourceFilePath) !== null) {
                $this->stubs->getClass($method->parentName, $this->sourceFilePath)->methods[$method->name] = $method;
            } else {
                $this->stubs->getInterface($method->parentName, $this->sourceFilePath)->methods[$method->name] = $method;
            }
        } elseif ($node instanceof Interface_) {
            $interface = (new PHPInterface())->readObjectFromStubNode($node);
            $interface->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $interface->stubBelongsToCore = true;
            }
            $this->stubs->addInterface($interface);
        } elseif ($node instanceof Class_) {
            $class = (new PHPClass())->readObjectFromStubNode($node);
            $class->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $class->stubBelongsToCore = true;
            }
            $this->stubs->addClass($class);
        } elseif ($node instanceof Node\Stmt\Property) {
            $property = (new PHPProperty())->readObjectFromStubNode($node);
            $property->sourceFilePath = $this->sourceFilePath;
            if ($this->isStubCore) {
                $property->stubBelongsToCore = true;
            }

            if ($this->stubs->getClass($property->parentName, $this->sourceFilePath) !== null) {
                $this->stubs->getClass($property->parentName, $this->sourceFilePath)->properties[$property->name] = $property;
            }
        }
    }

    /**
     * @param PHPInterface $interface
     * @return array
     * @throws RuntimeException
     */
    public function combineParentInterfaces(PHPInterface $interface): array
    {
        $parents = [];
        if (empty($interface->parentInterfaces)) {
            return $parents;
        }
        /**@var string $parentInterface */
        foreach ($interface->parentInterfaces as $parentInterface) {
            $parents[] = $parentInterface;
            if ($this->stubs->getInterface($parentInterface,
                    $interface->stubBelongsToCore ? null : $interface->sourceFilePath) !== null) {
                foreach ($this->combineParentInterfaces($this->stubs->getInterface($parentInterface,
                    $interface->stubBelongsToCore ? null : $interface->sourceFilePath)) as $value) {
                    $parents[] = $value;
                }
            }
        }
        return $parents;
    }

    /**
     * @param PHPClass $class
     * @return array
     * @throws RuntimeException
     */
    public function combineImplementedInterfaces(PHPClass $class): array
    {
        $interfaces = [];
        /**@var string $interface */
        foreach ($class->interfaces as $interface) {
            $interfaces[] = $interface;
            if ($this->stubs->getInterface($interface,
                    $class->stubBelongsToCore ? null : $class->sourceFilePath) !== null) {
                $interfaces[] = $this->stubs->getInterface($interface,
                    $class->stubBelongsToCore ? null : $class->sourceFilePath)->parentInterfaces;
            }
        }
        if ($class->parentClass === null) {
            return $interfaces;
        }
        if ($this->stubs->getClass($class->parentClass,
                $class->stubBelongsToCore ? null : $class->sourceFilePath) !== null) {
            $inherited = $this->combineImplementedInterfaces($this->stubs->getClass($class->parentClass,
                $class->stubBelongsToCore ? null : $class->sourceFilePath));
            $interfaces[] = Utils::flattenArray($inherited, false);
        }
        return $interfaces;
    }
}
