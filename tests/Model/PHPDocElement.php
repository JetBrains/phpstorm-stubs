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

    /**
     * @var string[]
     */
    public array $tagNames = [];

    public bool $hasInternalMetaTag = false;

    protected function collectTags(Node $node): void{
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = DocFactoryProvider::getDocFactory()->create($node->getDocComment()->getText());
                $tags = $phpDoc->getTags();
                foreach ($tags as $tag){
                    $this->tagNames[] = $tag->getName();
                }
                $this->links = $phpDoc->getTagsByName('link');
                $this->see = $phpDoc->getTagsByName('see');
                $this->sinceTags = $phpDoc->getTagsByName('since');
                $this->deprecatedTags = $phpDoc->getTagsByName('deprecated');
                $this->removedTags = $phpDoc->getTagsByName('removed');
                $this->hasInternalMetaTag = $phpDoc->hasTag('meta');
            } catch (Exception $e) {
                $this->parseError = $e;
            }
        }
    }
}
