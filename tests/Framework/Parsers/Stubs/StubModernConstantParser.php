<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicNodeExtractor;
use StubTests\Framework\Parsers\Stubs\Nodes\ConstantDefinitionNode;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocParserInterface;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocumentorParser;
use StubTests\Framework\Parsers\Stubs\Versions\AvailableVersionParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\DefaultAvailableVersionParser;

/**
 * Parses modern global const declarations from AST into PHPConstant domain objects.
 * Handles const statements like: const A = 1; const int B = 2, C = 3;
 * Parser-agnostic: works with any AST node implementing ConstantDefinitionNode interface.
 */
class StubModernConstantParser implements MultiEntityStubParserInterface
{
    private ConstantNodeExtractorInterface $nodeExtractor;
    private PhpDocParserInterface $phpDocParser;
    private AvailableVersionParserInterface $versionParser;

    public function __construct(
        ?ConstantNodeExtractorInterface $nodeExtractor = null,
        ?PhpDocParserInterface $phpDocParser = null,
        ?AvailableVersionParserInterface $versionParser = null
    ) {
        $this->nodeExtractor = $nodeExtractor ?? new NikicNodeExtractor();
        $this->phpDocParser = $phpDocParser ?? new PhpDocumentorParser();
        $this->versionParser = $versionParser ?? new DefaultAvailableVersionParser();
    }

    /**
     * Parses stub code string into PHPConstant array.
     * This is a convenience method that parses all const declarations in the code.
     *
     * @param string $stubCode PHP stub code
     * @return PHPConstant[]
     */
    public function parse(string $stubCode): array
    {
        $nodes = $this->nodeExtractor->extractAllModernConstants($stubCode);
        $constants = [];
        foreach ($nodes as $node) {
            $constants[] = $this->parseNode($node);
        }
        return $constants;
    }

    /**
     * Parses a constant definition AST node into PHPConstant domain object.
     * Works with any ConstantDefinitionNode implementation (parser-agnostic).
     *
     * @param ConstantDefinitionNode $node The constant definition AST node with namespace set
     * @return PHPConstant
     */
    public function parseNode(ConstantDefinitionNode $node): PHPConstant
    {
        $phpConstant = new PHPConstant();

        // Basic properties
        $phpConstant->setName($node->getName());
        $phpConstant->setNamespace($node->getNamespace());

        // Set ID: if namespace is root (\), don't double the backslash
        if ($phpConstant->getNamespace() === '\\') {
            $phpConstant->setId('\\' . $phpConstant->getName());
        } else {
            $phpConstant->setId($phpConstant->getNamespace() . '\\' . $phpConstant->getName());
        }

        // Value is already extracted as a plain scalar by the adapter
        $phpConstant->setValue($node->getValue());

        // Make the value resolvable to parameter default-value evaluation, which would
        // otherwise depend on the constant being defined in the host runtime.
        StubConstantRegistry::register($phpConstant->getId(), $phpConstant->getValue());

        // Parse PhpDoc and version availability (@since/@removed)
        $parsedPhpDoc = $this->phpDocParser->parseElementPhpDoc($node->getDocComment());
        $phpConstant->initStubsMetadata()->setPhpDoc($parsedPhpDoc->rawPhpDoc);
        $versions = $this->versionParser->parseAvailableVersion($parsedPhpDoc, [], []);
        $phpConstant->initStubsMetadata()->setSinceVersion($versions['sinceVersion']);
        $phpConstant->initStubsMetadata()->setRemovedVersion($versions['removedVersion']);

        return $phpConstant;
    }

    /**
     * Extract and parse all modern const declarations from stub content.
     *
     * @param string $stubContent The PHP stub file content to parse
     * @return array Array of PHPConstant objects
     */
    public function extractAndParseAll(string $stubContent): array
    {
        return $this->parse($stubContent);
    }
}
