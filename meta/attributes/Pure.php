<?php

namespace JetBrains\PhpStorm;

use Attribute;

/**
 * The attribute marks function that has no impact on program state or passed parameters that are used after function exectuion.
 * In other words, it means that function call that resolved to such function can be safely removed if result of execution is not used in code after.
 *
 * @since 8.0
 */
#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD)]
class Pure {

}
