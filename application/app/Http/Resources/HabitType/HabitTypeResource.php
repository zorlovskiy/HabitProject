<?php

namespace App\Http\Resources\HabitType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HabitTypeResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'name' => $this->name,
        ];
    }
}
