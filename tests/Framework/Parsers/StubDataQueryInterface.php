<?php

namespace StubTests\Framework\Parsers;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPInterface;

/**
 * Read-only query interface for accessing parsed stub/reflection data.
 *
 * These eight methods were previously spread across five per-entity interfaces
 * (Class/Function/Interface/Enum/ConstantQueryInterface) that this one composed, written so that
 * "clients can depend on only the slice they need". No client ever did: all five were referenced
 * by nothing but the composite, while this type is the declared parameter type in ~48 files.
 *
 * The split also could not deliver what it promised, because the coupling it aimed at is fixed by
 * CheckInterface::run(StubDataQueryInterface, ...). PHP does not permit narrowing a parameter type
 * in an override — only widening — so no check can declare a narrower dependency however the
 * interfaces are cut. Doing that would mean changing CheckInterface itself, at which point the
 * per-entity interfaces can be reintroduced from here in a single commit.
 *
 * Contrast the parallel *NodeExtractorInterface split, which is genuine: five narrow interfaces
 * that six Stub*Parser classes actually declare as their parameter types.
 */
interface StubDataQueryInterface
{
    /** @return PHPClass[] */
    public function getClasses(): array;

    public function hasClass(string $id): bool;

    /** @return PHPFunction[] */
    public function getFunctions(): array;

    /** @return PHPInterface[] */
    public function getInterfaces(): array;

    public function hasInterface(string $id): bool;

    /** @return PHPEnum[] */
    public function getEnums(): array;

    public function hasEnum(string $id): bool;

    /** @return PHPConstant[] */
    public function getConstants(): array;
}
