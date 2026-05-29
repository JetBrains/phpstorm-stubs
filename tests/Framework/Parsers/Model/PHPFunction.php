<?php

namespace StubTests\Framework\Parsers\Model;

use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;
use StubTests\Framework\Parsers\Model\PHPNamespacedElement;

class PHPFunction extends PHPNamespacedElement
{

    protected StandaloneType|UnionType|NullableType|NoType|IntersectionType|null $returnTypesFromSignature = null;
    protected bool $isDeprecated = false;
    protected array $parameters = [];
    protected bool $hasTentativeReturnType = false;

    public function getReturnTypeFromSignature(): StandaloneType|UnionType|NullableType|NoType|IntersectionType|null
    {
        return $this->returnTypesFromSignature;
    }

    public function setReturnTypeFromSignature(StandaloneType|UnionType|NullableType|NoType|IntersectionType $returnTypesFromSignature): void
    {
        $this->returnTypesFromSignature = $returnTypesFromSignature;
    }

    public function isDeprecated(): bool
    {
        return $this->isDeprecated;
    }

    public function setDeprecated(bool $isDeprecated): void
    {
        $this->isDeprecated = $isDeprecated;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function setHasTentativeReturnType(bool $hasTentativeReturnType): void
    {
        $this->hasTentativeReturnType = $hasTentativeReturnType;
    }

    public function hasTentativeReturnType(): bool
    {
        return $this->hasTentativeReturnType;
    }

}