<?php

$constants = [];
foreach (get_defined_constants() as $name => $value) {
    $constants[] = (new PHPConst())->serialize($name, $value);
}
$data['constants'] = $constants;

$functions = [];
foreach (get_defined_functions()['internal'] as $name) {
    $functions[] = (new PHPFunction())->serialize(new ReflectionFunction($name));
}
$data['functions'] = $functions;

$classes = [];
foreach (get_declared_classes() as $class) {
    $classes[] = (new PHPClass())->serialize(new ReflectionClass($class));
}
$data['classes'] = $classes;

$json = json_encode($data, JSON_NUMERIC_CHECK);
echo $json;


class PHPClass
{
    public $name;
    public $methods = [];
    public $constants = [];
    public $parentClass;
    public $interfaces = [];

    public function serialize(ReflectionClass $reflectionClass): array
    {
        $this->name = $reflectionClass->name;
        $parentClass = $reflectionClass->getParentClass();
        if (null !== $parentClass) {
            $this->parentClass = $reflectionClass->getParentClass()->name;
        }
        $this->interfaces = $reflectionClass->getInterfaceNames();
        foreach ($reflectionClass->getMethods() as $method) {
            if ($method->getDeclaringClass()->name !== $this->name) {
                continue;
            }
            $this->methods[$method->name] = (new PHPMethod())->serialize($method);
        }

        foreach ($reflectionClass->getReflectionConstants() as $constant){
            if($constant->getDeclaringClass()->name !== $this->name){
                continue;
            }
            $this->constants[$constant->name] = (new PHPConst())->serialize($constant->name, $constant->getValue());
        }
        return (array)$this;
    }

}

class PHPConst
{
    public $name;
    public $value;

    public function serialize($name, $value): array
    {
        $this->name = utf8_encode($name);
        $this->value = is_resource($value) ? 'PHPSTORM_RESOURCE' : utf8_encode($value);
        return (array)$this;
    }
}

class PHPFunction
{
    public $name;
    public $is_deprecated;
    public $parameters = [];

    public function serialize(ReflectionFunction $reflectionFunction): array
    {

        $this->name = $reflectionFunction->name;
        $this->is_deprecated = $reflectionFunction->isDeprecated();
        foreach ($reflectionFunction->getParameters() as $parameter) {
            $this->parameters[] = (new PHPParameter())->serialize($parameter);
        }
        return (array)$this;
    }

}

class PHPMethod
{
    public $name;
    public $is_static;
    public $access;
    public $is_final;
    public $parameters = [];

    public function serialize(ReflectionMethod $method): array
    {
        $this->name = $method->name;
        $this->is_static = $method->isStatic();
        $this->is_final = $method->isFinal();
        foreach ($method->getParameters() as $parameter) {
            $this->parameters[] = (new PHPParameter())->serialize($parameter);
        }

        if ($method->isProtected()) {
            $access = 'protected';
        } else if ($method->isPrivate()) {
            $access = 'private';
        } else {
            $access = 'public';
        }
        $this->access = $access;
        return (array)$this;
    }

}

class PHPParameter
{
    public $name;
    public $type = '';
    public $is_vararg;
    public $is_passed_by_ref;

    public function serialize(ReflectionParameter $parameter): array
    {
        $this->name = $parameter->name;
        if (!empty($parameter->getType())) {
            $this->type = $parameter->getType()->getName();
        }
        $this->is_vararg = $parameter->isVariadic();
        $this->is_passed_by_ref = $parameter->isPassedByReference();
        return (array)$this;
    }
}
