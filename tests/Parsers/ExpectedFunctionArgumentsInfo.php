<?php
declare(strict_types=1);

namespace StubTests\Parsers;

use PhpParser\Node\Expr;

class ExpectedFunctionArgumentsInfo
{
    private ?Expr $functionReference;
    private array $expectedArguments;
    private int $index;

    /**
     * ExpectedFunctionArgumentsInfo constructor.
     * @param Expr|null $functionReference
     * @param Expr[] $expectedArguments
     * @param int $index
     */
    public function __construct(?Expr $functionReference, array $expectedArguments, int $index) {
        $this->index = $index;
        $this->expectedArguments = $expectedArguments;
        $this->functionReference = $functionReference;
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

    public function getIndex(): int
    {
        return $this->index;
    }

    public function __toString(): string
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
