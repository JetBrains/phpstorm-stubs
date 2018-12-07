<?php

namespace Model;

use ReflectionMethod;

class PHPMethod extends PHPFunction
{
	public $is_static;
	public $access;
	public $is_final;

	public function serialize($method): self
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
		return $this;
	}

}