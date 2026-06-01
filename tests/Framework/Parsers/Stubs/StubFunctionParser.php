<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocParserInterface;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocumentorParser;
use StubTests\Framework\Parsers\Stubs\PhpDoc\TemplateTypeNormalizer;
use StubTests\Framework\Parsers\Stubs\Types\DefaultTypeParser;
use StubTests\Framework\Parsers\Stubs\Types\TypeParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\AvailableVersionParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\DefaultAvailableVersionParser;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicNodeExtractor;
use StubTests\Framework\Parsers\Stubs\Nodes\FunctionNode;

/**
 * Parses PHP function nodes from AST into PHPFunction domain objects.
 * Parser-agnostic: works with any AST node implementing FunctionNode interface.
 * Uses dedicated parser for child entities (parameters).
 */
class StubFunctionParser implements MultiEntityStubParserInterface
{
    use AttributeDetectionTrait;
    private FunctionNodeExtractorInterface $nodeExtractor;
    private PhpDocParserInterface $phpDocParser;
    private TypeParserInterface $typeParser;
    private AvailableVersionParserInterface $versionParser;
    private StubParameterParser $parameterParser;

    public function __construct(
        ?FunctionNodeExtractorInterface $nodeExtractor = null,
        ?PhpDocParserInterface $phpDocParser = null,
        ?TypeParserInterface $typeParser = null,
        ?AvailableVersionParserInterface $versionParser = null
    ) {
        $this->nodeExtractor = $nodeExtractor ?? new NikicNodeExtractor();
        $this->phpDocParser = $phpDocParser ?? new PhpDocumentorParser();
        $this->typeParser = $typeParser ?? new DefaultTypeParser();
        $this->versionParser = $versionParser ?? new DefaultAvailableVersionParser();
        $this->parameterParser = new StubParameterParser($typeParser, $versionParser);
    }

    /**
     * Parses stub code string into PHPFunction.
     * This is a convenience method that delegates to parseNode().
     *
     * @param string $stubCode PHP stub code
     * @return PHPFunction
     */
    public function parse(string $stubCode): PHPFunction
    {
        return $this->parseNode($this->nodeExtractor->extractFunction($stubCode));
    }

    /**
     * Parses a function AST node into PHPFunction domain object.
     * Works with any FunctionNode implementation (parser-agnostic).
     *
     * @param FunctionNode $node The function AST node with namespace set
     * @return PHPFunction
     */
    public function parseNode(FunctionNode $node): PHPFunction
    {
        $phpFunction = new PHPFunction();

        // Basic properties
        $phpFunction->setName($node->getName());
        $phpFunction->setNamespace($node->getNamespace());

        // Set ID
        if ($phpFunction->getNamespace() === '\\') {
            $phpFunction->setId('\\' . $phpFunction->getName());
        } else {
            $phpFunction->setId($phpFunction->getNamespace() . '\\' . $phpFunction->getName());
        }

        // Parse PhpDoc using injected parser
        $parsedPhpDoc = $this->phpDocParser->parseElementPhpDoc($node->getDocComment());

        // Get imports for resolving attribute aliases
        $imports = $node->getImports();

        // Parse return type using injected type parser with namespace context
        $parsedReturnType = $this->typeParser->parseType(
            $node->getReturnType(),
            $parsedPhpDoc->returnType,
            $node->getAttributes(),
            $imports,
            $phpFunction->getNamespace()
        );

        // Apply parsed PhpDoc data to function
        $phpFunction->initStubsMetadata()->setPhpDoc($parsedPhpDoc->rawPhpDoc);
        $phpFunction->setDeprecated($parsedPhpDoc->isDeprecated || $this->hasDeprecatedAttribute($node->getAttributes(), $imports));
        $phpFunction->setHasTentativeReturnType($this->hasTentativeTypeAttribute($node->getAttributes(), $imports));

        // Parse and apply available version (from PhpDoc + attributes)
        $versions = $this->versionParser->parseAvailableVersion($parsedPhpDoc, $node->getAttributes(), $imports);
        $phpFunction->initStubsMetadata()->setSinceVersion($versions['sinceVersion']);
        $phpFunction->initStubsMetadata()->setRemovedVersion($versions['removedVersion']);

        // Apply parsed return type data to function
        // typeFromSignature is always set (NoType if no type)
        $phpFunction->setReturnTypeFromSignature($parsedReturnType->typeFromSignature);
        $phpFunction->initStubsMetadata()->setTypeFromPhpDoc($parsedReturnType->typeFromPhpDoc);
        $phpFunction->initStubsMetadata()->setLanguageLevelTypes($parsedReturnType->languageLevelTypes);
        $phpFunction->initStubsMetadata()->setDefaultType($parsedReturnType->defaultType);

        // Parse parameters with @param types from PhpDoc, imports, namespace, and optional flags
        $parameters = [];
        foreach ($node->getParameters() as $param) {
            $parameters[] = $this->parameterParser->parseNode($param, $parsedPhpDoc->paramTypes, $imports, $phpFunction->getNamespace(), $parsedPhpDoc->optionalParams);
        }
        $phpFunction->setParameters($parameters);

        // Store @template names (e.g. T, TValue) bare rather than as the FQN `\T` phpDocumentor emits
        $templateNames = TemplateTypeNormalizer::extractTemplateNames($parsedPhpDoc->rawPhpDoc);
        if ($templateNames !== []) {
            $returnMeta = $phpFunction->getStubsMetadata();
            if ($returnMeta !== null) {
                $returnMeta->setTypeFromPhpDoc(
                    TemplateTypeNormalizer::unqualify($returnMeta->getTypeFromPhpDoc(), $templateNames)
                );
            }
            foreach ($phpFunction->getParameters() as $functionParam) {
                $paramMeta = $functionParam->getStubsMetadata();
                if ($paramMeta !== null) {
                    $paramMeta->setTypeFromPhpDoc(
                        TemplateTypeNormalizer::unqualify($paramMeta->getTypeFromPhpDoc(), $templateNames)
                    );
                }
            }
        }

        return $phpFunction;
    }

    /**
     * Extract and parse all functions from stub content.
     *
     * @param string $stubContent The PHP stub file content to parse
     * @return array Array of PHPFunction objects
     */
    public function extractAndParseAll(string $stubContent): array
    {
        $functionNodes = $this->nodeExtractor->extractAllFunctions($stubContent);
        $functions = [];

        foreach ($functionNodes as $functionNode) {
            $functions[] = $this->parseNode($functionNode);
        }

        return $functions;
    }
}
