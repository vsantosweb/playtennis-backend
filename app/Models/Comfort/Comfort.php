<?php

namespace App\Models\Comfort;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comfort extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected $hidden = ['pivot'];

    static function booted()
    {
        parent::creating(fn (Comfort $comfort) => [$comfort->uuid = Str::uuid(), $comfort->slug = Str::slug($comfort->name)]);
        parent::updating(fn (Comfort $comfort) => $comfort->slug = Str::slug($comfort->name));
    }
}
