<?php

namespace StubTests\Framework\Parsers\Stubs\PhpDoc;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use phpDocumentor\Reflection\DocBlockFactory;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;

/**
 * PhpDoc parser implementation using phpDocumentor library.
 * Parses PhpDoc comments and extracts type hints, version information, and other metadata.
 */
class PhpDocumentorParser implements PhpDocParserInterface
{
    private ?DocBlockFactory $factory = null;

    /**
     * Get or create the DocBlockFactory instance (lazy initialization).
     */
    private function getFactory(): DocBlockFactory
    {
        if ($this->factory === null) {
            $this->factory = DocBlockFactory::createInstance();
        }
        return $this->factory;
    }

    /**
     * @inheritDoc
     */
    public function parseDocComment(?string $docComment): ParsedPhpDoc
    {
        if ($docComment === null || trim($docComment) === '') {
            return new ParsedPhpDoc();
        }

        $parsed = new ParsedPhpDoc(rawPhpDoc: $docComment);

        try {
            $docBlock = $this->getFactory()->create($docComment);
        } catch (\InvalidArgumentException|\RuntimeException $e) {
            // If parsing fails, try to extract @deprecated from raw text
            $parsed->isDeprecated = str_contains($docComment, '@deprecated');
            return $parsed;
        }

        // Extract all information from DocBlock
        $parsed->returnType = $this->extractReturnType($docBlock);
        $parsed->paramTypes = $this->extractParamTypes($docBlock);
        $parsed->optionalParams = $this->extractOptionalParams($docBlock);
        $parsed->varType = $this->extractVarType($docBlock);
        $parsed->sinceVersion = $this->extractSinceVersion($docBlock);
        $parsed->removedVersion = $this->extractRemovedVersion($docBlock);
        $parsed->isDeprecated = $this->hasDeprecatedTag($docBlock);

        // phpDocumentor silently drops @param/@return/@var tags whose type it cannot resolve
        // (e.g. phpstan/psalm types like array<TKey, TValue> or non-empty-array<int>). Recover
        // those from the raw text so the documented type is stored faithfully; narrowing to a
        // built-in type happens later, at verification time.
        $this->recoverDroppedTypes($docComment, $parsed);

        return $parsed;
    }

    /**
     * Fill in @param/@return/@var types that phpDocumentor dropped, reading them verbatim from
     * the raw docblock. Only gaps are filled — values phpDocumentor already produced are kept.
     */
    private function recoverDroppedTypes(string $docComment, ParsedPhpDoc $parsed): void
    {
        // Drop the comment delimiters so single-line ("/** @var X */") and multi-line forms
        // are handled uniformly; types never contain these markers, so this is safe.
        $text = str_replace(['/**', '/*', '*/'], '', $docComment);

        foreach (explode("\n", $text) as $line) {
            if (!preg_match('/^\s*\*?\s*@(param|return|var)\b(.*)$/', $line, $m)) {
                continue;
            }

            $extracted = $this->extractLeadingType($m[2]);
            if ($extracted === null) {
                continue;
            }
            [$type, $rest] = $extracted;

            switch ($m[1]) {
                case 'return':
                    $parsed->returnType ??= $type;
                    break;
                case 'var':
                    $parsed->varType ??= $type;
                    break;
                case 'param':
                    if (preg_match('/\$(\w+)/', $rest, $vm) && !array_key_exists($vm[1], $parsed->paramTypes)) {
                        $parsed->paramTypes[$vm[1]] = $type;
                    }
                    break;
            }
        }
    }

