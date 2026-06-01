<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocParserInterface;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocumentorParser;
use StubTests\Framework\Parsers\Stubs\PhpDoc\TemplateTypeNormalizer;
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
     * @param string[] $classTemplateNames @template names declared on the enclosing class/interface
     * @return PHPMethod
     */
    public function parseNode(MethodNode $node, array $imports = [], string $namespace = '\\', array $classTemplateNames = []): PHPMethod
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

        // Template names (`TValue`, ...) must be stored bare, not as the FQN `\TValue` that
        // phpDocumentor produces. The relevant names are those declared on the enclosing
        // class/interface plus any declared on the method itself (e.g. @template TNewValue).
        $templateNames = array_merge(
            $classTemplateNames,
            TemplateTypeNormalizer::extractTemplateNames($parsedPhpDoc->rawPhpDoc)
        );
        $this->unqualifyTemplateTypes($method, $templateNames);

        return $method;
    }

    /**
     * Strip phpDocumentor's spurious FQN backslash from template names in a callable's
     * documented return type and parameter types.
     *
     * @param PHPMethod $callable
     * @param string[] $templateNames
     */
    private function unqualifyTemplateTypes(PHPMethod $callable, array $templateNames): void
    {
        if ($templateNames === []) {
            return;
        }

        $returnMeta = $callable->getStubsMetadata();
        if ($returnMeta !== null) {
            $returnMeta->setTypeFromPhpDoc(
                TemplateTypeNormalizer::unqualify($returnMeta->getTypeFromPhpDoc(), $templateNames)
            );
        }

        foreach ($callable->getParameters() as $param) {
            $paramMeta = $param->getStubsMetadata();
            if ($paramMeta !== null) {
                $paramMeta->setTypeFromPhpDoc(
                    TemplateTypeNormalizer::unqualify($paramMeta->getTypeFromPhpDoc(), $templateNames)
                );
            }
        }
    }

}
