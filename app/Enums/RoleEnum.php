<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Enums\Label;
use App\Traits\Enums\EnumOptions;
use App\Traits\Enums\LabelEnum;

enum RoleEnum: int
{
    use EnumOptions, LabelEnum;

    #[Label('Супервизор')]
    case Supervisor = 0;

    #[Label('Администратор')]
    case Admin = 1;

    #[Label('Менеджер')]
    case Manager = 2;

    #[Label('Рекламодатель')]
    case Advertiser = 3;

    #[Label('Контент')]
    case Content = 4;

    #[Label('Клиент')]
    case Client = 5;

    #[Label('Гость')]
    case Guest = 6;
}
