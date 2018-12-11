<?php

namespace StubTests\Parsers;

use FilesystemIterator;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPInterface;
use StubTests\Parsers\Visitors\ASTVisitor;
use StubTests\Parsers\Visitors\ParentConnector;

class StubParser
{
    public static function getPhpStormStubs(): array
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $nameResolver = new NameResolver;

        $stubs   = [];
        $visitor = new ASTVisitor($stubs);

        $stubsIterator =
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(__DIR__ . '/../../', FilesystemIterator::SKIP_DOTS)
            );
        /** @var SplFileInfo $file */
        foreach ($stubsIterator as $file) {
            if (strpos($file->getRealPath(), 'vendor') || strpos($file->getRealPath(), '.git') ||
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
        /**@var PHPInterface $interface */
        foreach ($stubs[PHPInterface::class] as $interface) {
            $stubs[PHPInterface::class][$interface->name]->parentInterfaces = $visitor->combineParentInterfaces($interface);
        }
        /**@var PHPClass $class */
        foreach ($stubs[PHPClass::class] as $class) {
            $stubs[PHPClass::class][$class->name]->interfaces = Utils::flattenArray($visitor->combineImplementedInterfaces($class), false);
        }
        return $stubs;
    }
}
