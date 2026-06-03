<?php

namespace StubTests\Framework\Parsers\Model;

class BasePHPElement
{
    private ?string $name = null;
    private ?string $id = null;
    private ?StubsMetadata $stubsMetadata = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getStubsMetadata(): ?StubsMetadata
    {
        return $this->stubsMetadata;
    }

    public function initStubsMetadata(): StubsMetadata
    {
        return $this->stubsMetadata ??= new StubsMetadata();
    }
}
