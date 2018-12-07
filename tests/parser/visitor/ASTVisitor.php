<?php
declare(strict_types=1);

namespace Parsers\Visitor;

use Exception;
use Model\PHPClass;
use Model\PHPConst;
use Model\PHPElementWithPHPDoc;
use Model\PHPFunction;
use Model\PHPInterface;
use Model\PHPMethod;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\DocBlockFactory;
use PhpParser\Node;
use PhpParser\Node\{Const_,
    Expr\FuncCall,
    FunctionLike,
    Stmt\Class_,
    Stmt\ClassMethod,
    Stmt\Function_,
    Stmt\Interface_,
    Stmt\Namespace_};
use PhpParser\NodeAbstract;
use PhpParser\NodeVisitorAbstract;
use stdClass;

class ASTVisitor extends NodeVisitorAbstract
{
	private $docFactory;
	public $stubs;

	public function __construct(DocBlockFactory $docFactory, array &$stubs)
	{
		$this->docFactory = $docFactory;
		$this->stubs      = &$stubs;
	}

	public function enterNode(Node $node)
	{
		if ($node instanceof Function_)
		{
			$this->visitFunction($node);
		}
		elseif ($node instanceof Const_)
		{
			$this->visitConstant($node);
		}
		elseif ($node instanceof FuncCall)
		{
			$this->visitDefine($node);
		}
		elseif ($node instanceof ClassMethod)
		{
			$this->visitMethod($node);
		}
		elseif ($node instanceof Interface_)
		{
			$this->visitInterface($node);
		}
		elseif ($node instanceof Class_)
		{
			$this->visitClass($node);
		}
	}

	public function visitFunction(Function_ $node): void
	{
		$function       = new PHPFunction();
		$functionName   = $this->getFQN($node, $node->name->name);
		$function->name = $functionName;

		$function->parameters = $this->parseParams($node);

		$function->parseError = null;
		$this->collectLinks($node, $function);
		if ($node->getDocComment() !== null)
		{
			try
			{
				$phpDoc = $this->docFactory->create($node->getDocComment()->getText());
			}
			catch (Exception $e)
			{
				$function->parseError = $e->getMessage();

				return;
			}
			if (empty($phpDoc->getTagsByName('deprecated')))
			{
				$function->is_deprecated = false;
			}
			else
			{
				$function->is_deprecated = true;
			}
		}
		$this->stubs[PHPFunction::class][$functionName] = $function;
	}

	private function visitConstant(Const_ $node): void
	{
		$constName         = $this->getFQN($node, $node->name->name);
		$const             = new PHPConst($constName);
		$const->name       = $constName;
		$const->value      = $this->getConstValue($node);
		$const->parseError = null;
		$this->collectLinks($node, $const);
		if ($node->getAttribute('parent') instanceof Node\Stmt\ClassConst)
		{
			$parentName = $this->getFQN($node->getAttribute('parent')->getAttribute('parent'),
				$node->getAttribute('parent')->getAttribute('parent')->name->name);
			if (array_key_exists($parentName, $this->stubs[PHPClass::class]))
			{
				$this->stubs[PHPClass::class][$parentName]->constants[$constName] = $const;
			}
			else
			{
				$this->stubs[PHPInterface::class][$parentName]->constants[$constName] = $const;
			}
		}
		else
		{
			$this->stubs[PHPConst::class][$constName] = $const;

		}
	}

	private function visitDefine(FuncCall $node): void
	{
		if ($node->name->parts[0] === 'define')
		{
			$constName = $this->getFQN($node, $node->args[0]->value->value);
			$const     = new PHPConst($constName);
			if (in_array($constName, ['null', 'true', 'false']))
			{
				$constName = strtoupper($constName);
			}
			$const->name       = $constName;
			$const->value      = $this->getConstValue($node->args[1]);
			$const->parseError = null;
			$this->collectLinks($node, $const);
			$this->stubs[PHPConst::class][$constName] = $const;
		}
	}

	private function collectLinks(NodeAbstract $node, PHPElementWithPHPDoc $stub)
	{
		$stub->links = [];
		$stub->see   = [];
		if ($node->getDocComment() !== null)
		{
			try
			{
				$phpDoc      = $this->docFactory->create($node->getDocComment()->getText());
				$stub->links = $phpDoc->getTagsByName('link');
				$stub->see   = $phpDoc->getTagsByName('see');
			}
			catch (Exception $e)
			{
				$stub->parseError = $e->getMessage();

				return;
			}
		}
	}

	private function getConstValue($node)
	{
		if (in_array('value', $node->value->getSubNodeNames(), true))
		{
			return $node->value->value;
		}
		if (in_array('expr', $node->value->getSubNodeNames(), true))
		{
			return $node->value->expr->value;
		}
		if (in_array('name', $node->value->getSubNodeNames(), true))
		{
			return $node->value->name->parts[0];
		}

		return null;
	}

