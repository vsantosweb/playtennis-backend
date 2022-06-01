<?php

namespace App\Models\Workout;

use App\Models\Benefit\Benefit;
use App\Models\Business\Business;
use App\Models\Gym\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'uuid', 'slug','description', 'business_id'];

    static function booted()
    {
        parent::creating(fn (Workout $workout) => [$workout->uuid = Str::uuid(), $workout->slug = 'aulas-' . Str::slug($workout->name)]);
        parent::updating(fn (Workout $workout) => $workout->slug = 'aulas-' . Str::slug($workout->name));
    }

    public function gyms()
    {
        return $this->belongsToMany(Gym::class, 'gyms_workouts');
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function benefits()
    {
        return $this->belongsToMany(Benefit::class, 'workouts_benefits');
    }
}
