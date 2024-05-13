<?php

namespace App\Services\ProgressMark;

use App\Models\ProgressMark;
use Illuminate\Support\Facades\Log;

class ProgressMarkService implements ProgressMarkInterface
{

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

        return $progressMark;
    }
}
