<?php

namespace App\Services\Habit;

use App\Models\Habit;
use App\Models\User;

interface HabitServiceInterface
{
    public function create(User $user, array $data): ?Habit;

    public function update(Habit $habit, array $data): ?Habit;

    public function delete(array $habit): bool;

    public function statisticByPeriod(Habit $habit, array $data): array;
}
