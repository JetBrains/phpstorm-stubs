<?php

namespace Model;

use ReflectionException;
use ReflectionFunction;

class PHPFunction extends PHPElementWithPHPDoc
{
    public $name;
    public $is_deprecated;
    public $parameters = [];
    public $returnTag;

    /**
     * @param mixed $function
     * @return $this|mixed
     */
    public function serialize($function)
    {
        try {
            $reflectionFunction = new ReflectionFunction($function);
            $this->name = $reflectionFunction->name;
            $this->is_deprecated = $reflectionFunction->isDeprecated();
            foreach ($reflectionFunction->getParameters() as $parameter) {
                $this->parameters[] = (new PHPParameter())->serialize($parameter);
            }
        } catch (ReflectionException $ex) {
            $this->parseError = $ex;
        }
        return $this;
    }
}