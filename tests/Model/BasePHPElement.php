<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use PhpParser\Node;
use Reflector;

abstract class BasePHPElement
{
    public string $name;
    public bool $stubBelongsToCore = false;
    public ?Exception $parseError = null;
    protected array $mutedProblems = [];

    abstract public function readObjectFromReflection(Reflector $object);

    abstract public function readObjectFromStubNode(Node $node);

    abstract public function readMutedProblems($jsonData): void;

    protected function getFQN(Node $node): string
    {
        $fqn = '';
        if ($node->namespacedName === null) {
            $fqn = $node->name->parts[0];
        } else {
            /**@var string $part */
            foreach ($node->namespacedName->parts as $part) {
                $fqn .= "$part\\";
            }
        }
        return rtrim($fqn, "\\");
    }

    public function hasMutedProblem($stubProblemType): bool
    {
        return in_array($stubProblemType, $this->mutedProblems, true);
    }
}
