<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'website',
        'description',
    ];

    static function booted()
    {
        parent::creating(fn (Partner $partner) => [$partner->uuid = Str::uuid(), $partner->slug = Str::slug($partner->name)]);
        parent::updating(fn (Partner $partner) => $partner->slug = Str::slug($partner->name));
    }
}
