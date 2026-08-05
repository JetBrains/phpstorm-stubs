<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\PhpDoc\ParsedPhpDoc;
use StubTests\Framework\Parsers\Stubs\Types\DefaultTypeParser;
use StubTests\Framework\Parsers\Stubs\Types\TypeParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\AvailableVersionParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\DefaultAvailableVersionParser;
use StubTests\Framework\Parsers\Stubs\Versions\DeprecationParser;
use StubTests\Framework\Model\PHPParameter;
use StubTests\Framework\Parsers\Stubs\Nodes\ParameterNode;

/**
 * Parses ParameterNode AST nodes into PHPParameter domain objects.
 * Extracts parameter name and LanguageLevelTypeAware attributes.
 */
class StubParameterParser
{
    private TypeParserInterface $typeParser;
    private AvailableVersionParserInterface $versionParser;
    private DeprecationParser $deprecationParser;

    public function __construct(
        ?TypeParserInterface $typeParser = null,
        ?AvailableVersionParserInterface $versionParser = null
    ) {
        $this->typeParser = $typeParser ?? new DefaultTypeParser();
        $this->versionParser = $versionParser ?? new DefaultAvailableVersionParser();
        $this->deprecationParser = new DeprecationParser();
    }

    /**
     * Parses a parameter AST node into PHPParameter domain object.
     *
     * @param ParameterNode $node The parameter AST node
     * @param array $paramTypesFromPhpDoc Map of parameter name => type from @param tags
     * @param array $imports Map of import aliases to fully qualified names
     * @param string $namespace Current namespace context (e.g., '\Dom' or '\\' for global)
     * @param string[] $optionalParamsFromPhpDoc Names of params marked [optional] in @param descriptions
     * @param int $position Zero-based index of the parameter in the signature. Supplied by the
     *     caller because a bare AST parameter node does not know its own index — only the
     *     enclosing function/method does. The reflection side populates the same field from
     *     ReflectionParameter::getPosition(), so the two must agree for any positional comparison
     *     to mean anything.
     * @return PHPParameter
     */
    public function parseNode(ParameterNode $node, array $paramTypesFromPhpDoc = [], array $imports = [], string $namespace = '\\', array $optionalParamsFromPhpDoc = [], int $position = 0): PHPParameter
    {
        $parameter = new PHPParameter($node->getName());
        $parameter->setPosition($position);

        // Match parameter type from PhpDoc @param tags
        $paramName = $node->getName();
        $phpDocType = $paramTypesFromPhpDoc[$paramName] ?? null;

        // Parse type using injected type parser with namespace context
        $parsedType = $this->typeParser->parseType(
            $node->getType(),  // Get parameter type from signature
            $phpDocType,
            $node->getAttributes(),
            $imports,
            $namespace
        );

        // Apply parsed type data to parameter
        // typeFromSignature is always set (NoType if no type)
        $parameter->setType($parsedType->typeFromSignature);
        $parameter->initStubsMetadata()->setTypeFromPhpDoc($parsedType->typeFromPhpDoc);
        $parameter->initStubsMetadata()->setLanguageLevelTypes($parsedType->languageLevelTypes);
        $parameter->initStubsMetadata()->setDefaultType($parsedType->defaultType);

        // Set variadic and by-reference flags from AST node
        $parameter->setIsVariadic($node->isVariadic());
        $parameter->setIsPassedByReference($node->isPassedByReference());

        // Set hasDefaultValue from AST node; defer actual evaluation until the value is needed
        $hasDefault = $node->hasDefaultValue();
        $parameter->setHasDefaultValue($hasDefault);

        if ($hasDefault) {
            $parameter->setDefaultValueEvaluator(fn () => $node->getDefaultValue());
        }

        // A parameter is optional if it has a default value, is variadic,
        // or is explicitly marked [optional] in the PhpDoc @param description.
        $isOptional = $hasDefault
            || $node->isVariadic()
            || in_array($paramName, $optionalParamsFromPhpDoc, true);
        $parameter->setIsOptional($isOptional);

        // Detect #[Deprecated] attribute on the parameter. Parameters carry no PhpDoc of their
        // own, so the attribute is the only deprecation source here.
        $deprecation = $this->deprecationParser->parseDeprecation($node->getAttributes(), $imports);
        $parameter->setDeprecated($deprecation->isDeprecated);
        $parameter->initStubsMetadata()->setDeprecatedSinceVersion($deprecation->sinceVersion);

        // Parse available version from attributes using version parser with import context
        // Note: Parameters typically don't have PhpDoc, only attributes
        $emptyPhpDoc = new ParsedPhpDoc();
        $versions = $this->versionParser->parseAvailableVersion($emptyPhpDoc, $node->getAttributes(), $imports);
        $parameter->initStubsMetadata()->setSinceVersion($versions['sinceVersion']);
        $parameter->initStubsMetadata()->setRemovedVersion($versions['removedVersion']);

        return $parameter;
    }
}
