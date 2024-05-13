<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HabitType extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'name',
    ];

    public function habit(): HasMany
    {
        return $this->hasMany(Habit::class);
    }
}
