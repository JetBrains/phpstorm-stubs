<?php
declare(strict_types=1);

namespace StubTests\Model\Tags;

use phpDocumentor\Reflection\DocBlock\Description;
use phpDocumentor\Reflection\DocBlock\DescriptionFactory;
use phpDocumentor\Reflection\DocBlock\Tags\BaseTag;
use phpDocumentor\Reflection\Types\Context;

class RemovedTag extends BaseTag
{
    const REGEX_VECTOR = '(?:\d\S*|[^\s\:]+\:\s*\$[^\$]+\$)';
    private $version;

    /**
     * @param string|null $version
     * @param Description|null $description
     */
    public function __construct($version = null, Description $description = null)
    {
        $this->version = $version;
        $this->name = 'removed';
        $this->description = $description;
    }

    /**
     * @param string|null $body
     * @param DescriptionFactory|null $descriptionFactory
     * @param Context|null $context
     * @return RemovedTag
     */
    public static function create(string $body, $descriptionFactory = null, $context = null): RemovedTag
    {
        if (empty($body)) {
            return new self();
        }

        $matches = [];
        if ($descriptionFactory !== null) {
            if (!preg_match('/^(' . self::REGEX_VECTOR . ')\s*(.+)?$/sux', $body, $matches)) {
                return new self(null, $descriptionFactory->create($body, $context));
            }

            return new self(
                $matches[1],
                $descriptionFactory->create($matches[2] ?? '', $context)
            );
        }
        return new self();
    }

    /**
     * @return string|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    public function __toString(): string
    {
        return "PhpStorm internal '@removed' tag";
    }
}
