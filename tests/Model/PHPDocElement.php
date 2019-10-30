<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use phpDocumentor\Reflection\DocBlock\Tag;
use PhpParser\Node;
use StubTests\Parsers\DocFactoryProvider;

trait PHPDocElement
{
    /**
     * @var Tag[]
     */
    public $links = [];

    /**
     * @var Tag[]
     */
    public $see = [];

    /**
     * @var Tag[]
     */
    public $sinceTags = [];

    /**
     * @var Tag[]
     */
    public $deprecatedTags = [];

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

    protected function collectSinceDeprecatedVersions(Node $node): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = DocFactoryProvider::getDocFactory()->create($node->getDocComment()->getText());
                $this->sinceTags = $phpDoc->getTagsByName('since');
                $this->deprecatedTags = $phpDoc->getTagsByName('deprecated');
            } catch (Exception $e) {
                $this->parseError = $e->getMessage();
            }
        }
    }
}
