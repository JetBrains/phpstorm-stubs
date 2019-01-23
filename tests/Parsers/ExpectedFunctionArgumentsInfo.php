<?php
declare(strict_types=1);
namespace StubTests\Parsers;
class ExpectedFunctionArgumentsInfo
{
    /**
     * @var \PhpParser\Node\Expr
     */
    private $functionReference;

    /**
     * @var \PhpParser\Node\Expr[]
     */
    private $expectedArguments;

    /**
     * ExpectedFunctionArgumentsInfo constructor.
     * @param \PhpParser\Node\Expr $functionReference
     * @param \PhpParser\Node\Expr[] $expectedArguments
     */
    public function __construct(\PhpParser\Node\Expr $functionReference, array $expectedArguments)
    {
        $this->functionReference = $functionReference;
        $this->expectedArguments = $expectedArguments;
    }


    /**
     * @return \PhpParser\Node\Expr
     */
    public function getFunctionReference(): \PhpParser\Node\Expr
    {
        return $this->functionReference;
    }

    /**
     * @param \PhpParser\Node\Expr $functionReference
     */
    public function setFunctionReference(\PhpParser\Node\Expr $functionReference): void
    {
        $this->functionReference = $functionReference;
    }

    /**
     * @return \PhpParser\Node\Expr[]
     */
    public function getExpectedArguments(): array
    {
        return $this->expectedArguments;
    }

    /**
     * @param \PhpParser\Node\Expr[] $expectedArguments
     */
    public function setExpectedArguments(array $expectedArguments): void
    {
        $this->expectedArguments = $expectedArguments;
    }

    public function __toString()
    {
        if (property_exists($this->functionReference, 'name')) {
            return (string)$this->functionReference->name;
        }
        return implode(',', $this->functionReference->getAttributes());
    }
}