    /**
     * Extract the leading type token from the text following a tag name, balancing `<> {} ()`.
     *
     * A top-level space ends the token unless it is glued to a `|`/`&`/`:` operator (union,
     * intersection, or callable return). Returns [type, remainder], or null when there is no
     * type (the remainder starts with `$`) or the brackets never balance (malformed/multiline) —
     * the null guard prevents consuming a description that contains stray `<`/`{`/`$`.
     *
     * @return array{0: string, 1: string}|null
     */
    private function extractLeadingType(string $s): ?array
    {
        $len = strlen($s);
        $i = 0;
        while ($i < $len && $s[$i] === ' ') {
            $i++;
        }
        if ($i >= $len || $s[$i] === '$') {
            return null;
        }

        $start = $i;
        $depth = 0;
        for (; $i < $len; $i++) {
            $c = $s[$i];
            if ($c === '<' || $c === '{' || $c === '(') {
                $depth++;
            } elseif ($c === '>' || $c === '}' || $c === ')') {
                $depth--;
                if ($depth < 0) {
                    return null;
                }
            } elseif ($depth === 0) {
                if ($c === '$') {
                    break;
                }
                if ($c === ' ') {
                    $p = $i - 1;
                    while ($p >= $start && $s[$p] === ' ') {
                        $p--;
                    }
                    $prev = $p >= $start ? $s[$p] : '';
                    $j = $i;
                    while ($j < $len && $s[$j] === ' ') {
                        $j++;
                    }
                    $next = $j < $len ? $s[$j] : '';
                    if (in_array($prev, ['|', '&', ':'], true) || in_array($next, ['|', '&', ':'], true)) {
                        continue;
                    }
                    break;
                }
            }
        }

        if ($depth !== 0) {
            return null;
        }

        $type = rtrim(substr($s, $start, $i - $start));
        if ($type === '') {
            return null;
        }

        return [$type, substr($s, $i)];
    }

    /**
     * @inheritDoc
     */
    public function parseElementPhpDoc(?DocCommentNode $docComment): ParsedPhpDoc
    {
        $docText = $docComment?->getText();
        return $this->parseDocComment($docText);
    }

    private function extractReturnType(DocBlock $docBlock): ?string
    {
        $returnTags = $docBlock->getTagsByName('return');
        if (empty($returnTags)) {
            return null;
        }

        $returnTag = $returnTags[0];
        if ($returnTag instanceof Return_) {
            $type = $returnTag->getType();
            return $type !== null ? (string)$type : null;
        }

        return null;
    }

    private function extractParamTypes(DocBlock $docBlock): array
    {
        $paramTypesMap = [];
        $paramTags = $docBlock->getTagsByName('param');

        foreach ($paramTags as $paramTag) {
            if ($paramTag instanceof Param) {
                $varName = $paramTag->getVariableName();
                $type = $paramTag->getType();

                if ($varName !== null && $type !== null) {
                    // Remove $ prefix if present
                    $varName = ltrim($varName, '$');
                    $paramTypesMap[$varName] = (string)$type;
                }
            }
        }

        return $paramTypesMap;
    }

    /**
     * Extract names of parameters marked as [optional] in their param description.
     *
     * Stubs use the pattern `param type $name [optional] description` to indicate
     * that a parameter is optional even when it has no default value in the signature.
     *
     * @return string[] List of parameter names (without $) marked as [optional]
     */
    private function extractOptionalParams(DocBlock $docBlock): array
    {
        $optionalParams = [];
        $paramTags = $docBlock->getTagsByName('param');

        foreach ($paramTags as $paramTag) {
            if ($paramTag instanceof Param) {
                $varName = $paramTag->getVariableName();
                $description = (string)$paramTag->getDescription();

                if ($varName !== null && str_contains($description, '[optional]')) {
                    $optionalParams[] = ltrim($varName, '$');
                }
            }
        }

        return $optionalParams;
    }

    private function extractVarType(DocBlock $docBlock): ?string
    {
        $varTags = $docBlock->getTagsByName('var');
        if (empty($varTags)) {
            return null;
        }

        $varTag = $varTags[0];
        if ($varTag instanceof Var_) {
            $type = $varTag->getType();
            return $type !== null ? (string)$type : null;
        }

        return null;
    }

    private function extractSinceVersion(DocBlock $docBlock): ?string
    {
        $sinceTags = $docBlock->getTagsByName('since');
        if (empty($sinceTags)) {
            return null;
        }

        $sinceTag = $sinceTags[0];
        if ($sinceTag instanceof Since) {
            return $sinceTag->getVersion();
        }

        return null;
    }

    private function extractRemovedVersion(DocBlock $docBlock): ?string
    {
        $removedTags = $docBlock->getTagsByName('removed');
        if (empty($removedTags)) {
            return null;
        }

        $removedTag = $removedTags[0];
        if ($removedTag instanceof Generic) {
            return (string)$removedTag->getDescription();
        }

        return null;
    }

    private function hasDeprecatedTag(DocBlock $docBlock): bool
    {
        $deprecatedTags = $docBlock->getTagsByName('deprecated');
        return !empty($deprecatedTags);
    }
}
