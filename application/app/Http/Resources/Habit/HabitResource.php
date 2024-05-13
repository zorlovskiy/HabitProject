<?php

namespace App\Http\Resources\Habit;

use App\Http\Resources\HabitType\HabitTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HabitResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'habit_type' => HabitTypeResource::make($this->whenLoaded('habitType')),
            'target' => $this->target,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
