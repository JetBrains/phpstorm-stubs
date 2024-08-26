<?php

namespace StubTests\Model;

use Exception;
use PhpParser\Node\Const_;
use stdClass;

class PHPConstant extends PHPNamespacedElement
{
    /**
     * @var bool|int|string|float|null
     */
    public $value;

    /**
     * @param \ReflectionConstant $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->getShortName();
        if (!empty($reflectionObject->getNamespaceName())) {
            $this->namespace = "\\" . $reflectionObject->getNamespaceName();
        }
        $this->id = "$this->namespace\\$this->name";
        $this->value = $reflectionObject->getValue();
        $this->isDeprecated = $reflectionObject->isDeprecated();
        return $this;
    }

    /**
     * @param Const_ $node
     * @return static
     */
    public function readObjectFromStubNode($node) {}

    /**
     * @param stdClass|array $jsonData
     * @throws Exception
     */
    public function readMutedProblems($jsonData)
    {
        foreach ($jsonData as $constant) {
            if ($constant->name === $this->name && !empty($constant->problems)) {
                foreach ($constant->problems as $problem) {
                    switch ($problem->description) {
                        case 'wrong value':
                            $this->mutedProblems[StubProblemType::WRONG_CONSTANT_VALUE] = $problem->versions;
                            break;
                        case 'missing constant':
                            $this->mutedProblems[StubProblemType::STUB_IS_MISSED] = $problem->versions;
                            break;
                        default:
                            throw new Exception("Unexpected value $problem->description");
                    }
                }
            }
        }
    }
}
