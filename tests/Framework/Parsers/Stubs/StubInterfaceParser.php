<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocParserInterface;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocumentorParser;
use StubTests\Framework\Parsers\Stubs\PhpDoc\TemplateTypeNormalizer;
use StubTests\Framework\Parsers\Stubs\Types\DefaultTypeParser;
use StubTests\Framework\Parsers\Stubs\Types\TypeParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\AvailableVersionParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\DefaultAvailableVersionParser;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicNodeExtractor;
use StubTests\Framework\Parsers\Stubs\Nodes\InterfaceNode;

/**
 * Parses PHP interface nodes from AST into PHPInterface domain objects.
 * Parser-agnostic: works with any AST node implementing InterfaceNode interface.
 * Uses dedicated parsers for child entities (methods, constants).
 */
class StubInterfaceParser implements MultiEntityStubParserInterface
{
    private InterfaceNodeExtractorInterface $nodeExtractor;
    private PhpDocParserInterface $phpDocParser;
    private TypeParserInterface $typeParser;
    private AvailableVersionParserInterface $versionParser;
    private StubMethodParser $methodParser;
    private StubClassConstantParser $constantParser;

    public function __construct(
        ?InterfaceNodeExtractorInterface $nodeExtractor = null,
        ?PhpDocParserInterface $phpDocParser = null,
        ?TypeParserInterface $typeParser = null,
        ?AvailableVersionParserInterface $versionParser = null
    ) {
        $this->nodeExtractor = $nodeExtractor ?? new NikicNodeExtractor();
        $this->phpDocParser = $phpDocParser ?? new PhpDocumentorParser();
        $this->typeParser = $typeParser ?? new DefaultTypeParser();
        $this->versionParser = $versionParser ?? new DefaultAvailableVersionParser();
        $this->methodParser = new StubMethodParser($phpDocParser, $typeParser, $versionParser);
        $this->constantParser = new StubClassConstantParser($phpDocParser, $versionParser);
    }

    /**
     * Parses stub code string into PHPInterface.
     * This is a convenience method that delegates to parseNode().
     *
     * @param string $stubCode PHP stub code
     * @return PHPInterface
     */
    public function parse(string $stubCode): PHPInterface
    {
        return $this->parseNode($this->nodeExtractor->extractAllInterfaces($stubCode)[0] ?? throw new \RuntimeException('No interface found'));
    }

    /**
     * Parses an interface AST node into PHPInterface domain object.
     * Works with any InterfaceNode implementation (parser-agnostic).
     *
     * @param InterfaceNode $node The interface AST node with namespace set
     * @param array $imports Map of import aliases to fully qualified names
     * @return PHPInterface
     */
    public function parseNode(InterfaceNode $node, array $imports = []): PHPInterface
    {
        $phpInterface = new PHPInterface();

        // Basic properties
        $phpInterface->setName($node->getName());
        $phpInterface->setNamespace($node->getNamespace());

        // Set ID: if namespace is root (\), don't double the backslash
        if ($phpInterface->getNamespace() === '\\') {
            $phpInterface->setId('\\' . $phpInterface->getName());
        } else {
            $phpInterface->setId($phpInterface->getNamespace() . '\\' . $phpInterface->getName());
        }

        // Parse PhpDoc using injected parser
        $parsedPhpDoc = $this->phpDocParser->parseElementPhpDoc($node->getDocComment());

        // Apply parsed PhpDoc data to interface
        $phpInterface->initStubsMetadata()->setPhpDoc($parsedPhpDoc->rawPhpDoc);

        // Interface-level @template names propagate to methods that reference them
        $classTemplateNames = TemplateTypeNormalizer::extractTemplateNames($parsedPhpDoc->rawPhpDoc);

        // Parse and apply available version (from PhpDoc + attributes)
        $versions = $this->versionParser->parseAvailableVersion($parsedPhpDoc, $node->getAttributes(), $imports);
        $phpInterface->initStubsMetadata()->setSinceVersion($versions['sinceVersion']);
        $phpInterface->initStubsMetadata()->setRemovedVersion($versions['removedVersion']);

        // Parent interfaces (extends)
        foreach ($node->getParentInterfaceNames() as $parentInterfaceName) {
            $parentInterface = new PHPInterface();
            $parentInterface->setName($parentInterfaceName);
            $parentInterface->setNamespace($node->getNamespace());
            $parentInterface->setId($node->getNamespace() === '\\'
                ? '\\' . $parentInterfaceName
                : $node->getNamespace() . '\\' . $parentInterfaceName);
            $phpInterface->addParentInterface($parentInterface);
        }

        // Methods - pass namespace context for type resolution
        foreach ($node->getMethods() as $methodNode) {
            $phpInterface->addMethod($this->methodParser->parseNode($methodNode, $imports, $phpInterface->getNamespace(), $classTemplateNames));
        }

        // Constants
        foreach ($node->getConstants() as $constantNode) {
            $phpInterface->addConstant($this->constantParser->parseNode($constantNode, $imports));
        }

        return $phpInterface;
    }

    /**
     * Extract and parse all interfaces from stub content.
     *
     * @param string $stubContent The PHP stub file content to parse
     * @return array Array of PHPInterface objects
     */
    public function extractAndParseAll(string $stubContent): array
    {
        // Extract interface nodes and imports from stub content
        $result = $this->nodeExtractor->extractAllInterfacesWithImports($stubContent);
        $interfaces = [];

        foreach ($result as $item) {
            $interfaces[] = $this->parseNode($item['node'], $item['imports']);
        }

        return $interfaces;
    }
}
