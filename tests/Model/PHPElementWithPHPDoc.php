<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use phpDocumentor\Reflection\DocBlock\Tag;
use PhpParser\Node;
use StubTests\Parsers\DocFactoryProvider;

abstract class PHPElementWithPHPDoc extends BasePHPElement
{
    /**
     * @var Tag[]
     */
    public $links = [];

    /**
     * @var Tag[]
     */
    public $see = [];

    protected function collectLinks(Node $node): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = DocFactoryProvider::getDocFactory()->create($node->getDocComment()->getText());
                $this->links = $phpDoc->getTagsByName('link');
                $this->see = $phpDoc->getTagsByName('see');
            } catch (Exception $e) {
                $this->parseError = $e->getMessage();
            }
        }
    }
}
