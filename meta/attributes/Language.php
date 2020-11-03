<?php

namespace JetBrains\PhpStorm;

use Attribute;

/**
 * Specifies that parameters is a string that represents source code in another language.
 * IDE will automatically inject specified language into passed string literals.
 *
 * @since 8.0
 */
#[Attribute(Attribute::TARGET_PARAMETER)]
class Language {
    /**
     * @param string $languageName Language name like "PHP", "SQL", "RegExp", etc...
     */
    public function __construct(string $languageName)
    {
    }
}
