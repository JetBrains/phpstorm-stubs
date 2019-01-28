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
    private const REGISTER_ARGUMENTS_SET_NAME = 'registerArgumentsSet';
    /**
     * @var ExpectedFunctionArgumentsInfo[]
     */
    private $expectedArgumentsInfos;

    public function __construct()
    {
        $this->expectedArgumentsInfos = array();
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof FuncCall) {
            if ((string)$node->name === self::EXPECTED_ARGUMENTS) {
                $args = $node->args;
                if ($args < 3) throw new RuntimeException('Expected at least 3 arguments for expectedArguments call');
                $this->expectedArgumentsInfos[] = $this->getExpectedArgumentsInfo($args[0]->value, array_slice($args, 2));
            } else if ((string)$node->name === self::REGISTER_ARGUMENTS_SET_NAME) {
                $args = $node->args;
                if ($args < 2) throw new RuntimeException('Expected at least 2 arguments for registerArgumentsSet call');
                $this->expectedArgumentsInfos[] = $this->getExpectedArgumentsInfo(null, array_slice($args, 1));
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
     * @return ExpectedFunctionArgumentsInfo[]
     */
    public static function getMetaExpectedArguments(): array
    {
        $visitor = new MetaExpectedArgumentsCollector();
        StubParser::processStubs($visitor, function (SplFileInfo $file) {
            return $file->getFilename() === '.phpstorm.meta.php';
        });
        return $visitor->getExpectedArgumentsInfos();
    }

    /**
     * @param Expr|null $functionReference
     * @param $args
     * @return ExpectedFunctionArgumentsInfo
     */
    private function getExpectedArgumentsInfo($functionReference, $args): ExpectedFunctionArgumentsInfo
    {
        $expressions = array_map(function (Arg $arg) {
            return $arg->value;
        }, $args);
        return new ExpectedFunctionArgumentsInfo($functionReference, $this->unpackArguments($expressions));
    }
}