<?php

namespace App\Models\Workout;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WorkoutEbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'workout_id',
        'name',
        'slug',
        'is_main',
        'url',
        'download_total',
    ];

    static function booted()
    {
        parent::creating(fn (WorkoutEbook $workoutEbook) => [$workoutEbook->uuid = Str::uuid(), $workoutEbook->slug = 'ebook-aulas-' . Str::slug($workoutEbook->workout->name)]);
        parent::updating(fn (WorkoutEbook $workoutEbook) => $workoutEbook->slug = 'ebook-aulas-' . Str::slug($workoutEbook->workout->name));
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function downloads()
    {
        return $this->hasMany(WorkoutEbookDownload::class);
    }
}
