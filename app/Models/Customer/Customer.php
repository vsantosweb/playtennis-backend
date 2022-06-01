<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'uid',
        'email',
        'customer_status_id',
        'cpf',
        'rg',
        'status',
        'password',
        'gender',
        'phone',
        'occupation',
        'notification',
        'birthday',
        'email_verified_at',
        'created_at',
        'updated_at',
        'remember_token',
        'customers',
    ];
    
    protected $hidden = ['password'];
    
    static function booted()
    {
        parent::creating(fn (Customer $customer) => [$customer->uuid = Str::uuid()]);
    }
}
