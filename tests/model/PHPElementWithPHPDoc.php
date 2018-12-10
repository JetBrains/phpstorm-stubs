<?php

namespace Model;

use Exception;
use phpDocumentor\Reflection\DocBlockFactory;
use PhpParser\NodeAbstract;

abstract class PHPElementWithPHPDoc extends BasePHPElement
{
    public $links = [];
    public $see = [];
    protected static $docFactory;

    protected function collectLinks(NodeAbstract $node)
    {
        if (self::$docFactory === null) {
            self::$docFactory = DocBlockFactory::createInstance();
        }
        $this->links = [];
        $this->see = [];
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = self::$docFactory->create($node->getDocComment()->getText());
                $this->links = $phpDoc->getTagsByName('link');
                $this->see = $phpDoc->getTagsByName('see');
            } catch (Exception $e) {
                $this->parseError = $e->getMessage();
            }
        }
    }
}