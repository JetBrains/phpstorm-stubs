<?php

namespace JetBrains\PhpStorm;

use Attribute;

/**
 * Marks a string parameter or a constant as a file or directory path.
 * The IDE injects file references into the string literals passed into parameter or concatenated with a constant,
 * and enables navigation, rename/move support, and completion for paths inside the project.
 */
#[Attribute(Attribute::TARGET_PARAMETER|Attribute::TARGET_CONSTANT|Attribute::TARGET_CLASS_CONSTANT)]
class FileReference
{
    /**
     * @param string $basePath Optional base path. May be relative (resolved against project content roots) or absolute.
     *                         When empty (default), references resolve against the project content roots.
     */
    public function __construct(string $basePath = '') {}
}
