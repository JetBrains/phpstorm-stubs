<?php

namespace StubTests\Framework\Parsers\Stubs\PhpDoc;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\PseudoTypes\Generic as GenericType;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\AbstractList;
use phpDocumentor\Reflection\Types\AggregatedType;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Context;
use phpDocumentor\Reflection\Types\Nullable;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;
use StubTests\Framework\Parsers\Stubs\Versions\DeprecationParser;

/**
 * PhpDoc parser implementation using phpDocumentor library.
 * Parses PhpDoc comments and extracts type hints, version information, and other metadata.
 */
class PhpDocumentorParser implements PhpDocParserInterface
{
    private ?DocBlockFactory $factory = null;
    private ?TypeResolver $typeResolver = null;

    /**
     * Empty context, matching what DocBlockFactory::createInstance() resolves types against, so
     * {@see rendersStably()} re-resolves a rendering exactly as the factory originally did.
     */
    private ?Context $typeContext = null;

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
        $parsed->deprecatedSinceVersion = $this->extractDeprecatedSinceVersion($docBlock);

        // phpDocumentor silently drops @param/@return/@var tags whose type it cannot resolve
        // (e.g. phpstan/psalm types like array<TKey, TValue> or non-empty-array<int>). Recover
        // those from the raw text so the documented type is stored faithfully; narrowing to a
        // built-in type happens later, at verification time.
        $this->recoverDroppedTypes($docComment, $parsed);

