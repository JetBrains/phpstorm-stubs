<?php

namespace StubTests\Parsers\Visitors;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\NodeVisitorAbstract;
use RuntimeException;
use SplFileInfo;
use StubTests\Parsers\StubParser;

class MetaOverrideFunctionsParser extends NodeVisitorAbstract
{
    private const OVERRIDE_FUNCTION = 'override';

    /**
     * @var string[]
     */
    public array $overridenFunctions;

    public function __construct()
    {
        $this->overridenFunctions = [];
        StubParser::processStubs($this, null, function (SplFileInfo $file) {
            return $file->getFilename() === '.phpstorm.meta.php';
        });
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Expr\FuncCall) {
            if ((string)$node->name === self::OVERRIDE_FUNCTION) {
                $args = $node->args;
                if (count($args) < 2) {
                    throw new RuntimeException('Expected at least 2 arguments for override call');
                }
                $this->overridenFunctions[] = $this->getOverrideFunctionName($args[0]);
            }
        }
    }

    private function getOverrideFunctionName($param)
    {
        $paramValue = $param->value;
        $targetFunction = null;
        if ($paramValue instanceof Expr\StaticCall) {
            $targetFunction = $paramValue->class . "::" . $paramValue->name;
        } else {
            $targetFunction = (string)$paramValue->name;
        }
        return $targetFunction;
    }
}
