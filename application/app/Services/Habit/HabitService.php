<?php

namespace App\Services\Habit;

use App\Models\Habit;
use App\Models\HabitType;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class HabitService implements HabitServiceInterface
{
    public function create(User $user, array $data): ?Habit
    {
        /** @var Habit $habit */
        $habit = null;

        try {

            $habit = Habit::query()->create([
                ...$data,
                'user_id' => $user->id,
                'habit_type_id' => HabitType::query()->where('name', $data['type'])->first()->id
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }

        return $habit;
    }

    public function update(Habit $habit, array $data): ?Habit
    {
        try {

            $habit->update($data);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return $habit;
    }

    public function delete(array $habits): bool
    {
        $result = null;

        foreach ($habits as $habit) {
           $result += Habit::query()->where('id', $habit)->delete();
        }

        if ($result === 0) {
            return false;
        }

        return true;
    }
}

