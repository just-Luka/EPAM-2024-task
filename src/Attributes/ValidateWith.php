<?php

declare(strict_types=1);

namespace App\Attributes;

use App\Domain\Request\BaseRequest;
use Attribute;
use http\Exception\InvalidArgumentException;

#[Attribute]
final readonly class ValidateWith
{
    public function __construct(
        public string $concrete
    ) {
        if (!is_subclass_of($this->concrete, BaseRequest::class)) {
            throw new InvalidArgumentException(
                sprintf("Class '%s' must be a subclass of %s", $this->concrete, BaseRequest::class)
            );
        }
    }
}