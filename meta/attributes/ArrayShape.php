<?php

namespace JetBrains\PhpStorm;

use Attribute;

/**
 * The attribute specifies possible array keys and their types.
 *
 * If applied, IDE will suggest specified array keys, will infer specified types and will highlight non-specified keys in array access
 *
 * Array shapes should be specified with required $shape parameter, it's values should be array literal.<br />
 * Here is sample usage: <br />
 * <b>#[ArrayShape(["f" => "int", "string", "x" => "float"])]</b>
 * This usage applied on element effectively means that array has dimension 3, keys are "f", 1, "x", corresponding types are "int", "string" and "float".
 */
#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD | Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY)]
class ArrayShape {
    public function __construct(array $shape)
    {
    }
}
