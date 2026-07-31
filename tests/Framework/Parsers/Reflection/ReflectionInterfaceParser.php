<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionClass>
 */
class ReflectionInterfaceParser implements Parser
{
    private ReflectionMethodParser $methodParser;
    private ReflectionClassConstantParser $constantParser;
    private ReflectionImplementedInterfaceParser $interfaceParser;

    public function __construct(
        ?ReflectionMethodParser $methodParser = null,
        ?ReflectionClassConstantParser $constantParser = null,
        ?ReflectionImplementedInterfaceParser $interfaceParser = null
    ) {
        $this->methodParser = $methodParser ?? new ReflectionMethodParser();
        $this->constantParser = $constantParser ?? new ReflectionClassConstantParser();
        $this->interfaceParser = $interfaceParser ?? new ReflectionImplementedInterfaceParser();
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
        // Interface inheritance used to be dropped entirely here, leaving getParentInterfaces()
        // empty for every reflected interface — so ClassHierarchyResolver::resolveInterface() was a
        // permanent no-op on the reflection storage even though Runner calls it there, and no check
        // could compare a stub's `extends` clause against the runtime.
        //
        // NOTE the semantics differ from the stubs side: ReflectionClass::getInterfaces() on an
        // interface returns the *transitive* ancestor set (\RecursiveIterator yields both Iterator
        // and Traversable), whereas PHPInterfaceSerializer records only the direct `extends` names
        // the stub literally writes. This mirrors ReflectionClassParser/ReflectionEnumParser, which
        // populate implementedInterfaces from the same transitive call. A check comparing the two
        // sides must therefore treat the reflection list as a superset, not as an equal set.
        foreach ($object->getInterfaces() ?? [] as $parentInterface) {
            $interface->addParentInterface($this->interfaceParser->parse($parentInterface));
        }
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
