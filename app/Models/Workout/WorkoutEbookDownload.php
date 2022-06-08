<?php

namespace App\Models\Workout;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WorkoutEbookDownload extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'workout_ebook_id',
        'accepted_terms',
        'email',
    ];

    public function ebook()
    {
        return $this->belongsTo(WorkoutEbook::class, 'workout_ebook_id');
    }
}
