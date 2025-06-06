<?php

namespace App\Enums\Traits;

trait EnumName
{
    public static function getAll(): array
    {
        return array_combine(
            array_column(self::cases(), 'name'),
            array_column(self::cases(), 'value'),
        );
    }
}
