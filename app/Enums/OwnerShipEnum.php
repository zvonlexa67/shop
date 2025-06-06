<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Enums\Label;
use App\Traits\Enums\EnumOptions;
use App\Traits\Enums\LabelEnum;

enum OwnerShipEnum: int
{
    use EnumOptions, LabelEnum;

    #[Label('Физическое лицо')]
    case Individual = 0;

    #[Label('Юридическое лицо')]
    case LegalEntity = 1;
}
