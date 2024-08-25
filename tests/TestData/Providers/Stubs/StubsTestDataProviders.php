<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use DirectoryIterator;
use Generator;
use SplFileInfo;
use StubTests\Model\PHPFunction;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use function dirname;
use function in_array;

class StubsTestDataProviders
{
    public static function allFunctionsProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getFunctions() as $functionName => $function) {
            yield "function $functionName" => [$function->id];
        }
    }

    public static function allClassesProvider(): ?Generator
    {
        $classes = PhpStormStubsSingleton::getPhpStormStubs()->getClasses();
        foreach ($classes as $class) {
            yield "class $class->sourceFilePath/$class->id" => [$class->id, $class->sourceFilePath];
        }
    }

    public static function allInterfacesProvider(): ?Generator
    {
        $interfaces = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        foreach ($interfaces as $class) {
            yield "class $class->sourceFilePath/$class->id" => [$class->id, $class->sourceFilePath];
        }
    }

    public static function allEnumsProvider(): ?Generator
    {
        $enums = PhpStormStubsSingleton::getPhpStormStubs()->getEnums();
        foreach ($enums as $class) {
            yield "class $class->sourceFilePath/$class->id" => [$class->id, $class->sourceFilePath];
        }
    }

    public static function coreFunctionsProvider(): ?Generator
    {
        $allFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $coreFunctions = array_filter($allFunctions, fn (PHPFunction $function): bool => $function->stubBelongsToCore === true);
        foreach ($coreFunctions as $coreFunction) {
            yield "function $coreFunction->name" => [$coreFunction];
        }
    }

    public static function stubsDirectoriesProvider(): ?Generator
    {
        $stubsDirectory = dirname(__DIR__, 4);
        /** @var SplFileInfo $directory */
        foreach (new DirectoryIterator($stubsDirectory) as $directory) {
            $directoryName = $directory->getBasename();
            if ($directory->isDot() || !$directory->isDir() || in_array($directoryName, ['tests', 'meta', 'vendor'], true) || str_starts_with($directoryName, '.')) {
                continue;
            }
            yield "directory $directoryName" => [$directoryName];
        }
    }
}
