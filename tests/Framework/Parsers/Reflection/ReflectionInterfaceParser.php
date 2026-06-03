<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionClass>
 */
class ReflectionInterfaceParser implements Parser
{
    private ReflectionMethodParser $methodParser;
    private ReflectionClassConstantParser $constantParser;

    public function __construct(
        ?ReflectionMethodParser $methodParser = null,
        ?ReflectionClassConstantParser $constantParser = null
    ) {
        $this->methodParser = $methodParser ?? new ReflectionMethodParser();
        $this->constantParser = $constantParser ?? new ReflectionClassConstantParser();
    }

    public function canParse($object): bool
    {
        return $object instanceof AdaptedReflectionClass
            && $object->isInternal()
            && $object->isInterface();
    }

    /**
     * Parse an AdaptedReflectionClass (representing an interface) into a PHPInterface model
     *
     * @param AdaptedReflectionClass $object
     * @return PHPInterface
     */
    public function parse($object): PHPInterface
    {
        $interface = new PHPInterface();
        $interface->setName($object->getShortName());
        $interface->setNamespace($object->getNamespaceName() ? '\\' . $object->getNamespaceName() : '\\');
        $interface->setId($interface->getNamespace() != '\\' ? $interface->getNamespace() . '\\' . $interface->getName() : '\\' . $interface->getName());
        foreach ($object->getMethods() ?? [] as $method) {
            $interface->addMethod($this->methodParser->parse($method));
        }
        if ($object->hasReflectionConstants()) {
            foreach ($object->getReflectionConstants() ?? [] as $reflectionConstant) {
                $interface->addConstant($this->constantParser->parse($reflectionConstant));
            }
        } else {
            foreach ($object->getConstants() ?? [] as $constantName => $constantValue) {
                $interface->addConstant($this->constantParser->parse([$constantName => $constantValue]));
            }
        }
        return $interface;
    }
}
