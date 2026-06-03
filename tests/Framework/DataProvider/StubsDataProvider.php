<?php

namespace StubTests\Framework\DataProvider;

interface StubsDataProvider
{
    public function getAllStubFiles(): array;

    public function getStubFileContent(string $path): string;

    public function getStubsRootPath(): string;
}
