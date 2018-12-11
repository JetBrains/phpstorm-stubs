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
        $data = [];

        $const_groups = get_defined_constants(true);
        unset($const_groups['user']);
        $const_groups = Utils::flattenArray($const_groups, true);
        $data[PHPConst::class] = [];
        foreach ($const_groups as $name => $value) {
            $data[PHPConst::class][] = (new PHPDefineConstant())->readObjectFromReflection([$name, $value]);
        }

        $data[PHPFunction::class] = [];
        /**@var ReflectionFunction $function */
        foreach (get_defined_functions()['internal'] as $function) {
            $data[PHPFunction::class][] = (new PHPFunction())->readObjectFromReflection($function);
        }

        $data[PHPClass::class] = [];
        $cl = get_declared_classes();
        foreach ($cl as $clazz) {
            $reflectionClass = new ReflectionClass($clazz);
            if ($reflectionClass->isInternal()) {
                $data[PHPClass::class][] = (new PHPClass())->readObjectFromReflection($clazz);
            }
        }

        $data[PHPInterface::class] = [];
        /**@var ReflectionClass $interface */
        foreach (get_declared_interfaces() as $interface) {
            $reflectionInterface = new ReflectionClass($interface);
            if ($reflectionInterface->isInternal()) {
                $data[PHPInterface::class][] = (new PHPInterface())->readObjectFromReflection($interface);
            }
        }

        return $data;
    }
}
