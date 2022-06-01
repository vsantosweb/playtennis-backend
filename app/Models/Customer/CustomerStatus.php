<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomerStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'uuid',
        'slug',
    ];
    
    protected $table = 'customer_status';

    static function booted()
    {
        parent::creating(fn (CustomerStatus $customerStatus) => [$customerStatus->uuid = Str::uuid(),  $customerStatus->slug = 'customerStatus-' . Str::slug($customerStatus->name)]);
        parent::updating(fn (CustomerStatus $customerStatus) => $customerStatus->slug = 'customerStatus-' . Str::slug($customerStatus->name));
    }
}
