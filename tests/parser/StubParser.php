<?php

namespace Parsers;

use FilesystemIterator;
use Model\PHPClass;
use Model\PHPInterface;
use parser\visitor\ParentConnector;
use Parsers\Visitor\ASTVisitor;
use PhpParser\Error;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class StubParser
{
    public static function getPhpStormStubs(): array
    {
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $nameResolver = new NameResolver;

        $stubs = array();
        $visitor = new ASTVisitor($stubs);

        $stubsIterator =
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(__DIR__ . '/../../', FilesystemIterator::SKIP_DOTS)
            );
        /** @var SplFileInfo $file */
        foreach ($stubsIterator as $file) {
            if (strpos($file->getRealPath(), 'vendor') || strpos($file->getRealPath(),
                    '.git') || strpos($file->getRealPath(), 'tests') || strpos($file->getRealPath(), '.idea')) {
                continue;
            }
            $code = file_get_contents($file->getRealPath());

            try {
                $ast = $parser->parse($code);
            } catch (Error $error) {
                $error->setRawMessage($error->getRawMessage() . "\n" . $file->getRealPath());
                throw $error;
            }
            $traverser = new NodeTraverser();

            $traverser->addVisitor(new ParentConnector());
            $traverser->addVisitor($nameResolver);
            $traverser->addVisitor($visitor);
            $traverser->traverse($ast);
        }
        foreach ($stubs[PHPInterface::class] as $interface) {
            $stubs[PHPInterface::class][$interface->name]->parentInterfaces = $visitor->combineParentInterfaces($interface);
        }
        foreach ($stubs[PHPClass::class] as $class) {
            $stubs[PHPClass::class][$class->name]->interfaces = ASTVisitor::flattenArray($visitor->combineImplementedInterfaces($class));
        }
        return $stubs;
    }
}