<?php

namespace App\Attributes\Enums;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class Label
{
    public function __construct(
        public string $label
    ) {}
}
