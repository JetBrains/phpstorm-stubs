<?php

namespace TestData;


use stdClass;

class MutedProblems
{
	/** @var stdClass */
	private $mutedProblems;

	public function __construct()
	{
		$json                = file_get_contents(__DIR__ . '/mutedProblems.json');
		$this->mutedProblems = json_decode($json);
	}

	public function getMutedProblemsForConstant(string $constantName): array
	{
		foreach ($this->mutedProblems->constants as $constant)
		{
			if ($constant->name === $constantName)
			{
				return $constant->problems;
			}
		}

		return [];
	}

	public function getMutedProblemsForFunction(string $functionName): array
	{
		foreach ($this->mutedProblems->functions as $function)
		{
			if ($function->name === $functionName)
			{
				return $function->problems;
			}
		}

		return [];
	}

	public function getMutedProblemsForClass(string $className): array
	{
		foreach ($this->mutedProblems->classes as $class)
		{
			if ($class->name === $className && !empty($class->problems))
			{
				return $class->problems;
			}
		}

		return [];
	}

	public function getMutedProblemsForMethod(string $className, $methodName): array
	{
		foreach ($this->mutedProblems->classes as $class)
		{
			if ($class->name === $className && !empty($class->methods))
			{
				foreach ($class->methods as $method)
				{
					if ($method->name === $methodName)
					{
						return $method->problems;
					}
				}
			}
		}

		return [];
	}

	public function getMutedProblemsForClassConstants($className, $constantName)
	{
		foreach ($this->mutedProblems->classes as $class)
		{
			if ($class->name === $className && !empty($class->constants))
			{
				foreach ($class->constants as $constant)
				{
					if ($constant->name === $constantName)
					{
						return $constant->problems;
					}
				}
			}
		}

		return [];
	}

	public function getMutedProblemsForInterface($interfaceName)
	{
		foreach ($this->mutedProblems->interfaces as $interface)
		{
			if ($interface->name === $interfaceName && !empty($interface->problems))
			{
				return $interface->problems;
			}
		}

		return [];
	}
}