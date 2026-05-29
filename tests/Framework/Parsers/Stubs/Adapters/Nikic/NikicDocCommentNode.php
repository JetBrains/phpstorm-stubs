<?php

namespace StubTests\Framework\Parsers\Stubs\Adapters\Nikic;

use PhpParser\Comment\Doc;
use StubTests\Framework\Parsers\Stubs\Nodes\DocCommentNode;

/**
 * Adapter for nikic/php-parser Doc comment nodes.
 */
class NikicDocCommentNode implements DocCommentNode
{
    private Doc $docComment;

    public function __construct(Doc $docComment)
    {
        $this->docComment = $docComment;
    }

    public function getText(): string
    {
        return $this->docComment->getText();
    }
}
