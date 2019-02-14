<?php
declare(strict_types=1);
namespace StubTests\Parsers;
use PhpParser\Node\Expr;

class ExpectedFunctionArgumentsInfo
{
    /**
     * @var Expr|null
     */
    private $functionReference;

    /**
     * @var Expr[]
     */
    private $expectedArguments;

    /**
     * ExpectedFunctionArgumentsInfo constructor.
     * @param Expr $functionReference
     * @param Expr[] $expectedArguments
     */
    public function __construct(?Expr $functionReference, array $expectedArguments)
    {
        $this->functionReference = $functionReference;
        $this->expectedArguments = $expectedArguments;
    }


    /**
     * @return Expr|null
     */
    public function getFunctionReference(): ?Expr
    {
        return $this->functionReference;
    }

    /**
     * @param Expr $functionReference
     */
    public function setFunctionReference(Expr $functionReference): void
    {
        $this->functionReference = $functionReference;
    }

    /**
     * @return Expr[]
     */
    public function getExpectedArguments(): array
    {
        return $this->expectedArguments;
    }

    /**
     * @param Expr[] $expectedArguments
     */
    public function setExpectedArguments(array $expectedArguments): void
    {
        $this->expectedArguments = $expectedArguments;
    }

    public function __toString()
    {
        if ($this->functionReference === null) {
            return '';
        }
        if (property_exists($this->functionReference, 'name')) {
            return (string)$this->functionReference->name;
        }
        return implode(',', $this->functionReference->getAttributes());
    }
}
