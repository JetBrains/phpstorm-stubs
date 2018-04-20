<?php

foreach (get_defined_constants() as $name => $value) {
    $constants[] = (new PHPConst())->serialize($name, $value);
}
$data["constants"] = $constants;

foreach (get_defined_functions()["internal"] as $name) {
    $functions[] = (new PHPFunction())->serialize(new ReflectionFunction($name));
}
$data["functions"] = $functions;

/**
 * @todo Check interfaces
 * @todo Check traits
 */
foreach (get_declared_classes() as $class) {
    $classes[] = (new PHPClass())->serialize(new ReflectionClass($class));
}
$data["classes"] = $classes;

$json = json_encode($data, JSON_NUMERIC_CHECK);
$outputFile = fopen("stub.json", "w");
fwrite($outputFile, $json);


class PHPClass
{
    public $name;
    public $methods = [];
    public $constants = [];
    public $parentClass = null;
    public $interfaces = [];

    public function serialize(ReflectionClass $reflectionClass)
    {
        $this->name = $reflectionClass->name;
        $parentClass = $reflectionClass->getParentClass();
        if (!empty($parentClass)) {
            $this->parentClass = $reflectionClass->getParentClass()->name;
        }
        $this->interfaces = $reflectionClass->getInterfaceNames();
        foreach ($reflectionClass->getMethods() as $method) {
            if ($method->getDeclaringClass()->name != $this->name) {
                continue;
            }
            $this->methods[] = (new PHPMethod())->serialize($method);
        }

        foreach ($reflectionClass->getConstants() as $name => $value) {
            $this->constants[] = (new PHPConst())->serialize($name, $value);
        }
        return (array)$this;
    }

}

class PHPConst
{
    public $name;
    public $value;

    public function serialize($name, $value)
    {
        $this->name = utf8_encode($name);
        $this->value = is_resource($value) ? "PHPSTORM_RESOURCE" : utf8_encode($value);
        return (array)$this;
    }
}

class PHPFunction
{
    public $name;
    public $is_deprecated;
    public $parameters = [];

    public function serialize(ReflectionFunction $reflectionFunction)
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

    public function serialize(ReflectionMethod $method)
    {
        $this->name = $method->name;
        $this->is_static = $method->isStatic();
        $this->is_final = $method->isFinal();
        foreach ($method->getParameters() as $parameter) {
            $this->parameters[] = (new PHPParameter())->serialize($parameter);
        }

        if ($method->isProtected()) {
            $access = "protected";
        } else if ($method->isPrivate()) {
            $access = "private";
        } else {
            $access = "public";
        }
        $this->access = $access;
        return (array)$this;
    }

}

class PHPParameter
{
    public $name;
    public $type = "";
    public $is_vararg;
    public $is_passed_by_ref;

    public function serialize(ReflectionParameter $parameter)
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
