<?php

namespace App\Models\TennisCourt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TennisCourt extends Model
{
    use HasFactory;

    protected $fillable =['name', 'slug'];

    static function booted()
    {
        parent::creating(fn (TennisCourt $tennisCourt) => [$tennisCourt->uuid = Str::uuid(), $tennisCourt->slug = Str::slug($tennisCourt->name)]);
        parent::updating(fn (TennisCourt $tennisCourt) => $tennisCourt->slug = Str::slug($tennisCourt->name));
    }
}