	private function visitMethod(ClassMethod $node): void
	{
		$parentName   = $this->getFQN($node->getAttribute('parent'), $node->getAttribute('parent')->name->name);
		$method       = new PHPMethod();
		$method->name = $node->name->name;

		//this will test PHPDocs
		$method->parseError = null;
		$method->returnTag  = null;
		$this->collectLinks($node, $method);
		if ($node->getDocComment() !== null)
		{
			try
			{
				$phpDoc          = $this->docFactory->create($node->getDocComment()->getText());
				$parsedReturnTag = $phpDoc->getTagsByName('return');
				if (!empty($parsedReturnTag) && $parsedReturnTag[0] instanceof Return_)
				{
					$method->returnTag = $parsedReturnTag[0]->getType() . "";
				}
			}
			catch (Exception $e)
			{
				$method->parseError = $e->getMessage();
			}
		}

		if (strncmp($method->name, 'PS_UNRESERVE_PREFIX_', 20) === 0)
		{
			$method->name = substr($method->name, strlen('PS_UNRESERVE_PREFIX_'));
		}
		$method->parameters = $this->parseParams($node);
		$method->is_final   = $node->isFinal();
		$method->is_static  = $node->isStatic();
		if ($node->isPrivate())
		{
			$method->access = 'private';
		}
		elseif ($node->isProtected())
		{
			$method->access = 'protected';
		}
		else
		{
			$method->access = 'public';
		}
		if (array_key_exists($parentName, $this->stubs[PHPClass::class]))
		{
			$this->stubs[PHPClass::class][$parentName]->methods[$method->name] = $method;
		}
		else
		{
			$this->stubs[PHPInterface::class][$parentName]->methods[$method->name] = $method;
		}
	}

	private function visitClass(Class_ $node): void
	{
		$class     = new PHPClass();
		$className = $this->getFQN($node, $node->name->name);
		//this will test PHPDocs
		$class->parseError = null;
		$this->collectLinks($node, $class);
		if ($node->getDocComment() !== null)
		{
			try
			{
				$this->docFactory->create($node->getDocComment()->getText());
			}
			catch (Exception $e)
			{
				$class->parseError = $e->getMessage();
			}
		}
		$class->name = $className;
		if (empty($node->extends))
		{
			$class->parentClass = null;
		}
		else
		{
			$class->parentClass = $this->getFQN($node, $node->extends->parts[0]);
		}
		$class->interfaces                                   = $node->implements;
		$this->stubs[PHPClass::class][$className]            = $class;
		$this->stubs[PHPClass::class][$className]->constants = [];
		$this->stubs[PHPClass::class][$className]->methods   = [];
	}

	private function visitInterface(Interface_ $node): void
	{
		$interface     = new PHPInterface();
		$interfaceName = $this->getFQN($node, $node->name->name);
		//this will test PHPDocs
		$interface->parseError = null;
		$this->collectLinks($node, $interface);
		if ($node->getDocComment() !== null)
		{
			try
			{
				$this->docFactory->create($node->getDocComment()->getText());
			}
			catch (Exception $e)
			{
				$interface->parseError = $e->getMessage();
			}
		}
		$interface->name             = $interfaceName;
		$interface->parentInterfaces = [];
		if (!empty($node->extends))
		{
			foreach ($node->extends[0]->parts as $part)
			{
				array_push($interface->parentInterfaces, $this->getFQN($node, $part));
			}
		}
		$this->stubs[PHPInterface::class][$interfaceName]            = $interface;
		$this->stubs[PHPInterface::class][$interfaceName]->constants = [];
		$this->stubs[PHPInterface::class][$interfaceName]->methods   = [];
	}

	public function combineParentInterfaces($interface): array
	{
		$parents = [];
		if (empty($interface->parentInterfaces))
		{
			return $parents;
		}
		else
		{
			foreach ($interface->parentInterfaces as $parentInterface)
			{
				array_push($parents, $parentInterface);
				foreach ($this->combineParentInterfaces($this->stubs[PHPInterface::class][$parentInterface]) as $value)
				{
					array_push($parents, $value);
				}
			}
		}

		return $parents;
	}

	private function parseParams(FunctionLike $node): array
	{
		$params       = $node->getParams();
		$parsedParams = [];
		/** @var Node\Param $param */
		foreach ($params as $param)
		{
			$parsedParam       = new stdClass();
			$parsedParam->name = $param->var->name;
			if ($param->type !== null)
			{
				if (empty($param->type->name))
				{
					if (!empty($param->type->parts))
					{
						$parsedParam->type = $param->type->parts[0];
					}
				}
				else
				{
					$parsedParam->type = $param->type->name;
				}

			}
			else
			{
				$parsedParam->type = '';
			}
			$parsedParam->is_vararg        = $param->variadic;
			$parsedParam->is_passed_by_ref = $param->byRef;
			$parsedParams[]                = $parsedParam;
		}

		return $parsedParams;
	}

	private function getFQN(NodeAbstract $node, string $nodeName): string
	{
		$namespace = '';
		if ($node->getAttribute('parent') instanceof Namespace_ && !empty($node->getAttribute('parent')->name))
		{
			$namespace = '\\' . implode('\\', $node->getAttribute('parent')->name->parts) . '\\';
		}

		return $namespace . $nodeName;
	}
}

