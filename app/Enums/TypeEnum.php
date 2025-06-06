<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Enums\Label;
use App\Attributes\Enums\Table;
use App\Traits\Enums\EnumOptions;
use App\Traits\Enums\LabelEnum;
use App\Traits\Enums\TableEnum;

enum TypeEnum: int
{
    use EnumOptions, LabelEnum, TableEnum;

    #[Table('')]
    #[Label('Строка')]
    case String = 1;

    #[Table('')]
    #[Label('Булево')]
    case Boolean = 2;

    #[Table('')]
    #[Label('Число')]
    case Number = 3;

    #[Table('')]
    #[Label('Диапазон')]
    case Range = 4;

    #[Table('')]
    #[Label('Пусто')]
    case RangeInt = 5;

    #[Table('')]
    #[Label('Пусто')]
    case RangeReal = 6;

    #[Table('brands')]
    #[Label('Справочник Брэнд')]
    case Brand = 7;

    #[Table('colors')]
    #[Label('Справочник Цвет')]
    case Color = 8;

    #[Table('dimensions')]
    #[Label('Справочник Размер')]
    case Dimension = 9;

}
