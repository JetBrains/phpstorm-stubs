<?php
declare(strict_types=1);

namespace StubTests\Parsers;

use ReflectionClass;
use ReflectionFunction;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPDefineConstant;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\StubsContainer;

class PHPReflectionParser
{

    public static function getStubs(): StubsContainer
    {
        $stubs = new StubsContainer();

        $jsonData = json_decode(file_get_contents(__DIR__ . '/../TestData/mutedProblems.json'));
        $const_groups = get_defined_constants(true);
        unset($const_groups['user']);
        $const_groups = Utils::flattenArray($const_groups, true);
        foreach ($const_groups as $name => $value) {
            $constant = (new PHPDefineConstant())->readObjectFromReflection([$name, $value]);
            $constant->readMutedProblems($jsonData->constants);
            $stubs->addConstant($constant);
        }

        /**@var ReflectionFunction $function */
        foreach (get_defined_functions()['internal'] as $function) {
            $phpFunction = (new PHPFunction())->readObjectFromReflection($function);
            $phpFunction->readMutedProblems($jsonData->functions);
            $stubs->addFunction($phpFunction);
        }

        /**@var ReflectionClass $clazz */
        foreach (get_declared_classes() as $clazz) {
            $reflectionClass = new ReflectionClass($clazz);
            if ($reflectionClass->isInternal()) {
                $class = (new PHPClass())->readObjectFromReflection($clazz);
                $class->readMutedProblems($jsonData->classes);
                $stubs->addClass($class);
            }
        }

        /**@var ReflectionClass $interface */
        foreach (get_declared_interfaces() as $interface) {
            $reflectionInterface = new ReflectionClass($interface);
            if ($reflectionInterface->isInternal()) {
                $phpInterface = (new PHPInterface())->readObjectFromReflection($interface);
                $phpInterface->readMutedProblems($jsonData->interfaces);
                $stubs->addInterface($phpInterface);
            }
        }

        return $stubs;
    }
}
