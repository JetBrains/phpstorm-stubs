<?php
declare(strict_types=1);
namespace StubTests\Parsers;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\BinaryOp\BitwiseOr;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\NodeVisitorAbstract;
use RuntimeException;
use SplFileInfo;

class MetaExpectedArgumentsCollector extends NodeVisitorAbstract
{
    private const EXPECTED_ARGUMENTS = 'expectedArguments';
    private const EXPECTED_RETURN_VALUES = 'expectedReturnValues';
    private const REGISTER_ARGUMENTS_SET_NAME = 'registerArgumentsSet';
    /**
     * @var ExpectedFunctionArgumentsInfo[]
     */
    private $expectedArgumentsInfos;
    /**
     * @var String[]
     */
    private $registeredArgumentsSet;

    public function __construct()
    {
        $this->expectedArgumentsInfos = array();
        $this->registeredArgumentsSet = array();
        StubParser::processStubs($this, null, function (SplFileInfo $file) {
            return $file->getFilename() === '.phpstorm.meta.php';
        });
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof FuncCall) {
            if ((string)$node->name === self::EXPECTED_ARGUMENTS) {
                $args = $node->args;
                if (count($args) < 3) throw new RuntimeException('Expected at least 3 arguments for expectedArguments call');
                $this->expectedArgumentsInfos[] = $this->getExpectedArgumentsInfo($args[0]->value, array_slice($args, 2), $args[1]->value->value);
            } else if ((string)$node->name === self::REGISTER_ARGUMENTS_SET_NAME) {
                $args = $node->args;
                if (count($args) < 2) throw new RuntimeException('Expected at least 2 arguments for registerArgumentsSet call');
                $this->expectedArgumentsInfos[] = $this->getExpectedArgumentsInfo(null, array_slice($args, 1));
                $name = $args[0]->value->value;
                $this->registeredArgumentsSet[] = $name;
            } else if ((string)$node->name === self::EXPECTED_RETURN_VALUES) {
                $args = $node->args;
                if (count($args) < 2) throw new RuntimeException('Expected at least 2 arguments for expectedReturnValues call');
                $this->expectedArgumentsInfos[] = $this->getExpectedArgumentsInfo($args[0]->value, array_slice($args, 1));
            }
        }
    }

    /**
     * @return ExpectedFunctionArgumentsInfo[]
     */
    public function getExpectedArgumentsInfos(): array
    {
        return $this->expectedArgumentsInfos;
    }

    /**
     * @return String[]
     */
    public function getRegisteredArgumentsSet(): array
    {
        return $this->registeredArgumentsSet;
    }

    /**
     * @param Expr[] $expressions
     * @return Expr[]
     */
    private function unpackArguments(array $expressions): array
    {
        $result = array();
        foreach ($expressions as $expr) {
            if ($expr instanceof BitwiseOr) {
                /** @noinspection SlowArrayOperationsInLoopInspection */
                $result = array_merge($result, $this->unpackArguments(array($expr->left, $expr->right)));
            } else {
                $result[] = $expr;
            }
        }
        return $result;
    }

    /**
     * @param Expr|null $functionReference
     * @param $index
     * @param $args
     * @return ExpectedFunctionArgumentsInfo
     */
    private function getExpectedArgumentsInfo($functionReference, $args, $index = -1): ExpectedFunctionArgumentsInfo
    {
        $expressions = array_map(function (Arg $arg) {
            return $arg->value;
        }, $args);
        return new ExpectedFunctionArgumentsInfo($functionReference, $this->unpackArguments($expressions), $index);
    }
}