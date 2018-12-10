<?php

namespace Parsers;

use Model\PHPClass;
use Model\PHPConst;
use Model\PHPFunction;
use Model\PHPInterface;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use ReflectionClass;

class PHPReflectionParser
{
    public static function getStubs(): array
    {
        $data = [];

        $const_groups = get_defined_constants(true);
        unset($const_groups['user']);
        $const_groups = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($const_groups)), true);
        $data[PHPConst::class] = [];
        foreach ($const_groups as $name => $value) {
            array_push($data[PHPConst::class], (new PHPConst())->readObjectFromReflection([$name, $value]));
        }

        $data[PHPFunction::class] = [];
        foreach (get_defined_functions()['internal'] as $function) {
            array_push($data[PHPFunction::class], (new PHPFunction())->readObjectFromReflection($function));
        }

        $data[PHPClass::class] = [];
        $cl = get_declared_classes();
        foreach ($cl as $clazz) {
            $reflectionClass = new ReflectionClass($clazz);
            if ($reflectionClass->isInternal()) {
                array_push($data[PHPClass::class], (new PHPClass())->readObjectFromReflection($clazz));
            }
        }

        $data[PHPInterface::class] = [];
        foreach (get_declared_interfaces() as $interface) {
            $reflectionInterface = new ReflectionClass($interface);
            if ($reflectionInterface->isInternal()) {
                array_push($data[PHPInterface::class], (new PHPInterface())->readObjectFromReflection($interface));
            }
        }

        return $data;
    }
}