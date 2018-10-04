<?php

// Start of inspector

/**
 * A disassembler and debug kit for PHP7
 * @link https://github.com/krakjoe/inspector
 */
namespace Inspector
{
    class InspectorClass extends \ReflectionClass
    {
        /**
         * @return bool
         */
        public function isPending() {}

        public function onResolve() {}

        /**
         * @param string $name
         * @return InspectorMethod
         */
        public function getMethod(string $name) {}

        /**
         * @param int $filter
         * @return array
         */
        public function getMethods($filter = 0) {}

        /**
         * @param array $filters
         */
        public static function purge(array $filters = []) {}
    }

    abstract class InspectorMethod extends \ReflectionMethod implements InspectorInstructionInterface
    {
        /**
         * @return InspectorClass
         */
        public function getDeclaringClass() {}
    }

    abstract class InspectorFunction extends \ReflectionFunction implements InspectorInstructionInterface
    {
        /**
         * @return bool
         */
        public function isPending() {}

        public function onResolve() {}

        public static function purge(array $filters = []) {}
    }

    abstract class InspectorFile extends InspectorFunction
    {
        /**
         * InspectorFile constructor.
         * @param string $file
         */
        public function __construct(string $file) {}

        /**
         * @return bool
         */
        public function isPending() {}

        public function onResolve() {}

        public static function purge(array $filters = []) {}
    }


    interface InspectorInstructionInterface
    {
        /**
         * @param int $num
         * @return InspectorInstruction
         */
        public function getInstruction($num = 0);

        /**
         * @return int
         */
        public function getInstructionCount();

        /**
         * @return InspectorInstruction|null
         */
        public function getEntryInstruction();

        /**
         * @param int $opcode
         * @param int $offset
         * @return InspectorInstruction|null
         */
        public function findFirstInstruction($opcode, $offset = 0);

        /**
         * @param int $opcode
         * @param int $offset
         * @return InspectorInstruction|null
         */
        public function findLastInstruction($opcode, $offset = -1);

        public function flushInstructionCache();
    }

    /**
     * Class InspectorInstruction
     *
     * opcode constants are registered with prefixed ZEND_ (verbatim)
     * vm constants are registered with prefix ZEND_VM_ (verbatim)
     */
    final class InspectorInstruction
    {
        /**
         * @return int
         */
        public function getOffset() {}

        /**
         * @return int
         */
        public function getOpcode() {}

        /**
         * @return null|string
         */
        public function getOpcodeName() {}

        /**
         * @param int $which
         * @return InspectorOperand
         */
        public function getOperand($which) {}

        /**
         * @return mixed
         */
        public function getExtendedValue() {}

        /**
         * @return int
         */
        public function getLine() {}

        /**
         * @return InspectorFunction
         */
        public function getFunction() {}

        /**
         * @return InspectorInstruction|null
         */
        public function getNext() {}

        /**
         * @return InspectorInstruction|null
         */
        public function getPrevious() {}

        /**
         * @param int $offset
         * @return InspectorInstruction|null
         */
        public function getRelative($offset) {}

        /**
         * @return InspectorBreakPoint
         */
        public function getBreakPoint() {}

        /**
         * @param array $which array<int>
         */
        public function getFlags($which) {}
    }

    final class InspectorOperand
    {
        /**
         * @return bool
         */
        public function isUnused() {}

        /**
         * @return bool
         */
        public function isExtendedTypeUnused() {}

        /**
         * @return bool
         */
        public function isCompiledVariable() {}

        /**
         * @return bool
         */
        public function isTemporaryVariable() {}

        /**
         * @return bool
         */
        public function isVariable() {}

        /**
         * @return bool
         */
        public function isConstant() {}

        /**
         * @return bool
         */
        public function isJumpTarget() {}

        /**
         * @return int
         */
        public function getWhich() {}

        /**
         * @param InspectorFrame|null $frame
         * @return mixed
         */
        public function getValue(InspectorFrame $frame) {}

        /**
         * @return string
         */
        public function getName() {}

        /**
         * @return int
         */
        public function getNumber() {}

        /**
         * @return InspectorInstruction
         */
        public function getInstruction() {}
    }

    class InspectorBreakPoint
    {
        /**
         * @param InspectorInstruction $opline
         */
        public function __construct(InspectorInstruction $opline) {}

        /**
         * @return bool
         */
        public function enable() {}

        /**
         * @return bool
         */
        public function disable() {}

        /**
         * @return bool
         */
        public function isEnabled() {}

        /**
         * @return InspectorInstruction
         */
        public function getInstruction() {}

        /**
         * @param InspectorFrame $frame
         * @return mixed
         */
        public function hit(InspectorFrame $frame) {}

        /**
         * @param \Closure InspectorFrame $frame
         * @param \Throwable $handler)
         */
        public static function onException(\Closure $frame, \Throwable $handler) {}
    }

    final class InspectorFrame
    {
        /**
         * @return InspectorInstructionInterface
         */
        public function getFunction() {}

        /**
         * @return InspectorInstruction|null
         */
        public function getInstruction() {}

        /**
         * @param InspectorInstruction $instruction
         */
        public function setInstruction(InspectorInstruction $instruction) {}

        /**
         * @return array|null
         */
        public function getSymbols() {}

        /**
         * @return InspectorFrame|null
         */
        public function getPrevious() {}

        /**
         * @return InspectorFrame|null
         */
        public function getCall() {}

        /**
         * @return array
         */
        public function getStack() {}

        /**
         * @return array
         */
        public function getParameters() {}

        /**
         * @param int $num
         * @return mixed
         */
        public function getVariable($num) {}

        /**
         * @return null|object
         */
        public function getThis() {}

        /**
         * @return InspectorFrame
         */
        public static function getCurrent() {}
    }
}
