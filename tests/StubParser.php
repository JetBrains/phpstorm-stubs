<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use phpDocumentor\Reflection\DocBlockFactory;
use PhpParser\Node;
use PhpParser\Node\{
    Const_, Expr\FuncCall, FunctionLike, Stmt\Class_, Stmt\ClassMethod, Stmt\Function_, Stmt\Namespace_
};

use PhpParser\NodeAbstract;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;

/**
 * The visitor is required to provide "parent" attribute to nodes
 */
class ParentConnector extends NodeVisitorAbstract
{
    private $stack;

    public function beforeTraverse(array $nodes)
    {
        $this->stack = [];
    }

    public function enterNode(Node $node)
    {
        if (!empty($this->stack)) {
            $node->setAttribute('parent', $this->stack[count($this->stack) - 1]);
        }
        $this->stack[] = $node;
    }

    public function leaveNode(Node $node)
    {
        array_pop($this->stack);
    }
}

class ASTVisitor extends NodeVisitorAbstract
{
    private $docFactory;
    private $stubs;

    public function __construct(DocBlockFactory $docFactory, stdClass $stubs)
    {
        $this->docFactory = $docFactory;
        $this->stubs = $stubs;
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Function_) {
            $this->visitFunction($node);
        } elseif ($node instanceof Const_) {
            $this->visitConstant($node);
        } elseif ($node instanceof FuncCall) {
            $this->visitDefine($node);
        } elseif ($node instanceof ClassMethod) {
            $this->visitMethod($node);
        } elseif ($node instanceof Class_) {
            $this->visitClass($node);
        }
    }

    public function visitFunction(Function_ $node): void
    {
        $function = new stdClass();
        $functionName = $this->getFQN($node, $node->name->name);
        $function->name = $functionName;

        $function->parameters = $this->parseParams($node);

        if ($node->getDocComment() !== null) {
            $phpDoc = $this->docFactory->create($node->getDocComment()->getText());
            if (empty($phpDoc->getTagsByName('deprecated'))) {
                $function->is_deprecated = false;
            } else {
                $function->is_deprecated = true;
            }
        }
        $this->stubs->functions[$functionName] = $function;
    }

    private function visitConstant(Const_ $node): void
    {
        $const = new stdClass();
        $constName = $this->getFQN($node, $node->name->name);
        $const->name = $constName;
        $const->value = $this->getConstValue($node);
        if ($node->getAttribute('parent') instanceof Node\Stmt\ClassConst) {
            $className = $node->getAttribute('parent')->getAttribute('parent')->name->name;
            $this->stubs->classes[$className]->constants[$constName] = $const;
        } else {
            $this->stubs->constants[$constName] = $const;

        }
    }

    private function visitDefine(FuncCall $node): void
    {
        if ($node->name->parts[0] === 'define') {
            $constName = $this->getFQN($node, $node->args[0]->value->value);
            $const = new stdClass();
            if (in_array($constName, ['null', 'true', 'false'])) {
                $constName = strtoupper($constName);
            }
            $const->name = $constName;
            $const->value = $this->getConstValue($node->args[1]);
            $this->stubs->constants[$constName] = $const;
        }
    }

    private function getConstValue($node)
    {
        if (in_array('value', $node->value->getSubNodeNames(), true)) {
            return $node->value->value;
        }
        if (in_array('expr', $node->value->getSubNodeNames(), true)) {
            return $node->value->expr->value;
        }
        if (in_array('name', $node->value->getSubNodeNames(), true)) {
            return $node->value->name->parts[0];
        }
        return null;
    }

    private function visitMethod(ClassMethod $node): void
    {
        $className = $node->getAttribute('parent')->name->name;
        $method = new stdClass();
        $method->name = $node->name->name;
        if(strncmp($method->name, 'PS_UNRESERVE_PREFIX_', 20) === 0){
            $method->name = substr($method->name, strlen('PS_UNRESERVE_PREFIX_'));
        }
        $method->parameters = $this->parseParams($node);
        $method->is_final = $node->isFinal();
        $method->is_static = $node->isStatic();
        if ($node->isPrivate()) {
            $method->access = 'private';
        } elseif ($node->isProtected()) {
            $method->access = 'protected';
        } else {
            $method->access = 'public';
        }

        $this->stubs->classes[$className]->methods[$method->name] = $method;
    }

    private function visitClass(Class_ $node): void
    {
        $class = new stdClass();
        $className = $this->getFQN($node, $node->name->name);
        $class->name = $className;
        if (empty($node->extends)) {
            $class->parentClass = null;
        } else {
            $class->parentClass = $node->extends->parts[0];
        }
        $class->interfaces = $node->implements;
        $this->stubs->classes[$className] = $class;
        $this->stubs->classes[$className]->constants = [];
        $this->stubs->classes[$className]->methods = [];
    }

    private function parseParams(FunctionLike $node): array
    {
        $params = $node->getParams();
        $parsedParams = [];
        /** @var Node\Param $param */
        foreach ($params as $param) {
            $parsedParam = new stdClass();
            $parsedParam->name = $param->var->name;
            if ($param->type !== null) {
                if (empty($param->type->name)) {
                    if (!empty($param->type->parts)) {
                        $parsedParam->type = $param->type->parts[0];
                    }
                } else {
                    $parsedParam->type = $param->type->name;
                }

            } else {
                $parsedParam->type = '';
            }
            $parsedParam->is_vararg = $param->variadic;
            $parsedParam->is_passed_by_ref = $param->byRef;
            $parsedParams[] = $parsedParam;
        }
        return $parsedParams;
    }

    private function getFQN(NodeAbstract $node, string $nodeName): string
    {
        $namespace = '';
        if ($node->getAttribute('parent') instanceof Namespace_ && !empty($node->getAttribute('parent')->name)) {
            $namespace = '\\' . implode('\\', $node->getAttribute('parent')->name->parts) . '\\';
        }
        return $namespace . $nodeName;
    }
}

function getPhpStormStubs(): stdClass
{
    $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    $docFactory = \phpDocumentor\Reflection\DocBlockFactory::createInstance();
    $stubs = new stdClass();

    $stubsIterator =
        new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(__DIR__ . '/../', FilesystemIterator::SKIP_DOTS)
        );
    /** @var SplFileInfo $file */
    foreach ($stubsIterator as $file) {
        if (strpos($file->getRealPath(), 'vendor') || substr(dirname($file->getRealPath(), 1), -5) === 'tests') {
            continue;
        }
        $code = file_get_contents($file->getRealPath());

        $ast = $parser->parse($code);
        $traverser = new NodeTraverser();

        $traverser->addVisitor(new ParentConnector());
        $traverser->addVisitor(new ASTVisitor($docFactory, $stubs));

        $traverser->traverse($ast);
    }
    return $stubs;
}
