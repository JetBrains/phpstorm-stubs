<?php

namespace StubTests\Framework\Parsers\Model;

class PHPEnum extends PHPClassLikeObject
{
    /** @var string[] */
    private array $cases = [];

    /** @return string[] */
    public function getCaseNames(): array
    {
        return $this->cases;
    }

    public function setCases(array $cases): void
    {
        $this->cases = $cases;
    }

    public function addCase(string $case): void
    {
        $this->cases[] = $case;
    }
}
