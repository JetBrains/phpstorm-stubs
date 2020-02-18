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
    public array $links = [];

    /**
     * @var Tag[]
     */
    public array $see = [];

    /**
     * @var Tag[]
     */
    public array $sinceTags = [];

    /**
     * @var Tag[]
     */
    public array $deprecatedTags = [];

    /**
     * @var Tag[]
     */
    public array $removedTags = [];

    public bool $hasInternalMetaTag = false;

    protected function collectLinks(Node $node): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = DocFactoryProvider::getDocFactory()->create($node->getDocComment()->getText());
                $this->links = $phpDoc->getTagsByName('link');
                $this->see = $phpDoc->getTagsByName('see');
            } catch (Exception $e) {
                $this->parseError = $e;
            }
        }
    }

    protected function collectSinceRemovedDeprecatedVersions(Node $node): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = DocFactoryProvider::getDocFactory()->create($node->getDocComment()->getText());
                $this->sinceTags = $phpDoc->getTagsByName('since');
                $this->deprecatedTags = $phpDoc->getTagsByName('deprecated');
                $this->removedTags = $phpDoc->getTagsByName('removed');
            } catch (Exception $e) {
                $this->parseError = $e;
            }
        }
    }

    protected function checkIfHasInternalMetaTag(Node $node): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = DocFactoryProvider::getDocFactory()->create($node->getDocComment()->getText());
                $this->hasInternalMetaTag = $phpDoc->hasTag('meta');
            } catch (Exception $e) {
                $this->parseError = $e;
            }
        }
    }
}
