<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocParserInterface;
use StubTests\Framework\Parsers\Stubs\PhpDoc\PhpDocumentorParser;
use StubTests\Framework\Parsers\Stubs\PhpDoc\TemplateTypeNormalizer;
use StubTests\Framework\Parsers\Stubs\Types\DefaultTypeParser;
use StubTests\Framework\Parsers\Stubs\Types\TypeParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\AvailableVersionParserInterface;
use StubTests\Framework\Parsers\Stubs\Versions\DefaultAvailableVersionParser;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicNodeExtractor;
use StubTests\Framework\Parsers\Stubs\Nodes\ClassNode;

/**
 * Parses PHP class nodes from AST into PHPClass domain objects.
 * Parser-agnostic: works with any AST node implementing ClassNode interface.
 * Uses dedicated parsers for child entities (methods, properties, constants).
 */
class StubClassParser implements MultiEntityStubParserInterface
{
    private ClassNodeExtractorInterface $nodeExtractor;
    private PhpDocParserInterface $phpDocParser;
    private TypeParserInterface $typeParser;
    private AvailableVersionParserInterface $versionParser;
    private StubMethodParser $methodParser;
    private StubPropertyParser $propertyParser;
    private StubClassConstantParser $constantParser;

    public function __construct(
        ?ClassNodeExtractorInterface $nodeExtractor = null,
        ?PhpDocParserInterface $phpDocParser = null,
        ?TypeParserInterface $typeParser = null,
        ?AvailableVersionParserInterface $versionParser = null
    ) {
        $this->nodeExtractor = $nodeExtractor ?? new NikicNodeExtractor();
        $this->phpDocParser = $phpDocParser ?? new PhpDocumentorParser();
        $this->typeParser = $typeParser ?? new DefaultTypeParser();
        $this->versionParser = $versionParser ?? new DefaultAvailableVersionParser();
        $this->methodParser = new StubMethodParser($phpDocParser, $typeParser, $versionParser);
        $this->propertyParser = new StubPropertyParser($phpDocParser, $typeParser, $versionParser);
        $this->constantParser = new StubClassConstantParser($phpDocParser, $versionParser);
    }

    /**
     * Parses stub code string into PHPClass.
     * This is a convenience method that delegates to parseNode().
     *
     * @param string $stubCode PHP stub code
     * @return PHPClass
     */
    public function parse(string $stubCode): PHPClass
    {
        return $this->parseNode($this->nodeExtractor->extractClass($stubCode));
    }

