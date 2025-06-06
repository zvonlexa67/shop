<?php

namespace App\Traits\Enums;

trait EnumOptions
{
    public static function getOptions(): array
    {
        $options = [];

        foreach (self::cases() as $item) {
            $options[] = ['label' => $item->label(), 'value' => $item->value];
        }

        return $options;
    }

    public function getOption(): array
    {
        return ['label' => $this->label(), 'value' => $this->value];
    }
}
