<?php

namespace App\Models\Gym;

use App\Models\Comfort\Comfort;
use App\Models\Lease\Lease;
use App\Models\Locale\City;
use App\Models\Subscription\Subscription;
use App\Models\TennisCourt\TennisCourt;
use App\Models\Workout\Workout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'is_main',
        'geolocation',
        'city_id',
        'city',
        'state',
        'address_1',
        'address_2',
        'locality',
        'phone',
        'email',
        'is_school',
        'description',
    ];

    static function booted()
    {
        parent::creating(fn (Gym $gym) => [$gym->uuid = Str::uuid(), $gym->slug = Str::slug($gym->name)]);
        parent::updating(fn (Gym $gym) => $gym->slug = Str::slug($gym->name));
    }

    public function city()
    {
        return $this->belongsTo(City::class)->with('state');
    }

    public function comforts()
    {
        return $this->belongsToMany(Comfort::class, 'gyms_comforts');
    }

    public function tennisCourts()
    {
        return $this->belongsToMany(TennisCourt::class, 'gym_courts')->withPivot('indoor', 'outdoor');
    }

    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'gyms_workouts');
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'gyms_subscriptions');
    }

    public function leases()
    {
        return $this->belongsToMany(Lease::class, 'gyms_leases');
    }
}
