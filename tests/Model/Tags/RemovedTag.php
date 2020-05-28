<?php
declare(strict_types=1);

namespace StubTests\Model\Tags;

use phpDocumentor\Reflection\DocBlock\Description;
use phpDocumentor\Reflection\DocBlock\DescriptionFactory;
use phpDocumentor\Reflection\DocBlock\Tags\BaseTag;
use phpDocumentor\Reflection\DocBlock\Tags\Factory\StaticMethod;
use phpDocumentor\Reflection\Types\Context;
use Webmozart\Assert\Assert;

class RemovedTag extends BaseTag implements StaticMethod
{
    protected $name = 'removed';

    private const REGEX_VECTOR = '(?:\d\S*|[^\s\:]+\:\s*\$[^\$]+\$)';

    private ?string $version;

    public function __construct($version = null, Description $description = null)
    {
        Assert::nullOrStringNotEmpty($version);

        $this->version = $version;
        $this->description = $description;
    }

    public static function create($body, DescriptionFactory $descriptionFactory = null, Context $context = null)
    {
        Assert::nullOrString($body);
        if (empty($body)) {
            return new static();
        }

        $matches = [];
        if (!preg_match('/^(' . self::REGEX_VECTOR . ')\s*(.+)?$/sux', $body, $matches)) {
            return new static(
                null,
                null !== $descriptionFactory ? $descriptionFactory->create($body, $context) : null
            );
        }

        return new static(
            $matches[1],
            $descriptionFactory->create($matches[2] ?? '', $context)
        );
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function __toString()
    {
        return "PhpStorm internal '@removed' tag";
    }
}
