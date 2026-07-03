<?php

namespace JetBrains\PhpStorm;

use Attribute;

/**
 * Marks a string parameter as a file or directory path.
 * The IDE injects file references into the passed string literals, enabling
 * navigation, rename/move support, and completion for paths inside the project.
 *
 * @since 8.0
 */
#[Attribute(Attribute::TARGET_PARAMETER)]
class FileReference
{
    /**
     * @param string $basePath Optional base path. May be relative (resolved against project content roots) or absolute.
     *                         When empty (default), references resolve against the project content roots.
     */
    public function __construct(string $basePath = '') {}
}
