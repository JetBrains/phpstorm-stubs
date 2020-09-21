<?php

namespace JetBrains\PhpStorm;

use Attribute;

/**
 * Attribute specifies expected values of the entity: return values for functions and argument values for methods
 *
 * If attribute is applied, PhpStorm will assume that only specified in attribute constructor arguments can
 * be passed/returned, this will affect:
 * <ul>
 * <li><i>completion: </i> expected arguments will be on the top of the list in comparisons</li>
 * <li><i>inspections [comparison with value/assignment to/return from method]: </i> element absent in expected values list will produce inspection warning</li>
 * <li><i>code generation: 'switch' construction generation:</i> for example, will automatically insert all possible expected values</li>
 * </ul>
 *
 * Expected values can be:
 * <ul>
 * <li>numbers</li>
 * <li>string literals</li>
 * <li>constant references</li>
 * <li>class constant references</li>
 * </ul>
 *
 * There are 4 ways to specify expected arguments:
 * <ul>
 * <li><b>#[ExpectedValues(values: [1,2,3])]</b> - this means that one of the following is expected: `1`, `2,` or `3`</li>
 * <li><b>#[ExpectedValues(flags: [1,2,3])]</b> - this means that bitmask of the following is expected: `1`, `2,` or `3`</li>
 * <li><b>#[ExpectedValues(valuesFromClass: MyClass::class)]</b> - this means that one of the constants from class `MyClass` is expected</li>
 * <li><b>#[ExpectedValues(flagsFromClass: ExpectedValues::class)]</b> - this means that bitmask of the constants from class `MyClass` is expected</li>
 * </ul>
 *
 * Attribute without constructor arguments size != 1 will produce undefined behaviour
 */
#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD | Attribute::TARGET_PARAMETER)]
class ExpectedValues {
    public function __construct($values = [], $flags = [], $valuesFromClass = null, $flagsFromClass = null)
    {
    }
}
