<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\AvailableVersionParserInterface;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicNodeExtractor;
use StubTests\Framework\Parsers\Stubs\Nodes\EnumNode;

/**
 * Parses PHP enum nodes from AST into PHPEnum domain objects.
 * Parser-agnostic: works with any AST node implementing EnumNode interface.
 * Uses dedicated parsers for child entities (methods, constants).
 */
class StubEnumParser implements MultiEntityStubParserInterface
{
    private EnumNodeExtractorInterface $nodeExtractor;
    private StubMethodParser $methodParser;
    private StubClassConstantParser $constantParser;

    public function __construct(
        ?EnumNodeExtractorInterface $nodeExtractor = null,
        ?PhpDocParserInterface $phpDocParser = null,
        ?AvailableVersionParserInterface $versionParser = null
    ) {
        $this->nodeExtractor = $nodeExtractor ?? new NikicNodeExtractor();
        $this->methodParser = new StubMethodParser($phpDocParser, null, $versionParser);
        $this->constantParser = new StubClassConstantParser($phpDocParser, $versionParser);
    }

    /**
     * Parses stub code string into PHPEnum.
     * This is a convenience method that delegates to parseNode().
     *
     * @param string $stubCode PHP stub code
     * @return PHPEnum
     */
    public function parse(string $stubCode): PHPEnum
    {
        return $this->parseNode($this->nodeExtractor->extractAllEnums($stubCode)[0] ?? throw new \RuntimeException('No enum found'));
    }

    /**
     * Parses an enum AST node into PHPEnum domain object.
     * Works with any EnumNode implementation (parser-agnostic).
     *
     * @param EnumNode $node The enum AST node with namespace set
     * @param array $imports Map of import aliases to fully qualified names
     * @return PHPEnum
     */
    public function parseNode(EnumNode $node, array $imports = []): PHPEnum
    {
        $phpEnum = new PHPEnum();

        // Basic properties
        $phpEnum->setName($node->getName());
        $phpEnum->setNamespace($node->getNamespace());

        // Set ID: if namespace is root (\), don't double the backslash
        if ($phpEnum->getNamespace() === '\\') {
            $phpEnum->setId('\\' . $phpEnum->getName());
        } else {
            $phpEnum->setId($phpEnum->getNamespace() . '\\' . $phpEnum->getName());
        }

        // Enum-specific properties
        $phpEnum->setIsFinal($node->isFinal()); // Always true for enums
        $phpEnum->setIsReadonly(false); // Enums are not readonly

        // Implemented interfaces
        foreach ($node->getImplementedInterfaceNames() as $interfaceName) {
            $phpInterface = new PHPInterface();
            $phpInterface->setName($interfaceName);
            $phpEnum->addImplementedInterface($phpInterface);
        }

        // Constants
        foreach ($node->getConstants() as $constantNode) {
            $constant = $this->constantParser->parseNode($constantNode, $imports);
            $phpEnum->addConstant($constant);
            StubConstantRegistry::register($phpEnum->getId() . '::' . $constant->getName(), $constant->getValue());
        }

        // Methods - pass namespace context for type resolution
        foreach ($node->getMethods() as $methodNode) {
            $phpEnum->addMethod($this->methodParser->parseNode($methodNode, $imports, $phpEnum->getNamespace()));
        }

        // Cases
        $caseNames = $node->getCaseNames();
        $phpEnum->setCases($caseNames);

        // Register each case so a parameter default that references one
        // (e.g. `\Uri\UriComparisonMode::ExcludeFragment`) can still be resolved
        // when the declaring extension is not loaded in the cache-generating
        // process. A pure enum case has no scalar value, so we store a reference
        // carrying the enum FQN; the serializer renders it identically to the
        // runtime-resolved enum instance ("[object:Uri\UriComparisonMode]").
        foreach ($caseNames as $caseName) {
            StubConstantRegistry::register(
                $phpEnum->getId() . '::' . $caseName,
                new StubEnumCaseReference($phpEnum->getId())
            );
        }

        return $phpEnum;
    }

    /**
     * Extract and parse all enums from stub content.
     *
     * @param string $stubContent The PHP stub file content to parse
     * @return array Array of PHPEnum objects
     */
    public function extractAndParseAll(string $stubContent): array
    {
        // Extract enum nodes and imports from stub content
        $result = $this->nodeExtractor->extractAllEnumsWithImports($stubContent);
        $enums = [];

        foreach ($result as $item) {
            $enums[] = $this->parseNode($item['node'], $item['imports']);
        }

        return $enums;
    }
}
