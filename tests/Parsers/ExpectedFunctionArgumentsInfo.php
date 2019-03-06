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
     * @var int
     */
    private $index;

    /**
     * ExpectedFunctionArgumentsInfo constructor.
     * @param Expr $functionReference
     * @param Expr[] $expectedArguments
     * @param int $index
     */
    public function __construct(?Expr $functionReference, array $expectedArguments, int $index)
    {
        $this->functionReference = $functionReference;
        $this->expectedArguments = $expectedArguments;
        $this->index = $index;
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

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
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
