<?php
declare(strict_types=1);

require_once __DIR__ . '../vendor/autoload.php';


use phpDocumentor\Reflection\DocBlockFactory;
use PhpParser\Error;
use PhpParser\Node;
use PhpParser\Node\{
    Const_, Expr\FuncCall, FunctionLike, Stmt\Class_, Stmt\ClassMethod, Stmt\Function_
};

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

    public function __construct(DocBlockFactory $docFactory, array &$stubs)
    {
        $this->docFactory = $docFactory;
        $this->stubs = &$stubs;
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
        $function = ['name' => $node->name->name];

        $function['parameters'][] = $this->parseParams($node);

        if ($node->getDocComment() != NULL) {
            $phpDoc = $this->docFactory->create($node->getDocComment()->getText());
            if (!empty($phpDoc->getTagsByName("deprecated"))) {
                $function['is_deprecated'] = TRUE;
            } else {
                $function['is_deprecated'] = FALSE;
            }
        }
        $this->stubs['functions'][] = $function;
    }

    private function visitConstant(Const_ $node): void
    {
        $const['name'] = $node->name->name;
        $const['value'] = $this->getConstValue($node);
        if ($node->getAttribute("parent") instanceof Node\Stmt\ClassConst) {
            $className = $node->getAttribute("parent")->getAttribute("parent")->name->name;
            $this->stubs['classes'][$className]['constants'][] = $const;
        } else {
            $this->stubs['constants'][] = $const;

        }
    }

    private function visitDefine(FuncCall $node): void
    {
        if ($node->name->parts[0] == "define") {
            $constName = $node->args[0]->value->value;
            if (in_array($constName, ["null", "true", "false"])) {
                return;
            }
            $const['name'] = $constName;
            $const['value'] = $this->getConstValue($node->args[1]);
            $this->stubs['constants'][] = $const;
        }
    }

    private function getConstValue($node)
    {
        if (in_array("value", $node->value->getSubNodeNames())) {
            return $node->value->value;
        }
        if (in_array("expr", $node->value->getSubNodeNames())) {
            return $node->value->expr->value;
        }
        if (in_array("name", $node->value->getSubNodeNames())) {
            return $node->value->name->parts[0];
        }
    }

    private function visitMethod(ClassMethod $node): void
    {
        $className = $node->getAttribute("parent")->name->name;
        $method['name'] = $node->name->name;
        $method['parameters'] = $this->parseParams($node);
        $method['is_final'] = $node->isFinal();
        $method['is_static'] = $node->isStatic();
        if ($node->isPrivate()) {
            $method['access'] = 'private';
        } elseif ($node->isProtected()) {
            $method['access'] = 'protected';
        } else {
            $method['access'] = 'public';
        }

        var_dump($node);

        $this->stubs['classes'][$className]['methods'][] = $method;
    }

    private function visitClass(Class_ $node): void
    {
        $className = $node->name->name;
        $class['name'] = $className;
        $this->stubs['classes'][$className] = $class;
    }

    private function parseParams(FunctionLike $node): array
    {
        $params = $node->getParams();
        $parsedParams = [];
        /** @var Node\Param $param */
        foreach ($params as $param) {
            $parsedParams['name'] = $param->var->name;
            if ($param->type != NULL) {
                if (!empty($param->type->name)) {
                    $parsedParams['type'] = $param->type->name;
                } else {
                    if (!empty($param->type->parts)) {
                        $parsedParams['type'] = $param->type->parts[0];
                    }
                }

            } else {
                $parsedParams['type'] = '';
            }
            $parsedParams['is_vararg'] = $param->variadic;
            $parsedParams['is_passed_by_ref'] = $param->byRef;
        }
        return $parsedParams;
    }
}


$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
$docFactory = \phpDocumentor\Reflection\DocBlockFactory::createInstance();
$stubs = [];

$stubsIterator =
    new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator("./vendor/jetbrains/phpstorm-stubs", FilesystemIterator::SKIP_DOTS)
    );
/** @var SplFileInfo $file */
foreach ($stubsIterator as $file) {
    $code = file_get_contents($file->getRealPath());
    try {
        $ast = $parser->parse($code);
    } catch (Error $error) {
        echo "Parse error: {$error->getMessage()}\n";
        return;
    }
    $traverser = new NodeTraverser();

    $traverser->addVisitor(new ParentConnector());
    $traverser->addVisitor(new ASTVisitor($docFactory, $stubs));

    $ast = $traverser->traverse($ast);
}


var_dump($stubs);