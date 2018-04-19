<?php
$data=[];
$names =[];

foreach (get_defined_constants() as $name => $value ) {
    $STUBSConst = new STUBSConst(utf8_encode($name), is_resource($value)?"PHPSTORM_RESOURCE":utf8_encode($value));
    $names[]= $STUBSConst->serialize();
}
$data["constants"] = $names;
$functions =[];
foreach (get_defined_functions()["internal"] as $name) {
    $reflectionFunction = new ReflectionFunction($name);
    $STUBSFunction = new STUBSFunction($reflectionFunction->name, $reflectionFunction->isDeprecated(), $reflectionFunction->getParameters());
    $functions[]= $STUBSFunction->serialize();
}

$data["functions"] = $functions;

$classesWithMethods=[];

foreach (get_declared_classes() as $it) {
    $reflectionClass = new ReflectionClass($it);
    $STUBSClass = new STUBSClass($reflectionClass->name, $reflectionClass->getMethods(), $reflectionClass->getProperties(), $reflectionClass->getConstants());
    $classesWithMethods[]=$STUBSClass->serialize();
}

$data["classes"] = $classesWithMethods;
$json = json_encode($data, JSON_NUMERIC_CHECK);
$myfile = fopen("stub.json", "w");
fwrite($myfile, $json);


class STUBSClass{
    public $name;
    public $methods;
    public $fields;
    public $consts;

    /**
     * STUBSClass constructor.
     * @param $methods
     * @param $fields
     * @param $consts
     */
    public function __construct($name, $methods, $fields, $consts)
    {
        $this->name = $name;
        $this->methods = $methods;
        $this->fields = $fields;
        $this->consts = $consts;
    }
    public function serialize() {
        $json_methods = [];
        /** @var ReflectionMethod $it */
        foreach ($this->methods as $it) {
            $access = "";
            if ($it->isPublic()) {
                $access = "public";
            }
            if ($it->isProtected()) {
                $access = "protected";
            }
            if ($it->isPrivate()) {
                $access = "private";
            }
            $parameters = [];
            /**
             * @var ReflectionParameter $parameter
             */
            $i=0;
            foreach ($it->getParameters() as $parameter) {
                $parameters[$i++]=new STUBSParameter($parameter->name,$parameter->getType()."", $parameter->isVariadic(), $parameter->isPassedByReference());
            }
            $json_methods[] = (new STUBSMethod($it->name, $it->isStatic(), $access, $it->isFinal(), $parameters))->serialize();
        }
        $consts=[];
        foreach ($this->consts as $name => $value ) {
            $STUBSConst = new STUBSConst(utf8_encode($name), is_resource($value)?"PHPSTORM_RESOURCE":utf8_encode($value));
            $consts[]= $STUBSConst->serialize();
        }
        return ["name"=>$this->name ,"methods" => $json_methods, "fields" => $this->fields, "constants" => $consts];
    }

}
class STUBSConst {
    public $name;
    public $value;

    /**
     * STUBSConst constructor.
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function serialize()
    {
        return array("name" => $this->name, "value" => $this->value);
    }
}
class STUBSFunction {
    public $name;
    public $is_deprecated;
    public $parameters;

    /**
     * STUBSFunction constructor.
     * @param $name
     * @param $is_static
     * @param $parameters
     */
    public function __construct($name, $is_deprecated, $parameters)
    {
        $this->name = $name;
        $this->is_deprecated = $is_deprecated;
        $this->parameters = $parameters;
    }


    public function serialize(){
        $parameters = [];
        /**
         * @var ReflectionParameter $it
         */
        $i=0;
        foreach ($this->parameters as $it) {
            $parameters[$i++]=new STUBSParameter($it->name,$it->getType()."", $it->isVariadic(), $it->isPassedByReference());
        }
        return ["name" => $this->name, "is_deprecated"=>$this->is_deprecated, "parameters" =>$parameters];
    }

}
class STUBSMethod {
    public $name;
    public $is_static;
    public $access;
    public $is_final;

    public $parameters;

    /**
     * STUBSMethod constructor.
     * @param $name
     * @param $is_static
     * @param $access
     * @param $is_final
     * @param $parameters
     */
    public function __construct($name, $is_static, $access, $is_final, $parameters)
    {
        $this->name = $name;
        $this->is_static = $is_static;
        $this->access = $access;
        $this->is_final = $is_final;
        $this->parameters = $parameters;
    }

    public function serialize(){
        $parameters = [];
        /**
         * @var STUBSParameter $it
         */
        $i=0;
        foreach ($this->parameters as $it) {
            $parameters[$i++] = $it->serialize();
        }
        return array("name" => $this->name, "is_static" => $this->is_static, "access" => $this->access, "is_final" => $this->is_final, "parameters" => $parameters);
    }

}

class STUBSParameter {
    public $name;
    public $type;
    public $is_vararg;
    public $is_passed_by_ref;

    /**
     * STUBSParameter constructor.
     * @param $name
     * @param $type
     * @param $is_vararg
     */
    public function __construct($name, $type, $is_vararg, $is_passed_by_ref)
    {
        $this->name = $name;
        $this->type = $type;
        $this->is_vararg = $is_vararg;
        $this->is_passed_by_ref = $is_passed_by_ref;
    }

    public function serialize() {
        return array("name" => $this->name, "type" => $this->type, "is_vararg" => $this->is_vararg, "is_passed_by_ref" => $this->is_passed_by_ref);
    }
}
