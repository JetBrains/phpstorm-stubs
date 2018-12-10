<?php

namespace Model;

use Exception;
use Parsers\DocFactoryProvider;
use PhpParser\Node;

abstract class PHPElementWithPHPDoc extends BasePHPElement
{
    public $links = [];
    public $see = [];

    protected function collectLinks(Node $node)
    {
        $this->links = [];
        $this->see = [];
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