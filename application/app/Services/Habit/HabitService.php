<?php

namespace App\Services\Habit;

use App\Models\Habit;
use App\Models\HabitType;
use App\Models\ProgressMark;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HabitService implements HabitServiceInterface
{
    public function create(User $user, array $data): ?Habit
    {
        /** @var Habit $habit */
        $habit = null;

        try {
            DB::transaction(function () use (&$habit, &$user, $data) {

                $habitTypeId = HabitType::query()->where('name', $data['type'])->first()->id;

                $habit = Habit::query()->create([
                    ...$data,
                    'user_id' => $user->id,
                    'habit_type_id' => $habitTypeId
                ]);
            });

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

        $result = Habit::query()->whereIn('id', $habits)->delete();
        //foreach ($habits as $habit) {
        //   //$result += Habit::query()->where('id', $habit)->delete();
        //}
//
        //if ($result === 0) {
        //    return false;
        //}

        return $result;
    }

    public function statisticByPeriod(Habit $habit, array $data): array
    {
        $toDate = Carbon::parse($data['start_date']);
        $fromDate = Carbon::parse($data['end_date']);

        $marksBetweenDates = $toDate->diffInDays($fromDate) + 1;
        $activeMarks = $this->getActiveMarks($habit, $data);

        $result = ($activeMarks / $marksBetweenDates) * 100;

        $arr = ['result' => $result, 'active' => $activeMarks, 'marksBetweenDates' => $marksBetweenDates];

        return $arr;
    }

    public function getActiveMarks(Habit $habit, array $data): int
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $data['start_date'])->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $data['end_date'])->endOfDay();

        $activeMarks = ProgressMark::query()
            ->where('habit_id', $habit->id)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('mark', '=','true')
            ->count();

        return $activeMarks;
    }
}

