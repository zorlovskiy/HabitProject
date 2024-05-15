<?php

namespace App\Services\ProgressMark;

use App\Events\SendMail;
use App\Models\ProgressMark;
use App\Services\Habit\HabitServiceInterface;
use Illuminate\Support\Facades\Log;

class ProgressMarkService implements ProgressMarkInterface
{

    public function __construct(
        private readonly HabitServiceInterface $habitService,
    )
    {
    }

    public function create(array $data): ?ProgressMark
    {
        /** @var ProgressMark $progressMark */
        $progressMark = null;

        try {
            $progressMark = ProgressMark::query()->create([
                ...$data,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }

        $this->progressChecker($progressMark);

        return $progressMark;
    }

    public function progressChecker(ProgressMark $progressMark)
    {
        if ($progressMark) {
            $habit = $progressMark->habit;
            $endDate = $habit->endDate();

            $period = ["start_date" => $habit->created_at->format('Y-m-d'), "end_date" => $endDate->format('Y-m-d')];

            $result = $this->habitService->statisticByPeriod($habit, $period);

            if ($result['result'] == 100) {
                event(new SendMail($habit->user, $habit));
            }

        }
    }
}
