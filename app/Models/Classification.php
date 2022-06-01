<?php

namespace App\Models;

use App\Models\Subscription\Subscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'uuid','description', 'business_id'];
    protected $hidden = ['pivot'];
    static function booted()
    {
        parent::creating(fn (Classification $classification) => [$classification->uuid = Str::uuid()]);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'subscriptions_classifications');
    }
}