    /**
     * Parses a class AST node into PHPClass domain object.
     * Works with any ClassNode implementation (parser-agnostic).
     *
     * @param ClassNode $node The class AST node with namespace set
     * @param array $imports Map of import aliases to fully qualified names
     * @return PHPClass
     */
    public function parseNode(ClassNode $node, array $imports = []): PHPClass
    {
        $phpClass = new PHPClass();

        // Basic properties
        $phpClass->setName($node->getName());
        $phpClass->setNamespace($node->getNamespace());

        // Set ID: if namespace is root (\), don't double the backslash
        if ($phpClass->getNamespace() === '\\') {
            $phpClass->setId('\\' . $phpClass->getName());
        } else {
            $phpClass->setId($phpClass->getNamespace() . '\\' . $phpClass->getName());
        }

        $phpClass->setIsFinal($node->isFinal());
        $phpClass->setIsReadonly($node->isReadonly());

        // Parse PhpDoc using injected parser
        $parsedPhpDoc = $this->phpDocParser->parseElementPhpDoc($node->getDocComment());

        // Apply parsed PhpDoc data to class
        $phpClass->initStubsMetadata()->setPhpDoc($parsedPhpDoc->rawPhpDoc);

        // Class-level @template names propagate to methods/properties that reference them
        $classTemplateNames = TemplateTypeNormalizer::extractTemplateNames($parsedPhpDoc->rawPhpDoc);

        // Parse and apply available version (from PhpDoc + attributes)
        $attributeNodes = $node->getAttributes();
        $versions = $this->versionParser->parseAvailableVersion($parsedPhpDoc, $attributeNodes, $imports);
        $phpClass->initStubsMetadata()->setSinceVersion($versions['sinceVersion']);
        $phpClass->initStubsMetadata()->setRemovedVersion($versions['removedVersion']);

        // Retain the class-level attributes (name + evaluated arguments) so checks can
        // compare them against reflection - e.g. the `#[Attribute(...)]` target flags.
        $attributes = [];
        foreach ($attributeNodes as $attributeNode) {
            $attributes[] = [
                'name' => $attributeNode->getName(),
                'arguments' => $attributeNode->getArguments(),
            ];
        }
        $phpClass->setAttributes($attributes);

        // Parent class. getName() keeps the short name as written in the source, while
        // getId() carries the fully qualified name resolved against the current namespace
        // and use-imports (e.g. `extends Exception` inside `namespace FFI` -> \FFI\Exception).
        // This mirrors how the class itself stores name vs. id and matches the FQN reported
        // by reflection, which ClassHierarchyResolver / ClassParentClassCheck rely on.
        $parentClassName = $node->getParentClassName();
        if ($parentClassName) {
            $parentClass = new PHPClass();
            $parentClass->setName($this->shortName($parentClassName));
            $parentClass->setId($this->resolveClassName($parentClassName, $imports, $phpClass->getNamespace()));
            $phpClass->setParentClass($parentClass);
        }

        // Interfaces - name/id resolved the same way as the parent class.
        foreach ($node->getInterfaceNames() as $interfaceName) {
            $phpInterface = new PHPInterface();
            $phpInterface->setName($this->shortName($interfaceName));
            $phpInterface->setId($this->resolveClassName($interfaceName, $imports, $phpClass->getNamespace()));
            $phpClass->addImplementedInterface($phpInterface);
        }

        // Methods - pass namespace context for type resolution
        foreach ($node->getMethods() as $methodNode) {
            $phpClass->addMethod($this->methodParser->parseNode($methodNode, $imports, $phpClass->getNamespace(), $classTemplateNames));
        }

        // Properties - pass namespace context for type resolution
        foreach ($node->getProperties() as $propertyNode) {
            $phpClass->addProperty($this->propertyParser->parseNode($propertyNode, $imports, $phpClass->getNamespace(), $classTemplateNames));
        }

        // Constants
        foreach ($node->getConstants() as $constantNode) {
            $constant = $this->constantParser->parseNode($constantNode, $imports);
            $phpClass->addConstant($constant);
            StubConstantRegistry::register($phpClass->getId() . '::' . $constant->getName(), $constant->getValue());
        }

        return $phpClass;
    }

    /**
     * Return the short (unqualified) form of a class-like name written in the stub source.
     *
     * @param string $name The name as written (may be qualified, e.g. `Foo\Bar` or `\Foo\Bar`)
     * @return string The last name segment (e.g. `Bar`)
     */
    private function shortName(string $name): string
    {
        $pos = strrpos($name, '\\');
        return $pos === false ? $name : substr($name, $pos + 1);
    }

    /**
     * Resolve a class-like name (parent class or implemented interface) to a fully
     * qualified name using PHP name-resolution rules, mirroring
     * {@see TypeNodeConverter::resolveTypeName()} so class references and type hints
     * resolve identically.
     *
     * @param string $name The name as written in the stub source
     * @param array $imports Map of import aliases to fully qualified names
     * @param string $namespace Current namespace context (e.g. '\FFI' or '\\' for global)
     * @return string Fully qualified name (leading backslash)
     */
    private function resolveClassName(string $name, array $imports, string $namespace): string
    {
        // Already fully qualified.
        if (str_starts_with($name, '\\')) {
            return $name;
        }

        // Aliased/imported name (e.g. `use FFI\Exception;` then `extends Exception`).
        if (isset($imports[$name])) {
            $resolved = $imports[$name];
            return str_starts_with($resolved, '\\') ? $resolved : '\\' . $resolved;
        }

        // Qualified but not imported (contains a separator) - treat as global-qualified.
        if (str_contains($name, '\\')) {
            return '\\' . $name;
        }

        // Unqualified name resolves relative to the current namespace.
        return $namespace === '\\' ? '\\' . $name : $namespace . '\\' . $name;
    }

    /**
     * Extract and parse all classes from stub content.
     *
     * @param string $stubContent The PHP stub file content to parse
     * @return array Array of PHPClass objects
     */
    public function extractAndParseAll(string $stubContent): array
    {
        // Extract class nodes and imports from stub content
        $result = $this->nodeExtractor->extractAllClassesWithImports($stubContent);
        $classes = [];

        foreach ($result as $item) {
            $classes[] = $this->parseNode($item['node'], $item['imports']);
        }

        return $classes;
    }
}
