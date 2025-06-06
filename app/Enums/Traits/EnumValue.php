<?php

declare(strict_types=1);

namespace App\Enums\Traits;

trait EnumValue
{
    public static function getOption($k): array
    {
        foreach (self::getValueValue() as $key => $value) {
            if ($key == $k) {
                return ['label' => $value, 'value' => $key];
            }
        }

        return [];
    }

    public static function getValueName(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_column(self::cases(), 'name'),
        );
    }

    public static function getNameValue(): array
    {
        return array_combine(
            array_column(self::cases(), 'name'),
            array_column(self::cases(), 'value'),
        );
    }

    public static function getListOption(): array
    {
        foreach (self::getValueValue() as $key => $value) {
            $result[] = ['label' => $value, 'value' => $key];
        }

        return $result;
    }

    public static function getValueValue(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_column(self::getEnumName()::cases(), 'value'),
        );
    }
}
