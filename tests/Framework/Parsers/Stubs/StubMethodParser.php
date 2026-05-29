<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocParserInterface;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocumentorParser;
use StubTests\Framework\Parsers\Stubs\Types\DefaultTypeParser;
use StubTests\Framework\Parsers\Stubs\StubParameterParser;
use StubTests\Framework\Parsers\Stubs\Types\TypeParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\AvailableVersionParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\DefaultAvailableVersionParser;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Stubs\Nodes\MethodNode;
use StubTests\Framework\Parsers\Stubs\AttributeDetectionTrait;

/**
 * Parses MethodNode AST nodes into PHPMethod domain objects.
 * Extracts all method metadata: name, access modifiers, static/final/abstract flags, deprecation.
 */
class StubMethodParser
{
    use AttributeDetectionTrait;

    private PhpDocParserInterface $phpDocParser;
    private TypeParserInterface $typeParser;
    private AvailableVersionParserInterface $versionParser;
    private StubParameterParser $parameterParser;

    public function __construct(
        ?PhpDocParserInterface $phpDocParser = null,
        ?TypeParserInterface $typeParser = null,
        ?AvailableVersionParserInterface $versionParser = null
    ) {
        $this->phpDocParser = $phpDocParser ?? new PhpDocumentorParser();
        $this->typeParser = $typeParser ?? new DefaultTypeParser();
        $this->versionParser = $versionParser ?? new DefaultAvailableVersionParser();
        $this->parameterParser = new StubParameterParser($typeParser, $versionParser);
    }

    /**
     * Parses a method AST node into PHPMethod domain object.
     *
     * @param MethodNode $node The method AST node
     * @param array $imports Map of import aliases to fully qualified names
     * @param string $namespace Current namespace context (e.g., '\Dom' or '\\' for global)
     * @return PHPMethod
     */
    public function parseNode(MethodNode $node, array $imports = [], string $namespace = '\\'): PHPMethod
    {
        $method = new PHPMethod();
        $method->setName($node->getName());

        // Access modifiers
        if ($node->isPublic()) {
            $method->setAccess(AccessModifier::PUBLIC);
        } elseif ($node->isProtected()) {
            $method->setAccess(AccessModifier::PROTECTED);
        } elseif ($node->isPrivate()) {
            $method->setAccess(AccessModifier::PRIVATE);
        }

        // Method modifiers
        $method->setIsStatic($node->isStatic());
        $method->setIsFinal($node->isFinal());
        $method->setIsAbstract($node->isAbstract());

        // Parse PhpDoc using injected parser
        $parsedPhpDoc = $this->phpDocParser->parseElementPhpDoc($node->getDocComment());

        // Parse return type using injected type parser with namespace context
        $parsedReturnType = $this->typeParser->parseType(
            $node->getReturnType(),
            $parsedPhpDoc->returnType,
            $node->getAttributes(),
            $imports,
            $namespace
        );

        // Apply parsed PhpDoc data to method
        $method->initStubsMetadata()->setPhpDoc($parsedPhpDoc->rawPhpDoc);
        $method->setDeprecated($parsedPhpDoc->isDeprecated || $this->hasDeprecatedAttribute($node->getAttributes(), $imports));
        $method->setHasTentativeReturnType($this->hasTentativeTypeAttribute($node->getAttributes(), $imports));

        // Parse and apply available version (from PhpDoc + attributes)
        $versions = $this->versionParser->parseAvailableVersion($parsedPhpDoc, $node->getAttributes(), $imports);
        $method->initStubsMetadata()->setSinceVersion($versions['sinceVersion']);
        $method->initStubsMetadata()->setRemovedVersion($versions['removedVersion']);

        // Apply parsed return type data to method
        // typeFromSignature is always set (NoType if no type)
        $method->setReturnTypeFromSignature($parsedReturnType->typeFromSignature);
        $method->initStubsMetadata()->setTypeFromPhpDoc($parsedReturnType->typeFromPhpDoc);
        $method->initStubsMetadata()->setLanguageLevelTypes($parsedReturnType->languageLevelTypes);
        $method->initStubsMetadata()->setDefaultType($parsedReturnType->defaultType);

        // Parse parameters with @param types from PhpDoc, imports, namespace, and optional flags
        $parameters = [];
        foreach ($node->getParameters() as $param) {
            $parameters[] = $this->parameterParser->parseNode($param, $parsedPhpDoc->paramTypes, $imports, $namespace, $parsedPhpDoc->optionalParams);
        }
        $method->setParameters($parameters);

        return $method;
    }

}
