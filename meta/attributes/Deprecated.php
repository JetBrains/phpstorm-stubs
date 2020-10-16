<?php

namespace JetBrains\PhpStorm;

use Attribute;


#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
class Deprecated {
    const PHP_VERSIONS = [
        "5.3",
        "5.4",
        "5.5",
        "5.6",
        "7.0",
        "7.1",
        "7.2",
        "7.3",
        "7.4",
        "8.0",
    ];

    /**
     * Mark element as deprecated
     *
     * @param string $reason Explanation of the deprecation, will be displayed by PhpStorm in deprecated inspection instead of default message
     * @param string $replacement Applicable only to function/method calls: IDE will suggest to replace deprecated function call with provided code template.
     * The following variables are available in this template:
     * <ul>
     * <li>%parametersList%: parameters of function call. For f(1,2) this will be "1,2"</li>
     * <li>%param0%,%param1%,%param2%,...: parameters of function call. For f(1,2) %param1% will be "2"</li>
     * <li>%name%: For \x\f(1,2) this will be "\x\f", for $this->ff() this will be "$this->ff"</li>
     * </ul>
     * The following example shows how to wrap function call in another and swap arguments:<br />
     * "#[Deprecated(replaceWith: "wrappedCall(%name%(%param1%, %param0%))")] f($a, $b){}<br />
     * f(1,2) will be replaced with wrappedCall(f(2,1))
     * @param string $since Element is deprecated starting with PHP language level, applicable only for PhpStorm stubs entries
     */
    public function __construct($reason = "", $replacement = "",
                                #[ExpectedValues(self::PHP_VERSIONS)] $since = "5.6")
    {
    }
}
