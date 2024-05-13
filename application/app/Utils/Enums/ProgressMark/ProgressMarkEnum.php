<?php

namespace App\Utils\Enums\ProgressMark;

use App\Utils\Traits\EnumEnhancements;

enum ProgressMarkEnum: string
{
    use EnumEnhancements;

    case TRUE = 'true';

    case FALSE = 'false';
}