        return $parsed;
    }

    /**
     * Fill in `@param`/`@return`/`@var` types that phpDocumentor dropped, reading them verbatim from
     * the raw docblock. Gaps are filled, and values phpDocumentor produced are also replaced when
     * its rendering turns out to be lossy (see {@see preferFaithfulType}); otherwise the value
     * phpDocumentor already produced is kept.
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
                    $parsed->returnType = $this->preferFaithfulType($parsed->returnType, $type);
                    break;
                case 'var':
                    $parsed->varType = $this->preferFaithfulType($parsed->varType, $type);
                    break;
                case 'param':
                    if (preg_match('/\$(\w+)/', $rest, $vm)) {
                        $parsed->paramTypes[$vm[1]] = $this->preferFaithfulType(
                            $parsed->paramTypes[$vm[1]] ?? null,
                            $type
                        );
                    }
                    break;
            }
        }
    }

    /**
     * Decide between phpDocumentor's resolved type and the verbatim type read from the raw
     * docblock.
     *
     * phpDocumentor's rendering is authoritative only when it is *lossless*. Renderings that merely
     * differ from the raw text (added `, ` after commas, FQN-prefixed identifiers, `T[]` rewritten
     * as `array<T>`, redundant parentheses dropped) are normalisation, not loss, and are kept so the
     * parsed cache does not churn. Three independent checks look for actual loss:
     *
     * 1. {@see rendersStably()} — a rendering that is not a fixed point has dropped something the
     *    raw docblock still carries.
     * 2. {@see rendersCompoundArrayAmbiguously()} — the one rendering bug that *is* a fixed point,
     *    so check 1 cannot see it.
     * 3. {@see decomposeGeneric()} — a truncated generic also renders stably; it is simply missing
     *    arguments the raw text has. Retained for the pre-6.0 `Collection` behaviour and as cover
     *    should generic truncation ever return.
     */
    private function preferFaithfulType(?string $current, string $verbatim): string
    {
        if ($current === null) {
            return $verbatim;
        }

        if (!$this->rendersStably($current) || $this->rendersCompoundArrayAmbiguously($verbatim)) {
            return $verbatim;
        }

        $resolved = $this->decomposeGeneric($current);
        $raw = $this->decomposeGeneric($verbatim);
        if ($resolved !== null && $raw !== null
            && $resolved[0] === $raw[0]
            && $raw[1] > $resolved[1]) {
            return $verbatim;
        }

        return $current;
    }

    /**
     * Whether re-resolving a rendered type string reproduces it verbatim.
     *
     * Must be given phpDocumentor's raw rendering, *before* template names are unqualified by
     * {@see \StubTests\Framework\PhpDoc\TemplateTypeNormalizer}: a bare `T` re-resolves to `\T`,
     * which would read as instability when it is only the unqualification being undone.
     *
     * A type phpDocumentor cannot re-parse is treated as unstable — if the library will not accept
     * its own output, that output is not something to store.
     */
    private function rendersStably(string $rendered): bool
    {
        if ($this->typeResolver === null) {
            $this->typeResolver = new TypeResolver();
            $this->typeContext = new Context('');
        }

        try {
            return (string)$this->typeResolver->resolve($rendered, $this->typeContext) === $rendered;
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * Whether the type contains an array whose element type is a union or intersection, which
     * phpDocumentor renders ambiguously.
     *
     * `Array_::__toString()` only reaches its unambiguous `array<…>` branch when the rendered
     * element type does not already end in `[]`; otherwise it appends `[]` to the element string.
     * For a compound element that is wrong at any nesting depth, because `A|B[]` parses as
     * `A|(B[])` and never as `(A|B)[]`. So `(int|string[])[]` renders as `int|string[][]` — a
     * different type — and `getopt()`'s `(string|false|string[]|false[])[]|false` additionally
     * loses its trailing `|false` when re-parsed.
     *
     * This cannot be decided from the rendered string alone: `int|string[]` is a perfectly ordinary
     * type that is indistinguishable from a corrupted `(int|string)[]`. Hence the check runs against
     * the resolved object graph of the *raw* text, where the grouping is still explicit.
     *
     * Deliberately over-approximating: it flags every compound-element array, including ones whose
     * element string does not end in `[]` and which therefore do render correctly, e.g.
     * `(string|false)[]` → `array<string|false>`. Those keep the author's `(string|false)[]` instead,
     * which is equally unambiguous and handled by
     * {@see \StubTests\Framework\Validator\Services\PhpStanTypeNormalizer::strip()}. Narrowing the
     * predicate would mean re-deriving which branch `Array_::__toString()` took, i.e. reimplementing
     * the buggy logic in order to second-guess it. `getopt()` is the only stub affected either way.
     *
     * Deliberately `get_class()` rather than `instanceof`: every `Array_` subclass in type-resolver
     * (`List_`, `NonEmptyArray`, `ArrayShape`, `CallableArray`, `PropertiesOf`, …) overrides
     * `__toString()` and always brackets its arguments, as does `Iterable_`. Only plain `Array_`
     * carries the ambiguous branch.
     */
    private function rendersCompoundArrayAmbiguously(string $verbatim): bool
    {
        if (!str_contains($verbatim, '[]')) {
            return false;
        }

        if ($this->typeResolver === null) {
            $this->typeResolver = new TypeResolver();
            $this->typeContext = new Context('');
        }

        try {
            $type = $this->typeResolver->resolve($verbatim, $this->typeContext);
        } catch (\Throwable) {
            return false;
        }

        return $this->containsCompoundElementArray($type);
    }

    /**
     * Recursively look for a plain `Array_` with an aggregated (union/intersection) element type.
     */
    private function containsCompoundElementArray(Type $type): bool
    {
        if ($type::class === Array_::class) {
            if ($type->getOriginalValueType() instanceof AggregatedType) {
                return true;
            }
        }

        if ($type instanceof AbstractList) {
            foreach ([$type->getOriginalKeyType(), $type->getOriginalValueType()] as $nested) {
                if ($nested !== null && $this->containsCompoundElementArray($nested)) {
                    return true;
                }
            }

            return false;
        }

        if ($type instanceof AggregatedType) {
            foreach ($type as $member) {
                if ($this->containsCompoundElementArray($member)) {
                    return true;
                }
            }

            return false;
        }

        if ($type instanceof Nullable) {
            return $this->containsCompoundElementArray($type->getActualType());
        }

        if ($type instanceof GenericType) {
            foreach ($type->getTypes() as $argument) {
                if ($this->containsCompoundElementArray($argument)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Decompose the outermost generic of a type string into its base name (without a leading
     * backslash) and the number of top-level type arguments, respecting nested `<> {} ()`.
     *
     * e.g. `\Generator<int, list<string>, void, void>` → `['Generator', 4]`.
     *
     * @return array{0: string, 1: int}|null null when the string is not a (well-formed) generic
     */
    private function decomposeGeneric(string $type): ?array
    {
        $open = strpos($type, '<');
        if ($open === false) {
            return null;
        }

        $base = ltrim(substr($type, 0, $open), '\\');
        $depth = 0;
        $args = 1;
        $closed = false;
        for ($i = $open, $len = strlen($type); $i < $len; $i++) {
            $c = $type[$i];
            if ($c === '<' || $c === '{' || $c === '(') {
                $depth++;
            } elseif ($c === '>' || $c === '}' || $c === ')') {
                $depth--;
                if ($depth === 0) {
                    $closed = true;
                    break;
                }
            } elseif ($c === ',' && $depth === 1) {
                $args++;
            }
        }

        return $closed ? [$base, $args] : null;
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

    /**
     * Read the PHP version out of `@_deprecated <version> [description]`.
     *
     * The leading version vector is a PHP language level on most entries (`@_deprecated 7.1`) but a
     * library version on others (`@_deprecated 2.3.0 use ... instead`, for PECL extensions versioned
     * independently of PHP), so only recognised PHP versions are accepted —
     * see {@see DeprecationParser::normalizePhpVersion()}. Anything else yields null, meaning
     * "deprecated regardless of version", which is how a bare `@_deprecated` already behaves.
     */
    private function extractDeprecatedSinceVersion(DocBlock $docBlock): ?string
    {
        $deprecatedTags = $docBlock->getTagsByName('deprecated');
        if (empty($deprecatedTags)) {
            return null;
        }

        $deprecatedTag = $deprecatedTags[0];
        if (!$deprecatedTag instanceof Deprecated) {
            return null;
        }

        $version = $deprecatedTag->getVersion();

        return $version === null ? null : DeprecationParser::normalizePhpVersion($version);
    }
}
