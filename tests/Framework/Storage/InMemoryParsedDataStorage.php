<?php

namespace StubTests\Framework\Storage;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Model\PHPMethod;

class InMemoryParsedDataStorage implements ParsedDataStorageProvider
{
    private array $entities = [];
    private array $classes = [];
    private array $functions = [];
    private array $interfaces = [];
    private array $constants = [];
    private array $enums = [];

    public function __construct() {}

    public function getEntities(): array
    {
        return $this->entities;
    }

    public function addEntity(mixed $entity): void
    {
        $this->entities[] = $entity;

        // Also categorize by type for faster lookups
        // PHPMethod extends PHPFunction, so it is excluded explicitly: methods are reached
        // via their owning class, and indexing them here would list them as free functions.
        if ($entity instanceof PHPClass) {
            $this->classes[] = $entity;
        } elseif ($entity instanceof PHPFunction && !$entity instanceof PHPMethod) {
            $this->functions[] = $entity;
        } elseif ($entity instanceof PHPInterface) {
            $this->interfaces[] = $entity;
        } elseif ($entity instanceof PHPEnum) {
            $this->enums[] = $entity;
        } elseif ($entity instanceof PHPConstant) {
            $this->constants[] = $entity;
        }
    }

    public function getClasses(): array
    {
        return $this->classes;
    }

    public function getFunctions(): array
    {
        return $this->functions;
    }

    public function getInterfaces(): array
    {
        return $this->interfaces;
    }

    public function getEnums(): array
    {
        return $this->enums;
    }

    public function getConstants(): array
    {
        return $this->constants;
    }
}
