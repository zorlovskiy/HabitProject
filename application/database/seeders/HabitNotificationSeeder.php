<?php

namespace Database\Seeders;

use App\Models\HabitNotification;
use App\Utils\Enums\HabitNotification\HabitNotificationEnum;
use Illuminate\Database\Seeder;

class HabitNotificationSeeder extends Seeder
{

    public function run(): void
    {
        HabitNotification::query()->firstOrCreate(['name' => HabitNotificationEnum::DAILY->value]);
        HabitNotification::query()->firstOrCreate(['name' => HabitNotificationEnum::WEEKLY->value]);
    }
}
