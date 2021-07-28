<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use DirectoryIterator;
use Generator;
use StubTests\Model\PHPFunction;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsTestDataProviders
{
    public static function allFunctionsProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getFunctions() as $functionName => $function) {
            yield "function $functionName" => [$function];
        }
    }

    public static function allClassesProvider(): ?Generator
    {
        $allClassesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        foreach ($allClassesAndInterfaces as $class) {
            yield "class $class->sourceFilePath/$class->name" => [$class];
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
        foreach (new DirectoryIterator($stubsDirectory) as $directory) {
            $directoryName = $directory->getBasename();
            if ($directory->isDot() || !$directory->isDir() || in_array($directoryName, ['tests', 'meta', 'vendor'], true) || str_starts_with($directoryName, '.')) {
                continue;
            }
            yield "directory $directoryName" => [$directoryName];
        }
    }
}
