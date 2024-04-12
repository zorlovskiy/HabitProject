<?php

namespace App\Utils\Enums\HabitNotification;

use App\Utils\Traits\EnumEnhancements;

enum HabitNotificationEnum: string
{
    use EnumEnhancements;

    case DAILY = 'ежедневно';
    case WEEKLY = 'еженедельно';
}
