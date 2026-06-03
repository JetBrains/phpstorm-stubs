<?php

namespace StubTests\Framework\Parsers\Stubs\PhpDoc;

use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;

/**
 * Interface for PhpDoc parsers.
 * Allows switching between different PhpDoc parsing implementations
 * (e.g., phpDocumentor, PHPStan, custom parsers).
 */
interface PhpDocParserInterface
{
    /**
     * Parse a PhpDoc comment string and extract all relevant information.
     *
     * @param string|null $docComment The PhpDoc comment text (including /** *\/)
     * @return ParsedPhpDoc Parsed PhpDoc data, or empty object if parsing fails
     */
    public function parseDocComment(?string $docComment): ParsedPhpDoc;

    /**
     * Parse a PhpDoc comment from a DocCommentNode and merge with attribute information.
     * This method handles both PhpDoc tags and PhpStormStubsElementAvailable attributes,
     * with attributes taking precedence over PhpDoc tags.
     *
     * @param DocCommentNode|null $docComment The doc comment node from AST
     * @return ParsedPhpDoc Parsed and merged PhpDoc data
     */
    public function parseElementPhpDoc(?DocCommentNode $docComment): ParsedPhpDoc;
}
