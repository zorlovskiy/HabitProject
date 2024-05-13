<?php

namespace App\Services\ProgressMark;

use App\Models\ProgressMark;

interface ProgressMarkInterface
{
    public function create(array $data): ?ProgressMark;
}
