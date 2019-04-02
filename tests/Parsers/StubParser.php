<?php
declare(strict_types=1);

namespace StubTests\Parsers;

use FilesystemIterator;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use StubTests\Model\StubsContainer;
use StubTests\Parsers\Visitors\ASTVisitor;
use StubTests\Parsers\Visitors\ParentConnector;

class StubParser
{
    public static function getPhpStormStubs(): StubsContainer
    {
        /** @noinspection PhpUnhandledExceptionInspection */

        $stubs = new StubsContainer();
        $visitor = new ASTVisitor($stubs);
        self::processStubs($visitor, function ($file) {
            return true;
        });
        foreach ($stubs->getInterfaces() as $interface) {
            $interface->parentInterfaces = $visitor->combineParentInterfaces($interface);
        }

        foreach ($stubs->getClasses() as $class) {
            $class->interfaces =
                Utils::flattenArray($visitor->combineImplementedInterfaces($class), false);
        }
        return $stubs;
    }

    /**
     * @param NodeVisitorAbstract $visitor
     * @param callable $fileCondition
     */
    public static function processStubs(NodeVisitorAbstract $visitor, callable $fileCondition): void
    {
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $nameResolver = new NameResolver(null, ['preserveOriginalNames' => true]);

        $stubsIterator =
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(__DIR__ . '/../../', FilesystemIterator::SKIP_DOTS)
            );
        /** @var SplFileInfo $file */
        foreach ($stubsIterator as $file) {
            if (!$fileCondition($file) ||
                strpos($file->getRealPath(), 'vendor') || strpos($file->getRealPath(), '.git') ||
                strpos($file->getRealPath(), 'tests') || strpos($file->getRealPath(), '.idea')) {
                continue;
            }
            $code = file_get_contents($file->getRealPath());
            $traverser = new NodeTraverser();
            $traverser->addVisitor(new ParentConnector());
            $traverser->addVisitor($nameResolver);
            $traverser->addVisitor($visitor);
            $traverser->traverse($parser->parse($code, new StubsParserErrorHandler()));
        }
    }
}
