<?php

namespace App\Attributes\Enums;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class Table
{
    public function __construct(
        public string $table
    ) {}
}
