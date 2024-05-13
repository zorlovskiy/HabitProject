<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Habit extends Model
{
    use HasUuids, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'habit_type_id',
        'target'
    ];

    public function habitType(): BelongsTo
    {
        return $this->belongsTo(HabitType::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function progressMarks(): HasMany
    {
        return $this->hasMany(ProgressMark::class);
    }
}
