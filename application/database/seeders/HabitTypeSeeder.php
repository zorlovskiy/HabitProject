<?php

namespace Database\Seeders;

use App\Models\HabitType;
use App\Utils\Enums\HabitType\HabitTypeEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitTypeSeeder extends Seeder
{

    public function run(): void
    {
        HabitType::query()->firstOrCreate(['name' => HabitTypeEnum::FORMING->value]);
        HabitType::query()->firstOrCreate(['name' => HabitTypeEnum::REJECTION->value]);
    }
}
