<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Stmt\ClassMethod;
use ReflectionParameter;
use stdClass;

class PHPMethod extends PHPFunction
{
    public $access;
    public $is_static;
    public $is_final;
    public $parentName;

    /**
     * @param \ReflectionMethod $method
     * @return $this
     */
    public function readObjectFromReflection($method)
    {
        $this->name = $method->name;
        $this->is_static = $method->isStatic();
        $this->is_final = $method->isFinal();
        /**@var ReflectionParameter $parameter */
        foreach ($method->getParameters() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromReflection($parameter);
        }

        if ($method->isProtected()) {
            $access = 'protected';
        } elseif ($method->isPrivate()) {
            $access = 'private';
        } else {
            $access = 'public';
        }
        $this->access = $access;
        return $this;
    }

    /**
     * @param ClassMethod $node
     * @return $this
     */
    public function readObjectFromStubNode($node)
    {
        $this->parentName = $this->getFQN($node->getAttribute('parent'));
        $this->name = $node->name->name;

        $this->collectLinks($node);
        $this->collectSinceDeprecatedVersions($node);
        $this->checkDeprecationTag($node);
        $this->checkReturnTag($node);

        if (strncmp($this->name, 'PS_UNRESERVE_PREFIX_', 20) === 0) {
            $this->name = substr($this->name, strlen('PS_UNRESERVE_PREFIX_'));
        }
        foreach ($node->getParams() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromStubNode($parameter);
        }

        $this->is_final = $node->isFinal();
        $this->is_static = $node->isStatic();
        if ($node->isPrivate()) {
            $this->access = 'private';
        } elseif ($node->isProtected()) {
            $this->access = 'protected';
        } else {
            $this->access = 'public';
        }
        return $this;
    }

    public function readMutedProblems($jsonData): void
    {
        /**@var stdClass $method */
        foreach ($jsonData as $method) {
            if ($method->name === $this->name && !empty($method->problems)) {
                /**@var stdClass $problem */
                foreach ($method->problems as $problem) {
                    switch ($problem) {
                        case 'parameter mismatch':
                            $this->mutedProblems[] = StubProblemType::FUNCTION_PARAMETER_MISMATCH;
                            break;
                        case 'missing method':
                            $this->mutedProblems[] = StubProblemType::STUB_IS_MISSED;
                            break;
                        case 'deprecated method':
                            $this->mutedProblems[] = StubProblemType::FUNCTION_IS_DEPRECATED;
                            break;
                        default:
                            $this->mutedProblems[] = -1;
                            break;
                    }
                }
                return;
            }
        }
    }
}
