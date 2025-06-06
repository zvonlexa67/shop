<?php

namespace App\Traits\Enums;

use App\Attributes\Enums\Label;
use Illuminate\Support\Arr;
use ReflectionClassConstant;

trait LabelEnum
{
    public function label(): string
    {
        $attributes = (new ReflectionClassConstant(
            class: self::class,
            constant: $this->name,
        ))->getAttributes(
            name: Label::class,
        );

        if ($attributes === []) {
            throw new \RuntimeException(
                message: "No Label attribute found for {$this->name}",
            );
        }

        return Arr::first($attributes)->newInstance()->label;
    }
}
