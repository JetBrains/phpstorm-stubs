<?php
declare(strict_types=1);

namespace StubTests\Parsers;

use ReflectionClass;
use ReflectionFunction;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPDefineConstant;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;

class PHPReflectionParser
{

    public static function getStubs(): array
    {
        //A class will be better than a map here. This should be done in a separate pull request though.
        $data = [];
        $data[PHPConst::class] = [];
        $data[PHPFunction::class] = [];
        $data[PHPClass::class] = [];
        $data[PHPInterface::class] = [];

        $jsonData = json_decode(file_get_contents(__DIR__ . '/../TestData/mutedProblems.json'));
        $const_groups = get_defined_constants(true);
        unset($const_groups['user']);
        $const_groups = Utils::flattenArray($const_groups, true);
        foreach ($const_groups as $name => $value) {
            $constant = (new PHPDefineConstant())->readObjectFromReflection([$name, $value]);
            $constant->readStubProblems($jsonData);
            $data[PHPConst::class][] = $constant;
        }

        /**@var ReflectionFunction $function */
        foreach (get_defined_functions()['internal'] as $function) {
            $phpFunction = (new PHPFunction())->readObjectFromReflection($function);
            $phpFunction->readStubProblems($jsonData);
            $data[PHPFunction::class][] = $phpFunction;
        }

        /**@var ReflectionClass $clazz */
        foreach (get_declared_classes() as $clazz) {
            $reflectionClass = new ReflectionClass($clazz);
            if ($reflectionClass->isInternal()) {
                $class = (new PHPClass())->readObjectFromReflection($clazz);
                $class->readStubProblems($jsonData);
                $data[PHPClass::class][] = $class;
            }
        }

        /**@var ReflectionClass $interface */
        foreach (get_declared_interfaces() as $interface) {
            $reflectionInterface = new ReflectionClass($interface);
            if ($reflectionInterface->isInternal()) {
                $phpInterface = (new PHPInterface())->readObjectFromReflection($interface);
                $phpInterface->readStubProblems($jsonData);
                $data[PHPInterface::class][] = $phpInterface;
            }
        }

        return $data;
    }
}
