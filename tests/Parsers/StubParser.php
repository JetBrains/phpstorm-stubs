<?php
declare(strict_types=1);

namespace StubTests\Parsers;

use FilesystemIterator;
use LogicException;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use StubTests\Model\StubsContainer;
use StubTests\Parsers\Visitors\ASTVisitor;
use StubTests\Parsers\Visitors\CoreStubASTVisitor;
use StubTests\Parsers\Visitors\ParentConnector;
use StubTests\TestData\Providers\PhpCoreStubsProvider;
use UnexpectedValueException;

class StubParser
{
    private static ?StubsContainer $stubs = null;

    public static function getPhpStormStubs(): StubsContainer
    {
        self::$stubs = new StubsContainer();
        $visitor = new ASTVisitor(self::$stubs);
        $coreStubVisitor = new CoreStubASTVisitor(self::$stubs);
        /** @noinspection PhpUnhandledExceptionInspection */
        self::processStubs($visitor, $coreStubVisitor,
            fn(SplFileInfo $file) => $file->getFilename() !== '.phpstorm.meta.php');
        foreach (self::$stubs->getInterfaces() as $interface) {
            $interface->parentInterfaces = $visitor->combineParentInterfaces($interface);
        }

        foreach (self::$stubs->getClasses() as $class) {
            $class->interfaces =
                Utils::flattenArray($visitor->combineImplementedInterfaces($class), false);
        }
        $jsonData = json_decode(file_get_contents(__DIR__ . '/../TestData/mutedProblems.json'));
        foreach (self::$stubs->getClasses() as $class) {
            $class->readMutedProblems($jsonData->classes);
        }
        foreach (self::$stubs->getInterfaces() as $interface) {
            $interface->readMutedProblems($jsonData->interfaces);
        }
        foreach (self::$stubs->getFunctions() as $function) {
            $function->readMutedProblems($jsonData->functions);
        }
        foreach (self::$stubs->getConstants() as $constant) {
            $constant->readMutedProblems($jsonData->constants);
        }
        return self::$stubs;
    }

    /**
     * @param NodeVisitorAbstract $visitor
     * @param CoreStubASTVisitor|null $coreStubASTVisitor
     * @param callable $fileCondition
     * @throws LogicException
     * @throws UnexpectedValueException
     */
    public static function processStubs(NodeVisitorAbstract $visitor, ?CoreStubASTVisitor $coreStubASTVisitor, callable $fileCondition): void
    {
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $nameResolver = new NameResolver(null, ['preserveOriginalNames' => true]);

        $stubsIterator =
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(__DIR__ . '/../../', FilesystemIterator::SKIP_DOTS)
            );
        $coreStubDirectories = PhpCoreStubsProvider::getCoreStubsDirectories();
        /** @var SplFileInfo $file */
        foreach ($stubsIterator as $file) {
            if (!$fileCondition($file) || basename(dirname($file->getRealPath())) === 'phpstorm-stubs' ||
                strpos($file->getRealPath(), 'vendor') || strpos($file->getRealPath(), '.git') ||
                strpos($file->getRealPath(), 'tests') || strpos($file->getRealPath(), '.idea')) {
                continue;
            }
            $code = file_get_contents($file->getRealPath());
            $traverser = new NodeTraverser();
            $traverser->addVisitor(new ParentConnector());
            $traverser->addVisitor($nameResolver);
            if ($coreStubASTVisitor !== null && self::stubBelongsToCore($file, $coreStubDirectories)) {
                $traverser->addVisitor($coreStubASTVisitor);
            } else {
                $traverser->addVisitor($visitor);
            }
            $traverser->traverse($parser->parse($code, new StubsParserErrorHandler()));
        }
    }

    private static function stubBelongsToCore(SplFileInfo $file, array $coreStubDirectories): bool
    {
        $filePath = dirname($file->getRealPath());
        while (stripos($filePath, 'phpstorm-stubs') !== strlen($filePath) - strlen('phpstorm-stubs')) {
            if (in_array(basename($filePath), $coreStubDirectories, true)) {
                return true;
            }
            $filePath = dirname($filePath);
        }
        return false;
    }
}
