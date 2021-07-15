<?php

namespace JetBrains\PhpStorm;

use Attribute;

/**
 * This marks a property as readonly.
 *
 * That means that this property can only be writting from the declaring class constructor it self.
 *
 * @since 8.0
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Readonly
{
}
