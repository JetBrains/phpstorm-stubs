<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionClass>
 */
class ReflectionEnumParser implements Parser
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
            && $object->isEnum();
    }

    /**
     * Parse an AdaptedReflectionClass (representing an enum) into a PHPEnum model
     *
     * @param AdaptedReflectionClass $object
     * @return PHPEnum
     */
    public function parse($object): PHPEnum
    {
        $parsedEnum = new PHPEnum();
        $parsedEnum->setName($object->getShortName());
        $parsedEnum->setNamespace($object->getNamespaceName() ? '\\' . $object->getNamespaceName() : '\\');
        if ($parsedEnum->getNamespace() !== '\\') {
            $parsedEnum->setId($parsedEnum->getNamespace() . '\\' . $parsedEnum->getName());
        } else {
            $parsedEnum->setId('\\' . $parsedEnum->getName());
        }
        $parsedEnum->setIsFinal((bool)$object->isFinal());
        $parsedEnum->setIsReadonly((bool)$object->isReadOnly());
        foreach ($object->getMethods() ?? [] as $method) {
            $parsedEnum->addMethod($this->methodParser->parse($method));
        }
        // ReflectionClass::getReflectionConstants() reports enum cases alongside real
        // constants, distinguished by isEnumCase(). They must be split: cases belong in
        // setCases() so EnumCasesCheck can compare them against the stubs, and treating
        // them as constants instead left getCaseNames() permanently empty, which made
        // that check incapable of ever failing.
        $caseNames = [];
        if ($object->hasReflectionConstants()) {
            foreach ($object->getReflectionConstants() ?? [] as $reflectionConstant) {
                if ($reflectionConstant->isEnumCase()) {
                    $caseNames[] = $reflectionConstant->getName();
                    continue;
                }
                $parsedEnum->addConstant($this->constantParser->parse($reflectionConstant));
            }
        } else {
            // Fallback for reflection data captured without getReflectionConstants(), which
            // carries no isEnumCase flag. Enums require PHP 8.1, where that method always
            // exists, so this is only reachable for malformed data — keep the entries as
            // constants rather than guessing which are cases.
            foreach ($object->getConstants() ?? [] as $key => $value) {
                $parsedEnum->addConstant($this->constantParser->parse([$key => $value]));
            }
        }
        $parsedEnum->setCases($caseNames);
        foreach ($object->getInterfaces() ?? [] as $interface) {
            $parsedEnum->addImplementedInterface($this->interfaceParser->parse($interface));
        }
        return $parsedEnum;
    }
}
