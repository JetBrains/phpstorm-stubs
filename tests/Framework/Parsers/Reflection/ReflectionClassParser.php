<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Reflection\ReflectionClassConstantParser;
use StubTests\Framework\Parsers\Reflection\ReflectionImplementedInterfaceParser;
use StubTests\Framework\Parsers\Reflection\ReflectionMethodParser;
use StubTests\Framework\Parsers\Reflection\ReflectionParentClassParser;
use StubTests\Framework\Parsers\Reflection\ReflectionPropertyParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionClass>
 */
class ReflectionClassParser implements Parser
{
    private ReflectionMethodParser $methodParser;
    private ReflectionPropertyParser $propertyParser;
    private ReflectionClassConstantParser $constantParser;
    private ReflectionParentClassParser $parentClassParser;
    private ReflectionImplementedInterfaceParser $interfaceParser;

    public function __construct(
        ?ReflectionMethodParser $methodParser = null,
        ?ReflectionPropertyParser $propertyParser = null,
        ?ReflectionClassConstantParser $constantParser = null,
        ?ReflectionParentClassParser $parentClassParser = null,
        ?ReflectionImplementedInterfaceParser $interfaceParser = null
    ) {
        $this->methodParser = $methodParser ?? new ReflectionMethodParser();
        $this->propertyParser = $propertyParser ?? new ReflectionPropertyParser();
        $this->constantParser = $constantParser ?? new ReflectionClassConstantParser();
        $this->parentClassParser = $parentClassParser ?? new ReflectionParentClassParser();
        $this->interfaceParser = $interfaceParser ?? new ReflectionImplementedInterfaceParser();
    }

    public function canParse($object): bool
    {
        return $object instanceof AdaptedReflectionClass
            && $object->isInternal()
            && !$object->isInterface()
            && !$object->isEnum();
    }

    /**
     * Parse an AdaptedReflectionClass into a PHPClass model
     *
     * @param AdaptedReflectionClass $object
     * @return PHPClass
     */
    public function parse($object): PHPClass
    {
        $class = new PHPClass();
        $class->setName(!empty($object->getShortName()) ? $object->getShortName() : null);
        $class->setNamespace($object->getNamespaceName() ? '\\' . $object->getNamespaceName() : '\\');
        if ($class->getName()) {
            $class->setId($class->getNamespace() != '\\' ? $class->getNamespace() . '\\' . $class->getName() : '\\' . $class->getName());
        }
        $class->setIsFinal((bool)$object->isFinal());
        $class->setIsReadonly((bool)$object->isReadOnly());
        foreach ($object->getMethods() ?? [] as $method) {
            $class->addMethod($this->methodParser->parse($method));
        }
        foreach ($object->getProperties() ?? [] as $property) {
            $class->addProperty($this->propertyParser->parse($property));
        }
        if ($object->hasReflectionConstants()) {
            foreach ($object->getReflectionConstants() ?? [] as $reflectionConstant) {
                $class->addConstant($this->constantParser->parse($reflectionConstant));
            }
        } else {
            foreach ($object->getConstants() ?? [] as $constantName => $constantValue) {
                $class->addConstant($this->constantParser->parse([$constantName => $constantValue]));
            }
        }
        if ($object->getParentClass()) {
            $class->setParentClass($this->parentClassParser->parse($object->getParentClass()));
        }
        if ($object->getInterfaces()) {
            foreach ($object->getInterfaces() ?? [] as $interface) {
                $class->addImplementedInterface($this->interfaceParser->parse($interface));
            }
        }
        return $class;
    }
}