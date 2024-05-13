<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProgressMark extends Model
{
    use HasUuids, HasFactory, Notifiable;

    protected $fillable = [
        'habit_id',
        'mark',
    ];
}
