<?php

namespace App\Models\Subscription;

use App\Models\Benefit\Benefit;
use App\Models\Business\Business;
use App\Models\Classification;
use App\Models\Gym\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;


class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'uuid', 'slug','description', 'business_id'];

    static function booted()
    {
        parent::creating(fn (Subscription $subscription) => [$subscription->uuid = Str::uuid(), $subscription->slug = 'assinaturas-' . Str::slug($subscription->name)]);
        parent::updating(fn (Subscription $subscription) => $subscription->slug = 'assinaturas-' . Str::slug($subscription->name));
    }

    public function gyms()
    {
        return $this->belongsToMany(Gym::class, 'gyms_subscriptions');
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    
    public function classifications()
    {
        return $this->belongsToMany(Classification::class, 'subscriptions_classifications');
    }

    public function benefits()
    {
        return $this->belongsToMany(Benefit::class, 'subscriptions_benefits');
    }
    
}
