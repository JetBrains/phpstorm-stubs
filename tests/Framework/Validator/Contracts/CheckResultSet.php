<?php

namespace StubTests\Framework\Validator\Contracts;

class CheckResultSet
{
    /** @var array<string, string[]> */
    private array $failures = [];

    /** @var array<string> */
    private array $successes = [];

    public function addFailure(string $name, string $message): void
    {
        $this->failures[$name][] = $message;
    }

    public function addSuccess(string $name): void
    {
        $this->successes[] = $name;
    }

    /**
     * @return array<string, string>
     */
    public function getFailures(): array
    {
        return array_map(
            static fn(array $messages): string => implode("\n", $messages),
            $this->failures
        );
    }

    /**
     * @return array<string>
     */
    public function getSuccesses(): array
    {
        return $this->successes;
    }

    public function hasFailures(): bool
    {
        return $this->failures !== [];
    }

    public function getFailureCount(): int
    {
        return count($this->failures);
    }

    public function getSuccessCount(): int
    {
        return count($this->successes);
    }
}
