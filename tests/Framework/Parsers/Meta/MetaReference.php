<?php

namespace StubTests\Framework\Parsers\Meta;

use StubTests\Framework\Parsers\Meta\MetaReferenceRole;
use StubTests\Framework\Parsers\Meta\MetaReferenceType;

final class MetaReference
{
    private const ENTITY_ID_SEPARATOR = '|';

    public function __construct(
        public readonly MetaReferenceType $type,
        public readonly string $fqn,
        public readonly string $sourceFile,
        public readonly int $line,
        public readonly MetaReferenceRole $role = MetaReferenceRole::VALUE,
    ) {
    }

    public function toEntityId(): string
    {
        return $this->type->value . self::ENTITY_ID_SEPARATOR . $this->fqn;
    }

    public static function parseEntityId(string $entityId): array
    {
        $separatorPos = strpos($entityId, self::ENTITY_ID_SEPARATOR);
        if ($separatorPos === false) {
            throw new \InvalidArgumentException("Invalid meta entity ID: $entityId");
        }

        $typeValue = substr($entityId, 0, $separatorPos);
        $fqn = substr($entityId, $separatorPos + 1);

        return [MetaReferenceType::from($typeValue), $fqn];
    }
}
