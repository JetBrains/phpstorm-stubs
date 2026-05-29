<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocParserInterface;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocumentorParser;
use StubTests\Framework\Parsers\Stubs\Types\DefaultTypeParser;
use StubTests\Framework\Parsers\Stubs\Types\TypeParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\AvailableVersionParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\DefaultAvailableVersionParser;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Stubs\Nodes\PropertyNode;

/**
 * Parses PropertyNode AST nodes into PHPProperty domain objects.
 * Extracts all property metadata: name, access modifiers, static/readonly flags, type hint.
 */
class StubPropertyParser
{
    private PhpDocParserInterface $phpDocParser;
    private TypeParserInterface $typeParser;
    private AvailableVersionParserInterface $versionParser;

    public function __construct(
        ?PhpDocParserInterface $phpDocParser = null,
        ?TypeParserInterface $typeParser = null,
        ?AvailableVersionParserInterface $versionParser = null
    ) {
        $this->phpDocParser = $phpDocParser ?? new PhpDocumentorParser();
        $this->typeParser = $typeParser ?? new DefaultTypeParser();
        $this->versionParser = $versionParser ?? new DefaultAvailableVersionParser();
    }

    /**
     * Parses a property AST node into PHPProperty domain object.
     *
     * @param PropertyNode $node The property AST node
     * @param array $imports Map of import aliases to fully qualified names
     * @param string $namespace Current namespace context (e.g., '\Dom' or '\\' for global)
     * @return PHPProperty
     */
    public function parseNode(PropertyNode $node, array $imports = [], string $namespace = '\\'): PHPProperty
    {
        $property = new PHPProperty();
        $property->setName($node->getName());

        // Access modifiers
        if ($node->isPublic()) {
            $property->setAccess(AccessModifier::PUBLIC);
        } elseif ($node->isProtected()) {
            $property->setAccess(AccessModifier::PROTECTED);
        } elseif ($node->isPrivate()) {
            $property->setAccess(AccessModifier::PRIVATE);
        }

        // Property modifiers
        $property->setIsStatic($node->isStatic());
        $property->setIsReadonly($node->isReadonly());

        // Parse PhpDoc using injected parser
        $parsedPhpDoc = $this->phpDocParser->parseElementPhpDoc($node->getDocComment());

        // Parse type using injected type parser with namespace context
        $parsedType = $this->typeParser->parseType(
            $node->getType(),
            $parsedPhpDoc->varType,
            $node->getAttributes(),
            $imports,
            $namespace
        );

        // Apply parsed PhpDoc data to property
        $property->initStubsMetadata()->setPhpDoc($parsedPhpDoc->rawPhpDoc);

        // Parse and apply available version (from PhpDoc + attributes)
        $versions = $this->versionParser->parseAvailableVersion($parsedPhpDoc, $node->getAttributes(), $imports);
        $property->initStubsMetadata()->setSinceVersion($versions['sinceVersion']);
        $property->initStubsMetadata()->setRemovedVersion($versions['removedVersion']);

        // Apply parsed type data to property
        // typeFromSignature is always set (NoType if no type)
        $property->setTypeFromSignature($parsedType->typeFromSignature);
        $property->initStubsMetadata()->setTypeFromPhpDoc($parsedType->typeFromPhpDoc);
        $property->initStubsMetadata()->setLanguageLevelTypes($parsedType->languageLevelTypes);
        $property->initStubsMetadata()->setDefaultType($parsedType->defaultType);

        return $property;
    }
}
