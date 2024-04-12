<?php

namespace App\Utils\Enums\HabitType;

use App\Utils\Traits\EnumEnhancements;

enum HabitTypeEnum: string
{
    use EnumEnhancements;

    case FORMING = 'формирование';
    case REJECTION = 'отказ';
}
