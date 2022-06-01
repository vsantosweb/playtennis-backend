<?php

namespace App\Models\Business;

use App\Models\Lease\Lease;
use App\Models\Subscription\Subscription;
use App\Models\Workout\Workout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Business extends Model
{
    use HasFactory;


 protected $fillable = ['name', 'slug'];

 protected $table = 'business';
 
    static function booted()
    {
        parent::creating(fn (Business $business) => [$business->uuid = Str::uuid(), $business->slug = Str::slug($business->name)]);
        parent::updating(fn (Business $business) => $business->slug = Str::slug($business->name));
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class, 'business_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'business_id');
    }

    public function leases()
    {
        return $this->hasMany(Lease::class, 'business_id');
    }

    // public function kidsTeen()
    // {
    //     return $this->hasManyThrough(Workout::class, 'business_id');
    // }

}
