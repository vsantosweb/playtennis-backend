<?php

namespace App\Models\Benefit;

use App\Models\Workout\Workout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'slug',
        'name'
    ];

    static function booted()
    {
        parent::creating(fn (Benefit $benefit) => [$benefit->uuid = Str::uuid(),  $benefit->slug = 'benefit-' . Str::slug($benefit->name)]);
        parent::updating(fn (Benefit $benefit) => $benefit->slug = 'benefit-' . Str::slug($benefit->name));
    }

    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'workouts_benefits');
    }
}
