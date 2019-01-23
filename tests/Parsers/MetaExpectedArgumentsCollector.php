<?php
declare(strict_types=1);
namespace StubTests\Parsers;

use PhpParser\NodeVisitorAbstract;
use RuntimeException;
use SplFileInfo;

class MetaExpectedArgumentsCollector extends NodeVisitorAbstract
{
    private const EXPECTED_ARGUMENTS = 'expectedArguments';
    /**
     * @var ExpectedFunctionArgumentsInfo[]
     */
    private $expectedArgumentsInfos;

    public function __construct()
    {
        $this->expectedArgumentsInfos = array();
    }

    public function enterNode(\PhpParser\Node $node)
    {
        if ($node instanceof \PhpParser\Node\Expr\FuncCall) {
            if ((string)$node->name === self::EXPECTED_ARGUMENTS) {
                $args = $node->args;
                if ($args < 3) throw new RuntimeException('Expected at least 3 arguments for expectedArguments call');
                $expressions = array_slice(
                    array_map(function (\PhpParser\Node\Arg $arg) {
                        return $arg->value;
                    }, $args), 2);
                $this->expectedArgumentsInfos[] = new ExpectedFunctionArgumentsInfo($args[0]->value, $this->unpackArguments($expressions));
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
     * @param \PhpParser\Node\Expr[] $args
     * @return \PhpParser\Node\Expr[]
     */
    private function unpackArguments(array $expressions): array
    {
        $result = array();
        foreach ($expressions as $expr) {
            if ($expr instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseOr) {
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
}